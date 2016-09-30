<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
$log->debug($_SESSION["username"]."退出系统并销毁session");
session_unset();
session_destroy();
header("location: http://".$_SERVER["SERVER_NAME"]."/".constant("PROJECT_NAME")."/login.php");