<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:35
 * description:
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	                 ����	          PHP
    connection_aborted()	����Ƿ�Ͽ��ͻ�����	3
    connection_status()	    ���ص�ǰ������״̬��	3
    connection_timeout()	�� PHP 4.0.5 �в��޳�ʹ�á�	3
    constant()	����һ��������ֵ��	4
    define()	����һ��������	3
    defined()	���ĳ�����Ƿ���ڡ�	3
    die()	���һ����Ϣ�����˳���ǰ�ű���	3
    eval()	���ַ������� PHP ���������㡣	3
    exit()	���һ����Ϣ�����˳���ǰ�ű���	3
    get_browser()	�����û�����������ܡ�	3
    highlight_file()	���ļ������﷨������ʾ��	4
    highlight_string()	���ַ��������﷨������ʾ��	4
    ignore_user_abort()	������ͻ����Ͽ��Ƿ����ֹ�ű���ִ�С�	3
    pack()	������װ��һ���������ַ�����	3
    php_check_syntax()	�� PHP 5.0.5 �в��޳�ʹ�á�	5
    php_strip_whitespace()	������ɾ�� PHP ע���Լ��հ��ַ���Դ�����ļ���	5
    show_source()	highlight_file() �ı�����	4
    sleep()	�ӳٴ���ִ�������롣	3
    time_nanosleep()	�ӳٴ���ִ������������롣	5
    time_sleep_until()	�ӳٴ���ִ��ָ����ʱ�䡣	5
    uniqid()	����Ψһ�� ID��	3
    unpack()	�Ӷ������ַ��������ݽ��н����	3
    usleep()	�ӳٴ���ִ������΢�롣	3
 * */
class MiscellaneousController extends CommonController{
    public function main(){
        var_dump(get_browser());
    }
}