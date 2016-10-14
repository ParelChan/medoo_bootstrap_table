<?php
if (! defined ( 'IN_SYS' )) {
	exit ( 'deny' );
}
header("context-type:text/html;charset=UTF-8");
require_once 'lib/class.util.php';
echo "IN_SYS:" . IN_SYS;
// 与变量不同，常量贯穿整个脚本是自动全局的。
$a = 1;
$b = 2;
function test() {
	// 无法拿到全局的变量，这里会出错
	echo $a + $b;
}
function test1() {
	// 访问全局变量
	global $a, $b;
	echo $a + $b;
}
function test2() {
	// 访问全局变量方式
	echo $GLOBALS ["a"] + $GLOBALS ["b"];
}
test ();
echo "<br/>";
test1 ();
echo "<br/>";
test2 ();
function c($param = 1) {
	return $param;
}
echo "<br/>c()->" . c ();
echo "<br/>c(123)->" . c ( 123 );

$age = array (
		"Bill" => "35",
		"Steve" => "37",
		"Peter" => "43"
);
foreach ( $age as $x => $x_value ) {
	echo "Key=" . $x . ", Value=" . $x_value;
	echo "<br>";
}
// <script>location.href="http://www.baidu.com";</script>
echo "<pre style='color:green;'>";
echo "param:" . $_REQUEST ["param"] . "<br/>";
echo "filter param:" . Util::filter_input ( $_REQUEST ["param"] );
$log->debug ( "未过滤用户输入,param:" . $_REQUEST ["param"] );
$log->debug ( "过滤用户输入,param:" . Util::filter_input ( $_REQUEST ["param"] ) );
echo "</pre>";
// http://www.jb51.net/article/43134.htm
/**
 * 总结PHP中，"NULL" 和 "空" 是2个概念。
 * isset 主要用来判断变量是否被初始化过
 * empty 可以将值为 "假"、"空"、"0"、"NULL"、"未初始化" 的变量都判断为TRUE
 * is_null 仅把值为 "NULL" 的变量判断为TRUE
 * var == null 把值为 "假"、"空"、"0"、"NULL" 的变量都判断为TRUE
 * var === null 仅把值为 "NULL" 的变量判断为TRUE
 * 所以我们在判断一个变量是否真正为"NULL"时，大多使用 is_null，从而避免"false"、"0"等值的干扰。
 */

echo "mask input:".strreplacemask($_GET['string'],$_GET['mask'])."<br/>";
echo "mask input2:".strreplacemask("中文",$_GET['mask']);
$log->debug("mask input2：".strreplacemask("中文",$_GET['mask']));
$log->debug("abc strlen长度：".strlen("abc"));
$log->debug("abc mb_strlen长度：".mb_strlen("abc","utf8"));
$log->debug("strlen中文abc长度：".strlen("中文abc"));
$log->debug("mb_strlen中文abc长度：".mb_strlen("中文abc","utf8"));
$log->debug("截取：".mb_substr("这里a没有乱码！",0,3,"utf-8"));
function strreplacemask($string, $mask) {
	global $log;
	$length=mb_strlen($string,"utf8");
	if(empty($string)||$length==0){
		return "";
	}
	$log->debug("$string 长度：".$length);
	switch ($length){
		case 1:
			$masknum=0;
			$sstring=$string;
			$estring="";
			break;
		case 2:
			$masknum=1;
			$sstring="";
			$estring= mb_substr($string,1,1,"utf-8");
			break;
		default:
			$masknum=$length-2;
			$sstring=mb_substr($string, 0,1,"utf-8");
			$estring=mb_substr($string, $length-1,$length,"utf-8");
	}
	return $sstring.str_repeat($mask,$masknum).$estring;
}
$list=array(0=>array("nick"=>"test"),1=>array("nick"=>"test2"),2=>array("nick"=>"test3"),3=>array("nick"=>"test4"));
foreach ( $list as $key => $val ) {
	echo "<br/>nick1:".$val["nick"]."<br/>";
	#这样赋值不会改变原数组的
	$val["nick"]="n1";
	#重新赋值
	$list[$key]["nick"]="n";
	echo "nick2:".$list[$key]["nick"]."<br/>";
}
echo "<br/>list:".var_export($list,true)."<br/>";