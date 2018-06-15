<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:00
 */

namespace App\Http\Controllers;


use App\Http\Common;
use App\Http\Model\Tech;
use Illuminate\Http\Request;

class TechController extends Controller
{
    /**
     * 根据参数类型获取技术与产品的内容
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $type = $request->get('type');

        if ($type != Tech::TYPE_TECH && $type != Tech::TYPE_PRODUCT) {
            return Common::error('请求参数错误!');
        }

        $query =  Tech::where(['type' => $request->get('type')]);

        if ($keyword = trim($request->get('keyword'))) {
            $query = $query->where('title', 'like', "%{$keyword}%");
        }

        $data = $query->paginate($request->get('limit') ?: config('common.page.limit'))->toArray();

        return Common::success($data);
    }

    /**
     * 获取指定ID的数据
     *
     * @param $id integer
     * @return array
     */
    public function show($id)
    {
        $data = Tech::find($id);

        if (!$data) {
            return Common::error('请求参数错误!');
        } else {
            $data = $data->toArray();
            return Common::success($data);
        }
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
        if (!$image = Common::upload($request)) {
            return '请上传图片!';
        } elseif (!$request->post('title')) {
            return '请输入标题';
        } elseif (!$request->post('url')) {
            return '请输入超链接';
        } elseif (!$request->post('content')) {
            return '请输入内容';
        }

        $type = $request->post('type');

        if ($type != Tech::TYPE_PRODUCT && $type != Tech::TYPE_TECH) {
            return '错误类型,请重新选择';
        }


        return ['image' => $image] + $request->post();
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


        if (is_string($data)) return Common::error($data);

        try {
            Tech::create($data);
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
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

        if (!$tech = Tech::find($id)) {
            return Common::error('请求参数错误');
        }

        $data = $this->assert($request);

        if (is_string($data)) return Common::error($data);

        try {
            $tech->update($data);
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }

    /**
     * 删除指定数据
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $data = Tech::find($id);

        if (!$data) Common::success();

        try {
            $data->delete();
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }
}