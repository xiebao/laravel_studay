<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/23
 * Time: 10:43
 */

namespace App\Http\Middleware;

use App\Http\Common;
use Closure;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     * 验签
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Common::checkSign($request->headers)) {
            return $next($request);
        } else {
            die(json_encode(Common::error('非法请求!')));
        }
    }
}