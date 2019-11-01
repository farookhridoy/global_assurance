<?php 
global $footerFunctions,$policyInfo;
$footerFunctions = array("scriptDuplicatePolicy");
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Open Policy Record</a></li>
              <li>Duplicate Form</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          
          <h1 class="page-titlename">Duplicate Form</h1>
          <!--<div class="title_bar">
            <button class="btn btn-primary" type="button">Save</button>
            <button class="btn btn-primary bgwhite" type="button" style="text-transform: none"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</button>
            <div class="btn btn-primary bgorange" ><a href="">Delete</a></div>
          </div>-->

          <div class="content_section_aside">
            <div class="row">
              

              <div class="col-md-8">
                  <div class="contryin_life">
                    <div class="row">
                    <div class="col-md-12 "><div id="ajax_progress_block" style="display: none"><img src="<?php echo MEDIA_IMAGES; ?>ajax-loader.gif" alt="loading..."/>&nbsp;<label>Duplicating policy please wait...</label></div></div>
                    </div>
                    <div class="row">
                      <div class="col-md-5 ">
                        <label class="formheading">Policy Number</label>
                        <span class="form-select">
                        <select class="form-control" name="policy_number" id="policy_number">
                          <option value="0">&nbsp;</option>
                          <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){$selected_text = ($hp_value['id'] == $policyInfo['id']) ? 'selected="selected"': '';   echo '<option value="'.$hp_value['id'].'" '.$selected_text.'>'.$hp_value['policynumber'].'</option>';}} ?>
                        </select>
                        </span>
                      </div>
                      <div class="col-md-5 ">
                        <label class="formheading">New Policy Number</label>
                        <input type="text" class="form-control" name="new_policy_num" id="new_policy_num" />
                      </div>
                      <div class="col-md-2 ">
                        <label class="formheading">&nbsp;</label>
                        <button class="btn btn-primary bgorange" onclick="duplicatePolicy()">Duplicate</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- content_section_aside END -->



          <div class="content_section_aside">
                  <h4 class="content_section_aside_header">Audit</h4> 
                  <div class="activitylist">
                    <ul>
                      <li><span class="activitydesc">Test data 9/18/2018 <span class="timelist"> 1:20:36 PM</span></span></li>
                      <li><span class="activitydesc">Test data 9/18/2018 <span class="timelist"> 1:20:33 PM</span></span></li>
                      <li><span class="activitydesc">Test data 9/18/2018 <span class="timelist"> 1:20:30 PM</span></span></li>
                    </ul>
                  </div>
                </div>


         


          </div>
          <div class="clearfix"></div>


</div><!-- sectionPanel_Right END -->