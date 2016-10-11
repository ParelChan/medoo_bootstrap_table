<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
require_once 'lib/class.util.php';
echo "IN_SYS:".IN_SYS;
# 与变量不同，常量贯穿整个脚本是自动全局的。
$a=1;
$b=2;
function test(){
	//无法拿到全局的变量，这里会出错
	echo $a+$b;
}
function test1(){
	//访问全局变量
	global $a,$b;
	echo $a+$b;
}
function test2(){
	//访问全局变量方式
	echo $GLOBALS["a"]+$GLOBALS["b"];
}
test();
echo "<br/>";
test1();
echo "<br/>";
test2();
function c($param=1) {
	return $param;
}
echo "<br/>c()->".c();
echo "<br/>c(123)->".c(123);

$age=array("Bill"=>"35","Steve"=>"37","Peter"=>"43");
foreach($age as $x=>$x_value) {
	echo "Key=" . $x . ", Value=" . $x_value;
	echo "<br>";
}
// <script>location.href="http://www.baidu.com";</script>
echo "<pre style='color:green;'>";
echo "param:".$_REQUEST["param"]."<br/>";
echo "filter param:".Util::filter_input($_REQUEST["param"]);
$log->debug("未过滤用户输入,param:".$_REQUEST["param"]);
$log->debug("过滤用户输入,param:".Util::filter_input($_REQUEST["param"]));
echo "</pre>";