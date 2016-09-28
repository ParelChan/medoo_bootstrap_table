<?php
/**
 * test class
 * @author netbuffer
 */
class Action{

	private $config=array(
			"host"=>"127.0.0.1",
			"db"=>"user"
	);

	static $info=array(
			"host"=>"127.0.0.1",
			"db"=>"user"
	);

	/**
	 * 构造方法传递配置信息
	 * @param array $config
	 */
	function __construct($config) {
		$this->config=$config;
	}

	/**
	 * 获取配置信息
	 */
	public function getConfig(){
		return $this->config;
	}

	/**
	 * 静态方法获取信息
	 */
	public static function getInfo(){
		return Action::$info;
	}
}