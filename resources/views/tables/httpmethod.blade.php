@extends('layout')

@section('meta')
<meta name="keywords" content="HTTP请求方法对照表">
<meta name="description" content="提供HTTP请求方法对照表">
@stop

@section('title')
HTTP请求方法对照表 - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<style>
    .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
        border: 1px solid #ddd;
        line-height: 18px;
    }
</style>
@stop


@section('content')
@include('tables.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        HTTP请求方法对照表
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">

                <h3>HTTP Request Method <small>共计15种</small></h3>

                <table class="table table-bordered list">

                    <tr>
                        <th width="5%">序号</th>
                        <th width="15%">方法</th>
                        <th>描述</th>
                    </tr>


                    <tr>
                        <td>1</td>
                        <td>GET</td>
                        <td>请求指定的页面信息，并返回实体主体。</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>HEAD</td>
                        <td>类似于get请求，只不过返回的响应中没有具体的内容，用于获取报头</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>POST</td>
                        <td>向指定资源提交数据进行处理请求（例如提交表单或者上传文件）。数据被包含在请求体中。POST请求可能会导致新的资源的建立和/或已有资源的修改。</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>PUT</td>
                        <td>从客户端向服务器传送的数据取代指定的文档的内容。</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>DELETE</td>
                        <td>请求服务器删除指定的页面。</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>CONNECT</td>
                        <td>HTTP/1.1协议中预留给能够将连接改为管道方式的代理服务器。</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>OPTIONS</td>
                        <td>允许客户端查看服务器的性能。</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>TRACE</td>
                        <td>回显服务器收到的请求，主要用于测试或诊断。</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>PATCH</td>
                        <td>实体中包含一个表，表中说明与该URI所表示的原内容的区别。</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>MOVE</td>
                        <td>请求服务器将指定的页面移至另一个网络地址。</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>COPY</td>
                        <td>请求服务器将指定的页面拷贝至另一个网络地址。</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>LINK</td>
                        <td>请求服务器建立链接关系。</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>UNLINK</td>
                        <td>断开链接关系。</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>WRAPPED</td>
                        <td>允许客户端发送经过封装的请求。</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>Extension-mothed</td>
                        <td>在不改动协议的前提下，可增加另外的方法。</td>
                    </tr>

                </table>



            </div>
        </div>
    </div>
</div>
@stop
