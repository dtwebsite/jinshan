<?php

namespace App\Http\Controllers\backend;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Client::orderBy('sort')->paginate(10);
            return response()->json($data);
        }

        return view('backend.client');
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
        $img_path='backend/images/client/';
        $real_path = $input['img']->getRealPath();
        $img_name = time().rand(0,100).$input['img']->getClientOriginalName();
        $input['img'] = $img_path.$img_name;
        $img = Image::make($real_path)->save($input['img']);

        Client::create($input);

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
        $data = Client::findOrFail($id);
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
        $input = $request->except(['_method','_token']);

        if($request->has('img')){
            $img_path='backend/images/client/';
            $real_path = $input['img']->getRealPath();
            $img_name = time().rand(0,100).$input['img']->getClientOriginalName();
            $input['img'] = $img_path.$img_name;
            $img = Image::make($real_path)->save($input['img']);
        }

        Client::find($id)->fill($input)->save();
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
        Client::where('id',$id)->delete();
        $return = [
            'status' => 'success',
            'message' => '刪除成功！',
        ];
        return response()->json($return);
    }
}
