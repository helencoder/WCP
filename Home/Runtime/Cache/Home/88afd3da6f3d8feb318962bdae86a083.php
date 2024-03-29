<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
    <title><?php echo ($basetitle); ?></title>

    <!--<link href="__MEEZAO2__/Game/ShuanFuweng/css/base.css" rel="stylesheet"/>
    <link href="__MEEZAO2__/Game/ShuanFuweng/css/start.css" rel="stylesheet"/>
    <link href="__MEEZAO2__/Game/ShuanFuweng/css/font-awesome.min.css" rel="stylesheet"/>-->

    
</head>
<body>


<link rel="dns-prefetch" href="http://mmbiz.qpic.cn">
<link rel="dns-prefetch" href="http://res.wx.qq.com">
<!--在使用JSSDK前，必须先引入jquery文件-->
<script src="jquery-1.11.1.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="weixin.js"></script>

<!--微信JSSDK接口触发的隐藏按钮-->
<div style="display: none;">
    <!--微信配置信息-->
    <button class="btn btn_primary" id="appId" data-id="<?php echo ($weixin2["appId"]); ?>" style="display: none">123</button>
    <button class="btn btn_primary" id="timestamp" data-id="<?php echo ($weixin2["timestamp"]); ?>" style="display: none">3123</button>
    <button class="btn btn_primary" id="nonceStr" data-id="<?php echo ($weixin2["nonceStr"]); ?>" style="display: none">3123</button>
    <button class="btn btn_primary" id="signature" data-id="<?php echo ($weixin2["signature"]); ?>" style="display: none">31321</button>
    <!--微信分享设置-->
    <button class="btn btn_primary" id="title" value="分享标题" style="display: none"><?php echo ($weixin2["appId"]); ?></button>
    <button class="btn btn_primary" id="desc" value="分享描述" style="display: none"><?php echo ($weixin2["timestamp"]); ?></button>
    <button class="btn btn_primary" id="link" value="分享链接" style="display: none"><?php echo ($weixin2["nonceStr"]); ?></button>
    <button class="btn btn_primary" id="imgUrl" value="分享图片地址" style="display: none"><?php echo ($weixin2["signature"]); ?></button>
    <!--微信JSSDK触发事件-->
    <!--分享接口-->
    <h3 id="menu-basic">基础接口</h3>
    <span class="desc">判断当前客户端是否支持指定JS接口</span>
    <button class="btn btn_primary" id="checkJsApi">checkJsApi</button>

    <h3 id="menu-share">分享接口</h3>
    <span class="desc">获取“分享到朋友圈”按钮点击状态及自定义分享内容接口</span>
    <button class="btn btn_primary" id="onMenuShareTimeline">onMenuShareTimeline</button>
    <span class="desc">获取“分享给朋友”按钮点击状态及自定义分享内容接口</span>
    <button class="btn btn_primary" id="onMenuShareAppMessage">onMenuShareAppMessage</button>
    <span class="desc">获取“分享到QQ”按钮点击状态及自定义分享内容接口</span>
    <button class="btn btn_primary" id="onMenuShareQQ">onMenuShareQQ</button>
    <span class="desc">获取“分享到腾讯微博”按钮点击状态及自定义分享内容接口</span>
    <button class="btn btn_primary" id="onMenuShareWeibo">onMenuShareWeibo</button>

    <h3 id="menu-image">图像接口</h3>
    <span class="desc">拍照或从手机相册中选图接口</span>
    <button class="btn btn_primary" id="chooseImage">chooseImage</button>
    <span class="desc">预览图片接口</span>
    <button class="btn btn_primary" id="previewImage">previewImage</button>
    <span class="desc">上传图片接口</span>
    <button class="btn btn_primary" id="uploadImage">uploadImage</button>
    <span class="desc">下载图片接口</span>
    <button class="btn btn_primary" id="downloadImage">downloadImage</button>

    <h3 id="menu-voice">音频接口</h3>
    <span class="desc">开始录音接口</span>
    <button class="btn btn_primary" id="startRecord">startRecord</button>
    <span class="desc">停止录音接口</span>
    <button class="btn btn_primary" id="stopRecord">stopRecord</button>
    <span class="desc">播放语音接口</span>
    <button class="btn btn_primary" id="playVoice">playVoice</button>
    <span class="desc">暂停播放接口</span>
    <button class="btn btn_primary" id="pauseVoice">pauseVoice</button>
    <span class="desc">停止播放接口</span>
    <button class="btn btn_primary" id="stopVoice">stopVoice</button>
    <span class="desc">上传语音接口</span>
    <button class="btn btn_primary" id="uploadVoice">uploadVoice</button>
    <span class="desc">下载语音接口</span>
    <button class="btn btn_primary" id="downloadVoice">downloadVoice</button>

    <h3 id="menu-smart">智能接口</h3>
    <span class="desc">识别音频并返回识别结果接口</span>
    <button class="btn btn_primary" id="translateVoice">translateVoice</button>

    <h3 id="menu-device">设备信息接口</h3>
    <span class="desc">获取网络状态接口</span>
    <button class="btn btn_primary" id="getNetworkType">getNetworkType</button>

    <h3 id="menu-location">地理位置接口</h3>
    <span class="desc">使用微信内置地图查看位置接口</span>
    <button class="btn btn_primary" id="openLocation">openLocation</button>
    <span class="desc">获取地理位置接口</span>
    <button class="btn btn_primary" id="getLocation">getLocation</button>

    <h3 id="menu-webview">界面操作接口</h3>
    <span class="desc">隐藏右上角菜单接口</span>
    <button class="btn btn_primary" id="hideOptionMenu">hideOptionMenu</button>
    <span class="desc">显示右上角菜单接口</span>
    <button class="btn btn_primary" id="showOptionMenu">showOptionMenu</button>
    <span class="desc">关闭当前网页窗口接口</span>
    <button class="btn btn_primary" id="closeWindow">closeWindow</button>
    <span class="desc">批量隐藏功能按钮接口</span>
    <button class="btn btn_primary" id="hideMenuItems">hideMenuItems</button>
    <span class="desc">批量显示功能按钮接口</span>
    <button class="btn btn_primary" id="showMenuItems">showMenuItems</button>
    <span class="desc">隐藏所有非基础按钮接口</span>
    <button class="btn btn_primary" id="hideAllNonBaseMenuItem">hideAllNonBaseMenuItem</button>
    <span class="desc">显示所有功能按钮接口</span>
    <button class="btn btn_primary" id="showAllNonBaseMenuItem">showAllNonBaseMenuItem</button>

    <h3 id="menu-scan">微信扫一扫</h3>
    <span class="desc">调起微信扫一扫接口</span>
    <button class="btn btn_primary" id="scanQRCode0">scanQRCode(微信处理结果)</button>
    <button class="btn btn_primary" id="scanQRCode1">scanQRCode(直接返回结果)</button>

    <h3 id="menu-shopping">微信小店接口</h3>
    <span class="desc">跳转微信商品页接口</span>
    <button class="btn btn_primary" id="openProductSpecificView">openProductSpecificView</button>

    <h3 id="menu-card">微信卡券接口</h3>
    <span class="desc">批量添加卡券接口</span>
    <button class="btn btn_primary" id="addCard">addCard</button>
    <span class="desc">调起适用于门店的卡券列表并获取用户选择列表</span>
    <button class="btn btn_primary" id="chooseCard">chooseCard</button>
    <span class="desc">查看微信卡包中的卡券接口</span>
    <button class="btn btn_primary" id="openCard">openCard</button>

    <h3 id="menu-pay">微信支付接口</h3>
    <span class="desc">发起一个微信支付请求</span>
    <button class="btn btn_primary" id="chooseWXPay">chooseWXPay</button>
</div>



<button id="test">测试接口</button>
<script src="<?php echo ($public_path); ?>/Weixin/weixin.js"></script>
<script type="text/javascript">
    /*使用jssdk*/
    /*分享给朋友*/
    function onMenuShareAppMessage(){
        alert('分享给朋友o');
    };
    /*分享到朋友圈*/
    function onMenuShareTimeline(){
        alert('分享到朋友圈o');
    }
</script>
</body>
</html>