<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:25
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Tech extends Model
{
    const TYPE_TECH = 0;
    const TYPE_PRODUCT = 1;

    protected $fillable = [
        'title', 'url', 'image', 'content', 'type'
    ];
}