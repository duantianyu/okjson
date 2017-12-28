@extends('layout')

@section('meta')
<meta name="keywords" content="二维码生成,在线二维码生成">
<meta name="description" content="在线JSON校验格式化工具(OK JSON), 二维码在线生成, 在线美化">
@stop

@section('title')
二维码生成|在线二维码生成 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<style type="text/css">
.QRCodeDiv {
    margin-top: 22px;
    border: 1px solid #ccc;
    background-color: #eee;
    text-align: center;
    padding: 20px;
    border-radius: 4px;
}
</style>
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        在线二维码生成,QR码生成
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <form id="qrcode_form">
            <div class="row">
                <div class="col-lg-5">
                    <div class="form-group">

                        {{--<!-- <p>
                            <label>输出格式:</label><br/>
                            <select name="output" class="span1">
                                <option value="image/png" selected>PNG</option>
                                <option value="image/jpeg">JPEG</option>
                            </select>
                        </p> -->--}}

                        <label>纠错级别:
                        <select name="error">
                            <option value="L">L 7%</option>
                            <option value="M">M 15%</option>
                            <option value="Q" selected>Q 25%</option>
                            <option value="H">H 30%</option>
                        </select></label>
                        &nbsp;&nbsp;<label>边缘留白:
                        <select name="outerFrame">
                            <option value="0">0</option>
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select></label>
                        &nbsp;&nbsp;<label>色块大小:
                        <select name="size">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8" selected>8</option>
                            <option value="10">10</option>
                        </select></label>
                        &nbsp;&nbsp;<button type="button" class="btn btn-primary format generate"> 生成 </button>

                    </div>
                    <div class="form-group">
                        <textarea class="form-control QRInput" id="data" name="data" rows="20" placeholder="请输入要生成二维码的信息如：{{ env('APP_URL') }}"></textarea>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="form-group">

                        <div class="QRCodeDiv">
                            <p>QR码</p>
                            <p class="msg"></p>
                            <img id="qrcode" src="{{ asset('images/qr.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>


@stop


@section('foot_js')
<script type="text/javascript">
(function(){
    $('.msg').hide();
    $(".generate").on('click', function(){
        $("#qrcode").hide();
        $('.msg').html('').hide();
        $('.generate').attr('disabled', true);

        if($('#data').val() == ''){
            $('.msg').html('请输入要生成二维码的信息').show();
            $('.generate').attr('disabled', false);
            return;
        }

        $.post('/qr?generate=1&' + $("#qrcode_form").serialize(), {
            _token:'{{ csrf_token() }}'
        }, function(d){
            if(d.status){
                $("#qrcode").attr('src', '/' + d.msg).show();
            }else{
                $('.msg').html(d.msg).show();
            }

            $('.generate').attr('disabled', false);
        });
    });
})()
</script>
@stop