<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 14:49
 * description: 错误函数
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      函数	             描述	PHP
    debug_backtrace()	生成 backtrace。	4
    debug_print_backtrace()	输出 backtrace。	5
    error_get_last()	获得最后发生的错误。	5
    error_log()	向服务器错误记录、文件或远程目标发送一个错误。	4
    error_reporting()	规定报告哪个错误。	4
    restore_error_handler()	恢复之前的错误处理程序。	4
    restore_exception_handler()	恢复之前的异常处理程序。	5
    set_error_handler()	设置用户自定义的错误处理函数。	4
    set_exception_handler()	设置用户自定义的异常处理函数。	5
    trigger_error()	创建用户自定义的错误消息。	4
    user_error()	trigger_error() 的别名。	4
 * */
class ErrorController extends CommonController{
    public function main(){

    }
}