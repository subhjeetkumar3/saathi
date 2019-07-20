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

       $result1 = $this->getLoginId($result[0]['userId']);

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
				'logInto'=>'Admin Panel',			
				'validated' => true
				);
			$this->session->set_userdata($sessionData);

			$this->session->set_userdata('rights',$rights);
            return $result;
		}
    }
	
	public function deletedTransData(){
        $sql="Update ".$this->input->post('tabelName')." set deleted='Y' 
		where ".$this->input->post('colName')."='".$this->input->post('deleteId')."'";
        $query=$this->db->query($sql);
		return $query;
    }
	
	public function importantLinkList() {				
		$sql="SELECT * FROM `tbl_usefull_link` WHERE deleted = 'N' ";
         if($this->session->userdata() == 'employee')
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
				FROM `tbl_sms` WHERE deleted = 'N' ";

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
	
	public function smsById($id) {				
		$sql="SELECT *,
				DATE_FORMAT(`dateTime`,'%d-%m-%Y') AS `date`,
				DATE_FORMAT(`dateTime`,'%H:%i') AS `time`
				FROM tbl_sms WHERE smsId = ".$id."";
		$query = $this->db->query($sql);
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

		$sql .=" AND createdDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW() ORDER BY createdDate DESC";
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

    	$sql="SELECT *,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.addressState)addressState1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.addressDistrict)addressDistrict1,(SELECT stateName FROM tbl_state WHERE deleted = 'N' AND stateId = tbl_user.state)state1,(SELECT districtName FROM tbl_district WHERE deleted = 'N' AND districtId = tbl_user.districtId)district1 FROM `tbl_user` WHERE userVerify = 'Y' AND userType = 'user' ";

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


    	$sql .= " ORDER BY createdDate DESC";
		$query = $this->db->query($sql);

	
		$res = $query->result_array();	


		return $res;
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
    	$sql = "SELECT t1.*,t2.userName AS empName FROM `tbl_event_data` AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N' AND (startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) )";

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
    	$sql = "SELECT * FROM `tbl_event_data` WHERE deleted = 'N' AND (startDate >= DATE(NOW()) OR endDate >= DATE(NOW()) )";

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
	
	
	public function ongroundPartnerList() {				
		$sql="SELECT t1.*,(SELECT stateName FROM tbl_state WHERE stateId = t1.stateId)stateName,(SELECT districtName FROM tbl_district WHERE districtId = t1.districtId)districtName,t2.userName AS empName FROM `tbl_onground_partner_data` AS t1 LEFT JOIN tbl_user AS t2 ON t1.createdBy = t2.userId WHERE t1.deleted = 'N' ";

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
		$sql="SELECT * FROM `tbl_state` WHERE deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function districtList() {				
		$sql="SELECT * FROM `tbl_district` WHERE deleted = 'N'";
		$query = $this->db->query($sql);
		echo $this->db->last_query(); exit;	
		$res = $query->result_array();		
		return $res;
    }
	
	public function getDistrict() {				
		$sql="SELECT * FROM `tbl_district` WHERE deleted = 'N' and stateId ='".$this->input->post('state')."'";
		$query = $this->db->query($sql);
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
		$sql="SELECT *,
				(SELECT GROUP_CONCAT(serviceTypeParameterId) FROM `tbl_service_provider_fields` 
				WHERE serviceProviderId = tbl_service_provider_details.serviceProviderId and deleted = 'N' and value='Y') AS serviceFields
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
		$sql="SELECT t1.stateId,t2.districtId FROM `tbl_state` AS t1 
				LEFT JOIN `tbl_district` AS t2 ON t1.stateId = t2.stateId
				WHERE t1.stateName = '".$state."' AND t1.deleted = 'N' 
				AND t2.districtName = '".$district."' AND t2.deleted = 'N'";
		$query = $this->db->query($sql);
		//echo $this->db->last_query(); 
		$res = $query->result_array();		
		return $res;
    }

    public function state_by_id($stateId)
    {
    	$this->db->select();

    	$this->db->from('tbl_state');

    	$this->db->where('deleted','N');

    	$this->db->where_in('stateId',$stateId);

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
	
	public function addServiceProvider($data) {
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
		$post['p_dayAndTime'] = $this->input->post('dayAndTime');		
		$post['p_conMode'] = $this->input->post('conMode');		
		$post['p_conCharges'] = $this->input->post('conCharges');		
		$post['p_concession'] = $this->input->post('concession');		
		$post['p_userId'] = $this->session->userdata('userId');	
		//echo '<pre>';print_r($post);exit;
		$stored="Call proc_service_provider_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query = $this->db->query($stored,$post);
		//echo $this->db->last_query(); exit;
		$result = $query->result_array();	
		$query->next_result();
		$query->free_result();

		return $result;
    }
	
	public function addUser($data) 
	{
        $sql = "SELECT CONCAT(LEFT(userUniqueId,6),RIGHT(CONCAT('0000',IFNULL(MAX(SUBSTR(userUniqueId,7)),0)+1),5)) AS uniqueId FROM tbl_user WHERE LEFT(userUniqueId,6) = (SELECT CONCAT('A1',IFNULL(t2.stateCode,'00'),IFNULL(t1.districtCode,'00')) FROM `tbl_district` AS t1 LEFT JOIN `tbl_state` AS t2 ON t1.stateId = t2.stateId
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

          $query2 =  $this->db->get_where('tbl_sms_user',['deleted'=>'N','mobileNo'=>'+91'.$this->input->post('mobileNo')]);

        $result2 = $query2->result_array();
   
        if(!empty($result2))
        {
        	$this->db->where('id',$result2[0]['id']);

        	$this->db->update('tbl_sms_user',array('client_id'=>$uniqueId,'webUser'=>'Y'));
        }	
       

        $post['userType'] = 'user';
        $post['userUniqueId'] = $uniqueId;
        $post['userName'] = '+91'.$this->input->post('mobileNo');
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
	    $post['educationalLevel'] = $this->input->post('educationalLevel');
	    $post['occupation'] = $this->input->post('occupation');
	    $post['occupation_other'] = $this->input->post('occupation_other');
	    $post['monthlyIncome'] = $this->input->post('monthlyIncome');
	    $post['remark'] = $this->input->post('remark');
	    $post['maritalStatus'] =$this->input->post('maritalStatus');
	    $post['maritalStatus_other'] =$this->input->post('maritalStatus_other');
	    $post['male_children'] = $this->input->post('malechildren');
	    $post['female_children'] = $this->input->post('femalechildren');
	    $post['total_children'] = $this->input->post('totalchildren');
	    $post['state'] = $this->input->post('state');
	    $post['districtId'] = $this->input->post('districtId');
	    $post['secondaryIdentity'] = $this->input->post('secondaryIdentity');
	    $post['secondaryIdentity_other'] = $this->input->post('secondaryIdentity_other');
        $post['sexualBehaviour'] = $this->input->post('sexualBehaviour');
	    $post['sought'] = $this->input->post('sought');
	    $post['condomUsage'] = $this->input->post('condomUsage');
	    $post['substanceUse'] = $this->input->post('substanceUse');
	    $post['multipleSexPartner'] = $this->input->post('multipleSexPartner');
	    $post['prefferedSexualAct'] = $this->input->post('prefferedSexualAct');
	    $post['pastHivReport'] = $this->input->post('pastHivReport');
	    $post['fingerDate'] = $this->input->post('fingerDate');
		$post['saictcStatus'] = $this->input->post('saictcRefer');
		$post['saictcDate'] = $this->input->post('saictcDate');
	    $post['saictcPlace'] = $this->input->post('saictcPlace');
		$post['ictcNumber'] = $this->input->post('ictcNumber');
		 $post['hivDate'] = $this->input->post('hivDate');
		$post['hivStatus'] = $this->input->post('hivStatus');
        $post['reportIssuedDate'] = $this->input->post('reportIssuedDate');
		$post['reportStatus'] = $this->input->post('reportStatus');
	    $post['testHiv'] = $this->input->post('testHiv');
	    $post['hivTestResult'] = $this->input->post('hivConfirmation');
	    $post['prefferedGender'] = $this->input->post('prefferedGender');
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
	    $post['registeredBy'] = $this->input->post('registeredBy');
	    $post['registeredOn'] = date('Y-m-d',strtotime($this->input->post('registeredOn')));
	    $post['createdBy'] = $this->session->userdata('userId');
	    $post['userVerify'] = 'Y';
	    $post['deleted'] = 'N';
	    $post['campCode'] = $this->input->post('campCode');


		$this->db->insert('tbl_user',$post);
		
		$insertId = $this->db->insert_id();

		return $insertId;
    }

    public function updateUser($data)
    {
    	$sql = "UPDATE tbl_user SET userName = '".$this->input->post('userName')."',`password` = '".$this->input->post('password')."',`name` = '".$this->input->post('name')."',nameAlias = '".$this->input->post('nameAlias')."',domainOfWork = '".$this->input->post('domainOfWork')."',monthlyIncome = '".$this->input->post('monthlyIncome')."',address = '".$this->input->post('address')."',primaryIdentity = '".$this->input->post('primaryIdentity')."',secondaryIdentity = '".$this->input->post('secondaryIdentity')."',hivHistory = '".$this->input->post('hivHistory')."',gender = '".$this->input->post('gender')."',emailAddress = '".$this->input->post('emailAddress')."',age = '".$this->input->post('age')."',occupation = '".$this->input->post('occupation')."',occupation_other = '".$this->input->post('occupation_other')."',educationalLevel = '".$this->input->post('educationalLevel')."',districtId = '".$this->input->post('districtId')."',state = '".$this->input->post('state')."',placeOforigin = '".$this->input->post('placeOforigin')."',mobileNo =  '".'+91'.$this->input->post('mobileNo')."',maritalStatus = '".$this->input->post('maritalStatus')."',maritalStatus_other = '".$this->input->post('maritalStatus_other')."',sexualBehaviour = '".$this->input->post('sexualBehaviour')."',updatedBy = '".$this->session->userdata('userId')."',dob = '".date('Y-m-d',strtotime($this->input->post('dob')))."',referralPoint = '".$this->input->post('referralPoint')."',male_children = '".$this->input->post('malechildren')."',female_children = '".$this->input->post('femalechildren')."',total_children = '".$this->input->post('totalchildren')."',updatedBy = '".$this->session->userdata('userId')."',updatedDate = NOW(),registeredBy = '".$this->input->post('registeredBy')."' ,registeredOn = '".date('Y-m-d',strtotime($this->input->post('registeredOn')))."',campCode = '".$this->input->post('campCode')."' WHERE userId = '".$data['id']."' ";

    	$query = $this->db->query($sql);
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
             $sql1 = "SELECT id as userId,mobileNo,'smsUserTable' as dataTable as userName FROM tbl_sms_user WHERE deleted = 'N' AND current_status = 'CONSENTED'  ";	

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
        $sql = "SELECT CONCAT('OG',IFNULL(RIGHT(CONCAT('0000',MAX(SUBSTR(ongroundPartnerUniqueId,3))+1),5),'00001')) AS ongroundPartnerUniqueId FROM `tbl_onground_partner_data` WHERE LEFT(ongroundPartnerUniqueId,1) = 'OG'";

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
  	 $array = ['name'=>$this->input->post('name'),'address'=>$this->input->post('address'),'officePhone'=>$this->input->post('officePhone'),'mobile'=>$this->input->post('mobile'),'email'=>$this->input->post('email'),'latitude'=>$this->input->post('latitude'),'longtitute'=>$this->input->post('longitude'),'stateId'=>$this->input->post('state'),'districtId'=>$this->input->post('district'),'location'=>$this->input->post('location'),'dayAndTime'=>$this->input->post('dayAndTime')];

  	 $this->db->where(['deleted'=>'N','ongroundPartnerId'=>$this->input->post('partnerId')]);

  	 $this->db->update('tbl_onground_partner_data',$array);

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
	  	  $this->db->select('t1.*,t2.userName as empName,t3.userType');

	  	  $this->db->from('tbl_user as t1');

	  	  $this->db->join('tbl_user as t2','t1.createdBy = t2.userId','left');

	  	  $this->db->join('tbl_usertype as t3','t1.roleId = t3.userTypeId','left');

	  	  $this->db->where(['t1.deleted'=>'N','t1.userType'=>'employee','t3.deleted'=>'N']);

	  	  $query = $this->db->get();

	  	  $result = $query->result_array();

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

	  	 $data['userType'] = 'employee';

	  	 $data['roleId'] = $this->input->post('role');

	  	 $data['name'] = $this->input->post('name');

	  	 $data['emailAddress'] = $this->input->post('email');

	  	 $data['mobileNo'] = $this->input->post('mobile');

	  	 $data['password'] = $this->input->post('password');

	  	 $data['registerFromDevice'] = 'Web';

	  	 $data['registerMode'] = 'Online';

	  	 $data['createdBy'] = $this->session->userdata('userId');

	  	 $data['userVerify'] = 'Y';

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


    public function downloadEventData()
    {
    	$sql = "SELECT `eventName`, `eventVenue`, DATE_FORMAT(startDate, '%d %M %Y') AS startDate,TIME_FORMAT(startTime, '%H %i %p') AS startTime,DATE_FORMAT(endDate, '%d %M %Y') AS endDate, TIME_FORMAT(endTime, '%H %i %p') AS endTime,`mobileNo`, `website`,`otherInfo`,DATE_FORMAT(createdDate, '%d %M %Y') AS createdDate FROM (`tbl_event_data`) WHERE `deleted` = 'N' ";

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
    	$sql = "SELECT `userUniqueId`,`userName`,`name`,`nameAlias`,DATE_FORMAT(`dob`,'%d %M %Y')dob,`age`,
               `mobileNo`,`address`,(SELECT `stateName` FROM `tbl_state` WHERE `stateId` = tbl_user.`addressState`)addressState,(SELECT `districtName` FROM `tbl_district` WHERE `districtId` = tbl_user.`addressDistrict`)addressDistrict,`educationalLevel`,`occupation`,`occupation_other`,`monthlyIncome`,`maritalStatus`,`maritalStatus_other`,`male_children`,`female_children`,`total_children`,(SELECT `stateName` FROM `tbl_state` WHERE `stateId` = tbl_user.`state`)state,(SELECT `districtName` FROM `tbl_district` WHERE `districtId` = tbl_user.`districtId`)districtId,`secondaryIdentity`,`secondaryIdentity_other`,`sexualBehaviour`,`multipleSexPartner`,`sought`,`prefferedGender`,`prefferedSexualAct`,`substanceUse`,`testHiv`,`hivTestResult`,`pastHivReport`,`remark`,DATE_FORMAT(createdDate, '%d %M %Y') AS createdDate FROM `tbl_user` WHERE  userType = 'user' AND userVerify = 'Y' ";

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

    	if(!empty($this->input->post('districtExcel')))
    	{if(implode(',',$this->input->post('districtExcel')) != '')
          {
    		$sql .= " AND addressDistrict IN (".implode(',',$this->input->post('districtExcel')) != ''.") ";
    	  }
    	}			




        $query = $this->db->query($sql);

    	$result = $query->result_array();

    	return $result;       
    }

    public function downloadServiceProviderData()
    {
    	$sql = "SELECT t1.`uniqueId`,t1.name,t1.`address`,t1.`mobile`,t1.`officePhone`,t1.email,t1.`otherMobile`,t1.`location`,(SELECT districtName FROM `tbl_district` WHERE districtId = t1.districtId)districtName,(SELECT stateName FROM `tbl_state` WHERE stateId=t1.state)stateName,
           t1.`rating`,t1.`qualification`,t1.`affiliation`,t1.`linkage`,t1.`day`,t1.`time`,t1.`conFace`,t1.`conHome`,t1.`conTel`,t1.`conEmail`,t1.`conOnline`,t1.`conCharges`,t1.`concession`,t1.`latitude`,t1.`longitude`,GROUP_CONCAT((SELECT serviceTypeName FROM `tbl_service_type` WHERE serviceTypeId = t2.serviceTypeId)) services,DATE_FORMAT(t1.createdDate, '%d %M %Y') AS createdDate
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

  	  $this->db->join('tbl_user as t2','t1.createdBy = t2.userId');

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
    
       $sql = "INSERT INTO `tbl_usertype`(userType,createdDate,deleted)VALUES('".$role."',NOW(),'N')";

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
    	$sql = "UPDATE `tbl_usertype` SET userType = '".$this->input->post('role')."' WHERE userTypeId = '".$id."'";

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

	public function checkUserWithMobile($userName,$mobile)
     {
     		$this->db->select('*');

     		$this->db->from('tbl_user');

     		$this->db->where('userName',$userName);

     		$this->db->where("RIGHT(mobileNo,10) = '".substr($mobile,-10)."'");

     		$query = $this->db->get();

     
		  	 $result = $query->result_array();

		     return $result;
     }

   public function getSmsWithUser($smsId)
   {
       /*$this->db->select('*');

       $this->db->from('tbl_sms');

       $this->db->where(['deleted'=>'N','smsId'=>$smsId]);

     		$query = $this->db->get();
     
	  	 $result = $query->result_array();


    	$users = explode(',',$result[0]['users']);

    	if(count($users) > 1)
    	{
    		
    		
    		}
    	}else{
    	      
    		 $result1 =$this->rolemaster->userById($users[0]);
    	}	*/
      	 
   }  




}
