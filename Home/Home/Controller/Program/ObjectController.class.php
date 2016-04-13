<?php
/**
 * Author: helen
 * CreateTime: 2016/3/7 21:16
 * description: 面向对象--类的创建和对象实例化(类、对象、模块化、抽象)
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
class ObjectController extends CommonController{
    //面向对象编程测试方法
    public function main(){
        //hello类的使用
        $hello = new HelloWorld();
        $hello->sayHello();
        //删除一个类
        unset($hello);
        echo '<br>';
        //rectangle类的使用
        $width = 30;
        $height = 40;
        $rectangle = new Rectangle($width,$height);
        //$rectangle->setSize($width,$height);
        echo $rectangle->getArea();
        echo $rectangle->getPerimeter();
        unset($rectangle);
        echo '<br>';
        //demo类
        $this->test();
        $demo = new Demo();
        unset($demo);

    }
    //函数销毁
    function test(){
        $demo = new Demo();
    }
}
//定义类(类名不区分大小写，对象名区分大小写)
class ClassName{
    //定义类中属性
    /*
     * 属性
     * 1、是变量。
     * 2、必须声明为public、private、protected。
     * 3、如果声明时进行初始化，必须使用静态值（不能是表达式的结果）。
     * */
    /*
     * $this变量
     * $this变量总是指向该类的当前实例。
     * 可以使用$this->attributeName来访问类的实例及其属性。
     * */
    /*
     * 在类的名称中使用get_和set_前缀是一种通用的规范。
     * 以set开始的方法用于向类的属性赋值。
     * 以get开始的方法用于返回值：属性的值或者计算的结果。
     * */
    /*
     * 构造函数
     * 1、其名称永远是__construct()。
     * 2、当创建对象时，它总是会立即被自动调用
     * 3、它不能有返回（return）语句。
     * 可以直接调用构造函数（但是一般很少这样做）
     * 在PHP5类中找不到__construct()方法，就会寻找与类同名的构造函数(不可用！)
     * */
    /*
     * 析构函数
     * 1、在对象销毁的时候（或者脚本结束的时候）自动被调用。
     * 2、不能接收任何参数。
     * */
    public $propertyName;
    public $attribute;
    //构造函数
    function __construct(){

    }
    //定义类中操作
    public function operation(){

    }
    public function methodName(){

    }
}
//HelloWorld类
class HelloWorld{
    function sayHello($language='English'){
        switch($language){
            case 'Dutch':
                echo 'Hallo wereld';
                break;
            case 'French':
                echo 'Bonjour mondel';
                break;
            case 'German':
                echo 'Hallo Welt!';
                break;
            case 'Italian':
                echo 'Ciao.mondao!';
                break;
            case 'Spanish':
                echo 'iHola,mundo!';
                break;
            case 'English':
            default:
                echo 'Hello World!';
                break;
        }
    }
}
//Rectangle类
class Rectangle{
    public $width=0;
    public $height=0;
    function __construct($width=0,$height=0){
        $this->width=$width;
        $this->height=$height;
    }
    function setSize($width,$height){
        $this->width=$width;
        $this->height=$height;
    }
    function getArea(){
        return ($this->width*$this->height);
    }
    function getPerimeter(){
        return (($this->width+$this->height)*2);
    }
    function isSquare(){
        if($this->width==$this->height){
            return true;
        }else{
            return false;
        }
    }
}
//Demo类
class Demo{
    function __construct(){
        echo '<p>In the constructor.</p>';
    }
    function __destruct(){
        echo '<p>In the destructor.</p>';
    }
}