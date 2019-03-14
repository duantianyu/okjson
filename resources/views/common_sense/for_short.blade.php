@extends('layout')

@section('meta')
<meta name="keywords" content="简称，">
<meta name="description" content="中国省份(自治区)简称">
@stop

@section('title')
中国省份(自治区)简称 - 在线JSON校验格式化工具(OK JSON)
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
    <div class="panel panel-default">
    <div class="panel-heading">
        中国省份(自治区)简称
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-success" role="alert">
            <p>省份简称，指中国一级行政区（省级行政区）的简称。中华人民共和国自1999年12月20日对澳门恢复行使主权为止，划分为23个省、5个自治区、4个直辖市、2个特别行政区，共计34个一级行政区，之后数量一直稳定不变。</p>
            <ul>
                <li>当省份有两个或多个简称时，车牌简称取与省份全称有同字的。如：四川简称“川”或“蜀”，车牌简称取“川”字。</li>
                <li>内蒙古自治区简称为“内蒙古”，不简称“蒙”，但在车牌号中，只能使用一个字，所以用“蒙”字代替。</li>
                <li>香港特别行政区、澳门特别行政区进入内地车牌代码分别为“粤Z 港”“粤Z 澳”</li>
            </ul>
        </div>

        <table class="toolTable table list" width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <th class="separateColor">名称</th>
                <th>简称</th>
                <th>行政中心</th>
            </tr>
            <tr>
                <td>天津市</td>
                <td>津</td>
                <td>天津</td>
            </tr>
            <tr>
                <td>河北省</td>
                <td>冀 [jì]</td>
                <td>石家庄</td>
            </tr>
            <tr>
                <td>山西省</td>
                <td>晋</td>
                <td>太原</td>
            </tr>
            <tr>
                <td>内蒙古自治区</td>
                <td>内蒙古</td>
                <td>呼和浩特</td>
            </tr>
            <tr>
                <td>辽宁省</td>
                <td>辽</td>
                <td>沈阳</td>
            </tr>
            <tr>
                <td>吉林省</td>
                <td>吉</td>
                <td>长春</td>
            </tr>
            <tr>
                <td>黑龙江省</td>
                <td>黑</td>
                <td>哈尔滨</td>
            </tr>
            <tr>
                <td>上海市</td>
                <td>沪 [hù]</td>
                <td>上海</td>
            </tr>
            <tr>
                <td>江苏省</td>
                <td>苏</td>
                <td>南京</td>
            </tr>
            <tr>
                <td>浙江省</td>
                <td>浙</td>
                <td>杭州</td>
            </tr>
            <tr>
                <td>安徽省</td>
                <td>皖 [wǎn]</td>
                <td>合肥</td>
            </tr>
            <tr>
                <td>福建省</td>
                <td>闽 [mǐn]</td>
                <td>福州</td>
            </tr>
            <tr>
                <td>江西省</td>
                <td>赣 [gàn]</td>
                <td>南昌</td>
            </tr>
            <tr>
                <td>山东省</td>
                <td>鲁 [lǔ]</td>
                <td>济南</td>
            </tr>
            <tr>
                <td>河南省</td>
                <td>豫 [yù]</td>
                <td>郑州</td>
            </tr>
            <tr>
                <td>湖北省</td>
                <td>鄂 [è]</td>
                <td>武汉</td>
            </tr>
            <tr>
                <td>湖南省</td>
                <td>湘 [xiāng]</td>
                <td>长沙</td>
            </tr>
            <tr>
                <td>广东省</td>
                <td>粤 [yuè]</td>
                <td>广州</td>
            </tr>
            <tr>
                <td>广西壮族自治区</td>
                <td>桂 [guì]</td>
                <td>南宁</td>
            </tr>
            <tr>
                <td>海南省</td>
                <td>琼 [qióng]</td>
                <td>海口</td>
            </tr>
            <tr>
                <td>四川省</td>
                <td>川或蜀 [shǔ]</td>
                <td>成都</td>
            </tr>
            <tr>
                <td>贵州省</td>
                <td>贵或黔 [qián]</td>
                <td>贵阳</td>
            </tr>
            <tr>
                <td>云南省</td>
                <td>云或滇 [diān]</td>
                <td>昆明</td>
            </tr>
            <tr>
                <td>重庆市</td>
                <td>渝 [yú]</td>
                <td>重庆</td>
            </tr>
            <tr>
                <td>西藏自治区</td>
                <td>藏 [zàng]</td>
                <td>拉萨</td>
            </tr>
            <tr>
                <td>陕西省</td>
                <td>陕 [shǎn]或秦 [qín]</td>
                <td>西安</td>
            </tr>
            <tr>
                <td>甘肃省</td>
                <td>甘或陇 [lǒng]</td>
                <td>兰州</td>
            </tr>
            <tr>
                <td>青海省</td>
                <td>青</td>
                <td>西宁</td>
            </tr>
            <tr>
                <td>宁夏回族自治区</td>
                <td>宁</td>
                <td>银川</td>
            </tr>
            <tr>
                <td>新疆维吾尔自治区</td>
                <td>新</td>
                <td>乌鲁木齐</td>
            </tr>
            <tr>
                <td>香港特别行政区</td>
                <td>港</td>
                <td>香港</td>
            </tr>
            <tr>
                <td>澳门特别行政区</td>
                <td>澳</td>
                <td>澳门</td>
            </tr>
            <tr>
                <td>台湾省</td>
                <td>台</td>
                <td>台北</td>
            </tr>

        </table>
    </div>
</div>
@stop