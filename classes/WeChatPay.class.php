<?php

/**
 * Author: helen
 * CreateTime: 2016/4/18 9:04
 * description: 微信支付
 */
class WeChatPay
{
    private $appid;
    private $appsecret;
    //微信支付传送参数
    private $mch_id;
    private $device_info;
    private $body;
    private $nonce_str;


    /*
     * 接口规则
        传输方式	为保证交易安全性，采用HTTPS传输
        提交方式	采用POST方法提交
        数据格式	提交和返回数据都为XML格式，根节点名为xml
        字符编码	统一采用UTF-8字符编码
        签名算法	MD5，后续会兼容SHA1、SHA256、HMAC等。
        签名要求	请求和接收数据均需要校验签名，详细方法请参考安全规范-签名算法
        证书要求	调用申请退款、撤销订单接口需要商户证书
        判断逻辑	先判断协议字段返回，再判断业务返回，最后判断交易状态
     *
     * 参数规定
     * 交易类型
        JSAPI--公众号支付、NATIVE--原生扫码支付、APP--app支付，统一下单接口trade_type的传参可参考这里
        MICROPAY--刷卡支付，刷卡支付有单独的支付接口，不调用统一下单接口
     *
     * 签名算法
     * */


    public function __construct()
    {

    }

    /*
     * 签名算法
     * */
    protected function getSignature()
    {

    }


    /*
     * 公众号支付
     *
     * */
    public function JSAPI()
    {

    }

    /*
     * 原生扫码支付
     *
     * */
    public function NATIVE()
    {

    }

    /*
     * 刷卡支付
     *
     * */
    public function MICROPAY()
    {

    }

}