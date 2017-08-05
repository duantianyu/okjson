@extends('layout')

@section('meta')
<meta name="keywords" content="google搜索, JSON,JSON在线,json解析, json在线解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化, json在线,json 在线验证,json 在线校验">
<meta name="description" content="json解析,json在线解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
@stop

@section('title')
Google搜索 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Google搜索，Google镜像搜索
    </div>
    <div class="panel-body">
        <form class="form-se" method="get" target="_blank" action="https://g.pank.one/search">
            <div class="form-group input-group">
                <span class="input-group-addon">关键字</span>
                <input type="text" class="form-control kwd" style="max-width: 350px;" placeholder="" name="q">
                <input type="hidden" name="site" value="">
                <input type="hidden" name="source" value="hp">
                <input type="hidden" name="btnK" value="Google">
                &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary format variable se-btn">Go</button>
            </div>
        </form>
    </div>
</div>
@stop





@section('foot_js')
<script type="text/javascript">
(function(){
    // function submit_form(){
    //     var kwd = $(".kwd").val();
    //     window.open('https://google.gg-g.org/search?site=&source=hp&btnK=Google+%E6%90%9C%E7%B4%A2&q='+ encodeURIComponent(kwd));
    // }
    // $('.se-btn').on('click', function(){
    //     submit_form();
    // });
    // $('.kwd').on('keyup', function(e){
    //     if(e.keyCode == 13){
    //         submit_form();
    //     }
    // });
})()
</script>

@stop