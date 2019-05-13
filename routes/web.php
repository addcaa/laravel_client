<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('login/add',"Login\LoginController@add");
Route::get('login/caa',"Login\LoginController@caa");

//对称加密
Route::get('text/openssl',"Text\TextController@openssl");
//非对称加密
Route::get('text/pointsopenssl',"Text\TextController@pointsopenssl");
//非对称加密做签名
Route::get('text/signature',"Text\TextController@signature");

//注册
Route::get('reg/regshow',"Reg\RegController@regshow");
Route::post('reg/regadd',"Reg\RegController@regadd");

//登陆
Route::get('login/logshow',"Reg\RegController@logshow");
Route::post('login/log',"Reg\RegController@log");



