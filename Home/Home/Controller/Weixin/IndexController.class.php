<?php
/**
 * Author: helen
 * CreateTime: 2016/2/26 10:19
 * description: ΢�Ź����˺ų�ʼ������
 */
    namespace Home\Controller\Weixin;   //���ö༶�����������ռ��������ʽ
    use Think\Controller;
    class IndexController extends Controller{

        public function __construct(){
            //��ʼ������(�˴�����һЩ��ʼ������)

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


        //΢����֤
        public function index(){
            //��ȡ΢�ŷ���ȷ�ϵĲ�����
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
        //΢�Żظ���Ϣ
        public function getMsg(){
            //1,��ȡ��΢�����͹���post���ݣ�xml��ʽ��
            $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
            //2,������Ϣ���ͣ������ûظ����ͺ�����
            $postObj = simplexml_load_string($postArr);
            //3���¼��ж�(����΢�����͵�MsgType��Event�����¼����ж�)
            $MsgType = strtolower($postObj->MsgType);
            $Event = strtolower($postObj->Event);
            //4���¼����������¼������΢��ɨ�봦��
            //��ȡ�ӿڵ���ƾ��
            $access_token = getToken();
            //�����û�openid�ж��û���Ϣ�Ƿ��Ѿ��������ݿ���
            $openid = $postObj->FromUserName;
            $search_user = $this->searchUserInfo($openid);
            if(!$search_user){  //δ���û���Ϣ����ֱ�ӽ��д洢,�����û�����Ϣ����ȡ�û���Ϣ�������ݿ��С�
                $user_info_data = getUserInfo($access_token,$openid);
                $this->saveWeixinUserInfo($openid,$user_info_data);
            }

            //ɨ�������¼� (ɨ�����¼��ҵ�������Ϣ�����С���ʾ����¼����� )
            if($MsgType=='event'&&$Event=='scancode_waitmsg'){
                //������ɨ���¼�
                if($postObj->ScanCodeInfo->ScanType=='barcode'){
                    $result = $postObj->ScanCodeInfo->ScanResult;
                    $pos = strpos($result,',');
                    $ISBN = substr($result,$pos+1);
                    $BookInfo = $this->searchBookInfo($ISBN);
                    $Content = '��ӭ��,'.$user_info_data->nickname.'����Ҫ�������Ϊ:'.$BookInfo['title'].',����Ϊ:'.$BookInfo['author'].',������Ҫ����'.$BookInfo['summary'];
                    responseText($postObj,$Content);
                }elseif($postObj->ScanCodeInfo->ScanType=='qrcode'){
                    $redirect_uyl = $postObj->ScanCodeInfo->ScanResult;
                    $Content = '��ӭ��,'.$user_info_data->nickname.'<a href='.$redirect_uyl.'>���������ӣ����н�һ������</a>';
                    responseText($postObj,$Content);
                }

            }


            //�û���ע�¼�
            if( strtolower($postObj->MsgType)=='event' && strtolower($postObj->Event)=='subscribe' ){
                $Content = 'MakerWay����л���Ĺ�ע!���ܻظ�ϵͳ�ڴ������Ի���';
                responseText($postObj,$Content);
            }
            //��ͨ��Ϣ�ظ�
            //�û������ı���Ϣ
            if( strtolower($postObj->MsgType)=='text' && strtolower($postObj->Content)=='��ʷ��Ϣ' ){
                $array = array(
                    array(
                        'title'=>'hao123',
                        'description'=>"hao123 is very cool",
                        'picUrl'=>'https://www.baidu.com/img/bdlogo.png',
                        'url'=>'http://www.hao123.com',
                    ),
                    //��ͼ��ֱ����Ӽ��ɣ�
                );
                responseNews($postObj,$array);
            }
            if( strtolower($postObj->MsgType)=='text' && strtolower($postObj->Content)!='��ʷ��Ϣ' )
            {
                $Content = '��������ǣ�'.$postObj->Content;
                responseText($postObj,$Content);
            }
            //�û�����λ����Ϣ
            if( strtolower($postObj->MsgType)=='location' ){
                $Content = '������������λ��Ϊ��'.$postObj->Label.'.����Ϊ��'.$postObj->Location_Y.'.γ��Ϊ��'.$postObj->Location_X;
                responseText($postObj,$Content);
            }
        }

        //ɨ�������¼�
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

        //weixin_user_info��΢���û�������Ϣ��
        function saveWeixinUserInfo($openid,$user_info_data){
            //���Ƚ����û����ң�������ԣ��������
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
        //��ѯ�û���Ϣ�Ƿ��Ѿ�����
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
        //����ͼ��API(����API�ṩ�˸���ISBN����ѯ�鱾��Ϣ�ķ���)
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
        //�����û�ͼ����Ϣ
        function saveBookInfo($openid,$ISBN,$BookInfo){
            $bookInfo = M('weixin_book_info');
            //���ȸ���ͼ��ISBN���в���
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
        //�����û�������Ϣ
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
        //����ͼ�����ͼ�鱾����Ϣ
        function saveBookList($ISBN,$action){
            $bookList = M('weixin_book_list');
            $map['isbn'] = $ISBN;
            $res = $bookList->where($map)->find();
            if($res){   //�鱾�Ѵ���
                if($action=='share'){   //����
                    $share_data['total_count'] = $res['total_count']+1;
                    $share_data['surplus_count'] = $res['surplus_count']+1;
                    $share_data['update_time'] = date('Y-m-d H:i:s',time());
                    $bookList->where($map)->save($share_data);
                    $back_data['msg'] = '����ɹ�';
                }elseif($action=='borrow'){     //����
                    if($res['surplus_count']=0){
                        $back_data['msg'] = '��ǰ������ȫ�����';
                    }else{
                        $borrow_data['surplus_count'] = $res['surplus_count']-1;
                        $borrow_data['update_time'] = date('Y-m-d H:i:s',time());
                        $bookList->where($map)->save($borrow_data);
                        $back_data['msg'] = '���ĳɹ�';
                    }
                }else{      //�黹
                    $return_data['surplus_count'] = $res['surplus_count']+1;
                    $return_data['update_time'] = date('Y-m-d H:i:s',time());
                    $bookList->where($map)->save($return_data);
                    $back_data['msg'] = '�黹�ɹ�';
                }
            }else{      //�鱾δ����
                $new_date['isbn'] = $ISBN;
                $new_date['total_count'] = 1;
                $new_date['surplus_count'] = 1;
                $new_date['create_time'] = date('Y-m-d H:i:s',time());
                $new_date['update_time'] = date('Y-m-d H:i:s',time());
                $bookList->data($new_date)->add();
                $back_data['msg'] = '����ɹ�';
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