<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
header('Content-type: text/json');
//语句前面加@屏蔽错误输出
@$username=$_POST["username"];
@$password=$_POST["password"];
$result=array();
if(!isset($username)||empty($username)||!isset($password)||empty($password)){
	$result=array("success"=>false,"msg"=>"用户名或密码不能为空");
	exit(json_encode($result));
}else{
	$log->debug("登录验证,username:".$username.",password:".$password);
	$result=array("success"=>false,"msg"=>"用户名或密码错误");
	$user = $database->select("user","*",["name"=>$username]);
	$log->debug("查询用户username:".$username."对应结果:".var_export($user,true));
	if(empty($user)){
		exit(json_encode($result));
	}else {
		if(is_array($user)){
			if(count($user)==1){
				$dbpwd=$user[0]["password"];
				$dbsalt=$user[0]["salt"];
				$calpwd=md5($dbsalt.$password);
				$log->debug("计算用户password:".$calpwd.",数据库pwd:".$dbpwd);
				if($calpwd==$dbpwd){
					$log->debug($username."->登录成功");
					$_SESSION["username"]=$username;
					$result=array("success"=>true,"msg"=>json_encode($user[0]));
				}
				exit(json_encode($result));
			}elseif (count($user)>1){
				$result=array("success"=>false,"msg"=>"find many");
				exit(json_encode($result));
			}
		}else{
			exit(json_encode($result));
		}
	}
}