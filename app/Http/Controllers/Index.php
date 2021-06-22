<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\Psr7\str;

class Index extends Base
{
    public function index(Request $request)
    {
        if(!empty(Session::get('userInfo'))){
            return view('homepage',['data'=>$this->getData()]);
        }
        return view('index');
    }

    public function HomePage(Request $request)
    {
        $check_data = $this->checkLogin($request->ajax());
        if($check_data !== true){
            return $check_data;
        }
        return view('homepage',['data'=>$this->getData()]);
    }

    public function quxiao(Request $request)
    {
        $params = $request->only(['id']);
        DB::table('ac_reservation')->where('id',$params['id'])->delete();
        return $this->returnData(200,'取消成功.');
    }

    public function loginout()
    {
        Session::put('userInfo',null);
        return view('index');
    }

    public function select(Request $request)
    {
        $check_data = $this->checkLogin($request->ajax());
        if($check_data !== true){
            return $check_data;
        }
        $start_time_ = DB::table('ac_activity_time')->where('id',1)->value('start_time');
        if(time()>strtotime($start_time_)){
            $start_time = date('Y-m-d',time());
        }else{
            $start_time = $start_time_;
        }
        $end_time = DB::table('ac_activity_time')->where('id',1)->value('end_time');
        return view('selectdate',[
            'check_start_time'=>date('Y-m-d',strtotime($start_time)),
            'check_end_time'=>date('Y-m-d',strtotime($end_time)),
            'start_time'=>date('Y-m-d',strtotime($start_time_)),
            'end_time'=>date('Y-m-d',strtotime($end_time))
        ]);
    }

    public function reserve(Request $request)
    {
        $check_data = $this->checkLogin($request->ajax());
        if($check_data !== true){
            return $check_data;
        }
        $this->checkLogin($request->ajax());
        $params = $request->only(['date']);
        if(empty($params['date'])){
            return $this->returnData(210,'请选择预定的时间.');
        }
        $start_time = DB::table('ac_activity_time')->where('id',1)->value('start_time');
        $end_time = DB::table('ac_activity_time')->where('id',1)->value('end_time');
        if(strtotime($params['date']) < strtotime($start_time) || strtotime($params['date']) > strtotime($end_time)){
            return $this->returnData(210,'所选时间超出活动范围.');
        }
        $start_time = date('Y-m-d',strtotime($start_time)).' 00:00:00';
        $end_time = date('Y-m-d',strtotime($end_time)).' 23:59:59';
        $user_id = session('userInfo')['id'];
        //There are only three bookings per person at an event
        $count = DB::table('ac_reservation')
            ->whereRaw("sign_time >= '".$start_time."' and sign_time <= '".$end_time."'")
            ->where(['user_id'=>$user_id,'status'=>1])
            ->count();
        if($count >= 3){
            return $this->returnData(210,'一次活动中每人只有三个预订.');
        }
        //You can only book once on the same day
        $one_count = DB::table('ac_reservation')
            ->whereRaw("sign_time >= '".$params['date']." 00:00:00' and sign_time <= '".$params['date']." 23:59:59'")
            ->where(['user_id'=>$user_id,'status'=>1])
            ->count();
        if($one_count>0){
            return $this->returnData(210,'当天只能预订一次');
        }
        //Reservations are limited to ten people a day
        $one_count_ten = DB::table('ac_reservation')
            ->whereRaw("sign_time >= '".$params['date']." 00:00:00' and sign_time <= '".$params['date']." 23:59:59'")
            ->where(['status'=>1])
            ->count();
        if($one_count_ten>=10){
            return $this->returnData(210,'预约一天限十人');
        }
        DB::table('ac_reservation')->insert([
            'user_id'       =>      $user_id,
            'sign_time'     =>      $params['date'],
            'status'        =>      1,
            'check_code'    =>      $this->getRandA(),
            'add_time'      =>      date('Y-m-d H:i:s',time())
        ]);
        return $this->returnData(200,'预订成功.');
    }

    public function checkLogin($is_ajax){
        if($is_ajax){
            if(empty(Session::get('userInfo'))){
                return $this->returnData(300,'请登录.');
            }else{
                return true;
            }
        }else{
            if(empty(Session::get('userInfo'))){
                return view('index');
            }else{
                return true;
            }
        }
    }

    public function getRandA()
    {
        $str = '';
        for($a=1;$a<=6;$a++)
        {
            $str.=chr(rand(97,122));
        }
        if(DB::table('ac_reservation')->where('check_code',$str)->value('id')){
            return $this->getRandA();
        }else{
            return $str;
        }
    }

    public function getData()
    {
        $data = DB::table('ac_reservation')->where('user_id',Session::get('userInfo')['id'])->get();
        $data = $this->objToArr($data);
        foreach($data as $k=>$v)
        {
            $data[$k]['sign_time'] = date('Y-m-d',strtotime($v['sign_time']));
            if($v['status']==1){
                $data[$k]['status'] = '未签到';
                $data[$k]['status_'] = 1;
            }else{
                $data[$k]['sign_over_time'] = date('Y-m-d',strtotime($v['sign_over_time']));
                $data[$k]['status'] = '已签到';
                $data[$k]['status_'] = 2;
            }
        }
        $arr['name'] = Session::get('userInfo')['username'];
        $arr['data'] = $data;
        return $arr;
    }

    public function objToArr($object) {
        return json_decode(json_encode($object), true);
    }
}

