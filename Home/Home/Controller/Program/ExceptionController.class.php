<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 21:31
 * description: �����쳣
 */
namespace Home\Controller\Program;
use Home\Controller\CommonController;
use Think\Exception;

class EchartsController extends CommonController{
    public function main(){
        try{

        }catch (Exception $e){
            $e->getMessage();
        }
    }
}
/*
 * Exception��
 * getCode()            �쳣����
 * getMessage()         �쳣��Ϣ
 * getFile()            �����쳣���ļ���
 * getLine()            �׳��쳣�Ĵ�������
 * getTrace()           ������ʽ��Ϣ
 * getTraceAsString()   �ַ�����ʽ��Ϣ
 * __toString()         �ַ�����ʽ��������Ϣ
 * Exception����ֻ�й��캯����__toString()�������Ը��ǡ�
 * */