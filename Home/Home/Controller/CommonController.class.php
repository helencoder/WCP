<?php
/**
 * Author: helen
 * CreateTime: 2016/4/8 11:21
 * description:
 */
namespace Home\Controller;
use Think\Controller;
/*
 * ��������������
 * */
class CommonController extends Controller{
    //�ղ���Ĭ��Ϊ��½
    public function _empty(){
        $this->display('Public/Login');
    }

    /* �����߹������� */
    protected function _initialize(){
        //�趨��Ŀ����·����������Ϣ
        ini_set("include_path","D:wamp/www/WCPcms");
        $root = $_SERVER['DOCUMENT_ROOT'];
        $project_path = $root.'WCPcms/';
        $this->assign('root',$root);
        $this->assign('project_path',$project_path);

    }
}