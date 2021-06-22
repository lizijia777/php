<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Login extends Base
{
    public function login(Request $request)
    {
        $params = $request->only(['username','password']);
        if(empty($params['username']) || empty($params['password'])){
            return $this->returnData(210,'需要用户名和密码.');
        }
        $user = DB::table('ac_user')
            ->whereRaw("(username = '".$params['username']."' or email = '".$params['username']."')")
            ->where('password',md5($params['password']))->first();
        if(empty($user)){
            return $this->returnData(210,'用户名或密码不正确.');
        }else{
            Session::put('userInfo',get_object_vars($user));
            return $this->returnData(200,'登录成功.');
        }
    }

    public function register(Request $request)
    {
        $params = $request->only(['username','email','password']);
        if(empty($params['username']) || empty($params['email'] || empty($params['password']))){
            return $this->returnData(210,'缺少参数.');
        }
        if(DB::table('ac_user')->where('username',$params['username'])->value('id')){
            return $this->returnData(210,'用户名已经存在.');
        }
        if(DB::table('ac_user')->where('email',$params['email'])->value('id')){
            return $this->returnData(210,'电子邮件已经存在.');
        }
        DB::table('ac_user')->insert([
            'username'  =>  $params['username'],
            'password'  =>  md5($params['password']),
            'email'     =>  $params['email'],
            'add_time'  =>  date('Y-m-d H:i:s',time())
        ]);
        return $this->returnData(200,'注册成功.');
    }

    public function siginPage()
    {
        return view('/sigindo');
    }

    public function checkCode(Request $request)
    {
        $params = $request->only(['check_code','password']);
        if(empty($params['check_code']) || empty($params['password'])){
            return $this->returnData(210,'请输入邀请码和密码.');
        }
        $user_id = DB::table('ac_reservation')->where(['check_code'=>$params['check_code']])->value('user_id');
        if(empty($user_id)){
            return $this->returnData(210,'邀请码错误.');
        }
        $is_sign = DB::table('ac_reservation')->where(['check_code'=>$params['check_code'],'status'=>2])->value('user_id');
        if($is_sign){
            return $this->returnData(210,'邀请码已经签到.');
        }
        $user = DB::table('ac_user')->where(['id'=>$user_id,'password'=>md5($params['password'])])->value('username');
        if(empty($user)){
            return $this->returnData(210,'邀请码与密码不匹配.');
        }
        DB::table('ac_reservation')
            ->where('check_code',$params['check_code'])
            ->update(['sign_over_time'=>date('Y-m-d H:i:s',time()),'status'=>2]);
        return $this->returnData(200,'Sign in successfully.',['name'=>$user]);
    }
}

