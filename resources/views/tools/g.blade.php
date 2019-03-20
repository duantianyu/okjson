@extends('layout')

@section('meta')
<meta name="keywords" content="google搜索,谷歌搜索">
<meta name="description" content="谷歌搜索免费为需求者提供谷歌新闻,谷歌视频,google搜索,谷歌学术等实时搜索结果,国内上网搜索就上谷歌搜索">
@stop

@section('title')
Google搜索 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        Google搜索，Google镜像搜索
    </div>
    <div class="panel-body">
        <form class="form-se">
            <div class="form-group input-group">
                <span class="input-group-addon">关键字</span>
                <input type="text" class="form-control kwd" style="max-width: 350px;" placeholder="" name="q">
                {{--<input type="hidden" name="site" value="">--}}
                {{--<input type="hidden" name="source" value="hp">--}}
                {{--<input type="hidden" name="btnK" value="Google">--}}
                {{--&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary format variable se-btn">搜索</button>--}}
                &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary format variable se-btn">搜索</button>
            </div>
        </form>
    </div>
</div>
@stop





@section('foot_js')
<script src="{{ asset('js/lib/jquery.base64.js') }}" type="text/javascript"></script>
<script type="text/javascript">
(function(){
    function submit_form(){
        var kwd = $(".kwd").val();
        //window.open('https://google.gg-g.org/search?site=&source=hp&btnK=Google+%E6%90%9C%E7%B4%A2&q='+ encodeURIComponent(kwd));
        $.base64.utf8encode = !0;
        window.open('https://gugesousuo.com/'+ $.base64.btoa(kwd)+'.html');
    }
    $('.se-btn').on('click', function(){
        submit_form();
    });
    $('.kwd').on('keyup', function(e){
        if(e.keyCode == 13){
            submit_form();
        }
    });
})()
</script>

@stop