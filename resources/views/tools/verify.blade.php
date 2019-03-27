@extends('layout')

@section('meta')
<meta name="keywords" content="验证码 - 在线JSON校验格式化工具">
<meta name="description" content="验证码，Captcha，机器人验证，安全防护">
@stop

@section('title')
验证码 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<style>
.vaptcha-init-main {
    display: table;
    width: 100%;
    height: 100%;
    background-color: #EEEEEE;
}
.vaptcha-init-loading {
    display: table-cell;
    vertical-align: middle;
    text-align: center
}
.vaptcha-init-loading>a {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: none;
}
.vaptcha-init-loading>a img {
    vertical-align: middle
}
.vaptcha-init-loading .vaptcha-text {
    font-family: sans-serif;
    font-size: 12px;
    color: #CCCCCC;
    vertical-align: middle
}
</style>
@stop
@section('head_js')
<script src="https://ssl.captcha.qq.com/TCaptcha.js"></script>
@stop



@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        好用的验证码，智能验证
    </div>
    <div class="panel-body">
        <form class="form-se">
            <p class="alert alert-info">Google reCAPTCHA 免费，v2点击，v3无感</p>
            <div id="g_recaptcha_v2"></div>
            <button type="button" class="btn btn-primary format variable se-btn" id="g_captcha_v2">google reCAPTCHA
                v2测试
            </button>
            <div class="alert msg_google_v2" role="alert"></div>

            <div style="height: 10px"></div>
            <button type="button" class="btn btn-primary format variable se-btn" id="g_captcha_v3">google reCAPTCHA v3测试</button>
            <div class="alert msg_google_v3" role="alert"></div>
        </form>

        <div style="height: 30px"></div>
        <p class="alert alert-info">腾讯验证码，登录即享受免费套餐，2000次/小时安全防护</p>
        <button class="btn btn-primary format variable se-btn" id="tencentCaptcha"
                data-appid="{{env('T_APP_ID')}}"
                data-cbfn="tCallback">腾讯验证码测试
        </button>
        <div class="alert msg_qq" role="alert"></div>


        <div style="height: 30px"></div>
        <p class="alert alert-info">Vaptcha，免费版有使用限制，500 次/h，验证单元数上限3等</p>
        <div id="vaptchaContainer" style="width: 430px;height: 250px;">
            <div class="vaptcha-init-main">
                <div class="vaptcha-init-loading">
                    <img src="https://cdn.vaptcha.com/vaptcha-loading.gif" />
                    <span class="vaptcha-text">Vaptcha启动中...</span>
                </div>
            </div>
        </div>
        <div style="height: 5px"></div>
        <button type="button" class="btn btn-primary format variable se-btn" id="vaptcha">Vaptcha测试</button>
        {{--<button type="button" class="btn btn-primary format variable se-btn" id="reset">重置Vaptcha</button>--}}
        <div class="alert msg_vaptcha" role="alert"></div>


        <div style="height: 30px"></div>
        <p class="alert alert-info">GEETEST，免费版验证会随机出现广告图片，默认为滑动验证模式，付费版是根据您的需求定制</p>
        <div id="gtCaptchaBox"></div>
        <div class="geetest_form">
            <input type="hidden" name="geetest_challenge" value="">
            <input type="hidden" name="geetest_validate" value="">
            <input type="hidden" name="geetest_seccode" value="">
        </div>
        <div style="height: 5px"></div>
        <button type="button" class="btn btn-primary format variable se-btn" id="geetestCaptcha">geetest测试</button>
        <div class="alert msg_gt_aptcha" role="alert"></div>

    </div>
</div>
@stop





@section('foot_js')
<script type="text/javascript">
var msg_google_v2 = $('.msg_google_v2');
var msg_google_v3 = $('.msg_google_v3');
var msg_qq = $('.msg_qq');
var msg_vaptcha = $('.msg_vaptcha');
var msg_gt_aptcha = $('.msg_gt_aptcha');
msg_google_v2.hide();
msg_google_v3.hide();
msg_qq.hide();
msg_vaptcha.hide();
msg_gt_aptcha.hide();
//reCAPTCHA v2
var g_recaptcha_response_v2 = '';
var widgetId_v2;//定义容器v2
var onloadCallback = function () {
    var widgetId_v2 = grecaptcha.render('g_recaptcha_v2', {
        'sitekey': '{{env('RE_CAPTCHA_SITE_KEY_2')}}',
        'callback': verifyCallback_v2,
        'action': 'verifyV2'
        //'theme' : 'dark'
    });

};
//得到g_recaptcha_response_v2方法1
var verifyCallback_v2 = function (response) {
    console.log(response);
};
var _token = '{{ csrf_token() }}';
$('#g_captcha_v2').click(function () {
    $(this).attr('disabled', true);
    g_recaptcha_response_v2 = grecaptcha.getResponse(widgetId_v2);//得到g_recaptcha_response_v2方法2
    if (g_recaptcha_response_v2) {
        $.post('/verify', {
            g_recaptcha_response_v2: g_recaptcha_response_v2,
            _token: _token
        }, function (data) {
            console.log(data);
            if (data.success === true) {
                msg_google_v2.addClass('alert-success').html('验证成功').show();

            } else {
                msg_google_v2.addClass('alert-danger').html('验证失败，请重试').show();
                window.setTimeout(function () {
                    msg_google_v2.removeClass('alert-danger alert-success').html('').hide();
                    grecaptcha.reset(widgetId_v2);//重置验证
                }, 3000);
                $('#g_captcha_v2').attr('disabled', false);

            }

        });
    } else {
        msg_google_v2.addClass('alert-danger').html('请进行人机身份验证').show();
        window.setTimeout(function () {
            msg_google_v2.removeClass('alert-danger alert-success').html('').hide();
            $('#g_captcha_v2').attr('disabled', false);
        }, 3000);

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
$('#g_captcha_v3').click(function () {
    $(this).attr('disabled', true);
    verify_v3(_token, reCAPTCHA_site_key, msg_google_v3);
});

function verify_v3(_token, reCAPTCHA_site_key, msg_google_v3) {
    grecaptcha.ready(function () {
        grecaptcha.execute(reCAPTCHA_site_key, {action: 'verifyV3'}).then(function (token) {
            if ($('#g_captcha_v3').prop("disabled")) {
                $.post('/verify', {
                    g_recaptcha_response_v3: token,
                    _token: _token
                }, function (data) {
                    console.log(data);
                    if (data.success === true) {
                        msg_google_v3.addClass('alert-success').html('验证成功').show();

                    } else {
                        msg_google_v3.addClass('alert-danger').html('验证失败，请重试').show();
                        window.setTimeout(function () {
                            msg_google_v3.removeClass('alert-danger alert-success').html('').hide();
                            verify_v3(_token, reCAPTCHA_site_key, msg_google_v3);//重置验证
                        }, 3000);
                        $('#g_captcha_v3').attr('disabled', false);

                    }

                });
            }

        });
    });
}


//腾讯验证
$('#tencentCaptcha').click(function () {
    $('#tencentCaptcha').attr('disabled', true);

});
/*window.tCallback = function (res) {
    console.log(res);
    // res（用户主动关闭验证码）= {ret: 2, ticket: null}
    // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
    if (res.ret === 0) {
        $.post('/verifyQQ', {
            ticket: res.ticket,
            randstr: res.randstr,
            _token: _token
        }, function (data) {
            console.log(data);
            if (data.response === '1') {
                msg_qq.addClass('alert-success').html('验证成功').show();

            } else {
                msg_qq.addClass('alert-danger').html('验证失败，请重试').show();
                window.setTimeout(function () {
                    msg_qq.removeClass('alert-danger alert-success').html('').hide();
                    $('#tencentCaptcha').attr('disabled', false);
                }, 3000);

            }

        });
    }
}*/

new TencentCaptcha(
    document.getElementById('tencentCaptcha'), '{{env('T_APP_ID')}}',
    function(res) {
        console.log(res);
        // res（用户主动关闭验证码）= {ret: 2, ticket: null}
        // res（验证成功） = {ret: 0, ticket: "String", randstr: "String"}
        if (res.ret === 0) {
            $.post('/verifyQQ', {
                ticket: res.ticket,
                randstr: res.randstr,
                _token: _token
            }, function (data) {
                console.log(data);
                if (data.response === '1') {
                    msg_qq.addClass('alert-success').html('验证成功').show();

                } else {
                    msg_qq.addClass('alert-danger').html('验证失败，请重试').show();
                    window.setTimeout(function () {
                        msg_qq.removeClass('alert-danger alert-success').html('').hide();
                        $('#tencentCaptcha').attr('disabled', false);
                    }, 3000);

                }

            });
        }
    },
    { bizState: (new Date()).getTime()}
);


</script>
<script type="text/javascript" src="https://cdn.vaptcha.com/v2.js"></script>
<script type="text/javascript">
var vObj;
var vaptchaBtn = $('#vaptcha');
vaptcha({
    //配置参数
    vid: '{{env("VAPTCHA_VID")}}', // 验证单元id
    type: 'embed', // 展现类型 点击式
    scene: '01', // 展现类型 点击式
    container: '#vaptchaContainer' // 按钮容器，可为Element 或者 selector
}).then(function (vaptchaObj) {
    vObj = vaptchaObj;//将VAPTCHA验证实例保存到局部变量中
    // 验证码加载完成后将事件绑定到按钮
    // 调用validate()方法的伪代码，将该方法的调用绑定在'click'事件上，实际开发中需要更改为合适的调用方式
    /*vaptchaObj.listen('pass', function() {

    });*/
    vaptchaObj.render();//执行该方法, 生成验证码

});
/*$('#reset').click(function(){
    vObj.reset();
    vaptchaBtn.attr('disabled', false);
    msg_vaptcha.removeClass('alert-danger alert-success').html('').hide();

});*/
vaptchaBtn.click(function(){
    $(this).attr('disabled', true);
    //obj.validate();
    var token = vObj.getToken();
    // 验证成功进行后续操作
    if(token){
        $.post('/verifyVaptcha', {
            token: token,
            _token: _token
        }, function (data) {
            console.log(data);
            if (data.success === 1) {
                msg_vaptcha.addClass('alert-success').html('验证成功').show();

            } else {
                msg_vaptcha.addClass('alert-danger').html('验证失败，请重试').show();
                window.setTimeout(function () {
                    msg_vaptcha.removeClass('alert-danger alert-success').html('').hide();
                    vObj.reset();
                }, 3000);
                vaptchaBtn.attr('disabled', false);

            }

        });
    }else{
        msg_vaptcha.addClass('alert-danger').html('请绘制图中手势完成人机验证').show();
        window.setTimeout(function () {
            msg_vaptcha.removeClass('alert-danger alert-success').html('').hide();
        }, 3000);
        $(this).attr('disabled', false);

    }

});
</script>


<script src="{{ asset('js/gt.js') }}" type="text/javascript"></script>
<script>
    //geetest
    var handler = function (gtCaptchaObj) {
        gtCaptchaObj.appendTo('#gtCaptchaBox');
        gtCaptchaObj.onReady(function () {
            $("#wait").hide();
        });
        $('#geetestCaptcha').click(function () {
            $(this).attr('disabled', true);
            var result = gtCaptchaObj.getValidate();
            if (!result) {
                msg_gt_aptcha.addClass('alert-danger').html('请完成验证').show();
                window.setTimeout(function () {
                    msg_gt_aptcha.removeClass('alert-danger alert-success').html('').hide();
                }, 3000);
                return $(this).attr('disabled', false);
            }
            console.log(result);
            $.ajax({
                url: '/validateGeetest',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: _token,
                    geetest_challenge: result.geetest_challenge,
                    geetest_validate: result.geetest_validate,
                    geetest_seccode: result.geetest_seccode
                },
                success: function (data) {
                    if (data.status === 'success') {
                        msg_gt_aptcha.addClass('alert-success').html('验证成功').show();

                    } else{
                        msg_gt_aptcha.addClass('alert-danger').html('验证失败，请重试').show();
                        window.setTimeout(function () {
                            msg_gt_aptcha.removeClass('alert-danger alert-success').html('').hide();
                            gtCaptchaObj.reset();
                        }, 3000);
                        $('#geetestCaptcha').attr('disabled', false);
                    }
                }
            });
        })
        // 更多前端接口说明请参见：http://docs.geetest.com/install/client/web-front/
    };

    $.ajax({
        url: "/verifyGeetest?t=" + (new Date()).getTime(), // 加随机数防止缓存
        type: "get",
        dataType: "json",
        success: function (data) {
            $('#text').hide();
            $('#wait').show();

            // 调用 initGeetest 进行初始化
            // 参数1：配置参数
            // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它调用相应的接口
            initGeetest({
                // 以下 4 个配置参数为必须，不能缺少
                gt: data.gt,
                challenge: data.challenge,
                offline: !data.success, // 表示用户后台检测极验服务器是否宕机
                new_captcha: data.new_captcha, // 用于宕机时表示是新验证码的宕机

                product: "popup", // 产品形式，包括：float，popup
                width: "300px",
                https: true

                // 更多前端配置参数说明请参见：http://docs.geetest.com/install/client/web-front/
            }, handler);
        }
    });
</script>

@stop