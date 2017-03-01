<?php

require('Grep.class.php');
require('Csv.class.php');
$content = file_get_contents('http://www.ibos.com.cn');

/*
 * 调用Grep类，获取对应dt 和 dd 的内容
 */
$obj = new Grep();
$obj->set($content);
$dt_value = $obj->get('dt',0);
$dd_value = $obj->get('dd',0);

$dt_count=count($dt_value);
$result_arr=array();

for($i=0;$i<$dt_count;$i++){
    $result_arr[]=array($dt_value[$i],$dd_value[$i]);
}

/*
 * 调用Csv类，获取生成csv文件
 */
$csv_obj=new Csv();
$csv_obj->export2('授权公司目录', 'authorization date,company name',$result_arr);


?>