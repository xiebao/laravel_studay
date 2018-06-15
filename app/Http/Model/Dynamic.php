<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:25
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Dynamic extends Model
{
    protected $fillable = [
        'title', 'image', 'url', 'time'
    ];
}