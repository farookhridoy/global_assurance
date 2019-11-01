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
                      

                      <div class="tabl_th">NB</div>

                      <div class="tabl_th">RN</div>
                      <div class="tabl_th">PayBy</div>
                      
                    </div>
                    <div class="tabl_row">
                      <div class="tabl_cell"> Agent Level 1 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level1" id="agent_level1" data-id="1">
                            <option value="0"></option>
                            <?php $agentLists = getAgentLists('health',1); if($agentLists){foreach($agentLists as $al_key => $al_vl){ $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'">'.$al_vl['name'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level1_f_name"  class="form-control" value="" /> </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level1_l_name" class="form-control" value="" /> </div>                                
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level1_nb" class="form-control widthsm" value="" /></div>
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level1_rn" class="form-control widthsm" value="" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level1_pay_by" class="form-control widthsm" value="" /></div>
                      
                    </div>
                    <div class="tabl_row">
                      <div class="tabl_cell"> Agent Level 2 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level2" id="agent_level2" data-id="2">
                            <option value="0"></option>
                            <?php $agentLists = getAgentLists('health',2); if($agentLists){foreach($agentLists as $al_key => $al_vl){ $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'">'.$al_vl['name'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level2_f_name"  class="form-control" value="" /> </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level2_l_name" class="form-control" value="" /> </div>                                
                      

                      <div class="tabl_cell"> <input type="text" id="agent_level2_nb" class="form-control widthsm" value="" /></div>

                      <div class="tabl_cell"> <input type="text" id="agent_level2_rn" class="form-control widthsm" value="" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level2_pay_by" class="form-control widthsm" value="" /></div>
                      
                    </div>
                    <div class="tabl_row">
                      <div class="tabl_cell"> Agent Level 3 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level3" id="agent_level3" data-id="3">
                            <option value="0"></option>
                            <?php $agentLists = getAgentLists('health',3); if($agentLists){foreach($agentLists as $al_key => $al_vl){ $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'">'.$al_vl['name'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level3_f_name"  class="form-control" value="" /> </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level3_l_name" class="form-control" value="" /> </div>                                
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level3_nb" class="form-control widthsm" value="" /></div>
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level3_rn" class="form-control widthsm" value="" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level3_pay_by" class="form-control widthsm" value="" /></div>
                      
                    </div>
                    <div class="tabl_row">
                      <div class="tabl_cell"> Agent Level 4 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level4" id="agent_level4" data-id="4">
                            <option value="0"></option>
                            <?php $agentLists = getAgentLists('health',4); if($agentLists){foreach($agentLists as $al_key => $al_vl){ $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'">'.$al_vl['name'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level4_f_name"  class="form-control" value="" /> </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level4_l_name" class="form-control" value="" /> </div>                                
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level4_nb" class="form-control widthsm" value="" /></div>

                      <div class="tabl_cell"> <input type="text" id="agent_level4_rn" class="form-control widthsm" value="" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level4_pay_by" class="form-control widthsm" value="" /></div>
                      
                    </div>

                    <div class="tabl_row">
                      <div class="tabl_cell"> Agent Level 5 </div>
                      <div class="tabl_cell">                      
                        <span class="form-select">
                          <select class="form-control payment_policy_agents" name="agent_level5" id="agent_level5" data-id="" >
                            <option value="0"></option>
                            <?php $agentLists = getAgentLists('health',5); if($agentLists){foreach($agentLists as $al_key => $al_vl){ $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? 'selected="selected"': '';   echo '<option value="'.$al_vl['id'].'">'.$al_vl['name'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level5_f_name"  class="form-control" value="" /> </div>
                      <div class="tabl_cell"> <input type="text" id="agent_level5_l_name" class="form-control" value="" /> </div>                                
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level5_nb" class="form-control widthsm" value="" /></div>
                      
                      <div class="tabl_cell"> <input type="text" id="agent_level5_rn" class="form-control widthsm" value="" /></div>
                      <div class="tabl_cell"> <input type="text" id="agent_level5_pay_by" class="form-control widthsm" value="" /></div>
                      
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- content_section_aside END -->
      </div>
    </div>

 <form method="post" action="" id="frm_agent_notes" onsubmit="return agent_note_form_submit()" enctype="multipart/form-data">
    
    <div class="content_section_aside">
      <h4 class="content_section_aside_header">Agent Notes</h4>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L1</label></div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="note_1" id="note_1" value="<?php echo $getData['note_1']; ?>">
            <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange" onclick="agent_note_form_submit()">Save</button>
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L2</label></div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="note_2" id="note_2" value="<?php echo $getData['note_2']; ?>">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange" onclick="agent_note_form_submit()">Save</button>
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L3</label></div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="note_3" id="note_3" value="<?php echo $getData['note_3']; ?>">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange" onclick="agent_note_form_submit()">Save</button>
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L4</label></div>
          <div class="col-md-9">
            <input type="text" class="form-control" name="note_4" id="note_4" value="<?php echo $getData['note_4']; ?>">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange" onclick="agent_note_form_submit()">Save</button>
          </div>
        </div>
      </div>

      <div class="form-group-row">
        <div class="row rowsm">
          <div class="col-md-1"><label class="formheading labelSide">L5</label></div>
          <div class="col-md-9">
           <input type="text" class="form-control" name="note_5" id="note_5" value="<?php echo $getData['note_5']; ?>">
          </div>
          <div class="col-md-2">
            <button class="btn btn-primary bgorange" onclick="agent_note_form_submit()">Save</button>
          </div>
        </div>
      </div>

    </div>

</form>

  </div>
</div>

</div>
</div><!-- sectionPanel_Right END -->
