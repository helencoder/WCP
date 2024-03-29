<?php
/**
 * Author: helen
 * CreateTime: 2016/4/9 19:38
 * description:公众函数
 */
/*
 * 将URL中的参数取出来放到数组里
 * @access public
 * @param string url后带参数
 * @return array 处理后的数组信息
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
 * 将 参数数组 再变回 字符串形式的参数格式
 * @access public
 * @param array 参数数组信息
 * @return string url后带参数
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