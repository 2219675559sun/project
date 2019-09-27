<?php

namespace App\Http\Model\App\admin;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_type';
    protected $primaryKey='t_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];

    public static function add($data){
        $res=Type::create($data);
        return $res;
    }
    public static function index(){
        $res=Type::get()->toArray();
        return $res;
    }
    public static function find($where){
        $res=Type::where($where)->first()->toArray();
        return $res;
    }
    //查询类型数
//    public static function type_count(){
//        $res=
//    }
}
