<?php

namespace App\Http\Controllers\backend;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gallery_img;
use App\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Gallery::where('lang','zh')->orderByDesc('sort')->paginate(10);
            return response()->json($data);
        }

        return view('backend.gallery');
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
        $gallery_img_path='backend/images/gallery/';
        $detail_img = $input['detail_img'];
        unset($input['detail_img']);

        $gallery_data = Gallery::create($input);
        $insert_id = $gallery_data->id;
        if(is_null($request->gallery_id)){
            Gallery::where('id', $insert_id)->update(['gallery_id' => $insert_id]);
        }else{
            Gallery::where('gallery_id', $input['gallery_id'])->update(['en_check' => 1]);
        }

        foreach ($detail_img as $key => $value) {
            $extension = '.'.$value->getClientOriginalExtension();
            $ver = time().rand(0,100);
            $file_name = $ver.$extension;
            $file_path = $gallery_img_path.$file_name;
            $img = Image::make($value->getRealPath())->save($file_path);
            $img_data = [
                'gallery_id' => $insert_id,
                'img' => $file_path,
            ];
            $gallery_data->detail_img()->create($img_data);
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
        $data = Gallery::with('detail_img')->where('gallery_id',$id)->get();
        return view('backend.layouts.gallery_edit_page',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Gallery::with(['detail_img' => function ($query) {
            $query->orderBy('img_sort', 'desc');
        }])->where('gallery_id',$id)->get();
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

        $img_path='backend/images/gallery/';

        if($request->has('detail_img')){
            foreach ($data['detail_img'] as $key => $value) {
                $extension = '.'.$value->getClientOriginalExtension();
                $ver = time().rand(0,100);
                $file_name = $ver.$extension;
                $file_path = $img_path.$file_name;
                $img = Image::make($value->getRealPath())->save($file_path);
                $img_data = [
                    'gallery_id' => $id,
                    'img' => $file_path,
                ];
                Gallery_img::create($img_data);
            }
            unset($data['detail_img']);
        }
        unset($data['img_sort']);

        Gallery::where('id',$id)->where('lang',$request->lang)->update($data);

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
        Gallery::where('gallery_id',$id)->delete();
        $return = [
            'status' => 'success',
            'message' => '刪除成功！',
        ];
        return response()->json($return);
    }

    public function img_sort(Request $request){
        $data = [
            'img_sort' => $request->img_sort,
        ];
        Gallery_img::where('id',$request->id)->update($data);
        $return = [
            'status' => 'success',
            'message' => '編輯成功！',
        ];
        return response()->json($return);
    }

    public function img_delete(Request $request){
        Gallery_img::where('id',$request->id)->delete();
        $return = [
            'status' => 'success',
            'message' => '刪除成功！',
        ];
        return response()->json($return);
    }
}
