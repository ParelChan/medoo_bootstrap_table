<?php
#路由action
require_once 'lib/class.action.php';
require_once 'lib/config.php';
define('IN_SYS', true);
define('PROJECT_NAME', "medoo_bootstrap_table");
#异常输出
ini_set("display_errors", $config["DEBUG"]);
session_start();
// include log service
require_once 'lib/log4php/Logger.php';
// include db service
require_once 'lib/db.php';
// $logger = Logger::getLogger("main");
// $logger->info("This is an informational message.<br/>");
// $logger->warn("I'm not feeling so good...<br/>");
Logger::configure('lib/logconfigdaily.xml');
$log = Logger::getLogger('log');
// Start logging
// $log->trace("My first message.");   // Not logged because TRACE < WARN
// $log->debug("My second message.");  // Not logged because DEBUG < WARN
// $log->info("My third message.");    // Not logged because INFO < WARN
// $log->warn("My fourth message.");   // Logged because WARN >= WARN
// $log->error("My fifth message.");   // Logged because ERROR >= WARN
// $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
$a=$_GET["a"];
if(file_exists("action/".$a.".php")){
	$log->debug("执行控制器:[".$a."]");
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