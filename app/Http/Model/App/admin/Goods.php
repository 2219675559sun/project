<?php

namespace App\Http\Model\App\admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_goods';
    protected $primaryKey='g_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];

    public static function add($data=[]){
        $res=Goods::create($data);

        return $res;
    }
    public static function find($where=[]){
        $res=Goods::where($where)->first();
        return $res;
    }
    //商品展示
    public static function goods_get($where=[],$wheres=[]){
        $res=Goods::where($where)->orwhere($wheres)->paginate(5);
        return $res;
    }
    //商品删除
    public static function del($where){
        $res=Goods::where($where)->delete();
        return $res;
    }
    //商品修改
    public static function upd($where,$data){
        $res=Goods::where($where)->update($data);
        return $res;
    }
}
