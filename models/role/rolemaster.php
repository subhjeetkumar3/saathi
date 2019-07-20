<?php 

class RoleMaster extends CI_Model {

	function __construct(){
	 	parent::__construct();
	 	   $CI = &get_instance();
        $this->db2 = $CI->load->database('db2', TRUE);
	 }

    public function validate() {
		$post['p_userName']	 = $this->input->post('userName');	
		$post['p_password']	 = $this->input->post('password');
		$stored = "Call proc_login_validation_web(?,?)";
		$query = $this->db->query($stored,$post);
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();

	//	print_r($result);exit();

      // $result1 = $this->getLoginId($result[0]['userId']);

       if($result[0]['userType'] == 'employee' || $result[0]['userType'] == 'partner' || $result[0]['userType'] == 'serviceProvider')
       {
       	
         $sql1 = "SELECT t1.rightId AS rights,t3.otherAccess FROM `tbl_usertype_rights` AS t1 
			LEFT JOIN `tbl_usertype_rights_mapping` AS t2 ON t1.`rightId` = t2.`rightId` 
                      LEFT JOIN `tbl_usertype` AS t3 ON t2.`userTypeId` = t3.`userTypeId` WHERE 
                        t3.`userTypeId` IN  (".$result[0]['roleId'].") AND t3.deleted = 'N' AND t1.deleted = 'N' AND t2.deleted = 'N'";

               $query1 = $this->db->query($sql1); 

         //echo $this->db->last_query();      
        
        $result2 = $query1->result_array();

       // echo "<pre>";

       // print_r($result2);exit();


        foreach ($result2 as $data) 
        {
            $rights[] =  $data['rights'];
         }

         $otherAccess = explode(',',$result2[0]['otherAccess']) ;  

         $this->db->select("GROUP_CONCAT(userType)userType",FALSE);

         $this->db->from('tbl_usertype');

         $this->db->where('deleted','N');

         $roles = explode(',',$result[0]['roleId']);

         $this->db->where_in('userTypeId',$roles);

        $queryNew =  $this->db->get(); 

       // echo $this->db->last_query();

        $resultNew = $queryNew->result_array();

        //print_r($resultNew);
        //exit();

        $roleType = $resultNew[0]['userType'];

       }

       if($result[0]['userType'] == 'partner')
       {
       	  $this->db->select('stateId,districtId');

       	  $this->db->from('tbl_onground_partner_data');

       	  $this->db->where('deleted','N');

       	  $this->db->where('ongroundPartnerId',$result[0]['assignedId']);

       	  $query3 = $this->db->get();

       	  $result3 = $query3->result_array();

       	  $stateId = $result3[0]['stateId'];

       	  $districtId = $result3[0]['districtId'];

       }elseif ($result[0]['userType'] == 'serviceProvider') {
      		 $this->db->select('state,districtId');

       	  $this->db->from('tbl_service_provider_details');

       	  $this->db->where('deleted','N');

       	  $this->db->where('serviceProviderId',$result[0]['assignedId']);

       	    $query3 = $this->db->get();

       	  $result3 = $query3->result_array();

       	  $stateId = $result3[0]['state'];

       	  $districtId = $result3[0]['districtId'];

       }

       //print_r($rights);exit(); 
		if($result[0]['responseCode']==0){
			return $result;
		} else if($result[0]['responseCode']==200) {
			$sessionData = array(
				'userId' => $result[0]['userId'],
				'userName' => $result[0]['userName'],
				'email' => $result[0]['emailAddress'],
				'mobile' => $result[0]['mobileNo'],	
				'userType' => $result[0]['userType'],
				'logId'=>$result1[0]['id'],
				'roleId'=>$result[0]['roleId'],
				'logInto'=>'Admin Panel',			
				'validated' => true
				);
			$this->session->set_userdata($sessionData);

			$this->session->set_userdata('rights',$rights);

			$this->session->set_userdata('otherAccess',$otherAccess);

			$this->session->set_userdata('roleType',$roleType);

			$this->session->set_userdata('stateId',$stateId);

			$this->session->set_userdata('districtId',$districtId);

            return $result;
		}
    }
	
	public function deletedTransData(){
        $sql="Update ".$this->input->post('tabelName')." set deleted='Y' 
		where ".$this->input->post('colName')."='".$this->input->post('deleteId')."'";
        $query=$this->db->query($sql);
		return $query;
    }
	
	public function deletedTransDataNew1(){
        $sql="Update ".$this->input->post('tabelName')."  set ".$this->input->post('colName')."='' 
		where id ='".$this->input->post('deleteId')."'";
        $query=$this->db->query($sql);
		return $query;
    }
	
	public function importantLinkList() {				
		$sql="SELECT * FROM `tbl_usefull_link` WHERE deleted = 'N' ";
         if($this->session->userdata('userType') == 'employee')
         {
         	$userId = $this->session->userdata('userId');
         	$sql .= " AND createdBy = '".$userId."' ";
         }	

		$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function importantLinkById($id) {				
		$sql="SELECT * FROM `tbl_usefull_link` WHERE deleted = 'N' and id=".$id."";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function addImportantLink($data) {
		$post['p_mode'] = $data['mode'];		
		$post['p_id'] = $data['id'];		
		$post['p_linkUrl'] = $this->input->post('linkUrl');		
		$post['p_description'] = $this->input->post('description');		
		$post['p_userId'] = $this->session->userdata('userId');
		$stored="Call proc_important_link_iud(?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		return $result;
    }
	
	public function smsList() {				
		$sql="SELECT *,
				CASE WHEN users = 'All'
				THEN
				'All Users'
				ELSE
				'Multiple Users'
				END 
				AS users
				FROM `tbl_sms` WHERE deleted = 'N' AND smsPath = 'formFill' ";

	  if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}				

		$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }

    public function uploadsmsList() {				
		$sql="SELECT *, CASE WHEN `to` = 'webUser' OR `to` = 'webSmsUser' OR `to` = 'common' THEN (SELECT `userUniqueId` FROM `tbl_user` WHERE `userId` = tbl_sms.`users`) ELSE (SELECT `client_id` FROM `tbl_sms_user` WHERE `id` = tbl_sms.`users`) END AS users FROM `tbl_sms` WHERE deleted = 'N' AND smsPath = 'fileImport' ";


	  if($this->session->userdata("userType") == "employee")
	    	{
	    		$userId = $this->session->userdata("userId");
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}				

		$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		$res = $query->result_array();	
		return $res;
    }

	public function smsById($id) {				
		$sql="SELECT *,
				DATE_FORMAT(`dateTime`,'%d-%m-%Y') AS `date`,
				DATE_FORMAT(`dateTime`,'%H:%i') AS `time`
				FROM tbl_sms WHERE smsId = ".$id."";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
			
		$res = $query->result_array();		
		return $res;
    }
	
	public function addSMS($data) {
		$userIds = $this->input->post('user');
		if($userIds[0] == 'All'){
			$user = $userIds[0];
		}else{
			$user = implode(',',$userIds);
		}
		$date = explode('-',$this->input->post('date'));
		$newDate = $date[2].'-'.$date[1].'-'.$date[0];
		$dateTime = $newDate.' '.$this->input->post('time');
		$post['p_mode'] = $data['mode'];		
		$post['p_id'] = $data['id'];
		$post['p_to'] = $this->input->post('to');
		$post['p_users'] = $user;
		$post['p_sendVia'] = $this->input->post('sendVia');
		$post['p_smsText'] = $this->input->post('smsText');
		$post['p_dateTime'] = $dateTime;
		$post['p_userId'] = $this->session->userdata('userId');
		$stored="Call proc_sms_iud(?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
			$query->next_result();
		$query->free_result();

		return $result;
    }
	
	public function notificationList() {				
		$sql="SELECT *,
				CASE WHEN users = 'All'
				THEN
				'All Users'
				ELSE
				'Multiple Users'
				END 
				AS users
				FROM `tbl_notification` WHERE deleted = 'N' ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}			

		$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function notificationById($id) {				
		$sql="SELECT *,
				DATE_FORMAT(`dateTime`,'%d-%m-%Y') AS `date`,
				DATE_FORMAT(`dateTime`,'%H:%i') AS `time`
				FROM tbl_notification WHERE notificationId = ".$id."";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function addNotification($data) {
		$userIds = $this->input->post('user');
		if($userIds[0] == 'All'){
			$user = $userIds[0];
		}else{
			$user = implode(',',$userIds);
		}
		
		$date = explode('-',$this->input->post('date'));
		$newDate = $date[2].'-'.$date[1].'-'.$date[0];
		$dateTime = $newDate.' '.$this->input->post('time');
		$post['p_mode'] = $data['mode'];		
		$post['p_id'] = $data['id'];
		$post['p_users'] = $user;
		$post['p_title'] = $this->input->post('title');
		$post['p_description'] = $this->input->post('description');
		$post['p_dateTime'] = $dateTime;
		$post['p_userId'] = $this->session->userdata('userId');
		$stored="Call proc_notification_iud(?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	

        $query->next_result();
		$query->free_result();    

		return $result;
    }
	
	public function userList() {				
		$sql="SELECT *,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.addressState)addressState1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.addressDistrict)addressDistrict1,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.state)state1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.districtId)district1,(SELECT userName FROM tbl_user WHERE userId = tbl_user.createdBy AND deleted = 'N' AND userVerify = 'Y')userName1 FROM `tbl_user` WHERE deleted = 'N'  ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}	

		$sql .=" ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();

		return $res;
    }

    public function activeuserList() {				
	$sql="SELECT *,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.addressState)addressState1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.addressDistrict)addressDistrict1,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.state)state1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.districtId)district1,(SELECT userName FROM tbl_user WHERE userId = tbl_user.createdBy )userName1 FROM `tbl_user` WHERE deleted = 'N' AND userVerify = 'Y' AND userType = 'user' ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}	

		/*$sql .=" AND createdDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ORDER BY createdDate DESC";*/
		$sql .= " ORDER BY userId DESC LIMIT 20";
		$query = $this->db->query($sql);
	
		$res = $query->result_array();

		return $res;
    }

    public function inactiveuserList(){
    	$sql="SELECT *,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.addressState)addressState1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.addressDistrict)addressDistrict1,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.state)state1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.districtId)district1,(SELECT userName FROM tbl_user WHERE userId = tbl_user.createdBy AND deleted = 'N' AND userVerify = 'Y')userName1 FROM `tbl_user` WHERE deleted = 'Y' AND userVerify = 'Y' AND userType = 'user' ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}	

		$sql .="   ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }

    public function filterUser($data)
    {

    	/*$sql="SELECT *,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.addressState)addressState1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.addressDistrict)addressDistrict1,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.state)state1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.districtId)district1 FROM `tbl_user` WHERE userVerify = 'Y' AND userType = 'user' ";

    	if($data['userType'] == 'active')
    	{
    		$sql .= " AND deleted = 'N' ";
    	}else{
    		$sql .= " AND deleted = 'Y' ";
    	} 

    	if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}

    	if(!empty($data['userBy']))
    	{
    		if(is_array($data['userBy']))
    		{
    			$sql .= " AND CASE WHEN createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE createdBy IN ('".implode("','",$data['userBy'])."') END";
    		}	
    		else{
    			$sql .= " AND CASE WHEN createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE createdBy IN ('".$data['userBy']."') END";
    		}
    	}

    	if(!empty($data['wildcard']))
    	{
    		$sql .= " AND userName LIKE  '%".$data['wildcard']."%' ";
    	}

    	if(!empty($data['stateFilter']))
    	{
    		$sql .= " AND addressState = '".$data['stateFilter']."' ";
    	}

    	if(!empty($data['districtFilter']))
    	{
    		$sql .= " AND addressDistrict IN (".$data['districtFilter'].") ";
    	}

    	if(!empty($data['searchData']))
    	{
    		$sql .= " AND (userUniqueId LIKE '%".$data['searchData']."%' 
    		         OR userName LIKE '%".$data['searchData']."%' OR 
    		         name LIKE '%".$data['searchData']."%' 
    		         OR nameAlias LIKE '%".$data['searchData']."%' OR domainOfWork LIKE '%".$data['searchData']."%' OR monthlyIncome LIKE '%".$data['searchData']."%' OR male_children LIKE '%".$data['searchData']."%' OR female_children LIKE '%".$data['searchData']."%' OR total_children LIKE '%".$data['searchData']."%' OR referralPoint LIKE '%".$data['searchData']."%' OR referralPoint_others LIKE '%".$data['searchData']."%' OR address LIKE '%".$data['searchData']."%' OR primaryIdentity LIKE '%".$data['searchData']."%' OR primaryIdentity_others LIKE '%".$data['searchData']."%' OR secondaryIdentity LIKE '%".$data['searchData']."%' OR secondaryIdentity_other LIKE '%".$data['searchData']."%' OR gender LIKE '%".$data['searchData']."%' OR emailAddress LIKE '%".$data['searchData']."%' OR age LIKE '%".$data['searchData']."%' OR dob LIKE '%".$data['searchData']."%' OR occupation LIKE '%".$data['searchData']."%' OR occupation_other LIKE '%".$data['searchData']."%' OR educationalLevel LIKE '%".$data['searchData']."%' OR placeOforigin LIKE '%".$data['searchData']."%' OR mobileNo LIKE '%".$data['searchData']."%' OR maritalStatus LIKE '%".$data['searchData']."%' OR maritalStatus_other LIKE '%".$data['searchData']."%' OR sought LIKE '%".$data['searchData']."%') ";
    	}		


    	$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);

	
		$res = $query->result_array();	


		return $res;*/


		$sql = "SELECT t1.*,t2.stateName as addressState1,t3.districtName as addressDistrict1,t4.stateName as state1,t5.districtName as district1 FROM tbl_user AS t1 LEFT JOIN tbl_state AS t2 ON t1.addressState = t2.stateId LEFT JOIN tbl_district AS t3 ON t1.addressDistrict = t3.districtId LEFT JOIN tbl_state AS t4 ON t1.state = t4.stateId LEFT JOIN tbl_district AS t5 ON t1.districtId = t5.districtId WHERE userVerify = 'Y' AND userType = 'user' ";

		if($data['userType'] == 'active')
    	{
    		$sql .= " AND t1.deleted = 'N' ";
    	}else{
    		$sql .= " AND t1.deleted = 'Y' ";
    	}

    	if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND t1.createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}


    	if(!empty($data['userBy']))
    	{
    		if(is_array($data['userBy']))
    		{
    			$sql .= " AND CASE WHEN t1.createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE t1.createdBy IN ('".implode("','",$data['userBy'])."') END";
    		}	
    		else{
    			$sql .= " AND CASE WHEN t1.createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE t1.createdBy IN ('".$data['userBy']."') END";
    		}
    	}

    	if(!empty($data['wildcard']))
    	{
    		$sql .= " AND userName LIKE  '%".$data['wildcard']."%' ";
    	}

    	if(!empty($data['stateFilter']))
    	{
    		$sql .= " AND addressState = '".$data['stateFilter']."' ";
    	}



    	if(!empty($data['districtFilter']))
    	{
    		$sql .= " AND addressDistrict IN (".$data['districtFilter'].") ";
    	}

    	if(!empty($data['searchData']))
    	{
    		$sql .= " AND (userUniqueId LIKE '%".$data['searchData']."%' 
    		         OR userName LIKE '%".$data['searchData']."%' OR 
    		         name LIKE '%".$data['searchData']."%' 
    		         OR nameAlias LIKE '%".$data['searchData']."%' OR domainOfWork LIKE '%".$data['searchData']."%' OR monthlyIncome LIKE '%".$data['searchData']."%' OR male_children LIKE '%".$data['searchData']."%' OR female_children LIKE '%".$data['searchData']."%' OR total_children LIKE '%".$data['searchData']."%' OR referralPoint LIKE '%".$data['searchData']."%' OR referralPoint_others LIKE '%".$data['searchData']."%' OR address LIKE '%".$data['searchData']."%' OR primaryIdentity LIKE '%".$data['searchData']."%' OR primaryIdentity_others LIKE '%".$data['searchData']."%' OR secondaryIdentity LIKE '%".$data['searchData']."%' OR secondaryIdentity_other LIKE '%".$data['searchData']."%' OR gender LIKE '%".$data['searchData']."%' OR emailAddress LIKE '%".$data['searchData']."%' OR age LIKE '%".$data['searchData']."%' OR dob LIKE '%".$data['searchData']."%' OR occupation LIKE '%".$data['searchData']."%' OR occupation_other LIKE '%".$data['searchData']."%' OR educationalLevel LIKE '%".$data['searchData']."%' OR placeOforigin LIKE '%".$data['searchData']."%' OR mobileNo LIKE '%".$data['searchData']."%' OR maritalStatus LIKE '%".$data['searchData']."%' OR maritalStatus_other LIKE '%".$data['searchData']."%' OR sought LIKE '%".$data['searchData']."%' OR sexualBehaviour LIKE '%".$data['searchData']."%' OR multipleSexPartner LIKE '%".$data['searchData']."%' OR prefferedGender LIKE '%".$data['searchData']."%' OR prefferedSexualAct LIKE '%".$data['searchData']."%' OR condomUsage LIKE '%".$data['searchData']."%' OR substanceUse LIKE '%".$data['searchData']."%' OR hivTestResult LIKE '%".$data['searchData']."%' OR hivTestResult LIKE '%".$data['searchData']."%' OR testHiv LIKE '%".$data['searchData']."%' OR pastHivReport LIKE '%".$data['searchData']."%' OR fingerDate LIKE '%".$data['searchData']."%' OR saictcStatus LIKE '%".$data['searchData']."%' OR saictcPlace LIKE '%".$data['searchData']."%' OR ictcNumber LIKE '%".$data['searchData']."%' OR hivDate LIKE '%".$data['searchData']."%' OR hivStatus LIKE '%".$data['searchData']."%' OR hivStatus LIKE '%".$data['searchData']."%' OR reportIssuedDate LIKE '%".$data['searchData']."%' OR remark LIKE '%".$data['searchData']."%' OR campCode LIKE '%".$data['searchData']."%' OR registeredOn LIKE '%".$data['searchData']."%' OR t2.stateName LIKE '%".$data['searchData']."%' OR t3.districtName LIKE '%".$data['searchData']."%' OR t4.stateName LIKE '%".$data['searchData']."%' OR t5.districtName LIKE '%".$data['searchData']."%' ) ";
    	}	
//added by subhjeet 05-06-2019
    	if(!empty($data['campCode']))
    	{
    		$sql .= " AND campCode LIKE '%".$data['campCode']."%'";
    	}	
//ended by subhjeet

    	$sql .= " ORDER BY t1.createdDate DESC";
		$query = $this->db->query($sql);

	
        
	     
		$res = $query->result_array();	


		return $res ;
    }
	
	public function eventList() {				
		$sql="SELECT * FROM `tbl_event_data` WHERE deleted = 'N' ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }

    public function pastEventList()
    {
    	$sql = "SELECT t1.*,t2.userName AS empName FROM `tbl_event_data`  AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N' AND (endDate < DATE(NOW()) OR startDate < DATE(NOW()) )";

    	if($this->session->userdata('userType') == 'employee')
    	{
    		$userId = $this->session->userdata('userId');
    		$sql .= " AND t1.createdBy = '".$userId."' ";
    	}	

    	$query = $this->db->query($sql);
       
        $res = $query->result_array();	

		return $res;        
    }

    public function filterpastEventList($data)
    {
       $sql = "SELECT * FROM `tbl_event_data`  WHERE deleted = 'N' AND (endDate < DATE(NOW()) OR startDate < DATE(NOW()) )";

         
    	if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}	


    	$query = $this->db->query($sql);
       
        $res = $query->result_array();	

		return $res;
    }

    public function upcomingEventList()
    {
    	/*$sql = "SELECT t1.*,t2.userName AS empName FROM `tbl_event_data` AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N' AND (startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) )";*/

    	$sql = "SELECT t1.*,t2.userName AS empName FROM `tbl_event_data` AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N' AND (startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) OR endDate IS NULL)";

    	if($this->session->userdata('userType') == 'employee')
    	{
    		$userId = $this->session->userdata('userId');
    		$sql .= " AND t1.createdBy = '".$userId."' ";
    	}	

    	$query = $this->db->query($sql);
       
        $res = $query->result_array();	

		return $res;
    }

    public function filterupcomingEventList($data)
    {
    	$sql = "SELECT * FROM `tbl_event_data` WHERE deleted = 'N'  AND (startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) OR endDate IS NULL)";

    	if(!empty($data['daterange1']))
    	{ 
    		$date = explode('-',$data['daterange1']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}	

    	$query = $this->db->query($sql);
       
        $res = $query->result_array();	

		return $res;
    }

    public function updateEvent($image)
    {
    	date_default_timezone_set("Asia/Kolkata");

    	/*$set = array('eventName'=>$this->input->post('eventName'),'eventVenue'=>$this->input->post('venu'),'startDate'=>date('Y-m-d',strtotime($this->input->post('startDate'))),'startTime'=>date('Y-m-d',strtotime($this->input->post('startTime'))),'endDate'=>date('Y-m-d',strtotime($this->input->post('endDate'))),'endTime'=>date('Y-m-d',strtotime($this->input->post('endTime'))),'mobileNo'=>$this->input->post('mobile'),'otherInfo'=>$this->input->post('otherInfo'),'website'=>$this->input->post('website'),'eventImage'=>$image['Image']);*/

    	$set['eventName'] = $this->input->post('eventName');

    	$set['eventVenue'] =  $this->input->post('venu');

    	$set['mobileNo']  = $this->input->post('mobile');

    	$set['otherInfo'] = $this->input->post('otherInfo');

    	$set['website'] = $this->input->post('website');

    	if(!empty($this->input->post('startDate')))
    	{
    		$set['startDate'] = date('Y-m-d',strtotime($this->input->post('startDate')));
    	}

    	if(!empty($this->input->post('startTime')))
    	{
    		$set['startTime'] = date('H:i:s',strtotime($this->input->post('startTime')));
    	}

    	if(!empty($this->input->post('endDate')))
    	{
           $set['endDate'] = date('Y-m-d',strtotime($this->input->post('endDate')));
    	}

    	if(!empty($this->input->post('endTime')))
    	{
    		$set['endTime'] = date('H:i:s',strtotime($this->input->post('endTime')));
    	}

    	if(!empty($image['Image']))
    	{
    		$set['eventImage'] = $image['Image'];
    	}	

    	$set['updatedBy'] = $this->session->userdata('userId');

    	$set['updatedDate'] = date('Y-m-d H:i:s');	



    	$where = array('eventId'=>$this->input->post('eventId'));

    	$this->db->where($where);

    	$this->db->update('tbl_event_data',$set);

    	//echo $this->db->last_query();exit();
    }
	
	
	public function ongroundPartnerList() {				
		$sql="SELECT t1.*,(SELECT stateName FROM tbl_state WHERE stateId = t1.stateId)stateName,(SELECT GROUP_CONCAT(districtName) FROM tbl_district WHERE districtId IN (t1.districtId))districtName,t2.userName AS empName FROM `tbl_onground_partner_data` AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N' ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND t1.createdBy = '".$userId."' ";
	    	}	

		$sql .=" ORDER BY t1.createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }

    public function filterongroundPartner($data)
    {
    	$sql="SELECT *,(SELECT stateName FROM tbl_state WHERE stateId = tbl_onground_partner_data.stateId)stateName,(SELECT districtName FROM tbl_district WHERE districtId = tbl_onground_partner_data.districtId)districtName FROM `tbl_onground_partner_data` WHERE deleted = 'N' ";

       
       if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}

    	if (!empty($data['states'])) 
    	{
    		$stateArr = join("','",$data['states']);
    		$sql .= " AND stateId IN ('".$stateArr."')";
    	}



    	$sql .= "ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
	
		$res = $query->result_array();		
		return $res;
    }
	
	public function getQuizQuestions() {				
		$sql="SELECT *,
				(SELECT COUNT(quizQuestionOptionId) FROM tbl_quiz_question_options WHERE quizQuestionId = tbl_quiz_questions.quizQuestionId) AS totalOptions,
				(SELECT quizQuestionOptionId FROM tbl_quiz_question_options WHERE quizQuestionId = tbl_quiz_questions.quizQuestionId LIMIT 1) AS quizQuestionOptionId,
				(SELECT quizQuestionOptionName FROM tbl_quiz_question_options WHERE quizQuestionId = tbl_quiz_questions.quizQuestionId LIMIT 1) AS quizQuestionOptionName,
				(SELECT quizQuestionAnswer FROM tbl_quiz_question_options WHERE quizQuestionId = tbl_quiz_questions.quizQuestionId LIMIT 1) AS quizQuestionAnswer
				FROM  `tbl_quiz_questions`
				WHERE deleted = 'N' AND quizId = '".$this->input->post('quizId')."' order by createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();	
		return $res;
    }
	
	public function getQuestionOptions($value) {				
		$sql="SELECT * FROM tbl_quiz_question_options 
				WHERE quizQuestionId = '".$value['quizQuestionId']."' AND deleted = 'N' AND quizQuestionOptionId != '".$value['quizQuestionOptionId']."' ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function quizNameList() {				
		$sql="SELECT t1.*,t2.userName AS empName FROM  `tbl_quiz_names` AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N'  ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND t1.createdBy = '".$userId."' ";
	    	}	

		$sql .=" ORDER BY t1.createdDate DESC";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function userById($id = NULL) {				
		$sql="SELECT * FROM `tbl_user` WHERE  userVerify = 'Y' and userId = ".$id."";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function stateList() {				
		$sql="SELECT * FROM `tbl_state` WHERE deleted = 'N' ORDER BY  stateName ASC ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function districtList() {				
		$sql="SELECT * FROM `tbl_district` WHERE deleted = 'N' ORDER BY districtName ASC ";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function getDistrict() {				
		$sql="SELECT * FROM `tbl_district` WHERE deleted = 'N' and stateId ='".$this->input->post('state')."' ORDER BY districtName";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }

    public function getStateDistrict($stateId,$districtId = '') {				
		$this->db->select('*');

		$this->db->from('tbl_district');

		$this->db->where('stateId',$stateId);

		if($districtId)
		{
			$districts = explode(',', $districtId);

		   $this->db->where_in('districtId',$districts);
		}

		$query = $this->db->get();	
		//$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function serviceProviderList() 
      {				
		/*$sql="SELECT t1.*,t2.serviceTypeName FROM `tbl_service_provider_details` AS t1 
				LEFT JOIN `tbl_service_type` AS t2 ON t1.serviceTypeId = t2.serviceTypeId
				WHERE t1.deleted = 'N' order by createdDate DESC";*/
              /*  $sql = "SELECT GROUP_CONCAT(t2.serviceTypeName) AS services,t3.uniqueId,t3.* FROM tbl_service_type_mapping AS 
                         t1 LEFT JOIN tbl_service_type AS t2 ON t1.serviceTypeId = t2.serviceTypeId LEFT JOIN 
                              tbl_service_provider_details 
                           AS t3 ON t3.serviceProviderId = t1.serviceProviderId WHERE t3.deleted = 'N' GROUP BY t1.serviceProviderId order by t3.createdDate DESC";
*/

		 $sql = "SELECT t1.*,GROUP_CONCAT((SELECT serviceTypeName FROM `tbl_service_type` WHERE serviceTypeId = t2.serviceTypeId)) services,(SELECT stateName FROM `tbl_state` WHERE stateId=t1.state)stateName,
		             (SELECT districtName FROM `tbl_district` WHERE districtId = t1.districtId)districtName,t3.userName AS empName
		               FROM tbl_service_provider_details AS t1 LEFT JOIN `tbl_service_type_mapping` AS t2 
						ON t1.`serviceProviderId` = t2.`serviceProviderId` LEFT JOIN tbl_user AS t3 ON t1.createdBy = t3.userId
						 WHERE t1.deleted = 'N' ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND t1.createdBy = '".$userId."' ";
	    	}					 


	     $sql .= " GROUP BY t1.`serviceProviderId`";                          
        

		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
            
 
     }

     public function filterServiceProvider($data)
     {
     	 $sql = "SELECT t1.*,GROUP_CONCAT((SELECT serviceTypeName FROM `tbl_service_type` WHERE serviceTypeId = t2.serviceTypeId)) services,(SELECT stateName FROM `tbl_state` WHERE stateId=t1.state)stateName,
             (SELECT districtName FROM `tbl_district` WHERE districtId = t1.districtId)districtName
               FROM tbl_service_provider_details AS t1 LEFT JOIN `tbl_service_type_mapping` AS t2 
				ON t1.`serviceProviderId` = t2.`serviceProviderId`
				 WHERE t1.deleted = 'N' ";

       if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND t1.createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}

    	if (!empty($data['states'])) 
    	{
    		$stateArr = join(",",$data['states']);
    		$sql .= ' AND state IN ("'.$stateArr.'")';
    	}



		 $sql .= "GROUP BY t1.`serviceProviderId`";                          
        

		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;

     }
	
	public function serviceTypeList() {				
		$sql="SELECT * from tbl_service_type WHERE deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function serviceProviderById($id) {				
		$sql="SELECT *,(SELECT GROUP_CONCAT(serviceTypeId) FROM `tbl_service_type_mapping` 
				WHERE serviceProviderId = tbl_service_provider_details.serviceProviderId and deleted = 'N' )serviceType,
				(SELECT GROUP_CONCAT(serviceTypeParameterId) FROM `tbl_service_provider_fields` 
				WHERE serviceProviderId = tbl_service_provider_details.serviceProviderId and deleted = 'N' and (value='Y' OR value = 'Yes')) AS serviceFields
				FROM tbl_service_provider_details WHERE serviceProviderId = ".$id."";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function modeList() {				
		$sql="SELECT * from tbl_consultation_modes WHERE deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function serviceTypeExist($name) 
	{ 
               
		if (strpos($name, ',') !== false) 
               {
                   $array = explode(',',$name);

                   //print_r($array);exit;

                    foreach ($array as $name) 
	    	   {
	    		 $this->db->select('serviceTypeId');

                       $this->db->from('tbl_service_type');

                     $this->db->where('serviceTypeName',$name);

                     $this->db->where('deleted','N');

                      $query = $this->db->get();  
                 
                     // echo $this->db->last_query();exit;

                      $result = $query->result_array();

                      return $result;
	    		
	    	  }                     
 
                }
             
	    else{	
	    	 $this->db->select('serviceTypeId');

                 $this->db->from('tbl_service_type');

                 $this->db->where('serviceTypeName',$name);

                 $this->db->where('deleted','N');

                 $query = $this->db->get();

                 //echo $this->db->last_query();exit;

                 $result = $query->result_array();
 
              return $result;
	    }	


      

		//$sql="SELECT serviceTypeId FROM `tbl_service_type` WHERE serviceTypeName = '".$name."' AND deleted = 'N' ";
		//$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		//print_r($query->result());exit;
		//$res = $query->result();
		//print_r($res);exit;
		//return $res;
    }
	
	public function getServiceUniqueId() {				
		$sql="SELECT COUNT(uniqueId) AS total FROM `tbl_service_provider_details` 
				WHERE uniqueId = '".$this->input->post('id')."' AND 
				CASE WHEN '".$this->input->post('serviceProviderId')."' = ''
				THEN
				deleted = 'N'
				ELSE
				serviceProviderId != '".$this->input->post('serviceProviderId')."' AND deleted = 'N'
				END";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	public function checkUniqueNumber($number) {				
		$sql="SELECT COUNT(uniqueId) AS total FROM `tbl_service_provider_details` 
				WHERE uniqueId = '".$number."' AND deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	public function getUserUniqueId() {				
		$sql="SELECT COUNT(userName) AS total FROM `tbl_user` 
				WHERE userName = '".$this->input->post('id')."' AND 
				CASE WHEN '".$this->input->post('userId')."' = ''
				THEN
				deleted = 'N'
				ELSE
				userId != '".$this->input->post('userId')."' AND deleted = 'N'
				END";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	public function checkStateDistrict($state,$district) {				
		$sql="SELECT t1.stateId,t2.districtId,t1.stateCode,t2.districtCode FROM `tbl_state` AS t1 
				LEFT JOIN `tbl_district` AS t2 ON t1.stateId = t2.stateId
				WHERE t1.stateName = '".$state."' AND t1.deleted = 'N' 
				AND t2.districtName = '".$district."' AND t2.deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit();
		$res = $query->result_array();		
		return $res;
    }

    public function state_by_id($stateId)
    {
    	$this->db->select('*');

    	$this->db->from('tbl_state');

    	$this->db->where('deleted','N');

    	$this->db->where_in('stateId',$stateId);

    	$query = $this->db->get();

    	$result = $query->result_array();

    	return $result;

    }

     public function district_by_id($districtId)
    {
    	$this->db->select('*');

    	$this->db->from('tbl_district');

    	$this->db->where('deleted','N');

    	$this->db->where_in('districtId',$districtId);

    	$query = $this->db->get();

    	$result = $query->result_array();

    	return $result;

    }
	
	public function conModeExist($name) {				
		$sql="SELECT modeId FROM `tbl_consultation_modes` 
				WHERE modeName = '".$name."' AND deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	public function serviceTypeParameterList() {				
		$sql="SELECT t2.serviceTypeParameterId,t2.serviceTypeParameterName FROM 
				`tbl_servicetype_parameter_mapping` AS t1
				LEFT JOIN `tbl_service_type_parameters` AS t2 
				ON t1.serviceTypeParameterId = t2.serviceTypeParameterId
				WHERE t1.serviceTypeId = '".$this->input->post('serviceTypeId')."'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	/*public function addServiceProvider($data) {

		$post['p_mode'] = $data['mode'];
		$post['p_id'] = $data['id'];	
		$post['p_serviceFields'] = implode(',',$this->input->post('serviceFields'));		
		$post['p_serviceTypeId'] = $this->input->post('serviceTypeId');		
		$post['p_uniqueId'] = $this->input->post('uniqueId');		
		$post['p_name'] = $this->input->post('name');		
		$post['p_address'] = $this->input->post('address');		
		$post['p_email'] = $this->input->post('email');		
		$post['p_officePhone'] = $this->input->post('officePhone');		
		$post['p_mobileNo'] = $this->input->post('mobileNo');		
		$post['p_skypeId'] = $this->input->post('skypeId');		
		$post['p_website'] = $this->input->post('website');		
		$post['p_latitude'] = $this->input->post('latitude');		
		$post['p_longitude'] = $this->input->post('longitude');		
		$post['p_rating'] = $this->input->post('rating');		
		$post['p_otherMobile'] = $this->input->post('otherMobile');		
		$post['p_location'] = $this->input->post('location');		
		$post['p_state'] = $this->input->post('state');		
		$post['p_districtId'] = $this->input->post('districtId');		
		$post['p_qualification'] = $this->input->post('qualification');		
		$post['p_affiliation'] = $this->input->post('affiliation');		
		$post['p_linkage'] = $this->input->post('linkage');		
		$post['p_day'] = $this->input->post('day');	
		$post['p_time']	= $this->input->post('time');
		$post['p_conMode'] = $this->input->post('conMode');		
		$post['p_conCharges'] = $this->input->post('conCharges');		
		$post['p_concession'] = $this->input->post('concession');
		$post['p_gender'] = $this->input->post('gender');		
		$post['p_userId'] = $this->session->userdata('userId');	
		
		$stored="Call proc_service_provider_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();

		return $result;
    }*/

    	public function addServiceProvider($data) {

		$post['p_mode'] = $data['mode'];
		$post['p_id'] = $data['id'];	
		$post['p_serviceFields'] = implode(',',$this->input->post('serviceFields'));		
		$post['p_serviceTypeId'] = implode(',',$this->input->post('serviceTypeId'));		
		$post['p_uniqueId'] = $this->input->post('uniqueId');		
		$post['p_name'] = $this->input->post('name');		
		$post['p_address'] = $this->input->post('address');		
		$post['p_email'] = $this->input->post('email');		
		$post['p_officePhone'] = $this->input->post('officePhone');		
		$post['p_mobileNo'] = $this->input->post('mobileNo');		
		$post['p_skypeId'] = $this->input->post('skypeId');		
		$post['p_website'] = $this->input->post('website');		
		$post['p_latitude'] = $this->input->post('latitude');		
		$post['p_longitude'] = $this->input->post('longitude');		
		$post['p_rating'] = $this->input->post('rating');		
		$post['p_otherMobile'] = $this->input->post('otherMobile');		
		$post['p_location'] = $this->input->post('location');		
		$post['p_state'] = $this->input->post('state');		
		$post['p_districtId'] = $this->input->post('districtId');		
		$post['p_qualification'] = $this->input->post('qualification');		
		$post['p_affiliation'] = $this->input->post('affiliation');		
		$post['p_linkage'] = $this->input->post('linkage');		
		$post['p_day'] = $this->input->post('day');	
		$post['p_time']	= $this->input->post('time');
		$post['p_conFace'] = $this->input->post('conFace');
		$post['p_conHome'] = $this->input->post('conHome');
		//$post['p_conHome'] = $this->input->post('conHome');
		$post['p_conTel'] = $this->input->post('conTel');
		$post['p_conEmail'] = $this->input->post('conEmail');
		$post['p_conOnline'] = $this->input->post('conOnline');		
		$post['p_conCharges'] = $this->input->post('conCharges');		
		$post['p_concession'] = $this->input->post('concession');
		$post['p_gender'] = $this->input->post('gender');		
		$post['p_userId'] = $this->session->userdata('userId');

		/*echo "<pre>";

		print_r($post);exit();	*/
		
		$stored="Call proc_service_provider_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();

		return $result;
    }
	
	public function addUser($data) 
	{
		//echo "<pre>"; print_r($this->input->post());

       $mode_of_contact = $this->input->post('modeOfContact');

    if($mode_of_contact == 'Offline one to one')
      {
        $sql = "SELECT CONCAT(LEFT(client_id,9),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(client_id,10)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(client_id,9) = (SELECT CONCAT('C1','/',IFNULL(t2.stateCode,'00'),'/',IFNULL(t1.districtCode,'00'),'/') FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
			WHERE t1.districtId = '".$this->input->post('addressDistrict')."')";
	}else{
		$sql = "SELECT CONCAT(LEFT(client_id,9),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(client_id,10)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(client_id,9) = (SELECT CONCAT('C2','/',IFNULL(t2.stateCode,'00'),'/',IFNULL(t1.districtCode,'00'),'/') FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
			WHERE t1.districtId = '".$this->input->post('addressDistrict')."')";
	}

		$query = $this->db->query($sql);	

		$result = $query->result_array();

		if(empty($result[0]['uniqueId']))
		{
		   if($mode_of_contact == 'Offline one to one')
      	 {		
			$sql1 = "SELECT CONCAT('C1','/',IFNULL(t2.stateCode,'00'),'/',IFNULL(t1.districtCode,'00'),'/','00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$this->input->post('addressDistrict')."'";
		}else{
			$sql1 = "SELECT CONCAT('C2','/',IFNULL(t2.stateCode,'00'),'/',IFNULL(t1.districtCode,'00'),'/','00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$this->input->post('addressDistrict')."'";
		}	

			$query1 = $this->db->query($sql1);	

		   $result1 = $query1->result_array();

		    $uniqueId = $result1[0]['uniqueId'];

		}else{

           $uniqueId = $result[0]['uniqueId'];
		}

          $query2 =  $this->db->get_where('tbl_sms_user',['deleted'=>'N','mobileNo'=>'+91'.$this->input->post('mobileNo')]);

        $result2 = $query2->result_array();
   
     /*   if(!empty($result2))
        {
        	$this->db->where('id',$result2[0]['id']);

        	$this->db->update('tbl_sms_user',array('client_id'=>$uniqueId,'webUser'=>'Y'));
        }	*/
       

        $post['userType'] = 'user';
        $post['client_id'] = $uniqueId;
        //$post['userName'] = $this->input->post('mobileNo');
        $post['userName'] = $uniqueId;
	    $post['password'] = md5($this->input->post('password'));
	    $post['name'] = $this->input->post('name');
	    $post['nameAlias'] = $this->input->post('nameAlias');
	    $post['gender'] = $this->input->post('gender');
    
     if($this->input->post('dob') && date('Y-m-d',strtotime($this->input->post('dob'))) != '1970-01-01')
	   { $post['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));}
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

     if(!empty($this->input->post('substanceUse')))
     {
              $post['substanceUse'] = implode(',',$this->input->post('substanceUse'));
     }	
	 
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
 
	  // $post['registrationNumber'] = $this->input->post('rnumber');
	    $post['modeOfContact'] = $this->input->post('modeOfContact');
	    $post['hrg'] = $this->input->post('hrg');
	    $post['arg'] = $this->input->post('arg');
	   // $post['ictcUpload'] = $this->input->post(ictcUpload);

	    $post['linkToArt'] = $this->input->post('artLink');

	  if(!empty($this->input->post('artDate')))
	  {  
	     $post['artDate'] = $this->input->post('artDate');
	  }  //$post['artUpload']

	   if(!empty($this->input->post('otherService')))
	  {  

	    $post['otherService'] = implode(',',$this->input->post('otherService'));

	   } 

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
	     $post['registerMode'] = $this->input->post('modeOfContact');

	    $post['registeredBy'] = $this->input->post('registeredBy');

	    if(!empty($this->input->post('registeredOn')))
	    {
	      $post['registeredOn'] = date('Y-m-d',strtotime($this->input->post('registeredOn')));	
	    }

    	if($_FILES['referralUpload']['name'])
		{
			$file_name = str_replace(" ","",$_FILES['referralUpload']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/userReferralSlip/".$file_name;

		 $move = move_uploaded_file($_FILES["referralUpload"]["tmp_name"],$file_path);

		  $post['referralSlip'] = $file_name;	


		}

		if($_FILES['artUpload']['name'])
		{
			$file_name2 = str_replace(" ","",$_FILES['artUpload']['name']);
			$file_name2 = time().$file_name2;  
			$file_path2 = "uploads/userArt/".$file_name2;

			$move2 = move_uploaded_file($_FILES["artUpload"]["tmp_name"],$file_path2);

			  $post['artUpload'] = $file_name2;	


		}		

		if($_FILES['ictcUpload']['name'])
		{
			$file_name1 = str_replace(" ","",$_FILES['ictcUpload']['name']);
			$file_name1 = time().$file_name1;  
			$file_path1 = "uploads/userIctcScan/".$file_name1;

			$move1 = move_uploaded_file($_FILES["ictcUpload"]["tmp_name"],$file_path1);

			  $post['ictcReportScan'] = $file_name1;	


		}	
    
	    $post['createdBy'] = $this->session->userdata('userId');
	    $post['userVerify'] = 'Y';
	    $post['deleted'] = 'N';

	   if(!empty($this->input->post('stateCode')))  
	   { 
	   		$post['campCode'] = $this->input->post('stateCode').'/'.$this->input->post('districtCode').'/'.$this->input->post('campCode1');
       }

	   // print_r($post);exit();


		$this->db->insert('tbl_user',$post);
		
		$insertId = $this->db->insert_id();

		return $insertId;
    }

    public function updateUser($data)
    {
    	//print_r($this->input->post());exit();

      date_default_timezone_set("Asia/Kolkata");

    	// $post['userType'] = 'user';
        //$post['userUniqueId'] = $uniqueId;
       // $post['userName'] = $this->input->post('mobileNo');
	    //$post['password'] = md5($this->input->post('password'));
	    $post['name'] = $this->input->post('name');
	    $post['nameAlias'] = $this->input->post('nameAlias');
	    $post['gender'] = $this->input->post('gender');
	   if($this->input->post('dob') || date('Y-m-d',strtotime($this->input->post('dob'))) != '1970-01-01') 
	    {
	    	$post['dob'] = date('Y-m-d',strtotime($this->input->post('dob')));
	    }else if(!$this->input->post('dob') || date('Y-m-d',strtotime($this->input->post('dob'))) != '1970-01-01'){
	    	$post['dob'] = NULL;
	    }
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
	  	 if(!empty($this->input->post('substanceUse')))
         {
             $post['substanceUse'] = implode(',',$this->input->post('substanceUse'));
         }	
	 
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
	    $post['hivTestResult'] = $this->input->post('hivTestResult');
	    $post['hivTestTime'] = $this->input->post('hivTestTime');

       if(!empty($this->input->post('prefferedGender')))
	  {

	    $post['prefferedGender'] = implode(',',$this->input->post('prefferedGender')) ;

	   } 
	   // $post['registrationNumber'] = $this->input->post('rnumber');
	    $post['modeOfContact'] = $this->input->post('modeOfContact');
	    $post['hrg'] = $this->input->post('hrg');
	    $post['arg'] = $this->input->post('arg');
	   // $post['ictcUpload'] = $this->input->post(ictcUpload);

	    $post['linkToArt'] = $this->input->post('artLink');

	  if(!empty($this->input->post('artDate')))
	  {  
	     $post['artDate'] = $this->input->post('artDate');
	  }  //$post['artUpload']

	  if(!empty($this->input->post('otherService')))
	  {
          $post['otherService'] = implode(',',$this->input->post('otherService'));
	  }	

	    $post['clientStatus'] = $this->input->post('clientStatus');
	  

	    if(!empty($this->input->post('registeredOn')))
	    {
	      $post['registeredOn'] = date('Y-m-d',strtotime($this->input->post('registeredOn')));	
	    }

	    if($_FILES['referralUpload']['name'])
		{
			$file_name = str_replace(" ","",$_FILES['referralUpload']['name']);
			$file_name = time().$file_name;  
			$file_path = "uploads/userReferralSlip/".$file_name;

		 $move = move_uploaded_file($_FILES["referralUpload"]["tmp_name"],$file_path);

		  $post['referralSlip'] = $file_name;	


		}

		if($_FILES['artUpload']['name'])
		{
			$file_name2 = str_replace(" ","",$_FILES['artUpload']['name']);
			$file_name2 = time().$file_name2;  
			$file_path2 = "uploads/userArt/".$file_name2;

			$move2 = move_uploaded_file($_FILES["artUpload"]["tmp_name"],$file_path2);

			  $post['artUpload'] = $file_name2;	


		}			

		if($_FILES['ictcUpload']['name'])
		{
			$file_name1 = str_replace(" ","",$_FILES['ictcUpload']['name']);
			$file_name1 = time().$file_name1;  
			$file_path1 = "uploads/userIctcScan/".$file_name1;

			$move1 = move_uploaded_file($_FILES["ictcUpload"]["tmp_name"],$file_path1);

			  $post['ictcReportScan'] = $file_name1;	


		}		
	    
	    $post['updatedBy'] = $this->session->userdata('userId');
	    $post['updatedDate'] = date('Y-m-d');
	   // $post['userVerify'] = 'Y';
	    //$post['deleted'] = 'N';
	  $post['campCode'] = $this->input->post('stateCode').'/'.$this->input->post('districtCode').'/'.$this->input->post('campCode1');

	  /*  echo "<pre>";

	    print_r($post);exit();*/



	    $where = array('userId'=>$this->input->post('userId'));

	    $this->db->where($where);


		$this->db->update('tbl_user',$post);
		
		
    }
	
	public function checkServiceFields($fields,$serviceType)
	{
		if($serviceType == 1)
		{
			$j = 0; $k = 10;
		 }
		  else if ($serviceType == 2)
		 {
			$j = 11; $k = 22;
		  }
		   else if ($serviceType == 3)
		   {
			  $j = 23; $k = 35;
		   }

		$t = 0;
		$m = 0;
		for($i=$j; $i<= $k; $i++)
		{
			$sql="SELECT IFNULL(t1.serviceTypeParameterId,'') AS serviceTypeParameterId,COUNT(t1.serviceTypeParameterId) AS cc FROM tbl_service_type_parameters AS t1
			LEFT JOIN tbl_servicetype_parameter_mapping AS t2 ON t1.serviceTypeParameterId = t2.serviceTypeParameterId
			WHERE t1.serviceTypeParameterName = '".$fields[$i-1]['serviceTypeParameterName']."' AND t2.serviceTypeId = '".$serviceType."'";
			$query = $this->db->query($sql);
			//echo $this->db->last_query(); exit;	
			$res = $query->result_array();	
			//print_r($res);
			if($res[0]['cc'] !=0)
			 {
				$fieldValues[] = $res[0]['serviceTypeParameterId'];
				$m++;
		     }
		     else
		     {
		     	
		     }	
			
		$t++;
		}
		if($t == $m){
			$r = implode(',',$fieldValues);
			$oo = array('status'=>'true','values' => $r);
		}else{
			//$r = implode(',',$fieldValues);
			$oo = array('status'=>'false');
		}
		return $oo;
	}
	
	public function addQuiz($data){
		//echo '<pre>';print_r($this->input->post());exit;
		$post['p_mode'] = $data['mode'];		
		$post['p_id'] = $data['id'];		
		$post['p_quizName'] = $this->input->post('quizName');		
		$post['p_quizImage'] = $data['image'];		
		$post['p_userId'] = $this->session->userdata('userId');
		$stored="Call proc_quiz_name_iud(?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();
		return $result;
	}
	
	public function quizById($id) {				
		$sql="SELECT * FROM `tbl_quiz_names` WHERE quizId = '".$id."' AND deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	public function smsTemplate() {				
		$sql="SELECT * FROM `tbl_sms_templates` WHERE deleted = 'N' ";

		if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$sql .= " AND createdBy = '".$userId."' ";
	    	}	

		$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);
		$res = $query->result_array();		
		return $res;
    }
	
	public function getUsersList() {
		if($this->input->post('to') == 'webUser'){
			$sql="SELECT * FROM `tbl_user` WHERE deleted = 'N' AND userVerify = 'Y' AND smsUser = 'N' ";

			if($this->input->post('state'))
			{
				$sql .= " AND addressState = '".$this->input->post('state')."' ";
			}

			if(!empty($this->input->post('district')))
			{
				$sql .= " AND addressDistrict IN (".implode(',',$this->input->post('district')).")";
			}

			$query = $this->db->query($sql);

			$res = $query->result_array();			
		}elseif($this->input->post('to') == 'webSmsUser'){
             $sql="SELECT * FROM `tbl_user` WHERE deleted = 'N' AND userVerify = 'Y'  ";

			if($this->input->post('state'))
			{
				$sql .= " AND addressState = '".$this->input->post('state')."' ";
			}

			if(!empty($this->input->post('district')))
			{
				$sql .= " AND addressDistrict IN (".implode(',',$this->input->post('district')).")";
			}

			$query = $this->db->query($sql);

			$res = $query->result_array();
		}elseif($this->input->post('to') == 'smsUser'){
			 $sql1 = "SELECT id as userId,mobileNo as userName,'smsUserTable' as dataTable FROM tbl_sms_user WHERE deleted = 'N' AND current_status = 'CONSENTED' AND webUser = 'N'  ";	

		   $query1 = $this->db->query($sql1);

				$res = $query1->result_array();	

		}elseif($this->input->post('to') == 'smsWebUser'){
             $sql1 = "SELECT id as userId,mobileNo as userName,'smsUserTable' as dataTable  FROM tbl_sms_user WHERE deleted = 'N' AND current_status = 'CONSENTED'  ";	

		   $query1 = $this->db->query($sql1);

				$res = $query1->result_array();	

		}else{
			$sql="SELECT *,'userTable' as dataTable FROM `tbl_user` WHERE deleted = 'N' AND userVerify = 'Y' AND smsUser = 'Y' AND agreeSms = 'Y' ";

				$query = $this->db->query($sql);

				$res = $query->result_array();			

		  /* $sql1 = "SELECT id as userId,mobileNo as userName FROM tbl_sms_user WHERE current_status != 'STOPPED' OR current_status IS NULL ";	

		   $query1 = $this->db->query($sql1);

				$result2 = $query1->result_array();	
*/
				//$res = array_merge($result1,$result2);	

			
		}	
		
		//echo $this->db->last_query(); exit;	
		
		return $res;
    }
	
	public function smsTemplateById($id) {				
		$sql="SELECT * FROM `tbl_sms_templates` WHERE smsTemplateId = '".$id."' AND deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	public function addSMSTemplate($data){
		//echo '<pre>';print_r($this->input->post());exit;
		$post['p_mode'] = $data['mode'];		
		$post['p_id'] = $data['id'];		
		$post['p_templateName'] = $this->input->post('templateName');		
		$post['p_smsContent'] = $this->input->post('smsContent');		
		$post['p_userId'] = $this->session->userdata('userId');
		$stored="Call proc_sms_template_iud(?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();
		return $result;
	}
	
	public function event($action)
	{
		//echo '<pre>';print_r($this->input->post());exit;
		$post['p_mode']       = $action['mode'];		
		$post['p_eventId']    = $action['eventId'];		
		$post['p_eventName']  = $this->input->post('eventName');		
		$post['p_venu']       = $this->input->post('venu');		
		$post['p_date']       = $this->input->post('date');		
		$post['p_mobile']     = $this->input->post('mobile');		
		$post['p_website']    = $this->input->post('website');		
		$post['p_topic']      = $this->input->post('topic');		
		$post['p_eventImage'] = $action['eventImage'];			
		$post['p_userId']     = $this->session->userdata('userId');
		$post['p_startDate'] =  $this->input->post('startDate');
		$post['p_startTime'] =  $this->input->post('startTime');
		$post['p_endDate'] = $this->input->post('endDate');
		$post['p_endTime'] = $this->input->post('endTime');
		$post['p_otherInfo'] = $this->input->post('otherInfo');

		$stored="Call proc_event_data_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();	
		return $result;
	}

	public function editEvent($data)
	{
		$sql = "SELECT eventId,eventName,eventVenue,DATE_FORMAT(eventDate,'%d-%m-%Y') AS eventDate,mobileNo,website,topic,startDate,endDate,eventImage,startTime,endTime,otherInfo FROM `tbl_event_data` WHERE eventId = '".$data['eventId']."' ";
		
        $query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res; 

	}
	
	public function checkRegistrationMode($mode) {				
		$sql="SELECT * FROM `tbl_registration_modes` WHERE `mode` = '".$mode."' AND deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }
	
	/*public function insertUserValue($data){
		//echo '<pre>';print_r($data);exit;
		$post['p_createdDate'] = $data['createdDate'];		
		$post['p_registerFromDevice'] = $data['registerFromDevice'];		
		$post['p_code'] = $data['code'];		
		$post['p_name'] = $data['name'];		
		$post['p_nameAlias'] = $data['nameAlias'];		
		$post['p_dob'] = $data['dob'];		
		$post['p_gender'] = $data['gender'];		
		$post['p_educationalLevel'] = $data['educationalLevel'];		
		$post['p_occupation'] = $data['occupation'];		
		$post['p_domainOfWork'] = $data['domainOfWork'];		
		$post['p_monthlyIncome'] = $data['monthlyIncome'];		
		$post['p_maritalStatus'] = $data['maritalStatus'];		
		$post['p_noOfChildren'] = $data['noOfChildren'];		
		$post['p_address'] = $data['address'];		
		$post['p_districtId'] = $data['districtId'];		
		$post['p_state'] = $data['state'];		
		$post['p_mobileNo'] = $data['mobileNo'];
		$post['p_primaryIdentity'] = $data['primaryIdentity'];
		$post['p_secondaryIdentity'] = $data['secondaryIdentity'];
		$post['p_referralPoint'] = $data['referralPoint'];
		$post['p_userId'] = $data['createdBy'];
		//echo '<pre>';print_r($post);exit;
		$stored="Call proc_excel_user_entry(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		return $result;
	}*/

	   public function comments($commentStatus)
	{
		$this->db->select('t1.*,t2.pageName AS pageName');

		$this->db->from('tbl_pages_comments as t1');

		$this->db->join('tbl_pages as t2','t1.page_id = t2.id');

		$this->db->where(['t1.deleted'=>'N','t1.comment_status'=>$commentStatus,'t2.deleted'=>'N']);

		$query = $this->db->get();

		return $query->result_array();
	}

	public function changeCommentStatus($data)
	{
		$this->db->where('id',$data['commentId']);

		$this->db->update('tbl_pages_comments',['comment_status'=>$data['status']]);

		return TRUE;
	}

	public function getContactRequest()
	{
		$query = $this->db->get_where('tbl_contact_us');

		$result = $query->result_array();

		return $result;
	}

    public function pendingCommentsWp()
	{
		$this->db2->select('t1.*,t2.post_title,t3.comment_status AS anotherStatus');

		$this->db2->from('ccodes_sahya.wp_comments as t1');

		$this->db2->join('ccodes_sahya.wp_posts as t2','t1.comment_post_ID = t2.ID');

        $this->db2->join('saathi.tbl_comment_status as t3','t3.comment_id = t1.comment_ID','left');  

		//$this->db2->where('comment_approved',0);

		$this->db2->order_by('comment_date','desc');

		$query = $this->db2->get();

		//print_r($query->result_array());exit();

		return $query->result_array();
	}

	public function approvedCommentsWp()
	{
		$this->db2->select('t1.*,t2.post_title');

		$this->db2->from('wp_comments as t1');

		$this->db2->join('wp_posts as t2','t1.comment_post_ID = t2.ID');

		$this->db2->where('comment_approved',1);

		$this->db2->order_by('comment_date','desc');

		$query = $this->db2->get();

		return $query->result_array();
	}

	public function changeCommentStatusWp($data)
	{
		$this->db2->where('comment_ID',$data['commentId']);

		$this->db2->update('wp_comments',['comment_approved'=>$data['status']]);

		$this->db->select('id');

		$this->db->from('tbl_comment_status');

		$this->db->where(['comment_id'=>$data['commentId'],'deleted'=>'N']);

		$query = $this->db->get();

		$result = $query->result_array();

		if(!empty($result))
		{
           $this->db->where(['deleted'=>'N','comment_id'=>$data['commentId']]);

           $this->db->update('tbl_comment_status',['comment_status'=>$data['anotherStatus'],'updatedBy'=>$this->session->userdata('userId'),'updatedOn'=>date('Y-m-d H:i:s')]);

		}else{
			$this->db->insert('tbl_comment_status',['comment_id'=>$data['commentId'],'comment_status'=>$data['anotherStatus'],'createdOn'=>$this->session->userdata('userId')]);

		}	

		return true;
	}

	 public function ongroundPartnerUniqueId()
    {
        $sql = "SELECT CONCAT('OG',IFNULL(RIGHT(CONCAT('0000',MAX(SUBSTR(ongroundPartnerUniqueId,3))+1),5),'00001')) AS ongroundPartnerUniqueId FROM `tbl_onground_partner_data` WHERE LEFT(ongroundPartnerUniqueId,2) = 'OG'";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result[0]['ongroundPartnerUniqueId'];
    }

     public function serviceProviderUniqueId()
    {
    	$sql = "SELECT CONCAT('SP',IFNULL(RIGHT(CONCAT('0000',MAX(SUBSTR(`uniqueId`,3))+1),5),'00001')) AS `uniqueId` FROM `tbl_service_provider_details` WHERE LEFT(`uniqueId`,2) = 'SP'";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result[0]['uniqueId'];
    }

     public function getMobile($user)
    {
    	$sql = "SELECT mobileNo FROM `tbl_user` WHERE deleted = 'N' AND userId = '".$user."' ";

    	$query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;
    }

     public function getMobileUsers($user,$to)
    {
      if($to == 'webUser' || $to == 'webSmsUser' || $to == 'common')
      {	
      	$this->db->select('mobileNo');

      	$this->db->from('tbl_user');

      	$this->db->where('deleted','N');

      	$this->db->where_in('userId',$user);

      	$query = $this->db->get();
    	$result = $query->result_array();

     }else{
     	/*$sql = "SELECT mobileNo FROM `tbl_sms_user` WHERE deleted = 'N' AND id = '".$user."' ";

    	$query = $this->db->query($sql);
*/        
    		$this->db->select('mobileNo');

      	$this->db->from('tbl_sms_user');

      	$this->db->where('deleted','N');

      	$this->db->where_in('id',$user);

      	$query = $this->db->get();
    
    	$result = $query->result_array();

     }	

    	return $result;
    }

    public function logs()
    {
    	$this->db->select('`t1`.`id`,t1.logInto,`t2`.`userName`,t3.`loginId`,t1.`createdDate` AS loginTime,t3.`createdDate` AS logoutTime');

    	$this->db->from('tbl_login_logs as t1');

    	$this->db->join('tbl_logout_logs as t3','t3.loginId = t1.id','left');

    	$this->db->join('tbl_user as t2','t1.userId = t2.userId','left');

    	$this->db->where('t2.deleted','N');

    	$query = $this->db->get();

    	$result = $query->result_array();

    	return $result;
    }

    public function loggedInLogs()
    {
    	$query = $this->db->get_where('ci_sessions',['user_data !='=>'']);

  	     $result = $query->result_array();

  	      return $result;
    }


    public function ongroundPartnerById($ongroundPartnerId)
  {
  	$query = $this->db->get_where('tbl_onground_partner_data',['deleted'=>'N','ongroundPartnerId'=>$ongroundPartnerId]);
  	$result = $query->result_array();

     	return $result;
  }

  public function updatePartner()
  {

  	 $array = ['name'=>$this->input->post('name'),'address'=>$this->input->post('address'),'officePhone'=>$this->input->post('officePhone'),'mobile'=>$this->input->post('mobile'),'email'=>$this->input->post('email'),'latitude'=>$this->input->post('latitude'),'longtitute'=>$this->input->post('longitude'),'stateId'=>$this->input->post('state'),'districtId'=>implode(',',$this->input->post('district')),'location'=>$this->input->post('location'),'dayAndTime'=>$this->input->post('dayAndTime')];

  	 $this->db->where(['deleted'=>'N','ongroundPartnerId'=>$this->input->post('partnerId')]);

  	 $this->db->update('tbl_onground_partner_data',$array);

  	// echo $this->db->last_query();exit();

  	 return true;
  }

   public function serviceProviderVouchers()
     {
         $this->db->select('t1.*,t2.name as serviceProviderName,t3.userName as userName');

         $this->db->from('tbl_voucher_creation_data as t1');

         $this->db->join('tbl_service_provider_details as t2','t1.categoryId = t2.serviceProviderId');

         $this->db->join('tbl_user as t3','t1.userId = t3.userId');

         $this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t3.deleted'=>'N']);

       /*  if($this->session->userdata('userType') == 'employee')
	    	{
	    		$userId = $this->session->userdata('userId');
	    		$this->db->where();
	    	}	*/

         $query = $this->db->get();

         $result = $query->result_array();

         return $result;
     }

     public function quizVouchers()
     {
     	$this->db->select('t1.*,t2.quizName,t3.name as partnerName,t4.userName,t5.quizTotalMarks');

     	$this->db->from('tbl_voucher_creation_data as t1');

     	$this->db->join('tbl_quiz_names as t2','t1.categoryId = t2.quizId');

     	$this->db->join('tbl_onground_partner_data as t3','t1.ongroundPartnerId = t3.ongroundPartnerId','left');

     	$this->db->join('tbl_user as t4','t1.userId = t4.userId');

     	$this->db->join('tbl_quiz_question_result_details as t5','t1.uniqueQuizNumber = t5.quizUniqueNumber');

     	$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t4.deleted'=>'N','t5.deleted'=>'N']);

     	$this->db->where("(t3.deleted = 'N' OR t3.deleted IS NULL)");

     	$query = $this->db->get();

     	//echo $this->db->last_query();exit();

     	$result = $query->result_array();

     	return $result;
     }


    public function filterServiceVoucher($data)
  {
  	   $this->db->select('t1.*,t2.name as serviceProviderName,t3.userName as userName');

         $this->db->from('tbl_voucher_creation_data as t1');

         $this->db->join('tbl_service_provider_details as t2','t1.categoryId = t2.serviceProviderId');

         $this->db->join('tbl_user as t3','t1.userId = t3.userId');

         $this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t3.deleted'=>'N']);

        if(!empty($data['daterange']))
        { 
         $date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

         $this->db->where("voucherDate BETWEEN '".$startDate."' and '".$endDate."' ");

        } 
        
        if($data['filter'] == 'userwise')
        {
        	$this->db->where_in('t1.userId',$data['dataName']);
        }

        if($data['filter'] == 'serviceProvider')
        {
        	$this->db->where_in('t1.categoryId',$data['dataName']);
        }

        if($data['filter'] == 'claimed')
        {
        	$this->db->where('used','Yes');
        }

        if($data['filter'] == 'unclaimed')
        {
        	$this->db->where('used','No');
        }	

         $query = $this->db->get();

         $result = $query->result_array();

         return $result;


  }

  public function filterGiftCoupon($data)
  {
  	$this->db->select('t1.*,t2.quizName,t3.name as partnerName,t4.userName,t5.quizTotalMarks');

     	$this->db->from('tbl_voucher_creation_data as t1');

     	$this->db->join('tbl_quiz_names as t2','t1.categoryId = t2.quizId');

     	$this->db->join('tbl_onground_partner_data as t3','t1.ongroundPartnerId = t3.ongroundPartnerId','left');

     	$this->db->join('tbl_user as t4','t1.userId = t4.userId');

     	$this->db->join('tbl_quiz_question_result_details as t5','t1.uniqueQuizNumber = t5.quizUniqueNumber');

     	$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t4.deleted'=>'N','t5.deleted'=>'N']);

     	$this->db->where("(t3.deleted = 'N' OR t3.deleted IS NULL)");

        if(!empty($data['daterange']))
        { 	
     	  $date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

         $this->db->where("voucherDate BETWEEN '".$startDate."' and '".$endDate."' ");

        }

         if($data['filter'] == 'userwise')
        {
        	$this->db->where_in('t1.userId',$data['dataName']);
        }

        if($data['filter'] == 'ongroundPartner')
        {
        	$this->db->where_in('t1.ongroundPartnerId',$data['dataName']);
        }

        if($data['filter'] == 'contestWise')
        {
        	$this->db->where_in('categoryId',$data['dataName']);
        }


        if($data['filter'] == 'claimed')
        {
        	$this->db->where('used','Yes');
        }

        if($data['filter'] == 'unclaimed')
        {
        	$this->db->where('used','No');
        }	 

     	$query = $this->db->get();

     	$result = $query->result_array();

     	return $result;
  }

	  public function filterLogs($data)
	  {
          $this->db->select('`t1`.`id`,t1.logInto,`t2`.`userName`,t3.`loginId`,t1.`createdDate` AS loginTime,t3.`createdDate` AS logoutTime');

    	$this->db->from('tbl_login_logs as t1');

    	$this->db->join('tbl_logout_logs as t3','t3.loginId = t1.id','left');

    	$this->db->join('tbl_user as t2','t1.userId = t2.userId','left');

    	$this->db->where('t2.deleted','N');

    	$this->db->where("t1.createdDate BETWEEN '".$data['startDate']."' AND '".$data['endDate']."' ");

    	$query = $this->db->get();

    	$result = $query->result_array();

    	return $result;
	  }

	  public function staff()
	  {
	  	  $this->db->select('t1.*,t2.userName as empName');

	  	  $this->db->from('tbl_user as t1');

	  	  $this->db->join('tbl_user as t2','t1.createdBy = t2.userId','left');

	  	//  $this->db->join('tbl_usertype as t3','t1.roleId = t3.userTypeId','left');

	  	  $this->db->where(['t1.deleted'=>'N']);

	  	  $userType =  array('employee','partner','serviceProvider');

	  	  $this->db->where_in('t1.userType',$userType);

	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

	  	 // echo "<pre>"; print_r($result);exit();

    	  return $result;
	  }

	   public function filterStaff($data)
	  {
	  	  $this->db->select('t1.*,t2.userName as empName,t3.userType');

	  	  $this->db->from('tbl_user as t1');

	  	  $this->db->join('tbl_user as t2','t1.createdBy = t2.userId','left');

	  	  $this->db->join('tbl_usertype as t3','t1.roleId = t3.userTypeId','left');

	  	  $this->db->where(['t1.deleted'=>'N','t1.userType'=>'employee','t3.deleted'=>'N']);

	  	  if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		//$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."' " ;

    	  $this->db->where("t1.createdDate BETWEEN '".$startDate."' AND '".$endDate."'");	
    	}

    	if(!empty($data['userBy']))
    	{
    		if(is_array($data['userBy']))
    		{
    			//$sql .= " AND CASE WHEN createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE createdBy IN ('".implode("','",$data['userBy'])."') END";

    		 /* $this->db->where("CASE WHEN createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE createdBy IN ('".implode("','",$data['userBy'])."') END");	*/

    		$this->db->where_in('t1.createdBy',$data['userBy']); 
    		}	
    		else{
    			//$sql .= " AND CASE WHEN createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE createdBy IN ('".$data['userBy']."') END";

    			//$this->db->where("CASE WHEN createdBy IS NULL THEN userId = '".$data['userBy']."' ELSE createdBy IN ('".$data['userBy']."') END");
    		 $this->db->where('t1.createdBy',$data['userBy']);	
    		}
    	}

    	if(!empty($data['wildcard']))
    	{
    		//$sql .= " AND userName LIKE  '%".$data['wildcard']."%' ";

    		$this->db->where("t1.userName LIKE  '%".$data['wildcard']."%'");
    	}	



	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;
	  }

	  public function createStaff()
	  {

	  	 $data['userName'] = $this->input->post('uname');

	  	$data1['assignedWith']  = $this->input->post('assignedWith');

	  	$data1['userTypeNew']  = $this->input->post('userTypeNew');
	  	
	  	if($data1['userTypeNew'] == 'partner')
	  	{
          $data['userType'] = $data1['userTypeNew'];
	  	}else if($data1['userTypeNew'] == 'serviceProvider')
	  	 {
            $data['userType'] = $data1['userTypeNew'];
	  	 }else{
          
	  	   $data['userType'] = 'employee';
	  	 } 

	  	// $data['roleId'] =  implode(',',$this->input->post('role'));

	  	 $data['roleId'] = $this->input->post('role');

	  	 $data['assignedId'] = $data1['assignedWith'];

	  	 $data['name'] = $this->input->post('name');

	  	 $data['emailAddress'] = $this->input->post('email');

	  	 $data['mobileNo'] = $this->input->post('mobile');

	  	 $data['password'] = $this->input->post('password');

	  	 $data['registerFromDevice'] = 'Web';

	  	 $data['registerMode'] = 'Online';

	  	 $data['modeOfContact'] = 'Online';

	  	 $data['createdBy'] = $this->session->userdata('userId');

	  	 $data['userVerify'] = 'Y';

	  	 //print_r($data);exit();

	  	 $this->db->insert('tbl_user',$data);

	  	 $insertId = $this->db->insert_id();

	  	 return $insertId;

	  }

	  public function staffById($staffId)
	  {
	  	$query =  $this->db->get_where('tbl_user',['deleted'=>'N','userId'=>$staffId]);

	  	 $result = $query->result_array();

    	  return $result;
	  }

	  public function updateStaff()
	  {
	  	 $where = ['deleted'=>'N','userId'=>$this->input->post('staffId')];

	  	 $set = ['name'=>$this->input->post('name'),'mobileNo'=>$this->input->post('mobile'),'emailAddress'=>$this->input->post('email'),'roleId'=>$this->input->post('role'),'password'=>$this->input->post('password'),'updatedBy'=>$this->session->userdata('userId'),'updatedDate'=>date('Y-m-d H:i:s')];

	  	 $this->db->where($where);

	  	 $this->db->update('tbl_user',$set);

	  	  	$data1['assignedWith']  = $this->input->post('assignedWith');

	  	$data1['userTypeNew']  = $this->input->post('userTypeNew');
	  	
	  	if($data1['userTypeNew'] == 'partner')
	  	{
          $data['userType'] = $data1['userTypeNew'];
	  	}else if($data1['userTypeNew'] == 'serviceProvider')
	  	 {
            $data['userType'] = $data1['userTypeNew'];
	  	 }else{
          
	  	   $data['userType'] = 'employee';
	  	 }


	  	 $data['assignedId'] =  $data1['assignedWith'];

	  	

	  	 $this->db->where($where);

	  	 $this->db->update('tbl_user',$data);
	  }

	  public function rights()
	  {
	  	 $this->db->select('*');

	  	 $this->db->from('tbl_usertype_rights');

	  	 $this->db->where(['deleted'=>'N']);

	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;
	  }

	  public function roles()
	  {
	  	 $query = $this->db->get_where('tbl_usertype',['deleted'=>'N']);

	  	  $result = $query->result_array();

    	  return $result;
	  }



	  public function userSms()
	  {
	  	 $this->db->select('*');

	  	 $this->db->from('tbl_sms_communication');

	  	 $this->db->where(['deleted'=>'N']);

	  	 $this->db->where('createDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW()');

	  	 $this->db->order_by('createDate','desc');

	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;
	  }

	   public function filterUserSms()
	  {
	  	 $this->db->select('*');

	  	 $this->db->from('tbl_sms_communication');

	  	 $this->db->where(['deleted'=>'N']);

	  	// $this->db->where('createDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW()');

	  	 if(!empty($data['daterange']))
    	{ 
    		$date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		//$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."' " ;

    	  $this->db->where("createdDate BETWEEN '".$startDate."' AND '".$endDate."'");	
    	}


	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;
	  }

	public function campPeopleScreened($campCode)
	{
       $this->db->select('count(userId)count');

       $this->db->from('tbl_user');

       $this->db->where('campCode',$campCode);

       $this->db->where('(fingerDate IS NOT NULL OR fingerDate != " ")');

         $query = $this->db->get();

	  	  $result = $query->result_array();

	  	  //print_r($result);exit();

    	  return $result;


	}  

	public function campPeopleStr($campCode)
	{
       $this->db->select('count(userId)count');

       $this->db->from('tbl_user');

       $this->db->where('campCode',$campCode);

       $this->db->where('saictcStatus','Yes');

         $query = $this->db->get();

         //echo $this->db->last_query();exit();

	  	  $result = $query->result_array();

    	  return $result;


	}

  public function downloadUserSms()
  {
  	 $this->db->select('smsContent,mobile,DATE_FORMAT(createDate,"%d %M %Y")',FALSE);

	  	 $this->db->from('tbl_sms_communication');

	  	 $this->db->where(['deleted'=>'N']);

	  	// $this->db->where('createDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW()');

	  	 $this->db->order_by('createDate','desc');

	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;

  }


   public function downloadSmsUser()
   {

   	  $this->db->select('mobileNo,DATE_FORMAT(latestConsentConfirm,"%d %M %Y"),TIME_FORMAT(latestConsentConfirm, "%h:%i %p"),DATE_FORMAT(latestStopRequest,"%d %M %Y"),TIME_FORMAT(latestStopRequest, "%h:%i %p"),IFNULL(current_status,"UNCONFIRM")',FALSE);

	  	 $this->db->from('tbl_sms_user');

	  	 $this->db->where(['deleted'=>'N']);

	  	// $this->db->where('createDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW()');

	  	 //$this->db->order_by('createdOn','desc');

	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;

   }  


    public function downloadEventData()
    {
    	$sql = "SELECT `eventName`, `eventVenue`, DATE_FORMAT(startDate, '%d %M %Y') AS startDate,TIME_FORMAT(startTime, '%h:%i %p') AS startTime,DATE_FORMAT(endDate, '%d %M %Y') AS endDate, TIME_FORMAT(endTime, '%h:%i %p') AS endTime,`mobileNo`, `website`,`otherInfo`,DATE_FORMAT(createdDate, '%d %M %Y') AS createdDate FROM (`tbl_event_data`) WHERE `deleted` = 'N' ";

    	if($this->input->post('exceleventType') == 'upcoming')
    	{
    		$sql .= " AND (startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) ) ";
    	}else{
    		$sql .= " AND  (endDate < DATE(NOW()) OR startDate < DATE(NOW()) ) ";
    	}


       if(!empty($this->input->post('exceldaterange')))
    	{ 
    		$date = explode('-',$this->input->post('exceldaterange'));

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}          

         if(!empty($this->input->post('exceldaterange1')))
    	{ 
    		$date = explode('-',$this->input->post('exceldaterange1'));

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}          	

    	$query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;
    }

    public function downloadUserData()
    {
    	$sql = "SELECT DATE_FORMAT(registeredOn,'%d/%m/%Y')registeredOn,campCode,registeredBy,client_id,modeOfContact,`userName`,`name`,`nameAlias`,DATE_FORMAT(`dob`,'%d/%m/%Y')dob,`age`,gender,educationalLevel,`occupation`,`occupation_other`,hrg,arg,
              `monthlyIncome`,`maritalStatus`,`maritalStatus_other`,`male_children`,`female_children`,`total_children`,`address`,(SELECT `stateName` FROM `tbl_state` WHERE `stateId` = tbl_user.`addressState`)addressState,(SELECT `districtName` FROM `tbl_district` WHERE `districtId` = tbl_user.`addressDistrict`)addressDistrict,(SELECT `stateName` FROM `tbl_state` WHERE `stateId` = tbl_user.`state`)state,(SELECT `districtName` FROM `tbl_district` WHERE `districtId` = tbl_user.`districtId`)districtId,`mobileNo`,referralPoint,referralPoint_others,`sexualBehaviour`,`multipleSexPartner`,`sought`,`prefferedGender`,`prefferedSexualAct`,condomUsage,`substanceUse`,`testHiv`,`hivTestResult`,`pastHivReport`,hivTestTime,pastHivReport,DATE_FORMAT(fingerDate,'%d/%m/%Y')fingerDate,saictcStatus,DATE_FORMAT(saictcDate,'%d/%m/%Y')saictcDate,saictcPlace,ictcNumber,DATE_FORMAT(hivDate,'%d/%m/%Y')hivDate,hivStatus,DATE_FORMAT(reportIssuedDate,'%d/%m/%Y')reportIssuedDate,reportStatus,`remark`,linkToArt,DATE_FORMAT(artDate,'%d/%m/%Y')artDate,artNumber,cd4Result,otherService,clientStatus,DATE_FORMAT(createdDate, '%d/%m/%Y') AS createdDate,artUpload,ictcReportScan,referralSlip FROM `tbl_user` WHERE  userType = 'user' AND userVerify = 'Y' ";
/*
          $sql = "SELECT artUpload,ictcReportScan,referralSlip FROM `tbl_user` WHERE  userType = 'user' AND userVerify = 'Y' ";     */

         if ($this->input->post('excelPage') == 'active') {
               	$sql .= " AND deleted = 'N' ";

               }else{
               	$sql .= "AND deleted = 'Y' ";
               }


       if(!empty($this->input->post('exceldaterange')))
    	{ 
    		$date = explode('-',$this->input->post('exceldaterange'));

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}          

         if(!empty($this->input->post('exceldaterange1')))
    	{ 
    		$date = explode('-',$this->input->post('exceldaterange1'));

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}


           
    	if(!empty($this->input->post('userBy')))
    	{
    		if(is_array($data['userBy']))
    		{
    			$sql .= " AND CASE WHEN createdBy IS NULL THEN userId = '".$this->input->post('userBy')."' ELSE createdBy IN ('".implode("','",$this->input->post('userBy'))."') END";
    		}	
    		else{
    			$sql .= " AND CASE WHEN createdBy IS NULL THEN userId = '".$this->input->post('userBy')."' ELSE createdBy IN ('".$this->input->post('userBy')."') END";
    		}
    	}

    	if(!empty($this->input->post('wildcard')))
    	{
    		$sql .= " AND userName LIKE  '%".$this->input->post('wildcard')."%' ";
    	}

    		if(!empty($this->input->post('stateExcel')))
    	{
    		$sql .= " AND addressState = '".$this->input->post('stateExcel')."' ";
    	}
//	changes started by Subhjeet Kumar
    	if(!empty($this->input->post('campCode')))
    	{
    		$sql.= " AND campCode LIKE '%".$this->input->post('campCode')."%' ";
    	}
//	changes ended by Subhjeet Kumar

    	if(!empty($this->input->post('districtExcel')))
    	{if(implode(',',$this->input->post('districtExcel')) != '')
          {
    		$sql .= " AND addressDistrict IN (".implode(',',$this->input->post('districtExcel')) != ''.") ";
    	  }
    	}


        $query = $this->db->query($sql);

      //  print_r($this->db->last_query());exit();

    	$result = $query->result_array();

    	return $result;       
    }

    public function downloadServiceProviderData()
    {
    	$sql = "SELECT t1.serviceProviderId,t1.`uniqueId`,t1.name,t1.`address`,t1.`mobile`,t1.`officePhone`,t1.email,t1.`otherMobile`,t1.`location`,(SELECT districtName FROM `tbl_district` WHERE districtId = t1.districtId)districtName,(SELECT stateName FROM `tbl_state` WHERE stateId=t1.state)stateName,
           t1.`rating`,t1.`qualification`,t1.`affiliation`,t1.`linkage`,t1.`day`,t1.`time`,t1.`conFace`,t1.`conHome`,t1.`conTel`,t1.`conEmail`,t1.`conOnline`,t1.`conCharges`,t1.`concession`,t1.`latitude`,t1.`longitude`,GROUP_CONCAT((SELECT serviceTypeName FROM `tbl_service_type` WHERE serviceTypeId = t2.serviceTypeId)) services,DATE_FORMAT(t1.createdDate, '%d %M %Y') AS createdDate,(SELECT userName FROM tbl_user WHERE userId = t1.createdBy AND deleted = 'N' )createdBy
               FROM tbl_service_provider_details AS t1 LEFT JOIN `tbl_service_type_mapping` AS t2 
				ON t1.`serviceProviderId` = t2.`serviceProviderId`
				 WHERE t1.deleted = 'N' ";


       if(!empty($this->input->post('exceldaterange')))
    	{ 
    		$date = explode('-',$this->input->post('exceldaterange'));

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

    		$sql .= " AND t1.createdDate BETWEEN '".$startDate."' AND '".$endDate."'" ;
    	}

    	if (!empty($this->input->post('exceldataName'))) 
    	{
    		$stateArr = join(",",$this->input->post('exceldataName'));
    		$sql .= ' AND t1.state IN ("'.$stateArr.'")';
    	}

    	$sql .= "GROUP BY t1.`serviceProviderId`";			 

    	 $query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;
    }

    public function serviceTypeParameterById($serviceProviderId)
    {
    	$this->db->select('GROUP_CONCAT(t2.serviceTypeParameterName)serviceArea,t1.serviceProviderId',FALSE);

    	$this->db->from('tbl_service_provider_fields as t1');

    	$this->db->join('tbl_service_type_parameters as t2','t1.serviceTypeParameterId = t2.serviceTypeParameterId','left');

    	$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N']);

    	$this->db->where('(t1.value =  "Y" OR t1.value = "Yes" )');

    	$this->db->where('t1.serviceProviderId',$serviceProviderId);

    	  $query = $this->db->get();

	  	  $result = $query->result_array();

    	  return $result;
    }


     public function downloadSACdata()
    {

    	 $sql = "SELECT `t1`.`voucherNumber`, `t1`.`voucherCode`, `t3`.`userName` AS userName,DATE_FORMAT(t1.voucherDate, '%d %M %Y')awardedDate, TIME_FORMAT(t1.voucherDate, '%h:%i %p')awardedTime, 
                DATE_FORMAT(t1.voucherExpDate, '%d %M %Y')expireDate, `t2`.`name` AS serviceProviderName,t1.used,DATE_FORMAT(t1.updatedDate,'%d %M %Y'),TIME_FORMAT(t1.updatedDate,'%h:%i %p') FROM (`tbl_voucher_creation_data` AS t1) JOIN `tbl_service_provider_details` AS t2 ON `t1`.`categoryId` = `t2`.`serviceProviderId` JOIN `tbl_user` AS t3 ON `t1`.`userId` = `t3`.`userId` WHERE `t1`.`deleted` = 'N' AND `t2`.`deleted` = 'N' AND `t3`.`deleted` = 'N' ";

    	 if( (!empty($this->input->post("excelFilter"))) || (!empty($this->input->post("exceldaterange"))) || (!empty($this->input->post("exceldataName"))) )
    	{
    		  if(!empty($this->input->post("exceldaterange")))
                { 
                      $date = explode('-',$this->input->post("exceldaterange"));

                     $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

                    $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

                   $sql .= " AND t1.voucherDate BETWEEN '".$startDate."' AND '".$endDate."' ";

                }

                if($this->input->post("excelFilter") == 'userwise')
                {
                	$users = join("','",$this->input->post('exceldataName'));
                	$sql .= " AND  t1.userId IN ('".$users."')";
                }

              if($this->input->post("excelFilter") == 'serviceProvider')
              {
              	  $providers = join("','",$this->input->post('exceldataName'));

                  $sql .= " AND  t1.categoryId IN ('".$providers."')";
              }

               if($this->input->post('excelFilter') == 'claimed')
               {
        	       $sql .= " AND  used = 'Yes' ";
               }

		        if($this->input->post('excelFilter') == 'unclaimed')
		        {
		          $sql .= " AND used = 'No' ";
		        }	  	
                   
    	}

    	  $query = $this->db->query($sql);

         $result = $query->result_array();

         return $result;

    		
    }

    public function downloadGCdata()
    {
       $sql = "SELECT `t1`.voucherNumber,`t1`.voucherCode,`t4`.`userName`,DATE_FORMAT(t1.voucherDate,'%d %M %Y'),DATE_FORMAT(t1.voucherDate,'%h %i %p'),DATE_FORMAT(t1.voucherExpDate,'%d %M %Y'), t1.used,DATE_FORMAT(t1.updatedDate,'%d %M %Y'),TIME_FORMAT(t1.updatedDate,'%h:%i %p'),`t3`.`name` as partnerName,`t2`.`quizName`,`t5`.`quizTotalMarks` FROM (`tbl_voucher_creation_data` as t1) JOIN `tbl_quiz_names` as t2 ON `t1`.`categoryId` = `t2`.`quizId` LEFT JOIN `tbl_onground_partner_data` as t3 ON `t1`.`ongroundPartnerId` = `t3`.`ongroundPartnerId` JOIN `tbl_user` as t4 ON `t1`.`userId` = `t4`.`userId` JOIN `tbl_quiz_question_result_details` as t5 ON `t1`.`uniqueQuizNumber` = `t5`.`quizUniqueNumber` WHERE `t1`.`deleted` = 'N' AND `t2`.`deleted` = 'N' AND `t4`.`deleted` = 'N' AND `t5`.`deleted` = 'N' AND (t3.deleted = 'N' OR t3.deleted IS NULL)";

         if( (!empty($this->input->post("excelFilter1"))) || (!empty($this->input->post("exceldaterange1"))) || (!empty($this->input->post("exceldataName1"))) )
    	{
   
            if(!empty($this->input->post('exceldaterange1')))
           { 	
     	          $date = explode('-',$this->input->post('exceldaterange1'));

                $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

                $endDate = date('Y-m-d',strtotime($date[1])).' 00:00:00';

               $sql .= " AND voucherDate WHERE '".$startDate."' AND '".$endDate."' ";

        }

         if($this->input->post('excelFilter1') == 'userwise')
        {
        	$users = join("','",$this->input->post('exceldataName1'));

        	$sql .= " AND t1.userId IN ('".$users."') ";
        	
        }

        if($this->input->post('excelFilter1') == 'ongroundPartner')
        {
        	$partner = join("','",$this->input->post('exceldataName1'));
        	$sql .= " AND t1.ongroundPartnerId IN ('".$partner."')";
        }

        if($this->input->post('excelFilter1') == 'contestWise')
        {
        	$contest = join("','",$this->input->post('exceldataName1'));
        	$sql .= " AND t1.categoryId IN ('".$contest."')";
        }

          if($this->input->post('excelFilter1') == 'claimed')
           {
        	       $sql .= " AND  used = 'Yes' ";
           }

		  if($this->input->post('excelFilter1') == 'unclaimed')
		   {
		          $sql .= " AND used = 'No' ";
		    }

      }

       $query = $this->db->query($sql);

         $result = $query->result_array();

         return $result;
    }

    public function downloadOngroundPartnerdata()
    {
        
    	$sql = "SELECT ongroundPartnerUniqueId,name,address,officePhone,mobile,email,latitude,longtitute,(SELECT stateName FROM tbl_state WHERE stateId = tbl_onground_partner_data.stateId)stateName,(SELECT districtName FROM tbl_district WHERE districtId = tbl_onground_partner_data.districtId)districtName,dayAndTime,DATE_FORMAT(createdDate,'%d %M %Y'),TIME_FORMAT(createdDate,'%h:%i %p') FROM tbl_onground_partner_data WHERE deleted = 'N'";

    	
    		  if(!empty($this->input->post("exceldaterange")))
                { 
                      $date = explode('-',$this->input->post("exceldaterange"));

                     $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

                    $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

                   $sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."' ";

                }


                if($this->input->post("exceldataName"))
                {
                	$users = join("','",$this->input->post('exceldataName'));
                	$sql .= " AND  stateId IN ('".$users."')";
                }

    
    	 $query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;       
    }

    public function downloadGallerydata()
    {
    	$sql = "SELECT contentName,DATE_FORMAT(createdOn,'%d %M %Y'),description FROM tbl_gallery_content WHERE deleted = 'N'";


    		  if(!empty($this->input->post("exceldaterange")))
                { 
                      $date = explode('-',$this->input->post("exceldaterange"));

                     $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

                    $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

                   $sql .= " AND createdDate BETWEEN '".$startDate."' AND '".$endDate."' ";

                }

    	 $query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;      
    }

    public function downloadCommentdata()
    {
    	$sql = "SELECT `t1`.comment_content,`t1`.comment_author,`t1`.comment_author_email,`t1`.comment_author_url,`t2`.`post_title`, `t3`.`comment_status` AS anotherStatus,DATE_FORMAT(`t1`.comment_date,'%d %M %Y') as comment_date FROM (`ccodes_sahya`.`wp_comments` as t1) JOIN `ccodes_sahya`.`wp_posts` as t2 ON `t1`.`comment_post_ID` = `t2`.`ID` LEFT JOIN `saathi`.`tbl_comment_status` as t3 ON `t3`.`comment_id` = `t1`.`comment_ID` ";

    		  if(!empty($this->input->post("exceldaterange")))
                { 
                      $date = explode('-',$this->input->post("exceldaterange"));

                     $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

                    $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

                   $sql .= " AND comment_date BETWEEN '".$startDate."' AND '".$endDate."' ";

                }

           $sql .=  "ORDER BY `comment_date` DESC";     

    	 $query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;
    }

     public function downloadCampData($data)
   {
   	   $this->db->select('t1.camp_code,DATE_FORMAT(date_of_camp,"%d-%b-%Y"),start_time,end_time,t2.stateName,t3.districtName,block,site,latitude,longitude,nearset_ictc,nearest_health_facility,nearest_hiv_service_provider,coordinated_with,coordinated_others,hrg_population,arg_population,in_migration,out_migration,no_of_labourers,activityDesc,no_of_people_attended,no_of_people_screened,no_of_people_found_to_be_str,no_of_str_cases_referred_to_ictc,challenges,innovations,learing,follow,other_remark,cost_for_cbs,cost_for_renting,cost_of_consumables,cost_of_mobilisation,cost_of_transporting,other_major_cost,desc_for_other_cost,kits_name,batch_no,,DATE_FORMAT(expiry_date,"%d-%b-%Y"),opening_stock,received,consumed,control,wastage,closing_stock,quantity_indented,kits_returned,DATE_FORMAT(t1.createDate,"%d-%b-%Y")',FALSE);

   	  $this->db->from('tbl_camp_reports as t1');

   	  $this->db->join('tbl_state as t2','t1.state = t2.stateId','left');

   	  $this->db->join('tbl_district as t3','t1.district = t3.districtId','left');

   	  $this->db->where(['t1.deleted'=>'N']);

   	    //$roleType = explode(',',$this->session->userdata('roleType'));

   	  if($this->session->userdata('userType') =='employee' && $this->session->userdata('roleType') == 'User Data Manager')
  	  {
  	  	//echo 'nhjbhnmbh';exit();

  	  	 $this->db->where('t1.createdBy',$this->session->userdata('userId'));
  	  }

  	     if(!empty($data['daterangeExcel']))
        { 
         $date = explode('-',$data['daterangeExcel']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

         $this->db->where("(createDate BETWEEN '".$startDate."' and '".$endDate."' )");

        } 
        
        if($data['stateExcel'])
        {
        	$this->db->where_in('t1.state',$data['stateExcel']);
        }

        if($data['districtExcel'])
        {
        	$this->db->where_in('t1.district',$data['districtExcel']);
        }

        if($data['siteExcel'])
        {
            $this->db->where('t1.site',$data['siteExcel']);
        }

        if($data['submitExcel'])
        {
        	 $this->db->where('t1.submit',$data['submitExcel']);
        }	

   	  $this->db->order_by('t1.createDate','desc');

   	   $query = $this->db->get();

   	  // echo $this->db->last_query();exit();

   	  $result = $query->result_array();

   	  return $result;
   }

  public function downloadStock()
  {
  	$this->db->select('DATE_FORMAT(date_of_kits_received,"%d/%b/%Y"),kits_name,batch_no,DATE_FORMAT(expiry_date,"%d/%b/%Y"),opening_stock,received,consumed,DATE_FORMAT(date_of_camp,"%d/%b/%Y"),wastage,control,closing_stock,kits_returned',FALSE);

  	$this->db->from('tbl_camp_reports');

  	$this->db->where('deleted','N');

  	$dates = explode('-',$this->input->post('daterange'));

  	$startDate = date('Y-m-d',strtotime($dates[0])).' '.'00:00:00';

  	$endDate = date('Y-m-d',strtotime($dates[1])).' '.'23:59:59';

  if($this->session->userdata('userType') == 'admin')	

  	{
  		$this->db->where('date_of_camp >=',$startDate);
  	
  	  	$this->db->where('date_of_camp <=',$endDate);
  	}else{
  			$this->db->where('(MONTH(date_of_camp) = "'.$this->input->post('month').'" )');
  	
  	  	$this->db->where('(YEAR(date_of_camp) = "'.$this->input->post('year').'" )');
  	}

  	$this->db->where('state',$this->input->post('state'));

  	$this->db->where('district',$this->input->post('district'));

   	   $query = $this->db->get();

   	  $result = $query->result_array();

   	  return $result;


  } 



    public function getAllTicker()
    {
    	$sql = "SELECT * FROM `wp_posts` 
					WHERE post_type = 'post' AND ID IN (SELECT object_id FROM `wp_term_relationships` WHERE term_taxonomy_id = '76') order by ID desc ";

    	 $query = $this->db2->query($sql);

    	$result = $query->result_array();

    	return $result;					
    }

	public function changePostStatusWp($data)
	{
		$this->db2->where('ID',$data['postId']);

		$this->db2->update('wp_posts',['post_status'=>$data['status']]);

		return TRUE;
	}

	public function otpUsed()
	{
		$this->db->select('t1.otp,t2.userUniqueId,t2.userName,t1.createdDate');

		$this->db->from('tbl_otp_data as t1');

		$this->db->join('tbl_user as t2','t1.userId = t2.userId');

		$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N']);

		$query = $this->db->get();

     	$result = $query->result_array();

     	return $result;
	}


	public function getLoginId($userId)
  {
        $this->db->select_max('id');

		$this->db->from('tbl_login_logs');

		$this->db->where('userId',$userId);

		$this->db->where('logInto','Admin panel');

		$query1 = $this->db->get();

        $result1 = $query1->result_array();

        return $result1;

  }

   public function logout($userId,$logId)
  {
  	$array = ['userId'=>$userId,'logTime'=>date('Y-m-d h:i:s'),'loginId'=>$logId,'logInto'=>'Admin Panel'];
  	 $this->db->insert('tbl_logout_logs',$array);
  }

  public function insertContent($content)
  {
  	$array = ['contentName'=>$this->input->post('name'),'content'=>$content,'description'=>$this->input->post('description'),'contentType'=>$this->input->post('contentType'),'createdBy'=>$this->session->userdata('userId'),'link'=>$this->input->post('link')];

  	  $this->db->insert('tbl_gallery_content',$array);
  }


  public function getContents()
  {
  	  $this->db->select('t1.*,t2.userName as empName');

  	  $this->db->from('tbl_gallery_content as t1');

  	  $this->db->join('tbl_user as t2','t1.createdBy = t2.userId','left');

  	  $this->db->where('t1.deleted','N');

  	  if($this->session->userdata('userType') =='employee')
  	  {
  	  	 $this->db->where('t1.createdBy',$this->session->userdata('userId'));
  	  }

  	  $this->db->order_by('createdOn','desc');	

  	  $query = $this->db->get();

      $result = $query->result_array();

      return $result;
  }

  public function contentById($contentId)
  {
  	  $this->db->select('*');

  	  $this->db->from('tbl_gallery_content');

  	  $this->db->where('deleted','N');

  	  $this->db->where('id',$contentId);

  	  $query = $this->db->get();

      $result = $query->result_array();

      return $result;
  }

  public function updateContent($content)
  {
  	$where = ['deleted'=>'N','id'=>$this->input->post('contentId')];

  	$set = ['contentName'=>$this->input->post('name'),'description'=>$this->input->post('description'),'contentType'=>$this->input->post('contentType'),'updatedBy'=>$this->session->userdata('userId'),'updatedOn'=>date('Y-m-d H:i:s'),'link'=>$this->input->post('link')];

  	$this->db->where($where);

  	$this->db->update('tbl_gallery_content',$set);

  	if(!empty($content))
  	{
  	  $this->db->where($where);
  	  
  	  $this->db->update('tbl_gallery_content',['content'=>$content]);	
  	}	
  }

   public function checkUserMobile($mobileNo)
  {
  	$query = $this->db->get_where('tbl_user',['deleted'=>'N','userVerify'=>'Y','mobileNo'=>$mobileNo]);

  	 $result = $query->result_array();

  	 //echo $this->db->last_query();exit();

     return $result;
  }

  public function checkRegistertionNumber($client_id)
  {
  		$query = $this->db->get_where('tbl_user',['deleted'=>'N','userVerify'=>'Y','client_id'=>$client_id]);

  	 $result = $query->result_array();

  	 //echo $this->db->last_query();exit();

     return $result;
  }

  

  public function test()
  {
  	$query = $this->db->get('ci_sessions');

  	$result = $query->result_array();

  	return $result;
  }

  public function claimCoupon()
  {
  	 $where = ['voucherId'=>$this->input->post('voucherId')];

  	 $date = date('Y-m-d',strtotime($this->input->post('claimDate'))).' '.$this->input->post('claimTime').':00';

  	 $set = ['updatedDate'=>$date,'used'=>'Yes'];

  	 $this->db->where($where);

  	 $this->db->update('tbl_voucher_creation_data',$set);
  }

  public function smsUser()
  {

   $query =  $this->db->get_where('tbl_sms_user',['deleted'=>'N']);

   $result = $query->result_array();

   return $result;
  }

  public function smsUserById($id)
  {

   $query =  $this->db->get_where('tbl_sms_user',['deleted'=>'N','id'=>$id]);

   $result = $query->result_array();

   return $result;
  }


	public function checkUser($username)
	{
		$this->db->select('*');

		$this->db->from('tbl_user');

		$this->db->where('deleted','N');

		$this->db->where('userName',$username);

		$where = "(userType = 'admin' OR userType = 'employee')";

		$this->db->where($where);

		$query = $this->db->get();

		$result = $query->result_array();

		return $result;
	}

	public function updateUserOtp($userId,$otp)
	{
		$array = ['deleted'=>'N','userId'=>$userId];
        $this->db->where($array);

        $this->db->update('tbl_user',['otp'=>$otp]);
	}

	 public function insertOtp($userId,$otp)
	  {
	  	 $array = ['otp'=>$otp,'userId'=>$userId];

	  	 $this->db->insert('tbl_otp_data',$array);
	  }

	 public function setPassword($data)
	  {
	  	  $this->db->where(['deleted'=>'N','userId'=>$data['userId']]);

	  	  $this->db->update('tbl_user',['password'=>$data['password']]);
	  }

	   public function setLogs($userId)
	  {
	  	  $array = ['userId'=>$userId,'logTime'=>date('Y-m-d h:i:s'),'logInto'=>'Admin panel'];

	  	  $this->db->insert('tbl_login_logs',$array);
	  }

	 public function getUserRights()
    {
    	$sql = "SELECT * FROM `tbl_usertype_rights` WHERE deleted = 'N'";

    	$query = $this->db->query($sql);

    	 $result = $query->result_array();

           return $result;  
    }

    public function getRoles()
    {
    	$sql = "SELECT t1.* FROM `tbl_usertype` AS t1 LEFT JOIN `tbl_usertype_rights_mapping` AS t2 ON t1.userTypeId = t2.userTypeId WHERE t1.deleted = 'N' AND t2.deleted = 'N' GROUP BY t2.userTypeId ";

    	$query = $this->db->query($sql);

    	 $result = $query->result_array();

           return $result;
    }

     public function insertRole()
    {
    	$role = $this->input->post('role');

    	$otherAccess = implode(',',$this->input->post('campReport')) ;
    
       $sql = "INSERT INTO `tbl_usertype`(userType,otherAccess,createdDate,deleted)VALUES('".$role."','".$otherAccess."',NOW(),'N')";

       $query = $this->db->query($sql);

       $roleId = $this->db->insert_id();

       $rights  = $this->input->post('rights');

       foreach ($rights as $value) 
       {
       	  $sql1 = "INSERT INTO `tbl_usertype_rights_mapping`(userTypeId,rightId,createdBy)VALUES('".$roleId."','".$value."','".$this->session->userdata('userId')."')";

       	  $query1 = $this->db->query($sql1);
       }


    }

      public function roleDetails($id)
    {
    	$sql = "SELECT * FROM `tbl_usertype`  WHERE userTypeId = '".$id."'";

    	$query = $this->db->query($sql);

    	 $result = $query->result_array();

    	 $sql1 = "SELECT t2.rightId FROM `tbl_usertype_rights_mapping` AS t1 LEFT JOIN `tbl_usertype_rights` AS t2 ON t1.rightId = t2.rightId WHERE t2.deleted = 'N' AND t1.userTypeId = '".$id."' AND t1.deleted = 'N' " ;

    	 $query1 = $this->db->query($sql1);

    	 $result['rights'] = $query1->result_array();

           return $result;
       
    }

    
    public function updateRole($id)
    {
    	$sql = "UPDATE `tbl_usertype` SET userType = '".$this->input->post('role')."',otherAccess = '".implode(',',$this->input->post('campReport'))."'  WHERE userTypeId = '".$id."'";

    	$query = $this->db->query($sql);

    	$rights = $this->input->post('rights');

    	$sql3 = "UPDATE `tbl_usertype_rights_mapping` SET deleted = 'Y' WHERE userTypeId = '".$id."' AND rightId NOT IN ('".$rights."')";

    	$query3 = $this->db->query($sql3);

    	foreach ($rights as  $value) 
    	{
    	
    		 $sql1 = "SELECT mappingId FROM `tbl_usertype_rights_mapping` WHERE userTypeId = '".$id."' AND rightId = '".$value."' ";

    		 $query1 = $this->db->query($sql1);

    		 $result1 = $query1->result_array();

    		 if(!empty($result1))
    		 {
                $sql2 = "UPDATE `tbl_usertype_rights_mapping` SET deleted = 'N' WHERE userTypeId = '".$id."' AND rightId = '".$value."'";

                $this->db->query($sql2); 
    		 }
    		 else
    		 {
                $sql2 = "INSERT INTO `tbl_usertype_rights_mapping`(userTypeId,rightId,deleted,createdBy)VALUES('".$id."','".$value."','N','".$this->session->userdata('userId')."')";

                $this->db->query($sql2);
    		 }	
    	}

    }

     public function checkEmpMobile($mobileNo)
	 {
		 $query = $this->db->get_where('tbl_user',['deleted'=>'N','mobileNo'=>$mobileNo,'userType'=>'employee']);

		 $result = $query->result_array();

		  return $result;
	}

	public function changeEmpPassword()
	{
		$set = ['password'=>$this->input->post('password')];
		$this->db->where('userId',$this->input->post('userId'));

		$this->db->update('tbl_user',$set);
	}

	public function empUser($roleId)
	{
		$this->db->select('t1.*');

		$this->db->from('tbl_user as t1');

		$this->db->join('tbl_usertype as t2','t1.roleId = t2.userTypeId','left');

		$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N']);

		$this->db->where('t1.userType','employee');

		$this->db->where('t2.userTypeId',$roleId);

		$query = $this->db->get();

		$result = $query->result_array();


		return $result;
	}

	public function websiteUser()
	{
	   $this->db->select('*');

		$this->db->from('tbl_user');

		$this->db->where(['deleted'=>'N','registerFromDevice'=>'App','registerMode'=>'Online','userVerify'=>'Y','userType'=>'user']);

		$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
	}

	public  function wildcardUsername($data)
	{
        $this->db->select('*');

		$this->db->from('tbl_user');

		$this->db->where(['deleted'=>'N','userVerify'=>'Y','userType'=>'user']);

		$this->db->like('userName',$data['wildcard'], 'both'); 

		$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
    
	}

	public function createUserUniqueId($district)
	{
       $sql3 = "SELECT * FROM tbl_district WHERE districtName = '".$district."' ";

       $query3 = $this->db->query($sql3);

       $result3 = $query3->result_array();

       $districtId = $result3[0]['districtId'];

		 $sql = "SELECT CONCAT(LEFT(userUniqueId,6),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(userUniqueId,7)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(userUniqueId,6) = (SELECT CONCAT('A1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
			WHERE t1.districtId = '".$districtId."')";

		$query = $this->db->query($sql);	

		$result = $query->result_array();

		if(empty($result[0]['uniqueId']))
		{
			$sql1 = "SELECT CONCAT('A1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00'),'00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$districtId."'";

			$query1 = $this->db->query($sql1);	

		   $result1 = $query1->result_array();

		    $uniqueId = $result1[0]['uniqueId'];

		}else{

           $uniqueId = $result[0]['uniqueId'];
		}

		return $uniqueId;	
	}

	public function createUserUniqueIdExcel($mode_of_contact,$district)
	{
       $sql3 = "SELECT * FROM tbl_district WHERE districtName = '".$district."' ";

       $query3 = $this->db->query($sql3);

       $result3 = $query3->result_array();

       $districtId = $result3[0]['districtId'];


      if($mode_of_contact == 'Offline one to one') 
		{
			$sql = "SELECT CONCAT(LEFT(client_id,6),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(client_id,7)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(client_id,6) = (SELECT CONCAT('B1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
					WHERE t1.districtId = '".$districtId."')";

		}else{
			$sql = "SELECT CONCAT(LEFT(client_id,6),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(client_id,7)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(client_id,6) = (SELECT CONCAT('B2',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
					WHERE t1.districtId = '".$districtId."')";
		}


		$query = $this->db->query($sql);	

		$result = $query->result_array();

		if(empty($result[0]['uniqueId']))
		{
	      if($mode_of_contact == 'Offline one to one') 
		{		

			$sql1 = "SELECT CONCAT('B1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00'),'00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$districtId."'";

			

		 }else{
            $sql1 = "SELECT CONCAT('B2',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00'),'00001') AS uniqueId FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId WHERE t1.districtId = '".$districtId."'";
		 }

		 $query1 = $this->db->query($sql1);	

		   $result1 = $query1->result_array();

		    $uniqueId = $result1[0]['uniqueId'];    

		}else{

           $uniqueId = $result[0]['uniqueId'];
		}

		return $uniqueId;	
	}

	public function checkUserWithMobile($clientId,$name,$mobile)
     {
     		$this->db->select("userId,CASE WHEN smsUser = 'N' THEN 'webUser' ELSE 'webSmsUser' END as tableName",FALSE);

     		$this->db->from('tbl_user');

     		$this->db->where('userUniqueId',$clientId);
             
           if(!empty($name))

           {
     		$this->db->where("(name = '".$name."' or nameAlias = '".$name."')");
     	 }	

     		$this->db->where("RIGHT(mobileNo,10) = '".substr($mobile,-10)."'");

     		$this->db->where('agreeSms','Y');

     		$query = $this->db->get();
     
		  	 $result = $query->result_array();

		  	 $this->db->select("id as userId,CASE WHEN webUser = 'N' THEN 'smsUser' ELSE 'smsWebUser' END as tableName",FALSE);

		  	 $this->db->from('tbl_sms_user');

		  	 $this->db->where('client_id',$clientId);

		  	$this->db->where("RIGHT(mobileNo,10) = '".substr($mobile,-10)."'");

     		$query1 = $this->db->get();
     
		  	 $result1 = $query1->result_array();

		     //return $result;

		     return array_merge($result,$result1);
     }

   public function getSmsWithUser($smsId)
   {
       $this->db->select('*');

       $this->db->from('tbl_sms');

       $this->db->where(['deleted'=>'N','smsId'=>$smsId]);

     		$query = $this->db->get();
     
	  	 $result = $query->result_array();


    	return $result;
      	 
   } 

   public function campReportList()
   {
   	  $this->db->select('t1.*,t2.stateName,t3.districtName');

   	  $this->db->from('tbl_camp_reports as t1');

   	  $this->db->join('tbl_state as t2','t1.state = t2.stateId','left');

   	  $this->db->join('tbl_district as t3','t1.district = t3.districtId','left');

   	  $this->db->where(['t1.deleted'=>'N']);

   	  //print_r($this->session->all_userdata());exit();

   	  $otherAccess = $this->session->userdata('otherAccess');
//print_r($otherAccess);exit();

   	   if($this->session->userdata('userType') !='admin' && in_array('campReport',$otherAccess) == false)
  	  {
  	  
  	  	 $this->db->where('t1.createdBy',$this->session->userdata('userId'));
  	  }

   	  $this->db->order_by('t1.createDate','desc');

   	   $query = $this->db->get();

   	  $result = $query->result_array();

   	  return $result;
   }

   public function getPeoplePresent($data)
   {
   	   $this->db->select('*');

		$this->db->from('tbl_camp_peoples');

		$this->db->where(['deleted'=>'N','campId'=>$data['campId']]);

		$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
   }

   public function editReport($campId)
   {
   	  $this->db->select('*');

		$this->db->from('tbl_camp_reports');

		$this->db->where(['deleted'=>'N','id'=>$campId]);

		$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
   } 

     public function editPeoplePresent($data)
   {
   	   $this->db->select('t1.name,t1.designation,t1.organisation,t1.contactInfo,t1.id,t2.camp_code,t1.campId');

		$this->db->from('tbl_camp_peoples as t1');

		$this->db->join('tbl_camp_reports as t2','t1.campId = t2.id','left');

		$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t1.id'=>$data['peopleId']]);

		$query = $this->db->get();


		$result = $query->result_array();


		return $result;	
   }

   public function quizData($quizId)
   {

   	   $this->db->select('t1.quizId,t1.quizName,t2.quizQuestionId,t2.quizQuestionName,GROUP_CONCAT(CONCAT(t3.quizQuestionOptionName,"-",t3.quizQuestionAnswer)SEPARATOR "||")options',FALSE);

		$this->db->from('tbl_quiz_names as t1');

		$this->db->join('tbl_quiz_questions as t2','t1.quizId = t2.quizId','left');

		$this->db->join('tbl_quiz_question_options as t3','t2.quizQuestionId = t3.quizQuestionId','left');

		$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t3.deleted'=>'N','t1.quizId'=>$quizId]);

		$this->db->group_by(array('t1.quizId','t2.quizQuestionId'));

		$query = $this->db->get();


		$result = $query->result_array();

		return $result;	
   }

   public function insertQuizData()
   {

   
   	  $data['quizId'] = $this->input->post('quizId');

   	  $data['quizQuestionName'] = trim($this->input->post('questionName'));

   	  $data['typeOfAnswer'] = trim($this->input->post('answerType'));

 //  	  $data["numberOfAnswer"] = trim($this->input->post('answerType'));

   	  $data['NumberOfCorrectOptions'] = trim($this->input->post('numCorrect'));

   	  $data['MarksForEachCorrectAnswe'] = trim($this->input->post('marks'));

   	  $data['AdditionalInfoInCaseOfWrongAnswer'] = trim($this->input->post('info'));

   	  //$data['']

   	  $this->db->insert('tbl_quiz_questions',$data);

   	  	 $insert_id = $this->db->insert_id();

   	  $options = $this->input->post('options');

   	  if(!empty($this->input->post('count')))
   	  {
           $count = $this->input->post('count');
   	  }else{
   	  	$count = 0;
   	  }	  	

   	  $answer = $this->input->post('answer');

   	  $count = $count + 2;
   	  
   	  for ($i=0; $i < $count; $i++) { 
   	  	$data1['quizQuestionId'] = $insert_id;

   	  	//$data1['quizQuestionId'] = 1;

   	  	$data1['quizQuestionOptionName'] = $options[$i];

   	  	if(!empty($answer[$i]))
   	  	{
   	  		$ansValue = $answer[$i];
   	  	}else{
   	  			$ansValue = '0';		
   	  	}

   	  	$data1['quizQuestionAnswer'] = $ansValue;

   	  

   	  $this->db->insert('tbl_quiz_question_options',$data1);		
   	  }

  

   	  	
   }

   public function editQuizData($questionId)
   {
   	   $this->db->select('t1.quizId,t1.quizName,t2.quizQuestionId,t2.quizQuestionName,GROUP_CONCAT(CONCAT(t3.quizQuestionOptionName,"-",t3.quizQuestionAnswer,"-",t3.quizQuestionOptionId)SEPARATOR "||")options,t2.typeOfAnswer,t2.numberOfAnswer,t2.NumberOfCorrectOptions,t2.MarksForEachCorrectAnswe,t2.AdditionalInfoInCaseOfWrongAnswer',FALSE);

		$this->db->from('tbl_quiz_names as t1');

		$this->db->join('tbl_quiz_questions as t2','t1.quizId = t2.quizId','left');

		$this->db->join('tbl_quiz_question_options as t3','t2.quizQuestionId = t3.quizQuestionId','left');

		$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N','t3.deleted'=>'N','t2.quizQuestionId'=>$questionId]);

		$this->db->group_by(array('t1.quizId','t2.quizQuestionId'));

		$query = $this->db->get();


		$result = $query->result_array();

		return $result;	
   }

   public function updateQuizData($questionId)
   {
   	//echo "<pre>";
       $post['quizQuestionName'] = $this->input->post('questionName');

       $post['typeOfAnswer'] = $this->input->post('answerType');

       $post['NumberOfCorrectOptions'] = $this->input->post('numCorrect');

       $post['MarksForEachCorrectAnswe'] = $this->input->post('marks');

       $post['AdditionalInfoInCaseOfWrongAnswer'] = $this->input->post('info');

       $this->db->where('quizQuestionId',$questionId);

       $this->db->update('tbl_quiz_questions',$post);

       $count = count($this->input->post('optionsOld'));

       $optionsOldData = $this->input->post('optionsOld');

       $optionsOldId = $this->input->post('optionId');

       $optionAnswerOld = $this->input->post('answerNew');

       /* $sql3 = "UPDATE `tbl_quiz_question_options` SET deleted = 'Y' WHERE quizQuestionId = '".$questionId."' AND quizQuestionOptionId NOT IN ('".$optionsOldId."')";

    	$query3 = $this->db->query($sql3);*/

    	$this->db->where('quizQuestionId',$questionId);

    	$this->db->where_not_in('quizQuestionOptionId', $optionsOldId);

    	$this->db->update('tbl_quiz_question_options',['deleted'=>'Y']);

    //	echo $this->db->last_query();exit();

       for ($i=0; $i < $count; $i++) 
       { 

       	if(!empty($optionsOldData[$i]))
        {

       	 if(!empty($optionAnswerOld[$i]))
   	  	{
   	  		$ansValue = $optionAnswerOld[$i];
   	  	}else{
   	  			$ansValue = '0';		
   	  	}

       $sql3 = "UPDATE `tbl_quiz_question_options` SET deleted = 'N',quizQuestionAnswer = '".$ansValue."',quizQuestionOptionName = '".$optionsOldData[$i]."' WHERE quizQuestionId = '".$questionId."' AND quizQuestionOptionId = '".$optionsOldId[$i]."' ";

    	$query3 = $this->db->query($sql3);

      }

    /*	echo $this->db->last_query();

    	echo "<br>";*/
       }

   

       $array = $this->input->post('options');

       $answer = $this->input->post('answer');

   if(!empty($array))
   {
   	$j = 0;
       foreach ($array as $key => $value) 
       {
           
       	  if(!empty($answer[$j]))
   	  	{
   	  		
   	  		$ansValueNew = $answer[$j];
   	  	}else{
   	  			$ansValueNew = '0';		
   	  	}

       $this->db->insert('tbl_quiz_question_options',['quizQuestionOptionName'=>$value,'quizQuestionAnswer'=>$ansValueNew,'quizQuestionId'=>$questionId]);

        $j++;
       }
      } 

     
   }


    public function campReportUniqueId()
    {
        $sql = "SELECT CONCAT('CMP',IFNULL(RIGHT(CONCAT('0000',MAX(SUBSTR(camp_code_unique_id,4))+1),5),'00001')) AS campReportUniqueId FROM `tbl_camp_reports` WHERE LEFT(camp_code_unique_id,3) = 'CMP'";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result[0]['campReportUniqueId'];
    }

    public function checkCampUniqueCode($data)
    {
        $this->db->select('*');

        $this->db->from('tbl_camp_reports');

		$this->db->where(['deleted'=>'N','camp_code'=>$data['campCode']]);

		if(!empty($data['campId']))
		{
			$this->db->where('( id != "'.$data['campId'].'")');
		}	

		$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
    }


	public function checkUserExist($data)
	{
		$sql = "SELECT userId FROM `tbl_user` WHERE  userName = '".$data['userName']."' AND deleted = 'N' AND userVerify ='Y' ";

		$query = $this->db->query($sql);

         $result = $query->result_array();

         return $result;

	}

	public function filterCampReport($data)
	{
		$this->db->select('t1.*,t2.stateName,t3.districtName');

   	  $this->db->from('tbl_camp_reports as t1');

   	  $this->db->join('tbl_state as t2','t1.state = t2.stateId','left');

   	  $this->db->join('tbl_district as t3','t1.district = t3.districtId','left');

   	  $this->db->where(['t1.deleted'=>'N']);

   	   // $roleType = explode(',',$this->session->userdata('roleType'));

   	 $otherAccess = $this->session->userdata('otherAccess');


   	   if($this->session->userdata('userType') !='admin' && in_array('campReport',$otherAccess)==false)
  	  {
  	  	//echo 'nhjbhnmbh';exit();

  	  	 $this->db->where('t1.createdBy',$this->session->userdata('userId'));
  	  }

  	     if(!empty($data['daterange']))
        { 
         $date = explode('-',$data['daterange']);

         $startDate = date('Y-m-d',strtotime($date[0])).' 00:00:00';

         $endDate = date('Y-m-d',strtotime($date[1])).' 23:59:59';

         $this->db->where("(createDate BETWEEN '".$startDate."' and '".$endDate."' )");

        } 
        
        if($data['stateFilter'])
        {
        	$this->db->where_in('t1.state',$data['stateFilter']);
        }

        if($data['districtFilter'])
        {
        	$this->db->where_in('t1.district',$data['districtFilter']);
        }

        if($data['siteFilter'])
        {
            $this->db->where('t1.site',$data['siteFilter']);
        }

        if($data['submitFilter'])
        {
        	$this->db->where('t1.submit',$data['submitFilter']);
        }	


   	  $this->db->order_by('t1.createDate','desc');

   	   $query = $this->db->get();

   	//   echo $this->db->last_query(); exit();

   	  $result = $query->result_array();

   	  return $result;
	} 

	public function getStateInfo($data)
	{
		$this->db->select('*');

		$this->db->from('tbl_state');

		$this->db->where('stateId',$data['stateId']);

			$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
	}

	public function getDistrictInfo($data)
	{
       $this->db->select('*');

		$this->db->from('tbl_district');

		$this->db->where('districtId',$data['districtId']);

			$query = $this->db->get();

		$result = $query->result_array();


		return $result;	
	}

	public function downloadFileReport($data)
	{
		$this->db->select('t1.firstName,t1.lastName,t1.guardian,t1.age,t1.address,t2.stateName as addressState,t3.districtName as addressDistrict,t1.mobile,t1.date_of_incidence,t4.stateName as incidenceState,t5.districtName as incidenceDistrict,t1.date_of_incidence_reported,t1.type_of_incidence,t1.type_of_incidence_other,t1.by_whom,t1.by_whom_other,t1.support_required,t1.createdDate,t1.incidence_addressed_internal,t1.incidence_addressed_external,t1.date_of_incidence_addressed,t1.type_of_services,t1.type_of_services_other,t1.method_of_resolving,t1.status,t1.description,t1.reason',FALSE);

 	$this->db->from('tbl_file_reports as t1');

 	$this->db->join('tbl_state as t2','t1.state = t2.stateId','left');

 	$this->db->join('tbl_district as t3','t1.district = t3.districtId','left');

 	$this->db->join('tbl_state as t4','t1.incidence_state = t4.stateId','left');

 	$this->db->join('tbl_district as t5','t1.incidence_district = t5.districtId','left');;

 	$this->db->where('t1.deleted','N');

 	$this->db->where('t1.otpVerify','Y');

 	$this->db->where(['t2.deleted'=>'N','t3.deleted'=>'N']);

 	if($data['reportIdExcel'])
 	{
 		$this->db->where('t1.report_unique_id',$data['reportIdExcel']);
 	}

 	if($data['mobileExcel'])
 	{
      $this->db->where('mobile',$data['mobileExcel']);
 	}

 	if($data['stateExcel'])
 	{
 		$this->db->where('incidence_state',$data['stateExcel']);
 	}

 	if($data['districtExcel'])
 	{
      	$this->db->where('incidence_district',$data['districtExcel']);
 	}

 	 if(!empty($data['dates'][0]))		
	{	
		$this->db->where('t1.date_of_incidence >=',$data['startDateExcel']);
		
		$this->db->where('t1.date_of_incidence <=',$data['endDateExcel']);
	}	

 	$this->db->order_by('t1.createdDate','desc');

 	$query = $this->db->get();

 	//echo $this->db->last_query();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	

	}

	public function getPositiveReport($data)
	{

		$this->db->select('DATE_FORMAT(t1.registeredOn,"%d/%b/%Y")registeredOn,t1.referralPoint_others,t1.userUniqueId,t1.userName,t1.address,t2.stateName,t3.districtName,t1.age,t1.gender,CASE WHEN (t1.hrg IS NULL OR t1.hrg = " ") AND (t1.arg IS NULL OR t1.arg = " ") THEN t1.occupation WHEN t1.hrg IS NOT NULL  AND (t1.arg IS NULL OR t1.arg = " ") THEN t1.hrg  WHEN (t1.hrg IS NULL OR t1.hrg = " ")  AND (t1.arg IS NOT NULL OR t1.arg != " ") THEN t1.arg ELSE t1.occupation END identity,t1.modeOfContact,t1.saictcPlace,t1.ictcNumber,t1.hivDate,t1.linkToArt,DATE_FORMAT(t1.artDate,"%d/%b/%Y")artDate,t1.artNumber,t1.cd4Result,t1.otherService,t1.remark,t1.maritalStatus,t1.occupation,t1.occupation_other',FALSE);

		$this->db->from('tbl_user as t1');

		$this->db->join('tbl_state as t2','t1.addressState = t2.stateId','left');

		$this->db->join('tbl_district as t3','t1.addressDistrict = t3.districtId','left');

		$this->db->where('t1.deleted','N');

		$this->db->where('t1.hivStatus','Reactive');

	 if(!empty($data['dates']))		
	{	
		$this->db->where('t1.hivDate >=',$data['startDate']);
		
		$this->db->where('t1.hivDate <=',$data['endDate']);
	}

		$this->db->where('t1.addressState',$data['state']);

		$this->db->where('t1.addressDistrict',$data['district']);

			$query = $this->db->get();

	//echo $this->db->last_query();	exit();	

			$result = $query->result_array();

			//print_r($result);exit();

	 	return $result;	


	}

	public function groupRoleById($roles)
	{
	  //$roleId = explode(',',$roles);	

	   $this->db->select('userType');

	   $this->db->from('tbl_usertype');

	   $this->db->where('deleted','N');

	   $this->db->where_in('userTypeId',$roles);

	   	$query = $this->db->get();

		$result = $query->result_array();

			//print_r($result);exit();

	 	return $result;	


	}

	public function getStrReport($data)
	{/*
		$this->db->select('t2.stateName,t3.districtName,t1.fingerDate,CASE WHEN (occupation = "Truckers" OR occupation = "Drivers") THEN occupation END,CASE WHEN (occupation = "Migrant") THEN occupation END,CASE WHEN (occupation = "Student") THEN occupation END,CASE WHEN (occupation = "Daily Wage") THEN occupation END,CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END,CASE WHEN (arg = "Female Partner (FPHRG)" OR arg = "Partner / Spouse of FSW") THEN arg END,CASE WHEN arg = "Female Partner (FPARG)" THEN arg END,CASE WHEN arg = "TG (F-M)"  THEN arg END,',FALSE);

			$this->db->from('tbl_user as t1');

		$this->db->join('tbl_state as t2','t1.addressState = t2.stateId','left');

		$this->db->join('tbl_district as t3','t1.addressDistrict = t3.districtId','left');

		$this->db->where('t1.deleted','N');

		$this->db->where('t1.hivStatus','Reactive');

	 if(!empty($data['dates']))		
	{	
		$this->db->where('t1.fingerDate >=',$data['startDate']);
		
		$this->db->where('t1.fingerDate <=',$data['endDate']);
	}

		$this->db->where('t1.addressState',$data['state']);

		$this->db->where('t1.addressDistrict',$data['district']);

			$query = $this->db->get();*/

	$sql = 'SELECT t2.stateName,t3.`districtName`,t1.fingerDate,
COUNT(a.arg1),COUNT(a.arg2),COUNT(a.arg3),COUNT(a.arg4),COUNT(a.arg5),COUNT(a.arg6),COUNT(a.arg7), COUNT(a.arg8),

(COUNT(a.arg1) + COUNT(a.arg2) + COUNT(a.arg3) + COUNT(a.arg4) + COUNT(a.arg5) + COUNT(a.arg6) + COUNT(a.arg7))AtotalScreeningArg,

COUNT(a.arg9),COUNT(a.arg10),COUNT(a.arg11),COUNT(a.arg12),

(COUNT(a.arg9) + COUNT(a.arg10) + COUNT(a.arg11) + COUNT(a.arg12))AtotalScreeningHrg,
(COUNT(a.arg1) + COUNT(a.arg2) + COUNT(a.arg3) + COUNT(a.arg4) +COUNT(a.arg5)+ COUNT(a.arg6) + COUNT(a.arg7) + COUNT(a.arg9) + COUNT(a.arg10) + COUNT(a.arg11) + COUNT(a.arg12))ASum,

COUNT(b.arg13),COUNT(b.arg14),COUNT(b.arg15),COUNT(b.arg16),COUNT(b.arg17),COUNT(b.arg18),COUNT(b.arg19),COUNT(b.arg20),

(COUNT(b.arg13) + COUNT(b.arg14) + COUNT(b.arg15) + COUNT(b.arg16) + COUNT(b.arg17) + COUNT(b.arg18) + COUNT(b.arg19))BtotalScreeningArg,

COUNT(b.arg21),COUNT(b.arg22),COUNT(b.arg23),COUNT(b.arg24),

(COUNT(b.arg21) + COUNT(b.arg22) + COUNT(b.arg23) + COUNT(b.arg24))BtotalScreeningHrg,
(COUNT(b.arg13) + COUNT(b.arg14) + COUNT(b.arg15) + COUNT(b.arg16) + COUNT(b.arg17) + COUNT(b.arg18) + COUNT(b.arg19) + COUNT(b.arg21) + COUNT(b.arg22) + COUNT(b.arg23) + COUNT(b.arg24))BSum,

COUNT(c.arg25),COUNT(c.arg26),COUNT(c.arg27),COUNT(c.arg28),COUNT(c.arg29),COUNT(c.arg30),COUNT(c.arg31),COUNT(c.arg32),

(COUNT(c.arg25) + COUNT(c.arg26) + COUNT(c.arg27) + COUNT(c.arg28) + COUNT(c.arg29) + COUNT(c.arg30) + COUNT(c.arg31))CtotalScreeningArg,

COUNT(c.arg33),COUNT(c.arg34),COUNT(c.arg35),COUNT(c.arg36),

(COUNT(c.arg33) + COUNT(c.arg34) + COUNT(c.arg35) + COUNT(c.arg36))CtotalScreeningHrg,
(COUNT(c.arg25) + COUNT(c.arg26) + COUNT(c.arg27) + COUNT(c.arg28) + COUNT(c.arg29) + COUNT(c.arg30) + COUNT(c.arg31) + COUNT(c.arg33) + COUNT(c.arg34) + COUNT(c.arg35) + COUNT(c.arg36))CSum,

COUNT(d.arg37),COUNT(d.arg38),COUNT(d.arg39),COUNT(d.arg40),COUNT(d.arg41),COUNT(d.arg42),COUNT(d.arg43),COUNT(d.arg44),

(COUNT(d.arg37) + COUNT(d.arg38) + COUNT(d.arg39) + COUNT(d.arg40) + COUNT(d.arg41) + COUNT(d.arg42) + COUNT(d.arg43))DtotalScreeningArg,

COUNT(d.arg45),COUNT(d.arg46),COUNT(d.arg47),COUNT(d.arg48),

(COUNT(d.arg45) + COUNT(d.arg46) + COUNT(d.arg47) + COUNT(d.arg48))DtotalScreeningHrg,
(COUNT(d.arg37) + COUNT(d.arg38) + COUNT(d.arg39) + COUNT(d.arg40) + COUNT(d.arg41) + COUNT(d.arg42) + COUNT(d.arg43) + COUNT(d.arg45) + COUNT(d.arg46) + COUNT(d.arg47) + COUNT(d.arg48))DSum,

COUNT(e.arg49),COUNT(e.arg50),COUNT(e.arg51),COUNT(e.arg52),COUNT(e.arg53),COUNT(e.arg54),COUNT(e.arg55),COUNT(e.arg56),

(COUNT(e.arg49) + COUNT(e.arg50) + COUNT(e.arg51) + COUNT(e.arg52) + COUNT(e.arg53) + COUNT(e.arg54) + COUNT(e.arg55))EtotalScreeningArg,

COUNT(e.arg57),COUNT(e.arg58),COUNT(e.arg59),COUNT(e.arg60),

(COUNT(e.arg57) + COUNT(e.arg58) + COUNT(e.arg59) + COUNT(e.arg60))EtotalScreeningHrg,
(COUNT(e.arg49) + COUNT(e.arg50) + COUNT(e.arg51) + COUNT(e.arg52) + COUNT(e.arg53) + COUNT(e.arg54) + COUNT(e.arg55) + COUNT(e.arg57) + COUNT(e.arg58) + COUNT(e.arg59) + COUNT(e.arg60) )ESum 
				FROM (`tbl_user` AS t1) LEFT JOIN tbl_state AS t2 ON t1.addressState = t2.stateId LEFT JOIN `tbl_district` AS t3 ON t1.addressDistrict = t3.`districtId` LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg1,CASE WHEN (occupation = "Migrant") THEN occupation END arg2, CASE WHEN (hrg IS NULL OR hrg = " ") AND (`arg` IS NULL OR `arg` = " ") THEN "Student"  END arg3,CASE WHEN (occupation = "Daily Wage") THEN occupation END arg4, CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg5, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg6,CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg7,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg8,CASE WHEN hrg = "MSM" THEN hrg END arg9,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg10,CASE WHEN hrg = "FSW" THEN hrg END arg11,CASE WHEN hrg = "IDU" THEN hrg END arg12  FROM `tbl_user`  WHERE fingerDate IS NOT NULL OR fingerDate != " ")a ON t1.userId = a.userId LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg13, CASE WHEN (occupation = "Migrant") THEN occupation END arg14, CASE WHEN (hrg IS NULL OR hrg = " ") AND (`arg` IS NULL OR `arg` = " ") THEN "Student" END arg15, CASE WHEN (occupation = "Daily Wage") THEN occupation END arg16, CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg17, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg18, CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg19,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg20,CASE WHEN hrg = "MSM" THEN hrg END arg21,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg22,CASE WHEN hrg = "FSW" THEN hrg END arg23,CASE WHEN hrg = "IDU" THEN hrg END arg24 FROM `tbl_user`  WHERE saictcStatus = "Yes")b ON t1.userId = b.userId LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg25, CASE WHEN (occupation = "Migrant") THEN occupation END arg26, CASE WHEN (hrg IS NULL OR hrg = " ") AND (`arg` IS NULL OR `arg` = " ") THEN "Student" END arg27,CASE WHEN (occupation = "Daily Wage") THEN occupation END arg28, CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg29, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg30, CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg31,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg32,CASE WHEN hrg = "MSM" THEN hrg END arg33,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg34,CASE WHEN hrg = "FSW" THEN hrg END arg35,CASE WHEN hrg = "IDU" THEN hrg END arg36 FROM `tbl_user`  WHERE hivDate IS NOT NULL OR hivDate != " ")c ON t1.userId = c.userId LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg37, CASE WHEN (occupation = "Migrant") THEN occupation END arg38, CASE WHEN (hrg IS NULL OR hrg = " ") AND (`arg` IS NULL OR `arg` = " ") THEN "Student" END arg39, CASE WHEN (occupation = "Daily Wage") THEN occupation END arg40, CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg41, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg42, CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg43,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg44, CASE WHEN hrg = "MSM" THEN hrg END arg45,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg46,CASE WHEN hrg = "FSW" THEN hrg END arg47,CASE WHEN hrg = "IDU" THEN hrg END arg48 FROM `tbl_user`  WHERE hivStatus = "Reactive" )d ON t1.userId = d.userId LEFT JOIN (SELECT userId,CASE WHEN occupation = "Truckers" OR occupation = "Drivers" THEN occupation END arg49, CASE WHEN (occupation = "Migrant") THEN occupation END arg50, CASE WHEN (hrg IS NULL OR hrg = " ") AND (`arg` IS NULL OR `arg` = " ") THEN "Student" END arg51, CASE WHEN (occupation = "Daily Wage") THEN occupation END arg52, CASE WHEN (occupation = "Salaried" OR occupation = "self Employed" OR occupation ="Unemployed" OR occupation = "Other") THEN occupation END arg53, CASE WHEN (ARG = "Female Partner (FPHRG)" OR ARG = "Partner / Spouse of FSW") THEN ARG END arg54, CASE WHEN ARG = "Female Partner (FPARG)" THEN ARG END arg55,CASE WHEN ARG = "TG (F-M)" THEN ARG END arg56,CASE WHEN hrg = "MSM" THEN hrg END arg57,CASE WHEN hrg = "TG(M_F)" THEN hrg END arg58,CASE WHEN hrg = "FSW" THEN hrg END arg59, CASE WHEN hrg = "IDU" THEN hrg END arg60 FROM `tbl_user` WHERE artDate IS NOT NULL OR artDate != " ") AS e ON t1.userId = e.userId WHERE `t1`.`deleted` = "N" AND t1.userType = "user" ' ;

      if($data['dates']!='')
      {
      	$sql .= " AND `t1`.`fingerDate` >= '".$data['startDate']."' AND `t1`.`fingerDate` <= '".$data['endDate']."'  ";
      }
      else{
      	$sql .=" AND `t1`.`fingerDate`>='1970-01-01' AND `t1`.`fingerDate` <= now() ";
      }

      if($data['state']!='')
      {
      	$sql .=  "AND t1.addressState = '".$data['state']."' "; 
      }

      if($data['district']!='')
      {
      	$sql .=  "AND t1.addressDistrict = '".$data['district']."' "; 
      }	



	$sql .=	'GROUP BY t1.fingerDate';
	
	$query = $this->db->query($sql);		

	echo $this->db->last_query();	exit();	

			$result = $query->result_array();

			//print_r($result);exit();

	 	return $result;	

	}

 public function reportList()
 {
 	$this->db->select('*');

 	$this->db->from('tbl_file_reports');

 	$this->db->where('deleted','N');

   $this->db->where('otpVerify','Y');	

 	 $otherAccess = $this->session->userdata('otherAccess');

     if($this->session->userdata('userType') !='admin' && in_array('violenceReport',$otherAccess) == false)
  	  {
  	  
  	  	 $this->db->where('incidence_state',$this->session->userdata('stateId'));
  	  }

 	$query = $this->db->get();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	
 }
  


 public function getTrackReport($data)
 {
  

 	$this->db->select('t1.*,t2.stateName as addressState,t3.districtName as addressDistrict,t4.stateName as incidenceState,t5.districtName as incidenceDistrict');

 	$this->db->from('tbl_file_reports as t1');

 	$this->db->join('tbl_state as t2','t1.state = t2.stateId','left');

 	$this->db->join('tbl_district as t3','t1.district = t3.districtId','left');

 	$this->db->join('tbl_state as t4','t1.incidence_state = t4.stateId','left');

 	$this->db->join('tbl_district as t5','t1.incidence_district = t5.districtId','left');;

 	$this->db->where('t1.deleted','N');

 	$this->db->where('t1.otpVerify','Y');

 	//$this->db->where(['t2.deleted'=>'N','t3.deleted'=>'N']);

 	if($data['reportId'])
 	{
 		$this->db->where('t1.report_unique_id',$data['reportId']);
 	}

 	if($data['mobile'])
 	{
      $this->db->where('mobile',$data['mobile']);
 	}

 	if($data['state'])
 	{
 		$this->db->where('incidence_state',$data['state']);
 	}

 	if($data['district'])
 	{
      	$this->db->where('incidence_district',$data['district']);
 	}

 	 if(!empty($data['dates'][0]))		
	{	
		$this->db->where('t1.date_of_incidence >=',$data['startDate']);
		
		$this->db->where('t1.date_of_incidence <=',$data['endDate']);
	}

	 $otherAccess = $this->session->userdata('otherAccess');

	 $districts = explode(',',$this->session->userdata('districtId')) ;

     if($this->session->userdata('userType') !='admin' && in_array('violenceReport',$otherAccess) == false)
  	  {
  	  
  	  	 $this->db->where('t1.incidence_state',$this->session->userdata('stateId'));

  	  	 $this->db->where_in('t1.incidence_district',$districts);
  	  }


 	$this->db->order_by('t1.createdDate','desc');

 	$query = $this->db->get();

 	//echo $this->db->last_query();exit();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	

 } 


public function editTrackReport($reportId)
{


 	$this->db->select('t1.*,t2.stateName as addressState,t3.districtName as addressDistrict,t4.stateName as incidenceState,t5.districtName as incidenceDistrict');

 	$this->db->from('tbl_file_reports as t1');

 	$this->db->join('tbl_state as t2','t1.state = t2.stateId','left');

 	$this->db->join('tbl_district as t3','t1.district = t3.districtId','left');

 	$this->db->join('tbl_state as t4','t1.incidence_state = t4.stateId','left');

 	$this->db->join('tbl_district as t5','t1.incidence_district = t5.districtId','left');;

 	$this->db->where('t1.deleted','N');

 	$this->db->where(['t4.deleted'=>'N','t5.deleted'=>'N']);

 	$this->db->where('t1.id',$reportId);


 
 	$query = $this->db->get();


 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	

}

 public function trackReportHistory($reportId)
 {
 	$this->db->select('*');

 	$this->db->from('report_audit');

 	$this->db->where('deleted','N');

 	$this->db->where('report_id',$reportId);

 	$query = $this->db->get();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	
 }

 public function fileReportFeedback()
 {
 $this->db->select('t1.part_one,t1.part_one_text,t1.part_two,t1.part_two_text,t1.part_three,t1.part_three_text,t1.part_four,t1.part_four_text,t2.report_unique_id,t1.id,t1.createdDate');

 	$this->db->from('tbl_file_reports_feedbacks as t1');

 	$this->db->join('tbl_file_reports as t2','t1.report_id = t2.id','left');

 	$this->db->where(['t1.deleted'=>'N','t2.deleted'=>'N']);

  $otherAccess = $this->session->userdata('otherAccess');

   $districts = explode(',',$this->session->userdata('districtId')) ;


 
  if($this->session->userdata('userType') !='admin' && in_array('violenceReport',$otherAccess) == false )
	  {
	  
	  	 $this->db->where('t2.incidence_state',$this->session->userdata('stateId'));

	  	 $this->db->where_in('t2.incidence_district',$districts);
	  }

 	$this->db->order_by('t1.createdDate','desc');

 	$query = $this->db->get();

 	//echo $this->db->last_query();exit();

 	$result = $query->result_array();

			//print_r($result);exit();

	return $result;	



 }		


}
