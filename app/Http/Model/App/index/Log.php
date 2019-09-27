<?php

namespace App\Http\Model\App\index;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $connection = 'appshop_mysql';
    protected $table = 'app_user';
    protected $primaryKey='u_id';
    public $timestamps = false;
    const CREATED_AT = 'create_time';
    const UPDATED_AT ='';
    protected $dateFormat = 'U';
    protected $guarded = [];
    public static function find($where=[]){
        $res=Log::where($where)->first();
        return $res;
    }
}
