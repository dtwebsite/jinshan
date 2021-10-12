<?php

namespace App\Http\Controllers\backend;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = About::all();
            return response()->json($data);
        }

        return view('backend.about');
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
        //
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
        //
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

        if($request->has('index_img1')){
            $input['index_img1'] = $this->save_img($input['index_img1']);
        }
        if($request->has('index_img2')){
            $input['index_img2'] = $this->save_img($input['index_img2']);
        }
        if($request->has('inner_img')){
            $input['inner_img'] = $this->save_img($input['inner_img']);
        }

        foreach ($input as $key => $value) {
            About::where('name',$key)->update(['value' => $value]);
        }
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
        //
    }

    public function save_img($data)
    {
        $img_path='backend/images/about/';
        $real_path = $data->getRealPath();
        $img_name = time().rand(0,100).$data->getClientOriginalName();
        $data = $img_path.$img_name;
        $img = Image::make($real_path)->save($data);
        return '/'.$data;
    }
}
