<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductionEquipmentDetail;

class ProductionEquipmentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = ProductionEquipmentDetail::where('lang','zh')->orderBy('sort')->paginate(10);
            return response()->json($data);
        }

        return view('backend.production_equipment_detail');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ProductionEquipmentDetail::create($request->all());
        $insert_id = $data->id;
        if(is_null($request->pid)){
            ProductionEquipmentDetail::where('id', $insert_id)->update(['pid' => $insert_id]);
        }else{
            ProductionEquipmentDetail::where('pid', $request->pid)->update(['en_check' => 1]);
        }

        $return = [
            'status' => 'success',
            'message' => '新增成功！',
        ];
        return response()->json($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ProductionEquipmentDetail::where('pid',$id)->get();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_method','_token']);
        ProductionEquipmentDetail::where('pid',$id)->where('lang',$request->lang)->update($data);
        $return = [
            'status' => 'success',
            'message' => '修改成功！',
        ];
        return response()->json($return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductionEquipmentDetail::where('pid',$id)->delete();
        $return = [
            'status' => 'success',
            'message' => '刪除成功！',
        ];
        return response()->json($return);
    }
}
