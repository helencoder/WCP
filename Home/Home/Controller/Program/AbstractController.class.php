<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 11:18
 * description: �������--������ͷ���
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
class AbstractController extends CommonController{
    //��������̲��Է���
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
 * ������
 * 1���������Ǹ����ģ�塣ͨ������һ�������࣬����ָ�����һ����Ϊ��
 * 2�����仰˵��һ�������ඨ���˽ӿڣ��������ļ̳�����α�ʹ�á�Ȼ������Ḻ������Щ�ӿڵ�������ʵ�֡�
 * 3�����������ͨ�������������ڣ������ͼ�ӳ����ഴ��һ�����󽫻����һ�����������෴�����������������չ�ģ�Ȼ�����ǾͿ��Դ�����Щ�������ʵ����
 * 4��������Ķ��巽ʽ�Թؼ���abstract��ʼ��
 * 5��������Ҳ���г��󷽷����ڴ˲���Ҫ���巽���Ĺ��ܣ�����幦�ܽ��ɳ������������������
 * 6�����󷽷�����ɼ��ԣ�ֻ����abstract�ؼ���֮�������Ӧ�Ĺؼ��֡�
 * 7������չ������ʵ�ֳ��󷽷���ʱ����ɼ��Ա�����ڻ���ڳ��󷽷�����Ŀɼ��ԡ�
 * 8�����ܽ����󷽷�����Ϊ˽�еģ�private��,��Ϊһ��˽�еķ������ܱ��̳С�
 * 9������������£�������ʵ�ְ汾Ҳ����Ҫ�ͳ��󷽷��Ķ������һ����Ŀ�Ĳ�����
 * 10�����һ�������г��󷽷�����ô����౾��ҲӦ���ǳ����ࡣ���ǣ�һ�����������û�г��󷽷�.
 * 11�����󷽷���Ҫ��������̳С�
 * */
/*
 * �ӿ�
 * 1������Ϊ���뱻�ض��ඨ��Ĺ��ܽӿڡ�
 * 2��Ҫ�����ӿڣ���Ҫʹ��interface�ؼ��֡����巽��ǩ���������Ƿ���������ʵ�֡�����Ϊ�������ӿ����־�����һ��Сд��i��ʼ��
 * 3���ӿ������еķ����������ǹ����ģ�public����
 * 4���ӿ�ֻ�����˷���������û�а������ԡ�
 * 5��Ҫ��һ�����һ���ӿڹ�������Ҫ����Ķ�����ʹ��implements��������Ȼ���������붨��ӿ����г������з�����
 *
 * */
/*
 * traits
 * 1��traits���������ڲ�ʹ�ü̳е������Ϊһ�������ӹ��ܡ�
 * 2�����ȼ���traits�з��������з���ͬ��������Ϊ����ֱ�Ӷ���ķ������������ȼ��ߣ���Ϊ�̳����ķ�������traits���ȼ��ߡ�
 * 3��������ʹ��use traitsName����ֱ��ʹ�á�
 * */
/*
 * ������ʾ
 * 1����Ҫ�ڲ���������ǰ����������������͡�
 * */
/*
 * �����ռ�
 * 1��ʹ��namespace�ؼ���
 * 2���������ռ䣬ʹ��һ����б�ܣ�\����ʾ��
 * 3�����������ռ��е��࣬ʹ�÷�б������������
 * 4��namespace�ؼ��ֿ��Է��� declare()��� ֮��
 * 5��__NAMESPACE__��������ǰ�������ռ䡣
 * 6��PHP��������ʹ��use�ؼ��ֽ������ռ���뵱ǰ���������Ա���������һ�������ռ䡣
 *
 * */
/*
 * __toString()����
 * �������Ķ�������string���ַ��������͵�ʱ��ͻ��Զ��������������
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
