<?php
// We'll be outputting an excel file
// It will be called file.xls
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
date_default_timezone_set('Asia/Manila');
$date = date('m-d-Y(h-i-s-A)', time());


// Code here
$inputFileName = '../templates/MORBIDITY-MORTALITY.xls';

/** Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$sheet->setCellValue('A1', 'Hello World !');
$file ='Report-'.$date.'.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($file);

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>

<a href="Report.xlsx"> Download Report </a>