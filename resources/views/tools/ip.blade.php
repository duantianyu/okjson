@extends('layout')

@section('meta')
<meta name="keywords" content="IP查询工具 - 在线JSON校验格式化工具">
<meta name="description" content="搜索iP地址的地理位置!">
@stop

@section('title')
IP查询工具 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        IP查询工具
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <p>搜索iP地址的地理位置</p>
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">IP</span>
            <input type="text" id="ip" name="ip" class="form-control from" style="max-width:450px;" value="">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary format query">查询</button>
        </div>

        <div class="alert msg" role="alert">
        </div>

        <table id="results" width="100%"></table>


    </div>
</div>
@stop


@section('foot_js')
<script>
(function(){
    $("#results").css("margin-bottom","35px");

    function checkIp(ip){
        if(ip !== ''){
            var reg=/^(?:(?:2[0-4][0-9]\.)|(?:25[0-5]\.)|(?:1[0-9][0-9]\.)|(?:[1-9][0-9]\.)|(?:[0-9]\.)){3}(?:(?:2[0-5][0-5])|(?:25[0-5])|(?:1[0-9][0-9])|(?:[1-9][0-9])|(?:[0-9]))$/;
            if(!reg.test(ip)){
                return false;
            }
            return true;
        }
    }
    /*$.getJSON("http://ip-api.com/json/?callback=?", function(data) {
        var table_body = '';
        $.each(data, function(k, v) {
            table_body += "<tr><td align='right' width='25%'>" + k + "</td><td><b>" + v + "</b></td></tr>";
            if(k == 'query')
                $("#ip").val(v);
        });
        $("#results").html(table_body);
        $("#results td").css("padding","3px");
    });*/
    var obj_query = $(".query");
    getinfo(obj_query, 1);
    obj_query.on('click', function(){
        getinfo(this, 2);
    });

    function getinfo(obj, n) {
        var msg = $('.msg');
        $(obj).attr('disabled', true);
        msg.removeClass('alert-danger alert-info alert-success').html('').hide();
        var ip = $("#ip").val();
        var _token = '{{ csrf_token() }}';
        if(n === 2 && !checkIp(ip)){
            msg.addClass('alert-danger').html("<p>请输入正确的IP</p>").show();
            $(obj).attr('disabled', false);
            return false;
        }

        msg.addClass('alert-info').html('...请稍后...').show();
        $.post('/ip', {
            ip:ip,
            _token:_token
        }, function(data){
            msg.removeClass('alert-danger alert-info alert-success');
            if(data.status === 'success' || data.status === 'fail'){
                var table_body = '';
                $.each(data, function(k, v) {
                    table_body += "<tr><td align='right' width='25%'>" + k + "</td><td><b>" + v + "</b></td></tr>";
                    if(k === 'query')
                        $("#ip").val(v);
                });
                $("#results").html(table_body);
                $("#results td").css("padding","3px");
                msg.addClass('alert-success').html('查询成功').show();

            }else{
                msg.addClass('alert-danger').html(data.msg).show();
            }
            $(".query").attr('disabled', false);
        });
    }
})()

</script>
@stop