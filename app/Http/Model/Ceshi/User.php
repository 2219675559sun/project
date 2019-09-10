<?php

namespace App\Http\Model\Ceshi;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection='user_mysql';
    protected $table = 'user';
    protected $primaryKey="id";
    public $timestamps = false;
        public static function list($where=[],$where_age=[]){
                $res=User::where($where)->orwhere($where_age)->orderBy('id')->paginate(3)->toArray();
        return $res;
    }
    public static function Udelete($where){
            $res=User::where($where)->delete();
            return $res;
    }
    public static function first($where){
        $res=User::where($where)->first()->toArray();
        return $res;
    }
}
