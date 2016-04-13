<?php
/**
 * Author: helen
 * CreateTime: 2016/3/8 9:16
 * description: 表单设计与管理
 */
    namespace Home\Controller\Program;
    use Think\Controller;
    class FormController extends Controller{
        public function validate(){
            dump(filter_var('email@example.com',FILTER_VALIDATE_EMAIL));
            dump(filter_var('http://www.example.com',FILTER_VALIDATE_URL));
        }
    }