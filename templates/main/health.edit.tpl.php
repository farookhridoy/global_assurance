<?php global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole;  $datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");
//error_reporting(E_ALL);

?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li>Open Policy Record</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          
          <h1 class="page-titlename">Open Policy Record</h1>
          <div class="title_bar">
            <div id="ajax_progress" style="display: none;"><img src="<?php echo MEDIA_IMAGES; ?>ajax-loader.gif" alt="loading..."/>&nbsp;<label>Policy saving please wait...</label></div>
            <div class="btn btn-primary bgwhite"><a href="javascript:void(0);" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</a></div>
            <?php if($checkPermissionRole){ ?>
            <button class="btn btn-primary bgorange" onclick="health_form_submit()">Save</button>
            <button class="btn btn-primary bgorange" onclick="health_form_submit_exit()">Save and Exit</button>
            <?php } ?>
          </div>
          <form method="post" action="" id="frm_new_health" onsubmit="return health_form_submit()" enctype="multipart/form-data">
          <input type="hidden" name="policy_form_edit" value="1"/>
          <div class="content_section_aside">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Policy Number</label>
                  <input type="text" class="form-control" name="policy_number" id="policy_number" value="<?php echo $policyInfo['policynumber']; ?>"/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Status</label>
                  <span class="form-select">
                    <select class="form-control" name="policy_status" id="policy_status">
                      <option value="0"></option>
                      <?php $statusList = getPolicyStatus(); if($statusList){foreach($statusList as $st_key => $st_vl){ $selected_text = ($policyInfo['idstatus'] == $st_key) ? 'selected="selected"': '';   echo '<option value="'.$st_key.'" '.$selected_text.'>'.$st_vl.'</option>';}} ?> 
                    </select>
                  </span>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Date Cancelled, Rescinded or non-Renewed</label>
                  <input type="text" class="form-control" name="date_cancelled" id="date_cancelled" value="<?php echo dateFormFormat($policyInfo['datecancel']); ?>"/>                 
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Cancel Note</label>
                  <span class="form-select">
                    <select class="form-control" name="cancel_reason" id="cancel_reason">
                      <option value="0"></option>
                      <?php $cancelReasons = getCancelReasons(); if($cancelReasons){foreach($cancelReasons as $cn_key => $cn_vl){ $selected_text = ($policyInfo['idnotecancel'] == $cn_key) ? 'selected="selected"': '';   echo '<option value="'.$cn_key.'" '.$selected_text.'>'.$cn_vl.'</option>';}} ?> 
                    </select>
                  </span>                
                </div>
              </div>
            </div>
          </div><!-- content_section_aside END -->


          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-4">
              <div class="content_section_aside" id="planDetails">
                <h4 class="content_section_aside_header">Plan Details</h4>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Carrier</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control" name="policy_carrier" id="policy_carrier">
                         <option value=""></option>
                          <?php $carrier = getPolicyCarrier(); if($carrier){foreach($carrier as $c_cr => $c_vl){$selected_text = ($policyInfo['carrier'] == $c_cr) ? 'selected="selected"': ''; echo '<option value="'.$c_cr.'" '.$selected_text.'>'.$c_vl.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Effective Date</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="effective_date" id="effective_date" value="<?php echo dateFormFormat($policyInfo['effectivedate']); ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Plan</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control" name="plan" id="policy_plan">
                           <option value="0">&nbsp;</option>
                          <?php $planList = getPolicyPlanLists(1); if($planList){foreach($planList as $p_key => $p_value){ $selected_text = ($policyInfo['idplan'] == $p_key) ? 'selected="selected"': ''; echo '<option value="'.$p_key.'" '.$selected_text.'>'.$p_value.'</option>';}} ?>
                          
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Coverage</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control" name="coverage" id="policy_coverage">
                        <option>&nbsp;</option>
                        <?php $coverageLists = getPolicyCoverages($policyInfo['idplan']); if($coverageLists){foreach($coverageLists as $cv_key => $cv_value){ $selected_text = ($policyInfo['idcoverage'] == $cv_key) ? 'selected="selected"': ''; echo '<option value="'.$cv_key.'" '.$selected_text.'>'.$cv_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Deductible</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control" name="deductible" id="policy_deductible">
                        <option>&nbsp;</option>
                        <?php $deductibleLists = getPolicyDeductibles($policyInfo['idcoverage']); if($deductibleLists){foreach($deductibleLists as $dd_key => $dd_value){ $selected_text = ($policyInfo['iddeductible'] == $dd_value['id']) ? 'selected="selected"': ''; echo '<option value="'.$dd_value['id'].'" '.$selected_text.'>'.$dd_value['deductible'].'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Group ID</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="group_id" value="<?php echo $policyInfo['idgroup']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">RFID</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="policy_rfid" id="policy_rfid" value="<?php echo $policyInfo['rfid']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">RFID Clams</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="rfid_clams" id="rfid_clams" value="<?php echo $policyInfo['rfidclams']; ?>"/>
                    </div>
                  </div>
                </div>  

                <!--<div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading">Constitucion</label></div>
                    <div class="col-md-12 col-lg-7">
                      <div class="checkbxs">
                        <input type="checkbox" name="approved" id="constitucionLabel">
                        <label for="constitucionLabel"></label>
                      </div>
                    </div>
                  </div>
                </div>-->

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading">Dominicana</label></div>
                    <div class="col-md-12 col-lg-7">
                      <div class="checkbxs">
                        <input type="checkbox" name="dominicana" id="dominicanaLabel" value="1" <?php if($policyInfo['dominicana']) echo 'checked="checked"'; ?>/>
                        <label for="dominicanaLabel"></label>
                      </div>
                    </div>
                  </div>
                </div>   

              </div><!-- content_section_aside END -->
            </div>



            <div class="col-md-4">
              <div class="content_section_aside" id="contactinformations">
                <h4 class="content_section_aside_header">Contact Information</h4>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Address L1</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="address_l1" value="<?php echo $policyInfo['addressl1']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Address L2</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="address_l2" value="<?php echo $policyInfo['addressl2']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">City</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_city" value="<?php echo $policyInfo['city']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Country</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control" name="contact_country">
                          <option value=""></option>
                          <?php $countries = getCountryLists(); if($countries){foreach($countries as $c_key => $c_value){$selected_text = ($policyInfo['idcountry'] == $c_key) ? 'selected="selected"': '';  echo '<option value="'.$c_key.'" '.$selected_text.'>'.$c_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Phone</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_phone" value="<?php echo $policyInfo['phone']; ?>" />
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Work Phone</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_work_phone" value="<?php echo $policyInfo['workphone']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Celphone</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_cell_phone" value="<?php echo $policyInfo['cellphone']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Email</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_email" value="<?php echo $policyInfo['email']; ?>"/>
                    </div>
                  </div>
                </div>  
 
              </div><!-- content_section_aside END -->
            </div>




            <div class="col-md-4">
              <div class="content_section_aside" id="paymentperiod">
                <h4 class="content_section_aside_header">Payment Period</h4>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Rate Year</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control"  name="rate_year">
                           <option>&nbsp;</option>
                          <?php $rateYears = getRateYearLists(); if($rateYears){foreach($rateYears as $y_key => $y_value){$selected_text = ($policyInfo['idrateyear'] == $y_key) ? 'selected="selected"': ''; echo '<option value="'.$y_key.'" '.$selected_text.'>'.$y_value.'</option>';}} ?>
                          
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide" >Start</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="payment_start" id="payment_start" value="<?php echo dateFormFormat($policyInfo['paymentstart']); ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">End</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="payment_end" id="payment_end" value="<?php echo dateFormFormat($policyInfo['paymentend']); ?>"/>
                    </div>
                  </div>
                </div>

              </div><!-- content_section_aside END -->



              <div class="content_section_aside" id="paymentinfo">
                
                <div class="row">
                  <div class="col-md-7">
                    <h4 class="content_section_aside_header">Payment Info</h4>
                  </div>
                  <div class="col-md-5">
                    <div class="checkbxs float-right">
                      <input type="checkbox" name="approved" id="waivepolicyLabel" />
                      <label for="waivepolicyLabel">Waive Policy Fee</label>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Payment Cycle</label></div>
                    <div class="col-md-12 col-lg-7">
                      <span class="form-select">
                        <select class="form-control" name="payment_cycle">
                          <option>&nbsp;</option>
                          <?php $payCycles = getPayCycleLists(); if($payCycles){foreach($payCycles as $pc_key => $pc_value){$selected_text = ($policyInfo['idpaycycle'] == $pc_key) ? 'selected="selected"': ''; echo '<option value="'.$pc_key.'" '.$selected_text.'>'.$pc_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Date Due</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="date_due" id="date_due" value="<?php echo dateFormFormat($policyInfo['paymentduedate']); ?>" />
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Group Discount</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="group_discount" value="<?php echo $policyInfo['groupdiscount']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Discount</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="policy_discount" value="<?php echo $policyInfo['policydiscount']; ?>"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Policy fee amount</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo $policyInfo['fee']; ?>" name="policy_fee"/>
                    </div>
                  </div>
                </div>


              </div><!-- content_section_aside END -->
            </div>
            <div class="col-md-6">
              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Agents</h4>
                
                 <?php 

                    //$policyAgents = loadHealthPolicyAgents($policyInfo['idagent']); //pre($policyAgents); 
                 
                 //echo $policyAgents[2][0]['idagent']."eeteet";
                 ?>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Agent Level 1</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-6">
                          <span class="form-select">
                            <select class="policy_agents form-control" name="agent_level1" id="agent_level1" data-id="1">
                              <option value="0">&nbsp;</option>
                               <?php 
                               $agents = getAgentLists("health",1);  
                               if($agents)
                                {foreach($agents as $ag_key => $ag_value)
                                    { 
                                        
                                        $selected_text = ( trim($policyInfo['idagent']) == $ag_value['id']) ? 'selected="selected"': '';
                                         echo '<option value="'.$ag_value['id'].'" '.$selected_text.'>'.$ag_value['name'].'</option>';
                                     }
                                 } 
                                ?>  
                            </select>
                            
                            <?php //pre($agents); ?>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" readonly="readonly" id="agent_level1_f_name" />
                          <input type="text" class="form-control spaceTopTen" readonly="readonly" id="agent_level1_l_name" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Agent Level 2</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-6">
                          <span class="form-select">
                            <select class="policy_agents form-control" name="agent_level2" id="agent_level2" data-id="2">
                            <option value="0">&nbsp;</option>
                            <?php 
                               $agents = getAgentLists("health",2);  
                               if($agents)
                                {foreach($agents as $ag_key => $ag_value)
                                    { 
                                        $selected_text = ( trim($policyInfo['idagent2']) == $ag_value['id']) ? 'selected="selected"': '';
                                         echo '<option value="'.$ag_value['id'].'" '.$selected_text.'>'.$ag_value['name'].'</option>';
                                     }
                                 } 
                                ?>  
                            </select>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" readonly="readonly" id="agent_level2_f_name" />
                          <input type="text" class="form-control spaceTopTen" readonly="readonly" id="agent_level2_l_name" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Agent Level 3</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-6">
                          <span class="form-select">
                            <select class="policy_agents form-control" name="agent_level3" id="agent_level3" data-id="3">
                              <option value="0">&nbsp;</option>
                               <?php 
                               $agents = getAgentLists("health",3);  
                               if($agents)
                                {foreach($agents as $ag_key => $ag_value)
                                    { 
                                        $selected_text = ( trim($policyInfo['idagent3']) == $ag_value['id']) ? 'selected="selected"': '';
                                         echo '<option value="'.$ag_value['id'].'" '.$selected_text.'>'.$ag_value['name'].'</option>';
                                     }
                                 } 
                                ?>  

                            </select>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" readonly="readonly" id="agent_level3_f_name" />
                          <input type="text" class="form-control spaceTopTen" readonly="readonly" id="agent_level3_l_name" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Agent Level 4</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-6">
                          <span class="form-select">
                            <select class="policy_agents form-control" name="agent_level4" id="agent_level4" data-id="4">
                              <option value="0">&nbsp;</option>
                                <?php 
                               $agents = getAgentLists("health",4);  
                               if($agents)
                                {foreach($agents as $ag_key => $ag_value)
                                    { 
                                        $selected_text = ( trim($policyInfo['idagent4']) == $ag_value['id']) ? 'selected="selected"': '';
                                         echo '<option value="'.$ag_value['id'].'" '.$selected_text.'>'.$ag_value['name'].'</option>';
                                     }
                                 } 
                                ?>  
                            </select>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" readonly="readonly" id="agent_level4_f_name" />
                          <input type="text" class="form-control spaceTopTen" readonly="readonly" id="agent_level4_l_name" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Agent Level 5</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-6">
                          <span class="form-select">
                            <select class="policy_agents form-control" name="agent_level5" id="agent_level5" data-id="5">
                              <option value="0">&nbsp;</option>
                              <?php 
                               $agents = getAgentLists("health",5);  
                               if($agents)
                                {foreach($agents as $ag_key => $ag_value)
                                    { 
                                        $selected_text = ( trim($policyInfo['idagent5']) == $ag_value['id']) ? 'selected="selected"': '';
                                         echo '<option value="'.$ag_value['id'].'" '.$selected_text.'>'.$ag_value['name'].'</option>';
                                     }
                                 } 
                                ?>  
                            </select>
                          </span>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" readonly="readonly" id="agent_level5_f_name" />
                          <input type="text" class="form-control spaceTopTen" readonly="readonly" id="agent_level5_l_name" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                
              </div><!-- content_section_aside END -->
            </div>



            <div class="col-md-6">
              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Fronting and Overrides</h4>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Fronting</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-4">
                          <span class="form-select">
                            <select class="form-control">
                              <option>&nbsp;</option>
                            </select>
                          </span>
                        </div>
                        <div class="col-md-4">
                          <input type="text" class="form-control" />
                        </div>
                        <div class="col-md-2">
                          <input type="text" class="form-control" value="0" />
                        </div>
                        <div class="col-md-2">
                          <input type="text" class="form-control" />
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
                        <div class="col-md-4">
                          <span class="form-select">
                            <select class="form-control">
                              <option>&nbsp;</option>
                            </select>
                          </span>
                        </div>
                        <div class="col-md-4">
                          <input type="text" class="form-control"/>
                        </div>
                        <div class="col-md-2">
                          <input type="text" class="form-control" value="0" />
                        </div>
                        <div class="col-md-2">
                          <input type="text" class="form-control" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div><!-- content_section_aside END -->

              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Underwriting</h4>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Doctor</label></div>
                    <div class="col-md-12 col-lg-9">
                      <span class="form-select">
                        <select class="form-control" name="doctor">
                          <option>&nbsp;</option>
                          <?php $doctors = getDoctorLists(); if($doctors){foreach($doctors as $d_key => $d_value){$selected_text = ( $policyInfo['iddoctor'] == $d_key) ? 'selected="selected"': ''; echo '<option value="'.$d_key.'" '.$selected_text.'>'.$d_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-6">
                      <label class="formheading labelSide">Date Received</label>
                      <input type="text" class="form-control" name="date_received" id="date_received" value="<?php echo dateFormFormat($policyInfo['datereceived']); ?>"/>
                    </div>
                    <div class="col-md-6">
                      <label class="formheading labelSide">Date Approved</label>
                      <input type="text" class="form-control" name="date_approved" id="date_approved" value="<?php echo dateFormFormat($policyInfo['dateapproved']); ?>" />
                    </div>
                  </div>
                </div>

              </div><!-- content_section_aside END -->

              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Approval Sheet</h4>
                <div class="form-group-row">
                  <div class="checkbxs">
                    <input type="checkbox" name="approved_standard" id="approvedstand" value="1" <?php if($policyInfo['approvedstandrad']) echo 'checked="checked"'; ?>/>
                    <label for="approvedstand">Approved Standrad</label>
                  </div>
                </div>
              </div><!-- content_section_aside END --> 

             <div class="content_section_aside bgNone paddingNone paddintTopNone">
                <div class="checkapproval">
                  <ul>
                    <li><div class="checkbxs">
                        <input type="checkbox" name="death_main_insured" id="deathmainLabel" value="1" <?php if($policyInfo['deathmaininsured']) echo 'checked="checked"'; ?>/><label for="deathmainLabel">Death - Main Insured</label>
                      </div></li>
                    <li><div class="checkbxs">
                        <input type="checkbox" name="is_spanish" id="spanishLabel" value="1" <?php if($policyInfo['spanish']) echo 'checked="checked"'; ?>/><label for="spanishLabel">Spanish</label>
                      </div></li>
                    <li><div class="radioset">
                        <input type="radio" name="premium_zone" id="maxicoLabel" value="maxico" <?php if($policyInfo['premium_zone']=='maxico') echo 'checked="checked"'; ?>/><label for="maxicoLabel">Mexico</label>
                      </div></li>
                    <!--<li><div class="checkbxs">
                        <input type="checkbox" name="approved" id="dominiLabel"><label for="dominiLabel">Domini</label>
                      </div></li>-->
                    <li><div class="checkbxs">
                        <input type="checkbox" name="claria_express" id="clariaexpLabel" value="1" <?php if($policyInfo['clariaexpress']) echo 'checked="checked"'; ?>/><label for="clariaexpLabel">Claria Express</label>
                      </div></li>
                    <!--<li><div class="checkbxs">
                        <input type="checkbox" name="add_percent" id="addLabel" hidden="" value="1" <?php if($policyInfo['add_25_percent']) echo 'checked="checked"'; ?>/><label for="addLabel">Add 25%</label>
                      </div></li>-->
                    <li><div class="radioset">
                        <input type="radio" name="premium_zone" id="worldLabel" value="world" <?php if($policyInfo['premium_zone']=='world') echo 'checked="checked"'; ?>/><label for="worldLabel">World</label>
                      </div></li>
                    <li><div class="radioset">
                        <input type="radio" name="premium_zone" id="srilankaLabel" value="srilanka" <?php if($policyInfo['premium_zone']=='srilanka') echo 'checked="checked"'; ?>/><label for="srilankaLabel">Sri Lanka</label>
                      </div></li>
                  </ul>
                </div>
              </div><!-- content_section_aside END -->

            </div>



          </div>
          <div class="clearfix"></div>
          <div class="content_section_aside" id="content_section_insured"> 
            <div class="table_overlay">
              <table class="tableContent">
                <tr>
                  <th class="fltersearch"><span>Order</span></th>
                  <th class="fltersearch"><span>First Name</span></th>
                  <th class="fltersearch"><span>Last Name</span></th>
                  <th class="fltersearch"><span>Dob</span></th>
                  <th class="fltersearch"><span>Relation</span></th>
                  <th class="fltersearch"><span>Effective Date</span></th>
                  <th class="fltersearch"><span>Age</span></th>
                  <th class="fltersearch"><span>Gender</span></th>
                  <th class="fltersearch"><span>Premium</span></th>
                  <th class="fltersearch"><span>Add Rate Up</span></th>
                  <th class="fltersearch"><span>Rate Up Type %</span></th>

                  <th class="fltersearch"><span>Rate Up Type $</span></th>
                  <th class="fltersearch"><span>Rate Up Type $ C</span></th>
                  <th class="fltersearch"><span>Add Rider</span></th>
                  <th class="fltersearch"><span>90 day waiver</span></th>
                  <th class="fltersearch"><span>Effective Date 90 day</span></th>
                  <th class="fltersearch"><span>Manual Rate</span></th>
                  <!--<th class="fltersearch"><span>Rider Maternity</span></th>-->
                  <!--<th class="fltersearch"><span>Rider CompMater</span></th>-->
                  <th class="fltersearch"><span>Active</span></th>
                  <th class="fltersearch"><span>Delete</span></th>
                  <th class="fltersearch"><span>Inactive Date</span></th>
                  <th class="fltersearch"><span>Email</span></th>
                </tr>
                
                
                
                  <tr id="row_insured_base" data-id="0" style="display: none;">
                  <td style="display: none;"><input type="hidden" name="insured[]" value=""/><input type="checkbox" name="interview[]" class="insuredProcess" value="1"/></td>
                  <td><input type="text" name="order[]" class="input-no-border insuredProcess order_column" size="5"/></td>
                  <td><input type="text" name="first_name[]" class="input-no-border insuredProcess" size="6"/></td>
                  <td><input type="text" name="last_name[]" class="input-no-border insuredProcess" size="6"/></td>
                  <td><input type="text" name="dob[]" class="input-no-border useDatePicker datepicker-dob" size="7"/></td>
                  <td><select class="form-control input-no-border insuredProcess insuredRelation" name="relation[]">
                      <option>&nbsp;</option>
                      <?php 
                      $realtions = getRelationLists();  if($realtions){foreach($realtions as $r_key => $r_value){echo '<option value="'.$r_key.'">'.$r_value.'</option>';}} ?>  
                      </select>
                  </td>
                  <td><input type="text" name="effective[]" class="input-no-border useDatePicker datepicker-dob  align-left"  size="12" value="<?php echo $policyInfo['effectivedate'] ? dateFormFormat($policyInfo['effectivedate']):''; ?>"/></td>
                  <td><input type="text" name="age[]" class="input-no-border insured-age" size="6"/></td>
                   <td><select class="form-control input-no-border" name="gender[]">
                      <option>&nbsp;</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      </select></td>
                  <td></td>
                  <td><a href="javascript: void(0)" class="addRateUps detailsLink">Add Rate Up</a></td>
                  <td><span class="frmRateUPPercent">0</span></td>
                  <td><span class="frmRateUPAmount">$0.00</span></td>
                  <td>$0.00</td>
                  <td><a href="javascript: void(0)" class="detailsLink">Add Rider</a></td>
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ninety_day_waiver[]" id="waiverday" value="1" class=""/>
                      <label for="waiverday"></label>
                    </div>
                  </td>
                  <td><input type="text" name="effective_ninety_day[]" class="input-no-border useDatePicker"  size="12"/></td>
                  <td><a href="javascript: void(0)" class="detailsLink">Manual Rate</a></td>

                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridermater[]" id="ridermater" class="insuredProcess" value="1"/>
                      <label for="ridermater"></label>
                    </div>
                  </td>-->
                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridercomp[]" id="ridercomp" class="insuredProcess" value="1"/>
                      <label for="ridercomp"></label>
                    </div>
                  </td>-->
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="activelab[]" id="activelab" class="" value="1"/>
                      <label for="activelab" class=""></label>
                    </div>
                  </td>
                  <td><a href="javascript: void(0)" class="detailsLink deleteInsured">Delete</a></td>
                  <td><input type="text" name="ins_inactivate_date[]" class="input-no-border useDatePicker"  size="12"/></td>
                  <td><input type="text" name="ins_email[]" class="input-no-border"  size="12"/></td>
                </tr>
                
                <?php $insuredLists = getHealthInsuredLists($policyInfo['id']);if($insuredLists){ $ins_loop = 1; foreach($insuredLists as $singleInsured){ ?>
 
                 <tr id="row_insured<?php echo $ins_loop; ?>" data-id="<?php echo $ins_loop; ?>">
                  <td style="display: none;"><input type="hidden" name="insured[]" value="<?php echo $singleInsured['id']; ?>"/><input type="checkbox" name="interview[]" value="1" <?php if($singleInsured['interview']){echo 'checked="checked"';} ?>/></td>
                  <td><input type="text" name="order[]" class="input-no-border order_column" size="5" value="<?php echo $ins_loop;?>"/></td>
                  <td><input type="text" name="first_name[]" class="input-no-border insuredProcess" value="<?php echo $singleInsured['first_name']; ?>" size="6"/></td>
                  <td><input type="text" name="last_name[]" class="input-no-border insuredProcess" value="<?php echo $singleInsured['last_name']; ?>" size="6"/></td>
                  <td><input type="text" name="dob[]" class="input-no-border useDatePicker datepicker-dob" value="<?php if($singleInsured['dob'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['dob']); ?>" size="7"/></td>
                  <td><select class="form-control input-no-border insuredProcess insuredRelation" name="relation[]">
                      <option>&nbsp;</option>
                      <?php $realtions = getRelationLists();  if($realtions){foreach($realtions as $r_key => $r_value){$selected_text = ($singleInsured['idrelation'] == $r_key) ? 'selected="selected"': '';  echo '<option value="'.$r_key.'" '.$selected_text.'>'.$r_value.'</option>';}} ?>  
                      </select>
                  </td>
                  <td><input type="text" name="effective[]" class="input-no-border useDatePicker datepicker-dob align-left" value="<?php if($singleInsured['effectivedate'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['effectivedate']); ?>"  size="12"/></td>
                  <td><input type="text" name="age[]" class="input-no-border insured-age" size="6" value="<?php echo $singleInsured['age']; ?>"/></td>
                   <td><select class="form-control input-no-border" name="gender[]">
                      <option>&nbsp;</option>
                      <option value="male" <?php if($singleInsured['gender']=='male') echo 'selected="selected"'; ?>>Male</option>
                      <option value="female" <?php if($singleInsured['gender']=='female') echo 'selected="selected"'; ?>>Female</option>
                      </select></td>
                  <td>$<?php echo $singleInsured['premium']; ?></td>
                  <td><a href="javascript: void(0)" class="addRateUps detailsLink">Add Rate Up</a></td>
                  <td><span class="frmRateUPPercent">0</span></td>
                  <td><span class="frmRateUPAmount">$0.00</span></td>
                  <td>$0.00</td>
                  <td><a href="javascript: void(0)" class="riderController detailsLink">Add Rider</a></td>
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ninety_day_waiver[]" id="waiverday<?php echo $ins_loop; ?>" value="1" <?php if($singleInsured['ninety_day_waiver']){echo 'checked="checked"';} ?> class="insuredProcess"/>
                      <label for="waiverday<?php echo $ins_loop;  ?>"></label>
                    </div>
                  </td>
                  <td><input type="text" name="effective_ninety_day[]" class="input-no-border useDatePicker"  size="12" value="<?php if($singleInsured['effective_ninety_day'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['effective_ninety_day']); ?>"/></td>
                  <td><a href="javascript: void(0)" class="detailsLink manualRate">Manual Rate</a></td>

                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridermater[]" id="ridermater<?php echo $ins_loop;  ?>" value="1"  class="insuredProcess" <?php if($singleInsured['ridermat']){echo 'checked="checked"';} ?>/>
                      <label for="ridermater<?php echo $ins_loop;  ?>"></label>
                    </div>
                  </td>-->
                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridercomp[]" id="ridercomp<?php echo $ins_loop;  ?>" value="1" class="insuredProcess" <?php if($singleInsured['ridercommat']){echo 'checked="checked"';} ?>/>
                      <label for="ridercomp<?php echo $ins_loop;  ?>"></label>
                    </div>
                  </td>-->
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="activelab[]" id="activelab<?php echo $ins_loop;  ?>" value="1" class="" <?php if($singleInsured['active']){echo 'checked="checked"';} ?>/>
                      <label for="activelab<?php echo $ins_loop;  ?>" class=""></label>
                    </div>
                  </td>
                  <td><a href="javascript: void(0)" class="detailsLink deleteInsured">Delete</a></td>
                  <td><input type="text" name="ins_inactivate_date[]" class="input-no-border useDatePicker" value="<?php if($singleInsured['dateinactive'] != '0000-00-00 00:00:00') echo dateFormFormat($singleInsured['dateinactive']); ?>"  size="12"/></td>
                  <td><input type="text" name="ins_email[]" class="input-no-border" value="<?php echo $singleInsured['email']; ?>"  size="12"/></td>
                </tr> 
                
                <?php $ins_loop++; } }else{ ?>
                <tr id="row_insured1" data-id="1">
                  <td style="display: none;"><input type="hidden" name="insured[]" value=""/><input type="checkbox" name="interview[]" value="1"/></td>
                  <td><input type="text" id="order_column1" name="order[]" class="input-no-border order_column" value="1" size="5"/></td>
                  <td><input type="text" name="first_name[]" class="input-no-border insuredProcess" size="6"/></td>
                  <td><input type="text" name="last_name[]" class="input-no-border insuredProcess" size="6"/></td>
                  <td><input type="text" name="dob[]" class="input-no-border useDatePicker datepicker-dob" size="7"/></td>
                  <td><select class="form-control input-no-border insuredProcess insuredRelation" name="relation[]">
                      <option>&nbsp;</option>
                      <?php 
                      $realtions = getRelationLists();  if($realtions){foreach($realtions as $r_key => $r_value){echo '<option value="'.$r_key.'">'.$r_value.'</option>';}} ?>  
                      </select>
                  </td>
                  <td><input type="text" name="effective[]" class="input-no-border useDatePicker datepicker-dob align-left"  size="12" value="<?php echo $policyInfo['effectivedate'] ? dateFormFormat($policyInfo['effectivedate']):''; ?>"/></td>
                  <td><input type="text" name="age[]" class="input-no-border insured-age" size="6"/></td>
                   <td><select class="form-control input-no-border" name="gender[]">
                      <option>&nbsp;</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      </select></td>
                  <td></td>
                  <td><a href="javascript: void(0)" class="addRateUps detailsLink">Add Rate Up</a></td>
                  <td><span class="frmRateUPPercent">0</span></td>
                  <td><span class="frmRateUPAmount">$0.00</span></td>
                  <td>$0.00</td>
                  <td><a href="javascript: void(0)" class="detailsLink">Add Rider</a></td>
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ninety_day_waiver[]" id="waiverday1" value="1" class=""/>
                      <label for="waiverday1"></label>
                    </div>
                  </td>
                  <td><input type="text" name="effective_ninety_day[]" class="input-no-border useDatePicker"  size="12"/></td>
                  <td><a href="javascript: void(0)" class="detailsLink">Manual Rate</a></td>

                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridermater[]" id="ridermater1" class="insuredProcess"/>
                      <label for="ridermater1"></label>
                    </div>
                  </td>-->
                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridercomp[]" id="ridercomp1" class="insuredProcess"/>
                      <label for="ridercomp1"></label>
                    </div>
                  </td>-->
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="activelab[]" id="activelab1" class=""/>
                      <label for="activelab1" class=""></label>
                    </div>
                  </td>
                  <td><a href="javascript: void(0)" class="detailsLink deleteInsured">Delete</a></td>
                  <td><input type="text" name="ins_inactivate_date[]" class="input-no-border useDatePicker insuredProcess"  size="12"/></td>
                  <td><input type="text" name="ins_email[]" class="input-no-border"  size="12"/></td>
                </tr>
                <?php } ?>
                
                <tr>
                  <td><span id="addInsuredRow" title="Add new row"><a href="javascript: void(0)">+</a></span></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                  </td>
                  <td>
                    
                  </td>
                  <td>
                    
                  </td>
                  <td></td>
                  <td></td>
                </tr>
                
              
              </table>
            </div><!-- table_overlay END -->
            <div class="clearfix"></div>
            
          </div><!-- content_section_aside END -->




          <div class="clearfix"></div>
          
          <div class="row">
            <div class="col-md-12">
              <h3 class="pagesubheading">Add Attachments</h3>
              <div class="content_section_aside bgNone bordersetTop paddingNone">
                <span class="attentionValue">Attention : This will store files it for later use</span>
                <span class="blueheading">To add a New File</span>
                <span class="listingValue">1. Click the browse button to add the location of the file.</span>
                <span class="listingValue">2. Click the add button to add more file.</span>
                <span class="listingValue">3. Add a brief description of the file on the description column</span>

                <!--<span class="blueheading">To Open Existing file</span>
                <span class="listingValue">1. Click the Path column</span>-->
                <span class="attentionValue">Do not click add on existing records or it will be overwrite</span>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="content_section_aside" id="content_section_file">
           <?php $policyFiles = getPolicyFiles($policyInfo['id']); 
           
              //pre($policyFiles);
               if($policyFiles){
                $files_total = count($policyFiles);
                $file_loop = 0;
                foreach($policyFiles as $key => $file){ 
                //$note_class_name = (($notes_total - $note_loop)>1) ? "noteBlock".($notes_total - $note_loop): "noteBlock";
                $data_id = $file['id'];
                $file_loop++;
               ?>
                <div class="row" id="currFile<?php echo $data_id; ?>">
                  <div class="col-md-4">
                    <div class="form-group-section">
                      <label class="formheading">Description</label>
                      <input type="text" class="form-control file_description" value="<?php echo $file['description']; ?>" disabled="disabled"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group-section">
                      <label class="formheading">Path</label>
                      <input type="text" class="form-control file_path" value="<?php echo $file['file_path']; ?>" disabled="disabled"/>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group-section">
                      <label class="formheading">&nbsp;</label>
                      <div class="btn btn-primary bgorange"><a href="javascript: void(0)" class="removeFiles" data-id="<?php echo $data_id; ?>">X</a></div>
                      <div class="btn btn-primary bgorange"><a href="<?php echo THE_URL; ?>/<?php echo $file['file_path']; ?>" target="_blank">View/Download</a></div>
                    </div>
                  </div>
                </div>
            <?php }} ?>
            <div class="row fileBlock">
              <div class="col-md-5">
                <div class="form-group-section">
                  <label class="formheading">Description</label>
                  <input type="text" class="form-control file_description" name="file_description[]" id="file_description1"/>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group-section">
                  <label class="formheading">Path</label>
                  <input type="text" class="form-control file_path" id="file_path1" value="" disabled="disabled"/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">&nbsp;</label>
                  <input type="file" id="adfile1" name="attachment_file" class="hideaddinput" data-id="1"/>
                  <label class="btn btn-primary bgorange" for="adfile1">Browse</label>
                  <div class="btn btn-primary bgorange"><a href="javascript: void(0)" id="addFiles" class="addFiles" data-id="1">Add</a></div>
                </div>
              </div>
            </div>
          </div><!-- END content_section_aside -->

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">            
              <div class="content_section_aside" id="content_section_note">
              <h3 class="pagesubheading">Add Notes</h3>
               <?php $policyNotes = getPolicyNotes($policyInfo['id']); 
               if($policyNotes){
                //print_r($policyNotes);
                $notes_total = count($policyNotes);
                $note_loop = 0;
                foreach($policyNotes as $key => $note){ 
                $note_class_name = (($notes_total - $note_loop)>1) ? "noteBlock".($notes_total - $note_loop): "noteBlock";
                $data_id = (($notes_total - $note_loop)>1) ? $notes_total - $note_loop: 1;
                $note_loop++;
               ?>
                <div class="row <?php echo $note_class_name; ?>">
                  <div class="col-md-10">
                    <div class="form-group-section">
                      <label class="formheading">Note</label>
                     
                      
                      <input type="hidden" name="notesids[]" class="notesids" value="<?php echo $note['id'] ?>"/>
                      <input type="text" class="form-control inputNotes" name="notes[]" value="<?php echo $note['note'] ?>"/>
                      
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="button-forequal">
                      <div class="form-group-section">
                        <?php if((count($policyNotes) - 1)==$key){ ?>
                        <div class="btn btn-primary bgorange"><a href="javascript: void(0)" class="addNotes" id="addNotes" data-id="<?php echo $data_id; ?>">Add</a></div>
                        <?php }else{ ?>
                        <div class="btn btn-primary bgorange"><a href="javascript: void(0)" id="addNotes<?php echo $data_id; ?>" class="addNotes" data-id="<?php echo $data_id; ?>">X</a></div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }}else{ ?>
                <div class="row noteBlock">
                  <div class="col-md-10">
                    <div class="form-group-section">
                      <label class="formheading">Note</label>
                      <input type="hidden" name="notesids[]" class="notesids" value=""/>
                      <input type="text" class="form-control inputNotes" name="notes[]"/>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="button-forequal">
                      <div class="form-group-section">
                        <div class="btn btn-primary bgorange"><a href="javascript: void(0)" id="addNotes" class="addNotes" data-id="1">Add</a></div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div><!-- END content_section_aside -->
            </div>
          </div>  


          <div class="content_section_aside">
            <h4 class="content_section_aside_header">Activity</h4> 
            <div class="activitylist">
              <ul>
               <?php echo getPolicyActivityLists($policyInfo['id']); ?>
               <!--<li><span class="activitydesc">jonathan Changed Foreign Provider to -1 for 542 on 9/18/2013&nbsp; <span class="timelist">1:35:16 PM</span></span></li>
               <li><span class="activitydesc">jonathan Changed Foreign Provider to -1 for 542 on 9/18/2013&nbsp; <span class="timelist">1:44:53 PM</span></span></li>
               <li><span class="activitydesc">jonathan Changed Foreign Provider to 0 for 542 on 9/18/2013&nbsp; <span class="timelist">2:44:38 PM</span></span></li>
               <li><span class="activitydesc">jonathan Changed Provider to Cleveland Clinic Florida for 542 on 9/18/2013&nbsp; <span class="timelist">3:31:26 PM</span></span></li>
               <li><span class="activitydesc">jjonathan Changed Provider to  for 542 on 9/18/2013&nbsp; <span class="timelist">4:16:59 PM</span></span></li>
               <li><span class="activitydesc">ederneys Changed Provider to Cleveland Clinic Florida for 542 on 9/23/2013&nbsp; <span class="timelist">4:48:10 PM</span></span></li>-->
               </ul>
            </div>
          </div>
          <div class="clearfix"></div>
         </form>
         
         <div style="" class="premium-inclusion-wrapper">
         <a href="javascript:void(0);" class="close-btn">x</a>
            <div class="table_overlay">
            <form action="" method="post" onsubmit="return premium_inclusion_form_submit()" id="form_premium_inclusion">
                <table class="tableContent">
                <tr>
                    <th class="mediumcontrolform">Insured Full Name</th>
                    <th class="mediumcontrolform">Relation</th>
                    <th class="mediumcontrolform">Premium</th>
                    <th class="mediumcontrolform">Effective Date</th>
                    <th class="mediumcontrolform">PremiumDay_I</th>
                    <th class="mediumcontrolform">BasePremiumDay</th>
                    <th class="mediumcontrolform">Date_Prorate</th>
                    <th class="mediumcontrolform">DaysP</th>
                    <th class="mediumcontrolform">PremiumToPay</th>
                    <th class="mediumcontrolform">End_Date_p</th>
                    <th class="mediumcontrolform">PremiumCertificate</th>
                    <th class="mediumcontrolform">PremiumWI</th>
                    <th class="mediumcontrolform">AnnualToPay</th>
                    <th class="mediumcontrolform">SemiToPay</th>
                    <th class="mediumcontrolform">QuarterToPay</th>
                    <th class="mediumcontrolform">MonthToPay</th>
                </tr>
              <?php 
                $numItems = count($insuredLists);
                $insuredCount = 1; foreach($insuredLists as $inLists){
                        $payment_cycle = $policyInfo['idpaycycle'];
                        $totalPremium = $inLists['premium'];
                        if($payment_cycle == 1){
                            $premiumDay = $totalPremium/365;
                        }elseif($payment_cycle == 2){
                            $premiumDay = ($totalPremium*0.55)*2/365;
                        }elseif($payment_cycle == 3){
                            $premiumDay = ($totalPremium*0.28)*4/365;
                        }elseif($payment_cycle == 4){
                            $premiumDay = ($totalPremium*0.1)*12/365;
                        }
                        $premiumDay = round($premiumDay,2);
                        
                        $basePremiumDay = $totalPremium/365;
                        $basePremiumDay = round($basePremiumDay,2);
                    
                ?>
                <tr class="insured-data">
                  <td style="display: none;" class="bigcontrolform"><input id="insuredId" type="hidden" readonly="readonly" disabled="disabled" class="form-control" name="insuredId" value="<?php echo $inLists['id'];?>"></td>
                  <td class="bigcontrolform"><input id="insuredName<?php echo $insuredCount;?>" type="text" class="form-control" name="insuredName" value="<?php echo $inLists['first_name'].' '.$inLists['last_name'];?>"></td>
                  <td class="mediumcontrolform">
                    <select class="form-control input-no-border insuredRelation" name="relation[]">
                      <option>&nbsp;</option>
                      <?php $realtions = getRelationLists();  if($realtions){foreach($realtions as $r_key => $r_value){$selected_text = ($inLists['idrelation'] == $r_key) ? 'selected="selected"': '';  echo '<option value="'.$r_key.'" '.$selected_text.'>'.$r_value.'</option>';}} ?>  
                    </select>       
                  </td>
                  <td class="mediumcontrolform"><input id="premium<?php echo $insuredCount;?>" type="text" class="form-control" name="premium" value="<?php echo $inLists['premium'];?>"></td>
                  <td class="mediumcontrolform"><input id="insuredEffectiveDate<?php echo $insuredCount;?>" type="text" class="form-control insuredEffectiveDate" name="insuredEffectiveDate" value="<?php echo dateFormFormat($inLists['effectivedate']);?>"></td>
                  <td class="mediumcontrolform"><input id="premiumDayI<?php echo $insuredCount;?>" type="text" class="form-control premiumDayI" name="premiumDayI" value="<?php echo $premiumDay;?>"></td>
                  <td class="mediumcontrolform"><input id="BasepremiumDay<?php echo $insuredCount;?>" type="text" class="form-control BasepremiumDay" name="BasepremiumDay" value="<?php echo $basePremiumDay?>"></td>
                  <td class="mediumcontrolform"><input id="prorateDate<?php echo $insuredCount;?>" type="text" class="form-control prorateDate" name="prorateDate" value=""></td>
                  <td class="mediumcontrolform"><input id="DaysP<?php echo $insuredCount;?>" type="text" class="form-control DaysP" name="DaysP" value=""></td>
                  <td class="mediumcontrolform"><input id="premiumToPay<?php echo $insuredCount;?>" type="text" class="form-control premiumToPay" name="premiumToPay" value=""></td>
                  <td class="mediumcontrolform"><input id="endDate<?php echo $insuredCount;?>" type="text" class="form-control endDate" name="endDate" value=""></td>
                  <td class="mediumcontrolform"><input id="premiumCertificate<?php echo $insuredCount;?>" type="text" class="form-control premiumCertificate" name="premiumCertificate" value=""></td>
                  <td class="mediumcontrolform"><input id="premiumWI<?php echo $insuredCount;?>" type="text" class="form-control premiumWI" name="premiumWI" value=""></td>
                  <td class="mediumcontrolform"><input id="AnnualToPay<?php echo $insuredCount;?>" type="text" class="form-control AnnualToPay" name="AnnualToPay" value="<?php echo $totalPremium;?>"></td>
                  <td class="mediumcontrolform"><input id="SemiToPay<?php echo $insuredCount;?>" type="text" class="form-control SemiToPay" name="SemiToPay" value="<?php echo $totalPremium*0.55;?>"></td>
                  <td class="mediumcontrolform"><input id="QuarterToPay<?php echo $insuredCount;?>" type="text" class="form-control QuarterToPay" name="QuarterToPay" value="<?php echo $totalPremium*0.28;?>"></td>
                  <td class="mediumcontrolform"><input id="MonthToPay<?php echo $insuredCount;?>" type="text" class="form-control MonthToPay" name="MonthToPay" value="<?php echo $totalPremium*0.1;?>"></td>
                </tr>
              <?php 
              $insuredCount++; }?>
              </table>
            </form>
          </div>
        </div>
        <div class="prorate-enddate-wrapper">
                <div class="proratedate-wrapper">
                    <p>Prorate Date</p>
                    <input type="text" name="proratedate[]" class="input-no-border useDatePicker datepicker-proratedate" value="" size="7">
                </div>
                <div class="enddate-wrapper">
                    <p>End Date</p>
                    <input type="text" name="enddate[]" class="input-no-border useDatePicker datepicker-enddate" value="" size="7">
                </div>            
        </div>
        </div>
        
        
        
      </div><!-- sectionPanel_Right END -->
      
<div style="display: none;" class="premium-calculation-wrapper">

<?php 

//$footerFunctions = array("scriptHealthRateup");
//print_r($policyInfo);

function clean($string) {
   $string = str_replace(' ', '', $string);

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

//$insuredInfo = getHealthSingleInsured($policyInfo['id']);
$insuredLists = getHealthInsuredLists($policyInfo['id']);
//echo '<br>';
//print_r($insuredLists);
$totalPremium = 0;
foreach($insuredLists as $inLists){
    $totalPremium+= $inLists['premium'];
}

$policyCycle = getPayCycleLists();
//print_r($policyCycle);
foreach($policyCycle as $keyCycle => $valCycle){
    if($keyCycle == $policyInfo['idpaycycle'])
    $policyType = $valCycle;
}

$policyCountry = getCountryLists();
//print_r($policyCycle);
foreach($policyCountry as $keyCountry => $valCountry){
    if($keyCountry == $policyInfo['idcountry'])
    $insuredCountry = $valCountry;
}

$PolicyCoverage = getPolicyCoverages($policyInfo['idplan']);
//print_r($PolicyCoverage);
foreach($PolicyCoverage as $keyCoverage => $valCoverage){
    if($keyCoverage == $policyInfo['idcoverage'])
    $totalCoverage = $valCoverage;
}

$PolicyDeductible = getPolicyDeductibles($policyInfo['idcoverage']);
//print_r($PolicyDeductible);
foreach($PolicyDeductible as $keyDeductible => $valDeductible){
    if($valDeductible['id'] == $policyInfo['iddeductible'])
    $totalDeductible = clean($valDeductible['deductible']);
}

$policyPlan = $policyInfo['idplan'];
if($policyInfo['premium_zone'] == 'world'){$premiumZone = 'other';}
else{$premiumZone = $policyInfo['premium_zone'];}
$premiumZone;

if($policyPlan != 1){
$sql="SELECT * FROM rate_table WHERE plan ='$policyPlan' AND coverage ='$totalCoverage' AND deductible ='$totalDeductible' AND rate_country ='$premiumZone'";
$rateData = $db->select($sql);
//echo '<br>';
//print_r($rateData);
foreach($rateData as $rData){
    if($rData['age'] == '0-10'){
        $premium1 = $rData['premium'];
    }elseif($rData['age'] == '11-17'){
        $premium2 = $rData['premium'];
    }elseif($rData['age'] == '18-29'){
        $premium3 = $rData['premium'];
    }elseif($rData['age'] == '30-39'){
        $premium4 = $rData['premium'];
    }elseif($rData['age'] == '40-49'){
        $premium5 = $rData['premium'];
    }elseif($rData['age'] == '50-59'){
        $premium6 = $rData['premium'];
    }elseif($rData['age'] == '60-64'){
        $premium7 = $rData['premium'];
    }elseif($rData['age'] == '65-69'){
        $premium8 = $rData['premium'];
    }
}


?>
<div class="content_section">
<div class="content_section_aside">
<div class="table_overlay">
<form method="post" action="" onsubmit="return calculate_premium_form_submit()" id="form_calculate_premium">
  <table class="tableContent tableNothover">
    <tr>
        <th class="mediumcontrolform">Name</th>
        <th class="smcontrolform">DOB</th>
        <th class="mediumcontrolform">Age</th>
        <th class="mediumcontrolform">Effective Date</th>
        <th class="mediumcontrolform">Base Premium</th>
        <th class="mediumcontrolform">Premium</th>
    </tr>
  <?php $insuredCount = 1; foreach($insuredLists as $inLists){
    $sql_rate="SELECT * FROM rateup WHERE idinsured ='".$inLists['id']."'";
    $rateupData = $db->select($sql_rate);
    //print_r($rateupData);
    if($rateupData){
        $percentData = 0;
        $amountData = 0;
        $amountDataStudentUs = 0;
        
        foreach($rateupData as $rupData){
            $sql_rateType="SELECT * FROM rateuptypes WHERE id ='".$rupData['idrateuptype']."'";
            $rateupTypeData = $db->select($sql_rateType);
            if($rateupTypeData){
                foreach($rateupTypeData as $ruptypeData){
                    if($ruptypeData['rateuppercent'] != 0){$percentData += $ruptypeData['rateuppercent'];}
                    if($ruptypeData['rateupamount'] != 0){
                        if($ruptypeData['id'] == 9 || $ruptypeData['id'] == 20 || $ruptypeData['id'] == 22){
                            $amountDataStudentUs += $ruptypeData['rateupamount'];
                        }else{
                            $amountData += $ruptypeData['rateupamount'];
                        }
                    }
                }
            }
        }
    }else{
        $percentData = 0;
        $amountData = 0;
        $amountDataStudentUs = 0;
    }
    
    ?>
    <tr class="insured-data">
      <td style="display: none;" class="smcontrolform"><input id="insuredId" type="hidden" readonly="readonly" disabled="disabled" class="form-control" name="insuredId" value="<?php echo $inLists['id'];?>"></td>
      <td class="bigcontrolform"><input id="insuredName" type="text" class="form-control" name="insuredName" value="<?php echo $inLists['first_name'].' '.$inLists['last_name'];?>"></td>
      <td class="mediumcontrolform"><input id="insuredDob" type="text" class="form-control" name="insuredDob" value="<?php echo dateFormFormat($inLists['dob']);?>"></td>
      <td class="smcontrolform"><input id="insuredAge" type="text" class="form-control" name="insuredAge" value="<?php echo $inLists['age'];?>"></td>
      <td class="mediumcontrolform"><input id="insuredEffectiveDate" type="text" class="form-control" name="insuredEffectiveDate" value="<?php echo dateFormFormat($inLists['effectivedate']);?>"></td>
      <!-- Base Premium Start -->
      <?php if($inLists['age'] < 11){
        $basePremium = $premium1;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;} 
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 10 && $inLists['age'] < 18){
        $basePremium = $premium2;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 17 && $inLists['age'] < 30){
        $basePremium = $premium3;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2); 
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 40){
        $basePremium = $premium4;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 50){
        $basePremium = $premium5;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 60){
        $basePremium = $premium6;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 59 && $inLists['age'] < 65){
        $basePremium = $premium7;
        //if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 64 && $inLists['age'] < 70){
        $basePremium = $premium8;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }?>
          
      <!-- Premium Start -->
      <?php if($inLists['age'] < 11){
        $basePremium = $premium1;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 10 && $inLists['age'] < 18){
        $basePremium = $premium2;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 17 && $inLists['age'] < 30){
        $basePremium = $premium3;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 40){
        $basePremium = $premium4;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2); 
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 50){
        $basePremium = $premium5;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 60){
        $basePremium = $premium6;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 59 && $inLists['age'] < 65){
        $basePremium = $premium7;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 64 && $inLists['age'] < 70){
        $basePremium = $premium8;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2); 
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }?>
    </tr>
  <?php $insuredCount++; }?>
  </table>
</form>
</div><!-- table_overlay END -->
</div><!-- END content_section_aside -->





</div>
<div class="clearfix"></div>

<?php }else{
    
$sqlMundial="SELECT * FROM rate_table_mundial WHERE plan ='$policyPlan' AND coverage ='$totalCoverage' AND deductible ='$totalDeductible' AND rate_country ='$premiumZone'";
$rateDataMundial = $db->select($sqlMundial);
//echo '<br>';
//echo $totalDeductible;
//print_r($rateDataMundial);
foreach($rateDataMundial as $rMunData){
    if($rMunData['age'] == '18-24'){
        $premium1 = $rMunData['premium'];
    }elseif($rMunData['age'] == '25-29'){
        $premium2 = $rMunData['premium'];
    }elseif($rMunData['age'] == '30-34'){
        $premium3 = $rMunData['premium'];
    }elseif($rMunData['age'] == '35-39'){
        $premium4 = $rMunData['premium'];
    }elseif($rMunData['age'] == '40-44'){
        $premium5 = $rMunData['premium'];
    }elseif($rMunData['age'] == '45-49'){
        $premium6 = $rMunData['premium'];
    }elseif($rMunData['age'] == '50-54'){
        $premium7 = $rMunData['premium'];
    }elseif($rMunData['age'] == '55-59'){
        $premium8 = $rMunData['premium'];
    }elseif($rMunData['age'] == '1dependent'){
        $premium9 = $rMunData['premium'];
    }elseif($rMunData['age'] == '2dependents'){
        $premium10 = $rMunData['premium'];
    }elseif($rMunData['age'] == '3plusdependent'){
        $premium11 = $rMunData['premium'];
    }elseif($rMunData['age'] == '60'){
        $premium12 = $rMunData['premium'];
    }elseif($rMunData['age'] == '61'){
        $premium13 = $rMunData['premium'];
    }elseif($rMunData['age'] == '62'){
        $premium14 = $rMunData['premium'];
    }elseif($rMunData['age'] == '63'){
        $premium15 = $rMunData['premium'];
    }elseif($rMunData['age'] == '64'){
        $premium16 = $rMunData['premium'];
    }elseif($rMunData['age'] == '65'){
        $premium17 = $rMunData['premium'];
    }elseif($rMunData['age'] == '66'){
        $premium18 = $rMunData['premium'];
    }elseif($rMunData['age'] == '67'){
        $premium19 = $rMunData['premium'];
    }elseif($rMunData['age'] == '68'){
        $premium20 = $rMunData['premium'];
    }elseif($rMunData['age'] == '69'){
        $premium21 = $rMunData['premium'];
    }
}


$Count = 1;
foreach($insuredLists as $inListsD){
    if($inListsD['age'] < 23 && $inListsD['studentus'] != ''){
        $dependentCountStudent += $Count;
    }
    if($inListsD['age'] < 19){
        $dependentCount += $Count;
    }
}
$totalDependentCount = $dependentCountStudent + $dependentCount;
?>

<div class="content_section">
<div class="content_section_aside">
<div class="table_overlay">
<form method="post" action="" onsubmit="return calculate_premium_form_submit()" id="form_calculate_premium">
  <table class="tableContent tableNothover">
    <tr>
        <th class="mediumcontrolform">Name</th>
        <th class="smcontrolform">DOB</th>
        <th class="mediumcontrolform">Age</th>
        <th class="mediumcontrolform">Effective Date</th>
        <th class="mediumcontrolform">Base Premium</th>
        <th class="mediumcontrolform">Premium</th>
    </tr>
  <?php $insuredCount = 1; foreach($insuredLists as $inLists){
    $sql_rate="SELECT * FROM rateup WHERE idinsured ='".$inLists['id']."'";
    $rateupData = $db->select($sql_rate);
    //print_r($rateupData);
    if($rateupData){
        foreach($rateupData as $rupData){
            $sql_rateType="SELECT * FROM rateuptypes WHERE id ='".$rupData['idrateuptype']."'";
            $rateupTypeData = $db->select($sql_rateType);
            if($rateupTypeData){
                foreach($rateupTypeData as $ruptypeData){
                    if($ruptypeData['rateuppercent'] != 0){$percentData += $ruptypeData['rateuppercent'];}
                    if($ruptypeData['rateupamount'] != 0){
                        if($ruptypeData['id'] == 9 || $ruptypeData['id'] == 20 || $ruptypeData['id'] == 22){
                            $amountDataStudentUs += $ruptypeData['rateupamount'];
                        }else{
                            $amountData += $ruptypeData['rateupamount'];
                        }
                    }
                }
            }
        }
    }else{
        $percentData = 0;
        $amountData = 0;
        $amountDataStudentUs = 0;
    }
    
    ?>
    <tr class="insured-data">
      <td style="display: none;" class="smcontrolform"><input id="insuredId" type="hidden" readonly="readonly" disabled="disabled" class="form-control" name="insuredId" value="<?php echo $inLists['id'];?>"></td>
      <td class="bigcontrolform"><input id="insuredName" type="text" class="form-control" name="insuredName" value="<?php echo $inLists['first_name'].' '.$inLists['last_name'];?>"></td>
      <td class="mediumcontrolform"><input id="insuredDob" type="text" class="form-control" name="insuredDob" value="<?php echo dateFormFormat($inLists['dob']);?>"></td>
      <td class="smcontrolform"><input id="insuredAge" type="text" class="form-control" name="insuredAge" value="<?php echo $inLists['age'];?>"></td>
      <td class="mediumcontrolform"><input id="insuredEffectiveDate" type="text" class="form-control" name="insuredEffectiveDate" value="<?php echo dateFormFormat($inLists['effectivedate']);?>"></td>
      <!-- Base Premium Start -->
      <?php if($inLists['age'] > 17 && $inLists['age'] < 25){
        $basePremium = $premium1;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;} 
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 24 && $inLists['age'] < 30){
        $basePremium = $premium2;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 35){
        $basePremium = $premium3;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2); 
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 34 && $inLists['age'] < 40){
        $basePremium = $premium4;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 45){
        $basePremium = $premium5;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 44 && $inLists['age'] < 50){
        $basePremium = $premium6;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 55){
        $basePremium = $premium7;
        //if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 54 && $inLists['age'] < 60){
        $basePremium = $premium8;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 60){
        $basePremium = $premium12;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 61){
        $basePremium = $premium13;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 62){
        $basePremium = $premium14;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 63){
        $basePremium = $premium15;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 64){
        $basePremium = $premium16;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 65){
        $basePremium = $premium17;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 66){
        $basePremium = $premium18;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 67){
        $basePremium = $premium19;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 68){
        $basePremium = $premium20;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 69){
        $basePremium = $premium21;
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] < 19){
        if($totalDependentCount == 1){$basePremium = $premium9;}
        if($totalDependentCount == 2){$basePremium = $premium10;}
        if($totalDependentCount > 3){$basePremium = $premium11;}
        
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] < 23 && $inLists['studentus'] != ''){
        if($totalDependentCount == 1){$basePremium = $premium9;}
        if($totalDependentCount == 2){$basePremium = $premium10;}
        if($totalDependentCount > 3){$basePremium = $premium11;}
        
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
      <?php }?>    
      <!-- Premium Start -->
      <?php if($inLists['age'] > 17 && $inLists['age'] < 25 && $inLists['studentus'] == ''){
        $basePremium = $premium1;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 24 && $inLists['age'] < 30){
        $basePremium = $premium2;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 35){
        $basePremium = $premium3;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 34 && $inLists['age'] < 40){
        $basePremium = $premium4;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2); 
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 45){
        $basePremium = $premium5;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 44 && $inLists['age'] < 50){
        $basePremium = $premium6;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);  
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 55){
        $basePremium = $premium7;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] > 54 && $inLists['age'] < 60){
        $basePremium = $premium8;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2); 
      ?>
      <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 60){
        $basePremium = $premium12;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 61){
        $basePremium = $premium13;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 62){
        $basePremium = $premium14;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 63){
        $basePremium = $premium15;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 64){
        $basePremium = $premium16;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 65){
        $basePremium = $premium17;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 66){
        $basePremium = $premium18;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 67){
        $basePremium = $premium19;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 68){
        $basePremium = $premium20;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] == 69){
        $basePremium = $premium21;
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] < 19){
        if($totalDependentCount == 1){$basePremium = $premium9;}
        if($totalDependentCount == 2){$basePremium = $premium10;}
        if($totalDependentCount > 3){$basePremium = $premium11;}
        
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }elseif($inLists['age'] < 23 && $inLists['studentus'] != ''){
        if($totalDependentCount == 1){$basePremium = $premium9;}
        if($totalDependentCount == 2){$basePremium = $premium10;}
        if($totalDependentCount > 3){$basePremium = $premium11;}
        
        if($inLists['smoker'] == 1){$basePremium *= 1.1;}
        if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
        if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
        if($amountData && $amountData != 0){$basePremium += $amountData;}
        if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
        $basePremium = round($basePremium,2);
      ?>
      <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
      <?php }?>
    </tr>
  <?php $insuredCount++; }?>
  </table>
</form>
</div><!-- table_overlay END -->
</div><!-- END content_section_aside -->





</div>
<div class="clearfix"></div>
   
<?php }?>

<script type="text/javascript">
        
    function form_submit()
    {
        $('#form_calculate_premium').submit();
        
    }
    
    
</script>
</div>
