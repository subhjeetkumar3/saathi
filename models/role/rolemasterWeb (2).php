<?php 

class Rolemasterweb extends CI_Model {

	public function eventList($type,$limit, $id) {		
			if ($id > 0) {
						$offset = ($id - 1) * $limit;
			}	
		$sql="SELECT eventName,eventVenue,
			DATE_FORMAT(eventDate,'%d-%b-%Y')eventDate,
			IFNULL(NULLIF(eventImage,''),'dummy_image.png')eventImage 
			FROM `tbl_event_data` WHERE deleted = 'N' AND 
			case when '".$type."' = 'past'
			then
			eventDate < DATE(NOW())
			when '".$type."' = 'upcoming'
			then
			eventDate >= DATE(NOW())
			else
			1=1
			end ORDER BY eventDate DESC  limit ";
		if ($offset > 0) {
			$sql .="".$offset.",";
		}
		$sql .="".$limit."";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$res = $query->result_array();		
		return $res;
    }
	public function eventListCount($type) {				
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
        $sql="SELECT `name`,`address`,`mobile`,`email`,`skypeId`,`website`,`qualification`,`affiliation`,`dayAndTime`,`conMode`,`conCharges`,`linkage`
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

    public function serviceProviderServices($serviceProviderId)
    {
     /* $sql = "SELECT `t1.serviceTypeParameterName` FROM tbl_service_type_parameters AS t1 LEFT JOIN tbl_service_provider_fields AS t2 ON t1.serviceTypeParameterId = t2.serviceTypeParameterId WHERE t2.serviceProviderId = '".$serviceProviderId."' ";	*/

      $sql = "SELECT serviceTypeParameterName FROM tbl_service_type_parameters LEFT JOIN tbl_service_provider_fields ON tbl_service_type_parameters.serviceTypeParameterId = tbl_service_provider_fields.serviceTypeParameterId WHERE tbl_service_provider_fields.serviceProviderId = '".$serviceProviderId."' GROUP BY tbl_service_type_parameters.serviceTypeParameterId,tbl_service_provider_fields.serviceTypeParameterId ";

      $query = $this->db->query($sql);

      $result = $query->result_array();

      return $result;

    }

      public function createUser($data)
    {
    	 $post['p_mode'] = $data['mode'];
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
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query();
		$result = $query->result_array();	
		$query->free_result();
		$query->next_result();

		//print_r($result);exit;
		return $result;

    }
	
	public function state() {				
		$sql="SELECT * FROM `tbl_state` WHERE deleted = 'N'";	
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function getDistrict($stateId) {				
		$sql="SELECT * FROM `tbl_district` WHERE deleted = 'N' AND stateId = '".$stateId."'";	
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$res = $query->result_array();		
		return $res;
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
	
}
