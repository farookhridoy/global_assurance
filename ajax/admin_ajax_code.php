<?php 
ini_set('max_execution_time', 0);  set_time_limit(0); ignore_user_abort(true);
include('../includes/config.php');

require_once('../spreadsheet-plugin/php-excel-reader/excel_reader2.php');
require_once('../spreadsheet-plugin/SpreadsheetReader.php');
//exit("Action Not Allowed!!!!");	
?>
<?php
global $db;
$user_id = state('user_id');
$user_name = state("user_name");
if(!$user_id){
  $data_sucess['sucess'] = 0;  
  $data_sucess['message'] = "Authentication Required.";
  echo json_encode($data_sucess);
  die();  
}


$action = $_REQUEST['action'];

switch($action)
	{		
		
        case 'load_agent':
        $agentType = trim($_POST['agent_type']);
        $agentID = trim($_POST['agent_num']);
        $agentLevel = trim($_POST['agent_level']);
        $agentLevelSub = $agentLevel + 1;
        
        $agentInfo = getSingleAgent($agentID);
       
        $agentSub = getAgentLists($agentType,$agentLevelSub,$agentID);
        
        if($agentInfo){
        $data_sucess['sucess'] = 1;
        $data_sucess['agent_data'] = $agentInfo;
        $data_sucess['agent_sub'] = $agentSub;
        }else{
           $data_sucess['sucess'] = 0; 
        }
		echo json_encode($data_sucess);
	    break;
        
        case 'load_coverage':
        $planID = trim($_POST['plan_num']);
        $coverageLists = getPolicyCoverages($planID);
        if($coverageLists){
           $data_sucess['sucess'] = 1;
           $data_sucess['coverage_data'] = $coverageLists; 
        }else{
           $data_sucess['sucess'] = 0; 
        }
        echo json_encode($data_sucess);
        break;
        
        case 'load_deductible':
        $coverageID = trim($_POST['cov_num']);
        $deductibleLists = getPolicyDeductibles($coverageID);
        if($deductibleLists){
           $data_sucess['sucess'] = 1;
           $data_sucess['deductible_data'] = $deductibleLists; 
        }else{
           $data_sucess['sucess'] = 0; 
           //$data_sucess['message'] = $coverageID; 
           
        }
        echo json_encode($data_sucess);
        break;  
        
        case 'create_policy_number':
        
        $year = trim($_POST['year_fval']);
        $plan = trim($_POST['plan_fval']);
        $policy_id = trim($_POST['policy_num']);
        
        if(!$policy_id)
        $policy_id = createNewPolicy();
        
        
        if($policy_id && $plan && $year){
           $year_last_two = substr( $year, -2);
           $plan_code = getPolicyPlanCode($plan);
           if($year_last_two && $plan_code){
            $policy_number = "1".$plan_code.$year_last_two."-";
            $policy_id_len = strlen($policy_id);
            if($policy_id_len<5){
            $policy_id_code =  $policy_id;
            while(strlen($policy_id_code)<5){
              $policy_id_code = "0". $policy_id_code; 
            }
             
            }else{
                $policy_id_code = $policy_id;
            }
            $policy_number = $policy_number.$policy_id_code;
            $data_sucess['sucess'] = 1;
            $data_sucess['policy_nu'] = $policy_id; 
            $data_sucess['policy_number'] = $policy_number;
           }
           
           
        }else{
           $data_sucess['sucess'] = 0; 
           //$data_sucess['message'] = $coverageID; 
           
        }
        echo json_encode($data_sucess);
        break; 
        
        
        
        case 'save_insured':
        
        $checkPermission = checkUserAccessRole('Policies');
        if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
        }
        
        $insured_id = trim($_POST['insured_num']);
        $policy_id = trim($_POST['policy_num']);
        $process_filter = trim($_POST['process_filter']);
        
        if($policy_id){
        $interview = $db_data['interview'] = trim($_POST['interview']);
        $order = $db_data['ins_order'] = trim($_POST['order']);
        $first_name = $db_data['first_name'] = trim($_POST['first_name']);
        $last_name = $db_data['last_name'] = trim($_POST['last_name']);
        if(trim($_POST['dob']))
        $dob = $db_data['dob'] = date("Y-m-d",strtotime(trim($_POST['dob'])));
        $relation = $db_data['idrelation'] = trim($_POST['relation']);
        if(trim($_POST['effective']))
        $effective = $db_data['effectivedate'] = date("Y-m-d",strtotime(trim($_POST['effective'])));
        $age = $db_data['age'] = trim($_POST['age']);
        $gender = $db_data['gender'] = trim($_POST['gender']);
        $ninety_day_waiver = $db_data['ninety_day_waiver'] = trim($_POST['ninety_day_waiver']);
        if(trim($_POST['effective_ninety_day']))
        $effective_ninety_day = $db_data['effective_ninety_day'] = date("Y-m-d",strtotime(trim($_POST['effective_ninety_day'])));
        $ridermater = $db_data['ridermat'] = trim($_POST['ridermater']);
       	$ridercomp = $db_data['ridercommat'] = trim($_POST['ridercomp']);
        $activelab = $db_data['active'] = trim($_POST['activelab']); 
        if(trim($_POST['ins_inactivate_date'])) 
        $ins_inactivate_date = $db_data['dateinactive'] = date("Y-m-d",strtotime(trim($_POST['ins_inactivate_date'])));
        $ins_email = $db_data['email'] = trim($_POST['ins_email']); 
        $db_data['idpolicy'] = $policy_id;
        
        if($process_filter){
            if($insured_id)
            $insuredOldData = getHealthSingleInsured($insured_id);
            //else
            //$insuredOldData = array('idpolicy'=>$policy_id);
        }
        
        $insured_id = saveHealthInsured($policy_id,$db_data,$insured_id);
        if($insured_id){
          if($process_filter && $insuredOldData) 
          addAuditsPolicyInsuredData($insuredOldData,$db_data);
          
          $data_sucess['insured_number'] = $insured_id;
          $data_sucess['data_row'] = trim($_POST['data_row_id']);
          
          $data_sucess['sucess'] = 1;  
        }else{
          $data_sucess['sucess'] = 0; 
          $data_sucess['message'] = 'Failed to save insured.';  
        }
        }else{
           $data_sucess['sucess'] = 0; 
           $data_sucess['message'] = 'Policy number not found.';  
        }
		echo json_encode($data_sucess);
	    break;
        
        
        case 'remove_insured':
        
        $checkPermission = checkUserAccessRole('Policies');
        if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
        }
        
        $insured_id = trim($_POST['insured_num']);
        
        $delete_insured = removeHealthInsured($insured_id);
        if($delete_insured){
          $data_sucess['insured_number'] = $insured_id;
          $data_sucess['data_row'] = trim($_POST['data_row_id']);
          
          $data_sucess['sucess'] = 1;  
        }else{
          $data_sucess['sucess'] = 0; 
          $data_sucess['message'] = 'Failed to remove insured.';  
        }
        
        echo json_encode($data_sucess);
	    break;
        
        case 'load_rateups':
        $rate_up_type = trim($_POST['rate_up_type']);
        if($rate_up_type){
          $rateUPSingle = getSingleRateUpType($rate_up_type);
          //print_r($rateUPSingle);
          if($rateUPSingle){ 
             $data_sucess['sucess'] = 1;
             $data_sucess['rateuppercent'] = $rateUPSingle['rateuppercent'];
             $data_sucess['rateupamount'] = $rateUPSingle['rateupamount'];
          }
        }else{
           $data_sucess['sucess'] = 0; 
        }
        
        echo json_encode($data_sucess);
	    break;
        
        case 'save_rateups':
        
        $checkPermission = checkUserAccessRole('Policies');
        if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
        }
        
        $rate_up_type = trim($_POST['rate_up_type']);
        $insured_number = trim($_POST['insured_number']);
        $rate_up_amount = trim($_POST['rate_up_amount']);
        if(($rate_up_type || $rate_up_amount) && $insured_number){
          //$rateUPSingle = getRateUpByInsured($insured_number);
          //print_r($rateUPSingle);
          //if($rateUPSingle)
          //$rateUpData['id'] = $rateUPSingle['id'];
          
          $rateUpData['idinsured'] = $rateUPSingle['id'];
          $rateUpData['rate_up_id'] = $rate_up_type;
          $rateUpData['amount'] = $rate_up_amount;
          
          $rateUPId = addRateUps($insured_number,$rateUpData);
          
          //print_r($rateUPSingle);
          if($rateUPId){ 
             $data_sucess['sucess'] = 1;
             $data_sucess['rate_id'] = $rateUPId;
             $data_sucess['insurednumber'] = $insured_number;
             
          }
        }else{
           $data_sucess['sucess'] = 0; 
        }
        
        
        echo json_encode($data_sucess);
	    break;
        
        case 'rate_up_changes_insured': 
        
        $insured_number = trim($_POST['insured_num']);
        
        if($insured_number){
          $rateUPSingle = getRateUpByInsured($insured_number);
         
          if($rateUPSingle){ 
            $rateUpType = getSingleRateUpType($rateUPSingle['idrateuptype']);
            //print_r($rateUpType);
            if($rateUpType){
               $data_sucess['sucess'] = 1;
               $data_sucess['rateuppercent'] = $rateUpType['rateuppercent'];
               $data_sucess['rateupamount'] = $rateUpType['rateupamount']; 
               $data_sucess['insurednumber'] = $insured_number; 
               $data_sucess['data_row'] = trim($_POST['data_row_id']);
               //print_r($data_sucess);
            }
             
             
          }
        }else{
           $data_sucess['sucess'] = 0; 
        }
        
        
        echo json_encode($data_sucess);
	    break;
        
        case 'delete_rateup': 
        
        $rate_id = trim($_POST['rateup_id']);
        
        if($rate_id){         
            $rateUpDelete = DeleteSingleRateUp($rate_id);            
            $data_sucess['sucess'] = 1;
        }else{
           $data_sucess['sucess'] = 0; 
        }
        
        echo json_encode($data_sucess);
	    break;
        
        
        case 'update_insured_premium':
        
        $premium['idinsured'] = trim($_POST['insured_number']);
        $premium['premiumBase'] = trim($_POST['premiumBase']);
        $premium['premiumCalculate'] = trim($_POST['premiumCalculate']);
        
        $auditCalculatePremium = state('c_premium');
        
        if(!$auditCalculatePremium){
         $policy_id = getPolicyIDByInsured($premium['idinsured']);
         addAudit(array("uid"=>$user_id,"idpolicy"=>$policy_id,"action"=>$user_name." Clicked Calculate Premiums"));
         state('c_premium',1);
        }
        
        if($premium['idinsured']){          
          $premiumId = updateInsuredPremium($premium);
          if($premiumId){ 
             $data_sucess['sucess'] = 1;             
          }else{
            $data_sucess['sucess'] = 0;
          }
        }else{
           $data_sucess['sucess'] = 0; 
        }
        
        
        echo json_encode($data_sucess);
	    break;
        
        case 'save_health_policy':
        
        
        $checkPermission = checkUserAccessRole('Policies');
        if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
        }
        
        $policy_id = trim($_POST['policy_num']);
        $policy_number = $db_data['policynumber'] = trim($_POST['policy_number']);
        $date_cancelled = trim($_POST['date_cancelled']);
        if($date_cancelled)
        $db_data['datecancel']  = date("Y-m-d",strtotime($date_cancelled));
        $policy_carrier = $db_data['carrier'] = trim($_POST['policy_carrier']);
        $effective_date =  trim($_POST['effective_date']);
        if($effective_date)
        $db_data['effectivedate'] = date("Y-m-d",strtotime($effective_date));
        $plan = $db_data['idplan'] = trim($_POST['plan']);
        $coverage = $db_data['idcoverage'] = trim($_POST['coverage']);
        $deductible = $db_data['iddeductible'] = trim($_POST['deductible']);
        
        
        $group_id = $db_data['idgroup'] = trim($_POST['group_id']);
        $policy_rfid = $db_data['rfid'] = trim($_POST['policy_rfid']);
        $rfid_clams = $db_data['rfidclams'] = trim($_POST['rfid_clams']);
        $policy_status = $db_data['idstatus'] = trim($_POST['policy_status']);
        $cancel_reason = $db_data['idnotecancel'] = trim($_POST['cancel_reason']);
        $address_l1 = $db_data['addressl1'] = trim($_POST['address_l1']);
        $address_l2 = $db_data['addressl2'] = trim($_POST['address_l2']);
        $contact_city = $db_data['city'] = trim($_POST['contact_city']);
        $contact_country = $db_data['idcountry'] = trim($_POST['contact_country']);
        $contact_phone = $db_data['phone'] = trim($_POST['contact_phone']);
        $contact_work_phone = $db_data['workphone'] = trim($_POST['contact_work_phone']);
        $contact_cell_phone = $db_data['cellphone'] = trim($_POST['contact_cell_phone']);
        $contact_email = $db_data['email'] = trim($_POST['contact_email']);
        $rate_year = $db_data['idrateyear'] = trim($_POST['rate_year']);
        $payment_start = trim($_POST['payment_start']);
        if($payment_start)
        $db_data['paymentstart'] = date("Y-m-d",strtotime($payment_start));
        $payment_end = trim($_POST['payment_end']);
        if($payment_end)
        $db_data['paymentend'] = date("Y-m-d",strtotime($payment_end));
        $payment_cycle = $db_data['idpaycycle'] = trim($_POST['payment_cycle']);
        $date_due =  trim($_POST['date_due']);
        if($date_due)
        $db_data['paymentduedate'] = date("Y-m-d",strtotime($date_due));
        $group_discount = $db_data['groupdiscount'] = trim($_POST['group_discount']);
        $policy_discount = $db_data['policydiscount'] = trim($_POST['policy_discount']);
        $policy_fee = $db_data['fee'] = trim($_POST['policy_fee']);
        $doctor = $db_data['iddoctor'] = trim($_POST['doctor']);
        $date_received = trim($_POST['date_received']);
        if($date_received)
        $db_data['datereceived'] = date("Y-m-d",strtotime($date_received));
        $date_approved = trim($_POST['date_approved']);
        if($date_approved)
        $db_data['dateapproved'] = date("Y-m-d",strtotime($date_approved));
        
        $dominicana = $db_data['dominicana'] = trim($_POST['dominicana'])? 1: 0;
        $approved_standard = $db_data['approvedstandrad'] = trim($_POST['approved_standard'])? 1: 0;
        $death_main_insured = $db_data['deathmaininsured'] = trim($_POST['death_main_insured'])? 1: 0;
        $is_spanish = $db_data['spanish'] = trim($_POST['is_spanish'])? 1: 0;
        $claria_express = $db_data['clariaexpress'] = trim($_POST['claria_express'])? 1: 0;
        $add_percent = $db_data['add_25_percent'] = trim($_POST['add_percent'])? 1: 0;
        $premium_zone = $db_data['premium_zone'] = trim($_POST['premium_zone']);
        
        $policy_form_edit = trim($_POST['policy_form_edit']);
        
        
        
        $notes = $_POST['notes'];
        if($notes)
        $notes = array_reverse($notes);
        
        //echo json_encode($_FILES);
        //break;
        
        
        $notesids = $_POST['notesids'];
        if($notesids)
        $notesids = array_reverse($notesids);
        
         
        if($_POST['agent_level5']>0){
          $agent_id = $_POST['agent_level5']; 
        }
        elseif($_POST['agent_level4']>0){
           $agent_id = $_POST['agent_level4'];
        }
        elseif($_POST['agent_level3']>0){
            $agent_id = $_POST['agent_level3'];
        }
        elseif($_POST['agent_level2']>0){
          $agent_id = $_POST['agent_level2']; 
        }
        elseif($_POST['agent_level1']>0){
           $agent_id = $_POST['agent_level1']; 
        }
        	
        
        $db_data['idagent'] = $agent_id;
        $db_data['policytype'] = "health"; 
        $db_data['last_update'] = time(); 
        
        
        
        
        if($policy_id){
           $policyOldData = getSinglePolicy($policy_id);
           $db_data['active'] = 1;
           $updStats = saveHealthPolicy($policy_id,$db_data); 
        }
  
        
        if($updStats){  
        addAuditsPolicyFormData($policyOldData,$db_data);
        $data_sucess['sucess'] = 1;
        if($notes){
          addPolicyNotes($policy_id,$notes,$notesids);  
        }
        }else{
           $data_sucess['sucess'] = 0; 
           //$data_sucess['message'] = $coverageID; 
           
        }
        
        echo json_encode($data_sucess);
        break; 
        
        
        case 'duplicate_policy':
        
        $checkPermission = checkUserAccessRole('Policies');
        if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
        }
        
        $policy_id = trim($_POST['policy_num']);
        $new_policy_numer = trim($_POST['policy_new_number']);
        
        if($policy_id && $new_policy_numer){
         $new_policy_id = duplicateHealthPolicy($policy_id,$new_policy_numer); 
         if($new_policy_id){
          $data_sucess['sucess'] = 1;
          $data_sucess['new_policy_number'] = $new_policy_id;
             
         }
        }else{
           $data_sucess['sucess'] = 0; 
           //$data_sucess['message'] = $coverageID; 
           
        }
        echo json_encode($data_sucess);
        break; 
        
        ## Payment Codes 
        
        case 'save_agent_notes':
          $checkPermission = checkUserAccessRole('Policies');
          if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
          }
          $policy_id =trim($_POST['policy_id']);
          $note_1 = trim($_POST['note_1']);
          $note_2 = trim($_POST['note_2']);
          $note_3 = trim($_POST['note_3']);
          $note_4 = trim($_POST['note_4']);
          $note_5 = trim($_POST['note_5']);
          $created_date = date("Y-m-d");
          $updated_date = date("Y-m-d");

          if($policy_id){
            $new_agent_notes = createNewAgentNotes($policy_id,$note_1,$note_2,$note_3,$note_4,$note_5,$created_date,$updated_date);
            if($new_agent_notes){
            $data_sucess['sucess'] = 1;
          }
        }else{
         $data_sucess['sucess'] = 0; 
       }
       echo json_encode($data_sucess);

        break;
        //for save payments
         case 'save_payments':

           $checkPermission = checkUserAccessRole('Policies');
           if(!$checkPermission){
            $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
            echo json_encode($data_sucess);
            break;
          }

          $policy_id = trim($_POST['policy_id']);
          $payments_id = $db_data['id'] = trim($_POST['payments_id']);

          $p_id = $db_data['id_policy'] = trim($_POST['policy_id']);
          $receipt_pay = $db_data['receipt_pay'] = $_POST['receipt_pay'];
          $receipt_type = $db_data['receipt_type'] = $_POST['receipt_type'];
          $receipt_note = $db_data['receipt_note'] = $_POST['receipt_note'];
          $paymenType = $db_data['type'] = $_POST['paymenType'];
          $id_pay_cycle = $db_data['id_pay_cycle'] = $_POST['id_pay_cycle'];
          $paymentamount = $db_data['amount'] = $_POST['paymentamount'];
          $paymentpolicyfee = $db_data['fee'] = $_POST['paymentpolicyfee'];
          $paymentdetails = $db_data['details'] = $_POST['paymentdetails'];

          $discount_agent_1 = $db_data['agent_1_discount'] = $_POST['discount_agent_1'];
          $discount_agent_2 = $db_data['agent_2_discount'] = $_POST['discount_agent_2'];
          $discount_agent_3 = $db_data['agent_3_discount'] = $_POST['discount_agent_3'];
          $discount_agent_4 = $db_data['agent_4_discount'] = $_POST['discount_agent_4'];
          $discount_agent_5 = $db_data['agent_5_discount'] = $_POST['discount_agent_5'];

          $paymentMethod = $db_data['id_pay_type'] = $_POST['paymentMethod'];



          $locked = $db_data['locked'] = $_POST['locked'];
          $paidcheck = $db_data['paid'] = $_POST['paidcheck'];

          $paymentAction = $db_data['action'] = $_POST['paymentAction'];

          $paymentpaid = $_POST['paymentpaid'];
          if($paymentpaid)
            $db_data['date_paid']  = date("Y-m-d",strtotime($paymentpaid));
          $paymentduedate = $_POST['paymentduedate'];
          if($paymentduedate)
            $db_data['date_due']  = date("Y-m-d",strtotime($paymentduedate));


          if($policy_id){
            $new_payments = createNewPayments($db_data);
            if($new_payments){
              $data_sucess['sucess'] = 1;

            }
          }else{
           $data_sucess['sucess'] = 0; 
         }
         echo json_encode($data_sucess);

         break;
        //end notes add end
         case 'save_agent_label':

        $checkPermission = checkUserAccessRole('Policies');
            if(!$checkPermission){
                $data_sucess = array("sucess"=>0,"pr"=>1,"message"=>"Permission error");
                echo json_encode($data_sucess);
                break;
            }

            $policy_id = trim($_POST['policy_id']);
            $data_id = trim($_POST['data_id']);
            $agent_id = trim($_POST['agent_id']);

            $db_data['agent_id'] =  $agent_id;
            $db_data['policy_id'] = $policy_id;
            $db_data['label_id'] = $data_id;
            $db_data['commission'] = trim($_POST['agent_level'.$data_id.'_commission']);
            $db_data['sys_nb'] = trim($_POST['agent_level'.$data_id.'_sys_nb']);
            $db_data['nb'] = trim($_POST['agent_level'.$data_id.'_nb']);
            $db_data['sys_rn'] = trim($_POST['agent_level'.$data_id.'_sys_rn']);
            $db_data['rn'] = trim($_POST['agent_level'.$data_id.'_rn']);
            $db_data['pay_by'] = trim($_POST['agent_level'.$data_id.'_pay_by']);

            if($policy_id && $agent_id){

                $new_payments = createNewAgentLabel($db_data,$agent_id,$policy_id,$data_id);

                if($new_payments){

                  $data_sucess['sucess'] = 1;

                }

          }else{

            $data_sucess['sucess'] = 0; 
         }
         echo json_encode($data_sucess);
         break;
        //end agent commission 
	}
die();	
?>