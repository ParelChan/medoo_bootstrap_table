<?php
require_once 'lib/class.action.php';
define('IN_SYS', true);
define('PROJECT_NAME', "medoo_bootstrap_table");
//action
$a=$_GET["a"];
if(file_exists("action/".$a.".php")){
	include_once "action/$a".".php";
}else {
	echo "can't find controller->[".$a."]";
}
// $action=new Action(array("a"=>"a","b"=>"b"));
// echo "getconfig:".var_export($action->getConfig(),true)."<br/>";
// echo "getinfo:".var_export(Action::getInfo(),true)."<br/>";
// echo "<br/>".$a;
// session_id()
// session_start();
// $_SESSION['name'] = 't';
// var_dump($_SESSION);