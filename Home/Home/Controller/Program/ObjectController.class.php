<?php
/**
 * Author: helen
 * CreateTime: 2016/3/7 21:16
 * description: �������--��Ĵ����Ͷ���ʵ����(�ࡢ����ģ�黯������)
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
class ObjectController extends CommonController{
    //��������̲��Է���
    public function main(){
        //hello���ʹ��
        $hello = new HelloWorld();
        $hello->sayHello();
        //ɾ��һ����
        unset($hello);
        echo '<br>';
        //rectangle���ʹ��
        $width = 30;
        $height = 40;
        $rectangle = new Rectangle($width,$height);
        //$rectangle->setSize($width,$height);
        echo $rectangle->getArea();
        echo $rectangle->getPerimeter();
        unset($rectangle);
        echo '<br>';
        //demo��
        $this->test();
        $demo = new Demo();
        unset($demo);

    }
    //��������
    function test(){
        $demo = new Demo();
    }
}
//������(���������ִ�Сд�����������ִ�Сд)
class ClassName{
    //������������
    /*
     * ����
     * 1���Ǳ�����
     * 2����������Ϊpublic��private��protected��
     * 3���������ʱ���г�ʼ��������ʹ�þ�ֵ̬�������Ǳ��ʽ�Ľ������
     * */
    /*
     * $this����
     * $this��������ָ�����ĵ�ǰʵ����
     * ����ʹ��$this->attributeName���������ʵ���������ԡ�
     * */
    /*
     * �����������ʹ��get_��set_ǰ׺��һ��ͨ�õĹ淶��
     * ��set��ʼ�ķ���������������Ը�ֵ��
     * ��get��ʼ�ķ������ڷ���ֵ�����Ե�ֵ���߼���Ľ����
     * */
    /*
     * ���캯��
     * 1����������Զ��__construct()��
     * 2������������ʱ�������ǻ��������Զ�����
     * 3���������з��أ�return����䡣
     * ����ֱ�ӵ��ù��캯��������һ�������������
     * ��PHP5�����Ҳ���__construct()�������ͻ�Ѱ������ͬ���Ĺ��캯��(�����ã�)
     * */
    /*
     * ��������
     * 1���ڶ������ٵ�ʱ�򣨻��߽ű�������ʱ���Զ������á�
     * 2�����ܽ����κβ�����
     * */
    public $propertyName;
    public $attribute;
    //���캯��
    function __construct(){

    }
    //�������в���
    public function operation(){

    }
    public function methodName(){

    }
}
//HelloWorld��
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
//Demo��
class Demo{
    function __construct(){
        echo '<p>In the constructor.</p>';
    }
    function __destruct(){
        echo '<p>In the destructor.</p>';
    }
}