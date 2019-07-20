<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

define("GOOGLE_API_KEY", "AIzaSyAxPmMr__6hq0_g-IPlEpccHOwyeKQWta4");

class Homeweb extends CI_Controller {
    function __construct() {
		parent::__construct();
        $this->load->model('webService/apiModel', 'Api', TRUE);      
		$this->load->model('role/rolemasterweb','roleMasterWeb',TRUE); 			
		$this->load->library('pagination');
		$this->load->library('user_agent');
    } 
  
    public function index(){ 
		$data['content'] = 'web/index';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function quiz()
	{ 

		$data['quizList']=$this->Api->quizList();
		$data['pageId'] = 987;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(987);
		//print_r($data['quizList']);
		$data['content'] = 'web/quiz';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function playedQuiz(){ 
		$data['userId']=$this->session->userdata('userId');
		$data['playedQuizList']=$this->Api->playedQuizList($data);

		$data['pageId'] = 23;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(23);

		$data['content'] = 'web/playedQuiz';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function quizQuestions(){ 
		$data['quizId'] = $this->uri->segment(3);
		$data['quizName']     = $this->roleMasterWeb->quizName($data['quizId']);
		//print_r($data['quizName']); exit;
		$data['quizQuestionsList']=$this->Api->newQuizQuestions($data);
		//echo '<pre>';print_r($data['quizQuestionsList']);exit;
		$data['pageId'] = 994;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(994);
		$data['content'] = 'web/quizQuestions';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function submitQuiz()
	{ 
           $data['quizId']=$this->input->post('quizId');
              $data['quizName'] = $this->roleMasterWeb->quizName($data['quizId']);
		$data['quizStartTime']=$this->input->post('quizStartTime');
		$data['quizEndTime']=$this->input->post('quizEndTime');
		 $optionsArray = $this->input->post('options');
		if(!empty($optionsArray)) 
		{	
		 foreach ($optionsArray as $value) 
		 {
		 	foreach ($value as $value1) 
		 	{
		 		$options[] = $value1;
		 	}
		 }
		  $ops = implode(',',$options);
		  
		  $data['quizQuestionId']=implode(',',array_keys($this->input->post('options')));

		$data['quizQuestionOptionId']= implode(",", $options); 
		}
		else
		{
			$data['quizQuestionId'] = NULL;
			$data['quizQuestionOptionId'] = NULL;
		} 

		$data['userId']=$this->session->userdata('userId');
		$data['quizResult'] = $this->Api->submitQuiz($data);

		$data['pageId'] = 994;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(994);

		//$data['resultantMarks'] = $this->roleMasterWeb->resultantMarks($this->input->post('options'));
		//$data['totalMarks'] = $this->roleMasterWeb->getQuizTotalMarks($data['quizId']);	
		$data['content'] = 'web/quizResult';
		$this->load->view('Layout/dashboardLayoutWeb',$data); 
		//redirect('homeweb/quiz');
		//echo '<pre>';print_r($res);exit;

	}

	/**
	 * show message of quiz
	 */

	public function showMessage()
	{
		$data['optionId'] =$this->input->post('optionId');
		$main = $this->roleMasterWeb->showMessage($data['optionId']);
		$res = json_encode($main);
		echo $res; 
	}

	public function getGiftCoupon()
	{
		if($this->input->post())
		{
            $data['stateId'] = $this->input->post('state');
            $data['districtId'] = $this->input->post('districtId');
            $data['state'] = $this->roleMasterWeb->stateName($data['stateId']);
            $data['district'] = $this->roleMasterWeb->districtName($data['districtId']);
           $data['ongroundPartners'] = $this->roleMasterWeb->getOnGroundPartner($data);
           if(empty($data['ongroundPartners']))
           {
           	  $data['response'] = 'Sorry,There are no Onground partners in '.$data['state'][0]['stateName'];
               if(!empty($data['district']))
               {
               	 $data['response'] .= 'in '.$data['district'][0]['districtName'];
               }

               $data['response'] .= " .Please select some other State/District.";

           }

              
           
		}	

		$quizNumber = $this->uri->segment(3);

		$data['quizNumber'] = $quizNumber;

		$data['state']=$this->roleMasterWeb->state();

		$data['accessVoucherDetail'] = $this->roleMasterWeb->getVoucherNumber($quizNumber);

		//$this->session->set_userdata('giftCouponNo',$data['accessVoucherDetail'][0]['voucherNumber']);

		$data['pageId'] = 989;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(989);
   
         $data['content'] = 'web/giftCoupon';

         $this->load->view('Layout/dashboardLayoutWeb',$data);
		
	}



	public function createUser()
	{
      		//$data['search']= $this->input->post();
		//$data['serviceProviderType']=$this->Api->serviceProviderType();
		$data['pageId'] = 2;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(2);

		$data['state']=$this->roleMasterWeb->state();
		$data['content'] = 'web/createUser';

        $this->load->view('Layout/dashboardLayoutWeb',$data);       

	}

	public function addUser()
	{
	  $userId = 	$this->roleMasterWeb->addUser();

	  $otp = mt_rand(10000,99999);

	  $post['mobileNo'] = $this->input->post('mobileNo');

	  $post['smsContent'] = 'The OTP for registration on Sahay website is '.$otp;

	  $this->db->where('userId',$userId);

	  $this->db->update('tbl_user',['otp'=>$otp]);

	  //$this->Api->sendSms($post);

	   $data['userName'] = $this->input->post('userName');
		 $data['name'] = $this->input->post('name');
		 $data['emailAddress'] = $this->input->post('emailAddress');
		 $data['password'] = $this->input->post('password');
		 $data['mobileNo'] = $this->input->post('mobileNo');

     	redirect(base_url()."homeweb/otp/".$userId);            
		 


	}

/*	public function addUser()
	{
			//print_r($this->input->post());exit;
/*			 $post['mode'] = 0;
	    $post['id'] = 1;
	    $post['name'] = $this->input->post('name');
	    $post['nameAlias'] = $this->input->post('nameAlias');
	    $post['dob'] = date('d-m-Y',strtotime($this->input->post('dob')));
	    $post['gender'] = $this->input->post('gender');
	    $post['educationalLevel'] = $this->input->post('educationalLevel');
	    $post['occupation'] = $this->input->post('occupation');
	    $post['domainOfWork'] = $this->input->post('domainOfWork');
	    $post['monthlyIncome'] = $this->input->post('monthlyIncome');
	    $post['address'] = $this->input->post('address');
	    $post['state'] = $this->input->post('state');
	    $post['districtId'] = $this->input->post('districtId');
	    $post['mobileNo'] = $this->input->post('mobileNo');
	    $post['primaryIdentity'] = $this->input->post('primaryIdentity');
	    $post['secondaryIdentity'] = $this->input->post('secondaryIdentity');
	    $post['hivTest'] = $this->input->post('hivTest');
	    $post['userName'] = $this->input->post('userName');
	    $post['password'] = $this->input->post('password');
	    $post['emailAddress'] = $this->input->post('emailAddress');
	    $post['referralPoint'] = $this->input->post('referralPoint');
	    $post['placeOforigin'] = $this->input->post('placeOforigin');
	    $post['maritalStatus'] = $this->input->post('maritalStatus');
	    $post['userId'] = $this->session->userdata('userId');;
	    $post['age'] = $this->input->post('age');
	    $post['occupation1'] = $this->input->post('occupation1');
	    $post['maritalStatus1'] =$this->input->post('maritalStatus1');
	    $post['malechildren'] = $this->input->post('malechildren');
	    $post['femalechildren'] = $this->input->post('femalechildren');
	    $post['primaryIdentity1'] = $this->input->post('primaryIdentity1');
	    $post['secondaryIdentity1'] = $this->input->post('secondaryIdentity1');
	    $post['referralPoint1'] = $this->input->post('referralPoint1');
	    $post['hivTestTime'] = $this->input->post('hivTestTime');
	    $post['hivTestResult'] = $this->input->post('hivTestResult');
	    $post['fingerDate'] = date('d-m-Y',strtotime($this->input->post('fingerDate')));
	    $post['fingerReport'] = $this->input->post('fingerReport');
	    $post['saictcStatus'] = $this->input->post('saictcStatus');
	    $post['saictcDate'] = date('d-m-Y',strtotime($this->input->post('saictcDate')));
	    $post['saictcPlace'] = $this->input->post('saictcPlace');
	    $post['ictcNumber'] = $this->input->post('ictcNumber');
	    $post['hivDate'] = date('d-m-Y',strtotime($this->input->post('hivDate')));
	    $post['hivStatus'] = $this->input->post('hivStatus');
	    $post['reportIssuedDate'] = date('d-m-Y',strtotime($this->input->post('reportIssuedDate')));
	    $post['reportStatus'] = $this->input->post('reportStatus');
	    $post['artCenter'] = $this->input->post('artCenter');
	    $post['artNumber'] = $this->input->post('artNumber');
	    $post['cd4Status'] = $this->input->post('cd4Status');
	    $post['cd4Result'] = $this->input->post('cd4Result');
	    $post['artStatus'] = $this->input->post('artStatus');
	    $post['syphilisTest'] = $this->input->post('syphilisTest');
	    $post['syphilisResult'] = $this->input->post('syphilisResult');
	    $post['tbTest'] = $this->input->post('tbTest');
	    $post['tbResult'] = $this->input->post('tbResult');
	    $post['rntcpRefer'] = $this->input->post('rntcpRefer');
	    $post['remark'] = $this->input->post('remark');
	    $post['totalchildren'] = $this->input->post('totalchildren');
	    //print_r($post);exit;
		//$data['serviceProviderList']=$this->roleMasterWeb->searchServiceProvider($post);
		 
	    if ($this->input->post()) {
		$post['mode'] = 0;                                              
	    $post['id'] = 1;
	    $post['userId'] = $this->session->userdata('userId');
	    $post['userName'] = $this->input->post('userName');
	    $post['password'] = md5($this->input->post('password'));
	    $post['name'] = $this->input->post('name');
	    $post['nameAlias'] = $this->input->post('nameAlias');
	    $post['gender'] = $this->input->post('gender');
	    $post['dob'] = date('d-m-Y',strtotime($this->input->post('dob')));
	    $post['age'] = $this->input->post('age');
	    $post['address'] = $this->input->post('address');
	    $post['addressState'] = $this->input->post('addressState');
	    $post['addressDistrict'] = $this->input->post('addressDistrict');
	    $post['mobileNo'] = $this->input->post('mobileNo');
	    
	    $post['educationalLevel'] = $this->input->post('educationalLevel');
	    $post['occupation'] = $this->input->post('occupation');
	    $post['occupation_other'] = $this->input->post('occupation_other');
        $post['monthlyIncome'] = $this->input->post('monthlyIncome');
        $post['remark'] = $this->input->post('remark');
        $post['maritalStatus'] = $this->input->post('maritalStatus');
	    $post['maritalStatus_other'] =$this->input->post('maritalStatus_other');
	     $post['male_children'] = $this->input->post('male_children');
	    $post['female_children'] = $this->input->post('female_children');
	    $post['total_children'] = $this->input->post('total_children');
	    $post['state'] = $this->input->post('state');
	    $post['districtId'] = $this->input->post('districtId');
	    $post['secondaryIdentity'] = $this->input->post('secondaryIdentity');
	    $post['secondaryIdentity_other'] = $this->input->post('secondaryIdentity_other');
	    $post['sexualBehaviour']=$this->input->post('sexualBehaviour');
        $post['sought'] = $this->input->post('sought');
	    $post['condomUsage'] = $this->input->post('condomUsage');
	    $post['substanceUse'] = $this->input->post('substanceUse');
	    $post['multipleSexPartner'] = $this->input->post('multipleSexPartner');
	    $post['prefferedSexualAct'] = $this->input->post('prefferedSexualAct');
	    $post['pastHivReport'] = $this->input->post('pastHivReport');
	    $post['testHiv'] = $this->input->post('testHiv');
	    $post['hivConfirmation'] = $this->input->post('hivConfirmation');
	    $post['prefferedGender'] = $this->input->post('prefferedGender');
 
		$res =  $this->roleMasterWeb->createUser($post);
			//print_r($data['serviceProviderList']); exit;
			echo $a ='&nbsp;';//echo '/n';
		}	
		 $data['userName'] = $this->input->post('userName');
		 $data['name'] = $this->input->post('name');
		 $data['emailAddress'] = $this->input->post('emailAddress');
		 $data['password'] = $this->input->post('password');
		 $data['mobileNo'] = $this->input->post('mobileNo');

        //echo $this->input->post('password');exit;
		//$data['state']=$this->roleMasterWeb->state();
		$data['content'] = 'web/successUser';
        $this->load->view('Layout/dashboardLayoutWeb',$data);  *

		$userId = $res[0]['userId'];
		$otp = $res[0]['otp'];
		$this->roleMasterWeb->insertOtp($userId,$otp);

		$this->Api->sendSms(['mobileNo'=>$this->input->post('mobileNo'),'smsContent'=>"The OTP for registration on Sahay website is $otp"]);
		redirect(base_url()."homeweb/otp/".$userId);            

	

	}*/

     public function gamesPanel()
	{
		$data['content'] = 'web/gamesPanel';
		$this->load->view('Layout/dashboardLayoutWeb',$data);
	}

	public function allServiceProvider()
	{
		$data['serviceProviders'] = $this->roleMasterWeb->allServiceProvider();

		$data['content'] = 'web/allServiceProvider';

		$this->load->view('Layout/dashboardLayoutWeb',$data);
	}
	
	public function searchServiceProvider(){
      

		if ($this->input->post()){
			//print_r($this->input->post());exit;
			$post['stateId']=$this->input->post('stateId');
			$post['districtId']=$this->input->post('districtId');
			$post['serviceTypeId']=$this->input->post('serviceTypeId');
			$post['serviceTypeParameterId']=$this->input->post('serviceTypeParameterId');
			$post['latLong']=$this->input->post('latLong');

			$data['serviceProviderList']=$this->roleMasterWeb->searchServiceProvider($post);
			//print_r($data['serviceProviderList']); exit;
			echo $a ='&nbsp;';//echo '/n';
		}
		$data['search']= $this->input->post();
		$data['pageId'] = 1;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(1);

     	$data['serviceProviderType']=$this->Api->serviceProviderType();
		$data['state']=$this->roleMasterWeb->state();
		$data['content'] = 'web/searchServiceProvider';

        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }

	public function getDistrict() {
		$data['stateId'] =$this->input->post('stateId');
		$main = $this->roleMasterWeb->getDistrict($data['stateId']);
		$res = json_encode($main);
		echo $res; 
	}
	public function serivceTypeParameters()
	{ 
		$data['serviceTypeId'] =$this->input->post('typeId');
		//$data['serviceTypeId'] = 3;
		// print_r($data['serviceTypeId']);exit();
		$main = $this->Api->serivceTypeParameters($data);
		$res = json_encode($main);
		echo $res;
	}
	
	public function feedback(){
		$data['serviceProviderId'] = $this->uri->segment(3);
		if ($this->input->post('serviceProviderId')){
			$post['userId']=$this->session->userdata('userId');
			$post['serviceProviderId']=$this->input->post('serviceProviderId');
			$post['feedback']=$this->input->post('feedback');
			//echo '<pre>';print_r($post);exit;
			$res=$this->Api->feedback($post);
			//echo '<pre>';print_r($res);exit;
			redirect(base_url().'homeweb/searchServiceProvider');
		}
		$data['serviceProviderFeedbackDetail']=$this->roleMasterWeb->serviceProviderFeedbackDetail($data['serviceProviderId']);
		$data['content'] = 'web/feedback';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function serviceAccessVoucher()
	{
		$serviceProviderId = $this->uri->segment(3);
		$data['userId']=$this->session->userdata('userId');
		$data['serviceProviderId']=$serviceProviderId;
		$data['voucherCode'] = 'VC'.mt_rand(10000,99999);
		if($data['serviceProviderId']){
			$data['accessVoucherDetail']=$this->Api->serviceAccessVoucher($data);

			$data1['mobileNo'] = $this->session->userdata('mobile');
			$data1['smsContent'] = "Hello ".$this->session->userdata('userName')." your voucher number for ".$data['accessVoucherDetail'][0]['name']." is ".$data['accessVoucherDetail'][0]['voucherNumber']." and your voucher details have been sent to Service Provider also";

			$this->Api->sendSms($data1);

			$data2['mobileNo'] = $data['accessVoucherDetail'][0]['mobile'];

			$data2['smsContent'] = "The voucher no. for ".$this->session->userdata('userName')." is ".$data['accessVoucherDetail'][0]['voucherNumber'].". The user would be contacting you for gifts".

			$this->Api->sendSms($data2);

		    $data3['mobileNo'] = $this->session->userdata('mobile');
			$data3['smsContent'] = "Hello,".$this->session->userdata('userName')." your voucher code generated is ".$data['voucherCode']." share this voucher code once you visits selected service provider ".$data['accessVoucherDetail'][0]['name'];

			$this->Api->sendSms($data3);
			//redirect('MainController/Student_Login/'.$data['accessVoucherDetail']);
		}


		//echo '<pre>';print_r($accessVoucherDetail);exit;
		$data['pageId'] = 81;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(81);
		$data['content'] = 'web/serviceAccessVoucher';
        $this->load->view('Layout/dashboardLayoutWeb',$data);
		//redirect('homeweb/searchServiceProvider');
	}
	
	public function eventSearch(){
		if ($this->input->post()){
			$post['name']=$this->input->post('name');
			$post['date']=$this->input->post('date');
			$data['eventList']=$this->Api->eventSearch($post);
			//echo '<pre>';print_r($data['eventList']);exit;
		}
		$data['content'] = 'web/eventSearch';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function ongroundPartners(){ 
		$data['ongroundPartnerId']=$this->uri->segment(3);

		 $ongroundPartnerId = $this->uri->segment(3);

		$data['ongroundPartnersList']=$this->Api->ongroundPartnersList($ongroundPartnerId);
		//echo '<pre>';print_r($data['ongroundPartnersList']);exit;

		$data['content'] = 'web/ongroundPartner';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	
	public function event()
	{
		$data['type'] = $this->uri->segment(3);
		$config = array();
		$config["base_url"] = base_url() . "index.php/homeweb/event/".$data['type']."";
		$total_row = $this->roleMasterWeb->eventListCount($data['type']);
		$config["total_rows"] = $total_row[0]['total']; //exit;
		$config["per_page"] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['cur_page'] = $this->uri->segment(3);
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';  
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['cur_tag_open'] = '<li> <a class="pagiCurrent" >';
		$config['cur_tag_close'] = '</a></li>';
		
		$this->pagination->initialize($config);
		
		$page = $this->uri->segment(4) ;
		
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );
		$data['type'] = $this->uri->segment(3);
		$data['eventList']=$this->roleMasterWeb->eventList($data['type'],$config["per_page"], $page);

	if($data['type'] == 'past')	
	{	
		$data['pageId'] = 17;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(17);
	}else{
		$data['pageId'] = 16;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(16);
	}	
		$data['content'] = 'web/event';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	public function voucherInformation(){
		$data['userId']=$this->session->userdata('userId');
		$data['voucherId']=$this->uri->segment(3);
		//echo '<pre>';print_r($this->session->all_userdata());exit;
		
		$data['vouchersList']=$this->Api->vouchersList($data);
		//echo '<pre>';print_r($vouchersList);exit;
		$data['content'] = 'web/voucherInformation';
        $this->load->view('Layout/dashboardLayoutWeb',$data);
	}
	
	public function voucherDeatil(){
		$data['userId']=$this->input->post('userId');
		$data['voucherId']=$this->uri->segment(3);
		$data['voucheDetail']=$this->Api->vouchersList($data);
		//echo '<pre>';print_r($vouchersList);exit;
		$data['content'] = 'web/voucherDeatil';
        $this->load->view('Layout/dashboardLayoutWeb',$data);
	}
	
	public function ongroundPartner(){
		if($this->uri->segment(3)){
			$data['ongroundPartnerId'] = $this->uri->segment(3);
		}else{
			$data['ongroundPartnerId'] = NULL;
		}
		
		$data['ongroundPartnersList']=$this->Api->ongroundPartnersList($data['ongroundPartnerId']);

        $result = $this->roleMasterWeb->checkVoucher($this->session->userdata('giftCouponNo'));

		if($this->uri->segment(3) && (!empty($result)))
		{
		    $data1['mobileNo'] = $this->session->userdata('mobile');

             $data1['smsContent'] = "You have selected ".$data['ongroundPartnersList'][0]['name'].". Kindly visit and redeem the gift coupon. The gift coupon number is ".$this->session->userdata('giftCouponNo');

                  $this->Api->sendSms($data1);

            $data2['mobileNo']  = $data['ongroundPartnersList'][0]['mobile'];
            
            $data2['smsContent'] = $this->session->userdata('userName')." has selected ".$data['ongroundPartnersList'][0]['name']." to redeem the gift coupon number ".$this->session->userdata('giftCouponNo');

            $this->Api->sendSms($data2);   

            $this->roleMasterWeb->updateVoucher($this->session->userdata($this->session->userdata('giftCouponNo'))); 

            $data['content'] = 'web/ongroundPartner';
            $this->load->view('Layout/dashboardLayoutWeb',$data);       

		}
		else{
			redirect(base_url().'homeweb/voucherInformation');
		}
     }
	
	public function ongroundPartnerLocation(){
		
		if($this->uri->segment(3))
		{
			$data['ongroundPartnerId'] = $this->uri->segment(3);
		}else{
			$data['ongroundPartnerId'] = NULL;
		}

		$data['ongroundPartnersLocation']=$this->Api->ongroundPartnersList($data['ongroundPartnerId']);
		$data['content'] = 'web/ongroundPartnerLocation';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }

     public function checkArea()
    {
    	$currentArea = $this->input->post('currentArea');

    	$main = $this->roleMasterWeb->checkArea($currentArea);

    	$res = json_encode($main);

		echo $res;
    }
	
	
	
	public function login(){

		if ($this->agent->referrer() != base_url().'homeweb/login') {
				$this->session->set_userdata(['last_link'=> $this->agent->referrer()]);	
			}	

		 $data['serviceProviderId'] = $this->uri->segment(3); //exit;
		 $data['quizId'] = $this->uri->segment(4);
		if ($this->input->post()){
			$data['userName'] = $this->input->post('userName');
			$data['password'] = $this->input->post('password');
			$data['quizUniqueNumber'] = $this->input->post('quizUniqueNumber');
			$data['loginTime'] = date('Y-m-d h:i:s');
			//echo '<pre>';print_r($data);exit;
			$result=$this->Api->login($data);
			

            $result1 =  $this->roleMasterWeb->getLoginId($result[0]['userId']);

			if ($result[0]['responseCode']==0) {
				$data['msg'] = '<span class="btn btn-sm btn-white "style="color:red;font-weight:bold;">'.$result[0]['responseMessage'].'</span>';
				
			}
			elseif($result[0]['responseCode']==200){
				$sessionData = array(
				'userId' => $result[0]['userId'],
				'userType' => $result[0]['userType'],
				'userName' => $result[0]['userName'],
				'userUniqueId' => $result[0]['userUniqueId'],
				'mobile' => $result[0]['mobileNo'],				
				'email' => $result[0]['emailAddress'],				
				'age' => $result[0]['age'],				
				'occupation' => $result[0]['occupation'],
				'logId'	=> $result1[0]['id'],
				'logInto'=>'Website',			
				'validated' => true
				);
				$this->session->set_userdata($sessionData);
				$_SESSION['isLogin'] = 'yes';
				$_SESSION['loginmobile'] = $result[0]['mobileNo'];
				$_SESSION['loginemail'] = $result[0]['emailAddress'];
				$_SESSION['user'] =  $result[0]['userName'];				

				$aa=1;
				if($data['serviceProviderId'] != ''){	
					if($data['serviceProviderId'] == 'quiz')
					{
                       redirect(base_url().'homeweb/getGiftCoupon/'.$data['quizId']);
					}	
					else
					{	
					  redirect(base_url().'homeweb/serviceAccessVoucher/'.$data['serviceProviderId']);
				    }
				}elseif (strpos($last_link,'homeweb/otpVerify') !== false) 
				{
					redirect('http://localhost/sahya/');
				}else{
					
					$last_link = $this->session->userdata('last_link');
					$this->session->unset_userdata('last_link');			
					redirect($last_link);
					//redirect(base_url().'homeweb');
				}
				
				//print_r($this->session->all_userdata()); exit;
			}
			
		}

		$data['pageId'] = 20;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(20);
		$data['content'] = 'web/login';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
/*	public function logout() {
		$this->session->sess_destroy();
        redirect(base_url().'homeweb/login');
    }*/
	
	public function serviceProviderLocation(){
		if ($this->input->post()){
			$post['searchText']=$this->input->post('searchText');
			$post['serviceTypeId']=$this->input->post('serviceTypeId');
			$post['serviceTypeParameterId']='';
			$post['latLong']='';
			$data['serviceProviderList']=$this->Api->searchServiceProvider($post);
			
			//echo '<pre>';print_r($data['serviceProviderList']);exit;
		}
		$data['search']= $this->input->post();
		$data['serviceProviderType']=$this->Api->serviceProviderType();
		$data['content'] = 'web/serviceProviderLocation';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }
	
	
	public function addServiceProviderLocation(){
		if($this->input->post()){
			$aa= $this->input->post('latLng');
			 $string = substr($aa, 1, -1);
			$latlng=explode(',',$string);
			//print_r($latlng);
			$post['userId']= $this->session->userdata('userId');
			$post['serviceProviderId'] =$this->input->post('serviceProviderId');
			$post['lat']=$latlng[0];
			$post['long']= $latlng[1];
			//print_r($post); exit;
			$data['addServiceProviderLocation']=$this->Api->addServiceProviderLocation($post);
					//print_r($data['addServiceProviderLocation']);
					redirect(base_url().'homeweb/serviceProviderLocation');
					//exit;
		}
		$data['userlat'] = $this->uri->segment(4);
		$data['userlng'] = $this->uri->segment(5);
		$data['content'] = 'web/addServiceProviderLocation';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       
    }

    public function serviceProviderDetails()
    {
    	 $serviceProviderId = $this->uri->segment(3);

         $data['id'] = $serviceProviderId;

    	 $data['stateId'] = $this->uri->segment(4);

    	 $data['districtId'] = $this->uri->segment(5);

    	 $data['serviceTypeId'] = $this->uri->segment(6);

    	 $data['serviceTypeParameterId'] = $this->uri->segment(7);

    	 $data['latlong'] = $this->uri->segment(8);

    	$data['serviceProviderId'] = $serviceProviderId;

    	$data['serviceProviderDetails'] = $this->roleMasterWeb->serviceProviderDetail($serviceProviderId);

    	$data['conMode'] = $this->roleMasterWeb->getRegistrationMode($data['serviceProviderDetails'][0]['conMode']);

    	$data['services'] = $this->roleMasterWeb->serviceProviderServices($serviceProviderId);

    	$data['pageId'] = 79;

		$data['comments'] = $this->roleMasterWeb->getCommentsWp(79);


        $data['content'] = 'web/serviceProviderDetails';



        $this->load->view('Layout/dashboardLayoutWeb',$data);
    }

    public function checkUserExist()
    {
    	$data['userName'] = $this->input->post('userName');

    	//$data['password'] = $this->input->post('password');

    	$main = $this->roleMasterWeb->checkUserExist($data);

    	echo json_encode($main);
    }

    public function insertComment()
    {
         
		$this->session->set_userdata(['last_link'=> $this->agent->referrer()]);	


    	$data['pageId'] = $this->uri->segment(3);

    	$data['comment'] = $this->input->post('comment');

    	$data['name'] = $this->input->post('author');

    	$data['email'] = $this->input->post('email');

    	$data['mobile'] = $this->input->post('mobile');

    	$data['website'] = $this->input->post('url');

        $this->roleMasterWeb->insertComment($data);

       // redirect(base_url().'homeweb/searchServiceProvider');

        $last_link = $this->session->userdata('last_link');
					$this->session->unset_userdata('last_link');			
					redirect($last_link);
       
    }

    public function contactUs()
    {
    	$data['content'] = 'web/contactUs';
    	//$data['pageId'] = 15;
		//$data['comments'] = $this->roleMasterWeb->getCommentsWp(15);
        $this->load->view('Layout/dashboardLayoutWeb',$data);
    }

    public function eventInfo()
    {
    	$data['eventId'] = $this->input->post('eventId');

    	$main = $this->roleMasterWeb->eventInfo($data);

    	echo json_encode($main);
    }

    public function ongroundPartnerDetail()
    {
    	$ongroundPartnerId = $this->input->post('ongroundPartnerId');

    	$main = $this->Api->ongroundPartnersList($ongroundPartnerId);

    	echo json_encode($main);
    }

    public function otp()
    {
 		$data['content'] = 'web/otp';
        $this->load->view('Layout/dashboardLayoutWeb',$data);       	
    }

    public function otpVerify()
    {
    	
    	if ($this->input->post()) {
    		
    		$res = $this->roleMasterWeb->otpVerify($data);

    		if ($res['0']['otp'] == $this->input->post('otp')) {
    			

    			$this->roleMasterWeb->updateVerify();
    		
				$data['userName'] 		= $res['0']['userName'];
				$data['name'] 			= $res['0']['name'];
				$data['emailAddress']	= $res['0']['emailAddress'];
				$data['password'] 		= $res['0']['password'];
				$data['mobileNo'] 		= $res['0']['mobileNo'];
		
		 		$data['content'] = 'web/successUser';
		        $this->load->view('Layout/dashboardLayoutWeb',$data);
    		}else{
    			$this->session->set_flashdata(['errorMessage'=>'please insert correct otp']);
    			redirect(base_url()."homeweb/otp/".$this->uri->segment(3));
    		}
    	}
    }

    public function getContactRequestInfo()
    {
    	$this->roleMasterWeb->getContactDetail();

    	redirect(base_url().'homeweb/contactUs');
    }
	
    public function logout()
    {
        $this->roleMasterWeb->logout($this->session->userdata('userId'),$this->session->userdata('logId'));
		$last_link = $this->agent->referrer();	    	
    	session_destroy();
    	$this->session->sess_destroy();				
		redirect($last_link);
    }

     public function redeemCoupon()
    {
       $data['voucherId'] = $this->input->post('voucherId');

       $data['partnerId'] = $this->input->post('partnerId');

       $result = $this->roleMasterWeb->getOnGroundPartnerById($data['partnerId']);

       $result2 =  $this->roleMasterWeb->getVoucherNumberById($data['voucherId']);

      $result1 = $this->roleMasterWeb->redeemCoupon($data);

       if(!empty($result) && !empty($result1))
       {
       	 $data1['mobileNo'] = $this->session->userdata('mobile');

            // $data1['smsContent'] = "You have selected ".$result[0]['name'].". Kindly visit and redeem the gift coupon. The gift coupon number is ".$result2[0]['voucherNumber'];

       	 $data1['smsContent'] = "Congrats ".$this->session->userdata('userName')." ! Your Gift Coupon is ".$result2[0]['voucherNumber']." Please call ".$result[0]['name']." on ".$result[0]['mobile'].". Your Code is ".$result2[0]['voucherCode'];

                  $this->Api->sendSms($data1);

            $data2['mobileNo']  = $result[0]['mobile'];
            
          /*  $data2['smsContent'] = $this->session->userdata('userName')." has selected ".$result[0]['name']." to redeem the gift coupon number ".$result2[0]['voucherNumber'];
*/
           $data2['smsContent'] = "Coupon: ".$result2[0]['voucherNumber']." ;Date: ".date('d M Y',strtotime($result2[0]['voucherDate']))." ;Mobile: ".$this->session->userdata('mobile')." ;Partner Id: ".$result[0]['ongroundPartnerUniqueId'];

            $this->Api->sendSms($data2); 

       /*   $data3['mobileNo'] = $this->session->userdata('mobile');
          
          $data3['smsContent'] =   "Hello,".$this->session->userdata('userName')." your voucher code generated is ".$result2[0]['voucherCode']." share this voucher code once you visits selected onground provider ".$result[0]['name'];

            $this->Api->sendSms($data3); */
       }
    }

       public function insertCommentWp()
    {
    	$this->session->set_userdata(['last_link'=> $this->agent->referrer()]);

    	$data['comment_post_ID'] = $this->uri->segment(3);

    	$data['comment_content'] = $this->input->post('comment');

    	$data['comment_author'] = $this->input->post('author');

    	$data['comment_author_email'] = $this->input->post('email');

    	$data['comment_author_url'] = $this->input->post('url');

    	$data['comment_approved'] = 0;

    	$data['comment_date'] = date('Y-m-d h:i:s');

    	$data['user_id'] = $this->session->userdata('userId');

        $this->roleMasterWeb->insertCommentWp($data);



        $last_link = $this->session->userdata('last_link');
					$this->session->unset_userdata('last_link');			
					redirect($last_link);
       

    }

    public function test()
    {
    	print_r($this->session->all_userdata());
    }

     public function forgotPassword()
    {
    	$data['content'] = 'web/forgotPassword';

        $this->load->view('Layout/dashboardLayoutWeb',$data);          	
    }

    public function checkUser()
    {
        $username = $this->input->post('username');

       $result = $this->roleMasterWeb->checkUser($username);

       if(!empty($result))
       {
          $data['mobile'] = $result[0]['mobileNo'];

       	  $data['userId'] = $result[0]['userId'];

       	  $data['content'] = 'web/verifyUser';

       	  $otp = mt_rand(10000,99999);

       	  $this->roleMasterWeb->updateOtp($result[0]['userId'],$otp);

       	  $this->roleMasterWeb->insertOtp($result[0]['userId'],$otp);

       	  $message = "Your OTP to reset password in Sahay website is ".$otp;

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


       	  $this->load->view('Layout/dashboardLayoutWeb',$data);
       }
       else{
             $this->session->set_flashdata(['errorMessage'=>'User with this user name does not exist']);
    			redirect(base_url()."homeweb/forgotPassword");  	
       }
    }

  
    public function verifyUser()
    {

      $userId = $this->input->post('userId');

      $mobile = $this->input->post('mobile');

      $result = $this->roleMasterWeb->getUser($userId);

      if($result[0]['otp'] == $this->input->post('otp'))
      {
      	
      	redirect(base_url().'homeweb/resetPassword');
        
      }
      else{

            $data['userId'] = $userId;

            $data['mobile'] = $mobile;

            $otp = mt_rand(10000,99999);

       	  $this->roleMasterWeb->updateOtp($userId,$otp);

       	 $this->roleMasterWeb->insertOtp($userId,$otp);

       	  $message = "Your OTP to reset password in Sahay website is ".$otp;

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

            $data['content'] = 'web/verifyUser';

      	  $this->load->view('Layout/dashboardLayoutWeb',$data);
    			  	
      }

    }

    public function resetPassword()
    {
    	$data['userId'] = $this->session->userdata('temp_userId');

    	$data['content'] = 'web/resetPassword';

    	$this->load->view('Layout/dashboardLayoutWeb',$data);
    }

    public function setPassword()
    {
    	$data['userId'] = $this->input->post('userId');

    	$data['password'] = md5($this->input->post('password'));

    	$this->roleMasterWeb->setPassword($data);

    	$result = $this->roleMasterWeb->getUser($data['userId']);

    	$this->roleMasterWeb->setLogs($data['userId']);

    	$result1 = $this->roleMasterWeb->getLoginId($data['userId']);

    	$this->session->unset_userdata('temp_userId');

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
				'logInto'=>'Website',				
				'validated' => true
				);
				$this->session->set_userdata($sessionData);

				$_SESSION['isLogin'] = 'yes';
				$_SESSION['loginmobile'] = $result[0]['mobileNo'];
				$_SESSION['loginemail'] = $result[0]['emailAddress'];
				$_SESSION['user'] =  $result[0]['userName'];	

	    redirect('http://101.53.136.41/sahya/');			

    }

    public function gallery()
    {
    	$data['contentList'] = $this->roleMasterWeb->getContents();

    	$data['content'] = 'web/gallery';

    	$this->load->view('Layout/dashboardLayoutWeb',$data);
    }

 
    public function contentInfo()
    {
    	$data['contentId'] = $this->input->post('contentId');

    	$main = $this->roleMasterWeb->contentInfo($data['contentId']);

    	echo json_encode($main);
    }

    public function checkUserMobile()
    {
    	$mobileNo = '+91'.$this->input->post('mobileNo');

    	$main = $this->roleMasterWeb->checkUserMobile($mobileNo);

    	echo json_encode($main);
    }

    public function fileReport()
    {
    	//$data['contentList'] = $this->roleMasterWeb->getContents();

    	$data['state']=$this->roleMasterWeb->state();

    	$data['content'] = 'web/fileReport';

    	$this->load->view('Layout/dashboardLayoutWeb',$data);
    }

    public function getFileReport()
    {
    	$data['reportId'] = $this->roleMasterWeb->getFileReport();

    		$data['content'] = 'web/verifyFileReport';

    	$this->load->view('Layout/dashboardLayoutWeb',$data);

    	//redirect(base_url().'homeweb/fileReport');
    }

    public function verifyFileReport()
    {
    	$data['reportId'] = $this->input->post('reportId');

    	$data['otp'] = $this->input->post('otp');

    	//print_r($data);exit();

    	$result =   $this->roleMasterWeb->verifyFileReport($data);

    	//print_r($result);exit();

    	if(!$result)
    	{
    		$data['msg'] = 'Wrong OTP'; 

 			$this->session->set_flashdata(['otpMessage'=>'Wrong OTP']);

    		$this->roleMasterWeb->resetFileReportOtp($data);

    		$data['content'] = 'web/verifyFileReport';


    	$this->load->view('Layout/dashboardLayoutWeb',$data);

    	}else{

    		//echo "hjkhjk";

    		$this->roleMasterWeb->fileReportVerified($data);

    		redirect(base_url().'homeweb/fileReport');

    	}	
    }

    public function feedbackNew()
    {
    		$data['content'] = 'web/feedbackNew';

    	$this->load->view('Layout/dashboardLayoutWeb',$data);

    }

    public function fileReportHistory()
    {
      
             $data['content'] = 'web/fileReportHistory';	
       	
       

    	$this->load->view('Layout/dashboardLayoutWeb',$data);
    }

    public function showFileReport()
    {

       	  $data['reportId'] = $this->input->post('reportId');

       	  $data['reportHistory'] = $this->roleMasterWeb->fileReportHistory($data['reportId']);

       	  $data['reportData'] = $this->roleMasterWeb->fileReportData($data['reportId']);

       	
           // print_r($data['reportData']);exit();
             		$data['content'] = 'web/showFileReport';

        	$this->load->view('Layout/dashboardLayoutWeb',$data);     		
       

    }

     public function campReportPdf()
	 {
	 	$data['content'] = 'campReportPdf';

	 	 $this->load->view('campReportPdf');   	


	 }   


    public function checkFileReportId()
    {
      $fileReportId  = strtoupper($this->input->post('reportId'));

      $main = $this->roleMasterWeb->checkFileReportId($fileReportId);

    	 echo json_encode($main);
    }

    public function getFileReportFeedback()
    {
      $res = $this->roleMasterWeb->getFileReportFeedback();

      if($res)
      {
      	  $this->session->set_flashdata(['feedbackSubmitMessage'=>'Feedback already submitted']);
      }	

      $this->session->set_flashdata(['feedbackMessage'=>'Thank you for the review']);

      redirect(base_url().'homeweb/feedbackNew');	
    }

	
}