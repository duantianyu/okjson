@extends('layout')

@section('meta')
<meta name="keywords" content="Android Manifest功能与权限描述大全">
<meta name="description" content="提供Android Manifest功能与权限描述">
@stop

@section('title')
Android Manifest功能与权限描述大全 - 在线JSON校验格式化工具(OK JSON)
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
        Android Manifest功能与权限描述大全
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <table class="table table-bordered list">
            <tr id="tit"><th style="width:25%;">权限</th><th style="width:12%;">名称</th><th style="width:60%;">描述</th></tr>
            <tr><td>android.permission.ACCESS_CHECKIN_PROPERTIES</td><td>访问登记属性</td><td>读取或写入登记check-in数据库属性表的权限</td></tr>
            <tr><td>android.permission.ACCESS_COARSE_LOCATION</td><td>获取错略位置</td><td>通过WiFi或移动基站的方式获取用户错略的经纬度信息,定位精度大概误差在30~1500米</td></tr>
            <tr><td>android.permission.ACCESS_FINE_LOCATION</td><td>获取精确位置</td><td>通过GPS芯片接收卫星的定位信息,定位精度达10米以内</td></tr>
            <tr><td>android.permission.ACCESS_LOCATION_EXTRA_COMMANDS</td><td>访问定位额外命令</td><td>允许程序访问额外的定位提供者指令</td></tr>
            <tr><td>android.permission.ACCESS_MOCK_LOCATION</td><td>获取模拟定位信息</td><td>获取模拟定位信息,一般用于帮助开发者调试应用</td></tr>
            <tr><td>android.permission.ACCESS_NETWORK_STATE</td><td>获取网络状态</td><td>获取网络信息状态,如当前的网络连接是否有效</td></tr>
            <tr><td>android.permission.ACCESS_SURFACE_FLINGER</td><td>访问Surface Flinger</td><td>Android平台上底层的图形显示支持,一般用于游戏或照相机预览界面和底层模式的屏幕截图</td></tr>
            <tr><td>android.permission.ACCESS_WIFI_STATE</td><td>获取WiFi状态</td><td>获取当前WiFi接入的状态以及WLAN热点的信息</td></tr>
            <tr><td>android.permission.ACCOUNT_MANAGER</td><td>账户管理</td><td>获取账户验证信息,主要为GMail账户信息,只有系统级进程才能访问的权限</td></tr>
            <tr><td>android.permission.AUTHENTICATE_ACCOUNTS</td><td>验证账户</td><td>允许一个程序通过账户验证方式访问账户管理ACCOUNT_MANAGER相关信息</td></tr>
            <tr><td>android.permission.BATTERY_STATS</td><td>电量统计</td><td>获取电池电量统计信息</td></tr>
            <tr><td>android.permission.BIND_APPWIDGET</td><td>绑定小插件</td><td>允许一个程序告诉appWidget服务需要访问小插件的数据库,只有非常少的应用才用到此权限</td></tr>
            <tr><td>android.permission.BIND_DEVICE_ADMIN</td><td>绑定设备管理</td><td>请求系统管理员接收者receiver,只有系统才能使用</td></tr>
            <tr><td>android.permission.BIND_INPUT_METHOD</td><td>绑定输入法</td><td>请求InputMethodService服务,只有系统才能使用</td></tr>
            <tr><td>android.permission.BIND_REMOTEVIEWS</td><td>绑定RemoteView</td><td>必须通过RemoteViewsService服务来请求,只有系统才能用</td></tr>
            <tr><td>android.permission.BIND_WALLPAPER</td><td>绑定壁纸</td><td>必须通过WallpaperService服务来请求,只有系统才能用</td></tr>
            <tr><td>android.permission.BLUETOOTH</td><td>使用蓝牙</td><td>允许程序连接配对过的蓝牙设备</td></tr>
            <tr><td>android.permission.BLUETOOTH_ADMIN</td><td>蓝牙管理</td><td>允许程序进行发现和配对新的蓝牙设备</td></tr>
            <tr><td>android.permission.BRICK</td><td>变成砖头</td><td>能够禁用手机,非常危险,顾名思义就是让手机变成砖头</td></tr>
            <tr><td>android.permission.BROADCAST_PACKAGE_REMOVED</td><td>应用删除时广播</td><td>当一个应用在删除时触发一个广播</td></tr>
            <tr><td>android.permission.BROADCAST_SMS</td><td>收到短信时广播</td><td>当收到短信时触发一个广播</td></tr>
            <tr><td>android.permission.BROADCAST_STICKY</td><td>连续广播</td><td>允许一个程序收到广播后快速收到下一个广播</td></tr>
            <tr><td>android.permission.BROADCAST_WAP_PUSH</td><td>WAP PUSH广播</td><td>WAP PUSH服务收到后触发一个广播</td></tr>
            <tr><td>android.permission.CALL_PHONE</td><td>拨打电话</td><td>允许程序从非系统拨号器里输入电话号码</td></tr>
            <tr><td>android.permission.CALL_PRIVILEGED</td><td>通话权限</td><td>允许程序拨打电话,替换系统的拨号器界面</td></tr>
            <tr><td>android.permission.CAMERA</td><td>拍照权限</td><td>允许访问摄像头进行拍照</td></tr>
            <tr><td>android.permission.CHANGE_COMPONENT_ENABLED_STATE</td><td>改变组件状态</td><td>改变组件是否启用状态</td></tr>
            <tr><td>android.permission.CHANGE_CONFIGURATION</td><td>改变配置</td><td>允许当前应用改变配置,如定位</td></tr>
            <tr><td>android.permission.CHANGE_NETWORK_STATE</td><td>改变网络状态</td><td>改变网络状态如是否能联网</td></tr>
            <tr><td>android.permission.CHANGE_WIFI_MULTICAST_STATE</td><td>改变WiFi多播状态</td><td>改变WiFi多播状态</td></tr>
            <tr><td>android.permission.CHANGE_WIFI_STATE</td><td>改变WiFi状态</td><td>改变WiFi状态</td></tr>
            <tr><td>android.permission.CLEAR_APP_CACHE</td><td>清除应用缓存</td><td>清除应用缓存</td></tr>
            <tr><td>android.permission.CLEAR_APP_USER_DATA</td><td>清除用户数据</td><td>清除应用的用户数据</td></tr>
            <tr><td>android.permission.CWJ_GROUP</td><td>底层访问权限</td><td>允许CWJ账户组访问底层信息</td></tr>
            <tr><td>android.permission.CELL_PHONE_MASTER_EX</td><td>手机优化大师扩展权限</td><td>手机优化大师扩展权限</td></tr>
            <tr><td>android.permission.CONTROL_LOCATION_UPDATES</td><td>控制定位更新</td><td>允许获得移动网络定位信息改变</td></tr>
            <tr><td>android.permission.DELETE_CACHE_FILES</td><td>删除缓存文件</td><td>允许应用删除缓存文件</td></tr>
            <tr><td>android.permission.DELETE_PACKAGES</td><td>删除应用</td><td>允许程序删除应用</td></tr>
            <tr><td>android.permission.DEVICE_POWER</td><td>电源管理</td><td>允许访问底层电源管理</td></tr>
            <tr><td>android.permission.DIAGNOSTIC</td><td>应用诊断</td><td>允许程序到RW到诊断资源</td></tr>
            <tr><td>android.permission.DISABLE_KEYGUARD</td><td>禁用键盘锁</td><td>允许程序禁用键盘锁</td></tr>
            <tr><td>android.permission.DUMP</td><td>转存系统信息</td><td>允许程序获取系统dump信息从系统服务</td></tr>
            <tr><td>android.permission.EXPAND_STATUS_BAR</td><td>状态栏控制</td><td>允许程序扩展或收缩状态栏</td></tr>
            <tr><td>android.permission.FACTORY_TEST</td><td>工厂测试模式</td><td>允许程序运行工厂测试模式</td></tr>
            <tr><td>android.permission.FLASHLIGHT</td><td>使用闪光灯</td><td>允许访问闪光灯</td></tr>
            <tr><td>android.permission.FORCE_BACK</td><td>强制后退</td><td>允许程序强制使用back后退按键,无论Activity是否在顶层</td></tr>
            <tr><td>android.permission.GET_ACCOUNTS</td><td>访问账户Gmail列表</td><td>访问GMail账户列表</td></tr>
            <tr><td>android.permission.GET_PACKAGE_SIZE</td><td>获取应用大小</td><td>获取应用的文件大小</td></tr>
            <tr><td>android.permission.GET_TASKS</td><td>获取任务信息</td><td>允许程序获取当前或最近运行的应用</td></tr>
            <tr><td>android.permission.GLOBAL_SEARCH</td><td>允许全局搜索</td><td>允许程序使用全局搜索功能</td></tr>
            <tr><td>android.permission.HARDWARE_TEST</td><td>硬件测试</td><td>访问硬件辅助设备,用于硬件测试</td></tr>
            <tr><td>android.permission.INJECT_EVENTS</td><td>注射事件</td><td>允许访问本程序的底层事件,获取按键、轨迹球的事件流</td></tr>
            <tr><td>android.permission.INSTALL_LOCATION_PROVIDER</td><td>安装定位提供</td><td>安装定位提供</td></tr>
            <tr><td>android.permission.INSTALL_PACKAGES</td><td>安装应用程序</td><td>允许程序安装应用</td></tr>
            <tr><td>android.permission.INTERNAL_SYSTEM_WINDOW</td><td>内部系统窗口</td><td>允许程序打开内部窗口,不对第三方应用程序开放此权限</td></tr>
            <tr><td>android.permission.INTERNET</td><td>访问网络</td><td>访问网络连接,可能产生GPRS流量</td></tr>
            <tr><td>android.permission.KILL_BACKGROUND_PROCESSES</td><td>结束后台进程</td><td>允许程序调用killBackgroundProcesses(String).方法结束后台进程</td></tr>
            <tr><td>android.permission.MANAGE_ACCOUNTS</td><td>管理账户</td><td>允许程序管理AccountManager中的账户列表</td></tr>
            <tr><td>android.permission.MANAGE_APP_TOKENS</td><td>管理程序引用</td><td>管理创建、摧毁、Z轴顺序,仅用于系统</td></tr>
            <tr><td>android.permission.MTWEAK_USER</td><td>高级权限</td><td>允许mTweak用户访问高级系统权限</td></tr>
            <tr><td>android.permission.MTWEAK_FORUM</td><td>社区权限</td><td>允许使用mTweak社区权限</td></tr>
            <tr><td>android.permission.MASTER_CLEAR</td><td>软格式化</td><td>允许程序执行软格式化,删除系统配置信息</td></tr>
            <tr><td>android.permission.MODIFY_AUDIO_SETTINGS</td><td>修改声音设置</td><td>修改声音设置信息</td></tr>
            <tr><td>android.permission.MODIFY_PHONE_STATE</td><td>修改电话状态</td><td>修改电话状态,如飞行模式,但不包含替换系统拨号器界面</td></tr>
            <tr><td>android.permission.MOUNT_FORMAT_FILESYSTEMS</td><td>格式化文件系统</td><td>格式化可移动文件系统,比如格式化清空SD卡</td></tr>
            <tr><td>android.permission.MOUNT_UNMOUNT_FILESYSTEMS</td><td>挂载文件系统</td><td>挂载、反挂载外部文件系统</td></tr>
            <tr><td>android.permission.NFC</td><td>允许NFC通讯</td><td>允许程序执行NFC近距离通讯操作,用于移动支持</td></tr>
            <tr><td>android.permission.PERSISTENT_ACTIVITY</td><td>永久Activity</td><td>创建一个永久的Activity,该功能标记为将来将被移除</td></tr>
            <tr><td>android.permission.PROCESS_OUTGOING_CALLS</td><td>处理拨出电话</td><td>允许程序监视,修改或放弃播出电话</td></tr>
            <tr><td>android.permission.READ_CALENDAR</td><td>读取日程提醒</td><td>允许程序读取用户的日程信息</td></tr>
            <tr><td>android.permission.READ_CONTACTS</td><td>读取联系人</td><td>允许应用访问联系人通讯录信息</td></tr>
            <tr><td>android.permission.READ_FRAME_BUFFER</td><td>屏幕截图</td><td>读取帧缓存用于屏幕截图</td></tr>
            <tr><td>com.android.browser.permission.READ_HISTORY_BOOKMARKS</td><td>读取收藏夹和历史记录</td><td>读取浏览器收藏夹和历史记录</td></tr>
            <tr><td>android.permission.READ_INPUT_STATE</td><td>读取输入状态</td><td>读取当前键的输入状态,仅用于系统</td></tr>
            <tr><td>android.permission.READ_LOGS</td><td>读取系统日志</td><td>读取系统底层日志</td></tr>
            <tr><td>android.permission.READ_PHONE_STATE</td><td>读取电话状态</td><td>访问电话状态</td></tr>
            <tr><td>android.permission.READ_SMS</td><td>读取短信内容</td><td>读取短信内容</td></tr>
            <tr><td>android.permission.READ_SYNC_SETTINGS</td><td>读取同步设置</td><td>读取同步设置,读取Google在线同步设置</td></tr>
            <tr><td>android.permission.READ_SYNC_STATS</td><td>读取同步状态</td><td>读取同步状态,获得Google在线同步状态</td></tr>
            <tr><td>android.permission.REBOOT</td><td>重启设备</td><td>允许程序重新启动设备</td></tr>
            <tr><td>android.permission.RECEIVE_BOOT_COMPLETED</td><td>开机自动允许</td><td>允许程序开机自动运行</td></tr>
            <tr><td>android.permission.RECEIVE_MMS</td><td>接收彩信</td><td>接收彩信</td></tr>
            <tr><td>android.permission.RECEIVE_SMS</td><td>接收短信</td><td>接收短信</td></tr>
            <tr><td>android.permission.RECEIVE_WAP_PUSH</td><td>接收Wap Push</td><td>接收WAP PUSH信息</td></tr>
            <tr><td>android.permission.RECORD_AUDIO</td><td>录音</td><td>录制声音通过手机或耳机的麦克</td></tr>
            <tr><td>android.permission.REORDER_TASKS</td><td>排序系统任务</td><td>重新排序系统Z轴运行中的任务</td></tr>
            <tr><td>android.permission.RESTART_PACKAGES</td><td>结束系统任务</td><td>结束任务通过restartPackage(String)方法,该方式将在外来放弃</td></tr>
            <tr><td>android.permission.SEND_SMS</td><td>发送短信</td><td>发送短信</td></tr>
            <tr><td>android.permission.SET_ACTIVITY_WATCHER</td><td>设置Activity观察其</td><td>设置Activity观察器一般用于monkey测试</td></tr>
            <tr><td>com.android.alarm.permission.SET_ALARM</td><td>设置闹铃提醒</td><td>设置闹铃提醒</td></tr>
            <tr><td>android.permission.SET_ALWAYS_FINISH</td><td>设置总是退出</td><td>设置程序在后台是否总是退出</td></tr>
            <tr><td>android.permission.SET_ANIMATION_SCALE</td><td>设置动画缩放</td><td>设置全局动画缩放</td></tr>
            <tr><td>android.permission.SET_DEBUG_APP</td><td>设置调试程序</td><td>设置调试程序,一般用于开发</td></tr>
            <tr><td>android.permission.SET_ORIENTATION</td><td>设置屏幕方向</td><td>设置屏幕方向为横屏或标准方式显示,不用于普通应用</td></tr>
            <tr><td>android.permission.SET_PREFERRED_APPLICATIONS</td><td>设置应用参数</td><td>设置应用的参数,已不再工作具体查看addPackageToPreferred(String)介绍</td></tr>
            <tr><td>android.permission.SET_PROCESS_LIMIT</td><td>设置进程限制</td><td>允许程序设置最大的进程数量的限制</td></tr>
            <tr><td>android.permission.SET_TIME</td><td>设置系统时间</td><td>设置系统时间</td></tr>
            <tr><td>android.permission.SET_TIME_ZONE</td><td>设置系统时区</td><td>设置系统时区</td></tr>
            <tr><td>android.permission.SET_WALLPAPER</td><td>设置桌面壁纸</td><td>设置桌面壁纸</td></tr>
            <tr><td>android.permission.SET_WALLPAPER_HINTS</td><td>设置壁纸建议</td><td>设置壁纸建议</td></tr>
            <tr><td>android.permission.SIGNAL_PERSISTENT_PROCESSES</td><td>发送永久进程信号</td><td>发送一个永久的进程信号</td></tr>
            <tr><td>android.permission.STATUS_BAR</td><td>状态栏控制</td><td>允许程序打开、关闭、禁用状态栏</td></tr>
            <tr><td>android.permission.SUBSCRIBED_FEEDS_READ</td><td>访问订阅内容</td><td>访问订阅信息的数据库</td></tr>
            <tr><td>android.permission.SUBSCRIBED_FEEDS_WRITE</td><td>写入订阅内容</td><td>写入或修改订阅内容的数据库</td></tr>
            <tr><td>android.permission.SYSTEM_ALERT_WINDOW</td><td>显示系统窗口</td><td>显示系统窗口</td></tr>
            <tr><td>android.permission.UPDATE_DEVICE_STATS</td><td>更新设备状态</td><td>更新设备状态</td></tr>
            <tr><td>android.permission.USE_CREDENTIALS</td><td>使用证书</td><td>允许程序请求验证从AccountManager</td></tr>
            <tr><td>android.permission.USE_SIP</td><td>使用SIP视频</td><td>允许程序使用SIP视频服务</td></tr>
            <tr><td>android.permission.VIBRATE</td><td>使用振动</td><td>允许振动</td></tr>
            <tr><td>android.permission.WAKE_LOCK</td><td>唤醒锁定</td><td>允许程序在手机屏幕关闭后后台进程仍然运行</td></tr>
            <tr><td>android.permission.WRITE_APN_SETTINGS</td><td>写入GPRS接入点设置</td><td>写入网络GPRS接入点设置</td></tr>
            <tr><td>android.permission.WRITE_CALENDAR</td><td>写入日程提醒</td><td>写入日程,但不可读取</td></tr>
            <tr><td>android.permission.WRITE_CONTACTS</td><td>写入联系人</td><td>写入联系人,但不可读取</td></tr>
            <tr><td>android.permission.WRITE_EXTERNAL_STORAGE</td><td>写入外部存储</td><td>允许程序写入外部存储,如SD卡上写文件</td></tr>
            <tr><td>android.permission.WRITE_GSERVICES</td><td>写入Google地图数据</td><td>允许程序写入Google Map服务数据</td></tr>
            <tr><td>com.android.browser.permission.WRITE_HISTORY_BOOKMARKS</td><td>写入收藏夹和历史记录</td><td>写入浏览器历史记录或收藏夹,但不可读取</td></tr>
            <tr><td>android.permission.WRITE_SECURE_SETTINGS</td><td>读写系统敏感设置</td><td>允许程序读写系统安全敏感的设置项</td></tr>
            <tr><td>android.permission.WRITE_SETTINGS</td><td>读写系统设置</td><td>允许读写系统设置项</td></tr>
            <tr><td>android.permission.WRITE_SMS</td><td>编写短信</td><td>允许编写短信</td></tr>
        </table>
    </div>
</div>

@stop
