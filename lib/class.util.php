<?php
class Util{
	
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