<?php
/**
 * Author: helen
 * CreateTime: 2016/4/9 23:02
 * description: ���ģʽ--�򵥹���ģʽ��������ʵ�֣�
 */
namespace Home\Controller\DesignPattern;
use Home\Controller\CommonController;
class FactoryPatternController extends CommonController{
    //������ʵ��

}
//�����㹤����
class OperationFactory{

}
//������
class Operation{

}
//�Ӽ��˳���
class OperationAdd extends Operation{

}
class OperationSub extends Operation{

}
class OperationMul extends Operation{

}
class OperationDiv extends Operation{

}