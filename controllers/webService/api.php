<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'); 
// if (!isset($_SERVER['PHP_AUTH_USER'])) {
//     header('WWW-Authenticate: Basic realm="My Realm"');
//     header('HTTP/1.0 401 Unauthorized');

//     	$failed['responseMessage']='Api authentication is required';
// 			$failed['responseCode']=0;
// 			$response=$failed;
	
// 		echo json_encode($response);;
//     exit;
// } elseif(($_SERVER['PHP_AUTH_USER']=='saathi')&&($_SERVER['PHP_AUTH_PW']=='7827795968')) {
//     // echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
//     // echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
// }


define("GOOGLE_API_KEY", "AIzaSyA7tYOQH__KfBbY2DvuAejQCkg4e-M9_7Y");

class Api extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        $this->load->model('webService/apiModel', 'Api', TRUE);
    }
    		

	// public function signup() {		
	// 	if ($this->input->post()){
			
	// 		$userId = 	$this->Api->addUser();

	// 		 $otp = mt_rand(10000,99999);

	//   $post['mobileNo'] = $this->input->post('mobileNo');

	//   $post['smsContent'] = 'The OTP for registration on Sahay App is '.$otp;

	//   $this->db->where('userId',$userId);

	//   $this->db->update('tbl_user',['otp'=>$otp]);

	//   //$res=$this->Api->sendSms($post);

	//      $data['userName'] = $this->input->post('userName');
	// 	 $data['name'] = $this->input->post('name');
	// 	 $data['emailAddress'] = $this->input->post('emailAddress');
	// 	 $data['password'] = $this->input->post('password');
	// 	 $data['mobileNo'] = $this->input->post('mobileNo');

	// 		$response=$res[0];
	// 	}else{
	// 		$this->failed['responseMessage']='Field is Mandatory';
	// 		$this->failed['responseCode']=0;
	// 		$response=$this->failed;
	// 	}
	// 	echo json_encode($response);
 //    }

	public function login() {		
		if ($this->input->post()){
			$data['userName']=$this->input->post('userName');
			$data['password']=$this->input->post('password');
			$data['quizUniqueNumber']=$this->input->post('quizUniqueNumber');
			$data['loginTime']=$this->input->post('loginTime');
			$res=$this->Api->login($data);
			//echo '<pre>';print_r($res);exit;
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function searchServiceProvider() {		
		if ($this->input->post()){
			$data['searchText']=$this->input->post('searchText');
			$data['serviceTypeId']=$this->input->post('serviceTypeId');
			$data['serviceTypeParameterId']=$this->input->post('serviceTypeParameterId');
			$data['latLong']=$this->input->post('latLong');
			$res=$this->Api->searchServiceProvider($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Service Provider Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function vouchersList() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['voucherId']=$this->input->post('voucherId');
			$res=$this->Api->vouchersList($data);
			//echo '<pre>';print_r($res);exit;
			if($this->input->post('voucherId')){
				$this->success=$res[0];
			}else{
				$this->success['responseMessage']='Vouchers Fetched Successfully';
				$this->success['responseCode']=200;
				$this->success['data']=$res;
			}
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function registerUser() {		
		if ($this->input->post()){
			$data['name']=$this->input->post('name');
			$data['age']=$this->input->post('age');
			$data['dob']=$this->input->post('dob');
			$data['gender']=$this->input->post('gender');
			$data['email']=$this->input->post('email');
			$data['occupation']=$this->input->post('occupation');
			$data['educationLevel']=$this->input->post('educationLevel');
			$data['userName']=$this->input->post('userName');
			$data['password']=$this->input->post('password');
			$data['district']=$this->input->post('district');	
			$data['state']=$this->input->post('state');	
			$data['placeofOrigin']=$this->input->post('placeofOrigin');	
			$data['mobile']=$this->input->post('mobile');	
			$data['maritalStatus']=$this->input->post('maritalStatus');	
			$data['behaviour']=$this->input->post('behaviour');	
			$data['hydc']=$this->input->post('hydc');	
			$res=$this->Api->registerUser($data);
			//echo '<pre>';print_r($res);exit;
			if($res[0]['responseCode'] == '200'){
				$resOtp=$this->Api->sendSms($res[0]);
			}
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function forgotPassword() {		
		if ($this->input->post()){
			$data['userName']=$this->input->post('userName');
			$res=$this->Api->forgotPassword($data);
			//echo '<pre>';print_r($res);exit;
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function changePassword() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['oldPassword']=$this->input->post('oldPassword');
			$data['newPassword']=$this->input->post('newPassword');
			$res=$this->Api->changePassword($data);
			//echo '<pre>';print_r($res);exit;
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function eventsList() {		
		$data['eventId']=$this->input->post('eventId');
		$res=$this->Api->eventsList($data);
		//echo '<pre>';print_r($res);exit;
		if($this->input->post('eventId')){
			$this->success=$res[0];
		}else{
			$this->success['responseMessage']='Events Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
		}
		$response=$this->success;
		echo json_encode($response);
    }
	
	public function ongroundPartnersList() {		
		$data['ongroundPartnerId']=$this->input->post('ongroundPartnerId');
		$res=$this->Api->ongroundPartnersList($data);
		if($this->input->post('ongroundPartnerId')){
			$this->success=$res[0];
		}else{
			$this->success['responseMessage']='Onground Partner Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
		}
		$response=$this->success;
		echo json_encode($response);
    }
	
	public function otpVerification() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['otp']=$this->input->post('otp');
			$data['quizUniqueNumber']=$this->input->post('quizUniqueNumber');
			$res=$this->Api->otpVerification($data);
			//echo '<pre>';print_r($res);exit;
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function serviceAccessVoucher() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['serviceProviderId']=$this->input->post('serviceProviderId');
			$res=$this->Api->serviceAccessVoucher($data);
			//echo '<pre>';print_r($res);exit;
			if($res[0]['responseCode'] == '200'){
				$resOtp=$this->Api->sendSms($res[0]);
			}
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function playedQuizList() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$res=$this->Api->playedQuizList($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Quiz List Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function quizList() {		
		$res=$this->Api->quizList();
		//echo '<pre>';print_r($res);exit;
		$this->success['responseMessage']='Quiz List Fetched Successfully';
		$this->success['responseCode']=200;
		$this->success['data']=$res;
		$response=$this->success;
		echo json_encode($response);
    }
	
	public function newQuizQuestions() {		
		if ($this->input->post()){
			$data['quizId']=$this->input->post('quizId');
			$res=$this->Api->newQuizQuestions($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Quiz Questions Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function eventSearch() {		
		if ($this->input->post()){
			$data['name']=$this->input->post('name');
			$data['date']=$this->input->post('date');
			$res=$this->Api->eventSearch($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Events Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function stateList() {		
		$res=$this->Api->stateList();
		//echo '<pre>';print_r($res);exit;
		$this->success['responseMessage']='States Fetched Successfully';
		$this->success['responseCode']=200;
		$this->success['data']=$res;
		$response=$this->success;
		echo json_encode($response);
    }
	
	public function districtList() {		
		if ($this->input->post()){
			$data['stateId']=$this->input->post('stateId');
			$res=$this->Api->districtList($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Districts Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function addServiceProviderLocation() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['serviceProviderId']=$this->input->post('serviceProviderId');
			$data['lat']=$this->input->post('lat');
			$data['long']=$this->input->post('long');
			$res=$this->Api->addServiceProviderLocation($data);
			//echo '<pre>';print_r($res);exit;
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function menuList() {		
		if ($this->input->post()){
			$data['userType']=$this->input->post('userType');
			$res=$this->Api->menuList($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Menu Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function serviceProviderType() {		
		$res=$this->Api->serviceProviderType();
		//echo print_r($res);exit;
		$this->success['responseMessage']='Service Provider Types Fetched Successfully';
		$this->success['responseCode']=200;
		$this->success['data']=$res;
		$response=$this->success;
		echo json_encode($response);
    }
	
	public function submitQuiz() {		
		if ($this->input->post()){
			$data['quizId']=$this->input->post('quizId');
			$data['quizStartTime']=$this->input->post('quizStartTime');
			$data['quizEndTime']=$this->input->post('quizEndTime');
			$data['quizQuestionId']=$this->input->post('quizQuestionId');
			$data['quizQuestionOptionId']=$this->input->post('quizQuestionOptionId');
			$data['userId']=$this->input->post('userId');
			$res=$this->Api->submitQuiz($data);
			$response=$res;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function feedback() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['serviceProviderId']=$this->input->post('serviceProviderId');
			$data['feedback']=$this->input->post('feedback');
			$res=$this->Api->feedback($data);
			$response=$res[0];
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function webView() {		
		if ($this->input->post()){
			$type=$this->input->post('type');
			$this->success['responseMessage']='Web View Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['url']= base_url().'index.php/webService/api/webViewUrl/'.$type;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function webViewUrl() {	
		$type = $this->uri->segment(4);
		$this->load->view('api/'.$type);
	}
	
	public function logout() {		
		if ($this->input->post()){
			$data['userId']=$this->input->post('userId');
			$data['logoutTime']=$this->input->post('logoutTime');
			$res=$this->Api->logout($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='User Logout Successfully';
			$this->success['responseCode']=200;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }
	
	public function serviceTypeParameters() {		
		if ($this->input->post()){
			$data['serviceTypeId']=$this->input->post('serviceTypeId');
			$res=$this->Api->serivceTypeParameters($data);
			//echo '<pre>';print_r($res);exit;
			$this->success['responseMessage']='Service Type Parameters Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$res;
			$response=$this->success;
		}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}
		echo json_encode($response);
    }

   public function userRegistrationConsent()
   {
   	  $data['mobile'] = $_GET['your_sender'];

   	  $data['smsContent'] = $_GET['your_message'];

   	 /* $data['mobile'] = $this->input->post('mobile');

        $data['smsContent'] = $this->input->post('smsContent');*/
    
   	   $result = $this->Api->userRegistrationConsent($data);

   	  $this->success['responseMessage']='User registration consent SMS Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$result;
			$response=$this->success;
	/*	}else{
			$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;
		}*/
		echo json_encode($response);

   }

   public function campReportUniqueId()
   {
   	 $query = $this->db->get('tbl_camp_reports');

   	 $result = $query->result_array();

   	 foreach ($result as $key => $value) 
   	 {
   	 	
   	 	$campReportUniqueId = $this->Api->campReportUniqueId();

   	 	$this->db->where('id',$value['id']);

   	 	$this->db->update('tbl_camp_reports',['camp_code_unique_id'=>$campReportUniqueId]);
   	 }
   }


//15-06-2019

   	public function searchServiceProviders(){
      

		// if ($this->input->post()){
		// 	//print_r($this->input->post());exit;
		// 	$post['stateId']=$this->input->post('stateId');
		// 	$post['districtId']=$this->input->post('districtId');
		// 	$post['serviceTypeId']=$this->input->post('serviceTypeId');
		// 	$post['serviceTypeParameterId']=$this->input->post('serviceTypeParameterId');
		// 	$post['latLong']=$this->input->post('latLong');

		// 	$data['serviceProviderList']=$this->roleMasterWeb->searchServiceProvider($post);
		// 	//print_r($data['serviceProviderList']); exit;
		// 	echo $a ='&nbsp;';//echo '/n';



		// }
		// $data['search']= $this->input->post();
		// $data['pageId'] = 1;

		// $data['comments'] = $this->roleMasterWeb->getCommentsWp(1);

  //    	$data['serviceProviderType']=$this->Api->serviceProviderType();
		// $data['state']=$this->roleMasterWeb->state();
		//$data['content'] = 'web/searchServiceProvider';

        //$this->load->view('Layout/dashboardLayoutWeb',$data);

if($this->input->post())
{
        $post['stateId'] = $this->input->post('stateId');
        $post['districtId']=$this->input->post('districtId');
        $post['serviceTypeId']=$this->input->post('serviceTypeId');
        $post['serviceTypeParameterId']=$this->input->post('serviceTypeParameterId');
        $post['latLong']=$this->input->post('latLong');
        $result=$this->Api->searchServiceProviders($post);


        	$this->success['responseMessage']='Service Fetched Successfully';
			$this->success['responseCode']=200;
			$this->success['data']=$result;
			$response=$this->success;


    }
    else{
    		$this->failed['responseMessage']='Field is Mandatory';
			$this->failed['responseCode']=0;
			$response=$this->failed;

    }

    	echo json_encode($response);
}


}
