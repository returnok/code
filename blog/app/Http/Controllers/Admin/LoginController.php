<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'org/code/Code.class.php'; //引入验证码类
class LoginController extends Controller
{
    public function Login(){
        if($input = Input::all()){
            $code = new \Code();
            $_code = $code->get();//获取验证码
            if(strtoupper($input['code'])!=$_code){
                return back()->with('msg','验证码错误!');
            }else{
                $user = User::first();//取出数据
                $user_pass = Crypt::decrypt($user['user_pass']);//解密
                if($input['user_name']!=$user['user_name'] || $input['user_pass']!=$user_pass){
                    return back()->with('msg','用户名或者密码错误!');
                }else{
                    session(['user'=>$user]);//验证通过写入session
                    return redirect('admin/index');
                }
            }
        }else{

            return view('admin.login');
        }
    }
    public function quit(){
        session(['user'=>null]);
        return redirect('admin/login');
    }
    public function Code(){
        $code = new \Code();
        return $code->make();
    }
}
