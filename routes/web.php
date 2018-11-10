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
Route::get('/','IndexController@index')->name('index');

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


/**
 * 杂项
 * 关于公司情况的一些模块
 */
Route::get('/trems_conditions','About\AboutController@trems_conditions');

# 分类模块
Route::get('/category','CategoryController@index')->name('category');
Route::get('/category/{id}','CategoryController@show')->name('category.show');

# 商品模块
Route::get('/product/{id}','ProductController@show')->name('product.show');



Route::namespace('Admin')->group(function () {
    Route::name('admin.')->prefix('admin')->group(function (){

        // 必须登录状态下才能进入
        Route::group(['middleware' => 'auth.admin'], function () {

                // 权限控制路由
                Route::group(['middleware'=>'admin.permission'],function (){
                    Route::get('/', 'IndexController@index')->name('index');
                    Route::get('/welcome', 'IndexController@welcome')->name('welcome');;

                    /**
                     * 角色相关
                     */
                    Route::get('/admins/role/store/{id?}', 'AdminController@roleEditOrAdd')->name('admins.role.edit_or_add');
                    Route::get('/admins/role', 'AdminController@role')->name('admins.role');
                    Route::post('/admins/role/store', 'AdminController@roleStore')->name('admins.role.store');
                    Route::delete('/admins/role','AdminController@roleDelete')->name('admins.role.delete');

                    /**
                     * 权限相关
                     */
                    Route::get('/admins/permission', 'AdminController@permission')->name('admins.permission');
                    Route::get('/admins/permission/store/{id?}', 'AdminController@permissionEditOrAdd')->name('admins.permission.edit_or_add');
                    Route::post('/admins/permission/store', 'AdminController@permissionStore')->name('admins.permission.store');
                    Route::get('/admins/permission', 'AdminController@permission')->name('admins.permission');
                    Route::delete('/admins/permission','AdminController@permissionDelete')->name('admins.permission.delete');


                    /**
                     * 管理员管理
                     */
                    Route::get('/admins', 'AdminController@admins')->name('admins.admins');
                    Route::get('/admins/store/{id?}', 'AdminController@adminsEditOrAdd')->name('admins.edit_or_add');
                    Route::post('/admins/store', 'AdminController@adminsStore')->name('admins.store');
                    Route::get('/admins', 'AdminController@admins')->name('admins');
                    Route::delete('/admins','AdminController@adminsDelete')->name('admins.delete');
                    Route::put('/admins/active','AdminController@adminsActived')->name('admins.active');

                    /**
                     * 用户管理
                     */
                    Route::get('/users', 'UserController@list')->name('admins.users');
                    Route::get('/users/store/{id?}', 'UserController@addOrEdit')->name('user.add_or_edit');
                    Route::put('/users/store/{id}', 'UserController@update')->name('user.update');
                    Route::post('/users/store', 'UserController@create')->name('user.create');
                    Route::delete('/users','UserController@delete')->name('user.delete');

                    /**
                     * 分类管理
                     */
                    Route::get('/category', 'CategoryController@list')->name('category');
                    Route::get('/category/store/{id?}', 'CategoryController@addOrEdit')->name('category.add_or_edit');
                    Route::put('/category/store', 'CategoryController@update')->name('category.update');
                    Route::post('/category/store', 'CategoryController@create')->name('category.create');
                    Route::delete('/category','CategoryController@delete')->name('category.delete');

                    /**
                     * 商品管理
                     */
                    Route::get('/product', 'ProductController@list')->name('product');
                    Route::get('/product/store/{id?}', 'ProductController@addOrEdit')->name('product.add_or_edit');
                    Route::put('/product/store', 'ProductController@update')->name('product.update');
                    Route::post('/product/store', 'ProductController@create')->name('product.create');
                    Route::delete('/product','ProductController@delete')->name('product.delete');
                    Route::post('/upload/product','ProductController@upload')->name('product.upload');

                });
        });

        Route::get('/login','LoginController@login')->name('login');
        Route::post('/login','LoginController@store')->name('store');
        Route::post('/logout','LoginController@logout')->name('logout');

    });
});











