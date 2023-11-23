<?php

include 'koneksi.php';
require_once 'plugins/PHPExcel3/PHPExcel.php';

//Setingan awal file excel

$excel->getProperties()->setCreator('Absensi Siswa')
					   ->setLastModifiedBy('Fajar Dev')
					   ->setTitle("Laporan Siswa")
					   ->setSubject("Siswa")
					   ->setDescription("Laporan Siswa")
					   ->setKeywords("siswa");
//header
$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO");
$excel->setActiveSheetIndex(0)->setCellValue('B1', "Nama Siswa");
$excel->setActiveSheetIndex(0)->setCellValue('C1', "NIS");
$excel->setActiveSheetIndex(0)->setCellValue('D1', "KELAS");
$excel->setActiveSheetIndex(0)->setCellValue('E1', "ALAMAT");

$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);

//end header

//body
$no = 1;
$numrow = 2;
$sql = mysqli_query("SELECT * FROM");
$excel->setActiveSheetIndex(0)->setCellValue('A1', "NO");
?>