<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
    public function index(){

        $subCategories = Category::where(['parent_id'=>12])->get();
            foreach($subCategories as $subcat){
                $mollar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $mollar = Product::orderBy('id','DESC')->whereIn('category_id',$mollar_ids)->where('status',1)->paginate(8);

        $subCategories = Category::where(['parent_id'=>18])->get();
            foreach($subCategories as $subcat){
                $qoylar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $qoylar = Product::orderBy('id','DESC')->whereIn('category_id',$qoylar_ids)->where('status',1)->paginate(8);

        $subCategories = Category::where(['parent_id'=>22])->get();
            foreach($subCategories as $subcat){
                $echkilar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $echkilar = Product::orderBy('id','DESC')->whereIn('category_id',$echkilar_ids)->where('status',1)->paginate(8);

        $subCategories = Category::where(['parent_id'=>25])->get();
            foreach($subCategories as $subcat){
                $tovuqlar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $tovuqlar = Product::orderBy('id','DESC')->whereIn('category_id',$tovuqlar_ids)->where('status',1)->paginate(8);

        $subCategories = Category::where(['parent_id'=>29])->get();
            foreach($subCategories as $subcat){
                $boshqahayvonlar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $boshqahayvonlar = Product::orderBy('id','DESC')->whereIn('category_id',$boshqahayvonlar_ids)->where('status',1)->paginate(8);

        $subCategories = Category::where(['parent_id'=>31])->get();
            foreach($subCategories as $subcat){
                $yemishlar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $yemishlar = Product::orderBy('id','DESC')->whereIn('category_id',$yemishlar_ids)->where('status',1)->paginate(8);

        $subCategories = Category::where(['parent_id'=>35])->get();
            foreach($subCategories as $subcat){
                $yemlar_ids[] = $subcat->id;
            }
            // print_r($cat_ids); die; 
        $yemlar = Product::orderBy('id','DESC')->whereIn('category_id',$yemlar_ids)->where('status',1)->paginate(8);

        // Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        // $categories_menu = "";
        // foreach($categories as $cat){
        // 	$categories_menu .= "<div class='panel-heading'>
								// 	<h4 class='panel-title'>
								// 		<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
								// 			<span class='badge pull-right'><i class='fa fa-plus'></i></span>
								// 			".$cat->name."
								// 		</a>
								// 	</h4>
								// </div>
        //                         <div id='".$cat->id."' class='panel-collapse collapse'>
								// 	<div class='panel-body'>
								// 		<ul>";
								// 				$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
								// 	        	foreach($sub_categories as $subcat){
								// 	        		$categories_menu .= "<li><a href='".$subcat->url."'>".$subcat->name." </a></li>";
								// 	        	}
								// 		$categories_menu .= "</ul>
								// 	</div>
								// </div>
								// ";
        // }


    	return view('index')->with(compact('mollar','qoylar','echkilar','tovuqlar','boshqahayvonlar','yemishlar','yemlar','categories'));
    }
}
