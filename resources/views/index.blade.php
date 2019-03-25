@extends('layout')

@section('meta')
<meta name="keywords" content="JSON,JSON在线,json解析, json在线解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化, json在线,json 在线验证,json 在线校验">
<meta name="description" content="json解析,json在线解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
@stop

@section('head_css')
    <link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <span>json格式化校验工具</span>
        {{--<a style="color:green;" href="/donate">赞助名单</a>--}}
        <span style="margin-left: 20px;"></span>
    </div>

    <div class="panel-body">

        <textarea style="width: 100%; outline:none;" rows="28" id="json_input" spellcheck="false" placeholder='请输入需要校验的json字符串'></textarea>

        <div style="height: 10px;"></div>

        <button type="button" class="btn btn-primary format variable">校验</button>&nbsp;&nbsp;
        <button type="reset" class="btn btn-outline btn-danger clear">清空</button>

        <span style="padding-left:15px;">&nbsp;&nbsp;试试:&nbsp;&nbsp;
            <a href="/json/parser/?f=1" target="_blank">JSON在线视图</a>&nbsp;&nbsp;
            <a href="/json/format/?f=1" target="_blank">JSON格式化高亮</a>&nbsp;&nbsp;
            <a href="/json/poster">Poster</a>
        </span>

        <div style="height: 10px;"></div>
        <pre class="v-result alert" style="display:none;"></pre>

    </div>
</div>


<div class="well map-div">
    <p align="center"><strong>网站地图</strong></p>
    <p>JSON相关</p>
    <div class="map">
        <a href="/">JSON格式化校验</a>
        <a href="/json/poster">Poster</a>
        <a href="/json/parser">JSON在线视图</a>
        <a href="/json/format">JSON格式化高亮</a>
    </div>

    <p>HTML相关</p>
    <div class="map">
        <a href="/format/xml">XML格式化工具</a>
        <a href="/format/js">HTML/JS格式化</a>
        <a href="/format/css">CSS压缩/格式化</a>
        <a href="/format/sql">SQL格式化</a>
    </div>

    <p>转换工具</p>
    <div class="map">
        <a href="/convert/time">Unix时间戳</a>
        <a href="/convert/url">URL编码/解码</a>
        <a href="/convert/markdown">Markdown编辑器</a>
        <a href="/convert/n2a">Native/Asscii编码互转</a>
        <a href="/convert/hex">任意进制转换</a>
        <a href="/convert/rgb">色值转换工具</a>
        <a href="/convert/togglecase">字母大小写转换</a>
        <a href="/convert/cn_tw">中文简体繁体转换</a>
    </div>

    <p>加密/解密</p>
    <div class="map">
        <a href="/encrypt/md5">MD5加密</a>
        <a href="/encrypt/base64">Base64</a>
        <a href="/encrypt/openssl_encode">Openssl加密工具</a>
        <a href="/encrypt/openssl_decode">Openssl解密工具</a>
        <a href="/encrypt/hash">在线Hash计算工具</a>
    </div>
    <p>常用对照表</p>
    <div class="map">
        <a href="/tables/rgb">RGB颜色对照表</a>
        <a href="/tables/httpstatus">HTTP状态码表</a>
        <a href="/tables/httpheader">HTTP请求头</a>
        <a href="/tables/httpmethod">HTTP请求方法</a>
        <a href="/tables/androidmanifest">Android Manifest描述</a>
        <a href="/tables/geo">国家代码与区号查询</a>
    </div>
    <p>常用工具</p>
    <div class="map">
        <a href="/tools/wordcount">字数计算</a>
        <a href="/tools/regex">正则测试</a>
        <a href="/tools/qr/">二维码生成</a>
        <a href="/tools/uuid">UUID在线生成</a>
        <a href="/tools/shortcut">网址快捷方式</a>
        <a href="/tools/screenshot">网页截图</a>
        <a href="/tools/downpage">网页模版下载</a>
        <a href="/tools/g">Google搜索</a>
        <a href="/tools/ip">IP查询</a>
        <a href="/tools/diff">文本对比</a>
    </div>
    <p>验证码</p>
    <div class="map">
        <a href="/tools/verify">验证码</a>
    </div>
    <p>常识</p>
    <div class="map">
        <a href="/cs/for_short">简称</a>
    </div>
    <p>电台</p>
    <div class="map">
        <a href="/page/fm">电台</a>
    </div>

</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery-linedtextarea.js') }}"></script>
<script src="{{ asset('js/jsl.format.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsl.parser.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsoninit.js') }}" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
    $('#json_input').val(sessionStorage.getItem("jsonCon"));
    jsl.interactions.init('json_input');
});
</script>
@stop