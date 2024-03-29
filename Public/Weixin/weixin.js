/**
 * Created by DELL-PC on 2016/3/28.
 */
        /*<!--在使用JSSDK前，必须先引入jquery文件-->*/
    /*document.write('<script src="__MEEZAO2__/js/jquery-1.11.1.min.js"><Vscript>')
    document.write('<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"><Vscript>')*/

//推广链接固定模式
var authorize_link = 'http://open.weixin.qq.com/connect/oauth2/authorize?appid=';
var authorize_code = '&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect'
//通过config接口注入权限验证配置
wx.config({
    debug: false,
    appId: $("#appId").data('id'),
    timestamp: $("#timestamp").data('id'),
    nonceStr: $("#nonceStr").data('id'),
    signature: $("#signature").data('id'),
    jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard'
    ]
});
//通过ready接口处理成功验证
wx.ready(function () {
    document.querySelector('#checkJsApi').onclick = function () {
        wx.checkJsApi({
            jsApiList: [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'getNetworkType',
                'previewImage',
                'hideMenuItems'
            ],
            success: function (res) {
                /*alert(JSON.stringify(res));*/
            }
        });
    };
    document.querySelector('#hideOptionMenu').onclick = function () {
        wx.hideAllNonBaseMenuItem();
    };
    // 批量隐藏菜单项
    document.querySelector('#hideMenuItems').onclick = function () {
        wx.hideMenuItems({
            menuList: [
                'menuItem:readMode', // 阅读模式
                'menuItem:openWithSafari',  //在Safari中打开
                'menuItem:copyUrl', // 复制链接
                'menuItem:favorite',    //收藏
                'menuItem:share:qq',    //分享到QQ
                'menuItem:share:email'  //邮件
            ],
            success: function (res) {

            },
            fail: function (res) {
                /*alert(JSON.stringify(res));*/
            }
        });
    };
    //默认点击，触发隐藏菜单项
    //$("#hideMenuItems").click();
    //获取“分享给朋友”按钮点击状态及自定义分享内容接口
    wx.onMenuShareAppMessage({
        title: $('#title').text(),
        desc: $('#desc').text(),
        link: $('#link').text(),
        imgUrl: $('#imgUrl').text(),
        success: function (res) {
            onMenuShareAppMessage();
            alert('分享成功');
        },
        cancel: function (res) {
            alert('已取消');
        },
        fail: function (res) {
            /*alert(JSON.stringify(res));*/
        }
    });
    //获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
    wx.onMenuShareTimeline({
        title: $('#title').text(),
        link: $('#link').text(),
        imgUrl: $('#imgUrl').text(),
        success: function (res) {
            onMenuShareTimeline();
            alert('已分享');
        },
        cancel: function (res) {
            alert('已取消');
        },
        fail: function (res) {
            /*alert(JSON.stringify(res));*/
        }
    });
    // 2.3 监听“分享到QQ”按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareQQ({
        title: $('#title').text(),
        desc: $('#desc').text(),
        link: $('#link').text(),
        imgUrl: $('#imgUrl').text(),
        trigger: function (res) {
            onMenuShareQQ();
            alert('用户点击分享到QQ');
        },
        complete: function (res) {
            alert(JSON.stringify(res));
        },
        success: function (res) {
            alert('已分享');
        },
        cancel: function (res) {
            alert('已取消');
        },
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    });
    // 2.4 监听“分享到微博”按钮点击、自定义分享内容及分享结果接口
    wx.onMenuShareWeibo({
        title: $('#title').text(),
        desc: $('#desc').text(),
        link: $('#link').text(),
        imgUrl: $('#imgUrl').text(),
        trigger: function (res) {
            alert('用户点击分享到微博');
        },
        complete: function (res) {
            alert(JSON.stringify(res));
        },
        success: function (res) {
            onMenuShareWeibo();
            alert('已分享');
        },
        cancel: function (res) {
            alert('已取消');
        },
        fail: function (res) {
            alert(JSON.stringify(res));
        }
    });

    // 3 智能接口
    var voice = {
        localId: '',
        serverId: ''
    };
    // 3.1 识别音频并返回识别结果
    document.querySelector('#translateVoice').onclick = function () {
        if (voice.localId == '') {
            alert('请先使用 startRecord 接口录制一段声音');
            return;
        }
        wx.translateVoice({
            localId: voice.localId,
            complete: function (res) {
                if (res.hasOwnProperty('translateResult')) {
                    alert('识别结果：' + res.translateResult);
                } else {
                    alert('无法识别');
                }
            }
        });
    };

    // 4 音频接口
    // 4.2 开始录音
    document.querySelector('#startRecord').onclick = function () {
        wx.startRecord({
            cancel: function () {
                alert('用户拒绝授权录音');
            }
        });
    };

    // 4.3 停止录音
    document.querySelector('#stopRecord').onclick = function () {
        wx.stopRecord({
            success: function (res) {
                voice.localId = res.localId;
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };

    // 4.4 监听录音自动停止
    wx.onVoiceRecordEnd({
        complete: function (res) {
            voice.localId = res.localId;
            alert('录音时间已超过一分钟');
        }
    });

    // 4.5 播放音频
    document.querySelector('#playVoice').onclick = function () {
        if (voice.localId == '') {
            alert('请先使用 startRecord 接口录制一段声音');
            return;
        }
        wx.playVoice({
            localId: voice.localId
        });
    };

    // 4.6 暂停播放音频
    document.querySelector('#pauseVoice').onclick = function () {
        wx.pauseVoice({
            localId: voice.localId
        });
    };

    // 4.7 停止播放音频
    document.querySelector('#stopVoice').onclick = function () {
        wx.stopVoice({
            localId: voice.localId
        });
    };

    // 4.8 监听录音播放停止
    wx.onVoicePlayEnd({
        complete: function (res) {
            alert('录音（' + res.localId + '）播放结束');
        }
    });

    // 4.8 上传语音
    document.querySelector('#uploadVoice').onclick = function () {
        if (voice.localId == '') {
            alert('请先使用 startRecord 接口录制一段声音');
            return;
        }
        wx.uploadVoice({
            localId: voice.localId,
            success: function (res) {
                alert('上传语音成功，serverId 为' + res.serverId);
                voice.serverId = res.serverId;
            }
        });
    };

    // 4.9 下载语音
    document.querySelector('#downloadVoice').onclick = function () {
        if (voice.serverId == '') {
            alert('请先使用 uploadVoice 上传声音');
            return;
        }
        wx.downloadVoice({
            serverId: voice.serverId,
            success: function (res) {
                alert('下载语音成功，localId 为' + res.localId);
                voice.localId = res.localId;
            }
        });
    };

    // 5 图片接口
    // 5.1 拍照、本地选图
    var images = {
        localId: [],
        serverId: []
    };
    document.querySelector('#chooseImage').onclick = function () {
        wx.chooseImage({
            success: function (res) {
                images.localId = res.localIds;
                alert('已选择 ' + res.localIds.length + ' 张图片');
            }
        });
    };

    // 5.2 图片预览
    document.querySelector('#previewImage').onclick = function () {
        wx.previewImage({
            current: 'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
            urls: [
                'http://img3.douban.com/view/photo/photo/public/p2152117150.jpg',
                'http://img5.douban.com/view/photo/photo/public/p1353993776.jpg',
                'http://img3.douban.com/view/photo/photo/public/p2152134700.jpg'
            ]
        });
    };

    // 5.3 上传图片
    document.querySelector('#uploadImage').onclick = function () {
        if (images.localId.length == 0) {
            alert('请先使用 chooseImage 接口选择图片');
            return;
        }
        var i = 0, length = images.localId.length;
        images.serverId = [];
        function upload() {
            wx.uploadImage({
                localId: images.localId[i],
                success: function (res) {
                    i++;
                    alert('已上传：' + i + '/' + length);
                    images.serverId.push(res.serverId);
                    if (i < length) {
                        upload();
                    }
                },
                fail: function (res) {
                    alert(JSON.stringify(res));
                }
            });
        }
        upload();
    };

    // 5.4 下载图片
    document.querySelector('#downloadImage').onclick = function () {
        if (images.serverId.length === 0) {
            alert('请先使用 uploadImage 上传图片');
            return;
        }
        var i = 0, length = images.serverId.length;
        images.localId = [];
        function download() {
            wx.downloadImage({
                serverId: images.serverId[i],
                success: function (res) {
                    i++;
                    alert('已下载：' + i + '/' + length);
                    images.localId.push(res.localId);
                    if (i < length) {
                        download();
                    }
                }
            });
        }
        download();
    };

    // 6 设备信息接口
    // 6.1 获取当前网络状态
    document.querySelector('#getNetworkType').onclick = function () {
        wx.getNetworkType({
            success: function (res) {
                alert(res.networkType);
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };

    // 8 界面操作接口
    // 8.1 隐藏右上角菜单
    document.querySelector('#hideOptionMenu').onclick = function () {
        wx.hideOptionMenu();
    };

    // 8.2 显示右上角菜单
    document.querySelector('#showOptionMenu').onclick = function () {
        wx.showOptionMenu();
    };

    // 8.3 批量隐藏菜单项
    document.querySelector('#hideMenuItems').onclick = function () {
        wx.hideMenuItems({
            menuList: [
                'menuItem:readMode', // 阅读模式
                'menuItem:share:timeline', // 分享到朋友圈
                'menuItem:copyUrl' // 复制链接
            ],
            success: function (res) {
                alert('已隐藏“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };

    // 8.4 批量显示菜单项
    document.querySelector('#showMenuItems').onclick = function () {
        wx.showMenuItems({
            menuList: [
                'menuItem:readMode', // 阅读模式
                'menuItem:share:timeline', // 分享到朋友圈
                'menuItem:copyUrl' // 复制链接
            ],
            success: function (res) {
                alert('已显示“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };

    // 8.5 隐藏所有非基本菜单项
    document.querySelector('#hideAllNonBaseMenuItem').onclick = function () {
        wx.hideAllNonBaseMenuItem({
            success: function () {
                alert('已隐藏所有非基本菜单项');
            }
        });
    };

    // 8.6 显示所有被隐藏的非基本菜单项
    document.querySelector('#showAllNonBaseMenuItem').onclick = function () {
        wx.showAllNonBaseMenuItem({
            success: function () {
                alert('已显示所有非基本菜单项');
            }
        });
    };

    // 8.7 关闭当前窗口
    document.querySelector('#closeWindow').onclick = function () {
        wx.closeWindow();
    };

    // 9 微信原生接口
    // 9.1.1 扫描二维码并返回结果
    document.querySelector('#scanQRCode0').onclick = function () {
        wx.scanQRCode({
            desc: 'scanQRCode desc'
        });
    };
    // 9.1.2 扫描二维码并返回结果
    document.querySelector('#scanQRCode1').onclick = function () {
        wx.scanQRCode({
            needResult: 1,
            desc: 'scanQRCode desc',
            success: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };

    // 10 微信支付接口
    // 10.1 发起一个支付请求
    document.querySelector('#chooseWXPay').onclick = function () {
        wx.chooseWXPay({
            timestamp: 1414723227,
            nonceStr: 'noncestr',
            package: 'addition=action_id%3dgaby1234%26limit_pay%3d&bank_type=WX&body=innertest&fee_type=1&input_charset=GBK&notify_url=http%3A%2F%2F120.204.206.246%2Fcgi-bin%2Fmmsupport-bin%2Fnotifypay&out_trade_no=1414723227818375338&partner=1900000109&spbill_create_ip=127.0.0.1&total_fee=1&sign=432B647FE95C7BF73BCD177CEECBEF8D',
            paySign: 'bd5b1933cda6e9548862944836a9b52e8c9a2b69'
        });
    };

    // 11.3  跳转微信商品页
    document.querySelector('#openProductSpecificView').onclick = function () {
        wx.openProductSpecificView({
            productId: 'pDF3iY0ptap-mIIPYnsM5n8VtCR0'
        });
    };

    // 12 微信卡券接口
    // 12.1 添加卡券
    document.querySelector('#addCard').onclick = function () {
        wx.addCard({
            cardList: [
                {
                    cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
                    cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'
                },
                {
                    cardId: 'pDF3iY9tv9zCGCj4jTXFOo1DxHdo',
                    cardExt: '{"code": "", "openid": "", "timestamp": "1418301401", "signature":"64e6a7cc85c6e84b726f2d1cbef1b36e9b0f9750"}'
                }
            ],
            success: function (res) {
                alert('已添加卡券：' + JSON.stringify(res.cardList));
            }
        });
    };

    // 12.2 选择卡券
    document.querySelector('#chooseCard').onclick = function () {
        wx.chooseCard({
            cardSign: '97e9c5e58aab3bdf6fd6150e599d7e5806e5cb91',
            timestamp: 1417504553,
            nonceStr: 'k0hGdSXKZEj3Min5',
            success: function (res) {
                alert('已选择卡券：' + JSON.stringify(res.cardList));
            }
        });
    };

    // 12.3 查看卡券
    document.querySelector('#openCard').onclick = function () {
        alert('您没有该公众号的卡券无法打开卡券。');
        wx.openCard({
            cardList: [
            ]
        });
    };


});

wx.error(function (res) {
    alert(res.errMsg);



    // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
});


