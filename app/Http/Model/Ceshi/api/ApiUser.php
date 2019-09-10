<?php

namespace App\Http\Model\Ceshi\api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiUser extends Model
{
    protected $connection='test1_mysql';
    protected $table = 'api_user';
//    public $timestamps = false;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
//    protected $dates =['create_time'];
    protected $dateFormat ='U';
    protected $guarded = [];
    //查询全部
    public static function all($where=[],$where1=[]){
        $res=ApiUser::where($where)->orwhere($where1)->get()->toArray();
        return $res;
    }
    //查询一条
    public static function find($where=[]){
        $res=ApiUser::where($where)->first()->toArray();
        return $res;
    }
    //添加
    public static function add($data){
        $res=ApiUser::create($data);
        return $res;
    }
    //修改
    public static function modify($where,$data){
        $res=ApiUser::where($where)->update($data);
        return $res;
    }
    //删除
    public static function out($where){
        $res=ApiUser::where($where)->delete();
        return $res;
    }

}
