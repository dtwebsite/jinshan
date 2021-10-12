<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function change_password(Request $request)
    {
    	$data = User::where('id',$request->id)->first();
    	if(!Hash::check($request->old_password,$data->password)){
    		$status = 'error';
    		$message = '舊密碼錯誤！';
    	}
    	if($request->password != $request->password_confirm){
    		$status = 'error';
    		$message = '新密碼確認錯誤！';
    	}
    	if(Hash::check($request->old_password,$data->password) && $request->password == $request->password_confirm){
    		User::where('id',$request->id)->update(['password' => bcrypt($request->password)]);
    		$status = 'success';
    		$message = '修改成功！';
    	}
    	$return = [
            'status' => $status,
            'message' => $message,
        ];
        return response()->json($return);
    }
}
