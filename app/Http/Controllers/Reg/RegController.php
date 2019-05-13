<?php

namespace App\Http\Controllers\Reg;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegController extends Controller
{
    //注册
    public function regshow(){
        return view("reg/regshow");
    }
    public function regadd(){
        $json_ser=json_encode($_POST);
        // dd($json_ser);
        //获取秘钥
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        //加密
        openssl_private_encrypt($json_ser,$enc_data,$k);
        $res=base64_encode($enc_data);
        $url="http://api.cui.com/reg";
        echo curl($url,$res);
    }
    //登录
    public function logshow(){
        return view("login/logshow");
    }
    public function log(){
        $json_ser=json_encode($_POST);
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        //加密
        openssl_private_encrypt($json_ser,$enc_data,$k);
        $res=base64_encode($enc_data);
        $url="http://api.cui.com/log";
        echo curl($url,$res);

    }
}
