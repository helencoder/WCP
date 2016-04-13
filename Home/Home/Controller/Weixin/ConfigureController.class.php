<?php
/**
 * Author: helen
 * CreateTime: 2016/3/4 17:11
 * description: 微信相关配置页面
 */
    namespace Home\Controller\Weixin;
    use Think\Controller;
    class ConfigureController extends Controller{
        //微信相关信息输入页
        public function index(){
            $this->display();
        }
        //微信信息保存
        public function saveConf(){
            //实例化微信数据表

        }
    }