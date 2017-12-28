@extends('layout')

@section('meta')
<meta name="keywords" content="Poster json,post结果直接格式化">
<meta name="description" content="post获取的json直接格式化">
@stop

@section('head_css')
    <link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <span>Poster</span>
        {{--<a style="color:green;" href="/donate">赞助名单</a>--}}
        <span style="margin-left: 20px;"></span>
    </div>

    <div class="panel-body">
        <div class="input-group">
            <div class="input-group-btn" id="btn-http-group">
                <button type="button" id="httpMethod" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100px;">GET <span class="caret"></span></button>
                <ul class="dropdown-menu method" style="width: 100px;min-width: 100px;">
                    <li><a href="#">GET</a></li>
                    <li><a href="#">POST</a></li>
                    <li><a href="#">PUT</a></li>
                    <li><a href="#">DELETE</a></li>
                    <li><a href="#">HEAD</a></li>
                    {{--<li><a href="#">PATCH</a></li>
                    <li><a href="#">COPY</a></li>
                    <li><a href="#">OPTIONS</a></li>
                    <li><a href="#">LINK</a></li>
                    <li><a href="#">UNLINK</a></li>
                    <li><a href="#">PURGE</a></li>
                    <li><a href="#">LOCK</a></li>
                    <li><a href="#">UNLOCK</a></li>
                    <li><a href="#">PROPFND</a></li>
                    <li><a href="#">VIEW</a></li>--}}
                </ul>
            </div><!-- /btn-group -->
            <input type="text" class="form-control url" name="request_url" id="requestUrl" aria-label="..." placeholder="请输入URL,http或https开头" value="">
        </div>

        <div style="height: 10px;"></div>
        <textarea class="form-control header" rows="2" spellcheck="false" placeholder='请输入header，格式如 Cache-Control=no-cache&Accept-Encoding=gzip, deflate 或者 json格式'></textarea>
        <div style="height: 10px;"></div>
        <textarea class="form-control parameter" rows="2" spellcheck="false" placeholder='请输入参数如 p=2&m=total 或者 json'></textarea>
        <div style="height: 10px;"></div>
        <textarea class="form-control cookie" rows="2" spellcheck="false" placeholder='请输入cookie，格式如 B=115.100.62.7.1401937092035530; bdshare_firstime=1401937092199;'></textarea>
        <div style="height: 10px;"></div>
        <div class="form-group form-inline">
            &nbsp;&nbsp;<button type="button" class="btn btn-primary format send"> SEND </button>
        </div>

        <textarea class="form-control" rows="5" id="json_input" spellcheck="false" placeholder='请求的结果'></textarea>
        <div style="height: 10px;"></div>
        <textarea style="width: 100%; outline:none;" rows="20" id="json_output" spellcheck="false" placeholder='如果请求的结果是json,会在这里格式化'></textarea>

        <div style="height: 10px;"></div>
        <pre class="v-result alert" style="display:none;"></pre>
        <span>试试:&nbsp;&nbsp;
            <a href="/?f=1" target="_blank">JSON格式化</a>&nbsp;&nbsp;
            <a href="/json/parser/?f=1" target="_blank">JSON在线视图</a>&nbsp;&nbsp;
            <a href="/json/format/?f=1" target="_blank">JSON格式化高亮</a>&nbsp;&nbsp;
        </span>

        <div style="height: 10px;"></div>


    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery-linedtextarea.js') }}"></script>
<script src="{{ asset('js/jsl.format.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsl.parser.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsoninit.js') }}" type="text/javascript"></script>
<script type="text/javascript">
(function () {
    function checkUrl(url){
        if(url!=""){
            var reg=/(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;
            if(!reg.test(url)){
                $(".url").val('http://' + url);
                return false;
            }
            return true;
        }
    }

    $("#btn-http-group .dropdown-menu>li").click(function () {
        text = $(this).text();
        $("#httpMethod").html(text + ' <span class="caret"></span>');
    });


    $(".url").val(sessionStorage.getItem("url"));
    $(".parameter").val(sessionStorage.getItem("parameter"));
    $(".cookie").val(sessionStorage.getItem("cookie"));
    $(".header").val(sessionStorage.getItem("header"));

    jsl.interactions.init('json_output');
    var json_input = $('#json_input');
    $(".send").on('click', function(){
        $(this).attr('disabled', true);
        json_input.val('');
        $('#json_output').val('');
        var url = $(".url").val();
        var method = $("#httpMethod").text();
        var parameter = $(".parameter").val();
        var cookie = $(".cookie").val();
        var header = $(".header").val();
        var _token = '{{ csrf_token() }}';
        sessionStorage.setItem("url", url);
        sessionStorage.setItem("parameter", parameter);
        sessionStorage.setItem("cookie", cookie);
        sessionStorage.setItem("header", header);

        if(!checkUrl(url)){
            json_input.val('请输入正确的URL');
            $(this).attr('disabled', false);
            return false;
        }

        $.post("/poster", {
            url: url,
            method: method,
            parameter: parameter,
            cookie: cookie,
            header: header,
            _token: _token
        }, function(d){
            json_input.val(d);
            $('#json_output').val(d);
            $('.send').attr('disabled', false);
            jsl.interactions.validate('json_output');
        })
    });
})()
</script>
@stop