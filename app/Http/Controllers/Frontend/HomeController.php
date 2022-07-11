<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categorys = ProductCategory::whereStatus(1)->whereNull('parent_id')->get();
        return view('frontend.home', compact('categorys'));
    }
    public function shop(){
          return view('frontend.shop');
    }
    public function product_details($slug){
        $product = Product::whereSlug($slug)->first();
        return view('frontend.product_details',compact('product'));
    }
    public function category($slug)
    {
        dd($slug);
        $category = ProductCategory::whereSlug($slug)->first();
        $products = $category->products()->Active()->HasQuantity()->ActiveCategory()->paginate(12);
        // return view('frontend.product_details', compact('category','products'));
    }

}
