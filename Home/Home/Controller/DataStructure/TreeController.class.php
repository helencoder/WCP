<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 16:34
 * description: 数据结构--树
 */
namespace Home\Controller\DataStructure;
use Home\Controller\CommonController;
class StringController extends CommonController{
    //利用输入先序遍历结果、中序遍历结果，直接输出后序遍历结果
    //利用输入后序遍历结果、中序遍历结果，直接输出前序遍历结果
    //利用输入前序遍历结果、后序遍历结果，直接输出所有可能的中序遍历结果

}
//二叉树
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
    //前序遍历算法
    function PreOrderTraverse(BiTree $T){
        if($T==NULL){
            return;
        }else{

        }
    }
}