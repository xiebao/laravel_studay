<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/18
 * Time: 15:26
 */

namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'last_login_ip', 'token'
    ];
}