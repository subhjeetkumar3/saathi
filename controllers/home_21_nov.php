<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define("GOOGLE_API_KEY", "AIzaSyAxPmMr__6hq0_g-IPlEpccHOwyeKQWta4");

class Home extends CI_Controller {
   function __construct() {
		parent::__construct();
        $this->load->model('role/rolemaster');        
    } 
  
    public function index($msg = NULL){ 
		if($this->session->userdata('validated')){
			redirect(base_url().'home/dashboard');
		}
		$data['msg'] = $msg;
		$data['content'] = 'login';
        $this->load->view('Layout/dashboardLayoutLogin',$data);       
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
    	$path = "C:\art.png";

    	if(is_readable($path))
    	{
    		echo "yes";
    	}
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
					if(trim($row['A']) != ''){
                       $uniqueId = $this->rolemaster->ongroundPartnerUniqueId(); 
                       $checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['I']),trim($row['H']));

						$insert['ongroundPartnerUniqueId'] = $uniqueId;
						$insert['name']	 = trim($row['A']);
						$insert['address']	 = trim($row['B']);
						$insert['mobile']	 = trim($row['C']);
						$insert['officePhone']	 = trim($row['D']);
						$insert['email']	 = trim($row['E']);
						$insert['location'] = trim($row['G']);
						$insert['stateId'] = $checkStateDistrict[0]['stateId'];
						$insert['districtId'] = $checkStateDistrict[0]['districtId'];
						$insert['dayAndTime'] = trim($row['J']);
						$insert['latitude']	 = trim($row['K']);
						$insert['longtitute']	 = trim($row['L']);
						//$insert['skypeId']	 = trim($row['H']);
						//$insert['website']	 = trim($row['I']);
						$insert['createdBy']	 = $this->session->userdata('userId');
						$id = $this->common_model->insertValue('tbl_onground_partner_data', $insert);
						$total++;
					}else{
						$error[$j]['error'] = 'Field is mandatory';
						$error[$j]['name']	 = trim($row['A']);
						$error[$j]['address']	 = trim($row['B']);
						$error[$j]['officePhone']	 = trim($row['C']);
						$error[$j]['mobile']	 = trim($row['D']);
						$error[$j]['email']	 = trim($row['E']);
						$error[$j]['latitude']	 = trim($row['F']);
						$error[$j]['longtitute']	 = trim($row['G']);
						$error[$j]['skypeId']	 = trim($row['H']);
						$error[$j]['website']	 = trim($row['I']);
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

			print_r($this->input->post());exit();
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
		}
		$data['content'] = 'serviceProvider';
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
			$data['userById'] = $this->rolemaster->userById($id);
		}
		
		$data['role_master'] = $this->rolemaster;
		$data['content'] = 'user';
		$data['exceldaterange'] = '';
		$data['exceldaterange'] = '';
		$data['activeuserList'] = $this->rolemaster->activeuserList();
		$data['inactiveuserList'] = $this->rolemaster->inactiveuserList();
		$data['empUser'] = $this->rolemaster->empUser(3);
        $data['websiteUser'] = $this->rolemaster->websiteUser();

		$data['stateList'] = $this->rolemaster->stateList();

		
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

            $message = "User created successfully with uniqueId ".$result[0]['userUniqueId'];

			 $this->session->set_flashdata('message',$message);
		}
		
		
		redirect(base_url().'home/user');
    }

    public function filterUser()
    {
    	$data['daterange'] = $this->input->post('daterange');
    
        $data['userBy'] = $this->input->post('userBy');
    
    	$data['userType'] = $this->input->post('userType');

    	$data['wildcard'] = $this->input->post('wildcard');

    	$data['stateFilter'] = $this->input->post('stateFilter');

    	$data['districtFilter'] = implode(',',$this->input->post('districtFilter'));

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

    	$data['content'] = 'user';

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
					if(trim($row['E']) != '' && trim($row['F']) != '' && trim($row['G']) != '' && trim($row['H']) != '' && trim($row['I']) != '' && trim($row['J']) != '' && trim($row['K']) != ''){
						$len = strlen(trim($row['J']));
					
					  	if($len == 10)
						  {
							$checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['L']),trim($row['M']));
							// echo '<pre>';print_r($checkStateDistrict);exit;
							if($checkStateDistrict){
								$checkStateDistrict1 = $this->rolemaster->checkStateDistrict(trim($row['X']),trim($row['Y']));
							
								if($checkStateDistrict1)
							  {	

							     $userMobile = $this->rolemaster->checkUserMobile(trim($row['J']));

							     if(empty($userMobile))
							     {
							     	echo $row['M'];
							     	    $insert['registeredOn'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));
							     	    $insert['campCode'] = trim($row['B']);
							     	    $insert['registeredBy'] = trim($row['C']);
							     	    $insert['userUniqueId'] = $this->rolemaster->createUserUniqueId(trim($row['M']));
							     	    
							     	  //  $insert['registerFromDevice'] = trim($row['D']);
										$insert['userName'] = trim($row['J']);
									    $insert['password'] = md5('123456');
									    $insert['name'] = trim($row['E']);
									    $insert['nameAlias'] = trim($row['F']);
									    $insert['dob'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['G'])));
									    $insert['age'] = trim($row['H']);
									    $insert['gender'] = trim($row['I']);
									    $insert['mobileNo'] = trim($row['J']);
									    $insert['address'] =  trim($row['K']);
									    $insert['educationalLevel'] = trim($row['N']);
									    $insert['occupation'] = trim($row['O']);
									    $insert['occupation_other'] = trim($row['P']);
									    $insert['domainOfWork'] = trim($row['Q']);
									    $insert['monthlyIncome'] = trim($row['R']);
									    $insert['maritalStatus'] = trim($row['S']);
									    $insert['maritalStatus_other'] = trim($row['T']);
									    $insert['male_children'] = trim($row['U']);
									    $insert['female_children'] = trim($row['V']);
									    $insert['total_children'] = trim($row['W']);
									    $insert['state'] = $checkStateDistrict1[0]['stateId'];
									    $insert['districtId'] = $checkStateDistrict1[0]['districtId'];
									    $insert['addressState'] = $checkStateDistrict[0]['stateId'];
									    $insert['addressDistrict'] = $checkStateDistrict[0]['districtId'];
									 
									    $insert['secondaryIdentity'] = trim($row['Z']);
									    $insert['secondaryIdentity_other'] = trim($row['AA']);
									    $insert['referralPoint'] = trim($row['AB']);
									    $insert['referralPoint_others'] = trim($row['AC']);
									    $insert['shareInfoAboutSexualBehaviour'] = trim($row['AD']);
									    $insert['multipleSexPartner'] = trim($row['AE']);
									    $insert['sought'] = trim($row['AF']);
									    $insert['sexualBehaviour'] = trim($row['AG']);
									    $insert['prefferedSexualAct'] = trim($row['AH']);
									    $insert['condomUsage'] = trim($row['AI']);
									    $insert['substanceUse'] = trim($row['AJ']);
									    $insert['hivTestResult'] = trim($row['AK']);
									    $insert['hivTestTime'] = trim($row['AL']);
									    $insert['pastHivReport'] = trim($row['AM']);
									    $insert['fingerDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AN'])));
									    $insert['saictcStatus'] = trim($row['AO']);
									    $insert['saictcDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AP'])));
									    $insert['saictcPlace'] = trim($row['AQ']);
									    $insert['ictcNumber'] = trim($row['AR']);
									    $insert['hivDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AS'])));
									    $insert['hivStatus'] = trim($row['AT']);
									    $insert['reportIssuedDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['AU'])));
									    $insert['reportStatus'] = trim($row['AV']);
									    $insert['remark']= trim($row['AW']);
									    $insert['userVerify'] = 'Y';
									    $insert['registerFromDevice'] = 'Web';
									    $insert['registerMode'] = 'Online';

		

										$this->common_model->insertValue('tbl_user',$insert);

								//$id = $this->rolemaster->insertUserValue($insert);
								//echo $this->db->last_query();exit;
								$total++;
							 }else{
							 		$error[$j]['error'] = 'Mobile Number already exist';
							 		 $error[$j]['createdDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));
							     	    $error[$j]['userUniqueId'] = trim($row['B']);
							     	    $error[$j]['createdBy'] = trim($row['C']);
							     	    $error[$j]['registerFromDevice'] = trim($row['D']);
										$error[$j]['userName'] = trim($row['J']);
									    $error[$j]['password'] = md5('123456');
									    $error[$j]['name'] = trim($row['E']);
									    $error[$j]['nameAlias'] = trim($row['F']);
									    $error[$j]['dob'] = trim($row['G']);
									    $error[$j]['age'] = trim($row['H']);
									    $error[$j]['gender'] = trim($row['I']);
									    $error[$j]['mobileNo'] = trim($row['J']);
									    $error[$j]['address'] =  trim($row['K']);
									    $error[$j]['educationalLevel'] = trim($row['N']);
									    $error[$j]['occupation'] = trim($row['O']);
									    $error[$j]['occupation_other'] = trim($row['P']);
									    $error[$j]['domainOfWork'] = trim($row['Q']);
									    $error[$j]['monthlyIncome'] = trim($row['R']);
									    $error[$j]['maritalStatus'] = trim($row['S']);
									    $error[$j]['maritalStatus_other'] = trim($row['T']);
									    $error[$j]['male_children'] = trim($row['U']);
									    $error[$j]['female_children'] = trim($row['V']);
									    $error[$j]['total_children'] = trim($row['W']);
									    $error[$j]['state'] = trim($row['X']);
									    $error[$j]['districtId'] = trim($row['Y']);
									    $error[$j]['addressState'] =trim($row['L']);
									    $error[$j]['addressDistrict'] = trim($row['M']);
									 
									    $error[$j]['secondaryIdentity'] = trim($row['Z']);
									    $error[$j]['secondaryIdentity_other'] = trim($row['AA']);
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['shareInfoAboutSexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['sexualBehaviour'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);
									    $error[$j]['fingerDate'] = trim($row['AN']);
									    $error[$j]['saictcStatus'] = trim($row['AO']);
									    $error[$j]['saictcDate'] = trim($row['AP']);
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
									    $error[$j]['hivDate'] = trim($row['AS']);
									    $error[$j]['hivStatus'] = trim($row['AT']);
									    $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    $error[$j]['reportStatus'] = trim($row['AV']);
									    $error[$j]['remark']= trim($row['AW']);
								$j++;
							 }

							}else{
								$error[$j]['error'] = 'Native State or Native District not Match';
								 $error[$j]['createdDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));
							     	    $error[$j]['userUniqueId'] = trim($row['B']);
							     	    $error[$j]['createdBy'] = trim($row['C']);
							     	    $error[$j]['registerFromDevice'] = trim($row['D']);
										$error[$j]['userName'] = trim($row['J']);
									    $error[$j]['password'] = md5('123456');
									    $error[$j]['name'] = trim($row['E']);
									    $error[$j]['nameAlias'] = trim($row['F']);
									    $error[$j]['dob'] = trim($row['G']);
									    $error[$j]['age'] = trim($row['H']);
									    $error[$j]['gender'] = trim($row['I']);
									    $error[$j]['mobileNo'] = trim($row['J']);
									    $error[$j]['address'] =  trim($row['K']);
									    $error[$j]['educationalLevel'] = trim($row['N']);
									    $error[$j]['occupation'] = trim($row['O']);
									    $error[$j]['occupation_other'] = trim($row['P']);
									    $error[$j]['domainOfWork'] = trim($row['Q']);
									    $error[$j]['monthlyIncome'] = trim($row['R']);
									    $error[$j]['maritalStatus'] = trim($row['S']);
									    $error[$j]['maritalStatus_other'] = trim($row['T']);
									    $error[$j]['male_children'] = trim($row['U']);
									    $error[$j]['female_children'] = trim($row['V']);
									    $error[$j]['total_children'] = trim($row['W']);
									    $error[$j]['state'] = trim($row['X']);
									    $error[$j]['districtId'] = trim($row['Y']);
									    $error[$j]['addressState'] =trim($row['L']);
									    $error[$j]['addressDistrict'] = trim($row['M']);
									 
									    $error[$j]['secondaryIdentity'] = trim($row['Z']);
									    $error[$j]['secondaryIdentity_other'] = trim($row['AA']);
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['shareInfoAboutSexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['sexualBehaviour'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);
									    $error[$j]['fingerDate'] = trim($row['AN']);
									    $error[$j]['saictcStatus'] = trim($row['AO']);
									    $error[$j]['saictcDate'] = trim($row['AP']);
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
									    $error[$j]['hivDate'] = trim($row['AS']);
									    $error[$j]['hivStatus'] = trim($row['AT']);
									    $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    $error[$j]['reportStatus'] = trim($row['AV']);
									    $error[$j]['remark']= trim($row['AW']);
								$j++;
							}
							}else{
								$error[$j]['error'] = 'State or District of address not Match ';
								 $error[$j]['createdDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));
							     	    $error[$j]['userUniqueId'] = trim($row['B']);
							     	    $error[$j]['createdBy'] = trim($row['C']);
							     	    $error[$j]['registerFromDevice'] = trim($row['D']);
										$error[$j]['userName'] = trim($row['J']);
									    $error[$j]['password'] = md5('123456');
									    $error[$j]['name'] = trim($row['E']);
									    $error[$j]['nameAlias'] = trim($row['F']);
									    $error[$j]['dob'] = trim($row['G']);
									    $error[$j]['age'] = trim($row['H']);
									    $error[$j]['gender'] = trim($row['I']);
									    $error[$j]['mobileNo'] = trim($row['J']);
									    $error[$j]['address'] =  trim($row['K']);
									    $error[$j]['educationalLevel'] = trim($row['N']);
									    $error[$j]['occupation'] = trim($row['O']);
									    $error[$j]['occupation_other'] = trim($row['P']);
									    $error[$j]['domainOfWork'] = trim($row['Q']);
									    $error[$j]['monthlyIncome'] = trim($row['R']);
									    $error[$j]['maritalStatus'] = trim($row['S']);
									    $error[$j]['maritalStatus_other'] = trim($row['T']);
									    $error[$j]['male_children'] = trim($row['U']);
									    $error[$j]['female_children'] = trim($row['V']);
									    $error[$j]['total_children'] = trim($row['W']);
									    $error[$j]['state'] = trim($row['X']);
									    $error[$j]['districtId'] = trim($row['Y']);
									    $error[$j]['addressState'] =trim($row['L']);
									    $error[$j]['addressDistrict'] = trim($row['M']);
									 
									    $error[$j]['secondaryIdentity'] = trim($row['Z']);
									    $error[$j]['secondaryIdentity_other'] = trim($row['AA']);
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['shareInfoAboutSexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['sexualBehaviour'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);
									    $error[$j]['fingerDate'] = trim($row['AN']);
									    $error[$j]['saictcStatus'] = trim($row['AO']);
									    $error[$j]['saictcDate'] = trim($row['AP']);
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
									    $error[$j]['hivDate'] = trim($row['AS']);
									    $error[$j]['hivStatus'] = trim($row['AT']);
									    $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    $error[$j]['reportStatus'] = trim($row['AV']);
									    $error[$j]['remark']= trim($row['AW']);
								
								$j++;
							}
						}else{
							$error[$j]['error'] = 'Mobile Number should have 10 digits';
						 $error[$j]['createdDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));
							     	    $error[$j]['userUniqueId'] = trim($row['B']);
							     	    $error[$j]['createdBy'] = trim($row['C']);
							     	    $error[$j]['registerFromDevice'] = trim($row['D']);
										$error[$j]['userName'] = trim($row['J']);
									    $error[$j]['password'] = md5('123456');
									    $error[$j]['name'] = trim($row['E']);
									    $error[$j]['nameAlias'] = trim($row['G']);
									    $error[$j]['dob'] = trim($row['F']);
									    $error[$j]['age'] = trim($row['H']);
									    $error[$j]['gender'] = trim($row['I']);
									    $error[$j]['mobileNo'] = trim($row['J']);
									    $error[$j]['address'] =  trim($row['K']);
									    $error[$j]['educationalLevel'] = trim($row['N']);
									    $error[$j]['occupation'] = trim($row['O']);
									    $error[$j]['occupation_other'] = trim($row['P']);
									    $error[$j]['domainOfWork'] = trim($row['Q']);
									    $error[$j]['monthlyIncome'] = trim($row['R']);
									    $error[$j]['maritalStatus'] = trim($row['S']);
									    $error[$j]['maritalStatus_other'] = trim($row['T']);
									    $error[$j]['male_children'] = trim($row['U']);
									    $error[$j]['female_children'] = trim($row['V']);
									    $error[$j]['total_children'] = trim($row['W']);
									    $error[$j]['state'] = trim($row['X']);
									    $error[$j]['districtId'] = trim($row['Y']);
									    $error[$j]['addressState'] =trim($row['L']);
									    $error[$j]['addressDistrict'] = trim($row['M']);
									 
									    $error[$j]['secondaryIdentity'] = trim($row['Z']);
									    $error[$j]['secondaryIdentity_other'] = trim($row['AA']);
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['shareInfoAboutSexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['sexualBehaviour'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);
									    $error[$j]['fingerDate'] = trim($row['AN']);
									    $error[$j]['saictcStatus'] = trim($row['AO']);
									    $error[$j]['saictcDate'] = trim($row['AP']);
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
									    $error[$j]['hivDate'] = trim($row['AS']);
									    $error[$j]['hivStatus'] = trim($row['AT']);
									    $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    $error[$j]['reportStatus'] = trim($row['AV']);
									    $error[$j]['remark']= trim($row['AW']);
							
						$j++;
						}
					}else{
						$error[$j]['error'] = 'Field is mandatory';
					 $error[$j]['createdDate'] = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP(trim($row['A'])));
							     	    $error[$j]['userUniqueId'] = trim($row['B']);
							     	    $error[$j]['createdBy'] = trim($row['C']);
							     	    $error[$j]['registerFromDevice'] = trim($row['D']);
										$error[$j]['userName'] = trim($row['J']);
									    $error[$j]['password'] = md5('123456');
									    $error[$j]['name'] = trim($row['E']);
									    $error[$j]['nameAlias'] = trim($row['F']);
									    $error[$j]['dob'] = trim($row['G']);
									    $error[$j]['age'] = trim($row['H']);
									    $error[$j]['gender'] = trim($row['I']);
									    $error[$j]['mobileNo'] = trim($row['J']);
									    $error[$j]['address'] =  trim($row['K']);
									    $error[$j]['educationalLevel'] = trim($row['N']);
									    $error[$j]['occupation'] = trim($row['O']);
									    $error[$j]['occupation_other'] = trim($row['P']);
									    $error[$j]['domainOfWork'] = trim($row['Q']);
									    $error[$j]['monthlyIncome'] = trim($row['R']);
									    $error[$j]['maritalStatus'] = trim($row['S']);
									    $error[$j]['maritalStatus_other'] = trim($row['T']);
									    $error[$j]['male_children'] = trim($row['U']);
									    $error[$j]['female_children'] = trim($row['V']);
									    $error[$j]['total_children'] = trim($row['W']);
									    $error[$j]['state'] = trim($row['X']);
									    $error[$j]['districtId'] = trim($row['Y']);
									    $error[$j]['addressState'] =trim($row['L']);
									    $error[$j]['addressDistrict'] = trim($row['M']);
									 
									    $error[$j]['secondaryIdentity'] = trim($row['Z']);
									    $error[$j]['secondaryIdentity_other'] = trim($row['AA']);
									    $error[$j]['referralPoint'] = trim($row['AB']);
									    $error[$j]['referralPoint_others'] = trim($row['AC']);
									    $error[$j]['shareInfoAboutSexualBehaviour'] = trim($row['AD']);
									    $error[$j]['multipleSexPartner'] = trim($row['AE']);
									    $error[$j]['sought'] = trim($row['AF']);
									    $error[$j]['sexualBehaviour'] = trim($row['AG']);
									    $error[$j]['prefferedSexualAct'] = trim($row['AH']);
									    $error[$j]['condomUsage'] = trim($row['AI']);
									    $error[$j]['substanceUse'] = trim($row['AJ']);
									    $error[$j]['hivTestResult'] = trim($row['AK']);
									    $error[$j]['hivTestTime'] = trim($row['AL']);
									    $error[$j]['pastHivReport'] = trim($row['AM']);
									    $error[$j]['fingerDate'] = trim($row['AN']);
									    $error[$j]['saictcStatus'] = trim($row['AO']);
									    $error[$j]['saictcDate'] = trim($row['AP']);
									    $error[$j]['saictcPlace'] = trim($row['AQ']);
									    $error[$j]['ictcNumber'] = trim($row['AR']);
									    $error[$j]['hivDate'] = trim($row['AS']);
									    $error[$j]['hivStatus'] = trim($row['AT']);
									    $error[$j]['reportIssuedDate'] = trim($row['AU']);
									    $error[$j]['reportStatus'] = trim($row['AV']);
									    $error[$j]['remark']= trim($row['AW']);
						
						$j++;
					}
					$totalCount++;
				}

	
				if($error){
					$data['er']=$error;
					$data['total_error'] =($total-1).' rows are inserted out of '.($totalCount-1);
					$data['content'] = 'user';
					
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
                   	   $questionInsert['quizId'] =  $quizId;
                       $questionInsert['quizQuestionName'] = trim($rowData[0][0]);
                       $questionInsert['numberOfAnswer'] = trim($rowData[0][1]);
                       $questionInsert['typeOfAnswer'] = trim($rowData[0][2]);
                       $questionInsert['NumberOfCorrectOptions'] = trim($rowData[0][18]);
                       $questionInsert['MarksForEachCorrectAnswe'] = trim($rowData[0][19]);
                       $questionInsert['correctOptions'] = trim($rowData[0][20]);
                       $questionInsert['AdditionalInfoInCaseOfWrongAnswer'] = trim($rowData[0][21]);
                       $questionInsert['AdditionalInfoInCaseOfCorrectAnswer'] = trim($rowData[0][22]);
                       $questionInsert['createdBy'] = $this->session->userdata('userId');
                          
                       //print_r($questionInsert);   
                       //echo "<br />";
                      $quizQuestionId = $this->common_model->insertValue('`tbl_quiz_questions`',$questionInsert);
               
                      $colNumber = PHPExcel_Cell::columnIndexFromString('R');

                     for($j=3;$j<=$colNumber-1;$j++)
                     { 
                     	$optionValue = $objWorksheet->getCellByColumnAndRow($j,$i)->getValue();


                     	if(!empty($optionValue))
                     	{                  
                   	       $optionInsert['quizQuestionId'] = $quizQuestionId;	
                          $optionValue1 = $optionValue;
                          $optionInsert['quizQuestionOptionName'] = $optionValue1;
                          //echo $rowData[0][20];
                          if(!empty($rowData[0][20]))
                          {
                          	$searchString = ',';
                          	if(strpos($rowData[0][20], $searchString) !== false )
                             {
                               $options = explode(',',$rowData[0][20]);
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
                             	if($optionValue == $rowData[0][20])
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
     	$data['contactRequest'] = $this->rolemaster->getContactRequest();

        $data['content'] = 'contactRequest';

       $this->load->view('Layout/dashboardLayoutDash',$data);        

     }

     public function commentsWp()
     {
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
     	 $data['logsList'] = $this->rolemaster->logs();

     	 $data['loggedInLogs'] = $this->rolemaster->loggedInLogs();

     	 $data['content'] = 'logs';

     	 $this->load->view('Layout/dashboardLayoutDash',$data);
     }

      public function ongroundPartnerById($ongroundPartnerId)
     {
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
     	 $data['staffMember'] = $this->rolemaster->staff();

     	  $data['roles'] = $this->rolemaster->roles();

     	  $data['empUser'] = $this->rolemaster->empUser(3);

     	 $data['content'] = 'staff';

     	  $this->load->view('Layout/dashboardLayoutDash',$data);
     }

     public function filterStaff()
     {

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
     	$data['staffId'] = $staffId;

        $data['staffData'] = $this->rolemaster->staffById($staffId);

          $data['roles'] = $this->rolemaster->roles();

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
	  	 $data['smsList'] = $this->rolemaster->userSms();

	  	 $data['content'] = 'userSms';

	  	  $this->load->view('Layout/dashboardLayoutDash',$data);
	  }

        public function filterUserSms()
	  {
	  	$data['daterange'] = $this->input->post('daterange');

	  	 $data['smsList'] = $this->rolemaster->filterUserSms($data);

	  	 $data['content'] = 'userSms';

	  	  $this->load->view('Layout/dashboardLayoutDash',$data);
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

     public function downloadUserData()
     {
     	  $this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$result = $this->rolemaster->downloadUserData();

		$filename = 'userData.xls';

		$header = array('Unique Id','User Name','Name','Name Alias','Date Of Birth','Age','Mobile No','Address','State','District','Education','Occupation','Occupation Other','Monthly Income','Marital Status','Marital Status Other','Male Children','Female Children','Total Children','Native State','Native District','Secondary Identifty','Secondary Identifty Other','Like to share information about sexual behaviour','Have multiple sex partner','Ever sought paid sex','Preferred sexual act','Status of condom usage','Substance Use','Have you ever been tested for HIV before','If yes when(please mention how many months/year before)','Past HIV test result','Remarks','Created Date');

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

      public function downloadServiceProviderData()
     {

          $this->load->library('excel');

		 $this->excel->setActiveSheetIndex(0);

		$result = $this->rolemaster->downloadServiceProviderData();

		$filename = 'serviceProviderData.xls';

		$header = array('Unique Id','Name','Address','Mobile No','Landline','Email','Other Contact','Location','District','State','Queer Friendly Rating','Qualification','Affiliation','Linkage','Days','Time','Face To Face Consultation','Home Visits','Consultation On Telephone','Consultation Through Email','Consultation Through Skype/Video Conference/Other Chat','Consultation Charges','Consession','Latitude','Longitude','Services','Created Date');

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
					//echo "<pre>";
				   $aa = array_keys(array_keys($row));
					$cc = array_combine($aa,$row);

					//print_r($cc);

					//print_r($row);

					$checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['L']),trim($row['K']));
					
					$insert['uniqueId'] =trim($row['A']);
					$insert['name'] = trim($row['B']);
					$insert['gender'] = trim($row['C']);
					$insert['address'] = trim($row['E']);
					$insert['officePhone'] = trim($row['G']);
					$insert['mobile'] = trim($row['F']);
					$insert['email'] = trim($row['H']);
					$insert['latitude'] = 	trim($row['Z']);
                    $insert['longitude'] = trim($row['AA']);
                    $insert['rating'] = trim($row['N']);
                    $insert['otherMobile'] = trim($row['I']);
                    $insert['location'] = trim($row['J']);
                    $insert['state'] = $checkStateDistrict[0]['stateId'];
                    $insert['districtId'] = $checkStateDistrict[0]['districtId'];
                    $insert['qualification'] = trim($row['D']);
                    $insert['affiliation'] = trim($row['O']);
                    $insert['linkage'] = trim($row['P']);
                    $insert['day'] = trim($row['Q']);
                    $insert['time'] = trim($row['R']);
                    $insert['conFace'] = trim($row['S']); 
                    $insert['conHome'] = trim($row['T']);
                    $insert['conTel'] = trim($row['U']);
                    $insert['conEmail'] = trim($row['V']);
                    $insert['conOnline'] = trim($row['W']);
                    $insert['conCharges'] = trim($row['X']);
                    $insert['concession'] = trim($row['Y']);

                    

                    //print_r($insert);

                    $id = $this->common_model->insertValue('tbl_service_provider_details', $insert);

                    if(trim($row['AB']) == 'Yes')
                    {
                    	//echo 'sexualhealth';

                    	$serviceFocus['serviceTypeId'] = 1;
                    	$serviceFocus['serviceProviderId'] = $id;

                    	$this->common_model->insertValue('tbl_service_type_mapping',$serviceFocus);
                    }

                    if(trim($row['AC']) == "Yes")
                    {
                    	//echo 'mentalHealth';
                        $serviceFocus['serviceTypeId'] = 2;
                    	$serviceFocus['serviceProviderId'] = $id;

                    	$this->common_model->insertValue('tbl_service_type_mapping',$serviceFocus);
                    }

                    if(trim($row['AD']) == 'Yes')
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
                        for($l=30;$l<=66;$l++)
                         {	
                         	//echo $cc[$l].'--'.$serviceTypeParameterId[$h]['serviceTypeParameterId'];

                         	//echo "<br>";
                           $this->common_model->insertValue('tbl_service_provider_fields', array('serviceProviderId'=>$id,'value' => $cc[$l],'serviceTypeParameterId'=>$serviceTypeParameterId[$h]['serviceTypeParameterId']));
                              $h++;
                           }
                       }while($h<=36);
	

				}		

		  }

		}

		redirect(base_url().'home/serviceProvider');

	}	

	public function ticker()
	{
		
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
     	$data['otp'] = $this->rolemaster->otpUsed();

     	$data['content'] = 'otp';
     	
     	$this->load->view('Layout/dashboardLayoutDash',$data);  
     }

     public function gallery()
     {
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
					if(trim($row['A']) != '' && trim($row['B']) != '' && trim($row['C'] != '')){
                        
					  $status = $this->rolemaster->checkUserWithMobile(trim($row['B']),trim($row['C']))	;

					
					  if($status)
					  {	
						$insert['to']	 = 'verified';
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
						$error[$j]['userName'] = trim($row['B']);
						$error[$j]['mobile'] = trim($row['C']);
						$j++;
					  }	
					}else{
						$error[$j]['error'] = 'Field is mandatory';
					    $error[$j]['clientId'] = trim($row['A']);
						$error[$j]['userName'] = trim($row['B']);
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
    		   $result1[] =$this->rolemaster->userById($value);
    		}
    	}else{
    	      
    		 $result1 =$this->rolemaster->userById($users[0]);
    	}	
      
        print_r($result1);

        $main =array_merge($result,$result1);

        print_r($main);

    	echo json_encode($main);
    }

   
	
}