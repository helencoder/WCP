<?php
/**
 * Author: helen
 * CreateTime: 2016/3/25 11:53
 * description:
 */
namespace Home\Controller\Program;
use Think\Controller;
class CacheController extends Controller{
    public function test(){
        //�����ʼ��,ֱ�Ӳ���S��������
        /*S(array('type'=>'xcahe','expire'=>60));
        S(array(
                'type'=>'memcache',
                'host'=>'192.168.1.10',
                'port'=>'11211',
                'prefix'=>'think',
                'expire'=>60)
        );*/
        // ��ʼ������
        $cache = S(array('type'=>'xcache','prefix'=>'think','expire'=>600));
        $cache->name = 'value'; // ���û���
        $value = $cache->name; // ��ȡ����
        dump($value);
        //unset($cache->name); // ɾ������
    }

}