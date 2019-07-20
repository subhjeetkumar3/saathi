<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define("GOOGLE_API_KEY", "AIzaSyAxPmMr__6hq0_g-IPlEpccHOwyeKQWta4");

class Userexcelupload extends CI_Controller {
   function __construct() {
		parent::__construct();
        $this->load->model('role/rolemaster');  
      date_default_timezone_set("Asia/Kolkata");
      ini_set('memory_limit','200M');
        
    }
  
  public function index()
  {
  	echo "jkhjughhjgfh";
  }


  public function testExcel()
  {

  }


 public function download()
 {

		$table = $this->uri->segment(3);

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$rs = $this->db->get($table);

		  $array = $rs->result_array();

		$header = $array[0];  

		//print_r($rs->result_array());

		//echo "<br>/";

		$registeredBy = "CRP, SPC, SPO, Volunteer";

        $modeOfContact = "Online, Offline- One to One, Offline-Camps-CBS events";

        $gender = "Male, Female, TG";

 $educationalLevel = "Pre-Literate,Primary,Secondary,Higher Secondary,Graduation and Above,Non formal education";

      //echo "<br>";  
		
		$occupation = "Salaried,Self employed,Daily wage,Student,Sex Work,Badhai,Mangt,Dancing,Truckers,Migrant,Drivers,Other";

		$hrgNew = "MSM,TG_M-F,FSW,IDU";


		$stateArr = $this->rolemaster->stateList();

		$districtArr = $this->rolemaster->districtList();

		//$statescols = array_column($stateArr, 'stateName') ;

		$j = 1;

		$k = 1;
		$p=500;			//variable used to place the state start from 501 
		$q=500;

		foreach ($stateArr as $key => $value) {
			//print_r($value);exit();
		
			//echo 'BM'.($p+1).'=>'.$value;
 	   $this->excel->getActiveSheet()
        ->setCellValue('BM'.($p+1), $value['stateName']);
        	$p++;
			$j++;
		}
		//exit();


		foreach ($districtArr as $key1 => $value1) {

 	   $this->excel->getActiveSheet()
        ->setCellValue('BO' .($q+1), $value1['districtName']);
        	$q++;
			$k++;
		}
		$p++;
		$s=$p;
		$t=$q;
		$b = $j;

		$c = $k;



		//$argNew = "Single Male migrant,Trucker,Partner / Spouse of FSW,Have multiple partners,Female partner,Female Partner,TG_F-M";
		
		/*$argNew = "Single Male migrant,Trucker,Partner / Spouse of FSW,Have multiple partners,Female partner,Female Partner,TG_F-M";*/

		$argNew = "Single Male migrant,Trucker,Partner / Spouse of FSW,Have multiple partners,Female Partner-ARG,Female Partner-HRG,TG_F-M";

		$monthlyIncome = "> 1000 , 1001-5000, 5001-10000, Above 10000";

		$maritalStatus = "Married, Unmarried, Divcored, Widow/Widower, Separated, Other";

		$referralPoint = "Construction Site, Youth Club, Hotspot, Truckers Point , Others";

		$answer = "Yes, No";

		$prefferedSexualAct = "Oral,Anal,Vaginal";

		$condomUsage = "In every sex ,In paid sex, Sometime, Never,Not aware";

		$substanceUse = "Tobacco,Drug,Alcohol";

		$status = "Reactive, Not-reactive";

		$reportStatus = "Received by Community, Migrated, Non Acceptance, Died";

		$otherService = "Positive living counselling, ART adherence counselling, Linkage to Social protection, Other services";

		$clientStatus = "New Detection, Known Positive, LFU";


			//for($m=1;$m<=)






		  for ($m=1; $m <= 40 ; $m++) { 


        $this->excel->getActiveSheet()->setCellValue('A2',date('d/m/Y'));

		$this->excel->getActiveSheet()->setCellValue('B2','HR/FD/0001');



	  $objValidationNewVar1 = $this->excel->getActiveSheet()->getCell('W'.$m)->getDataValidation();
		$objValidationNewVar1->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidationNewVar1->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidationNewVar1->setAllowBlank(false);
		$objValidationNewVar1->setShowInputMessage(true);
		$objValidationNewVar1->setShowErrorMessage(true);
		$objValidationNewVar1->setShowDropDown(true);
		$objValidationNewVar1->setErrorTitle('Input error');
		$objValidationNewVar1->setError('Value is not in list.');
		$objValidationNewVar1->setPromptTitle('Pick from list');
		$objValidationNewVar1->setPrompt('Please pick a value from the drop-down list.');
		
		
		$objValidationNewVar1->setFormula1('$BM$501:$BM$'.($p-1));


  //      $objValidationNewVar1 = $this->excel->getActiveSheet()->getCell('X'.$m)->getDataValidation();
		// $objValidationNewVar1->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		// $objValidationNewVar1->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		// $objValidationNewVar1->setAllowBlank(false);
		// $objValidationNewVar1->setShowInputMessage(true);
		// $objValidationNewVar1->setShowErrorMessage(true);
		// $objValidationNewVar1->setShowDropDown(true);
		// $objValidationNewVar1->setErrorTitle('Input error');
		// $objValidationNewVar1->setError('Value is not in list.');
		// $objValidationNewVar1->setPromptTitle('Pick from list');
		// $objValidationNewVar1->setPrompt('Please pick a value from the drop-down list.');
		
		
		// $objValidationNewVar1->setFormula1('$BO$1:$BO$'.($c-1));


		  $objValidationNewVar1 = $this->excel->getActiveSheet()->getCell('Y'.$m)->getDataValidation();
		$objValidationNewVar1->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidationNewVar1->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidationNewVar1->setAllowBlank(false);
		$objValidationNewVar1->setShowInputMessage(true);
		$objValidationNewVar1->setShowErrorMessage(true);
		$objValidationNewVar1->setShowDropDown(true);
		$objValidationNewVar1->setErrorTitle('Input error');
		$objValidationNewVar1->setError('Value is not in list.');
		$objValidationNewVar1->setPromptTitle('Pick from list');
		$objValidationNewVar1->setPrompt('Please pick a value from the drop-down list.');
		
		
		$objValidationNewVar1->setFormula1('$BM$501:$BM$'.($P-1));

/*
       $objValidationNewVar1 = $this->excel->getActiveSheet()->getCell('Z'.$m)->getDataValidation();
		$objValidationNewVar1->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidationNewVar1->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidationNewVar1->setAllowBlank(false);
		$objValidationNewVar1->setShowInputMessage(true);
		$objValidationNewVar1->setShowErrorMessage(true);
		$objValidationNewVar1->setShowDropDown(true);
		$objValidationNewVar1->setErrorTitle('Input error');
		$objValidationNewVar1->setError('Value is not in list.');
		$objValidationNewVar1->setPromptTitle('Pick from list');
		$objValidationNewVar1->setPrompt('Please pick a value from the drop-down list.');
		
		
		$objValidationNewVar1->setFormula1('$BO$1:$BO$'.($c-1));*/

    
	


   
		$objValidation = $this->excel->getActiveSheet()->getCell('C'.$m)->getDataValidation();
		$objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation->setAllowBlank(false);
		$objValidation->setShowInputMessage(true);
		$objValidation->setShowErrorMessage(true);
		$objValidation->setShowDropDown(true);
		$objValidation->setErrorTitle('Input error');
		$objValidation->setError('Value is not in list.');
		$objValidation->setPromptTitle('Pick from list');
		$objValidation->setPrompt('Please pick a value from the drop-down list.');
		$objValidation->setFormula1('"'.$registeredBy.'"');

	    $this->excel->getActiveSheet()->setCellValue('D2','B1HRFD0001');




     $objValidation1 = $this->excel->getActiveSheet()->getCell('E'.$m)->getDataValidation();
		$objValidation1->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation1->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation1->setAllowBlank(false);
		$objValidation1->setShowInputMessage(true);
		$objValidation1->setShowErrorMessage(true);
		$objValidation1->setShowDropDown(true);
		$objValidation1->setErrorTitle('Input error');
		$objValidation1->setError('Value is not in list.');
		$objValidation1->setPromptTitle('Pick from list');
		$objValidation1->setPrompt('Please pick a value from the drop-down list.');
		$objValidation1->setFormula1('"'.$modeOfContact.'"');



   $this->excel->getActiveSheet()->setCellValue('F2','Test Name');

   $this->excel->getActiveSheet()->setCellValue('H2','01/01/1990');

   $this->excel->getActiveSheet()->setCellValue('I2','27');

   // $this->excel->getActiveSheet()->setCellValue('N'.$m,'Select HRG');

$objValidation5 = $this->excel->getActiveSheet()->getCell('N'.$m)->getDataValidation();
		$objValidation5->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation5->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation5->setAllowBlank(false);
		$objValidation5->setShowInputMessage(true);
		$objValidation5->setShowErrorMessage(true);
		$objValidation5->setShowDropDown(true);
		$objValidation5->setErrorTitle('Input error');
		$objValidation5->setError('Value is not in list.');
		$objValidation5->setPromptTitle('Pick from list');
		$objValidation5->setPrompt('Please pick a value  from the drop-down list.');
		$objValidation5->setFormula1('"'.$hrgNew.'"');		

$objValidation6 = $this->excel->getActiveSheet()->getCell('O'.$m)->getDataValidation();
		$objValidation6->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation6->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation6->setAllowBlank(false);
		$objValidation6->setShowInputMessage(true);
		$objValidation6->setShowErrorMessage(true);
		$objValidation6->setShowDropDown(true);
		$objValidation6->setErrorTitle('Input error');
		$objValidation6->setError('Value is not in list.');
		$objValidation6->setPromptTitle('Pick from list');
		$objValidation6->setPrompt('Please pick a value xdfgdfgfrom the drop-down list.');
		$objValidation6->setFormula1('"'.$argNew.'"');		




   $objValidation2 = $this->excel->getActiveSheet()->getCell('J'.$m)->getDataValidation();
		$objValidation2->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation2->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation2->setAllowBlank(false);
		$objValidation2->setShowInputMessage(true);
		$objValidation2->setShowErrorMessage(true);
		$objValidation2->setShowDropDown(true);
		$objValidation2->setErrorTitle('Input error');
		$objValidation2->setError('Value is not in list.');
		$objValidation2->setPromptTitle('Pick from list');
		$objValidation2->setPrompt('Please pick a value from the drop-down list.');
		$objValidation2->setFormula1('"'.$gender.'"');

 $objValidation3 = $this->excel->getActiveSheet()->getCell('K'.$m)->getDataValidation();
		$objValidation3->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation3->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation3->setAllowBlank(false);
		$objValidation3->setShowInputMessage(true);
		$objValidation3->setShowErrorMessage(true);
		$objValidation3->setShowDropDown(true);
		$objValidation3->setErrorTitle('Input error');
		$objValidation3->setError('Value is not in list.');
		$objValidation3->setPromptTitle('Pick from list');
		$objValidation3->setPrompt('Please pick a value from the drop-down list.');
		$objValidation3->setFormula1('"'.$educationalLevel.'"');	

$objValidation4 = $this->excel->getActiveSheet()->getCell('L'.$m)->getDataValidation();
		$objValidation4->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation4->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation4->setAllowBlank(false);
		$objValidation4->setShowInputMessage(true);
		$objValidation4->setShowErrorMessage(true);
		$objValidation4->setShowDropDown(true);
		$objValidation4->setErrorTitle('Input error');
		$objValidation4->setError('Value is not in list.');
		$objValidation4->setPromptTitle('Pick from list');
		$objValidation4->setPrompt('Please pick a value from the drop-down list.');
		$objValidation4->setFormula1('"'.$occupation.'"');	




$objValidation7 = $this->excel->getActiveSheet()->getCell('P'.$m)->getDataValidation();
		$objValidation7->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation7->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation7->setAllowBlank(false);
		$objValidation7->setShowInputMessage(true);
		$objValidation7->setShowErrorMessage(true);
		$objValidation7->setShowDropDown(true);
		$objValidation7->setErrorTitle('Input error');
		$objValidation7->setError('Value is not in list.');
		$objValidation7->setPromptTitle('Pick from list');
		$objValidation7->setPrompt('Please pick a value from the drop-down list.');
		$objValidation7->setFormula1('"'.$monthlyIncome.'"');	
		

$objValidation8 = $this->excel->getActiveSheet()->getCell('Q'.$m)->getDataValidation();
		$objValidation8->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation8->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation8->setAllowBlank(false);
		$objValidation8->setShowInputMessage(true);
		$objValidation8->setShowErrorMessage(true);
		$objValidation8->setShowDropDown(true);
		$objValidation8->setErrorTitle('Input error');
		$objValidation8->setError('Value is not in list.');
		$objValidation8->setPromptTitle('Pick from list');
		$objValidation8->setPrompt('Please pick a value from the drop-down list.');
		$objValidation8->setFormula1('"'.$maritalStatus.'"');	

$objValidation9 = $this->excel->getActiveSheet()->getCell('AB'.$m)->getDataValidation();
		$objValidation9->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation9->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation9->setAllowBlank(false);
		$objValidation9->setShowInputMessage(true);
		$objValidation9->setShowErrorMessage(true);
		$objValidation9->setShowDropDown(true);
		$objValidation9->setErrorTitle('Input error');
		$objValidation9->setError('Value is not in list.');
		$objValidation9->setPromptTitle('Pick from list');
		$objValidation9->setPrompt('Please pick a value from the drop-down list.');
		$objValidation9->setFormula1('"'.$referralPoint.'"');	


$objValidation10 = $this->excel->getActiveSheet()->getCell('AD'.$m)->getDataValidation();
		$objValidation10->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation10->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation10->setAllowBlank(false);
		$objValidation10->setShowInputMessage(true);
		$objValidation10->setShowErrorMessage(true);
		$objValidation10->setShowDropDown(true);
		$objValidation10->setErrorTitle('Input error');
		$objValidation10->setError('Value is not in list.');
		$objValidation10->setPromptTitle('Pick from list');
		$objValidation10->setPrompt('Please pick a value from the drop-down list.');
		$objValidation10->setFormula1('"'.$answer.'"');

$objValidation11 = $this->excel->getActiveSheet()->getCell('AE'.$m)->getDataValidation();
		$objValidation11->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation11->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation11->setAllowBlank(false);
		$objValidation11->setShowInputMessage(true);
		$objValidation11->setShowErrorMessage(true);
		$objValidation11->setShowDropDown(true);
		$objValidation11->setErrorTitle('Input error');
		$objValidation11->setError('Value is not in list.');
		$objValidation11->setPromptTitle('Pick from list');
		$objValidation11->setPrompt('Please pick a value from the drop-down list.');
		$objValidation11->setFormula1('"'.$answer.'"');

$objValidation12 = $this->excel->getActiveSheet()->getCell('AF'.$m)->getDataValidation();
		$objValidation12->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation12->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation12->setAllowBlank(false);
		$objValidation12->setShowInputMessage(true);
		$objValidation12->setShowErrorMessage(true);
		$objValidation12->setShowDropDown(true);
		$objValidation12->setErrorTitle('Input error');
		$objValidation12->setError('Value is not in list.');
		$objValidation12->setPromptTitle('Pick from list');
		$objValidation12->setPrompt('Please pick a value from the drop-down list.');
		$objValidation12->setFormula1('"'.$answer.'"');		


$objValidation13 = $this->excel->getActiveSheet()->getCell('AG'.$m)->getDataValidation();
		$objValidation13->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation13->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation13->setAllowBlank(false);
		$objValidation13->setShowInputMessage(true);
		$objValidation13->setShowErrorMessage(true);
		$objValidation13->setShowDropDown(true);
		$objValidation13->setErrorTitle('Input error');
		$objValidation13->setError('Value is not in list.');
		$objValidation13->setPromptTitle('Pick from list');
		$objValidation13->setPrompt('Please pick a value from the drop-down list.');
		$objValidation13->setFormula1('"'.$gender.'"');	

 //  $prefferedGender = "Male,Female,TG";		

	// $this->excel->getActiveSheet()->setCellValue('AG'.$m,$prefferedGender);



$objValidation14 = $this->excel->getActiveSheet()->getCell('AH'.$m)->getDataValidation();
		$objValidation14->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation14->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation14->setAllowBlank(false);
		$objValidation14->setShowInputMessage(true);
		$objValidation14->setShowErrorMessage(true);
		$objValidation14->setShowDropDown(true);
		$objValidation14->setErrorTitle('Input error');
		$objValidation14->setError('Value is not in list.');
		$objValidation14->setPromptTitle('Pick from list');
		$objValidation14->setPrompt('Please pick a value from the drop-down list.');
		$objValidation14->setFormula1('"'.$prefferedSexualAct.'"');		

//$this->excel->getActiveSheet()->setCellValue('AH'.$m,$prefferedSexualAct);		


$objValidation15 = $this->excel->getActiveSheet()->getCell('AI'.$m)->getDataValidation();
		$objValidation15->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation15->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation15->setAllowBlank(false);
		$objValidation15->setShowInputMessage(true);
		$objValidation15->setShowErrorMessage(true);
		$objValidation15->setShowDropDown(true);
		$objValidation15->setErrorTitle('Input error');
		$objValidation15->setError('Value is not in list.');
		$objValidation15->setPromptTitle('Pick from list');
		$objValidation15->setPrompt('Please pick a value from the drop-down list.');
		$objValidation15->setFormula1('"'.$condomUsage.'"');	


$objValidation16 = $this->excel->getActiveSheet()->getCell('AJ'.$m)->getDataValidation();
		$objValidation16->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation16->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation16->setAllowBlank(false);
		$objValidation16->setShowInputMessage(true);
		$objValidation16->setShowErrorMessage(true);
		$objValidation16->setShowDropDown(true);
		$objValidation16->setErrorTitle('Input error');
		$objValidation16->setError('Value is not in list.');
		$objValidation16->setPromptTitle('Pick from list');
		$objValidation16->setPrompt('Please pick a value from the drop-down list.');
		$objValidation16->setFormula1('"'.$substanceUse.'"');	

//$this->excel->getActiveSheet()->setCellValue('AJ'.$m,$substanceUse);		


$objValidation17 = $this->excel->getActiveSheet()->getCell('AK'.$m)->getDataValidation();
		$objValidation17->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation17->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation17->setAllowBlank(false);
		$objValidation17->setShowInputMessage(true);
		$objValidation17->setShowErrorMessage(true);
		$objValidation17->setShowDropDown(true);
		$objValidation17->setErrorTitle('Input error');
		$objValidation17->setError('Value is not in list.');
		$objValidation17->setPromptTitle('Pick from list');
		$objValidation17->setPrompt('Please pick a value from the drop-down list.');
		$objValidation17->setFormula1('"'.$answer.'"');	


$objValidation18 = $this->excel->getActiveSheet()->getCell('AM'.$m)->getDataValidation();
		$objValidation18->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation18->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation18->setAllowBlank(false);
		$objValidation18->setShowInputMessage(true);
		$objValidation18->setShowErrorMessage(true);
		$objValidation18->setShowDropDown(true);
		$objValidation18->setErrorTitle('Input error');
		$objValidation18->setError('Value is not in list.');
		$objValidation18->setPromptTitle('Pick from list');
		$objValidation18->setPrompt('Please pick a value from the drop-down list.');
		$objValidation18->setFormula1('"'.$status.'"');		

$this->excel->getActiveSheet()->setCellValue('AN2',date('d/m/Y'));


$this->excel->getActiveSheet()->setCellValue('AP2',date('d/m/Y'));

$this->excel->getActiveSheet()->setCellValue('AS2',date('d/m/Y'));


$this->excel->getActiveSheet()->setCellValue('AU2',date('d/m/Y'));

  $objValidation19 = $this->excel->getActiveSheet()->getCell('AO'.$m)->getDataValidation();
		$objValidation19->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation19->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation19->setAllowBlank(false);
		$objValidation19->setShowInputMessage(true);
		$objValidation19->setShowErrorMessage(true);
		$objValidation19->setShowDropDown(true);
		$objValidation19->setErrorTitle('Input error');
		$objValidation19->setError('Value is not in list.');
		$objValidation19->setPromptTitle('Pick from list');
		$objValidation19->setPrompt('Please pick a value from the drop-down list.');
		$objValidation19->setFormula1('"'.$answer.'"');	


$objValidation20 = $this->excel->getActiveSheet()->getCell('AT'.$m)->getDataValidation();
		$objValidation20->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation20->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation20->setAllowBlank(false);
		$objValidation20->setShowInputMessage(true);
		$objValidation20->setShowErrorMessage(true);
		$objValidation20->setShowDropDown(true);
		$objValidation20->setErrorTitle('Input error');
		$objValidation20->setError('Value is not in list.');
		$objValidation20->setPromptTitle('Pick from list');
		$objValidation20->setPrompt('Please pick a value from the drop-down list.');
		$objValidation20->setFormula1('"'.$status.'"');		


$objValidation21 = $this->excel->getActiveSheet()->getCell('AV'.$m)->getDataValidation();
		$objValidation21->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation21->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation21->setAllowBlank(false);
		$objValidation21->setShowInputMessage(true);
		$objValidation21->setShowErrorMessage(true);
		$objValidation21->setShowDropDown(true);
		$objValidation21->setErrorTitle('Input error');
		$objValidation21->setError('Value is not in list.');
		$objValidation21->setPromptTitle('Pick from list');
		$objValidation21->setPrompt('Please pick a value from the drop-down list.');
		$objValidation21->setFormula1('"'.$reportStatus.'"');


$objValidation22 = $this->excel->getActiveSheet()->getCell('AW'.$m)->getDataValidation();
		$objValidation22->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation22->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation22->setAllowBlank(false);
		$objValidation22->setShowInputMessage(true);
		$objValidation22->setShowErrorMessage(true);
		$objValidation22->setShowDropDown(true);
		$objValidation22->setErrorTitle('Input error');
		$objValidation22->setError('Value is not in list.');
		$objValidation22->setPromptTitle('Pick from list');
		$objValidation22->setPrompt('Please pick a value from the drop-down list.');
		$objValidation22->setFormula1('"'.$answer.'"');	


$objValidation23 = $this->excel->getActiveSheet()->getCell('BA'.$m)->getDataValidation();
		$objValidation23->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation23->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation23->setAllowBlank(false);
		$objValidation23->setShowInputMessage(true);
		$objValidation23->setShowErrorMessage(true);
		$objValidation23->setShowDropDown(true);
		$objValidation23->setErrorTitle('Input error');
		$objValidation23->setError('Value is not in list.');
		$objValidation23->setPromptTitle('Pick from list');
		$objValidation23->setPrompt('Please pick a value from the drop-down list.');
		$objValidation23->setFormula1('"'.$otherService.'"');


$objValidation24 = $this->excel->getActiveSheet()->getCell('BB'.$m)->getDataValidation();
		$objValidation24->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
		$objValidation24->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
		$objValidation24->setAllowBlank(false);
		$objValidation24->setShowInputMessage(true);
		$objValidation24->setShowErrorMessage(true);
		$objValidation24->setShowDropDown(true);
		$objValidation24->setErrorTitle('Input error');
		$objValidation24->setError('Value is not in list.');
		$objValidation24->setPromptTitle('Pick from list');
		$objValidation24->setPrompt('Please pick a value from the drop-down list.');
		$objValidation24->setFormula1('"'.$clientStatus.'"');										


		  		
		  	}	
		 
   

     $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
	$this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(30);
	   $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
	$this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);

  

		//print_r($excel_data);

		//Fill data
		$this->excel->getActiveSheet()->fromArray($header, null, 'A1');
		//$this->excel->getActiveSheet()->getStyle('A1:AM1')->getFont()->setBold(true)->setSize(12);
		$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
 } 

  
  public function uploadExcelUser(){
   if(!$this->session->userdata('validated')){
			redirect(base_url().'home/dashboard');
		}


		if($_FILES['importExcel']['name']){
          $limit = $this->input->post('limit');

			//$limit = 1;

			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/userExcel/".$file_name;
			if(move_uploaded_file($_FILES["importExcel"]["tmp_name"],$file_path)){
				$this->load->library('excel');
				$arr_data = array();
				$objPHPExcel = PHPExcel_IOFactory::load($file_path);
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();

		
				foreach ($cell_collection as $cell){
					$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
					$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();

					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
					if ($row == 1) {
						$header[$row][$column] = $data_value;
					} else {

							 $arr_data[$row][$column] = $data_value;
					  
					}
				}



			/*	foreach ($arr_data as $key => $dataNew) {

			    if($key != 2)
			    {
			    	if(!empty($dataNew['F']))	
					{
					  $arr_data_new[] = $dataNew;	
					}
			    }else{
			    	$arr_data_new[] = $dataNew;
			    }	
			
				}*/

				$arr_data_new = [];

				for ($i=2; $i < ($limit+2); $i++) { 
				  $arr_data_new[]	= $arr_data[$i];
				}

				
				$j = 0; 
				$total=1;
				$totalCount = 1;

				//foreach($arr_data/arr_data_new as $row){
				
				foreach($arr_data_new as $row){
					// $a = $row['A'];
					// $b=str_replace('/','-',$row['A']);

					
					// echo date('Y-m-d',strtotime($b));exit();
					// echo strtotime('10/03/2019').'weeeeeeeeeeeeeeeeeee'; exit();

						// if(trim($row['AN'])<trim($row['A']))
						// {
						// 	echo "Date ";
						// }
						// else{
						// 	echo "right";
						// }
					// 	// exit();
					// echo date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));;exit();
					// 	echo date('Y-m-d',trim($row['A']));exit();
					// 	echo date('Y-m-d',strtotime(str_replace('/','-',trim($row['A']))));exit();
					// // if(trim($row['AP'])>(trim($row['AN']))){
					// 	echo 'AP'.'>'.'AN';exit();
					// }
					// else{
					// 	echo 'AP'.'<'.'AN';exit();
					// }

				//	print_r(json_encode($row));exit();
					if(trim($row['F']) != ''  && trim($row['I']) != '' && trim($row['J']) != '' && trim($row['W']) != '' && trim($row['X']) != ''  && trim($row['AN']) != '' && trim($row['AO']) != '' && trim($row['A']) != '' )
					{
										$len = strlen(trim($row['AA']));
										$checkRegistertionNumber = $this->rolemaster->checkRegistertionNumber(trim($row['D']));
					  	if($len == 10 || $len == 0)
						 {
								$checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['W']),trim($row['X']));
								// echo '<pre>';print_r($checkStateDistrict);exit;
								if($checkStateDistrict)
								{
									  $checkStateDistrict1 = $this->rolemaster->checkStateDistrict(trim($row['Y']),trim($row['Z']));
									if($checkStateDistrict1 || (!trim($row['Y']) && !trim($row['Z'])))
							  		{	
																						if($len !=  0)
																					  	{
																					  		 $mobile1 = '+91'.trim($row['AA']); 
																					     $userMobile = $this->rolemaster->checkUserMobile($mobile1);
																					 	}

								    	if(empty($userMobile))
							     		{
							     				//echo $row['M'];
							    			if(empty($checkRegistertionNumber))
							    			{
											     				
							    				if(trim($row['AN']) >= trim($row['A']))
							    				{
													if((trim($row['AP'])=='')||(trim($row['AP'])>trim($row['AN'])))
													{							    					
											     		if((trim($row['AS'])=='')||(trim($row['AS'])>trim($row['AP'])))
											     		{
											     			if((trim($row['AU'])=='')||(trim($row['AU'])>trim($row['AS'])))
											     			{
											     				if((trim($row['AX'])=='')||(trim($row['AS'])=='') ||(trim($row['AX'])>trim($row['AS'])))
											     				{

																			     				if(!empty(trim($row['A'])))
																						     	{
																						     		$insert['registeredOn'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['A']))));
																						     			//print_r(trim($row['A']));exit();
																						     	}
								                                 

																						     	  /* $uniqueIdNew = $this->rolemaster->createUserUniqueIdExcel(trim($row['E']),trim($row['N']));	*/

																						     	    //$insert['client_id'] = $uniqueIdNew;
																						     	    $insert['campCode'] = trim($row['B']);
																						     	    $insert['registeredBy'] = trim($row['C']);
																						     	    $insert['client_id'] = trim($row['D']);
																						     	    $insert['modeOfContact'] = trim($row['E']);
																						     	    
																						     	  //  $insert['registerFromDevice'] = trim($row['D']);
																									//$insert['userName'] = trim($row['AA']);
																									$insert['userName'] = trim($row['D']);
																								    $insert['password'] = md5('123456');
																								    $insert['name'] = trim($row['F']);
																								    $insert['nameAlias'] = trim($row['G']);

																								  if(!empty(trim($row['H'])))  
																								 	{  
																								 	 $insert['dob'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['H']))));
																								 	}
																								    $insert['age'] = trim($row['I']);
																								    $insert['gender'] = trim($row['J']);
																								   if(!empty(trim($row['AA']))) 
																								  {  
																								  	$insert['mobileNo'] = trim($row['AA']);
																								  }
																								    $insert['address'] =  trim($row['V']);

																								  
																								  
																								 if(trim($row['K']) == 'Primary')
																								 {
																								    $insert['educationalLevel'] = 'Primary(1-5)';	
																								 }elseif (trim($row['K']) == 'Secondary') {
																								 	$insert['educationalLevel'] = 'Secondary(6-10)';
																								 }elseif (trim($row['K']) == 'Secondary') {
																								 	$insert['educationalLevel'] = 'Higher Secondary';
																								 }else{
																								 	$insert['educationalLevel'] = trim($row['K']);
																								 } 
															   
																								    $insert['educationalLevel'] = trim($row['K']);
																								    $insert['occupation'] = trim($row['L']);
																								    $insert['occupation_other'] = trim($row['M']);

																								   if(trim($row['N']) == 'TG_M-F') 
																								   {
															                                         $insert['hrg'] = 'TG(M-F)';

																								   }else{
																								   	$insert['hrg'] = trim($row['N']);
																								   }

																								   if(trim($row['O']) == 'TG_F-M') 
																								   {
																								   	$insert['arg'] = 'TG(F-M)';
																								   }else{
																								   	$insert['arg'] = trim($row['O']);
																								   }	
																								   /*else if(trim($row['O']) == 'Female Partner-ARG'){
																								   	  	$insert['arg'] = 'Female partner (FPARG)';

																								   }else if(trim($row['O']) == 'Female Partner-HRG'){
																								   	  	$insert['arg'] = 'Female Partner (FMHRG) ';

																								   }*/ 
																								    
																								   // $insert['domainOfWork'] = trim($row['P']);
																								    $insert['monthlyIncome'] = trim($row['P']); 	
																								    $insert['maritalStatus'] = trim($row['Q']);
																								    $insert['maritalStatus_other'] = trim($row['R']);
																								    $insert['male_children'] = trim($row['S']);
																								    $insert['female_children'] = trim($row['T']);
																								  //  $insert['total_children'] = trim($row['U']);

																								    $insert['total_children'] = trim($row['S']) + trim($row['T']);
																								    $insert['state'] = $checkStateDistrict1[0]['stateId'];
																								    $insert['districtId'] = $checkStateDistrict1[0]['districtId'];
																								    $insert['addressState'] = $checkStateDistrict[0]['stateId'];
																								    $insert['addressDistrict'] = $checkStateDistrict[0]['districtId'];
																								   /*  $insert['secondaryIdentity'] = trim($row['AC']);
																								    $insert['secondaryIdentity_other'] = trim($row['AD']);*/
																								    $insert['referralPoint'] = trim($row['AB']);
																								    $insert['referralPoint_others'] = trim($row['AC']);
																								    $insert['sexualBehaviour'] = trim($row['AD']);
																								    $insert['multipleSexPartner'] = trim($row['AE']);
																								    $insert['sought'] = trim($row['AF']);
																								    $insert['prefferedGender'] = trim($row['AG']);
																								    $insert['prefferedSexualAct'] = trim($row['AH']);
																								    $insert['condomUsage'] = trim($row['AI']);
																								    $insert['substanceUse'] = trim($row['AJ']);
																								    $insert['hivTestResult'] = trim($row['AK']);
																								    $insert['hivTestTime'] = trim($row['AL']);
																								    $insert['pastHivReport'] = trim($row['AM']);

																								  if(!empty(trim($row['AN'])))
																								  {
																							

																								  	 $insert['fingerDate'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['AN']))));

																								  }  
																								   
																								    $insert['saictcStatus'] = trim($row['AO']);

																								  if(!empty(trim($row['AP'])))  
																								  {
																								  	$insert['saictcDate'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['AP']))));
																								  }
																								    
																								    $insert['saictcPlace'] = trim($row['AQ']);
																								    $insert['ictcNumber'] = trim($row['AR']);
															                                     
															                                     if(!empty(trim($row['AS'])))
															                                     {
															                                     	 $insert['hivDate'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['AS']))));
															                                     }	
																								    $insert['hivStatus'] = trim($row['AT']);

																								 if(!empty(trim($row['AU'])))
																								 {
																								 	 $insert['reportIssuedDate'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['AU']))));
																								 }   
																								   

																								    $insert['reportStatus'] = trim($row['AV']);

																								    $insert['linkToArt'] = trim($row['AW']);
															                                    
															                                    if(!empty(trim($row['AX'])))
															                                    {

															                                    	 $insert['artDate'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['AX']))));

															                                    }	

																								    
																								     $insert['artNumber'] = trim($row['AY']);
																								     $insert['cd4Result'] = trim($row['AZ']);
																								     $insert['otherService'] = trim($row['BA']);
																								     $insert['clientStatus'] = trim($row['BB']);

																								   
																								    
																								    $insert['remark']= trim($row['BC']);
																								    $insert['userVerify'] = 'Y';
																								    $insert['registerFromDevice'] = 'Web';
																								    $insert['registerMode'] = 'Online';

																								 

																	

																									$this->common_model->insertValue('tbl_user',$insert);

																							//$id = $this->rolemaster->insertUserValue($insert);
																							//echo $this->db->last_query();exit;
																							$total++;
																								}
																								else{

																								  					$error[$j]['error'] = 'ART Registeration Date should be greater than Date of HIV confirmation Test ';

																						     		
																											     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

																											     	$error[$j]['registeredOn'] = trim($row['A']);
																											     	   
																											     	    $error[$j]['campCode'] = trim($row['B']);
																											     	    $error[$j]['registeredBy'] = trim($row['C']);
																											     	    $error[$j]['client_id'] = trim($row['D']);
																											     	    $error[$j]['modeOfContact'] = trim($row['E']);
																											     	    
																											     	 
																														$error[$j]['userName'] = trim($row['AA']);
																													   
																													    $error[$j]['name'] = trim($row['F']);
																													    $error[$j]['nameAlias'] = trim($row['G']);
																													  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
																													  $error[$j]['dob'] = trim($row['H']);
																													    $error[$j]['age'] = trim($row['I']);
																													    $error[$j]['gender'] = trim($row['J']);
																													    $error[$j]['mobileNo'] = trim($row['AA']);
																													    $error[$j]['address'] =  trim($row['V']);
																													    $error[$j]['educationalLevel'] = trim($row['K']);
																													    $error[$j]['occupation'] = trim($row['L']);
																													    $error[$j]['occupation_other'] = trim($row['M']);
																													    $error[$j]['hrg'] = trim($row['N']);
																													    $error[$j]['arg'] = trim($row['O']);
																													  
																													    $error[$j]['monthlyIncome'] = trim($row['P']); 	
																													    $error[$j]['maritalStatus'] = trim($row['Q']);
																													    $error[$j]['maritalStatus_other'] = trim($row['R']);
																													    $error[$j]['male_children'] = trim($row['S']);
																													    $error[$j]['female_children'] = trim($row['T']);
																													    $error[$j]['total_children'] = trim($row['U']);
																													    $error[$j]['state'] = trim($row['W']);
																													    $error[$j]['districtId'] = trim($row['X']);
																													    $error[$j]['addressState'] = trim($row['Y']);
																													    $error[$j]['addressDistrict'] = trim($row['Z']);
																													  
																													    $error[$j]['referralPoint'] = trim($row['AB']);
																													    $error[$j]['referralPoint_others'] = trim($row['AC']);
																													    $error[$j]['sexualBehaviour'] = trim($row['AD']);
																													    $error[$j]['multipleSexPartner'] = trim($row['AE']);
																													    $error[$j]['sought'] = trim($row['AF']);
																													    $error[$j]['prefferedGender'] = trim($row['AG']);
																													    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
																													    $error[$j]['condomUsage'] = trim($row['AI']);
																													    $error[$j]['substanceUse'] = trim($row['AJ']);
																													    $error[$j]['hivTestResult'] = trim($row['AK']);
																													    $error[$j]['hivTestTime'] = trim($row['AL']);
																													    $error[$j]['pastHivReport'] = trim($row['AM']);

																													  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

																													$error[$j]['fingerDate'] = trim($row['AN']);
																													   
																													    $error[$j]['saictcStatus'] = trim($row['AO']);

																													
																													 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

																													 $error[$j]['saictcDate'] = trim($row['AP']);
																													  
																													    
																													    $error[$j]['saictcPlace'] = trim($row['AQ']);
																													    $error[$j]['ictcNumber'] = trim($row['AR']);
																				                               
																				                                       $error[$j]['hivDate'] =trim($row['AS']);
																				                                     	
																													    $error[$j]['hivStatus'] = trim($row['AT']);

																													
																													 	/* $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
																													    $error[$j]['reportIssuedDate'] = trim($row['AU']);
																													   
																													    $error[$j]['reportStatus'] = trim($row['AV']);

																													    $error[$j]['linkToArt'] = trim($row['AW']);
																				                                    
																				                                  
																				                                    /*	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/

																				                                    	$error[$j]['artDate'] = trim($row['BA']);

																													    
																													     $error[$j]['artNumber'] = trim($row['AY']);
																													     $error[$j]['cd4Result'] = trim($row['AZ']);
																													     $error[$j]['otherService'] = trim($row['BA']);
																													     $error[$j]['clientStatus'] = trim($row['BB']);
																													    
																													    $error[$j]['remark']= trim($row['BC']);
																											 		
																												$j++;							  			

																								}
																							}
																							else{

																								  					$error[$j]['error'] = 'Date of Test Report issued to Client should be greater than Date of HIV Confirmation Test';

																						     		
																											     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

																											     	$error[$j]['registeredOn'] = trim($row['A']);
																											     	   
																											     	    $error[$j]['campCode'] = trim($row['B']);
																											     	    $error[$j]['registeredBy'] = trim($row['C']);
																											     	    $error[$j]['client_id'] = trim($row['D']);
																											     	    $error[$j]['modeOfContact'] = trim($row['E']);
																											     	    
																											     	 
																														$error[$j]['userName'] = trim($row['AA']);
																													   
																													    $error[$j]['name'] = trim($row['F']);
																													    $error[$j]['nameAlias'] = trim($row['G']);
																													  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
																													  $error[$j]['dob'] = trim($row['H']);
																													    $error[$j]['age'] = trim($row['I']);
																													    $error[$j]['gender'] = trim($row['J']);
																													    $error[$j]['mobileNo'] = trim($row['AA']);
																													    $error[$j]['address'] =  trim($row['V']);
																													    $error[$j]['educationalLevel'] = trim($row['K']);
																													    $error[$j]['occupation'] = trim($row['L']);
																													    $error[$j]['occupation_other'] = trim($row['M']);
																													    $error[$j]['hrg'] = trim($row['N']);
																													    $error[$j]['arg'] = trim($row['O']);
																													  
																													    $error[$j]['monthlyIncome'] = trim($row['P']); 	
																													    $error[$j]['maritalStatus'] = trim($row['Q']);
																													    $error[$j]['maritalStatus_other'] = trim($row['R']);
																													    $error[$j]['male_children'] = trim($row['S']);
																													    $error[$j]['female_children'] = trim($row['T']);
																													    $error[$j]['total_children'] = trim($row['U']);
																													    $error[$j]['state'] = trim($row['W']);
																													    $error[$j]['districtId'] = trim($row['X']);
																													    $error[$j]['addressState'] = trim($row['Y']);
																													    $error[$j]['addressDistrict'] = trim($row['Z']);
																													  
																													    $error[$j]['referralPoint'] = trim($row['AB']);
																													    $error[$j]['referralPoint_others'] = trim($row['AC']);
																													    $error[$j]['sexualBehaviour'] = trim($row['AD']);
																													    $error[$j]['multipleSexPartner'] = trim($row['AE']);
																													    $error[$j]['sought'] = trim($row['AF']);
																													    $error[$j]['prefferedGender'] = trim($row['AG']);
																													    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
																													    $error[$j]['condomUsage'] = trim($row['AI']);
																													    $error[$j]['substanceUse'] = trim($row['AJ']);
																													    $error[$j]['hivTestResult'] = trim($row['AK']);
																													    $error[$j]['hivTestTime'] = trim($row['AL']);
																													    $error[$j]['pastHivReport'] = trim($row['AM']);

																													  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

																													$error[$j]['fingerDate'] = trim($row['AN']);
																													   
																													    $error[$j]['saictcStatus'] = trim($row['AO']);

																													
																													 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

																													 $error[$j]['saictcDate'] = trim($row['AP']);
																													  
																													    
																													    $error[$j]['saictcPlace'] = trim($row['AQ']);
																													    $error[$j]['ictcNumber'] = trim($row['AR']);
																				                               
																				                                       $error[$j]['hivDate'] =trim($row['AS']);
																				                                     	
																													    $error[$j]['hivStatus'] = trim($row['AT']);

																													
																													 	/* $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
																													    $error[$j]['reportIssuedDate'] = trim($row['AU']);
																													   
																													    $error[$j]['reportStatus'] = trim($row['AV']);

																													    $error[$j]['linkToArt'] = trim($row['AW']);
																				                                    
																				                                  
																				                                    /*	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/

																				                                    	$error[$j]['artDate'] = trim($row['BA']);

																													    
																													     $error[$j]['artNumber'] = trim($row['AY']);
																													     $error[$j]['cd4Result'] = trim($row['AZ']);
																													     $error[$j]['otherService'] = trim($row['BA']);
																													     $error[$j]['clientStatus'] = trim($row['BB']);
																													    
																													    $error[$j]['remark']= trim($row['BC']);
																											 		
																												$j++;							  			
																								  				
																							}
																						}
																						else{
																									$error[$j]['error'] = 'Date of HIV Confirmation Test should be greater than Date of out-Referral to SA-ICTC ';

																						     		
																											     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

																											     	$error[$j]['registeredOn'] = trim($row['A']);
																											     	   
																											     	    $error[$j]['campCode'] = trim($row['B']);
																											     	    $error[$j]['registeredBy'] = trim($row['C']);
																											     	    $error[$j]['client_id'] = trim($row['D']);
																											     	    $error[$j]['modeOfContact'] = trim($row['E']);
																											     	    
																											     	 
																														$error[$j]['userName'] = trim($row['AA']);
																													   
																													    $error[$j]['name'] = trim($row['F']);
																													    $error[$j]['nameAlias'] = trim($row['G']);
																													  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
																													  $error[$j]['dob'] = trim($row['H']);
																													    $error[$j]['age'] = trim($row['I']);
																													    $error[$j]['gender'] = trim($row['J']);
																													    $error[$j]['mobileNo'] = trim($row['AA']);
																													    $error[$j]['address'] =  trim($row['V']);
																													    $error[$j]['educationalLevel'] = trim($row['K']);
																													    $error[$j]['occupation'] = trim($row['L']);
																													    $error[$j]['occupation_other'] = trim($row['M']);
																													    $error[$j]['hrg'] = trim($row['N']);
																													    $error[$j]['arg'] = trim($row['O']);
																													  
																													    $error[$j]['monthlyIncome'] = trim($row['P']); 	
																													    $error[$j]['maritalStatus'] = trim($row['Q']);
																													    $error[$j]['maritalStatus_other'] = trim($row['R']);
																													    $error[$j]['male_children'] = trim($row['S']);
																													    $error[$j]['female_children'] = trim($row['T']);
																													    $error[$j]['total_children'] = trim($row['U']);
																													    $error[$j]['state'] = trim($row['W']);
																													    $error[$j]['districtId'] = trim($row['X']);
																													    $error[$j]['addressState'] = trim($row['Y']);
																													    $error[$j]['addressDistrict'] = trim($row['Z']);
																													  
																													    $error[$j]['referralPoint'] = trim($row['AB']);
																													    $error[$j]['referralPoint_others'] = trim($row['AC']);
																													    $error[$j]['sexualBehaviour'] = trim($row['AD']);
																													    $error[$j]['multipleSexPartner'] = trim($row['AE']);
																													    $error[$j]['sought'] = trim($row['AF']);
																													    $error[$j]['prefferedGender'] = trim($row['AG']);
																													    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
																													    $error[$j]['condomUsage'] = trim($row['AI']);
																													    $error[$j]['substanceUse'] = trim($row['AJ']);
																													    $error[$j]['hivTestResult'] = trim($row['AK']);
																													    $error[$j]['hivTestTime'] = trim($row['AL']);
																													    $error[$j]['pastHivReport'] = trim($row['AM']);

																													  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

																													$error[$j]['fingerDate'] = trim($row['AN']);
																													   
																													    $error[$j]['saictcStatus'] = trim($row['AO']);

																													
																													 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

																													 $error[$j]['saictcDate'] = trim($row['AP']);
																													  
																													    
																													    $error[$j]['saictcPlace'] = trim($row['AQ']);
																													    $error[$j]['ictcNumber'] = trim($row['AR']);
																				                               
																				                                       $error[$j]['hivDate'] =trim($row['AS']);
																				                                     	
																													    $error[$j]['hivStatus'] = trim($row['AT']);

																													
																													 	/* $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
																													    $error[$j]['reportIssuedDate'] = trim($row['AU']);
																													   
																													    $error[$j]['reportStatus'] = trim($row['AV']);

																													    $error[$j]['linkToArt'] = trim($row['AW']);
																				                                    
																				                                  
																				                                    /*	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/

																				                                    	$error[$j]['artDate'] = trim($row['BA']);

																													    
																													     $error[$j]['artNumber'] = trim($row['AY']);
																													     $error[$j]['cd4Result'] = trim($row['AZ']);
																													     $error[$j]['otherService'] = trim($row['BA']);
																													     $error[$j]['clientStatus'] = trim($row['BB']);
																													    
																													    $error[$j]['remark']= trim($row['BC']);
																											 		
																												$j++;							  		
																						}
																					}
																					else{
																							$error[$j]['error'] = 'Date of out-Referral to SA-ICTC should be greater than Date of FingerPrick Screening';

																						     		
																						     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

																						     	$error[$j]['registeredOn'] = trim($row['A']);
																						     	   
																						     	    $error[$j]['campCode'] = trim($row['B']);
																						     	    $error[$j]['registeredBy'] = trim($row['C']);
																						     	    $error[$j]['client_id'] = trim($row['D']);
																						     	    $error[$j]['modeOfContact'] = trim($row['E']);
																						     	    
																						     	 
																									$error[$j]['userName'] = trim($row['AA']);
																								   
																								    $error[$j]['name'] = trim($row['F']);
																								    $error[$j]['nameAlias'] = trim($row['G']);
																								  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
																								  $error[$j]['dob'] = trim($row['H']);
																								    $error[$j]['age'] = trim($row['I']);
																								    $error[$j]['gender'] = trim($row['J']);
																								    $error[$j]['mobileNo'] = trim($row['AA']);
																								    $error[$j]['address'] =  trim($row['V']);
																								    $error[$j]['educationalLevel'] = trim($row['K']);
																								    $error[$j]['occupation'] = trim($row['L']);
																								    $error[$j]['occupation_other'] = trim($row['M']);
																								    $error[$j]['hrg'] = trim($row['N']);
																								    $error[$j]['arg'] = trim($row['O']);
																								  
																								    $error[$j]['monthlyIncome'] = trim($row['P']); 	
																								    $error[$j]['maritalStatus'] = trim($row['Q']);
																								    $error[$j]['maritalStatus_other'] = trim($row['R']);
																								    $error[$j]['male_children'] = trim($row['S']);
																								    $error[$j]['female_children'] = trim($row['T']);
																								    $error[$j]['total_children'] = trim($row['U']);
																								    $error[$j]['state'] = trim($row['W']);
																								    $error[$j]['districtId'] = trim($row['X']);
																								    $error[$j]['addressState'] = trim($row['Y']);
																								    $error[$j]['addressDistrict'] = trim($row['Z']);
																								  
																								    $error[$j]['referralPoint'] = trim($row['AB']);
																								    $error[$j]['referralPoint_others'] = trim($row['AC']);
																								    $error[$j]['sexualBehaviour'] = trim($row['AD']);
																								    $error[$j]['multipleSexPartner'] = trim($row['AE']);
																								    $error[$j]['sought'] = trim($row['AF']);
																								    $error[$j]['prefferedGender'] = trim($row['AG']);
																								    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
																								    $error[$j]['condomUsage'] = trim($row['AI']);
																								    $error[$j]['substanceUse'] = trim($row['AJ']);
																								    $error[$j]['hivTestResult'] = trim($row['AK']);
																								    $error[$j]['hivTestTime'] = trim($row['AL']);
																								    $error[$j]['pastHivReport'] = trim($row['AM']);

																								  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

																								$error[$j]['fingerDate'] = trim($row['AN']);
																								   
																								    $error[$j]['saictcStatus'] = trim($row['AO']);

																								
																								 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

																								 $error[$j]['saictcDate'] = trim($row['AP']);
																								  
																								    
																								    $error[$j]['saictcPlace'] = trim($row['AQ']);
																								    $error[$j]['ictcNumber'] = trim($row['AR']);
															                               
															                                       $error[$j]['hivDate'] =trim($row['AS']);
															                                     	
																								    $error[$j]['hivStatus'] = trim($row['AT']);

																								
																								 	/* $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
																								    $error[$j]['reportIssuedDate'] = trim($row['AU']);
																								   
																								    $error[$j]['reportStatus'] = trim($row['AV']);

																								    $error[$j]['linkToArt'] = trim($row['AW']);
															                                    
															                                  
															                                    /*	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/

															                                    	$error[$j]['artDate'] = trim($row['BA']);

																								    
																								     $error[$j]['artNumber'] = trim($row['AY']);
																								     $error[$j]['cd4Result'] = trim($row['AZ']);
																								     $error[$j]['otherService'] = trim($row['BA']);
																								     $error[$j]['clientStatus'] = trim($row['BB']);
																								    
																								    $error[$j]['remark']= trim($row['BC']);
																						 		
																							$j++;
																					}



																				}
																				else{

																							$error[$j]['error'] = 'Date of finger prick screening should be greater than Date of registeration';

																						     		
																						     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

																						     	$error[$j]['registeredOn'] = trim($row['A']);
																						     	   
																						     	    $error[$j]['campCode'] = trim($row['B']);
																						     	    $error[$j]['registeredBy'] = trim($row['C']);
																						     	    $error[$j]['client_id'] = trim($row['D']);
																						     	    $error[$j]['modeOfContact'] = trim($row['E']);
																						     	    
																						     	 
																									$error[$j]['userName'] = trim($row['AA']);
																								   
																								    $error[$j]['name'] = trim($row['F']);
																								    $error[$j]['nameAlias'] = trim($row['G']);
																								  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
																								  $error[$j]['dob'] = trim($row['H']);
																								    $error[$j]['age'] = trim($row['I']);
																								    $error[$j]['gender'] = trim($row['J']);
																								    $error[$j]['mobileNo'] = trim($row['AA']);
																								    $error[$j]['address'] =  trim($row['V']);
																								    $error[$j]['educationalLevel'] = trim($row['K']);
																								    $error[$j]['occupation'] = trim($row['L']);
																								    $error[$j]['occupation_other'] = trim($row['M']);
																								    $error[$j]['hrg'] = trim($row['N']);
																								    $error[$j]['arg'] = trim($row['O']);
																								  
																								    $error[$j]['monthlyIncome'] = trim($row['P']); 	
																								    $error[$j]['maritalStatus'] = trim($row['Q']);
																								    $error[$j]['maritalStatus_other'] = trim($row['R']);
																								    $error[$j]['male_children'] = trim($row['S']);
																								    $error[$j]['female_children'] = trim($row['T']);
																								    $error[$j]['total_children'] = trim($row['U']);
																								    $error[$j]['state'] = trim($row['W']);
																								    $error[$j]['districtId'] = trim($row['X']);
																								    $error[$j]['addressState'] = trim($row['Y']);
																								    $error[$j]['addressDistrict'] = trim($row['Z']);
																								  
																								    $error[$j]['referralPoint'] = trim($row['AB']);
																								    $error[$j]['referralPoint_others'] = trim($row['AC']);
																								    $error[$j]['sexualBehaviour'] = trim($row['AD']);
																								    $error[$j]['multipleSexPartner'] = trim($row['AE']);
																								    $error[$j]['sought'] = trim($row['AF']);
																								    $error[$j]['prefferedGender'] = trim($row['AG']);
																								    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
																								    $error[$j]['condomUsage'] = trim($row['AI']);
																								    $error[$j]['substanceUse'] = trim($row['AJ']);
																								    $error[$j]['hivTestResult'] = trim($row['AK']);
																								    $error[$j]['hivTestTime'] = trim($row['AL']);
																								    $error[$j]['pastHivReport'] = trim($row['AM']);

																								  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

																								$error[$j]['fingerDate'] = trim($row['AN']);
																								   
																								    $error[$j]['saictcStatus'] = trim($row['AO']);

																								
																								 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

																								 $error[$j]['saictcDate'] = trim($row['AP']);
																								  
																								    
																								    $error[$j]['saictcPlace'] = trim($row['AQ']);
																								    $error[$j]['ictcNumber'] = trim($row['AR']);
															                               
															                                       $error[$j]['hivDate'] =trim($row['AS']);
															                                     	
																								    $error[$j]['hivStatus'] = trim($row['AT']);

																								
																								 	/* $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
																								    $error[$j]['reportIssuedDate'] = trim($row['AU']);
																								   
																								    $error[$j]['reportStatus'] = trim($row['AV']);

																								    $error[$j]['linkToArt'] = trim($row['AW']);
															                                    
															                                  
															                                    /*	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/

															                                    	$error[$j]['artDate'] = trim($row['BA']);

																								    
																								     $error[$j]['artNumber'] = trim($row['AY']);
																								     $error[$j]['cd4Result'] = trim($row['AZ']);
																								     $error[$j]['otherService'] = trim($row['BA']);
																								     $error[$j]['clientStatus'] = trim($row['BB']);
																								    
																								    $error[$j]['remark']= trim($row['BC']);
																						 		
																							$j++;

																				}


							     }else{
							     	$error[$j]['error'] = 'Registration Number already exist';

							     		
							     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

							     	$error[$j]['registeredOn'] = trim($row['A']);
							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
									  $error[$j]['dob'] = trim($row['H']);
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = trim($row['AA']);
									    $error[$j]['address'] =  trim($row['V']);
									    $error[$j]['educationalLevel'] = trim($row['K']);
									    $error[$j]['occupation'] = trim($row['L']);
									    $error[$j]['occupation_other'] = trim($row['M']);
									    $error[$j]['hrg'] = trim($row['N']);
									    $error[$j]['arg'] = trim($row['O']);
									  
									    $error[$j]['monthlyIncome'] = trim($row['P']); 	
									    $error[$j]['maritalStatus'] = trim($row['Q']);
									    $error[$j]['maritalStatus_other'] = trim($row['R']);
									    $error[$j]['male_children'] = trim($row['S']);
									    $error[$j]['female_children'] = trim($row['T']);
									    $error[$j]['total_children'] = trim($row['U']);
									    $error[$j]['state'] = trim($row['W']);
									    $error[$j]['districtId'] = trim($row['X']);
									    $error[$j]['addressState'] = trim($row['Y']);
									    $error[$j]['addressDistrict'] = trim($row['Z']);
									  
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['sexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['prefferedGender'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);

									  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

									$error[$j]['fingerDate'] = trim($row['AN']);
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

									 $error[$j]['saictcDate'] = trim($row['AP']);
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	/* $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
									    $error[$j]['reportIssuedDate'] = trim($row['AU']);
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    /*	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/

                                    	$error[$j]['artDate'] = trim($row['BA']);

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);
							 		
								$j++;
							     }	

							     	
							 }else{
							 		$error[$j]['error'] = 'Mobile Number already exist';

							     		/*
							     		$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

							     		$error[$j]['registeredOn'] = trim($row['A']);
   	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									   /* $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
									     $error[$j]['dob'] = trim($row['H']);
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = trim($row['AA']);
									    $error[$j]['address'] =  trim($row['V']);
									    $error[$j]['educationalLevel'] = trim($row['K']);
									    $error[$j]['occupation'] = trim($row['L']);
									    $error[$j]['occupation_other'] = trim($row['M']);
									    $error[$j]['hrg'] = trim($row['N']);
									    $error[$j]['arg'] = trim($row['O']);
									  
									    $error[$j]['monthlyIncome'] = trim($row['P']); 	
									    $error[$j]['maritalStatus'] = trim($row['Q']);
									    $error[$j]['maritalStatus_other'] = trim($row['R']);
									    $error[$j]['male_children'] = trim($row['S']);
									    $error[$j]['female_children'] = trim($row['T']);
									    $error[$j]['total_children'] = trim($row['U']);
									    $error[$j]['state'] = trim($row['W']);
									    $error[$j]['districtId'] = trim($row['X']);
									    $error[$j]['addressState'] = trim($row['Y']);
									    $error[$j]['addressDistrict'] = trim($row['Z']);
									  
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['sexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['prefferedGender'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);

									  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

										$error[$j]['fingerDate'] = trim($row['AN']);
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									/*
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

									  	 $error[$j]['saictcDate'] = trim($row['AP']);
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 /*	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/

									 $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	/* $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/
                                    	$error[$j]['artDate'] = trim($row['BA']);
	    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);
							 		
								$j++;
							 }

							}else{
								$error[$j]['error'] = 'Native State or Native District not Match';
								  
							    	
							     	/*	$error[$j]['registeredOn'] =
							     		date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

							     		$error[$j]['registeredOn'] = trim($row['A']);
							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
									    $error[$j]['dob'] = trim($row['H']);
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = trim($row['AA']);
									    $error[$j]['address'] =  trim($row['V']);
									    $error[$j]['educationalLevel'] = trim($row['K']);
									    $error[$j]['occupation'] = trim($row['L']);
									    $error[$j]['occupation_other'] = trim($row['M']);
									    $error[$j]['hrg'] = trim($row['N']);
									    $error[$j]['arg'] = trim($row['O']);
									  
									    $error[$j]['monthlyIncome'] = trim($row['P']); 	
									    $error[$j]['maritalStatus'] = trim($row['Q']);
									    $error[$j]['maritalStatus_other'] = trim($row['R']);
									    $error[$j]['male_children'] = trim($row['S']);
									    $error[$j]['female_children'] = trim($row['T']);
									    $error[$j]['total_children'] = trim($row['U']);
									    $error[$j]['state'] = trim($row['W']);
									    $error[$j]['districtId'] = trim($row['X']);
									    $error[$j]['addressState'] = trim($row['Y']);
									    $error[$j]['addressDistrict'] = trim($row['Z']);
									  
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['sexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['prefferedGender'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);

									  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

										$error[$j]['fingerDate'] = trim($row['AN']);
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

									  $error[$j]['saictcDate'] = trim($row['AP']);
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                      /* $error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));*/

                                          $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] =trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  /*
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/
                                    	$error[$j]['artDate'] = trim($row['BA']);
									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);
								$j++;
							}
							}else{
								$error[$j]['error'] = 'Current State or Current District of address not Match ';
								 	
							     		/*$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/

							     		$error[$j]['registeredOn'] = trim($row['A']);
							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									   /* $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
									     $error[$j]['dob'] = trim($row['H']);
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = trim($row['AA']);
									    $error[$j]['address'] =  trim($row['V']);
									    $error[$j]['educationalLevel'] = trim($row['K']);
									    $error[$j]['occupation'] = trim($row['L']);
									    $error[$j]['occupation_other'] = trim($row['M']);

                               

									    $error[$j]['hrg'] = trim($row['N']);
									    $error[$j]['arg'] = trim($row['O']);
									  
									    $error[$j]['monthlyIncome'] = trim($row['P']); 	
									    $error[$j]['maritalStatus'] = trim($row['Q']);
									    $error[$j]['maritalStatus_other'] = trim($row['R']);
									    $error[$j]['male_children'] = trim($row['S']);
									    $error[$j]['female_children'] = trim($row['T']);
									    $error[$j]['total_children'] = trim($row['U']);
									    $error[$j]['state'] = trim($row['W']);
									    $error[$j]['districtId'] = trim($row['X']);
									    $error[$j]['addressState'] = trim($row['Y']);
									    $error[$j]['addressDistrict'] = trim($row['Z']);
									  
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['sexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['prefferedGender'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);

									  	/* $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

										$error[$j]['fingerDate'] = trim($row['AN']);
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									 /* 	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

									  $error[$j]['saictcDate'] = trim($row['AP']);
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       /*$error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));*/
                                           $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 /*	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/

									 $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 /*$error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/
                                        $error[$j]['artDate'] = trim($row['BA']);
                                 	    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);								
								$j++;
							}
						}else{
							$error[$j]['error'] = 'Mobile Number should have 10 digits';
							 
							     		
							  /*   		$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/
							    $error[$j]['registeredOn'] = trim($row['A']);

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									   /* $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
									     $error[$j]['dob'] = trim($row['H']);
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] =trim($row['AA']);
									    $error[$j]['address'] =  trim($row['V']);
									    $error[$j]['educationalLevel'] = trim($row['K']);
									    $error[$j]['occupation'] = trim($row['L']);
									    $error[$j]['occupation_other'] = trim($row['M']);
									    $error[$j]['hrg'] = trim($row['N']);
									    $error[$j]['arg'] = trim($row['O']);
									  
									    $error[$j]['monthlyIncome'] = trim($row['P']); 	
									    $error[$j]['maritalStatus'] = trim($row['Q']);
									    $error[$j]['maritalStatus_other'] = trim($row['R']);
									    $error[$j]['male_children'] = trim($row['S']);
									    $error[$j]['female_children'] = trim($row['T']);
									    $error[$j]['total_children'] = trim($row['U']);
									    $error[$j]['state'] = trim($row['W']);
									    $error[$j]['districtId'] = trim($row['X']);
									    $error[$j]['addressState'] = trim($row['Y']);
									    $error[$j]['addressDistrict'] = trim($row['Z']);
									  
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['sexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['prefferedGender'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);

									/*  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/
										$error[$j]['fingerDate'] = trim($row['AN']);
									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									/*
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/

									  	 $error[$j]['saictcDate'] = trim($row['AP']);
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                               /*        $error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));*/
                                   $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									/* 	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));*/
									$error[$j]['reportIssuedDate'] = trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	/* $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/
                                     $error[$j]['artDate'] = trim($row['BA']);
									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);							
						$j++;
						}
					}
					else
					{
                         
                          $fields = []; 

                          if(trim($row['A']) == '')
                          {
                          	$fields[] = 'Registeration Date';
                          }
                           
                          if(trim($row['F']) == '')
                          {
                          	$fields[] = 'Name';
                          }

                          if(trim($row['I']) == '')
                          {
                          	$fields[] = 'Age';
                          }

                          if(trim($row['J']) == '')
                          {
                          	$fields[] = 'Gender';
                          }

                          if(trim($row['W']) == '')
                          {
	                          $fields[] = 'Current State';
                          }

                          if(trim($row['X']) == '')
                          {
	                         $fields[] = 'Current District';
                          }

                          if(trim($row['AN']) == '')
                          {
	                          $fields[] = 'Date of finger pricking test';
                          }

                          if(trim($row['AO']) == '')
                          {
	                           $fields[] = 'Referred To SA-ICTC';
                          }

                          $countNum = count($fields);


                         $fields = implode(',',$fields);
                          	
                        if($countNum == 1)
                        {
                         $error[$j]['error'] = $fields.' Field is mandatory';
                        }else{
                            	$error[$j]['error'] = $fields.' Fields are mandatory';
                        }	
					 
						     	/*	$error[$j]['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));*/
                                     $error[$j]['registeredOn'] = trim($row['A']);
							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									  /*  $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));*/
									    $error[$j]['dob'] = trim($row['H']);
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = trim($row['AA']);
									    $error[$j]['address'] =  trim($row['V']);
									    $error[$j]['educationalLevel'] = trim($row['K']);
									    $error[$j]['occupation'] = trim($row['L']);
									    $error[$j]['occupation_other'] = trim($row['M']);
									    $error[$j]['hrg'] = trim($row['N']);
									    $error[$j]['arg'] = trim($row['O']);
									  
									    $error[$j]['monthlyIncome'] = trim($row['P']); 	
									    $error[$j]['maritalStatus'] = trim($row['Q']);
									    $error[$j]['maritalStatus_other'] = trim($row['R']);
									    $error[$j]['male_children'] = trim($row['S']);
									    $error[$j]['female_children'] = trim($row['T']);
									    $error[$j]['total_children'] = trim($row['U']);
									    $error[$j]['state'] = trim($row['W']);
									    $error[$j]['districtId'] = trim($row['X']);
									    $error[$j]['addressState'] = trim($row['Y']);
									    $error[$j]['addressDistrict'] = trim($row['Z']);
									  
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['sexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['prefferedGender'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);

									  /*	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));*/

										$error[$j]['fingerDate'] = trim($row['AN']);
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  /*	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));*/
									   $error[$j]['saictcDate'] = trim($row['AP']);
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       /*$error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));*/

                                           $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] =trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	/* $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));*/
                                    	$error[$j]['artDate'] = trim($row['BA']);

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);	
						$j++;
					}
					$totalCount++;
				}
                // print_r($error);exit();
			
				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'userNew';
					
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/user');	
				}
			}
		}
	}


public function excelErrorFormat()
{
  $dataJson = $this->input->post('errorExcel');

 $dataArray = json_decode(htmlspecialchars_decode(str_replace('\\', '',$dataJson)),true);
//$dataArray = json_decode(htmlspecialchars_decode($dataJson), true);

 $j= 0;


$array1 = [];

foreach ($dataArray as $key => $value) {
    $array1[$j]['error'] = $value['error'];

    $array1[$j]['registeredOn'] = date('d/m/Y',strtotime(str_replace('/','-',$value['registeredOn']))) ;

  $array1[$j]['campCode'] = $value['campCode'];

  $array1[$j]['registeredBy'] = $value['registeredBy'];

  $array1[$j]['client_id'] = $value['client_id'];

  $array1[$j]['modeOfContact'] = $value['modeOfContact'];

  $array1[$j]['name'] = $value['name'];

  $array1[$j]['nameAlias'] = $value['nameAlias'];

  $array1[$j]['dob'] = date('d/m/Y',strtotime(str_replace('/','-',$value['dob'])));

  $array1[$j]['age'] = $value['age'];

  $array1[$j]['gender'] = $value['gender'];

  $array1[$j]['educationalLevel'] = $value['educationalLevel'];

  $array1[$j]['occupation'] = $value['occupation'];

  $array1[$j]['occupation_other'] = $value['occupation_other'];

  $array1[$j]['hrg'] = $value['hrg'];

  $array1[$j]['arg'] = $value['arg'];

  $array1[$j]['monthlyIncome'] = $value['monthlyIncome'];

  $array1[$j]['maritalStatus'] = $value['maritalStatus'];

  $array1[$j]['maritalStatus_other'] = $value['maritalStatus_other'];

  $array1[$j]['male_children'] = $value['male_children'];

  $array1[$j]['female_children'] = $value['female_children'];

  $array1[$j]['total_children'] = $value['total_children'];

  $array1[$j]['address'] = $value['address'];

  $array1[$j]['state'] = $value['state'];

  $array1[$j]['districtId'] = $value['districtId'];


  $array1[$j]['addressState'] = $value['addressState'];

  $array1[$j]['addressDistrict'] = $value['addressDistrict'];

 
  $array1[$j]['mobileNo'] = str_replace('+91',' ',$value['mobileNo'] ) ;

  $array1[$j]['referralPoint'] = $value['referralPoint'];

  $array1[$j]['referralPoint_others'] = $value['referralPoint_others'];

  $array1[$j]['sexualBehaviour'] = $value['sexualBehaviour'];

  $array1[$j]['multipleSexPartner'] = $value['multipleSexPartner'];

  $array1[$j]['sought'] = $value['sought'];

  $array1[$j]['prefferedGender'] = $value['prefferedGender'];

  $array1[$j]['prefferedSexualAct'] = $value['prefferedSexualAct'];

  $array1[$j]['condomUsage'] = $value['condomUsage'];

  $array1[$j]['substanceUse'] = $value['substanceUse'];

  $array1[$j]['hivTestResult'] = $value['hivTestResult'];

  $array1[$j]['hivTestTime'] = $value['hivTestTime'];

  $array1[$j]['pastHivReport'] = $value['pastHivReport'];

  $array1[$j]['fingerDate'] = date('d/m/Y',strtotime(str_replace('/','-',$value['fingerDate'])));

  $array1[$j]['saictcStatus'] = $value['saictcStatus'];

 if($value['saictcDate']) 
	{
	 $array1[$j]['saictcDate'] = date('d/m/Y',strtotime(str_replace('/','-',$value['saictcDate'])));
	}else{
		$array1[$j]['saictcDate'] = '';		
	}
 

  $array1[$j]['saictcPlace'] = $value['saictcPlace'];

  $array1[$j]['ictcNumber'] = $value['ictcNumber'];

  if($value['hivDate'])
{
  $array1[$j]['hivDate'] = date('d/m/Y',strtotime(str_replace('/','-',$value['hivDate'])));
}else{
	$array1[$j]['hivDate'] = '';
}

  $array1[$j]['hivStatus'] = $value['hivStatus'];

 if($value['reportIssuedDate']) 
 {  
	$array1[$j]['reportIssuedDate'] = date('d/m/Y',strtotime(str_replace('/','-',$value['reportIssuedDate'])));
 }else{
 	$array1[$j]['reportIssuedDate'] = '';
 }

  $array1[$j]['reportStatus'] = $value['reportStatus'];

  $array1[$j]['linkToArt'] = $value['linkToArt'];

  if($value['artDate'])
  {
  	 $array1[$j]['artDate'] = date('d/m/Y',strtotime(str_replace('/','-',$value['artDate'])));

  }else{
  	$array1[$j]['artDate'] = '';
  }	

 
  $array1[$j]['artNumber'] = $value['artNumber'];

  $array1[$j]['cd4Result'] = $value['cd4Result'];

  $array1[$j]['otherService'] = $value['otherService'];

  $array1[$j]['clientStatus'] = $value['clientStatus'];

  $array1[$j]['remark'] = $value['remark'];

  $j++;

}





   $table = 'user_excel_format';

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$rs = $this->db->get($table);

		  $array = $rs->result_array();

		$header = $array[0]; 

          $this->excel->getActiveSheet()->setCellValue('A1','Error');


			$this->excel->getActiveSheet()->fromArray($header, null, 'B1');

         $this->excel->getActiveSheet()->fromArray($array1, null, 'A2');

		//$this->excel->getActiveSheet()->getStyle('A1:AM1')->getFont()->setBold(true)->setSize(12);
		$filename='userUploadError.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output'); 
}





 }   