@extends('layout')

@section('meta')
<meta name="keywords" content="JSON,JSON在线,json解析, json在线解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化, json在线,json 在线验证,json 在线校验">
<meta name="description" content="json解析,json在线解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
@stop

@section('head_css')
    <link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bdsstyle.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <span>json格式化校验工具</span>
        {{--<a style="color:green;" href="/donate">赞助名单</a>--}}
        <span style="margin-left: 20px;"></span>
    </div>

    <div class="panel-body">

        <textarea style="width: 100%; outline:none;" rows="20" id="json_input" spellcheck="false" placeholder='请输入需要校验的json字符串'></textarea>

        <div style="height: 10px;"></div>

        <button type="button" class="btn btn-primary format variable">校验</button>&nbsp;&nbsp;
        <button type="reset" class="btn btn-outline btn-danger clear">清空</button>

        <span style="padding-left:15px;">&nbsp;&nbsp;试试:&nbsp;&nbsp;
            <a href="/json/parser/?f=1" target="_blank">JSON在线视图</a>&nbsp;&nbsp;
            <a href="/json/format/?f=1" target="_blank">JSON格式化高亮</a>&nbsp;&nbsp;
        </span>

        <div style="height: 10px;"></div>
        <pre class="v-result alert" style="display:none;"></pre>

    </div>
</div>


<div class="alert alert-info" role="alert">
    <p><strong>网站地图</strong></p>
    <p>JSON相关:
        <a href="/" class="alert-link">JSON格式化校验</a>
        <a href="/json/poster" class="alert-link">Poster</a>
        <a href="/json/parser" class="alert-link">JSON在线视图</a>
        <a href="/json/format" class="alert-link">JSON格式化高亮</a>
    </p>

    <p>HTML相关:
        <a href="/format/xml" class="alert-link">XML格式化工具</a>
        <a href="/format/js" class="alert-link">HTML/JS格式化</a>
        <a href="/format/css" class="alert-link">CSS压缩/格式化</a>
        <a href="/format/sql" class="alert-link">SQL格式化</a>
    </p>

    <p>转换工具:
        <a href="/convert/time" class="alert-link">Unix时间戳</a>
        <a href="/convert/url" class="alert-link">URL编码/解码</a>
        <a href="/convert/markdown" class="alert-link">Markdown编辑器</a>
        <a href="/convert/n2a" class="alert-link">Native/Asscii编码互转</a>
        <a href="/convert/hex" class="alert-link">任意进制转换</a>
        <a href="/convert/rgb" class="alert-link">色值转换工具</a>
        <a href="/convert/togglecase" class="alert-link">字母大小写转换</a>
        <a href="/convert/cn_tw" class="alert-link">中文简体繁体转换</a>
    </p>

    <p>加密/解密:
        <a href="/encrypt/md5" class="alert-link">MD5加密</a>
        <a href="/encrypt/base64" class="alert-link">Base64</a>
        <a href="/encrypt/openssl_encode" class="alert-link">Openssl加密工具</a>
        <a href="/encrypt/openssl_decode" class="alert-link">Openssl解密工具</a>
        <a href="/encrypt/hash" class="alert-link">在线Hash计算工具</a>
    </p>
    <p>常用对照表:
        <a href="/tables/rgb" class="alert-link">RGB颜色对照表</a>
        <a href="/tables/httpstatus" class="alert-link">HTTP状态码表</a>
        <a href="/tables/httpheader" class="alert-link">HTTP请求头大全</a>
        <a href="/tables/httpmethod" class="alert-link">HTTP请求方法</a>
        <a href="/tables/androidmanifest" class="alert-link">Android Manifest描述大全</a>
        <a href="/tables/geo" class="alert-link">国家代码与区号查询</a>
    </p>
    <p>常用工具:
        <a href="/tools/wordcount" class="alert-link">字数计算</a>
        <a href="/tools/regex" class="alert-link">正则测试</a>
        <a href="/convert/qr/" class="alert-link">二维码生成</a>
        <a href="/encrypt/uuid" class="alert-link">UUID在线生成</a>
        <a href="/tools/shortcut" class="alert-link">网址快捷方式</a>
        <a href="/tools/screenshot" class="alert-link">网页截图</a>
        <a href="/tools/downpage" class="alert-link">网页模版下载</a>
    </p>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery-linedtextarea.js') }}"></script>
<script src="{{ asset('js/jsl.format.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsl.parser.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsoninit.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        jsl.interactions.init('json_input');
    });
</script>
@stop