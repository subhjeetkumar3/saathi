<?php 

class Rolemasterweb extends CI_Model {

	 function __construct(){
	 	parent::__construct();
	 	   $CI = &get_instance();
        $this->db2 = $CI->load->database('db2', TRUE);
	 }

	public function eventList($type,$limit, $id) 
	{	
	   $offset = 0;	
			if ($id > 0) {
						$offset = ($id - 1) * $limit;
			}	
		$sql="SELECT eventId,eventName,eventVenue,
			DATE_FORMAT(eventDate,'%d-%b-%Y')eventDate,
			IFNULL(NULLIF(eventImage,''),'dummy_image.jpg')eventImage,
			startDate,startTime,endDate,endTime,otherInfo,website 
			FROM `tbl_event_data` WHERE deleted = 'N' AND 
			case 
			when '".$type."' = 'upcoming'
			then
			startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) OR endDate IS NULL
			when '".$type."' = 'past'
			then
		    startDate < DATE(NOW()) OR endDate < DATE(NOW())
			else
			1=1
			end";

	   if($type == 'past')
      {	
		  $sql .= " ORDER BY startDate DESC";
	  }
	  else
	  {
       $sql .= " ORDER BY startDate DESC"; 
	  }		


		/*if ($offset > 0) {
			$sql .="".$offset.",";
		}*/
		//$sql .="".$limit."";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$res = $query->result_array();

		//echo "<pre>";		

		//print_r($res);exit();
		return $res;
    }
	public function eventListCount($type) 
	{				
		$sql="SELECT count(eventName) as total
			FROM `tbl_event_data` WHERE deleted = 'N' AND 
			case when '".$type."' = 'past'
			then
			eventDate < DATE(NOW())
			when '".$type."' = 'upcoming'
			then
			eventDate >= DATE(NOW())
			else
			1=1
			end ORDER BY eventDate DESC";	
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$res = $query->result_array();		
		return $res;
    }
	
	public function quizName($id) {				
		$sql="SELECT quizName FROM  tbl_quiz_names WHERE quizId = '".$id."' AND deleted = 'N'";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res[0]['quizName'];
    }
	public function serviceProviderFeedbackDetail($id) 
	{				
		$sql="SELECT `name`,`address`,`mobile`,`email`,`skypeId`,`website` 
			FROM tbl_service_provider_details WHERE deleted = 'N' AND serviceProviderId='".$id."'";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }

    public function serviceProviderDetail($serviceProviderId)
    {
        $sql="SELECT `name`,`address`,`mobile`,`email`,`skypeId`,`website`,`qualification`,`affiliation`,`day`,`time`,`conMode`,`conCharges`,`linkage`
			FROM tbl_service_provider_details WHERE deleted = 'N' AND serviceProviderId='".$serviceProviderId."'";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }

    public function getRegistrationMode($modeId)
    {
    	$sql = "SELECT `mode` FROM tbl_registration_modes WHERE modeid = '".$modeId."' ";

    	$query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;
    }

    public function allServiceProvider()
    {
      $sql = "SELECT GROUP_CONCAT(t2.serviceTypeName) AS services,t1.uniqueId,t3.*,(SELECT stateName FROM `tbl_state` WHERE stateId = t3.state)stateName,(SELECT districtName FROM `tbl_district` WHERE districtId = t3.districtId)districtName FROM tbl_service_type_mapping AS t1 LEFT JOIN tbl_service_type AS t2 ON t1.serviceTypeId = t2.serviceTypeId LEFT JOIN tbl_service_provider_details AS t3 ON t3.uniqueId = t1.uniqueId GROUP BY t1.uniqueId;";
	 
	 $query = $this->db->query($sql);

	 $res = $query->result_array();
	
	 return $res;
    }

    public function serviceProviderServices($serviceProviderId)
    {
     /* $sql = "SELECT `t1.serviceTypeParameterName` FROM tbl_service_type_parameters AS t1 LEFT JOIN tbl_service_provider_fields AS t2 ON t1.serviceTypeParameterId = t2.serviceTypeParameterId WHERE t2.serviceProviderId = '".$serviceProviderId."' ";	*/

      $sql = "SELECT t1.serviceTypeParameterName FROM tbl_service_type_parameters  AS t1  LEFT JOIN tbl_service_provider_fields AS t2 ON 
              t1.serviceTypeParameterId = t2.serviceTypeParameterId WHERE t2.serviceProviderId = '".$serviceProviderId."' AND t2.`value` IN ('Y','Yes') 
             GROUP BY t1.serviceTypeParameterId,t2.serviceTypeParameterId ";

      $query = $this->db->query($sql);

      $result = $query->result_array();

      return $result;

    }

      public function createUser($data)
    {
    	/* $post['p_mode'] = $data['mode'];
	    $post['p_id'] = $data['id'];
	    $post['p_name'] = $data['name'];
	    $post['p_nameAlias'] = $data['nameAlias'];
	    $post['p_dob'] = $data['dob'];
	    $post['p_gender'] = $data['gender'];
	    $post['p_educationalLevel'] = $data['educationalLevel'];
	    $post['p_occupation'] = $data['occupation'];
	    $post['p_domainOfWork'] = $data['domainOfWork'];
	    $post['p_monthlyIncome'] = $data['monthlyIncome'];
	    $post['p_address'] = $data['address'];
	    $post['p_state'] = $data['state'];
	    $post['p_districtId'] = $data['districtId'];
	    $post['p_mobileNo'] = $data['mobileNo'];
	    $post['p_primaryIdentity'] = $data['primaryIdentity'];
	    $post['p_secondaryIdentity'] = $data['secondaryIdentity'];
	    $post['p_hivTest'] = $data['hivTest'];
	    $post['p_userName'] = $data['userName'];
	    $post['p_password'] = $data['password'];
	    $post['p_emailAddress'] = $data['emailAddress'];
	    $post['p_referralPoint'] = $data['referralPoint'];
	    $post['p_placeOforigin'] = $data['placeOforigin'];
	    $post['p_maritalStatus'] = $data['maritalStatus'];
	    $post['p_userId'] = $data['userId'];
	    $post['p_age'] = $data['age'];
	    $post['p_occupation1'] = $data['occupation1'];
	    $post['p_maritalStatus1'] =$data['maritalStatus1'];
	    $post['p_malechidren'] = $data['malechildren'];
	    $post['p_femalechildren'] = $data['femalechildren'];
	    $post['p_primaryIdentity1'] = $data['primaryIdentity1'];
	    $post['p_secondaryIdentity1'] = $data['secondaryIdentity1'];
	    $post['p_referralPoint1'] = $data['referralPoint1'];
	    $post['p_hivTestTime'] = $data['hivTestTime'];
	    $post['p_hivTestResult'] = $data['hivTestResult'];
	    $post['p_fingerDate'] = $data['fingerDate'];
	    $post['p_fingerReport'] = $data['fingerReport'];
	    $post['p_saictcStatus'] = $data['saictcStatus'];
	    $post['p_saictcDate'] = $data['saictcDate'];
	    $post['p_saictcPlace'] = $data['saictcPlace'];
	    $post['p_ictcNumber'] = $data['ictcNumber'];
	    $post['p_hivDate'] = $data['hivDate'];
	    $post['p_hivStatus'] = $data['hivStatus'];
	    $post['p_reportIssuedDate'] = $data['reportIssuedDate'];
	    $post['p_reportStatus'] = $data['reportStatus'];
	    $post['p_artCenter'] = $data['artCenter'];
	    $post['p_artNumber'] = $data['artNumber'];
	    $post['p_cdStatus'] = $data['cd4Status'];
	    $post['p_cd4Result'] = $data['cd4Result'];
	    $post['p_artStatus'] = $data['artStatus'];
	    $post['p_syphilisTest'] = $data['syphilisTest'];
	    $post['p_syphilisResult'] = $data['syphilisResult'];
	    $post['p_tbTest'] = $data['tbTest'];
	    $post['p_tbResult'] = $data['tbResult'];
	    $post['p_rntcpRefer'] = $data['rntcpRefer'];
	    $post['p_remark'] = $data['remark'];
	    $post['p_totalchildren'] = $data['totalchildren'];

	    $stored="Call proc_user_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);*/
		//echo $this->db->last_query();
         	$post['p_mode'] = $data['mode'];
        $post['p_id'] = $data['p_id'];
        $post['p_userId'] = $data['userId'];
        $post['p_userName'] = $data['userName'];
	    $post['p_password'] = $data['password'];
	    $post['p_name'] = $data['name'];
	    $post['p_nameAlias'] = $data['nameAlias'];
	    $post['p_gender'] = $data['gender'];
	    $post['p_dob'] = $data['dob'];
	    $post['p_age'] = $data['age'];
	    $post['p_address'] = $data['address'];
	    $post['p_addressState'] = $data['addressState'];
	    $post['p_addressDistrict'] = $data['addressDistrict'];
	    $post['p_mobileNo'] = '+91'.$data['mobileNo'];
	    $post['p_educationalLevel'] = $data['educationalLevel'];
	    $post['p_occupation'] = $data['occupation'];
	    $post['p_occupation_other'] = $data['occupation_other'];
	    $post['p_monthlyIncome'] = $data['monthlyIncome'];
	    $post['p_remark'] = $data['remark'];
	    $post['p_maritalStatus'] =$data['maritalStatus'];
	    $post['p_maritalStatus_other'] =$data['maritalStatus_other'];
	    $post['p_malechidren'] = $data['malechildren'];
	    $post['p_femalechildren'] = $data['femalechildren'];
	    $post['p_totalchildren'] = $data['totalchildren'];
	    $post['p_state'] = $data['state'];
	    $post['p_districtId'] = $data['districtId'];
	    $post['p_secondaryIdentity'] = $data['secondaryIdentity'];
	    $post['p_secondaryIdentity_other'] = $data['secondaryIdentity_other'];
        $post['p_sexualBehaviour'] = $data['sexualBehaviour'];
	    $post['p_sought'] = $data['sought'];
	    $post['p_condomUsage'] = $data['condomUsage'];
	    $post['p_substanceUse'] = $data['substanceUse'];
	    $post['p_multipleSexPartner'] = $data['multipleSexPartner'];
	    $post['p_prefferedSexualAct'] = $data['prefferedSexualAct'];
	    $post['p_pastHivReport'] = $data['pastHivReport'];
	    $post['p_testHiv'] = $data['testHiv'];
	    $post['p_hivConfirmation'] = $data['hivConfirmation'];
	    $post['p_prefferedGender'] = $data['prefferedGender'];

	  $stored="Call proc_user_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

         $query = $this->db->query($stored,$post);

		$result = $query->result_array();	
		$query->free_result();
		$query->next_result();

		//print_r($result);exit;
		return $result;

    }

    public function addUser()
    {
    	
    	 $sql = "SELECT CONCAT(LEFT(client_id,6),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(client_id,7)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(client_id,6) = (SELECT CONCAT('A1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
			WHERE t1.districtId = '".$this->input->post('addressDistrict')."')";

		$query = $this->db->query($sql);	

		$result = $query->result_array();

		if(empty($result[0]['uniqueId']))
		{
			$sql1 = "SELECT CONCAT('A1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00'),'00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$this->input->post('addressDistrict')."'";

			$query1 = $this->db->query($sql1);	

		   $result1 = $query1->result_array();

		    $uniqueId = $result1[0]['uniqueId'];

		}else{

           $uniqueId = $result[0]['uniqueId'];
		}

		//print_r($uniqueId);exit();

          $query2 =  $this->db->get_where('tbl_sms_user',['deleted'=>'N','mobileNo'=>'+91'.$this->input->post('mobileNo')]);

        $result2 = $query2->result_array();
 /*  
        if(!empty($result2))
        {
        	$this->db->where('id',$result2[0]['id']);

        	$this->db->update('tbl_sms_user',array('client_id'=>$uniqueId,'webUser'=>'Y'));
        }	*/
       

        $post['userType'] = 'user';
        $post['client_id'] = $uniqueId;
        $post['userName'] = $this->input->post('userName');
	    $post['password'] = md5($this->input->post('password'));
	    $post['name'] = $this->input->post('name');
	    $post['nameAlias'] = $this->input->post('nameAlias');
	    $post['gender'] = $this->input->post('gender');
	    $post['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
	    $post['age'] = $this->input->post('age');
	    $post['address'] = $this->input->post('address');
	    $post['addressState'] = $this->input->post('addressState');
	    $post['addressDistrict'] = $this->input->post('addressDistrict');
	    $post['mobileNo'] = '+91'.$this->input->post('mobileNo');
	    $post['educationalLevel'] = $this->input->post('education');
	   $post['occupation'] = $this->input->post('occupation');
	    $post['occupation_other'] = $this->input->post('occupation1');
	    $post['monthlyIncome'] = $this->input->post('monthlyIncome');
	   $post['referralPoint'] = $this->input->post('referralPoint');
	   $post['referralPoint_others']  = $this->input->post('referralPoint1');
	    $post['maritalStatus'] =$this->input->post('maritalStatus');
	    $post['maritalStatus_other'] =$this->input->post('maritalStatus1');
	    $post['male_children'] = $this->input->post('malechildren');
	    $post['female_children'] = $this->input->post('femalechildren');
	    $post['total_children'] = $this->input->post('totalchildren');
	    $post['state'] = $this->input->post('state');
	    $post['districtId'] = $this->input->post('districtId');
	    //$post['secondaryIdentity'] = $this->input->post('secondaryIdentity');
	    //$post['secondaryIdentity_other'] = $this->input->post('secondaryIdentity_other');
        $post['sexualBehaviour'] = $this->input->post('sexualBehaviour');
	    $post['sought'] = $this->input->post('sought');
	    $post['condomUsage'] = $this->input->post('condomUsage');

	    if($this->input->post('substanceUse'))
	   { $post['substanceUse'] = implode(',',$this->input->post('substanceUse'));}
	    $post['multipleSexPartner'] = $this->input->post('multipleSexPartner');

	    if(!empty($this->input->post('prefferedSexualAct')))
	    {
	    	$post['prefferedSexualAct'] = implode(',', $this->input->post('prefferedSexualAct')) ;

	    }	
	 
	    $post['pastHivReport'] = $this->input->post('pastHivReport');

	    if(!empty($this->input->post('fingerDate')))
	    {
	    	  $post['fingerDate'] = date('Y-m-d',strtotime($this->input->post('fingerDate'))) ;
	    }	
	

		$post['saictcStatus'] = $this->input->post('saictcRefer');
	  $post['remark'] = $this->input->post('remark');
	  $post['artNumber'] = $this->input->post('artNumber');
	  $post['cd4Result'] = $this->input->post('cd4Result');	
	  if(!empty($this->input->post('saictcDate')))
	  {
	  	$post['saictcDate'] = date('Y-m-d',strtotime($this->input->post('saictcDate'))) ;
	  }
		
	    $post['saictcPlace'] = $this->input->post('saictcPlace');
		$post['ictcNumber'] = $this->input->post('ictcNumber');

	if(!empty($this->input->post('hivDate')))	
	{

		 $post['hivDate'] = date('Y-m-d',strtotime($this->input->post('hivDate')));
	}
		$post['hivStatus'] = $this->input->post('hivStatus');

		 if(!empty($this->input->post('reportIssuedDate')))
		 {
		 	 $post['reportIssuedDate'] = date('Y-m-d',strtotime($this->input->post('reportIssuedDate'))) ;
		 }		
       
		$post['reportStatus'] = $this->input->post('reportStatus');
	   /* $post['testHiv'] = $this->input->post('testHiv');
	    $post['hivConfirmation'] = $this->input->post('hivConfirmation');*/
	     $post['hivTestResult'] = $this->input->post('hivTestResult');
	    $post['hivTestTime'] = $this->input->post('hivTestTime');
     
     if(!empty($this->input->post('prefferedGender')))
     {
          $post['prefferedGender'] = implode(',',$this->input->post('prefferedGender')) ;
     }
	   
	   
	    $post['modeOfContact'] = 'Online';
	    $post['hrg'] = $this->input->post('hrg');
	    $post['arg'] = $this->input->post('arg');
	   // $post['ictcUpload'] = $this->input->post(ictcUpload);

	    $post['linkToArt'] = $this->input->post('artLink');

	  if(!empty($this->input->post('artDate')))
	  {  
	     $post['artDate'] = $this->input->post('artDate');
	  }  //$post['artUpload']

	   // $post['otherService'] = implode(',',$this->input->post('otherService'));

	    $post['clientStatus'] = $this->input->post('clientStatus');
	   if(!empty($result2))
        {
           $post['registerFromDevice'] = 'Sms';
        }else{   
	    $post['registerFromDevice'] = 'Web';
	   }
	    if(!empty($result2))
        {
        	$post['smsUser'] = 'Y';
        	$post['agreeSms'] = 'Y';
        } 
	     $post['registerMode'] = 'Online';

	     $post['registeredOn'] = date('Y-m-d');

	    $post['registeredBy'] = $this->input->post('registeredBy');

	  	
	    
	    $post['createdBy'] = $this->session->userdata('userId');
	  //  $post['userVerify'] = 'Y';
	    $post['deleted'] = 'N';
	    $post['campCode'] = $this->input->post('campCode');

	 //   print_r($post);exit();


		$this->db->insert('tbl_user',$post);
		
		$insertId = $this->db->insert_id();

		return $insertId;
    }

    public function stateName($stateId)
    {
    	$sql="SELECT * FROM `tbl_state` WHERE deleted = 'N' AND stateId = '".$stateId."' ";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;

    }

    public function districtName($districtId)
    {
        $sql="SELECT * FROM `tbl_district` WHERE deleted = 'N' AND districtId = '".$districtId."' ";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function state() {				
		$sql="SELECT * FROM `tbl_state` WHERE deleted = 'N'";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }

      public function checkArea($currentArea)
      {
        $sql = "SELECT * FROM tbl_onground_partner_data WHERE stateId = (SELECT stateId FROM tbl_state WHERE stateName='".$currentArea."') OR districtId = (SELECT districtId FROM tbl_district WHERE districtName ='".$currentArea."')";

        $query = $this->db->query($sql);

        $res = $query->result_array();

        return $res;
      }
	
	public function getDistrict($stateId) 
    {				
		$sql="SELECT * FROM `tbl_district` WHERE deleted = 'N' AND stateId = '".$stateId."' ORDER BY districtName";	
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$res = $query->result_array();		
		return $res;
    }

     public function showMessage($optionId)
    {
  
    	sort($optionId);
        $res = $this->db->select('quizQuestionAnswer,quizQuestionId')
		       			->from('tbl_quiz_question_options')
		       			->where('deleted','N')
		       			->where_in('quizQuestionOptionId',$optionId)
		       			->get()->result_array();


			$sql="SELECT AdditionalInfoIncaseOfCorrectAnswer,AdditionalInfoInCaseOfWrongAnswer FROM tbl_quiz_questions WHERE quizQuestionId = '".$res[0]['quizQuestionId']."' AND deleted='N' ";

            $query = $this->db->query($sql);

		    $result = $query->result_array();
		    $ress['rigthAnswer'] = $this->db->select('quizQuestionOptionName')
				       		 ->from('tbl_quiz_question_options')
				       		 ->where('quizQuestionAnswer','1')
				       		 ->where('deleted','N')
				       		 ->where_in('quizQuestionId',$res[0]['quizQuestionId'])
				       		 ->get()->result_array();
			
			//print_r($ress); 

			$sqlCorrect="SELECT GROUP_CONCAT(quizQuestionOptionId)AS quizQuestionOptionId FROM tbl_quiz_question_options WHERE quizQuestionId = '".$res[0]['quizQuestionId']."' AND deleted='N' AND quizQuestionAnswer = '1' ORDER BY quizQuestionOptionId";

            $queryCorrect = $this->db->query($sqlCorrect);

		    $resultCorrect = $queryCorrect->result_array();

		    if ($resultCorrect[0]['quizQuestionOptionId'] == implode(',', $optionId)) {
		    	$naswe['youranswer'] = array('correct');
		    }else{
		    	$naswe['youranswer'] = array('wrong');
		    }

			$re = array_merge($result,$ress,$naswe);	       		 
			return $re;


/*       $sql="SELECT quizQuestionAnswer,quizQuestionId FROM tbl_quiz_question_options WHERE quizQuestionOptionId = '".$optionId."' AND deleted='N' ";

       $query = $this->db->query($sql);
		$res = $query->result_array();

		//print_r($res[0]['quizQuestionAnswer']);exit;

		if($res[0]['quizQuestionAnswer'] == 0)
		{
			$sql="SELECT AdditionalInfoInCaseOfWrongAnswer FROM tbl_quiz_questions WHERE quizQuestionId = '".$res[0]['quizQuestionId']."' AND deleted='N' ";

              $query = $this->db->query($sql);
		   //echo $this->db->last_query(); exit;
		     $result = $query->result_array();

		}
		else
		{
			 $sql="SELECT AdditionalInfoIncaseOfCorrectAnswer FROM tbl_quiz_questions WHERE quizQuestionId = '".$res[0]['quizQuestionId']."' AND deleted='N' ";

                   $query = $this->db->query($sql);
		         //echo $this->db->last_query(); exit;
		       $result = $query->result_array();

		}	

		return $result;*/


    }


    public function getOnGroundPartner($data)
    {
      $sql = "SELECT * FROM `tbl_onground_partner_data` WHERE stateId = '".$data['stateId']."' OR districtId = '".$data['districtId']."' ";

      $query = $this->db->query($sql);

      $res = $query->result_array();

      return $res;

    }

    public function getOnGroundPartnerById($id)
    {
       $query = $this->db->get_where('tbl_onground_partner_data',['deleted'=>'N','ongroundPartnerId'=>$id]);

       $result = $query->result_array();

       return $result;
    }

     public function getVoucherNumber($quizNumber)
    {
    	$sql = "SELECT voucherId,voucherNumber FROM `tbl_voucher_creation_data` WHERE uniqueQuizNumber = '".$quizNumber."' ";

    	$query = $this->db->query($sql);

    	$res = $query->result_array();

    	return $res;
    }

     public function getVoucherNumberById($id)
    {
    	$query = $this->db->get_where('tbl_voucher_creation_data',['voucherId'=>$id,'deleted'=>'N']);

    	$result = $query->result_array();

         return $result;
    }

	
	public function searchServiceProvider($data) 
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

      public function resultantMarks($details)
	{
		
         foreach ($details as $key => $value) 
         {
         	//echo $key;
         	//echo $value;
                 //exit;
         	$sql = "SELECT t1.quizQuestionAnswer,t2.MarksForEachCorrectAnswe FROM tbl_quiz_question_options AS t1 LEFT JOIN tbl_quiz_questions AS t2 ON t1.quizQuestionId = t2.quizQuestionId WHERE t1.quizQuestionId = '".$key."' AND t1.quizQuestionOptionId = '".$value."' ";
         	$query = $this->db->query($sql);

         	//echo $this->db->last_query();exit;

         	$result = $query->result_array();
                
                  //print_r($result);exit;

            $Sum[] = $result[0]['quizQuestionAnswer']*$result[0]['MarksForEachCorrectAnswe'];

         }

         $sum1 = array_sum($Sum);

         return $sum1;
	}

	
	public function getQuizTotalMarks($quizId)
	{
		$sql = "SELECT SUM(MarksForEachCorrectAnswe) AS totalMarks FROM tbl_quiz_questions WHERE quizId = '".$quizId."' ";

		$query = $this->db->query($sql);

         $result = $query->result_array();

         return $result;

	}

	public function checkUserExist($data)
	{
		$sql = "SELECT userId FROM `tbl_user` WHERE userName = '".$data['userName']."' AND deleted = 'N' AND userVerify ='Y'  ";

		$query = $this->db->query($sql);

         $result = $query->result_array();

         return $result;

	}

	public function getComments($page_id)
	{
       $query = $this->db->get_where('tbl_pages_comments',['deleted'=>'N','comment_status'=>'approved','page_id'=>$page_id,'parent_id'=>0]);

       $result = $query->result_array();


        //return $result;

      if(!empty($result))
      {	
       foreach ($result as $value) 
		{
			$this->db->select('*');

			$this->db->from('tbl_pages_comments');

			$this->db->where(['deleted'=>'N','comment_status'=>'approved','page_id'=>$page_id]);

			$this->db->where('parent_id',$value['id']);

			$query1 = $this->db->get();

			$result1 = $query1->result_array();
		}

		$result3 = array_merge($result,$result1);

      }else{
      	$result3 = $result;
      }

      

     // print_r($result3);exit();
	
        return $result3;

	}

	public function getCommentsWp($post_id)
	{
      $query =  $this->db2->get_where('wp_comments',['comment_post_ID'=>$post_id,'comment_approved'=>1]);

      $result = $query->result_array();

      return $result;
	}

	public function insertComment($data)
	{
       
		$array = array('comment'=>$data['comment'],'name'=>$data['name'],'email'=>$data['email'],'mobile'=>$data['mobile'],'website'=>$data['website'],'page_id'=>$data['pageId']);

		$this->db->insert('tbl_pages_comments',$array);

	}

	public function eventInfo($data)
	{
        $query = $this->db->get_where('tbl_event_data',['deleted'=>'N','eventId'=>$data['eventId']]);

        $result = $query->result_array();

        return $result;
	}

	public function checkVoucher($voucherNumber = '')
	{
	   $query = $this->db->get_where('tbl_voucher_creation_data',['deleted'=>'N','voucherNumber'=>$voucherNumber]);
		
		$result = $query->result_array();

		return $result;
	}

	public function updateVoucher($voucherNumber)
	{
		/*$this->db->where(['voucherNumber'=>$voucherNumber,'deleted'=>'N']);

		$this->db->update('tbl_voucher_creation_data',['deleted'=>'Y']);*/
	}
	
	public function otpVerify()
	{
		return $this->db->select('*')
				 ->from('tbl_user')
				 ->where('userId',$this->uri->segment(3))
				 ->get()
				 ->result_array();
	}

	public function updateVerify()
	{
		$this->db->where('userId',$this->uri->segment(3));
		$this->db->update('tbl_user',['userVerify'=> 'Y','deleted'=>'N']);

		
	}

	public function getContactDetail()
	{
		$data = array('name'=>$this->input->post('name'),'email'=>$this->input->post('email'),'mobile'=>$this->input->post('mobile'),'subject'=>$this->input->post('subject'),'message'=>$this->input->post('message'));
		$this->db->trans_start();

		$this->db->insert('tbl_contact_us',$data);

		$this->db->trans_complete();
	}

    public function redeemCoupon($data)
	{
        $this->db->where('voucherId',$data['voucherId']);

        $this->db->update('tbl_voucher_creation_data',['used'=>'No','ongroundPartnerId'=>$data['partnerId']]);

        return TRUE;
	}

	public function insertCommentWp($data)
	{
		$this->db->trans_start();

		$this->db2->insert('wp_comments',$data);

		$insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();


		 if(!empty($this->input->post('phone')))
        {
        	$this->db2->insert('wp_commentmeta',['comment_id'=>$insert_id,'meta_key'=>'phone','meta_value'=>$this->input->post('phone')]);
        }
	}

	public function checkMobileExist($mobile)
	{
		$this->db->select('userId');

		$this->db->from('tbl_user');

		$this->db->where('deleted','N');

		$this->db->where('mobileNo',$mobile);

		$query = $this->db->get();

		$result = $query->result_array();

		return $result;
	}

	public function checkUser($username)
	{
		$this->db->select('*');

		$this->db->from('tbl_user');

		$this->db->where('deleted','N');

		$this->db->where('userName',$username);

		$query = $this->db->get();

		$result = $query->result_array();

		return $result;
	}

	public function updateOtp($userId,$otp)
	{
		$array = ['deleted'=>'N','userId'=>$userId];
        $this->db->where($array);

        $this->db->update('tbl_user',['otp'=>$otp]);
	}

  public function getUser($userId)
  {
     $query = $this->db->get_where('tbl_user',['deleted'=>'N','userId'=>$userId]);

     $result = $query->result_array();

     return $result;
  }

  public function setPassword($data)
  {
  	  $this->db->where(['deleted'=>'N','userId'=>$data['userId']]);

  	  $this->db->update('tbl_user',['password'=>$data['password']]);
  }

  public function logout($userId,$logId)
  {
  	$array = ['userId'=>$userId,'logTime'=>date('Y-m-d h:i:s'),'loginId'=>$logId,'logInto'=>'Website'];
  	 $this->db->insert('tbl_logout_logs',$array);
  }

  public function setLogs($userId)
  {
  	  $array = ['userId'=>$userId,'logTime'=>date('Y-m-d h:i:s'),'logInto'=>'Website'];

  	  $this->db->insert('tbl_login_logs',$array);
  }

   public function insertOtp($userId,$otp)
  {
  	 $array = ['otp'=>$otp,'userId'=>$userId];

  	 $this->db->insert('tbl_otp_data',$array);
  }

  public function getLoginId($userId)
  {
        $this->db->select_max('id');

		$this->db->from('tbl_login_logs');

		$this->db->where('userId',$userId);

		$this->db->where('logInto','Website');

		$query1 = $this->db->get();

        $result1 = $query1->result_array();

        return $result1;

  }

  public function getContents()
  {
  	$this->db->select('*');

  	$this->db->from('tbl_gallery_content');

  	$this->db->where('deleted','N');

  	$this->db->order_by('createdOn','desc');

  	$query = $this->db->get();

    $result = $query->result_array();

     return $result;

  }

  public function contentInfo($contentId)
  {
  	$this->db->select('*');

  	$this->db->from('tbl_gallery_content');

  	$this->db->where('deleted','N');

  	$this->db->where('id',$contentId);

  	$this->db->order_by('createdOn','desc');

  	$query = $this->db->get();

    $result = $query->result_array();

     return $result;

  }

  public function checkUserMobile($mobileNo)
  {
  	$query = $this->db->get_where('tbl_user',['deleted'=>'N','userVerify'=>'Y','mobileNo'=>$mobileNo]);

  	 $result = $query->result_array();

     return $result;
  }

 public function getFileReport()
 {
   //echo "<pre>"; print_r($this->input->post());exit();

 	  $sql = "SELECT CONCAT(LEFT(report_unique_id,4),RIGHT(CONCAT('000',IFNULL(MAX(SUBSTR(report_unique_id,5)),0)+1),4)) AS uniqueId FROM tbl_file_reports WHERE LEFT(report_unique_id,4) = (SELECT CONCAT(IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$this->input->post('districtIncidence')."') ";

		$query = $this->db->query($sql);	

		$result = $query->result_array();

		if(empty($result[0]['uniqueId']))
		{
			$sql1 = "SELECT CONCAT(IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00'),'0001') AS uniqueId 
                      FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$this->input->post('districtIncidence')."' ";

			$query1 = $this->db->query($sql1);	

		   $result1 = $query1->result_array();

		    $uniqueId = $result1[0]['uniqueId'];

		}else{

           $uniqueId = $result[0]['uniqueId'];
		}

   $data['report_unique_id'] = $uniqueId;		

 	$data['firstName'] = $this->input->post('fname');

 	$data['lastName'] = $this->input->post('lname');

 	$data['guardian'] = $this->input->post('guardian');

 	$data['age'] = $this->input->post('age');

 	$data['mobile'] = $this->input->post('mobile');

 	$data['address'] = $this->input->post('address');

 	$data['state'] = $this->input->post('state');

 	$data['district'] = $this->input->post('district');

	 if(!empty($this->input->post('incidenceDate')))	
	  {	

	 	$data['date_of_incidence'] = date('Y-m-d',strtotime($this->input->post('incidenceDate')));
	  }
 	$data['incidence_state'] = $this->input->post('stateIncidence');

 	$data['incidence_district'] = $this->input->post('districtIncidence');

 /*if(!empty($this->input->post('incidenceReport')))	

  {	
  	$data['date_of_incidence_reported'] = date('Y-m-d',strtotime($this->input->post('incidenceReport')));
  }*/

  $data['date_of_incidence_reported'] = date('Y-m-d');

 	$data['type_of_incidence'] = $this->input->post('incidenceType');

 	$data['by_whom'] = 	$this->input->post('byWhom');

 	$data['support_required'] = $this->input->post('support');

 	$data['description'] = $this->input->post('description');

 	$data['type_of_incidence_other'] = $this->input->post('incidenceTypeOther');

 	$data['by_whom_other'] = $this->input->post('byWhomOther');

 	$data['support_required_other'] = $this->input->post('supportOther');

 	//print_r($data);exit();

 	$this->db->insert('tbl_file_reports',$data);


 	$post['mobileNo'] = $data['mobile'];


 	$insert_id =  $this->db->insert_id();

 	$otp = mt_rand(100000,999999);

 	$this->db->where('id',$insert_id);

 	$this->db->update('tbl_file_reports',['otp'=>$otp]);

     $post['smsContent'] = 'Your Sahay Violence reporting otp is '.$otp;
     //new line


 	//$this->session->set_flashdata(['completeMessage'=>$post['smsContent']]);

 		$mobile = $post['mobileNo'];
		$smsContent = str_replace(' ','+',$post['smsContent']);
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


 	return $insert_id;

 	


 }

 public function verifyFileReport($data)
 {

 	$this->db->select('id');

 	$this->db->from('tbl_file_reports');

 	$this->db->where('id',$data['reportId']);

 	$this->db->where('otp',$data['otp']);

 	$query = $this->db->get();

 	//echo $this->db->last_query();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	

 }

 public function resetFileReportOtp($data)
 {
   $otp = mt_rand(100000,999999);

 	$this->db->where('id',$data['reportId']);

 	$this->db->update('tbl_file_reports',['otp'=>$otp]);

 	$res  = $this->fileReportById($data);

     	  $post['smsContent'] = 'Your Sahay Violence reporting otp is '.$otp;


 		$mobile = $res[0]['mobile'];
		$smsContent = str_replace(' ','+',$post['smsContent']);
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

 public function fileReportVerified($data)
 {
   
 	$this->db->where('id',$data['reportId']);

 	$this->db->update('tbl_file_reports',['otpVerify'=>"Y"]);

 	$res  = $this->fileReportById($data);

 	$post['smsContent'] = 'You report with ID '.$res[0]['report_unique_id'].' has been registered with Sangraha. Please quote this number for future followup.';


 	$this->session->set_flashdata(['completeMessage'=>$post['smsContent']]);

 		$mobile = $res[0]['mobile'];
		$smsContent = str_replace(' ','+',$post['smsContent']);
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

  public function fileReportById($data)
 {
 	/*$this->db->select('t1.incidence_addressed_internal,t1.incidence_addressed_external,t1.date_of_incidence_addressed,t1.type_of_services,t1.report_unique_id,t1.method_of_resolving,t1.status,t1.description,t1.reason,t1.createdDate');*/

 	$this->db->select('t1.*,t4.stateName as incidenceState,t5.districtName as incidenceDistrict');

 	$this->db->from('tbl_file_reports as t1');


 	$this->db->join('tbl_state as t4','t1.incidence_state = t4.stateId','left');

 	$this->db->join('tbl_district as t5','t1.incidence_district = t5.districtId','left');;

 	

 	$this->db->where('t1.deleted','N');

 	$this->db->where('t1.id',$data['reportId']);


 		$query = $this->db->get();

	 	$result = $query->result_array();

				//print_r($result);exit();

		return $result;	


 }		


  public function fileReportHistory($reportId)
 {
 	$this->db->select('t1.incidence_addressed_internal,t1.incidence_addressed_external,t1.date_of_incidence_addressed,t1.type_of_services,t2.report_unique_id,t1.method_of_resolving,t1.status,t1.description,t1.reason,,t1.createdDate');

 	$this->db->from('report_audit as t1');

 	$this->db->join('tbl_file_reports as t2','t1.report_id = t2.id','left');

 	$this->db->where('t1.deleted','N');

 	$this->db->where('t2.report_unique_id',$reportId);

 	$query = $this->db->get();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	
 }

 public function fileReportData($reportId)
 {
 	/*$this->db->select('t1.incidence_addressed_internal,t1.incidence_addressed_external,t1.date_of_incidence_addressed,t1.type_of_services,t1.report_unique_id,t1.method_of_resolving,t1.status,t1.description,t1.reason,t1.createdDate');*/

 	$this->db->select('t1.*,t4.stateName as incidenceState,t5.districtName as incidenceDistrict');

 	$this->db->from('tbl_file_reports as t1');


 	$this->db->join('tbl_state as t4','t1.incidence_state = t4.stateId','left');

 	$this->db->join('tbl_district as t5','t1.incidence_district = t5.districtId','left');;

 	

 	$this->db->where('t1.deleted','N');

 	$this->db->where('t1.report_unique_id',$reportId);


 		$query = $this->db->get();

	 	$result = $query->result_array();

				//print_r($result);exit();

		return $result;	


 }

 public function checkFileReportId($fileReportId)
 {
 	$this->db->select('id');

 	$this->db->from('tbl_file_reports');

 	$this->db->where('deleted','N');

 	$this->db->where('report_unique_id',$fileReportId);

 		$query = $this->db->get();

	 	$result = $query->result_array();

				//print_r($result);exit();

		return $result;	


 }

 public function getFileReportFeedback()
 {
 		$this->db->select('id');

 	$this->db->from('tbl_file_reports');

 	$this->db->where('deleted','N');

 	$this->db->where('report_unique_id',$this->input->post('reportId'));

 		$query = $this->db->get();

	 	$result = $query->result_array();


		$this->db->select('id');

 	$this->db->from('tbl_file_reports_feedbacks');

 	$this->db->where('deleted','N');

 	$this->db->where('report_id',$result[0]['id']);

 		$query1 = $this->db->get();

	 	$result1 = $query1->result_array();


	if(!$result1[0]['id'])
	{

    $post['report_id' ] = $result[0]['id'];

    $post['part_one'] = $this->input->post('part1');

    $post['part_one_text'] = $this->input->post('parttext1');

    $post['part_two'] =  $this->input->post('part2');

    $post['part_two_text'] = $this->input->post('parttext2');

    $post['part_three'] = $this->input->post('part3');

    $post['part_three_text'] = $this->input->post('parttext3');

    $post['part_four'] = $this->input->post('part4');

    $post['part_four_text'] = $this->input->post('parttext4');

    $this->db->insert('tbl_file_reports_feedbacks',$post);

	} 	
 
   return $result1[0]['id'];
   

 }		


      
	
}
