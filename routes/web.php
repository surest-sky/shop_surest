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




Route::group(['middleware'=>['web','actived']],function (){

    Route::get('/','IndexController@index')->name('index');

    Route::middleware(['guest'])->group(function (){

        Route::get('/login','Auth\LoginController@login')->name('login');
        Route::post('/login','Auth\LoginController@store')->name('login.store');
        Route::get('/weibo/login','Auth\LoginWeiboController@login')->name('login.weibo');
        Route::get('/weibo/user','Auth\LoginWeiboController@user')->name('login.weibo.user');

        /**
         * 忘记密码
         */
        Route::get('/forget','Auth\ForgetController@forget')->name('forget');
        # 获取第一步验证码
        Route::post('/forget/account','Auth\ForgetController@account')->name('forget.account');
        # 第二步：进入填写密码
        Route::get('/forget_too/{key?}','Auth\ForgetController@forget_too')->name('forget_too');
        # 处理第二步：
        Route::post('/forget/store_pwd','Auth\ForgetController@store_pwd')->name('forget.store_pwd');
        # 处理第一步验证码字段相关
        Route::post('/forget','Auth\ForgetController@store')->name('forget.store');
    });


    Route::get('/test/sub','TestController@sub')->name('sub');
    Route::get('/test/form','TestController@form')->name('test.form');
    Route::get('/test/store','TestController@store')->name('test.store');
    /**
     * 注册注销相关
     */
    # 注册
    Route::get('/register','Auth\RegisterController@register')->name('register');
    # 注册处理
    Route::post('/register','Auth\RegisterController@store')->name('register.store');
    # 获取验证码
    Route::post('/register/account','Auth\RegisterController@account')->name('register.account');
    #
    Route::get('/register/verify','Auth\RegisterController@verify')->name('verify');

    Route::post('/logout','Auth\LoginController@logout')->name('logout');

    Route::post('/subscriber','SubscriberController@store')->name('subscriber');






    # 必须登录的情况下使用
    Route::middleware(['auth'])->group(function (){
        # 注销
        Route::post('/logout','Auth\LoginController@logout')->name('logout');

        # 收藏清单
        Route::get('/wish','WishController@list')->name('wish');

        # 删除收藏
        Route::delete('/wish','WishController@delete')->name('wish.delete');
        Route::post('/wish','WishController@add')->name('wish.add');


        # 购物车
        Route::get('/carts','CartController@list')->name('cart');
        Route::delete('/carts','CartController@delete')->name('cart.delete');
        Route::put('/carts','CartController@create')->name('cart.create');


        # 订单信息
        Route::get('/order', 'OrderController@list')->name('order.list');
        Route::get('/order/{id}', 'OrderController@show')->name('order.show');
        Route::post('/order/create', 'OrderController@create')->name('order.create');
        Route::post('/order/refund', 'OrderController@refund')->name('order.refund');


        Route::get('/alipay/return','PayController@alipayReturn')->name('pay.alipay.return'); # 前端回调页面
        Route::get('/alipay/{id}','PayController@payByAlipay')->name('pay.alipay');


        # 个人资料页面
        Route::get('/me', 'MeController@index')->name('me.index');

        # 收货地址
        Route::get('/me/address', 'MeController@address')->name('me.address');
        Route::get('/me/address/add_edit/{id?}', 'MeController@add_edit')->name('me.address.add_edit');
        Route::delete('/me/address/delete', 'MeController@delete')->name('me.address.delete');

        # 处理收货地址
        Route::post('/me/address', 'MeController@create')->name('me.address.create');
        Route::put('/me/address', 'MeController@update')->name('me.address.update');

    });


    Route::post('/alipay/notify','PayController@alipayNotify')->name('pay.alipay.notify'); # 服务端回调页面

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
    Route::get('/product','ProductController@list')->name('product.list');


    Route::namespace('Admin')->group(function () {
        Route::name('admin.')->prefix('admin')->group(function (){

            // 必须登录状态下才能进入
            Route::group(['middleware' => ['auth.admin']], function () {


                Route::get('/', 'IndexController@index')->name('index');
                // 权限控制路由
                Route::group(['middleware'=>'admin.permission'],function (){
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

                    /**
                     * 首页头图管理
                     */
                    Route::get('/banner', 'BannerController@list')->name('banner');
                    Route::get('/banner/store/{id?}', 'BannerController@add')->name('banner.add');
                    Route::post('/banner/store', 'BannerController@create')->name('banner.create');
                    Route::delete('/banner','BannerController@delete')->name('banner.delete');


                    /**
                     * 订单模块管理
                     */
                    Route::get('/order', 'OrderController@list')->name('order');
                    Route::get('/order/{id}', 'OrderController@show')->name('order.show');
                    Route::post('/order/ship', 'OrderController@ship')->name('order.ship');
                    Route::post('/order/refund', 'OrderController@refund')->name('order.refund'); # 退款
//                    Route::post('/product/store', 'ProductController@create')->name('product.create');


                    Route::get('/express', 'ExpressController@import')->name('import');


                });
            });

            Route::get('/login','LoginController@login')->name('login');
            Route::post('/login','LoginController@store')->name('store');
            Route::post('/logout','LoginController@logout')->name('logout');

        });
    });
});

















