<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 20:14
 * description: ���ݿ������(���Խ�MySQL���ݿ�,��Ҫ����MySQLi����)
 */
class Database{

    //MySQL������ַ
    private $_host;
    //MySQL�û���
    private $_user;
    //MySQL�û�����
    private $_password;
    //ָ�����ݿ�����
    private $_database;
    //MySQL���ݿ�˿ں�
    private $_port;
    private $_socket;
    //��ǰ���ݿ����
    private $_dbObj;
    //���ݿ��
    private $_table;
    //���ݿ�����
    private $_tableObj;
    // ���������Ϣ
    protected $error            =   '';
    // �ֶ���Ϣ
    protected $fields           =   array();
    // ������Ϣ
    protected $data             =   array();
    // ��ѯ���ʽ����
    protected $options          =   array();
    protected $_validate        =   array();  // �Զ���֤����
    protected $_auto            =   array();  // �Զ���ɶ���
    protected $_map             =   array();  // �ֶ�ӳ�䶨��
    protected $_scope           =   array();  // ������Χ����
    // �����������б�
    protected $methods          =   array('strict','order','alias','having','group','lock','distinct','auto','filter','validate','result','token','index','force');

    /**
     * Database���ʼ������
     * ȡ��DB���ʵ������ �ֶμ��
     * @access public
     * @param string $host MySQL���ݿ�������
     * @param string $user MySQL���ݿ��û���
     * @param string $password MySQL���ݿ�����
     * @param string $database ָ�����������ݿ�
     * @return mixed  ���ݿ�������Ϣ��������Ϣ
     */
    public function __construct($host,$user,$passowrd,$database,$port=3306){
        $this->_initialize();
        if(!isset($host)||!isset($user)||!isset($passowrd)||!isset($database)){
            return false;
        }else{
            $this->_host     = $host;
            $this->_user     = $user;
            $this->_password = $passowrd;
            $this->_database = $database;
            $this->_port     = $port;
            $_dbObj = new mysqli($host,$user,$passowrd,$database,$port);
            if($_dbObj->connect_errno){
                $this->error = $_dbObj->connect_error;
                return false;
            }else{
                $this->_dbObj = $_dbObj;
                return $this;
            }
        }
    }
    /**
     * ������Ϣ����
     * �������ݿ�������������һ��ִ��ʱ�Ĵ�����Ϣ
     * @access public
     * @return mixed  ���ݿ����Ӵ�����Ϣ(��������'')
     */
    public function error(){
        return $this->error;
    }
    // �ص����� ��ʼ��ģ��
    protected function _initialize() {}
    /**
     * �������ݶ����ֵ
     * @access public
     * @param string $name ����
     * @param mixed $value ֵ
     * @return void
     */
    public function __set($name,$value) {
        // �������ݶ�������
        $this->data[$name] = $value;
    }

    /**
     * ��ȡ���ݶ����ֵ
     * @access public
     * @param string $name ����
     * @return mixed
     */
    public function __get($name) {
        return isset($this->data[$name])?$this->data[$name]:null;
    }

    /**
     * ������ݶ����ֵ
     * @access public
     * @param string $name ����
     * @return boolean
     */
    public function __isset($name) {
        return isset($this->data[$name]);
    }

    /**
     * �������ݶ����ֵ
     * @access public
     * @param string $name ����
     * @return void
     */
    public function __unset($name) {
        unset($this->data[$name]);
    }
    /**
     * ����__call����ʵ��һЩ����ķ���(���ڵ������в����ڷ����Ľ������)
     * @access public
     * @param string $method ��������
     * @param array $args ���ò���
     * @return mixed
     */
    public function __call($method,$args) {
        if(in_array(strtolower($method),$this->methods,true)) {
            // ���������ʵ��
            $this->options[strtolower($method)] =   $args[0];
            return $this;
        }elseif(in_array(strtolower($method),array('count','sum','min','max','avg'),true)){
            // ͳ�Ʋ�ѯ��ʵ��
            $field =  isset($args[0])?$args[0]:'*';
            return ;
        }elseif(strtolower(substr($method,0,5))=='getby') {
            // ����ĳ���ֶλ�ȡ��¼
            $field   =   parse_name(substr($method,5));
            $where[$field] =  $args[0];
            return ;
        }elseif(strtolower(substr($method,0,10))=='getfieldby') {
            // ����ĳ���ֶλ�ȡ��¼��ĳ��ֵ
            $name   =   parse_name(substr($method,10));
            $where[$name] =$args[0];
            return ;
        }elseif(isset($this->_scope[$method])){// ������Χ�ĵ�������֧��
            return ;
        }else{

        }
    }

    /*
     * ѡ�����ݿ�
     * @access public
     * @param string $database ѡ������ݿ�����
     * @return mixed ���ݿ�������Ϣ
     * */
    public function select_db($database){
        $select_db = mysqli_select_db($this->_dbObj,$database);
        if($select_db){
            $this->_database = $database;
            $_dbObj = new mysqli($this->_host,$this->_user,$this->_password,$database,$this->_port);
            $this->_dbObj = $_dbObj;
            return $this;
        }else{
            $this->error = mysqli_error($this->_dbObj);
            return false;
        }
    }
    /*
     * ���ݿ��û�����
     * @access public
     * @param string $user ���ݿ��û�����
     * @param string $password ���ݿ��û�����
     * @return mixed ���ݿ�������Ϣ
     * */
    public function change_user($user,$password){
        $change_user = mysqli_change_user($this->_dbObj,$user,$password,$this->_database);
        if($change_user){
            $this->_user = $user;
            $this->_password = $password;
            $_dbObj = new mysqli($this->_host,$this->_user,$this->_password,$this->_database,$this->_port);
            $this->_dbObj = $_dbObj;
            return $this;
        }else{
            $this->error = mysqli_error($this->_dbObj);
            return false;
        }
    }
    /*
     * ��ѯ���ݿ������еı���
     * @access public
     * @return array ���ݱ�������ͱ���
     * */
    public function tables(){
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
     * ��ȡָ������������Ϣ
     * @access public
     * @param string $table ���ݱ�����
     * @return array ���ݱ����ϸ��Ϣ
     * */
    public function select_table($table){
        $sql = 'select * from '.$table;
        $search_res = mysqli_query($this->_dbObj,$sql);
        if($search_res){
            $this->_table = $table;
            $table_msg = self::query_handle($search_res);
            $this->_tableObj = $table_msg;
            mysqli_free_result($search_res);
            return $table_msg;
        }else{
            mysqli_free_result($search_res);
            return false;
        }
    }
    /*
     * ��ȡָ������ֶ���ϸ��Ϣ
     * @access public
     * @param string $table ���ݱ�����
     * @return array ���ݱ���ֶ���ϸ��Ϣ
     * */
    public function select_table_fields($table){
        $sql = 'show fields from '.$table;
        $search_res = mysqli_query($this->_dbObj,$sql);
        if($search_res){
            $this->_table = $table;
            $fields_msg = self::query_handle($search_res);
            mysqli_free_result($search_res);
            return $fields_msg;
        }else{
            mysqli_free_result($search_res);
            return false;
        }
    }
    /*
     * ��ȡ���ݱ���ָ���ֶ���Ϣ��������ֶ�ͬʱ��ѯ��
     * @access public
     * @param mixed $field ָ���ֶΣ��ַ�������ʹ�ã������
     * @return array ���ݱ���ָ���ֶ���Ϣ
     * */
    public function getField($field){
        $fields = self::param_handle($field);
        $count = count($fields);
        for($i=0;$i<$count;$i++){
            $index = $fields[$i];
            $sql = 'select '.$index.' from '.$this->_table;
            $res = mysqli_query($this->_dbObj,$sql);
            $field_msg[$index] = self::query_handle($res);
        }
        return $field_msg;
    }
    /*
     * mysqli_query�������������
     * @access protected
     * @param object $obj mysqli_query�������
     * @return array ���ݱ���ָ���ֶ���Ϣ
     * */
    protected function query_handle($obj){
        $res = array();
        for($i=0;$i<$obj->num_rows;$i++){
            $row = $obj->fetch_assoc();
            array_push($res,$row);
        }
        return $res;
    }
    /*
     * �������������
     * @access protected
     * @param mixed $param �������
     * @return array �������������
     * */
    public function param_handle($param){
        if(is_string($param)&&!empty($param)){
            $params = explode(',',$param);
        }elseif(is_array($param)&&!empty($param)){
            $params = $param;
        }else{
            return false;
        }
        return $params;
    }
    /*
     * ��ѯ���ʽ$options������
     * @access protected
     * @return string ���ݱ��ѯsql
     * */
    protected function options_handle(){
        $options = $this->options;

    }
    /*
     * ��ѯ��Ϣ(����operation�и����Ĳ�ѯ����)
     * */
    public function find(){
        $_options = $this->_options;
    }
    /*
     * ��ѯ���ʽ where������
     * @access public
     * @param mixed $where where��ѯ����
     * @return object $this
     * */
    public function where($where){
        $this->options['where'] = $where;
        return $this;
    }
    /*
     * ��ѯָ�����ֶ�
     * */
    function field($field){
        $this->options['field'] = $field;
        return $this;
    }
    /*
     * ��ѯ���ʽ limit������
     * @access public
     * @param mixed $limit limit��ѯ����(����)
     * @return object $this
     * */
    public function limit($limit){
        $this->options['where'] = $limit;
        return $this;
    }
    /*
     * ��ѯ���ʽ order������
     * @access public
     * @param string $order order��ѯ����
     * @param string $type order��ѯ������˳��Ĭ�Ͻ���
     * @return object $this
     * */
    public function order($order,$type='desc'){
        $this->options['order'] = $order;
        $this->options['order_type'] = $type;
        return $this;
    }
    /*
     * Ϊ�����������Ϣ
     * */
    function add(array $data){

    }
    /*
     * ���±�����Ϣ
     * */
    function save(array $data){

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
     * mysql�в�ѯ���
     * */
    function sql(){
        /*
         * ����SQL���
         * �������ݣ�INSERT INTO tb_name(id,name,score)VALUES(NULL,'����',140),(NULL,'����',178),(NULL,'����',134);
         * ������䣺UPDATE tb_name SET score=189 WHERE id=2;
         * ɾ�����ݣ�DELETE FROM tb_name WHERE id=3;
         * WHERE��䣺SELECT * FROM tb_name WHERE id=3;
         * HAVING ��䣺SELECT * FROM tb_name GROUP BY score HAVING count(*)>2
         * ����������Ʒ���=��>��<��<>��IN(1,2,3......)��BETWEEN a AND b��NOT AND ��OR Linke()�÷���      %  Ϊƥ�����⡢  _  ƥ��һ���ַ��������Ǻ��֣�IS NULL ��ֵ���
         * MySQL��������ʽ��SELECT * FROM tb_name WHERE name REGEXP '^[A-D]'   //�ҳ���A-D Ϊ��ͷ��name
         * */
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