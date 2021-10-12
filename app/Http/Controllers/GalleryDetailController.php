<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Gallery;
use App;

class GalleryDetailController extends Controller
{
    public function index($id)
    {
    	$locale = App::getLocale();
    	$data = Gallery::with(['detail_img' => function ($query) {
            $query->orderBy('img_sort', 'desc');
        }])->where('gallery_id',$id)->where('status',1)->where('lang',$locale)->first();
    	$all_data = Gallery::where('lang',$locale)->where('status',1)->orderBy('sort','desc')->get()->toArray();
    	$ids = array_column($all_data, 'gallery_id');

        if(isset($all_data[array_keys($ids,$id)[0]+1])){
            $next_data['gallery_id'] = $all_data[array_keys($ids,$id)[0]+1]['gallery_id'];
            $next_data['title'] = $all_data[array_keys($ids,$id)[0]+1]['title'];
        }
        if(isset($all_data[array_keys($ids,$id)[0]-1])){
            $prev_data['gallery_id'] = $all_data[array_keys($ids,$id)[0]-1]['gallery_id'];
            $prev_data['title'] = $all_data[array_keys($ids,$id)[0]-1]['title'];
        }
    	
        $start_id = reset($all_data)['gallery_id'];
    	$end_id = end($all_data)['gallery_id'];
        $page = Gallery::select('id')->orderBy('sort','desc')->get()->search(function ($item, $key) use ($id){
            return $item->id == $id;
        }) + 1;
        $page = ceil($page / 6);
        return view('front.galleryDetail',compact('data','next_data','prev_data','start_id','end_id','page'));
    }
}
