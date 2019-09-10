<?php

namespace App\Http\Model\Ceshi\api\goodsApi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class GoodsApi extends Model
{
    protected $connection = 'test1_mysql';
    protected $table = 'goods_api';
    protected $primaryKey='id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];
//    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public static function add($data){
        $res=GoodsApi::create($data);
        return $res;
    }
    public static function list($where=[],$where1=[]){
        $res=GoodsApi::where($where)->orwhere($where1)->paginate(2)->toArray();
        return $res;
    }
    public static function del($where){
        $res=GoodsApi::where($where)->delete();
        return $res;
    }
    public static function find($where){
        $res=GoodsApi::where($where)->first()->toArray();
        return $res;
    }
    public static function gupdate($where,$data){
        $res=GoodsApi::where($where)->update($data);
        return $res;
    }
}
