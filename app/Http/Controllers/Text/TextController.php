<?php

namespace App\Http\Controllers\Text;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class TextController extends Controller
{
    //对称加密
    public function openssl(){
        $data=[
            'name'=>"zhangsan",
            'email'=>"123@qq.com",
            'card'=>"123456789123456"
        ];

        $arr=json_encode($data); //待加密的明文信息数据。
        $method="AES-256-CBC";//加密算法
        $key="cuifang"; //密钥。
        $iv="erertfvnhujikwse"; //非空的初始化向量。
        //openssl_encrypt — 加密数据
        $openssl_ser=openssl_encrypt($arr,$method,$key,OPENSSL_RAW_DATA,$iv);



        $res=base64_encode($openssl_ser);

        //加密传输给 url
        $url="http://api.cui.com/add";
        //初始化curl curl是封装的方法
        echo curl($url,$res);
    }

    //非对称加密
    public function pointsopenssl(){
        $data=[
            'name'=>"hahah",
            'tel'=>"1234567891",
            'meali'=>"345342@qq.com"
        ];
        $json_set=json_encode($data);
        //获取秘钥
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        //加密
        openssl_private_encrypt($json_set,$enc_data,$k);
        $res=base64_encode($enc_data);


        $url="http://api.cui.com/adj";
        echo curl($url,$res);
    }

    /**
     *
     * 非对称加密做签名 signature
     */
    public function signature(){
        $data=[
            'a'=>'hha',
            'b'=>'b',
            'c'=>'c'
        ];
        $json_set=json_encode($data);
        //获取秘钥
        $k=openssl_pkey_get_private('file://'.storage_path('app/key/private.pem'));
        //加密
        openssl_sign($json_set,$signature,$k);
        $res=base64_encode($signature);
        urlencode($res);
        $url="http://api.cui.com/signature?res=$res";
        echo curl($url,$json_set);

    }
}
