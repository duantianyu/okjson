@extends('layout')

@section('meta')
<meta name="keywords" content="Poster json,post结果直接格式化">
<meta name="description" content="post获取的json直接格式化">
@stop

@section('head_css')
    <link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bdsstyle.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <span>Poster</span>
        {{--<a style="color:green;" href="http://www.608558.com/donate">赞助名单</a>--}}
        <span style="margin-left: 20px;"></span>
    </div>

    <div class="panel-body">

        <div class="form-group input-group">
            <span class="input-group-addon">url</span>
            <input type="text" value="http://api3.dev" class="form-control url">
        </div>
        <textarea class="form-control parameter" rows="2" spellcheck="false" placeholder='请输入参数'></textarea>
        <div style="height: 10px;"></div>
        <div class="form-group form-inline">
            <label>方式
            <select class="form-control method">
                <option value="post"> post </option>
                <option value="get"> get </option>
            </select></label>
            &nbsp;&nbsp;<button type="button" class="btn btn-primary format send"> SEND </button>
        </div>

        <textarea class="form-control" rows="5" id="json_input" spellcheck="false" placeholder='请求的结果'></textarea>
        <div style="height: 10px;"></div>
        <textarea style="width: 100%; outline:none;" rows="20" id="json_output" spellcheck="false" placeholder='如果请求的结果是json,会在这里格式化'></textarea>

        <div style="height: 10px;"></div>
        <pre class="v-result alert" style="display:none;"></pre>
        <span>试试:&nbsp;&nbsp;
            <a href="http://www.608558.com/?f=1" target="_blank">JSON格式化</a>&nbsp;&nbsp;
            <a href="http://www.608558.com/json/parser/?f=1" target="_blank">JSON在线视图</a>&nbsp;&nbsp;
            <a href="http://www.608558.com/json/format/?f=1" target="_blank">JSON格式化高亮</a>&nbsp;&nbsp;
        </span>

        <div style="height: 10px;"></div>


    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jquery-linedtextarea.js') }}"></script>
<script src="{{ asset('js/jsl.format.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsl.parser.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jsoninit.js') }}" type="text/javascript"></script>
<script type="text/javascript">
(function () {
    function checkUrl(url){
        if(url!=""){
            var reg=/(http|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&:/~\+#]*[\w\-\@?^=%&/~\+#])?/;
            if(!reg.test(url)){
                return false;
            }
            return true;
        }
    }
    jsl.interactions.init('json_output');
    var json_input = $('#json_input');
    $(".send").on('click', function(){
        $(this).attr('disabled', true);
        var url = $(".url").val();
        var method = $(".method").val();
        var parameter = $(".parameter").val();
        var _token = '{{ csrf_token() }}';

        if(!checkUrl(url)){
            json_input.val('请输入正确的URL');
            $(this).attr('disabled', false);
            return false;
        }

        $.post("/poster", {
            url: url,
            method: method,
            parameter: parameter,
            _token: _token
        }, function(d){
            json_input.val(d);
            $('#json_output').val(d);
            $('.send').attr('disabled', false);
            jsl.interactions.validate('json_output');
        })
    });
})()
</script>
@stop