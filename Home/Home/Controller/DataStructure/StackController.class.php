<?php
/**
 * Author: helen
 * CreateTime: 2016/4/8 9:48
 * description: 数据结构--栈()
 */
namespace Home\Controller\DataStructure;
use Home\Controller\CommonController;
class StackController extends CommonController{
    public function main(){
        //设定时间无限长
        ini_set("include_path","D:/wamp/bin/php/php5.5.12/pear");
        set_time_limit(0);
        $root = $_SERVER['DOCUMENT_ROOT'];
        require $root.'makerway/Ext/Benchmark/Timer.php';
        //require_once '__Ext__/Benchmark/Timer.php';
        $timer = new \Benchmark_Timer();
        $timer->start();
        for($i=0;$i<20;$i++){
            $timer->setMarker('marker'."$i");
            dump("$i".'对应的Fbi为'.$this->Fbi($i));
        }
        $timer->stop();
        $timer->display();
    }
    //斐波那契的递归函数
    function Fbi($i){
        if($i<2){
            return $i==0?0:1;
        }else{
            $sum = $this->Fbi($i-1)+$this->Fbi($i-2);
            return $sum;
        }
    }
}