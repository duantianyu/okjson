@extends('layout')

@section('meta')
<meta name="keywords" content="FM,豆瓣FM,百度音乐">
<meta name="description" content="戴上耳机就是一个人的世界,最高品质静悄悄！">
@stop

@section('title')
FM - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
<div class="alert alert-success" role="alert">
    戴上耳机就是一个人的世界,最高品质静悄悄！
</div>
<iframe style="width: 100%; min-height:600px; max-height:600px;" src="http://fm.baidu.com/" name="iframe_canvas" frameborder="0" scrolling="no"></iframe>
@stop