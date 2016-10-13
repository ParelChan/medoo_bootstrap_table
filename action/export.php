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
	$log->debug("导出用户数据列表");
	PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);
	$xls->getProperties()->setCreator("netbuffer");
	$xls->getProperties()->setLastModifiedBy("netbuffer");
// 	$xls->getProperties()->setTitle("用户数据导出export");
// 	$xls->getProperties()->setSubject("用户数据");
// 	$xls->getProperties()->setDescription("用户所有数据导出测试");
// 	$xls->getProperties()->setKeywords("用户 数据 medoo 导出");
// 	$xls->getProperties()->setCategory("用户");
	$xls->setActiveSheetIndex(0);
	$xls->getActiveSheet()->setCellValue('A1', '用户ID');
	$xls->getActiveSheet()->setCellValue('B1', '姓名');
	$xls->getActiveSheet()->setCellValue('C1', '性别');
	$xls->getActiveSheet()->setCellValue('D1', '年龄');
	$xls->getActiveSheet()->setCellValue('E1', '手机号');
	$xls->getActiveSheet()->setCellValue('F1', '收货地址');
	$xls->getActiveSheet()->setCellValue('G1', '添加时间');
// 	$xls->getActiveSheet()->setCellValue('A1', 'ID');
// 	$xls->getActiveSheet()->setCellValue('B1', 'NAME');
// 	$xls->getActiveSheet()->setCellValue('C1', 'SEX');
// 	$xls->getActiveSheet()->setCellValue('D1', 'AGE');
// 	$xls->getActiveSheet()->setCellValue('E1', 'PHONE');
// 	$xls->getActiveSheet()->setCellValue('F1', 'ADDRESS');
// 	$xls->getActiveSheet()->setCellValue('G1', 'TIME');
	//单元格样式
	$objConditional1 = new PHPExcel_Style_Conditional();
	$objConditional1->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS);
	$objConditional1->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_LESSTHAN);
	$objConditional1->addCondition('0');
	$objConditional1->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
	$objConditional1->getStyle()->getFont()->setBold(true);
	
	$objConditional2 = new PHPExcel_Style_Conditional();
	$objConditional2->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS);
	$objConditional2->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_GREATERTHANOREQUAL);
	$objConditional2->addCondition('0');
	$objConditional2->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKBLUE);
	$objConditional2->getStyle()->getFont()->setBold(true);
	foreach (range('A', 'G') as $col){
		$conditionalStyles = $xls->getActiveSheet()->getStyle($col."1")->getConditionalStyles();
// 		array_push($conditionalStyles, $objConditional1);
		array_push($conditionalStyles, $objConditional2);
		$xls->getActiveSheet()->getStyle($col."1")->setConditionalStyles($conditionalStyles);//设置样式
	}
	$xls->getActiveSheet()->freezePane("A2");//冻结第一行 原理http://blog.csdn.net/zhang197093/article/details/50357916
	
	foreach (range('A', 'G') as $col){
		// 		$xls->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
		$xls->getActiveSheet()->getColumnDimension($col)->setWidth(20);
	}
	
	
	
	$datas = $database->select("user","*");
	$d_length=count($datas);
	for($i=0;$i<$d_length;$i++){
		$xls->getActiveSheet()->setCellValue('A'.($i+2), $datas[$i]["id"]);
		$xls->getActiveSheet()->setCellValue('B'.($i+2), $datas[$i]["name"]);
		$xls->getActiveSheet()->setCellValue('C'.($i+2), $datas[$i]["sex"]);
		$xls->getActiveSheet()->setCellValue('D'.($i+2), $datas[$i]["age"]);
		$xls->getActiveSheet()->setCellValue('E'.($i+2), $datas[$i]["phone"]);
		$xls->getActiveSheet()->setCellValue('F'.($i+2), $datas[$i]["deliveryaddress"]);
		$xls->getActiveSheet()->setCellValue('G'.($i+2), date('Y-m-d H:i:s',$datas[$i]["adddate"]));
// 		$xls->getActiveSheet()->getStyle('G'.($i+2))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD);
	}
	
}
ob_end_clean();//清除缓冲区,避免乱码http://www.cnblogs.com/freespider/p/3332550.html
$outputFileName="t.xls";
header ('Pragma:public');
header ('Expires:0');
header ('Cache-Control:must-revalidate,post-check=0,pre-check=0');
header ('Content-Type:application/force-download');
header ('Content-Type:application/vnd.ms-excel');
header ('Content-Type:application/octet-stream');
header ('Content-Type:application/download');
header ('Content-Disposition:attachment;filename='. $outputFileName );
header ('Content-Transfer-Encoding:binary');
// $log->debug("导出xls:".var_export($xls,true));
$objWriter = new PHPExcel_Writer_Excel2007($xls);
// $objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save("php://output");
$log->debug("导出到内存消耗:".(memory_get_peak_usage(true)/1024/1024)."mb");
// unset($xls);