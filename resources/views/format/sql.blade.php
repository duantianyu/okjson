@extends('layout')

@section('meta')
<meta name="keywords" content="JSON,JSON在线,json解析, json在线解析,json教程,json数组,JSON 校验,格式化JSON,xml转json 工具,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化, json在线,json 在线验证,json 在线校验">
<meta name="description" content="json解析,json在线解析,json教程,json数组,JSON在线,JSON在线校验工具,JSON,JSON 校验,格式化,xml转json 工具,json视图,在线json格式化工具,json 格式化,json格式化工具,json字符串格式化,json 在线查看器,json在线,json 在线验证">
@stop

@section('title')
SQL格式化、压缩 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/bdsstyle.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')


<div class="panel panel-default">
    <div class="panel-heading">
        SQL格式化、压缩
    </div>
    <div class="panel-body">

        <div class="alert alert-success" role="alert">
            <p><code>[SQL格式化]</code>，<code>[SQL压缩]</code>，<code>[SQL美化]</code>，本工具针对<code>SQL语句</code>做格式化、美化处理。</p>
        </div>

        <div class="input">
            <textarea class="form-control" rows="10" id="input" placeholder="请输入要处理的sql"></textarea>
        </div>
        <div style="height: 10px"></div>
        <button type="button" class="btn btn-primary format" data-type="format">格式化</button>
        <button type="button" class="btn btn-primary format" data-type="compress">压缩</button>
        <button type="button" class="btn btn-warning" id="clear-input">清空</button>
        <button type="button" class="btn btn-success" id="copy" data-clipboard-action="copy" data-clipboard-target="#output">复制结果</button>
        <button type="button" class="btn btn-success" id="sql-example">SQL样例</button>
        <div style="height: 10px"></div>
        <div class="output">
            <div class="form-control" id="output"></div>
        </div>

        <div style="height: 10px"></div>
        <p id="message"></p>
        <pre class="success" id="results">
1、创建数据库
CREATE DATABASE database-name

2、删除数据库
drop database dbname

3、备份mysql
mysqldump -u 用户名 -p 数据库名 > 导出的文件名
如我输入的命令行:mysqldump -u root -p news > news.sql   (输入后会让你输入进入MySQL的密码)

4、创建新表
create table tabname(col1 type1 [not null] [primary key],col2 type2 [not null],..)

根据已有的表创建新表：
A：create table tab_new like tab_old (使用旧表创建新表)
B：create table tab_new as select col1,col2… from tab_old definition only

5、删除新表
drop table tabname

6、增加一个列
Alter table tabname add column col type
注：列增加后将不能删除。DB2中列加上后数据类型也不能改变，唯一能改变的是增加varchar类型的长度。

7、添加主键： Alter table tabname add primary key(col)
删除主键： Alter table tabname drop primary key(col)

8、创建索引：create [unique] index idxname on tabname(col….)
删除索引：drop index idxname
注：索引是不可更改的，想更改必须删除重新建。

9、创建视图：create view viewname as select statement
删除视图：drop view viewname

10、几个简单的基本的sql语句
选择：select * from table1 where 范围
插入：insert into table1(field1,field2) values(value1,value2)
删除：delete from table1 where 范围
更新：update table1 set field1=value1 where 范围
查找：select * from table1 where field1 like ’%value1%’ ---like的语法很精妙，查资料!
排序：select * from table1 order by field1,field2 [desc]
总数：select count as totalcount from table1
求和：select sum(field1) as sumvalue from table1
平均：select avg(field1) as avgvalue from table1
最大：select max(field1) as maxvalue from table1
最小：select min(field1) as minvalue from table1
</pre>
    </div>
</div>


@stop


@section('foot_js')
<script src="{{ asset('js/lib/clipboard/clipboard.min.js') }}"></script>
<script>
(function () {

    //$('#output').hide();
    $('#output').height($('#input').height() + 'px');
//    $('#output').width($('#input').width() + 'px');

    var input = $('#input');
    $('.format').click(function(e){
        var inputdata = input.val();
        if (inputdata) {
            $.ajax({
                type: 'post',
                url: '/sql',
                data: {"query":inputdata, "type": $(this).data('type'), _token:'{{ csrf_token() }}'},
                success: function(data){
//                    $('#output').show();
//                    $('#input').hide();
                    $('#output').height('auto');
                    $('#output').html(data.result);
                    $('#output pre').css('border', 'none');
                    showmsg('success', '成功');
                },
                error: function(){
                    showmsg('danger', '网络错误');
                }
            })
        } else {
            showmsg('danger', '输入为空');
        }
        e.preventDefault();
    });
    $('#sql-example').click(function(e){
        input.val($('#sql-template').html());
        //input.clearSelection();
        input.focus(false);
        e.preventDefault();
    });
    $('#clear-input').click(function(e){
        input.val("").height('100px');
        $('#output').html("");
        input.focus();
        e.preventDefault();
    });
    // 复制相关的处理
    var clipboard = new Clipboard('#copy');
    clipboard.on('success', function(e) {
        showmsg("success", "复制成功")
        e.clearSelection();
    });
    clipboard.on('error', function(e) {
        showmsg("danger", "复制失败，请手动复制")
    });
    function showmsg(type, msg) {
        $('#message').hide().removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg).show(100);
    }
})()
</script>

<script type="text/template" id="sql-template">
SELECT count(*),`Column1`,`Testing`, `Testing Three` FROM `Table1`
WHERE Column1 = 'testing' AND ( (`Column2` = `Column3` OR Column4 >= NOW()) )
GROUP BY Column1 ORDER BY Column3 DESC LIMIT 5,10
</script>
@stop