<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 18:19
 */

namespace App\Http\Controllers;

use App\Http\Common;
use App\Http\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class DzController extends Controller
{
    /**
     * 登录验证
     *
     * App\Http\Middleware\ApiMiddleware -> 验证签名, 提高API接口的安全性
     * App\Http\Middleware\AuthMiddleware -> 验证AccessToken, 提高登录后续操作的安全性
     *
     * @url /auth/login
     * @data username 加密后的用户名
     *       password 加密后的密码
     * @method POST
     *
     * @param Request $request
     * @return array 返回token标识和登录时间戳
     */
    public function login(Request $request)
    {
        if (!$username = $request->input('username')) {
            return Common::error('请输入用户名');
        } elseif (!$password = $request->input('password')) {
            return Common::error('请输入密码');
        }

        // 解密用户名和密码
        /*$username = Common::decrypt($username);
        $password = Common::decrypt($password);

        if (empty($username) || empty($password)) return Common::error('请输入用户名和密码!');*/
//
//        $admin = Admin::where([
//            'username' => $username
//        ])->first();
//
//        if (!$admin) {
//            return Common::error('用户名不存在');
//        }
//
//        if ($admin->password !== md5($password)) {
//            return Common::error('密码错误');
//        }

        // 用户获取到的token和时间戳. 每次请求需要将该两个值进行rsa加密后传输
        $token = uniqid(md5(config('common.token_key')));
        $timestamp = time();
        // 实际token值,保存在数据库进行校验
        $realToken = md5($timestamp . $token);
//
//        $admin->update([
//            'token' => $realToken,
//            'last_login_ip' => $request->getClientIp(),
//        ]);

        return Common::success([
            'token' => $token,
            'timestamp' => $timestamp
        ]);
    }


    /**
     * 用户退出
     *
     * @url /auth/logout
     * @data username 加密后的用户名
     * @method POST
     *
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        if (!$username = $request->input('username')) {
            return Common::error('非法请求!');
        }

        $username = Common::decrypt($username);

        if (!$username) return Common::error('非法请求');

        $admin = Admin::where([
            'username' => $username,
            //'token' => $token, // 由于已经在全局使用accessToken验证,所以无需该参数
        ])->first();

        if (!$admin) {
            return Common::error('非法请求!');
        }

        // 退出后重置token
        $token = md5(time() . uniqid(md5(config('common.token_key'))));
        $admin->update([
            'token' => $token
        ]);

        return Common::success();
    }

    /**
     * 返回服务器时间戳. (让客户端与服务器时间保持一致)
     *
     * @url /server/time
     *
     * @return float|int
     */
    public function getTime()
    {
        return time() * 1000;
    }
}