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

    }
}