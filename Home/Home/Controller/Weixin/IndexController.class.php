<?php
/**
 * Author: helen
 * CreateTime: 2016/2/26 10:19
 * description: 微信公众账号初始函数等
 */
    namespace Home\Controller\Weixin;   //设置多级域名后命名空间的命名方式
    use Think\Controller;
    class IndexController extends Controller{

        public function __construct(){
            //初始化函数(此处设置一些初始化方法)

        }
        public function getShortUrl(){
            $access_token = getToken();
            $url = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token='.$access_token;
            $url1 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx3be7b35d2d7a8256&redirect_uri=http://m.shuangan.bj.meezao.com/Game/ShuanFuweng/start.html?share_place=origin&response_type=code&scope=snsapi_userinfo&state=oauth#wechat_redirect';
            dump($url1);
            $share_place = $_GET['option'];
            dump($_GET['option']);
            $data['share_place'] = empty($share_place)?'origin_link':$share_place;
            dump($data['share_place']);
            $data = array(

            );
        }


        //微信验证
        public function index(){
            //获取微信发送确认的参数。
            $signature = $_GET['signature'];
            $timestamp = $_GET['timestamp'];
            $nonce = $_GET['nonce'];
            $echostr = $_GET['echostr'];
            $token = 'weixin';
            $array = array($token,$timestamp,$nonce);
            sort($array);
            $str = sha1( implode($array) );
            if( $str==$signature && $echostr ){
                echo $echostr;
                exit;
            }else{
                $this->getMsg();
            }
        }
        //微信回复消息
        public function getMsg(){
            //1,获取到微信推送过来post数据（xml格式）
            $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
            //2,处理消息类型，并设置回复类型和内容
            $postObj = simplexml_load_string($postArr);
            //3、事件判断(根据微信推送的MsgType和Event进行事件的判断)
            $MsgType = strtolower($postObj->MsgType);
            $Event = strtolower($postObj->Event);
            //4、事件处理（基础事件处理和微信扫码处理）
            //获取接口调用凭据
            $access_token = getToken();
            //根据用户openid判断用户信息是否已经存入数据库中
            $openid = $postObj->FromUserName;
            $search_user = $this->searchUserInfo($openid);
            if(!$search_user){  //未有用户信息，则直接进行存储,根据用户的信息，拉取用户信息存入数据库中。
                $user_info_data = getUserInfo($access_token,$openid);
                $this->saveWeixinUserInfo($openid,$user_info_data);
            }

            //扫码推送事件 (扫码推事件且弹出“消息接收中”提示框的事件推送 )
            if($MsgType=='event'&&$Event=='scancode_waitmsg'){
                //条形码扫描事件
                if($postObj->ScanCodeInfo->ScanType=='barcode'){
                    $result = $postObj->ScanCodeInfo->ScanResult;
                    $pos = strpos($result,',');
                    $ISBN = substr($result,$pos+1);
                    $BookInfo = $this->searchBookInfo($ISBN);
                    $Content = '欢迎您,'.$user_info_data->nickname.'。您要分享的书为:'.$BookInfo['title'].',作者为:'.$BookInfo['author'].',本书主要讲述'.$BookInfo['summary'];
                    responseText($postObj,$Content);
                }elseif($postObj->ScanCodeInfo->ScanType=='qrcode'){
                    $redirect_uyl = $postObj->ScanCodeInfo->ScanResult;
                    $Content = '欢迎您,'.$user_info_data->nickname.'<a href='.$redirect_uyl.'>请点击此链接，进行进一步操作</a>';
                    responseText($postObj,$Content);
                }

            }


            //用户关注事件
            if( strtolower($postObj->MsgType)=='event' && strtolower($postObj->Event)=='subscribe' ){
                $Content = 'MakerWay，感谢您的关注!智能回复系统期待与您对话。';
                responseText($postObj,$Content);
            }
            //普通消息回复
            //用户发送文本消息
            if( strtolower($postObj->MsgType)=='text' && strtolower($postObj->Content)=='历史消息' ){
                $array = array(
                    array(
                        'title'=>'hao123',
                        'description'=>"hao123 is very cool",
                        'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
                        'url'=>'http://www.hao123.com',
                    ),
                    //多图文直接添加即可！
                );
                responseNews($postObj,$array);
            }
            if( strtolower($postObj->MsgType)=='text' && strtolower($postObj->Content)!='历史消息' )
            {
                $Content = '您输入的是：'.$postObj->Content;
                responseText($postObj,$Content);
            }
            //用户发送位置信息
            if( strtolower($postObj->MsgType)=='location' ){
                $Content = '您现在所处的位置为：'.$postObj->Label.'.经度为：'.$postObj->Location_Y.'.纬度为：'.$postObj->Location_X;
                responseText($postObj,$Content);
            }
        }

        //扫码推送事件
        function scancodeWaitmsg($type,$result){
            switch($type){
                case 'barcode':
                    $pos = strpos($result,',');
                    $data['barcode'] = substr($result,$pos+1);
                    break;
                case 'qrcode':
                    $data['url'] = $result;
                    break;
            }
            return $data;
        }

        //weixin_user_info表（微信用户基础信息表）
        function saveWeixinUserInfo($openid,$user_info_data){
            //首先进行用户查找，有则忽略，无则添加
            $weixinUserInfo = M('weixin_user_info');
            $search_user = $weixinUserInfo->where("openid=$openid")->find();
            if($search_user){
                return true;
            }else{
                $data['openid'] = $openid;
                $data['create_time'] = date('Y-m-d H:i:s',time());
                $data['nickname'] = $user_info_data->nickname;
                $data['sex'] = $user_info_data->sex;
                $data['province'] = $user_info_data->province;
                $data['city'] = $user_info_data->city;
                $data['country'] = $user_info_data->country;
                $data['headimgurl'] = $user_info_data->headimgurl;
                $data['is_subscribe'] = 1;
                $weixinUserInfo->data($data)->add();
            }

        }
        //查询用户信息是否已经存在
        function searchUserInfo($openid){
            header('Content-type: text/html; charset=utf-8');
            $weixinUserInfo = M('weixin_user_info');
            $search_user = $weixinUserInfo->where("openid=$openid")->find();
            if($search_user){
                return true;
            }else{
                return false;
            }
        }
        //豆瓣图书API(豆瓣API提供了根据ISBN来查询书本信息的服务)
        function searchBookInfo($ISBN){
            header('Content-type: text/html; charset=utf-8');
            $request_url = 'https://api.douban.com/v2/book/isbn/'.$ISBN;
            $res = api_request($request_url);
            $BookInfo['title'] = $res->title;
            $author = $res->author;
            $BookInfo['author'] = $author[0];
            $BookInfo['author_intro'] = $res->author_intro;
            $BookInfo['summary'] = $res->summary;
            $BookInfo['catalog'] = $res->catalog;
            $BookInfo['image'] = $res->image;
            $BookInfo['ebook_url'] = $res->ebook_url;
            //$BookInfo['tags'] = $res->tags;
            return $BookInfo;
        }
        //保存用户图书信息
        function saveBookInfo($openid,$ISBN,$BookInfo){
            $bookInfo = M('weixin_book_info');
            //首先根据图书ISBN进行查找
            $map['isbn'] = $ISBN;
            $res = $bookInfo->where($map)->find();
            if($res){
                return 'existed';
            }else{
                $data['isbn'] = $ISBN;
                $data['first_openid'] = $openid;
                $data['title'] = $BookInfo['title'];
                $data['author'] = $BookInfo['author'];
                $data['author_intro'] = $BookInfo['author_intro'];
                $data['summary'] = $BookInfo['summary'];
                $data['catalog'] = $BookInfo['catalog'];
                $data['image'] = $BookInfo['image'];
                $data['ebook_url'] = $BookInfo['ebook_url'];
                $data['title'] = $BookInfo['title'];
                $data['create_time'] = date('Y-m0d H:i:s',time());
                $data['update_time'] = date('Y-m0d H:i:s',time());
                $bookInfo->data($data)->add();
                return 'success';
            }
        }
        //保存用户借阅信息
        function saveBookUser($ISBN,$openid,$action){
            $bookUser = M('weixin_book_user');
            $data['isbn'] = $ISBN;
            $data['openid'] = "$openid";
            $data['action'] = $action;
            if($action=='borrow'){
                $data['return_time'] = date('Y-m-d H:i:s',strtotime("+1 month"));
                $data['is_return'] = 0;
            }
            $data['create_time'] = date('Y-m-d H:i:s',time());
            $data['update_time'] = date('Y-m-d H:i:s',time());
            $bookUser->data($data)->add();
        }
        //保存图书馆中图书本数信息
        function saveBookList($ISBN,$action){
            $bookList = M('weixin_book_list');
            $map['isbn'] = $ISBN;
            $res = $bookList->where($map)->find();
            if($res){   //书本已存在
                if($action=='share'){   //分享
                    $share_data['total_count'] = $res['total_count']+1;
                    $share_data['surplus_count'] = $res['surplus_count']+1;
                    $share_data['update_time'] = date('Y-m-d H:i:s',time());
                    $bookList->where($map)->save($share_data);
                    $back_data['msg'] = '分享成功';
                }elseif($action=='borrow'){     //借阅
                    if($res['surplus_count']=0){
                        $back_data['msg'] = '当前此书已全部外借';
                    }else{
                        $borrow_data['surplus_count'] = $res['surplus_count']-1;
                        $borrow_data['update_time'] = date('Y-m-d H:i:s',time());
                        $bookList->where($map)->save($borrow_data);
                        $back_data['msg'] = '借阅成功';
                    }
                }else{      //归还
                    $return_data['surplus_count'] = $res['surplus_count']+1;
                    $return_data['update_time'] = date('Y-m-d H:i:s',time());
                    $bookList->where($map)->save($return_data);
                    $back_data['msg'] = '归还成功';
                }
            }else{      //书本未存在
                $new_date['isbn'] = $ISBN;
                $new_date['total_count'] = 1;
                $new_date['surplus_count'] = 1;
                $new_date['create_time'] = date('Y-m-d H:i:s',time());
                $new_date['update_time'] = date('Y-m-d H:i:s',time());
                $bookList->data($new_date)->add();
                $back_data['msg'] = '分享成功';
            }
            return $back_data;
        }
        public function test(){
            $ISBN = '9787508641225';
            /*$request_url = 'https://api.douban.com/v2/book/isbn/'.$ISBN;
            $res = api_request($request_url);*/
            $res = $this->searchBookInfo($ISBN);
            dump($res);
            $time = date('Y-m-d H:i:s',strtotime("+1 month"));
            dump($time);
        }

    }