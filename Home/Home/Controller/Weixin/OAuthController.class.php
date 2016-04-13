<?php
/**
 * Author: helen
 * CreateTime: 2016/2/27 9:39
 * description: 微信网页授权类
 */
    namespace Home\Controller\Weixin;
    use Think\Controller;
    class OAuthController extends Controller{
        /*
         * 网页授权流程
         * 1 第一步：用户同意授权，获取code
         * 2 第二步：通过code换取网页授权access_token
         * 3 第三步：刷新access_token（如果需要）
         * 4 第四步：拉取用户信息(需scope为 snsapi_userinfo)
         * 5 附：检验授权凭证（access_token）是否有效
         * */
        //初始化方法
        public function __construct(){
            /*$appid = 'wxa4b61eaf7ba3d596';
            $scope = 'snsapi_userinfo';
            $this->getCode($appid,$scope);*/
        }
        //授权流程方法
        public function index(){
            $appid = 'wxa4b61eaf7ba3d596';
            $appsecret = '929ef373218ccbca5c6bf73f4becac73';
            $code = $_GET['code'];
            $access_token_res = $this->getAccessToken($appid,$appsecret,$code);
            $access_token = $access_token_res->access_token;
            $openid = $access_token_res->openid;
            //获取用户信息
            $userinfo_res = $this->getUserInfo($access_token,$openid);
            echo '<h1>欢迎您，'.$userinfo_res->nickname.'</h1>';
        }
        //第一步：用户同意授权，获取code
        /*注意：跳转回调redirect_uri，应当使用https链接来确保授权code的安全性。
         *appid 公众号的唯一标识
         *redirect_uri  授权后重定向的回调链接地址，请使用urlencode对链接进行处理
         *scope 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且，即使在未关注的情况下，只要用户授权，也能获取其信息）
         *response_type  返回类型，请填写code
         *state 重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节
         *#wechat_redirect 无论直接打开还是做页面302重定向时候，必须带此参数
         */
        public function getCode($appid,$scope){
            //$response_type = 'code';
            //$scope = 'snsapi_userinfo';
            //$redirect_uri = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/makerway/Home/Weixin/OAuth/getAccessToken.html';;
            $redirect_uri = 'https://'.$_SERVER['HTTP_HOST'].'/makerway/Home/Weixin/OAuth/index.html';;
            $state = 'oauth';   //重定向后会带上state参数，开发者可以填写a-zA-Z0-9的参数值，最多128字节
            //获取code
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
            //重定向
            redirect($url, 0,'');
        }
        //第二步：通过code换取网页授权access_token
        public function getAccessToken($appid,$appsecret,$code){
            //$code = $_GET['code'];
            //$grant_type = 'authorization_code';
            $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
            $res = api_request($request_url);
            return $res;
        }
        //第三步：刷新access_token（如果需要）
        public function refreshAccessToken(){

        }
        //第四步：拉取用户信息(需scope为 snsapi_userinfo)
        public function getUserInfo($access_token,$openid){
            $request_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
            $res = api_request($request_url);
            return $res;
        }

    }