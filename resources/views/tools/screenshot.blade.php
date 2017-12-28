@extends('layout')

@section('meta')
<meta name="keywords" content="在线网页截图工具, 网站截图工具，网站在线截图，网站监控, 如何截取整个网页的截图, 怎么截图一整个网页">
<meta name="description" content="一款在线网页快速截图工具。">
@stop

@section('title')
在线网页截图工具-截图一整个网页 - 在线JSON校验格式化工具(OK JSON)
@stop



@section('content')
@include('tools.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        在线网页截图工具
    </div>

    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <p>在线网页截图工具, 图片目前只保留一天, 请勿直接外链本站截图！如有问题请联系QQ: 2443738275</p>
        </div>

        <div class="form-group input-group">
            <span class="input-group-addon">网址</span>
            <input type="text" id="url" name="url" class="form-control from" style="max-width:450px;" value="http://www.baidu.com" placeholder="http://www.baidu.com">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-primary format screenshot">截图</button>
        </div>

        <div class="alert msg" role="alert">
        </div>

        <!--options-->

        <div class="form-group">
            <label>截图范围：</label>
            <label class="radio-inline">
                <input type="radio" name="clipping" value="1" checked>全网页
            </label>
            <label class="radio-inline">
                <input type="radio" name="clipping" value="0">首屏
            </label>
        </div>

        <div class="form-group">
            <label> 分 辨 率 ：</label>
            <label class="radio-inline">
                <input type="radio" name="resolution" value="0" checked>1440x900
            </label>
            <label class="radio-inline">
                <input type="radio" name="resolution" value="1">1200x800
            </label>
            <label class="radio-inline">
                <input type="radio" name="resolution" value="2">1024x768
            </label>
            <label class="radio-inline">
                <input type="radio" name="resolution" value="3">768x1024
            </label>
            <label class="radio-inline">
                <input type="radio" name="resolution" value="4">480x640
            </label>
            <label class="radio-inline">
                <input type="radio" name="resolution" value="5">320x480
            </label>
        </div>

        <div class="form-group">
            <label>生成格式：</label>
            <label class="radio-inline">
                <input type="radio" name="ext" value="png" checked>PNG
            </label>
            <!-- <label class="radio-inline">
                <input type="radio" name="ext" value=".gif">GIF
            </label> -->
            <label class="radio-inline">
                <input type="radio" name="ext" value="jpg">JPEG
            </label>
            <!-- <label class="radio-inline">
                <input type="radio" name="ext" value=".pdf">PDF
            </label> -->
        </div>

    </div>
</div>

@stop


@section('foot_js')
<script type="text/javascript">
(function(){
    var msg = $('.msg');
    msg.hide();
    function checkUrl(url){
        if(url!=""){
            var reg=/(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;
            if(!reg.test(url)){
                return false;
            }
            return true;
        }
    }


    $(".screenshot").on("click", function(){
        var _token = '{{ csrf_token() }}';
        $(this).attr('disabled', true);
        msg.removeClass('alert-danger alert-info alert-success').html('').hide();


        var url = $("#url").val();
        if(!url|| !checkUrl(url)){
            msg.addClass('alert-danger').html('<p>请输入正确的网址，例如：https://www.baidu.com</p>').show();
            $(this).attr('disabled', false);
            return;
        }
        msg.addClass('alert-info').html('<p>正在截图中，请稍等...</p>');
        var clipping = $("input[name=clipping]:checked").val();
        var resolution = $("input[name=resolution]:checked").val();
        var ext = $("input[name=ext]:checked").val();
        var useragent = $("input[name=useragent]").val();

        $.post("/screen_shot?screenshot=1", {
            url: url,
            _token:_token,
            options: {
                clipping: clipping,
                resolution: resolution,
                ext: ext,
                useragent: useragent
            }
        }, function(d){
            msg.removeClass('alert-danger alert-info alert-success');
            if(d.status){
                var html = '';
                    html += '<div class="form-group input-group">';
                    html += '<span class="input-group-addon">';
                    html += '<a href="'+d.msg+'" target="_blank">view</a>';
                    html +='</span>';
                    html += '<input type="text" readonly class="form-control from" style="max-width:650px;" value="'+d.msg+'">';
                    html += '</div>';
                msg.addClass('alert-success').css('margin-top', '10px').html(html).show();
                $('.form-group').css('margin-bottom', 0);
                $(".screenshot").attr('disabled', false);
            }else{
                msg.addClass('alert-danger').html('<p>截图失败! ' + d.msg + '</p>').show();
                $(".screenshot").attr('disabled', false);
            }
        });
    });
})()
</script>
@stop