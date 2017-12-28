@extends('layout')

@section('meta')
<meta name="keywords" content="网址桌面快捷方式 快捷方式">
<meta name="description" content="生成网址桌面快捷方式, 生成快捷方式 - 在线JSON校验格式化工具(OK JSON)">
@stop

@section('title')
网址桌面快捷方式 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        创建网址桌面快捷方式
    </div>
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p>生成网址桌面快捷方式并下载</p>
        </div>
        <form action="/shortcut" method="post" target="_blank">
                <div class="form-group input-group">
                    <span class="input-group-addon">网址</span>
                    <input type="text" id="url" name="url" class="form-control from" style="max-width:450px;" placeholder="{{ env('APP_URL') }}" value="{{ env('APP_URL') }}">{{ csrf_field() }}
                    &nbsp;&nbsp;<button type="submit" name="generate" class="btn btn-primary format">创建并下载</button>
                </div>
        </form>
    </div>
</div>

@stop