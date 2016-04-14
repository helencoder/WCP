<?php
/**
 * Author: helen
 * CreateTime: 2016/4/9 19:38
 * description:���ں���
 */
/*
 * ��URL�еĲ���ȡ�����ŵ�������
 * @access public
 * @param string url�������
 * @return array ������������Ϣ
 * */
function convertUrlQuery($query){
    $queryParts = explode('&', $query);
    $params = array();
    foreach ($queryParts as $param){
        $item = explode('=', $param);
        $params[$item[0]] = $item[1];
    }
    return $params;
}
/*
 * �� �������� �ٱ�� �ַ�����ʽ�Ĳ�����ʽ
 * @access public
 * @param array ����������Ϣ
 * @return string url�������
 * */
function getUrlQuery($array_query){
    $tmp = array();
    foreach($array_query as $k=>$param)
    {
        $tmp[] = $k.'='.$param;
    }
    $params = implode('&',$tmp);
    return $params;
}