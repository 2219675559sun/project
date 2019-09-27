<?php

namespace App\Http\Controllers\App\admin;

use App\Http\Common\Common;
use App\Http\Model\App\admin\Attribute;
use App\Http\Model\App\admin\Category;
use App\Http\Model\App\admin\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\App\admin\Goods;
use App\Http\Model\App\admin\Goodsattr;
use App\Http\Model\App\admin\Cargo;
use DB;

class GoodsController extends Controller
{
    public $common;
    public function __construct(Common $common)
    {
        $this->common=$common;
    }
    //添加
    public function add(Request $request){
        //商品分类
        $category=Category::index();
        $getinfo=$this->common->getInfo($category,0);
        //商品类型
        $type=Type::index();
//        dd($data);
        return view("App.admin.goods.add",['category'=>$getinfo,'type'=>$type]);
    }
    public function add_do(Request $request){
        $data=$request->all();
        $file = $request->file('g_img');

        if(!empty($file)){
            $dk=date('Y-n-j');
            $path=$file->store('app/goods/'.$dk);
        }
        //        DB::connection('appshop_mysql')->beginTransaction();
            $goods=Goods::add([
                'g_name'=>$data['g_name'],
                'cat_id'=>$data['cat_id'],
                'g_price'=>$data['g_price'],
                'g_img'=>$file==''?'':$path,
                'g_content'=>$data['g_content'],
            ]);

        foreach($data['attr_id_list'] as $k=>$v){
            $goodsarrt=Goodsattr::add([
                'g_id'=>$goods->g_id,
                'a_id'=>$v,
                'attr_name'=>$data['attr_value_list'][$k],
                'attr_price'=>$data['attr_price_list'][$k],
            ]);
        }
//        DB::connection('appshop_mysql')->rollBack();
//       DB::connection('appshop_mysql')->commit();
        if($goods && $goodsarrt){
            return redirect('admin/goods/product_add/'.$goods->g_id);
        }else{
            return redirect('admin/goods/add');
        }

    }
    //货品添加
    public function product_add($goods_id){
        $where=[
            ['g_id','=',$goods_id],
        ];
        $goods_name=Goods::find($where);//商品名
//        dd($goods_name->g_name);
        //查询属性值
        $where=[
            ['attr','=',2],
            ['g_id','=',$goods_id],
        ];
        $data=Goodsattr::all($where);
        $attr_name=[];
        $info=[];
        foreach($data as $k=>$v){
            $attr_name[]=$v['a_name'];
            $info[$v['a_id']][]=$v['attr_name'];
        }
//        dd($data);
        $attr_name=array_unique($attr_name);
//        dd($info);

        return view("App.admin.goods.product_add",['goods_name'=>$goods_name->g_name,
            'attr_name'=>$attr_name,
            'info'=>$info,
            'goods_id'=>$goods_id]);
    }
    public function product_add_do(Request $request){
            $data=$request->all();//接收全部数据
//            dd($data);
        if(isset($data['attr_id'])) {
            $size = count($data['attr_id']) / count($data['number']); //查询每个tr共有几个字段
            $info = array_chunk($data['attr_id'], $size);//分割成二维数组

            foreach ($info as $k => $v) {
                $attr_id = implode(',', $v);
//                dd($data['goods_num'][$k]);
                $res = Cargo::add([
                    'g_id' => $data['g_id'],
                    'attr_id' => $attr_id,
                    'goods_num' => $data['goods_num'][$k],
                    'number' => $data['number'][$k],
                ]);
            }
        }else{
            $res = Cargo::add([
                'g_id' => $data['g_id'],
                'attr_id' => '',
                'goods_num' => $data['goods_num'][0],
                'number' => $data['number'][0],
            ]);
        }
        if($res){
            return redirect('admin/product/index');
        }else{
            return redirect('admin/goods/product_add');
        }
    }
    //货品展示
    public function product_index(){
        $data=Cargo::index();

        return view('App.admin.cargo.index',['data'=>$data]);
    }
    //ajax内容改变事件
    public function ajax_add(Request $request){
        //属性查询
        $id=$request->input('id');
        $where=[
            ['t_pid','=',$id],
        ];
        $attr=Attribute::index_attr($where)->toArray();
        echo json_encode(['code'=>200,'msg'=>$attr]);

    }
    //商品展示
    public function index(Request $request){
        $arr=$request->all();
//        dd($arr['cat_id']);
        $where=[];
        $cat_id='';
        $mohu='';
        if(!empty($arr['cat_id'])){
            $where[]=['cat_id','=',$arr['cat_id']];
            $cat_id=$arr['cat_id'];
        }
        if(!empty($arr['mohu'])){
            $where[]=['g_name','like',"%{$arr['mohu']}%"];
            $mohu=$arr['mohu'];
        }
//        dump($where);
        //查询所有分类
        $category=Category::index();
        $getinfo=$this->common->getInfo($category,0);
        //展示
        $data=Goods::goods_get($where);
        foreach($data as $k=>$v){
            $where=[
                ['c_id','=',$v['cat_id']],
            ];
            $info=Category::find($where);
//            dump($data[$k]['ca']='ss');
            $data[$k]['car_name']=$info['c_name'];
        }
//        $data=Goods::paginate(2)->toArray();
        return view("App.admin.goods.index",['data'=>$data,'category'=>$getinfo,'cat_id'=>$cat_id,'mohu'=>$mohu]);
    }
    public function delete(Request $request){
        $id=$request->input('id');
        $id=rtrim($id,',');
        $ids=explode(',',$id);
        foreach($ids as $k=>$v) {
            $where=[
                ['g_id','=',$v],
            ];
            $res=Goods::del($where);
        }
        if($res){
            echo json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            echo json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }
    //修改
    public function update(Request $request){
        $data=$request->all();
        $datas=[$data['fieid']=>$data['value']];
        $where=[
            ['g_id','=',$data['g_id']],
        ];
        $res=Goods::upd($where,$datas);
        if($res){
            echo json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            echo json_encode(['code'=>201,'msg'=>'修改失败']);
        }
    }
}
