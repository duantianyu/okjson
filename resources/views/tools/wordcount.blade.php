@extends('layout')

@section('meta')
<meta name="description" content="本工具用于字数计算，适用于文章标题、描述、关键词的字数统计，合适的字数是页面SEO基础优化的重要组成部分。" />
<meta name="keywords" content="字数计算,字数统计,字数计算工具" />
@stop

@section('title')
字数计算工具 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default category-description">
    <div class="panel-heading">
        <div class="panel-title">字数计算工具</div>
    </div>
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p class="alert-success" id="wordCount">字数：<code>0</code></p>
        </div>

        <label class="label-margin" for="special-config">
            <input type="checkbox" id="special-config">
            <span> 此处勾选则中文算2个字，英文算1个字 </span>
        </label>

        <textarea class="form-control data" id="content"  placeholder="请在这里输入内容" rows="20"></textarea>

    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery-linedtextarea.js') }}"  type="text/javascript"></script>
<script type="text/javascript">
(function() {
    $('#content').linedtextarea();
    $('.label-margin').css('margin-bottom', '15px')
    function wordCalculate() {
        var config = $('#special-config').prop("checked");
        var content = $('#content').val();
        var wordCount = content.length;
        if (config) {
            var Chinese = content.replace(/[^\u4e00-\u9fa5]+/g, '');
            wordCount += Chinese.length;
        }
        $('#wordCount').html('字数：<code>' + wordCount + '</code>');
    }

    $("body").on('click', '#special-config', function(){
        wordCalculate();
    });

    $("body").on('keyup mouseup', '#content', function(){
        wordCalculate();
    });

    //Init
    wordCalculate();
})();
</script>
@stop