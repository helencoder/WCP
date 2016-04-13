<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 11:18
 * description: 面向对象--抽象类和方法
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
class AbstractController extends CommonController{
    //面向对象编程测试方法
    public function main(){
        $side1 = 5;
        $side2 = 10;
        $side3 = 13;
        $triangle = new Triangle($side1,$side2,$side3);
        echo $triangle->getArea();
        echo $triangle->getPerimeter();
        unset($triangle);
        echo '<br>';

        $user_data = array('username'=>'helen');
        $user = new User($user_data);
        $info = $user->read();
        var_dump($info);
        $user->update(array('username'=>'huihui'));
        $info = $user->read();
        var_dump($info);


    }
}
/*
 * 抽象类
 * 1、抽象类是父类的模板。通过定义一个抽象类，可以指明类的一般行为。
 * 2、换句话说，一个抽象类定义了接口：这个基类的继承类如何被使用。然后子类会负责定义这些接口的真正的实现。
 * 3、抽象类和普通类的最大区别在于，如果试图从抽象类创建一个对象将会出现一个致命错误。相反，抽象类就是用来扩展的，然后我们就可以创建这些派生类的实例。
 * 4、抽象类的定义方式以关键字abstract开始。
 * 5、抽象类也会有抽象方法。在此不需要定义方法的功能，其具体功能将由抽象类的子类来决定。
 * 6、抽象方法定义可见性，只需在abstract关键字之后添加相应的关键字。
 * 7、在扩展的类里实现抽象方法的时候，其可见性必须高于或等于抽象方法定义的可见性。
 * 8、不能将抽象方法定义为私有的（private）,因为一个私有的方法不能被继承。
 * 9、在所有情况下，方法的实现版本也必须要和抽象方法的定义具有一样数目的参数。
 * 10、如果一个类中有抽象方法，那么这个类本身也应该是抽象类。但是，一个抽象类可以没有抽象方法.
 * 11、抽象方法需要被派生类继承。
 * */
/*
 * 接口
 * 1、定义为必须被特定类定义的功能接口。
 * 2、要创建接口，需要使用interface关键字。定义方法签名，而不是方法的真正实现。（作为惯例，接口名字经常以一个小写的i开始）
 * 3、接口中所有的方法都必须是公开的（public）。
 * 4、接口只定义了方法，但是没有包括属性。
 * 5、要将一个类和一个接口关联，需要在类的定义中使用implements操作符。然后这个类必须定义接口中列出的所有方法！
 *
 * */
/*
 * traits
 * 1、traits允许我们在不使用继承的情况下为一个类增加功能。
 * 2、优先级：traits中方法和类中方法同名，假如为类中直接定义的方法，则其优先级高；若为继承来的方法，则traits优先级高。
 * 3、在类中使用use traitsName即可直接使用。
 * */
/*
 * 类型提示
 * 1、需要在参数变量名前加上期望的类的类型。
 * */
/*
 * 命名空间
 * 1、使用namespace关键字
 * 2、子命名空间，使用一个反斜杠（\）表示。
 * 3、引用命名空间中的类，使用反斜杠来引用它。
 * 4、namespace关键字可以放在 declare()语句 之后。
 * 5、__NAMESPACE__常量代表当前的命名空间。
 * 6、PHP允许我们使用use关键字将命名空间带入当前的作用域，以便更快的引用一个命名空间。
 *
 * */
/*
 * __toString()方法
 * 当这个类的对象用做string（字符串）类型的时候就会自动调用这个方法。
 * */

abstract class Shape{
    abstract protected function getArea();
    abstract protected function getPerimeter();
}
class Triangle extends Shape{
    private $_sides = array();
    private $_perimeter = NULL;
    function __construct($s0=0,$s1=0,$s2=0){
        $this->_sides[] = $s0;
        $this->_sides[] = $s1;
        $this->_sides[] = $s2;
        $this->_perimeter = array_sum($this->_sides);
    }
    public function getArea(){
        return (sqrt(($this->_perimeter/2)*(($this->_perimeter/2)-$this->_sides[0])*(($this->_perimeter/2)-$this->_sides[1])*(($this->_perimeter/2)-$this->_sides[2])));
    }
    public function getPerimeter(){
        return $this->_perimeter;
    }
}
interface iCrud{
    public function create($data);
    public function read();
    public function update($data);
    public function delete();
}
class User implements iCrud{
    private $_userId = NULL;
    private $_username = NULL;
    function __construct($data){
        $this->_userId = uniqid();
        $this->_username = $data['username'];
    }
    function create($data){
        self::__construct($data);
    }
    function read(){
        return array(
            'userId'   => $this->_userId,
            'username' => $this->_username
        );
    }
    function update($data){
        $this->_username = $data['username'];
    }
    public function delete(){
        $this->_userId = NULL;
        $this->_username = NULL;
    }
}
trait tDebug{
    public function dumpObject(){
        $class = get_class($this);
        $attributes = get_object_vars($this);
        $methods = get_class_methods($this);
        echo "<h2>Information about the $class object</h2>";
        echo "<h3>Attributes</h3><ul>";
        foreach($attributes as $key=>$value){
            echo "<li>$key: $value</li>";
        }
        echo "</li></ul>";
        echo "<h3>Methods</h3><ul>";
        foreach($methods as $key=>$value){
            echo "<li>$key: $value</li>";
        }
        echo "</li></ul>";
    }
}
