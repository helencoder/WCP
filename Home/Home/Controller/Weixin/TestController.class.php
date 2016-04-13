<?php
/**
 * Author: helen
 * CreateTime: 2016/4/11 17:00
 * description:
 */
namespace Home\Controller\Weixin;
use Think\Controller;
class TestController extends Controller{
    public function test(){
        $root = $_SERVER['DOCUMENT_ROOT'];
        $public_path = $root.'WCP/Public';
        dump($public_path);
        $this->assign('public_path',$public_path);
        $this->display();
    }
}