<?php
/**
 * Author: helen
 * CreateTime: 2016/4/15 23:12
 * description: PHP--排序函数（数组排序）
 */
class SORT
{
    //属性值：存储传入的数组
    protected $array = array();
    //属性值：数组长度
    protected $length;

    /*
     * SORT类初始化函数
     * @access public
     * @param array $array 传入的需要进行排序的函数
     * @return object $this 对象本身
     * */
    public function __construct(array $array)
    {
        $this->array = $array;
        $this->length = count($array);
        return $this;
    }

    /*
     * 冒泡排序
     * 算法思想：两两比较相邻元素（记录）的关键字，如果反序则交换，直到没有反序的元素（记录）为止
     * 复杂度：时间复杂度：o(n*n)
     * 辅助空间：o(1)
     * 稳定性：稳定
     * @access public
     * @param string $type 排列顺序：升序asc，降序desc;默认升序asc
     * @return array $array 排序完成的数组
     * @return string $exchange_count 排序过程中交换的次数
     * @return string $compare_count 排序过程中比较的次数
     * */
    public function BubbleSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //交换次数
        $compare_count = 0;       //比较次数
        $flag = true;             //标记，目的在于减少比较次数
        switch ($type) {
            case 'asc':     //升序排列
                for ($i = 0; $i < $length && $flag; $i++) {      //若flag为true则退出循环
                    $flag = false;
                    for ($j = $length - 2; $j > $i; $j--) {
                        if ($array[$j] > $array[$j + 1]) {
                            $tmp = $array[$j];
                            $array[$j] = $array[$j + 1];
                            $array[$j + 1] = $tmp;
                            $exchange_count++;
                            $flag = true;   //如果有数据交换，则flag为true
                        }
                        $compare_count++;
                    }
                }
                break;
            case 'desc':    //降序排列
                for ($i = 0; $i < $length && $flag; $i++) {          //若flag为true则退出循环
                    $flag = false;
                    for ($j = $length - 2; $j >= $i; $j--) {
                        if ($array[$j] < $array[$j + 1]) {
                            $tmp = $array[$j];
                            $array[$j] = $array[$j + 1];
                            $array[$j + 1] = $tmp;
                            $exchange_count++;
                            $flag = true;   //如果有数据交换，则flag为true
                        }
                        $compare_count++;
                    }
                }
                break;
        }
        return array(
            'array' => $array,
            'exchange_count' => $exchange_count,
            'compare_count' => $compare_count
        );
    }

    /*
     * 简单选择排序
     * 算法思想：通过n-i次关键字间的比较，从n-i+1个记录中选出关键字最小的元素（记录），并和第i（1=<i<=n）个元素（记录）交换之
     * 复杂度：o(n*n)
     * 辅助空间：o(1)
     * 稳定性：稳定
     * @access public
     * @param string $type 排列顺序：升序asc,降序desc;默认升序asc
     * @return array $array 排序完成的数组
     * @return string $exchange_count 排序过程中交换的次数
     * @return string $compare_count 排序过程中比较的次数
     * */
    public function SelectSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //交换次数
        $compare_count = 0;       //比较次数
        switch ($type) {
            case 'asc':
                for ($i = 0; $i < $length; $i++) {
                    $min = $i;          //将当前下标定义为最小值下标
                    for ($j = $i + 1; $j < $length; $j++) {   //循环之后的数据
                        if ($array[$min] > $array[$j]) {    //如果有小于当前最小值的关键字
                            $min = $j;                  //将此关键字的下标赋值给min
                        }
                        $compare_count++;
                    }
                    if ($i != $min) {       //若min不等于i，说明找到最小值，交换
                        $tmp = $array[$min];
                        $array[$min] = $array[$i];
                        $array[$i] = $tmp;
                        $exchange_count++;
                    }
                }
                break;
            case 'desc':
                for ($i = 0; $i < $length; $i++) {
                    $max = $i;          //将当前下标定义为最大值下标
                    for ($j = $i + 1; $j < $length; $j++) {   //循环之后的数据
                        if ($array[$max] < $array[$j]) {    //如果有大于当前最da值的关键字
                            $max = $j;                  //将此关键字的下标赋值给max
                        }
                        $compare_count++;
                    }
                    if ($i != $max) {       //若min不等于i，说明找到最大值，交换
                        $tmp = $array[$max];
                        $array[$max] = $array[$i];
                        $array[$i] = $tmp;
                        $exchange_count++;
                    }
                }
                break;
        }
        return array(
            'array' => $array,
            'exchange_count' => $exchange_count,
            'compare_count' => $compare_count
        );

    }

    /*
     * 排序算法中数组元素交换函数
     * @access protected
     * @param array $array 需要元素交换的数组
     * @param interger $i 需要元素交换的数组下标
     * @param interger $j 需要元素交换的数组下标
     * @return void
     * */
    protected function swap(array $array, $i, $j)
    {
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }
}