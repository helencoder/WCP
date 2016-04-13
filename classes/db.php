<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 20:14
 * description: ���ݿ������
 */
class Database{
    private $_host;
    private $_user;
    private $_password;
    private $_database;
    private $_port;
    private $_socket;
    private $_dbObj;
    private $_table;
    private $_tableObj;
    protected $options = array();

    /*
     * ���ʼ��
     *
     * */
    function __construct($host,$user,$passowrd,$database,$port=3306){
        if(!isset($host)||!isset($user)||!isset($passowrd)||!isset($database)){
            return false;
        }else{
            $this->_host     = $host;
            $this->_user     = $user;
            $this->_password = $passowrd;
            $this->_database = $database;
            $this->_port     = $port;
            $_dbObj = new mysqli($host,$user,$passowrd,$database,$port);
            $this->_dbObj = $_dbObj;
            return $_dbObj;
        }
    }
    /*
     * ��������Ŀ��Ʒ���(ʵ��ԭ��return $this �����౾��)
     * */
    public function __call($func, $args){
        if(in_array($func, array('form', 'field', 'join', 'order', 'where', 'limit', '����....')))
        {
            $this->options[$func] = $args;
            return $this; //���ﷵ���˱�����
        }
    }
    /*
     * ѡ�����ݿ�
     * */
    function select_db($database){
        $this->_database = $database;
        $dbConnect = mysqli_select_db($this->_dbObj,$this->_database);
        if($dbConnect){
            $_dbObj = new mysqli($this->_host,$this->_user,$this->_password,$this->_database,$this->_port);
            $this->_dbObj = $_dbObj;
            return $_dbObj;
        }else{
            return false;
        }
    }
    /*
     * ���ݿ��û�����
     * */
    function change_user($user,$password){
        $changeUser = mysqli_change_user($this->_dbObj,$user,$password,$this->_database);
        if($changeUser){
            $this->_user = $user;
            $this->_password = $password;
            $_dbObj = new mysqli($this->_host,$this->_user,$this->_password,$this->_database,$this->_port);
            $this->_dbObj = $_dbObj;
            return $_dbObj;
        }else{
            return false;
        }
    }
    /*
     * ��ѯ���ݿ��еı�
     * */
    function tables(){
        $sql = 'show tables';
        $search_res = mysqli_query($this->_dbObj,$sql);
        if($search_res){
            $num_rows = $search_res->num_rows;
            $tables_msg = array(
                'count'=>$num_rows,
                'tables'=>array()
            );
            for($i=0;$i<$num_rows;$i++){
                $row = $search_res->fetch_assoc();
                $key = 'Tables_in_'.$this->_database;
                array_push($tables_msg['tables'],$row[$key]);
            }
            mysqli_free_result($search_res);
            return $tables_msg;
        }else{
            mysqli_free_result($search_res);
            return false;
        }
    }
    /*
     * ��ȡָ������Ϣ(���ر�����Ϣ)
     * */
    function select_table($table){
        $sql = 'select * from '.$table;
        $search_res = mysqli_query($this->_dbObj,$sql);
        if($search_res){
            $this->_table = $table;
            $table_msg = array();
            for($i=0;$i<$search_res->num_rows;$i++){
                $row = $search_res->fetch_assoc();
                array_push($table_msg,$row);
            }
            $this->_tableObj = $table_msg;
            mysqli_free_result($search_res);
            return $table_msg;
        }else{
            mysqli_free_result($search_res);
            return false;
        }
    }
    /*
     * ��ȡָ������ֶ���Ϣ
     * */
    function select_table_fields($table){
        $sql = 'show fields from '.$table;
        $search_res = mysqli_query($this->_dbObj,$sql);
        if($search_res){
            $this->_table = $table;
            $fields_msg = array();
            for($i=0;$i<$search_res->num_rows;$i++){
                $row = $search_res->fetch_assoc();
                array_push($fields_msg,$row);
            }
            mysqli_free_result($search_res);
            return $fields_msg;
        }else{
            mysqli_free_result($search_res);
            return false;
        }
    }
    /*
     * ��ȡ����ָ���ֶ���Ϣ
     * */
    function getField($data,$type='desc'){

    }
    /*
     * ָ����ѯ������ѯ������Ϣ
     * */
    function where($array,$type='desc'){

    }
    /*
     * ָ��������Ŀ����ѯ������Ϣ
     * */
    function limit($count,$type='desc'){

    }
    /*
     * ָ�����ؽ���������ѯ������Ϣ
     * */
    function order($field,$type='desc'){

    }
    /*
     * Ϊ�����������Ϣ
     * */
    function add($data){

    }
    /*
     * ���±�����Ϣ
     * */
    function save($data){

    }
    /*
     * �趨����ָ���ֶ���Ϣ
     * */
    function setField($data){

    }
    /*
     * ɾ�����е���Ϣ(��Ϊ�գ�����ձ�)
     * */
    function delete($data=null){

    }
    /*
     * ��ѯSQL������ѯ
     * */
    function query($sql){
        $search_res = mysqli_query($this->_dbObj,$sql);
        return $search_res;
    }
    /*
     * �ر�����
     * */
    function close(){
        $close = mysqli_close($this->_dbObj);
        if($close){
            return true;
        }else{
            return false;
        }
    }
    function __destruct(){
        mysqli_close($this->_dbObj);
    }


}