<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
session_start();
session_destroy();
header("location: http://".$_SERVER["SERVER_NAME"]."/".constant("PROJECT_NAME")."/login.php");