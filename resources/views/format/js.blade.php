@extends('layout')

@section('meta')
<meta name="keywords" content="js在线格式化,javascript在线格式化,html在线格式化,js代码格式化">
<meta name="description" content="可以对javascript/js，HTML进行格式化排版，整齐的进行显示。">
@stop


@section('title')
HTML/JS压缩格式化 - 在线JSON校验格式化工具(OK JSON), json解析,json格式化,json 在线校验
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
@include('format.tab')


<div class="panel panel-default">
    <div class="panel-heading">
        JavaScript/HTML格式化
    </div>
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p><code>[JavaScript/HTML格式化]</code>，<code>[JavaScript/HTML压缩]</code>，<code>[JavaScript/HTML美化]</code>，本工具针对 <code>JavaScript/HTML</code>做格式化、美化处理。</p>
        </div>
        <form class="form-inline">

            <select id="tabsize" class="form-control">
                <option value="1">制表符缩进</option>
                <option value="2">2个空格缩进</option>
                <option value="4" selected="selected">4个空格缩进</option>
                <option value="8">8个空格缩进</option>
            </select>
            <input class="btn btn-primary format b1" value="格式化" onclick="return do_js_beautify()" id="beautify" type="button">

            <input class="btn btn-primary format b1" value="普通压缩" onclick="pack_js(0)" type="button">
            <input class="btn btn-primary format b1" value="* 加密压缩 *" onclick="pack_js(1)" type="button">
            <button type="button" class="btn btn-success" id="copy" data-clipboard-action="copy" data-clipboard-target="#content">复制结果</button>
            <input class="btn btn-primary format clear" value="清空结果" type="button">

            <div style="height: 10px"></div>

        </form>
        <textarea id="content" class="form-control" name="content" rows="10" placeholder="请输入需要处理的javascript/HTML"></textarea>
        <div style="height: 10px"></div>
        <p id="message"></p>

    </div>
</div>
    
@stop





@section('foot_js')
<script src="{{ asset('js/jsformat/base.js') }}"></script>
<script src="{{ asset('js/jsformat/jsformat.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsformat/jsformat2.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsformat/htmlformat.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/lib/clipboard/clipboard.min.js') }}"></script>
<script type="text/javascript">
    function do_js_beautify() {
        document.getElementById('beautify').disabled = true;
        js_source = document.getElementById('content').value.replace(/^\s+/, '');
        tab_size = document.getElementById('tabsize').value;
        tabchar = ' ';
        if (tabsize == 1) {
            tabchar = '\t';
        }
        if (js_source && js_source.charAt(0) === '<') {
            document.getElementById('content').value = style_html(js_source, tab_size, tabchar, 80);
        } else {
            document.getElementById('content').value = js_beautify(js_source, tab_size, tabchar);
        }
        document.getElementById('beautify').disabled = false;
        return false;
    }
    function pack_js(base64) {
        var input = document.getElementById('content').value;
        var packer = new Packer;
        if (base64) {
            var output = packer.pack(input, 1, 0);
        } else {
            var output = packer.pack(input, 0, 0);
        }
        document.getElementById('content').value = output;
    }
    function copy() {
        var Result = $('#content').val();
        if (Result != '') {
            window.clipboardData.setData("Text", Result);
            document.getElementById('content').select();
            window.alert('已复制成功！');
        }
    }
    $('.clear').click(function () {
        $('#content').val('');
        $('#content').focus('');
    });
    function GetFocus() {
        $('#content').focus('');
    }
    // 复制相关的处理
    var clipboard = new Clipboard('#copy');
    clipboard.on('success', function(e) {
        showmsg("success", "复制成功")
        e.clearSelection();
    });
    clipboard.on('error', function(e) {
        showmsg("danger", "复制失败，请手动复制")
    });
    function showmsg(type, msg) {
        $('#message').hide().removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg).show(100);
    }
</script>

@stop