<?php

namespace App\Http\Controllers\ceshi\api\zhoukao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CeshiController extends Controller
{
    public function index(){
        $url="http://www.project.com/yuekao/list";
        $indo=file_get_contents($url);
    }
}
