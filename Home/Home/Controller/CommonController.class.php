<?php
/**
 * Author: helen
 * CreateTime: 2016/4/8 11:21
 * description:
 */
namespace Home\Controller;
use Think\Controller;
/*
 * 控制器公众配置
 * */
class CommonController extends Controller{
    //空操作默认为登陆
    public function _empty(){
        $this->display('Public/Login');
    }

    /* 开发者公共配置 */
    protected function _initialize(){
        //设定项目基础路径等配置信息

    }
}