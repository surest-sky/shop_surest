<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/2
 * Time: 19:43
 */

return [
    'log' => [
        'file' =>storage_path('logs/login/'.date('Y-m-d') . '.php')
    ],
   'weibo' => [
       // 微博登录相关key
       'w_key' => ENV('W_KEY',''),
       'w_secret' => ENV('W_SECRET',''),
       'w_get_code_url' => 'https://api.weibo.com/oauth2/authorize?client_id=%d&response_type=code&redirect_uri=%s',
       'w_get_access_token_url' => 'https://api.weibo.com/oauth2/access_token?client_id=%d&client_secret=%s&grant_type=authorization_code&redirect_uri=%s&code=%s',
       'w_user_url' => 'https://api.weibo.com/2/users/show.json'
   ]
];