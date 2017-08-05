@extends('layout')

@section('meta')
<meta name="keywords" content="字母大小写转换,英文字母大小写转换工具">
<meta name="description" content="字母大小写转换工具，可以方便快速的转换字母的大小写。">
@stop

@section('title')
字母大小写转换工具 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        字母大小写转换工具
    </div>
    <div class="panel-body">
        <button type="button" class="btn btn-primary format toLowerCase">转换成小写</button>
        <button type="button" class="btn btn-primary format toUpperCase">转换成大写</button>
        <button type="button" class="btn btn-primary format toUpperLowerCase">大小写互转</button>
        <div style="height: 10px;"></div>
        <textarea id="content" name="content" class="form-control" rows="8">www.608558.com</textarea>
    </div>
</div>
@stop


@section('foot_js')
<script type="text/javascript">
(function(){
    $("button").on('click', function(){
        var text = $("#content").val();
        if(text){
            if($(this).hasClass('toLowerCase')){
                $("#content").val(text.toLowerCase());
            }else if($(this).hasClass('toUpperCase')){
                $("#content").val(text.toUpperCase());
            }else if($(this).hasClass('toUpperLowerCase')){
                var t = ''; var j;
                for (var i=0;i<text.length;i++){
                    j = text.charAt(i);
                    if(j.charCodeAt() > 90){
                        t += j.toUpperCase();
                    }else{
                        t += j.toLowerCase();
                    }
                }
                $("#content").val(t);
            }else{
                alert("出现异常，请刷新页面重试");
            }
        }
    });
})()
</script>
@stop