<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 16:34
 * description: ���ݽṹ--��
 */
namespace Home\Controller\DataStructure;
use Home\Controller\CommonController;
class StringController extends CommonController{
    //��������������������������������ֱ���������������
    //�������������������������������ֱ�����ǰ��������
    //��������ǰ����������������������ֱ��������п��ܵ�����������

}
//������
class BiTree{
    protected $T = array();
    protected $data;
    protected $lchild;
    protected $rchild;
    function __construct($data,$lchild,$rchild){
        $this->data = $data;
        $this->lchild = $lchild;
        $this->rchild = $rchild;
    }
    //ǰ������㷨
    function PreOrderTraverse(BiTree $T){
        if($T==NULL){
            return;
        }else{

        }
    }
}