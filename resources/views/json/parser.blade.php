@extends('layout')

@section('meta')
<meta name="keywords" content="JSON在线解析,JSON在线视图,JSON,JSON在线,json解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
<meta name="description" content="json解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证,JSON在线解析,JSON在线视图">
@stop

@section('head_css')
<link href="{{ asset('css/jsonparser/style.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/jsonparser/screen.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        JSON在线视图
    </div>

    <div class="panel-body" id="jsonparser">
        <div class="form-inline" style="padding: 20px 30px 0;">
            <button class="btn btn-primary format" id="beautify">美化</button>&nbsp;&nbsp;
            <button class="btn btn-primary format" id="show-types">显示类型</button>&nbsp;&nbsp;
            <button class="btn btn-primary format" id="show-indexes">显示索引</button>
        </div>

        <div class="ui-field json" id="editor" spellcheck="false" contenteditable="true">
            {"sitename":"OK JSON","siteurl":"{{ env('APP_URL') }}","keyword":"JSON在线校验,格式化JSON,json 在线校验","description":"JSON解析,json 在线校验,JSON格式化工具您要是觉得这个工具不错，请推荐给您的好友"}
        </div>

        <div class="ui-aside">
            <div class="ui-notification">
                <div class="ui-msg" id="status">
                </div>
            </div>
            {{--<div class="ui-menu">
                <div class="ui-menu-dropdown">
                    <div class="ui-menu-panel">
                        <div class="ui-menu-item ui-option" id="beautify">
                            美化
                        </div>
                        <div class="ui-menu-item ui-option" id="show-types">
                            显示类型
                        </div>
                        <div class="ui-menu-item ui-option" id="show-indexes">
                            显示索引
                        </div>

                    </div>
                </div>
            </div>--}}
            <div class="ui-treeview json" id="result">
            </div>
        </div>

    </div>
</div>
@stop


@section('foot_js')
<script src="{{ asset('js/jsonparser/script.js') }}" type="text/javascript"></script>
@stop