<?php
/**
 * Author: helen
 * CreateTime: 2016/3/21 9:16
 * description:
 */
    namespace Home\Controller\Program;
    use Home\Controller\CommonController;
    class TestController extends CommonController{
        public function test(){
            /*$a = '10';
            var_dump(gettype($a));
            settype($a,'int');
            var_dump(gettype($a));*/
            /*register_tick_function('doTicks');
            declare(ticks = 1){
                for($i=1;$i<3;$i++){
                    echo '郑海伦';
                }
            }*/
            /*$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
            dump($DOCUMENT_ROOT);*/
            //echo __ROOT__;
            # echo $HTTP_SERVER_VARS['DOCUMENT_ROOT'];
            /*$fp = fopen(__ROOT__.'/Public/Images/test.txt','rw');
            $word = fgets($fp,999);
            echo $word;*/
            /*$redis = new Redis();*/
            //$str = "";
            //dump(empty($str));
            /*\Think\Build::buildController('Admin','Role');
            \Think\Build::buildController('Admin','weixin');*/
            /*$fuwengUserTable = M('zyd_fuweng_user');
            $map['count'] = 1;
            $res = $fuwengUserTable->where($map)->order('id')->find();
            dump($res);*/

            

            $dbObj = new \mysqli('localhost','helen','901230','weixin','3306');
            //$query = 'select * from zyd_fuweng_user';
            $query = 'show fields from zyd_fuweng_user';
            $tables = mysqli_query($dbObj,$query);
            //dump($tables);
            $count = $tables->num_rows;
            $arr = array();
            for($i=0;$i<$count;$i++){
                $row = $tables->fetch_assoc();
                //dump($row);
                array_push($arr,$row);
            }
            mysqli_free_result($tables);
            dump($arr);
            die;
            $query1 = 'select * from zyd_fuweng_user';
            $table_msg = mysqli_query($dbObj,$query1);
            //输出查询结果
            $num = $table_msg->num_rows;
            for($i=0;$i<$num;$i++){
                $row = $table_msg->fetch_assoc();
                dump($row);
            }
            dump($dbObj);
            dump($tables);
            dump($table_msg);
            $res = mysqli_close($dbObj);
            dump($res);


        }
        function doTicks(){
            echo 'Ticks';
        }

        public function testGet(){
            $data['msg'] = 'hello';
            $data = json_encode($data);
            dump(gettype($data));
        }

        public function testSQL(){
            //$db = new \mysqli('101.201.140.109','root','meeZao','master_meezao');     //蜜枣
            //$db = new \mysqli('43.242.131.173','helen','helen901230','improvcn_helen');   //improvcn
            $db = new \mysqli('115.29.51.11','root','35cdb02f64','test');   //makerway
            //$db = new \mysqli('localhost','root','901230','student_helen_php');
            dump(mysqli_connect_errno());
            if(mysqli_connect_errno()){
                var_dump('连接错误');
                exit;
            }else{
                //mysqli_select_db($db,'zyd_sssmall_conf_weixin');
                //$query = "select * from zyd_sssmall_conf_weixin";
                mysqli_select_db($db,'pw_weixin_conf_data');
                $query = "select * from pw_weixin_conf_data";
                //$result = $db->query($query);
                $result = mysqli_query($db,$query);
                //$num_results = $result->num_rows;
                $num_results = mysqli_num_rows($result);
                for($i=0;$i<$num_results;$i++){
                    $row = mysqli_fetch_assoc($result);
                    //$row = mysqli_fetch_row($result);     //数组
                    //$row = mysqli_fetch_object($result);  //对象
                    dump($row);
                }
                //dump($result);
            }
        }


    }