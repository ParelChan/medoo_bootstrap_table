<?php
header('Content-type: text/json');
require_once 'lib/db.php';
// $database->quote($data);
if($_GET["a"]==null||$_GET["a"]==""){
	exit("please set a parameter");
}
if($_GET["a"]=="newdata"){
	$data=$database->query("select count(id) as count from user where DATE_FORMAT(NOW(),'%Y-%m-%d')=FROM_UNIXTIME(adddate,'%Y-%m-%d')")->fetch()["count"];
	$result=array("newcount"=>$data);
	echo json_encode($result);
}else if($_GET["a"]=="datasum"){
	$data=$database->query("select count(id) num,FROM_UNIXTIME(adddate,'%Y-%m-%d') adddate from user group by FROM_UNIXTIME(adddate,'%Y-%m-%d')")->fetchAll();
// 	print_r($data);
	echo json_encode($data);
}


