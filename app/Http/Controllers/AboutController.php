<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App;

class AboutController extends Controller
{
    public function index()
    {
    	$locale = App::getLocale();
    	$data = new About;
    	$about = [];
    	$about = [
    		'index_img1' => $data->where('name','index_img1')->first(),
    		'index_img2' => $data->where('name','index_img2')->first(),
    	];
    	if($locale == 'zh'){
    		$about['introduction'] = $data->where('name','introduction')->first();
    	}else{
    		$about['introduction'] = $data->where('name','en_introduction')->first();
    	}
        return view('front.about',compact('about'));
    }
}
