@extends('layout')

@section('meta')
<meta name="keywords" content="css在线格式化,css在线格式化, html在线格式化,js代码格式化">
<meta name="description" content="可以对css进行格式化排版，整齐的进行显示。">
@stop

@section('title')
CSS压缩格式化 - 在线JSON校验格式化工具(OK JSON), json解析,json格式化,json 在线校验
@stop



@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        CSS格式化、压缩
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p><code>[CSS格式化]</code>，<code>[CSS压缩]</code>，<code>[CSS美化]</code>，本工具针对<code>CSS语句</code>做格式化、美化处理。</p>
        </div>

        <button type="button" class="btn btn-primary format pretty">美化</button>
        &nbsp;&nbsp;
        <button type="button" class="btn btn-primary format minimize">压缩</button>
        &nbsp;&nbsp;
        <input class="btn btn-primary format clear" value="清空结果" onclick="Empty();" type="button">
        <div style="height: 10px"></div>
        <div class="form-group">
            <textarea class="form-control data" rows="10" placeholder="请输入要处理的css"></textarea>
        </div>



    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery.format.js') }}"></script>
<script type="text/javascript">
(function(){
    $(".pretty").on('click', function(){
        $(".data").format({method: 'css'});
    });
    $(".minimize").on('click', function(){
        $(".data").format({method: 'cssmin'});
    });

    $('.clear').click(function () {
        $('textarea').val('');
        $('textarea').focus('');
    });

})()
</script>
@stop