<?php

namespace App\Http\Model\App\index;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_cart';
    protected $primaryKey='c_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT= '';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = [];

    public static function add($data){
        $res=Cart::create($data);
        return $res;
    }
    public static function find($where){
        $res=Cart::where($where)->first();
        return $res;
    }
    public static function index($where=[]){
        $res=Cart::where($where)
            ->join('app_goods','app_goods.g_id','=','app_cart.g_id')
            ->get();
        return $res;
    }
}
