<?php 
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole,$paymentsList;$datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$paymenType = [ 'Payment' => "Payment",'Discount' => "Discount",'Inclusion' => "Inclusion"];
$action = [ 'Pending' => "Pending",'Recieved' => "Recieved",'Void' => "Void"];

$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");
//print_r($policyInfo);

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

?>
<div class="sectionPanel_Right">
  <div class="content_section">
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
                    <?php $policyAgents = loadHealthPolicyAgents($policyInfo['idagent']); //pre($policyAgents); ?>
                    <div class="tabl_row" id="agent_frm1">
                      <div class="tabl_cell"> Agent Level 1 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level1" id="agent_level1" data-id="1">
                            <option value="0"></option>
                            <?php 
                            $agentLvl1 = $policyAgents[2][0]['idagent'];
                            if($agentLvl1){

                              $checkAgentDataFromAC=getAgentData($policy_id_p,1);

                              if ($checkAgentDataFromAC) {
                               $agents=$checkAgentDataFromAC;
                             }else{
                              $agents = getAgentLists("health",1); 
                            }
                            if($agents){
                              foreach($agents as $al_key => $al_vl){
                                $selected_text = ( trim($policyAgents[2][0]['idagent']) == $al_vl['id']) ? 'selected="selected"': ''; echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                                if($policyAgents[2][0]['idagent'] == $al_vl['id']){
                                  $fName = $al_vl['name'];
                                  $lName = $al_vl['lastname'];
                                  $commission = $al_vl['commission'];
                                  $sys_nb = $al_vl['sys_nb'];
                                  $nb = $al_vl['nb'];
                                  $sys_rn = $al_vl['sys_rn'];
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


                          }else{
                            $checkAgentDataFromAC=getAgentData($policy_id_p,1);

                            if ($checkAgentDataFromAC) {
                             $agents=$checkAgentDataFromAC;
                           }else{
                            $agents = getAgentLists("health",1); 
                          }
                          if($agents){
                            foreach($agents as $al_key => $al_vl){ 
                              $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                              if($policyInfo['idagent'] == $al_vl['id']){
                                $fName = $al_vl['name'];
                                $lName = $al_vl['lastname'];
                                $commission = $al_vl['commission'];
                                $sys_nb = $al_vl['sys_nb'];
                                $nb = $al_vl['nb'];
                                $sys_rn = $al_vl['sys_rn'];
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
                        }
                        ?>                            
                      </select>
                    </span>
                  </div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_f_name" name="agent_level1_f_name"  class="form-control" value="<?php echo $fName;?>" /> </div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_l_name" name="agent_level1_l_name" class="form-control" value="<?php echo $lName;?>" /> </div>                                
                  <div class="tabl_cell"> <input type="text" id="agent_level1_commission" name="agent_level1_commission" class="form-control widthsm" value="<?php echo $commission;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_sys_nb" name="agent_level1_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_nb" name="agent_level1_nb" class="form-control widthsm" value="<?php echo $nb;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_sys_rn" name="agent_level1_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn;?>" /></div>
                  <div class="tabl_cell"> <input type="text" id="agent_level1_rn" name="agent_level1_rn" class="form-control widthsm" value="<?php echo $rn;?>" /></div>
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
                        $agentLvl2 = $policyAgents[3][0]['idagent'];
                        if($agentLvl2){
                          $checkAgentDataFromAC2=getAgentData($policy_id_p,2);

                          if ($checkAgentDataFromAC2) {
                           $agentLists2=$checkAgentDataFromAC2;
                         }else{
                          $agentLists2 = getAgentLists("health",2); 
                        }  
                        if($agentLists2){
                          foreach($agentLists2 as $al_key => $al_vl){
                            $selected_text = ( trim($policyAgents[3][0]['idagent']) == $al_vl['id']) ? 'selected="selected"': ''; echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                            if($policyAgents[3][0]['idagent'] == $al_vl['id']){
                              $fName2 = $al_vl['name'];
                              $lName2 = $al_vl['lastname'];
                              $commission2 = $al_vl['commission'];
                              $sys_nb2 = $al_vl['sys_nb'];
                              $nb2 = $al_vl['nb'];
                              $sys_rn2 = $al_vl['sys_rn'];
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
                      }else{
                        $checkAgentDataFromAC2=getAgentData($policy_id_p,2);

                        if ($checkAgentDataFromAC2) {
                         $agentLists2=$checkAgentDataFromAC2;
                       }else{
                        $agentLists2 = getAgentLists("health",2); 
                      } 
                      if($agentLists2){
                        foreach($agentLists2 as $al_key => $al_vl){ 
                          $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                          if($policyInfo['idagent'] == $al_vl['id']){
                            $fName2 = $al_vl['name'];
                            $lName2 = $al_vl['lastname'];
                            $commission2 = $al_vl['commission'];
                            $sys_nb2 = $al_vl['sys_nb'];
                            $nb2 = $al_vl['nb'];
                            $sys_rn2 = $al_vl['sys_rn'];
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
                    }
                    ?>
                  </select>
                </span>
              </div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_f_name" name="agent_level2_f_name"  class="form-control" value="<?php echo $fName2;?>" /> </div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_l_name" name="agent_level2_l_name" class="form-control" value="<?php echo $lName2;?>" /> </div>                                
              <div class="tabl_cell"> <input type="text" id="agent_level2_commission" name="agent_level2_commission" class="form-control widthsm" value="<?php echo $commission2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_sys_nb" name="agent_level2_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_nb" name="agent_level2_nb" class="form-control widthsm" value="<?php echo $nb2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_sys_rn" name="agent_level2_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn2;?>" /></div>
              <div class="tabl_cell"> <input type="text" id="agent_level2_rn" name="agent_level2_rn" class="form-control widthsm" value="<?php echo $rn2;?>" /></div>
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
                    $agentLvl3 = $policyAgents[4][0]['idagent'];
                    if($agentLvl3){
                      $checkAgentDataFromAC3=getAgentData($policy_id_p,3);

                      if (count($checkAgentDataFromAC3)>0) {
                       $agentLists3=$checkAgentDataFromAC3;
                     }else{
                      $agentLists3 = getAgentLists("health",3); 
                    }   
                    if($agentLists3){
                      foreach($agentLists3 as $al_key => $al_vl){
                        $selected_text = ( trim($policyAgents[4][0]['idagent']) == $al_vl['id']) ? 'selected="selected"': ''; echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                        if($policyAgents[4][0]['idagent'] == $al_vl['id']){
                          $fName3 = $al_vl['name'];
                          $lName3 = $al_vl['lastname'];
                          $commission3 = $al_vl['commission'];
                          $sys_nb3 = $al_vl['sys_nb'];
                          $nb3 = $al_vl['nb'];
                          $sys_rn3 = $al_vl['sys_rn'];
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
                  }else{
                    $checkAgentDataFromAC3=getAgentData($policy_id_p,3);

                    if (count($checkAgentDataFromAC3)>0) {
                     $agentLists3=$checkAgentDataFromAC3;
                   }else{
                    $agentLists3 = getAgentLists("health",3); 
                  }   
                  if($agentLists3){
                    foreach($agentLists3 as $al_key => $al_vl){ 
                      $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                      if($policyInfo['idagent'] == $al_vl['id']){
                        $fName3 = $al_vl['name'];
                        $lName3 = $al_vl['lastname'];
                        $commission3 = $al_vl['commission'];
                        $sys_nb3 = $al_vl['sys_nb'];
                        $nb3 = $al_vl['nb'];
                        $sys_rn3 = $al_vl['sys_rn'];
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
                }
                ?>
              </select>
            </span>
          </div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_f_name" name="agent_level3_f_name"  class="form-control" value="<?php echo $fName3;?>" /> </div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_l_name" name="agent_level3_l_name" class="form-control" value="<?php echo $lName3;?>" /> </div>                                
          <div class="tabl_cell"> <input type="text" id="agent_level3_commission" name="agent_level3_commission" class="form-control widthsm" value="<?php echo $commission3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_sys_nb" name="agent_level3_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_nb" name="agent_level3_nb" class="form-control widthsm" value="<?php echo $nb3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_sys_rn" name="agent_level3_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn3;?>" /></div>
          <div class="tabl_cell"> <input type="text" id="agent_level3_rn" name="agent_level3_rn" class="form-control widthsm" value="<?php echo $rn3;?>" /></div>
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
                $agentLvl4 = $policyAgents[5][0]['idagent'];
                if($agentLvl4){
                  $checkAgentDataFromAC4=getAgentData($policy_id_p,4);

                  if (count($checkAgentDataFromAC4)>0) {
                   $agentLists4=$checkAgentDataFromAC4;
                 }else{
                  $agentLists4 = getAgentLists("health",4); 
                }    
                if($agentLists4){
                  foreach($agentLists4 as $al_key => $al_vl){
                    $selected_text = ( trim($policyAgents[5][0]['idagent']) == $al_vl['id'] && trim($policyAgents[5][0]['level']) == $al_vl['level'] ) ? 'selected="selected"': ''; echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                    if($policyAgents[5][0]['idagent'] == $al_vl['id']){
                      $fName4 = $al_vl['name'];
                      $lName4 = $al_vl['lastname'];
                      $commission4 = $al_vl['commission'];
                      $sys_nb4 = $al_vl['sys_nb'];
                      $nb4 = $al_vl['nb'];
                      $sys_rn4 = $al_vl['sys_rn'];
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
              }else{
                $checkAgentDataFromAC4=getAgentData($policy_id_p,4);

                if (count($checkAgentDataFromAC4)>0) {
                 $agentLists4=$checkAgentDataFromAC4;
               }else{
                $agentLists4 = getAgentLists("health",4); 
              }   
              if($agentLists4){
                foreach($agentLists4 as $al_key => $al_vl){ 
                  $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                  if($policyInfo['idagent'] == $al_vl['id']){
                    $fName4 = $al_vl['name'];
                    $lName4 = $al_vl['lastname'];
                    $commission4 = $al_vl['commission'];
                    $sys_nb4 = $al_vl['sys_nb'];
                    $nb4 = $al_vl['nb'];
                    $sys_rn4 = $al_vl['sys_rn'];
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
            }
            ?>
          </select>
        </span>
      </div>
      <div class="tabl_cell"><input type="text" id="agent_level4_f_name" name="agent_level4_f_name"  class="form-control" value="<?php echo $fName4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_l_name" name="agent_level4_l_name" class="form-control" value="<?php echo $lName4;?>" /> </div>                                
      <div class="tabl_cell"> <input type="text" id="agent_level4_commission" name="agent_level4_commission" class="form-control widthsm" value="<?php echo $commission4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_sys_nb" name="agent_level4_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_nb" name="agent_level4_nb" class="form-control widthsm" value="<?php echo $nb4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_sys_rn" name="agent_level4_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn4;?>" /></div>
      <div class="tabl_cell"> <input type="text" id="agent_level4_rn" name="agent_level4_rn" class="form-control widthsm" value="<?php echo $rn4;?>" /></div>
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
            $agentLvl5 = $policyAgents[6][0]['idagent'];
            if($agentLvl5){
              $checkAgentDataFromAC5=getAgentData($policy_id_p,5);

              if (count($checkAgentDataFromAC5)>0) {
               $agentLists5=$checkAgentDataFromAC5;
             }else{
              $agentLists5 = getAgentLists("health",5); 
            }    
            if($agentLists5){
              foreach($agentLists5 as $al_key => $al_vl){
                $selected_text = ( trim($policyAgents[6][0]['idagent']) == $al_vl['id']) ? 'selected="selected"': ''; echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
                if($policyAgents[6][0]['idagent'] == $al_vl['id']){
                  $fName5 = $al_vl['name'];
                  $lName5 = $al_vl['lastname'];
                  $commission5 = $al_vl['commission'];
                  $sys_nb5 = $al_vl['sys_nb'];
                  $nb5 = $al_vl['nb'];
                  $sys_rn5 = $al_vl['sys_rn'];
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
          }else{
            $checkAgentDataFromAC5=getAgentData($policy_id_p,5);

            if (count($checkAgentDataFromAC5)>0) {
             $agentLists5=$checkAgentDataFromAC5;
           }else{
            $agentLists5 = getAgentLists("health",5); 
          }  
          if($agentLists5){
            foreach($agentLists5 as $al_key => $al_vl){ 
              $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
              if($policyInfo['idagent'] == $al_vl['id']){
                $fName5 = $al_vl['name'];
                $lName5 = $al_vl['lastname'];
                $commission5 = $al_vl['commission'];
                $sys_nb5 = $al_vl['sys_nb'];
                $nb5 = $al_vl['nb'];
                $sys_rn5 = $al_vl['sys_rn'];
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
        }
        ?>
      </select>
    </span>
  </div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_f_name" name="agent_level5_f_name"  class="form-control" value="<?php echo $fName5;?>" /> </div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_l_name" name="agent_level5_l_name" class="form-control" value="<?php echo $lName5;?>" /> </div>                                
  <div class="tabl_cell"> <input type="text" id="agent_level5_commission" name="agent_level5_commission" class="form-control widthsm" value="<?php echo $commission5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_sys_nb" name="agent_level5_sys_nb" class="form-control widthsm" value="<?php echo $sys_nb5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_nb" name="agent_level5_nb" class="form-control widthsm" value="<?php echo $nb5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_sys_rn" name="agent_level5_sys_rn" class="form-control widthsm" value="<?php echo $sys_rn5;?>" /></div>
  <div class="tabl_cell"> <input type="text" id="agent_level5_rn" name="agent_level5_rn" class="form-control widthsm" value="<?php echo $rn5;?>" /></div>
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
    <div class="content_section_aside">
      <div class="row">
        <div class="col-md-7">
          <h4 class="content_section_aside_header">Agent Notes</h4>
        </div>
        <div class="col-md-5">
          <a class="btn btn-primary bgorange float-right" target="_blank"  href="<?php echo THE_URL."main/agent-notes/".$policyInfo['id']; ?>">Add</a>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L1</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control" id="agent_level1_notes" name="agent_level1_notes" value="<?=$notes?>">
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L2</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control" id="agent_level2_notes" name="agent_level2_notes"  value="<?=$notes2?>">
          </div>
        </div>
      </div>  

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L3</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control" id="agent_level3_notes" name="agent_level3_notes"  value="<?=$notes3?>">
          </div>
        </div>
      </div> 

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L4</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control"  id="agent_level4_notes" name="agent_level4_notes" value="<?=$notes4?>">
          </div>
        </div>
      </div> 

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-1"><label class="formheading labelSide">L5</label></div>
          <div class="col-md-12 col-lg-11">
            <input type="text" class="form-control" id="agent_level5_notes" name="agent_level5_notes" value="<?=$notes5?>">
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
            <textarea class="form-control form-textarea" name="notes" id="notes"></textarea>
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
            <input id="receipt_pay" type="text" class="form-control" name="receipt_pay">
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Type</label></div>
          <div class="col-md-12 col-lg-9">
            <input id="receipt_type" type="text" class="form-control" name="receipt_type">
          </div>
        </div>
      </div>  

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Note</label></div>
          <div class="col-md-12 col-lg-9">
            <textarea id="receipt_note" class="form-control form-textarea" name="receipt_note"></textarea>
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
          $paymentsList = getPaymentsLists($policy_id_p); 
          $ins_loop = 1;
          if(count($paymentsList)>0)
            {foreach($paymentsList as $payments_key => $payments_value)
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
                      <td><input type="text" name="paymentpaid" class="input-no-border useDatePicker datepicker-dob" value="<?=date("m/d/Y",strtotime($payments_value['date_paid'])) ?>" size="7"/></td>
                      <td><input type="text" name="paymentduedate" class="input-no-border useDatePicker datepicker-dob" value="<?=date("m/d/Y",strtotime($payments_value['date_due']))?>" size="7"/></td>
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

            <tr class="row_payment" id="row_payment<?php echo $ins_loop;?>" data-id="<?php echo $ins_loop;?>">
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
                  <td><input type="text" id="paymentpaid" name="paymentpaid" class="input-no-border useDatePicker datepicker-dob" value="" size="7" /></td>
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

                        <input type="checkbox" name="locked" id="lockedlabe<?php echo $ins_loop;?>" />
                        <label for="lockedlabe<?php echo $ins_loop;?>"></label>
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

                          <input type="checkbox" name="paidcheck" id="paidlabe<?php echo $ins_loop;?>" />
                          <label for="paidlabe<?php echo $ins_loop;?>"></label>
                        </div>
                      </td>

                    </tr>


                  </table>
                </div><!-- table_overlay END -->
                <div class="clearfix"></div>
                <!-- filtersColumn END -->
              </div><!-- content_section_aside END -->
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
                </div><!-- content_section_aside END -->
              </div>
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
