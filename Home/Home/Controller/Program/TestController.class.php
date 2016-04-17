<?php
/**
 * Author: helen
 * CreateTime: 2016/3/21 9:16
 * description:
 */
    namespace Home\Controller\Program;
    use Home\Controller\CommonController;
    use Think\Model;

    class TestController extends CommonController{
        public function test(){
            include '/classes/sort.php';
            //$arr = array(1,5,4,2,9,7,8,6);
            //$arr = array_reverse($arr);
            //$arr = array(5,3,4,6,2);
            $arr2 = array(1, 5, 4, 2, 9, 7, 8, 6, 16, 13, 14, 17);
            //$arr2 = array_reverse($arr2);
            $arr = new \SORT($arr2);
            echo '<h2>冒泡排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $bubble_sort_asc = $arr->BubbleSort('asc');
            dump($bubble_sort_asc);
            echo '<h4>降序：</h4>';
            $bubble_sort_desc = $arr->BubbleSort('desc');
            dump($bubble_sort_desc);
            echo '<h2>选择排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $select_sort_asc = $arr->SelectSort('asc');
            dump($select_sort_asc);
            echo '<h4>降序：</h4>';
            $select_sort_desc = $arr->SelectSort('desc');
            dump($select_sort_desc);
            echo '<h2>插入排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $insert_sort_asc = $arr->InsertSort('asc');
            dump($insert_sort_asc);
            echo '<h4>降序：</h4>';
            $insert_sort_desc = $arr->InsertSort('desc');
            dump($insert_sort_desc);
            echo '<h2>希尔排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $shell_sort_asc = $arr->ShellSort('asc');
            dump($shell_sort_asc);
            echo '<h4>降序：</h4>';
            $shell_sort_desc = $arr->ShellSort('desc');
            dump($shell_sort_desc);
            echo '<h2>堆排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $heap_sort_asc = $arr->HeapSort('asc');
            dump($heap_sort_asc);
            echo '<h4>降序：</h4>';
            $heap_sort_desc = $arr->HeapSort('desc');
            dump($heap_sort_desc);
            echo '<h2>归并排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $merge_sort_asc = $arr->MergeSort('asc');
            dump($merge_sort_asc);
            echo '<h4>降序：</h4>';
            $merge_sort_desc = $arr->MergeSort('desc');
            dump($merge_sort_desc);
            echo '<h2>快速排序结果：</h2>';
            echo '<h4>升序：</h4>';
            $quick_sort_asc = $arr->QuickSort('asc');
            dump($quick_sort_asc);
            echo '<h4>降序：</h4>';
            $quick_sort_desc = $arr->QuickSort('desc');
            dump($quick_sort_desc);
            die;
            //当前页面地址
            $local_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            //首先获取其中的scope参数
            $scope = $_GET['scope'];
            $needle = 'scope=' . $scope;
            //对当前页面地址进行处理
            $url_query = parse_url($local_url);
            $res = str_replace($needle, '', $url_query['query']);
            //然后替换其中的url=字符串
            $res = str_replace('url=', '', $res);
            if (substr(strtolower($res), 0, 1) == '&') {
                $url = substr($res, 1);
            } else {
                $url = $res;
            }
            dump($url);
            die;
            dump($query['query']);
            $res = strstr($query['query'], 'url');
            $res1 = str_replace('url=', '', $res);
            dump($res);
            dump($res1);

            die;
            $scope =
            $res = parse_url($url);
            dump($res);
            $res2 = strpos('url', $res['query']);
            dump($res2);
            dump(parse_url($url));
            dump($_GET['url']);
            dump($_GET['type']);
            dump(parse_url($res['query']));


            die;
            phpinfo();
            die;
            $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $data = parse_url($url);
            $url = $_GET['url'];
            $type = $_GET['type'];
            $map['url'] = $url;
            $map['type'] = $type;
            dump(getUrlQuery($map));

            $test = 'www.baidu.com123';
            dump(strpos($test, '?'));

            dump($url);
            dump($type);
            dump($data);
            $query = convertUrlQuery($data['query']);
            dump($query);
            die;


            include '/classes/db.php';
            $db = new \Database('localhost', 'root', '901230', 'weixin');
            //$db = new \mysqli('localhost','root','901230','weixin');
            //$db->select_db('visitor');
            //dump($db->error());
            //$db->change_user('helen','901230');
            $table = 'zyd_fuweng_user';
            //dump($db->select_table_fields($table));
            //dump($db->error());
            $db->select_table($table);
            $param1 = '123';
            $param2 = 'id>1,record>100';
            $param3 = array(
                /*array('count'=>1,'openid'=>'123','record'=>'100'),
                array('count'=>2,'openid'=>'234','record'=>'200'),*/
                array('count' => 4, 'openid' => '456', 'record' => '500')
            );
            $param4 = array('count' => 4, 'openid' => '456', 'record' => '500');
            //dump($db->where('id=4')->save($param4));
            dump($db->where('count=4')->delete());

            die;
            dump($db->data($param3)->add());
            dump(array_keys($param3));
            dump(array_values($param3));
            dump(implode(',', array_values($param3)));
            dump(implode(',', array_keys($param3)));

            dump($db->where($param2)->order('id')->limit(2)->find());
            dump($db->options_handle($param1));
            dump($db->options_handle($param2));
            dump($db->options_handle($param3));
            $array = array('id', 'count');

            $num = '123';
            if (is_string($num)) {
                echo 'true';
            }

            dump($db->getField($array));
            dump($db->select_table_fields($table));
            /*$array = array('a','b');
            $array1 = array();
            dump($db->getField('a,b'));
            dump($db->getField($array));
            dump($db->getField($array1));
            dump($db->getField(''));*/
            /*$str = '';
            if(empty($str)){
                echo 'true';
            }*/
            /*$model = M('zyd_fuweng_user');
            $res = $model->getField('create_time,count');
            dump($res);*/
            die;
            //
            $table = 'zyd_fuweng_user';
            //选择指定的数据库，并返回其中全部信息
            $table_msg = $db->select_table($table);
            //选择指定数据库，返回数据库的字段信息
            $table_field_msg = $db->select_table_fields($table);
            //条件搜索，传入条件均为数据
            $where = array(
                'id' => 1
            );
            $data = array(
                'headimgurl' => 'helen.jpg'
            );
            dump($db->where($where)->field('field'));
            dump($table);
            $test = new
            M();


            /*$dbObj = new \mysqli('localhost','helen','901230','weixin','3306');
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
            dump($res);*/


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



