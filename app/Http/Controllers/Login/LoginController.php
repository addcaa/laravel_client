<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    private $app=3;
    private $str="abc";

    // ascii算法 函数：ord（）；chr（）
    //恺撒 加密
    public function add(){
        $n= $this->app;
        $str=$this->str;
        $strlen=strlen($str);
        $dncode="";
        for($i=0;$i<$strlen;$i++){
            //加密
            $encode=ord($str[$i]) + $n;
            $dncode .=chr($encode);
            //解密
        }
        return $dncode;
    }
    //恺撒 解密
    public function dncode(){
        $str=$this->add();
        $n= $this->app;
        $strlen=strlen($str);
        $res="";
        for($i=0;$i<$strlen;$i++){
            $ascii =ord($str[$i]);
            $res .=chr($ascii-$n);
        }
        return $res;
    }


    //OpenSSL 加密
    public function openssl(){
        $data="cuifang";//原文
        $method="AES-256-CBC";//加密方式
        $key="ccc";//秘钥
        $options=OPENSSL_RAW_DATA;
        $iv='1234567812345678';
        $set=openssl_encrypt($data,$method,$key,$options,$iv);
        $ba6=base64_encode($set);
        $url=urlencode($ba6);
        return $url;
    }
    //OpenSSL 解密
    public function ssl_dncode(){
        // $data=request()->input('ser');
        $data=$_GET['ser'];
        // $sopenssl=$this->openssl();
        $method="AES-256-CBC";//加密方式
        $key="ccc";//秘钥
        $options=OPENSSL_RAW_DATA;
        $iv='1234567812345678';
        $dn=base64_decode($data);

        $set=openssl_decrypt($dn,$method,$key,$options,$iv);
        return $set;
    }

    public function caa(){
        $openssl=$this->openssl();
        echo "加密：".$openssl;echo "<hr>";
        $ssl_dncode=$this->ssl_dncode();
        echo "解密：".$ssl_dncode;die;
        // dd();
        $arr=$this->add();
        $res=$this->dncode();
        echo '加密：'.$arr;
        echo '解密：'.$res;

    }
}
