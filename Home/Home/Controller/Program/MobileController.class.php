<?php
/**
 * Author: helen
 * CreateTime: 2016/3/7 21:48
 * description: PHP���ƶ��豸�ϵ�Ӧ��
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