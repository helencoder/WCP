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
        //缓存初始化,直接采用S方法即可
        /*S(array('type'=>'xcahe','expire'=>60));
        S(array(
                'type'=>'memcache',
                'host'=>'192.168.1.10',
                'port'=>'11211',
                'prefix'=>'think',
                'expire'=>60)
        );*/
        // 初始化缓存
        $cache = S(array('type'=>'xcache','prefix'=>'think','expire'=>600));
        $cache->name = 'value'; // 设置缓存
        $value = $cache->name; // 获取缓存
        dump($value);
        //unset($cache->name); // 删除缓存
    }

}