<?php

namespace App\Http\Model\Ceshi;

use Illuminate\Database\Eloquent\Model;

class Wechat_openid extends Model
{
    //
    protected $connection='test_mysql';
    protected $table = 'wechat_openid';
    protected $primaryKey="id";
    public $timestamps = false;


}
