@extends('layout')

@section('meta')
<meta name="keywords" content="xml在线格式化,xml在线格式化, html在线格式化,js代码格式化">
<meta name="description" content="可以对xml进行格式化排版，整齐的进行显示。">
@stop

@section('title')
XML压缩格式化 - 在线JSON校验格式化工具(OK JSON), json解析,json格式化,json 在线校验
@stop



@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        XML格式化、压缩
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p><code>[XML格式化]</code>，<code>[XML压缩]</code>，<code>[XML美化]</code>，本工具针对 <code>XML</code>做格式化、美化处理。</p>
        </div>
        <button type="button" class="btn btn-primary format pretty">美化</button>
        &nbsp;&nbsp;
        <button type="button" class="btn btn-primary format minimize">压缩</button>
        &nbsp;&nbsp;
        <button type="button" class="btn btn-primary format eg">给个例子</button>
        <div style="height: 10px"></div>
        <div class="form-group">
            {{--<label>XML</label>--}}
            <textarea class="form-control data" rows="10" placeholder="请输入要处理的xml"></textarea>
        </div>

    </div>
</div>

@stop





@section('foot_js')
<script src="{{ asset('js/jquery.format.js') }}"></script>

<script type="text/javascript">
    (function(){
        $(".pretty").on('click', function(){
            $(".data").format({method: 'xml'});
        });
        $(".minimize").on('click', function(){
            $(".data").format({method: 'xmlmin'});
        });
        $(".eg").on('click', function(){
            var xml = '%3C%3Fxml%20version%3D%221.0%22%3F%3E%3Cnote%3E%3Cto%3EGeorge%3C%2Fto%3E%3Cfrom%3EJohn%3C%2Ffrom%3E%3Cheading%3EReminder%3C%2Fheading%3E%3Cbody%3Ewww.608558.com%3C%2Fbody%3E%3C%2Fnote%3E';
            $(".data").val(decodeURIComponent(xml));
        });
    })()
</script>
@stop