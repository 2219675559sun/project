<?php

namespace App\Http\Model\App\admin;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_cargo';
    protected $primaryKey='c_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];
        public static function add($data=[]){
            $res=Cargo::create($data);
            return $res;
        }
        //查询货品表
        public static function index($where=[]){
            $res=Cargo::join('app_goods','app_goods.g_id','=','app_cargo.g_id')->where($where)->select('app_cargo.*','app_goods.g_name')->get()->toArray();
            return $res;
        }
}
