@extends('layout')

@section('meta')
<meta name="keywords" content="JSON在线解析,JSON在线视图,JSON,JSON在线,json解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
<meta name="description" content="json解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证,JSON在线解析,JSON在线视图">
@stop

@section('head_css')
<link href="{{ asset('css/jsonFormater.css') }}" rel="stylesheet" type="text/css">
@stop



@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        JSON格式化高亮
    </div>

    <div class="panel-body">
        <div class="form-group">
            <textarea class="form-control json" placeholder="请输入要格式化的JSON" rows="5">{"number":6,"array":[],"null":null,"string":"oOK JSON","boolean":true,"obj":{},"level1":{"level2":{"level3":{"level4":{"level5":{"level6":{"level7":{"level8":{"level9":{"level10":{}}}}}}}}}}}</textarea>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-format">格式化</button>&nbsp;&nbsp;
            <button type="button" class="btn btn-primary btn-clean">清空</button>&nbsp;&nbsp;

            <label>缩进：</label>
            <label class="radio-inline">
                <input type="radio" name="tab" class="tab" value="2">2
            </label>
            <label class="radio-inline">
                <input type="radio" name="tab" class="tab" value="4" checked>4
            </label>

            &nbsp;&nbsp;&nbsp;&nbsp;<label><input type="checkbox" class="QuoteKeys" checked>&nbsp;引号</label>
            &nbsp;&nbsp;<label><input type="checkbox" class="CollapsibleView" checked>&nbsp;显示控制</label>

            &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:;" class="expandAll">展开</a>&nbsp;&nbsp;
            <a href="javascript:;" class="collapseAll">叠起</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="3">2级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="4">3级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="5">4级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="6">5级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="7">6级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="8">7级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="9">8级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="10">9级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="11">10级</a>&nbsp;&nbsp;
            <a href="javascript:;" class="expand" data-level="12">11级</a>
        </div>

        <div class="Canvas"></div>
    </div>
</div>

@stop


@section('foot_js')
<script src="{{ asset('js/jsonFormater.js') }}" type="text/javascript"></script>

<script type="text/javascript">
(function(){

    $(document).ready(function () {
        var jf;
        var format = function(){
            var options = {
                dom: '.Canvas',
                isCollapsible: $('.CollapsibleView').prop('checked'),
                quoteKeys: $('.QuoteKeys').prop('checked'),
                tabSize: $('input[name=tab]:checked').val()
            };

            jf = new JsonFormater(options);
            jf.doFormat($('.json').val());
        };

        $(".btn-clean").on('click', function(){
            $('.json').val('');
        });
        $(".btn-format").on('click', function(){
            format();
        });
        $('.expandAll').click(function () {
            jf.expandAll();
        });
        $('.collapseAll').click(function () {
            jf.collapseAll();
        });
        $('.tab, .CollapsibleView, .QuoteKeys').change(function () {
            format();
        });
        $('.expand').click(function () {
            format();
            var level = $(this).data('level');
            jf.collapseLevel(level);
        });

    });
})();
</script>
@stop