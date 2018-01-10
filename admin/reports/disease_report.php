<?php
// We'll be outputting an excel file
// It will be called file.xls
require '../../vendor/autoload.php';
require '../../config.php';
require '../../functions.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
date_default_timezone_set('Asia/Manila');
$date = date('m-d-Y(h-i-s-A)', time());
	$scope = 'ALL';
if(isset($_GET['baranggay_id'])){
	$scope = $_GET['baranggay_id'];
}

//GET COLLECTION
$data = qryOutbreak($_GET);
//Get Diseases with records
$ids = getDiseaseIDS($data); //ids already filtered corresponding to other params


$reports  = array();
$ctr = 0;
foreach ($ids as $value) {

	$curr_disease = getDiseaseViaIDNumber($value);
	$ctr++;
	$reports[]=array('count'=>$ctr,'name'=>$curr_disease[0]['disease_name'],'age_range'=>summarizeAgeRangePerDisease($value),'id'=>$curr_disease[0]['id']);
}

// Code here
$inputFileName = '../templates/MORBIDITY-MORTALITY-temp.xlsx';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load($inputFileName);

$morbidity = $spreadsheet->getSheet(0);
$morbidity->getCell('AB2')->setValue($scope);	

$row = 8;
$ctr = 1;
//start on A8
	foreach ($reports as $key => $value) {
		
		$morbidity->getCell('A'.$row)->setValue($ctr);
		$morbidity->getCell('B'.$row)->setValue(ucfirst($value['name']));

		$morbidity->getCell('D'.$row)->setValue(getCountOnAge($value['id'],0,1)[0]['Male']);// <1 M
		$morbidity->getCell('E'.$row)->setValue(getCountOnAge($value['id'],0,1)[0]['Female']);// <1 M

		$morbidity->getCell('F'.$row)->setValue(getCountOnAge($value['id'],1,4)[0]['Male']);
		$morbidity->getCell('G'.$row)->setValue(getCountOnAge($value['id'],1,4)[0]['Female']);

		$morbidity->getCell('H'.$row)->setValue(getCountOnAge($value['id'],5,9)[0]['Male']);
		$morbidity->getCell('I'.$row)->setValue(getCountOnAge($value['id'],5,9)[0]['Female']);
		
		$morbidity->getCell('J'.$row)->setValue(getCountOnAge($value['id'],10,14)[0]['Male']);
		$morbidity->getCell('K'.$row)->setValue(getCountOnAge($value['id'],10,14)[0]['Female']);
	
		$morbidity->getCell('L'.$row)->setValue(getCountOnAge($value['id'],15,19)[0]['Male']);
		$morbidity->getCell('M'.$row)->setValue(getCountOnAge($value['id'],15,19)[0]['Female']);
		
		$morbidity->getCell('N'.$row)->setValue(getCountOnAge($value['id'],20,24)[0]['Male']);
		$morbidity->getCell('O'.$row)->setValue(getCountOnAge($value['id'],20,24)[0]['Female']);
		
		$morbidity->getCell('P'.$row)->setValue(getCountOnAge($value['id'],25,29)[0]['Male']);
		$morbidity->getCell('Q'.$row)->setValue(getCountOnAge($value['id'],25,29)[0]['Female']);
		
		$morbidity->getCell('R'.$row)->setValue(getCountOnAge($value['id'],30,34)[0]['Male']);
		$morbidity->getCell('S'.$row)->setValue(getCountOnAge($value['id'],30,34)[0]['Female']);
		
		$morbidity->getCell('T'.$row)->setValue(getCountOnAge($value['id'],35,39)[0]['Male']);
		$morbidity->getCell('U'.$row)->setValue(getCountOnAge($value['id'],35,39)[0]['Female']);
		
		$morbidity->getCell('V'.$row)->setValue(getCountOnAge($value['id'],40,44)[0]['Male']);
		$morbidity->getCell('W'.$row)->setValue(getCountOnAge($value['id'],40,44)[0]['Female']);
		
		$morbidity->getCell('X'.$row)->setValue(getCountOnAge($value['id'],45,49)[0]['Male']);
		$morbidity->getCell('Y'.$row)->setValue(getCountOnAge($value['id'],45,49)[0]['Female']);
		
		$morbidity->getCell('Z'.$row)->setValue(getCountOnAge($value['id'],40,54)[0]['Male']);
		$morbidity->getCell('AA'.$row)->setValue(getCountOnAge($value['id'],40,54)[0]['Female']);
		
		$morbidity->getCell('AB'.$row)->setValue(getCountOnAge($value['id'],55,59)[0]['Male']);
		$morbidity->getCell('AC'.$row)->setValue(getCountOnAge($value['id'],55,59)[0]['Female']);
		
		$morbidity->getCell('AD'.$row)->setValue(getCountOnAge($value['id'],60,64)[0]['Male']);
		$morbidity->getCell('AE'.$row)->setValue(getCountOnAge($value['id'],60,64)[0]['Female']);
		
		$morbidity->getCell('AF'.$row)->setValue(getCountOnAge($value['id'],65,10000000)[0]['Male']);
		$morbidity->getCell('AG'.$row)->setValue(getCountOnAge($value['id'],65,10000000)[0]['Female']);	
		

		$row++;
		$ctr++;
	}

$file ='../reports/Report-'.$date.'.xlsx';
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
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
