<?php
namespace Home\Controller;
use Think\Controller;
class PrinteController extends Controller{
	public function _initialize() {
        vendor('PHPexcel.PHPExcel'); 
		vendor('PHPexcel/PHPExcel/Writer.Excel2007'); 
	}
	
	public function exlse(){
		$objExcel=new \PHPExcel(); 
		$objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
		$objProps = $objExcel->getProperties ();
		$objProps->setCreator ('felix');
		$objProps->setLastModifiedBy("felix");

//描述

$objProps->setDescription("预约导出");

//设置标题

$objProps->setTitle (date()+'预约列表');

//设置题目

$objProps->setSubject("预约列表");

//设置关键字

$objProps->setKeywords ( '预约列表' );

//设置分类

$objProps->setCategory ( "预约列表");

//工作表设置

$objExcel->setActiveSheetIndex( 0 );

$objActSheet = $objExcel->getActiveSheet ();

//单元格赋值   例：

$objActSheet->setCellValue ( 'A1', '编号');

$objActSheet->setCellValue ( 'B1', '留言人');

$objActSheet->setCellValue ( 'C1', '联系电话');

$objActSheet->setCellValue ( 'D1', '来源IP');
		
$objActSheet->setCellValue ( 'E1', '地区');
$objActSheet->setCellValue ( 'F1', '创建时间');		
$objActSheet->setCellValue ( 'G1', '留言内容');
$objActSheet->setCellValue ( 'H1', '来源页面');	
$objActSheet->setCellValue ( 'I1', '新预约');

//自动设置单元格宽度   例：

$objActSheet->getColumnDimension('A')->setAutoSize(true);

//手动设置单元格的宽度   例：

//$objActSheet->getColumnDimension('A')->setWidth(10);

//导出的文件名

$outputFileName = iconv ( 'UTF-8', 'gb2312', date("YmdHi"). '预约列表' . '.xlsx' );

//直接导出文件

$objWriter->save ( $outputFileName );
		
//其他设置：

//显式指定内容类型  

$objActSheet->setCellValueExplicit('A5','847475847857487584',PHPExcel_Cell_DataType::TYPE_STRING);  

//合并单元格  

$objActSheet->mergeCells('B1:C22');  

//分离单元格  

$objActSheet->unmergeCells('B1:C22');

//得到单元格的样式

$objStyleA5 = $objActSheet->getStyle('A5');

//设置字体  

$objFontA5 = $objStyleA5->getFont();  

$objFontA5->setName('Courier New');  

$objFontA5->setSize(10);  

$objFontA5->setBold(true);  

$objFontA5->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);  

$objFontA5->getColor()->setARGB('FF999999');  

//设置对齐方式

$objAlignA5 = $objStyleA5->getAlignment();  

$objAlignA5->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);  

$objAlignA5->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

//设置边框  

$objBorderA5 = $objStyleA5->getBorders();  

$objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

$objBorderA5->getTop()->getColor()->setARGB('FFFF0000');// color  

$objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

$objBorderA5->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

$objBorderA5->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);  

//设置填充颜色  

$objFillA5 = $objStyleA5->getFill();  

$objFillA5->setFillType(PHPExcel_Style_Fill::FILL_SOLID);  

$objFillA5->getStartColor()->setARGB('FFEEEEEE');  

//从指定的单元格复制样式信息.  

$objActSheet->duplicateStyle($objStyleA5,'B1:C22');  

//*************************************  

//添加图片  

$objDrawing = new \PHPExcel_Worksheet_Drawing();  

$objDrawing->setName('ZealImg');  

$objDrawing->setDescription('Image inserted byZeal');  

$objDrawing->setPath('./zeali.net.logo.gif');  

$objDrawing->setHeight(36);  

$objDrawing->setCoordinates('C23');  

$objDrawing->setOffsetX(10);  

$objDrawing->setRotation(15);  

$objDrawing->getShadow()->setVisible(true);  

$objDrawing->getShadow()->setDirection(36);  

$objDrawing->setWorksheet($objActSheet);  

//添加一个新的worksheet  

$objExcel->createSheet();  

$objExcel->getSheet(1)->setTitle('测试2');  

//保护单元格  

$objExcel->getSheet(1)->getProtection()->setSheet(true);  

$objExcel->getSheet(1)->protectCells('A1:C22','PHPExcel');
//文件直接输出到浏览器

header ( 'Pragma:public');

header ( 'Expires:0');

header ( 'Cache-Control:must-revalidate,post-check=0,pre-check=0');

header ( 'Content-Type:application/force-download');

header ( 'Content-Type:application/vnd.ms-excel');

header ( 'Content-Type:application/octet-stream');

header ( 'Content-Type:application/download');

header ( 'Content-Disposition:attachment;filename='. $outputFileName );

header ( 'Content-Transfer-Encoding:binary');

$objWriter->save ( 'php://output');
die;


	}
}