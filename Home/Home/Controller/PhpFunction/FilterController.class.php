<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 14:57
 * description: ����������
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	             ����	PHP
    filter_has_var()	����Ƿ����ָ���������͵ı�����	5
    filter_id()	����ָ���������� ID �š�	5
    filter_input()	�ӽű��ⲿ��ȡ���룬�����й��ˡ�	5
    filter_input_array()	�ӽű��ⲿ��ȡ�������룬�����й��ˡ�	5
    filter_list()	���ذ������еõ�֧�ֵĹ�������һ�����顣	5
    filter_var_array()	��ȡ��������������й��ˡ�	5
    filter_var()	��ȡһ�������������й��ˡ�	5
 *
 * PHP Filters
        ID����	         ����
    FILTER_CALLBACK	�����û��Զ��庯�����������ݡ�
    FILTER_SANITIZE_STRING	ȥ����ǩ��ȥ������������ַ���
    FILTER_SANITIZE_STRIPPED	"string" �������ı�����
    FILTER_SANITIZE_ENCODED	URL-encode �ַ�����ȥ������������ַ���
    FILTER_SANITIZE_SPECIAL_CHARS	HTML ת���ַ� '"<>& �Լ� ASCII ֵС�� 32 ���ַ���
    FILTER_SANITIZE_EMAIL	ɾ�������ַ���������ĸ�������Լ� !#$%&'*+-/=?^_`{|}~@.[]
    FILTER_SANITIZE_URL	ɾ�������ַ���������ĸ�������Լ� $-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=
    FILTER_SANITIZE_NUMBER_INT	ɾ�������ַ����������ֺ� +-
    FILTER_SANITIZE_NUMBER_FLOAT	ɾ�������ַ����������֡�+- �Լ� .,eE��
    FILTER_SANITIZE_MAGIC_QUOTES	Ӧ�� addslashes()��
    FILTER_UNSAFE_RAW	�������κι��ˣ�ȥ������������ַ���
    FILTER_VALIDATE_INT	��ָ���ķ�Χ��������ֵ֤��
    FILTER_VALIDATE_BOOLEAN	����� "1", "true", "on" �Լ� "yes"���򷵻� true������� "0", "false", "off", "no" �Լ� ""���򷵻� false�����򷵻� NULL��
    FILTER_VALIDATE_FLOAT	�Ը�������ֵ֤��
    FILTER_VALIDATE_REGEXP	���� regexp������ Perl ��������ʽ����ֵ֤��
    FILTER_VALIDATE_URL	��ֵ��Ϊ URL ����֤��
    FILTER_VALIDATE_EMAIL	��ֵ��Ϊ e-mail ����֤��
    FILTER_VALIDATE_IP	��ֵ��Ϊ IP ��ַ����֤��
 * */
class FilterController extends CommonController{
    public function main(){

    }
}