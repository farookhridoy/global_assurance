<?php

function addAudit($data=array()){     /* Table Fields:: id: auto increment, uid: user id, idpolicy: policy id, action: audit details, datecreated: date time default current time stamp */ 
    global $db;
    $audit_id = 0;
    if($data['uid'] && $data['action']){
        $sql = 'INSERT INTO audit SET ';
        foreach($data as $key => $value){
           $sql .=  $key.'="'.$value.'",';
        }
        $sql = rtrim($sql,",");
        $audit_id = $db->insert($sql);
    } 
    return  $audit_id;
}

function getAuditName($user_info=array()){
    if($user_info){
        return $user_info['user_name'];
    }
}


function getAreaActivities($activity_area){
 global $db;
 $activityLists = array();
 if($activity_area){
 $sql="SELECT * FROM audit WHERE audit_area ='$activity_area' ORDER BY id DESC";
 $activityLists = $db->select($sql);
 }
 return $activityLists;   
}


function getPolicyActivities($policy_id){
 global $db;
 $activityLists = array();
 if($policy_id){
 $sql="SELECT * FROM audit WHERE idpolicy ='$policy_id' ORDER BY id DESC";
 $activityLists = $db->select($sql);
 }
 return $activityLists;   
}

function getPolicyActivityLists($policy_id){
    $activityLists = '';
    if($policy_id){
       $activities =  getPolicyActivities($policy_id);
       if($activities){
        foreach($activities as $activity){
            if($activity['action']){
              $activityLists .='<li><span class="activitydesc">'.$activity['action'].' on '.date('n/j/Y',strtotime($activity['datecreated'])).'&nbsp; <span class="timelist">'.date('g:i:s',strtotime($activity['datecreated'])).' '. date('A',strtotime($activity['datecreated'])).'</span></span></li>';  
            }
        }
       }
    }
    return $activityLists;  
}


function getAreaActivityLists($activity_area){
    $activityLists = '';
    if($activity_area){
       $activities =  getAreaActivities($activity_area);
       if($activities){
        foreach($activities as $activity){
            if($activity['action']){
              $activityLists .='<li><span class="activitydesc">'.$activity['action'].' on '.date('n/j/Y',strtotime($activity['datecreated'])).'&nbsp; <span class="timelist">'.date('g:i:s',strtotime($activity['datecreated'])).' '. date('A',strtotime($activity['datecreated'])).'</span></span></li>';  
            }
        }
       }
    }
    return $activityLists;  
}


function getPolicyFormAuditFieldLists(){
    return array('datecancel','carrier','effectivedate','idplan','idcoverage','iddeductible','idgroup','rfid','rfidclams','idstatus','idnotecancel','addressl1','addressl2','city','idcountry','phone','workphone','cellphone','email','idrateyear','paymentstart','paymentend','idpaycycle','paymentduedate','groupdiscount','policydiscount','fee','iddoctor','datereceived','dateapproved','dominicana','approvedstandrad','deathmaininsured','spanish','clariaexpress','premium_zone');
}





function getPolicyFormFieldWithIds(){
    return array(
    'idplan' => array('plan','plan'),
    'idcoverage' => array('coverage','coverage'),
    'iddeductible' => array('deductible','deductible'),
    'idcountry'      => array('country','country'),
    'idrateyear' => array('rateyear','year'),
    'idstatus'   => array('statuspolicy','status'),
    'idnotecancel' => array('notecancel','note'),
    'idpaycycle'   => array('paycycle','paycycle'),
    'iddoctor'     => array('doctor','name')
    );
}

function getPolicyFormDateFields(){
    return array('datecancel','effectivedate','paymentstart','paymentend','paymentduedate','datereceived','dateapproved');
}

function auditPolicyFieldDescriptions(){
    $fieldsDescriptins = array(
    'datecancel' => 'Changed Date Cancelled to',
    'carrier' => 'Changed Carrier to',
    'effectivedate' => 'Changed Effective Date to',
    'idplan'  => 'Changed Plan to',
    'idcoverage' => 'Changed Coverage to',
    'iddeductible' => 'Changed Deductible to',
    'idgroup' => 'Changed Group ID to',
    'rfid' => 'Changed RFID to',
    'rfidclams' => 'Changed RFID Clams to',
    'idstatus' => 'Changed Status to',
    'idnotecancel' => 'Changed Cancel Note to',
    'addressl1'     => 'Changed Address L1 to',
    'addressl2'     => 'Changed Address L2 to',
    'city'          => 'Changed City to',
    'idcountry'     => 'Changed Country to',
    'phone'         => 'Changed Phone Number to',
    'workphone'     => 'Changed Work Phone to',
    'cellphone'     => 'Changed Cell Phone to',
    'email'         => 'Changed Email to',
    'idrateyear'    => 'Changed Rate Year to',
    'paymentstart'  => 'Changed Payment Start to',
    'paymentend'    => 'Changed Payment End to',
    'idpaycycle'  => 'Changed Payment Cycle to',
    'paymentduedate' => 'Changed Payment Due Date to',
    'groupdiscount'  => 'Changed Group Discount to',
    'policydiscount' => 'Changed Discount to',
    //'fee'            => 'Changed Policy fee amount to',
    'iddoctor'       => 'Changed Underwriting Doctor to',
    'datereceived'   => 'Changed Date Received to',
    'dateapproved'   => 'Changed Date Approved to',
    'dominicana'     => 'Changed Dominicana to',
    'approvedstandrad' => 'Changed Approved Standrad to',
    'deathmaininsured' => 'Changed Death Main Insured to',
    'spanish'          => 'Changed Spanish to',
    'clariaexpress'    => 'Changed Claria Express',
    'premium_zone'     => 'Changed Premium Zone to'
    );
    return $fieldsDescriptins;
}


function addAuditsPolicyFormData($policyOldData,$policyNewData){
   $auditFields = getPolicyFormAuditFieldLists();
   $dateFields = getPolicyFormDateFields(); 
   $user_id = state('user_id');
   $user_name = state("user_name");
   $fieldWithIds = getPolicyFormFieldWithIds();
   $filedDescriptions = auditPolicyFieldDescriptions();
   
   if($auditFields){
    
    if($policyNewData && $policyOldData){
       foreach($auditFields as $auditField){
        $needToAudit = false;
        
        if(empty($policyNewData[$auditField]) && empty($policyOldData[$auditField]))
        continue;
        
        if(!in_array($auditField,$dateFields)){
           if($policyOldData[$auditField] != $policyNewData[$auditField]) 
           $needToAudit = true;
        }else{
            $date_old = date("Y-m-d",strtotime($policyOldData[$auditField]));
            if($date_old != $policyNewData[$auditField])
            $needToAudit = true;
        }
        
        if($needToAudit){
            if($fieldWithIds[$auditField]){
                $audArray = $fieldWithIds[$auditField];
                $fieldValue = getFieldValueByFieldId($audArray[0],$audArray[1],$policyNewData[$auditField]);
            }else if(in_array($auditField,$dateFields)){
              $fieldValue =   dateFormFormat($policyNewData[$auditField]);
            }else{
              $fieldValue =  $policyNewData[$auditField];
            }
            
            $filedDescription = $filedDescriptions[$auditField];
            if($filedDescription == 'Changed Claria Express' && $user_id && $user_name && $fieldValue == 0){
                addAudit(array("uid"=>$user_id,"idpolicy"=>$policyOldData['id'],"action"=>$user_name." unselected Claria Express")); 
            }elseif($filedDescription == 'Changed Claria Express' && $user_id && $user_name && $fieldValue == 1){
                addAudit(array("uid"=>$user_id,"idpolicy"=>$policyOldData['id'],"action"=>$user_name." Changed Policy to Claria Express")); 
            }elseif($filedDescription && $user_id && $user_name && !empty($fieldValue)){
                addAudit(array("uid"=>$user_id,"idpolicy"=>$policyOldData['id'],"action"=>$user_name." ".$filedDescription." ".$fieldValue)); 
            }
        }
       } 
     }
   }
}


function auditInsuredFieldDescriptions(){
    $fieldsDescriptins = array(
    'first_name' => 'Changed insureds  first name to',
    'last_name' => 'Changed insureds last_name to',
    'dob' => 'Changed insureds DOB to',
    'idrelation'  => 'Changed Relation to',
    'effectivedate' => 'Changed insureds Effective Date to',
    'age' => 'Changed insureds Age to',
    'gender' => 'Set insureds Gender to',
    'ninety_day_waiver' => 'Changed insureds inclusion to 90 day waiver to',
    'effective_ninety_day' => 'Changed Effective Date 90 day to',
    'active' => 'Changed active to {INSURED_NAME} - ',
    'dateinactive' => 'Changed insureds Inactive Date to',
    'email'     => 'Changed insureds Email to'
    );
    return $fieldsDescriptins;
}

function getInsuredFormDateFields(){
    return array('dob','effectivedate','dateinactive','effective_ninety_day');  
}

function getInsuredFormFieldWithIds(){
    return array(
    'idrelation' => array('relation','relation')
    );
}

function getInsuredFormAuditFieldLists(){
    return array('first_name','last_name','dob','idrelation','effectivedate','age','gender','ninety_day_waiver','effective_ninety_day','active','dateinactive','email');
}

function addAuditsPolicyInsuredData($insuredOldData,$insuredNewData){
   $auditFields = getInsuredFormAuditFieldLists();
   $dateFields = getInsuredFormDateFields(); 
   $user_id = state('user_id');
   $user_name = state("user_name");
   $fieldWithIds = getInsuredFormFieldWithIds();
   $filedDescriptions = auditInsuredFieldDescriptions();
   
   //mail('chisty2008@gmail.com',"test insured ",serialize($insuredOldData)."===".serialize($insuredNewData));
   
   if($auditFields){
    if($insuredOldData && $insuredNewData){
       foreach($auditFields as $auditField){
        $needToAudit = false;
        if(empty($insuredNewData[$auditField]) && empty($insuredOldData[$auditField]))
        continue;
        
        if(!in_array($auditField,$dateFields)){
           if($insuredOldData[$auditField] != $insuredNewData[$auditField]) 
           $needToAudit = true;
        }else{
            $date_old = date("Y-m-d",strtotime($insuredOldData[$auditField]));
            if($date_old != $insuredNewData[$auditField])
            $needToAudit = true;
        }
        
        if($needToAudit){
            if($fieldWithIds[$auditField]){
                $audArray = $fieldWithIds[$auditField];
                $fieldValue = getFieldValueByFieldId($audArray[0],$audArray[1],$insuredNewData[$auditField]);
            }else if(in_array($auditField,$dateFields)){
              $fieldValue =   dateFormFormat($insuredNewData[$auditField]);
            }else{
              $fieldValue =  $insuredNewData[$auditField];
            }
            
            $filedDescription = $filedDescriptions[$auditField];
            $auditName = $insuredNewData['first_name'];
            if($insuredNewData['last_name'])
            $auditName .= " ".$insuredNewData['last_name'];
            
            $filedDescription = str_replace("{INSURED_NAME}",$auditName,$filedDescription);
            
            if($filedDescription && $user_id && $user_name && !empty($fieldValue)){
                addAudit(array("uid"=>$user_id,"idpolicy"=>$insuredOldData['idpolicy'],"action"=>$user_name." ".$filedDescription." ".$fieldValue)); 
            }
        }
       } 
     }
   }
}

?>