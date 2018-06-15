<?php

namespace App\Http\Middleware;

use App\Http\Common;
use Closure;

class AuthMiddleware
{



    /**
     * Handle an incoming request.
     * 进行登录后方可操作的方法后,需要进行该中间件验证.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result = Common::checkSign($request->headers, true, $request->getClientIp());

        if (true === $result) {
            return $next($request);
        } else {
            die(json_encode(Common::error('无法访问,权限不足', $result)));
        }

        /*$method = strtoupper($request->getMethod());

        $token = null;
        if ($method === 'GET') {
            $token = $request->get('token');
        } elseif ($method === 'DELETE') {
            $token = $request->input('token');
        } elseif ($method === 'POST') {
            $token = $request->input('token');
        }

        // 78a89b894ce4407249528901d0901b07
        if ($token) {
            $admin = Admin::where([
                'token' => $token
            ])->count();

            if (!$admin) die(json_encode(Common::error('无法访问,权限不足')));
        } else {
            die(json_encode(Common::error('无法访问,权限不足')));
        }

        return $next($request);*/
    }
}
