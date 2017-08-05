@extends('layout')

@section('meta')
<meta name="keywords" content="简体繁体互转,QQ火星文转换">
<meta name="description" content="在线中文汉字 简体繁体互转 - 中文汉字转QQ火星文">
@stop

@section('title')
中文简体繁体转换 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        中文简体繁体转换
    </div>
    <div class="panel-body">
        <div>
            <button type="button" class="btn btn-primary format to-cn">转化为简体</button>
            <button type="button" class="btn btn-primary format to-tw">转化为繁体</button>
            <button type="button" class="btn btn-primary format to-qq">转化为QQ火星文</button>
        </div>
        <div style="height: 10px;"></div>
        <textarea id="content" name="content" class="form-control" rows="12"></textarea>
    </div>
</div>
@stop


@section('foot_js')
<script src="{{ asset('js/zh-cn_zh-tw.js') }}"></script>
@stop