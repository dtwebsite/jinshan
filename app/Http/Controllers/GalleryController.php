<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Gallery;
use App;

class GalleryController extends Controller
{
    public function index()
    {
        $locale = App::getLocale();
        $gallery = Gallery::with(['detail_img' => function ($query) {
            $query->orderBy('img_sort', 'desc');
        }])->where('lang',$locale)->where('status',1)->orderBy('sort','desc')->paginate(6);
        return view('front.gallery',compact('gallery'));
    }
}
