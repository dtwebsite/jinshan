<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductionEquipmentDetail;
use App\ProductionEquipment;
use App\TestingEquipmentDetail;
use App\TestingEquipment;
use App\Certification;
use App\HistoryImg;
use App\Products;
use App\History;
use App\Client;
use App\About;
use App;

class AboutDetailController extends Controller
{
    public function index()
    {
    	$locale = App::getLocale();
    	$about = new About;
    	$about_detail = [];
    	$about_detail['inner_img'] = $about->where('name','inner_img')->first();
    	$about_detail['certification'] = array_chunk(Certification::orderBy('sort')->get()->toArray(),2);
    	$about_detail['production_equipment'] = ProductionEquipment::orderBy('sort')->get();
    	$about_detail['testing_equipment'] = TestingEquipment::orderBy('sort')->get();
    	$about_detail['client'] = array_chunk(Client::orderBy('sort')->get()->toArray(),6);
    	$about_detail['history_img'] = HistoryImg::orderBy('sort')->get();
        $about_detail['history'] = array_chunk(History::where('lang',$locale)->orderBy('sort')->get()->toArray(),3);
        $about_detail['production_equipment_detail'] = array_chunk(ProductionEquipmentDetail::where('lang',$locale)->orderBy('sort')->get()->toArray(),10);
        $about_detail['testing_equipment_detail'] = array_chunk(TestingEquipmentDetail::where('lang',$locale)->orderBy('sort')->get()->toArray(),10);
    	if($locale == 'zh'){
    		$about_detail['full_introduction'] = $about->where('name','full_introduction')->first();
    		$about_detail['quality'] = $about->where('name','quality')->first();
    		$about_detail['service'] = $about->where('name','service')->first();
    		$about_detail['innovation'] = $about->where('name','innovation')->first();
    	}else{
    		$about_detail['full_introduction'] = $about->where('name','en_full_introduction')->first();
    		$about_detail['quality'] = $about->where('name','en_quality')->first();
    		$about_detail['service'] = $about->where('name','en_service')->first();
    		$about_detail['innovation'] = $about->where('name','en_innovation')->first();
    	}
        $first_product = Products::where('lang',$locale)->where('status',1)->orderBy('sort','desc')->first();
        return view('front.aboutDetail',compact('about_detail','first_product'));
    }
}
