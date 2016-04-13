<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 21:31
 * description: 捕获异常
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
use Think\Exception;

class EchartsController extends CommonController{
    public function main(){
        try{

        }catch (Exception $e){
            $e->getMessage();
        }
    }
}
/*
 * Exception类
 * getCode()            异常代号
 * getMessage()         异常信息
 * getFile()            发生异常的文件名
 * getLine()            抛出异常的代码行数
 * getTrace()           数组形式信息
 * getTraceAsString()   字符串形式信息
 * __toString()         字符串形式的所有信息
 * Exception类中只有构造函数和__toString()方法可以覆盖。
 * */