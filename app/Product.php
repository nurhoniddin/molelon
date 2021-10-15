<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use DB;

class Product extends Model
{
    public function attributes(){
    	return $this->hasMany('App\ProductsAttribute','product_id');
    }

    public static function cartCount(){
    	if (Auth::check()) {
    		// User is logged in; We will use Auth
    		$user_email = Auth::user()->email;
    		$cartCount = DB::table('cart')->where('user_email',$user_email);
    	}else{
    		// User is not logged in. We will use Session 
    		$session_id = Session::get('session_id');
    		$cartCount = DB::table('cart')->where('session_id',$session_id);
    	}
    	return $cartCount;
    }

    public static function productCount($cat_id){
    	$cartCount = Product::where(['category_id'=>$cat_id,'status'=>1])->count();
    	return $cartCount;
    }

    public static function getProductStock($product_id,$product_size){
        $getProductStock = ProductsAttribute::select('stock')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
        return $getProductStock->stock;
    }

    public static function getProductPrice($product_id,$product_size){
        $getProductPrice = ProductsAttribute::select('price')->where(['product_id'=>$product_id,'size'=>$product_size])->first();
        return $getProductPrice->price;
    }

    public static function deleteCartProduct($product_id,$user_email){
        DB::table('cart')->where(['product_id'=>$product_id,'user_email'=>$user_email])->delete();
    }

    public static function getProductStatus($product_id){
        $getProductStatus = Product::select('status')->where('id',$product_id)->first();
        return $getProductStatus->status;
    }

    public static function getCategoryStatus($category_id){
        $getCategoryStatus = Category::select('status')->where('id',$category_id)->first();
        return $getCategoryStatus->status;
    }

    public static function getAttributeCount($product_id,$product_size){
        $getAttributeCount = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$product_size])->count();
        return $getAttributeCount;
    }

    public static function getGrandTotal(){
        $getGrandTotal = "";
        $user_name = Auth::user()->email;
        $userCart = DB::table('cart')->where('user_email',$user_name)->get();
        $userCart = json_decode(json_encode($userCart),true);
        foreach ($userCart as $product) {
            $productPrice = ProductsAttribute::where(['product_id'=>$product['product_id'],'size'=>$product['size']])->first();
            $priceArray[] = $productPrice->price;
        }
        $grandTotal = array_sum($priceArray) - Session::get('CouponAmount') + Session::get('ShippingCharges');
        return $grandTotal;
    }
}
