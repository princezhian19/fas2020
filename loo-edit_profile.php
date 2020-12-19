<?php

require_once('_includes/setting.php');
require_once('_includes/dbaseCon.php');
require_once('_includes/library.php');
require_once('_includes/sql_statements.php');
require_once('_includes/secure.php');
require_once('personnel/includes/class.upload.php');
require_once('calendar/bdd.php');

$currentuser=$_GET['id'];

$isPersonnel='';
$empid='';
$province= '';
$mun = '';

$link = mysqli_connect("localhost","calaba9_intra","{^-LouqU_vpV", "calaba9_intranetdb");
              if(mysqli_connect_errno()){echo mysqli_connect_error();}  
             

              $query = "SELECT * FROM tblemployee where EMP_N = '".$currentuser."'";
              $result = mysqli_query($link, $query);
              $val = array();
              while($row = mysqli_fetch_array($result))
              {
                $isPersonnel = $row['isPersonnel'];
                $empid=$row['EMP_N'];
                $province = $row['PROVINCE_C'];
                $mun = $row['CITYMUN_C'];
              }
/********************************/
/*	Check access permission 	*/
/********************************/

/*echo "<pre>";
print_r($_SESSION);
echo "</pre>";*/


$msg = "";

if (!empty($_SESSION['message'])){
	$msg = $_SESSION['message'];
	unset($_SESSION['message']);
}

$DBConn = dbConnect();
if (!$DBConn) {
	return false;
}	

$sqltable 	= "tblemployee";
$directory 	= "images/directory/";	
$photo		= false;

// the user click the submit button
if(isset($_POST['save'])){

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
   
        
        
    	  // validate inputs		
    	  $continue 	= true;
    	  $msg 			= array("","");	
    	  $employeeid	= antiSqlinject($_POST["employeeid"]);
    	
    	  $designation	= antiSqlinject($_POST["designation"]);	
    	      	  $e_ename	= antiSqlinject($_POST["e_ename"]);	

    	  $emp_number	= antiSqlinject($_POST["employee_number"]);		  	  				  	  					
    	  $division		= antiSqlinject($_POST["division"]);		  	  				  	  				
    	  $position		= antiSqlinject($_POST["position"]);		
    	  $contact		= antiSqlinject($_POST["contact"]);	
    
    	  $cluster		= antiSqlinject($_POST["cluster"]);	
    	  $office		= antiSqlinject($_POST["office"]);		  
    	  $alter_email	= antiSqlinject($_POST["alter_email"]);	
    	  $cellphone	= antiSqlinject($_POST["cellphone"]);
    	  
    //========================= personal information ===========================
         
      
          if(!isset($lname))     $lname = antiSqlinject($_POST["lname"]);
          else                   $lname = 'N/A';
    	  $fname		= antiSqlinject($_POST["fname"]);
    	  $mname		= antiSqlinject($_POST["mname"]);
      	  $birthdate =    antiSqlinject(date("Y-m-d",strtotime($_POST["birthdate"])));
      	 
      	  $place_of_birth=antiSqlinject($_POST['place_of_birth']);
    	  $gender		= antiSqlinject($_POST["gender"]);	
          $civil_status = antiSqlinject($_POST['civil_status']);
          $blood_type   = antiSqlinject($_POST['blood_type']);
          $weight       = antiSqlinject($_POST['weight']);
          $height       = antiSqlinject($_POST['height']);
          $tel_no       = antiSqlinject($_POST['tel_no']);
          $mob_no       = antiSqlinject($_POST['mob_no']);
      	  $email		= antiSqlinject($_POST["email"]);	
      	  $sss          = antiSqlinject($_POST['sss']);
      	  $dilg_no      = antiSqlinject($_POST['dilg_no']);
                                
      	  $house_no     = antiSqlinject($_POST['house_no']);
      	  $street       = antiSqlinject($_POST['street']);
      	  $brgy         = antiSqlinject($_POST['brgy']);
      	  $mun          = antiSqlinject($_POST['municipality']);
      	  $pro          = antiSqlinject($_POST['province']);
      	  $subdivision = antiSqlinject($_POST['subdivision']);
          $zip_code_post = antiSqlinject($_POST['zip_code']);  
            
      	  $house_no2     = antiSqlinject($_POST['house_no2']);
      	  $street2       = antiSqlinject($_POST['street2']);
      	  $brgy2         = antiSqlinject($_POST['brgy2']);
      	  $mun2          = antiSqlinject($_POST['municipality2']);
      	  $pro2         = antiSqlinject($_POST['province2']);
            $subdivision2 = antiSqlinject($_POST['subdivision2']);
            $zip_code_post2 = antiSqlinject($_POST['zip_code2']);  
      	  
      	  //  ====================== family background ==============================
          $s_lname 		= antiSqlinject($_POST["s_lname"]);
          $s_fname 		= antiSqlinject($_POST["s_fname"]);
          $s_mname 		= antiSqlinject($_POST["s_mname"]);
          $s_ename 		= antiSqlinject($_POST["s_ename"]);
          $mothers_maidenname = antiSqlinject($_POST['m_maidenname']);
          $mothers_fname = antiSqlinject($_POST['m_fname']);
          $mothers_mname = antiSqlinject($_POST['m_mname']);
          $mothers_lname = antiSqlinject($_POST['m_lname']);
        
          $fathers_lname = antiSqlinject($_POST['f_lname']);
          $fathers_fname = antiSqlinject($_POST['f_fname']);
          $fathers_mname = antiSqlinject($_POST['f_mname']);
          $fathers_ename = antiSqlinject($_POST['f_ename']);
            
          $fb_occupation= antiSqlinject($_POST['fb_occupation']);
          $fb_ebusiness_name = antiSqlinject($_POST['fb_ebusiness_name']);
          $fb_buss_address = antiSqlinject($_POST['fb_buss_address']);
          $fb_tel_no        = antiSqlinject($_POST['fb_tel_no']);
          $bd1 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd1"])));
          $bd2 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd2"])));
          $bd3 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd3"])));
          $bd4 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd4"])));
          $bd5 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd5"])));
          $bd6 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd6"])));
          $bd7 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd7"])));
          $bd8 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd8"])));
          $bd9 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd9"])));
          $bd10 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd10"])));
          $bd11 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd11"])));
          $bd12 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd12"])));
          $bd13 		    = antiSqlinject(date("Y-m-d",strtotime($_POST["bd13"])));
          $children1 	= antiSqlinject($_POST["children1"]);
          $children2 	= antiSqlinject($_POST["children2"]);
          $children3 	= antiSqlinject($_POST["children3"]);
          $children4 	= antiSqlinject($_POST["children4"]);
          $children5 	= antiSqlinject($_POST["children5"]);
          $children6 	= antiSqlinject($_POST["children6"]);
          $children7 	= antiSqlinject($_POST["children7"]);
          $children8 	= antiSqlinject($_POST["children8"]);
          $children9 	= antiSqlinject($_POST["children9"]);
          $children10 	= antiSqlinject($_POST["children10"]);
          $children11	= antiSqlinject($_POST["children11"]);
          $children12 	= antiSqlinject($_POST["children12"]);
          $children13 	= antiSqlinject($_POST["children13"]);
          $fb_id1       = antiSqlinject($_POST['fb_id1']);
          $fb_id2       = antiSqlinject($_POST['fb_id2']);
          $fb_id3       = antiSqlinject($_POST['fb_id3']);
          $fb_id4       = antiSqlinject($_POST['fb_id4']);
          $fb_id5       = antiSqlinject($_POST['fb_id5']);
          $fb_id6       = antiSqlinject($_POST['fb_id6']);
          $fb_id7       = antiSqlinject($_POST['fb_id7']);
          $fb_id8       = antiSqlinject($_POST['fb_id8']);
          $fb_id9       = antiSqlinject($_POST['fb_id9']);
          $fb_id10       = antiSqlinject($_POST['fb_id10']);
          $fb_id11      = antiSqlinject($_POST['fb_id11']);
          $fb_id12       = antiSqlinject($_POST['fb_id12']);
          $fb_id13       = antiSqlinject($_POST['fb_id13']);
    //  ================== educational background ===================
    
          
          
   
    // ====================== civil service eligibility ======================

// ========================== work experience ================================
        
          
          $we_id1           = antiSqlinject($_POST['we_id1']);

    //=========================== ORGANIZATIONS ============================
          
          
        //   $organization2           = antiSqlinject($_POST['organization2']);
        //   $inclusive_from2           = antiSqlinject($_POST['inclusive_from2']);
        //   $inclusive_to2           = antiSqlinject($_POST['inclusive_to2']);
        //   $hour2          = antiSqlinject($_POST['hour2']);
        //   $position2           = antiSqlinject($_POST['position2']);
          
        //   $organization3           = antiSqlinject($_POST['organization3']);
        //   $inclusive_from3           = antiSqlinject($_POST['inclusive_from3']);
        //   $inclusive_to3           = antiSqlinject($_POST['inclusive_to3']);
        //   $hour3           = antiSqlinject($_POST['hour3']);
        //   $position3           = antiSqlinject($_POST['position3']);
          
        //   $organization4           = antiSqlinject($_POST['organization4']);
        //   $inclusive_from4           = antiSqlinject($_POST['inclusive_from4']);
        //   $inclusive_to4           = antiSqlinject($_POST['inclusive_to4']);
        //   $hour4           = antiSqlinject($_POST['hour4']);
        //   $position4          = antiSqlinject($_POST['position4']);
          
        //   $o_id2            = antiSqlinject($_POST['o_id2']);
        //   $o_id3            = antiSqlinject($_POST['o_id3']);
        //   $o_id4            = antiSqlinject($_POST['o_id4']);
    // ========================= trainings=====================================
          $tp_program1      = antiSqlinject($_POST['tp_program1']);
          $tp_from1            = antiSqlinject($_POST['tp_from1']); 
          $tp_to1            = antiSqlinject($_POST['tp_to1']); 
          $tp_hours1            = antiSqlinject($_POST['tp_hours1']);
          $tp_id_type1            = antiSqlinject($_POST['tp_id_type1']);
          $tp_sponsored1            = antiSqlinject($_POST['tp_sponsored1']);
          
          $tp_program2      = antiSqlinject($_POST['tp_program2']);
          $tp_from2            = antiSqlinject($_POST['tp_from2']); 
          $tp_to2            = antiSqlinject($_POST['tp_to2']); 
          $tp_hours2            = antiSqlinject($_POST['tp_hours2']);
          $tp_id_type2            = antiSqlinject($_POST['tp_id_type2']);
          $tp_sponsored2            = antiSqlinject($_POST['tp_sponsored2']);
          
          $tp_program3      = antiSqlinject($_POST['tp_program3']);
          $tp_from3            = antiSqlinject($_POST['tp_from3']); 
          $tp_to3            = antiSqlinject($_POST['tp_to3']); 
          $tp_hours3            = antiSqlinject($_POST['tp_hours3']);
          $tp_id_type3            = antiSqlinject($_POST['tp_id_type3']);
          $tp_sponsored3            = antiSqlinject($_POST['tp_sponsored3']);
          
          $tp_program4      = antiSqlinject($_POST['tp_program4']);
          $tp_from4            = antiSqlinject($_POST['tp_from4']); 
          $tp_to4            = antiSqlinject($_POST['tp_to4']); 
          $tp_hours4            = antiSqlinject($_POST['tp_hours4']);
          $tp_id_type4            = antiSqlinject($_POST['tp_id_type4']);
          $tp_sponsored4            = antiSqlinject($_POST['tp_sponsored4']);
          
          $tp_id1            = antiSqlinject($_POST['tp_id1']);
          $tp_id2            = antiSqlinject($_POST['tp_id2']);
          $tp_id3            = antiSqlinject($_POST['tp_id3']);
          $tp_id4            = antiSqlinject($_POST['tp_id4']);
    // ========================== skills and hobbies ===========================
          $s_skills1        = antiSqlinject($_POST['s_skills1']);
          $s_recog1     = antiSqlinject($_POST['s_recog1']);
          $s_org1       = antiSqlinject($_POST['s_org1']);
          
          $s_skills2        = antiSqlinject($_POST['s_skills2']);
          $s_recog2    = antiSqlinject($_POST['s_recog2']);
          $s_org2     = antiSqlinject($_POST['s_org2']);
          
          $s_skills3        = antiSqlinject($_POST['s_skills3']);
          $s_recog3     = antiSqlinject($_POST['s_recog3']);
          $s_org3    = antiSqlinject($_POST['s_org3']);
          
          $s_skills4        = antiSqlinject($_POST['s_skills4']);
          $s_recog4     = antiSqlinject($_POST['s_recog4']);
          $s_org4     = antiSqlinject($_POST['s_org4']);
          
          $s_id1        = antiSqlinject($_POST['s_id1']);
          $s_id2       = antiSqlinject($_POST['s_id2']);
          $s_id3        = antiSqlinject($_POST['s_id3']);
          $s_id4        = antiSqlinject($_POST['s_id4']);
          
          

          
          
          
          
          
          
            
    


          
          
          
          
    	  $datehired    = antiSqlinject(date("Y-m-d",strtotime($_POST["datehired"])));
    	  $dpromotion   = antiSqlinject($_POST["dpromotion"]);
    	  $eligibility1  = antiSqlinject($_POST["eligibility1"]);
    	  $eligibility2  = antiSqlinject($_POST["eligibility2"]);
    	  $eligibility3  = antiSqlinject($_POST["eligibility3"]);
    	  $eligibility4  = antiSqlinject($_POST["eligibility4"]);
    	  $status_app   = antiSqlinject($_POST["status_app"]);
          $salary_grade = antiSqlinject($_POST["salary_grade"]);
          $tin_n        = antiSqlinject($_POST["tin"]);
          $gsis         = antiSqlinject($_POST["gsis"]);
          $pagibig      = antiSqlinject($_POST["pagibig"]);
          $philhealth   = antiSqlinject($_POST["philhealth"]);
    	 
    
    	  if (empty($province)) 	$province = "";
    	  if (empty($municipality))	$municipality = "";
    	  if (empty($employeeid)) 	$employeeid = "";
    	  if (empty($gender)) 		$gender = "";
    	 
    	  if (empty($mname)) 		$mname = "";		
    	  if (empty($email)) 		$email = "";
    	  if (empty($contact)) 		$contact = "";	
    	  if (empty($publish)) 		$publish = "Yes";
    	  if (empty($cluster)) 		$cluster = "";		
    	  if (empty($office)) 		$office = "";
    	  if (empty($alter_email)) 	$alter_email = "";								
    	  if (empty($cellphone)) 	$cellphone = "";			  	
    	  	  
        //  md5($_SESSION['inet_credentials']['code'])
    	  $checkQuery = "SELECT * FROM tblemployee WHERE EMP_N = '".$currentuser."' LIMIT 1";											  
    	  
    		if (!empty($_FILES["file"]["name"]))
    		{			
    			$photo = true;		
    		}
    		else
    		{
    			$photo = false;						
    		}
    				  
    // 		if(
    // 		    !empty($_POST['employee_number']) &&
    // 		    !empty($_POST['datehired']) &&
    // 		    !empty($_POST['place_of_birth']) &&
    // 		    !empty($_POST['height']) &&
    // 		    !empty($_POST['weight']) &&
    // 		    !empty($tel_no) &&
    // 		    !empty($mob_no) &&
    // 		    !empty($email) &&
    // 		    !empty($birthdate) &&
    // 		    !empty($gsis) &&
    // 		    !empty($philhealth) &&
    // 		    !empty($tin_n) &&
    // 		    !empty($pagibig) &&
    // 		    !empty($_POST['fname']) && 
    // 		    !empty($_POST['lname']) 
    		  
    // 		  )
    // 		{		
    			
    			if ($photo)
    			{		
    				if (!empty($_FILES["file"]["name"]))
    				{
    				
                        $errors= array();
                        $extension = pathinfo($_POST['dddd'], PATHINFO_EXTENSION);
                        $file_name = $_FILES["file"]['name'];
                        $file_size =$_FILES["file"]['size'];
                        $file_tmp =$_FILES["file"]['tmp_name'];
                        $file_type=$_FILES["file"]['type'];
                        $file_ext=strtolower(end(explode('.',$_FILES["file"]['name'])));
                        $profile_name = $lname.'-'.$fname;
                        $extensions= array("jpeg","jpg","png");
                        $target_file = 'images/profile/' . basename($_FILES["file"]["name"]);
                        move_uploaded_file($file_tmp,$target_file);
                        $PROFILE = 'images/profile/'.$profile_name.'.'.$extension;
                        $p = "UPDATE `tblemployee` SET `PROFILE` = '$target_file' WHERE `tblemployee`.`EMP_NUMBER` = $currentuser";
                      
                        $bdd->prepare($p)->execute([$PROFILE]); 
    				}
    				else
    				{
    					$msg = array("<strong>Photo</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>",'ERROR'); 	
    				}
    			}
    			else
    			{
    				$msg 			= array("",'INFO'); 	
    				$rndFilename	= "";
    			}															
    
    			if ($continue == true && $msg[1] != "ERROR")
    			{	  
    			
    						$checkQuery = "SELECT PHOTO FROM $sqltable WHERE EMP_N= '".$currentuser."' LIMIT 1";
    						
    						if (ifRecordExist($checkQuery))
    						{
    							$queryRs = $DBConn->query( $checkQuery );	
    						
    							if ($queryRs->num_rows)
    							{
    								$row 	= $queryRs->fetch_assoc();
    								$photo 	= $row["PHOTO"];
    							}
    						}					
    
    						if (!empty($rndFilename))
    						{
    						    
    							// delete then update former photo
    							if (!empty($photo ) && file_exists($directory.$photo)) unlink($directory.$photo);
    							  
    						}
    						
    						else
    						{
    							// photo not edited						
    						  $sql_update_profile = "UPDATE  $sqltable SET
                                                        PAGIBIG_N=?,
                                                        EMP_NUMBER=?,
                                                        PHILH_N=?,
                                                        GSIS_N=?,
    						                            TIN_N=?,
    						                            SALARY_GRADE=?,
    						                            STATUS_OF_APP=?,
    						                            ELIGIBILITY=?,
    						                            DATE_LAST_PROMOTION=?,
    						                            DATE_HIRED=?,
    													LAST_M=?, 
    													FIRST_M=?, 
    													MIDDLE_M=?, 
    													BIRTH_D=?, 
    													SEX_C=?, 
    													PROVINCE_C=?, 
    													CITYMUN_C=?, 
    													POSITION_C=?, 
    													DIVISION_C=?,
    													DESIGNATION=?, 
    													LANDPHONE=?, 
    													EMAIL=?,
    													AGENCY_EMP_NO=?,
    													CLUSTER=?,
    													OFFICE_STATION=?,
    													ALTER_EMAIL=?,
    													MOBILEPHONE=?
    												WHERE EMP_N = '".$currentuser."'";		
    												// md5($_SESSION['inet_credentials']['code'])
                        							$sql_var = 5;
                        							
                        							
                        							$sqlemp = "
                        							  UPDATE  $sqltable SET
                                                        PAGIBIG_N= '$pagibig',
                                                        EMP_NUMBER= '$dilg_no',
                                                        PHILH_N='$philhealth',
                                                        GSIS_N='$gsis',
    						                            TIN_N='$tin_n',
    						                            SALARY_GRADE='$salary_grade',
    						                            STATUS_OF_APP='$status_app',
    						                            ELIGIBILITY='$eligibility2',
    						                            DATE_HIRED='$datehired',
    													LAST_M='$lname', 
    													FIRST_M='$fname', 
    													MIDDLE_M='$mname',
    													BIRTH_D='$birthdate', 
    													SEX_C='$gender', 
    													PROVINCE_C='$pro', 
    													CITYMUN_C='$mun', 
    													POSITION_C='$position', 
    													DIVISION_C='$division',
    													DESIGNATION='$designation', 
    													LANDPHONE='$tel_no', 
    													EMAIL='$email',
    													AGENCY_EMP_NO='$dilg_no',
    													OFFICE_STATION='$office',
    													ALTER_EMAIL='$email',
    													MOBILEPHONE='$mob_no'
    													WHERE EMP_N = '".$currentuser."'";	
    											
    													$bdd->prepare($sqlemp)->execute([]);
    												
    													

                        							$sql ="UPDATE `hris_personnal_information` SET 
                                                        `SEX` = '$gender', 
                                                        `DOB`='$birthdate', 
                                                        `POB`='$place_of_birth', 
                                                        `HEIGHT` = '$height', 
                                                        `WEIGHT`= '$weight', 
                                                        `SSS_NO`='$sss',
                                                        `CIVIL_STATUS`='$civil_status', 
                                                        `BLOOD_TYPE` = '$blood_type',
                                                        `DILG_NO` = '$dilg_no',
                                                        `TEL_NO` = '$tel_no', 
                                                        `MOB_NO` = '$mob_no' ,
                                                        `HOUSE_NO`='$house_no',
                                                        `STREET`='$street',
                                                        `BARANGAY`='$brgy',
                                                        `MUNICIPALITY`='$mun',
                                                        `PROVINCE`='$pro',
                                                        `HOUSE_NO2`='$house_no2',
                                                        `STREET2`='$street2',
                                                        `BARANGAY2`='$brgy2',
                                                        `MUNICIPALITY2`='$mun2',
                                                        `PROVINCE2`='$pro2',
                                                        `SUBDIVISION2`='$subdivision2',
                                                        `SUBDIVISION`='$subdivision',
                                                        `ZIP_CODE` = '$zip_code_post',
                                                        `ZIP_CODE2` = '$zip_code_post2'
                                                        
                                                        where EMP_ID = $currentuser";
                                                     
                                                        $bdd->prepare($sql)->execute([$gender,$birthdate,$place_of_birth,$height,$weight,$civil_status,$blood_type,$tel_no,$mob_no,$email]);

                                                    $sql_emp = "UPDATE  tblemployee SET  `EMP_NUMBER` = '$emp_number', PROVINCE_C = '$pro', CITYMUN_C = '$mun' where EMP_N= $currentuser";
                                                   
                                                    
                                                    $bdd->prepare($sql_emp)->execute([$emp_number,$pro,$mun,$dilg_no]);

                                                    // ====================================================================================================
                                                  $sql66 ="UPDATE `tblemployee` SET `SUFFIX` = '$e_ename', `POSITION_C` = '$position', `DESIGNATION` = '$designation', `DIVISION_C` = '$division', `OFFICE_STATION` = '$office',`STATUS_OF_APP` ='$status_app', `SALARY_GRADE` = '$salary_grade', `DATE_HIRED` = '$datehired'  where EMP_N= $currentuser";
                                     
                                                    $bdd->prepare($sql66)->execute([$datehired,$currentuser,$salary_grade,$status_app,$office,$division,$designation,$position]); 
                                                    
                                                $sql6 ="UPDATE `hris_family_background` SET 
                                                `S_LNAME`= '$s_lname',
                                                `S_FNAME`='$s_fname',
                                                `S_MNAME`='$s_mname',
                                                `S_ENAME`='$s_ename',
                                                `S_OCCUPATION`='$fb_occupation',
                                                `EMPLOYER_BNAME`='$fb_ebusiness_name',
                                                `BUSS_ADD`='$fb_buss_address',
                                                `TEL_NO`='$fb_tel_no'
                                                where EMP_ID= $currentuser ";
                                                $bdd->prepare($sql6)->execute([$s_lname,$s_fname,$s_mname,$s_ename,$fb_occupation,$fb_ebusiness_name,$fb_buss_address,$fb_tel_no]);
                                                
                                                 if(!empty($fb_id1)){
                                                   
                                                     $sql7 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children1',
                                                    `DATE_OF_BIRTH`='$bd1'
                                                     WHERE `ID` = $fb_id1";
                                                     
                                                    $bdd->prepare($sql7)->execute([$children1,$bd1,$fb_id1]);
                                                  }else{
                                                     $sql7 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children1',null,null,null,'$bd1')";
                                                     $bdd->prepare($sql7)->execute([$children1,$bd1,$fb_id1]);
                                                 }
                                                 if(!empty($fb_id2))
                                                 {
                                                    $sql8 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children2',
                                                    `DATE_OF_BIRTH`='$bd2'
                                                     WHERE `ID` = $fb_id2";

                                                    $bdd->prepare($sql8)->execute([$children2,$bd2,$fb_id2]);
                                                     
                                                 }else{
                                                     $sql8 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children2',null,null,null,'$bd2')";
                                                     $bdd->prepare($sql8)->execute([$children2,$bd2,$fb_id2]);
                                                 }
                                                 if(!empty($fb_id3))
                                                 {
                                                     $sql9 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children3',
                                                    `DATE_OF_BIRTH`='$bd3'
                                                     WHERE `ID` = $fb_id3";
                                               
                                                    $bdd->prepare($sql9)->execute([$children3,$bd3,$fb_id3]); 
                                                 }else{
                                                     $sql9 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children3',null,null,null,'$bd3')";
                                                     $bdd->prepare($sql9)->execute([$children3,$bd3,$fb_id3]); 
                                                 }
                                                 if(!empty($fb_id4))
                                                 {
                                                     $sql10 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children4',
                                                    `DATE_OF_BIRTH`='$bd4'
                                                     WHERE `ID` = $fb_id4";
                                                    $bdd->prepare($sql10)->execute([$children4,$bd4,$fb_id4]); 
                                                 }else{
                                                     $sql10 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children4',null,null,null,'$bd4')";
                                                     $bdd->prepare($sql10)->execute([$children4,$bd4,$fb_id4]); 
                                                 }
                                                 if(!empty($fb_id5))
                                                 {
                                                     $sql11 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children5',
                                                    `DATE_OF_BIRTH`='$bd5'
                                                     WHERE `ID` = $fb_id5";
                                                    $bdd->prepare($sql11)->execute([$children5,$bd5,$fb_id5]); 
                                                 }else{
                                                     $sql11 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children5',null,null,null,'$bd5')";
                                                     $bdd->prepare($sql11)->execute([$children5,$bd5,$fb_id5]); 
                                                 }
                                                 
                                                 if(!empty($fb_id6))
                                                 {
                                                     $sql12 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children6',
                                                    `DATE_OF_BIRTH`='$bd6'
                                                     WHERE `ID` = $fb_id6";
                                                    $bdd->prepare($sql12)->execute([$children6,$bd6,$fb_id6]); 
                                                 }else{
                                                     $sql12 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children6',null,null,null,'$bd6')";
                                                     $bdd->prepare($sql12)->execute([$children6,$bd6,$fb_id6]); 
                                                 }
                                                 if(!empty($fb_id7))
                                                 {
                                                     $sql13 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children7',
                                                    `DATE_OF_BIRTH`='$bd7'
                                                     WHERE `ID` = $fb_id7";
                                                    $bdd->prepare($sql13)->execute([$children7,$bd7,$fb_id7]); 
                                                 }else{
                                                     $sql13 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children7',null,null,null,'$bd7')";
                                                     $bdd->prepare($sql13)->execute([$children7,$bd7,$fb_id7]); 
                                                 }
                                                 if(!empty($fb_id8))
                                                 {
                                                     $sql14 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children8',
                                                    `DATE_OF_BIRTH`='$bd8'
                                                     WHERE `ID` = $fb_id8";
                                                    $bdd->prepare($sql14)->execute([$children8,$bd8,$fb_id8]); 
                                                 }else{
                                                     $sql14 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children8',null,null,null,'$bd8')";
                                                     $bdd->prepare($sql14)->execute([$children8,$bd8,$fb_id8]); 
                                                 }
                                                 if(!empty($fb_id9))
                                                 {
                                                     $sql15 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children9',
                                                    `DATE_OF_BIRTH`='$bd9'
                                                     WHERE `ID` = $fb_id9";
                                                    $bdd->prepare($sql15)->execute([$children9,$bd9,$fb_id9]); 
                                                 }else{
                                                     $sql15 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children9',null,null,null,'$bd9')";
                                                     $bdd->prepare($sql15)->execute([$children9,$bd9,$fb_id9]); 
                                                 }
                                                 if(!empty($fb_id10))
                                                 {
                                                     $sql16 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children10',
                                                    `DATE_OF_BIRTH`='$bd10'
                                                     WHERE `ID` = $fb_id10";
                                                    $bdd->prepare($sql16)->execute([$children10,$bd10,$fb_id10]); 
                                                 }else{
                                                     $sql16 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children10',null,null,null,'$bd10')";
                                                     $bdd->prepare($sql16)->execute([$children10,$bd10,$fb_id10]); 
                                                 }
                                                 if(!empty($fb_id11))
                                                 {
                                                     $sql17 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children11',
                                                    `DATE_OF_BIRTH`='$bd11'
                                                     WHERE `ID` = $fb_id11";
                                                    $bdd->prepare($sql17)->execute([$children11,$bd11,$fb_id11]); 
                                                 }else{
                                                     $sql17 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children11',null,null,null,'$bd11')";
                                                     $bdd->prepare($sql17)->execute([$children11,$bd11,$fb_id11]); 
                                                 }
                                                 if(!empty($fb_id12))
                                                 {
                                                     $sql18 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children12',
                                                    `DATE_OF_BIRTH`='$bd12'
                                                     WHERE `ID` = $fb_id12";
                                                    $bdd->prepare($sql18)->execute([$children12,$bd12,$fb_id12]); 
                                                 }else{
                                                     $sql18 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children12',null,null,null,'$bd12')";
                                                     $bdd->prepare($sql18)->execute([$children12,$bd12,$fb_id12]); 
                                                 }
                                                 if(!empty($fb_id13))
                                                 {
                                                     $sql19 = "UPDATE `hris_son_daugther` SET 
                                                    `FULL_NAME` = '$children13',
                                                    `DATE_OF_BIRTH`='$bd13'
                                                     WHERE `ID` = $fb_id13";
                                                    $bdd->prepare($sql19)->execute([$children13,$bd13,$fb_id13]); 
                                                 }else{
                                                     $sql19 ="INSERT INTO `hris_son_daugther`(`ID`, `EMP_ID`, `FULL_NAME`, `FIRST_NAME`, `MIDDLE_NAME`, `LAST_NAME`, `DATE_OF_BIRTH`) 
                                                     VALUES (NULL,$currentuser,'$children13',null,null,null,'$bd13')";
                                                     $bdd->prepare($sql19)->execute([$children13,$bd13,$fb_id13]); 
                                                 }
                                                //  ==============================================================================================
                                                $sql20 = "UPDATE `hris_family_background` SET 
                                                `MOTHER_MAIDENNAME`='$mothers_maidenname',
                                                `MOTHER_LNAME`='$mothers_lname',
                                                `MOTHER_FNAME`='$mothers_fname',
                                                `MOTHER_MNAME`='$mothers_mname',
                                                `FATHER_LNAME`='$fathers_lname',
                                                `FATHER_FNAME`='$fathers_fname',
                                                `FATHER_MNAME`='$fathers_mname',
                                                `FATHER_ENAME`='$fathers_ename'
                                                WHERE EMP_ID= $currentuser ";
                                                $bdd->prepare($sql20)->execute([$mothers_maidenname,$mothers_lname,$mothers_fname,$mothers_mname,$fathers_lname,$fathers_fname,$fathers_mname,$fathers_ename]);
                                                // =================================================================================================

                                               
                                            
                                            
                                            //  ==============================================================================================
                                            for($b=0; $b <count($_POST['csc_id1']); $b++)
                                            {
                                              $eligibility1   =   antiSqlinject($_POST['eligibility1'][$b]);
                                              $rating1        =   antiSqlinject($_POST['rating1'][$b]);
                                              $examination_date1= antiSqlinject(date("Y-m-d",strtotime($_POST['examination_date1'][$b])));
                                              $place_exam1    =   antiSqlinject($_POST['place_exam1'][$b]);
                                              $number1        =   antiSqlinject($_POST['number1'][$b]);
                                              $date_of_validity1= antiSqlinject($_POST['date_of_validity1'][$b]);
                                              $csc_id1          = antiSqlinject($_POST['csc_id1'][$b]);
                                              $sql25 = "UPDATE `hris_eligibility` SET 
                                              `ELIGIBILITY`='$eligibility1',
                                              `RATING`='$rating1',
                                              `EXAMINATION_DATE`='$examination_date1',
                                              `PLACE_OF_EXAMINATION`='$place_exam1',
                                              `NUMBER`='$number1',
                                              `DATE_OF_VALIDITY`='$date_of_validity1' WHERE 
                                              `ID` = '$csc_id1'";
                                              $bdd->prepare($sql25)->execute([$eligibility1,$rating1,$examination_date1,$place_exam1,$number1,$date_of_validity1]);
                                              
                                              $sql255 = "UPDATE `hris_eligibility` SET 
                                              `EXAMINATION_DATE`='0000-00-00'
                                             WHERE `ID` = '$csc_id1' and   `EXAMINATION_DATE` = '1970-01-01'";
                                              $bdd->prepare($sql255)->execute([$csc_id1]);
                                            }

                                          
                                               
                                               
                                            //   ================================================================================================================
                                             
                                               
                                              

          for($c1=0;$c1 < count($_POST['e_from1']); $c1++)
          {
                
            $we_id1 = antiSqlinject($_POST['we_id1'][$c1]);
            $e_from1          = antiSqlinject(date("Y-m-d",strtotime($_POST["e_from1"][$c1])));
            $e_to1          = antiSqlinject(date("Y-m-d",strtotime($_POST["e_to1"][$c1])));
            $position_1          = antiSqlinject($_POST['position_1'][$c1]);
            $company1          = antiSqlinject($_POST['company1'][$c1]);
            $salary1          = antiSqlinject($_POST['salary1'][$c1]);
            $salary_grade1          = antiSqlinject($_POST['salary_grade1'][$c1]);
            $appointment      = antiSqlinject($_POST['appointment'][$c1]);
            $government_service = antiSqlinject($_POST['government_service'][$c1]);

            $sql_we = "DELETE FROM `hris_work_experience` WHERE `hris_work_experience`.`ID` = '$we_id1' ";   
            $bdd->prepare($sql_we)->execute([$we_id1]);
                      
            $sql_we2 ="INSERT INTO `hris_work_experience`(`ID`, `EMP_ID`, `EXCLUSIVE_DATE_FROM`, `EXCLUSIVE_DATE_TO`, `POSITION_TITLE`, `COMPANY`, `SALARY`, `SALARY_GRADE`, `STATUS_OF_APPOINTMENT`, `GOVERNMENT_SERVICE`) 
                     VALUES (null,'$currentuser','$e_from1','$e_to1','$position_1','$company1','$salary1','$salary_grade1','$appointment','$government_service')";
            $bdd->prepare($sql_we2)->execute([$currentuser,$e_from1,$e_to1,$position_1,$company1,$salary1,$salary_grade1,$appointment,$government_service]); 
    
            $sql422 = "DELETE FROM `hris_work_experience` WHERE `hris_work_experience`.`EXCLUSIVE_DATE_FROM` = '1970-01-01' ";   
            $bdd->prepare($sql422)->execute();
           
                      
          }
            









                                            //   =======================================================================
                                           
                                                     
                                           
                                         
for($count=0;$count < count($_POST['tp_from']); $count++)
{
 
          $tp_program1      = antiSqlinject($_POST['tp_program'][$count]);
          $tp_from1            = antiSqlinject((date("Y-m-d",strtotime($_POST['tp_from'][$count])))); 
          $tp_to1            = antiSqlinject((date("Y-m-d",strtotime($_POST['tp_to'][$count])))); 
          $tp_hours1            = antiSqlinject($_POST['tp_hours'][$count]);
          $tp_id_type1            = antiSqlinject($_POST['tp_id_type'][$count]);
          $tp_sponsored1            = antiSqlinject($_POST['tp_sponsored'][$count]);
          $tp_id1            = antiSqlinject($_POST['tp_id'][$count]);
      
    //   echo $tp_from1.'<br>';    

   
$sql41 = "DELETE FROM `hris_trainings` WHERE `hris_trainings`.`ID` = '$tp_id1' ";   
$bdd->prepare($sql41)->execute([$tp_id1]);
            
                     

            
                    $sql40 ="INSERT INTO `hris_trainings`(`ID`, `EMP_ID`, `TITLE_PROGRAM`, `TP_FROM`, `TP_TO`, `NO_OF_HOURS`, `ID_TYPE`, `SPONSORED_BY`) VALUES 
                    (null,'$currentuser','$tp_program1','$tp_from1','$tp_to1','$tp_hours1','$tp_id_type1','$tp_sponsored1')";
                    $bdd->prepare($sql40)->execute([$currentuser,$tp_program1,$tp_from1,$tp_to1,$tp_hours1,$tp_id_type1,$tp_sponsored1]); 
                    $sql42 = "DELETE FROM `hris_trainings` WHERE `hris_trainings`.`TP_FROM` = '1970-01-01' ";   
                    $bdd->prepare($sql42)->execute();
            
           
         
}




                                            $sql44 = "UPDATE `hris_skills` SET 
                                            `SKILLS`='$s_skills1',
                                            `RECOGNITION`='$s_recog1',
                                            `ORGANIZATION`='$s_org1' 
                                            WHERE `ID` = $s_id1";
                                     
                                            $bdd->prepare($sql44)->execute([$s_skills,$s_recog1,$s_org1]); 
                                        
                                        
                                        
                                            $sql44 = "UPDATE `hris_skills` SET 
                                            `SKILLS`='$s_skills2',
                                            `RECOGNITION`='$s_recog2',
                                            `ORGANIZATION`='$s_org2' 
                                            WHERE `ID` = $s_id2";
                                            $bdd->prepare($sql44)->execute([$s_skill2,$s_recog2,$s_org2]); 
                                      
                                        
                                            $sql44 = "UPDATE `hris_skills` SET 
                                            `SKILLS`='$s_skills3',
                                            `RECOGNITION`='$s_recog3',
                                            `ORGANIZATION`='$s_org3' 
                                            WHERE `ID` = $s_id3";
                                            $bdd->prepare($sql44)->execute([$s_skills3,$s_recog3,$s_org3]); 
                                       
                                       
                                            for($incr=0;$incr < count($_POST['r_id']); $incr++)
                                                 {
                                               
                                                  $r_name       = antiSqlinject($_POST['r_name'][$incr]);
                                                  $r_address    = antiSqlinject($_POST['r_address'][$incr]);
                                                  $r_tel        = antiSqlinject($_POST['r_tel'][$incr]);
                                                  $r_id         = antiSqlinject($_POST['r_id'][$incr]);

                                                      $sql45 = "UPDATE `hris_references` SET
                                                        `NAME`='$r_name',
                                                        `ADDRESS`='$r_address',
                                                        `TEL_NO`='$r_tel' 
                                                        WHERE ID = '$r_id'";
                                                      
                                                        $bdd->prepare($sql45)->execute([$r_name,$r_address,$r_tel]);
                                                 }
                                                 
                                                  for($a = 0; $a < count($_POST['chk']); $a++)
                                                  
                                                            {
                                                             $chk_id      = antiSqlinject($_POST['chk_id1'][$a]);
                                                             $question_no    = antiSqlinject($_POST['q_no'][$a]);
                                                             $chk        = antiSqlinject($_POST['chk'][$a]);
                                                             $details        = antiSqlinject($_POST['q1'][$a]);
                                                            
                                                            $sql46 = "UPDATE `hris_questions` 
                                                                SET 
                                                                `QUESTION_NO`= '$question_no',
                                                                `ANSWER`='$chk',
                                                                `DETAILS`='$details'
                                                                WHERE ID = '$chk_id'";
                                                                $bdd->prepare($sql46)->execute([$chk_id,$question_no,$chk,$details]);
                                                                

                                                            }
                                                             $date_filed     = antiSqlinject(date("Y-m-d",strtotime($_POST['date_filed'])));
                                                             $sql47 = "UPDATE `hris_questions` 
                                                                SET 
                                                                `DATE_FILED`='$date_filed'
                                                                WHERE EMP_ID = '$currentuser' and QUESTION_NO = '4'";
                                                                $bdd->prepare($sql47)->execute([$chk_id,$date_filed]);

                                        for($s = 0; $s < count($_POST['a0']); $s++){
                                            $o_id1          = antiSqlinject($_POST['a0'][$s]);
                                            $organization1  = antiSqlinject($_POST['a1'][$s]);
                                            $inclusive_from1= antiSqlinject(date("Y-m-d",strtotime($_POST['a2'][$s])));
                                            $inclusive_to1  = antiSqlinject(date("Y-m-d",strtotime($_POST['a3'][$s])));
                                            $hour1          = antiSqlinject($_POST['a4'][$s]);
                                            $position1      = antiSqlinject($_POST['a5'][$s]);
                                            $sql_del = "DELETE FROM `hris_organizations` WHERE ID = '$o_id1'";
                                            $bdd->prepare($sql_del)->execute([$o_id1]);

                                            $sql_insert = "INSERT INTO `hris_organizations`
                                                         (`ID`, `EMP_ID`, `ORGANIZATION`, `INCLUSIVE_FROM`, `INCLUSIVE_TO`, `NO_OF_HOURS`, `POSITION`) 
                                                         VALUES (null,'$currentuser','$organization1','$inclusive_from1','$inclusive_to1','$hour1','$position1')";
                                            $bdd->prepare($sql_insert)->execute([$currentuser,$inclusive_from1,$inclusive_to1,$hour1,$position1]);
                                                  
                                            $sql_del2 = "DELETE FROM `hris_organizations` WHERE INCLUSIVE_FROM = '1970-01-01'";
                                            $bdd->prepare($sql_del2)->execute([$o_id1]);
                                        }

                                             for($k = 0; $k < count($_POST['school1']); $k++)
                                             {
                                            $school1      = antiSqlinject($_POST['school1'][$k]);
                                            $course1      = antiSqlinject($_POST['course1'][$k]);
                                            $p_from1      = antiSqlinject(date("Y",strtotime($_POST['p_from1'][$k]))).'-01-01';
                                            $p_to1      = antiSqlinject(date("Y",strtotime($_POST['p_to1'][$k]))).'-01-01';
                                            $highest_lvl1      = antiSqlinject($_POST['highest_lvl1'][$k]);
                                            $year_grad1      = antiSqlinject($_POST['year_grad1'][$k]);
                                            $LEVEL = antiSqlinject($_POST['level'][$k]);
                                             $sql211 = "UPDATE `hris_education_background` SET 
                                             `SCHOOL_NAME`='$school1',
                                             `BASIC_EDUCATION_COURSE`='$course1',
                                             `PERIOD_FROM`='$p_from1',
                                             `PERIOD_TO`='$p_to1',
                                             `HIGHEST_LEVEL`='$highest_lvl1',
                                             `YEAR_GRAD`='$year_grad1-00-00'
                                              WHERE `EMP_ID` = $currentuser AND LEVEL = '$LEVEL'";
                                             $bdd->prepare($sql211)->execute([$school1,$course1,$p_from1,$p_to1,$highest_lvl1,$year_grad1]);  
                                             if($p_from1 == '1970-01-01' || $p_to1 == '1970-01-01')
                                             {
                                                          $sql_v = "UPDATE `hris_education_background` SET 
                                             `PERIOD_FROM`='0000-00-00'
                                             WHERE `EMP_ID` = $currentuser AND PERIOD_FROM = '1970-01-01'";
                                             $bdd->prepare($sql_v)->execute([]);  
                                             
                                             $sql_v2 = "UPDATE `hris_education_background` SET 
                                             `PERIOD_TO`='0000-00-00'
                                              WHERE `EMP_ID` = $currentuser AND  PERIOD_TO = '1970-01-01'";
                                             $bdd->prepare($sql_v2)->execute([]);  
                                             }
                                             }

    						}
    					

    				  if (ifRecordExist($checkQuery))
    				  {									  
    						if ($insertSQL = $DBConn->prepare($sql_update_profile)) 
    						{
    							
    							/* bind parameters for markers */
    							if (!empty($sql_var) && $sql_var == 5)	$insertSQL->bind_param("ssssssssssssssssssssssssssss",$pagibig,$dilg_no,$philhealth,$gsis,$tin_n,$salary_grade,$status_app,$eligibility,$dpromotion,$datehired,$lname, $fname, $mname, $birthdate, $gender, $province, $municipality, $position,$division, $designation, $contact, $email, $employeeid, $cluster, $office, $alter_email, $cellphone, $PROFILE);
    							elseif (!empty($sql_var) && $sql_var == 4)	$insertSQL->bind_param("sssssssssssssssssssssssssss",$pagibig,$dilg_no,$philhealth,$gsis,$tin_n,$salary_grade,$status_app,$eligibility,$dpromotion,$datehired,$lname, $fname, $mname, $birthdate, $gender, $province, $municipality, $position,$division, $designation, $contact, $email, $employeeid, $cluster, $office, $alter_email, $cellphone);
    							else 
    							{
    								$updateSQL->close();
    								header("Location: ".$_SERVER['PHP_SELF']);									
    								exit();											
    							}								
    		
    							/* execute query */
    							$insertSQL->execute();							
    											
    							$_SESSION['message'] = array("Record Saved!","INFO");	
    		
    							$data_entry = $datehired.",".$lname.", ".$fname.", ".$mname.", ".$birthdate.", ".$gender.", ".$province.", ".$municipality.", ".$position.",".$division.", ".$designation.", ".$contact.", ".$email.", ".$employeeid.", ".$PROFILE;
    		
    							$records_UID = $insertSQL->insert_id;
    							
    							dbaselogs("Insert ", $sqltable , "id=".antiSqlinject($records_UID), antiSqlinject($data_entry));
    							txtlogs("Insert ", $sqltable, "id=".antiSqlinject($records_UID), antiSqlinject($data_entry));		
    							
    							$insertSQL->close();
    							//update the division
    							$_SESSION['inet_credentials']['division']=$division;
    							print_debug($_POST);
    				// 			header("Location: ".$_SERVER['PHP_SELF']);		
    				            header("Location:edit_profile_form.php?id=".$currentuser."");
    							exit();
    							
    						}	
    						else
    						{
    							//echo mysqli_connect_error();
    						}							  						  
    				  }	
    	  		}
    // 		}
    // 		else{		
    // 			// Validation
    
    // 			$msg = array("<h2></h2>","ERROR");
    // 		    if (empty($_POST['employee_number']))
    // 			{
    // 			    $msg[0] .= "<strong>All fields with asterisk (*) are all required</strong><br/>";
    // 			}
    // 			if (empty($_POST['datehired']))
    // 			{
    // 			    $msg[0] .= "<strong>Date Hired</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    			
    // 			if (empty($lname))
    // 			{
    // 			    $msg[0] .= "<strong>Employee's Surname</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($fname))
    // 			{
    // 			    $msg[0] .= "<strong>Employee's  First Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($mname))
    // 			{
    // 			    $msg[0] .= "<strong>Employee's Middle Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($birthdate))
    // 			{
    // 			    $msg[0] .= "<strong>Birth Date</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($place_of_birth))
    // 			{
    // 			    $msg[0] .= "<strong>Place of Birth</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($gender))
    // 			{
    // 			    $msg[0] .= "<strong>Gender</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($civil_status))
    // 			{
    // 			    $msg[0] .= "<strong>Civil Status</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($blood_type))
    // 			{
    // 			    $msg[0] .= "<strong>Blood Type</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($_POST['weight']))
    // 			{
    // 			    $msg[0] .= "<strong>Weight</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($_POST['height']))
    // 			{
    // 			    $msg[0] .= "<strong>Height</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($tel_no))
    // 			{
    // 			    $msg[0] .= "<strong>Telephone No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($mob_no))
    // 			{
    // 			    $msg[0] .= "<strong>Mobile No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    // 			}
    // 			if (empty($email))
    // 			{
    // 			    $msg[0] .= "<strong>Email</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($sss))
    // 			{
    // 			    $msg[0] .= "<strong>SSS No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($gsis))
    // 			{
    // 			    $msg[0] .= "<strong>GSIS No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($philhealth))
    // 			{
    // 			    $msg[0] .= "<strong>Phil Health No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($tin_n))
    // 			{
    // 			    $msg[0] .= "<strong>TIN No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($pagibig))
    // 			{
    // 			    $msg[0] .= "<strong>PAGIBIG ID No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($dilg_no))
    // 			{
    // 			    $msg[0] .= "<strong>Employee No.</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($s_lname))
    // 			{
    // 			    $msg[0] .= "<strong>Spouse's Surname</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($s_fname))
    // 			{
    // 			    $msg[0] .= "<strong>Spouse's First Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($s_mname))
    // 			{
    // 			    $msg[0] .= "<strong>Spouse's Middle Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($mothers_maidenname))
    // 			{
    // 			    $msg[0] .= "<strong>Mother's Maiden Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($mothers_fname))
    // 			{
    // 			    $msg[0] .= "<strong>Mother's First Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($mothers_mname))
    // 			{
    // 			    $msg[0] .= "<strong>Mother's Middle Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($mothers_lname))
    // 			{
    // 			    $msg[0] .= "<strong>Mother's Surname</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($fathers_lname))
    // 			{
    // 			    $msg[0] .= "<strong>Father's Surname</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($fathers_fname))
    // 			{
    // 			    $msg[0] .= "<strong>Father's First Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($fathers_mname))
    // 			{
    // 			    $msg[0] .= "<strong>Father's Middle Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
                
    //             if (empty($school1))
    // 			{
    // 			    $msg[0] .= "<strong>Elementry School Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($school2))
    // 			{
    // 			    $msg[0] .= "<strong>Secondary School Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }
    //             if (empty($school4))
    // 			{
    // 			    $msg[0] .= "<strong>College School Name</strong> - Required Fields but&nbsp;&nbsp;<em>(Found Empty)</em>.<br/>";
    //             }											
    // 		}		
    		
    }
}



function province($region , $selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}

    $where = "where REGION_C = '".$region."'";
	
	$query = "SELECT PROVINCE_C, LGU_M FROM `tblprovince`  $where ORDER BY LGU_M ASC";
	$data = "";
	$isSelected = "";
	
	$rowRs = $DBConn->query( $query );	

	if ($rowRs->num_rows)
	{
		while ($row = $rowRs->fetch_assoc()) {
			if ((!empty($selected)) && ($row['PROVINCE_C'] == $selected)) 
			    {
			        $isSelected = " selected"; 
			        
			    }else
			    {
			        $isSelected = "";
			    }				
			$data .= "\t\t\t\t<option value='". $row['PROVINCE_C']."'".$isSelected.">".$row['LGU_M']."</option>\n";
		}		
	}	
	$rowRs->close();
	
	return $data;
}

function municipality($province, $selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	

	if (!empty($province))
	{
		$query = "SELECT CITYMUN_C, LGU_M FROM `tblcitymun` WHERE md5(PROVINCE_C) = '".md5($province)."' ORDER BY LGU_M ASC";
		$data = "";
		$isSelected = "";

		$rowRs = $DBConn->query( $query );

		if ($rowRs->num_rows)
		{
			while ($row = $rowRs->fetch_assoc()) {
				if ((!empty($selected)) && ($row['CITYMUN_C'] == $selected)) $isSelected = " selected"; else $isSelected = "";				
				$data .= "\t\t\t\t<option value='". $row['CITYMUN_C']."'".$isSelected.">".$row['LGU_M']."</option>\n";
			}		
			return $data;
		}	
		else return false;
		$rowRs->close();
	}
	else return false;
}

function province2($region , $selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}

    $where = "where md5(REGION_C) = '".md5($region)."'";
	
	$query = "SELECT PROVINCE_C, LGU_M FROM `tblprovince` $where ORDER BY LGU_M ASC";
	$data = "";
	$isSelected = "";
	
	$rowRs = $DBConn->query( $query );	

	if ($rowRs->num_rows)
	{
		while ($row = $rowRs->fetch_assoc()) {
			if ((!empty($selected)) && ($row['PROVINCE_C'] == $selected)) $isSelected = " selected"; else $isSelected = "";				
			$data .= "\t\t\t\t<option value='". $row['PROVINCE_C']."'".$isSelected.">".$row['LGU_M']."</option>\n";
		}		
	}	
	$rowRs->close();
	
	return $data;
}

function municipality2($province, $selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	

	if (!empty($province))
	{
		$query = "SELECT CITYMUN_C, LGU_M FROM `tblcitymun` WHERE md5(PROVINCE_C) = '".md5($province)."' ORDER BY LGU_M ASC";
		$data = "";
		$isSelected = "";

		$rowRs = $DBConn->query( $query );

		if ($rowRs->num_rows)
		{
			while ($row = $rowRs->fetch_assoc()) {
				if ((!empty($selected)) && ($row['CITYMUN_C'] == $selected)) $isSelected = " selected"; else $isSelected = "";				
				$data .= "\t\t\t\t<option value='". $row['CITYMUN_C']."'".$isSelected.">".$row['LGU_M']."</option>\n";
			}		
			return $data;
		}	
		else return false;
		$rowRs->close();
	}
	else return false;
}

function division($selected = "")
{
$DBConn = dbConnect();
if (!$DBConn)
{
return false;
}

$query = "SELECT DIVISION_N, DIVISION_M FROM tblpersonneldivision ORDER BY DIVISION_M ASC";
$data = "";
$isSelected = "";
$rowRs = $DBConn->query($query);
if ($rowRs->num_rows)
{
while ($row = $rowRs->fetch_assoc())
	{
	if ((!empty($selected)) && ($row['DIVISION_N'] == $selected)) $isSelected = " selected";
	  else $isSelected = "";
	$data.= "\t\t\t\t<option value='" . $row['DIVISION_N'] . "'" . $isSelected . ">" . $row['DIVISION_M'] . "</option>\n";
	}
}

$rowRs->close();
return $data;
}

function designation($selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	
	
	$query = "SELECT DESIGNATION_ID, DESIGNATION_M FROM `tbldesignation` ORDER BY DESIGNATION_M ASC";						
	$data = "";
	$isSelected = "";
	
	$rowRs = $DBConn->query( $query );	

	if ($rowRs->num_rows)
	{
		while ($row = $rowRs->fetch_assoc()) {
			if ((!empty($selected)) && ($row['DESIGNATION_ID'] == $selected)) $isSelected = " selected"; else $isSelected = "";				
			$data .= "\t\t\t\t<option value='". $row['DESIGNATION_ID']."'".$isSelected.">".$row['DESIGNATION_M']."</option>\n";
		}		
	}	
	$rowRs->close();
	
	return $data;
}

function position($selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	
	
	$query = "SELECT POSITION_ID, POSITION_M FROM `tbldilgposition` ORDER BY POSITION_M ASC";						
	$data = "";
	$isSelected = "";
	
	$rowRs = $DBConn->query( $query );	

	if ($rowRs->num_rows)
	{
		while ($row = $rowRs->fetch_assoc()) {
			if ((!empty($selected)) && ($row['POSITION_ID'] == $selected)) $isSelected = " selected"; else $isSelected = "";				
			$data .= "\t\t\t\t<option value='". $row['POSITION_ID']."'".$isSelected.">".$row['POSITION_M']."</option>\n";
		}		
	}	
	$rowRs->close();
	
	return $data;
}

function office($selected = "")
{
	$DBConn = dbConnect();
	if (!$DBConn) {
		return false;
	}	
	
	$query = "SELECT OFFICE_C, OFFICE_M FROM `tbloffice` ORDER BY OFFICE_M ASC";						
	$data = "";
	$isSelected = "";
	
	$rowRs = $DBConn->query( $query );	

	if ($rowRs->num_rows)
	{
		while ($row = $rowRs->fetch_assoc()) {
			if ((!empty($selected)) && ($row['OFFICE_C'] == $selected)) $isSelected = " selected"; else $isSelected = "";				
			$data .= "\t\t\t\t<option value='". $row['OFFICE_C']."'".$isSelected.">".$row['OFFICE_M']."</option>\n";
		}		
	}	
	$rowRs->close();
	
	return $data;
}
?>
 <?php
                    $checkQuery = "SELECT * FROM $sqltable WHERE EMP_N = '".$currentuser."' LIMIT 1";	
                    if (ifRecordExist($checkQuery))
                    {               
                        // md5($_SESSION['inet_credentials']['code'])
						//$query = "SELECT id, lastname, firstname, middlename, position_title, email, contactno, dept_id, section_id, ord FROM `$sqltable`  WHERE md5(id) = '".md5($_GET['id'])."' AND dept_id = 5 AND section_id = ".$_SESSION['inet_credentials']["region"]." LIMIT 1";
						$query = "SELECT EMP_N, TIN_N,GSIS_N,PHILH_N,PAGIBIG_N,SALARY_GRADE,DATE_LAST_PROMOTION,STATUS_OF_APP,ELIGIBILITY,DATE_HIRED,EMP_NUMBER,CLUSTER, OFFICE_STATION, ALTER_EMAIL, LANDPHONE, PHOTO, LAST_M, FIRST_M, MIDDLE_M, BIRTH_D, SEX_C, REGION_C, PROVINCE_C, CITYMUN_C, POSITION_C, DESIGNATION, DIVISION_C, MOBILEPHONE, EMAIL, AGENCY_EMP_NO, UNAME, SHOWDETAILS, DEPT_ID, SECTION_ID, EMP_N  FROM `$sqltable` md5(`CODE`) = '".$currentuser."' LIMIT 1";
                        $queryRs = $DBConn->query( $checkQuery );	
                    								
                        if ($queryRs->num_rows)
                        {
                            $row 	= $queryRs->fetch_assoc();
                                                
                            $id		 				= $row["EMP_N"];						
                            $_POST["province"] 		= $row["PROVINCE_C"];	
                            $_POST["municipality"]	= $row["CITYMUN_C"];	
                            $_POST["employeeid"]	= $row["AGENCY_EMP_NO"];								
                            $_POST["lname"] 		= $row["LAST_M"];	
                            $_POST["fname"] 		= $row["FIRST_M"];								
                            $_POST["mname"] 		= $row["MIDDLE_M"];	
                            $_POST["gender"] 		= $row["SEX_C"];	
                            $_POST["designation"]	= $row["DESIGNATION"];															
                            $_POST["position"] 		= $row["POSITION_C"];								
                            $_POST["birthdate"] 	= $row["BIRTH_D"];																													
                            $_POST["email"] 		= $row["EMAIL"];																						
                            $_POST["contact"] 		= $row["LANDPHONE"];	
                            $_POST["publish"] 		= $row["SHOWDETAILS"];
							$_POST["uname"]			= $row["UNAME"];	
							$_POST['division']      = $row['DIVISION_C'];
                            $_POST["cluster"]		= $row["CLUSTER"];		
                            $_POST["office"]		= $row["OFFICE_STATION"];																				
                            $_POST["alter_email"] 	= $row["ALTER_EMAIL"];		
                            $_POST["cellphone"] 	= $row["MOBILEPHONE"];	
                            $_POST["employee_number"] = $row["EMP_NUMBER"];
                            $_POST['region']        = $row['REGION_C'];
							$photo					= $row['PROFILE'];
							$date_of_promotion=$row['DATE_LAST_PROMOTION'];
                            $tin_n=$row['TIN_N'];
                            $gsis_n =$row['GSIS_N'];
                            $philhealth_n=$row['PHILH_N'];
                            $pagibig_n=$row['PAGIBIG_N'];
							$salary_grade=$row['SALARY_GRADE'];
							$_POST['date_hired']  = new DateTime($row['DATE_HIRED']);
							$s_appointment=$row['STATUS_OF_APP'];
                            $dhired = $_POST['date_hired']->format('F d, Y');
                            if(strtotime($dhired)== strtotime('0000-00-00 00:00:00')){
                            $dhired = '';
                            }else{
                            $dhired_format = date("Y-m-d",strtotime($dhired));
                            }
                            $eligibility = $row['ELIGIBILITY'];
                            if(strtotime($date_of_promotion)== strtotime('0000-00-00 00:00:00')){
                            $date_of_promotion = '';
                            
                            }else{
                            $date_of_promotion_format = date("Y-m-d",strtotime($date_of_promotion));
                            }
							
                        }
                    }				  
                ?>   
                <?php 
                    $id = $_GET['id'];
                    $con = mysqli_connect("localhost","calaba9_intra","{^-LouqU_vpV", "calaba9_intranetdb");
                    $selectQ = mysqli_query($con,"
                    SELECT 
                    SUFFIX,
                    LAST_M,
                    FIRST_M,
                    MIDDLE_M,
                    `EMP_ID`, 
                    `SEX`,
                    `DOB`, 
                    `POB`, 
                    `HEIGHT`, 
                    `WEIGHT`, 
                    `BLOOD_TYPE`, 
                    hris_personnal_information.`CIVIL_STATUS`, 
                    tblprovince.LGU_M AS province,
                    tblcitymun.LGU_M AS municipality,
                    CITIZENSHIP,
                    DUAL_CITIZENSHIP,
                    `MOB_NO`, 
                    `TEL_NO`, 
                    hris_personnal_information.`EMAIL`, 
                    tblemployee.`GSIS_N`,
                    hris_personnal_information.`SSS_NO`,
                    tblemployee.`EMP_NUMBER`,
                    tblemployee.`PAGIBIG_N`, 
                    tblemployee.`PHILH_N`, 
                    `SSS_NO`, 
                    tblemployee.`TIN_N`, 
                    `DILG_NO`, 
                    `HOUSE_NO`, 
                    `STREET`, 
                    `SUBDIVISION`,
                    `SUBDIVISION2`, 
                    `BARANGAY`, 
                    `MUNICIPALITY`, 
                    `PROVINCE`, 
                    `ZIP_CODE`,
                    `HOUSE_NO2`, 
                    `STREET2`, 
                    `BARANGAY2`, 
                    `MUNICIPALITY2`, 
                    `PROVINCE2`, 
                    `ZIP_CODE2`
                    
                    from hris_personnal_information 
                    LEFT JOIN tblemployee on hris_personnal_information.EMP_ID = tblemployee.EMP_N
                    LEFT JOIN tblregion ON tblemployee.REGION_C = tblregion.REGION_C
                    LEFT JOIN tblprovince ON tblemployee.PROVINCE_C = tblprovince.PROVINCE_C AND tblemployee.REGION_C = tblprovince.REGION_C
                    LEFT JOIN tblcitymun ON tblemployee.REGION_C = tblcitymun.REGION_C AND tblemployee.PROVINCE_C = tblcitymun.PROVINCE_C AND tblemployee.CITYMUN_C = tblcitymun.CITYMUN_C
                    
                    where EMP_ID  = '$currentuser' ");
                    
                    $row1 = mysqli_fetch_array($selectQ);
                    $suffix =   $row1['SUFFIX'];
                    $fname  =   $row1['FIRST_M'];
                    $mname  =   $row1['MIDDLE_M'];
                    $lname  =   $row1['LAST_M'];
                    $dob    =   $row1['DOB'];
                    $gender =   $row1['SEX'];
                    $pob    =   $row1['POB'];
                    $citizenship = $row1['CITIZENSHIP'];
                    $dual_citizenship = $row1['DUAL_CITIZENSHIP'];
                    $civil_status   =   $row1['CIVIL_STATUS'];
                    $height =   $row1['HEIGHT'];
                    $weight =   $row1['WEIGHT'];
                    $blood_type =   $row1['BLOOD_TYPE'];
                    $tel_no =   $row1['TEL_NO'];
                    $mob_no =   $row1['MOB_NO'];
                    $email  =   $row1['EMAIL'];
                    $gsis   =   $row1['GSIS_N'];
                    $philhealth= $row1['PHILH_N'];
                    $sss = $row1['SSS_NO'];
                    $en = $row1['EMP_NUMBER'];
                    $tin    =   $row1['TIN_N'];
                    $pagibig=   $row1['PAGIBIG_N'];
                    $house =    $row1['HOUSE_NO'];
                    $street=    $row1['STREET'];
                    $subdivision=$row1['SUBDIVISION'];
                    $province= $row1['province'];
                    $zip_code=$row1['ZIP_CODE'];
                    $municipality = $row1['municipality'];
                    $barangay = $row1['BARANGAY'];
                    
                     $house22 =    $row1['HOUSE_NO2'];
                    $street22=    $row1['STREET2'];
                    $province22= $row1['PROVINCE2'];
                    $zip_code22=$row1['ZIP_CODE2'];
                    $municipality22 = $row1['MUNICIPALITY2'];
                    $barangay22 = $row1['BARANGAY2'];
                    $subdivision22=$row1['SUBDIVISION2'];
                    
                    $select_fb = mysqli_query($con,"SELECT 
                    `ID`, 
                    `EMP_ID`, 
                    `S_LNAME`, 
                    `S_FNAME`, 
                    `S_MNAME`, 
                    `S_ENAME`, 
                    `EMPLOYER_BNAME`, 
                    `BUSS_ADD`, 
                    `S_OCCUPATION`,
                    `TEL_NO`, `FATHER_LNAME`, 
                    `FATHER_FNAME`, `FATHER_MNAME`, 
                    `FATHER_ENAME`, `MOTHER_MAIDENNAME`,
                    `MOTHER_LNAME`, `MOTHER_FNAME`, 
                    `MOTHER_MNAME`
                    FROM `hris_family_background` WHERE `EMP_ID` = $currentuser");
                    $row = mysqli_fetch_array($select_fb);
                    $S_LNAME = $row['S_LNAME'];
                    $S_FNAME = $row['S_FNAME'];
                    $S_MNAME = $row['S_MNAME'];
                    $S_ENAME = $row['S_ENAME'];
                    $EMPLOYER_BNAME = $row['EMPLOYER_BNAME'];
                    $BUSS_ADD = $row['BUSS_ADD'];
                    $OCCUPATION = $row['S_OCCUPATION'];
                    $TEL_NO = $row['TEL_NO'];
                    $FATHER_LNAME = $row['FATHER_LNAME'];
                    $FATHER_FNAME = $row['FATHER_FNAME'];
                    $FATHER_MNAME = $row['FATHER_MNAME'];
                    $FATHER_ENAME = $row['FATHER_ENAME'];
                    $MOTHER_MAIDENNAME = $row['MOTHER_MAIDENNAME'];
                    $MOTHER_LNAME = $row['MOTHER_LNAME'];
                    $MOTHER_FNAME = $row['MOTHER_FNAME'];
                    $MOTHER_MNAME = $row['MOTHER_MNAME'];
                    $SD_LNAME = $row['SD_LNAME'];
                    $SD_FNAME = $row['SD_FNAME'];
                    $SD_MNAME = $row['SD_MNAME'];
                    $SD_DOB = $row['SD_DOB'];
                    $S_OCCUPATION = $row['S_OCCUPATION'];
                    
                     $select_son_daugther = mysqli_query($con,"SELECT `EMP_ID`, `FULL_NAME`,`DATE_OF_BIRTH` FROM `hris_son_daugther` WHERE EMP_ID  = '$currentuser'");
                     $row2 = mysqli_fetch_array($select_son_daugther);
                     $FULLNAME = $row2['FULL_NAME'];
                     $F_DOB = $row2['DATE_OF_BIRTH'];
            // =============================================================================
            // ============================= CHILDREN INFO =================================
                    $select_child_info = mysqli_query($con,"SELECT 
                    hris_son_daugther.ID,
                    LAST_M,
                    FIRST_M,
                    MIDDLE_M,
                    hris_son_daugther.LAST_NAME,
                    hris_son_daugther.FIRST_NAME,
                    hris_son_daugther.MIDDLE_NAME,
                    hris_family_background.`EMP_ID`,
                    hris_son_daugther.`FULL_NAME` AS son_daughter,
                    hris_son_daugther.DATE_OF_BIRTH 
                    FROM `hris_family_background` 
                    LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                    LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                    WHERE hris_family_background.EMP_ID = '".$currentuser."'");
                    $row = mysqli_fetch_array($select_child_info);
                    
                    $fullname = $row['son_daughter'];
                    $date_of_birth = $row['DATE_OF_BIRTH'];
                    $f = $row['FIRST_M'];
                    $l = $row['LAST_M'];
                    $m = $row['MIDDLE_M'];
                    $LAST_NAME = $row['LAST_NAME'];
                    $FIRST_NAME = $row['FIRST_NAME'];
                    $MIDDLE_NAME = $row['MIDDLE_NAME'];
               

                ?>  
                 <?php
                    $checkQuery = "SELECT * FROM $sqltable WHERE EMP_N = '".$currentuser."' LIMIT 1";	
                    if (ifRecordExist($checkQuery))
                    {               
                        // md5($_SESSION['inet_credentials']['code'])
						//$query = "SELECT id, lastname, firstname, middlename, position_title, email, contactno, dept_id, section_id, ord FROM `$sqltable`  WHERE md5(id) = '".md5($_GET['id'])."' AND dept_id = 5 AND section_id = ".$_SESSION['inet_credentials']["region"]." LIMIT 1";
						$query = "SELECT EMP_N, TIN_N,GSIS_N,PHILH_N,PAGIBIG_N,SALARY_GRADE,DATE_LAST_PROMOTION,STATUS_OF_APP,ELIGIBILITY,DATE_HIRED,EMP_NUMBER,CLUSTER, OFFICE_STATION, ALTER_EMAIL, LANDPHONE, PHOTO, LAST_M, FIRST_M, MIDDLE_M, BIRTH_D, SEX_C, REGION_C, PROVINCE_C, CITYMUN_C, POSITION_C, DESIGNATION, DIVISION_C, MOBILEPHONE, EMAIL, AGENCY_EMP_NO, UNAME, SHOWDETAILS, DEPT_ID, SECTION_ID, EMP_N  FROM `$sqltable` md5(`CODE`) = '".$currentuser."' LIMIT 1";
                        $queryRs = $DBConn->query( $checkQuery );	
                    								
                        if ($queryRs->num_rows)
                        {
                            $row 	= $queryRs->fetch_assoc();
                                                
                            $id		 				= $row["EMP_N"];						
                            $_POST["province"] 		= $row["PROVINCE_C"];	
                            $_POST["municipality"]	= $row["CITYMUN_C"];	
                            $_POST["employeeid"]	= $row["AGENCY_EMP_NO"];								
                            $_POST["lname"] 		= $row["LAST_M"];	
                            $_POST["fname"] 		= $row["FIRST_M"];								
                            $_POST["mname"] 		= $row["MIDDLE_M"];	
                            $_POST["gender"] 		= $row["SEX_C"];	
                            $_POST["designation"]	= $row["DESIGNATION"];															
                            $_POST["position"] 		= $row["POSITION_C"];								
                            $_POST["birthdate"] 	= $row["BIRTH_D"];																													
                            $_POST["email"] 		= $row["EMAIL"];																						
                            $_POST["contact"] 		= $row["LANDPHONE"];	
                            $_POST["publish"] 		= $row["SHOWDETAILS"];
							$_POST["uname"]			= $row["UNAME"];	
							$_POST['division']      = $row['DIVISION_C'];
                            $_POST["cluster"]		= $row["CLUSTER"];		
                            $_POST["office"]		= $row["OFFICE_STATION"];																				
                            $_POST["alter_email"] 	= $row["ALTER_EMAIL"];		
                            $_POST["cellphone"] 	= $row["MOBILEPHONE"];	
                            $_POST["employee_number"] = $row["EMP_NUMBER"];
							$photo					= $row['PROFILE'];
							$date_of_promotion=$row['DATE_LAST_PROMOTION'];
                            $tin_n=$row['TIN_N'];
                            $gsis_n =$row['GSIS_N'];
                            $philhealth_n=$row['PHILH_N'];
                            $pagibig_n=$row['PAGIBIG_N'];
							$salary_grade=$row['SALARY_GRADE'];
							$_POST['date_hired']  = new DateTime($row['DATE_HIRED']);
							$s_appointment=$row['STATUS_OF_APP'];
                            $dhired = $_POST['date_hired']->format('F d, Y');
                            if(strtotime($dhired)== strtotime('0000-00-00 00:00:00')){
                            $dhired = '';
                            }else{
                            $dhired_format = date("Y-m-d",strtotime($dhired));
                            }
                            $eligibility = $row['ELIGIBILITY'];
                            if(strtotime($date_of_promotion)== strtotime('0000-00-00 00:00:00')){
                            $date_of_promotion = '';
                            
                            }else{
                            $date_of_promotion_format = date("Y-m-d",strtotime($date_of_promotion));
                            }
							
                        }
                    }				  
                ?>   
                <?php 
                    $id = $_GET['id'];
                    $con = mysqli_connect("localhost","calaba9_intra","{^-LouqU_vpV", "calaba9_intranetdb");
                    $selectQ = mysqli_query($con,"
                    SELECT 
                    LAST_M,
                    FIRST_M,
                    MIDDLE_M,
                    `EMP_ID`, 
                    `SEX`,
                    `DOB`, 
                    `POB`, 
                    `HEIGHT`, 
                    `WEIGHT`, 
                    `BLOOD_TYPE`, 
                    hris_personnal_information.`CIVIL_STATUS`, 
                    tblprovince.LGU_M AS province,
                    tblcitymun.LGU_M AS municipality,
                    CITIZENSHIP,
                    DUAL_CITIZENSHIP,
                    `MOB_NO`, 
                    `TEL_NO`, 
                    hris_personnal_information.`EMAIL`, 
                    tblemployee.`GSIS_N`,hris_personnal_information.`SSS_NO`,tblemployee.`EMP_NUMBER`, tblemployee.`PAGIBIG_N`, tblemployee.`PHILH_N`, `SSS_NO`, tblemployee.`TIN_N`, `DILG_NO`, `HOUSE_NO`, `STREET`, `SUBDIVISION`, `BARANGAY`, `MUNICIPALITY`, `PROVINCE`, `ZIP_CODE` 
                    
                    from hris_personnal_information 
                    LEFT JOIN tblemployee on hris_personnal_information.EMP_ID = tblemployee.EMP_N
                    LEFT JOIN tblregion ON tblemployee.REGION_C = tblregion.REGION_C
                    LEFT JOIN tblprovince ON tblemployee.PROVINCE_C = tblprovince.PROVINCE_C AND tblemployee.REGION_C = tblprovince.REGION_C
                    LEFT JOIN tblcitymun ON tblemployee.REGION_C = tblcitymun.REGION_C AND tblemployee.PROVINCE_C = tblcitymun.PROVINCE_C AND tblemployee.CITYMUN_C = tblcitymun.CITYMUN_C
                    
                    where EMP_ID  = '$currentuser' ");
                    
                    $row1 = mysqli_fetch_array($selectQ);
                    $fname  =   $row1['FIRST_M'];
                    $mname  =   $row1['MIDDLE_M'];
                    $lname  =   $row1['LAST_M'];
                    $dob    =   $row1['DOB'];
                    $gender =   $row1['SEX'];
                    $pob    =   $row1['POB'];
                    $citizenship = $row1['CITIZENSHIP'];
                    $dual_citizenship = $row1['DUAL_CITIZENSHIP'];
                    $civil_status   =   $row1['CIVIL_STATUS'];
                    $height =   $row1['HEIGHT'];
                    $weight =   $row1['WEIGHT'];
                    $blood_type =   $row1['BLOOD_TYPE'];
                    $tel_no =   $row1['TEL_NO'];
                    $mob_no =   $row1['MOB_NO'];
                    $email  =   $row1['EMAIL'];
                    $gsis   =   $row1['GSIS_N'];
                    $philhealth= $row1['PHILH_N'];
                    $sss = $row1['SSS_NO'];
                    $en = $row1['EMP_NUMBER'];
                    $tin    =   $row1['TIN_N'];
                    $pagibig=   $row1['PAGIBIG_N'];
                    $house =    $row1['HOUSE_NO'];
                    $street=    $row1['STREET'];
                    $subdivision=$row1['SUBDIVISION'];
                    $province= $row1['province'];
                    $zip_code=$row1['ZIP_CODE'];
                    $municipality = $row1['municipality'];
                    $barangay = $row1['BARANGAY'];
                    
                    $select_fb = mysqli_query($con,"SELECT 
                    `ID`, 
                    `EMP_ID`, 
                    `S_LNAME`, 
                    `S_FNAME`, 
                    `S_MNAME`, 
                    `S_ENAME`, 
                    `EMPLOYER_BNAME`, 
                    `BUSS_ADD`, 
                    `S_OCCUPATION`,
                    `TEL_NO`, `FATHER_LNAME`, 
                    `FATHER_FNAME`, `FATHER_MNAME`, 
                    `FATHER_ENAME`, `MOTHER_MAIDENNAME`,
                    `MOTHER_LNAME`, `MOTHER_FNAME`, 
                    `MOTHER_MNAME`
                    FROM `hris_family_background` WHERE `EMP_ID` = $currentuser");
                    $row = mysqli_fetch_array($select_fb);
                    $S_LNAME = $row['S_LNAME'];
                    $S_FNAME = $row['S_FNAME'];
                    $S_MNAME = $row['S_MNAME'];
                    $S_ENAME = $row['S_ENAME'];
                    $EMPLOYER_BNAME = $row['EMPLOYER_BNAME'];
                    $BUSS_ADD = $row['BUSS_ADD'];
                    $OCCUPATION = $row['S_OCCUPATION'];
                    $TEL_NO = $row['TEL_NO'];
                    $FATHER_LNAME = $row['FATHER_LNAME'];
                    $FATHER_FNAME = $row['FATHER_FNAME'];
                    $FATHER_MNAME = $row['FATHER_MNAME'];
                    $FATHER_ENAME = $row['FATHER_ENAME'];
                    $MOTHER_MAIDENNAME = $row['MOTHER_MAIDENNAME'];
                    $MOTHER_LNAME = $row['MOTHER_LNAME'];
                    $MOTHER_FNAME = $row['MOTHER_FNAME'];
                    $MOTHER_MNAME = $row['MOTHER_MNAME'];
                    $SD_LNAME = $row['SD_LNAME'];
                    $SD_FNAME = $row['SD_FNAME'];
                    $SD_MNAME = $row['SD_MNAME'];
                    $SD_DOB = $row['SD_DOB'];
                    $S_OCCUPATION = $row['S_OCCUPATION'];
                    
                     $select_son_daugther = mysqli_query($con,"SELECT `EMP_ID`, `FULL_NAME`,`DATE_OF_BIRTH` FROM `hris_son_daugther` WHERE EMP_ID  = '$currentuser'");
                     $row2 = mysqli_fetch_array($select_son_daugther);
                     $FULLNAME = $row2['FULL_NAME'];
                     $F_DOB = $row2['DATE_OF_BIRTH'];
            // =============================================================================
            // ============================= CHILDREN INFO =================================
                    $select_child_info = mysqli_query($con,"SELECT 
                    hris_son_daugther.ID,
                    LAST_M,
                    FIRST_M,
                    MIDDLE_M,
                    hris_son_daugther.LAST_NAME,
                    hris_son_daugther.FIRST_NAME,
                    hris_son_daugther.MIDDLE_NAME,
                    hris_family_background.`EMP_ID`,
                    hris_son_daugther.`FULL_NAME` AS son_daughter,
                    hris_son_daugther.DATE_OF_BIRTH 
                    FROM `hris_family_background` 
                    LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                    LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                    WHERE hris_family_background.EMP_ID = '".$currentuser."'");
                    $row = mysqli_fetch_array($select_child_info);
                    
                    $fullname = $row['son_daughter'];
                    $date_of_birth = $row['DATE_OF_BIRTH'];
                    $f = $row['FIRST_M'];
                    $l = $row['LAST_M'];
                    $m = $row['MIDDLE_M'];
                    $LAST_NAME = $row['LAST_NAME'];
                    $FIRST_NAME = $row['FIRST_NAME'];
                    $MIDDLE_NAME = $row['MIDDLE_NAME'];
               

                ?>  
<?php require_once($folderpath.'_includes/header_top.php'); ?>

   	<script type="text/javascript">

        function getProvinces(){

              $('#provincecontainer').load('ajax/getprovinces.php?<?php echo $_SERVER['QUERY_STRING']?>&region='+$('#region').val());
               //alert('lol');
        }
        function getCitymun(){
            //  alert('lol');
              $('#citymuncontainer').load('ajax/getcitymun.php?<?php echo $_SERVER['QUERY_STRING']?>&province='+$('#province').val()+'&region='+$('#region').val());
        }

        function getFilters(){
            //  alert('wtf');
              $('#searchFiltersContainer').load('ajax/searchoptions.php?<?php echo $_SERVER['QUERY_STRING']; ?>&searchby='+$('#searchby').val(),
              function(){
                if($('#searchby').val()=='LGU/Area'){
                $('#regioncontainer').load('ajax/getregions.php?<?php echo $_SERVER['QUERY_STRING']; ?>',function(){
                getProvinces();
                $.ajax({async:false})
                getCitymun();

                });
                }
              });

            }

            $(function(){
                getFilters();
                $('#searchby').change(function(){getFilters();});
            });



		$(document).ready(function() {
			
			$(".page_link").change(function(){
				var id=$(this).val();
	            getProAge(id);		
			});
			function getProAge(page)
			{			
				if (page != '' || page == 0){											
					$.get("directory-section-list.php",{ p: page },
					function(data){
						$('.proage').html(data.slist);				
					}, "json");   
				}
			}					

			var oid=$(".page_link").val()
			var cid=$(".proage").val()			
			if (oid == '' && cid == '' )
			{
	            getProAge(0);
			}	
			else
			{
	            getProAge(oid);				
			}
			
			//$(".view_details tr").click(function() {
				//window.location.href = $(this).find("a").attr("href");
			//});
			
		 });



    </script>
    <style type="text/css"> 
	.curve{
		-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.1); 
		-moz-box-shadow: 0 1px 3px rgba(0,0,0,.1); 
		box-shadow: 0 1px 3px rgba(0,0,0,.1);
		-moz-border-radius: 4px; 
		-webkit-border-radius: 4px; 	
		border-radius: 4px; 
		border:1px solid #f5f5f5;
		background-color:#f5f5f5; 
		font-size:14px;
		font-weight:bold;
		margin-bottom:4px;
		padding:10px 20px;
	}
	.acc_trigger{
		-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.1);
		-moz-box-shadow: 0 1px 3px rgba(0,0,0,.1);
		box-shadow: 0 1px 3px rgba(0,0,0,.1);
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px; 	
		border-radius: 4px; 
		border:1px solid #f5f5f5; 		
		background-color:#f5f5f5; 
		font-size:14px; 
		font-weight:bold;
		margin-bottom:4px;
		padding:10px 20px; 
	} 
	.acc_trigger a{ color:#666; text-decoration:none; }
	.acc_trigger a:hover{ color:#000000; }
	.acc_container{ 
		-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.1); 
		-moz-box-shadow: 0 1px 3px rgba(0,0,0,.1); 
		box-shadow: 0 1px 3px rgba(0,0,0,.1); 	
		-moz-border-radius: 4px; 
		-webkit-border-radius: 4px; 	
		border-radius: 4px; 	
		background-color:#FFF; 
		border:1px solid #f5f5f5; 
		padding:0 20px;
	}
	.post h2{ border-bottom:1px solid #0060a5; color:#0060a5; font-size:15px; font-weight:bold; margin-bottom:20px; padding-bottom:10px; }

.article-container {
  display: flex;
  flex-wrap: wrap;
}

.article {
  flex-grow: 1;
  flex-basis: 50%;
}

.article:after {
  content: "";
  flex: auto;
}
.center{
  width: 100%;
  height: 100%;
  margin: auto;
  text-align: center;
}

.pull-center{
    text-align:center;
     margin: auto;
}
.hide{
  display:none;
}
.show{
  display:block;
}
/*#pds_table td, #pds_table th {*/
/*  border-left: 5px solid black;*/
/*  border-right: 5px solid black;*/
/*  border-top: 2px solid black;*/
/*}*/
	</style>
	<script type="text/javascript" src="js/zebra_datepicker.js"></script>
	<link rel="stylesheet" href="css/zebra_datepicker_metallic.css" type="text/css">
   	<link rel="stylesheet" href="chosen/chosen.css">
   	<link rel="stylesheet" type="text/css" href="DataTables/datatables.css">
   	<script src="js/datetimepicker_css.js"></script>
    <script type="text/javascript" charset="utf8" src="DataTables/datatables.js"></script>
    <script src="chosen/chosen.jquery.js" 	type="text/javascript"></script>
    <script src="chosen/docsupport/prism.js" 	type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		var descid=$("#designation").val()
        if(descid!=null){
		if (descid.indexOf("60") >= 0 ) { $('.cluster').css("display","block"); }
        }

		$(".region_link").change(function(){
			var id=$(this).val();
            getProvince(id);		
		});
		$(".province_link").change(function(){
			var id=$(this).val();
            getMunicipality(id);		
		});	
		function getProvince(page)
		{
			if (page != '' || page == 0){															
				$.post("province-list.php",{ r: page },
				function(data){
					$('.province_link').html(data.plist);				
				}, "json");   
			}				
		}	
		function getMunicipality(mpage)
		{
          //  alert(mpage);
			if (mpage != '' || mpage == 0){																			
				$.post("municipality-list.php",{ p: mpage },
				function(mdata){
					$('.municipality_link').html(mdata.slist);
				}, "json");   
			}
							
		}	
		
		
		
		$(".province_link2").change(function(){
			var id=$(this).val();
            getMunicipality2(id);		
		});	
		function getProvince2(page)
		{
			if (page != '' || page == 0){															
				$.post("province-list.php",{ r: page },
				function(data){
					$('.province_link2').html(data.plist);				
				}, "json");   
			}				
		}	
		function getMunicipality2(mpage)
		{
          //  alert(mpage);
			if (mpage != '' || mpage == 0){																			
				$.post("municipality-list.php",{ p: mpage },
				function(mdata){
					$('.municipality_link2').html(mdata.slist);
				}, "json");   
			}
							
		}
		
		$(".reg_link").change(function(){
			var id=$(this).val();
            getPro(id);		
		});
		$(".pro_link").change(function(){
			var id=$(this).val();
            getMun(id);		
		});
		
		function getPro(page)
		{	
			if (page != '' || page == 0){															
				$.post("province-list.php",{ r: page },
				function(data){
					$('.pro_link').html(data.plist);				
				}, "json");   
			}				
		}	
		function getMun(mpage)
		{				
			if (mpage != '' || mpage == 0){																			
				$.post("municipality-list.php",{ p: mpage },
				function(mdata){						
					$('.mun_link').html(mdata.slist);		
				}, "json");   
			}
							
		}			
										
	 });	
				
</script>    
<?php require_once('_includes/header_top.php'); ?>
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.0"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.0" media="screen" />
	<script type="text/javascript" src="js/zebra_datepicker.js"></script>
	<link rel="stylesheet" href="css/zebra_datepicker_metallic.css" type="text/css">
   	<link rel="stylesheet" href="chosen/chosen.css">
	<script src="js/datetimepicker_css.js"></script>
   	<script type="text/javascript">
		$(document).ready(function() {
			$("#fname, #mname, #lname").change(function(){
				$("#username").val(($.trim($("#fname").val()).charAt(0)+$.trim($("#mname").val()).charAt(0)+$("#lname").val().replace(/[\. ,-]+/g, "")).toLowerCase());
			});
			$("#designation").chosen();
			$('input.birthdate1').Zebra_DatePicker({
				offset:[6,216]
			});		
					
			$(".fileBrowser").fancybox({		
				'maxWidth'			: 800,
				'maxHeight'			: 600,
				'fitToView'			: false,
				'width'				: '70%',
				'height'			: '70%',
				'autoSize'			: false,			
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'							
			});	
			
			$(".popup").fancybox({		
				'maxWidth'			: 800,
				'maxHeight'			: 600,
				'fitToView'			: false,
				'width'				: '70%',
				'height'			: '70%',
				'autoSize'			: false,
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe',
				'afterClose'		: function() { location.reload();}								
			});	
			
			$("#designation").change(function(){
				var id=$(this).val();
				$("#designation").trigger("chosen:updated");
				if (id.indexOf("60") >= 0) 	{ $('.cluster').css("display","block"); }
				else					{ $('.cluster').css("display","none"); }
			});	
			
			var descid=$("#designation").val()
            if(descid!=null){
			if (descid.indexOf("60") >= 0 ) { $('.cluster').css("display","block"); }
            }

			$(".region_link").change(function(){
				var id=$(this).val();
	            getProvince(id);		
			});
			$(".province_link").change(function(){
				var id=$(this).val();
	            getMunicipality(id);		
			});	
			function getProvince(page)
			{
				if (page != '' || page == 0){															
					$.post("province-list.php",{ r: page },
					function(data){
						$('.province_link').html(data.plist);				
					}, "json");   
				}				
			}	
			function getMunicipality(mpage)
			{
              //  alert(mpage);
				if (mpage != '' || mpage == 0){																			
					$.post("municipality-list.php",{ p: mpage },
					function(mdata){
						$('.municipality_link').html(mdata.slist);
					}, "json");   
				}
								
			}	
			
			$(".reg_link").change(function(){
				var id=$(this).val();
	            getPro(id);		
			});
			$(".pro_link").change(function(){
				var id=$(this).val();
	            getMun(id);		
			});
			
			function getPro(page)
			{	
				if (page != '' || page == 0){															
					$.post("province-list.php",{ r: page },
					function(data){
						$('.pro_link').html(data.plist);				
					}, "json");   
				}				
			}	
			function getMun(mpage)
			{				
				if (mpage != '' || mpage == 0){																			
					$.post("municipality-list.php",{ p: mpage },
					function(mdata){						
						$('.mun_link').html(mdata.slist);		
					}, "json");   
				}
								
			}			
											
		 });	
       function confirmDelete(id, rno) {
        var msg = "Are you sure you want to delete record no. "+rno+" ?";
            if ( confirm(msg) ) {
                window.location = "<?php echo $_SERVER['PHP_SELF']; ?>?option=del&id="+id;
            }
        }
		function copyToClipboard(text) {
		  window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
		}					
    </script>      
</head>

<body>
  <?php
  //require_once('_includes/dbaseCon.php');

$DBConn = dbConnect();
if (!$DBConn) {
  return false;
}
    $query='SELECT DIVISION_M,DIVISION_N from tblpersonneldivision ORDER BY DIVISION_M ASC';

       
// echo '<pre>';
$select= getData($DBConn,$query);
?>
<div id="trueModal" class="p-5 fancybox-content" style="display: none; max-width: 500px;max-height: 500px;">
     <h3 class="gradient_white"><span>Incoming Communications Monitoring Log Sheet </span></h3>
<div class="box_gray">
  <div class="box_content">
<form method="POST" action="excel_export_incoming_records.php">
  <table>
    <tr>
  <label>Date Added :<input placeholder = "N/A"class="subtxt" id="date" type="text" name="date"></label><br>
  <label>Office :</label>
  <select name="division" class="subtxt"
                                <option value=''></option>
                                <?php
                                $data1 = array();
                                foreach ($select as $key) { ?>
                                 <option value='<?php echo $key['DIVISION_N']; ?>'><?php echo $key['DIVISION_M']; ?></option>
                                   <?php
                                    } ?>
                                </select> 
      <label>Added By : <input placeholder = "N/A"type="checkbox" value="<?php echo $_SESSION['inet_credentials']['id']?>" name="by_me"></label><br>

      <input placeholder = "N/A"type="submit" name="submit" value="Submit" class="button white normalrounded">
</tr>
</table>

</form>

</div>
</div>
<span class="close">x</span>
    </div>
    <div id="fb-root"></div>
        <script>
$(window).load(function() {
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=10154088378963702";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
});

</script>
            <div id="pagewrap">
                <header id="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <hgroup>
      <h1 id="site-logo"><img src="<?php echo $folderpath; ?>images/logo_DILG_intranetlatesttopabahaha.png" width="AUTO" height="119"></h1>
      <h2 id="site-description">DILG(Department of the Interior and Local Government) Intranet</h2>
    </hgroup>
      <nav>
      <ul id="main-nav" class="dropdown">
        <li><a href="<?php echo $folderpath; ?>index.php">Home</a></li>
        <li><a href="<?php echo $folderpath; ?>directory_test.php">Personnel</a></li>
        <li><a href="<?php echo $folderpath; ?>records_search.php">Records</a></li>
        <li><a href="<?php echo $folderpath; ?>news.php">News</a></li>
        <li><a href="eventcalendar.php">Events</a></li>
        <li><a href="<?php echo $folderpath; ?>announcement.php">Announcements</a></li>
        <li><a href="<?php echo $folderpath; ?>issuances.php">Issuances</a>
        <!--  <ul class="dropdown-content">
            <li><a href="#">REGIONAL ORDER</a></li>
          </ul> --></li>
        <li><a href="<?php echo $folderpath; ?>downloads.php">Databank</a>
          <!-- <ul class="dropdown-content">
            <li><a href="#">ISO FORMS</a></li>
          </ul> -->
        </li>
        <li><a href="<?php echo $folderpath; ?>help.php">Help</a></li>
      </ul>
    </nav>
<!--    <form id="searchform">
      <p><input placeholder = "N/A"type="search" id="s"></p>
    </form>-->
  </header> 
                    <div id="content" style="margin-left:-9%;width:85%;">

<?php	
	if (!empty($msg))
	{
		echo msgBoxArray($msg);
	}	
?>
<style>
    .article-container {
  display: flex;
  flex-wrap: wrap;
}

.article {
  flex-grow: 1;
  flex-basis: 50%;
}

.article:after {
  content: "";
  flex: auto;
}
.center{
  width: 100%;
  height: 100%;
  margin: auto;
  text-align: center;
}

.pull-right{
    text-align:center;
     margin: auto;
}



table{
    width:100%;
    font-size:12px;
    /* margin-left:-32px; */
      border-spacing: 0;
        border-collapse: collapse;


}
 td:first-child {
  padding:2px;
  background-color:#B0BEC5;
}

 td:last-child {
  padding:7px;
  /*text-indent:20px;*/
}
th{
    background-color:#455A64;
    font-style: 'Arial Narrow';
}
.pull-right{
    float:right;
}
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
  .image-upload>input {
  display: none;
  }
  /*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}







.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4;
  width:auto;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
.setDateIcon{
background-image:url(images/cal.gif); 
background-repeat: no-repeat; 
background-position: 215px 5px;
}
	 #confirmBox2 button {
      background-color: #ccc;
      display: inline-block;
      border-radius: 3px;
      border: 1px solid #aaa;
      padding: 2px;
      text-align: center;
      width: 80px;
      cursor: pointer;
    }
    #confirmBox2 button:hover
    {
      background-color: #ddd;
    }
    #confirmBox2 .message
    {
      text-align: center;
      margin-bottom: 8px;
  	  font-weight: bold;

    }
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: #37474F; /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 20%;
      height:17%;
      text-align: center;

    }

</style>
<div class="box_gray" id = "user_pipanel" style = "margin-left:-50px;width:125%;">
    <h3 class="gradient_white"><span>Edit Profile</span></h3>
        <div class="box_content"> 
            <form id="changepassword" name="changepassword" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" enctype="multipart/form-data" class="myformStyle" >    
                <fieldset>
                    <legend>Employee Information Status</legend>
                        <div class="article-container">
                            <div class="article">
                                <p>
                                    <label style = "font-size:12px;"><span class="required">*</span> Employee No:</label>
                                    <input placeholder = "N/A"  placeholder = "N/A" type="text" name="employee_number" id="employeeid" class="alphanum subtxt " <?php if (isset($en)) echo "value = '$en'"; ?> style = "width:225px;"  />    
                                </p>
                                <p>
                                    <?php 
                                    $dateh=date_create($dhired_format);
                                    
                                    ?>
                                    <label style = "font-size:12px;"><span class="required">*</span> Date Hired:</label>
                                    <input placeholder = "N/A"placeholder = "N/A" type="text" name="datehired" id="datehired" class="setDateIcon alphanum subtxt " style = "width:225px;"value="<?php echo date_format($dateh,"F d, Y");?>" />    
                                </p>
                                <!--<p>-->
                                <!--    <label style = "font-size:12px;">Last Promotion:</label>-->
                                <!--    <input placeholder = "N/A" type="text" name="dpromotion" id="dpromotion" class="alphanum subtxt size250" value="<?php echo $date_of_promotion_format;?>" />    -->
                                <!--</p>-->
                                <p>
                                    <label><span class="required">*</span>Status of Appointment:</label>
                                        <select name="status_app" class="status_app dropdown size250">
                                        <?php
                                            switch($s_appointment){
                                                case 'Permanent':
                                                echo '
                                                <option value="Permanent" selected>Permanent</option>
                                                <option value="Temporary">Temporary</option>';
                                                break;
                                                case 'Temporary':
                                                echo '
                                                <option value="Permanent" >Permanent</option>
                                                <option value="Temporary" selected>Temporary</option>';
                                                break;
                                                default:
                                                echo '
                                                <option value="Permanent" >Permanent</option>
                                                <option value="Temporary" >Temporary</option>';
                                            }
                                        ?>
                                        </select>
                                </p>
                                <p>
                                    <label><span class="required">*</span>Salary Grade:</label>
                                        <select name="salary_grade" class="salary_grade dropdown size250">
                                        <?php
                                        for($a=1; $a<=32; $a++){
                                        if($a == $salary_grade)
                                        {
                                        ?>
                                        <option selected value="<?php echo $a;?>"><?php echo $a;?></option>
                                        <?php
                                        }else{
                                        ?>
                                        
                                        <option value="<?php echo $a;?>"><?php echo $a;?></option>
                                        <?php
                                        }
                                        }
                                        ?>
                                        </select>
                                </p>
                                
                    <p>
                    <label>&nbsp;</label>                      
                    
                    </p>
                    </div>
                            <div class="article">
                                <p>
                                    <label><span class="required">*</span>Office Station</label>
                                    <select name="office" class="office dropdown size250">
                                            <option></option>        
                                            <?php
                                            if (!empty($_POST["office"])) 	echo office($_POST["office"]);
                                            else							echo office();
                                            ?>                                                    
                                    </select>
                                </p>
                                <p>
                                    <label><span class="required">*</span>Division</label>
                                    <?php if ($_SESSION['inet_credentials']['access_type']=="admin") {?>
                                        <select name="division" class="division dropdown size250">
                                            <option></option>        
                                            <?php
                                            if (!empty($_POST["designation"])) 	echo division($_POST["division"]);
                                            else								echo division();
                                            ?>                                                    
                                        </select>
                                    <?php } else { ?>
                                       <select name="division" class="designation dropdown  size250">
                                            <option></option>        
                                            <?php
                                            if (!empty($_POST["designation"])) 	echo division($_POST["division"]);
                                            else								echo division();
                                            ?>                                                    
                                        </select>
                                    <?php }?>
                                        
                                </p>
                                 <p>
                        <label><span class="form_indicator">*</span> Designation:</label>
                          <select name="designation" class="designation dropdown size250">
                              <option></option>        
                              <?php
                                if (!empty($_POST["designation"])) 	echo designation($_POST["designation"]);
                                else								echo designation();
                              ?>                                                    
                          </select>
                      </p>
                                <p>
                                    <label><span class="required">*</span>Position</label>
                                    <select name="position" class="dropdown size250">-->
                                            <option></option>        
                                            <?php
                                            if (!empty($_POST["position"])) 	echo position($_POST["position"]);
                                            else								echo position();
                                            ?>                                                    
                                        </select> 
                                </p>
                            </div>
                        </div>
                </fieldset>
<div id="myModal2" class="modal">
        <div class="modal-content">
            <div id="confirmBox2">
                <div class="message"></div>
                    <span style = "float:left;border: 1px solid black;" class="yes white normalrounded ">Yes</span>
                    <span style = "float:right;border:1px solid black;" class="no white normalrounded">No</span>
            </div>
        </div>
    </div>

                    <div class="box_content"> 
                        <table border = "1" style = "width:auto;"  id = "pds_table" >
                            <tbody>
<!----=========================================================================>
<!----========================BASIC INFORMATION============================---->
                                <thead>
                                    <th style = "text-align:left;padding:10px;color:#fff;font-family: 'Arial Narrow';" colspan=7><i>I. PERSONAL INFORMATION</i><a href = "pds_record_save.php?id=<?php echo $_GET['id'];?>"><span  class = "pull-right" style = "color:#fff;border:1px solid #fff;">Download PDS</span></a></th>
                                </thead>
                                <tr>
                                    <td></td>
                                    <td colspan = 5 style = "text-indent:5px;padding:7px;"></td>
                                    <td rowspan = 4>
                                        <div class = "image-upload">
                                      <label for="file-input">   <img id="img"   style="text-align:center;overflow: hidden;width:167px;height:167px;border:1px solid black;" 
                                    src="
                                    <?php 
                                    $extension = pathinfo($photo, PATHINFO_EXTENSION);
                                      switch($extension)
                                    {
                                        case 'jpg':
                                            if($photo == '')
                                            {
                                                echo'images/male-user.png';
                                                
                                            }
                                            else if ($photo == $photo)
                                            {
                                            echo $photo;
                                            }
                                            
                                            break;
                                        case 'png':
                                            if($photo == '')
                                            {
                                                echo'images/male-user.png';
                                            }
                                            else if ($photo == $photo)
                                            {
                                            echo $photo;
                                            }
                                            
                                            break;
                                        default:
                                            echo'images/male-user.png';
                                            break;
                                    }
                                    
                                    ?>"  title = "Choose File" /></label><br>
                                    <input placeholder = "N/A"id ="file-input"class="pull-right" type="file" name="file" id="image"  onchange="readURL(this)" />
                                    <input placeholder = "N/A"type ="hidden" name = "dddd" value="images/profiles/<?php echo $_POST["lname"].'-';?><?php echo $_POST["fname"].'.'.$extension;?>" />
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>2. SURNAME</td>
                                    <td colspan=5 style = "text-indent:5px;padding:7px;"><?php echo '<input placeholder = "N/A"placeholder = "N/A" name = "lname" class = "alphanum subtxt" type = "text" value = "'.$lname.'" />';?></td>
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>FIRST NAME</td>
                                    <td colspan = 6 style = "text-indent:5px;padding:7px;"><?php echo '<input placeholder = "N/A"placeholder = "N/A" name = "fname" class = "alphanum subtxt" type = "text" value = "'.$fname.'" />';?></td>

                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>MIDDLE NAME</td>
                                    <td style = "text-indent:5px;padding:7px;"><?php echo '<input placeholder = "N/A"placeholder = "N/A" name = "mname" class = "alphanum subtxt" type = "text" value = "'.$mname.'" />';?></td>
                                    <td  style = "text-indent:10px;  background-color:#B0BEC5;">NAME EXTENSION (JR., SR)</td>
                                    <td  colspan = 3><?php echo '<input placeholder = "N/A" name = "e_ename" class = "alphanum subtxt" type = "text" value = "'.$suffix.'" />';?></td>
                                </tr>
                                <tr>
                                    <?php
                                    $date=date_create($dob);
                                    ?>
                                    <td><label><span class="required">*</span>3. DATE OF BIRTH (mm/dd/yyyy)</td>
                                    <td style = "text-indent:5px;padding:7px;" colspan = 6>
                                        <input placeholder = "N/A"  text="text" name = "birthdate" id = "birthdate" class = "alphanum subtxt" style = "width:150px;background-image:url(images/cal.gif);background-repeat: no-repeat;background-position: 215px 5px;"  value = "<?php echo date_format($date,"F d, Y"); ?>" />
                                    </td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>4. PLACE OF BIRTH</label></td>
                                    <td style = "text-indent:5px;padding:7px;" colspan = 6><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "place_of_birth" class = "alphanum subtxt" type = "text" value = "'.$pob.'" />';?></td>
                                 
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>5. SEX</label></td>
                                    <td style = "text-indent:5px;padding:7px;">
                                        <input name="gender" class = "checkboxgroup_gender" type = "checkbox" value="Male" <?php if (!empty($_POST["gender"]) && $_POST["gender"] == 'Male') echo 'checked ';?>>Male
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="gender" class = "checkboxgroup_gender" type = "checkbox" value="Female" <?php if (!empty($_POST["gender"]) && $_POST["gender"] == 'Female') echo 'checked ';?>>Female
                                    </td>
                                    <td style = "text-indent:10px;  background-color:#B0BEC5;vertical-align:top" rowspan = 2>16. CITIZENSHIP</td>
                                    <td colspan = 4>
                                        <input type = "checkbox" value = "Filipino"/>Filipino
                                        <input type = "checkbox" value = "Dual Citizenship"/>Dual Citizenship
                                        <input type = "checkbox" value = "by birth"/>by birth
                                        <input type = "checkbox" value = "by naturalization"/>by naturalization
                                    </td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>6. CIVIL STATUS</label></td>
                                    <td>
                                         &nbsp;&nbsp;&nbsp;&nbsp;<input name="civil_status" class = "checkboxgroup_status" type = "checkbox" value="Single" <?php if (!empty($civil_status) && $civil_status == 'Single') echo 'checked ';?>>Single
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="civil_status" class = "checkboxgroup_status" type = "checkbox" value="Married" <?php if (!empty($civil_status) && $civil_status == 'Married') echo 'checked ';?>>Married<br>
                                         &nbsp; &nbsp;&nbsp;<input name="civil_status" class = "checkboxgroup_status" type = "checkbox" value="Widowed" <?php if (!empty($civil_status) && $civil_status == 'Widowed') echo 'checked ';?>>Widowed
                                         &nbsp;&nbsp;  &nbsp;&nbsp;<input name="civil_status" class = "checkboxgroup_status" type = "checkbox" value="Separated" <?php if (!empty($civil_status) && $civil_status == 'Separated') echo 'checked ';?>>Separated<br>
                                         &nbsp;&nbsp;&nbsp;&nbsp;<input name="civil_status" class = "checkboxgroup_status" type = "checkbox" value="Others" <?php if (!empty($civil_status) && $civil_status == 'Others') echo 'checked ';?>>Others
                                    </td>
                                    <td style = "text-align:left;" colspan = 4>
                                    <div class="autocomplete" style="width:300px;">
                                        <input style = "margin-left:5px;max-width:100%;" placeholder = "N/A"id="myInput" type="text" class = "alphanum subtxt" name="myCountry" placeholder="Country" value = "<?php echo $citizenship;?>">
                                    </div>
                                    </td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>7. HEIGHT (m)</td>
                                    <td style = "text-align:left;">
                                        <?php
                                        if(isset($height) && $height != 0 )
                                        {
                                            ?>
                                             <?php echo '<input placeholder = "N/A"id="edValue" onInput="showCurrentValue(event)" onkeyPress=validate(event) class = "show alphanum subtxt" type = "text" value = "'.$height.'"  />';?>
                                        <?php echo '<input placeholder = "N/A"placeholder = "N/A"value = "'.$height.'" name = "height" class = "show alphanum subtxt" type = "hidden"  id="lblValue" readonly/>'; ?>
                                            <?php
                                        }else{
                                            $height = 'N/A';
                                            ?>
                                            <input placeholder = "N/A"type="button" name="answer" id = "convert" value="Convert cm to ft." onclick="onButtonClick()" />
                                        <?php echo '<input placeholder = "N/A"placeholder = "N/A"id="edValue" onInput="showCurrentValue(event)" onkeyPress=validate(event) class = "hide alphanum subtxt" type = "text"  value = "'.$height.'" />';?>
                                        <?php echo '<input placeholder = "N/A"placeholder = "N/A" value = "'.$height.'" name = "height" class = "hide alphanum subtxt" type = "hidden"  id="lblValue" readonly/>'; ?>
                                            <?php
                                        }
                                        
                                        ?>
                                        
                                    </td>
                                    <td style = "text-indent:10px;  background-color:#B0BEC5;vertical-align:top" rowspan = 3>
                                        17. RESIDENTIAL ADDRESS
                                    </td>
                                    <td><?php echo '<input style = "margin-left:5px;" placeholder = "House No."name = "house_no" class = "alphanum subtxt" type = "text" value = "'.$house.'" />';?></td>
                                    <td style = "text-align:center;"><input placeholder = "Street" name = "street" class = "alphanum subtxt" type = "text" value = "<?php echo $street; ?>" /></td>
                                    <td colspan = 2 style = "text-align:center;"><input style = "width:90%;" placeholder = "Subdivision" name = "subdivision" class = "alphanum subtxt" type = "text" value = "<?php echo $subdivision; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>8. WEIGHT (kg.)</td>
                                    <td style = "text-align:left;"><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "weight" class = "alphanum subtxt" type = "text" value = "'.$weight.'" />';?></td>
                                    <td><?php echo '<input style = "max-width:100%;margin-left:5px;" placeholder = "Barangay" name = "brgy" class = "alphanum subtxt" type = "text" value = "'.$barangay.'" />';?></td>
                                    <td>
                                        <select name="municipality" class="municipality_link dropdown" style = "max-width:100%;" >
                              <option></option>
                              <?php
                                if (!empty($_POST["municipality"])) 	echo municipality($_POST["province"], $_POST["municipality"]) ;
                              ?>                                                                                                           
                          </select>
                                    </td>
                                    <td colspan = 2>
                                        <select name="province" class="province_link dropdown" style = "max-width:90%;">
                                          <option></option>
                                              <?php
                                                if (!empty($_POST["province"])) 	echo province($_POST["region"],$_POST['province']);
                                                else								echo province('04');
                                              ?>
                                      </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>9. BLOOD TYPE</label></td>
                                    <td>
                                        <select name="blood_type" class="dropdown" style = "width:170px;">
                                            <?php
                                            switch($blood_type){
                                                case 'AB -'
                                                ?>
                                                    <option value = "AB -" selected>AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'B -'
                                                ?>
                                                    <option value = "AB -" >AB -</option>
                                                    <option value = "B -" selected>B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'AB +'
                                                ?>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +" selected>AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'A -'
                                                ?>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -" selected>A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'O -'
                                                ?>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -" selected>O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'B +'
                                                ?>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +" selected>B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'AB +'
                                                ?>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +" selected>AB +</option>
                                                    <option value = "O +">O +</option>
                                                <?php
                                                break;
                                                case 'O +'
                                                ?>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +" selected>O +</option>
                                                <?php
                                                break;
                                                default:
                                                    ?>
                                                    <option value = "N/A" selected>N/A</option>
                                                    <option value = "AB -">AB -</option>
                                                    <option value = "B -">B -</option>
                                                    <option value = "AB +">AB +</option>
                                                    <option value = "A -">A -</option>
                                                    <option value = "O -">O -</option>
                                                    <option value = "B +">B +</option>
                                                    <option value = "A +">AB +</option>
                                                    <option value = "O +">O +</option>
                                                    <?php
                                                    break;
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td colspan = 4><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "zip_code" class = "alphanum subtxt" type = "text" value = "'.$zip_code.'" />';?></td>

                                 

                                        
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>10. GSIS ID NO.</label></td>
                                    <td><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "gsis" class = "alphanum subtxt" type = "text" value = "'.$gsis.'" />';?></td>
                                    <td style = "text-indent:10px;  background-color:#B0BEC5;vertical-align:top" rowspan = 3>
                                        18. PERMANENT ADDRESS
                                    </td>
                                    <td><?php echo '<input style = "margin-left:5px;" placeholder = "House No." name = "house_no2" class = "alphanum subtxt" type = "text" value = "'.$house22.'" />';?></td>
                                    <td><input placeholder = "Street" name = "street2" class = "alphanum subtxt" type = "text" value = "<?php echo $street22; ?>" /></td>
                                    <td colspan = 2 style = "text-align:center"><input style = "width:90%" placeholder = "Subdivision" name = "subdivision2" class = "alphanum subtxt" type = "text" value = "<?php echo $subdivision22; ?>" /></td>
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>11. PAG-IBIG ID NO.</label></td>
                                    <td><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "pagibig" class = "alphanum subtxt" type = "text" value = "'.$pagibig.'" />';?></td>
                                    <td><?php echo '<input style = "margin-left:5px;max-width:100%;" placeholder = "Barangay" name = "brgy2" class = "alphanum subtxt" type = "text" value = "'.$barangay22.'" />';?></td>
                                    <td>                                      
                                    <select name="municipality2" class="municipality_link2 dropdown size250">
                              <option></option> 
                              <?php
                                if (!empty($_POST["municipality"])) 	echo municipality2($province22, $municipality22) ;
                              ?>                                                                                                           
                          </select>
                                    </td>
                                    <td colspan = 2>
                                        <select name="province2" class="province_link2 dropdown size250">
                                          <option></option>
                                              <?php
                                                if (!empty($_POST["province"])) 	echo province2($_POST["region"], $province22);
                                                else								echo province2('04');
                                              ?>
                                      </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label><span class="required">*</span>12. PHILHEALTH NO.</label></td>
                                    <td><?php echo '<input placeholder = "PhilHealth ID" name = "philhealth" class = "alphanum subtxt" type = "text" value = "'.$philhealth.'" />';?></td>
                                     <td colspan = 4><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "zip_code2" class = "alphanum subtxt" type = "text" value = "'.$zip_code22.'" />';?></td>
                                </tr>

                                <tr>
                                    <td><label><span class="required">*</span>13. SSS NO .</label></td>
                                    <td><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "sss" class = "alphanum subtxt" type = "text" value = "'.$sss.'" />';?></td>
                                    <td style = "background-color:#B0BEC5;"><label><span class="required">*</span>19. TELEPHONE NO.</td>
                                   <td colspan=6><?php echo '<input placeholder = "Na/A"placeholder = "N/A"name = "tel_no" class = "alphanum subtxt" type = "text" value = "'.$tel_no.'" />';?></td>
                                </tr>
                                <tr>                               
                                    <td style = "background-color:#B0BEC5;"><label><span class="required">*</span>14. TIN NO.</label></td>
                                    <td><?php echo '<input placeholder = "N/A"placeholder = "N/A"name= "tin" class = "alphanum subtxt" type = "text" value = "'.$tin.'" />';?></td>
                                    <td style = "background-color:#B0BEC5;"><label><span class="required">*</span>21. E-MAIL ADDRESS (if any)</td>
                                    <td colspan=6><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "email" class = "alphanum subtxt" type = "text" value = "'.$email.'" />';?></td>
                                </tr>
                                <tr>
                                    <td style = "background-color:#B0BEC5;"><label><span class="required">*</span>15. AGENCY EMPLOYEE NO.</label></td>
                                    <td><?php echo '<input placeholder = "N/A"placeholder = "N/A"name= "dilg_no" class = "alphanum subtxt" type = "text" value = "'.$en.'" />';?></td>
                                    <td style = "background-color:#B0BEC5;"><label><span class="required">*</span>20. MOBILE NUMBER</td>
                                 <td colspan=6><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "mob_no" class = "alphanum subtxt" type = "text" value = "'.$mob_no.'" />';?></td>
                                </tr>
                                
                                
                                <?php
                                $link = mysqli_connect("localhost","calaba9_intra","{^-LouqU_vpV", "calaba9_intranetdb");
                                ?>
                                <thead>
                                    <th style = "text-align:left;padding:10px;color:#fff;" colspan=7>II. FAMILY BACKGROUND</th>
                                </thead>
                                <tr>
                                    <td><label><span class="required">*</span>22. SPOUSE'S SURNAME</label></td>
                                    <td style = "text-indent:10px;" colspan=3><?php echo '<input placeholder = "Spouse Surname" name = "s_lname" class = "alphanum subtxt" type = "text" value = "'.$S_LNAME.'" />';?></td>
                                    <td style = "text-align:center;" colspan = 2><label><span class="required">*</span>23. NAME of CHILDREN (Write full name and list all)</label></td>
                                    <td style = "text-align:center;"><label><span class="required">*</span>DATE OF BIRTH (mm/dd/yyyy)</label></td>
                                </tr>
                                <!--children 1-5-->
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>FIRST NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "First Name" name = "s_fname" class = "alphanum subtxt" type = "text" value = "'.$S_FNAME.'" />';?></td>
                                    <td style = "text-indent:10px;background-color:#B0BEC5;">NAME EXTENSION(JR., SR.)</label></td>
                                    <td><?php echo '<input placeholder = "N/A"placeholder = "N/A"name = "s_ename" class = "alphanum subtxt" type = "text" value = "'.$S_ENAME.'" />';?></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();} 
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' order by hris_son_daugther.ID LIMIT 1";
                                            $result = mysqli_query($link, $query);
                                            $val1 = '';
                                            // echo $query;
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_1 = $rowz['son_daughter'];
                                                        $val1 = $rowz['ID'];
                                                        $bd = $rowz['DATE_OF_BIRTH'];
                                                       
                                                        $date=date_create($bd);
                                                        
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children" name = "children1" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_1; ?>" />
                                                        <input placeholder = "N/A"placeholder = "N/A"name = "fb_id1" type = "hidden" value = "<?php echo $val1;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of Birth" style = "width:90%;text-align:center;" name = "bd1" id = "bd1" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd == '0000-00-00'){echo '';}else if($bd == '1970-01-01'){echo '';} else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"placeholder = "N/A"name = "children1" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"placeholder = "N/A"name = "fb_id1" type = "hidden" value = ""/>
                                                        </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd1" id = "bd1" class = "alphanum subtxt" type = "date" value = "" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>MIDDLE NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Middle Name" name = "s_mname" class = "alphanum subtxt" type = "text" value = "'.$S_MNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' 
                                            order by hris_son_daugther.ID LIMIT 1";
                                            $result = mysqli_query($link, $query);
                                           if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_2 = $rowz['son_daughter'];
                                                        $val2 = $rowz['ID'];
                                                        $bd2 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd2);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children" name = "children2" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_2; ?>" />
                                                        <input placeholder = "N/A" name = "fb_id2" type = "hidden" value = "<?php echo $val2;?>"/>
                                                    </td>
                                  
                                                    <td style = "text-align:center;"><input placeholder = "Date of Birth" style = "width:90%;text-align:center;" name = "bd2" id = "bd2" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd2 == '0000-00-00'){echo '';}else if($bd2 == '1970-01-01'){echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children2" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id2" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd2" id = "bd2" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd2 == '0000-00-00'){echo $bd2;}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>OCCUPATION</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Occupation" name = "fb_occupation" class = "alphanum subtxt" type = "text" value = "'.$S_OCCUPATION.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' AND
                                            hris_son_daugther.ID != '".$val2."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_3 = $rowz['son_daughter'];
                                                        $val3 = $rowz['ID'];
                                                        $bd3 = $rowz['DATE_OF_BIRTH'];
                                                        $date=date_create($bd3);

                                   
                                    
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children3" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_3; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id3" type = "hidden" value = "<?php echo $val3;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of Birth" style = "width:90%;text-align:center;" name = "bd3" id = "bd3" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd3 == '0000-00-00'){echo '';}else if($bd3 == '1970-01-01'){echo '';}else if ($bd3 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children3" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id3" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd3" id = "bd3" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;font-size:12px;"><span class="required">*</span>EMPLOYER/BUSINESS NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Employer/Business Name" name = "fb_ebusiness_name"class = "alphanum subtxt" type = "text" value = "'.$EMPLOYER_BNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                   <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_4 = $rowz['son_daughter'];
                                                        $val4 = $rowz['ID'];
                                                        $bd4 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd4);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children" name = "children4" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_4; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id4" type = "hidden" value = "<?php echo $val4;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd4" id = "bd4" class = "alphanum subtxt" type = "text" value = "<?php if ($bd4 == '0000-00-00'){echo '';}else if($bd4 == '1970-01-01'){echo '';}else if ($bd4 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children4" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id4" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd4" id = "bd4" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd4 == '0000-00-00'){echo $bd4;}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>BUSINESS ADDRESS</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Business Address" name = "fb_buss_address" class = "alphanum subtxt" type = "text" value = "'.$BUSS_ADD.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' 
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_5 = $rowz['son_daughter'];
                                                        $val5 = $rowz['ID'];
                                                        $bd5 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd5);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children5" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_5; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id5" type = "hidden" value = "<?php echo $val5;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd5" id = "bd5" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd5 == '0000-00-00'){echo '';}else if($bd5 == '1970-01-01'){echo '';}else if ($bd5 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children5" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id5" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd5" id = "bd5" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd5== '0000-00-00'){echo $bd5;}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>TELEPHONE NO.</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Telephone No." name = "fb_tel_no" class = "alphanum subtxt" type = "text" value = "'.$TEL_NO.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_6 = $rowz['son_daughter'];
                                                        $val6 = $rowz['ID'];
                                                        $bd6 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd6);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children6" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_6; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id6" type = "hidden" value = "<?php echo $val6;?>"/>                                                       
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd6" id = "bd6" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd6 == '0000-00-00'){echo '';}else if($bd6 == '1970-01-01'){echo '';}else if ($bd6 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children6" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id6" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd6" id = "bd6" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd6 == '0000-00-00'){echo $bd6;}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td style="border-left: 0;border-top: 0; border-bottom: 0"><label style = "margin-left:25px;"><span class="required">*</span>24. FATHER'S SURNAME</label></td>
                                    <td style="border-left: 0;border-top: 0; border-bottom: 0;text-indent:10px;"><?php echo '<input placeholder = "Fathers Surname" name = "f_lname" class = "alphanum subtxt" type = "text" value = "'.$FATHER_LNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                     <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_7 = $rowz['son_daughter'];
                                                        $val7 = $rowz['ID'];
                                                        $bd7 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd7);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center">
                                                        <input placeholder = "Name of children"name = "children7" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_7; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id7" type = "hidden" value = "<?php echo $val7;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth" style = "width:90%;text-align:center;"name = "bd7" id = "bd7" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd7 == '0000-00-00'){echo '';}else if($bd7 == '1970-01-01'){echo '';}else if ($bd7 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children7" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id7" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;text-align:center;"name = "bd7" id = "bd7" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd7 == '0000-00-00'){echo $bd7;}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>                              
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>FIRST NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "First Name" name = "f_fname" class = "alphanum subtxt" type = "text" value = "'.$FATHER_FNAME.'" />';?></td>
                                    <td style = "text-indent:10px;;background-color:#B0BEC5;">NAME EXTENSION(JR., SR.)</label></td>
                                    <td><?php echo '<input placeholder = "N/A"name = "f_ename" class = "alphanum subtxt" type = "text" value = "'.$FATHER_ENAME.'" />';?></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."' and
                                            hris_son_daugther.ID != '".$val7."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_8 = $rowz['son_daughter'];
                                                        $val8 = $rowz['ID'];
                                                        $bd8 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd8);
                                                    ?>
                                                    <td colspan =2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children8" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_8; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id8" type = "hidden" value = "<?php echo $val8;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd8" id = "bd8" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd8 == '0000-00-00'){echo '';}else if($bd8 == '1970-01-01'){echo '';}else if ($bd8 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children8" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id8" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd8" id = "bd8" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd8 == '0000-00-00'){echo '';}else if($bd8 == '1970-01-01'){echo '';}else if ($bd8 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>MIDDLE NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Middle Name" name = "f_mname" class = "alphanum subtxt" type = "text" value = "'.$FATHER_MNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."' and
                                            hris_son_daugther.ID != '".$val7."' and
                                            hris_son_daugther.ID != '".$val8."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_9 = $rowz['son_daughter'];
                                                        $val9 = $rowz['ID'];
                                                        $bd9 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd9);
                                                    ?>
                                                    <td colspan =2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children9" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_9; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id9" type = "hidden" value = "<?php echo $val9;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth" style = "width:90%;text-align:center;"name = "bd9" id = "bd9" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd9 == '0000-00-00'){echo '';}else if($bd9 == '1970-01-01'){echo '';}else if ($bd9 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>

                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children9" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id9" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;text-align:center;"name = "bd9" id = "bd9" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd9 == '0000-00-00'){echo '';}else if($bd9 == '1970-01-01'){echo '';}else if ($bd9 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td style="border-left: 0;border-top: 0; border-bottom: 0"><label><span class="required">*</span>25. MOTHER'S MAIDEN NAME</td>
                                    <td style="border-left: 0;border-top: 0; border-bottom: 0;text-indent:10px;"><?php echo '<input placeholder = "Mothers Maiden Name" name = "m_maidenname" class = "alphanum subtxt" type = "text" value = "'.$MOTHER_MAIDENNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."' and
                                            hris_son_daugther.ID != '".$val7."' and
                                            hris_son_daugther.ID != '".$val8."' and
                                            hris_son_daugther.ID != '".$val9."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_10 = $rowz['son_daughter'];
                                                        $val10 = $rowz['ID'];
                                                        $bd10 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd10);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children10" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_10; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id10" type = "hidden" value = "<?php echo $val10;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd10" id = "bd10" class = "alphanum subtxt" type = "text" value = "<?php if ($bd10 == '0000-00-00'){echo '';}else if($bd10 == '1970-01-01'){echo '';}else if ($bd10 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                    
                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children10" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id10" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd10" id = "bd10" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd10 == '0000-00-00'){echo '';}else if($bd10 == '1970-01-01'){echo '';}else if ($bd10 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>SURNAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Surname" name = "m_lname" class = "alphanum subtxt" type = "text" value = "'.$MOTHER_LNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."' and
                                            hris_son_daugther.ID != '".$val7."' and
                                            hris_son_daugther.ID != '".$val8."' and
                                            hris_son_daugther.ID != '".$val9."' and
                                            hris_son_daugther.ID != '".$val10."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_11 = $rowz['son_daughter'];
                                                        $val11 = $rowz['ID'];
                                                        $bd11 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd11);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children11" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_11; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id11" type = "hidden" value = "<?php echo $val11;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd11" id = "bd11" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd11 == '0000-00-00'){echo '';}else if($bd11 == '1970-01-01'){echo '';}else if ($bd11 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                    
                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children11" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id11" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd11" id = "bd11" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd11 == '0000-00-00'){echo $bd11;}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>FIRST NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "First Name" name = "m_fname" class = "alphanum subtxt" type = "text" value = "'.$MOTHER_FNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."' and
                                            hris_son_daugther.ID != '".$val7."' and
                                            hris_son_daugther.ID != '".$val8."' and
                                            hris_son_daugther.ID != '".$val9."' and
                                            hris_son_daugther.ID != '".$val10."' and
                                            hris_son_daugther.ID != '".$val11."'
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_12 = $rowz['son_daughter'];
                                                        $val12 = $rowz['ID'];
                                                        $bd12 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd12);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center">
                                                        <input placeholder = "Name of children"name = "children12" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_12; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id12" type = "hidden" value = "<?php echo $val12?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd12" id = "bd12" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd12 == '0000-00-00'){echo '';}else if($bd12 == '1970-01-01'){echo '';}else if ($bd12 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                    
                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children12" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id12" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd12" id = "bd12" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd12 == '0000-00-00'){echo '';}else if($bd12 == '1970-01-01'){echo '';}else if ($bd12 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                <tr>
                                    <td><label style = "margin-left:25px;"><span class="required">*</span>MIDDLE NAME</label></td>
                                    <td style = "text-indent:10px;"><?php echo '<input placeholder = "Middle Name" name = "m_mname" class = "alphanum subtxt" type = "text" value = "'.$MOTHER_MNAME.'" />';?></td>
                                    <td></td>
                                    <td></td>
                                    <?php
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query = "SELECT 
                                            hris_son_daugther.ID,
                                            LAST_M,
                                            FIRST_M,
                                            MIDDLE_M,
                                            hris_son_daugther.LAST_NAME,
                                            hris_son_daugther.FIRST_NAME,
                                            hris_son_daugther.MIDDLE_NAME,
                                            hris_family_background.`EMP_ID`,
                                            hris_son_daugther.`FULL_NAME` AS son_daughter,
                                            hris_son_daugther.DATE_OF_BIRTH 
                                            FROM `hris_family_background` 
                                            LEFT JOIN hris_son_daugther ON hris_son_daugther.EMP_ID = hris_family_background.EMP_ID
                                            LEFT JOIN tblemployee on hris_family_background.EMP_ID = tblemployee.EMP_N 
                                            WHERE hris_family_background.EMP_ID = '".$currentuser."' and 
                                            hris_son_daugther.ID != '".$val1."' and 
                                            hris_son_daugther.ID != '".$val2."' and
                                            hris_son_daugther.ID != '".$val3."' and
                                            hris_son_daugther.ID != '".$val4."' and
                                            hris_son_daugther.ID != '".$val5."' and
                                            hris_son_daugther.ID != '".$val6."' and
                                            hris_son_daugther.ID != '".$val7."' and
                                            hris_son_daugther.ID != '".$val8."' and
                                            hris_son_daugther.ID != '".$val9."' and
                                            hris_son_daugther.ID != '".$val10."' and
                                            hris_son_daugther.ID != '".$val11."' and
                                            hris_son_daugther.ID != '".$val12."'
                                            
                                            order by hris_son_daugther.ID LIMIT 1";
                                            
                                            $result = mysqli_query($link, $query);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                while($rowz = mysqli_fetch_array($result))
                                                    {
                                                        $val_13 = $rowz['son_daughter'];
                                                        $val13 = $rowz['ID'];
                                                        $bd13 = $rowz['DATE_OF_BIRTH'];
                                                        $date = date_create($bd13);
                                                    ?>
                                                    <td colspan = 2 style = "text-align:center;">
                                                        <input placeholder = "Name of children"name = "children13" style = "width:90%;"class = "alphanum subtxt" type = "text" value = "<?php echo $val_13; ?>" />
                                                        <input placeholder = "N/A"name = "fb_id13" type = "hidden" value = "<?php echo $val13;?>"/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "Date of birth"style = "width:90%;text-align:center;" name = "bd13" id = "bd13" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd13 == '0000-00-00'){echo '';}else if($bd13 == '1970-01-01'){echo '';}else if ($bd13 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                    
                                                    <?php
                                                    }
                                            
                                            }else{
                                                ?>
                                                    <td>
                                                        <input placeholder = "N/A"name = "children13" style = "width:auto;"class = "alphanum subtxt" type = "text" value = "" />
                                                        <input placeholder = "N/A"name = "fb_id13" type = "hidden" value = ""/>
                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;text-align:center;" name = "bd13" id = "bd13" class = "alphanum subtxt" type = "text" value = "<?php  if ($bd13 == '0000-00-00'){echo '';}else if($bd13 == '1970-01-01'){echo '';}else if ($bd13 == '') {echo '';}else { echo date_format($date,"F d, Y");}?>" /></td>
                                                <?php
                                            }
                                    ?>
                                </tr>
                                
                                <thead>
                                        <th style = "text-align:left;padding:10px;color:#fff;" colspan=7>III. EDUCATIONAL BACKGROUND</th>
                                </thead>
                                <tr>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>
                                        <label><span class="required">*</span>26. LEVEL</label>
                                    </th>
                                    <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>NAME OF SCHOOL (Write in full)</th>
                                    <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>BASIC EDUCATION/DEGREE/COURSE (Write in full)</th>
                                    <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" colspan = 2>PERIOD OF ATTENDANCE</th>
                                    <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>HIGHEST LEVEL/UNITS EARNED (if not graduated)</th>
                                    <th style = "text-indent:10px;text-align:center;background-color:#F5F5F5;" rowspan = 2>YEAR GRADUATED</th>
                                </tr>
                                <tr>
                                    <th style = "background-color:#F5F5F5;text-align:center;">From</th>
                                    <th style = "background-color:#F5F5F5;text-align:center;">To</th>
                                    <th style = "background-color:#F5F5F5;"></th>
                                    <th style = "background-color:#F5F5F5;"></th>
                                    <th style = "background-color:#F5F5F5;"></th>
                                </tr>
                                
                                <?php $ID = '';?>
                             
                                        <?php 
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                        $select_educ_bg = "SELECT 
                                        `ID`, 
                                        `EMP_ID`, 
                                        `LEVEL`, 
                                        `SCHOOL_NAME`, 
                                        `BASIC_EDUCATION_COURSE`, 
                                        `PERIOD_FROM`, 
                                        `PERIOD_TO`, 
                                        `HIGHEST_LEVEL`, 
                                        YEAR(`YEAR_GRAD`) AS 'YEAR_GRAD'
                                        FROM `hris_education_background` WHERE `EMP_ID` ='".$currentuser."'";
                                        $result = mysqli_query($link, $select_educ_bg);
                                        if (mysqli_num_rows($result) != 0)
                                        {   
                                            
                                            while($row = mysqli_fetch_array($result))
                                                {
                                                    $ID = $row['ID'];
                                                    $school1 = $row['SCHOOL_NAME'];
                                                    $course1 = $row['BASIC_EDUCATION_COURSE'];
                                                    $p_from1 = $row['PERIOD_FROM'];
                                                    $p_to1   = $row['PERIOD_TO'];
                                                    $highest_lvl1 = $row['HIGHEST_LEVEL'];
                                                    $year_grad1 = $row['YEAR_GRAD'];
                                                    $date = date_create($p_from1);
                                                    $dateto = date_create($p_to1);
                                                    $level = $row['LEVEL'];
                                                    ?>
                                                       <tr>
                                                          <td><label><span class="required">*</span><?php echo $row['LEVEL'];?>
                                                          <input type = "hidden" name = "level[]" value = "<?php echo $level?>" />; 
                                                          </td>
                                                    <td style = "text-indent:10px;"><input placeholder = "N/A" name = "school1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $school1 ;?>" /></td>
                                                    <td style = "text-indent:10px;text-align:center;"><input placeholder = "N/A"style = "max-width:100%;" name = "course1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $course1 ;?>" /></td>
                                                    <td style = "text-align:center;">
                                                        <input placeholder = "N/A"style = "text-align:center;max-width:100%;" name = "p_from1[]" class = "p_from1 alphanum subtxt" type = "text" value = "<?php  if ($p_from1 == '0000-00-00'){echo '' ;}else { echo date_format($date,"F d, Y");}?>" />
                                                    </td>
                                                    <td style = "text-align:center;">
                                                    <input placeholder = "N/A"style = "text-align:center;max-width:100%;" name = "p_to1[]" class = "p_to1 alphanum subtxt" type = "text" value = "<?php  if ($p_to1 == '0000-00-00'){echo '' ;}else { echo date_format($dateto,"F d, Y");}?>" />

                                                    </td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"name = "highest_lvl1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $highest_lvl1;?>" /></td>
                                                    <td style = "text-align:center;">
                                                      <select name = "year_grad1[]" class="dropdown size250" >
                                                         <?php 
                                                    $isSelected = "";
                                                        if($year_grad1 == 0)
                                                        {
                                                            echo '<option value = "" '.$isSelected.'></option>';
                                                            for($i=1950; $i<= 2020; $i++)
                                                                {
                                                                    echo '<option value='.$i.'>'.$i.'</option>';
                                                                }
                                                        }else
                                                        {
                                                            for($i=$year_grad1; $i<= 2020; $i++)
                                                                {
                                                                    echo '<option value='.$i.' '.$isSelected.'>'.$i.'</option>';
                                                                }
                                                        }
                                                    ?>
                                                     </select>
                                                      <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" id = "educ_del<?php echo $row['ID'];?>"/> </span>
                                                    </td>
                                                    </tr>
                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#educ_del<?php echo $row['ID']; ?>').click(function(){
                                                                function doConfirm(msg, yesFn, noFn)
                                                                {
                                                                    var confirmBox = $("#confirmBox2");
                                                                    confirmBox.find(".message").text(msg);
                                                                    confirmBox.find(".yes,.no").unbind().click(function()
                                                                    {
                                                                    confirmBox.hide();
                                                                    });
                                                                    confirmBox.find(".yes").click(yesFn);
                                                                    confirmBox.find(".no").click(noFn);
                                                                    confirmBox.show();
                                                                }
                                                                var modal = document.getElementById("myModal2");
                                                                var span = document.getElementsByClassName("close")[0];
                                                                modal.style.display = "block";
                                                                doConfirm('Are you sure you want to delete this record?',function yes(){
                                                                                                $.ajax({
                                                                                                  type: "POST",
                                                                                                  url: "hris_functions.php",
                                                                                                 data: {"options":'educational',"id": <?php echo $row['ID'];?>,"userid":<?php echo $currentuser;?>},

                                                                                                        
                                                                                                  success: function(){
                                                                                                      console.log(<?php echo $row['ID'];?>);
                                                                                                      window.location.reload();
                                                                                                  }
                                                                                                });
                                                                                                modal.style.display = "none";
                                                                                              }, function no(){  modal.style.display = "none";})
                                                                // When the user clicks on <span> (x), close the modal
                                                                span.onclick = function() {
                                                                modal.style.display = "none";
                                                                }
                                                                // When the user clicks anywhere outside of the modal, close it
                                                                window.onclick = function(event) {
                                                                if (event.target == modal) {
                                                                modal.style.display = "none";
                                                                }
                                                                } 
                                                            
                                                            });
                                                        });
                                                    </script>
                                                    <?php
                                                }
                                        }else{
                                                    ?>
                                                    <tr>
                                                    <td style = "text-indent:10px;"><input placeholder = "N/A"name = "school1" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td style = "text-indent:10px;text-align:center;"><input placeholder = "N/A"style = "max-width:100%;" name = "course1" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td><input placeholder = "N/A"style = "text-align:center;width:50px;" name = "p_from1" id = "p_from1" class = "alphanum subtxt" type = "text" value = "" />
                                                    <td><input placeholder = "N/A"style = "text-align:center;width:50px;" name = "p_to1" id = "p_to1" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td><input placeholder = "N/A"name = "highest_lvl1" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td style = "text-align:center;">
                                                      <select name = "year_grad1" class="dropdown size250" >
                                                        <?php 
                                                        for($i=1950; $i<= 2020; $i++){
                                                           
                                                                echo '<option value='.$i.'>'.$i.'</option>';
                                                            
                                                        }
                                                        ?>
                                                     </select>
                                                     <img src = "images/delete.jpg" /> 
                                                    </td>
                                                    </tr>
                                                    <?php
                                        }
                                    ?>
                                      
                              
                     
                         
                                <thead>
                                    <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7>IV. CIVIL SERVICE ELIGIBILITY</th>
                                </thead>
                                <tr>
                              <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>
                              <label><span class="required">*</span>27. CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE / BARANGAY ELIGIBILITY/ DRIVER'S LICENSE </label>     </td>
                              <th style = "text-align:center;background-color:#F5F5F5;" rowspan =2>RATING (If applicable)</th>
                              <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>DATE OF EXAMINATION/CONFERMENT</th>
                              <th colspan = 2 style = "text-align:center;background-color:#F5F5F5;" rowspan=2>PLACE OF EXAMINATION/CONFERMENT</th>
                              <th colspan = 2 style = "text-align:center;background-color:#F5F5F5;">LICENSED</th>
                          </tr>
                          <tr>
                          <th style = "text-align:center;background-color:#F5F5F5;">NUMBER</th>
                          <th style = "text-align:center;background-color:#F5F5F5;">Date of Validity</th>
                          <th style = "text-align:center;background-color:#F5F5F5;"></th>
                          <th style = "text-align:center;background-color:#F5F5F5;"></th>
                          <th style = "text-align:center;background-color:#F5F5F5;"></th>
                          </tr>
                       
                            
                                        <?php 
                                        if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                        $select_eligibility = "SELECT
                                         hris_eligibility.`ID` as 'ID',
                                        `EMP_ID`,
                                        `RATING`,
                                        `EXAMINATION_DATE`,
                                        `PLACE_OF_EXAMINATION`,
                                        `NUMBER`,
                                        `DATE_OF_VALIDITY`,
                                        `ELIGIBILITY_LIST`.ELIGIBILITY_NAME,
                                        `ELIGIBILITY_LIST`.ID AS 'eligibility'
                                        FROM `hris_eligibility` 
                                        LEFT JOIN `ELIGIBILITY_LIST` on `hris_eligibility`.ELIGIBILITY =`ELIGIBILITY_LIST`.ID
                                        WHERE `EMP_ID` = '".$currentuser."'";
                                        $result = mysqli_query($link, $select_eligibility);
                                        if (mysqli_num_rows($result) != 0)
                                        {   
                                            while($row = mysqli_fetch_array($result))
                                                                {
                                                    
                                                    ?>
                                                    <tr>
                                                    <td style = "background-color:#F5F5F5;">
                                                    <select  name="eligibility1[]" class="eligibility dropdown" style = "width:158px;">
                                                        <?php
                                                            
                                                                    echo 'a';
                                                                    $e_id1 = $row['ID'];
                                                                    $eligibility = $row['eligibility'];
                                                                    $e_name = $row['ELIGIBILITY_NAME'];
                                                                    $rating1 = $row['RATING'];
                                                                    $examination_date1 = $row['EXAMINATION_DATE'];
                                                                    $place_exam1 = $row['PLACE_OF_EXAMINATION'];
                                                                    $number1 = $row['NUMBER'];
                                                                    $date_of_validity1 = $row['DATE_OF_VALIDITY'];
                                                                    $date1 = date_create($examination_date1);
                                                                    $date2 = date_create($date_of_validity1);
                                                                    if(empty($rating1)){
                                                                        $rating1 = '';
                                                                    }
                                                                    if(empty($place_exam1))
                                                                    {
                                                                        $place_exam1 = '';
                                                                    }
                                                                    switch($eligibility){
                                                                                case '0':
                                                                                    echo '
                                                                                    <option value="N/A" selected>N/A</option>
                                                                                    <option value="CS Professional" >CS Professional</option>
                                                                  				    <option value="CS Sub-Professional">CS Sub-Professional</option>
                                                                  				    <option value="RA 1080">RA 1080</option>
                                                                  				    <option value="PD 907">CS Sub-Professional</option>';
                                                                                    break;
                                                                                case '1':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1" selected>CS Professional</option>
                                                                  				    <option value="2"  >CS Sub-Professional</option>
                                                                  				    <option value="3">Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>';
                                                                                    break;
                                                                                case '2':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" selected >CS Sub-Professional</option>
                                                                  				    <option value="3">Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>';
                                                                                    break;
                                                                                case '3':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '4':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2">CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4" selected>Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '5':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5" selected>Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '6':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6" selected>Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '7':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7" selected>Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '8':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8" selected>Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '9':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9" selected>Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '10':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10" selected>Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '11':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11" selected>Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                              				    case '12':
                                                                                    echo '
                                                                                    <option value="0">N/A</option>
                                                                                    <option value="1">CS Professional</option>
                                                                  				    <option value="2" >CS Sub-Professional</option>
                                                                  				    <option value="3" selected>Bar/Board Eligibility (RA1080)</option>
                                                                  				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                                                                  				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                                                                  				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                                                                  				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                                                                  				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                                                                  				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                                                                  				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                                                                  				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. 1996, as amended)</option>
                                                                  				    <option value="12" selected>Veteran Preference Rating (EO 132/790) </option>
                                                                  				    ';
                                                                  				    break;
                                                                  			
                                                                             
                                                                                default:
                                                                                    echo '
                                                                                    <option value="N/A">N/A</option>
                                                                                    <option value="CS Professional" >CS Professional</option>
                                                                  				    <option value="CS Sub-Professional" >CS Sub-Professional</option>
                                                                  				    <option value="RA 1080" >RA 1080</option>
                                                                  				    <option value="PD 907" selected>CS Sub-Professional</option>
                                                                                      ';
                                                                  				    
                                                                            }
                                                                
                                                        ?>
                                                    </select>
                                                    </td>
                                                    <input placeholder = "N/A"type = "hidden" name = "csc_id1[]" value ="<?php echo $e_id1;?>"/>
                                                    <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100%px;" name = "rating1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $rating1;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "examination_date1[]"class = "datepicker1 alphanum subtxt" type = "text" value = "<?php  if ($examination_date1 == '0000-00-00'){echo '';}else { echo date_format($date1,"F d, Y");}?>" /></td>
                                                    <td style = "text-align:center;" colspan = 2 ><input placeholder = "Place of Examination" style = "width:90%;" name = "place_exam1[]"class = "alphanum subtxt" type = "text" value = "<?php echo $place_exam1;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "number1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $number1;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "date_of_validity1[]" class = "datepicker_civil alphanum subtxt" type = "text"  style = "width:100px;" value = "<?php if($date_of_validity1 == '0000-00-00'){echo '';}else{ echo date_format($date2, "F d, Y");}?>" /></td>
                                                	</tr>
                                                	<?php
                                                                }
                                        }else{
                                            ?>
                                            <td style = "background-color:#F5F5F5;">
                                                <input placeholder = "N/A"type = "hidden" name = "csc_id1[]" value ="<?php echo $e_id1;?>"/>
                                                <select  name="eligibility1[]" class="eligibility dropdown" style = "width:158px;">
                                                <option value="0">N/A</option>
                                                <option value="1" selected>CS Professional</option>
                              				    <option value="2"  >CS Sub-Professional</option>
                              				    <option value="3">Bar/Board Eligibility (RA1080)</option>
                              				    <option value="4">Barangay Nutrition Scholar Eligibility (PD159)</option>
                              				    <option value="5">Barangay Official Eligibility (RA 7160)</option>
                              				    <option value="6">Electronic Data Processing Specialist Eligibility (CSC Res. 90-083)</option>
                              				    <option value="7">Foreign School Honor Graduate Eligibility (CSC Res. 1302714)</option>
                              				    <option value="8">Honor Graduate Eligibility (PD907)</option>
                              				    <option value="9">Sanggunian Member Eligibility (RA10156)</option>
                              				    <option value="10">Scientific and Technological Specialist Eligibility (PD 997)</option>
                              				    <option value="11">Skills Eligibility - Category II (CSC MC 11, s. "opti":'',1996, as amended)</option>
                              				    <option value="12">Veteran Preference Rating (EO 132/790) </option>
                                            </select></td>
                                            <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "rating1[]" class = "alphanum subtxt" type = "text" value = "" /></td>
                                            <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "examination_date1[]"class = "datepicker1 alphanum subtxt" type = "text" value = "" /></td>
                                            <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "place_exam1[]"class = "alphanum subtxt" type = "text" value = "" /></td>
                                            <td style = "text-align:center;"><input placeholder = "N/A"style = "width:100px;"  name = "number1[]" class = "alphanum subtxt" type = "text" value = "" /></td>
                                            <td style = "text-align:center;"><input placeholder = "N/A" style = "width:100px;" name = "date_of_validity1[]" class = "datepicker_civil alphanum subtxt" type = "text"  style = "width:100px;" value = "" /></td>
                                            <?php
                                        }
                                  ?>
                              </tr>
                                
                              
                                <thead>
                                 <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7>V. WORK EXPERIENCED
                                 <label style = "font-size:12px;">(Include private employment. Start from your recent work)
                                 Description of duties should be indicated in the attached Work Experience sheet.</label>
                                 <span  class = "pull-right"><img id="moreExp"  src = "../images/add_rec.png" ></span></th>
                                </thead>
                                <tr>
                                    <th style = "background-color:#F5F5F5;text-align:center;"><label><span class="required">*</span>28. INCLUSIVE DATES (mm/dd/yyyy)</label></td>
                                    <th style ="background-color:#F5F5F5;text-align:center;" rowspan = 2>POSITION TITLE (Write in full/Do not abbreviate)</th>
                                    <th style ="background-color:#F5F5F5;text-align:center;" rowspan = 2>DEPARTMENT / AGENCY / OFFICE / COMPANY (Write in full/Do not abbreviate)</th>
                                    <th style ="background-color:#F5F5F5;text-align:center;" rowspan = 2>MONTHLY SALARY</th>
                                    <th  style ="background-color:#F5F5F5;text-align:center;" rowspan = 2>SALARY GRADE</th>
                                    <th  style ="background-color:#F5F5F5;text-align:center;" rowspan = 2>STATUS OF APPOINTMENT</th>
                                    <th  style ="background-color:#F5F5F5;text-align:center;" rowspan = 2>Government Service (Y/N)</th>
                                </tr>
                                <tr>
                                    <th style = "background-color:#F5F5F5;text-align:center;">FROM &nbsp;&nbsp;&nbsp;TO</th>
                                    <th style = "background-color:#F5F5F5;text-align:center;"></th>
                                    <th style = "background-color:#F5F5F5;text-align:center;"></th>
                                    <th style = "background-color:#F5F5F5;text-align:center;"></th>
                                    <th style = "background-color:#F5F5F5;text-align:center;"></th>
                                    <th style = "background-color:#F5F5F5;text-align:center;"></th>
                                </tr>

                                <tbody  id ="workExpPanel">
                                  <tr class="myTemplate2" style="display:none">
                                    <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                    $select_trainings = "SELECT 
                                    `ID`, 
                                    `EMP_ID`, 
                                    `EXCLUSIVE_DATE_FROM`,
                                    `EXCLUSIVE_DATE_TO`,
                                    `POSITION_TITLE`, 
                                    `COMPANY`,
                                    `SALARY`, 
                                    `SALARY_GRADE`,
                                    `STATUS_OF_APPOINTMENT`,
                                    `GOVERNMENT_SERVICE`
                                    FROM `hris_work_experience` WHERE `EMP_ID` = '".$currentuser."' order by   `EXCLUSIVE_DATE_TO` desc
                                    ";
                                    $result = mysqli_query($link, $select_trainings);
                                    if (mysqli_num_rows($result) != 0)
                                    {   
                                        while($row = mysqli_fetch_array($result))
                                            {
                                                $id = $row['ID'];
                                                $e_from1 = $row['EXCLUSIVE_DATE_FROM'];
                                                $e_to1 = $row['EXCLUSIVE_DATE_TO'];
                                                $position_1 = $row['POSITION_TITLE'];
                                                $company1 = $row['COMPANY'];
                                                $salary1 = $row['SALARY'];
                                                $salary_grade1 = $row['SALARY_GRADE'];
                                                $appointment = $row['STATUS_OF_APPOINTMENT'];
                                                $gov_serv = $row['GOVERNMENT_SERVICE'];
                                                $datef = date_create($e_from1);
                                                $datet = date_create($e_to1);
                                                      
                                                ?>
                                                <tr>
                                                        <input id = "work_id<?php echo $id?>" placeholder = "N/A"type = "hidden" name ="we_id1[]"  value = "<?php echo $id?>" />
                                                        <td style = "text-align:center;background-color:#F5F5F5;">
                                                            <input placeholder = "N/A"style = "width:50px;" name = "e_from1[]" class = "myDate2 alphanum subtxt" type = "text" value = "<?php  if ($e_from1 == '0000-00-00'){echo $e_from1;}else { echo date_format($datef,"F d, Y");}?>" />
                                                            <input placeholder = "N/A"style = "width:50px;" name = "e_to1[]" class = "myDate2 alphanum subtxt" type = "text" value = "<?php  if ($e_to1 == '0000-00-00'){echo $e_to1;}else { echo date_format($datet,"F d, Y");}?>" />
                                                        </td>
                                                        <td style = "text-align:center;"><input placeholder = "N/A"style = "max-width:100%;" name = "position_1[]" class = "alphanum subtxt" type = "text"  value = "<?php echo $position_1;?>" /></td>
                                                        <td style = "text-align:center;"><input placeholder = "N/A"name = "company1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $company1;?>" /></td>
                                                        <td style = "text-align:center;width:50px;">
                                                        <input placeholder = "N/A"name = "salary1[]" style = "width:50px;" class = "alphanum subtxt" type = "text" value = "<?php echo $salary1;?>" />
                                                        </td>
                                                        <td style = "text-align:center;">
                                                        <input placeholder = "N/A"name = "salary_grade1[]" style = "width:50px;"class = "alphanum subtxt" type = "text"  value = "<?php echo $salary_grade1;?>" />
                                                        </td>
                                                        <td style = "text-align:center">
                                                        <select  name="appointment[]" class="dropdown" style = "width:165px;">
                                                        <?php 
                                                        switch($appointment)
                                                        {
                                                            case 'Temporary':
                                                                echo '<option value = "Temporary" selected>Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary">Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                            break;
                                                            case 'Permanent':
                                                                echo '<option value = "Temporary" >Temporary</option>';
                                                                echo '<option value = "Permanent" selected>Permanent</option>';
                                                                echo '<option value = "Probationary">Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                            break;
                                                            case 'Probitionary':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" selected>Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Consultant':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" selected>Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Training':
                                                                 echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" selected>Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Student Job':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" selected>Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'OJT':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" >Student Job</option>';
                                                                echo '<option value = "OJT" selected>OJT</option>';
                                                                break;
                                                            default:
                                                                echo '<option value = "Temporary" selected>Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" >Student Job</option>';
                                                                echo '<option value = "OJT" >OJT</option>';
                                                                break;
                                                        }
                                                        ?>
                                                        </select>
                                                        </td>
                                                        <td style = "text-align:center">
                                                        <select  name="government_service[]" class="dropdown" style = "width:165px;">
                                                        <?php 
                                                        switch($gov_serv)
                                                        {
                                                            case 'Yes':
                                                                echo '<option value = "Yes" selected>Yes</option>';
                                                                echo '<option value = "No">No</option>';
                                                            break;
                                                            case 'No':
                                                                echo '<option value = "No" selected>No</option>';
                                                                echo '<option value = "Yes">Yes</option>';
                                                            break;
                                                        }
                                                        ?>
                                                        </select>
                                                         <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "work_del<?php echo $row['ID'];?>"/> </span>

                                                        </td>
                                                    </tr>
                                               <script>
                                              $("#workExpPanel").on("click", ".work_del<?php echo $row['ID'];?>", function() {
                                                   function doConfirm(msg, yesFn, noFn)
                                                                {
                                                                    var confirmBox = $("#confirmBox2");
                                                                    confirmBox.find(".message").text(msg);
                                                                    confirmBox.find(".yes,.no").unbind().click(function()
                                                                    {
                                                                    confirmBox.hide();
                                                                    });
                                                                    confirmBox.find(".yes").click(yesFn);
                                                                    confirmBox.find(".no").click(noFn);
                                                                    confirmBox.show();
                                                                }
                                                                var modal = document.getElementById("myModal2");
                                                                var span = document.getElementsByClassName("close")[0];
                                                                modal.style.display = "block";
                                                                doConfirm('Are you sure you want to delete this record?',function yes(){
                                                                                                var id = $('#work_id<?php echo $row['ID'];?>').val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "hris_functions.php",
                                                        data: {"options":'work',"w_id": id,"w_userid":<?php echo $currentuser;?>},
                                                        success: function(){
                                                        window.location.reload();
                                                            $(this).parents('tr').remove();
                                                        // window.location ="hris_functions.php";
                                                        }
                                                    });
                                                 
                                                                                                modal.style.display = "none";
                                                                                              }, function no(){  modal.style.display = "none";})
                                                                // When the user clicks on <span> (x), close the modal
                                                                span.onclick = function() {
                                                                modal.style.display = "none";
                                                                }
                                                                // When the user clicks anywhere outside of the modal, close it
                                                                window.onclick = function(event) {
                                                                if (event.target == modal) {
                                                                modal.style.display = "none";
                                                                }
                                                                } 
                                                    
                                                });
                                                $("#workExpPanel").on("click", ".work_del", function() {
                                                $(this).parents('tr').remove();
                                                });
                                                 
                                               </script> 
                                                <?php
                                            }
                                    }else{
                                        ?>
                                          <tr>
                                                        <input id = "work_id<?php echo $id?>" placeholder = "N/A"type = "hidden" name ="we_id1[]"  value = "<?php echo $id?>" />
                                                        <td style = "text-align:center;background-color:#F5F5F5;">
                                                            <input placeholder = "N/A"style = "width:50px;" name = "e_from1[]" class = "myDate2 alphanum subtxt" type = "text" value = "<?php  if ($e_from1 == '0000-00-00'){echo $e_from1;}else { echo date_format($datef,"F d, Y");}?>" />
                                                            <input placeholder = "N/A"style = "width:50px;" name = "e_to1[]" class = "myDate2 alphanum subtxt" type = "text" value = "<?php  if ($e_to1 == '0000-00-00'){echo $e_to1;}else { echo date_format($datet,"F d, Y");}?>" />
                                                        </td>
                                                        <td style = "text-align:center;"><input placeholder = "N/A"style = "max-width:100%;" name = "position_1[]" class = "alphanum subtxt" type = "text"  value = "<?php echo $position_1;?>" /></td>
                                                        <td style = "text-align:center;"><input placeholder = "N/A"name = "company1[]" class = "alphanum subtxt" type = "text" value = "<?php echo $company1;?>" /></td>
                                                        <td style = "text-align:center;width:50px;">
                                                        <input placeholder = "N/A"name = "salary1[]" style = "width:50px;" class = "alphanum subtxt" type = "text" value = "<?php echo $salary1;?>" />
                                                        </td>
                                                        <td style = "text-align:center;">
                                                        <input placeholder = "N/A"name = "salary_grade1[]" style = "width:50px;"class = "alphanum subtxt" type = "text"  value = "<?php echo $salary_grade1;?>" />
                                                        </td>
                                                        <td style = "text-align:center">
                                                        <select  name="appointment[]" class="dropdown" style = "width:165px;">
                                                        <?php 
                                                        switch($appointment)
                                                        {
                                                            case 'Temporary':
                                                                echo '<option value = "Temporary" selected>Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary">Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                            break;
                                                            case 'Permanent':
                                                                echo '<option value = "Temporary" >Temporary</option>';
                                                                echo '<option value = "Permanent" selected>Permanent</option>';
                                                                echo '<option value = "Probationary">Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                            break;
                                                            case 'Probitionary':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" selected>Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Consultant':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" selected>Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Training':
                                                                 echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" selected>Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Student Job':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" selected>Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'OJT':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" >Student Job</option>';
                                                                echo '<option value = "OJT" selected>OJT</option>';
                                                                break;
                                                            default:
                                                                echo '<option value = "Temporary" selected>Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" >Student Job</option>';
                                                                echo '<option value = "OJT" >OJT</option>';
                                                                break;
                                                        }
                                                        ?>
                                                        </select>
                                                        </td>
                                                        <td style = "text-align:center">
                                                        <select  name="government_service[]" class="dropdown" style = "width:165px;">
                                                        <?php 
                                                        switch($gov_serv)
                                                        {
                                                            case 'Yes':
                                                                echo '<option value = "Yes" selected>Yes</option>';
                                                                echo '<option value = "No">No</option>';
                                                            break;
                                                            case 'No':
                                                                echo '<option value = "No" selected>No</option>';
                                                                echo '<option value = "Yes">Yes</option>';
                                                            break;
                                                            default:
                                                                   echo '<option value = "No" selected>No</option>';
                                                                echo '<option value = "Yes">Yes</option>';
                                                                break;
                                                        }
                                                        ?>
                                                        </select>
                                                         <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "work_del"/> </span>

                                                        </td>
                                                    </tr>
                                                    <script>
                                                             $("#workExpPanel").on("click", ".work_del", function() {
                                                $(this).parents('tr').remove();
                                                });
                                                    </script>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                  <tr class="myTemplate2" style="display:none">
                                  <input placeholder = "N/A"type = "hidden" name ="we_id1[]" value = "<?php echo $id?>" />
                                  <td style = "text-align:center;background-color:#F5F5F5;">
                                                            <input placeholder = "N/A"style = "width:50px;" name = "e_from1[]" class = "datePicker22 alphanum subtxt" type = "text" value = "" />
                                                            <input placeholder = "N/A"style = "width:50px;" name = "e_to1[]" class = "datePicker22 alphanum subtxt" type = "text" value = "" />
                                                        </td>
                                                        <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A"name = "position_1[]" class = "alphanum subtxt" type = "text"  value = "" /></td>
                                                        <td style = "text-align:center;"><input placeholder = "N/A"name = "company1[]" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                        <td style = "text-align:center;width:50px;">
                                                        <input placeholder = "N/A"name = "salary1[]" style = "width:50px;" class = "alphanum subtxt" type = "text" value = "" />
                                                        </td>
                                                        <td style = "text-align:center;">
                                                        <input placeholder = "N/A"name = "salary_grade1[]" style = "width:50px;"class = "alphanum subtxt" type = "text"  value = "" />
                                                        </td>
                                                        <td style = "text-align:center;">
                                                        <select  name="appointment[]" class="dropdown" style = "width:165px;">
                                                        <?php 
                                                        switch($appointment)
                                                        {
                                                            case 'Temporary':
                                                                echo '<option value = "Temporary" selected>Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary">Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                            break;
                                                            case 'Permanent':
                                                                echo '<option value = "Temporary" >Temporary</option>';
                                                                echo '<option value = "Permanent" selected>Permanent</option>';
                                                                echo '<option value = "Probationary">Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                            break;
                                                            case 'Probitionary':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" selected>Probationary</option>';
                                                                echo '<option value = "Consultant">Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Consultant':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" selected>Consultant</option>';
                                                                echo '<option value = "Training">Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Training':
                                                                 echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" selected>Training</option>';
                                                                echo '<option value = "Student Job">Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'Student Job':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" selected>Student Job</option>';
                                                                echo '<option value = "OJT">OJT</option>';
                                                                break;
                                                            case 'OJT':
                                                                echo '<option value = "Temporary">Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" >Student Job</option>';
                                                                echo '<option value = "OJT" selected>OJT</option>';
                                                                break;
                                                            default:
                                                                echo '<option value = "Temporary" selected>Temporary</option>';
                                                                echo '<option value = "Permanent">Permanent</option>';
                                                                echo '<option value = "Probationary" >Probationary</option>';
                                                                echo '<option value = "Consultant" >Consultant</option>';
                                                                echo '<option value = "Training" >Training</option>';
                                                                echo '<option value = "Student Job" >Student Job</option>';
                                                                echo '<option value = "OJT" >OJT</option>';
                                                                break;
                                                        }
                                                        ?>
                                                        </select>
                                                        </td>
                                                        <td style = "text-align:center;">
                                                        <select  name="government_service[]" class="dropdown" style = "width:165px;">
                                                        <?php 
                                                        switch($gov_serv)
                                                        {
                                                            case 'Yes':
                                                                echo '<option value = "Yes" selected>Yes</option>';
                                                                echo '<option value = "No">No</option>';
                                                            break;
                                                            case 'No':
                                                                echo '<option value = "No" selected>No</option>';
                                                                echo '<option value = "Yes">Yes</option>';
                                                            break;
                                                            default:
                                                                echo '<option value = "No" selected>No</option>';
                                                                echo '<option value = "Yes">Yes</option>';
                                                            break;
                                                                break;
                                                        }
                                                        ?>
                                                        </select>
                                                        <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "work_del"/> </span>

                                                        </td>
                                  </tr>
                                </tbody>
                              
                          
                        
                                <thead>
                                    <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7>VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S<span  class = "pull-right"><img id="moreOrg"  src = "../images/add_rec.png" ></span></th>
                                </thead>
                                <tr>
                                    <th colspan = 2 style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>NAME & ADDRESS OF ORGANIZATION (Write in full) </th>
                                    <th colspan = 2 style = "text-align:center;background-color:#F5F5F5;">INCLUSIVE DATES <br>(mm/dd/yyyy)</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>NUMBER OF HOURS</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2 colspan = 2>POSITION / NATURE OF WORK</th>
                                </tr>
                                <tr>
                                    <th style = "text-align:center;background-color:#F5F5F5;">FROM</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;">TO</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;"></th>
                                    <th style = "text-align:center;background-color:#F5F5F5;"></th>
                                </tr>
                                 <tbody  id ="orgPanel">
                                    <tr class="myTemplate3" style="display:none;">
                                         <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                     $select_work_exp = "SELECT 
                                    `ID`, 
                                    `EMP_ID`, 
                                    `ORGANIZATION`, 
                                    `INCLUSIVE_FROM`, 
                                    `INCLUSIVE_TO`, 
                                    `NO_OF_HOURS`, 
                                    `POSITION` FROM `hris_organizations` WHERE 
                                    `EMP_ID` = '".$currentuser."' ORDER BY INCLUSIVE_FROM DESC
                                    ";
                                    $result = mysqli_query($link, $select_work_exp);
                                    if (mysqli_num_rows($result) != 0)
                                    {     
                                        while($row = mysqli_fetch_array($result))
                                            {
                                                        $oid1 = $row['ID'];
                                                        $organization1 = $row['ORGANIZATION'];
                                                        $inclusive_from1 = $row['INCLUSIVE_FROM'];
                                                        $inclusive_to1 = $row['INCLUSIVE_TO'];
                                                        $hours1 = $row['NO_OF_HOURS'];
                                                        $position1 = $row['POSITION'];
                                                        $date_create_from = date_create($inclusive_from1);
                                                        $date_create_to   = date_create($inclusive_to1);
                                                      
                                                ?>
                                                <tr>
                                                <input placeholder = "N/A"type = "hidden" name = "a0[]" id = "voluntary_id<?php echo $oid1;?>" value = <?php echo $oid1;?> />
                                                <td colspan =2 style = "text-align:center;background-color:#F5F5F5;"><input style = "width:90%;" placeholder = "N/A" name = "a1[]" class = "alphanum subtxt" type = "text"  value = "<?php echo $organization1;?>" /></td>
                                                <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A" name = "a2[]" class = "myDate3 alphanum subtxt" type = "text"  value = "<?php  if ($inclusive_from1 == '0000-00-00'){echo '';} else { echo date_format($date_create_from,"F d, Y");}?>" /></td>
                                                <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A" name = "a3[]" class = "myDate3 alphanum subtxt" type = "text"   value = "<?php  if ($inclusive_to1 == '0000-00-00'){echo '';} else { echo date_format($date_create_to,"F d, Y");}?>" /></td>
                                                <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A" name = "a4[]" class = "alphanum subtxt" type = "text" value = "<?php echo $hours1;?>" /></td>
                                                <td style = "text-align:center;" colspan = 2>
                                                    <input style = "width:50%;" placeholder = "N/A" name = "a5[]" style = "width:100px;" class = "alphanum subtxt" type = "text" value = "<?php echo $position1;?>" />
                                                     <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "voluntary_del<?php echo $row['ID'];?>"/> </span>

                                                </td>

                                               </tr>     
                                               <script>
                                                 $("#orgPanel").on("click",".voluntary_del<?php echo $row['ID'];?>",function(){
                                                     function doConfirm(msg, yesFn, noFn)
                                                                {
                                                                    var confirmBox = $("#confirmBox2");
                                                                    confirmBox.find(".message").text(msg);
                                                                    confirmBox.find(".yes,.no").unbind().click(function()
                                                                    {
                                                                    confirmBox.hide();
                                                                    });
                                                                    confirmBox.find(".yes").click(yesFn);
                                                                    confirmBox.find(".no").click(noFn);
                                                                    confirmBox.show();
                                                                }
                                                                var modal = document.getElementById("myModal2");
                                                                var span = document.getElementsByClassName("close")[0];
                                                                modal.style.display = "block";
                                                                doConfirm('Are you sure you want to delete this record?',function yes(){
                                                                                                var id = $('#voluntary_id<?php echo $row['ID'];?>').val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "hris_functions.php",
                                                        data: {"options":'voluntary',"v_id": id,"v_userid":<?php echo $currentuser;?>},
                                                        success: function(){
                                                        console.log(<?php echo $row['ID'];?>);
                                                        window.location.reload();
                                                         $(this).parents('tr').remove();

                                                        // window.location ="hris_functions.php";
                                                        }
                                                    });
                                                                                                modal.style.display = "none";
                                                                                              }, function no(){  modal.style.display = "none";})
                                                                // When the user clicks on <span> (x), close the modal
                                                                span.onclick = function() {
                                                                modal.style.display = "none";
                                                                }
                                                                // When the user clicks anywhere outside of the modal, close it
                                                                window.onclick = function(event) {
                                                                if (event.target == modal) {
                                                                modal.style.display = "none";
                                                                }
                                                                } 

                                                 });
                                                 $("#orgPanel").on("click",".voluntary_del",function(){
                                                     $(this).parents('tr').remove();
                                                 });
                                               </script>
                                                <?php
                                            }
                                    }else{
                                        ?>
                                        <tr>
                                                <input placeholder = "N/A"type = "hidden" name = "a0[]" id = "voluntary_id<?php echo $oid1;?>" value = <?php echo $oid1;?> />
                                                <td colspan =2 style = "text-align:center;background-color:#F5F5F5;"><input style = "width:90%;" placeholder = "N/A" name = "a1[]" class = "alphanum subtxt" type = "text"  value = "<?php echo $organization1;?>" /></td>
                                                <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A" name = "a2[]" class = "myDate3 alphanum subtxt" type = "text"  value = "<?php  if ($inclusive_from1 == '0000-00-00'){echo '';} else { echo date_format($date_create_from,"F d, Y");}?>" /></td>
                                                <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A" name = "a3[]" class = "myDate3 alphanum subtxt" type = "text"   value = "<?php  if ($inclusive_to1 == '0000-00-00'){echo '';} else { echo date_format($date_create_to,"F d, Y");}?>" /></td>
                                                <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A" name = "a4[]" class = "alphanum subtxt" type = "text" value = "<?php echo $hours1;?>" /></td>
                                                <td style = "text-align:center;" colspan = 2>
                                                    <input style = "width:50%;" placeholder = "N/A" name = "a5[]" style = "width:100px;" class = "alphanum subtxt" type = "text" value = "<?php echo $position1;?>" />
                                                     <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "voluntary_del"/> </span>

                                                </td>

                                               </tr> 
                                               <script>
                                                    $("#orgPanel").on("click",".voluntary_del",function(){
                                                     $(this).parents('tr').remove();
                                                 });
                                               </script>
                                        <?php
                                    }
                                    ?>
                                    </tr>
                                    <tr class="myTemplate3" style="display:none;">
                                        <input placeholder = "N/A"type = "hidden" name = "a0[]" value = <?php echo $oid1;?> />
                                        <td colspan =2 style = "text-align:center;background-color:#F5F5F5;"><input style = "width:90%;" name = "a1[]" placeholder = "N/A" class = "alphanum subtxt" type = "text"  value = "" /></td>
                                        <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A"  name = "a2[]" class = "datePicker220 alphanum subtxt" type = "text"  value = "" /></td>
                                        <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A"  name = "a3[]" class = "datePicker220 alphanum subtxt" type = "text"   value = "" /></td>
                                        <td style = "text-align:center;"><input style = "max-width:100%;" placeholder = "N/A"  name = "a4[]"class = "alphanum subtxt" type = "text" value = "" /></td>
                                        <td style = "text-align:center;" colspan = 2>
                                            <input style = "width:50%;" placeholder = "N/A"  name = "a5[]" style = "width:100px;" class = "alphanum subtxt" type = "text" value = "" />
                                             <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "voluntary_del"/> </span>

                                        </td>
                                    </tr>
                                 </tbody>
                                <thead>
                                <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7>VII.  LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED
                                <br><label style = "font-size:12px;">(Start from the most recent L&D/training program and include on the the relevant  L&D/training  taken for the last five (5) years for Division Chief/Executive/Managerial positions)</label>
                                <span  class = "pull-right"><img id="moreDates"  src = "../images/add_rec.png" ></span></th>
                         </thead>
                         <tr>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2 colspan = 2>30. TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS (Write in full)</th>
                                    <th colspan = 2 style = "text-align:center;background-color:#F5F5F5;">INCLUSIVE DATES OF ATTENDANCE<br>(mm/dd/yyyy)</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2>NUMBER OF HOURS</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2 >TYPE of ID (Managerial/Supervisory Technical/etc)</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;" rowspan = 2 colspan = 2>CONDUCTED/SPONSORED BY<br>(Write in full)</th>
                                </tr>
                                <tr>
                                    <th style = "text-align:center;background-color:#F5F5F5;">FROM</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;">TO</th>
                                    <th style = "text-align:center;background-color:#F5F5F5;"></th>
                                    <th style = "text-align:center;background-color:#F5F5F5;"></th>
                                </tr>
                                <tbody  id ="importantDates">
                                  <tr class="myTemplate" style="display:none;">
                                    <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                    $select_trainings = "SELECT 
                                    `ID`, 
                                    `EMP_ID`, 
                                    `TITLE_PROGRAM`,
                                    `TP_FROM`, 
                                    `TP_TO`, 
                                    `NO_OF_HOURS`, 
                                    `ID_TYPE`, 
                                    `SPONSORED_BY` FROM `hris_trainings` WHERE
                                    `EMP_ID` = '".$currentuser."' order by TP_FROM
                                    ";
                                    $result = mysqli_query($link, $select_trainings);
                                    if (mysqli_num_rows($result) != 0)
                                    {   
                                        while($row = mysqli_fetch_array($result))
                                            {
                                                $tp4 = $row['ID'];
                                                      $tp_program4= $row['TITLE_PROGRAM'];
                                                      $tp_from4= $row['TP_FROM'];
                                                      $tp_to4= $row['TP_TO'];
                                                      $to_hours4= $row['NO_OF_HOURS'];
                                                      $tp_id_type4= $row['ID_TYPE'];
                                                      $tp_sponsored4= $row['SPONSORED_BY'];
                                                      $date_from = date_create($tp_from4);
                                                      $date_to = date_create($tp_to4);
                                                      
                                                ?>
                                                <tr>
                                                    <input placeholder = "N/A"type = "hidden" name = "tp_id[]" id = "org_id<?php echo $tp4;?>"value = "<?php echo $tp4;?>" />
                                                    <td style = "text-align:center;background-color:#F5F5F5;" colspan = 2><input style = "width:90%;" placeholder = "Title of the Program" name = "tp_program[]" class = "alphanum subtxt" type = "text"  value = "<?php echo $tp_program4;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "From"name = "tp_from[]" class = "myDate alphanum subtxt" type = "text"  value = "<?php  if ($tp_from4 == '0000-00-00'){echo $tp_from4;}else { echo date_format($date_from,"F d, Y");}?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "To "name = "tp_to[]" class = "myDate alphanum subtxt" type = "text"   value = "<?php  if ($tp_to4 == '0000-00-00'){echo $tp_to4;}else { echo date_format($date_to,"F d, Y");}?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "No. of hours"name = "tp_hours[]" class = "alphanum subtxt" type = "text" value = "<?php echo $to_hours4;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "Type of I.D"name = "tp_id_type[]" class = "alphanum subtxt" type = "text" value = "<?php echo $tp_id_type4;?>" /></td>
                                                    <td style = "text-align:center;">
                                                        <input placeholder = "Sponsored by"name = "tp_sponsored[]" style = "width:100px;" class = "alphanum subtxt" type = "text" value = "<?php echo $tp_sponsored4;?>" />
                                                        <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "org_del<?php echo $row['ID'];?>"/> </span>
                                                    </td>
                                                </tr>
                                                <script>
                                                  $("#importantDates").on("click", ".org_del<?php echo $row['ID'];?>", function() {
                                                      function doConfirm(msg, yesFn, noFn)
                                                                {
                                                                    var confirmBox = $("#confirmBox2");
                                                                    confirmBox.find(".message").text(msg);
                                                                    confirmBox.find(".yes,.no").unbind().click(function()
                                                                    {
                                                                    confirmBox.hide();
                                                                    });
                                                                    confirmBox.find(".yes").click(yesFn);
                                                                    confirmBox.find(".no").click(noFn);
                                                                    confirmBox.show();
                                                                }
                                                                var modal = document.getElementById("myModal2");
                                                                var span = document.getElementsByClassName("close")[0];
                                                                modal.style.display = "block";
                                                                doConfirm('Are you sure you want to delete this record?',function yes(){
                                                                                                var id = $('#org_id<?php echo $row['ID'];?>').val();
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "hris_functions.php",
                                                        data: {"options":'organization',"o_id": id,"o_userid":<?php echo $currentuser;?>},
                                                        success: function(){
                                                        console.log(<?php echo $row['ID'];?>);
                                                        window.location.reload();
                                                         $(this).parents('tr').remove();

                                                        // window.location ="hris_functions.php";
                                                        }
                                                    });
                                                                                                modal.style.display = "none";
                                                                                              }, function no(){  modal.style.display = "none";})
                                                                // When the user clicks on <span> (x), close the modal
                                                                span.onclick = function() {
                                                                modal.style.display = "none";
                                                                }
                                                                // When the user clicks anywhere outside of the modal, close it
                                                                window.onclick = function(event) {
                                                                if (event.target == modal) {
                                                                modal.style.display = "none";
                                                                }
                                                                } 
                                                  });
                                                  $("#importantDates").on("click", ".org_del", function() {
                                                    $(this).parents('tr').remove();
                                                  });
                                                
                                               </script>
                                                <?php
                                            }
                                    }else{
                                        ?>
                                        <tr>
                                                    <input placeholder = "N/A"type = "hidden" name = "tp_id[]" value = "<?php echo $tp4;?>" />
                                                    <td style = "text-align:center;background-color:#F5F5F5;" colspan = 2><input style = "width:90%;" placeholder = "Title of the Program" name = "tp_program[]" class = "alphanum subtxt" type = "text"  value = "<?php echo $tp_program4;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "From"name = "tp_from[]" class = "myDate alphanum subtxt" type = "text"  value = "<?php  if ($tp_from4 == '0000-00-00'){echo $tp_from4;}else { echo date_format($date_from,"F d, Y");}?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "To "name = "tp_to[]" class = "myDate alphanum subtxt" type = "text"   value = "<?php  if ($tp_to4 == '0000-00-00'){echo $tp_to4;}else { echo date_format($date_to,"F d, Y");}?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "No. of hours"name = "tp_hours[]" class = "alphanum subtxt" type = "text" value = "<?php echo $to_hours4;?>" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "Type of I.D"name = "tp_id_type[]" class = "alphanum subtxt" type = "text" value = "<?php echo $tp_id_type4;?>" /></td>
                                                    <td style = "text-align:center;">
                                                        <input placeholder = "Sponsored by"name = "tp_sponsored[]" style = "width:100px;" class = "alphanum subtxt" type = "text" value = "<?php echo $tp_sponsored4;?>" />
                                                        <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "org_del"/> </span>
                                                    </td>
                                                </tr>
                                                <script>
                                                     $("#importantDates").on("click", ".org_del", function() {
                                                    $(this).parents('tr').remove();
                                                  });
                                                </script>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                  <tr class="myTemplate" style="display:none">
                                                    <input placeholder = "N/A"type = "hidden" name = "tp_id[]" value = "<?php echo $tp4;?>" />
                                                    <td style = "text-align:center;background-color:#F5F5F5;" colspan = 2><input style = "width:90%;" placeholder = "N/A"name = "tp_program[]" class = "alphanum subtxt" type = "text"  value = "" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"type="text"  name = "tp_from[]"class = " datePicker alphanum subtxt"   value=""/></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"type="text"   name = "tp_to[]" class = "datePicker alphanum subtxt"    value="" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"name = "tp_hours[]" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td style = "text-align:center;"><input placeholder = "N/A"name = "tp_id_type[]" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td style = "text-align:center;">
                                                        <input placeholder = "N/A"name = "tp_sponsored[]" style = "width:100px;" class = "alphanum subtxt" type = "text" value = "" />
                                                        <span style = "float:right;"><img src = "images/delete.jpg" style = "width:25px;height:25px;" class = "org_del"/> </span>

                                                        </td>
                                                </tr>
                                </tbody>
                                
                                <thead>
                                <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7>VIII.  OTHER INFORMATION</th>
                                </thead>
                                <tr>
                             <td colspan = 3 style="text-align:center;background-color:#F5F5F5;" colspan =2>Special Skills and Hobbies</td>
                             <td colspan = 2 style="text-align:center;">Non-Academic Distinctions/Recognition</td>
                             <td colspan = 2 style="text-align:center;">Membership in Association/Organization</td>
                         </tr>
                                <tr>
                            <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                    $select_skills = "SELECT 
                                    `ID`, 
                                    `EMP_ID`, 
                                    `SKILLS`,
                                    `RECOGNITION`, 
                                    `ORGANIZATION` from `hris_skills`
                                     WHERE
                                    `EMP_ID` = '".$currentuser."' 
                                    LIMIT 1
                                    ";
                                    $result = mysqli_query($link, $select_skills);
                                    if (mysqli_num_rows($result) != 0)
                                    {   
                                        ?>
                                            <?php
                                            $s_id1 = '';
                                                while($row = mysqli_fetch_array($result))
                                                    {
                                                     $s_id1 = $row['ID'];
                                                     $s_skills1 = $row['SKILLS'];
                                                     $s_recog1 = $row['RECOGNITION'];
                                                     $s_org1 = $row['ORGANIZATION'];
                                                    }
                                            ?>
                                                    <input placeholder = "N/A"type = "hidden" name = "s_id1" value = "<?php echo $s_id1;?>" />
                                                    <td colspan = 3 style = "text-align:center;background-color:#F5F5F5"><input style = "width:90%;" placeholder = "Special skills and hobbies"name = "s_skills1" class = "alphanum subtxt" type = "text" value = "<?php echo $s_skills1;?>" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input style = "width:100%;" placeholder = "N/A"name = "s_recog1" class = "alphanum subtxt" type = "text" value = "<?php echo $s_recog1;?>" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input style = "width:90%;" placeholder = "N/A"name = "s_org1" class = "alphanum subtxt" type = "text" value = "<?php echo $s_org1?>" /></td>

                                    	<?php
                                    }else{
                                        ?>
                                                    <td colspan = 2 style = "text-align:center;background-color:#F5F5F5"><input placeholder = "N/A"name = "s_skills1" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input placeholder = "N/A"name = "s_recog1" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input placeholder = "N/A"name = "s_org1" class = "alphanum subtxt" type = "text" value = "" /></td>

                                        <?php
                                    }
                                    ?>
                            
                        </tr>
                                <tr>
                            <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                    $select_skills = "SELECT 
                                    `ID`, 
                                    `EMP_ID`, 
                                    `SKILLS`,
                                    `RECOGNITION`, 
                                    `ORGANIZATION` from `hris_skills`
                                     WHERE
                                    `EMP_ID` = '".$currentuser."' and
                                    `ID` != '".$s_id1."'
                                    LIMIT 1
                                    ";
                                    $result = mysqli_query($link, $select_skills);
                                    if (mysqli_num_rows($result) != 0)
                                    {   
                                        ?>
                                            <?php
                                            $s_id2 = '';
                                                while($row = mysqli_fetch_array($result))
                                                    {
                                                     $s_id2 = $row['ID'];
                                                     $s_skills2 = $row['SKILLS'];
                                                     $s_recog2 = $row['RECOGNITION'];
                                                     $s_org2 = $row['ORGANIZATION'];
                                                    }
                                            ?>
                                                    <input placeholder = "N/A"type = "hidden" name = "s_id2" value = "<?php echo $s_id2;?>" />
                                                    <td colspan = 3 style = "text-align:center;background-color:#F5F5F5"><input style = "width:90%;" placeholder = "N/A"name = "s_skills2" class = "alphanum subtxt" type = "text" value = "<?php echo $s_skills2;?>" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input style = "width:90%;" placeholder = "N/A"name = "s_recog2" class = "alphanum subtxt" type = "text" value = "<?php echo $s_recog2;?>" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input style = "width:90%;" placeholder = "N/A"name = "s_org2" class = "alphanum subtxt" type = "text" value = "<?php echo $s_org2?>" /></td>

                                    	<?php
                                    }else{
                                        ?>
                                                    <td colspan = 2 style = "text-align:center;background-color:#F5F5F5"><input placeholder = "N/A"name = "s_skills2" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input placeholder = "N/A"name = "s_recog2" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input placeholder = "N/A"name = "s_org2" class = "alphanum subtxt" type = "text" value = "" /></td>

                                        <?php
                                    }
                                    ?>
                            
                        </tr>
                                <tr>
                            <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                    $select_skills = "SELECT 
                                    `ID`, 
                                    `EMP_ID`, 
                                    `SKILLS`,
                                    `RECOGNITION`, 
                                    `ORGANIZATION` from `hris_skills`
                                     WHERE
                                    `EMP_ID` = '".$currentuser."' and
                                    `ID` != '".$s_id1."' and
                                    `ID` != '".$s_id2."' 
                                    LIMIT 1
                                    ";
                                    $result = mysqli_query($link, $select_skills);
                                    if (mysqli_num_rows($result) != 0)
                                    {   
                                        ?>
                                            <?php
                                            $s_id2 = '';
                                                while($row = mysqli_fetch_array($result))
                                                    {
                                                     $s_id3 = $row['ID'];
                                                     $s_skills3 = $row['SKILLS'];
                                                     $s_recog3 = $row['RECOGNITION'];
                                                     $s_org3 = $row['ORGANIZATION'];
                                                    }
                                            ?>
                                                    <input placeholder = "N/A"type = "hidden" name = "s_id3" value = "<?php echo $s_id3;?>" />
                                                    <td colspan = 3 style = "text-align:center;background-color:#F5F5F5"><input style = "width:90%;" placeholder = "N/A"name = "s_skills3" class = "alphanum subtxt" type = "text" value = "<?php echo $s_skills3;?>" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input style = "width:90%;" placeholder = "N/A"name = "s_recog3" class = "alphanum subtxt" type = "text" value = "<?php echo $s_recog3;?>" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input style = "width:90%;" placeholder = "N/A"name = "s_org3" class = "alphanum subtxt" type = "text" value = "<?php echo $s_org3?>" /></td>

                                    	<?php
                                    }else{
                                        ?>
                                                    <td colspan = 2 style = "text-align:center;background-color:#F5F5F5"><input placeholder = "N/A"name = "s_skills3" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input placeholder = "N/A"name = "s_recog3" class = "alphanum subtxt" type = "text" value = "" /></td>
                                                    <td colspan = 2 style = "text-align:center;"><input placeholder = "N/A"name = "s_org3" class = "alphanum subtxt" type = "text" value = "" /></td>

                                        <?php
                                    }
                                    ?>
                            
                        </tr>
                                     <thead>
                                        <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7>41. REFERENCES <br>(Person not related by consanguinity or affinity to applicant /appointee)</th>
                                    </thead>
                                    <tr>
                                     <td colspan = 2 style="text-align:center;background-color:#F5F5F5;">Name</td>
                                     <td colspan = 3 style="text-align:center;">Address</td>
                                     <td colspan = 2 style="text-align:center;">Tel. No.</td>
                                    </tr>
                                     <?php 
                                    if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                    $select_skills = "SELECT `ID`, `EMP_ID`, `NAME`, `ADDRESS`, `TEL_NO` FROM `hris_references` where
                                    `EMP_ID` = '".$currentuser."'
                                    ";
                                    $result = mysqli_query($link, $select_skills);
                                    if (mysqli_num_rows($result) != 0)
                                    {   
                                        ?>
                                            <?php
                                            $s_id2 = '';
                                                while($row = mysqli_fetch_array($result))
                                                    {
                                                     $name = $row['NAME'];
                                                     $address = $row['ADDRESS'];
                                                     $tel = $row['TEL_NO'];
                                                     $id = $row['ID'];
                                                     ?>
                                                     <tr>
                                                         <input placeholder = "N/A"type = "hidden" value = "<?php echo $id?>" name = "r_id[]" />
                                                         <td  colspan = 2 style="text-align:center;background-color:#F5F5F5;"><input  placeholder = "Name"style = "width:90%;" type = "text" class = "alpha subtxt size150" name = "r_name[]" value = "<?php echo $name;?>" /></td>
                                                         <td  colspan = 3 style="text-align:center;"><input placeholder = "Complete Address"type = "text" style = "width:90%;" class = "alpha subtxt size150" name = "r_address[]" value = "<?php echo $address;?>" /></td>
                                                         <td  colspan = 2 style="text-align:center;"><input placeholder = "Telephone No."type = "text" style = "width:90%;" class = "alpha subtxt size150" name = "r_tel[]" value = "<?php echo $tel;?>" /></td>
                                                     </tr>
                                                     <?php
                                                    }
                                    }
                                    ?>
                                  
                            </tbody>
                            <thead>
                                <th style = "text-align:left;padding:10px;color:#FAFAFA;" colspan=7></th>
                         </thead>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  Are you related by consanguinity or affinity to the appointing or recommending authority, or to the			
                                  chief of bureau or office or to the person who has immediate supervision over you in the Office, 	<br><br>		
                                    a. within the third degree?
                                       <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q1 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 1
                                            ";
                                            $result = mysqli_query($link, $query_q1);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup1" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup1" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup1" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup1" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?><br>
                                    b. within the fourth degree (for Local Government Unit - Career Employees)?    
                                        <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q2 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 2
                                            ";
                                            $result = mysqli_query($link, $query_q2);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                        <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup2" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup2" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup2" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup2" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <td colspan = 3>
                                   <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q2 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 1
                                            ";
                                            $result = mysqli_query($link, $query_q2);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            
                                                            If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                          
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                                        <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q2 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 2
                                            ";
                                            $result = mysqli_query($link, $query_q2);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            
                                                            <br>If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                          
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                            </td>
                          </tr>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                a. Have you ever been found guilty of any administrative offense?
                                        <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q3 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 3
                                            ";
                                            $result = mysqli_query($link, $query_q3);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup3" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup3" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup3" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup3" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q35 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 3
                                            ";
                                            $result = mysqli_query($link, $query_q35);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                
                                                        ?>
                                                            <td colspan =3>
                                                            If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                      
                                                        
                                                    }
                                            }
                                        ?>
                               
                          </tr>
                          <tr>
                               <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                        b. Have you been criminally charged before any court?
                                        <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q4 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 4
                                            ";
                                            $result = mysqli_query($link, $query_q4);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup4" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup4" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup4" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup4" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q44 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 4
                                            ";
                                            $result = mysqli_query($link, $query_q44);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        $date = date_create($row['DATE_FILED']);
                                                     if($row['ANSWER'] == 'Yes')
                                                        {
                                                            ?>
                                                            <td colspan = 3>
                                                            Date Filed:<input placeholder = "N/A"type = "text" name = "date_filed" id = "date_filed" class = "alpha subtxt" value = "<?php echo date_format($date,'F d, Y');?>" style = "width:90%;" />
                                                            Status of Case/s:<input placeholder = "N/A"type = "text" name = "q1[]"class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                            <?php
                                                        }else{
                                                        ?>
                                                            <td colspan = 3>
                                                            Date Filed:<input placeholder = "N/A"type = "text" name = "date_filed" id = "date_filed" class = "alpha subtxt" style = "width:90%;" />
                                                            Status of Case/s:<input placeholder = "N/A"type = "text" name = "q1[]"class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              
                          </tr>
                          <tr>
                            <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?<br>			
                                       <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q5 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 5
                                            ";
                                            $result = mysqli_query($link, $query_q5);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup5" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup5" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]q1" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup5" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup5" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                            </td>
                             <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q55 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 5
                                            ";
                                            $result = mysqli_query($link, $query_q55);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                          <tr>
                               <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                   Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?<br>
                                     <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q6 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 6
                                            ";
                                            $result = mysqli_query($link, $query_q6);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup6" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup6" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup6" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup6" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                               </td>
                               <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q66 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 6
                                            ";
                                            $result = mysqli_query($link, $query_q66);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?<br>
                             <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q7 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 7
                                            ";
                                            $result = mysqli_query($link, $query_q7);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup7" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup7" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?> 
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup7" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup7" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                               <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q77 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 7
                                            ";
                                            $result = mysqli_query($link, $query_q77);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                            
                          </tr>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?
                             <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q8 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 8
                                            ";
                                            $result = mysqli_query($link, $query_q8);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup8" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup8" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup8" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup8" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q88 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 8
                                            ";
                                            $result = mysqli_query($link, $query_q88);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES, give details:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  Have you acquired the status of an immigrant or permanent resident of another country?
                                    <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q9 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 9
                                            ";
                                            $result = mysqli_query($link, $query_q9);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup9" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup9" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup9" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup9" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                               <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q99 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 9
                                            ";
                                            $result = mysqli_query($link, $query_q99);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES, give details (country):<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items:			
                                  <br><br>a. Are you a member of any indigenous group?	
                                  <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q10 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 10
                                            ";
                                            $result = mysqli_query($link, $query_q10);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup10" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup10" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup10" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup10" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q1010 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 10
                                            ";
                                            $result = mysqli_query($link, $query_q1010);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES,please specify:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                          
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  b. Are you a person with disability?			
                                  <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q11 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 11
                                            ";
                                            $result = mysqli_query($link, $query_q11);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup11" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup11" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup11" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup11" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q1111 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 11
                                            ";
                                            $result = mysqli_query($link, $query_q1111);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES,please specify:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                          <tr>
                              <td colspan = 4 style = "text-align:left;background-color:#F5F5F5;">
                                  c. Are you a solo parent?	
                                  <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q12 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 12
                                            ";
                                            $result = mysqli_query($link, $query_q12);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        if($row['ANSWER'] == 'Yes')
                                                        {
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup12" value = "Yes" checked/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup12" value = "No"/> No
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <input placeholder = "N/A"type = "hidden" name = "q_no[]" value = "<?php echo $row['QUESTION_NO'];?>">
                                                            <input placeholder = "N/A"type = "hidden" name = "chk_id1[]" value = "<?php echo $row['ID'];?>">
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup12" value = "Yes"/> Yes
                                                            <input placeholder = "N/A"type = "checkbox" name="chk[]" class = "checkboxgroup12" value = "No" checked/> No
                                                        <?php
                                                        }
                                                        
                                                    }
                                            }
                                        ?>
                              </td>
                              <?php 
                                            if(mysqli_connect_errno()){echo mysqli_connect_error();}  
                                            $query_q1212 = "SELECT * FROM `hris_questions` WHERE `EMP_ID` = '".$currentuser."' and `QUESTION_NO` = 12
                                            ";
                                            $result = mysqli_query($link, $query_q1212);
                                            if (mysqli_num_rows($result) != 0)
                                            {   
                                                if($row = mysqli_fetch_array($result))
                                                    {
                                                        ?>
                                                            <td colspan = 3>
                                                            If YES,please specify:<input placeholder = "N/A"name = "q1[]" type = "text" class = "alpha subtxt" style = "width:90%;" value = "<?php  if($row['ANSWER'] == 'Yes'){ echo $row['DETAILS'];}?>"/>
                                                            </td>
                                                        <?php
                                                       
                                                        
                                                    }
                                            }
                                        ?>
                          </tr>
                        </table>
                    </div>
                    
                    
                    
                    
                    
                    
                     <button type = "submit"  name = "save" class="button white normalrounded">Update</button>
            </form>
        </div>
</div>


   <?php require_once('_includes/footer.php'); ?>

    <script src="chosen/chosen.jquery.js" 	type="text/javascript"></script>
    <script src="chosen/docsupport/prism.js" 	type="text/javascript" charset="utf-8"></script>
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
    
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js" type="text/javascript"></script>-->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>-->
    <!--<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"type="text/javascript"></script>-->

    <script>
    $('.checkboxgroup1').on('change', function() {
        $('.checkboxgroup1').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup_gender').on('change', function() {
        $('.checkboxgroup_gender').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup_status').on('change', function() {
        $('.checkboxgroup_status').not(this).prop('checked', false);  
    });
    
    
    
    $('.checkboxgroup2').on('change', function() {
        $('.checkboxgroup2').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup3').on('change', function() {
        $('.checkboxgroup3').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup4').on('change', function() {
        $('.checkboxgroup4').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup5').on('change', function() {
        $('.checkboxgroup5').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup6').on('change', function() {
        $('.checkboxgroup6').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup7').on('change', function() {
        $('.checkboxgroup7').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup8').on('change', function() {
        $('.checkboxgroup8').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup9').on('change', function() {
        $('.checkboxgroup9').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup10').on('change', function() {
        $('.checkboxgroup10').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup11').on('change', function() {
        $('.checkboxgroup11').not(this).prop('checked', false);  
    });
    
    $('.checkboxgroup12').on('change', function() {
        $('.checkboxgroup12').not(this).prop('checked', false);  
    });
    function showCurrentValue(event)
{
    const value = event.target.value;
    var inches = value/2.54;
    var feet = parseInt(inches/12);
    inches = inches%12;
    var int_part = Math.trunc(inches);
    var a = feet+' ft. '+int_part+' inches';
    document.getElementById("lblValue").value = a;
    
}
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function onButtonClick(){
  document.getElementById('convert').className="hide";
  document.getElementById('lblValue').className="show alphanum subtxt";
  document.getElementById('edValue').className="show alphanum subtxt";
}
    $(document).ready(function() {
 
 var myCounter = 1;
 $(".myDate").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
 $(".myDate2").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
 $(".myDate3").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
 $(".myDate").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    // $( ".datepicker_inc_from1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
    // $( ".datepicker_inc_to1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
 $("#moreDates").click(function(){
  $('.myTemplate')
   .clone()
   .removeClass("myTemplate")
   .addClass("additionalDate")
   .show()
   .appendTo('#importantDates');
   
  myCounter++;
  $('.additionalDate .datePicker').each(function(index) {
   $('.datePicker').addClass("myDate");
   $(this).attr("name",$(this).attr("name") + myCounter);
  });
   
  $(".myDate").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  });

   
 });
 $('#moreExp').click(function(){
    $('.myTemplate2')
   .clone()
   .removeClass("myTemplate2")
   .addClass("additionalDate")
   .show()
   .appendTo('#workExpPanel');
   
  myCounter++;
  $('.additionalDate .datePicker22').each(function(index) {
   $('.datePicker22').addClass("myDate2");
   $(this).attr("name",$(this).attr("name") + myCounter);
  });
   
  $(".myDate2").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  }); 

});
 $("#moreOrg").click(function(){
    $('.myTemplate3')
   .clone()
   .removeClass("myTemplate3")
   .addClass("additionalDate")
   .show()
   .appendTo('#orgPanel');
   
  myCounter++;
  $('.additionalDate .datePicker220').each(function(index) {
   $('.datePicker220').addClass("myDate3");
   $(this).attr("name",$(this).attr("name") + myCounter);
  });
  $(".myDate3").on('focus', function(){
      var $this = $(this);
      if(!$this.data('datepicker')) {
       $this.removeClass("hasDatepicker");
       $this.datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
       $this.datepicker("show");
      }
  }); 
});

});
</script>
<script>

$( function() {
//   ====================================
$( "#datehired" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#date_filed" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

    

$( "#birthdate" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:2020",
        dateFormat:'M dd, yy'
});
$( "#bd1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd5" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd6" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd7" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd8" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd9" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd10").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd11").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd12").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#bd13").datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// ====================================
$('.p_from1').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_from2').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_from3').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_from4').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_from5').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

$('.p_to1').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_to2').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_to3').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_to4').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $('#p_to5').datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});


// =====================================
$( ".datepicker1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( ".datepicker_civil" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker2_2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker3_3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker4_4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});

// ==============================
$( "#datepicker_e_from1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_to1" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_from2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_to2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_from3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_to3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_from4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
$( "#datepicker_e_to4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// ===============================

// $( "#datepicker_inc_from2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $( "#datepicker_inc_to2" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $( "#datepicker_inc_from3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $( "#datepicker_inc_to3" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $( "#datepicker_inc_from4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});
// $( "#datepicker_inc_to4" ).datepicker({changeMonth: true, changeYear: true, yearRange: "1950:2020", dateFormat:'M dd, yy'});


} );
</script>
<script>
function readURL(input) {
var url = input.value;
var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#img').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
}else{
     $('#img').attr('src', 'images/male-user.png');
}
}
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
acc[i].addEventListener("click", function() {
this.classList.toggle("active");
var panel = this.nextElementSibling;
if (panel.style.display === "block") {
  panel.style.display = "none";
} else {
  panel.style.display = "block";
}
});
}
</script>
<script>
function autocomplete(inp, arr) {
/*the autocomplete function takes two arguments,
the text field element and an array of possible autocompleted values:*/
var currentFocus;
/*execute a function when someone writes in the text field:*/
inp.addEventListener("input", function(e) {
  var a, b, i, val = this.value;
  /*close any already open lists of autocompleted values*/
  closeAllLists();
  if (!val) { return false;}
  currentFocus = -1;
  /*create a DIV element that will contain the items (values):*/
  a = document.createElement("DIV");
  a.setAttribute("id", this.id + "autocomplete-list");
  a.setAttribute("class", "autocomplete-items");
  /*append the DIV element as a child of the autocomplete container:*/
  this.parentNode.appendChild(a);
  /*for each item in the array...*/
  for (i = 0; i < arr.length; i++) {
    /*check if the item starts with the same letters as the text field value:*/
    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
      /*create a DIV element for each matching element:*/
      b = document.createElement("DIV");
      /*make the matching letters bold:*/
      b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
      b.innerHTML += arr[i].substr(val.length);
      /*insert a input field that will hold the current array item's value:*/
      b.innerHTML += "<input placeholder = "N/A"type='hidden' value='" + arr[i] + "'>";
      /*execute a function when someone clicks on the item value (DIV element):*/
      b.addEventListener("click", function(e) {
          /*insert the value for the autocomplete text field:*/
          inp.value = this.getElementsByTagName("input")[0].value;
          /*close the list of autocompleted values,
          (or any other open lists of autocompleted values:*/
          closeAllLists();
      });
      a.appendChild(b);
    }
  }
});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
  var x = document.getElementById(this.id + "autocomplete-list");
  if (x) x = x.getElementsByTagName("div");
  if (e.keyCode == 40) {
    /*If the arrow DOWN key is pressed,
    increase the currentFocus variable:*/
    currentFocus++;
    /*and and make the current item more visible:*/
    addActive(x);
  } else if (e.keyCode == 38) { //up
    /*If the arrow UP key is pressed,
    decrease the currentFocus variable:*/
    currentFocus--;
    /*and and make the current item more visible:*/
    addActive(x);
  } else if (e.keyCode == 13) {
    /*If the ENTER key is pressed, prevent the form from being submitted,*/
    e.preventDefault();
    if (currentFocus > -1) {
      /*and simulate a click on the "active" item:*/
      if (x) x[currentFocus].click();
    }
  }
});
function addActive(x) {
/*a function to classify an item as "active":*/
if (!x) return false;
/*start by removing the "active" class on all items:*/
removeActive(x);
if (currentFocus >= x.length) currentFocus = 0;
if (currentFocus < 0) currentFocus = (x.length - 1);
/*add class "autocomplete-active":*/
x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
/*a function to remove the "active" class from all autocomplete items:*/
for (var i = 0; i < x.length; i++) {
  x[i].classList.remove("autocomplete-active");
}
}
function closeAllLists(elmnt) {
/*close all autocomplete lists in the document,
except the one passed as an argument:*/
var x = document.getElementsByClassName("autocomplete-items");
for (var i = 0; i < x.length; i++) {
  if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
  }
}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
  closeAllLists(e.target);
});
}
/*An array containing all the country names in the world:*/
var countries = ["Afghans","Albanians","Algerians","Andorrans","Angolans","Antiguans and Barbudans","Argentines","Armenians","Arubans","Filipino","Americans"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>

