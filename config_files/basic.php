<?php
/**
 * Author: helen
 * CreateTime: 2016/4/17 16:04
 * description: PHP���������л�������
 */

//���û�������UTF��8,���Է��õ�������
header("Content-type: text/html; charset=utf-8");
//��ǰҳ���url
$url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//��ǰ��Ŀ�ĸ�·��,ע���·�����Ϊ��/��
$root = $_SERVER['DOCUMENT_ROOT'];
