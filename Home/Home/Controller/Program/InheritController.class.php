<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 9:58
 * description: 面向对象--继承（重写（多态）、封装、可见性）
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
class InheritController extends CommonController{
    //面向对象编程测试方法
    public function main(){
        /*
         * instanceof关键词可以用来查看一个特别的对象是不是属于一个特定的类的类型
         * */
        $dog = new Dog('helen');
        $cat = new Cat('huihui');
        $dog->eat();
        $cat->eat();
        $dog->sleep();
        $cat->sleep();
        $dog->fetch();
        $cat->climb();
        $dog->play();
        $cat->play();
        unset($dog,$cat);

        echo '<br>';
        $side = 40;
        $square = new Square($side);
        echo $square->getArea();
        unset($square);

        echo '<br>';
        $parent = new Test();
        $child = new LittleTest();
        $parent->printVar('public');
        $child->printVar('public');

        $parent->public = 'modified';
        $parent->printVar('public');
        $child->printVar('public');

        $parent->printVar('protected');
        $child->printVar('protected');

        $parent->printVar('private');
        $child->printVar('private');

        $this->test();
        $this->test();
        $this->test();

        $obj = new SomeClass();
        echo $obj instanceof SomeClass; //输出1
        if($obj instanceof SomeClass){
            echo 'true';
        }else{
            echo 'false';
        }
        echo $obj::$counter;
        $obj1 = new SomeClass();
        echo $obj1::$counter;


    }

    function test(){
        static $n = 0;
        echo "$n<br>";
        $n++;
    }
}
//父类
class ParentClass{

}
//继承类
/*
 * 继承构造函数和析构函数
 * 在PHP中，创建一个子类的对象的时候，父类的构造函数不会被自动调用
 *
 * */
/*
 * 重写（创造了多态）
 * 子类定义的方法必须和父类的方法具有完全相同的名称和参数数量(参数数量不同的技术称为方法的“重载”)
 * 定义为final的方法不能被任何子类所重写
 * */
/*
 * 访问控制（封装）
 * 1、PHP中必须指定属性的可见性（默认public）。
 * 2、public，可以从任何一个地方访问：类本身内部、派生的子类和其他类。
 * 3、protected，只能在类本身以及子类中访问。
 * 4、private,只能在类本身访问(私有的变量名通常以一个下划线开始)
 * 有效的避免一些bug和一些不必要的行为（比如，改变类的属性的能力）
 * */
/*
 * 范围解析运算符（::）
 * 1、用于在类中（而不是对象）访问成员
 * 2、在使用类的时候，在父类和子类具有相同的属性和方法时，利用它可以避免混淆。
 * 3、在类外的时候，在没有创建对象的情况下使用该操作符访问类的成员。
 * 4、在类外使用类名；在类中，使用self关键字。
 * 5、要引用父类中的一个成员，可以使用parent关键字和范围解析操作符来引用。
 * */
/*
 * 静态成员
 * 1、类里的静态属性相当于函数中的静态变量。
 * 2、一个静态函数变量能够在每次函数被调用的时候记住其值。
 * 3、类的静态成员的概念也一样，添加static关键字。
 * 4、静态属性，不能在类里使用$this访问，应该使用self后跟范围解析操作符(::),后面是带着美元符号的变量名。
 * */
/*
 * 类常数
 * 1、类常数和静态属性是一样的，它能够被类（或者其子类）的全部实例访问。
 * 2、值是不能改变的。
 * 3、创建类常数的方法是使用const关键字，后面跟着常数名（没有美元符号）。
 * 4、不能通过对象进行访问，应该使用$obj::PI
 * 5、可以在任何地方使用ClassName::CONSTANT_NAME,类中使用self::CONSTANT_NAME
 * */
class ChildClass extends ParentClass{

}
//demo示例
class Pet{
    public $name;
    function __construct($pet_name){
        $this->name = $pet_name;
        self::sleep();
    }
    function eat(){
        echo "<p>$this->name is eating.</p>";
    }
    function sleep(){
        echo "<p>$this->name is sleeping.</p>";
    }
    function play(){
        echo "<p>$this->name is playing.</p>";
    }
}
class Cat extends Pet{
    function climb(){
        echo "<p>$this->name is climbing.</p>";
    }
    function play(){
        parent::play();
        echo "<p>$this->name is climbing.</p>";
    }
}
class Dog extends Pet{
    function fetch(){
        echo "<p>$this->name is fetching.</p>";
    }
    function play(){
        parent::play();
        echo "<p>$this->name is fetching.</p>";
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
class Square extends Rectangle{
    function __construct($side=0){
        $this->width = $side;
        $this->height = $side;
    }
}
class Test{
    public $public = 'public';
    protected $protected = 'protected';
    private $private = 'private';
    function printVar($var){
        echo "<p>In Test,\$$var:.'{$this->$var}'.</p>";
    }
}
class LittleTest extends Test{
    function printVar($var){
        echo "<p>In LittleTest,\$$var:.'{$this->$var}'.</p>";
    }
}
class SomeClass{
    public static $counter = 0;
    function __construct(){
        self::$counter++;
    }
}