<?php

namespace App\Http\Controllers\ceshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Ceshi\Wechat_openid;
class ApiController extends Controller
{
    public function api(){
        $data=Wechat_openid::get();
        dd($data);
    }
}
