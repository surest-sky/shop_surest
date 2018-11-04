<?php

/**
 * 登录
 * 注册
 * 找回密码
 * 修改密码
 * ---
 * 相关路由
 * 登录状态下跳转到首页
 */
Route::get('/','Index\IndexController@index')->name('index');

Route::middleware(['guest'])->group(function (){
    Route::name('login.')->group(function (){

        Route::get('/login','Auth\LoginController@login')->name('normal');
        Route::get('/weibo/login','Auth\LoginWeiboController@login')->name('weibo');
        Route::get('/weibo/user','Auth\LoginWeiboController@user')->name('weibo.user');

    });
});
//
///**
// * 注册注销相关
// */
Route::get('/register','Auth\RegisterController@register')->name('register');
Route::get('/register/store','Auth\RegisterController@store')->name('register.store');
Route::post('/register/account','Auth\RegisterController@account')->name('register.account');
Route::post('/logout','Auth\LoginController@logout')->name('logout');








 /**
  * 杂项
  * 关于公司情况的一些模块
  */
 Route::get('/trems_conditions','About\AboutController@trems_conditions');