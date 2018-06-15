<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:00
 */

namespace App\Http\Controllers;


use App\Http\Common;
use App\Http\Model\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * 获取用户留言
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $data = User::paginate($request->get('limit') ?: config('common.page.limit'))->toArray();

        return Common::success($data);
    }

    /**
     * 获取单条用户留言
     *
     * @param $id
     * @return array
     */
    public function show($id)
    {
        $data = User::find($id);

        if (!$data) {
            return Common::error('缺少请求参数!');
        } else {
            $data = $data->toArray();
            return Common::success($data);
        }
    }

    /**
     * 新增用户留言
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $content = $request->post('content');

        if (!$content) {
            return Common::error('请输入留言内容');
        }

        // 用户留言的长度不得超过300
        if (mb_strlen($content) > 300) {
           $content = mb_substr($content, 0, 300);
        }

        try {
            User::create([
                'ip' => $request->getClientIp(),
                'content' => $content
            ]);
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }

    /**
     * 删除指定的用户留言
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $data = User::find($id);

        if (!$data) return Common::success();

        try {
            $data->delete();
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }
}
