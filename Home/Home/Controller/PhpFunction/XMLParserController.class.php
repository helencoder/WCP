<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:31
 * description: XML Parser函数
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      函数	             描述	                  PHP
    utf8_decode()	把 UTF-8 字符串解码为 ISO-8859-1。	3
    utf8_encode()	把 ISO-8859-1 字符串编码为 UTF-8。	3
    xml_error_string()	获取 XML 解析器的错误描述。	3
    xml_get_current_byte_index()	获取 XML 解析器的当前字节索引。	3
    xml_get_current_column_number()	获取 XML 解析器的当前列号。	3
    xml_get_current_line_number()	获取 XML 解析器的当前行号。	3
    xml_get_error_code()	获取 XML 解析器错误代码。	3
    xml_parse()	解析 XML 文档。	3
    xml_parse_into_struct()	把 XML 数据解析到数组中。	3
    xml_parser_create_ns()	创建带有命名空间支持的 XML 解析器。	4
    xml_parser_create()	创建 XML 解析器。	3
    xml_parser_free()	释放 XML 解析器。	3
    xml_parser_get_option()	从 XML 解析器获取选项设置信息。	3
    xml_parser_set_option()	为 XML 解析进行选项设置。	3
    xml_set_character_data_handler()	建立字符数据处理器。	3
    xml_set_default_handler()	建立默认的数据处理器。	3
    xml_set_element_handler()	建立起始和终止元素处理器。	3
    xml_set_end_namespace_decl_handler()	建立终止命名空间声明处理器。	4
    xml_set_external_entity_ref_handler()	建立外部实体处理器。	3
    xml_set_notation_decl_handler()	建立注释声明处理器。	3
    xml_set_object()	在对象中使用 XML 解析器。	4
    xml_set_processing_instruction_handler()	建立处理指令（PI）处理器。	3
    xml_set_start_namespace_decl_handler()	建立起始命名空间声明处理器。	4
    xml_set_unparsed_entity_decl_handler()	建立未解析实体定义声明处理器。	3
 *
 *  PHP XML Parser 常量
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