<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Certification;
use App\Client;
use App\Contact;
use App\History;
use App\HistoryImg;
use App\Process;
use App\ProductionEquipment;
use App\ProductionEquipmentDetail;
use App\Products;
use App\TestingEquipment;
use App\TestingEquipmentDetail;

class DashboardController extends Controller
{
    public function index()
    {
    	$certification = Certification::count();
    	$client = Client::count();
    	$contact = Contact::count();
    	$history = History::count();
    	$history_img = HistoryImg::count();
    	$process = Process::count();
    	$production_equipment = ProductionEquipment::count();
    	$production_equipment_detail = ProductionEquipmentDetail::count();
    	$products = Products::count();
    	$testing_equipment = TestingEquipment::count();
    	$testing_equipment_detail = TestingEquipmentDetail::count();
        return view('backend.dashboard',compact('certification','client','contact','history','history_img','process','production_equipment','production_equipment_detail','products','testing_equipment','testing_equipment_detail'));
    }
}
