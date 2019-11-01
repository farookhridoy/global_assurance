<?php

/******Health Policy New ****/

function getPolicyCarrier(){
    $carrier = array("Claria"=>"Claria","Global Medical"=>"Global Medical");
    return $carrier;
}

function getPolicyStatus(){
    
    global $db;
    $statusLists = array();
    $sql="SELECT * FROM statuspolicy WHERE active ='1'";
    $statusData = $db->select($sql);
    if($statusData){
        foreach($statusData as $key => $value){
            $statusLists[$value['id']] = trim($value['status']);
        }
    }
    
    return $statusLists;
}

function getCancelReasons(){
    
    global $db;
    $cancelReasons = array();
    $sql="SELECT * FROM notecancel WHERE active ='1'";
    $cancelData = $db->select($sql);
    if($cancelData){
        foreach($cancelData as $key => $value){
            $cancelReasons[$value['id']] = trim($value['note']);
        }
    }
    
    return $cancelReasons;
}


function getCountryLists(){
    
    global $db;
    $countryLists = array();
    $sql="SELECT * FROM country WHERE active ='1'";
    $countryData = $db->select($sql);
    if($countryData){
        foreach($countryData as $key => $value){
            $countryLists[$value['id']] = trim($value['country']);
        }
    }
    
    return $countryLists;
}


function getRelationLists($policy_type='health'){
    
    global $db;
    $relationLists = array();
    $sql="SELECT * FROM relation WHERE active ='1' AND policytype='$policy_type'";
    $relationData = $db->select($sql);
    if($relationData){
        foreach($relationData as $key => $value){
            $relationLists[$value['id']] = trim($value['relation']);
        }
    }
    
    return $relationLists;
}

function getRelationbyid($policy_id){
    
    global $db;
    $relationLists = array();
    $sql="SELECT * FROM relation WHERE active ='1' AND id='$policy_id'";
    $relationData = $db->select_single($sql);
    if($relationData){
        $insured_relation = $relationData['relation'];
    }
    
    return $insured_relation;
}

function getDoctorLists(){
    
    global $db;
    $doctorLists = array();
    $sql="SELECT * FROM doctor WHERE active ='1'";
    $doctorData = $db->select($sql);
    if($doctorData){
        foreach($doctorData as $key => $value){
            $doctorLists[$value['id']] = trim($value['name']);
        }
    }
    
    return $doctorLists;
}


function getRateYearLists(){
    
    global $db;
    $yearLists = array();
    $sql="SELECT * FROM rateyear";
    $yearData = $db->select($sql);
    if($yearData){
        foreach($yearData as $key => $value){
            $yearLists[$value['id']] = trim($value['year']);
        }
    }
    
    return $yearLists;
}

function getPayCycleLists(){
    
    global $db;
    $payCycleLists = array();
    $sql="SELECT * FROM paycycle";
    $payData = $db->select($sql);
    if($payData){
        foreach($payData as $key => $value){
            $payCycleLists[$value['id']] = trim($value['paycycle']);
        }
    }
    
    return $payCycleLists;
}


function getPayTypeLists(){
    
    global $db;
    $payTypeLists = array();
    $sql="SELECT * FROM pay_type";
    $typeData = $db->select($sql);
    if($typeData){
        foreach($typeData as $key => $value){
            $payTypeLists[$value['id']] = trim($value['name']);
        }
    }
    
    return $payTypeLists;
}



function getPolicyPlanLists($policy_type){
    global $db;
    $planLists = array();
    if($policy_type){
        $sql="SELECT * FROM plan WHERE idtypepolicy='$policy_type' AND active ='1'";
        $planData = $db->select($sql);
        if($planData){
            foreach($planData as $key => $value){
                $planLists[$value['id']] = trim($value['plan']);
            }
        }
    }
    return $planLists;
}
 

function getPolicyCoverages($id_plan){
    global $db;
    $coverageLists = array();
    if($id_plan){
        $sql="SELECT * FROM coverage WHERE idplan='$id_plan' AND active ='1'";
        $coverageData = $db->select($sql);
        if($coverageData){
            foreach($coverageData as $key => $value){
                $coverageLists[$value['id']] = trim($value['coverage']);
            }
        }
    }
    return $coverageLists;
}


function getPolicyDeductibles($id_coverage){
    global $db;
    
    $deductibleLists = array();
    if($id_coverage){
        $sql="SELECT * FROM deductible WHERE idcoverage='$id_coverage' AND active ='1'";
        $deductibleLists = $db->select($sql);
    }
    return $deductibleLists;
}


function getAgentLists($policy_type,$level,$parent=0){
    global $db;
    $agentLists = array();
    if($policy_type && $level){
        if($policy_type == "life")
        $sql="SELECT * FROM agents WHERE life='1' AND active ='1' AND level='$level'";
        else
        $sql="SELECT * FROM agents WHERE health='1' AND active ='1' AND level='$level'";
        
        $agentLists = $db->select($sql);
    }
    return $agentLists;
}


function getSingleAgent($agent_id){
    global $db;
    $agent = array();
    if($agent_id){
        $sql="SELECT * FROM agents WHERE id='$agent_id' AND active ='1'";
        $agent = $db->select_single($sql);
    }
    return $agent;
}

function createNewPolicy(){
    global $db;
    $policy_id = 0;
    $sql="INSERT INTO policy SET active='4'";
    $policy_id = $db->insert($sql);
    return $policy_id;
}

function getPolicyPlanCode($policy_name){
    $code = '';
    switch($policy_name){
        case 'Mundial':
        $code = 'MU';
        break;
        
        case 'Sky':
        $code = 'SK';
        break;
        
        case 'Sun':
        $code = 'SN';
        break;
        
        case 'Star':
        $code = 'SR';
        break;
    }
    
    return $code;
}


function saveHealthPolicy($policy_id, $data){
  global $db;  
  $stats = '';
  if($policy_id && $data){
    if($data && is_array($data)){
        $sql = 'UPDATE policy SET ';
        foreach($data as $key => $value){
           $sql .=  $key.'="'.$value.'",';
        }
        $sql = rtrim($sql,",");
        $sql .= ' WHERE id="'.$policy_id.'"';
        $stats = $db->edit($sql);
    }
  }
 return $stats; 
}

function saveHealthInsured($policy_id, $data , $insured_id){
  global $db;  
  $stats = '';
  if($policy_id && $data){
    if($data && is_array($data)){
        if($insured_id)
        $sql = 'UPDATE insured SET ';
        else
        $sql = 'INSERT INTO insured SET ';
        
        foreach($data as $key => $value){
           $sql .=  $key.'="'.$value.'",';
        }
        $sql = rtrim($sql,",");
        
        if($insured_id)
        $sql .= ' WHERE id="'.$insured_id.'"';
        
        if($insured_id)
        $stats = $db->edit($sql);
        else $insured_id = $db->insert($sql);
    }
  }
 return $insured_id; 
}


function removeHealthInsured($insured_id){
  global $db; 
  $stats = false; 
  if($insured_id){
    $sql= "DELETE FROM insured WHERE id='$insured_id'";
    $stats = $db->delete($sql);
  }
  return $stats;  
}

function getHealthInsuredLists($policy_id){
  global $db;  
  $insuredLists = array();
    if($policy_id){
        $sql="SELECT * FROM insured WHERE idpolicy='$policy_id' ORDER BY id ASC";
        $insuredLists = $db->select($sql);
    }
    return $insuredLists;
}


function getHealthSingleInsured($insured_id){
    global $db;
    $insuredData = array();
    if($insured_id){
        $sql="SELECT * FROM insured WHERE id='$insured_id'";
        $insuredData = $db->select_single($sql);
    }
    return $insuredData;
}

function getPolicyIDByInsured($insured_id){
    global $db;
    $policyID = 0;
    if($insured_id){
        $sql="SELECT idpolicy FROM insured WHERE id='$insured_id'";
        $insuredData = $db->select_single($sql);
        $policyID = $insuredData['idpolicy'];
    }
    return $policyID;
}



function removeNotes($policy_id,$notes_exclude){
  global $db;  
  if($policy_id && $notes_exclude){
    $notesIds = implode(",",$notes_exclude);
    
    $sql= "DELETE FROM notespolicy WHERE idpolicy='$policy_id' AND id NOT IN($notesIds)";
    $db->delete($sql);
  }  
}
function addPolicyNotes($policy_id, $notes , $notesids=null){
  global $db;  
  if($policy_id && $notes){
     $user_id = state('user_id');
     $user_name = state("user_name");
    
    
    foreach($notes as $key => $note){
        $note = trim($note);
       if($note){
       if($notesids[$key] && $notesids[$key] !='NEW'){
        $sql='UPDATE notespolicy SET note="'.$note.'", idpolicy="'.$policy_id.'" WHERE id="'.$notesids[$key].'"'; 
        $stats= $db->update($sql);
        //if($stats)
        $note_id = $notesids[$key];
       }else{
       $sql='INSERT INTO notespolicy SET note="'.$note.'", idpolicy="'.$policy_id.'"'; 
       $note_id = $db->insert($sql);
       if($note_id){
        addAudit(array("uid"=>$user_id,"idpolicy"=>$policy_id,"action"=>$user_name." add a note"));
       }
      
       
       }
       
       if($note_id)
       $notesAdded[] = $note_id;
       }
    }
    //print_r($notesAdded);
    if($notesAdded)
    removeNotes($policy_id,$notesAdded);
  }
  return $notesAdded; 
}
function getPolicyNotes($policy_id){
  global $db;  
  $notesLists = array();
    if($policy_id){
        $sql="SELECT * FROM notespolicy WHERE idpolicy='$policy_id' ORDER BY id DESC";
        $notesLists = $db->select($sql);
    }
    return $notesLists;
}
function removePolicyFiles($policy_id,$file_lists){
  global $db;  
  if($policy_id && $file_lists){
    $filesIds = implode(",",$file_lists);
    
    $sql= "DELETE FROM filespolicy WHERE idpolicy='$policy_id' AND id IN($filesIds)";
    $db->delete($sql);
  }  
}
function addPolicyFiles($policy_id, $files , $filesids=null){
  global $db; 
   
  $user_id = state('user_id');
  $user_name = state("user_name");
  
  if($policy_id && $files){
    foreach($files as $key => $file){
        $description = trim($file['description']);
        $file_path = trim($file['file_path']);
        if($file_path){
           if($filesids[$key]){
            $sql='UPDATE filespolicy SET description="'.$description.'", idpolicy="'.$policy_id.'" WHERE id="'.$filesids[$key].'"'; 
            $stats= $db->update($sql);
            if($stats)
            $file_id = $filesids[$key];
           }else{
           $sql='INSERT INTO filespolicy SET description="'.$description.'", file_path="'.$file_path.'", idpolicy="'.$policy_id.'"'; 
           $file_id = $db->insert($sql);
           if($file_id)
           addAudit(array("uid"=>$user_id,"idpolicy"=>$policy_id,"action"=>$user_name." add a file"));
           }
           
           if($file_id)
           $filesAdded[] = $file_id;
       }
    }
  }
  return $filesAdded; 
}
function getPolicyFiles($policy_id){
  global $db;  
  $filesLists = array();
    if($policy_id){
        $sql="SELECT * FROM filespolicy WHERE idpolicy='$policy_id' ORDER BY id DESC";
        $filesLists = $db->select($sql);
    }
    return $filesLists;
}
function getHealthPolicies(){
 global $db; 

 $policyLists = array();
 $sql="SELECT * FROM policy WHERE policytype='health' AND active ='1'";
 $policyLists = $db->select($sql);
    
 return $policyLists;  
}
function getSinglePolicy($policy_id){
    global $db;
    $policy_info = array();
    if($policy_id){
        $sql="SELECT * FROM policy WHERE id='$policy_id' AND active ='1'";
        $policy_info = $db->select_single($sql);
    }
    return $policy_info;
}
function dateFormFormat($date,$format="m/d/Y"){
    if($date && $date != '0000-00-00 00:00:00'){
       $dateTime = strtotime($date);
       $dateYear = date("Y",$dateTime);
       //if($dateYear > 1970)
       return date($format,$dateTime);
    }
    
}
function loadHealthPolicyAgents($agent_id){
  global $db; 
  
  $policyAgents = array();
  if($agent_id){
    $sql="SELECT * FROM agents WHERE id='$agent_id'";
    $agent_info = $db->select_single($sql);
    if($agent_info){
        $agent_info_level = $agent_info['level'];
        $agent_info_parent = $agent_info['idagent'];
        $policyAgentsLevel = $db->select("SELECT * FROM agents WHERE health='1' AND idagent ='$agent_info_parent'");
        if($policyAgentsLevel){
            foreach($policyAgentsLevel as $key => $value){
               if($value['id']==$agent_id){
                $value['selected'] = 1;
               } 
               $policyAgents[$agent_info_level][] = $value;
            }
            
            //$policyAgents[$agent_info_level]['parent'] = $agent_info_parent;
        }
        
    }
  }
  
  return $policyAgents; 
}
function loadHealthPolicyAgentNames($agent_id){
  global $db; 
  
  $policyAgents = array();
  if($agent_id){
    $sql="SELECT * FROM agents WHERE id='$agent_id'";
    $agent_info = $db->select_single($sql);
    if($agent_info){
        $agent_info_level = $agent_info['level'];
        $agent_info_parent = $agent_info['idagent'];
        
        $policyAgents[$agent_info_level] = $agent_info['name'];
        
        while($agent_info_level != 1){
          $sql="SELECT * FROM agents WHERE id='$agent_info_parent'";
          $agent_info = $db->select_single($sql); 
          $agent_info_level = $agent_info['level'];
          $agent_info_parent = $agent_info['idagent'];
          $policyAgents[$agent_info_level] = $agent_info['name']; 
        }   
    }
  }
  
  return $policyAgents; 
}
function getRateUptypes(){
    global $db;
    $rateUpTypes = array();
    $sql="SELECT * FROM rateuptypes WHERE active ='1'";
    $rateUpTypes = $db->select($sql);
    return $rateUpTypes;
}
function getSingleRateUpType($type_id){
    global $db;
    $rateup_type_info = array();
    if($type_id){
        $sql="SELECT * FROM rateuptypes WHERE id='$type_id'";
        $rateup_type_info = $db->select_single($sql);
    }
    return $rateup_type_info;
}
function getRateUpByInsured($insured_id){
    global $db;
    $rateup_info = array();
    if($insured_id){
        $sql="SELECT * FROM rateup WHERE idinsured='$insured_id'";
        $rateup_info = $db->select_single($sql);
    }
    return $rateup_info;
}

function getRateUpById($rateup_id){
    global $db;
    $rateup_info = array();
    if($rateup_id){
        $sql="SELECT * FROM rateup WHERE id='$rateup_id'";
        $rateup_info = $db->select_single($sql);
    }
    return $rateup_info;
}

function getRateUpsByInsured($insured_id){
    global $db;
    $rateups = array();
    if($insured_id){
        $sql="SELECT * FROM rateup WHERE idinsured='$insured_id'";
        $rateups = $db->select($sql);
    }
    return $rateups;
}


function getRateUpListsByInsured($insured_id){
    global $db;
    $rateup_lists = array();
    if($insured_id){
        $sql="SELECT * FROM rateup WHERE idinsured='$insured_id'";
        $rateup_lists = $db->select($sql);
    }
    return $rateup_lists;
}

function addRateUps($insured_id, $data){
  global $db;  
  if($insured_id && $data){

       if($data['id']){
         $sql='UPDATE rateup SET idinsured="'.$insured_id.'", amount="'.$data['amount'].'", idrateuptype = "'.$data['rate_up_id'].'" WHERE id="'.$data['id'].'"'; 
         $stats= $db->update($sql);
        $rateUpId = $data['id'];
       }else{
         $sql='INSERT INTO rateup SET idinsured="'.$insured_id.'", amount="'.$data['amount'].'", idrateuptype = "'.$data['rate_up_id'].'"'; 
         $rateUpId = $db->insert($sql);
       }
      
  }
  return $rateUpId; 
}




function DeleteSingleRateUp($rateupid){
  global $db;  
  if($rateupid){
      $sql= "DELETE FROM rateup WHERE id='$rateupid'";
      $db->delete($sql);
  }
}

function getHealthMainInsuredId(){
 global $db;
 $primary_insured_id = 0;
 $sql = "SELECT id FROM relation WHERE relation='Main Insured'";
 $relation_info = $db->select_single($sql); 
 if($relation_info)  
 $primary_insured_id = $relation_info['id'];
 return $primary_insured_id;
}

function getHealthPrimaryInsured($policy_id){
  global $db;
  $primaryInsuredInfo = array();
  $primary_insured_id = getHealthMainInsuredId();
  if($policy_id && $primary_insured_id){
    $sql = "SELECT * FROM insured WHERE idrelation='$primary_insured_id' AND idpolicy='$policy_id'";
    $primaryInsuredInfo = $db->select_single($sql); 
     
  }
  return $primaryInsuredInfo;
}

function getHealthPrimaryInsuredText($policy_id){
    $primaryInsuredText = '';
    $primaryInsuredInfo = getHealthPrimaryInsured($policy_id); 
    if($primaryInsuredInfo){
      $primaryInsuredText = $primaryInsuredInfo['first_name']." ".$primaryInsuredInfo['last_name'];
    }
    return $primaryInsuredText;
}

function getHealthPrimaryInsuredFirstName($policy_id){
    $primaryInsuredText = '';
    $primaryInsuredInfo = getHealthPrimaryInsured($policy_id); 
    if($primaryInsuredInfo){
      $primaryInsuredText = $primaryInsuredInfo['first_name'];
    }
    return $primaryInsuredText;
}

function getHealthPrimaryInsuredLastName($policy_id){
    $primaryInsuredText = '';
    $primaryInsuredInfo = getHealthPrimaryInsured($policy_id); 
    if($primaryInsuredInfo){
      $primaryInsuredText = $primaryInsuredInfo['last_name'];
    }
    return $primaryInsuredText;
}



function saveDeliveryReq($dreq_id, $data){
  global $db;  
  $stats = '';
  if($dreq_id && $data){
    if($data && is_array($data)){
        $sql = 'UPDATE deliveryreq SET ';
        foreach($data as $key => $value){
           $sql .=  $key.'="'.$value.'",';
        }
        $sql = rtrim($sql,",");
        $sql .= ' WHERE id="'.$dreq_id.'"';
        //echo $sql;
        $stats = $db->edit($sql);
    }
  }
 return $stats; 
}

function deleteDeliveryReq($dreq_id){
    global $db;
    if($dreq_id){
    $sql= "DELETE FROM deliveryreq WHERE id='$dreq_id'";
    $stats = $db->delete($sql);
    }
    return $stats;
}



function getDeliveryRequests($policy_id){
    global $db;
    $dreqLists = array();
    $sql="SELECT * FROM deliveryreq WHERE idpolicy = '$policy_id' AND status !=''";
    $dreqLists = $db->select($sql);
    return $dreqLists;
}

function getDeliveryRequest($dreq_id){
    global $db;
    $dreqInfo = array();
    $sql="SELECT * FROM deliveryreq WHERE id = '$dreq_id'";
    $dreqInfo = $db->select_single($sql);
    return $dreqInfo;
}

function createNewDeliveryReq($policy_id){
    global $db;
    $dreq_id = 0;
    $sql="INSERT INTO deliveryreq SET idpolicy='$policy_id'";
    $dreq_id = $db->insert($sql);
    return $dreq_id;
}

function generateDreqNumber($dreq_id,$policy_number){ 

 $dreqNumber = '';
 if($dreq_id){
    $dreq_id_len = strlen($dreq_id);
    if($dreq_id_len<5){
    $dreq_id_code =  $dreq_id;
    while(strlen($dreq_id_code)<5){
      $dreq_id_code = "0". $dreq_id_code; 
    }
 }else{
    $dreq_id_code = $dreq_id;
   }
   $dreqNumber = $policy_number.'DREQ'.$dreq_id_code;
 }
 return $dreqNumber;
}

function updateInsuredPremium($data){
  global $db;  
  if($data){
    if($data['idinsured']){
        $sql='UPDATE insured SET basepremium="'.$data['premiumBase'].'", premium = "'.$data['premiumCalculate'].'" WHERE id="'.$data['idinsured'].'"'; 
        $stats= $db->update($sql);
        $premiumId = $data['idinsured'];
    }
      
  }
  return $premiumId; 
}

function getNewRiderNumber(){
  global $db;  
  $sql="SELECT MAX(id) as max_num FROM rider";
  $riderData = $db->select_single($sql);
  $new_number = $riderData['max_num'] ? $riderData['max_num'] : 0;
  $new_number = $new_number + 1;
  return $new_number;
}


function getPolicyNumberById($policy_id){
  global $db;  
  $policy_number = '';
  if($policy_id){
    $sql="SELECT policynumber FROM policy WHERE id='$policy_id'";
    $policyData = $db->select_single($sql);
    $policy_number = $policyData['policynumber'];
  }
  return $policy_number;
}

function getFieldValueByFieldId($table_name,$column_name,$field_value,$field_key='id'){
  global $db;  
  if($table_name && $field_value && $field_key && $column_name){
    $sql="SELECT $column_name FROM $table_name WHERE $field_key='$field_value'";
    $row_data = $db->select_single($sql);
    return $row_data[$column_name];
  } 
}

function generateRiderNumber($policy_id){ 

 $riderNumber = '';
 if($policy_id){
    $new_rider_id = getNewRiderNumber();
    
    $new_rider_id_len = strlen($new_rider_id);
    if($dreq_id_len<5){
    $new_rider_id_code =  $new_rider_id;
    while(strlen($new_rider_id_code)<5){
      $new_rider_id_code = "0". $new_rider_id_code; 
    }
   }else{
    $new_rider_id_code = $new_rider_id;
   }
   
   $policy_id_code = getPolicyNumberById($policy_id);
   $riderNumber = $policy_id_code.'RID'.$new_rider_id_code;
 }
 return $riderNumber;
}

//function write by omar farook from 24-10-2019

function getPayCyclebyid($paycycle_id){

  global $db;
  $payCycleData=array();
  if ($paycycle_id) {

    $sql="SELECT * FROM paycycle WHERE id='$paycycle_id'";
    $payCycleData = $db->select_single($sql);
  }

  return $payCycleData;
}

function createNewAgentNotes($policy_id,$note_1,$note_2,$note_3,$note_4,$note_5,$created_date,$updated_date){
  
  global $db;  
  $stats = '';

  if($policy_id){

    $sql="SELECT * FROM notes WHERE policy_id='$policy_id'";
    $getData = $db->select_single($sql);
    if ($getData!=null) {
      
        $sql='UPDATE notes SET  note_1="'.$note_1.'", note_2 = "'.$note_2.'" , note_3="'.$note_3.'", note_4 = "'.$note_4.'", note_5 = "'.$note_5.'", updated_date = "'.$updated_date.'" WHERE policy_id="'.$policy_id.'"'; 
         $stats= $db->update($sql);
     
    }else{

         $sql='INSERT INTO notes SET  policy_id="'.$policy_id.'", note_1="'.$note_1.'", note_2 = "'.$note_2.'" , note_3="'.$note_3.'", note_4 = "'.$note_4.'", note_5 = "'.$note_5.'", created_date = "'.$created_date.'"'; 
         $stats= $db->insert($sql);

    }

  }
    return $stats;
}


function createNewPayments($db_data){
  global $db;  
  $stats = '';



    if($db_data && is_array($db_data)){
        

        $sql = 'INSERT INTO payments SET ';
        foreach($db_data as $key => $value){
           $sql .=  $key.'="'.$value.'",';
        }
        $sql = rtrim($sql,",");
        $stats = $db->insert($sql);
    }



 return $stats; 
}

function createNewAgentLabel($db_data,$agent_id,$policy_id,$data_id){
  global $db;  

  $stats = '';

    if($db_data && is_array($db_data)){

      $sql="SELECT * FROM `agent_commissions` WHERE `policy_id`='$policy_id' AND `agent_id`='$agent_id' AND `label_id`='$data_id'";
      $getdata=$db->select_single($sql);

        if ($getdata !=null)
            $sql = 'UPDATE agent_commissions SET ';
        else
            $sql = 'INSERT INTO agent_commissions SET ';


        foreach($db_data as $key => $value){
           $sql .=  $key.'="'.$value.'",';
        }

        $sql = rtrim($sql,",");

         if ($getdata !=null)
        $sql .= 'WHERE agent_id="'.$agent_id.'" and policy_id="'.$policy_id.'" and label_id="'.$data_id.'" ';
        
         if ($getdata !=null)
            $stats = $db->edit($sql);
        else 
            $getdata = $db->insert($sql);
    }

 return $getdata; 
}



function getPaymentsLists($policy_id){
    
    global $db;
    $paymentsData = array();
    $sql="SELECT * FROM payments where id_policy='".$policy_id."' ";
    $paymentsData = $db->select($sql);
    
    return $paymentsData;
}

function getsinglePaymentsLists($id){
    
    global $db;
    $data = array();
    $sql="SELECT * FROM payments where id='".$id."'";
    $data = $db->select_single($sql);
    
    return $data;
}

function getSingleAgentNameById($agent_id,$level){
  global $db;  
  $agent_name = '';
  if($agent_id && $level){
   $sql="SELECT * FROM agents WHERE id='$agent_id' AND active ='1' AND level='$level'";
   $agent = $db->select_single($sql);
    $agent_name = $agent['name'];
  }
  return $agent_name;
}


//end file upload
?>