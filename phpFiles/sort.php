<?php
/**
 * Author: helen
 * CreateTime: 2016/4/16 10:20
 * description: �����㷨���Ժ���
 */

// Ԥ������һ������
$arr = array(12, 45, 28, 30, 88, 67);
echo "ԭ����";
print_r($arr);
echo "<br/>";
//ð������
function maopao($arr)
{
    // ���е�һ�����
    for ($i = 0, $k = count($arr); $i < $k; $i++) {
        // ���еڶ������ ��������ÿһ��Ԫ�ض������Ԫ�رȽ�
        // �����i+1��˼����������ǰԪ�������
        for ($j = $i + 1; $j < $k; $j++) {
            // ������������Ƚ�
            if ($arr[$i] < $arr[$j]) {
                // �Ȱ�����һ�����鸳ֵ����ʱ����
                $temp = $arr[$j];
                // ����λ��
                $arr[$j] = $arr[$i];
                // �ٴ���ʱ�����и�ֵ����
                $arr[$i] = $temp;
            }
        }
    }
    // ��������������
    return $arr;
}

// ֱ�Ӵ�ӡ����������
echo '�����';
print_r(maopao($arr));

function insertion_sort(&$arr)
{ //php�����ҕ������̈́e�����Ա���Â����������޸�ԭ���
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
{//php�����ҕ������̈́e�����Ա���Â����������޸�ԭ���

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