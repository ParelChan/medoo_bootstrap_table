<?php
if(!defined('IN_SYS')) {
	exit('deny');
}
# https://github.com/PHPOffice/PHPExcel/wiki/User%20Documentation
require_once 'lib/PHPExcel/PHPExcel.php';
require_once 'lib/class.util.php';
$log->debug("导出到excel");
$xls = new PHPExcel();
$e=Util::filter_input($_GET["e"]);
if($e==="test"){
	//Set properties 设置文件属性
	$xls->getProperties()->setCreator("netbuffer");
	$xls->getProperties()->setLastModifiedBy("netbuffer");
	$xls->getProperties()->setTitle("Office 2007 XLSX Test Document");
	$xls->getProperties()->setSubject("Office 2007 XLSX Test Document sub");
	$xls->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");
	$xls->getProperties()->setKeywords("office 2007 openxml php");
	$xls->getProperties()->setCategory("Test result file");
	$xls->setActiveSheetIndex(0);
	$xls->getActiveSheet()->setCellValue('A1', 'Hello');//可以指定位置
	$xls->getActiveSheet()->setCellValue('A2', true);
	$xls->getActiveSheet()->setCellValue('A3', false);
	$xls->getActiveSheet()->setCellValue('B2', 'world!');
	$xls->getActiveSheet()->setCellValue('B3', 2);
	$xls->getActiveSheet()->setCellValue('C1', 'Hello');
	$xls->getActiveSheet()->setCellValue('D2', 'world!');
	for($i = 1;$i<100;$i++) {
		$xls->getActiveSheet()->setCellValue('A' . $i, $i);
		$xls->getActiveSheet()->setCellValue('B' . $i, 'Test value');
	}
	//日期格式化
	$xls->getActiveSheet()->setCellValue('D1', time());
	// PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH
	$xls->getActiveSheet()->getStyle('D1')->getNumberFormat()->setFormatCode("Y-m-d hh:mm:ss");
	$objWriter = new PHPExcel_Writer_Excel2007($xls);
	$objWriter->save("demo.xlsx");
}else if($e==="user"){
	$xls->getProperties()->setCreator("netbuffer");
	$xls->getProperties()->setLastModifiedBy("netbuffer");
	$xls->getProperties()->setTitle("用户数据导出");
	$xls->getProperties()->setSubject("用户数据");
	$xls->getProperties()->setDescription("用户所有数据导出测试");
	$xls->getProperties()->setKeywords("用户 数据 medoo 导出");
	$xls->getProperties()->setCategory("用户");
	$xls->setActiveSheetIndex(0);
	$xls->getActiveSheet()->setCellValue('A1', '用户ID');
	$xls->getActiveSheet()->setCellValue('B1', '姓名');
	$xls->getActiveSheet()->setCellValue('C1', '性别');
	$xls->getActiveSheet()->setCellValue('D1', '年龄');
	$xls->getActiveSheet()->setCellValue('E1', '手机号');
	$xls->getActiveSheet()->setCellValue('F1', '收货地址');
	$xls->getActiveSheet()->setCellValue('G1', '添加时间');
	$datas = $database->select("user","*");
	$d_length=count($datas);
	for($i=0;$i<$d_length;$i++){
		$xls->getActiveSheet()->setCellValue('A'.($i+1), $datas[$i]["id"]);
		$xls->getActiveSheet()->setCellValue('B'.($i+1), $datas[$i]["name"]);
		$xls->getActiveSheet()->setCellValue('C'.($i+1), $datas[$i]["sex"]);
		$xls->getActiveSheet()->setCellValue('D'.($i+1), $datas[$i]["age"]);
		$xls->getActiveSheet()->setCellValue('E'.($i+1), $datas[$i]["phone"]);
		$xls->getActiveSheet()->setCellValue('F'.($i+1), $datas[$i]["phone"]);
		$xls->getActiveSheet()->setCellValue('G'.($i+1), $datas[$i]["phone"]);
	}
}
header("Content-Type:application/vnd.ms-excel");
header("Content-Disposition:attachment;filename=t.xlsx");
header("Pragma:no-cache");
header("Expires:0");
$log->debug("导出到内存消耗:".(memory_get_peak_usage(true)/1024/1024)."mb");
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save("php://output");
// unset($xls);