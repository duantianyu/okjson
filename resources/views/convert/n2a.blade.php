@extends('layout')

@section('meta')
<meta name="keywords" content="native,ascii,native2ascii,NATIVE/ASCII编码,NATIVE/ASCII编码互转">
<meta name="description" content="主要用于各类代码中各类本地字符的Unicode转换。\u开头+数字的编码是叫Unicode编码，原理:获得输入框里的值，然后逐个转换为unicode编码（这个返回值是 0 – 65535 之间的整数），unicode转化为16进制,再添加上”\u”前缀。">
@stop

@section('title')
Native/Asscii编码互转 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<style type="text/css">
.a1 { float: left;}
.a2 { margin-left: 10px; height: 45px; line-height: 45px; margin-right: 10px; vertical-align: middle;
    text-align: center;}
.a1 textarea {width: 370px;}
</style>
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Native/Asscii编码互转
    </div>
    <div class="panel-body">
        <div class="form-group a1">
            <label>NATIVE</label>
            <textarea class="form-control d1" placeholder="请输入要转换的字符串" rows="10"></textarea>
        </div>

        <div class="form-group a1 a2">
            <label for="ignoreLetter"> <input type="checkbox" name="ignoreLetter" id="ignoreLetter">
            <span class="pl5">不转换字母和数字</span></label>
            <br/>
            <button type="button" class="btn btn-primary format b1">→</button>
            <br/>
            <button type="button" class="btn btn-primary format b2">←</button>
        </div>

        <div class="form-group a1">
            <label>ASSCII</label>
            <textarea class="form-control d2" placeholder="请输入要转换的ASCII代码" rows="10"></textarea>
        </div>

    </div>
</div>

@stop


@section('foot_js')
<script type="text/javascript">
    (function(){
        function nativeConvertAscii(value, opts) {
            var nativecode = value.split("");
            var ascii = "";
            for (var i = 0; i < nativecode.length; i++) {
                var code = Number(nativecode[i].charCodeAt(0));
                if (!document.getElementById("ignoreLetter").checked || code > 127) {
                    var charAscii = code.toString(16);
                    charAscii = new String("0000").substring(charAscii.length, 4) + charAscii;
                    ascii += "\\u" + charAscii;
                } else {
                    ascii += nativecode[i];
                }
            }

            return ascii;
        }

        function asciiConvertNative(value) {
            var asciicode = value.split("\\u");
            var nativeValue = asciicode[0];
            for (var i = 1; i < asciicode.length; i++) {
                var code = asciicode[i];
                nativeValue += String.fromCharCode(parseInt("0x" + code.substring(0, 4)));
                if (code.length > 4) {
                    nativeValue += code.substring(4, code.length);
                }
            }
            return nativeValue;
        }

        $(".b1").on('click', function(){
            $(".d2").val( nativeConvertAscii($(".d1").val(), {'ignoreLetter': true}) );
        });

        $(".b2").on('click', function(){
            $(".d1").val( asciiConvertNative($(".d2").val()) );
        });

    })()
</script>
@stop