@extends('layout')

@section('meta')
<meta name="keywords" content="验证码 - 在线JSON校验格式化工具">
<meta name="description" content="验证码，Captcha，机器人验证，安全防护">
@stop

@section('title')
验证码 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        好用的验证码，智能验证
    </div>
    <div class="panel-body">
        <form class="form-se">
            <div class="form-group input-group">
                <div id="g_recaptcha_v2"></div>
                <button type="button" class="btn btn-primary format variable se-btn" id="t_captcha_v2">google reCAPTCHA v2测试</button>
                <div class="alert msg_google_v2" role="alert"></div>

                <div style="height: 10px"></div>
                <button type="button" class="btn btn-primary format variable se-btn" id="t_captcha_v3">google reCAPTCHA v3测试</button>
                <div class="alert msg_google_v3" role="alert"></div>

            </div>
        </form>



    </div>
</div>
@stop





@section('foot_js')
<script type="text/javascript">
var msg_google_v2 = $('.msg_google_v2');
var msg_google_v3 = $('.msg_google_v3');
msg_google_v2.hide();
msg_google_v3.hide();
//reCAPTCHA v2
var g_recaptcha_response_v2 = '';
var widgetId_v2;//定义容器v2
var onloadCallback = function () {
    var widgetId_v2 = grecaptcha.render('g_recaptcha_v2', {
        'sitekey': '{{env('RE_CAPTCHA_SITE_KEY_2')}}',
        'callback' : verifyCallback_v2,
        'action': 'verifyV2'
        //'theme' : 'dark'
    });

};
//得到g_recaptcha_response_v2方法1
var verifyCallback_v2 = function(response) {
    console.log(response);
};
var _token = '{{ csrf_token() }}';
$('#t_captcha_v2').click(function () {
    $(this).attr('disabled', true);
    g_recaptcha_response_v2 = grecaptcha.getResponse(widgetId_v2);//得到g_recaptcha_response_v2方法2
    if(g_recaptcha_response_v2){
        $.post('/verify', {
            g_recaptcha_response_v2: g_recaptcha_response_v2,
            _token: _token
        }, function (data) {
            console.log(data);
            if (data.success === true) {
                msg_google_v2.addClass('alert-success').html('验证成功').show();

            } else {
                msg_google_v2.addClass('alert-danger').html('验证失败，请重试').show();
                window.setTimeout(function(){
                    msg_google_v2.removeClass('alert-danger alert-success').html('').hide();
                    grecaptcha.reset(widgetId_v2);//重置验证
                },3000);
                $('#t_captcha_v2').attr('disabled', false);

            }

        });
    }else{
        msg_google_v2.addClass('alert-danger').html('请进行人机身份验证').show();
        window.setTimeout(function(){
            msg_google_v2.removeClass('alert-danger alert-success').html('').hide();
            $('#t_captcha_v2').attr('disabled', false);
        },3000);

    }

});

</script>
<script src="https://www.recaptcha.net/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
<script src="https://www.recaptcha.net/recaptcha/api.js?render={{env('RE_CAPTCHA_SITE_KEY_3')}}"></script>
<script type="text/javascript">
//reCAPTCHA v3
var reCAPTCHA_site_key = '{{env('RE_CAPTCHA_SITE_KEY_3')}}';
$('#t_captcha_v3').click(function () {
    $(this).attr('disabled', true);
    verify_v3(_token, reCAPTCHA_site_key, msg_google_v3);
});
function verify_v3(_token, reCAPTCHA_site_key, msg_google_v3){
    grecaptcha.ready(function () {
        grecaptcha.execute(reCAPTCHA_site_key, {action: 'verifyV3'}).then(function (token) {
            if($('#t_captcha_v3').prop("disabled")){
                $.post('/verify', {
                    g_recaptcha_response_v3: token,
                    _token: _token
                }, function (data) {
                    console.log(data);
                    if (data.success === true) {
                        msg_google_v3.addClass('alert-success').html('验证成功').show();

                    } else {
                        msg_google_v3.addClass('alert-danger').html('验证失败，请重试').show();
                        window.setTimeout(function(){
                            msg_google_v3.removeClass('alert-danger alert-success').html('').hide();
                            verify_v3(_token, reCAPTCHA_site_key, msg_google_v3);//重置验证
                        },3000);
                        $('#t_captcha_v3').attr('disabled', false);

                    }

                });
            }

        });
    });
}
</script>


@stop