<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Process;
use App;

class ProcessDetailController extends Controller
{
    public function index()
    {
    	$locale = App::getLocale();
    	$process = Process::where('lang',$locale)->where('status',1)->orderBy('sort')->get();
        return view('front.processDetail',compact('process'));
    }
}
