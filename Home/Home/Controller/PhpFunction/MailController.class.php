<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:09
 * description: 邮件函数
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      函数	         描述	PHP
    ezmlm_hash()	计算 EZMLM 邮件列表系统所需的散列值。	3
    mail()	允许您从脚本中直接发送电子邮件。	3
 *
 *  Mail 配置选项
    名称	         默认	  描述	                                      可更改
    SMTP	"localhost"	Windows 专用：SMTP 服务器的 DNS 名称或 IP 地址。	PHP_INI_ALL
    smtp_port	"25"	Windows 专用：SMTP 端口号。自 PHP 4.3 起可用。	PHP_INI_ALL
    sendmail_from	NULL	Windows 专用：规定从 PHP 发送的邮件中使用的 "from" 地址。	PHP_INI_ALL
    sendmail_path	NULL	Unix 系统专用：规定sendmail 程序的路径（通常 /usr/sbin/sendmail 或 /usr/lib/sendmail）	PHP_INI_SYSTEM

 * */
class MailController extends CommonController{
    public function main(){

    }
}