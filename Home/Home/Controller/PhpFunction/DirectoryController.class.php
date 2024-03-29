<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 14:42
 * description: 文件夹函数
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *    函数	  描述	   PHP
    chdir()	改变当前的目录。	3
    chroot()	改变当前进程的根目录。	4
    dir()	打开一个目录句柄，并返回一个对象。	3
    closedir()	关闭目录句柄。	3
    getcwd()	返回当前目录。	4
    opendir()	打开目录句柄。	3
    readdir()	返回目录句柄中的条目。	3
    rewinddir()	重置目录句柄。	3
    scandir()	列出指定路径中的文件和目录。	5
 * */
class DirectoryController extends CommonController{
    public function main(){
        $path = 'D:/wamp/www/';
        var_dump(scandir($path));
        var_dump(getcwd());
    }
}