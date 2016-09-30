<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
header('Content-type: text/json');
// print_r($database->info());
// 插入数据测试
// $database->insert ( 'user', [
// 		'name' => 'foo',
// 		'age' => 25,
// 		'adddate' => time (),
// 		'deliveryaddress' => "shouhuodizhi",
// 		'phone' => "13823832312",
// 		'sex' => "nan"
// ] );
//http://medoo.lvtao.net/doc.select.php
// $datas = $database->select("user","*", [
// 		"limit"=>$_GET["limit"],
// 		"offset"=>$_GET["offset"]
// ]);
// 调试打印sql
// $datas = $database->debug()->select("user","*",["LIMIT" => [$_GET["offset"],$_GET["limit"]]]);
// $total=$database->debug()->count("user");
// var_dump($_GET["search"]);
if(!empty($_GET["search"])){
	$datas = $database->select("user","*",["name[~]"=>$_GET["search"],"LIMIT" => [$_GET["offset"],$_GET["limit"]]]);
}else{
	$datas = $database->select("user","*",["LIMIT" => [$_GET["offset"],$_GET["limit"]]]);
}
$total=$database->count("user");
$result=array("total"=>$total,"rows"=>$datas);
$log->debug("获取用户列表,条数:".$total);
echo  json_encode($result);
