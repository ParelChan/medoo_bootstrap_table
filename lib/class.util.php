<?php
class Util{
	static $COLOR=array(
			0=>"red",
			0=>"green",
			0=>"blue"
	);
	/**
	 * 过滤表单的非法字符
	 * @param unknown $data
	 */
	public static function filter_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		echo "f:$data";
		return $data;
	}
}