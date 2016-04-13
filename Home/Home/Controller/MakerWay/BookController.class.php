<?php
/**
 * Author: helen
 * CreateTime: 2016/3/24 19:41
 * description:
 */
    namespace Home\Controller\Makerway;
    use Think\Controller;
    class BookController extends Controller{
        /*
         * ��ҪǨ�ƵĶ��������ݱ�������ҳ��
         * */
        //΢����֤(����ҳ��)
        public function Index(){
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
                $this->getWeixinMsg();
            }
        }
        //΢�Żظ���Ϣ
        public function getWeixinMsg(){
            //1,��ȡ��΢�����͹���post���ݣ�xml��ʽ��
            $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
            //2,������Ϣ���ͣ������ûظ����ͺ�����
            $postObj = simplexml_load_string($postArr);
            //3���¼��ж�(����΢�����͵�MsgType��Event�����¼����ж�)
            $MsgType = strtolower($postObj->MsgType);
            $Event = strtolower($postObj->Event);
            //4���¼����������¼������΢��ɨ�봦��
            //��ȡ�ӿڵ���ƾ��
            $access_token = $this->getWeixinToken();
            //�����û�openid�ж��û���Ϣ�Ƿ��Ѿ��������ݿ���
            $openid = $postObj->FromUserName;
            //�˴������û����
            $user_info = $this->searchWeixinUserInfo($openid);
            if(!$user_info){  //δ���û���Ϣ����ֱ�ӽ��д洢,�����û�����Ϣ����ȡ�û���Ϣ�������ݿ��С�
                $user_info_data = $this->getUserInfo($access_token,$openid);
                $this->saveWeixinUserInfo($openid,$user_info_data);
                $user_info['nickname'] = $user_info_data->nickname;
            }
            //ɨ�������¼� (ɨ�����¼��ҵ�������Ϣ�����С���ʾ����¼����� )
            if($MsgType=='event'&&$Event=='scancode_waitmsg'){
                //�����롢��ά��ɨ���¼�
                if($postObj->ScanCodeInfo->ScanType=='barcode'){
                    $result = $postObj->ScanCodeInfo->ScanResult;
                    $pos = strpos($result,',');
                    $ISBN = substr($result,$pos+1);
                    $BookInfo = $this->searchBookInfo($ISBN);
                    $action = $postObj->EventKey;
                    //�洢ͼ����Ϣ
                    $this->saveBookInfo($openid,$ISBN,$BookInfo);
                    //�洢ͼ�鱾����Ϣ
                    $this->saveBookList($ISBN,$action);
                    //�洢�û���Ϣ
                    $this->saveBookUser($ISBN,$openid,$action);
                    //���������¼������ͣ����н�һ������
                    if($action=='share'){
                        $Content = "�����鱾���ӣ����з���\n<a href='http://www.makerway.space/Home/Book/share.html?ISBN=$ISBN&openid=$openid'>��".$BookInfo['title']."��</a>"."\n��ӭ����".$user_info['nickname']."����л��ʹ��makerway�������ǻۣ�";
                    }elseif($action=='borrow'){
                        $Content = "�����鱾���ӣ����н��ģ�\n<a href='http://www.makerway.space/Home/Book/borrow.html?ISBN=$ISBN&openid=$openid'>��".$BookInfo['title']."��</a>"."\n��ӭ����".$user_info['nickname']."����л��ʹ��makerway�������ǻۣ�";
                    }else{
                        $Content = "�����鱾���ӣ����й黹��\n<a href='http://www.makerway.space/Home/Book/back.html?ISBN=$ISBN&openid=$openid'>��".$BookInfo['title']."��</a>"."\n��ӭ����".$user_info['nickname']."����л��ʹ��makerway�������ǻۣ�";
                    }
                    responseText($postObj,$Content);
                }elseif($postObj->ScanCodeInfo->ScanType=='qrcode'){
                    $redirect_url = $postObj->ScanCodeInfo->ScanResult;
                    $Content = "<a href='$redirect_url'>��ӭ��,".$user_info['nickname']." ���������ӣ����н�һ������</a>";
                    responseText($postObj,$Content);
                }
            }
            //����˵���ȡ��Ϣʱ���¼�����
            if($MsgType=='event'&&$Event=='click'){
                //�ǻ۷���(�����˴�Ϊͼ����Ϣ)
                $Content = "��ӭ����<a href='http://www.makerway.space/Home/Book/comment.html'>�������ӣ�������Ҫ��д������</a>";
                responseText($postObj,$Content);
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

        //makerwayͼ�鹫�ں�չʾҳ
        //ͼ�����
        public function share(){
            $ISBN = $_GET['ISBN'];
            $openid = $_GET['openid'];
            $this->assign('isbn',$ISBN);
            $this->assign('openid',$openid);
            //���Ȼ�ȡ���ݿ��е��鱾��Ϣ�Լ���Ա��Ϣ;
            /*$BookInfo = $this->getBookInfo($ISBN);
            $UserInfo = $this->getWeixinUserInfo($openid);
            //�����û���Ϣ���Ƿ����web_id�ֶν����ж�
            $web_id = $UserInfo['web_id'];
            if(empty($web_id)){
                //web_id�����ڣ�֤������û���й���
                $this->assign('tip',1); //���˴�ֵ��ǰ�ˣ�����js����ҳ����ʾע��ҳ
            }else{
                //�ѽ��а�
                $this->assign('tip',0); //���˴�ֵ��ǰ�ˣ�����js����ҳ����ʾע��ҳ
                //��ʱ����web_idȥpw_book_user_info�������Ϣ,������Ϣȷ�ϵ�չʾ
                $BookUserInfo = $this->getWebBookUserInfo($web_id);
                $this->assgin('BookUserInfo',$BookUserInfo);
            }
            //����û���Ϣ
            $this->assign('BookInfo',$BookInfo);
            $this->assign('UserInfo',$UserInfo);*/
            //�����¼

            //���ܸ���Ȥ����

            $this->assign('tip',1);
            $this->display();
        }
        //������
        public function share_handle(){
            //����ajax�������ı���ֵ
            $username = $_POST['username'];
            $phone = $_POST['phone'];
            $addr = $_POST['addr'];
            $isbn = $_POST['isbn'];
            $openid = $_POST['openid'];
            $type = $_POST['type'];
            //����typeֵ�ж���Ҫ������¼�����
            switch($type){
                case 'modify':  //�޸��û���Ϣ

                    break;
                case 'share':

                    break;
                case 'register':
                    //������Ϣ�� web_id �û���¼

                    break;
                case 'login':
                    //������Ϣ�� web_id

                    break;
                default:

                    break;
            }
            $data['code'] = 1;
            $data['msg'] = 'success';
            $this->ajaxReturn($data,'JSON');
        }
        //��վ���û���Ϣ��ѯ
        function getWebBookUserInfo($id){
            $map['book_user_info_id'] = $id;
            $webBookUserInfoTable = M('book_user_info');
            $BookUserInfo = $webBookUserInfoTable->where($map)->find();
            return $BookUserInfo;
        }

        //�û�ע��
        public function register(){

        }
        //�û���Ϣ�޸�
        public function msgModify(){

        }
        //ͼ�����
        public function borrow(){
            $ISBN = $_GET['ISBN'];
            $openid = $_GET['openid'];
            //���ȼ�����ݿ����Ƿ񱣴����鱾��Ϣ�Լ���Ա��Ϣ;
            $BookInfo = $this->getBookInfo($ISBN);
            $UserInfo = $this->getWeixinUserInfo($openid);
            $this->assign('BookInfo',$BookInfo);
            $this->assign('UserInfo',$UserInfo);
            $this->display();
        }
        //ͼ��黹
        public function back(){
            $ISBN = $_GET['ISBN'];
            $openid = $_GET['openid'];
            //���Ȼ�ȡ���ݿ����Ƿ񱣴����鱾��Ϣ�Լ���Ա��Ϣ;
            $BookInfo = $this->getBookInfo($ISBN);
            $UserInfo = $this->getWeixinUserInfo($openid);
            $this->assign('BookInfo',$BookInfo);
            $this->assign('UserInfo',$UserInfo);
            $this->display();
        }
        //ͼ������ҳ
        public function bookInfo(){
            $ISBN = $_GET['ISBN'];
            $openid = $_GET['openid'];
            $BookInfo = $this->getBookInfo($ISBN);
            $UserInfo = $this->getWeixinUserInfo($openid);
            $this->assign('BookInfo',$BookInfo);
            $this->assign('UserInfo',$UserInfo);
            $this->display();
        }
        //���˽�������ҳ
        public function userInfo(){
            //��ȡ������Ϣ
            $openid = $_GET['openid'];
            $UserInfo = $this->getWeixinUserInfo($openid);
            $this->assign('UserInfo',$UserInfo);
            $this->display();
        }
        //���¸���ע����Ϣ
        public function updateUserInfo(){
            $bookUser = M('weixin_book_user');
            $data['name'] = $_POST['name'];
            $data['phone'] = $_POST['phone'];
            $data['location'] = $_POST['location'];

        }

        //������վ�˵�pw_book_user_info��������ע���û���
        function saveBookUserInfo(){
            $bookUserInfoTable = M('book_user_info');
            $data['username'] = '';
            $data['flag'] = 1;
            $data['phone'] = '';
            $data['addr'] = '';
            $data['weixin'] = '';
            $data['password'] = '';
            $bookUserInfoTable->data($data)->add();
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
            $weixinUserInfo = M('weixin_user_info');
            $data['openid'] = "$openid";
            $data['create_time'] = date('Y-m-d H:i:s',time());
            $data['nickname'] = $user_info_data->nickname;
            $data['sex'] = $user_info_data->sex;
            $data['province'] = $user_info_data->province;
            $data['city'] = $user_info_data->city;
            $data['country'] = $user_info_data->country;
            $data['headimgurl'] = $user_info_data->headimgurl;
            $data['is_subscribe'] = 1;
            $res = $weixinUserInfo->data($data)->add();
            if($res){
                return true;
            }else{
                return false;
            }
        }
        //��ѯ�û���Ϣ�Ƿ��Ѿ����ڣ������û���
        function searchWeixinUserInfo($openid){
            $weixinUserInfo = M('weixin_user_info','');
            $map['openid'] = "$openid";
            $search_user = $weixinUserInfo->where($map)->find();
            if($search_user){
                return $search_user;
            }else{
                return false;
            }
        }
        //�����û�ͼ����Ϣ
        function saveBookInfo($openid,$ISBN,$BookInfo){
            $bookInfo = M('weixin_book_info');
            //���ȸ���ͼ��ISBN���в���
            $map['isbn'] = "$ISBN";
            $res = $bookInfo->where($map)->find();
            if($res){
                return 'existed';
            }else{
                $data['isbn'] = $ISBN;
                $data['first_openid'] = "$openid";
                $data['title'] = $BookInfo['title'];
                $data['author'] = $BookInfo['author'];
                $data['author_intro'] = $BookInfo['author_intro'];
                $data['summary'] = $BookInfo['summary'];
                $data['catalog'] = $BookInfo['catalog'];
                $data['image'] = $BookInfo['image'];
                $data['ebook_url'] = $BookInfo['ebook_url'];
                $data['title'] = $BookInfo['title'];
                $data['create_time'] = date('Y-m_d H:i:s',time());
                $data['update_time'] = date('Y-m_d H:i:s',time());
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
            $map['isbn'] = "$ISBN";
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

        //��ȡtoken(�˴���ҪΪ�����ݿ��н������ݵĵ�ȡ)
        function getWeixinToken()
        {
            $weixin_conf_data = M('weixin_conf_data');
            $conf = $weixin_conf_data->where('id=1')->find();
            $token_time = $conf['time'];
            $now_time = time();
            $tip = $now_time - $token_time;
            if ($tip < 7000) {  //ֱ�����
                //�ж�token�Ƿ���Ч
                $access_token = $conf['access_token'];
                $url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.$access_token;
                $res = api_request($url);
                if (empty($access_token) || $res->errcode == 40001) {
                    //���»�ȡ
                    $AppID = $conf['appid'];
                    $AppSecret = $conf['appsecret'];
                    $res = $this->getWeixinAccessToken($AppID, $AppSecret);
                    $access_token = $res->access_token;
                    $new_data['access_token'] = $access_token;
                    $new_data['time'] = time();
                    $res = $weixin_conf_data->where('id=1')->save($new_data);
                }
            } else {  //���»�ȡ
                $AppID = $conf['appid'];
                $AppSecret = $conf['appsecret'];
                $res = $this->getWeixinAccessToken($AppID, $AppSecret);
                $access_token = $res->access_token;
                $new_data['access_token'] = $access_token;
                $new_data['time'] = time();
                $res = $weixin_conf_data->where('id=1')->save($new_data);
            }
            return $access_token;
        }

        //��ȡaccess_token
        function getWeixinAccessToken($appid, $appsecret)
        {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
            $result = api_request($url);
            return $result;
        }

        //����openid��ȡ�û�������Ϣ
        function getUserInfo($access_token,$openid){
            $request_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
            $res = api_request($request_url);
            return $res;
        }


        /*
        * ΢�Ź��ںŽӿڵ��ú���(ͨ���Ƿ���data�ж���Ϊget������post����)
        * ���ڶ���API���þ��ʺ�
        */
        function api_request($url,$data=null){
            //��ʼ��cURL����
            $ch = curl_init();
            //����cURL����������������
            $opts = array(
                //�ھ������ڷ���httpsվ��ʱ��Ҫ������������ر�ssl��֤��
                //��������ʽ����ʱ��Ҫ���ģ���������֤��֤��
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_URL            => $url,
                /*CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $data*/
            );
            curl_setopt_array($ch,$opts);
            //post�������
            if(!empty($data)){
                curl_setopt($ch,CURLOPT_POST,true);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            }
            //ִ��cURL����
            $output = curl_exec($ch);
            if(curl_errno($ch)){    //cURL��������������
                var_dump(curl_error($ch));
                die;
            }
            //�ر�cURL
            curl_close($ch);
            $res = json_decode($output);
            return($res);   //����json����
        }

        //΢�Ź����˺Żظ�����
        //�ظ��ı���Ϣ
        function responseText($postObj,$Content){
            $FromUserName = $postObj->ToUserName;
            $ToUserName   = $postObj->FromUserName;
            $MsgType = 'text';
            $CreateTime = time();
            $template = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml>";
            $info = sprintf($template,$ToUserName,$FromUserName,$CreateTime,$MsgType,$Content);
            echo $info;
        }
        //�ظ�ͼ����Ϣ
        function responseNews($postObj,$array){
            $ToUserName = $postObj->FromUserName;
            $FromUserName = $postObj->ToUserName;
            $CreateTime = time();
            $MsgType = 'news';
            $template = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>".count($array)."</ArticleCount>
                            <Articles>";
            foreach($array as $key=>$value){
                $template .="<item>
                                <Title><![CDATA[".$value['title']."]]></Title>
                                <Description><![CDATA[".$value['description']."]]></Description>
                                <PicUrl><![CDATA[".$value['picUrl']."]]></PicUrl>
                                <Url><![CDATA[".$value['url']."]]></Url>
                                </item>";
            }
            $template .="</Articles>
                            </xml> ";
            $info = sprintf( $template, $ToUserName, $FromUserName, $CreateTime, $MsgType );
            echo $info;
        }


        //����ͼ��API(����API�ṩ�˸���ISBN����ѯ�鱾��Ϣ�ķ���)���ӿڣ�
        function searchBookInfo($ISBN){
            header('Content-type: text/html; charset=utf-8');
            $request_url = 'https://api.douban.com/v2/book/isbn/'.$ISBN;
            $res = api_request($request_url);
            $BookInfo['title'] = $res->title;
            $author = $res->author;
            $BookInfo['author'] = $author[0];
            $BookInfo['author_intro'] = $res->author_intro;
            $BookInfo['summary'] = $res->summary;
            $BookInfo['image'] = $res->image;
            $BookInfo['catalog'] = $res->catalog;
            $BookInfo['ebook_url'] = $res->ebook_url;
            //��ӱ�ǩ
            $tags = $res->tags;
            $BookInfo['tags'] = '';
            foreach($tags as $key=>$value){
                $BookInfo['tags'] .= $value->name.' ';
            }
            return $BookInfo;
        }
        //��ȡ�û�����(�ӿ�)
        /*function getWeixinUserInfo($access_token,$openid){
            $request_url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
            $user_info_data = api_request($request_url);
            $data['nickname'] = $user_info_data->nickname;
            $data['sex'] = $user_info_data->sex;
            $data['province'] = $user_info_data->province;
            $data['city'] = $user_info_data->city;
            $data['country'] = $user_info_data->country;
            $data['headimgurl'] = $user_info_data->headimgurl;
            return $data;
        }*/
        //��ȡͼ������(���ݿ�)
        function getBookInfo($ISBN){
            $bookInfo = M('weixin_book_info');
            $map['isbn'] = $ISBN;
            $res = $bookInfo->where($map)->find();
            return $res;
        }
        //��ȡ�û����飨���ݿ⣩
        function getWeixinUserInfo($openid){
            $userInfo = M('weixin_user_info');
            $map['openid'] = $openid;
            $res = $userInfo->where($map)->find();
            return $res;
        }
        //��ȡͼ���û�����
        function getBookUser($ISBN,$openid){
            $bookUser = M('weixin_book_user');
            $map['isbn'] = $ISBN;
            $map['openid'] = $openid;
            $res = $bookUser->where($map)->find();
            return $res;
        }
        //��ȡͼ�鱾������
        function getBookList($ISBN){
            $bookList = M('weixin_book_list');
            $map['isbn'] = $ISBN;
            $res = $bookList->where($map)->find();
            return $res;
        }


    }