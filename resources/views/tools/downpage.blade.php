@extends('layout')

@section('meta')
<meta name="keywords" content="在线仿站工具,模板小偷,网页模板在线下载工具,网页模版下载器">
<meta name="description" content="本工具可以在线下载单页面、JS文件、CSS文件、网页图片以及CSS文件里的图片，保留原始目录结构，并且免费打包下载!">
@stop

@section('title')
网页模板在线下载工具 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/bdsstyle.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        网页模板在线下载工具 beta
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <p>本工具还处在开发功能完善阶段，部分网页模版保存效果不佳。反馈问题请联系QQ: 2443738275</p>
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">网址</span>
            <input type="text" id="url" name="url" class="form-control from" style="max-width:450px;" placeholder="https://www.608558.com/" value="https://www.baidu.com">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary format analysis">分析</button>
        </div>

        <div class="alert msg" role="alert">
        </div>

        <p>说明：本工具能针对提供的网址进行分析，分析网页加载完成，页面所有请求的资源文件（如：css、js、image...），并规范整理成如下目录结构。
        <pre>
├── css
│   ├── bootstrap.min.css
│   └── docs.min.css
├── images
│   ├── top.jpg
│   ├── logo.jpg
├── index.html
├── js
│   ├── bootstrap.min.js
│   ├── jquery-1.11.1.min.js
│   └── font.js
└── other
</pre>
        </p>

    </div>
</div>
@stop


@section('foot_js')
<script type="text/javascript">
(function(){
    $('.msg').html('').hide();
    function checkUrl(url){
        if(url!=""){
            var reg=/(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;
            if(!reg.test(url)){
                return false;
            }
            return true;
        }
    }

    $(".analysis").on('click', function(){
        var msg = $('.msg');
        $(this).attr('disabled', true);
        msg.removeClass('alert-danger alert-info alert-success').html('').hide();
        var url = $("#url").val();
        var _token = '{{ csrf_token() }}';
        if(!checkUrl(url)){
            msg.addClass('alert-danger').html("<p>请输入正确的URL</p>").show();
            $(this).attr('disabled', false);
            return false;
        }

        msg.addClass('alert-info').html('...请稍后...').show();
        $.post('/down_page?analysis=1', {
            url: url,
            _token:_token
            }, function(d){
            msg.removeClass('alert-danger alert-info alert-success');
            if(d.status){
                d.msg = '<p>分析完成，zip文件下载地址: &nbsp;&nbsp;<a href="'+d.msg+'" target="_blank">点这里</a></p>';
                msg.addClass('alert-success')
            }else{
                msg.addClass('alert-danger')
            }
            msg.html(d.msg).show();
            $('.analysis').attr('disabled', false);
        });
    });
})()
</script>
@stop