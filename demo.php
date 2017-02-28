<?php

require('Grep_class.php');
require('Csv_class.php');
$content = file_get_contents('http://www.ibos.com.cn');

$obj = new Grep();
$obj->set($content);
$dt = $obj->get('dt',0);
$dd = $obj->get('dd',0);

$count=count($dt);
$new_arr=array();

for($i=0;$i<$count;$i++){
    $new_arr[]=array($dt[$i],$dd[$i]);
}

$csvobj=new Csv();
$csvobj->Export2('授权公司目录', 'authorization date,company name',$new_arr);


?>