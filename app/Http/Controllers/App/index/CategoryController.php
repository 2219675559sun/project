<?php

namespace App\Http\Controllers\App\index;

use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\App\index\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::all(['pid'=>0])->toArray();
        $arr=[];
        foreach($data as $k=>$v){
            $where=[
                ['pid','=',$v['c_id']],
            ];
            $info=Category::all($where)->toArray();
            if(!empty($info)) {
                foreach ($info as $key => $val) {

                    if ($v['c_id'] == $val['pid']) {
                        $val['c_name'] = $v['c_name'].'&'.$val['c_name'];
                        $arr[] = $val;
                    }
                }
            }else{
                $arr[]=$v;
            }
        }
        //分类只展示8条
        $num=count($arr);
        if($num>8){
            for($i=8;$i<$num;$i++){
                unset($arr[$i]);
            }
        }
//        dd($arr);
        if($arr){
            return json_encode(['code'=>200,'msg'=>$arr]);
        }else{
            return json_encode(['code'=>205,'msg'=>'请求失败']);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
