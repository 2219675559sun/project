<?php

namespace App\Http\Model\App\admin;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_attribute';
    protected $primaryKey='a_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];

    public static function add($data){
        $res=Attribute::create($data);
        return $res;
    }
    public static function index($where=[]){
        $res=Attribute::where($where)->paginate(2);
        return $res;
    }
    public static function index_attr($where=[]){
        $res=Attribute::where($where)->get();
        return $res;
    }
    public static function index_do($where=[]){
        $res=Attribute::where($where)->join('app_type','app_attribute.t_pid','=','app_type.t_id')->get()->toArray();
        return $res;
    }
    public static function c_get($where=[]){
        $res=Attribute::where($where)->get();
        return $res;
    }
    public static function del($where){
        $res=Attribute::where($where)->delete();
        return $res;
    }

}
