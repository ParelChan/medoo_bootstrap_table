<?php
require_once 'lib/class.action.php';
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