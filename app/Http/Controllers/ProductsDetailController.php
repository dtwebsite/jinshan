<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Products;
use App;

class ProductsDetailController extends Controller
{
    public function index($id)
    {
    	$locale = App::getLocale();
    	$data = Products::with(['detail_img' => function ($query) {
            $query->orderBy('img_sort', 'desc');
        }])->where('product_id',$id)->where('status',1)->where('lang',$locale)->first()->toArray();
    	$last_img = array_pop($data['detail_img']);
    	$products = Products::where('lang',$locale)->where('status',1)->orderBy('sort','desc')->get()->toArray();
    	$ids = array_column($products, 'product_id');
    	if(isset($products[array_keys($ids,$id)[0]+1])){
            $next_data['product_id'] = $products[array_keys($ids,$id)[0]+1]['product_id'];
            $next_data['name'] = $products[array_keys($ids,$id)[0]+1]['name'];
        }
    	$end_id = end($products)['product_id'];
        return view('front.productsDetail',compact('data','last_img','products','next_data','end_id'));
    }
}
