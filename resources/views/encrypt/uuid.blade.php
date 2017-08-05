@extends('layout')

@section('meta')
<meta name="keywords" content="通用唯一识别码在线生成，Universal unique identifier">
<meta name="description" content="通用唯一识别码在线生成器，生成唯一识别码，Universal unique identifier">
@stop

@section('title')
UUID在线生成 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/bdsstyle.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        UUID在线生成
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p>Universal unique identifier（通用唯一识别码）</p>
        </div>
        <button type="button" class="btn btn-primary format generate">生成</button>
        <div style="height: 10px"></div>
        <textarea class="form-control" name="data" rows="10"></textarea>

    </div>
</div>

@stop


@section('foot_js')
<script>
    (function(){
        $(".generate").on('click', function(){
            $.getJSON('/uuid?generate=&callback=?', function(d){
                $("textarea[name=data]").val(d.join("\n"));
            });
        })
    })()
</script>
@stop