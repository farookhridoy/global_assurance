<?php
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole;  $datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");

$policy_id_p= $policyInfo['id'];
$sql="SELECT * FROM notes WHERE policy_id='$policy_id_p'";
$getData = $db->select_single($sql);


//error_reporting(E_ALL);

?>

<div class="sectionPanel_Right">
  <div class="content_section">
    <div class="page-breadcrumbs">
      <ul>
        <li><a href="#"><i class="fas fa-home"></i></a></li>
        <li><a href="<?php echo THE_URL."main/health"; ?>">Dashboard</a></li>
        <li><a href="<?php echo THE_URL."main/payments-form/".$policyInfo['id']; ?>">Open Payment Form</a></li>
        <li>Agent Notes</li>
      </ul>
    </div><!-- page-breadcrumbs END -->

    <h1 class="page-titlename">Agent Notes</h1>

    <div class="clearfix"></div>

  
    <div class="row">  
      <div class="col-md-12">            
        <div class="content_section_aside">                  
          <h4 class="content_section_aside_header">Agent Notes</h4>                  
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
                      

                      <div class="tabl_th">NB</div>

                      <div class="tabl_th">RN</div>
                      <div class="tabl_th">PayBy</div>
                      <div class="tabl_th">Notes</div>
                      <?php $policyAgents = loadHealthPolicyAgents($policyInfo['idagent']); ?>
                       <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
                    </div>
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

                                        if (count($checkAgentDataFromAC)>0) {
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

                                        if (count($checkAgentDataFromAC)>0) {
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
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level1_nb" name="agent_level1_nb" class="form-control widthsm" value="<?php echo $nb;?>" /></div>
                      <input type="hidden" id="agent_level1_sys_nb" name="agent_level1_sys_nb"  class="form-control" value="<?php echo $sys_nb;?>" />  
                        <input type="hidden" id="agent_level1_sys_rn" name="agent_level1_sys_rn"  class="form-control" value="<?php echo $sys_rn;?>" /> 
                        <input type="hidden" id="agent_level1_commission" name="agent_level1_commission"  class="form-control" value="<?php echo $commission;?>" /> 
                      <div class="tabl_cell"> <input type="text" id="agent_level1_rn" name="agent_level1_rn" class="form-control widthsm" value="<?php echo $rn;?>" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level1_pay_by" name="agent_level1_pay_by" class="form-control widthsm" value="<?php echo $pay_by;?>" /></div>
                      <div class="tabl_cell col-md-3"> <input type="text" class="form-control" id="agent_level1_notes" name="agent_level1_notes" value="<?php echo $notes;?>"></div>
                      <div class="tabl_cell">
                        <button  data-id="1" class="submit_btn_agent btn btn-primary bgorange ">Save</button>
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

                                    if (count($checkAgentDataFromAC2)>0) {
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

                                    if (count($checkAgentDataFromAC2)>0) {
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
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level2_nb" name="agent_level2_nb" class="form-control widthsm" value="<?php echo $nb2;?>" /></div>
                      <input type="hidden" id="agent_level2_sys_nb" name="agent_level2_sys_nb"  class="form-control" value="<?php echo $sys_nb2;?>" />  
                        <input type="hidden" id="agent_level2_sys_rn" name="agent_level2_sys_rn"  class="form-control" value="<?php echo $sys_rn2;?>" /> 
                        <input type="hidden" id="agent_level2_commission" name="agent_level2_commission"  class="form-control" value="<?php echo $commission2;?>" /> 
                      <div class="tabl_cell"> <input type="text" id="agent_level2_rn" name="agent_level2_rn" class="form-control widthsm" value="<?php echo $rn2;?>" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level2_pay_by" name="agent_level2_pay_by" class="form-control widthsm" value="<?php echo $pay_by2;?>" /></div>
                      <div class="tabl_cell col-md-3"> <input type="text" class="form-control" id="agent_level2_notes" name="agent_level2_notes" value="<?php echo $notes2;?>"></div>
                      <div class="tabl_cell">
                        <button  data-id="2" class="submit_btn_agent btn btn-primary bgorange ">Save</button>
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
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level3_nb" name="agent_level3_nb" class="form-control widthsm" value="<?php echo $nb3;?>" /></div>
                      <input type="hidden" id="agent_level3_sys_nb" name="agent_level3_sys_nb"  class="form-control" value="<?php echo $sys_nb3;?>" />  
                        <input type="hidden" id="agent_level3_sys_rn" name="agent_level3_sys_rn"  class="form-control" value="<?php echo $sys_rn3;?>" /> 
                        <input type="hidden" id="agent_level3_commission" name="agent_level3_commission"  class="form-control" value="<?php echo $commission3;?>" /> 
                      <div class="tabl_cell"> <input type="text" id="agent_level3_rn" name="agent_level3_rn" class="form-control widthsm" value="<?php echo $rn3;?>" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level3_pay_by" name="agent_level3_pay_by" class="form-control widthsm" value="<?php echo $pay_by3;?>" /></div>
                      <div class="tabl_cell col-md-3"> <input type="text" class="form-control" id="agent_level3_notes" name="agent_level3_notes" value="<?php echo $notes3;?>"></div>
                      <div class="tabl_cell">
                        <button  data-id="3" class="submit_btn_agent btn btn-primary bgorange ">Save</button>
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
                                            $selected_text = ( trim($policyAgents[5][0]['idagent']) == $al_vl['id']) ? 'selected="selected"': ''; echo '<option value="'.$al_vl['id'].'" '.$selected_text.'>'.$al_vl['name'].'</option>';
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
                      <div class="tabl_cell"> <input type="text" id="agent_level4_f_name" name="agent_level4_f_name"  class="form-control" value="<?php echo $fName4;?>" /> </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level4_l_name" name="agent_level4_l_name" class="form-control" value="<?php echo $lName4;?>" /> </div>                                
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level4_nb" name="agent_level4_nb" class="form-control widthsm" value="<?php echo $nb4;?>" /></div>
                      <input type="hidden" id="agent_level4_sys_nb" name="agent_level4_sys_nb"  class="form-control" value="<?php echo $sys_nb4;?>" />  
                        <input type="hidden" id="agent_level4_sys_rn" name="agent_level4_sys_rn"  class="form-control" value="<?php echo $sys_rn4;?>" /> 
                        <input type="hidden" id="agent_level4_commission" name="agent_level4_commission"  class="form-control" value="<?php echo $commission4;?>" /> 
                      <div class="tabl_cell"> <input type="text" id="agent_level4_rn" name="agent_level4_rn" class="form-control widthsm" value="<?php echo $rn4;?>" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level4_pay_by" name="agent_level4_pay_by" class="form-control widthsm" value="<?php echo $pay_by4;?>" /></div>
                      <div class="tabl_cell col-md-3"> <input type="text" class="form-control" id="agent_level4_notes" name="agent_level4_notes" value="<?php echo $notes4;?>"></div>
                      <div class="tabl_cell">
                        <button  data-id="4" class="submit_btn_agent btn btn-primary bgorange ">Save</button>
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
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level5_nb" name="agent_level5_nb" class="form-control widthsm" value="<?php echo $nb5;?>" /></div>
                      <input type="hidden" id="agent_level5_sys_nb" name="agent_level5_sys_nb"  class="form-control" value="<?php echo $sys_nb5;?>" />  
                        <input type="hidden" id="agent_level5_sys_rn" name="agent_level5_sys_rn"  class="form-control" value="<?php echo $sys_rn5;?>" /> 
                        <input type="hidden" id="agent_level5_commission" name="agent_level5_commission"  class="form-control" value="<?php echo $commission5;?>" /> 
                      <div class="tabl_cell"> <input type="text" id="agent_level5_rn" name="agent_level5_rn" class="form-control widthsm" value="<?php echo $rn5;?>" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level5_pay_by" name="agent_level5_pay_by" class="form-control widthsm" value="<?php echo $pay_by5;?>" /></div>
                      <div class="tabl_cell col-md-3"> <input type="text" class="form-control" id="agent_level5_notes" name="agent_level5_notes" value="<?php echo $notes5;?>"></div>
                      <div class="tabl_cell">
                        <button  data-id="5" class="submit_btn_agent btn btn-primary bgorange ">Save</button>
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

 <!-- <form method="post" action="" id="frm_agent_notes" enctype="multipart/form-data">
    
    <div class="content_section_aside">
      <h4 class="content_section_aside_header">Agent Notes</h4>
 
      <div class="form-group-row" id="agent_frm1">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L1</label></div>
          <div class="col-md-9">
             <input type="text" class="form-control" id="agent_level1_notes" name="agent_level1_notes" value="">
            <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange submit_btn_agent" data-id="1">Save</button>
          </div>
        </div>
      </div>
 
      <div class="form-group-row" id="agent_frm2">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L2</label></div>
          <div class="col-md-9">
             <input type="text" class="form-control" id="agent_level2_notes" name="agent_level2_notes" value="">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange submit_btn_agent" data-id="2">Save</button>
          </div>
        </div>
      </div>
 
      <div class="form-group-row" id="agent_frm3">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L3</label></div>
          <div class="col-md-9">
             <input type="text" class="form-control" id="agent_level3_notes" name="agent_level3_notes" value="">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange submit_btn_agent" data-id="3">Save</button>
          </div>
        </div>
      </div>
 
      <div class="form-group-row" id="agent_frm4">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L4</label></div>
          <div class="col-md-9">
            <input type="text" class="form-control" id="agent_level4_notes" name="agent_level4_notes" value="">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange submit_btn_agent" data-id="4">Save</button>
          </div>
        </div>
      </div>
 
      <div class="form-group-row" id="agent_frm5">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L5</label></div>
          <div class="col-md-9">
           <input type="text" class="form-control" id="agent_level5_notes" name="agent_level5_notes" value="">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange submit_btn_agent" data-id="5">Save</button>
          </div>
        </div>
      </div>
 
    </div>
 
 </form> -->

  </div>
</div>

</div>
</div><!-- sectionPanel_Right END -->
