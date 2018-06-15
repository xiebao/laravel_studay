<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class RfStatus implements Rule
{
    /**
     * 判断验证规则是否通过。
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = DB::table('rfbase')->where('id', '=', $value)->where('status', '=', 0)->count();
        return $count > 0;
    }

    /**
     * 获取验证错误信息。
     *
     * @return string
     */
    public function message()
    {
        return '请先停止设备';
    }
}