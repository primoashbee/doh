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
$year  = 'ALL';
$month = 'ALL';
if(isset($_GET['month'])){
	$month = convertToMonthName($_GET['month']);
}
if(isset($_GET['year'])){
	$year = $_GET['year'];
}

if(isset($_GET['baranggay_id'])){
	$scope = $_GET['baranggay_id'];
	$scope = getBarangay($scope);
}
//GET COLLECTION
$data = qryOutbreak($_GET);
$data_morbidity = getMorbidityReport($_GET);

$data_mortality = getMortalityReport($_GET);
//Get Diseases with records
$ids = getDiseaseCollection();
$ids_morbidity = getDiseaseIDS($data_morbidity); //ids already filtered corresponding to other params
$ids_mortality = getDiseaseIDS($data_mortality); //ids already filtered corresponding to other params


$reports_morbidity  = array();
$reports_mortality  = array();
$ctr = 0;


foreach ($ids as $value) {

	$curr_disease = getDiseaseViaIDNumber($value['id']);
	$ctr++;
	$reports_morbidity[]=array('count'=>$ctr,'name'=>$curr_disease[0]['disease_name'],'id'=>$curr_disease[0]['id']);
}
foreach ($ids as $value) {

	$curr_disease = getDiseaseViaIDNumber($value['id']);
	$ctr++;
	$reports_mortality[]=array('count'=>$ctr,'name'=>$curr_disease[0]['disease_name'],'id'=>$curr_disease[0]['id']);
}


// Code here
$inputFileName = '../templates/MORBIDITY-MORTALITY-temp.xlsx';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load($inputFileName);

$morbidity = $spreadsheet->getSheet(0);
$mortality = $spreadsheet->getSheet(2);
$morbidity->getCell('AD1')->setValue($scope);	
$morbidity->getCell('AD2')->setValue($month);	
$morbidity->getCell('AD3')->setValue($year);	

$mortality->getCell('AD1')->setValue($scope);	
$mortality->getCell('AD2')->setValue($month);	
$mortality->getCell('AD3')->setValue($year);	

$row = 8;
$ctr = 1;

	foreach ($reports_morbidity as $key => $value) {
		
		$morbidity->getCell('A'.$row)->setValue($ctr);
		$morbidity->getCell('B'.$row)->setValue(ucfirst($value['name']));

		$morbidity->getCell('D'.$row)->setValue(getCountOnAgeMorbidity($value['id'],0,1,$_GET)[0]['Male']);// <1 M
		$morbidity->getCell('E'.$row)->setValue(getCountOnAgeMorbidity($value['id'],0,1,$_GET)[0]['Female']);// <1 M

		$morbidity->getCell('F'.$row)->setValue(getCountOnAgeMorbidity($value['id'],1,4,$_GET)[0]['Male']);
		$morbidity->getCell('G'.$row)->setValue(getCountOnAgeMorbidity($value['id'],1,4,$_GET)[0]['Female']);

		$morbidity->getCell('H'.$row)->setValue(getCountOnAgeMorbidity($value['id'],5,9,$_GET)[0]['Male']);
		$morbidity->getCell('I'.$row)->setValue(getCountOnAgeMorbidity($value['id'],5,9,$_GET)[0]['Female']);
		
		$morbidity->getCell('J'.$row)->setValue(getCountOnAgeMorbidity($value['id'],10,14,$_GET)[0]['Male']);
		$morbidity->getCell('K'.$row)->setValue(getCountOnAgeMorbidity($value['id'],10,14,$_GET)[0]['Female']);
	
		$morbidity->getCell('L'.$row)->setValue(getCountOnAgeMorbidity($value['id'],15,19,$_GET)[0]['Male']);
		$morbidity->getCell('M'.$row)->setValue(getCountOnAgeMorbidity($value['id'],15,19,$_GET)[0]['Female']);
		
		$morbidity->getCell('N'.$row)->setValue(getCountOnAgeMorbidity($value['id'],20,24,$_GET)[0]['Male']);
		$morbidity->getCell('O'.$row)->setValue(getCountOnAgeMorbidity($value['id'],20,24,$_GET)[0]['Female']);
		
		$morbidity->getCell('P'.$row)->setValue(getCountOnAgeMorbidity($value['id'],25,29,$_GET)[0]['Male']);
		$morbidity->getCell('Q'.$row)->setValue(getCountOnAgeMorbidity($value['id'],25,29,$_GET)[0]['Female']);
		
		$morbidity->getCell('R'.$row)->setValue(getCountOnAgeMorbidity($value['id'],30,34,$_GET)[0]['Male']);
		$morbidity->getCell('S'.$row)->setValue(getCountOnAgeMorbidity($value['id'],30,34,$_GET)[0]['Female']);
		
		$morbidity->getCell('T'.$row)->setValue(getCountOnAgeMorbidity($value['id'],35,39,$_GET)[0]['Male']);
		$morbidity->getCell('U'.$row)->setValue(getCountOnAgeMorbidity($value['id'],35,39,$_GET)[0]['Female']);
		
		$morbidity->getCell('V'.$row)->setValue(getCountOnAgeMorbidity($value['id'],40,44,$_GET)[0]['Male']);
		$morbidity->getCell('W'.$row)->setValue(getCountOnAgeMorbidity($value['id'],40,44,$_GET)[0]['Female']);
		
		$morbidity->getCell('X'.$row)->setValue(getCountOnAgeMorbidity($value['id'],45,49,$_GET)[0]['Male']);
		$morbidity->getCell('Y'.$row)->setValue(getCountOnAgeMorbidity($value['id'],45,49,$_GET)[0]['Female']);
		
		$morbidity->getCell('Z'.$row)->setValue(getCountOnAgeMorbidity($value['id'],40,54,$_GET)[0]['Male']);
		$morbidity->getCell('AA'.$row)->setValue(getCountOnAgeMorbidity($value['id'],40,54,$_GET)[0]['Female']);
		
		$morbidity->getCell('AB'.$row)->setValue(getCountOnAgeMorbidity($value['id'],55,59,$_GET)[0]['Male']);
		$morbidity->getCell('AC'.$row)->setValue(getCountOnAgeMorbidity($value['id'],55,59,$_GET)[0]['Female']);
		
		$morbidity->getCell('AD'.$row)->setValue(getCountOnAgeMorbidity($value['id'],60,64,$_GET)[0]['Male']);
		$morbidity->getCell('AE'.$row)->setValue(getCountOnAgeMorbidity($value['id'],60,64,$_GET)[0]['Female']);
		
		$morbidity->getCell('AF'.$row)->setValue(getCountOnAgeMorbidity($value['id'],65,10000000,$_GET)[0]['Male']);
		$morbidity->getCell('AG'.$row)->setValue(getCountOnAgeMorbidity($value['id'],65,10000000,$_GET)[0]['Female']);	
		

		$row++;
		$ctr++;
	}

$row = 8;
$ctr = 1;	
$population = getPopulation();
/*echo getCountOnAge(4,20,24,$_GET)[0]['Male'];
return;
*/
	foreach ($reports_mortality as $key => $value) {
		
		$mortality->getCell('A'.$row)->setValue($ctr);
		$mortality->getCell('B'.$row)->setValue(ucfirst($value['name']));

		$mortality->getCell('D'.$row)->setValue(getCountOnAgeMortality($value['id'],0,1,$_GET)[0]['Male']);// <1 M
		$mortality->getCell('E'.$row)->setValue(getCountOnAgeMortality($value['id'],0,1,$_GET)[0]['Female']);// <1 M

		$mortality->getCell('F'.$row)->setValue(getCountOnAgeMortality($value['id'],1,4,$_GET)[0]['Male']);
		$mortality->getCell('G'.$row)->setValue(getCountOnAgeMortality($value['id'],1,4,$_GET)[0]['Female']);

		$mortality->getCell('H'.$row)->setValue(getCountOnAgeMortality($value['id'],5,9,$_GET)[0]['Male']);
		$mortality->getCell('I'.$row)->setValue(getCountOnAgeMortality($value['id'],5,9,$_GET)[0]['Female']);
		
		$mortality->getCell('J'.$row)->setValue(getCountOnAgeMortality($value['id'],10,14,$_GET)[0]['Male']);
		$mortality->getCell('K'.$row)->setValue(getCountOnAgeMortality($value['id'],10,14,$_GET)[0]['Female']);
	
		$mortality->getCell('L'.$row)->setValue(getCountOnAgeMortality($value['id'],15,19,$_GET)[0]['Male']);
		$mortality->getCell('M'.$row)->setValue(getCountOnAgeMortality($value['id'],15,19,$_GET)[0]['Female']);
		
		$mortality->getCell('N'.$row)->setValue(getCountOnAgeMortality($value['id'],20,24,$_GET)[0]['Male']);
		$mortality->getCell('O'.$row)->setValue(getCountOnAgeMortality($value['id'],20,24,$_GET)[0]['Female']);
		
		$mortality->getCell('P'.$row)->setValue(getCountOnAgeMortality($value['id'],25,29,$_GET)[0]['Male']);
		$mortality->getCell('Q'.$row)->setValue(getCountOnAgeMortality($value['id'],25,29,$_GET)[0]['Female']);
		
		$mortality->getCell('R'.$row)->setValue(getCountOnAgeMortality($value['id'],30,34,$_GET)[0]['Male']);
		$mortality->getCell('S'.$row)->setValue(getCountOnAgeMortality($value['id'],30,34,$_GET)[0]['Female']);
		
		$mortality->getCell('T'.$row)->setValue(getCountOnAgeMortality($value['id'],35,39,$_GET)[0]['Male']);
		$mortality->getCell('U'.$row)->setValue(getCountOnAgeMortality($value['id'],35,39,$_GET)[0]['Female']);
		
		$mortality->getCell('V'.$row)->setValue(getCountOnAgeMortality($value['id'],40,44,$_GET)[0]['Male']);
		$mortality->getCell('W'.$row)->setValue(getCountOnAgeMortality($value['id'],40,44,$_GET)[0]['Female']);
		
		$mortality->getCell('X'.$row)->setValue(getCountOnAgeMortality($value['id'],45,49,$_GET)[0]['Male']);
		$mortality->getCell('Y'.$row)->setValue(getCountOnAgeMortality($value['id'],45,49,$_GET)[0]['Female']);
		
		$mortality->getCell('Z'.$row)->setValue(getCountOnAgeMortality($value['id'],40,54,$_GET)[0]['Male']);
		$mortality->getCell('AA'.$row)->setValue(getCountOnAgeMortality($value['id'],40,54,$_GET)[0]['Female']);
		
		$mortality->getCell('AB'.$row)->setValue(getCountOnAgeMortality($value['id'],55,59,$_GET)[0]['Male']);
		$mortality->getCell('AC'.$row)->setValue(getCountOnAgeMortality($value['id'],55,59,$_GET)[0]['Female']);
		
		$mortality->getCell('AD'.$row)->setValue(getCountOnAgeMortality($value['id'],60,64,$_GET)[0]['Male']);
		$mortality->getCell('AE'.$row)->setValue(getCountOnAgeMortality($value['id'],60,64,$_GET)[0]['Female']);
		
		$mortality->getCell('AF'.$row)->setValue(getCountOnAgeMortality($value['id'],65,10000000,$_GET)[0]['Male']);
		$mortality->getCell('AG'.$row)->setValue(getCountOnAgeMortality($value['id'],65,10000000,$_GET)[0]['Female']);	
		

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
    unlink($file) or die("Couldn't delete file");
    exit;
}
?>
