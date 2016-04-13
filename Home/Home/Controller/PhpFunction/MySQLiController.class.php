<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:19
 * description: MySQLi����
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	                 ����
    mysqli_affected_rows()	����ǰһ�� Mysql ��������Ӱ��������
    mysqli_autocommit()	�򿪻�ر��Զ��ύ���ݿ��޸Ĺ��ܡ�
    mysqli_change_user()	����ָ�����ݿ����ӵ��û���
    mysqli_character_set_name()	�������ݿ����ӵ�Ĭ���ַ�����
    mysqli_close()	�ر���ǰ�򿪵����ݿ����ӡ�
    mysqli_commit()	�ύ��ǰ����
    mysqli_connect_errno()	�������һ�����ӵ��õĴ�����롣
    mysqli_connect_error()	������һ�����Ӵ���Ĵ���������
    mysqli_connect()	�򿪵� Mysql �������������ӡ�
    mysqli_data_seek()	�������ָ�뵽������е�һ�������С�
    mysqli_debug()	ִ�е��Բ�����
    mysqli_dump_debug_info()	ת��������Ϣ����־�С�
    mysqli_errno()	��������ĺ������ò����Ĵ�����롣
    mysqli_error_list()	��������ĺ������ò����Ĵ����б�
    mysqli_error()	�����ַ������������һ�κ������ò����Ĵ�����롣
    mysqli_fetch_all()	ץȡ���еĽ���в����Թ������ݣ���ֵ�������飬�������߽��еķ�ʽ���ؽ������
    mysqli_fetch_array()	��һ���������飬��ֵ�������飬�������߽��еķ�ʽץȡһ�н����
    mysqli_fetch_assoc()	��һ���������鷽ʽץȡһ�н����
    mysqli_fetch_field_direct()	�Զ��󷵻ؽ�����е��ֶε�Ԫ���ݡ�
    mysqli_fetch_field()	�Զ��󷵻ؽ�����е���һ���ֶΡ�
    mysqli_fetch_fields()	���ش����������ֶεĶ������顣
    mysqli_fetch_lengths()	���ؽ�����е�ǰ�е��г��ȡ�
    mysqli_fetch_object()	�Զ��󷵻ؽ�����ĵ�ǰ�С�
    mysqli_fetch_row()	�ӽ������ץȡһ�в���ö���������ʽ��������
    mysqli_field_count()	�������һ�β�ѯ��ȡ�����е���Ŀ��
    mysqli_field_seek()	�����ֶ�ָ�뵽�ض����ֶο�ʼλ�á�
    mysqli_field_tell()	�����ֶ�ָ���λ�á�
    mysqli_free_result()	�ͷ���ĳ���������ص��ڴ档
    mysqli_get_charset()	�����ַ�������
    mysqli_get_client_info()	�����ַ������͵� Mysql �ͻ��˰汾��Ϣ��
    mysqli_get_client_stats()	����ÿ���ͻ��˽��̵�ͳ����Ϣ��
    mysqli_get_client_version()	�������͵� Mysql �ͻ��˰汾��Ϣ��
    mysqli_get_connection_stats()	���ؿͻ������ӵ�ͳ����Ϣ��
    mysqli_get_host_info()	���� MySQL ���������������������͡�
    mysqli_get_proto_info()	���� MySQL Э��汾��
    mysqli_get_server_info()	���� MySQL �������汾��
    mysqli_get_server_version()	�������͵� MySQL �������汾��Ϣ��
    mysqli_info()	�������һ��ִ�еĲ�ѯ�ļ�����Ϣ��
    mysqli_init()	��ʼ�� mysqli ���ҷ���һ���� mysqli_real_connect() ʹ�õ���Դ���͡�
    mysqli_insert_id()	�������һ�β�ѯ��ʹ�õ��Զ����� id��
    mysql_kill()	����������ս�ĳ�� MySQL �̡߳�
    mysqli_more_results()	���һ��������ѯ�Ƿ���������ѯ�������
    mysqli_multi_query()	�����ݿ���ִ��һ��������ѯ��
    mysqli_next_result()	�� mysqli_multi_query() ��׼����һ���������
    mysqli_num_fields()	���ؽ�����е��ֶ�����
    mysqli_num_rows()	���ؽ�����е�������
    mysqli_options()	����ѡ�
    mysqli_ping()	Ping һ�����������ӣ���������Ǹ����Ӷ��˳���������
    mysqli_prepare()	׼��һ������ִ�е� SQL ��䡣
    mysqli_query()	�����ݿ���ִ�в�ѯ��
    mysqli_real_connect()	��һ���� Mysql ����˵������ӡ�
    mysqli_real_escape_string()	ת���� SQL �����ʹ�õ��ַ����е������ַ���
    mysqli_real_query()	ִ�� SQL ��ѯ��
    mysqli_reap_async_query()	�����첽��ѯ�Ľ����
    mysqli_refresh()	ˢ�±�򻺴棬�������ø��Ʒ�������Ϣ��
    mysqli_rollback()	�ع���ǰ����
    mysqli_select_db()	�ı����ӵ�Ĭ�����ݿ⡣
    mysqli_set_charset()	����Ĭ�Ͽͻ����ַ�����
    mysqli_set_local_infile_default()	����û�Ϊ load local infile �����Ĵ������
    mysqli_set_local_infile_handler()	���� LOAD DATA LOCAL INFILE ����ִ�еĻص�������
    mysqli_sqlstate()	����ǰһ�� Mysql ������ SQLSTATE ������롣
    mysqli_ssl_set()	ʹ�� SSL ������װ���ӡ�
    mysqli_stat()	���ص�ǰϵͳ״̬��
    mysqli_stmt_init()	��ʼ��һ����䲢����һ���� mysqli_stmt_prepare() ʹ�õĶ���
    mysqli_store_result()	�������һ����ѯ�Ľ������
    mysqli_thread_id()	���ص�ǰ���ӵ��߳� ID��
    mysqli_thread_safe()	�����Ƿ��趨���̰߳�ȫ��
    mysqli_use_result()	��ʼ��һ���������ȡ�ء�
    mysqli_warning_count()	�������������һ�β�ѯ�ľ���������
 * */
class MySQLiController extends CommonController{
    public function main(){

    }
}