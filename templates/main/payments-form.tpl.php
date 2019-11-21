<?php 
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole,$paymentsList;$datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$paymenType = [ 'Payment' => "Payment",'Discount' => "Discount",'Inclusion' => "Inclusion"];
$action = [ 'Pending' => "Pending",'Recieved' => "Recieved",'Void' => "Void"];

$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");
//print_r($policyInfo);
//error_reporting(E_ALL);
$agentLists = getAgentLists('health',1);
//print_r($agentLists);

$policyCycle = getPayCycleLists();
//print_r($policyCycle);
foreach($policyCycle as $keyCycle => $valCycle){
  if($keyCycle == $policyInfo['idpaycycle'])
    $policyType = $valCycle;
}

$policyStatus = getPolicyStatus();
//print_r($policyCycle);
foreach($policyStatus as $keyStatus => $valStatus){
  if($keyStatus == $policyInfo['idstatus'])
    $pStatus = $valStatus;
}

$policyCountry = getCountryLists();
//print_r($policyCycle);
foreach($policyCountry as $keyCountry => $valCountry){
  if($keyCountry == $policyInfo['idcountry'])
    $insuredCountry = $valCountry;
}

$user_id = state('user_id');
$user_name = state("user_name");

$policy_id_p= $policyInfo['id'];
$sql="SELECT * FROM notes WHERE policy_id='$policy_id_p'";
$noteData = $db->select_single($sql);

$singleReceiptInfo=getsingleInfoReceiptLists($policy_id_p);

?>
<style type="text/css" media="screen">
    .header-payment {
       padding: 8px 25px;
       width: 100%;
  }
  .content-payment {
     padding: 16px;
  }
  .sectionPanel_Right .content_section .sticky {
      position: fixed;
      top: 0;
      right: 0;
      left: 0;
      z-index: 100;
      width: 81%;
      background: #ebf3f6;
      margin-left: 321px;
      margin-top: 73px;
      box-shadow: 0 -7px 28px rgba(0, 0, 0, 0.2);
      border-radius: 8px;
      float: left;
  }
  .sectionPanel_Right .content_section .sticky + .content-payment {
      padding-top: 102px;
  }
</style>

<div class="sectionPanel_Right">
  <div class="content_section">
    <div class="header-payment" id="myHeader">
        <div class="page-breadcrumbs">
      <ul>
        <li><a href="#"><i class="fas fa-home"></i></a></li>
        <li><a href="#">Dashboard</a></li>
        <li>Open Payment Form</li>
      </ul>
    </div><!-- page-breadcrumbs END -->

    <div class="titlebar_perent">            
      <div class="btn btn-primary agentnot_butt"><a target="_blank" href="<?php echo THE_URL."main/agent-notes/".$policyInfo['id']; ?>">Agent Notes</a></div>
      <div class="title_bar">
       <div class="btn btn-success"><a target="_blank" style="color: white" href="<?php echo THE_URL."main/receipts/"?>"><i class="fas fa-print"></i> &nbsp;Receipts</a></div>
       <div class="btn btn-info"><a target="_blank" style="color: white" href="<?php echo THE_URL."main/file-upload/".$policyInfo['id']; ?>"><i class="fas fa-upload"></i> &nbsp;System</a></div> 

       <div class="btn btn-primary bgwhite"><a href="javascript:void(0);" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</a></div>
       <button class="btn btn-primary bgorange" type="button" onclick="payment_form_submit()">Save</button>
     </div>
   </div>
   </div>
   <div class="content-payment">
       
   
   <div class="clearfix"></div>

   <form method="post" action="" id="frm_payments" onsubmit="return payment_form_submit()" enctype="multipart/form-data">

    <div class="content_section_aside">
      <div class="row">
        <div class="col-md-8">
          <div class="paymode_status">
            <ul>
              <li><span>Policy Number</span><p><?php echo $policyInfo['policynumber'];?></p></li>
              <li><span>Effective date</span><p><?php echo dateFormFormat($policyInfo['effectivedate']); ?></p></li>
              <li><span>Pay mode</span><p><?php echo $policyType;?></p></li>
            </ul>
          </div>
        </div>
        <div class="col-md-2">
          <div class="contryin">
            <div class="row">
              <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Status</label></div>
              <div class="col-md-12 col-lg-7">
                <select class="form-control" name="policy_status" id="policy_status">
                  <option value="0"></option>
                  <?php $statusList = getPolicyStatus(); if($statusList){foreach($statusList as $st_key => $st_vl){ $selected_text = ($policyInfo['idstatus'] == $st_key) ? 'selected="selected"': '';   echo '<option value="'.$st_key.'" '.$selected_text.'>'.$st_vl.'</option>';}} ?> 
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="contryin">
            <div class="row">
              <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Country</label></div>
              <div class="col-md-12 col-lg-7">
                <input type="text" class="form-control" value="<?php echo $insuredCountry;?>" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- content_section_aside END -->

    <div class="clearfix"></div>
    <div class="row">  
      <div class="col-md-12">            
        <div class="content_section_aside">                  
          <h4 class="content_section_aside_header">Agents</h4>                  
          <div class="paymentform_agentfirst">
            <div class="row">
              <div class="col-md-12">
                <div class="parentof_tabl">
                  <div class="tabl">
                    <div class="tabl_row">
                      <div class="tabl_th"></div>
                      <div class="tabl_th"></div>
                      <div class="tabl_th"></div>
                      <div class="tabl_th"></div>
                      <div class="tabl_th">
                        <div class="agentlock_commiss">
                          <div class="checkbxs">
                            <input type="checkbox" class="checkuncheckpayment" name="approved" id="paymentFormCommissionCheck">
                            <label for="paymentFormCommissionCheck"><!-- Lock Commission for this policy --></label>
                          </div>
                        </div>
                        <div class="postionchecl_label">Lock Commission for this policy</div>
                      </div>
                      <div class="tabl_th">Sys NB</div>
                      <div class="tabl_th">NB</div>
                      <div class="tabl_th">Sys RN</div>
                      <div class="tabl_th">RN</div>
                      <div class="tabl_th">PayBy</div>
                      <div class="tabl_th"></div>
                    </div>
                   
                    <div class="tabl_row" id="agent_frm1">
                      <div class="tabl_cell"> Agent Level 1 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level1" id="agent_level1" data-id="1">
                            <option value="0"></option>
                            <?php 
                                $hideshow='';
                               $checkAgentDataFromAC=getAgentData($policyInfo['id'],1);
                               
                               if ($checkAgentDataFromAC) {
                                    $agents=$checkAgentDataFromAC;
                               }else{
                                    $agents = getAgentLists("health",1); 
                                }

                             if($agents){
                                foreach($agents as $al_key => $al_vl){ 

                                 $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': ''; 

                                 echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.specialchar($al_vl['name']).'</option>';

                                 if($policyInfo['idagent'] == $al_vl['id']){

                                    $selected_val = ($policyInfo['idagent'] == $al_vl['id']) ? $al_vl['id']: '';
                                    $al_vl = getSingleAgentCommission($selected_val,1,$policy_id_p);
                                    $fName = $al_vl['name'];
                                    $lName = $al_vl['lastname'];
                                    
                                    $nb = $al_vl['nb'];
                                    
                                    $rn = $al_vl['rn'];
                                    $pay_by = $al_vl['pay_by'];
                                    $notes = $al_vl['notes'];
                                    $hideshow='';

                               }else{
                                  $hideshow='hiddenbtn';
                               }
                            }
                         }else{
                          $hideshow='hiddenbtn';
                       }
                        
                        ?>                            
                      </select>
                    </span>
                  </div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_f_name" name="agent_level1_f_name"  class="form-control" value="<?php echo isset($fName)?specialchar($fName):'';?>" /> </div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_l_name" name="agent_level1_l_name" class="form-control" value="<?php echo specialchar($lName);?>" /> </div>                                
                  <div class="tabl_cell"> <input type="text" id="agent_level1_commission" name="agent_level1_commission" class="form-control widthsm" value="<?php echo $commission;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_sys_nb" name="agent_level1_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_nb" name="agent_level1_nb" onkeyup="newbalance(1)" class="form-control widthsm" value="<?php echo $nb;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_sys_rn" name="agent_level1_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_rn" name="agent_level1_rn" onkeyup="renewal(1)" class="form-control widthsm" value="<?php echo $rn;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_pay_by" name="agent_level1_pay_by" class="form-control widthsm" value="<?php echo $pay_by;?>" /></div>
                  <div class="tabl_cell">
                    <button id="agent_level1_active" data-id="1" class="submit_btn_agent btn btn-primary blacklab <?=$hideshow?> ">AC L1</button>
                  </div>
                </div>
                <div class="tabl_row" id="agent_frm2">
                  <div class="tabl_cell"> Agent Level 2 </div>
                  <div class="tabl_cell">                      
                    <span class="form-select">
                      <select class="form-control payment_policy_agents" name="agent_level2" id="agent_level2" data-id="2">
                        <option value="0"></option>
                        <?php 
                        
                            $checkAgentDataFromAC2=getAgentData($policy_id_p,2);

                            if ($checkAgentDataFromAC2) {
                                   $agentLists2=$checkAgentDataFromAC2;
                               }else{
                                $agentLists2 = getAgentLists("health",2); 
                            } 
                            if($agentLists2){
                                foreach($agentLists2 as $al_key => $al_vl){ 
                                  $selected_text = ($policyInfo['idagent2'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.specialchar($al_vl['name']).'</option>';

                                  if($policyInfo['idagent2'] == $al_vl['id']){
                                    $selected_val = ($policyInfo['idagent2'] == $al_vl['id']) ? $al_vl['id']: '';
                                    $al_vl = getSingleAgentCommission($selected_val,2,$policy_id_p);

                                    $fName2 = $al_vl['name'];
                                    $lName2 = $al_vl['lastname'];
                                    
                                   
                                    $nb2 = $al_vl['nb'];
                                  
                                    $rn2 = $al_vl['rn'];
                                    $pay_by2 = $al_vl['pay_by'];
                                    $notes2 = $al_vl['notes'];
                                    $hideshow='';

                                }else{
                                    $hideshow='hiddenbtn';
                                }
                            }
                        }else{
                            $hideshow='hiddenbtn';
                        }
                    
                    ?>
                  </select>
                </span>
              </div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_f_name" name="agent_level2_f_name"  class="form-control" value="<?php echo specialchar($fName2);?>" /> </div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_l_name" name="agent_level2_l_name" class="form-control" value="<?php echo specialchar($lName2);?>" /> </div>                                
              <div class="tabl_cell"> <input type="text" id="agent_level2_commission" name="agent_level2_commission" class="form-control widthsm" value="<?php echo $commission2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_sys_nb" name="agent_level2_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_nb" name="agent_level2_nb" onkeyup="newbalance(2)" class="form-control widthsm" value="<?php echo $nb2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_sys_rn" name="agent_level2_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_rn" name="agent_level2_rn" onkeyup="renewal(2)"  class="form-control widthsm" value="<?php echo $rn2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_pay_by" name="agent_level2_pay_by" class="form-control widthsm" value="<?php echo $pay_by2;?>" /></div>
              <div class="tabl_cell">
                <button id="agent_level2_active" data-id="2" class="submit_btn_agent btn btn-primary blacklab <?=$hideshow?> ">AC L2</button>
              </div>
            </div>
            <div class="tabl_row" id="agent_frm3">
              <div class="tabl_cell"> Agent Level 3 </div>
              <div class="tabl_cell">                      
                <span class="form-select">
                  <select class="form-control payment_policy_agents" name="agent_level3" id="agent_level3" data-id="3">
                    <option value="0"></option>
                    <?php 
                   
                        $checkAgentDataFromAC3=getAgentData($policy_id_p,3);
                       
                        if ($checkAgentDataFromAC3) {
                               $agentLists3=$checkAgentDataFromAC3;
                           }else{
                            $agentLists3 = getAgentLists("health",3); 
                        } 
                       
                        if($agentLists3){
                            foreach($agentLists3 as $al_key => $al_vl){ 
                              $selected_text = ($policyInfo['idagent3'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.specialchar($al_vl['name']).'</option>';
                              if($policyInfo['idagent3'] == $al_vl['id']){
                                $selected_val = ($policyInfo['idagent3'] == $al_vl['id']) ? $al_vl['id']: '';
                              $al_vl = getSingleAgentCommission($selected_val,3,$policy_id_p);
                                $fName3 = $al_vl['name'];
                                $lName3 = $al_vl['lastname'];
                                
                                $nb3 = $al_vl['nb'];
                                
                                $rn3 = $al_vl['rn'];
                                $pay_by3 = $al_vl['pay_by'];
                                $notes3 = $al_vl['notes'];
                                $hideshow='';
                            }else{
                                $hideshow='hiddenbtn';
                            }
                        }
                    }else{
                        $hideshow='hiddenbtn';
                    }
                
                ?>
              </select>
            </span>
          </div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_f_name" name="agent_level3_f_name"  class="form-control" value="<?php echo isset($fName3)?specialchar($fName3):'';?>" /> </div>
              <div class="tabl_cell"> <input type="text" id="agent_level3_l_name" name="agent_level3_l_name" class="form-control" value="<?php echo specialchar($lName3);?>" /> </div>                                 
          <div class="tabl_cell"> <input type="text" id="agent_level3_commission" name="agent_level3_commission" class="form-control widthsm" value="<?php echo $commission3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_sys_nb" name="agent_level3_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_nb" name="agent_level3_nb" onkeyup="newbalance(3)" class="form-control widthsm" value="<?php echo $nb3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_sys_rn" name="agent_level3_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_rn" name="agent_level3_rn" onkeyup="renewal(3)" class="form-control widthsm" value="<?php echo $rn3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_pay_by" name="agent_level3_pay_by" class="form-control widthsm" value="<?php echo $pay_by3;?>" /></div>
          <div class="tabl_cell">
            <button id="agent_level3_active" data-id="3" class="submit_btn_agent btn btn-primary blacklab <?=$hideshow?> ">AC L3</button>
          </div>
        </div>
        <div class="tabl_row" id="agent_frm4">
          <div class="tabl_cell"> Agent Level 4 </div>
          <div class="tabl_cell">                      
            <span class="form-select">
              <select class="form-control payment_policy_agents" name="agent_level4" id="agent_level4" data-id="4">
                <option value="0"></option>
                <?php 
                
                    $checkAgentDataFromAC4=getAgentData($policy_id_p,4);

                    if ($checkAgentDataFromAC4) {
                           $agentLists4=$checkAgentDataFromAC4;
                       }else{
                        $agentLists4 = getAgentLists("health",4); 
                    }   
                    if($agentLists4){
                        foreach($agentLists4 as $al_key => $al_vl){ 
                          $selected_text = ($policyInfo['idagent4'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.specialchar($al_vl['name']).'</option>';
                          if($policyInfo['idagent4'] == $al_vl['id']){
                            $selected_val = ($policyInfo['idagent4'] == $al_vl['id']) ? $al_vl['id']: '';
                              $al_vl = getSingleAgentCommission($selected_val,4,$policy_id_p);
                            $fName4 = $al_vl['name'];
                            $lName4 = $al_vl['lastname'];
                            
                            $nb4 = $al_vl['nb'];
                           
                            $rn4 = $al_vl['rn'];
                            $pay_by4 = $al_vl['pay_by'];
                            $notes4 = $al_vl['notes'];
                            $hideshow='';
                        }else{
                            $hideshow='hiddenbtn';
                        }
                    }
                }else{
                    $hideshow='hiddenbtn';
                }
            
            ?>
          </select>
        </span>
      </div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_f_name" name="agent_level4_f_name"  class="form-control" value="<?php echo specialchar($fName4);?>" /> </div>
              <div class="tabl_cell"> <input type="text" id="agent_level4_l_name" name="agent_level4_l_name" class="form-control" value="<?php echo specialchar($lName4);?>" /> </div>                                  
      <div class="tabl_cell"> <input type="text" id="agent_level4_commission" name="agent_level4_commission" class="form-control widthsm" value="<?php echo $commission4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_sys_nb" name="agent_level4_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_nb" name="agent_level4_nb" onkeyup="newbalance(4)" class="form-control widthsm" value="<?php echo $nb4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_sys_rn" name="agent_level4_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_rn" name="agent_level4_rn" onkeyup="renewal(4)" class="form-control widthsm" value="<?php echo $rn4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_pay_by" name="agent_level4_pay_by" class="form-control widthsm" value="<?php echo $pay_by4;?>" /></div>
      <div class="tabl_cell">
        <button id="agent_level4_active" data-id="4" class="submit_btn_agent btn btn-primary blacklab <?=$hideshow?> ">AC L4</button>
      </div>
    </div>

    <div class="tabl_row" id="agent_frm5">
      <div class="tabl_cell"> Agent Level 5 </div>
      <div class="tabl_cell">                      
        <span class="form-select">
          <select class="form-control payment_policy_agents" name="agent_level5" id="agent_level5" data-id="5" >
            <option value="0"></option>
            <?php 
            
                $checkAgentDataFromAC5=getAgentData($policy_id_p,5);

                    if ($checkAgentDataFromAC5) {
                        $agentLists5=$checkAgentDataFromAC5;
                    }else{
                        $agentLists5 = getAgentLists("health",5); 
                    }  
                    if($agentLists5){
                        foreach($agentLists5 as $al_key => $al_vl){ 
                          $selected_text = ($policyInfo['idagent5'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.specialchar($al_vl['name']).'</option>';
                          if($policyInfo['idagent5'] == $al_vl['id']){
                            $selected_val = ($policyInfo['idagent5'] == $al_vl['id']) ? $al_vl['id']: '';
                              $al_vl = getSingleAgentCommission($selected_val,5,$policy_id_p);
                            $fName5 = $al_vl['name'];
                            $lName5 = $al_vl['lastname'];
                            
                            $nb5 = $al_vl['nb'];
                            
                            $rn5 = $al_vl['rn'];
                            $pay_by5 = $al_vl['pay_by'];
                            $notes5 = $al_vl['notes'];
                            $hideshow='';
                        }else{
                            $hideshow='hiddenbtn';
                        }
                    }
                }else{
                    $hideshow='hiddenbtn';
                }
        
        ?>
      </select>
    </span>
  </div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_f_name" name="agent_level5_f_name"  class="form-control" value="<?php echo specialchar($fName5);?>" /> </div>
<div class="tabl_cell"> <input type="text" id="agent_level5_l_name" name="agent_level5_l_name" class="form-control" value="<?php echo specialchar($lName5);?>" /> </div>                                 
  <div class="tabl_cell"> <input type="text" id="agent_level5_commission" name="agent_level5_commission" class="form-control widthsm" value="<?php echo $commission5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_sys_nb" name="agent_level5_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_nb" name="agent_level5_nb" onkeyup="newbalance(5)" class="form-control widthsm" value="<?php echo $nb5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_sys_rn" name="agent_level5_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_rn" name="agent_level5_rn" onkeyup="renewal(5)" class="form-control widthsm" value="<?php echo $rn5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_pay_by" name="agent_level5_pay_by" class="form-control widthsm" value="<?php echo $pay_by5;?>" /></div>
  <div class="tabl_cell">
    <button id="agent_level5active" data-id="5" class="submit_btn_agent btn btn-primary blacklab <?=$hideshow?>">AC L5</button>
  </div>
</div>

</div>
</div>
</div>
</div>
</div>
</div><!-- content_section_aside END -->
</div>
</div>

<div class="clearfix"></div>
<div class="row">
  <div class="col-md-7">
    <div class="content_section_aside">
      <h4 class="content_section_aside_header">Fronting and Overrides</h4>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Fronting</label></div>
          <div class="col-md-12 col-lg-9">
            <div class="row rowsm">
              <div class="col-md-6">
                <span class="form-select">
                  <select class="form-control">
                    <option>&nbsp;</option>
                  </select>
                </span>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" value="0">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Override</label></div>
          <div class="col-md-12 col-lg-9">
            <div class="row rowsm">
              <div class="col-md-6">
                <span class="form-select">
                  <select class="form-control">
                    <option>&nbsp;</option>
                  </select>
                </span>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" value="0">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- content_section_aside END -->
    <div class="content_section_aside" id="agent_note_inner_form">
      <div class="row">
        <div class="col-md-7">
          <h4 class="content_section_aside_header">Agent Notes</h4>
        </div>
        
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L1</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control from_agent_note" id="agent_level1_notes" name="agent_level1_notes" value="<?=$notes?>" data-id="1">
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L2</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control from_agent_note" id="agent_level2_notes" name="agent_level2_notes"  value="<?=$notes2?>" data-id="2">
          </div>
        </div>
      </div>  

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L3</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" data-id="3" class="form-control from_agent_note" id="agent_level3_notes" name="agent_level3_notes"  value="<?=$notes3?>">
          </div>
        </div>
      </div> 

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L4</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" data-id="4" class="form-control from_agent_note"  id="agent_level4_notes" name="agent_level4_notes" value="<?=$notes4?>">
          </div>
        </div>
      </div> 

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L5</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" data-id="5" class="form-control from_agent_note" id="agent_level5_notes" name="agent_level5_notes" value="<?=$notes5?>">
          </div>
        </div>
      </div> 

    </div><!-- content_section_aside END -->

  </div>
  <div class="col-md-5">
    <div class="content_section_aside">
      <h4 class="content_section_aside_header">Agent Notes for each Policy</h4> 

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Note</label></div>
          <div class="col-md-12 col-lg-9">
            <input type="hidden" name="notesids" class="notesids" id="notesids" value="NEW">
            <textarea id="notes" class="form-control form-textarea" name="notes"></textarea>
          </div>
        </div>
      </div> 
    </div><!-- content_section_aside END -->
    <div class="content_section_aside">
      <h4 class="content_section_aside_header">Info. Receipt</h4>
      
      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Pay</label></div>
          <div class="col-md-12 col-lg-9">
            <input id="receipt_pay" type="text" required="required" class="form-control" name="receipt_pay" value="<?php echo isset($singleReceiptInfo['receipt_pay'])? trim($singleReceiptInfo['receipt_pay']) :'' ?>">
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Type</label></div>
          <div class="col-md-12 col-lg-9">
            <input id="receipt_type" type="text" required="required" class="form-control" name="receipt_type"  value="<?php echo isset($singleReceiptInfo['receipt_type'])? trim($singleReceiptInfo['receipt_type']) :'' ?>">
          </div>
        </div>
      </div>  

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Note</label></div>
          <div class="col-md-12 col-lg-9">
            <textarea id="receipt_note" required="required" class="form-control form-textarea" name="receipt_note"> <?php echo isset($singleReceiptInfo['receipt_note'])? trim($singleReceiptInfo['receipt_note']) :'' ?></textarea>
          </div>
        </div>
      </div> 
    </div><!-- content_section_aside END -->
  </div>

</div>

<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12"> 
    <div class="content_section_aside" id="content_section_payments">
      <div class="table_overlay">
        <table class="tableContent tableHover" >
          <tr>
            <th class="fltersearch"><span>Type</span></th>
            <th class="fltersearch"><span>Pay Mod</span></th>
            <th class="fltersearch"><span>Date Paid</span></th>
            <th class="fltersearch"><span>Date Due</span></th>
            <th class="fltersearch"><span>Amount</span></th>
            <th class="fltersearch"><span>Policy Fee</span></th>
            <th class="fltersearch"><span>Agent L1</span><p class="disctitle">Discount</p></th>
            <th class="fltersearch"><span>Agent L2</span><p class="disctitle">Discount</p></th>
            <th class="fltersearch"><span>Agent L3</span><p class="disctitle">Discount</p></th>
            <th class="fltersearch"><span>Agent L4</span><p class="disctitle">Discount</p></th>
            <th class="fltersearch"><span>Agent L5</span><p class="disctitle">Discount</p></th>
            <th class="fltersearch"><span>Pay Form</span></th>
            <th class="fltersearch"><span>User</span></th>
            <th class="fltersearch"><span>Locked</span></th>
            <th class="fltersearch"><span>Action</span></th>
            <th class="fltersearch"><span>Details</span></th>
            <th class="fltersearch"><span>Print Auth</span></th>
            <th class="fltersearch"><span>Receipt</span></th>
            <th class="fltersearch"><span>Paid</span></th>
          </tr>



          <?php
          $perPage = 10;
          $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
          $startAt = $perPage * ($page - 1);

          $query = "SELECT COUNT(*) as total FROM payments
          WHERE id_policy = '".$policyInfo['id']."'";
          $paymentdata = $db->select($query);
          foreach($paymentdata as $r_v){
            $total_r = $r_v['total'];
        }
        $totalPages = ceil($total_r / $perPage);
        $links = "";
        for ($i = 1; $i <= $totalPages; $i++) {
          $links .= ($i != $page ) 
          ? "<li class='pagess'><a href='?page=".$i."'>".$i."</a></li> "
          : "$page";
        }
      $query1 = "SELECT * FROM payments
      WHERE id_policy = '".$policyInfo['id']."' 
      ORDER BY 'timestamp' LIMIT $startAt, $perPage";

      $paymentdata = $db->select($query1);

      if(count($paymentdata)>0){
        $ins_loop=0;
          foreach($paymentdata as $payments_key => $payments_value)
          {
                ?>

                
                <tr class="row_payment" id="row_payment<?php echo $ins_loop; ?>" data-id="<?php echo $ins_loop; ?>" >
                  <td>
                    <span class="form-select tableselect_height">
                      <select id="paymentType" class="form-control  minselect-width" name="paymenType">
                        <option>&nbsp;</option>

                        <?php 



                        if($paymenType)
                          {foreach($paymenType as $pt_key => $pt_value)
                            {
                              $selected_text = ($payments_value['type'] == $pt_key) ? 'selected="selected"': ''; 

                              echo '<option value="'.$pt_key.'" '.$selected_text.' >'.$pt_value.'</option>';
                            }
                          } 
                          ?>
                        </select>
                      </span>
                    </td>
                    <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policy_id_p; ?>">
                    <input type="hidden" name="payments_id" id="payments_id" value="<?php echo $payments_value['id']; ?>">
                    <td>
                      <span class="form-select tableselect_height">
                        <select id="id_pay_cycle" class="form-control  minselect-width" name="id_pay_cycle">
                          <option>&nbsp;</option>
                          <?php $payCycles = getPayCycleLists(); 
                          if($payCycles)
                            {foreach($payCycles as $pc_key => $pc_value)
                              {
                                $selected_text = ($payments_value['id_pay_cycle'] == $pc_key) ? 'selected="selected"': ''; 

                                echo '<option value="'.$pc_key.'" '.$selected_text.' >'.$pc_value.'</option>';
                              }
                            } 
                            ?>
                          </select>

                        </span>
                      </td>
                      <td><input type="text" name="paymentpaid" class="input-no-border useDatePicker datepicker-dob" value="<?= isset($payments_value['date_paid'])?date("m/d/Y",strtotime($payments_value['date_paid'])):'' ?>" size="7"/></td>
                      <td><input type="text" name="paymentduedate" class="input-no-border useDatePicker datepicker-dob" value="<?= isset($payments_value['date_due'])? date("m/d/Y",strtotime($payments_value['date_due'])):''?>" size="7"/></td>
                      <td>$<input type="text" name="paymentamount" class="input-no-border" size="6" value="<?=$payments_value['amount'] ?>"  /></td>
                      <td>$<input type="text" name="paymentpolicyfee" class="input-no-border" size="6" value="<?=$payments_value['fee'] ?>"/></td>
                      <td>$<input type="text" name="discount_agent_1" class="input-no-border" size="6" value="<?=$payments_value['agent_1_discount'] ?>"/></td>
                      <td>$<input type="text" name="discount_agent_2" class="input-no-border" size="6" value="<?=$payments_value['agent_2_discount'] ?>"/></td>
                      <td>$<input type="text" name="discount_agent_3" class="input-no-border" size="6" value="<?=$payments_value['agent_3_discount'] ?>"/></td>
                      <td>$<input type="text" name="discount_agent_4" class="input-no-border" size="6" value="<?=$payments_value['agent_4_discount'] ?>"/></td>
                      <td>$<input type="text" name="discount_agent_5" class="input-no-border" size="6" value="<?=$payments_value['agent_5_discount'] ?>"/></td>
                      <td>
                        <span class="form-select tableselect_height">
                          <select id="paymentMethod" class="form-control  minselect-width" name="paymentMethod">
                            <option>&nbsp;</option>
                            <?php $paytype = getPayTypeLists(); 
                            if($paytype)
                              {foreach($paytype as $pt_key => $pt_value)
                                {
                                  $selected_text = ($payments_value['id_pay_type'] == $pt_key) ? 'selected="selected"': ''; 

                                  echo '<option value="'.$pt_key.'" '.$selected_text.'>'.$pt_value.'</option>';
                                }
                              } 
                              ?>
                            </select>
                          </span>
                        </td>
                        <td><input type="text" name="payment_user_id" readonly class="input-no-border" size="6" value="<?php echo getSingleAdmin($payments_value['id_user']);?>"/></td>
                        <td>
                          <div class="checkbxs">
                            <input type="checkbox" name="locked" id="lockedlabel<?php echo $payments_key;  ?>" value="<?= isset($payments_value)? $payments_value['locked']:1 ?>" <?php if($payments_value['locked']){echo 'checked="checked"';} ?> />
                            <label for="lockedlabel<?php echo $payments_key;  ?>"></label>
                          </div>
                        </td>
                        <td>
                          <span class="form-select tableselect_height">
                            <select id="paymentAction" class="form-control  minselect-width" name="paymentAction">
                              <option>&nbsp;</option>




                              <?php 



                              if($action)
                                {foreach($action as $pt_key => $pt_value)
                                  {
                                    $selected_text = ($payments_value['action'] == $pt_key) ? 'selected="selected"': ''; 

                                    echo '<option value="'.$pt_key.'" '.$selected_text.' >'.$pt_value.'</option>';
                                  }
                                } 
                                ?>
                              </select>
                            </span>
                          </td>
                          <td><input type="text" name="paymentdetails" class="input-no-border" size="6" value="<?= isset($payments_value)? $payments_value['details']:'' ?>"/></td>
                          <td><a href="<?php echo THE_URL."main/payment-approval-notice/".$payments_value['id']; ?>" target="_blank" class="detailsLink">Print Auth</a></td>
                          <td><a href="<?php echo THE_URL."main/payment-receipt/".$payments_value['id']; ?>" target="_blank" class="detailsLink">Receipt</a></td>
                          <td>
                            <div class="checkbxs">
                              <input type="checkbox" <?php if($payments_value['paid']){echo 'checked="checked"';} ?> name="paidcheck" id="paidlabel<?php echo $payments_key;  ?>" value="<?= isset($payments_value)? $payments_value['paid']:1 ?>">
                              <label for="paidlabel<?php echo $payments_key;  ?>"></label>
                            </div>
                          </td>
                        </tr>


                        <?php 
                        $ins_loop++;
              } //end foreach
            }

            ?>

            <tr class="row_payment" id="row_payment" data-id="">
              <td>
                <span class="form-select tableselect_height">
                  <select id="paymentType" class="form-control  minselect-width" name="paymenType" >
                    <option>&nbsp;</option>

                    <?php 


                    if($paymenType)
                      {foreach($paymenType as $pt_key => $pt_value)
                        {
                                //$selected_text = ($payments_value['type'] == $pt_key) ? 'selected="selected"': ''; 

                          echo '<option value="'.$pt_key.'">'.$pt_value.'</option>';
                        }
                      } 
                      ?>
                    </select>
                  </span>
                </td>
                <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policy_id_p; ?>">
                <input type="hidden" name="payments_id" id="payments_id" value="">
                <td>
                  <span class="form-select tableselect_height">
                    <select id="id_pay_cycle" class="form-control  minselect-width" name="id_pay_cycle" >
                      <option>&nbsp;</option>
                      <?php $payCycles = getPayCycleLists(); 
                      if($payCycles)
                        {foreach($payCycles as $pc_key => $pc_value)
                          {
                                //$selected_text = ($payments_value['id_pay_cycle'] == $pc_key) ? 'selected="selected"': ''; 

                            echo '<option value="'.$pc_key.'">'.$pc_value.'</option>';
                          }
                        } 
                        ?>
                      </select>

                    </span>
                  </td>
                  <td><input type="text" id="paymentpaid" required name="paymentpaid" class="input-no-border useDatePicker datepicker-dob" value="" size="7" /></td>
                  <td><input type="text" name="paymentduedate" class="input-no-border useDatePicker datepicker-dob" value="" size="7"/></td>
                  <td>$<input type="text" name="paymentamount" class="input-no-border" size="6" value="" /></td>
                  <td>$<input type="text" name="paymentpolicyfee" class="input-no-border" size="6" value=""/></td>
                  <td>$<input type="text" name="discount_agent_1" class="input-no-border" size="6" value=""/></td>
                  <td>$<input type="text" name="discount_agent_2" class="input-no-border" size="6" value=""/></td>
                  <td>$<input type="text" name="discount_agent_3" class="input-no-border" size="6" value=""/></td>
                  <td>$<input type="text" name="discount_agent_4" class="input-no-border" size="6" value=""/></td>
                  <td>$<input type="text" name="discount_agent_5" class="input-no-border" size="6" value=""/></td>
                  <td>
                    <span class="form-select tableselect_height">
                      <select id="paymentMethod" class="form-control  minselect-width" name="paymentMethod">
                        <option>&nbsp;</option>
                        <?php $paytype = getPayTypeLists(); 
                        if($paytype)
                          {foreach($paytype as $pt_key => $pt_value)
                            {
                                //$selected_text = ($payments_value['id_pay_type'] == $pt_key) ? 'selected="selected"': ''; 
                              echo '<option value="'.$pt_key.'">'.$pt_value.'</option>';
                            }
                          } 
                          ?>
                        </select>
                      </span>
                    </td>
                    <td><input type="text" readonly class="input-no-border" size="6" value="<?=$user_name?>"/>
                      <input type="hidden" name="payment_user_id" class="input-no-border" size="6" value="<?=$user_id;?>"/></td>
                    <td>
                      <div class="checkbxs">

                        <input type="checkbox" name="locked" id="lockedlabe" />
                        <label for="lockedlabe"></label>
                      </div>
                    </td>
                    <td>
                      <span class="form-select tableselect_height">
                        <select id="paymentAction" class="form-control  minselect-width" name="paymentAction">
                          <option>&nbsp;</option>
                          <?php 
                          $action = [ 'Pending' => "Pending",'Recieved' => "Recieved",'Void' => "Void"];
                          if($action)
                            {foreach($action as $pt_key => $pt_value)
                              {
                                //$selected_text = ($payments_value['action'] == $pt_key) ? 'selected="selected"': ''; 

                                echo '<option value="'.$pt_key.'" >'.$pt_value.'</option>';
                              }
                            } 
                            ?>
                          </select>
                        </span>
                      </td>
                      <td><input type="text" name="paymentdetails" class="input-no-border" size="6" value=""/></td>
                      <td><a href="#" class="detailsLink">Print Auth</a></td>
                      <td><a href="#" class="detailsLink">Receipt</a></td>
                      <td>
                        <div class="checkbxs">

                          <input type="checkbox" name="paidcheck" id="paidlabe" />
                          <label for="paidlabe"></label>
                        </div>
                      </td>

                    </tr>


                  </table>
                </div><!-- table_overlay END -->
                <div class="clearfix"></div>
                <!-- filtersColumn END -->
                <div class="filtersColumn">

                    <div class="filtersColumn-left">
                     <div class="paginationcrum">
                        <ul>
                          <li class="first"><a href="?page=1"><i class="fas fa-backward"></i></a></li>
                          <li class="prev <?php if($page <= 1){ echo 'disabled'; } ?>"><a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>"><i class="fas fa-caret-left"></i></a></li>
                          <?php echo $links; ?>
                          <li class="next <?php if($page >= $totalPages){ echo 'disabled'; } ?>"><a href="<?php if($page >= $totalPages){ echo '#'; } else { echo "?page=".($page + 1); } ?>"><i class="fas fa-caret-right"></i></a></li>
                          <li class="last"><a href="?page=<?php echo $totalPages; ?>"><i class="fas fa-forward"></i></a></li>
                      </ul>
                  </div>
              </div>
                          
              </div><!-- content_section_aside END -->
            </div>
          </div>
</div>




          <div class="clearfix"></div><br>
          <div class="row">
            <div class="col-md-12"> 
              <div class="content_section_aside" >
                <div class="table_overlay">
                  <table class="tableContent tableHover">
                    <tr>
                      <th class="fltersearch"><span>First Name</span></th>
                      <th class="fltersearch"><span>Last Name</span></th>
                      <th class="fltersearch"><span>Relation</span></th>
                      <th class="fltersearch"><span>DOB</span></th>
                      <th class="fltersearch"><span>Age</span></th>
                      <th class="fltersearch"><span>Effective Date </span></th>
                      <th class="fltersearch"><span>90 Days waiver ex </span></th>
                      <th class="fltersearch"><span>Rate up Total</span></th>

                      <th class="fltersearch"><span>Rate amount D</span></th>
                      <th class="fltersearch"><span>Premium</span></th>
                      <th class="fltersearch"><span>Active</span></th>
                      <th class="fltersearch"><span>Inactive Date</span></th>
                    </tr>

                    <?php $insuredLists = getHealthInsuredLists($policyInfo['id']);if($insuredLists){ $ins_loop = 1; foreach($insuredLists as $singleInsured){ ?>
                      <tr>
                        <td><?php echo $singleInsured['first_name']; ?></td>
                        <td><?php echo $singleInsured['last_name']; ?></td>
                        <td><?php $realtions = getRelationLists();  if($realtions){foreach($realtions as $r_key => $r_value){if($singleInsured['idrelation'] == $r_key){echo $r_value;}}} ?></td>
                        <td><?php if($singleInsured['dob'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['dob']); ?></td>
                        <td><?php echo $singleInsured['age']; ?></td>
                        <td><?php if($singleInsured['effectivedate'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['effectivedate']); ?></td>
                        <td>
                          <div class="checkbxs">
                            <input type="checkbox" name="approved" id="constitucionLabel" <?php if($singleInsured['ninety_day_waiver']){echo 'checked="checked"';} ?> />
                            <label for="constitucionLabel"></label>
                          </div>
                        </td>
                        <td>0</td>
                        <td>$0.00</td>
                        <td>$<?php echo $singleInsured['premium']; ?></td>
                        <td>
                          <div class="checkbxs">
                            <input type="checkbox" name="approved" id="activelabel" <?php if($singleInsured['active']){echo 'checked="checked"';} ?> />
                            <label for="activelabel"></label>
                          </div>
                        </td>
                        <td><?php if($singleInsured['dateinactive'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['dateinactive']); ?></td>
                      </tr>
                      <?php $ins_loop++; } }else{ ?>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="checkbxs">
                              <input type="checkbox" name="approved" id="constitucionLabel">
                              <label for="constitucionLabel"></label>
                            </div>
                          </td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="checkbxs">
                              <input type="checkbox" name="approved" id="activelabel">
                              <label for="activelabel"></label>
                            </div>
                          </td>
                          <td></td>
                        </tr>
                      <?php } ?>

                    </table>
                  </div><!-- table_overlay END -->
                  <div class="clearfix"></div>
                    
                </div>
                </div><!-- content_section_aside END -->
              </div>
          




            <div class="clearfix"></div>
            <div class="row">  
              <div class="col-md-12">            
                <div class="content_section_aside">
                  <h4 class="content_section_aside_header">Activity</h4> 
                  <div class="activitylist">
                    <ul>
                      <li><span class="activitydesc">mc Changed Type in payment record to Payment on 9/18/2018 <span class="timelist"> 1:20:36 PM</span></span></li>
                      <li><span class="activitydesc">mc Changed Type in payment record to Payment on 9/18/2018 <span class="timelist"> 1:20:33 PM</span></span></li>
                      <li><span class="activitydesc">mc Changed Type in payment record to Payment on 9/18/2018 <span class="timelist"> 1:20:30 PM</span></span></li>
                    </ul>
                  </div>
                </div><!-- content_section_aside END -->
              </div>
            </div>

          </form>
          </div>
        </div>
      </div>

<script>
    
    
    function newbalance(dataid) {

            var parent= dataid-1;
           
            var sysnb=0;

            var nbchild= $('#agent_level'+dataid+'_nb').val();
            var nbparent= $('#agent_level'+parent+'_nb').val()
            var curr_agent_id = parseInt($('#agent_level'+dataid).children("option:selected").val());

            if(!isNaN(nbchild) && !isNaN(nbparent) && nbchild.length!=0 && nbparent.length!=0) {
               
               sysnb= parseFloat(nbparent)-parseFloat(nbchild);
            }

            $('#agent_level'+parent+'_sys_nb').val(sysnb.toFixed(2));
            $('#agent_level'+dataid+'_sys_nb').val(parseFloat(nbchild).toFixed(2));

            $('#agent_level'+parent+'_commission').val(sysnb.toFixed(2));
            $('#agent_level'+dataid+'_commission').val(parseFloat(nbchild).toFixed(2));
            //alert(sysnb);

            var next_level_id=dataid+1;
            var next_agent_id = parseInt($('#agent_level'+next_level_id).children("option:selected").val());
            
            if (!isNaN(next_agent_id) && next_agent_id!=0) {

                if (dataid<=3) {
                    var recall= dataid+1;
                    newbalance(recall);
                }
            }
    }



    function renewal(dataid) {

            var parent= dataid-1;
            var sysrn=0;

            var rnchild= $('#agent_level'+dataid+'_rn').val();
            var rnparent= $('#agent_level'+parent+'_rn').val()
            var curr_agent_id = parseInt($('#agent_level'+dataid).children("option:selected").val());

            //alert(curr_agent_id);

            if(!isNaN(rnchild) && !isNaN(rnparent) && rnchild.length!=0 && rnparent.length!=0) {
               
               sysrn= parseFloat(rnparent)-parseFloat(rnchild);

              
            }
            
            $('#agent_level'+parent+'_sys_rn').val(sysrn.toFixed(2));
            $('#agent_level'+dataid+'_sys_rn').val(parseFloat(rnchild).toFixed(2));
            //alert(sysnb);
            var next_level_id=dataid+1;
            var next_agent_id = parseInt($('#agent_level'+next_level_id).children("option:selected").val());
            
            if (!isNaN(next_agent_id) && next_agent_id!=0) {

                if (dataid<=3) {
                    var recall= dataid+1;
                    renewal(recall);
                }
            }

    }

   //call newbalance and renewal funtion when page load//
    window.onload = function() {[newbalance(1),renewal(1)]};

    //end 

   

    window.onscroll = function() {myFunction()};

    var header = document.getElementById("myHeader");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}
</script>