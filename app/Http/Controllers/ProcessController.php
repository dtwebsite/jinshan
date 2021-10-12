<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Process;
use App;

class ProcessController extends Controller
{
    public function index()
    {
    	$locale = App::getLocale();
    	$process = array_chunk(Process::where('lang',$locale)->where('status',1)->orderBy('sort')->get()->toArray(),3,true);
        return view('front.process',compact('process'));
    }
}
