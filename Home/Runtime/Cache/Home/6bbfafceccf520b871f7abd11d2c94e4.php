<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>毕设官网</title>
    <link rel="stylesheet" href="/WCP/Ext/Bootstrap/css/bootstrap.min.css">
    <style>
        body{
            padding-top: 70px;
        }
    </style>
</head>
<body>
    <!--导航条(自适应)-->
    <nav class="navbar navbar-dafault navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collpse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">毕设官网</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collpse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">综述</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>内容管理系统</span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">文案管理</a></li>
                            <li><a href="#">微信平台管理</a></li>
                            <li><a href="#">素材管理</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </li>
                    <li><a href="#">服务管理系统</a></li>
                    <li><a href="#">数据可视化平台</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!--滚动图片广告-->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1" ></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="" alt="">
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <img src="" alt="">
                <div class="carousel-caption">

                </div>
            </div>

        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <!--js文件-->
    <script src="/WCP/Ext/JQuery/jquery-2.2.0.min.js"></script>
    <script src="/WCP/Ext/Bootstrap/js/bootstrap.min.js"></script>

</body>
</html>