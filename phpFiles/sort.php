<?php
/**
 * Author: helen
 * CreateTime: 2016/4/16 10:20
 * description: 排序算法测试函数
 */

// 预先声明一个数组
$arr = array(12, 45, 28, 30, 88, 67);
echo "原数组";
print_r($arr);
echo "<br/>";
//冒泡排序
function maopao($arr)
{
    // 进行第一层遍历
    for ($i = 0, $k = count($arr); $i < $k; $i++) {
        // 进行第二层遍历 将数组中每一个元素都与外层元素比较
        // 这里的i+1意思是外层遍历当前元素往后的
        for ($j = $i + 1; $j < $k; $j++) {
            // 内外层两个数比较
            if ($arr[$i] < $arr[$j]) {
                // 先把其中一个数组赋值给临时变量
                $temp = $arr[$j];
                // 交换位置
                $arr[$j] = $arr[$i];
                // 再从临时变量中赋值回来
                $arr[$i] = $temp;
            }
        }
    }
    // 返回排序后的数组
    return $arr;
}

// 直接打印排序后的数组
echo '排序后';
print_r(maopao($arr));

function insertion_sort(&$arr)
{ //php的陣列視為基本型別，所以必須用傳參考才能修改原陣列
    for ($i = 1; $i < count($arr); $i++) {
        $temp = $arr[$i];
        for ($j = $i - 1; $j >= 0 && $arr[$j] > $temp; $j--)
            $arr[$j + 1] = $arr[$j];
        $arr[$j + 1] = $temp;
    }
}

$arr = array(12, 45, 28, 30, 88, 67);
insertion_sort($arr);
print_r($arr);


function shell_sort(&$arr)
{//php的陣列視為基本型別，所以必須用傳參考才能修改原陣列

}

$arr = array(12, 45, 28, 30, 88, 67);
shell_sort($arr);
print_r($arr);


function quick_sort($arr)
{
    $len = count($arr);

    if ($len <= 1)
        return $arr;

    $left = $right = array();
    $mid_value = $arr[0];

    for ($i = 1; $i < $len; $i++)
        if ($arr[$i] < $mid_value)
            $left[] = $arr[$i];
        else
            $right[] = $arr[$i];

    return array_merge(quick_sort($left), (array)$mid_value, quick_sort($right));
}

$arr = array(12, 45, 28, 30, 88, 67);
quick_sort($arr);
print_r($arr);