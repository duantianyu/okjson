@extends('layout')

@section('meta')
<meta name="keywords" content="MD5在线加密,MD5在线解密,MD5在线破解">
<meta name="description" content="KJSON提供在线md5加密解密服务">
@stop

@section('title')
MD5加密工具 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/bdsstyle.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                md5加密工具
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="form-group input-group">
                    <span class="input-group-addon">加密前</span>
                    <input type="text" name="string" class="form-control" value="" autocomplete="off" placeholder="请输入您要加密的字符串">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">16位小写</span>
                    <input type="text" class="form-control _16" readonly="readonly">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">16位大写</span>
                    <input type="text" class="form-control _16up" readonly="readonly">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">32位小写</span>
                    <input type="text" class="form-control _32"  readonly="readonly">
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon">32位大写</span>
                    <input type="text" class="form-control _32up"  readonly="readonly">
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery.md5.js') }}" type="text/javascript"></script>
<script type="text/javascript">
(function(){
    var encode = function(){
        var str = $("input[name=string]").val();
        var res = '';
        if(str != ''){
            res = $.md5(str);
            $("._32").val(res);
            $("._32up").val(res.toUpperCase());
            $("._16").val( res.substr(8,16) );
            $("._16up").val( res.substr(8,16).toUpperCase() );
        }
    };

    $("input[name=string]").keyup(function(){
        encode();
    });

})();
</script>
@stop