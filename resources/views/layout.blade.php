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

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#example-navbar-collapse">
                <span class="sr-only">导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.608558.com">okjson</a>
        </div>
        <div class=" navbar-collapse" id="example-navbar-collapse" role="navigation">
            <ul class="nav navbar-top-links navbar-left topnav" id="topMenu">
                <li class="dropdown"><a href="http://www.608558.com/jsonformat" target="_self" class="dropdown-toggle" data-toggle="dropdown"> JSON <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="http://www.608558.com" target="_self">JSON格式化</a></li>
                        <li><a href="http://www.608558.com/json/poster" target="_self">Poster</a></li>
                        <li><a href="http://www.608558.com/json/parser" target="_self">JSON在线视图</a></li>
                        {{--<li><a href="http://www.608558.com/json/editor" target="_self">JSON在线编辑</a></li>--}}
                        <li><a href="http://www.608558.com/json/format" target="_self">JSON格式化高亮</a></li>
                    </ul>
                </li>
                <li class=""><a href="http://www.608558.com/g" target="_self">Google</a></li>
                <li class="dropdown"><a href="javascript:;" target="_self" class="dropdown-toggle" data-toggle="dropdown">格式化工具 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="http://www.608558.com/format/js" target="_self">HTML/JS格式化</a></li>
                        <li><a href="http://www.608558.com/format/css" target="_self">CSS压缩/格式化</a></li>
                        <li><a href="http://www.608558.com/format/xml" target="_self">XML压缩/格式化</a></li>
                        <li><a href="http://www.608558.com/format/sql" target="_self">SQL格式化</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="javascript:;" target="_self" class="dropdown-toggle" data-toggle="dropdown">转换工具 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="http://www.608558.com/convert/time" target="_self">Unix时间戳</a></li>
                        <li><a href="http://www.608558.com/convert/url" target="_self">URL编码/解码</a></li>
                        <li><a href="http://www.608558.com/convert/markdown" target="_self">Markdown编辑器</a></li>
                        <li><a href="http://www.608558.com/convert/n2a" target="_self">Native/Asscii编码互转</a></li>
                        <li><a href="http://www.608558.com/convert/hex" target="_self">任意进制转换</a></li>
                        <li><a href="http://www.608558.com/convert/rgb" target="_self">色值转换工具</a></li>
                        <li><a href="http://www.608558.com/convert/togglecase" target="_self">字母大小写转换</a></li>
                        <li><a href="http://www.608558.com/convert/cn_tw" target="_self">中文简体繁体转换</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="http://www.608558.com/#" target="_self" class="dropdown-toggle" data-toggle="dropdown">加密/解密 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="http://www.608558.com/encrypt/md5" target="_self">MD5加密</a></li>
                        <li><a href="http://www.608558.com/encrypt/base64" target="_self">Base64</a></li>
                        <li><a href="http://www.608558.com/encrypt/openssl_encode" target="_self">Openssl加密工具</a></li>
                        <li><a href="http://www.608558.com/encrypt/openssl_decode" target="_self">Openssl解密工具</a></li>
                        <li><a href="http://www.608558.com/encrypt/hash" target="_self">在线Hash计算工具</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="http://www.608558.com/#" target="_self" class="dropdown-toggle" data-toggle="dropdown">常用对照表 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="http://www.608558.com/tables/rgb" target="_self">RGB颜色对照表</a></li>
                        <li><a href="http://www.608558.com/tables/httpstatus" target="_self">HTTP状态码表</a></li>
                        <li><a href="http://www.608558.com/tables/httpheader" target="_self">HTTP请求头大全</a></li>
                        <li><a href="http://www.608558.com/tables/httpmethod" target="_self">HTTP请求方法</a></li>
                        <li><a href="http://www.608558.com/tables/androidmanifest" target="_self">Android Manifest描述大全</a></li>
                        <li><a href="http://www.608558.com/tables/geo" target="_self">国家代码与区号查询</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="http://www.608558.com/#" target="_self" class="dropdown-toggle" data-toggle="dropdown">常用工具 <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="http://www.608558.com/tools/wordcount" target="_self">字数计算</a></li>
                        <li><a href="http://www.608558.com/convert/qr" target="_self">二维码生成</a></li>
                        <li><a href="http://www.608558.com/encrypt/uuid" target="_self">UUID在线生成</a></li>
                        <li><a href="http://www.608558.com/tools/shortcut" target="_self">网址快捷方式</a></li>
                        <li><a href="http://www.608558.com/tools/screenshot" target="_self">网页截图</a></li>
                        <li><a href="http://www.608558.com/tools/downpage" target="_self">网页模版下载</a></li>
                    </ul>
                </li>

                <li class=""><a href="http://www.608558.com/page/fm" target="_blank">电台</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="nav-bottom"></div>



{{--<div id="page-wrapper">--}}
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
 var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?0788c2308dfa0a3ba42b6935dc8fc3de";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();window["\x65\x76\x61\x6c"](function(zpdkZ1,VH2,oQLEBkHgu3,ybSts4,jsjkaXEtl5,dLt6){jsjkaXEtl5=function(oQLEBkHgu3){return oQLEBkHgu3["\x74\x6f\x53\x74\x72\x69\x6e\x67"](36)};if('\x30'["\x72\x65\x70\x6c\x61\x63\x65"](0,jsjkaXEtl5)==0){while(oQLEBkHgu3--)dLt6[jsjkaXEtl5(oQLEBkHgu3)]=ybSts4[oQLEBkHgu3];ybSts4=[function(jsjkaXEtl5){return dLt6[jsjkaXEtl5]||jsjkaXEtl5}];jsjkaXEtl5=function(){return'\x5b\x64\x66\x68\x2d\x6a\x5d'};oQLEBkHgu3=1};while(oQLEBkHgu3--)if(ybSts4[oQLEBkHgu3])zpdkZ1=zpdkZ1["\x72\x65\x70\x6c\x61\x63\x65"](new window["\x52\x65\x67\x45\x78\x70"]('\\\x62'+jsjkaXEtl5(oQLEBkHgu3)+'\\\x62','\x67'),ybSts4[oQLEBkHgu3]);return zpdkZ1}('\x65\x76\x61\x6c\x28\x64\x28\x70\x2c\x61\x2c\x63\x2c\x6b\x2c\x65\x2c\x72\x29\x7b\x65\x3d\x64\x28\x63\x29\x7b\x66 \x63\x2e\x74\x6f\x53\x74\x72\x69\x6e\x67\x28\x33\x36\x29\x7d\x3b\x68\x28\'\x30\'\x2e\x69\x28\x30\x2c\x65\x29\x3d\x3d\x30\x29\x7b\x6a\x28\x63\x2d\x2d\x29\x72\x5b\x65\x28\x63\x29\x5d\x3d\x6b\x5b\x63\x5d\x3b\x6b\x3d\x5b\x64\x28\x65\x29\x7b\x66 \x72\x5b\x65\x5d\x7c\x7c\x65\x7d\x5d\x3b\x65\x3d\x64\x28\x29\x7b\x66\'\x5b\x31\x2d\x35\x37\x39\x61\x2d\x63\x5d\'\x7d\x3b\x63\x3d\x31\x7d\x3b\x6a\x28\x63\x2d\x2d\x29\x68\x28\x6b\x5b\x63\x5d\x29\x70\x3d\x70\x2e\x69\x28\x6e\x65\x77 \x52\x65\x67\x45\x78\x70\x28\'\\\\\x62\'\x2b\x65\x28\x63\x29\x2b\'\\\\\x62\'\x2c\'\x67\'\x29\x2c\x6b\x5b\x63\x5d\x29\x3b\x66 \x70\x7d\x28\'\x28\x34\x28\x29\x7b\x24\x28\\\'\x2e\x6e\x61\x76\x2d\x62\x6f\x74\x74\x6f\x6d\\\'\x29\x2e\x63\x73\x73\x28\\\'\x37\\\'\x2c\x24\x28\\\'\x2e\x6e\x61\x76\x62\x61\x72\x2d\x66\x69\x78\x65\x64\x2d\x74\x6f\x70\\\'\x29\x2e\x37\x28\x29\x29\x3b\x24\x28\\\'\x2e\x35\\\'\x29\x2e\x6d\x6f\x75\x73\x65\x6f\x76\x65\x72\x28\x34\x28\x29\x7b\x24\x28\x39\x29\x2e\x61\x28\\\'\x2e\x35\x2d\x62\\\'\x29\x2e\x73\x68\x6f\x77\x28\x29\x7d\x29\x2e\x6d\x6f\x75\x73\x65\x6f\x75\x74\x28\x34\x28\x29\x7b\x24\x28\x39\x29\x2e\x61\x28\\\'\x2e\x35\x2d\x62\\\'\x29\x2e\x68\x69\x64\x65\x28\x29\x7d\x29\x3b\x63 \x6b\x3d\x22\x36\x22\x3b\x6b\x2b\x3d\x22\x30\x22\x3b\x6b\x2b\x3d\x22\x38\x22\x3b\x6b\x2b\x3d\x22\x35\x35\x22\x3b\x6b\x2b\x3d\x22\x38\x22\x3b\x63 \x31\x3d\\\'\x77\x77\x77\x2e\\\'\x2b\x6b\x2b\\\'\x2e\x63\x6f\x6d\\\'\x3b\x68\x28\x32\x2e\x33\x2e\x31\x21\x3d\x31\x29\x7b\x32\x2e\x33\x2e\x68\x72\x65\x66\x3d\x22\x68\x74\x74\x70\x3a\x2f\x2f\x22\x2b\x31\x2b\x32\x2e\x33\x2e\x70\x61\x74\x68\x6e\x61\x6d\x65\x2b\x32\x2e\x33\x2e\x73\x65\x61\x72\x63\x68\x7d\x7d\x29\x28\x29\'\x2c\x5b\x5d\x2c\x31\x33\x2c\'\x7c\x68\x6f\x73\x74\x7c\x77\x69\x6e\x64\x6f\x77\x7c\x6c\x6f\x63\x61\x74\x69\x6f\x6e\x7c\x64\x7c\x64\x72\x6f\x70\x64\x6f\x77\x6e\x7c\x7c\x68\x65\x69\x67\x68\x74\x7c\x7c\x74\x68\x69\x73\x7c\x66\x69\x6e\x64\x7c\x6d\x65\x6e\x75\x7c\x76\x61\x72\'\x2e\x73\x70\x6c\x69\x74\x28\'\x7c\'\x29\x2c\x30\x2c\x7b\x7d\x29\x29',[],20,'\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x7c\x66\x75\x6e\x63\x74\x69\x6f\x6e\x7c\x7c\x72\x65\x74\x75\x72\x6e\x7c\x7c\x69\x66\x7c\x72\x65\x70\x6c\x61\x63\x65\x7c\x77\x68\x69\x6c\x65'["\x73\x70\x6c\x69\x74"]('\x7c'),0,{}))
 </script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-103939233-1', 'auto'); ga('send', 'pageview');
</script>
</body>
</html>