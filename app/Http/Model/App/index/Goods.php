<?php

namespace App\Http\Model\App\index;

use Illuminate\Database\Eloquent\Model;
use DB;
class Goods extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_goods';
    protected $primaryKey='g_id';


    public static function index($where=[]){
        $res=Goods::where($where)->get();
        return $res;
    }
    //新品
    public static function new_index($where=[]){
        $res=Goods::where($where)->orderby('create_time','desc')->limit(4)->get();
        return $res;
    }
    //商品详情
    public static function details($where=[]){
        $res=DB::connection('appshop_mysql')
            ->table('app_goodsattr')
            ->where($where)
            ->join('app_attribute','app_attribute.a_id','=','app_goodsattr.a_id')
            ->get();
        return $res;
    }
    //
    public static function find($where=[]){
        $res=Goods::where($where)->first();
        return $res;
    }

    public static function bute($where=[]){
        $res=DB::connection('appshop_mysql')->table('app_attribute')->where($where)->get();
        return $res;
    }
    public static function addCate($where=[]){
        $res=DB::connection('appshop_mysql')->table('app_attribute')->where($where)->get();
        return $res;
    }
}
