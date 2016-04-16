<?php
/**
 * Author: helen
 * CreateTime: 2016/4/15 23:12
 * description: PHP--����������������
 */
class SORT
{
    //����ֵ���洢���������
    protected $array = array();
    //����ֵ�����鳤��
    protected $length;

    /*
     * SORT���ʼ������
     * @access public
     * @param array $array �������Ҫ��������ĺ���
     * @return object $this ������
     * */
    public function __construct(array $array)
    {
        $this->array = $array;
        $this->length = count($array);
        return $this;
    }

    /*
     * ð������
     * �㷨˼�룺�����Ƚ�����Ԫ�أ���¼���Ĺؼ��֣���������򽻻���ֱ��û�з����Ԫ�أ���¼��Ϊֹ
     * ���Ӷȣ�ʱ�临�Ӷȣ�o(n*n)
     * �����ռ䣺o(1)
     * �ȶ��ԣ��ȶ�
     * @access public
     * @param string $type ����˳������asc������desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function BubbleSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //��������
        $compare_count = 0;       //�Ƚϴ���
        $flag = true;             //��ǣ�Ŀ�����ڼ��ٱȽϴ���
        switch ($type) {
            case 'asc':     //��������
                for ($i = 0; $i < $length && $flag; $i++) {      //��flagΪtrue���˳�ѭ��
                    $flag = false;
                    for ($j = $length - 2; $j > $i; $j--) {
                        if ($array[$j] > $array[$j + 1]) {
                            $tmp = $array[$j];
                            $array[$j] = $array[$j + 1];
                            $array[$j + 1] = $tmp;
                            $exchange_count++;
                            $flag = true;   //��������ݽ�������flagΪtrue
                        }
                        $compare_count++;
                    }
                }
                break;
            case 'desc':    //��������
                for ($i = 0; $i < $length && $flag; $i++) {          //��flagΪtrue���˳�ѭ��
                    $flag = false;
                    for ($j = $length - 2; $j >= $i; $j--) {
                        if ($array[$j] < $array[$j + 1]) {
                            $tmp = $array[$j];
                            $array[$j] = $array[$j + 1];
                            $array[$j + 1] = $tmp;
                            $exchange_count++;
                            $flag = true;   //��������ݽ�������flagΪtrue
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
     * ��ѡ������
     * �㷨˼�룺ͨ��n-i�ιؼ��ּ�ıȽϣ���n-i+1����¼��ѡ���ؼ�����С��Ԫ�أ���¼�������͵�i��1=<i<=n����Ԫ�أ���¼������֮
     * ���Ӷȣ�o(n*n)
     * �����ռ䣺o(1)
     * �ȶ��ԣ��ȶ�
     * @access public
     * @param string $type ����˳������asc,����desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function SelectSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //��������
        $compare_count = 0;       //�Ƚϴ���
        switch ($type) {
            case 'asc':
                for ($i = 0; $i < $length; $i++) {
                    $min = $i;          //����ǰ�±궨��Ϊ��Сֵ�±�
                    for ($j = $i + 1; $j < $length; $j++) {   //ѭ��֮�������
                        if ($array[$min] > $array[$j]) {    //�����С�ڵ�ǰ��Сֵ�Ĺؼ���
                            $min = $j;                  //���˹ؼ��ֵ��±긳ֵ��min
                        }
                        $compare_count++;
                    }
                    if ($i != $min) {       //��min������i��˵���ҵ���Сֵ������
                        $tmp = $array[$min];
                        $array[$min] = $array[$i];
                        $array[$i] = $tmp;
                        $exchange_count++;
                    }
                }
                break;
            case 'desc':
                for ($i = 0; $i < $length; $i++) {
                    $max = $i;          //����ǰ�±궨��Ϊ���ֵ�±�
                    for ($j = $i + 1; $j < $length; $j++) {   //ѭ��֮�������
                        if ($array[$max] < $array[$j]) {    //����д��ڵ�ǰ��daֵ�Ĺؼ���
                            $max = $j;                  //���˹ؼ��ֵ��±긳ֵ��max
                        }
                        $compare_count++;
                    }
                    if ($i != $max) {       //��min������i��˵���ҵ����ֵ������
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
     * ֱ�Ӳ�������
     * �㷨˼�룺��һ��Ԫ�أ���¼�����뵽�Ѿ��ź����������У��Ӷ��õ�һ���µģ�Ԫ�أ���¼������1�������
     * ���Ӷȣ�o(n*n)
     * �����ռ䣺o(1)
     * �ȶ��ԣ��ȶ�
     * @access public
     * @param string $type ����˳������asc,����desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function InsertSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //��������
        $compare_count = 0;       //�Ƚϴ���
        switch ($type) {
            case 'asc':
                for ($i = 1; $i < $length; $i++) {
                    if ($array[$i] < $array[$i - 1]) {    //�뽫$array[$i]���������ӱ�
                        $flag = $array[$i];     //�����ڱ�
                        for ($j = $i - 1; $array[$j] > $flag && $j >= 0; $j--) {
                            $array[$j + 1] = $array[$j];    //��¼����
                            $compare_count++;
                        }
                        $array[$j + 1] = $flag;   //���뵽��ȷλ��
                        $exchange_count++;
                    }
                }
                break;
            case 'desc':
                for ($i = 1; $i < $length; $i++) {
                    if ($array[$i] > $array[$i - 1]) {    //�뽫$array[$i]���������ӱ�
                        $flag = $array[$i];     //�����ڱ�
                        for ($j = $i - 1; $array[$j] < $flag && $j >= 0; $j--) {
                            $array[$j + 1] = $array[$j];    //��¼����
                            $compare_count++;
                        }
                        $array[$j + 1] = $flag;   //���뵽��ȷλ��
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
     * ϣ������
     * �㷨˼�룺���зָ�--��������Ȼ�����ֱ�Ӳ������򡣽����ĳ��������Ԫ��(��¼)���һ�������У���֤���������зֱ����ֱ�Ӳ��������õ��Ľ���ǻ�������(С�Ĺؼ��ֻ�����ǰ�棬��Ĺؼ��ֻ����ں���)
     * ���Ӷȣ�o(n*logn)~o(n*n)
     * �����ռ䣺o(1)
     * �ȶ��ԣ����ȶ�
     * @access public
     * @param string $type ����˳������asc,����desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function ShellSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //��������
        $compare_count = 0;       //�Ƚϴ���
        switch ($type) {
            case 'asc':
                for ($gap = $length >> 1; $gap > 0; $gap >>= 1) {
                    for ($i = $gap; $i < $length; $i++) {
                        $temp = $array[$i];
                        for ($j = $i - $gap; $j >= 0 && $array[$j] > $temp; $j -= $gap) {
                            $array[$j + $gap] = $array[$j];
                            $compare_count++;
                        }
                        $array[$j + $gap] = $temp;
                        $exchange_count++;
                    }
                }
                break;
            case 'desc':
                for ($gap = $length >> 1; $gap > 0; $gap >>= 1) {
                    for ($i = $gap; $i < $length; $i++) {
                        $temp = $array[$i];
                        for ($j = $i - $gap; $j >= 0 && $array[$j] < $temp; $j -= $gap) {
                            $array[$j + $gap] = $array[$j];
                            $compare_count++;
                        }
                        $array[$j + $gap] = $temp;
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
     * ������
     * �㷨˼�룺������������й����һ���󶥶ѡ���ʱ���������е����ֵ���ǶѶ��ĸ��ڵ㡣�������ߣ�Ȼ��ʣ��Ԫ�����¹����һ���ѣ������߸��ڵ㣬�Դ����ơ�
     * ���Ӷȣ�o(n*logn)
     * �����ռ䣺o(1)
     * �ȶ��ԣ����ȶ�
     * @access public
     * @param string $type ����˳������asc,����desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function HeapSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //��������
        $compare_count = 0;       //�Ƚϴ���
        switch ($type) {
            case 'asc':
                $array = self::heap_sort_asc($array);
                break;
            case 'desc':
                $array = self::heap_sort_desc($array);
                break;
        }
        return array(
            'array' => $array,
            'exchange_count' => $exchange_count,
            'compare_count' => $compare_count
        );
    }

    protected function swap(&$x, &$y)
    {
        $t = $x;
        $x = $y;
        $y = $t;
    }

    protected function max_heapify_asc(&$arr, $start, $end)
    {
        //���������cָ�˺��ӹ��cָ��
        $dad = $start;
        $son = $dad * 2 + 1;
        if ($son >= $end)//���ӹ��cָ�˳��^����ֱ����������
            return;
        if ($son + 1 < $end && $arr[$son] < $arr[$son + 1])//�ȱ��^�ɂ��ӹ��c��С���x������
            $son++;
        if ($arr[$dad] <= $arr[$son]) {//��������cС��ӹ��c�r�����Q���Ӄ������^�m�ӹ��c�͌O���c���^
            self::swap($arr[$dad], $arr[$son]);
            self::max_heapify_asc($arr, $son, $end);
        }
    }

    protected function heap_sort_asc($arr)
    {
        $len = count($arr);
        //��ʼ����i������һ�������c�_ʼ�{��
        for ($i = $len / 2 - 1; $i >= 0; $i--)
            self::max_heapify_asc($arr, $i, $len);
        //�Ȍ���һ��Ԫ�غ����ź�Ԫ��ǰһλ�����Q���ُ����{����ֱ�������ꮅ
        for ($i = $len - 1; $i > 0; $i--) {
            self::swap($arr[0], $arr[$i]);
            self::max_heapify_asc($arr, 0, $i);
        }
        return $arr;
    }

    protected function max_heapify_desc(&$arr, $start, $end)
    {
        //���������cָ�˺��ӹ��cָ��
        $dad = $start;
        $son = $dad * 2 + 1;
        if ($son >= $end)//���ӹ��cָ�˳��^����ֱ����������
            return;
        if ($son + 1 < $end && $arr[$son] > $arr[$son + 1])//�ȱ��^�ɂ��ӹ��c��С���x������
            $son++;
        if ($arr[$dad] >= $arr[$son]) {//��������cС��ӹ��c�r�����Q���Ӄ������^�m�ӹ��c�͌O���c���^
            self::swap($arr[$dad], $arr[$son]);
            self::max_heapify_desc($arr, $son, $end);
        }
    }

    protected function heap_sort_desc($arr)
    {
        $len = count($arr);
        //��ʼ����i������һ�������c�_ʼ�{��
        for ($i = $len / 2 - 1; $i >= 0; $i--)
            self::max_heapify_desc($arr, $i, $len);
        //�Ȍ���һ��Ԫ�غ����ź�Ԫ��ǰһλ�����Q���ُ����{����ֱ�������ꮅ
        for ($i = $len - 1; $i > 0; $i--) {
            self::swap($arr[0], $arr[$i]);
            self::max_heapify_desc($arr, 0, $i);
        }
        return $arr;
    }

    /*
     * �鲢����
     * �㷨˼�룺�����ʼ����n��Ԫ�أ�ÿ�������еĳ���Ϊ2��Ȼ�������鲢���õ���һ�������У����������鲢���Դ����ơ�
     * ���Ӷȣ�o(n*logn)
     * �����ռ䣺o(n)
     * �ȶ��ԣ��ȶ�
     * @access public
     * @param string $type ����˳������asc,����desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function MergeSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        $exchange_count = 0;      //��������
        $compare_count = 0;       //�Ƚϴ���
        switch ($type) {
            case 'asc':
                $array = self::merge_sort_asc($array);
                break;
            case 'desc':
                $array = self::merge_sort_desc($array);
                break;
        }
        return array(
            'array' => $array,
            'exchange_count' => $exchange_count,
            'compare_count' => $compare_count
        );
    }

    protected function merge_sort_asc($arr)
    {
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        } else {
            $half = ($len >> 1) + ($len & 1);
            $arr2d = array_chunk($arr, $half);
            $left = self::merge_sort_asc($arr2d[0]);
            $right = self::merge_sort_asc($arr2d[1]);
            while (count($left) && count($right)) {
                if ($left[0] < $right[0]) {
                    $reg[] = array_shift($left);
                } else {
                    $reg[] = array_shift($right);
                }
            }
        }
        return array_merge($reg, $left, $right);
    }

    protected function merge_sort_desc($arr)
    {
        $len = count($arr);
        if ($len <= 1) {
            return $arr;
        } else {
            $half = ($len >> 1) + ($len & 1);
            $arr2d = array_chunk($arr, $half);
            $left = self::merge_sort_desc($arr2d[0]);
            $right = self::merge_sort_desc($arr2d[1]);
            while (count($left) && count($right)) {
                if ($left[0] > $right[0]) {
                    $reg[] = array_shift($left);
                } else {
                    $reg[] = array_shift($right);
                }
            }
        }
        return array_merge($reg, $left, $right);
    }

    /*
     * ��������
     * �㷨˼�룺ͨ��һ�����򽫴��ż�¼�ָ�ɶ����������֣�����һ���ּ�¼�Ĺؼ��־�����һ���ֵĹؼ���С����ɶ��������ּ�¼�������������Դﵽ�������������Ŀ�ġ�
     * ���Ӷȣ�o(n*logn)
     * �����ռ䣺o(logn)~o(n)
     * �ȶ��ԣ����ȶ�
     * @access public
     * @param string $type ����˳������asc,����desc;Ĭ������asc
     * @return array $array ������ɵ�����
     * @return string $exchange_count ��������н����Ĵ���
     * @return string $compare_count ��������бȽϵĴ���
     * */
    public function QuickSort($type = 'asc')
    {
        $array = $this->array;
        $length = $this->length;
        static $exchange_count = 0;      //��������
        static $compare_count = 0;       //�Ƚϴ���
        switch ($type) {
            case 'asc':
                $array = self::quick_sort_asc($array);
                break;
            case 'desc':
                $array = self::quick_sort_desc($array);
                break;
        }
        return array(
            'array' => $array,
            'exchange_count' => $exchange_count,
            'compare_count' => $compare_count
        );
    }

    protected function quick_sort_asc($arr)
    {
        $len = count($arr);
        static $compare_count = 0;       //�Ƚϴ���
        if ($len <= 1) {
            return $arr;
        } else {
            $left = $right = array();
            $mid_value = $arr[0];
            for ($i = 1; $i < $len; $i++) {
                if ($arr[$i] < $mid_value) {
                    $left[] = $arr[$i];
                } else {
                    $right[] = $arr[$i];
                }
                $compare_count++;
            }
        }
        return array_merge(self::quick_sort_asc($left), (array)$mid_value, self::quick_sort_asc($right));
    }

    protected function quick_sort_desc($arr)
    {
        $len = count($arr);
        static $compare_count = 0;       //�Ƚϴ���
        if ($len <= 1) {
            return $arr;
        } else {
            $left = $right = array();
            $mid_value = $arr[0];
            for ($i = 1; $i < $len; $i++) {
                if ($arr[$i] > $mid_value) {
                    $left[] = $arr[$i];
                } else {
                    $right[] = $arr[$i];
                }
                $compare_count++;
            }
        }
        return array_merge(self::quick_sort_desc($left), (array)$mid_value, self::quick_sort_desc($right));
    }
    /*
     * �����㷨������Ԫ�ؽ�������
     * @access protected
     * @param array $array ��ҪԪ�ؽ���������
     * @param interger $i ��ҪԪ�ؽ����������±�
     * @param interger $j ��ҪԪ�ؽ����������±�
     * @return void
     * */
    /*protected function swap(array $array, $i, $j)
    {
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }*/
}