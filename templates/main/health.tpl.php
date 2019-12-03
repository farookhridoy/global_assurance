<?php 
if($_REQUEST['pr']){
    $error_message = 'Permission error! You are not allowed to perform this action.';
}
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li>Health</li>
            </ul>
          </div><!-- page-breadcrumbs END -->

          <div class="content_section_aside healthdeshbord_content bgNone paddingNone marginbotton_none padding-topNone">
            
            <?php if($error_message){ ?>
            <div class="row">
            <div class="col-md-12">
            <p class="err"><?php echo $error_message; ?></p>
            </div>
            </div>
            <?php } ?>
            <div class="row">
              <div class="home_commiss_searchperent">
                <div class="col-md-5">
                  <div class="hometop_search">
                    
                    <div class="healthpolicy_button">
                      <a href="#" class="btn btn-primary">Search by Name</a>
                      <a href="<?php echo THE_URL."main/health-new"; ?>" class="btn btn-primary bgorange">New Health Policy</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="topcommiss_button">
                    <ul>
                      <li><a href="#"><span><i class="far fa-handshake"></i></span><div>Commissions</div></a></li>
                      <li><a href="#"><span><i class="fas fa-plus"></i></span><div>Add Custom Policy Number</div></a></li>
                      <li><a href="#"><span><i class="far fa-sticky-note"></i></span><div>Reports</div></a></li>
                      <li><a href="<?php echo THE_URL."main/delete-policy"; ?>"><span><i class="far fa-trash-alt"></i></span><div>Delete Policy</div></a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="homepolicy_records">
                  <div class="policy_rebox">
                      <label class="formheading">Open Policy Record</label>
                    <div class="form-group">
                      <script type="text/javascript">
                        function redirectPolicy (sel) {
                            var url = sel[sel.selectedIndex].value;
                            window.location = url;
                        }
                      </script>
                      <div class="">
                        <select class="form-control mySelect2" onchange="redirectPolicy(this);">
                          <option value="0">&nbsp;</option>
                          <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){echo '<option value="'. THE_URL.'main/health-edit/'.$hp_value['id'].'">'.$hp_value['policynumber'].'</option>';}} ?>
                        </select>
                        <span class="iconon_control"><i class="fas fa-angle-down"></i></span>
                      </div>
                    </div>
                  </div><!-- END policy_rebox -->
                  <div class="policy_rebox">
                      <label class="formheading">Open Payment Form</label>
                    <div class="form-group">
                      <script type="text/javascript">
                        function redirectPayment (sel) {
                            var url = sel[sel.selectedIndex].value;
                            window.location = url;
                        }
                      </script>
                      <div class="">
                        <select class="form-control mySelect2" onchange="redirectPolicy(this);">
                          <option value="0">&nbsp;</option>                        
                          <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){echo '<option value="'. THE_URL.'main/payments-form/'.$hp_value['id'].'">'.$hp_value['policynumber'].'</option>';}} ?>
                        </select>
                        <span class="iconon_control"><i class="fas fa-angle-down"></i></span>
                      </div>
                    </div>
                  </div><!-- END policy_rebox -->
                  <div class="policy_rebox">
                      <label class="formheading">Open Renewal Form</label>
                    <div class="form-group">
                      <script type="text/javascript">
                        function redirectRenewal (sel) {
                            var url = sel[sel.selectedIndex].value;
                            window.location = url;
                        }
                      </script>
                      <div class="icongroup">
                        <select class="form-control" onchange="">
                          <option value="open_renewals_form.html">EQI755289BR</option>                        
                          <option value="open_renewals_form.html">EQI755NHABS</option>
                        </select>
                        <span class="iconon_control"><i class="fas fa-angle-down"></i></span>
                      </div>
                    </div>
                  </div><!-- END policy_rebox -->
                </div>
              </div>
              <div class="col-md-12">
                <div class="pending_contorl_perent">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="pending_contorl">
                        <h5>Expired Renewals</h5>
                        <div class="pending_qt purpal_bold"> 05 </div>
                        <div class="pending_button">
                          <a href="#" class="btn btn-primary bgnaviblue">Pending Renewals Controls</a>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="pending_contorl_two">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="pending_contorl">
                              <h5>Expired Monthly<div>Payment</div></h5>
                              <div class="pending_qt blue_bold"> 05 </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="pending_contorl">
                              <h5>Expired Semi Annual<div>Payment</div></h5>
                              <div class="pending_qt orange_bold"> 09 </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="pending_contorl">
                              <h5>Expired Quarterly<div>Payment</div></h5>
                              <div class="pending_qt green_bold"> 08 </div>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="pending_contorl">
                              <h5>Expired Annual<div>Payment</div></h5>
                              <div class="pending_qt yellow_bold"> 15 </div>
                            </div>
                          </div>
                          <div class="col-md-12">                            
                            <div class="pending_button">
                              <a href="#" class="btn btn-primary bgnaviblue">Pending Payment Controls</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="paidcommbtn text-center">
                  <a href="#" class="btn btn-primary">Paid Commisions Control</a> 
                </div>
              </div>
              <div class="col-md-12">
                <div class="policy_writt_main">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="titleside_writt">
                        <h4>Policy in Underwritting</h4>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="titleside_buttons">
                       
                        <a href="#" class="btn btn-primary">Pending Underwritting control</a> 
                      </div> 
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="policydays">
                             <div class="pending_qt blue_bold"> 05 </div>
                             <div class="policydays_qt">3 to 5 Days</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="policydays">
                             <div class="pending_qt blue_bold"> 05 </div>
                             <div class="policydays_qt">Over 7 Days</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="policydays">
                             <div class="pending_qt blue_bold"> 05 </div>
                             <div class="policydays_qt">Expired Delivery Req</div>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="policydays">
                             <div class="pending_qt blue_bold"> 05 </div>
                             <div class="policydays_qt">Expired Riders</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="bottom_timeside">
                  <ul>
                    <li>After 30 minutes of inactivity the DB will close. </li>
                    <li>00 : 28 : 59</li>
                    <li>02 : 25 : 00 PM </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- sectionPanel_Right END -->