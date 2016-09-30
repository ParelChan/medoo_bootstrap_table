<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
header('Content-type: text/json');
// $database->quote($data);
if($_GET["act"]==null||$_GET["act"]==""){
	exit(json_encode(array("success"=>false,"msg"=>"pleactse set a parameter")));
}
if($_GET["act"]=="newdata"){
	$data=$database->query("select count(id) as count from user where DATE_FORMAT(NOW(),'%Y-%m-%d')=FROM_UNIXTIME(adddate,'%Y-%m-%d')")->fetch()["count"];
	$result=array("newcount"=>$data,"username"=>$_SESSION["username"]);
	$log->debug("获取最新数据:".var_export($result,true));
	exit(json_encode($result));
}else if($_GET["act"]=="datasum"){
	$data=$database->query("select count(id) num,FROM_UNIXTIME(adddate,'%Y-%m-%d') adddate from user group by FROM_UNIXTIME(adddate,'%Y-%m-%d')")->fetchAll();
// 	print_r($data);
	$log->debug("获取数据sum:".var_export($data,true));
	exit(json_encode($data));
}