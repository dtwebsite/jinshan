<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App;

class ContactController extends Controller
{
    public function index()
    {
    	$locale = App::getLocale();
    	if($locale == 'zh'){
    		$address = Setting::where('name','address')->first();
    	}else{
    		$address = Setting::where('name','en_address')->first();
    	}
    	$phone = Setting::where('name','phone')->first();
    	$fax = Setting::where('name','fax')->first();
    	$email = Setting::where('name','email')->first();
        return view('front.contact',compact('address','phone','fax','email'));
    }
}
