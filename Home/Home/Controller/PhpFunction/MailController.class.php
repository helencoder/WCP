<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:09
 * description: �ʼ�����
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	         ����	PHP
    ezmlm_hash()	���� EZMLM �ʼ��б�ϵͳ�����ɢ��ֵ��	3
    mail()	�������ӽű���ֱ�ӷ��͵����ʼ���	3
 *
 *  Mail ����ѡ��
    ����	         Ĭ��	  ����	                                      �ɸ���
    SMTP	"localhost"	Windows ר�ã�SMTP �������� DNS ���ƻ� IP ��ַ��	PHP_INI_ALL
    smtp_port	"25"	Windows ר�ã�SMTP �˿ںš��� PHP 4.3 ����á�	PHP_INI_ALL
    sendmail_from	NULL	Windows ר�ã��涨�� PHP ���͵��ʼ���ʹ�õ� "from" ��ַ��	PHP_INI_ALL
    sendmail_path	NULL	Unix ϵͳר�ã��涨sendmail �����·����ͨ�� /usr/sbin/sendmail �� /usr/lib/sendmail��	PHP_INI_SYSTEM

 * */
class MailController extends CommonController{
    public function main(){

    }
}