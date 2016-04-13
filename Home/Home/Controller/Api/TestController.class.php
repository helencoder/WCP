<?php
/**
 * Author: helen
 * CreateTime: 2016/3/7 14:45
 * description:
 */
    namespace Home\Controller\Api;
    use Think\Controller;
    class TestController extends Controller{
        public function index(){
            //dump(C('TMPL_PARSE_STRING.__Public__') );
            $this->display();
        }
    }