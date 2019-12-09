<?php global $datePicker,$footerFunctions;  $datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$footerFunctions = array("scriptHealthNew");
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li>Health Policy</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          
          
          
          <h1 class="page-titlename">Health Policy</h1>
          <div class="title_bar">
            <div id="ajax_progress" style="display: none;"><img src="<?php echo MEDIA_IMAGES; ?>ajax-loader.gif" alt="loading..."/>&nbsp;<label>Policy saving please wait...</label></div>
            <div class="btn btn-primary bgwhite"><a href="javascript:void(0);"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</a></div>
            <button class="btn btn-primary bgorange" onclick="health_form_submit()">Save</button>
            <!--<button class="btn btn-primary bgorange" onclick="policy_files_upload()">test</button>-->
          </div>
          <form method="post" action="" id="frm_new_health" onsubmit="return health_form_submit()" enctype="multipart/form-data">
          <div class="content_section_aside">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Policy Number</label>
                  <input type="text" class="form-control" name="policy_number" id="policy_number"/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Status</label>
                  <span class="form-select">
                    <select class="form-control" name="policy_status" id="policy_status">
                      <option value="0"></option>
                      <?php $statusList = getPolicyStatus(); if($statusList){foreach($statusList as $st_key => $st_vl){echo '<option value="'.$st_key.'">'.$st_vl.'</option>';}} ?>
                      
                      
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
                          <?php $carrier = getPolicyCarrier(); if($carrier){foreach($carrier as $c_cr => $c_vl){$selected_text = ('Claria' == $c_vl) ? 'selected="selected"': '';  echo '<option value="'.$c_cr.'" '.$selected_text.'>'.$c_vl.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Effective Date</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="effective_date" id="effective_date"/>
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
                          <?php $planList = getPolicyPlanLists(1); if($planList){foreach($planList as $p_key => $p_value){echo '<option value="'.$p_key.'">'.$p_value.'</option>';}} ?>
                          
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
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Group ID</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="group_id"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">RFID</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="policy_rfid" id="policy_rfid"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">RFID Clams</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="rfid_clams" id="rfid_clams"/>
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
                        <input type="checkbox" name="dominicana" id="dominicanaLabel" value="1"/>
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
                      <input type="text" class="form-control" name="address_l1"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Address L2</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="address_l2"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">City</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_city"/>
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
                          <?php $countries = getCountryLists(); if($countries){foreach($countries as $c_key => $c_value){echo '<option value="'.$c_key.'">'.$c_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Phone</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_phone" />
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Work Phone</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_work_phone"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Celphone</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_cell_phone"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Email</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="contact_email"/>
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
                          <?php $rateYears = getRateYearLists(); if($rateYears){foreach($rateYears as $y_key => $y_value){echo '<option value="'.$y_key.'">'.$y_value.'</option>';}} ?>
                          
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Start</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="payment_start" id="payment_start"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">End</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="payment_end" id="payment_end"/>
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
                          <?php $payCycles = getPayCycleLists(); if($payCycles){foreach($payCycles as $pc_key => $pc_value){echo '<option value="'.$pc_key.'">'.$pc_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Date Due</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="date_due" id="date_due" value="" />
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Group Discount</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="group_discount"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Discount</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" name="policy_discount"/>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Policy fee amount</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="100" name="policy_fee"/>
                    </div>
                  </div>
                </div>


              </div><!-- content_section_aside END -->
            </div>




            <div class="col-md-6">
              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Agents</h4>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-3"><label class="formheading labelSide">Agent Level 1</label></div>
                    <div class="col-md-12 col-lg-9">
                      <div class="row rowsm">
                        <div class="col-md-6">
                          <span class="">
                            <select class="policy_agents form-control mySelect2" name="agent_level1" id="agent_level1" data-id="1">
                              <option value="0">&nbsp;</option>
                               <?php $agents = getAgentLists("health",1);  if($agents){foreach($agents as $ag_key => $ag_value){echo '<option value="'.$ag_value['id'].'">'.$ag_value['name'].'</option>';}} ?>  
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
                          <span class="">
                            <select class="policy_agents form-control mySelect2" name="agent_level2" id="agent_level2" data-id="2">
                            <option value="0">&nbsp;</option>
                            <!--<option value="1234">Test Agent 2</option> -->
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
                          <span class="">
                            <select class="policy_agents form-control mySelect2" name="agent_level3" id="agent_level3" data-id="3">
                              <option value="0">&nbsp;</option>
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
                          <span class="">
                            <select class="policy_agents form-control mySelect2" name="agent_level4" id="agent_level4" data-id="4">
                              <option value="0">&nbsp;</option>
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
                          <span class="">
                            <select class="policy_agents form-control mySelect2" name="agent_level5" id="agent_level5" data-id="5">
                              <option value="0">&nbsp;</option>
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
                          <?php $doctors = getDoctorLists(); if($doctors){foreach($doctors as $d_key => $d_value){echo '<option value="'.$d_key.'">'.$d_value.'</option>';}} ?>
                        </select>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-6">
                      <label class="formheading labelSide">Date Received</label>
                      <input type="text" class="form-control" name="date_received" id="date_received" />
                    </div>
                    <div class="col-md-6">
                      <label class="formheading labelSide">Date Approved</label>
                      <input type="text" class="form-control" name="date_approved" id="date_approved" />
                    </div>
                  </div>
                </div>

              </div><!-- content_section_aside END -->

              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Approval Sheet</h4>
                <div class="form-group-row">
                  <div class="checkbxs">
                    <input type="checkbox" name="approved_standard"  id="approvedstand" value="1"/>
                    <label for="approvedstand">Approved Standrad</label>
                  </div>
                </div>
              </div><!-- content_section_aside END --> 

              <div class="content_section_aside bgNone paddingNone paddintTopNone">
                <div class="checkapproval">
                  <ul>
                    <li><div class="checkbxs">
                        <input type="checkbox" name="death_main_insured" id="deathmainLabel" value="1"/><label for="deathmainLabel">Death - Main Insured</label>
                      </div></li>
                    <li><div class="checkbxs">
                        <input type="checkbox" name="is_spanish" id="spanishLabel" value="1"/><label for="spanishLabel">Spanish</label>
                      </div></li>
                    <li><div class="radioset">
                        <input type="radio" name="premium_zone" id="maxicoLabel" value="maxico"/><label for="maxicoLabel">Mexico</label>
                      </div></li>
                    <!--<li><div class="checkbxs">
                        <input type="checkbox" name="approved" id="dominiLabel"><label for="dominiLabel">Domini</label>
                      </div></li>-->
                    <li><div class="checkbxs">
                        <input type="checkbox" name="claria_express" id="clariaexpLabel" value="1"/><label for="clariaexpLabel">Claria Express</label>
                      </div></li>
                    <!--<li><div class="checkbxs">
                        <input type="checkbox" name="add_percent" id="addLabel" hidden="" value="1"/><label for="addLabel">Add 25%</label>
                      </div></li>-->
                    <li><div class="radioset">
                        <input type="radio" name="premium_zone" id="worldLabel" value="world"/><label for="worldLabel">World</label>
                      </div></li>
                    <li><div class="radioset">
                        <input type="radio" name="premium_zone" id="srilankaLabel" value="srilanka"/><label for="srilankaLabel">Sri Lanka</label>
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
                  <td style="display: none;"><input type="hidden" name="insured[]" value=""/><input type="checkbox" name="interview[]" value="1"/></td>
                  <td><input type="text" name="order[]" class="input-no-border order_column" value="1" size="5"/></td>
                  <td><input type="text" name="first_name[]" class="input-no-border insuredProcess" size="6"/></td>
                  <td><input type="text" name="last_name[]" class="input-no-border insuredProcess" size="6"/></td>
                  <td><input type="text" name="dob[]" class="input-no-border useDatePicker datepicker-dob" size="7"/></td>
                  <td><select class="form-control input-no-border insuredProcess insuredRelation" name="relation[]">
                      <option>&nbsp;</option>
                      <?php 
                      $realtions = getRelationLists();  if($realtions){foreach($realtions as $r_key => $r_value){echo '<option value="'.$r_key.'">'.$r_value.'</option>';}} ?>  
                      </select>
                  </td>
                  <td><input type="text" name="effective[]" class="input-no-border useDatePicker datepicker-dob  align-left"  size="12"/></td>
                  <td><input type="text" name="age[]" class="input-no-border insured-age" size="6"/></td>
                   <td><select class="form-control input-no-border " name="gender[]">
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
                      <input type="checkbox" name="ridermater[]" id="ridermater" value="1" class="insuredProcess"/>
                      <label for="ridermater"></label>
                    </div>
                  </td>-->
                  <!--<td>
                    <div class="checkbxs">
                      <input type="checkbox" name="ridercomp[]" id="ridercomp" value="1" class="insuredProcess"/>
                      <label for="ridercomp"></label>
                    </div>
                  </td>-->
                  <td>
                    <div class="checkbxs">
                      <input type="checkbox" name="activelab[]" id="activelab" value="1" class=""/>
                      <label for="activelab" class=""></label>
                    </div>
                  </td>                  
                  <td><a href="javascript: void(0)" class="detailsLink deleteInsured">Delete</a></td>
                  <td><input type="text" name="ins_inactivate_date[]" class="input-no-border useDatePicker"  size="12"/></td>
                  <td><input type="text" name="ins_email[]" class="input-no-border"  size="12"/></td>
                </tr>
                
 
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
                  <td><input type="text" name="effective[]" class="input-no-border useDatePicker datepicker-dob align-left"  size="12"/></td>
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
                  <td><input type="text" name="ins_inactivate_date[]" class="input-no-border useDatePicker"  size="12"/></td>
                  <td><input type="text" name="ins_email[]" class="input-no-border"  size="12"/></td>
                </tr> 
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
              </div><!-- END content_section_aside -->
            </div>
          </div>  


          <div class="content_section_aside">
            <h4 class="content_section_aside_header">Activity</h4> 
            <div class="activitylist">
              <ul>
               <li><span class="activitydesc">Test Activity <span class="timelist">12:44:38 PM</span></span></li>
               <!--<li><span class="activitydesc">jonathan Changed Foreign Provider to -1 for 542 on 9/18/2013&nbsp; <span class="timelist">1:35:16 PM</span></span></li>
               <li><span class="activitydesc">jonathan Changed Foreign Provider to -1 for 542 on 9/18/2013&nbsp; <span class="timelist">1:44:53 PM</span></span></li>
               <li><span class="activitydesc">jonathan Changed Foreign Provider to 0 for 542 on 9/18/2013&nbsp; <span class="timelist">2:44:38 PM</span></span></li>
               <li><span class="activitydesc">jonathan Changed Provider to Cleveland Clinic Florida for 542 on 9/18/2013&nbsp; <span class="timelist">3:31:26 PM</span></span></li>
               <li><span class="activitydesc">jjonathan Changed Provider to  for 542 on 9/18/2013&nbsp; <span class="timelist">4:16:59 PM</span></span></li>
               <li><span class="activitydesc">ederneys Changed Provider to Cleveland Clinic Florida for 542 on 9/23/2013&nbsp; <span class="timelist">4:48:10 PM</span></span></li>-->
               </ul>
            </div>
          </div>
         </form>
        </div>
        
      </div><!-- sectionPanel_Right END -->