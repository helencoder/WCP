<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 14:51
 * description: �ļ�ϵͳ����
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *   ����	     ����	PHP
    basename()	����·���е��ļ������֡�	3
    chgrp()	�ı��ļ��顣	3
    chmod()	�ı��ļ�ģʽ��	3
    chown()	�ı��ļ������ߡ�	3
    clearstatcache()	����ļ�״̬���档	3
    copy()	�����ļ���	3
    delete()	�μ� unlink() �� unset()��
    dirname()	����·���е�Ŀ¼���Ʋ��֡�	3
    disk_free_space()	����Ŀ¼�Ŀ��ÿռ䡣	4
    disk_total_space()	����һ��Ŀ¼�Ĵ�����������	4
    diskfreespace()	disk_free_space() �ı�����	3
    fclose()	�رմ򿪵��ļ���	3
    feof()	�����ļ�ָ���Ƿ����ļ�������λ�á�	3
    fflush()	��򿪵��ļ�����������ݡ�	4
    fgetc()	�Ӵ򿪵��ļ��з����ַ���	3
    fgetcsv()	�Ӵ򿪵��ļ��н���һ�У�У�� CSV �ֶΡ�	3
    fgets()	�Ӵ򿪵��ļ��з���һ�С�	3
    fgetss()	�Ӵ򿪵��ļ��ж�ȡһ�в����˵� HTML �� PHP ��ǡ�	3
    file()	���ļ�����һ�������С�	3
    file_exists()	����ļ���Ŀ¼�Ƿ���ڡ�	3
    file_get_contents()	���ļ������ַ�����	4
    file_put_contents()	���ַ���д���ļ���	5
    fileatime()	�����ļ����ϴη���ʱ�䡣	3
    filectime()	�����ļ����ϴθı�ʱ�䡣	3
    filegroup()	�����ļ����� ID��	3
    fileinode()	�����ļ��� inode ��š�	3
    filemtime()	�����ļ����ϴ��޸�ʱ�䡣	3
    fileowner()	�ļ��� user ID �������ߣ���	3
    fileperms()	�����ļ���Ȩ�ޡ�	3
    filesize()	�����ļ���С��	3
    filetype()	�����ļ����͡�	3
    flock()	�������ͷ��ļ���	3
    fnmatch()	����ָ����ģʽ��ƥ���ļ������ַ�����	4
    fopen()	��һ���ļ��� URL��	3
    fpassthru()	�Ӵ򿪵��ļ��ж����ݣ�ֱ�� EOF�������������д�����	3
    fputcsv()	���и�ʽ��Ϊ CSV ��д��һ���򿪵��ļ��С�	5
    fputs()	fwrite() �ı�����	3
    fread()	��ȡ�򿪵��ļ���	3
    fscanf()	����ָ���ĸ�ʽ��������н�����	4
    fseek()	�ڴ򿪵��ļ��ж�λ��	3
    fstat()	���ع���һ���򿪵��ļ�����Ϣ��	4
    ftell()	�����ļ�ָ��Ķ�/дλ��	3
    ftruncate()	���ļ��ضϵ�ָ���ĳ��ȡ�	4
    fwrite()	д���ļ���	3
    glob()	����һ������ƥ��ָ��ģʽ���ļ���/Ŀ¼�����顣	4
    is_dir()	�ж�ָ�����ļ����Ƿ���һ��Ŀ¼��	3
    is_executable()	�ж��ļ��Ƿ��ִ�С�	3
    is_file()	�ж�ָ���ļ��Ƿ�Ϊ������ļ���	3
    is_link()	�ж�ָ�����ļ��Ƿ������ӡ�	3
    is_readable()	�ж��ļ��Ƿ�ɶ���	3
    is_uploaded_file()	�ж��ļ��Ƿ���ͨ�� HTTP POST �ϴ��ġ�	3
    is_writable()	�ж��ļ��Ƿ��д��	4
    is_writeable()	is_writable() �ı�����	3
    link()	����һ��Ӳ���ӡ�	3
    linkinfo()	�����й�һ��Ӳ���ӵ���Ϣ��	3
    lstat()	���ع����ļ���������ӵ���Ϣ��	3
    mkdir()	����Ŀ¼��	3
    move_uploaded_file()	���ϴ����ļ��ƶ�����λ�á�	4
    parse_ini_file()	����һ�������ļ���	4
    pathinfo()	���ع����ļ�·������Ϣ��	4
    pclose()	�ر��� popen() �򿪵Ľ��̡�	3
    popen()	��һ�����̡�	3
    readfile()	��ȡһ���ļ����������������塣	3
    readlink()	���ط������ӵ�Ŀ�ꡣ	3
    realpath()	���ؾ���·������	4
    rename()	�������ļ���Ŀ¼��	3
    rewind()	�����ļ�ָ���λ�á�	3
    rmdir()	ɾ���յ�Ŀ¼��	3
    set_file_buffer()	�����Ѵ��ļ��Ļ����С��	3
    stat()	���ع����ļ�����Ϣ��	3
    symlink()	�����������ӡ�	3
    tempnam()	����Ψһ����ʱ�ļ���	3
    tmpfile()	������ʱ�ļ���	3
    touch()	�����ļ��ķ��ʺ��޸�ʱ�䡣	3
    umask()	�ı��ļ����ļ�Ȩ�ޡ�	3
    unlink()	ɾ���ļ���	3
 * */
class FilesystemController extends CommonController{
    public function main(){

    }
}