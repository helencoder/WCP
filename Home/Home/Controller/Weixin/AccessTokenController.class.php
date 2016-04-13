<?php
/**
 * Author: helen
 * CreateTime: 2016/2/26 11:33
 * description: ΢��access_token������
 */
    namespace Home\Controller\Weixin;
    use Think\Controller;
    class AccessTokenController extends Controller{
        /*΢�Ż�����Ϣ����*/
        public function confData(){
            /*�״θ������ݿ�*/
            $weixin_conf_data = M('weixin_conf_data');
            $data['token'] = 'weixin';
            $data['appid'] = 'wxa4b61eaf7ba3d596';
            $data['appsecret'] = '929ef373218ccbca5c6bf73f4becac73';

            $result = $this->getAccessToken($data['appid'],$data['appsecret']);

            $data['access_token'] = $result->access_token;
            $data['time'] = time();
            //����
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

        /*��ȡaccess_token*/
        public function getToken(){
            $weixin_conf_data = M('weixin_conf_data');
            $conf = $weixin_conf_data->where('id=1')->find();
            $token_time = $conf['time'];
            $now_time = time();
            $tip = $now_time - $token_time;
            if ($tip < 7000) {  //ֱ�����
                //�ж�token�Ƿ���Ч
                $access_token = $conf['access_token'];
                $url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token=' . $access_token;
                $res = api_request($url);
                if (empty($access_token) || $res->errcode == 40001) {
                    //���»�ȡ
                    $AppID = $conf['appid'];
                    $AppSecret = $conf['appsecret'];
                    $res = $this->getAccessToken($AppID, $AppSecret);
                    $access_token = $res->access_token;
                    $new_data['access_token'] = $access_token;
                    $new_data['time'] = $now_time;
                    $res = $weixin_conf_data->where('id=1')->save($new_data);
                }
            } else {  //���»�ȡ
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

        /*��ȡaccess_token*/
        function getAccessToken($appid, $appsecret){
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
            $result = api_request($url);
            return $result;
        }

    }