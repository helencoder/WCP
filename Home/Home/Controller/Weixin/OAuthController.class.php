<?php
/**
 * Author: helen
 * CreateTime: 2016/2/27 9:39
 * description: ΢����ҳ��Ȩ��
 */
    namespace Home\Controller\Weixin;
    use Think\Controller;
    class OAuthController extends Controller{
        /*
         * ��ҳ��Ȩ����
         * 1 ��һ�����û�ͬ����Ȩ����ȡcode
         * 2 �ڶ�����ͨ��code��ȡ��ҳ��Ȩaccess_token
         * 3 ��������ˢ��access_token�������Ҫ��
         * 4 ���Ĳ�����ȡ�û���Ϣ(��scopeΪ snsapi_userinfo)
         * 5 ����������Ȩƾ֤��access_token���Ƿ���Ч
         * */
        //��ʼ������
        public function __construct(){
            /*$appid = 'wxa4b61eaf7ba3d596';
            $scope = 'snsapi_userinfo';
            $this->getCode($appid,$scope);*/
        }
        //��Ȩ���̷���
        public function index(){
            $appid = 'wxa4b61eaf7ba3d596';
            $appsecret = '929ef373218ccbca5c6bf73f4becac73';
            $code = $_GET['code'];
            $access_token_res = $this->getAccessToken($appid,$appsecret,$code);
            $access_token = $access_token_res->access_token;
            $openid = $access_token_res->openid;
            //��ȡ�û���Ϣ
            $userinfo_res = $this->getUserInfo($access_token,$openid);
            echo '<h1>��ӭ����'.$userinfo_res->nickname.'</h1>';
        }
        //��һ�����û�ͬ����Ȩ����ȡcode
        /*ע�⣺��ת�ص�redirect_uri��Ӧ��ʹ��https������ȷ����Ȩcode�İ�ȫ�ԡ�
         *appid ���ںŵ�Ψһ��ʶ
         *redirect_uri  ��Ȩ���ض���Ļص����ӵ�ַ����ʹ��urlencode�����ӽ��д���
         *scope Ӧ����Ȩ������snsapi_base ����������Ȩҳ�棬ֱ����ת��ֻ�ܻ�ȡ�û�openid����snsapi_userinfo ��������Ȩҳ�棬��ͨ��openid�õ��ǳơ��Ա����ڵء����ң���ʹ��δ��ע������£�ֻҪ�û���Ȩ��Ҳ�ܻ�ȡ����Ϣ��
         *response_type  �������ͣ�����дcode
         *state �ض��������state�����������߿�����дa-zA-Z0-9�Ĳ���ֵ�����128�ֽ�
         *#wechat_redirect ����ֱ�Ӵ򿪻�����ҳ��302�ض���ʱ�򣬱�����˲���
         */
        public function getCode($appid,$scope){
            //$response_type = 'code';
            //$scope = 'snsapi_userinfo';
            //$redirect_uri = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/makerway/Home/Weixin/OAuth/getAccessToken.html';;
            $redirect_uri = 'https://'.$_SERVER['HTTP_HOST'].'/makerway/Home/Weixin/OAuth/index.html';;
            $state = 'oauth';   //�ض��������state�����������߿�����дa-zA-Z0-9�Ĳ���ֵ�����128�ֽ�
            //��ȡcode
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
            //�ض���
            redirect($url, 0,'');
        }
        //�ڶ�����ͨ��code��ȡ��ҳ��Ȩaccess_token
        public function getAccessToken($appid,$appsecret,$code){
            //$code = $_GET['code'];
            //$grant_type = 'authorization_code';
            $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
            $res = api_request($request_url);
            return $res;
        }
        //��������ˢ��access_token�������Ҫ��
        public function refreshAccessToken(){

        }
        //���Ĳ�����ȡ�û���Ϣ(��scopeΪ snsapi_userinfo)
        public function getUserInfo($access_token,$openid){
            $request_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
            $res = api_request($request_url);
            return $res;
        }

    }