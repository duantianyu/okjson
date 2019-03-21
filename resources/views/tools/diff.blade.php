@extends('layout')

@section('meta')
<meta name="keywords" content="在线对比,比较,对比工具,比较工具,文本对比,代码对比,差异检测,diffuse - 在线JSON校验格式化工具">
<meta name="description" content="本工具可以方便大家快速对比两个文本/代码中的不同之处。">
@stop

@section('title')
文本对比 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/diff.css') }}" rel="stylesheet">
@stop


@section('content')
@include('tools.tab')
    <div class="panel panel-default">
    <div class="panel-heading">
        文本对比
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <p>快速对比两个文本/代码中的不同之处</p>
        </div>


        <div class="wwlr auto">
            <!--GuoLvWrap-begin-->
            <div class="clearfix " id="txtcontents">
                    <textarea class="fl form-control diff-con" id="original" placeholder="文本一" rows="15"></textarea>
                    <textarea class="fr form-control diff-con diff-con-r" id="edited" placeholder="文本二" rows="15"></textarea>
            </div>
            <div style="height: 10px"></div>
                    <input type="button" id="diffuse" value="开始比较" class="btn btn-primary format variable se-btn">
                    <input type="button" value="清空" id="clear" class="btn btn-warning">
            <div style="height: 10px"></div>

            <!--GuoLvWrap-end-->
            <div id="result">
                <div class="pr JsTxtW-r fl">
                    <pre id="original_result"><code></code></pre>
                </div>
                <div class="pr JsTxtW-r ml20 fr">
                    <pre id="edited_result"><code></code></pre>
                </div>
            </div>

        </div>

    </div>
</div>
@stop


@section('foot_js')
<script type="text/javascript" src="{{ asset('js/diff/LineDiff.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/EditSet.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/LineUtils.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/Diff.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/DiffFormatter.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/LineFormatter.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/AnchorIterator.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/highlight.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/diff/do.js') }}"></script>
@stop