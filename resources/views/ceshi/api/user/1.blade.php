@extends('ceshi/layout')

@section('title', '测试')

@section('body')
    <div class="container">


        <p class="text">我是测试文字，测试高亮功能</p>
        <p class="text">我是测试文字，测试高亮功能，点击按钮测试吧</p>
        <p class="text">我是测试文字，测试高亮功能</p>
        <p class="text">我是测试文字，测试高亮功能，点击按钮测试吧</p>
        <p class="text">我是测试文字，测试高亮功能</p>
        <p class="text">我是测试文字，测试高亮功能，点击按钮测试吧</p>

        <input type="text" value="高亮">
        <button class="one">点我</button>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/gaoliang.js"></script>
        <script type="text/javascript">
            $(".one").click(function () {
                // var otext = $("input").val();

                $('.text').GL({
                    ocolor:'red',   //设置关键词高亮颜色
                    oshuru:'高亮'   //设置要显示的关键词
                });
            })
        </script>

{{--        <div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">--}}

    </div>
@endsection

@section('script')
    @parent

@endsection
