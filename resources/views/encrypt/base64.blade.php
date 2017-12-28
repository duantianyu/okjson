@extends('layout')

@section('meta')
<meta name="keywords" content="base64在线加密,base64在线解密,base64在线破解">
<meta name="description" content="KJSON提供在线base64加密解密服务">
@stop

@section('title')
Base64加密、Base64解密 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
@include('encrypt.tab')
<div class="panel panel-default">
    <div class="panel-heading">
        Base64加密、解密
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="form-group">
            <label>Encode:</label>
            <textarea id="encode" class="form-control data" placeholder="请在这里输入要加密的内容" rows="8"></textarea>
        </div>

        <div>
            <button type="button" class="btn btn-primary format btn-encode">加密 ▽</button>
            <button type="button" class="btn btn-primary format btn-decode">解密 △</button>
            <button type="button" class="btn btn-outline btn-danger btn-clear">清空</button>
        </div>

        <div class="form-group">
            <label>Decode:</label>
            <textarea id="decode" class="form-control data" placeholder="请在这里输入要解密的内容" rows="8"></textarea>
        </div>
        <div class="tips">

        </div>
        <div class="alert alert-success" role="alert">
            <ol>
                <li>转换规则：进行Base64转换的时候，将3个byte（3*8bit = 24bit）的数据，先后放入一个24bit的缓冲区中，先来的byte占高位。数据不足3byte的话，于缓冲器中剩下的bit用0补足。然后，每次取出6个bit（24/6 = 4），因为2^6=64，按照其值选择<code>ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/</code>这64个字符中对应的字符作为编码后的输出。不断进行，直到全部输入数据转换完成。当原数据长度不是3byte的整数倍时, 如果最后剩下1个输入数据，在编码结果后加2个“<code>=</code>”；如果最后剩下2个输入数据，编码结果后加1个“<code>=</code>”；如果没有剩下任何数据，就什么都不要加。</li>
                <li>Base64编码后的数据比原始数据略长，长度约为原来的4/3。</li>
                <li>Base64编码对同一字符在不同的编码下结果可能不同。</li>
                <li>因为编码后的<code>+/=</code>字符，标准的Base64并不适合直接放在URL里传输，有一些Base64的变种，它们将<code>+/</code>等符号转换为其他符号（如<code>_-</code>），这样就能安全的在URL中传输（Url Safe）了。</li>
            </ol>
        </div>
    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/lib/jquery.base64.js') }}" type="text/javascript"></script>
<script type="text/javascript">
(function(){
    var dec = $("#decode"),
        enc = $('#encode');

    $.base64.utf8encode = !0;

    var en = function(){
        dec.val( $.base64.btoa(enc.val()) );
    };
    var de = function(){
        enc.val( $.base64.atob(dec.val(), true) );
    };

    enc.keyup(function(){
        en();
    });
    dec.keyup(function(){
        de();
    });

    $(".btn-encode").click(function(){
        en();
    });
    $(".btn-decode").click(function(){
        de();
    });
    $(".btn-clear").click(function(){
        dec.val('');
        enc.val('');
    });

})();
</script>

@stop