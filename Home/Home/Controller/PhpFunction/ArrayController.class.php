<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 22:06
 * description: ���麯��
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *    ����	                                             ����                              ������array	���衣�涨Ҫʹ�õ����顣��
    array()	                                        �������顣���������顢�������飩        array(value1,value2,value3,etc.);array(key=>value,key=>value,key=>value,etc.);
    array_change_key_case(array,case)	            �����������м�����ΪСд���д��        case CASE_LOWER - Ĭ��ֵ��������ļ�ת��ΪСд��ĸ��CASE_UPPER - ������ļ�ת��Ϊ��д��ĸ��
    array_chunk(array,size,preserve_key)	        ��һ������ָ�Ϊ�µ�����顣           size	���衣����ֵ���涨ÿ��������������ٸ�Ԫ�ء�preserve_key	��ѡ�����ܵ�ֵ��true - ����ԭʼ�����еļ�����false - Ĭ�ϡ�ÿ���������ʹ�ô��㿪ʼ��������������
   #array_column(array,column_key,index_key)        ��������������ĳ����һ�е�ֵ��         column_key ���衣��Ҫ����ֵ���С�����������������е����������������ǹ���������е��ַ�����ֵ���ò���Ҳ������ NULL����ʱ�������������� index_key	��ѡ�������������������/�����С�
   #array_combine(keys,values)	                    ͨ���ϲ���������������һ�������顣���е�һ�������Ǽ�������һ�������ֵΪ��ֵ��   �˴�keys��values��Ϊ����
   #array_count_values(array)	                    ����ͳ������������ֵ��value�����ֵĴ�����
   #array_diff(array1,array2,array3...)	            �Ƚ����飬���ز��ֻ�Ƚϼ�ֵ����      array1	���衣������������бȽϵĵ�һ�����顣
   #array_diff_assoc(array1,array2,array3...)	    �Ƚ����飬���ز���Ƚϼ����ͼ�ֵ����   array1	���衣������������бȽϵĵ�һ�����顣 array2	���衣���һ��������бȽϵ����顣
    array_diff_key(array1,array2,array3...)	        �Ƚ����飬���ز��ֻ�Ƚϼ�������      array1	���衣������������бȽϵĵ�һ�����顣 array2	���衣���һ��������бȽϵ����顣
    array_diff_uassoc()	                            �Ƚ����飬���ز���Ƚϼ����ͼ�ֵ��ʹ���û��Զ���ļ����ȽϺ�������
    array_diff_ukey()	                            �Ƚ����飬���ز��ֻ�Ƚϼ�����ʹ���û��Զ���ļ����ȽϺ�������
   #array_fill(index,number,value)	                �ø����ļ�ֵ������顣(�������ֵͬ)  index	���衣����������ĵ�һ�������� number	���衣�涨Ҫ�����Ԫ������ value	���衣�涨�����������ʹ�õ�ֵ��
    array_fill_keys(keys,value)	                    ��ָ�������ĸ�����ֵ������顣         keys	���衣ʹ�ø������ֵ��Ϊ�����Ƿ�ֵ����ת��Ϊ�ַ��������˿�Ϊ���飩 value	���衣���������ʹ�õ�ֵ��
   #array_filter(array,callbackfunction)	        �ûص��������������е�Ԫ�ء�           callbackfunction	���衣�涨Ҫʹ�õĻص�������
    array_flip(array)	                            ���������еļ���ֵ��
    array_intersect()	                            �Ƚ����飬���ؽ�����ֻ�Ƚϼ�ֵ����
    array_intersect_assoc()	                        �Ƚ����飬���ؽ������Ƚϼ����ͼ�ֵ����
    array_intersect_key()	                        �Ƚ����飬���ؽ�����ֻ�Ƚϼ�������
    array_intersect_uassoc()	                    �Ƚ����飬���ؽ������Ƚϼ����ͼ�ֵ��ʹ���û��Զ���ļ����ȽϺ�������
    array_intersect_ukey()	                        �Ƚ����飬���ؽ�����ֻ�Ƚϼ�����ʹ���û��Զ���ļ����ȽϺ�������
    array_key_exists(key,array)	                    ���ָ���ļ����Ƿ�����������С�
    array_keys(array,value,strict)	                �������������еļ�����                 value	��ѡ��������ָ����ֵ��Ȼ��ֻ�иü�ֵ��Ӧ�ļ����ᱻ���ء� true - ���ش���ָ����ֵ�ļ������������ͣ����� 5 ���ַ��� "5" �ǲ�ͬ�ġ� false - Ĭ��ֵ�����������ͣ����� 5 ���ַ��� "5" ����ͬ�ġ�
    array_map(myfunction,array1,array2,array3...)	�������е�ÿ��ֵ���͵��û��Զ��庯���������µ�ֵ��  myfunction	���衣�û��Զ��庯�������ƣ������� null��  array1	���衣�涨���顣
    array_merge(array1,array2,array3...)	        ��һ����������ϲ�Ϊһ�����顣        �����������������Ԫ������ͬ�ļ�����������Ԫ�ػḲ������Ԫ�ء�
    array_merge_recursive(array1,array2,array3...)	�ݹ�غϲ�һ���������顣             array_merge_recursive() ������м������ǣ����ǽ������ͬ������ֵ�ݹ����һ�����顣
   #array_multisort(array1,sorting order,sorting type,array2,array3...)	        �Զ��������ά�����������
    array_pad(array,size,value)	                    ��ֵ���������ָ�����ȡ�             size	���衣�涨�Ӻ������ص�������Ԫ�صĸ�����  value	���衣�涨�Ӻ������ص���������Ԫ�ص�ֵ��
    array_pop()	                                    ɾ����������һ��Ԫ�أ���ջ����
    array_product()	                                ��������������ֵ�ĳ˻���
    array_push()	                                ��һ������Ԫ�ز��������ĩβ����ջ����
    array_rand(array,number)	                    ����������һ����������ļ���
    array_reduce(array,myfunction,initial)	        ͨ��ʹ���û��Զ��庯�������ַ����������顣 initial	��ѡ���涨���͵������ĳ�ʼֵ��
    array_replace()	                                ʹ�ú��������ֵ�滻��һ�������ֵ��
    array_replace_recursive()	                    �ݹ��ʹ�ú��������ֵ�滻��һ�������ֵ��
    array_reverse(array,preserve)	                ���෴��˳�򷵻����顣                 preserve	��ѡ���涨�Ƿ���ԭʼ����ļ�����
    array_search(value,array,strict)	            ���������и�����ֵ�����ؼ�����          strict    ��ѡ������ò���������Ϊ TRUE�������������������������ͺ�ֵ��һ�µ�Ԫ�ء�
    array_shift()	                                ɾ���������׸�Ԫ�أ������ر�ɾ��Ԫ�ص�ֵ��
    array_slice(array,start,length,preserve)	    ���������б�ѡ���Ĳ��֡�                preserve	��ѡ���涨�����Ǳ��������������ü�����
    array_splice(array,start,length,array)	        ɾ�����滻������ָ����Ԫ�ء�
    array_sum()	                                    ����������ֵ�ĺ͡�
    array_udiff()	                                �Ƚ����飬���ز��ֻ�Ƚ�ֵ��ʹ��һ���û��Զ���ļ����ȽϺ�������
    array_udiff_assoc()	                            �Ƚ����飬���ز���Ƚϼ���ֵ��ʹ���ڽ������Ƚϼ�����ʹ���û��Զ��庯���Ƚϼ�ֵ����
    array_udiff_uassoc()	                        �Ƚ����飬���ز���Ƚϼ���ֵ��ʹ�������û��Զ���ļ����ȽϺ�������
    array_uintersect()	                            �Ƚ����飬���ؽ�����ֻ�Ƚ�ֵ��ʹ��һ���û��Զ���ļ����ȽϺ�������
    array_uintersect_assoc()	                    �Ƚ����飬���ؽ������Ƚϼ���ֵ��ʹ���ڽ������Ƚϼ�����ʹ���û��Զ��庯���Ƚϼ�ֵ����
    array_uintersect_uassoc()	                    �Ƚ����飬���ؽ������Ƚϼ���ֵ��ʹ�������û��Զ���ļ����ȽϺ�������
    array_unique()	                                ɾ�������е��ظ�ֵ��
    array_unshift()	                                �����鿪ͷ����һ������Ԫ�ء�
    array_values()	                                �������������е�ֵ��
    array_walk(array,myfunction,userdata...)	    �������е�ÿ����ԱӦ���û�������        userdata,...	��ѡ���涨�û��Զ��庯���Ĳ��������ܹ���˺�����������������
    array_walk_recursive()	                        �������е�ÿ����Ա�ݹ��Ӧ���û�������
    arsort()	                                    �Թ������鰴�ռ�ֵ���н�������
    asort()	                                        �Թ������鰴�ռ�ֵ������������
    compact()	                                    �������������������ǵ�ֵ�����顣
    count()	                                        ����������Ԫ�ص���Ŀ��
    current()	                                    ���������еĵ�ǰԪ�ء�
    each()	                                        ���������е�ǰ�ļ���ֵ�ԡ�
    end()	                                        ��������ڲ�ָ��ָ�����һ��Ԫ�ء�
    extract()	                                    �������н��������뵽��ǰ�ķ��ű�
    in_array(search,array,type)	                    ����������Ƿ����ָ����ֵ��          type	��ѡ��������øò���Ϊ true�����������������������ֵ�������Ƿ���ͬ��
    key()	                                        �ӹ���������ȡ�ü�����
    krsort()	                                    �����鰴�ռ�����������
    ksort()	                                        �����鰴�ռ�������
    list()	                                        �������е�ֵ����һЩ������
    natcasesort()	                                �á���Ȼ�����㷨��������в����ִ�Сд��ĸ������
    natsort()	                                    �á���Ȼ�����㷨����������
    next()	                                        �������е��ڲ�ָ����ǰ�ƶ�һλ��
    pos()	                                        current() �ı�����
    prev()	                                        ��������ڲ�ָ�뵹��һλ��
    range()	                                        ��������ָ����Χ��Ԫ�����顣
    reset()	                                        ��������ڲ�ָ��ָ���һ��Ԫ�ء�
    rsort()	                                        ��������������
    shuffle()	                                    ��������ҡ�
    sizeof()	                                    count() �ı�����
    sort()	                                        ����������
    uasort()	                                    ʹ���û��Զ���ıȽϺ����������еļ�ֵ��������
    uksort()	                                    ʹ���û��Զ���ıȽϺ����������еļ�����������
    usort()	                                        ʹ���û��Զ���ıȽϺ����������������
 * */
class ArrayController extends CommonController{
    public function main(){
        $arr_one = array('red','green','yellow');
        $arr_two = array(
            'one'   =>'red',
            'two'   =>'green',
            'three' =>'yellow'
        );
        $a1=array_fill(3,4,"blue");
        print_r($a1);


    }
}