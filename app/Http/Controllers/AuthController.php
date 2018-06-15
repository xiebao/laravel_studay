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

class AuthController extends Controller
{
    /**
     * 登录验证
     *
     * @param Request $request
     * @return array 返回token标识
     */
    public function login(Request $request)
    {
        if (!$username = $request->post('username')) {
            return Common::error('请输入用户名');
        } elseif (!$password = $request->post('password')) {
            return Common::error('请输入密码');
        }

        $admin = Admin::where([
            'username' => $username
        ])->first();


        if (!$admin) {
            return Common::error('用户名不存在');
        }

        if ($admin->password !== md5($password)) {
            return Common::error('密码错误');
        }

        $token = md5(time() . uniqid(md5(config('common.token_key'))));

        $admin->update([
            'token' => $token,
            'last_login_ip' => $request->getClientIp()
        ]);

        return Common::success([
            'token' => $token
        ]);
    }


    /**
     * 用户退出
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        if (!$username = $request->post('username') || !$token = $request->post('token')) {
            return Common::error('非法请求!');
        }

        $admin = Admin::where([
            'username' => $username,
            'token' => $token
        ])->first();

        if (!$admin) {
            return Common::error('非法请求!');
        }

        $token = md5(time() . uniqid(md5(config('common.token_key'))));

        $admin->update([
            'token' => $token
        ]);

        return Common::success();
    }
    public  function getTime()
    {
        return time();
    }
}