<?php
require_once 'medoo.php';
//数据库配置
$database = new medoo ( [
		'database_type' => 'mysql',
		'database_name' => 'u',
		'server' => 'localhost',
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf8'
] );