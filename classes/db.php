<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 20:14
 * description: 数据库操作类
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
     * 类初始化
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
     * 连贯操作的控制方法(实现原则return $this 返回类本身)
     * */
    public function __call($func, $args){
        if(in_array($func, array('form', 'field', 'join', 'order', 'where', 'limit', '更多....')))
        {
            $this->options[$func] = $args;
            return $this; //这里返回了本对象
        }
    }
    /*
     * 选择数据库
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
     * 数据库用户更换
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
     * 查询数据库中的表
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
     * 获取指定表信息(返回表中信息)
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
     * 获取指定表的字段信息
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
     * 获取表中指定字段信息
     * */
    function getField($data,$type='desc'){

    }
    /*
     * 指定查询条件查询表中信息
     * */
    function where($array,$type='desc'){

    }
    /*
     * 指定返回条目数查询表中信息
     * */
    function limit($count,$type='desc'){

    }
    /*
     * 指定返回结果的排序查询表中信息
     * */
    function order($field,$type='desc'){

    }
    /*
     * 为表中添加新信息
     * */
    function add($data){

    }
    /*
     * 更新表中信息
     * */
    function save($data){

    }
    /*
     * 设定表中指定字段信息
     * */
    function setField($data){

    }
    /*
     * 删除表中的信息(若为空，则清空表)
     * */
    function delete($data=null){

    }
    /*
     * 查询SQL的语句查询
     * */
    function query($sql){
        $search_res = mysqli_query($this->_dbObj,$sql);
        return $search_res;
    }
    /*
     * 关闭连接
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