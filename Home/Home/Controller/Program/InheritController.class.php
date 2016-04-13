<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 9:58
 * description: �������--�̳У���д����̬������װ���ɼ��ԣ�
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
class InheritController extends CommonController{
    //��������̲��Է���
    public function main(){
        /*
         * instanceof�ؼ��ʿ��������鿴һ���ر�Ķ����ǲ�������һ���ض����������
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
        echo $obj instanceof SomeClass; //���1
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
//����
class ParentClass{

}
//�̳���
/*
 * �̳й��캯������������
 * ��PHP�У�����һ������Ķ����ʱ�򣬸���Ĺ��캯�����ᱻ�Զ�����
 *
 * */
/*
 * ��д�������˶�̬��
 * ���ඨ��ķ�������͸���ķ���������ȫ��ͬ�����ƺͲ�������(����������ͬ�ļ�����Ϊ�����ġ����ء�)
 * ����Ϊfinal�ķ������ܱ��κ���������д
 * */
/*
 * ���ʿ��ƣ���װ��
 * 1��PHP�б���ָ�����ԵĿɼ��ԣ�Ĭ��public����
 * 2��public�����Դ��κ�һ���ط����ʣ��౾���ڲ�������������������ࡣ
 * 3��protected��ֻ�����౾���Լ������з��ʡ�
 * 4��private,ֻ�����౾�����(˽�еı�����ͨ����һ���»��߿�ʼ)
 * ��Ч�ı���һЩbug��һЩ����Ҫ����Ϊ�����磬�ı�������Ե�������
 * */
/*
 * ��Χ�����������::��
 * 1�����������У������Ƕ��󣩷��ʳ�Ա
 * 2����ʹ�����ʱ���ڸ�������������ͬ�����Ժͷ���ʱ�����������Ա��������
 * 3���������ʱ����û�д�������������ʹ�øò�����������ĳ�Ա��
 * 4��������ʹ�������������У�ʹ��self�ؼ��֡�
 * 5��Ҫ���ø����е�һ����Ա������ʹ��parent�ؼ��ֺͷ�Χ���������������á�
 * */
/*
 * ��̬��Ա
 * 1������ľ�̬�����൱�ں����еľ�̬������
 * 2��һ����̬���������ܹ���ÿ�κ��������õ�ʱ���ס��ֵ��
 * 3����ľ�̬��Ա�ĸ���Ҳһ�������static�ؼ��֡�
 * 4����̬���ԣ�����������ʹ��$this���ʣ�Ӧ��ʹ��self�����Χ����������(::),�����Ǵ�����Ԫ���ŵı�������
 * */
/*
 * �ೣ��
 * 1���ೣ���;�̬������һ���ģ����ܹ����ࣨ���������ࣩ��ȫ��ʵ�����ʡ�
 * 2��ֵ�ǲ��ܸı�ġ�
 * 3�������ೣ���ķ�����ʹ��const�ؼ��֣�������ų�������û����Ԫ���ţ���
 * 4������ͨ��������з��ʣ�Ӧ��ʹ��$obj::PI
 * 5���������κεط�ʹ��ClassName::CONSTANT_NAME,����ʹ��self::CONSTANT_NAME
 * */
class ChildClass extends ParentClass{

}
//demoʾ��
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
//Rectangle��
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