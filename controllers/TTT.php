<?php

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


				$arr_data_new = [];

				for ($i=2; $i < ($limit+2); $i++) { 
				  $arr_data_new[]	= $arr_data[$i];
				}

				
				$j = 0; 
				$total=1;
				$totalCount = 1;

				
				foreach($arr_data_new as $row){
					// $a = $row['A'];
					// $b=str_replace('/','-',$row['A']);
					
					// echo date('Y-m-d',strtotime($b));exit();
					// echo strtotime('10/03/2019').'weeeeeeeeeeeeeeeeeee'; exit();
					print_r(json_encode($row));exit();
					if(trim($row['F']) != ''  && trim($row['I']) != '' && trim($row['J']) != '' && trim($row['W']) != '' && trim($row['X']) != ''  && trim($row['AN']) != '' && trim($row['AO']) != '' )
					{
						

						$len = strlen(trim($row['AA']));

					 $checkRegistertionNumber = $this->rolemaster->checkRegistertionNumber(trim($row['D']));
					 

					
					  	if($len == 10 || $len == 0)
						  {
							$checkStateDistrict = $this->rolemaster->checkStateDistrict(trim($row['W']),trim($row['X']));
							// echo '<pre>';print_r($checkStateDistrict);exit;
							if($checkStateDistrict){
								
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

							     if(empty($checkRegistertionNumber)){
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
									  {  $insert['mobileNo'] = trim($row['AA']);}
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
                                    	 $insert['artDate'] = date('Y-m-d',strtotime(str_replace('/','-',trim($row['BA']))));

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

?>

