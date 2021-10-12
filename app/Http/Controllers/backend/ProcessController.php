<?php

namespace App\Http\Controllers\backend;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Process;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Process::where('lang','zh')->orderBy('sort')->paginate(10);
            return response()->json($data);
        }

        return view('backend.process');
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
        $input = $request->all();
        $process_img_path='backend/images/process/';
        $real_path = $input['img']->getRealPath();
        $img_name = time().rand(0,100).$input['img']->getClientOriginalName();
        $input['img'] = $process_img_path.$img_name;
        $img = Image::make($real_path)->save($input['img']);

        $process_data = Process::create($input);
        $insert_id = $process_data->id;
        if(is_null($request->process_id)){
            Process::where('id', $insert_id)->update(['process_id' => $insert_id]);
        }else{
            Process::where('process_id', $input['process_id'])->update(['en_check' => 1]);
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
        $data = Process::where('process_id',$id)->get();
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

        if($request->has('img')){
            $process_img_path='backend/images/process/';
            $real_path = $data['img']->getRealPath();
            $img_name = time().rand(0,100).$data['img']->getClientOriginalName();
            $data['img'] = $process_img_path.$img_name;
            $img = Image::make($real_path)->save($data['img']);
        }

        Process::where('process_id',$id)->where('lang',$request->lang)->update($data);
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
        Process::where('process_id',$id)->delete();
        $return = [
            'status' => 'success',
            'message' => '刪除成功！',
        ];
        return response()->json($return);
    }
}
