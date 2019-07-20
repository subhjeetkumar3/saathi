<?php

class ApiModel extends CI_Model {

    public function login($data) {
		$post['p_userName']	 = $data['userName'];	
		$post['p_password']	 = md5($data['password']);
		$post['p_quizUniqueNumber']	 = $data['quizUniqueNumber'];
		$post['p_loginTime']	 = $data['loginTime'];
		$stored = "Call proc_login_validation_app(?,?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();			
		return $result;
    }
	
	public function searchServiceProvider($data) {
		$post['p_searchText']	 = $data['searchText'];	
		$post['p_serviceTypeId']	 = $data['serviceTypeId'];	
		$post['p_serviceTypeParameterId']	 = $data['serviceTypeParameterId'];	
		$post['p_latLong']	 = $data['latLong'];	
		$stored = "Call proc_service_provider_search(?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query();
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
		//echo '<pre>';print_r($result);exit;
		if($post['p_latLong'] == ''){
			return $result;
		}else{
			foreach($result as $value){
				//echo $value['geoLocation'];
				$geoFrom = $post['p_latLong'];
				$geoTo = $value['latitude'].','.$value['longitude'];
				$distance = $this->getDistance($geoFrom, $geoTo, "K");
				//print_r($distance);
				if($distance['range']<= '5'){
					$rr[]=$value;
				}
				$i++;
			}
			return $rr;
		}
	}
	
	public function getDistance($geoFrom, $geoTo, $unit){
		$data1= explode(',',$geoFrom);
		$data2= explode(',',$geoTo);
		$latitudeFrom = $data1[0];
		$longitudeFrom = $data1[1];
		$latitudeTo = $data2[0];
		$longitudeTo = $data2[1];
		
		//Calculate distance from latitude and longitude
		$theta = $longitudeFrom - $longitudeTo;
		$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);
		if ($unit == "K") {
			$range = ($miles * 1.609344);
		} else if ($unit == "N") {
			$range = ($miles * 0.8684);
		} else {
			$range = $miles;
		}
		$geo = $latitudeTo.','.$longitudeTo;
		$result = array('range'=>$range);
		return $result;
	}
	
	public function registerUser($data) {
		//echo '<pre>';print_r($data);exit;
		$post['p_nameAlias']	 = $data['name'];	
		$post['p_age']	 = $data['age'];
		$post['p_dob']	 = $data['dob'];
		$post['p_gender']	 = $data['gender'];
		$post['p_email']	 = $data['email'];
		$post['p_occupation']	 = $data['occupation'];
		$post['p_educationLevel']	 = $data['educationLevel'];
		$post['p_userName']	 = $data['userName'];
		$post['p_password']	 = $data['password'];
		$post['p_district']	 = $data['district'];
		$post['p_state']	 = $data['state'];
		$post['p_placeofOrigin']	 = $data['placeofOrigin'];
		$post['p_mobile']	 = $data['mobile'];
		$post['p_maritalStatus']	 = $data['maritalStatus'];
		$post['p_behaviour']	 = $data['behaviour'];
		$post['p_hydc']	 = $data['hydc'];
		//echo '<pre>';print_r($post);exit;
		$stored = "Call proc_register_user_app(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
			
		return $result;
    }
	
	public function forgotPassword($data) {
		$post['p_userName']	 = $data['userName'];	
		$stored = "Call proc_forgot_password(?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
			
		return $result;
    }
	
	public function changePassword($data) {
		$post['p_userId']	 = $data['userId'];	
		$post['p_oldPassword']	 = $data['oldPassword'];	
		$post['p_newPassword']	 = $data['newPassword'];	
		$stored = "Call proc_change_password(?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
			
		return $result;
    }
	
	public function eventsList($data) {
		$post['p_eventId']	 = $data['eventId'];	
		$stored = "Call proc_event_data(?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();	
		$query->free_result();
		$query->next_result();
		
		return $result;
    }
	
	public function ongroundPartnersList($data) {
		if($data == NULL)
		{
           $post['p_ongroundPartnerId'] = '';
		}
		else
	   {	
		$post['p_ongroundPartnerId']	 = $data;	
	   }	
		$stored = "Call proc_onground_partner_data(?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
			
		$result = $query->result_array();	
       
     	$query->free_result();
		$query->next_result();	
		return $result;
    }
	
	public function vouchersList($data) {
		/*$post['p_userId']	 = $data['userId'];	
		$post['p_voucherId']	 = $data['voucherId'];	
		$stored = "Call proc_voucher_data(?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();


       //  print_r($result);exit();
       
		$query->free_result();
		$query->next_result();	
		
		return $result;*/

		$sql = "SELECT 'Voucher Detail Fetched Successfully' AS responseMessage,'200' AS responseCode,t1.voucherId,t1.voucherNumber,t1.voucherCode,DATE_FORMAT(t1.voucherDate,'%d-%m-%Y') AS voucherDate,
			DATE_FORMAT(t1.voucherExpDate,'%d-%m-%Y') AS voucherExpDate,t2.voucherBackName,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			'Service Access Voucher'
			WHEN t2.voucherBackName = 'game'
			THEN
			'Game Voucher'
			ELSE
			'Quiz Voucher'
			END
			AS 
			voucherType,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			(SELECT `name` FROM `tbl_service_provider_details` WHERE serviceProviderId = t1.categoryId)
			WHEN t2.voucherBackName = 'game'
			THEN
			(SELECT `gameName` FROM `tbl_game_master` WHERE id = t1.categoryId)
			ELSE
			(SELECT `quizName` FROM `tbl_quiz_names` WHERE quizId = t1.categoryId)
			END
			AS 
			categoryName,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			(SELECT `latitude` FROM `tbl_service_provider_details` WHERE serviceProviderId = t1.categoryId)
			WHEN t2.voucherBackName = 'game'
			THEN
			''
			ELSE
			''
			END
			AS 
			latitude,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			(SELECT `longitude` FROM `tbl_service_provider_details` WHERE serviceProviderId = t1.categoryId)
			WHEN t2.voucherBackName = 'game'
			THEN
			''
			ELSE
			''
			END
			AS 
			longitude,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			(SELECT `address` FROM `tbl_service_provider_details` WHERE serviceProviderId = t1.categoryId)
			WHEN t2.voucherBackName = 'game'
			THEN
			''
			ELSE
			''
			END
			AS 
			address,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			(SELECT `mobile` FROM `tbl_service_provider_details` WHERE serviceProviderId = t1.categoryId)
			WHEN t2.voucherBackName = 'game'
			THEN
			''
			ELSE
			''
			END
			AS 
			mobile,
			CASE WHEN t2.voucherBackName = 'service'
			THEN
			(SELECT `officePhone` FROM `tbl_service_provider_details` WHERE serviceProviderId = t1.categoryId)
			WHEN t2.voucherBackName = 'game'
			THEN
			''
			ELSE
			''
			END
			AS 
			officePhone
			FROM `tbl_voucher_creation_data` AS t1 
			LEFT JOIN `tbl_voucher_type` AS t2 ON t1.voucherTypeId = t2.voucherTypeId
			WHERE t1.userId = '".$data['userId']."' AND t1.deleted = 'N';";

			$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;		

		
    }
	
	public function otpVerification($data) {
		$post['p_userId']	 = $data['userId'];	
		$post['p_otp']	 = $data['otp'];
		$post['p_quizUniqueNumber']	 = $data['quizUniqueNumber'];		
		$stored = "Call proc_otp_verification(?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
			
		return $result;
    }
	
	public function serviceAccessVoucher($data) {
		$post['p_userId']	 = $data['userId'];	
		$post['p_serviceProviderId']	 = $data['serviceProviderId'];
		$post['p_voucherCode'] = $data['voucherCode'];	
		$stored = "Call proc_service_access_voucher(?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();	

		$query->next_result(); 
        $query->free_result(); 
 
		return $result;
    }
	
	public function playedQuizList($data) {
		$post['p_userId']	 = $data['userId'];	
		$stored = "Call proc_played_quiz_list(?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();	
		$query->free_result();
		$query->next_result();
		
		return $result;
    }
	
	public function quizList() {
		$sql="SELECT quizId,quizName,quizImage FROM `tbl_quiz_names` 
				WHERE deleted = 'N' 
				AND quizId IN (SELECT quizId FROM `tbl_quiz_questions` WHERE deleted = 'N') ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;	
    }
	
	public function newQuizQuestions($data) {
		$sql="SELECT quizQuestionId,quizQuestionName,typeOfAnswer FROM `tbl_quiz_questions` WHERE quizId = ".$data['quizId']." AND deleted = 'N' AND quizQuestionName != '' ";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		foreach($result as $val){
			$result1 = $this->newQuizQuestionOptions($val);
			
			//echo '<pre>';print_r($result1);
			$res['options'] = $result1;
			$cc = $val;
			$aa[] = array_merge($cc,$res);
		}
		
		//echo '<pre>';print_r($aa);
		return $aa;
	}
	
	public function newQuizQuestionOptions($data) {
		$sql1="SELECT quizQuestionOptionId as optionId,quizQuestionOptionName as optionName FROM `tbl_quiz_question_options` WHERE quizQuestionId = ".$data['quizQuestionId']." AND deleted = 'N' ";
		$query1 = $this->db->query($sql1);
		//echo $this->db->last_query();
		$result1 = $query1->result_array();
		foreach($result1 as $val){
			$option[] = $val;
		}
		return $option;
	}
	
	public function eventSearch($data) {
		$post['p_name']	 = $data['name'];	
		$post['p_date']	 = $data['date'];	
		$stored = "Call proc_event_search(?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query();
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
			
		return $result;
	}
	
	public function stateList() {
		$sql="SELECT stateId,stateName,stateCode FROM `tbl_state` WHERE deleted = 'N'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;	
    }
	
	public function districtList($data) {
		$sql="SELECT districtId,districtName,districtCode,stateId FROM `tbl_district` WHERE deleted = 'N' AND stateId = ".$data['stateId']."";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;	
    }
	
	public function addServiceProviderLocation($data) {
		$post['p_userId']	 = $data['userId'];	
		$post['p_serviceProviderId']	 = $data['serviceProviderId'];	
		$post['p_lat']	 = $data['lat'];	
		$post['p_long']	 = $data['long'];	
		$stored = "Call proc_add_service_provider_location(?,?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
			
		return $result;
    }
	
	public function menuList($data) {
		$sql="SELECT t1.menuId,t2.title,t2.component,t2.icon FROM `tbl_menu_app_mapping` AS t1 
				LEFT JOIN `tbl_menu_app` AS t2 ON t1.menuId = t2.menuId
				WHERE t1.userType = '".$data['userType']."' AND t1.deleted = 'N' AND t2.deleted = 'N'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;	
    }
	
	public function serviceProviderType() {
		$sql="SELECT serviceTypeId,serviceTypeName FROM `tbl_service_type` WHERE deleted ='N'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;	
    }
	
	public function submitQuiz($data) {
		$post['p_quizId']	 = $data['quizId'];	
		$post['p_quizStartTime']	 = $data['quizStartTime'];	
		$post['p_quizEndTime']	 = $data['quizEndTime'];	
		$post['p_quizQuestionId']	 = $data['quizQuestionId'];	
		$post['p_quizQuestionOptionId']	 = $data['quizQuestionOptionId'];	
		$post['p_userId']	 = $data['userId'];	
		$stored = "Call proc_submit_quiz(?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
		$sql1="SELECT t2.quizQuestionName,GROUP_CONCAT(t3.quizQuestionOptionName) as answer,
				(SELECT GROUP_CONCAT(quizQuestionOptionName) FROM tbl_quiz_question_options WHERE quizQuestionId = t1.quizQuestionId AND quizQuestionAnswer = '1' AND deleted = 'N') as correctAnswer,
				CASE WHEN 
				(SELECT quizQuestionAnswer FROM tbl_quiz_question_options 
				WHERE quizQuestionOptionId = t1.quizQuestionOptionId) = '1'
				THEN
				'Y'
				ELSE
				'N'
				END
				AS anwserMode
				FROM `tbl_quiz_question_result` AS t1 
				LEFT JOIN `tbl_quiz_questions` AS t2 ON t1.quizQuestionId = t2.quizQuestionId
				LEFT JOIN `tbl_quiz_question_options` AS t3 ON t1.quizQuestionOptionId = t3.quizQuestionOptionId
				WHERE t1.quizUniqueNumber = '".$result[0]['quizUniqueNumber']."' AND t1.deleted = 'N' AND t2.deleted = 'N' AND t3.deleted = 'N' GROUP BY t2.quizQuestionName  ORDER BY t2.quizQuestionId";
		$query1 = $this->db->query($sql1);
		$result1 = $query1->result_array();
		 if(!empty($result1))
	       {	
		   foreach($result1 as $val1){
			$aa[] = $val1;
	       }
		$cc['data'] = $aa;
	      }
	   else
	   {
              $cc = array();
	   }
	   $dd = array_merge($result[0],$cc);	
		return $dd;

    }
	
	public function feedback($data){
		$post['p_userId']	 = $data['userId'];	
		$post['p_serviceProviderId']	 = $data['serviceProviderId'];	
		$post['p_feedback']	 = $data['feedback'];	
		$stored = "Call proc_feedback_submit(?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query();
		$result = $query->result_array();	
		$query->free_result();
		$query->next_result();
		
		return $result;
	}
	
	public function sendSms($data){
		//print_r($data);exit;
		$mobile = $data['mobileNo'];
		$smsContent = str_replace(' ','+',$data['smsContent']);
		//$smsTime = $data['smsTime'];
		//$date = date('d-m-Y').'T'.date('h:i:s');
		$smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$mobile.'&message='.$smsContent.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate=';
		//echo $smsApi; //exit;
		$ch = curl_init($smsApi);
		//curl_setopt($ch, CURLOPT_BUFFERSIZE, 8400000);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $smsContent);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $mobile);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $smsTime);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain')); 
		$result2 = curl_exec($ch); // This is the result from the API
		//print_r($result2);exit;
		curl_close($ch);
		//return $result2;
	}
	
	public function logout($data){
		$sql  = "INSERT INTO `tbl_login_logout_logs` (logType,userId,logTime,createdDate)
				VALUES('logout','".$data['userId']."','".$data['logoutTime']."',NOW())";
		$query = $this->db->query($sql);
		return true;
	}
	
	public function serivceTypeParameters($data) {
		$sql="SELECT t2.serviceTypeParameterId,t2.serviceTypeParameterName FROM
				`tbl_servicetype_parameter_mapping` AS t1 
				LEFT JOIN `tbl_service_type_parameters` AS t2 
				ON t1.serviceTypeParameterId = t2.serviceTypeParameterId
				WHERE serviceTypeId = '".$data['serviceTypeId']."' AND t1.deleted = 'N' AND t2.deleted = 'N'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;	
    }

    public function userRegistrationConsent($data)
    {
        date_default_timezone_set("Asia/Kolkata");

        $smsData['message'] = $data['smsContent'];

        $smsData['mobile'] = $data['mobile'];

        $this->db->insert('tbl_sms_data',$smsData);

        $data['mobile'] = '+91'.$data['mobile'];

        $data['smsContent'] = strtolower($data['smsContent']);

       if($data['smsContent'] == 'consent')
       {

      

          $mobile = substr($data['mobile'],3); 

       	 $this->db->select('userId,userUniqueId');

       	 $this->db->from('tbl_user');

       	$this->db->where(['deleted'=>'N','userVerify'=>'Y']);

       	 $this->db->where('mobileNo',$data['mobile']);

       	 $this->db->or_where('mobileNo',$mobile);


       	 $query = $this->db->get();

       	 $result = $query->result_array();

       	

       	 $query2 =  $this->db->get_where('tbl_sms_user',['deleted'=>'N','mobileNo'=>$data['mobile']]);

        $result2 = $query2->result_array();

    
       	 if(!empty($result) && empty($result2))
       	 {
       	 	

             $this->db->where('userId',$result[0]['userId']);

             $this->db->update('tbl_user',['agreeSms'=>'Y']);

       	 	$message = "Thank You for your consent to interact with Sahay.You can send STOP any time to discontinue this service";

       	 	$mobileNo = $result[0]['mobileNo'];
  
           $array = ['client_id'=>$result[0]['userUniqueId'],'mobileNo'=>$data['mobile'],'latestConsentConfirm'=>date('Y-m-d H:i:s'),'webUser'=>'Y'];

    	  $this->db->insert('tbl_sms_user',$array);

       	  }elseif (!empty($result2) && empty($result)) {
       	  
       	  	$this->db->where('id',$result2[0]['id']);

               $this->db->update('tbl_sms_user',['latestConsentConfirm'=>date('Y-m-d H:i:s'),'current_status'=>'CONSENTED']);

            $data2['mobileNo'] = $data['mobile'];

            $data2['registerFromDevice'] = 'Sms';

            $this->db->insert('tbl_user',$data2);  

            	$message = "Thank You for your consent to interact with Sahay.You can send STOP any time to discontinue this service";

       	 	$mobileNo = $data['mobile']; 

       	  }elseif (!empty($result2) && !empty($result)) {

       	  
       	  	 $this->db->where('userId',$result[0]['userId']);

             $this->db->update('tbl_user',['agreeSms'=>'Y']);

              	$this->db->where('id',$result2[0]['id']);

               $this->db->update('tbl_sms_user',['latestConsentConfirm'=>date('Y-m-d H:i:s'),'current_status'=>'CONSENTED']);

               	$message = "Thank You for your consent to interact with Sahay.You can send STOP any time to discontinue this service";

       	 	$mobileNo = $data['mobile'];

       	  }
       	 else{
       	 	
       	      $mobileNo = $data['mobile'];

       	      $message = "Thank You. Type CONFIRM and send to 9664964444 to consent to our services over SMS/call, and that you are above 18 years of age";

       	      $this->registerUserSms($data);

          }	
	
       }

       if($data['smsContent'] == 'confirm')
       {

       
          $this->db->select('userId');

       	 $this->db->from('tbl_user');

       	 $this->db->where('mobileNo',$data['mobile']);

       	 $this->db->where('deleted','N');

       	 $this->db->where('userVerify','Y');

       	 $query = $this->db->get();

       	 $result = $query->result_array();


       	  $this->db->select('id');

       	 $this->db->from('tbl_sms_user');

       	 $this->db->where('mobileNo',$data['mobile']);

       	 $this->db->where('deleted','N');

       	 $query1 = $this->db->get();

       	 $result1 = $query1->result_array();

       	 $mobileNo = $data['mobile'];

       	 if(!empty($result) && empty($result1))
       	 {
       	 	
       	 	$message = "To avail of Sahay SMS service, send CONSENT to 9664964444.";
       	 }
       	elseif(!empty($result1)){
       		
                $message = "Thank You for your consent to interact with Sahay.You can send STOP any time to discontinue this service";

               $this->db->where('id',$result1[0]['id']);

               $this->db->update('tbl_sms_user',['latestConsentConfirm'=>date('Y-m-d H:i:s'),'current_status'=>'CONSENTED']);
       	 	}else{
       	 		$message = "INVALID INPUT";
       	 	}	

         
       }	

       if($data['smsContent'] == 'stop')
       {
       	  $mobile = substr($data['mobile'],3); 
       		
       	  $this->db->select('mobileNo,userId');

       	  $this->db->from('tbl_user');

       	  $this->db->where('mobileNo',$data['mobile']);

       	  $this->db->or_where('mobileNo',$mobile);

       	  $query1 = $this->db->get();

       	  $result1 = $query1->result_array();


       	  $this->db->select('id,mobileNo');

       	 $this->db->from('tbl_sms_user');

       	 $this->db->where('mobileNo',$data['mobile']);

       	 $query2 = $this->db->get();

       	 $result2 = $query2->result_array();

       	  if(!empty($result1))
       	  {
       	  		
             $this->db->where('userId',$result1[0]['userId']);

             $this->db->update('tbl_user',['agreeSms'=>'N']); 
            
       	  	 $mobileNo = $result1[0]['mobileNo'];

       	  	 $message = "Your services for SMS has been stopped";
       	  }

       	  if(!empty($result2))
       	  {
       	  		
       	  	 $this->db->where('id',$result2[0]['id']);

       	  	 $this->db->update('tbl_sms_user',['current_status'=>'STOPPED','latestStopRequest'=>date('Y-m-d H:i:s')]);

       	  	 $mobileNo = $result2[0]['mobileNo'];

       	  	 $message = "Your services for SMS has been stopped";
       	  }

       	  if (empty($result1) && empty($result2)) {
       	  		
       	  		$mobileNo = $data['mobile'];

       	      $message = 'INVALID INPUT';
       	  	}	
       }

       if($data['smsContent'] != 'stop' && $data['smsContent'] != 'consent' && $data['smsContent'] != 'confirm')
       {
       	 
       	  $mobileNo = $data['mobile'];

       	  $message = 'INVALID INPUT';
       }

       $array = ['smsContent'=>$message,'mobile'=>$mobileNo];

       	$this->db->insert('tbl_sms_communication',$array);	


       	$mobile = $mobileNo;
		$smsContent = str_replace(' ','+',$message);
		//$smsTime = $data['smsTime'];
		//$date = date('d-m-Y').'T'.date('h:i:s');
		$smsApi = 'http://smsw.co.in/API/WebSMS/Http/v1.0a/index.php?username=codecube&password=cod123&sender=CODECB&to='.$mobile.'&message='.$smsContent.'&reqid=1&format={json|text}&route_id=route+id&callback=Any+Callback+URL&unique=0&sendondate=';
		//echo $smsApi; //exit;
		$ch = curl_init($smsApi);
		//curl_setopt($ch, CURLOPT_BUFFERSIZE, 8400000);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $smsContent);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $mobile);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $smsTime);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain')); 
		$result2 = curl_exec($ch); // This is the result from the API
		//print_r($result2);exit;
		curl_close($ch);

    }


    public function registerUserSms($data)
    {
    	 date_default_timezone_set("Asia/Kolkata");

    	 $sql = "SELECT CONCAT('SMS',IFNULL(RIGHT(CONCAT('0000',MAX(SUBSTR(client_id,4))+1),5),'00001')) AS client_id FROM `tbl_sms_user` WHERE LEFT(`client_id`,3) = 'SMS' ";

    	 $query = $this->db->query($sql);
		$result = $query->result_array();


    	$array = ['client_id'=>$result[0]['client_id'],'mobileNo'=>$data['mobile'],'latestConsentConfirm'=>date('Y-m-d H:i:s')];

    	$this->db->insert('tbl_sms_user',$array);
    }

    
    public function campReportUniqueId()
    {
        $sql = "SELECT CONCAT('CMP',IFNULL(RIGHT(CONCAT('0000',MAX(SUBSTR(camp_code_unique_id,4))+1),5),'00001')) AS campReportUniqueId FROM `tbl_camp_reports` WHERE LEFT(camp_code_unique_id,3) = 'CMP'";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result[0]['campReportUniqueId'];
    } 




   public function searchServiceProviders($data) 
	{
		$post['p_stateId']	 = $data['stateId'];	
		$post['p_districtId']	 = $data['districtId'];	
		$post['p_serviceTypeId']	 = $data['serviceTypeId'];	
		$post['p_serviceTypeParameterId']	 = $data['serviceTypeParameterId'];	
		$post['p_latLong']	 = $data['latLong'];
		//print_r($post); exit;		
		$stored = "Call proc_service_provider_search_web(?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); //exit;
		$result = $query->result_array();
		$query->free_result();
		$query->next_result();
		//echo '<pre>';print_r($result);exit;
	
		if($post['p_latLong'] == ''){
			return $result;
		}else{
			foreach($result as $value){
				//echo $value['geoLocation'];
				$geoFrom = $post['p_latLong'];
				$newLatitude = DMStoDDconvertor($value['latitude']);
				$newLongitude = DMStoDDconvertor($value['longitude']);
				$geoTo = $newLatitude.','.$newLongitude;

				$distance = $this->getDistance($geoFrom, $geoTo, "K");
				//print_r($distance);
				if($distance['range']<= 10){
					$rr[]=$value;
				}
				//$i++;
			}
		    if(!empty($rr))
			{
			return $rr;
		   }

		}
	}
	







 //     public function addUser()
 //    {
    	
 //    	 $sql = "SELECT CONCAT(LEFT(client_id,6),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(client_id,7)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(client_id,6) = (SELECT CONCAT('A2',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
	// 		WHERE t1.districtId = '".$this->input->post('addressDistrict')."')";

	// 	$query = $this->db->query($sql);	

	// 	$result = $query->result_array();

	// 	if(empty($result[0]['uniqueId']))
	// 	{
	// 		$sql1 = "SELECT CONCAT('A2',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00'),'00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$this->input->post('addressDistrict')."'";

	// 		$query1 = $this->db->query($sql1);	

	// 	   $result1 = $query1->result_array();

	// 	    $uniqueId = $result1[0]['uniqueId'];

	// 	}else{

 //           $uniqueId = $result[0]['uniqueId'];
	// 	}

	// 	//print_r($uniqueId);exit();

 //          $query2 =  $this->db->get_where('tbl_sms_user',['deleted'=>'N','mobileNo'=>'+91'.$this->input->post('mobileNo')]);

 //        $result2 = $query2->result_array();
 // /*  
 //        if(!empty($result2))
 //        {
 //        	$this->db->where('id',$result2[0]['id']);

 //        	$this->db->update('tbl_sms_user',array('client_id'=>$uniqueId,'webUser'=>'Y'));
 //        }	*/
       

 //        $post['userType'] = 'user';
 //        $post['client_id'] = $uniqueId;
 //        $post['userName'] = $this->input->post('userName');
	//     $post['password'] = md5($this->input->post('password'));
	//     $post['name'] = $this->input->post('name');
	//   //  $post['nameAlias'] = $this->input->post('nameAlias');
	//     $post['gender'] = $this->input->post('gender');
	//     $post['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
	//     $post['age'] = $this->input->post('age');
	//     $post['address'] = $this->input->post('address');
	//     $post['addressState'] = $this->input->post('addressState');
	//     $post['addressDistrict'] = $this->input->post('addressDistrict');
	//     $post['mobileNo'] = '+91'.$this->input->post('mobileNo');
	// //     $post['educationalLevel'] = $this->input->post('education');
	// //    $post['occupation'] = $this->input->post('occupation');
	// //     $post['occupation_other'] = $this->input->post('occupation1');
	// //     $post['monthlyIncome'] = $this->input->post('monthlyIncome');
	// //    $post['referralPoint'] = $this->input->post('referralPoint');
	// //    $post['referralPoint_others']  = $this->input->post('referralPoint1');
	// //     $post['maritalStatus'] =$this->input->post('maritalStatus');
	// //     $post['maritalStatus_other'] =$this->input->post('maritalStatus1');
	// //     $post['male_children'] = $this->input->post('malechildren');
	// //     $post['female_children'] = $this->input->post('femalechildren');
	// //     $post['total_children'] = $this->input->post('totalchildren');
	// //     $post['state'] = $this->input->post('state');
	// //     $post['districtId'] = $this->input->post('districtId');
	// //     //$post['secondaryIdentity'] = $this->input->post('secondaryIdentity');
	// //     //$post['secondaryIdentity_other'] = $this->input->post('secondaryIdentity_other');
 // //        $post['sexualBehaviour'] = $this->input->post('sexualBehaviour');
	// //     $post['sought'] = $this->input->post('sought');
	// //     $post['condomUsage'] = $this->input->post('condomUsage');

	// //     if($this->input->post('substanceUse'))
	// //    { $post['substanceUse'] = implode(',',$this->input->post('substanceUse'));}
	// //     $post['multipleSexPartner'] = $this->input->post('multipleSexPartner');

	// //     if(!empty($this->input->post('prefferedSexualAct')))
	// //     {
	// //     	$post['prefferedSexualAct'] = implode(',', $this->input->post('prefferedSexualAct')) ;

	// //     }	
	 
	// //     $post['pastHivReport'] = $this->input->post('pastHivReport');

	// //     if(!empty($this->input->post('fingerDate')))
	// //     {
	// //     	  $post['fingerDate'] = date('Y-m-d',strtotime($this->input->post('fingerDate'))) ;
	// //     }	
	

	// // 	$post['saictcStatus'] = $this->input->post('saictcRefer');
	// //   $post['remark'] = $this->input->post('remark');
	// //   $post['artNumber'] = $this->input->post('artNumber');
	// //   $post['cd4Result'] = $this->input->post('cd4Result');	
	// //   if(!empty($this->input->post('saictcDate')))
	// //   {
	// //   	$post['saictcDate'] = date('Y-m-d',strtotime($this->input->post('saictcDate'))) ;
	// //   }
		
	// //     $post['saictcPlace'] = $this->input->post('saictcPlace');
	// // 	$post['ictcNumber'] = $this->input->post('ictcNumber');

	// // if(!empty($this->input->post('hivDate')))	
	// // {

	// // 	 $post['hivDate'] = date('Y-m-d',strtotime($this->input->post('hivDate')));
	// // }
	// // 	$post['hivStatus'] = $this->input->post('hivStatus');

	// // 	 if(!empty($this->input->post('reportIssuedDate')))
	// // 	 {
	// // 	 	 $post['reportIssuedDate'] = date('Y-m-d',strtotime($this->input->post('reportIssuedDate'))) ;
	// // 	 }		
       
	// // 	$post['reportStatus'] = $this->input->post('reportStatus');
	// //    /* $post['testHiv'] = $this->input->post('testHiv');
	// //     $post['hivConfirmation'] = $this->input->post('hivConfirmation');*/
	// //      $post['hivTestResult'] = $this->input->post('hivTestResult');
	// //     $post['hivTestTime'] = $this->input->post('hivTestTime');
     
 // //     if(!empty($this->input->post('prefferedGender')))
 // //     {
 // //          $post['prefferedGender'] = implode(',',$this->input->post('prefferedGender')) ;
 // //     }
	   
	   
	//     $post['modeOfContact'] = 'Online';
	//   //   $post['hrg'] = $this->input->post('hrg');
	//   //   $post['arg'] = $this->input->post('arg');
	//   //  // $post['ictcUpload'] = $this->input->post(ictcUpload);

	//   //   $post['linkToArt'] = $this->input->post('artLink');

	//   // if(!empty($this->input->post('artDate')))
	//   // {  
	//   //    $post['artDate'] = $this->input->post('artDate');
	//   // }  //$post['artUpload']

	//   //  // $post['otherService'] = implode(',',$this->input->post('otherService'));

	//   //   $post['clientStatus'] = $this->input->post('clientStatus');
	//    if(!empty($result2))
 //        {
 //           $post['registerFromDevice'] = 'Sms';
 //        }else{   
	//     $post['registerFromDevice'] = 'App';
	//    }
	//     if(!empty($result2))
 //        {
 //        	$post['smsUser'] = 'Y';
 //        	$post['agreeSms'] = 'Y';
 //        } 
	//      $post['registerMode'] = 'Online';

	//      $post['registeredOn'] = date('Y-m-d');

	//     $post['registeredBy'] = $this->input->post('registeredBy');

	  	
	    
	//     $post['createdBy'] = $this->session->userdata('userId');
	//   //  $post['userVerify'] = 'Y';
	//     $post['deleted'] = 'N';
	//     $post['campCode'] = $this->input->post('campCode');

	//  //   print_r($post);exit();


	// 	$this->db->insert('tbl_user',$post);
		
	// 	$insertId = $this->db->insert_id();

	// 	return $insertId;
 //    }

	
}
