<?php
return array(
	//'配置项'=>'配置值'

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'weixin',          // 数据库名
    'DB_USER'               =>  'helen',      // 用户名
    'DB_PWD'                =>  '901230',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀

    /* 模板相关配置 (路径)*/
    'TMPL_PARSE_STRING' => array(
        /*
         * 示例
         * '__MEEZAOWX__' => __ROOT__.'/Public/MeeZao/weixin', //静态蜜枣微信样式文件
         */
        '__Public__' => __ROOT__.'/Public', //Public文件夹路径
        '__Ext__' => __ROOT__.'/Ext' //Ext文件夹路径
    ),

    //开启多级控制器
    'CONTROLLER_LEVEL'	=>  2,

    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

);