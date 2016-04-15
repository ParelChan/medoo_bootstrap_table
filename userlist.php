<?php
header('Content-type: text/json');
require_once 'lib/db.php';
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
$datas = $database->select("user","*");
$result=array("total"=>"10","rows"=>$datas);
echo  json_encode($result);
