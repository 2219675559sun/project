<?php

namespace App\Http\Model\App\admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_category';
    protected $primaryKey='c_id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $dateFormat = 'U';
    protected $guarded = [];
    public static function add($data){
        $res=Category::create($data);
        return $res;
    }
    public static function find($where){
        $res=Category::where($where)->first()->toArray();
        return $res;
    }
    public static function index(){
        $res=Category::get()->toArray();
        return $res;
    }
}
