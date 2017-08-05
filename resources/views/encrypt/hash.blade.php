@extends('layout')

@section('meta')
<meta name="keywords" content="在线Hash计算工具, hash校验, 哈希校验">
<meta name="description" content="okjson提供最全的hash在线校验工具。">
@stop

@section('title')
在线Hash计算工具 - 在线JSON校验格式化工具(OK JSON)
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        在线Hash计算器
    </div>
    <div class="panel-body">

        <div class="alert alert-success" role="alert">
            <p>使用各种算法计算字符串的<code>Hash</code>值</p>
        </div>

        <div class="form-group">
            <textarea class="form-control data" rows="3" placeholder="请输入要加密的内容"></textarea>
        </div>

        <div class="form-group form-inline">
            <label>算法</label>
            <select class="form-control algo">
                <option value="md2">md2</option>
                <option value="md4">md4</option>
                <option value="md5" selected>md5</option>
                <option value="sha1">sha1</option>
                <option value="sha224">sha224</option>
                <option value="sha256">sha256</option>
                <option value="sha384">sha384</option>
                <option value="sha512">sha512</option>
                <option value="ripemd128">ripemd128</option>
                <option value="ripemd160">ripemd160</option>
                <option value="ripemd256">ripemd256</option>
                <option value="ripemd320">ripemd320</option>
                <option value="whirlpool">whirlpool</option>
                <option value="tiger128,3">tiger128,3</option>
                <option value="tiger160,3">tiger160,3</option>
                <option value="tiger192,3">tiger192,3</option>
                <option value="tiger128,4">tiger128,4</option>
                <option value="tiger160,4">tiger160,4</option>
                <option value="tiger192,4">tiger192,4</option>
                <option value="snefru">snefru</option>
                <option value="snefru256">snefru256</option>
                <option value="gost">gost</option>
                <option value="gost-crypto">gost-crypto</option>
                <option value="adler32">adler32</option>
                <option value="crc32">crc32</option>
                <option value="crc32b">crc32b</option>
                <option value="fnv132">fnv132</option>
                <option value="fnv1a32">fnv1a32</option>
                <option value="fnv164">fnv164</option>
                <option value="fnv1a64">fnv1a64</option>
                <option value="joaat">joaat</option>
                <option value="haval128,3">haval128,3</option>
                <option value="haval160,3">haval160,3</option>
                <option value="haval192,3">haval192,3</option>
                <option value="haval224,3">haval224,3</option>
                <option value="haval256,3">haval256,3</option>
                <option value="haval128,4">haval128,4</option>
                <option value="haval160,4">haval160,4</option>
                <option value="haval192,4">haval192,4</option>
                <option value="haval224,4">haval224,4</option>
                <option value="haval256,4">haval256,4</option>
                <option value="haval128,5">haval128,5</option>
                <option value="haval160,5">haval160,5</option>
                <option value="haval192,5">haval192,5</option>
                <option value="haval224,5">haval224,5</option>
                <option value="haval256,5">haval256,5</option>
            </select>

        </div>

        <button type="button" class="btn btn-primary format btn-encode">加密</button>
        <div style="height: 10px;"></div>

        <div class="form-group">
            <label>Result</label>
            <textarea class="form-control result" rows="3" readonly="readonly"></textarea>
        </div>

    </div>
</div>

@stop


@section('foot_js')
<script type="text/javascript">
(function(){

    $(".btn-encode").on('click', function(){
        var data = $(".data").val();
        var algo = $(".algo").val();
        var _token = '{{ csrf_token() }}';

        $.post("/hash", {
            data: data,
            algo: algo,
            _token: _token,
        }, function(d){
            $(".result").val(d);
        })
    });


})();
</script>
@stop