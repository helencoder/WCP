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
     * �����㷨������Ԫ�ؽ�������
     * @access protected
     * @param array $array ��ҪԪ�ؽ���������
     * @param interger $i ��ҪԪ�ؽ����������±�
     * @param interger $j ��ҪԪ�ؽ����������±�
     * @return void
     * */
    protected function swap(array $array, $i, $j)
    {
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }
}