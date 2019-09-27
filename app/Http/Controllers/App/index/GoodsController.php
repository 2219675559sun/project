<?php

namespace App\Http\Controllers\App\index;

//use App\Http\Model\App\Cart;
use App\Http\Model\App\admin\Goodsattr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\App\index\Goods;
use App\Http\Model\App\index\Cart;
use Illuminate\Support\Facades\Cache;
use DB;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
// dd($data);
//       Cache::pull('g_data');//删除
        if(Cache::has('g_data')){
            $data = Cache::get('g_data');
        }else{
            $data=Goods::new_index();
            Cache::put('g_data', $data, 84600);
        }
        header('Content-type: application/json');
//获取回调函数名
//        $jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']??'');
        if(!empty(htmlspecialchars($_REQUEST ['jsoncallback']??''))){
            $jsoncallback = htmlspecialchars($_REQUEST ['jsoncallback']??'');
        }
        //json数据
//        $json_data = '["customername1","customername2"]';
            if($data){
                if(isset($jsoncallback)){
                    //输出jsonp格式的数据
                    return $jsoncallback . "(" . json_encode(['code'=>200,'msg'=>$data]) . ")";
                }else {
                    return json_encode(['code' => 200, 'msg' => $data]);
                }
            }else{
                return json_encode(['code'=>202,'msg'=>'出现未知状况，请联系管理员']);
            }

//        dd($callback);

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
//    商品分类
    public function category($id)
    {
        //
    }
//    商品详情
    public function details_goods(Request $request){
        $goods_id=$request->input('goods_id');
        $goods=Goods::find(['g_id'=>$goods_id]);//商品详情
        $attr=Goods::details(['g_id'=>$goods_id]);//商品属性
        $a_name=[];
        $info=[];
//        dd($attr);
            foreach($attr as $k=>$v){
                if($v->attr==2){
                    $info[$v->a_id][]=$v;

            }
        }
        $a_name=array_unique($a_name);
//dd($info);
        if($goods){
            return json_encode(['code'=>200,'goods'=>$goods,'attr'=>$attr,'a_name'=>$a_name,'info'=>$info]);
        }else{
            return json_encode(['code'=>201,'msg'=>'数据出错，请联系管理员']);
        }
    }
    //商品列表
    public function goods_index(Request $request){
        $c_id=$request->input('c_id')??'';
        if($c_id==null){
            return json_encode(['code'=>233,'msg'=>'此分类下没有商品']);
        }
        if($c_id==0){
            $res=Goods::new_index();
        }else{
            $res=Goods::index(['cat_id'=>$c_id])->toArray();
            if(empty($res)){
                return json_encode(['code'=>233,'msg'=>$res,'da'=>'此分类下没有商品']);
            }
        }
//dd($res);
       if($res){
               return json_encode(['code'=>200,'msg'=>$res]);
       }else{
           return json_encode(['code'=>322,'msg'=>'请求出错，请联系管理员']);
       }
    }
    //添加购物车
    public function addCate(Request $request){
        $data=$request->all();
//        dd($data);
        if(isset($data['attr'])){
            $attr=implode(',',$data['attr']);
            $attribute=implode(' ',$data['attribute']);
//            dd($attribute);
        }else{
            return json_encode(['code'=>244,'msg'=>'请选择商品属性']);
        }
        $mid_params = $request->get('user_id');//中间件产生的参数

        $cart=Cart::find(['g_id'=>$data['g_id'],'u_id'=>$mid_params,'attr'=>$attr]);
        if(empty($cart)) {
            unset($data['token']);
            $data['attr'] = $attr;
            $data['u_id'] = $mid_params;
            $data['number'] = 1;
            $data['attribute']=$attribute;
            $res = Cart::add($data);
        }else{
            $cart->number=$cart['number']+1;
            $res=$cart->save();
        }
//        dd($res);
        if($res){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>207,'msg'=>'添加失败']);
        }
    }
    //购物车展示
    public function cart_index(){
        $data=Cart::index()->toArray();//查询购物车
        $attr_id=[];
        $attr=[];
        foreach($data as $k=>$v){
//            $attr_id=$v['attr_id']=$v['attr'];
            $attr_id=explode(',',$v['attr']);
            $attr=Goodsattr::whereIn('attr_id',$attr_id)->get()->toArray();//查询属性
            foreach($attr as $key=>$val){
                $data[$k]['g_price']+=$val['attr_price'];
            }
        }
        if($data){
            return json_encode(['code'=>200,'msg'=>$data]);
        }else{
            return json_encode(['code'=>201,'msg'=>'系统出错，请联系管理员']);
        }
    }
    public function update_cart(Request $request){
        $data=$request->all();
//        dd($data['number']);
        $cart=Cart::find(['c_id'=>$data['c_id']]);
        if($data['number']=='jian'){
            if($cart['number']=='1'){
               return json_encode(['code'=>200,'msg'=>'1']);
            }
            $res=Cart::where('c_id',$data['c_id'])->update(['number'=>$cart['number']-1]);
            $num=$cart['number']-1;
        }else{
            $res=Cart::where('c_id',$data['c_id'])->update(['number'=>$cart['number']+1]);
            $num=$cart['number']+1;
        }
        if($res){
            return json_encode(['code'=>200,'msg'=>$num]);
        }else{
            return json_encode(['code'=>209,'msg'=>'系统出错，请联系管理员']);
        }
    }
    public function delete_cart(Request $request){
            $id=$request->all();
            $res=Cart::whereIn('c_id',$id['c_id'])->delete();
            if($res){
                return json_encode(['code'=>200,'msg'=>'删除成功']);
            }else{
                return json_encode(['code'=>267,'msg'=>'删除失败']);
            }
    }
}
