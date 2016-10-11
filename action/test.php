<?php
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