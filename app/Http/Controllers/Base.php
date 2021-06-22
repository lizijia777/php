<?php
namespace App\Http\Controllers;

class Base
{
    public function __construct(){
        date_default_timezone_set('Asia/Shanghai');
    }

    public function returnData($code=200,$msg='',$data=[])
    {
        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }
}
