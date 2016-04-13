<?php
/**
 * Author: helen
 * CreateTime: 2016/3/10 10:55
 * description: ╟ы╤х╣ьм╪API
 */
    namespace Home\Controller\Program;
    use Think\Controller;
    class IpController extends Controller{
        public function test(){
            $ak = '9CzTKA44kk991pulforuGD4B';
            $ip = get_client_ip();
            $request_url = 'http://api.map.baidu.com/location/ip?ak='.$ak.'&ip='.$ip.'&coor=bd09ll';
            $res = api_request($request_url);
            dump($res);
        }
    }