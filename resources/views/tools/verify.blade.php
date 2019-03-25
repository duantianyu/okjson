@extends('layout')

@section('meta')
<meta name="keywords" content="验证码 - 在线JSON校验格式化工具">
<meta name="description" content="验证码，Captcha，机器人验证，安全防护">
@stop

@section('title')
验证码 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
@include('tools.tab')

<div class="panel panel-default">
    <div class="panel-heading">
        好用的验证码，智能验证
    </div>
    <div class="panel-body">
        <form class="form-se">
            <div class="form-group input-group">
                <span class="input-group-addon">关键字</span>
                <input type="text" class="form-control kwd" style="max-width: 350px;" placeholder="" name="q">
                &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary format variable se-btn">搜索</button>
            </div>
        </form>


        <form>
            <div id="g_recaptcha_v2"></div>
            <br>
            <input type="button" id="t_captcha_v2" value="Submit">
        </form>
    </div>
</div>
@stop





@section('foot_js')
<script type="text/javascript">
//reCAPTCHA v2
var g_recaptcha_response_v2 = '';
var widgetId_v2;
var onloadCallback = function () {
    var widgetId_v2 = grecaptcha.render('g_recaptcha_v2', {
        'sitekey': '{{env('RE_CAPTCHA_SITE_KEY_2')}}',
        'callback' : verifyCallback_v2,
        //'theme' : 'dark'
    });

};
//得到g_recaptcha_response_v2方法1
var verifyCallback_v2 = function(response) {
    console.log(response);
};
var _token = '{{ csrf_token() }}';
$('#t_captcha_v2').click(function () {
    g_recaptcha_response_v2 = grecaptcha.getResponse(widgetId_v2);//得到g_recaptcha_response_v2方法2
    $.post('/verify', {
        g_recaptcha_response_v2: g_recaptcha_response_v2,
        _token: _token
    }, function (data) {
        console.log(data);
        if (data.status === 200) {
            alert('验证成功');

        } else {
            grecaptcha.reset(widgetId_v2);//重置验证
        }
    });
});

</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>
<script src="https://www.google.com/recaptcha/api.js?render={{env('RE_CAPTCHA_SITE_KEY_3')}}"></script>
<script type="text/javascript">
//reCAPTCHA v3
var reCAPTCHA_site_key = '{{env('RE_CAPTCHA_SITE_KEY_3')}}';
function verify_v3(_token, reCAPTCHA_site_key){
    grecaptcha.ready(function () {
        grecaptcha.execute(reCAPTCHA_site_key, {action: '/verify'}).then(function (token) {
            $.post('/verify', {
                g_recaptcha_response_v3: token,
                _token: _token
            }, function (data) {
                console.log(data);
                if (data.status === 200) {
                    alert('验证成功');

                } else {
                    verify_v3();
                }
            });
        });
    });
}
</script>


@stop