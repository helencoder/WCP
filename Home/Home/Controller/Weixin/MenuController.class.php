<?php
/**
 * Author: helen
 * CreateTime: 2016/2/26 10:35
 * description:微信公众账号自定义菜单设置函数
 */
    namespace Home\Controller\Weixin;
    use Think\Controller;
    class MenuController extends Controller{
        /*菜单信息设置*/
        public function menuData(){

            $data = array(
                'button' => array(
                    0 => array(
                        'name' => '图书漂流',
                        'sub_button'    => array(
                            0 => array(
                                'type' => 'scancode_waitmsg',
                                'name' => '我要分享',
                                'key'  => 'share'
                            ),
                            1 => array(
                                'type' => 'scancode_waitmsg',
                                'name' => '我要借阅',
                                'key'  => 'borrow'
                            ),
                            2 => array(
                                'type' => 'scancode_waitmsg',
                                'name' => '我要还书',
                                'key'  => 'return'
                            )
                        )
                    ),
                    1 => array(
                        'name' => '智慧分享',
                        'type' => 'click',
                        'key'  => 'chat'
                        /*'sub_button'    => array(
                            0 => array(
                                'type' => 'view',
                                'name' => '大数据',
                                'url'  => 'http://www.thebigdata.cn/'
                            )
                        )*/
                    ),
                    2 => array(
                        'name' => '技术交流',
                        'type' => 'view',
                        'url'  => 'http://www.makerway.space/makerway/'
                        /*'sub_button'    => array(
                            0 => array(
                                'type' => 'scancode_waitmsg',
                                'name' => '我要分享',
                                'key'  => 'share'
                            ),
                            1 => array(
                                'type' => 'scancode_waitmsg',
                                'name' => '我要借阅',
                                'key'  => 'borrow'
                            ),
                            2 => array(
                                'type' => 'scancode_waitmsg',
                                'name' => '我要还书',
                                'key'  => 'return'
                            ),
                            3 => array(
                                'type' => 'click',
                                'name' => '我要讨论',
                                'key'  => 'chat'
                            ),
                            4 => array(
                                'type' => 'view',
                                'name' => '我要参观',
                                'url'  => 'http://www.makerway.space/makerway/'
                            ),
                        )*/
                    ),
                )
            );

            dump($data);
            $data = json_encode($data,JSON_UNESCAPED_UNICODE);
            dump($data);
            $access_token = $this->getToken();

            $res = $this->MenuAPI('create',$access_token,$data);
            dump(errorMsg($res->errcode));

        }

        /*创建自定义菜单*/
        public function createMenu(){
            
        }
        /*删除自定义菜单*/
        public function deleteMenu(){

        }

        /*微信自定义菜单接口调用类型*/
        function MenuAPI($type,$access_token,$data=null){
            //判断对自定义菜单操作的类型
            switch($type){
                case 'create':
                    $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
                    break;
                case 'delete':
                    $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$access_token;
                    break;
                case 'get':
                    $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$access_token;
                    break;
            }
            $res = api_request($url,$data);
            return $res;
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