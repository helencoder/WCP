<?php
/**
 * Author: helen
 * CreateTime: 2016/2/26 11:33
 * description: 微信access_token配置项
 */
    namespace Home\Controller\Weixin;
    use Think\Controller;
    class AccessTokenController extends Controller{
        /*微信基本信息配置*/
        public function confData(){
            /*首次更新数据库*/
            $weixin_conf_data = M('weixin_conf_data');
            $data['token'] = 'weixin';
            $data['appid'] = 'wxa4b61eaf7ba3d596';
            $data['appsecret'] = '929ef373218ccbca5c6bf73f4becac73';

            $result = $this->getAccessToken($data['appid'],$data['appsecret']);

            $data['access_token'] = $result->access_token;
            $data['time'] = time();
            //保存
            $conf = $weixin_conf_data->where('id=1')->find();
            if(!empty($conf)){
                $res = $weixin_conf_data->where('id=1')->save($data);
            }else{
                $res = $weixin_conf_data->data($data)->add();
            }
            if($res){
                echo 'success';
            }
        }

        /*获取access_token*/
        public function getToken(){
            $weixin_conf_data = M('weixin_conf_data');
            $conf = $weixin_conf_data->where('id=1')->find();
            $token_time = $conf['time'];
            $now_time = time();
            $tip = $now_time - $token_time;
            if ($tip < 7000) {  //直接输出
                //判断token是否有效
                $access_token = $conf['access_token'];
                $url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token=' . $access_token;
                $res = api_request($url);
                if (empty($access_token) || $res->errcode == 40001) {
                    //重新获取
                    $AppID = $conf['appid'];
                    $AppSecret = $conf['appsecret'];
                    $res = $this->getAccessToken($AppID, $AppSecret);
                    $access_token = $res->access_token;
                    $new_data['access_token'] = $access_token;
                    $new_data['time'] = $now_time;
                    $res = $weixin_conf_data->where('id=1')->save($new_data);
                }
            } else {  //重新获取
                $AppID = $conf['appid'];
                $AppSecret = $conf['appsecret'];
                $res = $this->getAccessToken($AppID, $AppSecret);
                $access_token = $res->access_token;
                $new_data['access_token'] = $access_token;
                $new_data['time'] = $now_time;
                $res = $weixin_conf_data->where('id=1')->save($new_data);
            }
            return $access_token;
        }

        /*获取access_token*/
        function getAccessToken($appid, $appsecret){
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
            $result = api_request($url);
            return $result;
        }

    }