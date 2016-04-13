<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 22:07
 * description: �ַ�������
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *      ����	         ����
    addcslashes()	������ָ�����ַ�ǰ��ӷ�б�ܵ��ַ�����
    addslashes()	������Ԥ������ַ�ǰ��ӷ�б�ܵ��ַ�����
    bin2hex()	�� ASCII �ַ����ַ���ת��Ϊʮ������ֵ��
    chop()	ɾ���ַ����Ҳ�Ŀհ��ַ��������ַ���
    chr()	��ָ���� ASCII ֵ�����ַ���
    chunk_split()	���ַ����ָ�Ϊһϵ�и�С�Ĳ��֡�
    convert_cyr_string()	���ַ�����һ�� Cyrillic �ַ���ת��Ϊ��һ�֡�
    convert_uudecode()	���� uuencode �����ַ�����
    convert_uuencode()	ʹ�� uuencode �㷨���ַ������б��롣
    count_chars()	�����й��ַ����������ַ�����Ϣ��
    crc32()	�����ַ����� 32 λ CRC��
    crypt()	������ַ������ܷ���hashing����
    echo()	���һ�������ַ�����
    explode()	���ַ�����ɢΪ���顣
    fprintf()	�Ѹ�ʽ�����ַ���д�뵽ָ�����������
    get_html_translation_table()	������ htmlspecialchars() �� htmlentities() ʹ�õķ����
    hebrev()	��ϣ�����ı�ת��Ϊ�ɼ��ı���
    hebrevc()	��ϣ�����ı�ת��Ϊ�ɼ��ı����������У�\n��ת��Ϊ <br>��
    hex2bin()	��ʮ������ֵ���ַ���ת��Ϊ ASCII �ַ���
    html_entity_decode()	�� HTML ʵ��ת��Ϊ�ַ���
    htmlentities()	���ַ�ת��Ϊ HTML ʵ�塣
    htmlspecialchars_decode()	��һЩԤ����� HTML ʵ��ת��Ϊ�ַ���
    htmlspecialchars()	��һЩԤ������ַ�ת��Ϊ HTML ʵ�塣
    implode()	����������Ԫ����ϳɵ��ַ�����
    join()	implode() �ı�����
    lcfirst()	���ַ��������ַ�ת��ΪСд��
    levenshtein()	���������ַ���֮��� Levenshtein ���롣
    localeconv()	���ر������ּ����Ҹ�ʽ��Ϣ��
    ltrim()	�Ƴ��ַ������Ŀհ��ַ��������ַ���
    md5()	�����ַ����� MD5 ɢ�С�
    md5_file()	�����ļ��� MD5 ɢ�С�
    metaphone()	�����ַ����� metaphone ����
    money_format()	���ظ�ʽ��Ϊ�����ַ������ַ�����
    nl_langinfo()	�����ض��ı�����Ϣ��
    nl2br()	���ַ����е�ÿ������֮ǰ���� HTML ���з���
    number_format()	��ǧλ��������ʽ�����֡�
    ord()	�����ַ����е�һ���ַ��� ASCII ֵ��
    parse_str()	�Ѳ�ѯ�ַ��������������С�
    print()	���һ�������ַ�����
    printf()	�����ʽ�����ַ�����
    quoted_printable_decode()	�� quoted-printable �ַ���ת��Ϊ 8 λ�ַ�����
    quoted_printable_encode()	�� 8 λ�ַ���ת��Ϊ quoted-printable �ַ�����
    quotemeta()	����Ԫ�ַ���
    rtrim()	�Ƴ��ַ����Ҳ�Ŀհ��ַ��������ַ���
    setlocale()	���õ�����Ϣ��������Ϣ����
    sha1()	�����ַ����� SHA-1 ɢ�С�
    sha1_file()	�����ļ��� SHA-1 ɢ�С�
    similar_text()	���������ַ��������ƶȡ�
    soundex()	�����ַ����� soundex ����
    sprintf()	�Ѹ�ʽ�����ַ���д������С�
    sscanf()	����ָ���ĸ�ʽ���������ַ��������롣
    str_getcsv()	�� CSV �ַ��������������С�
    str_ireplace()	�滻�ַ����е�һЩ�ַ����Դ�Сд�����У���
    str_pad()	���ַ������Ϊ�µĳ��ȡ�
    str_repeat()	���ַ����ظ�ָ���Ĵ�����
    str_replace()	�滻�ַ����е�һЩ�ַ����Դ�Сд���У���
    str_rot13()	���ַ���ִ�� ROT13 ���롣
    str_shuffle()	����ش����ַ����е������ַ���
    str_split()	���ַ����ָ�����С�
    str_word_count()	�����ַ����еĵ�������
    strcasecmp()	�Ƚ������ַ������Դ�Сд�����У���
    strchr()	�����ַ�������һ�ַ����еĵ�һ�γ��֡���strstr() �ı�������
    strcmp()	�Ƚ������ַ������Դ�Сд���У���
    strcoll()	�Ƚ������ַ��������ݱ������ã���
    strcspn()	�������ҵ�ĳЩָ���ַ����κβ���֮ǰ�����ַ����в��ҵ��ַ�����
    strip_tags()	��ȥ�ַ����е� HTML �� PHP ��ǩ��
    stripcslashes()	ɾ���� addcslashes() ������ӵķ�б�ܡ�
    stripslashes()	ɾ���� addslashes() ������ӵķ�б�ܡ�
    stripos()	�����ַ�������һ�ַ����е�һ�γ��ֵ�λ�ã��Դ�Сд�����У���
    stristr()	�����ַ�������һ�ַ����е�һ�γ��ֵ�λ�ã���Сд�����У���
    strlen()	�����ַ����ĳ��ȡ�
    strnatcasecmp()	ʹ��һ��"��Ȼ����"�㷨���Ƚ������ַ������Դ�Сд�����У���
    strnatcmp()	ʹ��һ��"��Ȼ����"�㷨���Ƚ������ַ������Դ�Сд���У���
    strncasecmp()	ǰ n ���ַ����ַ����Ƚϣ��Դ�Сд�����У���
    strncmp()	ǰ n ���ַ����ַ����Ƚϣ��Դ�Сд���У���
    strpbrk()	���ַ����в���һ���ַ����κ�һ���ַ���
    strpos()	�����ַ�������һ�ַ����е�һ�γ��ֵ�λ�ã��Դ�Сд���У���
    strrchr()	�����ַ�������һ���ַ��������һ�γ��֡�
    strrev()	��ת�ַ�����
    strripos()	�����ַ�������һ�ַ��������һ�γ��ֵ�λ�ã��Դ�Сд�����У���
    strrpos()	�����ַ�������һ�ַ��������һ�γ��ֵ�λ�ã��Դ�Сд���У���
    strspn()	�������ַ����а������ض��ַ�����Ŀ��
    strstr()	�����ַ�������һ�ַ����еĵ�һ�γ��֣��Դ�Сд���У���
    strtok()	���ַ����ָ�Ϊ��С���ַ�����
    strtolower()	���ַ���ת��ΪСд��ĸ��
    strtoupper()	���ַ���ת��Ϊ��д��ĸ��
    strtr()	ת���ַ������ض����ַ���
    substr()	�����ַ�����һ���֡�
    substr_compare()	��ָ���Ŀ�ʼλ�ã������ư�ȫ��ѡ�������ִ�Сд���Ƚ������ַ�����
    substr_count()	�����Ӵ����ַ����г��ֵĴ�����
    substr_replace()	���ַ�����һ�����滻Ϊ��һ���ַ�����
    trim()	�Ƴ��ַ�������Ŀհ��ַ��������ַ���
    ucfirst()	���ַ����е����ַ�ת��Ϊ��д��
    ucwords()	���ַ�����ÿ�����ʵ����ַ�ת��Ϊ��д��
    vfprintf()	�Ѹ�ʽ�����ַ���д��ָ�����������
    vprintf()	�����ʽ�����ַ�����
    vsprintf()	�Ѹ�ʽ���ַ���д������С�
    wordwrap()	����ַ���Ϊָ���������ִ�
 * */
class StringController extends CommonController{
    public function main(){

    }
}