<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function Index(){
        return view('admin.index');
    }
    public function Info(){
        return view('admin.info');
    }
    public function pass(){
        if($input = Input::all()){
            $rules = [
                'password'=>'required|between:6,20|confirmed' ,
            ];
            $messages = [
                'password.required'=>'新密码不能为空!',
                'password.between'=>'新密码必须在6-20之间!',
                'password.confirmed'=>'新密码跟确认密码不一致!',
            ];
            $validator = Validator::make($input,$rules,$messages);
            if($validator->errors()->messages()){
                return back()->withErrors($validator);
            }else{
                echo 'yes';
            }
        }else {
            return view('admin.pass');
        }
    }

}
