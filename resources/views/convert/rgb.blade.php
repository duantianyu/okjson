@extends('layout')

@section('meta')
<meta name="keywords" content="在线颜色选择器,RGB颜色查询对照表,HEX值,RGB与HEX转换">
<meta name="description" content="在线颜色选择器,RGB颜色查询对照表,HEX值,RGB与HEX转换">
@stop

@section('title')
在线颜色选择器|RGB颜色查询对照表|HEX值|RGB与HEX转换(OK JSON)
@stop


@section('head_css')
<link href="{{ asset('css/farbtastic.css') }}" rel="stylesheet" type="text/css">
<style type="text/css">
.well {
    width: 240px;
    background-color: #f5f5f5;
    border: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05) inset;
    margin-bottom: 20px;
    min-height: 20px;
    padding: 19px;
}
</style>
@stop


@section('content')
@include('convert.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        色值转换工具 | Color Convent
    </div>
    <div class="panel-body">
        <div class="form-inline" style="border-bottom: 1px dashed #ddd;">
            <div class="form-group input-group">
                <span class="input-group-addon">HEX</span>
                <input type="text" class="form-control fromhex" placeholder="请输入HEX值 如:#FFB6C1" value="">
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon">RGB</span>
                <input type="text" class="form-control torgb" value="">
            </div>
            <div class="hexpre" style="width:100px; height:20px;"></div>
        </div>


        <div class="form-inline" style="border-bottom: 1px dashed #ddd; margin-top:15px;">
            <div class="form-group input-group">
                <span class="input-group-addon">RGB</span>
                <input type="text" class="form-control fromrgb" placeholder="请输入RGB值 如:110,182,123" value="">
            </div>

            <div class="form-group input-group">
                <span class="input-group-addon">HEX</span>
                <input type="text" class="form-control tohex" value="">
            </div>
            <div class="rgbpre" style="width:100px; height:20px;"></div>
        </div>


        <div style="height:15px;"></div>
        <form action="" class="well form-inline" style="width:240px;align: center;">
            <div id="picker"></div>
            <div class="form-item">
                <div class="input-prepend">
                    <span class="add-on">颜色值：</span><input class="span2" type="text" id="color" name="color" value="#123456" /></span>
                </div>
            </div>
        </form>

    </div>
</div>
@stop


@section('foot_js')
<script src="{{ asset('js/farbtastic.js') }}"></script>
<script type="text/javascript">
(function(){
    (function(a){a["toRGB"]=function(a){var b=parseInt(a,16);return[b>>16,b>>8&255,b&255]};a["toHex"]=function(a,b,c){return(c|b<<8|a<<16|1<<24).toString(16).slice(1)}})(this);
    $('input').css('min-width', '220px')
    $(".fromhex").on("keyup", function(){
        var v = $(this).val();
        if(v.indexOf("#") === 0){
            v = v.replace("#", '');
        }

        $(".torgb").val(toRGB(v));

        $(".hexpre").css("background-color", "#"+ v)
    });

    $(".fromrgb").on("keyup", function(){
        var v = $(this).val(), vv="";
        v = v.split(',');
        vv = toHex(v[0], v[1], v[2]);
        $(".tohex").val('#' + vv);
        $(".rgbpre").css("background-color", "#"+ vv)
    });

    $('#picker').farbtastic('#color');

})();
</script>
@stop