@extends('layout')

@section('meta')
<meta name="keywords" content="openssl,cast-128,gost,rijndael-128,twofish,arcfour,cast-256,loki97,rijndael-192,saferplus,wake,blowfish-compat,des,rijndael-256,serpent,xtea,blowfish,enigma,rc2,tripledes,cbc,cfb,ctr,ecb,ncfb,nofb,ofb,stream">
<meta name="description" content="openssl支持多种加密算法，多种加密模式。在线加密工具[Online encrypt tool] - 在线JSON校验格式化工具(OK JSON)">
@stop

@section('title')
在线加密工具[Online encrypt tool] - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        在线加密工具[Online encrypt tool]<span style="margin-left:30px;" class="text-muted"><a href="/encrypt/openssl_decode">在线解密工具</a></span>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">

        <div class="alert alert-success" role="alert">
            <p>注意：加密后会对结果进行<code>base64_encode()</code></p>
        </div>
        <textarea class="form-control data" placeholder="请输入要加密的数据" rows="5"></textarea>
        <div style="height: 10px;"></div>
        <div class="form-group input-group">
            <span class="input-group-addon">key</span>
            <input type="text" class="form-control key" style="max-width: 500px;" value="" placeholder="key一般是32位">
        </div>
        <div class="form-group input-group">
            <span class="input-group-addon">iv</span>
            <input type="text" class="form-control iv" style="max-width: 500px;" value="" placeholder="请注意iv的长度要和算法一致">
        </div>
        <div class="form-group form-inline">

            <label> 算 法 ：</label><select class="form-control method">
                @foreach($mode as $k)
                    <option value="{{ $k }}">{{ $k }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group form-inline">
            <label>options：</label>
            <select class="form-control options">
                <option value="1">OPENSSL_RAW_DATA</option>
                <option value="2">OPENSSL_ZERO_PADDING</option>
            </select>
        </div>

        <button type="button" class="btn btn-primary format btn-encode">加密</button>

        <div style="height: 10px;"></div>

        <div class="form-group">
            <label>Result</label>
            <textarea class="form-control result" rows="8" readonly="readonly"></textarea>
        </div>




        <p class="text-muted">工具使用PHP中的openssl_encrypt()相关函数，有关参数，更多信息请<a href="http://www.php.net/manual/en/function.openssl-encrypt.php" target="_blank">查看手册</a>。</p>


    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/lib/jquery.cookie.js') }}" type="text/javascript"></script>
<script type="text/javascript">
(function(){

    $(".btn-encode").on('click', function(){
        var key = $(".key").val();
        var iv = $(".iv").val();
        var data = $(".data").val();
        var method = $(".method").val();
        var mode = $(".mode").val();
        var options = $(".options").val();
        var _token = '{{ csrf_token() }}';

        $.post("/openssl_encode", {
            key: key,
            iv: iv,
            data: data,
            method: method,
            mode: mode,
            options: options,
            _token: _token,
        }, function(d){
            $(".result").val(d);
        })
    });


    $("select").on('change', function(){
        var v = [];
        $("select").each(function(){
            v.push($(this).val());
        });
        $.cookie('encrypt', v.join('|'), {'expires': 10, 'path': '/encrypt/'});
    });

    var init_v = $.cookie('encrypt'), i=0;
    if(init_v){
        init_v = init_v.split('|');
        for(i in init_v){
            $("select").eq(i).val(init_v[i]);
        }
    }

})();
</script>
@stop