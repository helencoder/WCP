<?php
/**
 * Author: helen
 * CreateTime: 2016/3/30 14:56
 * description:
 */
namespace Home\Controller\Makerway;
use Think\Controller;
class IndexController extends Controller{
    //网站主页面
    public function index(){
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        dump($url);
        $helen = null;
        if(isset($helen)){
            echo 'huihui';
        }
        $this->display();
    }
    public function register(){
        session_start();
        $root = $_SERVER['DOCUMENT_ROOT'];
        require $root.'makerway/Ext/captcha.php';
        \captcha::generate(6,48);
        $this->display();
    }
    public function testISBN(){
        $ISBN = '9787308115469';
        header('Content-type: text/html; charset=utf-8');
        $request_url = 'https://api.douban.com/v2/book/isbn/'.$ISBN;
        $res = api_request($request_url);
        //获取标签
        $tags = $res->tags;
        $count = count($tags);
        $BookInfo['tags'] = '';
        foreach($tags as $key=>$value){
            $BookInfo['tags'] .= $value->name.' ';
        }
        dump($res);
        $BookInfo['title'] = $res->title;
        $author = $res->author;
        $BookInfo['author'] = $author[0];
        $BookInfo['author_intro'] = $res->author_intro;
        $BookInfo['summary'] = $res->summary;
        $BookInfo['image'] = $res->image;
        $BookInfo['catalog'] = $res->catalog;
        $BookInfo['ebook_url'] = $res->ebook_url;
        //添加标签
        //$BookInfo['tags'] = $res->tags;
        //return $BookInfo;
        dump($BookInfo);
    }
}