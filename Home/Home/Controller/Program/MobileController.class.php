<?php
/**
 * Author: helen
 * CreateTime: 2016/3/7 21:48
 * description: PHP在移动设备上的应用
 */
    namespace Home\Controller\Program;
    use Think\Controller;
    class MobileController extends Controller{
        public function testMobile(){
            dump($_SERVER['HTTP_USER_AGENT']);
            dump(get_browser($_SERVER['HTTP_USER_AGENT'],true));
            dump(preg_match('a','abc'));
        }
    }