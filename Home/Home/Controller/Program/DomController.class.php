<?php
/**
 * Author: helen
 * CreateTime: 2016/3/8 10:59
 * description:
 */
    namespace Home\Controller\Program;
    use Think\Controller;
    class DomController extends Controller{
        public function test(){
            /*header('Content-type:text/html;charset=UTF-8');
            ini_set('include_path','D:/wamp/www');
            require __ROOT__.'/Ext/phpQuery.php';*/
            //phpinfo();
            $db = new \mysqli('localhost','helen','901230','weixin','3306');
            $db = mysqli_connect('localhost','helen','901230','weixin','3306');
            $db->select_db('wx_hot');
            $query = 'select * from wx_hot';
            $result = $db->query($query);
            dump($result);
            $num_results = $result->fetch_row();
            dump($num_results);
        }
        public function testPdf(){
            header('Content-type:text/html;charset=UTF-8');
            ini_set('include_path','D:/wamp/www');
            require __ROOT__.'/Ext/tcpdf/examples/lang/eng.php';
            require __ROOT__.'/Ext/tcpdf/tcpdf.php';
            //�����µ�pdf����
            $pdf = new \TCPDF();
            //����һҳ
            $pdf->AddPage();
            //��������
            $txt = 'Pro PHP Programming';
            //��ӡ���ֿ�
            $pdf->Write(20,$txt);
            //����ΪPDF
            $pdf->Output('minimal.pdf','I');
        }
        public function testPredis(){
            /*header('Content-type:text/html;charset=UTF-8');*/
            ini_set('include_path','D:/wamp/www');
            require __ROOT__.'/Ext/Predis/autoload.php';
            $redis = new \Predis\Client(array(
                'scheme' => 'tcp',
                'host'   => '127.0.0.1',
                'port'   => '6379',
            ));

            echo $redis->get('foo');
        }
        public function testBootstrap(){

            $this->display();
        }
        public function show(){
            /*css����*/
            $this->display();
        }
        public function show2(){
            /*css���*/
            $this->display();
        }

    }