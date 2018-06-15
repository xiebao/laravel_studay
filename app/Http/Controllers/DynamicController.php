<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:00
 */

namespace App\Http\Controllers;


use App\Http\Common;
use App\Http\Model\Dynamic;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    /**
     * 动态获取通知内容
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $data = Dynamic::paginate($request->get('limit') ?: config('common.page.limit'))->toArray();

        return Common::success($data);
    }


    /**
     * 获取指定ID的内容
     *
     * @param $id integer
     * @return array
     */
    public function show($id)
    {
        $data = Dynamic::find($id);

        if (!$data) {
            return Common::error('非法请求');
        } else {
            $data = $data->toArray();
            return Common::success($data);
        }
    }

    /**
     *
     * 创建数据
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        $data = $this->assert($request);

        if (isset($data['code']) && $data['code'] == config('common.error')) {
            return $data;
        }

        try {
            Dynamic::create($data);
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }


    /**
     * 验证数据的正确性
     * 当验证失败时返回错误信息(string), 否则返回数据(array)
     *
     * @param Request $request
     * @return string|array
     */
    protected function assert(Request $request)
    {
        $image = Common::upload($request);

        if (!$image) {
            return '请上传图片!';
        } elseif (!$title = $request->post('title')) {
            return '请输入标题';
        } elseif (!$url = $request->post('url')) {
            return '请输入超链接';
        }

        $data = $request->post();
        $data['image'] = $image;
        $data['time'] = isset($data['time']) ? $data['time'] : date('Y-m-d');

        return $data;
    }

    /**
     * 保存数据
     *
     * @param Request $request
     * @param integer $id
     * @return array
     */
    public function store(Request $request, $id)
    {
        if (!$dynamic = Dynamic::find($id) ) {
            return Common::error('缺少请求参数!');
        }

        $data = $this->assert($request);

        if (is_string($data)) return Common::error($data);

        try {
            $dynamic->update($data);
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }

    /**
     * 根据ID删除数据
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $data = Dynamic::find($id);

        if (!$data) return Common::success();

        try {
            $data->delete();
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }
}