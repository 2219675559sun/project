<?php

namespace App\Http\Model\App\admin;

use Illuminate\Database\Eloquent\Model;

class Goodsattr extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_goodsattr';
    protected $primaryKey='attr_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];

    public static function add($data=[]){
        $res=Goodsattr::create($data);
        return $res;
    }
    //查询属性值
    public static function all($where=[]){
        $res=Goodsattr::join('app_attribute','app_attribute.a_id','=','app_goodsattr.a_id')
            ->where($where)
            ->select('app_goodsattr.*','app_attribute.a_name','app_attribute.attr')
            ->get()
            ->toArray();
        return $res;
    }
    public static function find($where=[]){
        $res=Goodsattr::where($where)->first();
        return $res;
    }
    //多条件查询
    public static function first($where=[]){
        $res=Goodsattr::whereIn($where)->get();
        return $res;
    }
}
