<?php
/**
 * Author: helen
 * CreateTime: 2016/4/10 22:06
 * description: 数组函数
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *    函数	                                             描述                              参数（array	必需。规定要使用的数组。）
    array()	                                        创建数组。（索引数组、关联数组）        array(value1,value2,value3,etc.);array(key=>value,key=>value,key=>value,etc.);
    array_change_key_case(array,case)	            把数组中所有键更改为小写或大写。        case CASE_LOWER - 默认值。将数组的键转换为小写字母。CASE_UPPER - 将数组的键转换为大写字母。
    array_chunk(array,size,preserve_key)	        把一个数组分割为新的数组块。           size	必需。整数值，规定每个新数组包含多少个元素。preserve_key	可选。可能的值：true - 保留原始数组中的键名。false - 默认。每个结果数组使用从零开始的新数组索引。
   #array_column(array,column_key,index_key)        返回输入数组中某个单一列的值。         column_key 必需。需要返回值的列。可以是索引数组的列的整数索引，或者是关联数组的列的字符串键值。该参数也可以是 NULL，此时将返回整个数组 index_key	可选。用作返回数组的索引/键的列。
   #array_combine(keys,values)	                    通过合并两个数组来创建一个新数组。其中的一个数组是键名，另一个数组的值为键值。   此处keys和values均为数组
   #array_count_values(array)	                    用于统计数组中所有值（value）出现的次数。
   #array_diff(array1,array2,array3...)	            比较数组，返回差集（只比较键值）。      array1	必需。与其他数组进行比较的第一个数组。
   #array_diff_assoc(array1,array2,array3...)	    比较数组，返回差集（比较键名和键值）。   array1	必需。与其他数组进行比较的第一个数组。 array2	必需。与第一个数组进行比较的数组。
    array_diff_key(array1,array2,array3...)	        比较数组，返回差集（只比较键名）。      array1	必需。与其他数组进行比较的第一个数组。 array2	必需。与第一个数组进行比较的数组。
    array_diff_uassoc()	                            比较数组，返回差集（比较键名和键值，使用用户自定义的键名比较函数）。
    array_diff_ukey()	                            比较数组，返回差集（只比较键名，使用用户自定义的键名比较函数）。
   #array_fill(index,number,value)	                用给定的键值填充数组。(填充多个相同值)  index	必需。被返回数组的第一个索引。 number	必需。规定要插入的元素数。 value	必需。规定供填充数组所使用的值。
    array_fill_keys(keys,value)	                    用指定键名的给定键值填充数组。         keys	必需。使用该数组的值作为键。非法值将被转换为字符串。（此可为数组） value	必需。填充数组所使用的值。
   #array_filter(array,callbackfunction)	        用回调函数过滤数组中的元素。           callbackfunction	必需。规定要使用的回调函数。
    array_flip(array)	                            交换数组中的键和值。
    array_intersect()	                            比较数组，返回交集（只比较键值）。
    array_intersect_assoc()	                        比较数组，返回交集（比较键名和键值）。
    array_intersect_key()	                        比较数组，返回交集（只比较键名）。
    array_intersect_uassoc()	                    比较数组，返回交集（比较键名和键值，使用用户自定义的键名比较函数）。
    array_intersect_ukey()	                        比较数组，返回交集（只比较键名，使用用户自定义的键名比较函数）。
    array_key_exists(key,array)	                    检查指定的键名是否存在于数组中。
    array_keys(array,value,strict)	                返回数组中所有的键名。                 value	可选。您可以指定键值，然后只有该键值对应的键名会被返回。 true - 返回带有指定键值的键名。依赖类型，数字 5 与字符串 "5" 是不同的。 false - 默认值。不依赖类型，数字 5 与字符串 "5" 是相同的。
    array_map(myfunction,array1,array2,array3...)	把数组中的每个值发送到用户自定义函数，返回新的值。  myfunction	必需。用户自定义函数的名称，或者是 null。  array1	必需。规定数组。
    array_merge(array1,array2,array3...)	        把一个或多个数组合并为一个数组。        如果两个或更多个数组元素有相同的键名，则最后的元素会覆盖其他元素。
    array_merge_recursive(array1,array2,array3...)	递归地合并一个或多个数组。             array_merge_recursive() 不会进行键名覆盖，而是将多个相同键名的值递归组成一个数组。
   #array_multisort(array1,sorting order,sorting type,array2,array3...)	        对多个数组或多维数组进行排序。
    array_pad(array,size,value)	                    用值将数组填补到指定长度。             size	必需。规定从函数返回的数组中元素的个数。  value	必需。规定从函数返回的数组中新元素的值。
    array_pop()	                                    删除数组的最后一个元素（出栈）。
    array_product()	                                计算数组中所有值的乘积。
    array_push()	                                将一个或多个元素插入数组的末尾（入栈）。
    array_rand(array,number)	                    返回数组中一个或多个随机的键。
    array_reduce(array,myfunction,initial)	        通过使用用户自定义函数，以字符串返回数组。 initial	可选。规定发送到函数的初始值。
    array_replace()	                                使用后面数组的值替换第一个数组的值。
    array_replace_recursive()	                    递归地使用后面数组的值替换第一个数组的值。
    array_reverse(array,preserve)	                以相反的顺序返回数组。                 preserve	可选。规定是否保留原始数组的键名。
    array_search(value,array,strict)	            搜索数组中给定的值并返回键名。          strict    可选。如果该参数被设置为 TRUE，则函数在数组中搜索数据类型和值都一致的元素。
    array_shift()	                                删除数组中首个元素，并返回被删除元素的值。
    array_slice(array,start,length,preserve)	    返回数组中被选定的部分。                preserve	可选。规定函数是保留键名还是重置键名。
    array_splice(array,start,length,array)	        删除并替换数组中指定的元素。
    array_sum()	                                    返回数组中值的和。
    array_udiff()	                                比较数组，返回差集（只比较值，使用一个用户自定义的键名比较函数）。
    array_udiff_assoc()	                            比较数组，返回差集（比较键和值，使用内建函数比较键名，使用用户自定义函数比较键值）。
    array_udiff_uassoc()	                        比较数组，返回差集（比较键和值，使用两个用户自定义的键名比较函数）。
    array_uintersect()	                            比较数组，返回交集（只比较值，使用一个用户自定义的键名比较函数）。
    array_uintersect_assoc()	                    比较数组，返回交集（比较键和值，使用内建函数比较键名，使用用户自定义函数比较键值）。
    array_uintersect_uassoc()	                    比较数组，返回交集（比较键和值，使用两个用户自定义的键名比较函数）。
    array_unique()	                                删除数组中的重复值。
    array_unshift()	                                在数组开头插入一个或多个元素。
    array_values()	                                返回数组中所有的值。
    array_walk(array,myfunction,userdata...)	    对数组中的每个成员应用用户函数。        userdata,...	可选。规定用户自定义函数的参数。您能够向此函数传递任意多参数。
    array_walk_recursive()	                        对数组中的每个成员递归地应用用户函数。
    arsort()	                                    对关联数组按照键值进行降序排序。
    asort()	                                        对关联数组按照键值进行升序排序。
    compact()	                                    创建包含变量名和它们的值的数组。
    count()	                                        返回数组中元素的数目。
    current()	                                    返回数组中的当前元素。
    each()	                                        返回数组中当前的键／值对。
    end()	                                        将数组的内部指针指向最后一个元素。
    extract()	                                    从数组中将变量导入到当前的符号表。
    in_array(search,array,type)	                    检查数组中是否存在指定的值。          type	可选。如果设置该参数为 true，则检查搜索的数据与数组的值的类型是否相同。
    key()	                                        从关联数组中取得键名。
    krsort()	                                    对数组按照键名逆向排序。
    ksort()	                                        对数组按照键名排序。
    list()	                                        把数组中的值赋给一些变量。
    natcasesort()	                                用“自然排序”算法对数组进行不区分大小写字母的排序。
    natsort()	                                    用“自然排序”算法对数组排序。
    next()	                                        将数组中的内部指针向前移动一位。
    pos()	                                        current() 的别名。
    prev()	                                        将数组的内部指针倒回一位。
    range()	                                        创建包含指定范围单元的数组。
    reset()	                                        将数组的内部指针指向第一个元素。
    rsort()	                                        对数组逆向排序。
    shuffle()	                                    将数组打乱。
    sizeof()	                                    count() 的别名。
    sort()	                                        对数组排序。
    uasort()	                                    使用用户自定义的比较函数对数组中的键值进行排序。
    uksort()	                                    使用用户自定义的比较函数对数组中的键名进行排序。
    usort()	                                        使用用户自定义的比较函数对数组进行排序。
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