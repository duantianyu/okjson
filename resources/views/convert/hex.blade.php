@extends('layout')

@section('meta')
    <meta name="keywords" content="任意进制转换,JSON,JSON在线,json解析, json在线解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化, json在线,json 在线验证,json 在线校验">
    <meta name="description" content="任意进制转换,json解析,json在线解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
@stop

@section('title')
    任意进制转换 - 在线JSON校验格式化工具(OK JSON) - json在线解析|json|在线校验
@stop


@section('content')
@include('convert.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        在线任意进制转换工具
    </div>
    <div class="panel-body form-inline">

        <p>进制字符序列为：0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_@</p>

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">二进制</span>
                <input type="text" class="form-control from" dtype="2" value="1110110100010">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon">十进制</span>
                <input type="text" class="form-control to" dtype="10" value="">
            </div>
        </div>


        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">十进制</span>
                <input type="text" class="form-control from" dtype="10" value="520">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon">二进制</span>
                <input type="text" class="form-control to" dtype="2" value="">
            </div>
        </div>

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">十进制</span>
                <input type="text" class="form-control from" dtype="10" value="520">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon">十六进制</span>
                <input type="text" class="form-control to" dtype="16" value="">
            </div>
        </div>

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">十六进制</span>
                <input type="text" class="form-control from" dtype="16" value="520">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon">十进制</span>
                <input type="text" class="form-control to" dtype="10" value="">
            </div>
        </div>

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">十进制</span>
                <input type="text" class="form-control from" dtype="10" value="10520">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon">六十四进制</span>
                <input type="text" class="form-control to" dtype="64" value="">
            </div>
        </div>

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">六十四进制</span>
                <input type="text" class="form-control from" dtype="64" value="g9TJZEG">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon">十进制</span>
                <input type="text" class="form-control to" dtype="10" value="">
            </div>
        </div>


        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon"><select class="sfrom"></select>进制</span>
                <input type="text" class="form-control from" dtype="2" value="">
            </div>
            <button type="button" class="btn btn-primary format"> → </button>
            <div class="form-group input-group">
                <span class="input-group-addon"><select class="sto"></select>进制</span>
                <input type="text" class="form-control to" dtype="2" value="">
            </div>
        </div>

    </div>
</div>

@stop


@section('foot_js')

<script type="text/javascript">
(function () {
    var ss = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_@";
    $('.box').css('padding-top', '10px')
    function v10toX(n, m) {
        m = String(m).replace(/ /gi, "");
        if (m == "") {
            return ""
        }
        var a = ss.substr(0, 10);
        var b = a + ".";
        if (eval("m.replace(/[" + b + "]/gi,'')") != "") {
            M("请输入有效的进制数！");
            return ""
        }
        m = m.split(".");
        if (m.length > 2) {
            M("请输入有效的进制数！");
            return ""
        }
        var a = ss.substr(0, n);
        if (m.length == 1) {
            m = m[0];
            var t = "";
            while (m != 0) {
                var b = m % n;
                t = a.charAt(b) + t;
                m = (m - b) / n
            }
            return t
        } else {
            var m0 = m[0];
            var t = "";
            while (m0 != 0) {
                var b = m0 % n;
                t = a.charAt(b) + t;
                m0 = (m0 - b) / n
            }
            var cnt = 18;
            var m1 = m[1];
            m1 = parseFloat("0." + m1);
            var d = "",
                b = 0;
            while (m1 != 0 && cnt > 0) {
                m1 = m1 * n;
                b = parseInt(m1);
                d = d + a.charAt(b);
                m1 = m1 - b;
                cnt--
            }
            return t + "." + d
        }
    }
    function vXto10(n, m) {
        m = String(m).replace(/ /gi, "");
        if (m == "") {
            return ""
        }
        var a = ss.substr(0, n);
        var b = a + ".";
        if (eval("m.replace(/[" + b + "]/gi,'')") != "") {
            M("请输入有效的" + n + "进制数！");
            return ""
        }
        m = m.split(".");
        if (m.length > 2) {
            M("请输入有效的" + n + "进制数！");
            return ""
        }
        if (m.length == 1) {
            m = m[0];
            var t = 0,
                c = 1;
            for (var x = m.length - 1; x > -1; x--) {
                t += c * (a.indexOf(m.charAt(x)));
                c *= n
            }
            return t
        } else {
            var m0 = m[0];
            var t = 0,
                c = 1;
            for (var x = m0.length - 1; x > -1; x--) {
                t += c * (a.indexOf(m0.charAt(x)));
                c *= n
            }
            var m1 = m[1];
            var d = 0,
                c = 1 / n;
            for (var x = 0; x < m1.length; x++) {
                d += c * (a.indexOf(m1.charAt(x)));
                c /= n
            }
            return t + d
        }
    }
    function vXtoY(from, val, to) {
        a = vXto10(from * 1, val);
        if (a == "") {
            return ""
        }
        a = v10toX(to, a);
        return a
    }
    function M(b) {
        alert(b)
    }

    $(".btn-primary").on('click', function(){
        var from = $(this).parent('.box').find(".from");
        var to = $(this).parent('.box').find(".to");
        //alert(from.attr('dtype')+' ' +from.val()+' ' +to.attr('dtype'))
        if(from.val()){
            var v = vXtoY(from.attr('dtype'), from.val(), to.attr('dtype'));
            to.val(v);
        }
    });

    var i = 2, options="";
    for(i; i<=64; i++){
        options = options + "<option value='"+i+"'>"+i+"</option>";
    }

    $(".sfrom, .sto").html(options).on('change', function(){
        //alert($(this).val());
        $(this).parent().parent().find('input').attr('dtype', $(this).val());
    });
})()
</script>
@stop