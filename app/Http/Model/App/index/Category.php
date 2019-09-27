<?php

namespace App\Http\Model\App\index;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_category';
    protected $primaryKey='c_id';

    //分类
    public static function all($where=[]){
        $res=Category::where($where)->get();
        return $res;
    }
    public static function pid($where=[]){
        $res=Category::where($where)->get();
        return $res;
    }
}
