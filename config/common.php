<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 16:14
 */

return [
    // 每次请求的页数
    'page' => [
        'limit' => 10
    ],

    // 请求码
    'success' => 0,
    'error' => 1,
    // token超时,需要退出
    'logout' => -1,

    // token_type
    'token_key' => 'VRONE',

    // seconds | 签名有效期
    'sign_timeout' => 2 * 60,

    // seconds | redis保存签名的有效期, 要大于sign_timeout
    'redis_timeout' => 5 * 60,

    // 登录有效期, 超时后再次请求将被拒绝,同时重置数据库的token
    'login_timeout' => 60 * 60 * 3,
];