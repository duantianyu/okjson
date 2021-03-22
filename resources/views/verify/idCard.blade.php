@extends('layout')

@section('meta')
<meta name="description" content="身份证号码校验,身份证定位查询,身份证号码查询。" />
<meta name="keywords" content="身份证号码校验,身份证定位查询,身份证号码查询" />
@stop

@section('title')
身份证号码校验 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default category-description">
    <div class="panel-heading">
        <div class="panel-title">身份证号码校验</div>
    </div>
    <div class="panel-body">
        <div class="form-group input-group">
            <span class="input-group-addon">身份证号码</span>
            <input type="text" id="idCard" name="idCard" class="form-control from" style="max-width:200px;">
            &nbsp;&nbsp;<button type="submit" name="generate" class="btn btn-primary format search">查询</button>
        </div>
        <div class="alert msg" role="alert"></div>

        <table id="results" width="100%"></table>

        <div style="height: 10px"></div>
        <p id="message"></p>
        <pre class="success" id="results">
（一）中国居民身份证号码编码规则
第一、二位表示省（自治区、直辖市、特别行政区）。
第三、四位表示市（地级市、自治州、盟及国家直辖市所属市辖区和县的汇总码）。其中，01-20，51-70表示省直辖市；21-50表示地区（自治州、盟）。
第五、六位表示县（市辖区、县级市、旗）。01-18表示市辖区或地区（自治州、盟）辖县级市；21-80表示县（旗）；81-99表示省直辖县级市。
第七、十四位表示出生年月日（单数字月日左侧用0补齐）。其中年份用四位数字表示，年、月、日之间不用分隔符。例如：1981年05月11日就用19810511表示。
第十五、十七位表示顺序码。对同地区、同年、月、日出生的人员编定的顺序号。其中第十七位奇数分给男性，偶数分给女性。
第十八位表示校验码。作为尾号的校验码，是由号码编制单位按统

（二）中国居民身份证校验码算法
步骤如下：
将身份证号码前面的17位数分别乘以不同的系数。从第一位到第十七位的系数分别为：7－9－10－5－8－4－2－1－6－3－7－9－10－5－8－4－2。
将这17位数字和系数相乘的结果相加。
用加出来和除以11，取余数。
余数只可能有0－1－2－3－4－5－6－7－8－9－10这11个数字。其分别对应的最后一位身份证的号码为1－0－X－9－8－7－6－5－4－3－2。
通过上面计算得知如果余数是3，第18位的校验码就是9。如果余数是2那么对应的校验码就是X，X实际是罗马数字10。
例如：某男性的身份证号码为【53010219200508011x】， 我们看看这个身份证是不是合法的身份证。首先我们得出前17位的乘积和【(5*7)+(3*9)+(0*10)+(1*5)+(0*8)+(2*4)+(1*2)+(9*1)+(2*6)+(0*3)+(0*7)+(5*9)+(0*10)+(8*5)+(0*8)+(1*4)+(1*2)】是189，然后用189除以11得出的结果是189/11=17----2，也就是说其余数是2。最后通过对应规则就可以知道余数2对应的检验码是X。所以，可以判定这是一个正确的身份证号码。
</pre>
    </div>
</div>

@stop


@section('foot_js')
<script type="text/javascript">
    (function(){
        $(".search").on('click', function(){
            var msg = $('.msg');
            var idCard = $('#idCard').val();
            msg.html('').hide();
            $('.search').attr('disabled', true);

            if(idCard === ''){
                msg.addClass('alert-danger').html('请输入身份证号码').show();
                $('.search').attr('disabled', false);
                return;
            }

            $.post('/getIdCardInfo', {
                idCard:idCard,
                _token:'{{ csrf_token() }}'
            }, function(d){
                if(d.status){
                    msg.removeClass('alert-danger alert-info alert-success');

                    var table_body = '';
                    $.each(d.msg, function(k, v) {
                        table_body += "<tr><td align='right' width='25%'>" + k + "</td><td><b>" + v + "</b></td></tr>";
                        if(k === 'query')
                            $("#ip").val(v);
                    });
                    $("#results").html(table_body);
                    $("#results td").css("padding","3px");

                    msg.addClass('alert-success').html('查询成功').show();

                }else{
                    msg.html(d.msg).show();
                }

                $('.search').attr('disabled', false);
            });
        });
    })()
</script>
@stop
