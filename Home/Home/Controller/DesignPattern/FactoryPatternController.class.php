<?php
/**
 * Author: helen
 * CreateTime: 2016/4/9 23:02
 * description: 设计模式--简单工厂模式（计算器实现）
 */
namespace Home\Controller\DesignPattern;
use Home\Controller\CommonController;
class FactoryPatternController extends CommonController{
    //计算器实现

}
//简单运算工厂类
class OperationFactory{

}
//运算类
class Operation{

}
//加减乘除类
class OperationAdd extends Operation{

}
class OperationSub extends Operation{

}
class OperationMul extends Operation{

}
class OperationDiv extends Operation{

}