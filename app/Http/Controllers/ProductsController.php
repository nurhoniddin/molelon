<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use DB;
use Carbon\Carbon;
use Dompdf\Dompdf;

class ProductsController extends Controller
{
    public function addProduct(Request $request){

    	if ($request->isMethod('post')) {
    		$data = $request->all();
            // echo "<pre>"; print_r($data); die;
    		if (empty($data['category_id'])) {
    			return redirect()->back()->with('flash_message_error','Under Category is mmissing!');
    		}

            if (empty($data['description'])) {
                $data['description'] = "";
            }

            $user_id = Auth::user()->id;

    		$product = new Product;
            $product->category_id = $data['category_id'];
    		$product->user_id = $user_id;
    		$product->product_name = $data['product_name'];
    		$product->description = $data['description'];
            $product->price = $data['price'];
            $product->price_type = $data['price_type'];
            $product->status = $data['status'];
    		$product->country_id = $data['country_id'];

            $this->validate($request, [
              'image'  => 'required|image|mimes:jpeg,png,jpg'
             ]);

            if ($request->file('images[]')) {
                $this->validate($request, [
                  'images[]'  => 'required|images|mimes:jpeg,png,jpg'
                 ]);
            }

            // Upload Image
             if ($request->hasFile('image')) {
             	$image_tmp = Input::file('image');
             	if ($image_tmp->isValid()) {
             		$extension = $image_tmp->getClientOriginalExtension();
             		$filename = rand(111,99999).'.'.$extension;
             		$large_image_path = 'images/backend_images/products/large/'.$filename;
             		$medium_image_path = 'images/backend_images/products/medium/'.$filename;
             		// $small_image_path = 'images/backend_images/products/small/'.$filename;
             		// resize images
                    Image::make($image_tmp)->resize(1000,1000)->save($large_image_path);
             		Image::make($image_tmp)->resize(300,300)->save($medium_image_path);
             		// Image::make($image_tmp)->resize(100,100)->save($small_image_path);

             		// store image name in products table
             		$product->image = $filename;
             	}
             }
      
    		$product->save();

            
           $productID = $product->id; 
           if ($request->file('images')) {
               // Multi upload image
               $files = $request->file('images');
               foreach ($files as $file) {
                    // Upload Images after resize
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/gallery/large/'.$fileName;
                    // $medium_image_path = 'images/backend_images/products/gallery/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/gallery/small/'.$fileName;
                    // resize images
                    Image::make($file)->resize(1000,1000)->save($large_image_path);
                    // Image::make($file)->resize(300,300)->save($medium_image_path);
                    Image::make($file)->resize(100,100)->save($small_image_path);

                    $pdatas['image']=$fileName;
                    $pdatas['product_id']=$productID;
                    DB::table('products_images')
                      ->insertGetId($pdatas);
               }
           }
        
    		return redirect('/view-products')->with('flash_message_success','E\'lon joylashtirildi!');
            //return redirect('/admin/view-products')->with('flash_message_success','Product has been added successfully!');
    	}

        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);

        //Countries drop down start
        $country =Country::where(['country_id'=>0])->get();
        $country_dropdown = "<option value='' selected disabled>ТАНЛАШ</option>";
        foreach($country as $cat){
            $country_dropdown .= "<option value='".$cat->id."' disabled >".$cat->country_name."</option>";
            $sub_categories = Country::where(['country_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $country_dropdown.= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->country_name."</option>";
            }
        }
        //Countries drop down ends 

        //Categories drop down start
    	$categories =Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option value='' selected disabled>ТАНЛАШ</option>";
    	foreach($categories as $cat){
    		$categories_dropdown .= "<option value='".$cat->id."' disabled >".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach($sub_categories as $sub_cat){
    			$categories_dropdown.= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    	}
        //Categories drop down ends 

    	return view('products.add_product')->with(compact('categories_dropdown','country_dropdown','userDetails'));
    }

    public function editProduct(Request $request, $id=null){

        if ($request->isMethod('post')) {
            $data = $request->all();
            
            if ($request->hasFile('image')) {
            $this->validate($request, [
              'image'  => 'required|image|mimes:jpeg,png,jpg'
             ]);
            }

            if ($request->file('images[]')) {
                $this->validate($request, [
                  'images[]'  => 'required|images|mimes:jpeg,png,jpg'
                 ]);
            }
            
             // Upload Image
             if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    // $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // resize images
                    Image::make($image_tmp)->resize(1000,1000)->save($large_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($medium_image_path);
                    // Image::make($image_tmp)->resize(100,100)->save($small_image_path);

          
                }
             }else{
                $filename = $data['current_image'];
             }

           $productID = $id; 
           if ($request->file('images')) {
               // Multi upload image
               $files = $request->file('images');
               foreach ($files as $file) {
                    // Upload Images after resize
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/gallery/large/'.$fileName;
                    // $medium_image_path = 'images/backend_images/products/gallery/medium/'.$fileName;
                    $small_image_path = 'images/backend_images/products/gallery/small/'.$fileName;
                    // resize images
                    Image::make($file)->resize(1000,1000)->save($large_image_path);
                    // Image::make($file)->resize(300,300)->save($medium_image_path);
                    Image::make($file)->resize(100,100)->save($small_image_path);

                    $pdatas['image']=$fileName;
                    $pdatas['product_id']=$productID;
                    DB::table('products_images')
                      ->insertGetId($pdatas);
               }
           }


            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'country_id'=>$data['country_id'],'product_name'=>$data['product_name'],'description'=>$data['description'],'price'=>$data['price'],'price_type'=>$data['price_type'],'image'=>$filename]);
            return redirect('/view-products')->with('flash_message_success','E\'lon o\'zgartirildi!');
        }

        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);

        //Get Product Details
        $productDetails = Product::where(['id'=>$id])->first();

        $productAltImages = ProductsImage::where(['product_id'=>$id])->get();

        //Country drop down start
        $countries =Country::where(['country_id'=>0])->get();
        $countries_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($countries as $cat){
            if ($cat->id==$productDetails->country_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
            $countries_dropdown .= "<option value='".$cat->id."' ".$selected." disabled >".$cat->country_name."</option>";
            $sub_categories = Country::where(['country_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
            if ($sub_cat->id==$productDetails->country_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
                $countries_dropdown.= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->country_name."</option>";
            }
        }
        //Country drop down ends 

        //Categories drop down start
        $categories =Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach($categories as $cat){
            if ($cat->id==$productDetails->category_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected." disabled >".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
            if ($sub_cat->id==$productDetails->category_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
                $categories_dropdown.= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories drop down ends 

        if ($user_id == $productDetails->user_id) {
            return view('products.edit_product')->with(compact('productDetails','categories_dropdown','countries_dropdown','productAltImages','userDetails'));
        }else{
            return redirect()->back()->with('flash_message_error','Error!');
        }
        
    }

    public function viewProducts(Request $request){
        $user_id = Auth::user()->id;
        $productsAll = Product::orderBy('id','DESC')->where(['user_id' => $user_id])->where('status',1)->paginate(16);

        $productCount = Product::where('user_id',$user_id)->count();

        return view('products.view_products')->with(compact('productsAll','productCount'));
    }

    public function deleteProduct($id=null){

        $user_id = Auth::user()->id;

        //Get Product Details
        $productDetails = Product::where(['id'=>$id])->first();

        if ($user_id == $productDetails->user_id) {
            
        // Get Product Image Name
        $productImage = Product::where(['id'=>$id])->first();
  
        // Get Product Image Paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        // Delete Large image if not exists in Folder
        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        // Delete medium image if not exists in Folder
        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }

        // Delete small image if not exists in Folder
        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        // Get Product Image Name
        $productImages = ProductsImage::where(['product_id'=>$id])->get();

        foreach ($productImages as $productImages) {
                   // Get Product Image Paths
        $large_image_path = 'images/backend_images/products/gallery/large/';
        $medium_image_path = 'images/backend_images/products/gallery/medium/';
        $small_image_path = 'images/backend_images/products/gallery/small/';

        // Delete Large image if not exists in Folder
        if (file_exists($large_image_path.$productImages->image)) {
            unlink($large_image_path.$productImages->image);
        }

        // Delete medium image if not exists in Folder
        if (file_exists($medium_image_path.$productImages->image)) {
            unlink($medium_image_path.$productImages->image);
        }

        // Delete small image if not exists in Folder
        if (file_exists($small_image_path.$productImages->image)) {
            unlink($small_image_path.$productImages->image);
        }
        
        // Delete Image from Products table
        ProductsImage::where(['id'=>$id])->delete();
        }
  


        Product::where(['id'=>$id])->delete();

        return redirect()->back()->with('flash_message_success','E\'lon o\'chirildi!');
        }else{
            return redirect()->back()->with('flash_message_error','Error!');
        }
    }

    public function deleteProductImage($id = null){

        // Get Product Image Name
        $productImage = Product::where(['id'=>$id])->first();
  
        // Get Product Image Paths
        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        // Delete Large image if not exists in Folder
        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        // Delete medium image if not exists in Folder
        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }

        // Delete small image if not exists in Folder
        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }
        
        // Delete Image from Products table
        Product::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_success','Rasm o\'chirildi!');
    }

    public function deleteAltImage($id = null){

        // Get Product Image Name
        $productImage = ProductsImage::where(['id'=>$id])->first();
  
        // Get Product Image Paths
        $large_image_path = 'images/backend_images/products/gallery/large/';
        $medium_image_path = 'images/backend_images/products/gallery/medium/';
        $small_image_path = 'images/backend_images/products/gallery/small/';

        // Delete Large image if not exists in Folder
        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }

        // Delete medium image if not exists in Folder
        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }

        // Delete small image if not exists in Folder
        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }
        
        // Delete Image from Products table
        ProductsImage::where(['id'=>$id])->delete();

        return redirect()->back()->with('flash_message_success','Rasm o\'chirildi!');
    }

    public function products($url = null){

        // Show 404 page if Category URL does not exist
        $countCategory = Category::where(['url'=>$url,'status'=>1])->count();
        if ($countCategory==0) {
             abort(404);
         } 
         

        $categoryDetails = Category::where(['url' => $url])->first();

        if ($categoryDetails->parent_id==0) {
            // If url is main Category url
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
            $productsAll = Product::orderBy('id','DESC')->whereIn('category_id',$cat_ids)->where('status',1)->paginate(28);
            //$productsAll = json_decode(json_encode($productsAll)); 
            // echo "<pre>"; print_r($productsAll); die; 
        }else{
            // If url is sub category url
            $productsAll = Product::orderBy('id','DESC')->where(['category_id' => $categoryDetails->id])->where('status',1)->paginate(28);
        }        

        //$productsAll = Product::where(['category_id' => $categoryDetails->id])->get();
        return view('products.listing')->with(compact('categoryDetails','productsAll'));
    }

    public function searchProducts(Request $request){
        
            $data = $request->all();

            if (!empty($data['product'])) {
                $search_product = $data['product'];
            }else{
                $search_product = '';
            }

            $productsAll = Product::orderBy('id','DESC')->where('product_name','like','%'.$search_product.'%')->orwhere('description',$search_product)->where('status',1)->paginate(28);

            return view('products.listing')->with(compact('productsAll'));
       
    }

    public function product($id = null){

        // Show 404 page if product is disabled
        $productsCount = Product::where(['id'=>$id,'status'=>1])->count();
        if ($productsCount == 0) {
            abort(404);
        }

        // Get Product Details 
        $productDetails = Product::where('id',$id)->first();
        $productDetails = json_decode(json_encode($productDetails));

        $relatedProducts = Product::orderBy('id','DESC')->where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->paginate(8);
       // $relatedProducts = json_decode(json_encode($relatedProducts));


        // Get Product Alternate Images
        $productAltImages = ProductsImage::where('product_id',$id)->get();

        $productCountry = Country::where('id',$productDetails->country_id)->first();

        $productCountrysity = Country::where('id',$productCountry->country_id)->first();


        $userDetails = User::find($productDetails->user_id);

        return view('products.detail')->with(compact('productDetails','productCountrysity','productCountry','userDetails','productAltImages','relatedProducts'));
    }

    public function addtocart(Request $request){

        $data =$request->all();

        if (!empty($data['wishListButton']) && $data['wishListButton']=="Wish List") {
 

        }else{

        if (empty(Auth::user()->email)) {
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        if (!isset($session_id)) {
             $session_id = str_random(40);
             Session::put('session_id',$session_id);
        }

        if (empty(Auth::check())) {
           $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],'session_id'=>$session_id])->count();
           if ($countProducts>0) {
            return redirect()->back()->with('flash_message_error','E\'lon saqlanganlarga qo\'shilgan!');
           }
        }else{
           $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],'user_email'=>Auth::user()->email])->count();
           if ($countProducts>0) {
            return redirect()->back()->with('flash_message_error','E\'lon saqlanganlarga qo\'shilgan!');
           }
        }


        DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'price'=>$data['price'],'price_type'=>$data['price_type'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);

        return redirect()->back()->with('flash_message_success','E\'lon saqlanganlarga qo\'shildi!');
        }

        
    }

    public function cart(){
        if (Auth::check()) {
           $user_email = Auth::user()->email;
           $userCart = DB::table('cart')->orderBy('id','DESC')->where(['user_email'=>$user_email])->paginate(16);
        }else{
           $session_id = Session::get('session_id');
           $userCart = DB::table('cart')->orderBy('id','DESC')->where(['session_id'=>$session_id])->paginate(16);
        }
   
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            if ($productDetails) {
                 $userCart[$key]->image = $productDetails->image;
                 $userCart[$key]->id = $productDetails->id;
            }
        }

        return view('products.cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id = null){
        DB::table('cart')->where('product_id',$id)->delete();
        return redirect('cart')->with('flash_message_success','E\'lon saqlanganlardan o\'chirildi!');
    }
}
