<?php

namespace App\Http\Controllers\backend;

use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products_img;
use App\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $data = Products::where('lang','zh')->orderByDesc('sort')->paginate(10);
            return response()->json($data);
        }

        return view('backend.products');
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
        $product_img_path='backend/images/products/';
        $real_path = $input['img']->getRealPath();
        $img_name = time().rand(0,100).$input['img']->getClientOriginalName();
        $input['img'] = $product_img_path.$img_name;
        $img = Image::make($real_path)->save($input['img']);


        $detail_img = $input['detail_img'];
        unset($input['detail_img']);

        $products_data = Products::create($input);
        $insert_id = $products_data->id;
        if(is_null($request->product_id)){
            Products::where('id', $insert_id)->update(['product_id' => $insert_id]);
        }else{
            Products::where('product_id', $input['product_id'])->update(['en_check' => 1]);
        }

        foreach ($detail_img as $key => $value) {
            $extension = '.'.$value->getClientOriginalExtension();
            $ver = time().rand(0,100);
            $file_name = $ver.$extension;
            $file_path = $product_img_path.$file_name;
            $img = Image::make($value->getRealPath())->save($file_path);
            $img_data = [
                'product_id' => $insert_id,
                'img' => $file_path,
            ];
            $products_data->detail_img()->create($img_data);
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
        $data = Products::with('detail_img')->where('product_id',$id)->get();
        return view('backend.layouts.products_edit_page',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Products::with(['detail_img' => function ($query) {
            $query->orderBy('img_sort', 'desc');
        }])->where('product_id',$id)->get();
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

        $img_path='backend/images/products/';
        if($request->has('img')){
            $real_path = $data['img']->getRealPath();
            $img_name = time().rand(0,100).$data['img']->getClientOriginalName();
            $data['img'] = $img_path.$img_name;
            $img = Image::make($real_path)->save($data['img']);
        }

        if($request->has('detail_img')){
            foreach ($data['detail_img'] as $key => $value) {
                $extension = '.'.$value->getClientOriginalExtension();
                $ver = time().rand(0,100);
                $file_name = $ver.$extension;
                $file_path = $img_path.$file_name;
                $img = Image::make($value->getRealPath())->save($file_path);
                $img_data = [
                    'product_id' => $id,
                    'img' => $file_path,
                ];
                Products_img::create($img_data);
            }
            unset($data['detail_img']);
        }
        unset($data['img_sort']);

        Products::where('id',$id)->where('lang',$request->lang)->update($data);

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
        Products::where('product_id',$id)->delete();
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
        Products_img::where('id',$request->id)->update($data);
        $return = [
            'status' => 'success',
            'message' => '編輯成功！',
        ];
        return response()->json($return);
    }

    public function img_delete(Request $request){
        Products_img::where('id',$request->id)->delete();
        $return = [
            'status' => 'success',
            'message' => '刪除成功！',
        ];
        return response()->json($return);
    }
}
