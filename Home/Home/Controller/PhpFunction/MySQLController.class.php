<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:15
 * description: MySQL����
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	                 ����	                  PHP
    mysql_affected_rows()	ȡ��ǰһ�� MySQL ������Ӱ��ļ�¼������	3
    mysql_change_user()	���޳ɡ��ı������е�¼���û�	3
    mysql_client_encoding()	���ص�ǰ���ӵ��ַ���������	4
    mysql_close()	�رշǳ־õ� MySQL ���ӡ�	3
    mysql_connect()	�򿪷ǳ־õ� MySQL ���ӡ�	3
    mysql_create_db()	���޳ɡ��½� MySQL ���ݿ⡣ʹ�� mysql_query() ���档	3
    mysql_data_seek()	�ƶ���¼ָ�롣	3
    mysql_db_name()	�Ӷ� mysql_list_dbs() �ĵ��÷������ݿ����ơ�	3
    mysql_db_query() ���޳ɡ�����һ�� MySQL ��ѯ��ʹ�� mysql_select_db() �� mysql_query() ���档3
    mysql_drop_db() ���޳ɡ�������ɾ����һ�� MySQL ���ݿ⡣ʹ�� mysql_query() ���档3
    mysql_errno()	������һ�� MySQL �����еĴ�����Ϣ�����ֱ��롣	3
    mysql_error()	������һ�� MySQL �����������ı�������Ϣ��	3
    mysql_escape_string() ���޳ɡ�ת��һ���ַ������� mysql_query��ʹ�� mysql_real_escape_string() ���档4
    mysql_fetch_array()	�ӽ������ȡ��һ����Ϊ�������飬���������飬����߼��С�	3
    mysql_fetch_assoc()	�ӽ������ȡ��һ����Ϊ�������顣	4
    mysql_fetch_field()	�ӽ������ȡ������Ϣ����Ϊ���󷵻ء�	3
    mysql_fetch_lengths()	ȡ�ý������ÿ���ֶε����ݵĳ��ȡ�	3
    mysql_fetch_object()	�ӽ������ȡ��һ����Ϊ����	3
    mysql_fetch_row()	�ӽ������ȡ��һ����Ϊ�������顣	3
    mysql_field_flags()	�ӽ����ȡ�ú�ָ���ֶι����ı�־��	3
    mysql_field_len()	����ָ���ֶεĳ��ȡ�	3
    mysql_field_name()	ȡ�ý����ָ���ֶε��ֶ�����	3
    mysql_field_seek()	��������е�ָ���趨Ϊָ�����ֶ�ƫ������	3
    mysql_field_table()	ȡ��ָ���ֶ����ڵı�����	3
    mysql_field_type()	ȡ�ý������ָ���ֶε����͡�	3
    mysql_free_result()	�ͷŽ���ڴ档	3
    mysql_get_client_info()	ȡ�� MySQL �ͻ�����Ϣ��	4
    mysql_get_host_info()	ȡ�� MySQL ������Ϣ��	4
    mysql_get_proto_info()	ȡ�� MySQL Э����Ϣ��	4
    mysql_get_server_info()	ȡ�� MySQL ��������Ϣ��	4
    mysql_info()	ȡ�����һ����ѯ����Ϣ��	4
    mysql_insert_id()	ȡ����һ�� INSERT ���������� ID��	3
    mysql_list_dbs()	�г� MySQL �����������е����ݿ⡣	3
    mysql_list_fields()���޳ɡ��г� MySQL ����е��ֶΡ�ʹ�� mysql_query() ���档3
    mysql_list_processes()	�г� MySQL ���̡�	4
    mysql_list_tables()���޳ɡ��г� MySQL ���ݿ��еı�ʹ��Use mysql_query() ���档3
    mysql_num_fields()	ȡ�ý�������ֶε���Ŀ��	3
    mysql_num_rows()	ȡ�ý�������е���Ŀ��	3
    mysql_pconnect()	��һ���� MySQL �������ĳ־����ӡ�	3
    mysql_ping()	Ping һ�����������ӣ����û���������������ӡ�	4
    mysql_query()	����һ�� MySQL ��ѯ��	3
    mysql_real_escape_string()	ת�� SQL �����ʹ�õ��ַ����е������ַ���	4
    mysql_result()	ȡ�ý�����ݡ�	3
    mysql_select_db()	ѡ�� MySQL ���ݿ⡣	3
    mysql_stat()	ȡ�õ�ǰϵͳ״̬��	4
    mysql_tablename()	���޳ɡ�ȡ�ñ�����ʹ�� mysql_query() ���档	3
    mysql_thread_id()	���ص�ǰ�̵߳� ID��	4
    mysql_unbuffered_query()	�� MySQL ����һ�� SQL ��ѯ������ȡ / ����������
 * */
class MySQLController extends CommonController{
    public function main(){

    }
}