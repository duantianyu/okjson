@extends('layout')

@section('meta')
<meta name="keywords" content="Unix时间戳转换, 时间戳转换工具">
<meta name="description" content="Unix时间戳转换可以把Unix时间转成北京时间, 北京时间转Unix时间戳">
@stop

@section('title')
Unix时间戳转换工具 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
@include('convert.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        Unix时间戳, Unix时间戳转换工具
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body form-inline">

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">当前时间戳</span>
                <input type="text" class="form-control now-time" value="">
            </div>
        </div>

        <div class="box">
            <p>Unix时间戳(Unix timestamp) → 北京时间</p>

            <div class="form-group input-group">
                <span class="input-group-addon">Unix时间戳</span>
                <input type="text" class="form-control time1" value="">
            </div>

            <button type="button" class="btn btn-primary format time2date"> → </button>

            <div class="form-group input-group">
                <span class="input-group-addon">北京时间</span>
                <input type="text" class="form-control time1-bj" value="">
            </div>
        </div>

        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">Unix时间戳</span>
                <input type="text" class="form-control time11" value="">
            </div>

            <button type="button" class="btn btn-primary format time22date"> → </button>

            <div class="form-group input-group">
                <span class="input-group-addon">北京时间</span>
                <input type="text" class="form-control time11-bj" value="">
            </div>
        </div>

        <div class="box">
            <p>北京时间 → Unix时间戳(Unix timestamp)</p>

            <div class="form-group input-group">
                <span class="input-group-addon">北京时间</span>
                <input type="text" class="form-control time2-bj" value="">
            </div>

            <button type="button" class="btn btn-primary format date2time"> → </button>

            <div class="form-group input-group">
                <span class="input-group-addon">Unix时间戳</span>
                <input type="text" class="form-control time2" value="">
            </div>
        </div>


        <div class="box">
            <div class="form-group input-group">
                <span class="input-group-addon">北京时间</span>
                <input type="text" class="form-control time22-bj" value="">
            </div>

            <button type="button" class="btn btn-primary format date22time"> → </button>

            <div class="form-group input-group">
                <span class="input-group-addon">Unix时间戳</span>
                <input type="text" class="form-control time22" value="">
            </div>
        </div>

        <div style="height: 20px"></div>
        <div class="alert alert-success">
            <ul>
                <li>UNIX时间戳（UNIX Time Stamp）为世界协调时间（Coordinated Universal Time，即UTC）1970年01月01日00时00分00秒到现在的总秒数，与时区无关。</li>
                <li>当前UNIX时间戳（基于浏览器时间）：<code class="current_timestamp"></code> </li>
            </ul>
        </div>

    </div>
</div>

@stop


@section('foot_js')
<script type="text/javascript">
    (function(){
        $('.box').css('padding-top', '15px');
        var now_time = $(".now-time"),
            now_time2 = $(".current_timestamp"),

            time1 = $(".time1"),
            time2date = $(".time2date"),
            time1_bj = $(".time1-bj"),

            time11 = $(".time11"),
            time22date = $(".time22date"),
            time11_bj = $(".time11-bj"),

            time2 = $(".time2"),
            date2time = $(".date2time"),
            time2_bj = $(".time2-bj");

            time22 = $(".time22"),
            date22time = $(".date22time"),
            time22_bj = $(".time22-bj");

        var timestamptostr = function(timestamp) {
            d = new Date(timestamp * 1000);
            var _d = (d.getFullYear())+"-"+(d.getMonth()+1)+"-"+(d.getDate())+" "+(d.getHours())+":"+(d.getMinutes())+":"+(d.getSeconds());
            return _d;
        };

        setInterval(function(){
            now_time.val(Math.round(new Date().getTime()/1000));
            now_time2.text(Math.round(new Date().getTime()/1000));
        },1000);

        time1.val(Math.round(new Date().getTime()/1000));
        time2_bj.val(timestamptostr(Math.round(new Date().getTime()/1000)));

        var time1_bj_fun = function(){
            time1_bj.val(timestamptostr(time1.val()));
        }
        time2date.on("click", time1_bj_fun);
        time1.bind('input propertychange', time1_bj_fun);

        var data2time_fun = function(){
            var t = time2_bj.val();
            t = t.replace(/-/g, "/");
            var d = new Date(t);
            time2.val(d.getTime()/1000);
        }
        time2_bj.bind('input propertychange', data2time_fun);
        date2time.on("click", data2time_fun);

        time11.val(Math.round(new Date().getTime()/1000));
        time22_bj.val(timestamptostr(Math.round(new Date().getTime()/1000)));

        var time11_bj_fun = function(){
            time11_bj.val(timestamptostr(time11.val()));
        };
        time22date.on("click", time11_bj_fun);
        time11.bind('input propertychange', time11_bj_fun);

        var time22_fun = function(){
            var t = time22_bj.val();
            t = t.replace(/-/g, "/");
            var d = new Date(t);
            time22.val(d.getTime()/1000);
        }

        time22_bj.bind('input propertychange', time22_fun);
        date22time.on("click", time22_fun);

    })();
</script>
@stop