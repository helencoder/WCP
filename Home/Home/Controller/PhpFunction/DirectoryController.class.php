<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 14:42
 * description: �ļ��к���
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *    ����	  ����	   PHP
    chdir()	�ı䵱ǰ��Ŀ¼��	3
    chroot()	�ı䵱ǰ���̵ĸ�Ŀ¼��	4
    dir()	��һ��Ŀ¼�����������һ������	3
    closedir()	�ر�Ŀ¼�����	3
    getcwd()	���ص�ǰĿ¼��	4
    opendir()	��Ŀ¼�����	3
    readdir()	����Ŀ¼����е���Ŀ��	3
    rewinddir()	����Ŀ¼�����	3
    scandir()	�г�ָ��·���е��ļ���Ŀ¼��	5
 * */
class DirectoryController extends CommonController{
    public function main(){
        $path = 'D:/wamp/www/';
        var_dump(scandir($path));
        var_dump(getcwd());
    }
}