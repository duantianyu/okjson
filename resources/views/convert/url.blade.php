@extends('layout')

@section('meta')
<meta name="keywords" content="URL编码/解码,URL编码解码,UrlEncode编码,UrlDecode解码">
<meta name="description" content="URL编码/解码,URL编码解码,UrlEncode编码,UrlDecode解码">
@stop

@section('title')
URL编码/解码 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
@include('convert.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        URL编码/解码
    </div>

    <div class="panel-body">
        <div class="form-group">
            <label>URL</label>
            <textarea class="form-control url1" placeholder="请输入你要编码/解码的url" rows="10"></textarea>
        </div>

        <button type="button" class="btn btn-primary format u-encode">UrlEncode编码</button>
        &nbsp;&nbsp;
        <button type="button" class="btn btn-primary format u-decode">UrlDecode解码</button>
        <div style="height:15px;"></div>

        <div class="form-group">
            <textarea class="form-control url2" placeholder="编码/解码的结果将会出现在这里" rows="10"></textarea>
        </div>

    </div>
</div>
@stop


@section('foot_js')
<script type="text/javascript">
(function(){
    $(".u-encode").on('click', function(){
        $(".url2").val(encodeURIComponent($(".url1").val()));
    });

    $(".u-decode").on('click', function(){
        $(".url2").val(decodeURIComponent($(".url1").val()));
    });
})()
</script>
@stop