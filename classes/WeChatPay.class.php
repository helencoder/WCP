<?php

/**
 * Author: helen
 * CreateTime: 2016/4/18 9:04
 * description: ΢��֧��
 */
class WeChatPay
{
    private $appid;
    private $appsecret;
    //΢��֧�����Ͳ���
    private $mch_id;
    private $device_info;
    private $body;
    private $nonce_str;


    /*
     * �ӿڹ���
        ���䷽ʽ	Ϊ��֤���װ�ȫ�ԣ�����HTTPS����
        �ύ��ʽ	����POST�����ύ
        ���ݸ�ʽ	�ύ�ͷ������ݶ�ΪXML��ʽ�����ڵ���Ϊxml
        �ַ�����	ͳһ����UTF-8�ַ�����
        ǩ���㷨	MD5�����������SHA1��SHA256��HMAC�ȡ�
        ǩ��Ҫ��	����ͽ������ݾ���ҪУ��ǩ������ϸ������ο���ȫ�淶-ǩ���㷨
        ֤��Ҫ��	���������˿���������ӿ���Ҫ�̻�֤��
        �ж��߼�	���ж�Э���ֶη��أ����ж�ҵ�񷵻أ�����жϽ���״̬
     *
     * �����涨
     * ��������
        JSAPI--���ں�֧����NATIVE--ԭ��ɨ��֧����APP--app֧����ͳһ�µ��ӿ�trade_type�Ĵ��οɲο�����
        MICROPAY--ˢ��֧����ˢ��֧���е�����֧���ӿڣ�������ͳһ�µ��ӿ�
     *
     * ǩ���㷨
     * */


    public function __construct()
    {

    }

    /*
     * ǩ���㷨
     * */
    protected function getSignature()
    {

    }


    /*
     * ���ں�֧��
     *
     * */
    public function JSAPI()
    {

    }

    /*
     * ԭ��ɨ��֧��
     *
     * */
    public function NATIVE()
    {

    }

    /*
     * ˢ��֧��
     *
     * */
    public function MICROPAY()
    {

    }

}