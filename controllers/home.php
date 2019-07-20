<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define("GOOGLE_API_KEY", "AIzaSyAxPmMr__6hq0_g-IPlEpccHOwyeKQWta4");

//new code

class Home extends CI_Controller {
   function __construct() {
		parent::__construct();
        $this->load->model('role/rolemaster');  
      date_default_timezone_set("Asia/Kolkata");
      ini_set('memory_limit','200M');
        
    } 
  
    public function index($msg = NULL){ 
		if($this->session->userdata('validated')){
			redirect(base_url().'home/dashboard');
		}
		$data['msg'] = $msg;
		 $data['content'] = 'login';
         $this->load->view('Layout/dashboardLayoutLogin',$data);   
  // 			$this->load->view('testing');
    }
	
	public function login() {
		if($this->session->userdata('validated')){
			redirect(base_url().'home/dashboard');
		}
		$this->load->model('role/rolemaster');
		//print_r($this->input->post());exit;
        $result = $this->rolemaster->validate($this->input->post());
		//print_r($result);exit;
	    if ($result[0]['responseCode']==0) {
            $msg = '<div class = "alert alert-error" style="background-color: #1ab394;margin:0px !important;">
                    <button type = "button" class = "close" data-dismiss = "alert">
                    <i class = "icon-remove"></i>
                    </button>
					<strong style="color:white;">
                    <i class = "icon-remove"></i>
                   '.$result[0]['responseMessage'].'
                    </strong>
					</div>';
			$this->index($msg);
        } else if ($this->session->userdata('validated')) {
			redirect(base_url().'home/dashboard');
		}
    }
	
	public function logout() {
 
        $this->rolemaster->logout($this->session->userdata('userId'),$this->session->userdata('logId'));	
		$this->session->sess_destroy();
        redirect(base_url().'home');
    }
	
	public function deletedTransData() {
        $this->load->model('role/rolemaster');
        $main = $this->rolemaster->deletedTransData();
        //print_r($main);
        //$res = json_encode($main);
        echo $main;
    }

    public function deletedTransDataNew1() {
        $this->load->model('role/rolemaster');
        // echo json_encode('jdfl');
        $main = $this->rolemaster->deletedTransDataNew1();
        //print_r($main);
        //$res = json_encode($main);
        echo $main;
    }
	
	public function dashboard() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		$this->load->model('role/rolemaster');
		$data['content'] = 'dashboard';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function importantLink() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['importantLinkById'] = $this->rolemaster->importantLinkById($id);
		}
		$this->load->model('role/rolemaster');
		$data['content'] = 'importantLink';
		$data['importantLinkList'] = $this->rolemaster->importantLinkList();
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addImportantLink() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);
		}else{
			$data['mode'] = '0';
		}
		$result = $this->rolemaster->addImportantLink($data);
		//echo '<pre>';print_r($result[0]['message']);exit;
		$this->session->set_flashdata('message',$result[0]['message']);
		redirect(base_url().'home/importantLink');
    }
	
	public function uploadExcelImportantLink(){
		if($_FILES['importExcel']['name']){		
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/importantLinkExcel/".$file_name;
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
				$j = 0; 
				$total=1;
				$totalCount = 1;
				foreach($arr_data as $row){
					if(trim($row['A']) != '' && trim($row['B']) != ''){
						$insert['linkUrl']	 = trim($row['A']);
						$insert['description']	 = trim($row['B']);
						$insert['createdBy']	 = $this->session->userdata('userId');
						$id = $this->common_model->insertValue('tbl_usefull_link', $insert);
						$total++;
					}else{
						$error[$j]['error'] = 'Field is mandatory';
						$error[$j]['linkUrl'] = trim($row['A']);
						$error[$j]['description'] = trim($row['B']);
						$j++;
					}
				$totalCount++;
				}
				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'importantLink';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/importantLink');	
				}
			}
		}
	}
	
	public function event() 
	{
		if(!$this->session->userdata('validated'))
		{
			redirect(base_url());
		}
		if(!empty($_GET['id']))
		{
			$action['mode']=2;
			$action['eventId'] = $_GET['id'];

			//print_r($action);  print_r($this->input->post()); exit();
			$data['eventEditData'] = $this->rolemaster->event($action);
			$data['id'] = $_GET['id'];
		}
		if($this->input->post())
		{
			if($this->uri->segment(3) != '')
			{
				//print_r($this->input->post());exit();
				if($_FILES['eventImage']['name'])
				{
					$actions['Image'] = time().'_eventImage_'.$_FILES['eventImage']['name'];
					$destination = './uploads/eventImage/' . $actions['Image'];
					move_uploaded_file($_FILES["eventImage"]["tmp_name"], $destination);
				}
				$action['mode']=1;
				$action['eventId'] = $this->uri->segment(3);
				$action['eventImage']=$actions['Image']; 
			}else{
				if($_FILES['eventImage']['name']){
					$actions['Image'] = time().'_eventImage_'.$_FILES['eventImage']['name'];
					$destination = './uploads/eventImage/' . $actions['Image'];
					move_uploaded_file($_FILES["eventImage"]["tmp_name"], $destination);
				}
				$action['mode']=0;
				$action['eventImage']=$actions['Image']; 
			}
			
			$resul = $this->rolemaster->event($action);
			$data = $resul[0]['message'];
			$this->session->set_flashdata('success_message',$data);
			redirect(base_url().'home/event');			
		}
		$data['content'] = 'event';
		$data['exceldaterange'] = '';
		$data['exceldaterange1'] = '';
		$data['upcomingeventList'] = $this->rolemaster->upcomingEventList();
		$data['pasteventList'] = $this->rolemaster->pastEventList();

		$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function editEvent($eventId)
    {
      if(!$this->session->userdata('validated')){
			redirect(base_url());
		}	

        $data['eventId'] = $eventId;	
    	$data['eventEditData'] = $this->rolemaster->editEvent($data);
			$data['id'] = $eventId;
        		
		$data['content'] = 'editEvent';

		$this->load->view('Layout/dashboardLayoutDash',$data);			
    }

    public function updateEvent()
    {
    	//print_r($this->input->post());exit();
      	if($_FILES['eventImage']['name'])
		{
			$actions['Image'] = time().'_eventImage_'.$_FILES['eventImage']['name'];
			$destination = './uploads/eventImage/' . $actions['Image'];
			move_uploaded_file($_FILES["eventImage"]["tmp_name"], $destination);
		}	
       $this->rolemaster->updateEvent($actions);
       
       redirect(base_url().'home/event');	
    }


    public function filterEvent()
    {
    	$data['daterange'] = $this->input->post('daterange');
    	$data['eventType'] = $this->input->post('eventType');
    	$data['daterange1'] = $this->input->post('daterange1');
    	

    	if($data['eventType'] == 'upcoming')
    	{
    		$data['exceleventType'] = $data['eventType'];
    		$data['exceldaterange']= $data['daterange'];
    		$data['upcomingeventList'] = $this->rolemaster->filterupcomingEventList($data);
    		$data['pasteventList'] = $this->rolemaster->pastEventList();
    	}else{
    		$data['exceleventType'] = $daa['eventType'];
    		$data['exceldaterange1']= $data['daterange'];
    		$data['pasteventList'] = $this->rolemaster->filterpastEventList($data);
    		$data['upcomingeventList'] = $this->rolemaster->upcomingEventList();
    	}	
			
		$data['content'] = 'event';

		$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function testing()
    {
    	//print_r($this->session->all_userdata());

    	$result = $this->rolemaster->campReportUniqueId();

    	print_r($result);
    }
	
	/*public function uploadExcelEvent(){
		if($_FILES['importExcel']['name']){		
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/eventExcel/".$file_name;
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

				 $images_data = array();
                    
									$i = 0;
					foreach ($objPHPExcel->getActiveSheet()->getDrawingCollection() as $drawing) {
					    if ($drawing instanceof PHPExcel_Worksheet_MemoryDrawing) {
					        ob_start();
					        call_user_func(
					            $drawing->getRenderingFunction(),
					            $drawing->getImageResource()
					        );
					        $imageContents = ob_get_contents();
					        ob_end_clean();

					        switch ($drawing->getMimeType()) {
					            case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_PNG :
					                    $extension = 'png'; break;
					            case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_GIF:
					                    $extension = 'gif'; break;
					            case PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_JPEG :
					                    $extension = 'jpg'; break;
					        }
					    } else {
					        $zipReader = fopen($drawing->getPath(),'r');
					        $imageContents = '';
					        while (!feof($zipReader)) {
					            $imageContents .= fread($zipReader,1024);
					        }
					        fclose($zipReader);
					        $extension = $drawing->getExtension();

					        //echo $drawing->getName();

					        $newArr = explode('.',$drawing->getName());

					        $string = str_replace(' ', '',$newArr[0]);

					       // echo $string;

					         $row = $drawing->getCoordinates();

					        //echo $extension;

					        //echo "<br>";
					    }
					    $myFileName = './uploads/eventImage/'.time().'_eventImage_'.$i++.'.'.$extension;

					    $imgArr = explode('/',$myFileName);

					   $images_data[$row] = $imgArr[3];


					   file_put_contents($myFileName,$imageContents);
					}

					asort($images_data);

					 $data2 =substr(max(array_keys($images_data)),1);

					 $data1 = substr(min(array_keys($images_data)),1);


				$j = 0; 
				$total=1;
				$totalCount = 1;
			
				foreach($arr_data as $row){
					if(trim($row['A']) != '' && trim($row['B']) != '' && trim($row['C']) != '' && trim($row['D']) != '')
					{
					  
						if(strlen(trim($row['G'])) == 0 || strlen(trim($row['G'])) == 10 )
						{	
							for($s = $data1;$s <= $data2;$s++)
					       {	
								$insert['eventName']	 = trim($row['A']);
								$insert['eventVenue']	 = trim($row['B']);
								//$insert['eventDate']	 = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(trim($row['C'])));
								$insert['startDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['C'])));
								$insert['startTime'] = PHPExcel_Style_NumberFormat::toFormattedString(($row['D']),'hh:mm:ss');
								$insert['endDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['E'])));
								$insert['endTime'] = PHPExcel_Style_NumberFormat::toFormattedString(($row['F']),'hh:mm:ss');
								$insert['mobileNo']	 = trim($row['G']);
								$insert['website']	 = trim($row['H']);
								//$insert['eventImage'] = trim($row['B']);
								$insert['otherInfo'] = trim($row['I']);
								//$insert['topic']	 = trim($row['F']);
								$insert['createdBy']	 = $this->session->userdata('userId');

								$key = 'J'.$s;

								$insert['eventImage'] = $images_data[$key];

								$id = $this->common_model->insertValue('tbl_event_data', $insert);

		                  
								$postdata['post_author']	 	= '1';
								$postdata['post_date']	 		= date('Y-m-d H:i:s');
								$postdata['post_date_gmt']	 	= date('Y-m-d H:i:s');
								$postdata['post_title']	 		= trim($row['A']);
								$postdata['post_status']		= 'publish';
								$postdata['post_name']	 		= trim($row['A']);
								$postdata['post_type']	 		= 'post';

								$postId = $this->common_model->insertValue('ccodes_sahya.wp_posts', $postdata);

								$postMaping['object_id']			= $postId;
								$postMaping['term_taxonomy_id']	 	= '76';
								$this->common_model->insertValue('ccodes_sahya.wp_term_relationships', $postMaping);	

								$s++;
						$total++;
                      
                        }

					 }else{
						$error[$j]['error'] = 'Mobile no should be 10 digits';
						$error[$j]['eventName'] = trim($row['A']);
						$error[$j]['eventVenue'] = trim($row['B']);
						$error[$j]['eventDate'] = trim($row['C']);
						$error[$j]['mobileNo'] = trim($row['D']);
						$error[$j]['website'] = trim($row['E']);
						$error[$j]['topic'] = trim($row['F']);
						$j++;
					}
                
                        
					}else{
						$error[$j]['error'] = 'Field is mandatory';
						$error[$j]['eventName'] = trim($row['A']);
						$error[$j]['eventVenue'] = trim($row['B']);
						$error[$j]['eventDate'] = trim($row['C']);
						$error[$j]['mobileNo'] = trim($row['D']);
						$error[$j]['website'] = trim($row['E']);
						$error[$j]['topic'] = trim($row['F']);
						$j++;
					}
				$totalCount++;
				}

				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'event';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/event');	
				}
			}
		}
	} */


	public function uploadExcelEvent(){
		if($_FILES['importExcel']['name']){		
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/eventExcel/".$file_name;
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

				

				$j = 0; 
				$total=1;
				$totalCount = 1;
			
				foreach($arr_data as $row){
					if(trim($row['A']) != '' && trim($row['B']) != '' && trim($row['C']) != '' && trim($row['D']) != '')
					{
					  
						if(strlen(trim($row['G'])) == 0 || strlen(trim($row['G'])) == 10 )
						{	
								
								$insert['eventName']	 = trim($row['A']);
								$insert['eventVenue']	 = trim($row['B']);
								//$insert['eventDate']	 = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP(trim($row['C'])));
								$insert['startDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['C'])));
								$insert['startTime'] = PHPExcel_Style_NumberFormat::toFormattedString(($row['D']),'hh:mm:ss');
								$insert['endDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['E'])));
								$insert['endTime'] = PHPExcel_Style_NumberFormat::toFormattedString(($row['F']),'hh:mm:ss');
								$insert['mobileNo']	 = trim($row['G']);
								$insert['website']	 = trim($row['H']);
								//$insert['eventImage'] = trim($row['B']);
								$insert['otherInfo'] = trim($row['I']);
								//$insert['topic']	 = trim($row['F']);
								$insert['createdBy']	 = $this->session->userdata('userId');

								$id = $this->common_model->insertValue('tbl_event_data', $insert);

		                  
								$postdata['post_author']	 	= '1';
								$postdata['post_date']	 		= date('Y-m-d H:i:s');
								$postdata['post_date_gmt']	 	= date('Y-m-d H:i:s');
								$postdata['post_title']	 		= trim($row['A']);
								$postdata['post_status']		= 'publish';
								$postdata['post_name']	 		= trim($row['A']);
								$postdata['post_type']	 		= 'post';

								$postId = $this->common_model->insertValue('ccodes_sahya.wp_posts', $postdata);

								$postMaping['object_id']			= $postId;
								$postMaping['term_taxonomy_id']	 	= '76';
								$this->common_model->insertValue('ccodes_sahya.wp_term_relationships', $postMaping);	

								$s++;
						$total++;
                      
                     }else{
						$error[$j]['error'] = 'Mobile no should be 10 digits';
						$error[$j]['eventName'] = trim($row['A']);
						$error[$j]['eventVenue'] = trim($row['B']);
						$error[$j]['eventDate'] = trim($row['C']);
						$error[$j]['mobileNo'] = trim($row['D']);
						$error[$j]['website'] = trim($row['E']);
						$error[$j]['topic'] = trim($row['F']);
						$j++;
					}
                
                        
					}else{
						$error[$j]['error'] = 'Field is mandatory';
						$error[$j]['eventName'] = trim($row['A']);
						$error[$j]['eventVenue'] = trim($row['B']);
						$error[$j]['eventDate'] = trim($row['C']);
						$error[$j]['mobileNo'] = trim($row['D']);
						$error[$j]['website'] = trim($row['E']);
						$error[$j]['topic'] = trim($row['F']);
						$j++;
					}
				$totalCount++;
				}

				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'event';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/event');	
				}
			}
		}
	}
	public function ongroundPartner() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

		$data['role_master'] = $this->rolemaster;
		$data['content'] = 'ongroundPartner';
		$data['stateList'] = $this->rolemaster->stateList();
		$data['exceldaterange'] = '';
		$data['ongroundPartnerList'] = $this->rolemaster->ongroundPartnerList();

	/*	echo "<pre>";

		print_r($data);exit();*/
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function filterongroundPartner()
    {
    	$data['role_master'] = $this->rolemaster;
    	$data['states'] = $this->input->post('states');
    	$data['daterange'] = $this->input->post('daterange');

        $data['exceldataName'] = $data['states'];
        $data['exceldaterange'] = $data['daterange'];
    	$data['ongroundPartnerList'] = $this->rolemaster->filterongroundPartner($data);
		$data['stateList'] = $this->rolemaster->stateList();
		$data['content'] = 'ongroundPartner';
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function uploadExcelOngroundPartner(){

		//echo 
		
		if($_FILES['importExcel']['name']){		
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/ongroundPartnerExcel/".$file_name;
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
				$j = 0; 
				$total=1;
				$totalCount = 1;
				foreach($arr_data as $row){
					if(trim($row['A']) != '' && trim($row['D']) != '' && trim($row['I']) != '' && trim($row['J']) != ''){
                       $checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['I']),trim($row['J']));

                       if($checkStateDistrict)
                       {
                          $latitude = trim($row['F']);

                          $longtitute = trim($row['G']);

                          $latArray = explode('.',$latitude);

                          $lonArray = explode('.',$longtitute);

                         if(empty($latitude) || (strlen($latArray[0]) == 2 && strlen($latArray[1]) == 4 ) ){
                    
                        if(empty($longtitute) || (strlen($lonArray[0]) == 2 && strlen($lonArray[1]) == 4 )){
                        	$uniqueId = $this->rolemaster->ongroundPartnerUniqueId(); 
	                          $insert['ongroundPartnerUniqueId'] = $uniqueId;
							$insert['name']	 = trim($row['A']);
							$insert['address']	 = trim($row['B']);
							$insert['mobile']	 = trim($row['D']);
							$insert['officePhone']	 = trim($row['C']);
							$insert['email']	 = trim($row['E']);
							$insert['location'] = trim($row['H']);
							$insert['stateId'] = $checkStateDistrict[0]['stateId'];
							$insert['districtId'] = $checkStateDistrict[0]['districtId'];
							$insert['dayAndTime'] = trim($row['K']);
							$insert['latitude']	 = trim($row['F']);
							$insert['longtitute']	 = trim($row['G']);
							//$insert['skypeId']	 = trim($row['H']);
							//$insert['website']	 = trim($row['I']);
							$insert['createdBy']	 = $this->session->userdata('userId');
							$id = $this->common_model->insertValue('tbl_onground_partner_data', $insert);
							$total++;
                        }else{
                        		$error[$j]['error'] = 'Longititude should be in xx.yyyy format';
						$error[$j]['name']	 = trim($row['A']);
						$error[$j]['address']	 = trim($row['B']);
						$error[$j]['mobile']	 = trim($row['D']);
						$error[$j]['officePhone']	 = trim($row['C']);
						$error[$j]['email']	 = trim($row['E']);
						$error[$j]['location'] = trim($row['H']);
						$error[$j]['stateId'] = trim($row['I']);
						$error[$j]['districtId'] = trim($row['J']);
						$error[$j]['dayAndTime'] = trim($row['K']);
						$error[$j]['latitude']	 = trim($row['F']);
						$error[$j]['longtitute']	 = trim($row['G']);
						$j++;
                        }      

                        	
                             
                        }else{
                        		$error[$j]['error'] = 'Latitude should be in xx.yyyy format';
						$error[$j]['name']	 = trim($row['A']);
						$error[$j]['address']	 = trim($row['B']);
						$error[$j]['mobile']	 = trim($row['D']);
						$error[$j]['officePhone']	 = trim($row['C']);
						$error[$j]['email']	 = trim($row['E']);
						$error[$j]['location'] = trim($row['H']);
						$error[$j]['stateId'] = trim($row['I']);
						$error[$j]['districtId'] = trim($row['J']);
						$error[$j]['dayAndTime'] = trim($row['K']);
						$error[$j]['latitude']	 = trim($row['F']);
						$error[$j]['longtitute']	 = trim($row['G']);
						$j++;
                        }  

                     
                       }else{
                       		$error[$j]['error'] = 'State and District does not match';
						$error[$j]['name']	 = trim($row['A']);
						$error[$j]['address']	 = trim($row['B']);
						$error[$j]['mobile']	 = trim($row['D']);
						$error[$j]['officePhone']	 = trim($row['C']);
						$error[$j]['email']	 = trim($row['E']);
						$error[$j]['location'] = trim($row['H']);
						$error[$j]['stateId'] = trim($row['I']);
						$error[$j]['districtId'] = trim($row['J']);
						$error[$j]['dayAndTime'] = trim($row['K']);
						$error[$j]['latitude']	 = trim($row['F']);
						$error[$j]['longtitute']	 = trim($row['G']);
						$j++;
                       }
						
					}else{
						$error[$j]['error'] = 'Field is mandatory';
						$error[$j]['name']	 = trim($row['A']);
						$error[$j]['address']	 = trim($row['B']);
						$error[$j]['mobile']	 = trim($row['D']);
						$error[$j]['officePhone']	 = trim($row['C']);
						$error[$j]['email']	 = trim($row['E']);
						$error[$j]['location'] = trim($row['H']);
						$error[$j]['stateId'] = trim($row['I']);
						$error[$j]['districtId'] = trim($row['J']);
						$error[$j]['dayAndTime'] = trim($row['K']);
						$error[$j]['latitude']	 = trim($row['F']);
						$error[$j]['longtitute']	 = trim($row['G']);
						$j++;
					}
				$totalCount++;
				}
				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'ongroundPartner';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/ongroundPartner');	
				}
			}
		}
	}
	
	public function smsModule() {
		if(!$this->session->userdata('validated')){
			redirect();
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['smsById'] = $this->rolemaster->smsById($id);
		}
		$this->load->model('role/rolemaster');
		$data['content'] = 'smsModule';
		$data['smsList'] = $this->rolemaster->smsList();
	    $data['uploadsmsList'] = $this->rolemaster->uploadsmsList();	
		$data['userList'] = $this->rolemaster->userList();
		$data['stateList'] = $this->rolemaster->stateList();
		$data['smsTemplate'] = $this->rolemaster->smsTemplate();
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addSMS() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);
		}else{

			//print_r($this->input->post());exit();
			$data['mode'] = '0';

			$users = $this->input->post('user');

			$message = $this->input->post('smsText');
			
       	  $message = str_replace(' ','%20',$message);

       	  $to = $this->input->post('to');

			$smsTime = date('d-m-Y');


			$userList = $this->rolemaster->getMobileUsers($users,$to);

		
			foreach ($userList as $key => $value) {
				
				 $smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$value['mobileNo'].'&message='.$message.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate='.$smsTime;
	
		               $ch = curl_init();
	                   curl_setopt($ch, CURLOPT_URL,$smsApi);
	                   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	                  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	                    curl_exec($ch);  

	             curl_close($ch);
			}

			

			/*foreach ($users as $user) 
			{
			  $result = $this->rolemaster->getMobile($user,$to);

			  	
			  $smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$result[0]['mobileNo'].'&message='.$message.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate='.$smsTime;
	
		               $ch = curl_init();
	                   curl_setopt($ch, CURLOPT_URL,$smsApi);
	                   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	                  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	                    curl_exec($ch);  

	             curl_close($ch);
			}*/
		}
		$result = $this->rolemaster->addSMS($data);
		$this->session->set_flashdata('message',$result[0]['message']);
		redirect(base_url().'home/smsModule');
    }
	
	public function getUsersList(){
		$main= $this->rolemaster->getUsersList();
        $res= json_encode($main);
        echo $res;
    }
	
	public function notification() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['notificationById'] = $this->rolemaster->notificationById($id);
		}
		$this->load->model('role/rolemaster');
		$data['content'] = 'notification';
		$data['notificationList'] = $this->rolemaster->notificationList();
		$data['userList'] = $this->rolemaster->userList();
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addNotification() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);
		}else{
			$data['mode'] = '0';
		}
		$result = $this->rolemaster->addNotification($data);
		$this->session->set_flashdata('message',$result[0]['message']);
		redirect(base_url().'home/notification');
    }
	
	public function serviceProvider() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['serviceProviderById'] = $this->rolemaster->serviceProviderById($id);

			//echo "<pre>"; print_r($data);exit();

			$data['content'] = 'editProvider';
		}else{
	        	$data['content'] = 'serviceProvider';		
		}
	
		$data['serviceProviderList'] = $this->rolemaster->serviceProviderList();
     
		$result = $this->rolemaster->serviceProviderUniqueId();
		$data['serviceProviderUniqueId'] = $result;
		$data['serviceTypeList'] = $this->rolemaster->serviceTypeList();
		$data['stateList'] = $this->rolemaster->stateList();
		$data['modeList'] = $this->rolemaster->modeList();
		$data['exceldaterange'] = '';
		$data['exceldataName'] = '';
		$data['serviceTypeParameterList'] = $this->rolemaster->serviceTypeParameterList();
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function filterServiceProvider()
    {
    	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

    	$data['role_master'] = $this->rolemaster;
    	$data['states'] = $this->input->post('states');
        $data['daterange'] = $this->input->post('daterange');
		$data['serviceProviderList'] = $this->rolemaster->filterServiceProvider($data);
		$result = $this->rolemaster->serviceProviderUniqueId();
		$data['serviceProviderUniqueId'] = $result;
		$data['serviceTypeList'] = $this->rolemaster->serviceTypeList();
		$data['stateList'] = $this->rolemaster->stateList();
		$data['modeList'] = $this->rolemaster->modeList();
		$data['exceldaterange'] =  $data['daterange'] ;
		$data['exceldataName'] = $data['states'];
		$data['content'] = 'serviceProvider';
		$data['serviceTypeParameterList'] = $this->rolemaster->serviceTypeParameterList();
		$this->load->view('Layout/dashboardLayoutDash',$data);	
    }

    public function uploadExcelServiceProvider()
	{
		if($_FILES['importExcel']['name'])
		{		
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/serviceProviderExcel/".$file_name;
			if(move_uploaded_file($_FILES["importExcel"]["tmp_name"],$file_path)){
				$this->load->library('excel');
				$arr_data = array();
				$objPHPExcel = PHPExcel_IOFactory::load($file_path);
		
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
				$p = 0;
				foreach ($cell_collection as $cell){
					$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
					$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
					if ($row == 1) {
						$header[$row][$p] = $data_value;
					} 
					else 
					{
					   $arr_data[$row][$column] = $data_value;
					}
				$p++;
				}
				$j = 0; 
				$total=1;
				$totalCount = 1;	

			
			/*foreach ($arr_data as $row) 
				{
					print_r($row);
				}

				die;*/

				foreach($arr_data as $row)
				{
					$aa = array_keys(array_keys($row));
					$cc = array_combine($aa,$row);
					if(trim($row['A']) != '' && trim($row['B']) != '' && trim($row['C']) != '' && trim($row['D']) != '' && trim($row['F']) != '' && trim($row['H']) != '' && trim($row['I']) != '' && trim($row['J']) != '' && trim($row['K']) != '' && trim($row['L']) != '' && trim($row['M']) == '' && trim($row['N']) != '' && trim($row['P']) != '' &&trim($row['V']) != '')
					{
						$checkUniqueNumber = $this->rolemaster->checkUniqueNumber(trim($row['A'])); 
						 //print_r($row['A']);	
						//print_r($checkUniqueNumber);exit;
						if($checkUniqueNumber[0]['total'] == 0) 
						{
							$serviceTypeExist = $this->rolemaster->serviceTypeExist(trim($row['K']));
							//print_r($serviceTypeExist);exit();
							if($serviceTypeExist || empty($serviceTypeExist)){
								$checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['J']),trim($row['I']));
								//print_r($checkStateDistrict);exit;
								if($checkStateDistrict)
								{
									$conModeExist = $this->rolemaster->conModeExist(trim($row['Q']));
									//print_r($conModeExist);exit;
									if(empty($conModeExist))
									{	
										$this->db->select('serviceTypeParameterName');

                                         $this->db->from('tbl_service_type_parameters');

                                         $query = $this->db->get();

                                         $subCategaries = $query->result_array();

										$checkServiceFields = $this->rolemaster->checkServiceFields($subCategaries,$serviceTypeExist[0]['serviceTypeId']);
										//print_r($checkServiceFields);exit;
										if($checkServiceFields['status'] == 'true' || $checkServiceFields['status'] == 'false')
										{

                                            //echo "ghjgfh";exit;
											$insert['uniqueId']	 = trim($row['A']);	
											$insert['name']	 = trim($row['B']);
											$insert['address']	 = trim($row['C']);
											$insert['mobile']	 = trim($row['D']);
											$insert['officePhone']	 = trim($row['E']);
											$insert['email']	 =trim($row['F']);
											$insert['otherMobile']	 = trim($row['G']);
											$insert['location']	 = trim($row['H']);
											$insert['districtId']	 = $checkStateDistrict[0]['districtId'];
											$insert['state']	 = $checkStateDistrict[0]['stateId'];
											$insert['serviceTypeId']	 = $serviceTypeExist[0]['serviceTypeId'];
											$insert['rating']	 = trim($row['L']);
											$insert['qualification']	 = trim($row['M']);
											$insert['affiliation']	 = trim($row['N']);
											$insert['linkage']	 = trim($row['O']);
											$insert['dayAndTime']	 = trim($row['P']);
											$insert['conFace']	 = trim($row['Q']); 
											$insert['conHome'] = trim($row['R']);
											$insert['conTel'] = trim($row['S']);
											$insert['conEmail'] = trim($row['T']);
											$insert['conOnline'] = trim($row['U']);
											$insert['conCharges']	 = trim($row['V']);
											$insert['concession']	 = trim($row['W']);
											$insert['latitude']	 = trim($row['X']);
											$insert['longitude']	 = trim($row['Y']);
											$insert['createdBy'] = $this->session->userdata('userId');
											$id = $this->common_model->insertValue('tbl_service_provider_details', $insert);
											if($serviceTypeExist[0]['serviceTypeId'] == 1)
											{
												$o = 21; $p = 57;
											}else if ($serviceTypeExist[0]['serviceTypeId'] == 2)
											{
											
												$o = 21; $p = 57;
											}else if ($serviceTypeExist[0]['serviceTypeId'] == 3)
											{
												$o = 21; $p = 57;
											}else 
											{
												$o = 0; $p = 0;
											}

									
											//$vv = explode(',',$checkServiceFields['values']);

											 $this->db->select('serviceTypeParameterId');

											 $this->db->from('tbl_service_type_parameters');

											 $query =  $this->db->get();

											 $serviceTypeParameterId = $query->result_array();
											$h = 0;
										
										  do{	  
                                              for($l=28;$l<=64;$l++)
                                              {	
                                                 $this->common_model->insertValue('tbl_service_provider_fields', array('serviceProviderId'=>$id,'value' => $cc[$l],'serviceTypeParameterId'=>$serviceTypeParameterId[$h]['serviceTypeParameterId']));
                                                 $h++;
                                               }
                                            }while($h<=36);	
											$total++;
										}
										else
										{
											$error[$j]['error'] = 'Service Fields Not Match for '.trim($row['K']);
											$error[$j]['uniqueId']	 = trim($row['A']);	
											$error[$j]['name']	 = trim($row['B']);
											$error[$j]['address']	 = trim($row['C']);
											$error[$j]['mobile']	 = trim($row['D']);
											$error[$j]['officePhone']	 = trim($row['E']);
											$error[$j]['email']	 =trim($row['F']);
											$error[$j]['otherMobile']	 = trim($row['G']);
											$error[$j]['location']	 = trim($row['H']);
											$error[$j]['districtId']	 = trim($row['I']);
											$error[$j]['state']	 = trim($row['J']);
											$error[$j]['serviceTypeId']	 =trim($row['K']);
											$error[$j]['rating']	 = trim($row['L']);
											$error[$j]['qualification']	 = trim($row['M']);
											$error[$j]['affiliation']	 = trim($row['N']);
											$error[$j]['linkage']	 = trim($row['O']);
											$error[$j]['dayAndTime']	 = trim($row['P']);
											$error[$j]['conFace']	 = trim($row['Q']);
											$error[$j]['conHome'] = trim($row['R']);
											$error[$j]['conTel'] = trim($row['S']);
											$error[$j]['conEmail'] = trim($row['T']);
											$error[$j]['conOnline'] = trim($row['U']);
											$error[$j]['conCharges']	 = trim($row['V']);
											$error[$j]['concession']	 = trim($row['W']);
											$error[$j]['latitude']	 = trim($row['X']);
											$error[$j]['longitude']	 = trim($row['Y']);
											 $error[$j]['sexualhealthservices'] = trim($row['Z']);
											 $error[$j]['mentalhealthservices'] = trim($row['AA']);
											 $error[$j]['Legalaidservices'] = trim($row['AB']);
						                     $error[$j]['shs1'] = trim($row['AC']);
						                     $error[$j]['shs2'] = trim($row['AD']);
						                     $error[$j]['shs3'] = trim($row['AE']);
						                      $error[$j]['shs4'] = trim($row['AF']);
						                     $error[$j]['shs5'] = trim($row['AG']);
						                     $error[$j]['shs6'] = trim($row['AH']);
						                     $error[$j]['shs7'] = trim($row['AI']);
						                      $error[$j]['shs8'] = trim($row['AJ']);
						                   $error[$j]['shs9'] = trim($row['AK']);
						                   $error[$j]['shs10'] = trim($row['AL']);
						                       $error[$j]['mhs1'] = trim($row['AM']);
						                       $error[$j]['mhs2'] = trim($row['AN']);
						                       $error[$j]['mhs3'] = trim($row['AO']);
						                       $error[$j]['mhs4'] = trim($row['AP']);
						                       $error[$j]['mhs5'] = trim($row['AQ']);
						                       $error[$j]['mhs6'] = trim($row['AR']);
						                      $error[$j]['mhs7'] = trim($row['AS']);
						                       $error[$j]['mhs8'] = trim($row['AT']);
						                     $error[$j]['mhs9'] = trim($row['AU']);
						                      $error[$j]['mhs10'] = trim($row['AV']);
						                      $error[$j]['mhs11'] = trim($row['AW']);
						                       $error[$j]['mhs12'] = trim($row['AX']);
						                       $error[$j]['mhs13'] = trim($row['AY']);
						                        $error[$j]['las1'] = trim($row['AZ']);
						                        $error[$j]['las2'] = trim($row['BA']);
						                          $error[$j]['las3'] = trim($row['BB']);
						                           $error[$j]['las4'] = trim($row['BC']);
						                           $error[$j]['las5'] = trim($row['BD']);
						                            $error[$j]['las6'] = trim($row['BE']);
						                            $error[$j]['las7'] = trim($row['BF']);
						                             $error[$j]['las8'] = trim($row['BG']);
						                              $error[$j]['las9'] = trim($row['BH']);
						                             $error[$j]['las10'] = trim($row['BI']);
						                             $error[$j]['las11'] = trim($row['BJ']);
						                             $error[$j]['las12'] = trim($row['BK']);
						                             $error[$j]['las13'] = trim($row['BL']);
						                             $error[$j]['las14'] = trim($row['BM']);

											$j++;
										}
									}
									else
									{
										$error[$j]['error'] = 'Consultation Mode Not Exist';
										$error[$j]['uniqueId']	 = trim($row['A']);	
											$error[$j]['name']	 = trim($row['B']);
											$error[$j]['address']	 = trim($row['C']);
											$error[$j]['mobile']	 = trim($row['D']);
											$error[$j]['officePhone']	 = trim($row['E']);
											$error[$j]['email']	 =trim($row['F']);
											$error[$j]['otherMobile']	 = trim($row['G']);
											$error[$j]['location']	 = trim($row['H']);
											$error[$j]['districtId']	 = trim($row['I']);
											$error[$j]['state']	 = trim($row['J']);
											$error[$j]['serviceTypeId']	 =trim($row['K']);
											$error[$j]['rating']	 = trim($row['L']);
											$error[$j]['qualification']	 = trim($row['M']);
											$error[$j]['affiliation']	 = trim($row['N']);
											$error[$j]['linkage']	 = trim($row['O']);
											$error[$j]['dayAndTime']	 = trim($row['P']);
											$error[$j]['conFace']	 = trim($row['Q']);
											$error[$j]['conHome'] = trim($row['R']);
											$error[$j]['conTel'] = trim($row['S']);
											$error[$j]['conEmail'] = trim($row['T']);
											$error[$j]['conOnline'] = trim($row['U']);
											$error[$j]['conCharges']	 = trim($row['V']);
											$error[$j]['concession']	 = trim($row['W']);
											$error[$j]['latitude']	 = trim($row['X']);
											$error[$j]['longitude']	 = trim($row['Y']);
											 $error[$j]['sexualhealthservices'] = trim($row['Z']);
											 $error[$j]['mentalhealthservices'] = trim($row['AA']);
											 $error[$j]['Legalaidservices'] = trim($row['AB']);
						                     $error[$j]['shs1'] = trim($row['AC']);
						                     $error[$j]['shs2'] = trim($row['AD']);
						                     $error[$j]['shs3'] = trim($row['AE']);
						                      $error[$j]['shs4'] = trim($row['AF']);
						                     $error[$j]['shs5'] = trim($row['AG']);
						                     $error[$j]['shs6'] = trim($row['AH']);
						                     $error[$j]['shs7'] = trim($row['AI']);
						                      $error[$j]['shs8'] = trim($row['AJ']);
						                   $error[$j]['shs9'] = trim($row['AK']);
						                   $error[$j]['shs10'] = trim($row['AL']);
						                       $error[$j]['mhs1'] = trim($row['AM']);
						                       $error[$j]['mhs2'] = trim($row['AN']);
						                       $error[$j]['mhs3'] = trim($row['AO']);
						                       $error[$j]['mhs4'] = trim($row['AP']);
						                       $error[$j]['mhs5'] = trim($row['AQ']);
						                       $error[$j]['mhs6'] = trim($row['AR']);
						                      $error[$j]['mhs7'] = trim($row['AS']);
						                       $error[$j]['mhs8'] = trim($row['AT']);
						                     $error[$j]['mhs9'] = trim($row['AU']);
						                      $error[$j]['mhs10'] = trim($row['AV']);
						                      $error[$j]['mhs11'] = trim($row['AW']);
						                       $error[$j]['mhs12'] = trim($row['AX']);
						                       $error[$j]['mhs13'] = trim($row['AY']);
						                        $error[$j]['las1'] = trim($row['AZ']);
						                        $error[$j]['las2'] = trim($row['BA']);
						                          $error[$j]['las3'] = trim($row['BB']);
						                           $error[$j]['las4'] = trim($row['BC']);
						                           $error[$j]['las5'] = trim($row['BD']);
						                            $error[$j]['las6'] = trim($row['BE']);
						                            $error[$j]['las7'] = trim($row['BF']);
						                             $error[$j]['las8'] = trim($row['BG']);
						                              $error[$j]['las9'] = trim($row['BH']);
						                             $error[$j]['las10'] = trim($row['BI']);
						                             $error[$j]['las11'] = trim($row['BJ']);
						                             $error[$j]['las12'] = trim($row['BK']);
						                             $error[$j]['las13'] = trim($row['BL']);
						                             $error[$j]['las14'] = trim($row['BM']);
										
				


										$j++;
									}
								}
								else
								{
									$error[$j]['error'] = 'State or District Not Exist';
									$error[$j]['uniqueId']	 = trim($row['A']);	
											$error[$j]['name']	 = trim($row['B']);
											$error[$j]['address']	 = trim($row['C']);
											$error[$j]['mobile']	 = trim($row['D']);
											$error[$j]['officePhone']	 = trim($row['E']);
											$error[$j]['email']	 =trim($row['F']);
											$error[$j]['otherMobile']	 = trim($row['G']);
											$error[$j]['location']	 = trim($row['H']);
											$error[$j]['districtId']	 = trim($row['I']);
											$error[$j]['state']	 = trim($row['J']);
											$error[$j]['serviceTypeId']	 =trim($row['K']);
											$error[$j]['rating']	 = trim($row['L']);
											$error[$j]['qualification']	 = trim($row['M']);
											$error[$j]['affiliation']	 = trim($row['N']);
											$error[$j]['linkage']	 = trim($row['O']);
											$error[$j]['dayAndTime']	 = trim($row['P']);
											$error[$j]['conFace']	 = trim($row['Q']);
											$error[$j]['conHome'] = trim($row['R']);
											$error[$j]['conTel'] = trim($row['S']);
											$error[$j]['conEmail'] = trim($row['T']);
											$error[$j]['conOnline'] = trim($row['U']);
											$error[$j]['conCharges']	 = trim($row['V']);
											$error[$j]['concession']	 = trim($row['W']);
											$error[$j]['latitude']	 = trim($row['X']);
											$error[$j]['longitude']	 = trim($row['Y']);
											 $error[$j]['sexualhealthservices'] = trim($row['Z']);
											 $error[$j]['mentalhealthservices'] = trim($row['AA']);
											 $error[$j]['Legalaidservices'] = trim($row['AB']);
						                     $error[$j]['shs1'] = trim($row['AC']);
						                     $error[$j]['shs2'] = trim($row['AD']);
						                     $error[$j]['shs3'] = trim($row['AE']);
						                      $error[$j]['shs4'] = trim($row['AF']);
						                     $error[$j]['shs5'] = trim($row['AG']);
						                     $error[$j]['shs6'] = trim($row['AH']);
						                     $error[$j]['shs7'] = trim($row['AI']);
						                      $error[$j]['shs8'] = trim($row['AJ']);
						                   $error[$j]['shs9'] = trim($row['AK']);
						                   $error[$j]['shs10'] = trim($row['AL']);
						                       $error[$j]['mhs1'] = trim($row['AM']);
						                       $error[$j]['mhs2'] = trim($row['AN']);
						                       $error[$j]['mhs3'] = trim($row['AO']);
						                       $error[$j]['mhs4'] = trim($row['AP']);
						                       $error[$j]['mhs5'] = trim($row['AQ']);
						                       $error[$j]['mhs6'] = trim($row['AR']);
						                      $error[$j]['mhs7'] = trim($row['AS']);
						                       $error[$j]['mhs8'] = trim($row['AT']);
						                     $error[$j]['mhs9'] = trim($row['AU']);
						                      $error[$j]['mhs10'] = trim($row['AV']);
						                      $error[$j]['mhs11'] = trim($row['AW']);
						                       $error[$j]['mhs12'] = trim($row['AX']);
						                       $error[$j]['mhs13'] = trim($row['AY']);
						                        $error[$j]['las1'] = trim($row['AZ']);
						                        $error[$j]['las2'] = trim($row['BA']);
						                          $error[$j]['las3'] = trim($row['BB']);
						                           $error[$j]['las4'] = trim($row['BC']);
						                           $error[$j]['las5'] = trim($row['BD']);
						                            $error[$j]['las6'] = trim($row['BE']);
						                            $error[$j]['las7'] = trim($row['BF']);
						                             $error[$j]['las8'] = trim($row['BG']);
						                              $error[$j]['las9'] = trim($row['BH']);
						                             $error[$j]['las10'] = trim($row['BI']);
						                             $error[$j]['las11'] = trim($row['BJ']);
						                             $error[$j]['las12'] = trim($row['BK']);
						                             $error[$j]['las13'] = trim($row['BL']);
						                             $error[$j]['las14'] = trim($row['BM']);
									

									$j++;
								}
							}
							else
							{
								$error[$j]['error'] = 'Service Type not exist';
								$error[$j]['uniqueId']	 = trim($row['A']);	
											$error[$j]['name']	 = trim($row['B']);
											$error[$j]['address']	 = trim($row['C']);
											$error[$j]['mobile']	 = trim($row['D']);
											$error[$j]['officePhone']	 = trim($row['E']);
											$error[$j]['email']	 =trim($row['F']);
											$error[$j]['otherMobile']	 = trim($row['G']);
											$error[$j]['location']	 = trim($row['H']);
											$error[$j]['districtId']	 = trim($row['I']);
											$error[$j]['state']	 = trim($row['J']);
											$error[$j]['serviceTypeId']	 =trim($row['K']);
											$error[$j]['rating']	 = trim($row['L']);
											$error[$j]['qualification']	 = trim($row['M']);
											$error[$j]['affiliation']	 = trim($row['N']);
											$error[$j]['linkage']	 = trim($row['O']);
											$error[$j]['dayAndTime']	 = trim($row['P']);
											$error[$j]['conFace']	 = trim($row['Q']);
											$error[$j]['conHome'] = trim($row['R']);
											$error[$j]['conTel'] = trim($row['S']);
											$error[$j]['conEmail'] = trim($row['T']);
											$error[$j]['conOnline'] = trim($row['U']);
											$error[$j]['conCharges']	 = trim($row['V']);
											$error[$j]['concession']	 = trim($row['W']);
											$error[$j]['latitude']	 = trim($row['X']);
											$error[$j]['longitude']	 = trim($row['Y']);
											 $error[$j]['sexualhealthservices'] = trim($row['Z']);
											 $error[$j]['mentalhealthservices'] = trim($row['AA']);
											 $error[$j]['Legalaidservices'] = trim($row['AB']);
						                     $error[$j]['shs1'] = trim($row['AC']);
						                     $error[$j]['shs2'] = trim($row['AD']);
						                     $error[$j]['shs3'] = trim($row['AE']);
						                      $error[$j]['shs4'] = trim($row['AF']);
						                     $error[$j]['shs5'] = trim($row['AG']);
						                     $error[$j]['shs6'] = trim($row['AH']);
						                     $error[$j]['shs7'] = trim($row['AI']);
						                      $error[$j]['shs8'] = trim($row['AJ']);
						                   $error[$j]['shs9'] = trim($row['AK']);
						                   $error[$j]['shs10'] = trim($row['AL']);
						                       $error[$j]['mhs1'] = trim($row['AM']);
						                       $error[$j]['mhs2'] = trim($row['AN']);
						                       $error[$j]['mhs3'] = trim($row['AO']);
						                       $error[$j]['mhs4'] = trim($row['AP']);
						                       $error[$j]['mhs5'] = trim($row['AQ']);
						                       $error[$j]['mhs6'] = trim($row['AR']);
						                      $error[$j]['mhs7'] = trim($row['AS']);
						                       $error[$j]['mhs8'] = trim($row['AT']);
						                     $error[$j]['mhs9'] = trim($row['AU']);
						                      $error[$j]['mhs10'] = trim($row['AV']);
						                      $error[$j]['mhs11'] = trim($row['AW']);
						                       $error[$j]['mhs12'] = trim($row['AX']);
						                       $error[$j]['mhs13'] = trim($row['AY']);
						                        $error[$j]['las1'] = trim($row['AZ']);
						                        $error[$j]['las2'] = trim($row['BA']);
						                          $error[$j]['las3'] = trim($row['BB']);
						                           $error[$j]['las4'] = trim($row['BC']);
						                           $error[$j]['las5'] = trim($row['BD']);
						                            $error[$j]['las6'] = trim($row['BE']);
						                            $error[$j]['las7'] = trim($row['BF']);
						                             $error[$j]['las8'] = trim($row['BG']);
						                              $error[$j]['las9'] = trim($row['BH']);
						                             $error[$j]['las10'] = trim($row['BI']);
						                             $error[$j]['las11'] = trim($row['BJ']);
						                             $error[$j]['las12'] = trim($row['BK']);
						                             $error[$j]['las13'] = trim($row['BL']);
						                             $error[$j]['las14'] = trim($row['BM']);
								
						        $j++;	
							}
						}else{
							$error[$j]['error'] = 'Unique Number';
							$error[$j]['uniqueId']	 = trim($row['A']);	
											$error[$j]['name']	 = trim($row['B']);
											$error[$j]['address']	 = trim($row['C']);
											$error[$j]['mobile']	 = trim($row['D']);
											$error[$j]['officePhone']	 = trim($row['E']);
											$error[$j]['email']	 =trim($row['F']);
											$error[$j]['otherMobile']	 = trim($row['G']);
											$error[$j]['location']	 = trim($row['H']);
											$error[$j]['districtId']	 = trim($row['I']);
											$error[$j]['state']	 = trim($row['J']);
											$error[$j]['serviceTypeId']	 =trim($row['K']);
											$error[$j]['rating']	 = trim($row['L']);
											$error[$j]['qualification']	 = trim($row['M']);
											$error[$j]['affiliation']	 = trim($row['N']);
											$error[$j]['linkage']	 = trim($row['O']);
											$error[$j]['dayAndTime']	 = trim($row['P']);
											$error[$j]['conFace']	 = trim($row['Q']);
											$error[$j]['conHome'] = trim($row['R']);
											$error[$j]['conTel'] = trim($row['S']);
											$error[$j]['conEmail'] = trim($row['T']);
											$error[$j]['conOnline'] = trim($row['U']);
											$error[$j]['conCharges']	 = trim($row['V']);
											$error[$j]['concession']	 = trim($row['W']);
											$error[$j]['latitude']	 = trim($row['X']);
											$error[$j]['longitude']	 = trim($row['Y']);
											 $error[$j]['sexualhealthservices'] = trim($row['Z']);
											 $error[$j]['mentalhealthservices'] = trim($row['AA']);
											 $error[$j]['Legalaidservices'] = trim($row['AB']);
						                     $error[$j]['shs1'] = trim($row['AC']);
						                     $error[$j]['shs2'] = trim($row['AD']);
						                     $error[$j]['shs3'] = trim($row['AE']);
						                      $error[$j]['shs4'] = trim($row['AF']);
						                     $error[$j]['shs5'] = trim($row['AG']);
						                     $error[$j]['shs6'] = trim($row['AH']);
						                     $error[$j]['shs7'] = trim($row['AI']);
						                      $error[$j]['shs8'] = trim($row['AJ']);
						                   $error[$j]['shs9'] = trim($row['AK']);
						                   $error[$j]['shs10'] = trim($row['AL']);
						                       $error[$j]['mhs1'] = trim($row['AM']);
						                       $error[$j]['mhs2'] = trim($row['AN']);
						                       $error[$j]['mhs3'] = trim($row['AO']);
						                       $error[$j]['mhs4'] = trim($row['AP']);
						                       $error[$j]['mhs5'] = trim($row['AQ']);
						                       $error[$j]['mhs6'] = trim($row['AR']);
						                      $error[$j]['mhs7'] = trim($row['AS']);
						                       $error[$j]['mhs8'] = trim($row['AT']);
						                     $error[$j]['mhs9'] = trim($row['AU']);
						                      $error[$j]['mhs10'] = trim($row['AV']);
						                      $error[$j]['mhs11'] = trim($row['AW']);
						                       $error[$j]['mhs12'] = trim($row['AX']);
						                       $error[$j]['mhs13'] = trim($row['AY']);
						                        $error[$j]['las1'] = trim($row['AZ']);
						                        $error[$j]['las2'] = trim($row['BA']);
						                          $error[$j]['las3'] = trim($row['BB']);
						                           $error[$j]['las4'] = trim($row['BC']);
						                           $error[$j]['las5'] = trim($row['BD']);
						                            $error[$j]['las6'] = trim($row['BE']);
						                            $error[$j]['las7'] = trim($row['BF']);
						                             $error[$j]['las8'] = trim($row['BG']);
						                              $error[$j]['las9'] = trim($row['BH']);
						                             $error[$j]['las10'] = trim($row['BI']);
						                             $error[$j]['las11'] = trim($row['BJ']);
						                             $error[$j]['las12'] = trim($row['BK']);
						                             $error[$j]['las13'] = trim($row['BL']);
						                             $error[$j]['las14'] = trim($row['BM']);
							

						    $j++;
						}
					}else{
						$error[$j]['error'] = 'Field is mandatory';
						$error[$j]['uniqueId']	 = trim($row['A']);	
											$error[$j]['name']	 = trim($row['B']);
											$error[$j]['address']	 = trim($row['C']);
											$error[$j]['mobile']	 = trim($row['D']);
											$error[$j]['officePhone']	 = trim($row['E']);
											$error[$j]['email']	 =trim($row['F']);
											$error[$j]['otherMobile']	 = trim($row['G']);
											$error[$j]['location']	 = trim($row['H']);
											$error[$j]['districtId']	 = trim($row['I']);
											$error[$j]['state']	 = trim($row['J']);
											$error[$j]['serviceTypeId']	 =trim($row['K']);
											$error[$j]['rating']	 = trim($row['L']);
											$error[$j]['qualification']	 = trim($row['M']);
											$error[$j]['affiliation']	 = trim($row['N']);
											$error[$j]['linkage']	 = trim($row['O']);
											$error[$j]['dayAndTime']	 = trim($row['P']);
											$error[$j]['conFace']	 = trim($row['Q']);
											$error[$j]['conHome'] = trim($row['R']);
											$error[$j]['conTel'] = trim($row['S']);
											$error[$j]['conEmail'] = trim($row['T']);
											$error[$j]['conOnline'] = trim($row['U']);
											$error[$j]['conCharges']	 = trim($row['V']);
											$error[$j]['concession']	 = trim($row['W']);
											$error[$j]['latitude']	 = trim($row['X']);
											$error[$j]['longitude']	 = trim($row['Y']);
											 $error[$j]['sexualhealthservices'] = trim($row['Z']);
											 $error[$j]['mentalhealthservices'] = trim($row['AA']);
											 $error[$j]['Legalaidservices'] = trim($row['AB']);
						                     $error[$j]['shs1'] = trim($row['AC']);
						                     $error[$j]['shs2'] = trim($row['AD']);
						                     $error[$j]['shs3'] = trim($row['AE']);
						                      $error[$j]['shs4'] = trim($row['AF']);
						                     $error[$j]['shs5'] = trim($row['AG']);
						                     $error[$j]['shs6'] = trim($row['AH']);
						                     $error[$j]['shs7'] = trim($row['AI']);
						                      $error[$j]['shs8'] = trim($row['AJ']);
						                   $error[$j]['shs9'] = trim($row['AK']);
						                   $error[$j]['shs10'] = trim($row['AL']);
						                       $error[$j]['mhs1'] = trim($row['AM']);
						                       $error[$j]['mhs2'] = trim($row['AN']);
						                       $error[$j]['mhs3'] = trim($row['AO']);
						                       $error[$j]['mhs4'] = trim($row['AP']);
						                       $error[$j]['mhs5'] = trim($row['AQ']);
						                       $error[$j]['mhs6'] = trim($row['AR']);
						                      $error[$j]['mhs7'] = trim($row['AS']);
						                       $error[$j]['mhs8'] = trim($row['AT']);
						                     $error[$j]['mhs9'] = trim($row['AU']);
						                      $error[$j]['mhs10'] = trim($row['AV']);
						                      $error[$j]['mhs11'] = trim($row['AW']);
						                       $error[$j]['mhs12'] = trim($row['AX']);
						                       $error[$j]['mhs13'] = trim($row['AY']);
						                        $error[$j]['las1'] = trim($row['AZ']);
						                        $error[$j]['las2'] = trim($row['BA']);
						                          $error[$j]['las3'] = trim($row['BB']);
						                           $error[$j]['las4'] = trim($row['BC']);
						                           $error[$j]['las5'] = trim($row['BD']);
						                            $error[$j]['las6'] = trim($row['BE']);
						                            $error[$j]['las7'] = trim($row['BF']);
						                             $error[$j]['las8'] = trim($row['BG']);
						                              $error[$j]['las9'] = trim($row['BH']);
						                             $error[$j]['las10'] = trim($row['BI']);
						                             $error[$j]['las11'] = trim($row['BJ']);
						                             $error[$j]['las12'] = trim($row['BK']);
						                             $error[$j]['las13'] = trim($row['BL']);
						                             $error[$j]['las14'] = trim($row['BM']);
						

						$j++;
					}
				$totalCount++;
				}
				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'serviceProvider';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect('home/serviceProvider');	
				}
			}
		}
	}

	
	public function addServiceProvider() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);
		}else{
			$data['mode'] = '0';


		}
		$result = $this->rolemaster->addServiceProvider($data);
		$this->session->set_flashdata('message',$result[0]['message']);
		redirect(base_url().'home/serviceProvider');
    }
	
	
	
	public function getServiceUniqueId(){
		$main= $this->rolemaster->getServiceUniqueId();
        $res= json_encode($main);
        echo $res;
    }
	
	public function getServiceFields(){
		$main= $this->rolemaster->serviceTypeParameterList();
        $res= json_encode($main);
        echo $res;
    }
	
	public function getDistrict(){
		$main= $this->rolemaster->getDistrict();
        $res= json_encode($main);
        echo $res;
    }
	
	public function user() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['id'] = $id;
			$data['userById'] = $this->rolemaster->userById($id);

   
			$data['content'] = 'editUserNew';
			//print_r($data);exit();
		}else{
			$data['content'] = 'userNew';
		}
		
		$data['role_master'] = $this->rolemaster;
		//$data['content'] = 'user';
		$data['exceldaterange'] = '';
		$data['exceldaterange'] = '';
		$data['activeuserList'] = $this->rolemaster->activeuserList();
		$data['inactiveuserList'] = $this->rolemaster->inactiveuserList();
		$data['empUser'] = $this->rolemaster->empUser(3);
        $data['websiteUser'] = $this->rolemaster->websiteUser();

		$data['stateList'] = $this->rolemaster->stateList();
		//	print_r($data);exit();
		
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addUser() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);

			$this->rolemaster->updateUser($data);
			$this->session->set_flashdata('message','User updated successfully');
		}else{
			$data['mode'] = '0';
			$userId =  $this->rolemaster->addUser($data);
            
            $result = $this->rolemaster->userById($userId);

            $message = "User created successfully with uniqueId ".$result[0]['client_id'];

			 $this->session->set_flashdata('message',$message);
		}
		
		
		redirect(base_url().'home/user');
    }

    public function filterUser()
    {
    	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

    	$data['daterange'] = $this->input->post('daterange');
    
        $data['userBy'] = $this->input->post('userBy');
    
    	$data['userType'] = $this->input->post('userType');

    	$data['wildcard'] = $this->input->post('wildcard');

    	$data['searchData'] = $this->input->post('searchData');

    	$data['stateFilter'] = $this->input->post('stateFilter');

 //added by subhjeet 05-06-2019
    	$data['campCode'] =$this->input->post('campCode');	
//ended by subhjeet	05-06-2019
    if(!empty($data['districtFilter'] ))
    	{$data['districtFilter'] = implode(',',$this->input->post('districtFilter'));}

    	$data['role_master'] = $this->rolemaster;

    	if($data['userType'] == 'active')
        {
        	$data['exceldaterange'] = $data['daterange'];
        	$data['activeuserList']  = $this->rolemaster->filterUser($data);
        	$data['inactiveuserList'] = $this->rolemaster->inactiveuserList();
        }else{
        	$data['exceldaterange1'] = $data['daterange'];
        	$data['activeuserList'] = $this->rolemaster->activeuserList();
        	$data['inactiveuserList'] = $this->rolemaster->filterUser($data);
        }   

        $data['empUser'] = $this->rolemaster->empUser(3);
    	
         $data['websiteUser'] = $this->rolemaster->websiteUser();


    	$data['stateList'] = $this->rolemaster->stateList();

    	$data['content'] = 'userNew';

		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	
	public function getUserUniqueId(){
		$main= $this->rolemaster->getUserUniqueId();
        $res= json_encode($main);
        echo $res;
    }
	
	public function uploadExcelUser(){
		if($_FILES['importExcel']['name']){		
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
				$j = 0; 
				$total=1;
				$totalCount = 1;
				
				foreach($arr_data as $row){
					if(trim($row['F']) != ''  && trim($row['I']) != '' && trim($row['J']) != '' && trim($row['W']) != '' && trim($row['X']) != ''  && trim($row['AN']) != '' && trim($row['AO']) != ''   && trim($row['V']) != '' )
					{
						$len = strlen(trim($row['AA']));

					 $checkRegistertionNumber = $this->rolemaster->checkRegistertionNumber(trim($row['D']));
					 

					
					  	if($len == 10 || $len == 0)
						  {
							$checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['W']),trim($row['X']));
							// echo '<pre>';print_r($checkStateDistrict);exit;
							if($checkStateDistrict){
								
								$checkStateDistrict1 = $this->rolemaster->checkStateDistrict(trim($row['Y']),trim($row['Z']));
							
								if($checkStateDistrict1)
							  {	
							  	if($len !=  0)
							  	{
							  		 $mobile1 = '+91'.trim($row['AA']); 
							     $userMobile = $this->rolemaster->checkUserMobile($mobile1);
							 	}

							     if(empty($userMobile))
							     {
							     	//echo $row['M'];

							     if(empty($checkRegistertionNumber)){
							     	if(!empty(trim($row['A'])))
							     	{
							     		$insert['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));

							     	}
                                 

							     	  /* $uniqueIdNew = $this->rolemaster->createUserUniqueIdExcel(trim($row['E']),trim($row['N']));	*/

							     	    //$insert['client_id'] = $uniqueIdNew;
							     	    $insert['campCode'] = trim($row['B']);
							     	    $insert['registeredBy'] = trim($row['C']);
							     	    $insert['client_id'] = trim($row['D']);
							     	    $insert['modeOfContact'] = trim($row['E']);
							     	    
							     	  //  $insert['registerFromDevice'] = trim($row['D']);
										$insert['userName'] = trim($row['AA']);
									    $insert['password'] = md5('123456');
									    $insert['name'] = trim($row['F']);
									    $insert['nameAlias'] = trim($row['G']);

									  if(!empty(trim($row['H'])))  
									 	{  
									 	 $insert['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									 	}
									    $insert['age'] = trim($row['I']);
									    $insert['gender'] = trim($row['J']);
									   if(!empty(trim($row['AA']))) 
									  {  $insert['mobileNo'] = '+91'.trim($row['AA']);}
									    $insert['address'] =  trim($row['V']);
									    $insert['educationalLevel'] = trim($row['K']);
									    $insert['occupation'] = trim($row['L']);
									    $insert['occupation_other'] = trim($row['M']);
									    $insert['hrg'] = trim($row['N']);
									    $insert['arg'] = trim($row['O']);
									   // $insert['domainOfWork'] = trim($row['P']);
									    $insert['monthlyIncome'] = trim($row['P']); 	
									    $insert['maritalStatus'] = trim($row['Q']);
									    $insert['maritalStatus_other'] = trim($row['R']);
									    $insert['male_children'] = trim($row['S']);
									    $insert['female_children'] = trim($row['T']);
									    $insert['total_children'] = trim($row['U']);
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
									  	 $insert['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									  }  
									   
									    $insert['saictcStatus'] = trim($row['AO']);

									  if(!empty(trim($row['AP'])))  
									  {
									  	$insert['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  }
									    
									    $insert['saictcPlace'] = trim($row['AQ']);
									    $insert['ictcNumber'] = trim($row['AR']);
                                     
                                     if(!empty(trim($row['AS'])))
                                     {
                                       $insert['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));
                                     }	
									    $insert['hivStatus'] = trim($row['AT']);

									 if(!empty(trim($row['AU'])))
									 {
									 	 $insert['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));
									 }   
									   
									    $insert['reportStatus'] = trim($row['AV']);

									    $insert['linkToArt'] = trim($row['AW']);
                                    
                                    if(!empty(trim($row['AX'])))
                                    {
                                    	 $insert['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

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
							     }else{
							     	$error[$j]['error'] = 'Registration Number already exist';

							     		
							     		$error[$j]['registeredOn'] =trim($row['A']);

							     
                                 

							     	

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = '+91'.trim($row['AA']);
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

									  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

                                    	

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);
							 		
								$j++;
							     }	

							     	
							 }else{
							 		$error[$j]['error'] = 'Mobile Number already exist';

							     		
							     		$error[$j]['registeredOn'] =trim($row['A']);

							     
                                 

							     	

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = '+91'.trim($row['AA']);
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

									  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] =trim($row['AS']);
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

                                    	

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);
							 		
								$j++;
							 }

							}else{
								$error[$j]['error'] = 'Native State or Native District not Match';
								  
							    	
							     		$error[$j]['registeredOn'] =trim($row['A']);

							     
                                 

							     	

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = '+91'.trim($row['AA']);
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

									  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] =trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

                                    	

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);
								$j++;
							}
							}else{
								$error[$j]['error'] = 'State or District of address not Match ';
								 	
							     		$error[$j]['registeredOn'] =trim($row['A']);

							     
                                 

							     	

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = '+91'.trim($row['AA']);
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

									  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

                                    	

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);								
								$j++;
							}
						}else{
							$error[$j]['error'] = 'Mobile Number should have 10 digits';
							 
							     		
							     		$error[$j]['registeredOn'] =trim($row['A']);

							     
                                 

							     	

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = '+91'.trim($row['AA']);
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

									  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

                                    	

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);							
						$j++;
						}
					}else{
						$error[$j]['error'] = 'Field is mandatory';
					 
							     		
							     		$error[$j]['registeredOn'] =trim($row['A']);

							     
                                 

							     	

							     	   
							     	    $error[$j]['campCode'] = trim($row['B']);
							     	    $error[$j]['registeredBy'] = trim($row['C']);
							     	    $error[$j]['client_id'] = trim($row['D']);
							     	    $error[$j]['modeOfContact'] = trim($row['E']);
							     	    
							     	 
										$error[$j]['userName'] = trim($row['AA']);
									   
									    $error[$j]['name'] = trim($row['F']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['H'])));
									    $error[$j]['age'] = trim($row['I']);
									    $error[$j]['gender'] = trim($row['J']);
									    $error[$j]['mobileNo'] = '+91'.trim($row['AA']);
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

									  	 $error[$j]['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));

									
									   
									    $error[$j]['saictcStatus'] = trim($row['AO']);

									
									  	$error[$j]['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									  
									    
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
                               
                                       $error[$j]['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));
                                     	
									    $error[$j]['hivStatus'] = trim($row['AT']);

									
									 	 $error[$j]['reportIssuedDate'] =trim($row['AU']);
									    
									   
									    $error[$j]['reportStatus'] = trim($row['AV']);

									    $error[$j]['linkToArt'] = trim($row['AW']);
                                    
                                  
                                    	 $error[$j]['artDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['BA'])));

                                    	

									    
									     $error[$j]['artNumber'] = trim($row['AY']);
									     $error[$j]['cd4Result'] = trim($row['AZ']);
									     $error[$j]['otherService'] = trim($row['BA']);
									     $error[$j]['clientStatus'] = trim($row['BB']);
									    
									    $error[$j]['remark']= trim($row['BC']);	
						$j++;
					}
					$totalCount++;
				}

				//print_r($error);exit();
                  	
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
	
	public function quiz() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['quizById'] = $this->rolemaster->quizById($id);
		}
		$data['content'] = 'quiz';
		$data['quizNameList'] = $this->rolemaster->quizNameList();
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addQuiz() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);

			if($_FILES['quizImage']['name']){
					$data['image'] = time().'_quiz_'.$_FILES['quizImage']['name'];
					$destination = './uploads/quizImage/' . $data['image'];
					move_uploaded_file($_FILES["quizImage"]["tmp_name"], $destination);
			
		}else{
			$data['mode'] = '0';

	     }
		}
		$result = $this->rolemaster->addQuiz($data);
		$this->session->set_flashdata('message',$result[0]['message']);
		redirect(base_url().'home/quiz');
    }
	
	public function getQuizQuestions(){
		$main= $this->rolemaster->getQuizQuestions();
		$htm = '<table class="table table-striped table-bordered table-hover">
					<thead>
					<tr>
						<th>Quiz Questions</th>
						<th>Options</th>
						<th>Answer</th>
					</tr>
					</thead>
					<tbody>';
				foreach($main as $value) {
					$htm .= '<tr>
								<td rowspan = "'.$value['totalOptions'].'">'.$value['quizQuestionName'].'</td>
								<td>'.$value['quizQuestionOptionName'].'</td>
								<td>';
								if($value['quizQuestionAnswer'] == 1){
									$htm .= '<i class="fa fa-check" aria-hidden="true" style="color: green;font-size: 22px;"></i>';
								}else{
									$htm .= '<i class="fa fa-times" aria-hidden="true" style="color: red;font-size: 22px;"></i>';
								} 
				
						$htm .= '</td>
							</tr>';
						$options = $this->rolemaster->getQuestionOptions($value); 
						foreach($options as $val) {
						$htm .= '<tr>
									<td>'.$val['quizQuestionOptionName'].'</td>
									<td>';
									if($val['quizQuestionAnswer'] == 1){
										$htm .=  '<i class="fa fa-check" aria-hidden="true" style="color: green;font-size: 22px;"></i>';
									}else{
										$htm .=  '<i class="fa fa-times" aria-hidden="true" style="color: red;font-size: 22px;"></i>';
									} 
							$htm .= '</td>
								</tr>';
						}
				}
				$htm .= '</tbody>
				</table>';
		echo $htm;
    }	

    public function uploadExcelQuiz()
    {
    	//echo "<pre>";
       if($_FILES['importExcel']['name'])
       {
            $file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/quizExcel/".$file_name;
			if(move_uploaded_file($_FILES["importExcel"]["tmp_name"],$file_path)){
				$this->load->library('excel');
				$arr_data = array();
				$objPHPExcel = PHPExcel_IOFactory::load($file_path);
				$sheet = $objPHPExcel->getSheet(0);
				$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
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
               $highestRow = $sheet->getHighestRow();
               $highestColumn = $sheet->getHighestColumn();

               $obj = ($objPHPExcel->setActiveSheetIndex(0)->rangeToArray('A1:B1'));
				 $quizNameColumn = $obj[0][0];
				  $quizName = $obj[0][1];
				$obj1 = ($objPHPExcel->setActiveSheetIndex(0)->rangeToArray('A2:B2'));
			      $totalQuestionsColumn = $obj1[0][0];
				   $totalQuestions = $obj1[0][1];
				$obj2 = ($objPHPExcel->setActiveSheetIndex(0)->rangeToArray('A3:C3'));
				   $questionColumn = $obj2[0][0];
				   $numberOfAnswerColumn = $obj2[0][1];
                   $typeOfAnswer = $obj2[0][2];
                 if(trim($quizName) != '' && trim($totalQuestions) != '')
                 {
                 	 $insert['quizName'] = trim($quizName);
					 $insert['TotalNoOfQuestion'] = trim($totalQuestions);
					 $insert['createdBy'] = $this->session->userdata('userId');
						
					 $quizId = $this->common_model->insertValue('`tbl_quiz_names`',$insert);
					 //echo $highestRow; exit;
					 for($i=4;$i<=$highestRow;$i++)
				   {
                     $rowData = $sheet->rangeToArray('A'.$i.':'.$highestColumn.$i,NULL,TRUE,FALSE);

                     //print_r($rowData);
                     $questionInsert['quizId'] =  $quizId;
                   	  // $questionInsert['quizId'] =  1;
                       $questionInsert['quizQuestionName'] = trim($rowData[0][0]);
                       $questionInsert['numberOfAnswer'] = trim($rowData[0][1]);
                       $questionInsert['typeOfAnswer'] = trim($rowData[0][2]);
                       $questionInsert['NumberOfCorrectOptions'] = trim($rowData[0][18]);
                       $questionInsert['MarksForEachCorrectAnswe'] = trim($rowData[0][19]);
                       $questionInsert['correctOptions'] = trim($rowData[0][20]);
                       $questionInsert['AdditionalInfoInCaseOfWrongAnswer'] = trim($rowData[0][21]);
                       $questionInsert['AdditionalInfoInCaseOfCorrectAnswer'] = trim($rowData[0][21]);
                       $questionInsert['createdBy'] = $this->session->userdata('userId');
                          
                     //  print_r($questionInsert);   
                     //  echo "<br />";
                      $quizQuestionId = $this->common_model->insertValue('`tbl_quiz_questions`',$questionInsert);
               
                      $colNumber = PHPExcel_Cell::columnIndexFromString('R');

                     for($j=3;$j<=$colNumber-1;$j++)
                     { 
                     	$optionValue = $objWorksheet->getCellByColumnAndRow($j,$i)->getValue();

                         $optionValue = trim($optionValue);

                     	if(!empty($optionValue))
                     	{                  
                   	       $optionInsert['quizQuestionId'] = $quizQuestionId;	
                   	     //  $optionInsert['quizQuestionId'] = 1;	
                          $optionValue1 = $optionValue;
                          $optionInsert['quizQuestionOptionName'] = trim($optionValue1);
                          //echo $rowData[0][20];
                          if(!empty($rowData[0][20]))
                          {

                          	$searchString = '||';
                          	if(strpos($rowData[0][20], $searchString) !== false )
                             {
                               $options = explode('||',$rowData[0][20]);
                               if(in_array($optionValue,$options))
                               {
                                 $optionInsert['quizQuestionAnswer'] = '1';
                               } 
                               else
                               {
                               	 $optionInsert['quizQuestionAnswer'] = '0';
                               }	
                             }
                             else
                             {
                             	
                             	if($optionValue == trim($rowData[0][20]))
                               {
                                 $optionInsert['quizQuestionAnswer'] = '1';
                               } 
                               else
                               {
                               	 $optionInsert['quizQuestionAnswer'] = '0';
                               }
                             	
                             }	

                          }	
                          else
                          {
                          	$optionInsert['quizQuestionAnswer'] = '0';
                          }
                                               
                           $this->common_model->insertValue('`tbl_quiz_question_options`',$optionInsert);
                     	}
                        
                     }  
                       
				    }


			    }
			    else
			    {
			    	
			    	for ($i=4; $i < $highestRow; $i++) 
			    	{ 
			    	  	$rowData = $sheet->rangeToArray('A'.$i.':'.$highestColumn.$i,NULL,TRUE,FALSE);
			    	  	$error['error'] = 'Field is mandatory';
			    	    $error['quizName'] = $quizName;
			    	    $error['TotalNoOfQuestion'] = $totalQuestions;

			    	    $error['question'] = $rowData[0][0];
			    	    $error['numberofcorrectoptions'] = $rowData[0][18];
			    	    $error['marksforeachcorrectanswer'] = $rowData[0][19];
			    	    $error['correctOptions'] = $rowData[0][20];
			    	    $error['AdditionalInfoInCaseOfCorrectAnswer'] = $rowData[0][21];
			    	    $error['AdditionalInfoInCaseOfWrongAnswer'] = $rowData[0][22];

			    	   $rowData1 = $sheet->rangeToArray('D'.$i.':'.'R'.$i,NULL,TRUE,FALSE);
			      	$rowData2 = (array_filter($rowData1[0]));
			      	$options = implode(',',$rowData2);
			      	 $error['options'] = $options;
			      	 $er[]=$error;
                
	    	  	
			      }
			    }

			  

			  if($er){
					$data['er']=$er;
					//$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'quiz';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/quiz');	
				}  	
          }
     } 
 }
	
	
	public function download() 
	{
		$table = $this->uri->segment(3);

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$rs = $this->db->get($table);

		//print_r($rs->result_array());

		//echo "<br>/";

          
        $array = $rs->result_array();

		//print_r($excel_data);

		//Fill data
		$this->excel->getActiveSheet()->fromArray($array, null, 'A1');
		//$this->excel->getActiveSheet()->getStyle('A1:AM1')->getFont()->setBold(true)->setSize(12);
		$filename=$table.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');


	}
	
	public function smsTemplate() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$id = $this->uri->segment(3);
			$data['smsTemplateById'] = $this->rolemaster->smsTemplateById($id);
		}
		$this->load->model('role/rolemaster');
		$data['content'] = 'smsTemplate';
		$data['contentActive'] = 'sms';
		$data['smsTemplate'] = $this->rolemaster->smsTemplate();
		$this->load->view('Layout/dashboardLayoutDash',$data);
    }
	
	public function addSMSTemplate() {
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		if($this->uri->segment(3)){
			$data['mode'] = '1';
			$data['id'] = $this->uri->segment(3);
		}else{
			$data['mode'] = '0';
		}
		$result = $this->rolemaster->addSMSTemplate($data);
		$this->session->set_flashdata('message',$result[0]['message']);
		redirect(base_url().'home/smsTemplate');
    }

    public function comments()
    {
      if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
			
       $data['content'] = 'comments';

       $data['pendingComments'] = $this->rolemaster->comments('pending'); 
       $data['approvedComments'] = $this->rolemaster->comments('approved');
       $data['rejectedComments'] = $this->rolemaster->comments('rejected');

   
       $this->load->view('Layout/dashboardLayoutDash',$data);
    }

     public function changeCommentStatus()
    {
    	$data['commentId'] = $this->input->post('commentId');

    	$data['status'] = $this->input->post('status');

    	$this->rolemaster->changeCommentStatus($data);

    	redirect(base_url().'home/comments');
     }

     public function getContactRequest()
     {
       if(!$this->session->userdata('validated')){
			redirect(base_url());
		}	

     	$data['contactRequest'] = $this->rolemaster->getContactRequest();

        $data['content'] = 'contactRequest';

       $this->load->view('Layout/dashboardLayoutDash',$data);        

     }

     public function commentsWp()
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$data['pendingComments'] = $this->rolemaster->pendingCommentsWp();

     	$data['approvedComments'] = $this->rolemaster->approvedCommentsWp();

     	$data['content'] = 'commentsWp';

     	$this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function changeCommentStatusWp()
     {
        $data['commentId'] = $this->input->post('commentId');

    	$data['status'] = $this->input->post('status');

    	$data['anotherStatus'] = $this->input->post('anotherStatus');

    	$res = $this->rolemaster->changeCommentStatusWp($data);

		if ($res) {
    		echo json_encode(['responseCode'=>'200','responseMessage'=>'Status updated successfully']);
    	}else{
    		echo json_encode(['responseCode'=>'0','responseMessage'=>'Error occured in updation']);
    	}

    	//redirect(base_url().'home/commentsWp');
      	
     }

      public function logs()
     { 
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	 $data['logsList'] = $this->rolemaster->logs();

     	 $data['loggedInLogs'] = $this->rolemaster->loggedInLogs();

     	 $data['content'] = 'logs';

     	 $this->load->view('Layout/dashboardLayoutDash',$data);
     }

      public function ongroundPartnerById($ongroundPartnerId)
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

         $data['ongroundPartnerId'] = $ongroundPartnerId;

         $data['stateList'] = $this->rolemaster->stateList();

         $data['ongroundPartnerById'] = $this->rolemaster->ongroundPartnerById($ongroundPartnerId);

         $data['content'] = 'editPartner';

        $this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function updatePartner()
     {
     	$this->rolemaster->updatePartner();

     	redirect(base_url().'home/ongroundPartner');
     }


     public function voucherDetail()
     {

       if(!$this->session->userdata('validated')){
			redirect(base_url());
		}	

     	$data['serviceProviderVouchers'] = $this->rolemaster->serviceProviderVouchers();

     	$data['quizVouchers'] = $this->rolemaster->quizVouchers();

     	$data['excelFilter'] = '';

     	$data['exceldaterange'] = '';

     	$data['exceldataName'] = '';

     	$data['content'] = 'vouchers';

     	$this->load->view('Layout/dashboardLayoutDash',$data);
     }

       public function getServiceProviders()
     {
     	$main = $this->rolemaster->serviceProviderList();

     	$res = json_encode($main);

     	echo $res;
     }

     public function getOngroundPartner()
     {
     	$main = $this->rolemaster->ongroundPartnerList();

     	$res = json_encode($main);

     	echo $res;
     }

      public function getquiz()
      {
      	 $main = $this->rolemaster->quizNameList();

      	 $res = json_encode($main);

      	 echo $res;
      }

     public function filterVoucher()
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$data['voucherName'] = $this->input->post('voucherName');

     	$data['filter'] = $this->input->post('filter');

     	$data['daterange'] = $this->input->post('daterange');

     	$data['dataName'] = $this->input->post('dataName');

     	if($data['voucherName'] == 'serviceAccess')
     	{
    		
     		   $data['serviceProviderVouchers'] = $this->rolemaster->filterServiceVoucher($data);

     		   $data['quizVouchers'] = $this->rolemaster->quizVouchers();

     		   $data['serviceAccess'] = 'serviceAccess';


     		   $data['excelFilter'] = $data['filter'];

     		   $data['exceldaterange'] = $data['daterange'];

     		   $data['exceldataName'] = $data['dataName'];


     		   $data['content'] = 'vouchers';

     		   $this->load->view('Layout/dashboardLayoutDash',$data);    			
     	}
     	else{

     		$data['serviceProviderVouchers'] = $this->rolemaster->serviceProviderVouchers();

     		$data['quizVouchers'] = $this->rolemaster->filterGiftCoupon($data);

     		$data['giftCoupon'] = 'giftCoupon';

     		 $data['excelFilter'] = $data['filter'];

     		   $data['exceldaterange'] = $data['daterange'];

     		   $data['exceldataName'] = $data['dataName'];

     		 $data['content'] = 'vouchers';

     		 $this->load->view('Layout/dashboardLayoutDash',$data);    			
     	}	

     	
     }

     public function filterLogs()
     {
       if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$dates = explode('-',$this->input->post('daterange'));

     	$data['startDate'] = date('Y-m-d',strtotime($dates[0])).' 00:00:00';

     	$data['endDate'] = date('Y-m-d',strtotime($dates[1])).' 23:59:59';

     	$data['logsList'] = $this->rolemaster->filterLogs($data);

     	 $data['loggedInLogs'] = $this->rolemaster->loggedInLogs();

     	 $data['content'] = 'logs';

     	 $this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function staff()
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

		$data['role_master'] = $this->rolemaster;

     	 $data['staffMember'] = $this->rolemaster->staff();

     	  $data['roles'] = $this->rolemaster->roles();

     	  $data['empUser'] = $this->rolemaster->empUser(3);

     	 $data['content'] = 'staff';

     	  $this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function filterStaff()
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     		$data['daterange'] = $this->input->post('daterange');
    
        $data['userBy'] = $this->input->post('userBy');
    
    	$data['userType'] = $this->input->post('userType');

    	$data['wildcard'] = $this->input->post('wildcard');

    	$data['role_master'] = $this->rolemaster;

     	 $data['staffMember'] = $this->rolemaster->filterStaff($data);

     	  $data['roles'] = $this->rolemaster->roles();

     	  $data['empUser'] = $this->rolemaster->empUser(3);

     	 $data['content'] = 'staff';

     	  $this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function createStaff()
     {
     	$this->rolemaster->createStaff();

     	redirect(base_url().'home/staff');
     }

     public function editStaff($staffId)
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$data['staffId'] = $staffId;

        $data['staffData'] = $this->rolemaster->staffById($staffId);

          $data['roles'] = $this->rolemaster->roles();

        $data['ongroundPartnerList'] =  $this->rolemaster->ongroundPartnerList(); 

       $data['serviceProviderList']=  $this->rolemaster->serviceProviderList();

         $data['content'] = 'editStaff';

     	  $this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function updateStaff()
     {
     	$this->rolemaster->updateStaff();

     	redirect(base_url().'home/staff');
     }

     public function test1()
	  {
	  	 print_r($this->session->all_userdata());
	  }

  public function userSms()
  {
  	if(!$this->session->userdata('validated')){
		redirect(base_url());
	}

  	 $data['smsList'] = $this->rolemaster->userSms();

  	 $data['content'] = 'userSms';

  	  $this->load->view('Layout/dashboardLayoutDash',$data);
  }

    public function filterUserSms()
  {
  	if(!$this->session->userdata('validated')){
		redirect(base_url());
	}

  	$data['daterange'] = $this->input->post('daterange');

  	 $data['smsList'] = $this->rolemaster->filterUserSms($data);

  	 $data['content'] = 'userSms';

  	  $this->load->view('Layout/dashboardLayoutDash',$data);
  }

  public function downloadSmsUser()
  {
  	  $this->load->library('excel');

	$this->excel->setActiveSheetIndex(0);

	$result = $this->rolemaster->downloadSmsUser();

	$filename = 'smsUser.xls';

	$header = array('Mobile No','Latest CONSENT confirm date','Latest CONSENT confirm time','Latest STOP Request date','Latest STOP Request time','Created Date');

	$this->excel->getActiveSheet()->getStyle('A1:AB1')->getFont()->setBold(true);

	$this->excel->getActiveSheet()->fromArray($header,null,'A1');

	$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

	//$filename=$table.'.xlsx'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header('Pragma: public');
   
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');

  }

  public function downloadUserSms()
  {

 	  $this->load->library('excel');

	$this->excel->setActiveSheetIndex(0);

	$result = $this->rolemaster->downloadUserSms();

	$filename = 'contentSMSLogs.xls';

	$header = array('SMS Content','MobileNo','Created Date');

	$this->excel->getActiveSheet()->getStyle('A1:AB1')->getFont()->setBold(true);

	$this->excel->getActiveSheet()->fromArray($header,null,'A1');

	$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

	//$filename=$table.'.xlsx'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header('Pragma: public');
   
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');


  }



  public function downlaodEventdata()
 {
 	  $this->load->library('excel');

	$this->excel->setActiveSheetIndex(0);

	$result = $this->rolemaster->downloadEventData();

	$filename = 'eventData.xls';

	$header = array('Event Name','Venue','Start Date','Start Time','End Date','End Time','Mobile Number','Website','Other Info','Created Date');

	$this->excel->getActiveSheet()->getStyle('A1:AB1')->getFont()->setBold(true);

	$this->excel->getActiveSheet()->fromArray($header,null,'A1');

	$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

	//$filename=$table.'.xlsx'; //save our workbook as this file name
	header('Content-Type: application/vnd.ms-excel'); //mime type
	header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
	header('Cache-Control: max-age=0'); //no cache
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header('Pragma: public');
   
	//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
	//if you want to save it as .XLSX Excel 2007 format
	$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
	//force user to download the Excel file without writing it to server's HD
	$objWriter->save('php://output');


 }

 public function downloadStock()
  {
  	$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$result = $this->rolemaster->downloadStock();

		$stateDetails = $this->rolemaster->state_by_id($this->input->post('state'));

		//print_r($stateDetails);

		$districtDetails = $this->rolemaster->district_by_id($this->input->post('district'));

		//print_r($districtDetails);

		//exit();

		$dates = explode('-',$this->input->post('daterange'));

		$startDate = date('dmY',strtotime($dates[0]));

		$endDate = date('dmY',strtotime($dates[1]));

		//echo $this->input->post('month');

		 $newDate = '2012-0'.$this->input->post('month').'-05';

		 $month = date('F',strtotime($newDate));


		$year = date('Y',strtotime($this->input->post('year')));

		 $monthYear = $month.$year; 

		
		if($this->session->userdata('userType') == 'admin')
		{
			$file = 'STK_'.$stateDetails[0]['stateCode'].'_'.$districtDetails[0]['districtCode'].'_'.$startDate.'_'.$endDate.'.xls';
		}else{
			$file = 'STK_'.$stateDetails[0]['stateCode'].'_'.$districtDetails[0]['districtCode'].'_'.$monthYear.'.xls';
		}

		$filename = $file;

		$header = array('Date of receiving kits','Name of the kit','Batch No.','Expiry Date','Opening Stock','No. of kits received','No. of kits used','Date of kits used','No. of damaged/other','Control','Closing Stock','Kits returned if any');

        $this->excel->getActiveSheet()->getStyle('A1:AA1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
  }

     public function downloadUserData()
     {
     	  $this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$result = $this->rolemaster->downloadUserData();

		$filename = date('Y-m-d').'userData.xls';

		/*$header = array('Unique Id','User Name','Name','Name Alias','Date Of Birth','Age','Mobile No','Address','State','District','Education','Occupation','Occupation Other','Monthly Income','Marital Status','Marital Status Other','Male Children','Female Children','Total Children','Native State','Native District','Like to share information about sexual behaviour','Have multiple sex partner','Ever sought paid sex','Preferred sex/Gender of sexual partner','Preferred sexual act','Status of condom usage','Substance Use','Have you ever been tested for HIV before','If yes when(please mention how many months/year before)','Past HIV test result','Date of Finger Prick Screening','Referred to SA-ICTC','Date of Out-referral to SA-ICTC','Place of SA-ICTC Referred','ICTC -PID Number','Date of HIV Confirmation Test','Result of HIV Confirmatory Test','Date of Test Report Issued to Client','Status of HIV Confirmation Report','Linked to ART','ART Registration Date','ART Registration Number','Baseline CD4 Count','Other services provided',	'Status of Client','Remarks','Created Date','Upload ART Green Card scan / photo','Upload ICTC test report scan','Upload Referral Slip');*/

		// 
		//

		$header = array('Date Of Registration','Camp Code','Registration done by','Registration Number','Mode of Contact','User Name','Name','Name Alias','Date Of Birth','Age','Gender','Education','Occupation','Occupation Other','HRG','ARG','Monthly Income','Marital Status','Marital Status Other','Male Children','Female Children','Total Children','Address','State','District','Native State','Native District','Mobile No', 'Referral Point','Referral Point Other','Like to share information about sexual behaviour','Have multiple sex partner','Ever sought paid sex','Preferred sex/Gender of sexual partner','Preferred sexual act','Status of condom usage','Substance Use','Have you ever been tested for HIV before','If yes when(please mention how many months/year before)','Past HIV test result','Date of Finger Prick Screening','Referred to SA-ICTC','Date of Out-referral to SA-ICTC','Place of SA-ICTC Referred','ICTC -PID Number','Date of HIV Confirmation Test','Result of HIV Confirmatory Test','Date of Test Report Issued to Client','Status of HIV Confirmation Report','Linked to ART','ART Registration Date','ART Registration Number','Baseline CD4 Count','Other services provided',	'Status of Client','Remarks','Created Date','Upload ART Green Card scan / photo','Upload ICTC test report scan','Upload Referral Slip');

		//$header = array();

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');


	
		$i = 2;


		foreach ($result as $obj => $val) {
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setCellValue('A' . $i, $val['registeredOn']);
            $this->excel->getActiveSheet()->setCellValue('B' . $i, $val['campCode']);
            $this->excel->getActiveSheet()->setCellValue('C' . $i, $val['registeredBy']);
            $this->excel->getActiveSheet()->setCellValue('D' . $i, $val['client_id']);
             $this->excel->getActiveSheet()->setCellValue('E' . $i, $val['modeOfContact']);
               $this->excel->getActiveSheet()->setCellValue('F' . $i, $val['userName']);
            $this->excel->getActiveSheet()->setCellValue('G' . $i, $val['name']);
            $this->excel->getActiveSheet()->setCellValue('H' . $i, $val['nameAlias']);
            $this->excel->getActiveSheet()->setCellValue('I' . $i, $val['dob']);
            $this->excel->getActiveSheet()->setCellValue('J' . $i, $val['age']);
            $this->excel->getActiveSheet()->setCellValue('K' . $i, $val['gender']);
            $this->excel->getActiveSheet()->setCellValue('L' . $i, $val['educationalLevel']);
            $this->excel->getActiveSheet()->setCellValue('M' . $i, $val['occupation']);
            $this->excel->getActiveSheet()->setCellValue('N' . $i, $val['occupation_other']);
             $this->excel->getActiveSheet()->setCellValue('O' . $i, $val['hrg']);
            $this->excel->getActiveSheet()->setCellValue('P' . $i, $val['arg']);
            $this->excel->getActiveSheet()->setCellValue('Q' . $i, $val['monthlyIncome']);
            $this->excel->getActiveSheet()->setCellValue('R' . $i, $val['maritalStatus']);
            $this->excel->getActiveSheet()->setCellValue('S' . $i, $val['maritalStatus_other']);
            $this->excel->getActiveSheet()->setCellValue('T' . $i, $val['male_children']);
             $this->excel->getActiveSheet()->setCellValue('U' . $i, $val['female_children']);
           // $this->excel->getActiveSheet()->setCellValue('S' . $i, $val['secondaryIdentity']);
            //$this->excel->getActiveSheet()->setCellValue('T' . $i, $val['secondaryIdentity_other']); 
             $this->excel->getActiveSheet()->setCellValue('V' . $i, $val['total_children']);
            $this->excel->getActiveSheet()->setCellValue('W' . $i, $val['address']);
            $this->excel->getActiveSheet()->setCellValue('X' . $i, $val['addressState']);
             $this->excel->getActiveSheet()->setCellValue('Y' . $i, $val['addressDistrict']);
            $this->excel->getActiveSheet()->setCellValue('Z' . $i, $val['state']);
            $this->excel->getActiveSheet()->setCellValue('AA'.$i,$val['districtId']);
            $this->excel->getActiveSheet()->setCellValue('AB' . $i, $val['mobileNo']);
            $this->excel->getActiveSheet()->setCellValue('AC' . $i,$val['referralPoint']);
            $this->excel->getActiveSheet()->setCellValue('AD'.$i,$val['referralPoint_others']);
             $this->excel->getActiveSheet()->setCellValue('AE' . $i,$val['sexualBehaviour']);
             $this->excel->getActiveSheet()->setCellValue('AF' . $i, $val['multipleSexPartner']);
            $this->excel->getActiveSheet()->setCellValue('AG' . $i, $val['sought']);
             $this->excel->getActiveSheet()->setCellValue('AH' . $i,$val['prefferedGender']);
             $this->excel->getActiveSheet()->setCellValue('AI' . $i,$val['prefferedSexualAct']);
              $this->excel->getActiveSheet()->setCellValue('AJ' . $i,$val['condomUsage']);
             $this->excel->getActiveSheet()->setCellValue('AK' . $i,$val['substanceUse']);
              $this->excel->getActiveSheet()->setCellValue('AL' . $i,$val['testHiv']);
             $this->excel->getActiveSheet()->setCellValue('AM' . $i,$val['hivTestResult']);
              $this->excel->getActiveSheet()->setCellValue('AN' . $i,$val['pastHivReport']);
             $this->excel->getActiveSheet()->setCellValue('AO' . $i,$val['fingerDate']);
              $this->excel->getActiveSheet()->setCellValue('AP' . $i,$val['saictcStatus']);
             $this->excel->getActiveSheet()->setCellValue('AQ' . $i,$val['saictcDate']);
              $this->excel->getActiveSheet()->setCellValue('AR' . $i,$val['saictcPlace']);
             $this->excel->getActiveSheet()->setCellValue('AS' . $i,$val['ictcNumber']);
              $this->excel->getActiveSheet()->setCellValue('AT' . $i,$val['hivDate']);
             //$this->excel->getActiveSheet()->setCellValue($val['pastHivReport']);
            $this->excel->getActiveSheet()->setCellValue('AU' . $i, $val['hivStatus']);
            $this->excel->getActiveSheet()->setCellValue('AV' . $i, $val['reportIssuedDate']);
            $this->excel->getActiveSheet()->setCellValue('AW' . $i, $val['reportStatus']);
              $this->excel->getActiveSheet()->setCellValue('AX' . $i, $val['linkToArt']);
            $this->excel->getActiveSheet()->setCellValue('AY' . $i ,$val['artDate']);
             $this->excel->getActiveSheet()->setCellValue('AZ' . $i, $val['artNumber']);
              $this->excel->getActiveSheet()->setCellValue('BA' . $i, $val['cd4Result']);
            $this->excel->getActiveSheet()->setCellValue('BB' . $i ,$val['otherService']);
             $this->excel->getActiveSheet()->setCellValue('BC' . $i, $val['clientStatus']);
            $this->excel->getActiveSheet()->setCellValue('BD' . $i ,$val['remark']);
               $this->excel->getActiveSheet()->setCellValue('BE' . $i ,$val['createdDate']);

            if($val['artUpload'])
           {
    		           $objDrawing = new PHPExcel_Worksheet_Drawing();
    				$objDrawing->setPath('./uploads/userArt/'.$val['artUpload']);
    				$objDrawing->setWidthAndHeight(100,100);
    				$objDrawing->setCoordinates('BF'.$i);
    				$objDrawing->setWorksheet($this->excel->getActiveSheet());
            }

           if($val['ictcReportScan']) 
			{
				$objDrawing1 = new PHPExcel_Worksheet_Drawing();
						$objDrawing1->setPath('./uploads/userIctcScan/'.$val['ictcReportScan']);
						$objDrawing1->setWidthAndHeight(100,100);
						$objDrawing1->setCoordinates('BG'.$i);
						$objDrawing1->setWorksheet($this->excel->getActiveSheet());
			}


          if($val['referralSlip'])     
		 { $objDrawing2 = new PHPExcel_Worksheet_Drawing();
		 			$objDrawing2->setPath('./uploads/userReferralSlip/'.$val['referralSlip']);
		 			$objDrawing2->setWidthAndHeight(100,100);
		 			$objDrawing2->setCoordinates('BH'.$i);
		 			$objDrawing2->setWorksheet($this->excel->getActiveSheet());
		 }

		    $this->excel->getActiveSheet()->getRowDimension($i)->setRowHeight(40);
	   
                  
            $i++;
        }

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

     }

     public function func1()
     {
     	$data = explode(',','Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal aid,Legal ');


     		$data1=explode(', ','B,1,BB,CF,12345');
     	print_r($data1);
     }

      public function downloadServiceProviderData()
     {

          $this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

		$result = $this->rolemaster->downloadServiceProviderData();

		$filename = 'serviceProviderData.xls';

		/*$header = array('Unique Id','Name','Address','Mobile No','Landline','Email','Other Contact','Location','District','State','Queer Friendly Rating','Qualification','Affiliation','Linkage','Days','Time','Face To Face Consultation','Home Visits','Consultation On Telephone','Consultation Through Email','Consultation Through Skype/Video Conference/Other Chat','Consultation Charges','Consession','Latitude','Longitude','Services Focus','Created Date','Created By','Dealing with sexually transmitted / reproductive tract infection testing and treatment','Dealing with HIV counselling and testing issues','Dealing with HIV prevention, care, support and treatment issues','Prevention of parent to child transmission of HIV','Guidance around family planning, safer child birth, abortion issues','Dealing with feminization and masculinisation (gender transition) medical procedures','Dealing with sexual injuries and dysfunction','Dealing with physical impact of sexual assault / sexual abuse','Dealing with sexual health and disability issues','Others','Dealing with confusion / dysphoria, depression, anxiety or other mental health concerns around gender, sexuality or HIV status','Dealing with disclosure around gender or sexuality','Dealing with HIV disclosure, HIV and marriage / relationships, HIV succession planning ','Dealing with feminization and masculinisation (gender transition) – psychosocial issues ','Dealing with family acceptance issues around gender and sexuality','Dealing with marital / relationship issues','Dealing with gender and sexuality issues in relation to disabilities','Dealing with stigma, discrimination and violence around gender and sexuality in educational institutions, seeking employment, workplace, health or legal aid services','Dealing with stigma, discrimination and violence around HIV or disability in educational institutions, seeking employment, workplace, health or legal aid services','Dealing with emotional impact of sexual assault / sexual abuse','Dealing with ageing issues around gender and sexuality','Dealing with mental health concerns in relation to    reproductive health','Others','Information on legal rights of queer people',	'Dealing with marital / relationship issues','Legal gender identity change guidance','Dealing with extortion or blackmail around gender, sexuality or HIV status','Dealing with sexual assault / sexual abuse','Dealing with family or intimate partner violence','Dealing with issues related to inheritance / eviction from home','Dealing with issues related to insurance','Dealing with denial of rented accommodation on grounds of gender, sexuality or HIV status','Dealing with discrimination / harassment / bullying on grounds of gender and sexuality in educational institutions, seeking employment, workplace, health or legal aid services','Dealing with discrimination / harassment / bullying on grounds of HIV status or disability in educational institutions, seeking employment, workplace, health or legal aid services','Adoption guidance','Dealing with denial of reproductive health rights','Others');*/

		$header = array('Unique Id','Name','Address','Mobile No','Landline','Email','Other Contact','Location','District','State','Queer Friendly Rating','Qualification','Affiliation','Linkage','Days','Time','Face To Face Consultation','Home Visits','Consultation On Telephone','Consultation Through Email','Consultation Through Skype/Video Conference/Other Chat','Consultation Charges','Consession','Latitude','Longitude','Services Focus','Created Date','Created By');

		$this->excel->getActiveSheet()->getStyle('A1:BZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->setCellValue('AC1','Service Area');

		$this->excel->getActiveSheet()->getColumnDimension('AC1')->setWidth("50");

		//$this->excel->getActiveSheet()->getColumnDimension('AC1')->setAutoSize(true);

	/*	$this->excel->getActiveSheet()->fromArray($result, null, 'A2');*/

	$l =2;


	foreach ($result as $key => $val) {
		 $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->setCellValue('A' . $l, $val['uniqueId']);
            $this->excel->getActiveSheet()->setCellValue('B' . $l, $val['name']);
            $this->excel->getActiveSheet()->setCellValue('C' . $l, $val['address']);
            $this->excel->getActiveSheet()->setCellValue('D' . $l, $val['mobile']);
            $this->excel->getActiveSheet()->setCellValue('E' . $l, $val['officePhone']);
            $this->excel->getActiveSheet()->setCellValue('F' . $l, $val['email']);
            $this->excel->getActiveSheet()->setCellValue('G' . $l, $val['otherMobile']);
           $this->excel->getActiveSheet()->setCellValue('H' . $l, $val['location']);
           $this->excel->getActiveSheet()->setCellValue('I' . $l, $val['districtName']);
          $this->excel->getActiveSheet()->setCellValue('J' . $l, $val['stateName']);
          $this->excel->getActiveSheet()->setCellValue('K' . $l, $val['rating']);
          $this->excel->getActiveSheet()->setCellValue('L' . $l, $val['qualification']);
          $this->excel->getActiveSheet()->setCellValue('M' . $l, $val['affiliation']);
         $this->excel->getActiveSheet()->setCellValue('N' . $l, $val['linkage']);
         $this->excel->getActiveSheet()->setCellValue('O' . $l, $val['day']);
         $this->excel->getActiveSheet()->setCellValue('P' . $l, $val['time']);
         $this->excel->getActiveSheet()->setCellValue('Q' . $l, $val['conFace']);
         $this->excel->getActiveSheet()->setCellValue('R' . $l, $val['conHome']);
         $this->excel->getActiveSheet()->setCellValue('S' . $l, $val['conTel']);
         $this->excel->getActiveSheet()->setCellValue('T' . $l, $val['conEmail']);
         $this->excel->getActiveSheet()->setCellValue('U' . $l, $val['conOnline']);
         $this->excel->getActiveSheet()->setCellValue('V' . $l, $val['conCharges']);
         $this->excel->getActiveSheet()->setCellValue('W' . $l, $val['concession']);
         $this->excel->getActiveSheet()->setCellValue('X' . $l, $val['latitude']);
         $this->excel->getActiveSheet()->setCellValue('Y' . $l, $val['longitude']);
         $this->excel->getActiveSheet()->setCellValue('Z' . $l, $val['services']);
         $this->excel->getActiveSheet()->setCellValue('AA' . $l, $val['createdDate']);
         $this->excel->getActiveSheet()->setCellValue('AB' . $l, $val['createdBy']);   

         $serviceParameter = $this->rolemaster->serviceTypeParameterById($val['serviceProviderId']);

         //print_r($serviceParameter);


       $this->excel->getActiveSheet()->setCellValue('AC' . $l, $serviceParameter[0]['serviceArea']);
       

    $l++;

	}

	//exit();

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

     }

       public function downloadSACdata()
     {
     	 $this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

     	$result = $this->rolemaster->downloadSACdata();

     	$filename = 'SACdata.xls';


		$header = array('Service Access Voucher No','Service Access Voucher Code','User Name','Date awarded','Time awarded','Expiry Date','Service Provider Name','Claimed','Claimed Date','Claimed Time');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
     }

     public function downloadGCdata()
     {
     	$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

     	$result = $this->rolemaster->downloadGCdata();

     	$filename = 'GCdata.xls';


		$header = array('Gift Coupon No','Gift Coupon Code','User Name','Date awarded','Time awarded','Expiry Date','Claimed','Claimed Date','Claimed Time','Onground Partner Name','Contest Name','Score');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

     }

    public function downloadOngroundPartnerdata()
    {
    	$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

     	$result = $this->rolemaster->downloadOngroundPartnerdata();

     	$filename = 'ongroundPartnerData.xls';


		$header = array('Unique Id','Name','Address','Office Phone','Mobile','Email','Latitude','Longitude','State Name','District Name','dayAndTime','Created Date','Created Time');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

    }

    public function downloadGallerydata()
    {
    		$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

     	$result = $this->rolemaster->downloadGallerydata();

     	$filename = 'galleryData.xls';


		$header = array('Content Name','Created Date','Description');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
    }

      public function downloadCommentdata()
    {
    		$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

     	$result = $this->rolemaster->downloadCommentdata();

     	$filename = 'commentData.xls';


		$header = array('Comment','Name','Email','Website','From Page','Status','Comment Date');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
    }

    public function newExcelUplaodServiceProvider()
	{
	   if($_FILES['importExcel']['name'])
		{
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/serviceProviderExcel/".$file_name;
			if(move_uploaded_file($_FILES["importExcel"]["tmp_name"],$file_path))
			{
				$this->load->library('excel');
				$arr_data = array();
				$objPHPExcel = PHPExcel_IOFactory::load($file_path);
		
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
				$p = 0;
				foreach ($cell_collection as $cell){
					$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
					$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
					if ($row == 1) {
						$header[$row][$p] = $data_value;
					} 
					else 
					{
					   $arr_data[$row][$column] = $data_value;
					}
				$p++;
				}
				$j = 0; 
				$total=1;
				$totalCount = 1;

				foreach($arr_data as $row)
				{
                 
                   if(trim($row['A']) != '' && trim($row['B']) != '' && trim($row['D']) != ''  && trim($row['X']) != '' && trim($row['Y']) != '' && trim($row['I']) != '' && trim($row['J']) != '')
                   {
					//echo "<pre>";
				   $aa = array_keys(array_keys($row));
					$cc = array_combine($aa,$row);

					/*print_r($cc);
					print_r($row);*/

					 $checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['J']),trim($row['I']));
                   if(!empty($checkStateDistrict)) 
                   {
                     $latitude = trim($row['X']);

                     $longtitute = trim($row['Y']);

                          $latArray = explode('.',$latitude);

                          $lonArray = explode('.',$longtitute);

                      if( strlen($latArray[0]) == 2 && strlen($latArray[1]) == 4 )    
                        {
                        	if(strlen($lonArray[0]) == 2 && strlen($lonArray[1]) == 4)
                        	{
                        		$resultData = $this->rolemaster->serviceProviderUniqueId();
					
						$insert['uniqueId'] = $resultData;
						$insert['name'] = trim($row['A']);
						$insert['gender'] = trim($row['C']);
						$insert['address'] = trim($row['B']);
						$insert['officePhone'] = trim($row['E']);
						$insert['mobile'] = trim($row['D']);
						$insert['email'] = trim($row['F']);
						$insert['latitude'] = 	trim($row['X']);
	                    $insert['longitude'] = trim($row['Y']);
	                    $insert['rating'] = trim($row['K']);
	                    $insert['otherMobile'] = trim($row['G']);
	                    $insert['location'] = trim($row['H']);
	                    $insert['state'] = $checkStateDistrict[0]['stateId'];
	                    $insert['districtId'] = $checkStateDistrict[0]['districtId'];
	                    $insert['qualification'] = trim($row['L']);
	                    $insert['affiliation'] = trim($row['M']);
	                    $insert['linkage'] = trim($row['N']);
	                    $insert['day'] = trim($row['O']);
	                    $insert['time'] = trim($row['P']);
	                    $insert['conFace'] = trim($row['Q']); 
	                    $insert['conHome'] = trim($row['R']);
	                    $insert['conTel'] = trim($row['S']);
	                    $insert['conEmail'] = trim($row['T']);
	                    $insert['conOnline'] = trim($row['U']);
	                    $insert['conCharges'] = trim($row['V']);
	                    $insert['concession'] = trim($row['W']);
	                    $insert['createdBy'] = $this->session->userdata('userId');
	                    

	                    //print_r($insert);

	                    $id = $this->common_model->insertValue('tbl_service_provider_details', $insert);

                    if(trim($row['Z']) == 'Yes' || trim($row['Z']) == 'yes' || trim($row['Z']) == 'Y' || trim($row['Z']) == 'y')
                    {
                    	//echo 'sexualhealth';

                    	$serviceFocus['serviceTypeId'] = 1;
                    	$serviceFocus['serviceProviderId'] = $id;

                    	$this->common_model->insertValue('tbl_service_type_mapping',$serviceFocus);
                    }

                    if(trim($row['AA']) == "Yes" || trim($row['AA']) == 'yes' || trim($row['AA']) == 'Y' || trim($row['AA']) == 'y')
                    {
                    	//echo 'mentalHealth';
                        $serviceFocus['serviceTypeId'] = 2;
                    	$serviceFocus['serviceProviderId'] = $id;

                    	$this->common_model->insertValue('tbl_service_type_mapping',$serviceFocus);
                    }

                    if(trim($row['AB']) == 'Yes' || trim($row['AB']) == 'yes' || trim($row['AB']) == 'Y' || trim($row['AB']) == 'y')
                    {
                    	//echo "legalAid";
                    	$serviceFocus['serviceTypeId'] = 3;
                    	$serviceFocus['serviceProviderId'] = $id;

                    	$this->common_model->insertValue('tbl_service_type_mapping',$serviceFocus);
                    }

                     $this->db->select('serviceTypeParameterId');

					$this->db->from('tbl_service_type_parameters');

					$query =  $this->db->get();

					$serviceTypeParameterId = $query->result_array();

					//print_r($serviceTypeParameterId);

					//print_r($cc);

					$h = 0;

				   do{	  
                        for($l=28;$l<=64;$l++)
                         {	
                         	/*echo $cc[$l].'--'.$serviceTypeParameterId[$h]['serviceTypeParameterId'];

                         	echo "<br>";*/
                           $this->common_model->insertValue('tbl_service_provider_fields', array('serviceProviderId'=>$id,'value' => $cc[$l],'serviceTypeParameterId'=>$serviceTypeParameterId[$h]['serviceTypeParameterId']));
                              $h++;
                           }
                       }while($h<=36);
                      }else{
                        		$error[$j]['error'] = 'Longitude should be in xx.yyyy format';
						$error[$j]['name'] = trim($row['A']);
						$error[$j]['gender'] = trim($row['C']);
						$error[$j]['address'] = trim($row['B']);
						$error[$j]['officePhone'] = trim($row['E']);
						$error[$j]['mobile'] = trim($row['D']);
						$error[$j]['email'] = trim($row['F']);
						$error[$j]['latitude'] = 	trim($row['X']);
	                    $error[$j]['longitude'] = trim($row['Y']);
	                    $error[$j]['rating'] = trim($row['K']);
	                    $error[$j]['otherMobile'] = trim($row['G']);
	                    $error[$j]['location'] = trim($row['H']);
	                    $error[$j]['state'] = trim($row['J']);
	                    $error[$j]['districtId'] = trim($row['I']);
	                    $error[$j]['qualification'] = trim($row['L']);
	                    $error[$j]['affiliation'] = trim($row['M']);
	                    $error[$j]['linkage'] = trim($row['N']);
	                    $error[$j]['day'] = trim($row['O']);
	                    $error[$j]['time'] = trim($row['P']);
	                    $error[$j]['conFace'] = trim($row['Q']); 
	                    $error[$j]['conHome'] = trim($row['R']);
	                    $error[$j]['conTel'] = trim($row['S']);
	                    $error[$j]['conEmail'] = trim($row['T']);
	                    $error[$j]['conOnline'] = trim($row['U']);
	                    $error[$j]['conCharges'] = trim($row['V']);
	                    $error[$j]['concession'] = trim($row['W']);
	                    $error[$j]['sexualhealthservices'] = trim($row['Z']);
						$error[$j]['mentalhealthservices'] = trim($row['AA']);
						$error[$j]['Legalaidservices'] = trim($row['AB']);
						$error[$j]['shs1'] = trim($row['AC']);
						$error[$j]['shs2'] = trim($row['AD']);
						$error[$j]['shs3'] = trim($row['AE']);
						$error[$j]['shs4'] = trim($row['AF']);
						$error[$j]['shs5'] = trim($row['AG']);
						$error[$j]['shs6'] = trim($row['AH']);
						$error[$j]['shs7'] = trim($row['AI']);
						$error[$j]['shs8'] = trim($row['AJ']);
						$error[$j]['shs9'] = trim($row['AK']);
						$error[$j]['shs10'] = trim($row['AL']);
						$error[$j]['mhs1'] = trim($row['AM']);
					     $error[$j]['mhs2'] = trim($row['AN']);
						 $error[$j]['mhs3'] = trim($row['AO']);
						$error[$j]['mhs4'] = trim($row['AP']);
						$error[$j]['mhs5'] = trim($row['AQ']);
						$error[$j]['mhs6'] = trim($row['AR']);
						$error[$j]['mhs7'] = trim($row['AS']);
						$error[$j]['mhs8'] = trim($row['AT']);
						$error[$j]['mhs9'] = trim($row['AU']);
						$error[$j]['mhs10'] = trim($row['AV']);
					   $error[$j]['mhs11'] = trim($row['AW']);
						$error[$j]['mhs12'] = trim($row['AX']);
						 $error[$j]['mhs13'] = trim($row['AY']);
						     $error[$j]['las1'] = trim($row['AZ']);
                        $error[$j]['las2'] = trim($row['BA']);
                          $error[$j]['las3'] = trim($row['BB']);
                           $error[$j]['las4'] = trim($row['BC']);
                           $error[$j]['las5'] = trim($row['BD']);
                            $error[$j]['las6'] = trim($row['BE']);
                            $error[$j]['las7'] = trim($row['BF']);
                             $error[$j]['las8'] = trim($row['BG']);
                              $error[$j]['las9'] = trim($row['BH']);
                             $error[$j]['las10'] = trim($row['BI']);
                             $error[$j]['las11'] = trim($row['BJ']);
                             $error[$j]['las12'] = trim($row['BK']);
                             $error[$j]['las13'] = trim($row['BL']);
                             $error[$j]['las14'] = trim($row['BM']);


						$j++;

                        	}	
                        		

                       }else{
                       	$error[$j]['error'] = 'Latitude should be in xx.yyyy format';
						$error[$j]['name'] = trim($row['A']);
						$error[$j]['gender'] = trim($row['C']);
						$error[$j]['address'] = trim($row['B']);
						$error[$j]['officePhone'] = trim($row['E']);
						$error[$j]['mobile'] = trim($row['D']);
						$error[$j]['email'] = trim($row['F']);
						$error[$j]['latitude'] = 	trim($row['X']);
	                    $error[$j]['longitude'] = trim($row['Y']);
	                    $error[$j]['rating'] = trim($row['K']);
	                    $error[$j]['otherMobile'] = trim($row['G']);
	                    $error[$j]['location'] = trim($row['H']);
	                    $error[$j]['state'] = trim($row['J']);
	                    $error[$j]['districtId'] = trim($row['I']);
	                    $error[$j]['qualification'] = trim($row['L']);
	                    $error[$j]['affiliation'] = trim($row['M']);
	                    $error[$j]['linkage'] = trim($row['N']);
	                    $error[$j]['day'] = trim($row['O']);
	                    $error[$j]['time'] = trim($row['P']);
	                    $error[$j]['conFace'] = trim($row['Q']); 
	                    $error[$j]['conHome'] = trim($row['R']);
	                    $error[$j]['conTel'] = trim($row['S']);
	                    $error[$j]['conEmail'] = trim($row['T']);
	                    $error[$j]['conOnline'] = trim($row['U']);
	                    $error[$j]['conCharges'] = trim($row['V']);
	                    $error[$j]['concession'] = trim($row['W']);
	                    $error[$j]['sexualhealthservices'] = trim($row['Z']);
						$error[$j]['mentalhealthservices'] = trim($row['AA']);
						$error[$j]['Legalaidservices'] = trim($row['AB']);
						$error[$j]['shs1'] = trim($row['AC']);
						$error[$j]['shs2'] = trim($row['AD']);
						$error[$j]['shs3'] = trim($row['AE']);
						$error[$j]['shs4'] = trim($row['AF']);
						$error[$j]['shs5'] = trim($row['AG']);
						$error[$j]['shs6'] = trim($row['AH']);
						$error[$j]['shs7'] = trim($row['AI']);
						$error[$j]['shs8'] = trim($row['AJ']);
						$error[$j]['shs9'] = trim($row['AK']);
						$error[$j]['shs10'] = trim($row['AL']);
						$error[$j]['mhs1'] = trim($row['AM']);
					     $error[$j]['mhs2'] = trim($row['AN']);
						 $error[$j]['mhs3'] = trim($row['AO']);
						$error[$j]['mhs4'] = trim($row['AP']);
						$error[$j]['mhs5'] = trim($row['AQ']);
						$error[$j]['mhs6'] = trim($row['AR']);
						$error[$j]['mhs7'] = trim($row['AS']);
						$error[$j]['mhs8'] = trim($row['AT']);
						$error[$j]['mhs9'] = trim($row['AU']);
						$error[$j]['mhs10'] = trim($row['AV']);
					   $error[$j]['mhs11'] = trim($row['AW']);
						$error[$j]['mhs12'] = trim($row['AX']);
						 $error[$j]['mhs13'] = trim($row['AY']);
						     $error[$j]['las1'] = trim($row['AZ']);
                        $error[$j]['las2'] = trim($row['BA']);
                          $error[$j]['las3'] = trim($row['BB']);
                           $error[$j]['las4'] = trim($row['BC']);
                           $error[$j]['las5'] = trim($row['BD']);
                            $error[$j]['las6'] = trim($row['BE']);
                            $error[$j]['las7'] = trim($row['BF']);
                             $error[$j]['las8'] = trim($row['BG']);
                              $error[$j]['las9'] = trim($row['BH']);
                             $error[$j]['las10'] = trim($row['BI']);
                             $error[$j]['las11'] = trim($row['BJ']);
                             $error[$j]['las12'] = trim($row['BK']);
                             $error[$j]['las13'] = trim($row['BL']);
                             $error[$j]['las14'] = trim($row['BM']);


						$j++;
                       }

					
                      }else{
                       $error[$j]['error'] = 'State or District Not Exist';
						$error[$j]['name'] = trim($row['A']);
						$error[$j]['gender'] = trim($row['C']);
						$error[$j]['address'] = trim($row['B']);
						$error[$j]['officePhone'] = trim($row['E']);
						$error[$j]['mobile'] = trim($row['D']);
						$error[$j]['email'] = trim($row['F']);
						$error[$j]['latitude'] = 	trim($row['X']);
	                    $error[$j]['longitude'] = trim($row['Y']);
	                    $error[$j]['rating'] = trim($row['K']);
	                    $error[$j]['otherMobile'] = trim($row['G']);
	                    $error[$j]['location'] = trim($row['H']);
	                    $error[$j]['state'] = trim($row['J']);
	                    $error[$j]['districtId'] = trim($row['I']);
	                    $error[$j]['qualification'] = trim($row['L']);
	                    $error[$j]['affiliation'] = trim($row['M']);
	                    $error[$j]['linkage'] = trim($row['N']);
	                    $error[$j]['day'] = trim($row['O']);
	                    $error[$j]['time'] = trim($row['P']);
	                    $error[$j]['conFace'] = trim($row['Q']); 
	                    $error[$j]['conHome'] = trim($row['R']);
	                    $error[$j]['conTel'] = trim($row['S']);
	                    $error[$j]['conEmail'] = trim($row['T']);
	                    $error[$j]['conOnline'] = trim($row['U']);
	                    $error[$j]['conCharges'] = trim($row['V']);
	                    $error[$j]['concession'] = trim($row['W']);
	                    $error[$j]['sexualhealthservices'] = trim($row['Z']);
						$error[$j]['mentalhealthservices'] = trim($row['AA']);
						$error[$j]['Legalaidservices'] = trim($row['AB']);
						$error[$j]['shs1'] = trim($row['AC']);
						$error[$j]['shs2'] = trim($row['AD']);
						$error[$j]['shs3'] = trim($row['AE']);
						$error[$j]['shs4'] = trim($row['AF']);
						$error[$j]['shs5'] = trim($row['AG']);
						$error[$j]['shs6'] = trim($row['AH']);
						$error[$j]['shs7'] = trim($row['AI']);
						$error[$j]['shs8'] = trim($row['AJ']);
						$error[$j]['shs9'] = trim($row['AK']);
						$error[$j]['shs10'] = trim($row['AL']);
						$error[$j]['mhs1'] = trim($row['AM']);
					     $error[$j]['mhs2'] = trim($row['AN']);
						 $error[$j]['mhs3'] = trim($row['AO']);
						$error[$j]['mhs4'] = trim($row['AP']);
						$error[$j]['mhs5'] = trim($row['AQ']);
						$error[$j]['mhs6'] = trim($row['AR']);
						$error[$j]['mhs7'] = trim($row['AS']);
						$error[$j]['mhs8'] = trim($row['AT']);
						$error[$j]['mhs9'] = trim($row['AU']);
						$error[$j]['mhs10'] = trim($row['AV']);
					   $error[$j]['mhs11'] = trim($row['AW']);
						$error[$j]['mhs12'] = trim($row['AX']);
						 $error[$j]['mhs13'] = trim($row['AY']);
						     $error[$j]['las1'] = trim($row['AZ']);
                        $error[$j]['las2'] = trim($row['BA']);
                          $error[$j]['las3'] = trim($row['BB']);
                           $error[$j]['las4'] = trim($row['BC']);
                           $error[$j]['las5'] = trim($row['BD']);
                            $error[$j]['las6'] = trim($row['BE']);
                            $error[$j]['las7'] = trim($row['BF']);
                             $error[$j]['las8'] = trim($row['BG']);
                              $error[$j]['las9'] = trim($row['BH']);
                             $error[$j]['las10'] = trim($row['BI']);
                             $error[$j]['las11'] = trim($row['BJ']);
                             $error[$j]['las12'] = trim($row['BK']);
                             $error[$j]['las13'] = trim($row['BL']);
                             $error[$j]['las14'] = trim($row['BM']);


						$j++;


                     }    

                     }else{
                         $error[$j]['error'] = 'Field is mandatory';
						$error[$j]['name'] = trim($row['A']);
						$error[$j]['gender'] = trim($row['C']);
						$error[$j]['address'] = trim($row['B']);
						$error[$j]['officePhone'] = trim($row['E']);
						$error[$j]['mobile'] = trim($row['D']);
						$error[$j]['email'] = trim($row['F']);
						$error[$j]['latitude'] = 	trim($row['X']);
	                    $error[$j]['longitude'] = trim($row['Y']);
	                    $error[$j]['rating'] = trim($row['K']);
	                    $error[$j]['otherMobile'] = trim($row['G']);
	                    $error[$j]['location'] = trim($row['H']);
	                    $error[$j]['state'] = trim($row['J']);
	                    $error[$j]['districtId'] = trim($row['I']);
	                    $error[$j]['qualification'] = trim($row['L']);
	                    $error[$j]['affiliation'] = trim($row['M']);
	                    $error[$j]['linkage'] = trim($row['N']);
	                    $error[$j]['day'] = trim($row['O']);
	                    $error[$j]['time'] = trim($row['P']);
	                    $error[$j]['conFace'] = trim($row['Q']); 
	                    $error[$j]['conHome'] = trim($row['R']);
	                    $error[$j]['conTel'] = trim($row['S']);
	                    $error[$j]['conEmail'] = trim($row['T']);
	                    $error[$j]['conOnline'] = trim($row['U']);
	                    $error[$j]['conCharges'] = trim($row['V']);
	                    $error[$j]['concession'] = trim($row['W']);
	                    $error[$j]['sexualhealthservices'] = trim($row['Z']);
						$error[$j]['mentalhealthservices'] = trim($row['AA']);
						$error[$j]['Legalaidservices'] = trim($row['AB']);
						$error[$j]['shs1'] = trim($row['AC']);
						$error[$j]['shs2'] = trim($row['AD']);
						$error[$j]['shs3'] = trim($row['AE']);
						$error[$j]['shs4'] = trim($row['AF']);
						$error[$j]['shs5'] = trim($row['AG']);
						$error[$j]['shs6'] = trim($row['AH']);
						$error[$j]['shs7'] = trim($row['AI']);
						$error[$j]['shs8'] = trim($row['AJ']);
						$error[$j]['shs9'] = trim($row['AK']);
						$error[$j]['shs10'] = trim($row['AL']);
						$error[$j]['mhs1'] = trim($row['AM']);
					     $error[$j]['mhs2'] = trim($row['AN']);
						 $error[$j]['mhs3'] = trim($row['AO']);
						$error[$j]['mhs4'] = trim($row['AP']);
						$error[$j]['mhs5'] = trim($row['AQ']);
						$error[$j]['mhs6'] = trim($row['AR']);
						$error[$j]['mhs7'] = trim($row['AS']);
						$error[$j]['mhs8'] = trim($row['AT']);
						$error[$j]['mhs9'] = trim($row['AU']);
						$error[$j]['mhs10'] = trim($row['AV']);
					   $error[$j]['mhs11'] = trim($row['AW']);
						$error[$j]['mhs12'] = trim($row['AX']);
						 $error[$j]['mhs13'] = trim($row['AY']);
						     $error[$j]['las1'] = trim($row['AZ']);
                        $error[$j]['las2'] = trim($row['BA']);
                          $error[$j]['las3'] = trim($row['BB']);
                           $error[$j]['las4'] = trim($row['BC']);
                           $error[$j]['las5'] = trim($row['BD']);
                            $error[$j]['las6'] = trim($row['BE']);
                            $error[$j]['las7'] = trim($row['BF']);
                             $error[$j]['las8'] = trim($row['BG']);
                              $error[$j]['las9'] = trim($row['BH']);
                             $error[$j]['las10'] = trim($row['BI']);
                             $error[$j]['las11'] = trim($row['BJ']);
                             $error[$j]['las12'] = trim($row['BK']);
                             $error[$j]['las13'] = trim($row['BL']);
                             $error[$j]['las14'] = trim($row['BM']);
                     

						$j++;

                     }  
	

				} 

		  }

		}

	/*	echo "<pre>";

		print_r($error); exit();*/

		if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'serviceProvider';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					$this->session->set_flashdata('message1','Service Provider data uploaded successfully');
					redirect(base_url().'home/serviceProvider');	
				}


		//redirect(base_url().'home/serviceProvider');

	}	

	public function ticker()
	{
		if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
		
		$data['tickerList'] = $this->rolemaster->getAllTicker();
		$data['content'] = 'tickers';
     	$this->load->view('Layout/dashboardLayoutDash',$data);

	}

    public function changePostStatusWp()
    {
    	$data['postId'] = $this->input->post('postId');

    	$data['status'] = $this->input->post('status');

    	$res = $this->rolemaster->changePostStatusWp($data);

		if ($res) {
    		echo json_encode(['responseCode'=>'200','responseMessage'=>'Status updated successfully']);
    	}else{
    		echo json_encode(['responseCode'=>'0','responseMessage'=>'Error occured in updation']);
    	}
     }
     

     public function otpUsed()
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$data['otp'] = $this->rolemaster->otpUsed();

     	$data['content'] = 'otp';
     	
     	$this->load->view('Layout/dashboardLayoutDash',$data);  
     }

     public function gallery()
     {
       if(!$this->session->userdata('validated')){
			redirect(base_url());
		}
			
       $data['contents'] = $this->rolemaster->getContents();

     	$data['content'] = 'gallery';

     	$this->load->view('Layout/dashboardLayoutDash',$data); 
     }

     public function insertContent()
     {
     	$actions['content'] = time().'_content_'.$_FILES['content']['name'];
					$destination = './uploads/galleryData/' . $actions['content'];
					move_uploaded_file($_FILES["content"]["tmp_name"], $destination);
 
       $this->rolemaster->insertContent($actions['content']);

       redirect(base_url().'home/gallery');

     }

     public function editContent($contentId)
     {
     	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$data['contentId'] = $contentId;

     	$data['galleryData'] =  $this->rolemaster->contentById($contentId);

     	$data['content'] = 'editContent';

     	$this->load->view('Layout/dashboardLayoutDash',$data); 
     }

     public function updateContent()
     {

     	if($_FILES['content']['name'])
     	{	
	     	$actions['content'] = time().'_content_'.$_FILES['content']['name'];
			$destination = './uploads/galleryData/' . $actions['content'];
		     move_uploaded_file($_FILES["content"]["tmp_name"], $destination);
	    }
	    else{
	    	$actions['content'] = '';
	    }				
  
         $this->rolemaster->updateContent($actions['content']);

               redirect(base_url().'home/gallery');
     }

    public function checkUserMobile()
    {
    	$mobileNo = '+91'.$this->input->post('mobileNo');

    	$main = $this->rolemaster->checkUserMobile($mobileNo);

    	echo json_encode($main);
    }

    public function claimCoupon()
    {
    	$this->session->set_flashdata('voucherType',$this->input->post('voucherType'));

    	$this->rolemaster->claimCoupon();

    	redirect(base_url().'home/voucherDetail');
    }

    public function test()
    {
    	$result = $this->rolemaster->test();

        echo "<pre>";

    	foreach ($result as  $key =>$value) {
    		 $arry = unserialize($value['user_data']);

    		 print_r($arry['userName']);
    	}
    }

     public function smsUser()
     {
        if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

     	$data['smsUser'] = $this->rolemaster->smsUser();

       $data['content'] = 'smsUser';

       $this->load->view('Layout/dashboardLayoutDash',$data);

     }

     public function forgetPassword()
     {
     	
     	 $data['content'] = 'forgetPassword';

         $this->load->view('Layout/dashboardLayoutLogin',$data);     
     }

     public function checkUsername()
     {


     	  $username = $this->input->post('userName');

       $result = $this->rolemaster->checkUser($username);

       if(!empty($result))
       {
          $data['mobile'] = $result[0]['mobileNo'];

       	  $data['userId'] = $result[0]['userId'];

       	  $data['content'] = 'verifyUser';

       	  $otp = mt_rand(10000,99999);

       	  $this->rolemaster->updateUserOtp($result[0]['userId'],$otp);

       	  $this->rolemaster->insertOtp($result[0]['userId'],$otp);

       	  $message = "Your OTP to reset password in Sahay admin panel is ".$otp;

       	  $message = str_replace(' ','%20',$message);

       	  $smsTime = date('d-m-Y');

       	 $smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$data['mobile'].'&message='.$message.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate='.$smsTime;
	
		        $ch = curl_init();
	           curl_setopt($ch, CURLOPT_URL,$smsApi);
	           curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	           curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	             curl_exec($ch);  

	             curl_close($ch);


       	  $this->load->view('Layout/dashboardLayoutLogin',$data);
       }
       else{
             $this->session->set_flashdata(['errorMessage'=>'User with this user name does not exist']);
    			redirect(base_url()."home/forgetPassword");  	
       }

     }

     public function checkUserOtp()
     {
     	$userId = $this->input->post('userId');

      $mobile = $this->input->post('mobile');

      $result = $this->rolemaster->userById($userId);



      if($result[0]['otp'] == $this->input->post('otp'))
      {
     	
      	redirect(base_url().'home/resetPassword');
        
      }
      else{

            $data['userId'] = $userId;

            $data['mobile'] = $mobile;

            $otp = mt_rand(10000,99999);

       	  $this->rolemaster->updateUserOtp($userId,$otp);

       	 $this->rolemaster->insertOtp($userId,$otp);

       	  $message = "Your OTP to reset password in Sahay admin panel is ".$otp;

       	  $message = str_replace(' ','%20',$message);

       	  $smsTime = date('d-m-Y');

       	 $smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$mobile.'&message='.$message.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate='.$smsTime;
	
		        $ch = curl_init();
	           curl_setopt($ch, CURLOPT_URL,$smsApi);
	           curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	           curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	             curl_exec($ch);  

	             curl_close($ch);

            $data['errorMessage'] = 'Incorrect OTP';

            $data['content'] = 'verifyUser';

      	  $this->load->view('Layout/dashboardLayoutLogin',$data);
    			  	
      }

     }

     public function resetPassword()
     {
     		$data['userId'] = $this->session->userdata('temp_userId_panel');

	    	$data['content'] = 'resetPassword';

	    	$this->load->view('Layout/dashboardLayoutLogin',$data);
	  }

	   public function setPassword()
    {
    	$data['userId'] = $this->input->post('userId');

    	$data['password'] = $this->input->post('password');

    	$this->rolemaster->setPassword($data);

    	$result = $this->rolemaster->userById($data['userId']);

    	$this->rolemaster->setLogs($data['userId']);

    	$result1 = $this->rolemaster->getLoginId($data['userId']);

    	$this->session->unset_userdata('temp_userId_panel');

    	if($result[0]['userType'] == 'employee')
       {
       	
         $sql1 = "SELECT t1.rightId AS rights FROM `tbl_usertype_rights` AS t1 
			LEFT JOIN `tbl_usertype_rights_mapping` AS t2 ON t1.`rightId` = t2.`rightId` 
                      LEFT JOIN `tbl_usertype` AS t3 ON t2.`userTypeId` = t3.`userTypeId` WHERE 
                        t3.`userTypeId` = '".$result[0]['roleId']."' AND t3.deleted = 'N' AND t1.deleted = 'N' AND t2.deleted = 'N'";

               $query1 = $this->db->query($sql1); 
        
        $result2 = $query1->result_array();


        foreach ($result2 as $data) 
        {
            $rights[] =  $data['rights'];
         }   

       } 

    	$sessionData = array(
				'userId' => $result[0]['userId'],
				'userType' => $result[0]['userType'],
				'userName' => $result[0]['userName'],
				'userUniqueId' => $result[0]['userUniqueId'],
				'mobile' => $result[0]['mobileNo'],				
				'email' => $result[0]['emailAddress'],				
				'age' => $result[0]['age'],				
				'occupation' => $result[0]['occupation'],
				'logId' => $result1[0]['logId'],
				'logInto'=>'Admin panel',				
				'validated' => true
				);
				
				$this->session->set_userdata($sessionData);

       	$this->session->set_userdata('rights',$rights);
	   redirect(base_url().'home/index');	

    }

    public function role()
    {
      if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

    	$data['rights'] = $this->rolemaster->getUserRights();

		$data['roles'] = $this->rolemaster->getRoles();

       $data['content'] = 'createRole';

		$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function insertRole()
	{
	   $this->rolemaster->insertRole();
    
       redirect(base_url().'home/role');
	}

	 public function editRole()
    {
    	if(!$this->session->userdata('validated')){
			redirect(base_url());
		}

    	$id = $this->uri->segment(3);

    	$data['id'] = $id;

    	$data['roleDetails'] = $this->rolemaster->roleDetails($id);



    	$data['roleRights'] = array_column($data['roleDetails']['rights'],'rightId');
      
       $data['rights'] = $this->rolemaster->getUserRights();

    	$data['content'] = 'editRole';

    	$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function updateRole()
	{
		$id = $this->uri->segment(3);

		$this->rolemaster->updateRole($id);

		 redirect(base_url().'home/role');
	}

	 public function checkEmpMobile()
    {
    	$mobileNo = $this->input->post('mobileNo');

    	$main = $this->rolemaster->checkEmpMobile($mobileNo);

    	echo json_encode($main);
    }

    public function changeEmpPassword()
    {
    	$this->rolemaster->changeEmpPassword();

    	redirect(base_url().'home/staff');
    }

    public function wildcardUsername()
    {
       $data['wildcard'] = $this->input->post('wildcard');

       $main = $this->rolemaster->wildcardUsername($data);

       echo json_encode($main);
  
    }

    public function uploadExcelSms()
    {
    	if($_FILES['importExcel']['name']){		
			$file_name = str_replace(" ","",$_FILES['importExcel']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/smsExcel/".$file_name;
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
				$j = 0; 
				$total=1;
				$totalCount = 1;
				


				foreach($arr_data as $row){
					if(trim($row['A']) != '' && trim($row['C'] != '')){
                        
					  $status = $this->rolemaster->checkUserWithMobile(trim($row['A']),trim($row['B']),trim($row['C']))	;   
		
					  if($status)
					  {	

                         if(!empty($status[0]['tableName']) && !empty($status[1]['tableName']))  
						$insert['to']	 = 'common';
					     else
					     	$insert['to'] = $status[0]['tableName'];  
						$insert['smsPath'] = 'fileImport';
						$insert['users']	 =  $status[0]['userId'];
						$insert['sendVia'] =   $this->input->post('sendVia');
						$insert['smsText'] =   $this->input->post('smsText');
						$insert['sendStatus'] = 'Y';
						$insert['createdBy']	 = $this->session->userdata('userId');


					    $id = $this->common_model->insertValue('tbl_sms', $insert);
                               
                         $mobile = trim($row['C']);

                         $message =  $this->input->post('smsText');

                         	  $message = str_replace(' ','%20',$message);

                         $smsTime = date('Y-m-d');     

					  $smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$mobile.'&message='.$message.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate='.$smsTime;
			
				               $ch = curl_init();
			                   curl_setopt($ch, CURLOPT_URL,$smsApi);
			                   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			                  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			                    curl_exec($ch);  

			             curl_close($ch);
						
						$total++;
					  }else{
					  	$error[$j]['error'] = 'User Details are wrong';
					  	$error[$j]['clientId'] = trim($row['A']);
						$error[$j]['name'] = trim($row['B']);
						$error[$j]['mobile'] = trim($row['C']);
						$j++;
					  }	
					}else{
						$error[$j]['error'] = 'Field is mandatory';
					    $error[$j]['clientId'] = trim($row['A']);
						$error[$j]['name'] = trim($row['B']);
						$error[$j]['mobile'] = trim($row['C']);
						$j++;
					}
				$totalCount++;
				}
              
				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'smsModule';
					$this->load->view('Layout/dashboardLayoutDash',$data);
				}else{
					redirect(base_url().'home/smsModule');	
				}
			}
		}
    }

    public function smsReport()
    {
    	$smsId = $this->input->post('smsId');

    	$result = $this->rolemaster->getSmsWithUser($smsId);

    	$users = explode(',',$result[0]['users']);
          
    	if(count($users) > 1)
    	{
    		
    		foreach ($users as $key => $value) {
    		  if($result[0]['to'] == 'smsUser' || $result[0]['to'] == 'smsWebUser')
    		  {	
    		   $result1[] =$this->rolemaster->smsUserById($value);
    		  }else{
    		  	$result1[] =$this->rolemaster->userById($value);
    		  } 
    		}
    	}else{
    	      
    	      if($result[0]['to'] == 'smsUser' || $result[0]['to'] == 'smsWebUser')
    		  {	
    		   $result1 =$this->rolemaster->smsUserById($users[0]);
    		  }else{
    		  	$result1 =$this->rolemaster->userById($users[0]);
    		  }  
    		 //$result1 =$this->rolemaster->userById($users[0]);
    	}	
        

        $main =array_merge($result,$result1);

    	echo json_encode($main);
    }

    public function campReport()
    {
    	if(!$this->session->userdata('validated')){
			redirect(base_url('home'));
		}

		$data['role_master'] = $this->rolemaster;

		$data['stateList'] = $this->rolemaster->stateList();

    	$data['content'] = 'campReport';

    	$data['campReportList'] = $this->rolemaster->campReportList();



    	$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public  function insertCampReport()
    { 
     // echo "<pre>"; 	
    	$count = $this->input->post('count');

    	$data['camp_code_unique_id'] = $this->rolemaster->campReportUniqueId();
    	
    	//$data['camp_code'] = $this->input->post('campCode');

    	$data['camp_code'] = strtoupper($this->input->post('stateCode')).'/'.strtoupper($this->input->post('districtCode')).'/'.$this->input->post('campCode1');

      if(!empty($this->input->post('campDate')))
      {
    	$data['date_of_camp'] =  date('Y-m-d',strtotime($this->input->post('campDate')));
     }

       if(!empty($this->input->post('startTime')))
      {
    	$data['start_time'] = date('H:i:s',strtotime($this->input->post('startTime')));
      }

        if(!empty($this->input->post('endTime')))
      {  
    	$data['end_time'] = date('H:i:s',strtotime($this->input->post('endTime')));
      }	

    	$data['state'] = $this->input->post('state');

    	$data['district'] = $this->input->post('district');

    	$data['block'] = $this->input->post('block');

    	$data['site'] = $this->input->post('site');

    	$data['latitude'] = $this->input->post('latitude');

    	$data['longitude'] = $this->input->post('longitude');

    	$data['nearset_ictc'] = $this->input->post('ictcDistance');

    	$data['nearest_health_facility'] = $this->input->post('healthDistance');

    	$data['nearest_hiv_service_provider'] = $this->input->post('providerDistance');

    	//$data['coordinated_with'] = $this->input->post('coordinated');
    	 if(is_array($this->input->post('coordinated')))
        {
          $data['coordinated_with'] = implode(',',$this->input->post('coordinated'));
	
        }else{	
    	$data['coordinated_with'] = $this->input->post('coordinated');
       }

    	$data['coordinated_others'] = $this->input->post('othercodetail');

    	$data['hrg_population'] = $this->input->post('hrg');

    	$data['arg_population'] = $this->input->post('arg');

    	$data['in_migration'] = $this->input->post('inMigration');

    	$data['out_migration'] = $this->input->post('outMigration');

    	$data['no_of_labourers'] = $this->input->post('labourers');

      if(!empty($this->input->post('rentingCost')))
      {
    	$data['cost_for_renting'] = number_format($this->input->post('rentingCost'), 2, '.', '');

      }

       if(!empty($this->input->post('mobilisationCost')))
      {	

    	$data['cost_of_mobilisation'] = number_format($this->input->post('mobilisationCost'), 2, '.', '');

    }

      if(!empty($this->input->post('consumablesCost')))
      {	
	

    	$data['cost_of_consumables'] = number_format($this->input->post('consumablesCost'), 2, '.', '');

    }
    
      if(!empty($this->input->post('transportingCost')))
      {	
	
    	echo $data['cost_of_transporting'] = number_format($this->input->post('transportingCost'), 2, '.', '');
    }


      if(!empty($this->input->post('transportingCost')))
      {	
		

    	$data['other_major_cost'] = number_format($this->input->post('otherCost'), 2, '.', '');

    }	

    $data['cost_for_cbs'] = $data['cost_for_renting'] + $data['cost_of_mobilisation'] + $data['cost_of_consumables'] + $data['cost_of_transporting'] + $data['other_major_cost'];


    	$data['desc_for_other_cost'] = $this->input->post('otherCostDesc');

    	$data['kits_name'] = $this->input->post('kitsName');

    	$data['batch_no'] = $this->input->post('batch');

        if(!empty($this->input->post('expiryDate')))
      {   
        
    	$data['expiry_date'] =  date('Y-m-d',strtotime($this->input->post('expiryDate')));
     }	

        if(!empty($this->input->post('receivedDate')))
	      {   
	        
	    	$data['date_of_kits_received'] =  date('Y-m-d',strtotime($this->input->post('receivedDate')));
	     }

	   $peopleScreened = $this->rolemaster->campPeopleScreened($data['camp_code']); 

	   $peopleStr = $this->rolemaster->campPeopleStr($data['camp_code']); 

	   $data['no_of_people_attended'] = $this->input->post('peopleAttened');
	   
	   $data['no_of_str_cases_referred_to_ictc'] = $this->input->post('strCases');  

	   $data['no_of_people_screened'] = $this->input->post('peopleScreened');

	   $data['no_of_people_found_to_be_str'] = 	$this->input->post('peopleStr');


    	$data['opening_stock'] = $this->input->post('openingStock');

    	$data['received'] = $this->input->post('received');

    
    	$data['control'] = $this->input->post('control');

    	$data['wastage'] = $this->input->post('wastage');

    	$data['activityDesc'] =$this->input->post('activityDesc');

    	$data['challenges'] = $this->input->post('challenges');

    	$data['innovations'] = $this->input->post('innovations');

    	$data['learing'] = $this->input->post('learing');

    	$data['follow'] = $this->input->post('follow');

    	$data['quantity_indented'] = $this->input->post('quantityIndented');

    	$data['kits_returned'] = $this->input->post('kitsReturned');

    	/*	$data['consumed'] = ($data['opening_stock'] + $data['received']) - ($data['wastage']  + $data['kits_returned'] + $data['control']);*/

    	$data['consumed'] = $this->input->post('consumed');


    	if ($this->input->post('closingStock') == '') {

    		$data['closing_stock'] = ($data['opening_stock'] + $data['received']) - ($data['wastage'] + $data['consumed'] + $data['kits_returned'] + $data['control']);
    		//(1000+1)-(1+1+1)
    	}else{
    		$data['closing_stock'] = $this->input->post('closingStock');
    	}
		

       if($_FILES['image'])
		{


			for ($i=0; $i < 4; $i++) { 
             if(!empty($_FILES['image']['name'][$i]))
              {
				$actions['Image'] = time().'_campReport_'.$_FILES['image']['name'][$i];
			    $destination = './uploads/campImage/' . $actions['Image'];
				move_uploaded_file($_FILES["image"]["tmp_name"][$i], $destination);
				if ($i == 0) {
					$data['image'] = $actions['Image'];
				}else{
					$data['image'.$i] = $actions['Image'];
				}
			  }  
			}


				// $actions['Image'] = time().'_campReport_'.$_FILES['image']['name'];
				//    $destination = './uploads/campImage/' . $actions['Image'];
				// move_uploaded_file($_FILES["image"]["tmp_name"], $destination);

				//    $data['image'] = $actions['Image'];	
		}		

       $data['createdBy'] = $this->session->userdata('userId');	

      // print_r($data); exit();

          if($this->input->post('submit'))
	       {
	       	 $data['submit'] = 'Y';
	       }

          $id = $this->common_model->insertValue('tbl_camp_reports', $data);

        // $count = $this->input->post('count');

         if(empty($count))
         {
         	$count = 0;
         } 

         $presentName = $this->input->post('presentName');

         $presentDesignation = $this->input->post('presentDesignation');

         $presentOrganisation = $this->input->post('presentOrganisation');

          $contact = $this->input->post('contact');


     if((!empty($presentName[0])) || (!empty($presentDesignation[0])) || (!empty($presentOrganisation[0])) || (!empty($contact[0])) )       
     {
       for($i = 0;$i <= $count;$i++)
       {
          $data1['campId'] = $id;

          $data1['name'] = $presentName[$i];

          $data1['designation'] = $presentDesignation[$i];

          $data1['organisation'] =  $presentOrganisation[$i];

          $data1['contactInfo'] = $contact[$i]; 

        

          $this->common_model->insertValue('tbl_camp_peoples', $data1);
       }
   }


          
         redirect(base_url().'home/campReport');	 		

    	//$data['image'] = 
     	 
    }

    public function viewPeoplePresent()
    {
      $data['campId'] = $this->input->post('campId');

      $main = $this->rolemaster->getPeoplePresent($data);

      echo json_encode($main);
    }

     public function viewPeoplePresentEdit()
    {
      $data['campId'] = $this->input->post('campId');

      $main = $this->rolemaster->getPeoplePresent($data);

      echo json_encode($main);
    }

    public function editPeoplePresent()
    {
    	$data['peopleId'] = $this->input->post('peopleId');

      $main = $this->rolemaster->editPeoplePresent($data);


      echo json_encode($main);
    }

    public function editPeople()
    {
    	$where_clause = array('id'=>$this->input->post('dataId'));
      	
      $row = array('name'=>$this->input->post('name'),'designation'=>$this->input->post('designation'),'organisation'=>$this->input->post('organisation'),'contactInfo'=>$this->input->post('contact'));	

      $table = 'tbl_camp_peoples';

       $this->common_model->updateValue($row,$table,$where_clause);

       redirect(base_url().'home/campReport');	
    }
 
      public function editPeopleEdit()
    {
    	
    	$where_clause = array('id'=>$this->input->post('dataId'));
      	
      $row = array('name'=>$this->input->post('name'),'designation'=>$this->input->post('designation'),'organisation'=>$this->input->post('organisation'),'contactInfo'=>$this->input->post('contact'));	

      $table = 'tbl_camp_peoples';

       $this->common_model->updateValue($row,$table,$where_clause);

       redirect(base_url().'home/editReport/'.$this->input->post('campId'));	
    }



    public function addPeople()
    {
    	  $row = array('name'=>$this->input->post('name'),'designation'=>$this->input->post('designation'),'organisation'=>$this->input->post('organisation'),'contactInfo'=>$this->input->post('contact'),'campId'=>$this->input->post('campId'));

    	  $this->common_model->insertValue('tbl_camp_peoples',$row);	

    	  redirect(base_url().'home/campReport');	

    }

     public function addPeopleEdit()
    {
    	  $row = array('name'=>$this->input->post('name'),'designation'=>$this->input->post('designation'),'organisation'=>$this->input->post('organisation'),'contactInfo'=>$this->input->post('contact'),'campId'=>$this->input->post('campId'));

    	  $this->common_model->insertValue('tbl_camp_peoples',$row);	

    	  redirect(base_url().'home/editReport/'.$this->input->post('campId'));	

    }

    public function editReport($campId)
    {
     	if(!$this->session->userdata('validated')){
			redirect(base_url('home'));
		}

      $data['campId'] = $campId;	

       $data['content'] = 'editCampReport';


    	$data['campReport'] = $this->rolemaster->editReport($campId);

    
    	$data['stateList'] = $this->rolemaster->stateList();


    	$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function updateCampReport()
    {
     
       $where_clause = array('id'=>$this->input->post('campId'));

      //	$data['camp_code'] = $this->input->post('campCode');
    
    	$data['camp_code'] = strtoupper($this->input->post('stateCode')).'/'.strtoupper($this->input->post('districtCode')).'/'.$this->input->post('campCode1');


      if(!empty($this->input->post('campDate')))
      {
    	$data['date_of_camp'] =  date('Y-m-d',strtotime($this->input->post('campDate')));
     }

       if(!empty($this->input->post('startTime')))
      {
    	$data['start_time'] = date('H:i:s',strtotime($this->input->post('startTime')));
      }

        if(!empty($this->input->post('endTime')))
      {  
    	$data['end_time'] = date('H:i:s',strtotime($this->input->post('endTime')));
      }	

    	$data['state'] = $this->input->post('state');

    	$data['district'] = $this->input->post('district');

    	$data['block'] = $this->input->post('block');

    	$data['site'] = $this->input->post('site');

    	$data['latitude'] = $this->input->post('latitude');

    	$data['longitude'] = $this->input->post('longitude');

    	$data['nearset_ictc'] = $this->input->post('ictcDistance');

    	$data['nearest_health_facility'] = $this->input->post('healthDistance');

    	$data['nearest_hiv_service_provider'] = $this->input->post('providerDistance');

        if(is_array($this->input->post('coordinated')))
        {
          $data['coordinated_with'] = implode(',',$this->input->post('coordinated'));
	
        }else{	
    	$data['coordinated_with'] = $this->input->post('coordinated');
       }

    	$data['coordinated_others'] = $this->input->post('othercodetail');

    	$data['hrg_population'] = $this->input->post('hrg');

    	$data['arg_population'] = $this->input->post('arg');

    	$data['in_migration'] = $this->input->post('inMigration');

    	$data['out_migration'] = $this->input->post('outMigration');

    	$data['no_of_labourers'] = $this->input->post('labourers');

    	//$data['cost_for_cbs'] = $this->input->post('cbsCost');

  
      $data['cost_for_renting'] = number_format($this->input->post('rentingCost'), 2, '.', '');
$data['cost_of_mobilisation'] = number_format($this->input->post('mobilisationCost'), 2, '.', '');
$data['cost_of_consumables'] = number_format($this->input->post('consumablesCost'), 2, '.', '');
$data['cost_of_transporting'] = number_format($this->input->post('transportingCost'), 2, '.', '');

	$data['other_major_cost'] = number_format($this->input->post('otherCost'), 2, '.', '');

	 $data['cost_for_cbs'] = $data['cost_for_renting'] + $data['cost_of_mobilisation'] + $data['cost_of_consumables'] + $data['cost_of_transporting'] + $data['other_major_cost'];


    	$data['desc_for_other_cost'] = $this->input->post('otherCostDesc');

    	$data['kits_name'] = $this->input->post('kitsName');

    	$data['batch_no'] = $this->input->post('batch');

        if(!empty($this->input->post('expiryDate')))
      {   
        
    	$data['expiry_date'] =  date('Y-m-d',strtotime($this->input->post('expiryDate')));
    }	

     if(!empty($this->input->post('receivedDate')))
	      {   
	        
	    	$data['date_of_kits_received'] =  date('Y-m-d',strtotime($this->input->post('receivedDate')));
	     }

    	$data['opening_stock'] = $this->input->post('openingStock');

    	$data['received'] = $this->input->post('received');

    //	$data['consumed'] = $this->input->post('consumed');

    	$data['control'] = $this->input->post('control');

    	$data['wastage'] = $this->input->post('wastage');

    	$data['activityDesc'] =$this->input->post('activityDesc');

    	$data['challenges'] = $this->input->post('challenges');

    	$data['innovations'] = $this->input->post('innovations');

    	$data['learing'] = $this->input->post('learing');

    	$data['follow'] = $this->input->post('follow');

    	$data['quantity_indented'] = $this->input->post('quantityIndented');

    	$data['kits_returned'] = $this->input->post('kitsReturned');

    /*	$data['consumed'] = ($data['opening_stock'] + $data['received']) - ($data['wastage']  + $data['kits_returned'] + $data['control']);*/

    $data['consumed'] = $this->input->post('consumed');

     $peopleScreened = $this->rolemaster->campPeopleScreened($data['camp_code']); 

	   $peopleStr = $this->rolemaster->campPeopleStr($data['camp_code']); 

	   $data['no_of_people_attended'] = $this->input->post('peopleAttened');
	   
	   $data['no_of_str_cases_referred_to_ictc'] = $this->input->post('strCases');  

	   $data['no_of_people_screened'] = $peopleScreened[0]['count'];

	   $data['no_of_people_found_to_be_str'] = 	$peopleStr[0]['count'];


       //closing stock

    	$data['closing_stock'] = ($data['opening_stock'] + $data['received']) - ($data['wastage'] + $data['consumed'] + $data['kits_returned'] + $data['control']);

		 if($_FILES['Image'])
		{

			for ($i=0; $i <= 4; $i++) { 
             if(!empty($_FILES['Image']['name'][$i]))
              {
              	
				$actions['Image'] = time().'_campReport_'.$_FILES['Image']['name'][$i];
			    $destination = './uploads/campImage/' . $actions['Image'];
				move_uploaded_file($_FILES["Image"]["tmp_name"][$i], $destination);
				if ($i == 0) {
					$data['image'] = $actions['Image'];
				}else{
					$data['image'.$i] = $actions['Image'];
				}
			  }  
			}

	  }

	// print_r($_FILES['imageNew']);

	 // print_r();

	   if($_FILES['imageNew'])
		{
          
           $a = 2;

           $length = count($this->input->post('imageOld'));

           if($length == 2)
           {
           	 $a = 2;
           }elseif ($length == 3) {
           	$a = 3;
           }else{
           	$a= 4;
           }

           

           $imageNumber = $this->input->post('imageNumber');
             
         if($length == 1 && $imageNumber[0] == 4)
         {
         	         	
				$actions['imageNew'] = time().'_campReport_'.$_FILES['imageNew']['name'][$k];
			    $destination = './uploads/campImage/' . $actions['imageNew'];
				move_uploaded_file($_FILES["imageNew"]["tmp_name"][$k], $destination);
				
                $imageNumber1 = substr($imageNumber[$k], -1);

				 $data['image4'] = $actions['imageNew'];
                 
				
			 
         }else{
			for ($k=0; $k < 3; $k++) { 
				//echo $a;
			
             if(!empty($_FILES['imageNew']['name'][$k]))
              {
              	
				$actions['imageNew'] = time().'_campReport_'.$_FILES['imageNew']['name'][$k];
			    $destination = './uploads/campImage/' . $actions['imageNew'];
				move_uploaded_file($_FILES["imageNew"]["tmp_name"][$k], $destination);
				

				$data['image'.$a] = $actions['imageNew'];
                 
				 $a++;	
			  }  

			 
			} }
				 

		}
         
       //  echo "<pre>";  print_r($data);exit();
	
       $data['updatedBy'] = $this->session->userdata('userId');	

       $data['updateDate'] = date('Y-m-d H:i:s'); 	

       if($this->input->post('submit'))
       {
       	 $data['submit'] = 'Y';
       }

      
     
        $table = 'tbl_camp_reports';

       $this->common_model->updateValue($data,$table,$where_clause); 

      
         redirect(base_url().'home/campReport');	 			
    }

    public function testFun()
    {
    	echo 'testFun';
    }

    public function stockRegister()
    {
     if($this->session->userdata('userType') == 'partner')
      {
    	$stateId = $this->session->userdata('stateId');

    	$districtId = $this->session->userData('districtId');

    	$data['districtList'] = $this->rolemaster->getStateDistrict($stateId,$districtId);

    	$data['stateDetails'] = $this->rolemaster->state_by_id($stateId);
     }

    	$data['stateList'] = $this->rolemaster->stateList();

    	$data['content'] = 'stockRegister';

    	$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function downloadCampData()
    {
    		$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

		 	$data['stateExcel'] = $this->input->post('stateExcel');
    		$data['districtExcel'] = $this->input->post('districtExcel');
        $data['daterangeExcel'] = $this->input->post('exceldaterange');
        $data['siteExcel'] = $this->input->post('siteExcel');
        $data['submitExcel'] = $this->input->post('submitExcel');

        
     	$result = $this->rolemaster->downloadCampData($data);

     	$filename = 'campData.xls';


		$header = array('Camp Code','Date Of Camp','Start time','End time','State','District','Block','Site','Latitude','Longitude','Distance from Nearest ICTC in Kms','Distance from nearest health facility','Distance from nearest HIV service provider','Coordinated with','If "Others"','HRG Population','ARG Population','In-Migration','Out-Migration','No. of labourers','Activity Description','No. of people attended','No. of people screened','No. of people found to be str','No. of STR cases referred to ICTC','Challenges','Innovations','Learnings','Follow','Other remark','Total cost for conducting CBS','Cost of renting locations/assets','Cost of consumables','Cost of special mobilisation activities','Cost of transporting personnel and cold chain for kits','Any other major cost involved','Description of Other costs','Name of the kits','Batch No','Expiry date','Opening stock','Received','Consumed','Control','Wastage/Damage','Closing stock','Quantity indented','Kits returned, if any','Created Date');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
    }


    public function filterCampReport()
    {
    	$data['role_master'] = $this->rolemaster;

    		$data['stateFilter'] = $this->input->post('state');
    		$data['districtFilter'] = $this->input->post('district');
        $data['daterange'] = $this->input->post('daterange');
        $data['siteFilter'] = $this->input->post('siteFilter');
        $data['submitFilter'] = $this->input->post('submitFilter');

        $data['campReportList'] = $this->rolemaster->filterCampReport($data);

         $data['stateList'] = $this->rolemaster->stateList();

         	$data['content'] = 'campReport';


    	$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function viewUploadPhoto()
    {
    	 $campId = $this->input->post('campId');

      $main = $this->rolemaster->editReport($campId);

      echo json_encode($main);
    }

  /*  public function addPhoto()
    {
    	$data['campId'] = 

    	  if($_FILES['image']['name'])
		{
			$actions['Image'] = time().'_campReport_'.$_FILES['image']['name'];
		   $destination = './uploads/campImage/' . $actions['Image'];
			move_uploaded_file($_FILES["image"]["tmp_name"], $destination);

		   $data['image'] = $actions['Image'];	
		}		


    }*/

    public function quizData($quizId)
    {
      	if(!$this->session->userdata('validated')){
			redirect(base_url('home'));
		}	
       $data['quizId'] = $quizId;	

       $data['content'] = 'editQuizData';


    	$data['quizData'] = $this->rolemaster->quizData($quizId);


    	$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function insertQuizData()
    {     

    	//print_r($this->input->post());exit();
    	 $this->rolemaster->insertQuizData();
    	redirect(base_url().'home/quizData/'.$this->input->post('quizId'));
    }

     public function editQuizData($questionId)
    {   
      	if(!$this->session->userdata('validated')){
			redirect(base_url('home'));
		}  
    	$data['questionId'] = $questionId;
    	$data['quizData'] = $this->rolemaster->editQuizData($questionId);

    	

    	     $data['content'] = 'editQuizQuestion';

    		$this->load->view('Layout/dashboardLayoutDash',$data);
    }

    public function updateQuizData()
    {
    	/*echo "<pre>";
    	print_r($this->input->post());exit();*/
    	$questionId  = $this->input->post('questionId');

    	$data['questionId'] = $this->input->post('questionId');

    	$this->rolemaster->updateQuizData($questionId);

    	redirect(base_url().'home/quizData/'.$this->input->post('quizId'));
    }

    public function checkCampUniqueCode()
    {
    	$data['campCode'] = $this->input->post('campCode');

    	$data['campId'] = $this->input->post('campId');

    	$main = $this->rolemaster->checkCampUniqueCode($data);

    	 echo json_encode($main);

    }

    public function checkUserExist()
    {
    	$data['userName'] = $this->input->post('userName');

    	//$data['password'] = $this->input->post('password');

    	$main = $this->rolemaster->checkUserExist($data);

    	echo json_encode($main);
    }

    public function getStateInfo()
    {
    	$data['stateId'] = $this->input->post('stateId');

    		$main = $this->rolemaster->getStateInfo($data);

    	echo json_encode($main);
    }

    public function getDistrictInfo()
    {
      $data['districtId'] = $this->input->post('districtId');

    		$main = $this->rolemaster->getDistrictInfo($data);

    	echo json_encode($main);
    }

   public function positiveLine()
   {
   	 $data['stateList'] = $this->rolemaster->stateList();	

   	 $data['content'] = 'positiveLine';

     $this->load->view('Layout/dashboardLayoutDash',$data);   	 
   }

   public function getPositiveReport()
   {
    		$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);
		// echo date('Y/m/d');exit();

	if(!empty($this->input->post('daterange')))
	{

   	 	$data['dates'] = explode('-',$this->input->post('daterange'));
	}else{
		$data['dates'];
	}
   	 	$data['startDate'] = date('Y-m-d',strtotime($data['dates'][0]));

		$data['endDate'] = date('Y-m-d',strtotime($data['dates'][1]));

	    $data['state'] = $this->input->post('state');

	    $data['district'] = $this->input->post('district');	
	    

    $result = $this->rolemaster->getPositiveReport($data);


    	$stateDetails = $this->rolemaster->state_by_id($this->input->post('state'));

		//print_r($stateDetails);

		$districtDetails = $this->rolemaster->district_by_id($this->input->post('district'));

		//print_r($districtDetails);

		//exit();

		$dates = explode('-',$this->input->post('daterange'));

		$startDate = date('dmY',strtotime($dates[0]));

		$endDate = date('dmY',strtotime($dates[1]));


    	$filename = 'PLL_'.$stateDetails[0]['stateCode'].'_'.$districtDetails[0]['districtCode'].'_'.$startDate.'_'.$endDate.'.xls';

    $header = array('Date of Registration','Place of Registration','SAATHII Registration No.','Name of the Client','Address','District','State','Age','Gender','Identity','Mode of Contact','Date of Out-referral to SA-ICTC','Place of SA-ICTC Referred','ICTC - PID Number','Date of HIV Confirmation Test','Linked to ART','ART Registration Date','ART Registration Number','Baseline CD4 Count','Other Service','REMARKS','Marital Status','Occupation','Occupation-Other');
    
    	$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	


   } 

    public function excelTest()
    {
    	$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

	//	$objPHPExcel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setCellValue('B5', "SELECT ITEM");


		$configs = "DUS800, DUG900+3xRRUS, DUW2100, 2xMU, SIU, DUS800+3xRRUS, DUG900+3xRRUS, DUW2100";

		$objValidation = $this->excel->getActiveSheet()->getCell('B5')->getDataValidation();
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
		$objValidation->setFormula1('"'.$configs.'"');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$this->excel->setActiveSheetIndex(0);


		// Save Excel 95 file
		echo date('H:i:s') , " Write to Excel5 format" , EOL;
		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('populate.xls');

    }

   public function strReport()
   {
   		 $data['stateList'] = $this->rolemaster->stateList();
   		 if(!empty($this->input->post('daterange')))
   		{
   		 $data['dates'] = explode('-',$this->input->post('daterange'));
   		
   		   	 	$data['startDate'] = date('Y-m-d',strtotime($data['dates'][0]));
   		
   				$data['endDate'] = date('Y-m-d',strtotime($data['dates'][1]));
   		}


   			    $data['state'] = $this->input->post('state');
   		
   			    $data['district'] = $this->input->post('district');	
   		

   		 $data['strreport']	= $this->rolemaster->getStrReport($data);
   		// 	print_r(json_encode($data['strreport']));exit();
	   	 $data['content'] = 'strReport';

	     $this->load->view('Layout/dashboardLayoutDash',$data);   	 

   }

   public function downloadFileReport()
   {
   		$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

		  $data['reportIdExcel'] = $this->input->post('reportIdExcel');

   	 $data['stateExcel'] = $this->input->post('stateExcel');

   	 $data['districtExcel'] = $this->input->post('districtExcel');

   	 $data['mobileExcel'] = $this->input->post('mobileExcel');

   	  	 $data['datesExcel'] = explode('-',$this->input->post('daterangeExcel'));

   	 	$data['startDateExcel'] = date('Y-m-d',strtotime($data['datesExcel'][0]));

		$data['endDateExcel'] = date('Y-m-d',strtotime($data['datesExcel'][1]));	

        
     	$result = $this->rolemaster->downloadFileReport($data);

     	$filename = 'violenceReport.xls';


		$header = array('First Name',' Last Name','s/0, d/o, c/o','Age','Contact  address','State','District','Mobile number','Date of incidence','Place of Incidence (State)','Place of Incidence (District )','Date of incidence reported','Type of incidence','Type of incidence other details','By whom','By whom other details','Support required','Date of report received','Incidence addressed by whom(Internal)','Incidence addressed by whom(External)','Date of incidence addressed','Types of services provided','Method of resolving','Status','Brief description' ,'If pending , reason/s');

		$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		$this->excel->getActiveSheet()->fromArray($header,null,'A1');

		$this->excel->getActiveSheet()->fromArray($result, null, 'A2');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

   }

   public function getStrReport()
   {
   			$this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

   	 $data['dates'] = explode('-',$this->input->post('daterange'));

   	 	$data['startDate'] = date('Y-m-d',strtotime($data['dates'][0]));

		$data['endDate'] = date('Y-m-d',strtotime($data['dates'][1]));

	    $data['state'] = $this->input->post('state');

	    $data['district'] = $this->input->post('district');	

	 //   print_r($data);exit();
	    

    $result = $this->rolemaster->getStrReport($data);

    $stateDetails = $this->rolemaster->state_by_id($this->input->post('state'));

		//print_r($stateDetails);

		$districtDetails = $this->rolemaster->district_by_id($this->input->post('district'));

		//print_r($districtDetails);

			$startDate = date('dmY',strtotime($data['dates'][0]));

			$endDate = date('dmY',strtotime($data['dates'][1]));

    	$filename = 'STR_'.$stateDetails[0]['stateCode'].'_'.$districtDetails[0]['districtCode'].'_'.$startDate.'_'.$endDate.'.xls';

    $header = array('ARG (Driver/ Truckers)','ARG(Migrants)','ARG(Students)','ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)','ARG (Others i.e. salesman, vendor, salaried employ, etc.)','ARG (Partner/ Spouse of HRG)','ARG (Partner/Spouse of ARG)','ARG (TG (F-M))','Total Screening (ARG)','HRG (MSM)','HRG (TG)','HRG (FSW)','(HRG) (IDU)','Total Screening (HRG)','Total clients screened (ARG+HRG)','ARG (Drivers/ Truckers)','ARG(Migrants)','ARG (Students)','ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)','ARG (Others i.e. salesman, vendor, salaried employ, etc.)','ARG (Partner/ Spouse of HRG)','ARG (Partnar/Spouse of ARG)','ARG (TG (F-M))','Total Screening (ARG)','HRG (MSM)','HRG (TG)','HRG (FSW)','(HRG) (IDU)','Total Screening (HRG)','Total clients screened (ARG+HRG)','ARG (Driers/ Truckers)','ARG (Migrants)','ARG (Students)','ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)','ARG (Others i.e. salesman, vendor, salaried employ, etc.)','ARG (Partner/ Spouse of HRG)','ARG (Partnar/Spouse of ARG)','ARG (TG (F-M))','Total Screening (ARG)','HRG (MSM)','HRG (TG)','HRG (FSW)','(HRG) (IDU)','Total Screening (HRG)','Total clients screened (ARG+HRG)','ARG (Drivers/ Truckers)','ARG (Migrants)','ARG (Students)','ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)','ARG (Others i.e. salesman, vendor, salaried employ, etc.)','ARG (Partner/ Spouse of HRG)','ARG (Partnar/Spouse of ARG)','ARG (TG (F-M))','Total Screened (ARG)','HRG (MSM)','HRG (TG)','HRG (FSW)','(HRG) (IDU)','Total Screened (HRG)','Total clients screened (ARG+HRG)','ARG (Drivers/ Truckers)','ARG (Migrants)','ARG (Students)','ARG (Daily wage laborer i.e. construction, carpenter, farm labourer, elecctrician, etc.)','ARG (Others i.e. salesman, vendor, salaried employ, etc.)','ARG (Partner/ Spouse of HRG)','ARG  (Partnar/Spouse of ARG)','ARG (TG (F-M))','Total Screened (ARG)','HRG (MSM)','HRG (TG)','HRG (FSW)','(HRG) (IDU)','Total Screened (HRG)','Total clients screened (ARG+HRG)');
    
    	$this->excel->getActiveSheet()->getStyle('A1:AZ1')->getFont()->setBold(true);

		//$this->excel->getActiveSheet()->fromArray($header,null,'A1');
    	$this->excel->getActiveSheet()->getStyle('L1:L201')->getfill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('D4D6D8');

		$this->excel->getActiveSheet()->mergeCells('A1:C1');

		$this->excel->getActiveSheet()->getStyle('A1:C1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DCDCDC');

		$this->excel->getActiveSheet()->getStyle('A2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DCDCDC');

		$this->excel->getActiveSheet()->setCellValue('A2','State');

		$this->excel->getActiveSheet()->setCellValue('B2','District');

		$this->excel->getActiveSheet()->setCellValue('C2','Date of Finger Prick screening');

		$this->excel->getActiveSheet()->setCellValue('D1','Screened for HIV through WBFPS');

		$this->excel->getActiveSheet()->mergeCells('D1:R1');
		

		$this->excel->getActiveSheet()->getStyle('D1:R1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');

		$this->excel->getActiveSheet()->getStyle('D2:R2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');

		$this->excel->getActiveSheet()->setCellValue('S1','STR Reactive through WBFPS');

		$this->excel->getActiveSheet()->mergeCells('S1:AG1');

		$this->excel->getActiveSheet()->getStyle('S1:AG1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

		$this->excel->getActiveSheet()->getStyle('S2:AG2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');

		$this->excel->getActiveSheet()->setCellValue('AH1','STR clients underwent confirmatory tests');

		$this->excel->getActiveSheet()->mergeCells('AH1:AV1');

		$this->excel->getActiveSheet()->getStyle('AH1:AV1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00BFFF');

        $this->excel->getActiveSheet()->getStyle('AH2:AV2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00BFFF');


		$this->excel->getActiveSheet()->setCellValue('AW1','STR found HIV + through confirmatory tests  ');

		$this->excel->getActiveSheet()->mergeCells('AW1:BK1');

		$this->excel->getActiveSheet()->getStyle('AW1:BK1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC0CB');

		$this->excel->getActiveSheet()->getStyle('AW2:BK2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFC0CB');

		$this->excel->getActiveSheet()->setCellValue('BL1','Confirmed HIV+ clients linked to ART ');

		$this->excel->getActiveSheet()->mergeCells('BL1:CA1');

		$this->excel->getActiveSheet()->getStyle('BL1:CA1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF7F50');

		$this->excel->getActiveSheet()->getStyle('BL2:CA2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FF7F50');

		$this->excel->getActiveSheet()->fromArray($header,null,'D2');

		$this->excel->getActiveSheet()->getStyle("A1:C1")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));

			$this->excel->getActiveSheet()->getStyle("A2:C2")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));


		$this->excel->getActiveSheet()->getStyle("D1:R1")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));

		$this->excel->getActiveSheet()->getStyle("S1:AG1")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));

		$this->excel->getActiveSheet()->getStyle("AH1:AV1")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));	

		$this->excel->getActiveSheet()->getStyle("AW1:BK1")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));	
		
		$this->excel->getActiveSheet()->getStyle("BL1:CA1")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));	

			$this->excel->getActiveSheet()->getStyle("D2:CA2")->applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('rgb' => '000000')))));		



		$this->excel->getActiveSheet()->fromArray($result, null, 'A3');

		//$filename=$table.'.xlsx'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

   }

   public function getPartnerList()
   {
   	 $main = $this->rolemaster->ongroundPartnerList();

   	 	echo json_encode($main);
   }

   public function getProviderList()
   {
   	 $main = $this->rolemaster->serviceProviderList();

   	  echo json_encode($main);
   }


   public function trackReport()
   {
   	if($this->session->userdata('userType') != 'admin')
      {	
      	$stateId = $this->session->userdata('stateId');
   
       	$districtId = $this->session->userData('districtId');
   
       	$data['districtList'] = $this->rolemaster->getStateDistrict($stateId,$districtId);
   
       	$data['stateDetails'] = $this->rolemaster->state_by_id($stateId);
      }

   	  $data['stateList'] = $this->rolemaster->stateList();	

   	  $data['reportList'] = $this->rolemaster->reportList();

   	  	 $data['content'] = 'trackReport';

	     $this->load->view('Layout/dashboardLayoutDash',$data);   	 

   }

   public function getTrackReport()
   {
   	if($this->session->userdata('userType') != 'admin')
      {	
      	$stateId = $this->session->userdata('stateId');
   
       	$districtId = $this->session->userData('districtId');
   
       	$data['districtList'] = $this->rolemaster->getStateDistrict($stateId,$districtId);
   
       	$data['stateDetails'] = $this->rolemaster->state_by_id($stateId);
      }
   	 $data['reportId'] = $this->input->post('reportId');

   	 $data['state'] = $this->input->post('state');

   	 $data['district'] = $this->input->post('district');

   	 $data['mobile'] = $this->input->post('mobile');

   	 $data['daterange'] =  $this->input->post('daterange');

   	  	 $data['dates'] = explode('-',$this->input->post('daterange'));

   	 	$data['startDate'] = date('Y-m-d',strtotime($data['dates'][0]));

		$data['endDate'] = date('Y-m-d',strtotime($data['dates'][1]));

     $data['stateList'] = $this->rolemaster->stateList();	

   	  $data['reportList'] = $this->rolemaster->reportList();


   	 $data['getReportList'] = $this->rolemaster->getTrackReport($data);

   	 //print_r($data);exit();

    	 $data['content'] = 'trackReport';

	     $this->load->view('Layout/dashboardLayoutDash',$data);   	 


   }

  public function editTrackReport($reportId)
  {
  	$data['reportId'] = $reportId;

  	$data['reportData'] = $this->rolemaster->editTrackReport($reportId);

  	//print_r($data);exit();

  	 $data['content'] = 'editTrackReport';

	     $this->load->view('Layout/dashboardLayoutDash',$data);   	 


  }

 public function updateTrackReport()
 {
 	//print_r($this->input->post());
 	 $where = array('id'=>$this->input->post('reportId'));

 	 $data['incidence_addressed_internal'] = $this->input->post('incidenceAddressInternal');

 	 $data['incidence_addressed_external'] = $this->input->post('incidenceAddressExternal');

 	$data['type_of_services_other'] = $this->input->post('serviceTypeOther');
 	
 	$data['incidence_addressed_external_other'] = $this->input->post('addressExternalOther'); 

 	if($this->input->post('dateIncidenceAddress')) 

 	{ 
 		$data['date_of_incidence_addressed'] = date('Y-m-d',strtotime($this->input->post('dateIncidenceAddress'))) ;
 	}

 	$data['type_of_services'] = implode(',', $this->input->post('serviceType')) ;

 	$data['method_of_resolving'] = $this->input->post('methodResolve');

    $data['status'] = $this->input->post('status');

    $data['description'] = trim($this->input->post('description'));

    $data['reason'] = trim($this->input->post('reason'));

    $data['createdBy'] = $this->session->userdata('userId');

    //print_r($data);exit();

    $table = 'tbl_file_reports';

     $this->common_model->updateValue($data,$table,$where); 


    redirect(base_url().'home/trackReport');


 }

 public function trackReportHistory($reportId)
 {
 	$data['reportHistory'] = $this->rolemaster->trackReportHistory($reportId);

 	$data['content'] = 'trackReportHistory';

 	 $this->load->view('Layout/dashboardLayoutDash',$data);   	


 }

 public function fileReportFeedback()
 {
 	$data['feedbackList'] = $this->rolemaster->fileReportFeedback();

 	$data['content'] = 'fileReportFeedback';

 	 $this->load->view('Layout/dashboardLayoutDash',$data);   

 }

 public function testExcelFunctionNew()
 {
   $this->load->library('excel');

   	$this->excel->setActiveSheetIndex(0);


    $this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("A1", "UK");
    $this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("A2", "USA");

    $this->excel->addNamedRange( 
        new PHPExcel_NamedRange(
            'countries', 
            $this->excel->getActiveSheet()->getSheetByName('Worksheet 1'), 
            'A1:A2'
        ) 
    );

$this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("B1", "London");
    $this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("B2", "Birmingham");
    $this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("B3", "Leeds");
    $this->excel->addNamedRange( 
        new PHPExcel_NamedRange(
            'UK', 
            $this->excel->getActiveSheet()->getSheetByName('Worksheet 1'), 
            'B1:B3'
        ) 
    );

$this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("C1", "Atlanta");
    $this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("C2", "New York");
    $this->excel->getActiveSheet()->getSheetByName('Worksheet 1')->setCellValue("C3", "Los Angeles");
    $this->excel->addNamedRange( 
        new PHPExcel_NamedRange(
            'USA', 
            $this->excel->getActiveSheet()->getSheetByName('Worksheet 1'), 
            'C1:C3'
        ) 
    );

    	// Save Excel 95 file
		echo date('H:i:s') , " Write to Excel5 format" , EOL;
		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('populateNewExcel.xls');

 }

public function testExcelFunction()
{
		$this->load->library('excel');


	/*$this->excel->getActiveSheet()->SetCellValue("A1", "UK");
    $this->excel->getActiveSheet()->SetCellValue("A2", "USA");

    $this->excel->getActiveSheet()->addNamedRange( 
        new PHPExcel_NamedRange(
            'countries', 
            $this->excel->getActiveSheet(), 
            'A1:A2'
        ) 
    );

$this->excel->getActiveSheet()->SetCellValue("B1", "London");
    $this->excel->getActiveSheet()->SetCellValue("B2", "Birmingham");
    $this->excel->getActiveSheet()->SetCellValue("B3", "Leeds");
    $this->excel->getActiveSheet()->addNamedRange( 
        new PHPExcel_NamedRange(
            'UK', 
            $this->excel->getActiveSheet(), 
            'B1:B3'
        ) 
    );

$this->excel->getActiveSheet()->SetCellValue("C1", "Atlanta");
    $this->excel->getActiveSheet()->SetCellValue("C2", "New York");
    $this->excel->getActiveSheet()->SetCellValue("C3", "Los Angeles");
    $this->excel->getActiveSheet()->addNamedRange( 
        new PHPExcel_NamedRange(
            'USA', 
            $this->excel->getActiveSheet(), 
            'C1:C3'
        ) 
    );

$objValidation = $this->excel->getActiveSheet()->getCell('A1')->getDataValidation();
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
    $objValidation->setFormula1("=countries"); //note this!


    $objValidation = $this->excel->getActiveSheet()->getCell('B1')->getDataValidation();
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
    $objValidation->setFormula1('=INDIRECT($A$1)'); 


    	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$this->excel->setActiveSheetIndex(0);*/


	for ($i = 3; $i <= 250; $i++)
{
    $objValidation2 = $this->excel->getActiveSheet()->getCell('N' . $i)->getDataValidation();
    $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
    $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
    $objValidation2->setAllowBlank(false);
    $objValidation2->setShowInputMessage(true);
    $objValidation2->setShowDropDown(true);
    $objValidation2->setPromptTitle('Pick from list');
    $objValidation2->setPrompt('Please pick a value from the drop-down list.');
    $objValidation2->setErrorTitle('Input error');
    $objValidation2->setError('Value is not in list');
    $objValidation2->setFormula1('"male,female"');
}	


		// Save Excel 95 file
		echo date('H:i:s') , " Write to Excel5 format" , EOL;
		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('populateNew.xls');



}


 public function testPdf()
 {
    $this->load->library('m_pdf');

 	//$this->m_pdf->pdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

 		$data['campReport'] = $this->rolemaster->editReport(1);

        	//print_r($data['campReport']);exit();

        	$post['stateId'] = $data['campReport'][0]['state'];

        	$post['districtId'] = $data['campReport'][0]['district'];

        	 $data['stateDetails'] = $this->rolemaster->getStateInfo($post);

        	 $data['districtDetails'] = $this->rolemaster->getDistrictInfo($post);

        	 $post['campId'] = 1;

          $data['peoplePresent'] = $this->rolemaster->getPeoplePresent($post);

$data['mpdf'] = $this->m_pdf->pdf;


$footer = '<div align="center">See <a href="http://this->m_pdf->pdf1.com/manual/index.php">documentation manual</a></div>';
$footerE = '<div align="center">See <a href="http://this->m_pdf->pdf1.com/manual/index.php">documentation manual</a></div>';


$this->m_pdf->pdf->SetHTMLHeader($header);
//$this->m_pdf->pdf->SetHTMLHeader($headerE,'E');
$this->m_pdf->pdf->SetHTMLFooter($footer);
//$this->m_pdf->pdf->SetHTMLFooter($footerE,'E');

  $html =  $this->load->view('campReportPdf',$data,true);



$this->m_pdf->pdf->WriteHTML($html);

$this->m_pdf->pdf->Output();

 }


 public function campReportPdf($campReportId)
 {
        $this->load->library('m_pdf');

        	$data['campReport'] = $this->rolemaster->editReport($campReportId);

        	//print_r($data['campReport']);exit();

        	$post['stateId'] = $data['campReport'][0]['state'];

        	$post['districtId'] = $data['campReport'][0]['district'];

        	 $data['stateDetails'] = $this->rolemaster->getStateInfo($post);

        	 $data['districtDetails'] = $this->rolemaster->getDistrictInfo($post);

        	 $post['campId'] = $campReportId;

          $data['peoplePresent'] = $this->rolemaster->getPeoplePresent($post);
          //print_r($data);exit();

        $FileName = 'campReport'.'_'.str_replace('/','',$data['campReport'][0]['camp_code']).'.pdf';

           $data['mpdf'] = $this->m_pdf->pdf;



       $html =  $this->load->view('campReportPdf',$data,true);

          $this->m_pdf->pdf->WriteHTML($html);

         try{
      //$path="uploads/campReportPdf/";
      $pdfFilePath= $FileName;
      $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');


      // $this->m_pdf->pdf->SetDisplayMode('fullpage');
     // $this->m_pdf->pdf->setFooter('<div style="text-align: center; font-weight: bold; background-color:black;color: white; width:1000px;">Powered by raj sehgal</div>');
      $this->m_pdf->pdf->SetTitle('Camp Report PDF');
      //$imagepath = base_url().'uploads/frameImage/frame1.jpg';
       //$this->m_pdf->pdf->Image($imagepath,0,0,210,297,'jpg','',true,false);


      /*$stylesheet = file_get_contents(getcwd().'\application\third_party\mpdf60\examples\mpdfstyleA4.css');
      $this->m_pdf->pdf->WriteHTML($stylesheet,1);*/
   
     
     //  $w = 10;$h = 10;
     //$this->mpdf->pdf->WriteCell(float,float,'shkjfhdkj');
      // $this->mpdf->pdf->text_input_as_HTML = true;
    
     $this->m_pdf->pdf->Output($pdfFilePath,"D");
     /* $this->db->set('pdf',$FileName)
          ->where('id',$test[0]['id'])
          ->update('tbl_catalogue_master');*/
    

    
    } catch (MpdfException $e) 
    {
        echo $e->getMessage();
    }     
          
  }   
	
}
