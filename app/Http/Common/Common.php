<?php

namespace App\Http\Common;

use Illuminate\Support\Facades\DB;


class Common
{
   public function getInfo($cateInfo,$pid,$level=1){

        static $info=[];
        foreach($cateInfo as $k=>$v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $info[]=$v;
               $this->getInfo($cateInfo,$v['c_id'],$level+1);
            }
        }
        return $info;
    }

}
