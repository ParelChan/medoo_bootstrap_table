<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
require_once 'lib/phpqrcode.php';
$log->debug("生成二维码,param:".$_GET["param"].",size:".$_GET["size"]);
QRcode::png($_GET["param"],false,QR_ECLEVEL_L,$_GET["size"],0);