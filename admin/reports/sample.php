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
?>
<table style="width:100%">
  <thead>
    <th>#</th>
    <th>Disease</th>
    <th>CODE</th> 
    <th>Under1</th>
    <th colspan="2">1-5</th>
  </thead>
  <tbody>
<?php 
	foreach ($reports as $key => $value) {
		echo '<tr >';
			echo '<td style="text-align:center">'.$value['count'].'</td>';
			echo '<td style="text-align:center">'.$value['id'].'</td>';
			echo '<td style="text-align:center" >'.$value['name'].'</td>';
			echo '<td style="text-align:center">'.rand(1,1000).'</td>';
			foreach ($value['age_range'] as $k => $v) {
				
				echo '<td style="text-align:center">'.$v['under'][0]['Female'].'</td>';
				echo '<td style="text-align:center">'.$v['under'][0]['Male'].'</td>';
			
			}
		echo '</tr>';	
	}
?>

  
  </tbody>
</table>

<?php
// Code here
$inputFileName = '../templates/MORBIDITY-MORTALITY.xlsx';
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load($inputFileName);

$morbidity = $spreadsheet->getSheet(0);
$morbidity->getCell('A9')->getValue();

$morbidity->getCell('AB2')->setValue($scope);

return false;

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
