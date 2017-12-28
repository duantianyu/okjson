@extends('layout')

@section('meta')
<meta name="keywords" content="Markdown在线编辑器">
<meta name="description" content="在线JSON校验格式化工具(OK JSON), Markdown在线编辑器">
@stop

@section('title')
Markdown在线编辑器 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/markdown-style.css') }}" rel="stylesheet" type="text/css">
<style type="text/css">
.table>tbody>tr>td{padding:2px;}
.help-info{top:1%;right:0.5%;position: absolute;}
</style>
@stop


@section('content')
@include('convert.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        Markdown在线编辑器
        <div class="text-right" style="float: right; width: 150px;">
            <a href="javascript:;" class="help-tips" title="提示"><i class="fa fa-info-circle fa-2x"></i></a>&nbsp;&nbsp;
            <a href="javascript:;" class="download" title="下载"><i class="fa fa-cloud-download fa-2x"></i></a>&nbsp;&nbsp;
            <a href="javascript:;" class="clearpage" title="清空"><i class="fa fa-trash-o fa-2x clearpage"></i></a>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <textarea class="form-control editer" placeholder="请在此编辑" rows="40"></textarea>
            </div>
            <div class="col-sm-6 preview"></div>
        </div>

    </div>
</div>
<!-- markdown help-->
<div class="help-wrapper">
    <div class="close help-info"><i class="fa fa-times-circle-o"></i></div>
    <table class="table table-bordered" style="margin-bottom:0">
        <tr>
            <td>
                <span class="symbol"># ## ...</span>>
                <span class="info">h1 h2 ...</span>
            </td>
            <td>
                <span class="symbol">*text*</span>>
                <span class="info">Italic</span>
            </td>
            <td>
                <span class="symbol">1. text 2. text</span>>
                <span class="info">List</span>
            </td>
            <td>
                <span class="symbol">`code`</span>>
                <span class="info">In-line code</span>
            </td>
        </tr>
        <tr>
            <td>
                <span class="symbol">[text](https://link)</span>>
                <span class="info">Link</span>
            </td>
            <td>
                <span class="symbol">**text**</span>>
                <span class="info">Bold</span>
            </td>
            <td>
                <span class="symbol">+ bla + bla</span>>
                <span class="info">List</span>
            </td>
            <td>
                <span class="symbol">***</span>>
                <span class="info">Horizontal Rule</span>
            </td>
        </tr>
        <tr>

            <td>
                <span class="symbol">![alt text](link)</span>>
                <span class="info">Image</span>
            </td>
            <td>
                <span class="symbol">~~text~~</span>>
                <span class="info">Strikethrough</span>
            </td>
            <td>
                <span class="symbol">> text</span>>
                <span class="info">Text quote</span>
            </td>
            <td style="text-align: center;">
                <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">more...</a>
            </td>
        </tr>
    </table>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/markdown/Markdown.Converter.js') }}"></script>
<script src="{{ asset('js/markdown/Markdown.Sanitizer.js') }}"></script>
<script src="{{ asset('js/markdown/Markdown.Extra.js') }}"></script>
<script src="{{ asset('js/markinit.js') }}"></script>
<script type="text/javascript">
(function () {
    $('body').css('padding-bottom', $('.help-wrapper').height() + 'px');
    $('.close').click(function () {
        $('body').css('padding-bottom', '10px');
    });
})();
</script>
@stop