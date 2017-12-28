@extends('layout')

@section('meta')
<meta name="keywords" content="在线仿站工具,模板小偷,网页模板在线下载工具,网页模版下载器">
<meta name="description" content="本工具可以在线下载单页面、JS文件、CSS文件、网页图片以及CSS文件里的图片，保留原始目录结构，并且免费打包下载!">
@stop

@section('title')
正则表达式测试工具/常用正则表达式/正则代码生成  - 在线JSON校验格式化工具(OK JSON)
@stop

@section('head_css')
<link href="{{ asset('css/jquery-linedtextarea.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/regex.css') }}" rel="stylesheet" type="text/css">
@stop


@section('content')
@include('tools.tab')

    <div class="panel panel-default">
    <div class="panel-heading">
        网页模板在线下载工具 beta
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="alert alert-info" role="alert">
            <p>正则表达式测试工具, 常用正则表达式, 正则代码生成, 让正则变得简单</p>
        </div>

        <div class="" id="options">
            <label for="flagG" class="hidden"><input id="flagG" type="checkbox" checked="checked"/>全部(g)</label>
            <label for="flagI"><input id="flagI" type="checkbox"/> 不区分大小写(i)</label>
            <label for="flagM"><input id="flagM" type="checkbox"/> 多行(m)</label>
            <label for="flagS"><input id="flagS" type="checkbox"/> 单行(s)</label>
            <input id="highlightSyntax" class="hidden" type="checkbox" checked="checked"/>
            <input id="highlightMatches" class="hidden" type="checkbox" checked="checked"/>
            <input id="invertMatches" class="hidden" type="checkbox"/>
            <!-- <a class="dropdown" href="#">常用正则</a> -->
        </div>
        <div id="commonRegex">
            <div class="hd">常用正则：</div>
            <ul class="bd">
                <li><a href="#" data-regex="\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}">匹配邮箱</a></li>
                <li><a href="#" data-regex="[\u4e00-\u9fa5]">匹配中文</a></li>
                <li><a href="#" data-regex="[^\x00-\xff]">匹配双字节字符（包含汉字）</a></li>
                <li><a href="#" data-regex="([01]?\d|2[0-3]):[0-5]?\d:[0-5]?\d">匹配时间（时:分:秒）</a></li>
                <li><a href="#" data-regex="(\d+)\.(\d+)\.(\d+)\.(\d+)">匹配IP（IPV4）</a></li>
                <li><a href="#" data-regex="[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)">匹配身份证</a></li>
                <li><a href="#"
                       data-regex="((((1[6-9]|[2-9]\d)\d{2})-(1[02]|0?[13578])-([12]\d|3[01]|0?[1-9]))|(((1[6-9]|[2-9]\d)\d{2})-(1[012]|0?[13456789])-([12]\d|30|0?[1-9]))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(1\d|2[0-8]|0?[1-9]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))">匹配日期（年-月-日）</a>
                </li>
                <li><a href="#"
                       data-regex="((((1[6-9]|[2-9]\d)\d{2})/(1[02]|0?[13578])/([12]\d|3[01]|0?[1-9]))|(((1[6-9]|[2-9]\d)\d{2})/(1[012]|0?[13456789])/([12]\d|30|0?[1-9]))|(((1[6-9]|[2-9]\d)\d{2})-0?2-(1\d|2[0-8]|0?[1-9]))|(((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))-0?2-29-))">匹配日期（年/月/日）</a>
                </li>
                <li><a href="#" data-regex="[1-9]\d*">匹配正整数</a></li>
                <li><a href="#" data-regex="-[1-9]\d*">匹配负整数</a></li>
                <li><a href="#" data-regex="(13\d|14[57]|15[^4,\D]|17[13678]|18\d)\d{8}|170[0589]\d{7}">匹配手机号</a></li>
                {{--<li><a href="#" data-regex="ed2k://\|file\|([^\|]+?)\|(\d+?)\|([0-9a-zA-Z]{32})\|((?:/\|sources,([^\s\|]+?)\||h=([0-9a-zA-Z]{32})\||s=([^\s\|]+?)\||p=([^\s\|]+?)\|)*)/">电驴链接</a></li>--}}
            </ul>
        </div>
        <div id="search" class="smartField">
            <textarea class="form-control" cols="100" rows="3" tabindex="1">\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}</textarea>
        </div>
        {{--<div class="clearfix" style="padding: 5px 0;">
            <button type="button" id="generate"
                    data-url="http://tool.lu/regex/ajax.html">生成程序代码
            </button>
        </div>--}}
        <div id="input" class="smartField">
            <textarea class="form-control" cols="100" rows="10" tabindex="2">下面是一些测试实例:
2017-08-15 正则表达式测试工具上线
2017/08/15
todo: 加上一些常用的正则表达式
notice: 由于我们使用的是js的正则引擎，所以暂时还不能支持逆序环视
demo@qq.com
test-demo@vip.qq.com
i+box@gmail.com
demo@live.com
127.0.0.1
15201159673
http://tool.lu/
123456789012345
330503197610083849
23088119820205077X
16:09:22</textarea>
        </div>

        <div style="height: 10px"></div>
        <div class="alert alert-info" role="alert">
            <p>
                <h2>一、校验数字的表达式</h2>
                <ul><li>
                        数字：<code>^[0-9]*$</code></li><li>

                        n位的数字：<code>^\d{n}$</code></li><li>
                        至少n位的数字<code>：^\d{n,}$</code></li><li>
                        m-n位的数字：<code>^\d{m,n}$</code></li><li>
                        零和非零开头的数字：<code>^(0|[1-9][0-9]*)$</code></li><li>
                        非零开头的最多带两位小数的数字：<code>^([1-9][0-9]*)+(.[0-9]{1,2})?$</code></li><li>
                        带1-2位小数的正数或负数：<code>^(\-)?\d+(\.\d{1,2})?$</code></li><li>
                        正数、负数、和小数：<code>^(\-|\+)?\d+(\.\d+)?$</code></li><li>
                        有两位小数的正实数：<code>^[0-9]+(\.[0-9]{2})?$</code></li><li>
                        有1~3位小数的正实数：<code>^[0-9]+(\.[0-9]{1,3})?$</code></li><li>
                        非零的正整数：<code>^[1-9]\d*$ 或 ^([1-9][0-9]*){1,3}$ 或 ^\+?[1-9][0-9]*$</code></li><li>
                        非零的负整数：<code>^\-[1-9][]0-9"*$ 或 ^-[1-9]\d*$</code></li><li>
                        非负整数：<code>^\d+$ 或 ^[1-9]\d*|0$</code></li><li>
                        非正整数：<code>^-[1-9]\d*|0$ 或 ^((-\d+)|(0+))$</code></li><li>
                        非负浮点数：<code>^\d+(\.\d+)?$ 或 ^[1-9]\d*\.\d*|0\.\d*[1-9]\d*|0?\.0+|0$</code></li><li>
                        非正浮点数：<code>^((-\d+(\.\d+)?)|(0+(\.0+)?))$ 或 ^(-([1-9]\d*\.\d*|0\.\d*[1-9]\d*))|0?\.0+|0$</code></li><li>
                        正浮点数：<code>^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$ 或 ^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$</code></li><li>
                        负浮点数：<code>^-([1-9]\d*\.\d*|0\.\d*[1-9]\d*)$ 或 ^(-(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*)))$</code></li><li>
                        浮点数：<code>^(-?\d+)(\.\d+)?$ 或 ^-?([1-9]\d*\.\d*|0\.\d*[1-9]\d*|0?\.0+|0)$</code></li></ul>

                <hr>
                <h2>二、校验字符的表达式</h2>
                <ul><li>
                        汉字：<code>^[\u4e00-\u9fa5]{0,}$</code></li><li>
                        英文和数字：<code>^[A-Za-z0-9]+$ 或 ^[A-Za-z0-9]{4,40}$</code></li><li>
                        长度为3-20的所有字符：<code>^.{3,20}$</code></li><li>
                        由26个英文字母组成的字符串：<code>^[A-Za-z]+$</code></li><li>
                        由26个大写英文字母组成的字符串：<code>^[A-Z]+$</code></li><li>
                        由26个小写英文字母组成的字符串：<code>^[a-z]+$</code></li><li>
                        由数字和26个英文字母组成的字符串：<code>^[A-Za-z0-9]+$</code></li><li>
                        由数字、26个英文字母或者下划线组成的字符串：<code>^\w+$ 或 ^\w{3,20}$</code></li><li>
                        中文、英文、数字包括下划线：<code>^[\u4E00-\u9FA5A-Za-z0-9_]+$</code></li><li>
                        中文、英文、数字但不包括下划线等符号：<code>^[\u4E00-\u9FA5A-Za-z0-9]+$ 或 ^[\u4E00-\u9FA5A-Za-z0-9]{2,20}$</code></li><li>
                        可以输入含有^%&',;=?$\"等字符：<code>[^%&',;=?$\x22]+</code></li><li>
                        禁止输入含有~的字符：<code>[^~\x22]+</code></li></ul>
                <hr>
                <h2>三、特殊需求表达式</h2>
                <ul><li>
                        Email地址：<code>^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$</code></li><li>
                        域名：<code>[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(/.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+/.?</code></li><li>
                        InternetURL：<code>[a-zA-z]+://[^\s]* 或 ^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$</code></li><li>
                        手机号码：<code>^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$</code></li><li>
                        电话号码("XXX-XXXXXXX"、"XXXX-XXXXXXXX"、"XXX-XXXXXXX"、"XXX-XXXXXXXX"、"XXXXXXX"和"XXXXXXXX)：<code>^(\(\d{3,4}-)|\d{3.4}-)?\d{7,8}$ </code></li><li>
                        国内电话号码(0511-4405222、021-87888822)：<code>\d{3}-\d{8}|\d{4}-\d{7}</code></li>
                    <li>电话号码正则表达式（支持手机号码，3-4位区号，7-8位直播号码，1－4位分机号）: <code>((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)</code></li>

                    <li>
                        身份证号(15位、18位数字)，最后一位是校验位，可能为数字或字符X：<code>(^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X|x)$)</code></li><li>
                        帐号是否合法(字母开头，允许5-16字节，允许字母数字下划线)：<code>^[a-zA-Z][a-zA-Z0-9_]{4,15}$</code></li><li>
                        密码(以字母开头，长度在6~18之间，只能包含字母、数字和下划线)：<code>^[a-zA-Z]\w{5,17}$</code></li><li>
                        强密码(必须包含大小写字母和数字的组合，不能使用特殊字符，长度在8-10之间)：<code>^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,10}$  </code></li><li>
                        日期格式：<code>^\d{4}-\d{1,2}-\d{1,2}</code></li><li>
                        一年的12个月(01～09和1～12)：<code>^(0?[1-9]|1[0-2])$</code></li><li>
                        一个月的31天(01～09和1～31)：<code>^((0?[1-9])|((1|2)[0-9])|30|31)$ </code></li><li>
                        钱的输入格式：<ol><li>
                                有四种钱的表示形式我们可以接受:"10000.00" 和 "10,000.00", 和没有 "分" 的 "10000" 和 "10,000"：<code>^[1-9][0-9]*$ </code></li><li>
                                这表示任意一个不以0开头的数字,但是,这也意味着一个字符"0"不通过,所以我们采用下面的形式：<code>^(0|[1-9][0-9]*)$ </code></li><li>
                                一个0或者一个不以0开头的数字.我们还可以允许开头有一个负号：<code>^(0|-?[1-9][0-9]*)$ </code></li><li>
                                这表示一个0或者一个可能为负的开头不为0的数字.让用户以0开头好了.把负号的也去掉,因为钱总不能是负的吧。下面我们要加的是说明可能的小数部分：<code>^[0-9]+(.[0-9]+)?$ </code></li><li>
                                必须说明的是,小数点后面至少应该有1位数,所以"10."是不通过的,但是 "10" 和 "10.2" 是通过的：<code>^[0-9]+(.[0-9]{2})?$ </code></li><li>
                                这样我们规定小数点后面必须有两位,如果你认为太苛刻了,可以这样：<code>^[0-9]+(.[0-9]{1,2})?$ </code></li><li>
                                这样就允许用户只写一位小数.下面我们该考虑数字中的逗号了,我们可以这样：<code>^[0-9]{1,3}(,[0-9]{3})*(.[0-9]{1,2})?$ </code></li><li>
                                1到3个数字,后面跟着任意个 逗号+3个数字,逗号成为可选,而不是必须：<code>^([0-9]+|[0-9]{1,3}(,[0-9]{3})*)(.[0-9]{1,2})?$ </code></li><li>
                                备注：这就是最终结果了,别忘了"+"可以用"*"替代如果你觉得空字符串也可以接受的话(奇怪,为什么?)最后,别忘了在用函数时去掉去掉那个反斜杠,一般的错误都在这里</li></ol></li><li>
                        xml文件：<code>^([a-zA-Z]+-?)+[a-zA-Z0-9]+\\.[x|X][m|M][l|L]$</code></li><li>
                        中文字符的正则表达式：<code>[\u4e00-\u9fa5]</code></li><li>
                        双字节字符：<code>[^\x00-\xff]</code>(包括汉字在内，可以用来计算字符串的长度(一个双字节字符长度计2，ASCII字符计1))</li><li>
                        空白行的正则表达式：<code>\n\s*\r</code>(可以用来删除空白行)</li><li>
                        HTML标记的正则表达式：<code><(\S*?)[^>]*>.*?</\1>|<.*? /></code>(首尾空白字符的正则表达式：^\s*|\s*$或(^\s*)|(\s*$)    (可以用来删除行首行尾的空白字符(包括空格、制表符、换页符等等)，非常有用的表达式)</li><li>
                        腾讯QQ号：<code>[1-9][0-9]{4,}</code>(腾讯QQ号从10000开始)</li><li>
                        中国邮政编码：<code>[1-9]\d{5}(?!\d)</code>(中国邮政编码为6位数字)</li><li>
                        IP地址：<code>((?:(?:25[0-5]|2[0-4]\\d|[01]?\\d?\\d)\\.){3}(?:25[0-5]|2[0-4]\\d|[01]?\\d?\\d)) </code></li></ul>
            </p>
        </div>
        <table class="table table-bordered list"><tr><td><div>元字符</div>
                </td><td><div>描述</div>
                </td></tr><tr><td><div>\</div>
                </td><td><div>将下一个字符标记符、或一个向后引用、或一个八进制转义符。例如，“\\n”匹配\n。“\n”匹配换行符。序列“\\”匹配“\”而“\(”则匹配“(”。即相当于多种编程语言中都有的“转义字符”的概念。</div>
                </td></tr><tr><td><div>^</div>
                </td><td><div>匹配输入字符串的开始位置。如果设置了RegExp对象的Multiline属性，^也匹配“\n”或“\r”之后的位置。</div>
                </td></tr><tr><td><div>$</div>
                </td><td class="selectTdClass"><div>匹配输入字符串的结束位置。如果设置了RegExp对象的Multiline属性，$也匹配“\n”或“\r”之前的位置。</div>
                </td></tr><tr><td><div>*</div>
                </td><td><div>匹配前面的子表达式任意次。例如，zo*能匹配“z”，也能匹配“zo”以及“zoo”。*等价于o{0,}</div>
                </td></tr><tr><td><div>+</div>
                </td><td><div>匹配前面的子表达式一次或多次(大于等于1次）。例如，“zo+”能匹配“zo”以及“zoo”，但不能匹配“z”。+等价于{1,}。</div>
                </td></tr><tr><td><div>?</div>
                </td><td><div>匹配前面的子表达式零次或一次。例如，“do(es)?”可以匹配“do”或“does”中的“do”。?等价于{0,1}。</div>
                </td></tr><tr><td><div>{n}</div>
                </td><td><div>n是一个非负整数。匹配确定的n次。例如，“o{2}”不能匹配“Bob”中的“o”，但是能匹配“food”中的两个o。</div>
                </td></tr><tr><td><div>{n,}</div>
                </td><td><div>n是一个非负整数。至少匹配n次。例如，“o{2,}”不能匹配“Bob”中的“o”，但能匹配“foooood”中的所有o。“o{1,}”等价于“o+”。“o{0,}”则等价于“o*”。</div>
                </td></tr><tr><td><div>{n,m}</div>
                </td><td><div>m和n均为非负整数，其中n&lt;=m。最少匹配n次且最多匹配m次。例如，“o{1,3}”将匹配“fooooood”中的前三个o为一组，后三个o为一组。“o{0,1}”等价于“o?”。请注意在逗号和两个数之间不能有空格。</div>
                </td></tr><tr><td><div>?</div>
                </td><td><div>当该字符紧跟在任何一个其他限制符（*,+,?，{n}，{n,}，{n,m}）后面时，匹配模式是非贪婪的。非贪婪模式尽可能少的匹配所搜索的字符串，而默认的贪婪模式则尽可能多的匹配所搜索的字符串。例如，对于字符串“oooo”，“o+”将尽可能多的匹配“o”，得到结果[“oooo”]，而“o+?”将尽可能少的匹配“o”，得到结果 ['o', 'o', 'o', 'o']</div>
                </td></tr><tr><td><div>.点</div>
                </td><td><div>匹配除“\r\n”之外的任何单个字符。要匹配包括“\r\n”在内的任何字符，请使用像“[\s\S]”的模式。</div>
                </td></tr><tr><td><div>(pattern)</div>
                </td><td><div>匹配pattern并获取这一匹配。所获取的匹配可以从产生的Matches集合得到，在VBScript中使用SubMatches集合，在JScript中则使用$0…$9属性。要匹配圆括号字符，请使用“\(”或“\)”。</div>
                </td></tr><tr><td><div>(?:pattern)</div>
                </td><td><div>非获取匹配，匹配pattern但不获取匹配结果，不进行存储供以后使用。这在使用或字符“(|)”来组合一个模式的各个部分时很有用。例如“industr(?:y|ies)”就是一个比“industry|industries”更简略的表达式。</div>
                </td></tr><tr><td><div>(?=pattern)</div>
                </td><td><div>非获取匹配，正向肯定预查，在任何匹配pattern的字符串开始处匹配查找字符串，该匹配不需要获取供以后使用。例如，“Windows(?=95|98|NT|2000)”能匹配“Windows2000”中的“Windows”，但不能匹配“Windows3.1”中的“Windows”。预查不消耗字符，也就是说，在一个匹配发生后，在最后一次匹配之后立即开始下一次匹配的搜索，而不是从包含预查的字符之后开始。</div>
                </td></tr><tr><td><div>(?!pattern)</div>
                </td><td><div>非获取匹配，正向否定预查，在任何不匹配pattern的字符串开始处匹配查找字符串，该匹配不需要获取供以后使用。例如“Windows(?!95|98|NT|2000)”能匹配“Windows3.1”中的“Windows”，但不能匹配“Windows2000”中的“Windows”。</div>
                </td></tr><tr><td><div>(?&lt;=pattern)</div>
                </td><td><div>非获取匹配，反向肯定预查，与正向肯定预查类似，只是方向相反。例如，“(?&lt;=95|98|NT|2000)Windows”能匹配“2000Windows”中的“Windows”，但不能匹配“3.1Windows”中的“Windows”。</div>
                </td></tr><tr><td><div>(?&lt;!pattern)</div>
                </td><td><div>非获取匹配，反向否定预查，与正向否定预查类似，只是方向相反。例如“(?&lt;!95|98|NT|2000)Windows”能匹配“3.1Windows”中的“Windows”，但不能匹配“2000Windows”中的“Windows”。这个地方不正确，有问题</div>
                    <div>此处用或任意一项都不能超过2位，如“(?&lt;!95|98|NT|20)Windows正确，“(?&lt;!95|980|NT|20)Windows 报错，若是单独使用则无限制，如(?&lt;!2000)Windows 正确匹配</div>
                </td></tr><tr><td><div>x|y</div>
                </td><td><div>匹配x或y。例如，“z|food”能匹配“z”或“food”(此处请谨慎)。“[z|f]ood”则匹配“zood”或“food”。</div>
                </td></tr><tr><td><div>[xyz]</div>
                </td><td><div>字符集合。匹配所包含的任意一个字符。例如，“[abc]”可以匹配“plain”中的“a”。</div>
                </td></tr><tr><td><div>[^xyz]</div>
                </td><td><div>负值字符集合。匹配未包含的任意字符。例如，“[^abc]”可以匹配“plain”中的“plin”。</div>
                </td></tr><tr><td><div>[a-z]</div>
                </td><td><div>字符范围。匹配指定范围内的任意字符。例如，“[a-z]”可以匹配“a”到“z”范围内的任意小写字母字符。</div>
                    <div>注意:只有连字符在字符组内部时,并且出现在两个字符之间时,才能表示字符的范围; 如果出字符组的开头,则只能表示连字符本身.</div>
                </td></tr><tr><td><div>[^a-z]</div>
                </td><td><div>负值字符范围。匹配任何不在指定范围内的任意字符。例如，“[^a-z]”可以匹配任何不在“a”到“z”范围内的任意字符。</div>
                </td></tr><tr><td><div>\b</div>
                </td><td><div>匹配一个单词边界，也就是指单词和空格间的位置（即正则表达式的“匹配”有两种概念，一种是匹配字符，一种是匹配位置，这里的\b就是匹配位置的）。例如，“er\b”可以匹配“never”中的“er”，但不能匹配“verb”中的“er”。</div>
                </td></tr><tr><td><div>\B</div>
                </td><td><div>匹配非单词边界。“er\B”能匹配“verb”中的“er”，但不能匹配“never”中的“er”。</div>
                </td></tr><tr><td><div>\cx</div>
                </td><td><div>匹配由x指明的控制字符。例如，\cM匹配一个Control-M或回车符。x的值必须为A-Z或a-z之一。否则，将c视为一个原义的“c”字符。</div>
                </td></tr><tr><td><div>\d</div>
                </td><td><div>匹配一个数字字符。等价于[0-9]。grep 要加上-P，perl正则支持</div>
                </td></tr><tr><td><div>\D</div>
                </td><td><div>匹配一个非数字字符。等价于[^0-9]。grep要加上-P，perl正则支持</div>
                </td></tr><tr><td><div>\f</div>
                </td><td><div>匹配一个换页符。等价于\x0c和\cL。</div>
                </td></tr><tr><td><div>\n</div>
                </td><td><div>匹配一个换行符。等价于\x0a和\cJ。</div>
                </td></tr><tr><td><div>\r</div>
                </td><td><div>匹配一个回车符。等价于\x0d和\cM。</div>
                </td></tr><tr><td><div>\s</div>
                </td><td><div>匹配任何不可见字符，包括空格、制表符、换页符等等。等价于[ \f\n\r\t\v]。</div>
                </td></tr><tr><td><div>\S</div>
                </td><td><div>匹配任何可见字符。等价于[^ \f\n\r\t\v]。</div>
                </td></tr><tr><td><div>\t</div>
                </td><td><div>匹配一个制表符。等价于\x09和\cI。</div>
                </td></tr><tr><td><div>\v</div>
                </td><td><div>匹配一个垂直制表符。等价于\x0b和\cK。</div>
                </td></tr><tr><td><div>\w</div>
                </td><td><div>匹配包括下划线的任何单词字符。类似但不等价于“[A-Za-z0-9_]”，这里的"单词"字符使用Unicode字符集。</div>
                </td></tr><tr><td><div>\W</div>
                </td><td><div>匹配任何非单词字符。等价于“[^A-Za-z0-9_]”。</div>
                </td></tr><tr><td><div>\xn</div>
                </td><td><div>匹配n，其中n为十六进制转义值。十六进制转义值必须为确定的两个数字长。例如，“\x41”匹配“A”。“\x041”则等价于“\x04&amp;1”。正则表达式中可以使用ASCII编码。</div>
                </td></tr><tr><td><div>\num</div>
                </td><td><div>匹配num，其中num是一个正整数。对所获取的匹配的引用。例如，“(.)\1”匹配两个连续的相同字符。</div>
                </td></tr><tr><td><div>\n</div>
                </td><td><div>标识一个八进制转义值或一个向后引用。如果\n之前至少n个获取的子表达式，则n为向后引用。否则，如果n为八进制数字（0-7），则n为一个八进制转义值。</div>
                </td></tr><tr><td><div>\nm</div>
                </td><td><div>标识一个八进制转义值或一个向后引用。如果\nm之前至少有nm个获得子表达式，则nm为向后引用。如果\nm之前至少有n个获取，则n为一个后跟文字m的向后引用。如果前面的条件都不满足，若n和m均为八进制数字（0-7），则\nm将匹配八进制转义值nm。</div>
                </td></tr><tr><td><div>\nml</div>
                </td><td><div>如果n为八进制数字（0-7），且m和l均为八进制数字（0-7），则匹配八进制转义值nml。</div>
                </td></tr><tr><td><div>\un</div>
                </td><td><div>匹配n，其中n是一个用四个十六进制数字表示的Unicode字符。例如，\u00A9匹配版权符号（&amp;copy;）。</div>
                </td></tr><tr><td><div>\p{P}</div>
                </td><td><div>小写 p 是 property 的意思，表示 Unicode 属性，用于 Unicode 正表达式的前缀。中括号内的“P”表示Unicode 字符集七个字符属性之一：标点字符。</div>
                    <div>其他六个属性：</div>
                    <div>L：字母；</div>
                    <div>M：标记符号（一般不会单独出现）；</div>
                    <div>Z：分隔符（比如空格、换行等）；</div>
                    <div>S：符号（比如数学符号、货币符号等）；</div>
                    <div>N：数字（比如阿拉伯数字、罗马数字等）；</div>
                    <div>C：其他字符。</div>
                    <div><i>*注：此语法部分语言不支持，例：javascript。</i></div>
                </td></tr><tr><td><div>\&lt;</div>
                    <div>\&gt;</div>
                </td><td>匹配词（word）的开始（\&lt;）和结束（\&gt;）。例如正则表达式\&lt;the\&gt;能够匹配字符串"for the wise"中的"the"，但是不能匹配字符串"otherwise"中的"the"。注意：这个元字符不是所有的软件都支持的。</td></tr><tr><td>( )</td><td>将( 和 ) 之间的表达式定义为“组”（group），并且将匹配这个表达式的字符保存到一个临时区域（一个正则表达式中最多可以保存9个），它们可以用 \1 到\9 的符号来引用。</td></tr><tr><td>|</td><td>将两个匹配条件进行逻辑“或”（Or）运算。例如正则表达式(him|her) 匹配"it belongs to him"和"it belongs to her"，但是不能匹配"it belongs to them."。注意：这个元字符不是所有的软件都支持的。</td></tr></table>
    </div>
</div>
@stop


@section('foot_js')
<script src="{{ asset('js/regex.js') }}" type="text/javascript"></script>
@stop