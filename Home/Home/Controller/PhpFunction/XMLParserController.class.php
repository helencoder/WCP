<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:31
 * description: XML Parser����
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	             ����	                  PHP
    utf8_decode()	�� UTF-8 �ַ�������Ϊ ISO-8859-1��	3
    utf8_encode()	�� ISO-8859-1 �ַ�������Ϊ UTF-8��	3
    xml_error_string()	��ȡ XML �������Ĵ���������	3
    xml_get_current_byte_index()	��ȡ XML �������ĵ�ǰ�ֽ�������	3
    xml_get_current_column_number()	��ȡ XML �������ĵ�ǰ�кš�	3
    xml_get_current_line_number()	��ȡ XML �������ĵ�ǰ�кš�	3
    xml_get_error_code()	��ȡ XML ������������롣	3
    xml_parse()	���� XML �ĵ���	3
    xml_parse_into_struct()	�� XML ���ݽ����������С�	3
    xml_parser_create_ns()	�������������ռ�֧�ֵ� XML ��������	4
    xml_parser_create()	���� XML ��������	3
    xml_parser_free()	�ͷ� XML ��������	3
    xml_parser_get_option()	�� XML ��������ȡѡ��������Ϣ��	3
    xml_parser_set_option()	Ϊ XML ��������ѡ�����á�	3
    xml_set_character_data_handler()	�����ַ����ݴ�������	3
    xml_set_default_handler()	����Ĭ�ϵ����ݴ�������	3
    xml_set_element_handler()	������ʼ����ֹԪ�ش�������	3
    xml_set_end_namespace_decl_handler()	������ֹ�����ռ�������������	4
    xml_set_external_entity_ref_handler()	�����ⲿʵ�崦������	3
    xml_set_notation_decl_handler()	����ע��������������	3
    xml_set_object()	�ڶ�����ʹ�� XML ��������	4
    xml_set_processing_instruction_handler()	��������ָ�PI����������	3
    xml_set_start_namespace_decl_handler()	������ʼ�����ռ�������������	4
    xml_set_unparsed_entity_decl_handler()	����δ����ʵ�嶨��������������	3
 *
 *  PHP XML Parser ����
    Constant
    XML_ERROR_NONE (integer)
    XML_ERROR_NO_MEMORY (integer)
    XML_ERROR_SYNTAX (integer)
    XML_ERROR_NO_ELEMENTS (integer)
    XML_ERROR_INVALID_TOKEN (integer)
    XML_ERROR_UNCLOSED_TOKEN (integer)
    XML_ERROR_PARTIAL_CHAR (integer)
    XML_ERROR_TAG_MISMATCH (integer)
    XML_ERROR_DUPLICATE_ATTRIBUTE (integer)
    XML_ERROR_JUNK_AFTER_DOC_ELEMENT (integer)
    XML_ERROR_PARAM_ENTITY_REF (integer)
    XML_ERROR_UNDEFINED_ENTITY (integer)
    XML_ERROR_RECURSIVE_ENTITY_REF (integer)
    XML_ERROR_ASYNC_ENTITY (integer)
    XML_ERROR_BAD_CHAR_REF (integer)
    XML_ERROR_BINARY_ENTITY_REF (integer)
    XML_ERROR_ATTRIBUTE_EXTERNAL_ENTITY_REF (integer)
    XML_ERROR_MISPLACED_XML_PI (integer)
    XML_ERROR_UNKNOWN_ENCODING (integer)
    XML_ERROR_INCORRECT_ENCODING (integer)
    XML_ERROR_UNCLOSED_CDATA_SECTION (integer)
    XML_ERROR_EXTERNAL_ENTITY_HANDLING (integer)
    XML_OPTION_CASE_FOLDING (integer)
    XML_OPTION_TARGET_ENCODING (integer)
    XML_OPTION_SKIP_TAGSTART (integer)
    XML_OPTION_SKIP_WHITE (integer)
 * */
class XMLParserController extends CommonController{
    public function main(){

    }
}