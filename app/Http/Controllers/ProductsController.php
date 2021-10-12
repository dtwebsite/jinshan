<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App;

class ProductsController extends Controller
{
    public function index()
    {
    	$locale = App::getLocale();
    	$products = array_chunk(Products::where('lang',$locale)->where('status',1)->orderBy('sort','desc')->get()->toArray(),2);
        return view('front.products',compact('products'));
    }
}
