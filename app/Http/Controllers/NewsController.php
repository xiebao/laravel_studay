<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:00
 */

namespace App\Http\Controllers;

use App\Http\Common;
use Illuminate\Http\Request;
use App\Http\Model\News;

class NewsController extends Controller
{
    /**
     * 动态获取通知内容
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $news = new News();
        if ($keyword = trim($request->get('keyword'))) {
            $news = $news->where('title', 'like', "%{$keyword}%");
        }

        $data = $news->paginate($request->get('limit') ?: config('common.page.limit'))->toArray();

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
        $data = News::find($id);

        if (!$data) {
            return Common::error('缺少请求参数');
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
        $image = Common::upload($request);

        if (!$image) {
            return '请上传图片!';
        } elseif (!$request->post('content')) {
            return '请输入通告内容!';
        } elseif (!$request->post('title')) {
            return  '请输入标题';
        } elseif (!$request->post('url')) {
            return '请输入超链接';
        }

        $data = $request->post();
        $data['time'] = isset($data['time']) ? $data['time'] : date('Y-m-d');
        $data['image'] = $image;

        return $data;
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
            News::create($data);
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
        if (!$news = News::find($id) ) {
            return [
                'code' => config('common.error'),
                'message' => '无效数据'
            ];
        }

        $data = $this->assert($request);

        if (is_string($data)) return Common::error($data);

        try {
            $news->update($data);
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }

    /**
     * 删除数据
     *
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $data = News::find($id);

        if (!$data) return Common::success();

        try {
            $data->delete();
        } catch (\Exception $e) {
            return Common::error($e->getMessage());
        }

        return Common::success();
    }
}