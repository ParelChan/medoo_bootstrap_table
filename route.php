<?php
require_once 'lib/class.action.php';
include('lib/log4php/Logger.php');
// $logger = Logger::getLogger("main");
// $logger->info("This is an informational message.<br/>");
// $logger->warn("I'm not feeling so good...<br/>");
Logger::configure('lib/logconfig.xml');
$log = Logger::getLogger('myLogger');
// Start logging
$log->trace("My first message.");   // Not logged because TRACE < WARN
$log->debug("My second message.");  // Not logged because DEBUG < WARN
$log->info("My third message.");    // Not logged because INFO < WARN
$log->warn("My fourth message.");   // Logged because WARN >= WARN
$log->error("My fifth message.");   // Logged because ERROR >= WARN
$log->fatal("My sixth message.");   // Logged because FATAL >= WARN
//action
$a=$_GET["a"];
$action=new Action(array("a"=>"a","b"=>"b"));
echo "getconfig:".var_export($action->getConfig(),true)."<br/>";
echo "getinfo:".var_export(Action::getInfo(),true)."<br/>";
echo "<br/>".$a;
// session_id()
// session_start();
// $_SESSION['name'] = 't';
// var_dump($_SESSION);