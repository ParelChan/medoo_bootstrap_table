<?php
//action
$a=$_GET["a"];
echo $a;
session_start();
$_SESSION['name'] = 't';
sleep(5);
var_dump($_SESSION);