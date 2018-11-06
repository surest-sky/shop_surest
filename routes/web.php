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
        Route::post('/login','Auth\LoginController@store')->name('store');
        Route::get('/weibo/login','Auth\LoginWeiboController@login')->name('weibo');
        Route::get('/weibo/user','Auth\LoginWeiboController@user')->name('weibo.user');

    });

    /**
     * 忘记密码
     */
    Route::get('/forget','Auth\ForgetController@forget')->name('forget');
    // 获取第一步验证码
    Route::post('/forget/account','Auth\ForgetController@account')->name('forget.account');
    // 第二步：进入填写密码
    Route::get('/forget_too/{key?}','Auth\ForgetController@forget_too')->name('forget_too');
    // 处理第二步：
    Route::post('/forget/store_pwd','Auth\ForgetController@store_pwd')->name('forget.store_pwd');
    // 处理第一步验证码字段相关
    Route::post('/forget','Auth\ForgetController@store')->name('forget.store');
});

/**
 * 注册注销相关
 */
// 注册
Route::get('/register','Auth\RegisterController@register')->name('register');
// 注册处理
Route::post('/register','Auth\RegisterController@store')->name('register.store');
// 获取验证码
Route::post('/register/account','Auth\RegisterController@account')->name('register.account');
// 注销
Route::post('/logout','Auth\LoginController@logout')->name('logout');
//
Route::get('/register/verify','Auth\RegisterController@verify')->name('verify');



Route::namespace('Admin')->group(function () {
    Route::name('admin.')->prefix('admin')->group(function (){

        // 必须登录状态下才能进入
        Route::group(['middleware' => 'auth.admin'], function () {

                // 权限控制路由
                Route::group(['middleware'=>'admin.permission'],function (){
                    Route::get('/', 'IndexController@index')->name('index');
                    Route::get('/welcome', 'IndexController@welcome')->name('welcome');;

                    /**
                     * 权限相关
                     */
                    Route::get('/admins/list', 'AdminController@list')->name('admins.list');
                    Route::get('/admins/role', 'AdminController@role')->name('admins.role');
                    Route::get('/admins/role/store/{id?}', 'AdminController@roleEditOrAdd')->name('admins.role.edit_or_add');
                    Route::post('/admins/role/store', 'AdminController@roleStore')->name('admins.role.store');
                    Route::get('/admins/permission', 'AdminController@permission')->name('admins.permission');
                    Route::get('/admins/permission', 'AdminController@permission')->name('admins.permission');
                });
        });

        Route::get('/login','LoginController@login')->name('login');
        Route::post('/login','LoginController@store')->name('store');
        Route::post('/logout','LoginController@logout')->name('logout');

    });
});








 /**
  * 杂项
  * 关于公司情况的一些模块
  */
 Route::get('/trems_conditions','About\AboutController@trems_conditions');