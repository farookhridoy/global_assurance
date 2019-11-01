<?php 
$error_message = state('err') ? state('err') : '';
$success_message = state('msg') ? state('msg') : '';
?>
      <div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li>Delete Policy</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          
          <script type="text/javascript">
          
          function pdelete_confirmation(){
            var result = confirm("Are you sure to delete this policy?");
            if(result){
                $('#frm_delete_policy').submit();
            }
          }
          </script>

          <h1 class="page-titlename">Delete Policy</h1>
          <?php if($error_message || $success_message){ ?>
          <div class="content_section_aside">
          <div class="col-md-12">
          <?php if($error_message){ ?>
          <p class="err"><?php echo $error_message; ?></p>
          <?php }elseif($success_message){ ?> 
          <p class="msg"><?php echo $success_message; ?></p>
          <?php } ?> 
          </div>
          </div>
          <?php } ?> 
          
          <div class="content_section_aside">
           <form method="post" id="frm_delete_policy" action="<?php echo THE_URL."main/delete-policy"; ?>">
           <input type="hidden" name="delete_submit" value="1"/>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group-section">
                <label class="formheading">Policy Number</label>
                 <select class="form-control" name="policy_number" id="policy_number" onchange="$('#policy_uid').val($(this).val())">
                          <option value="0" selected="selected">&nbsp;</option>
                          <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){$selected_text = '';   echo '<option value="'.$hp_value['id'].'" '.$selected_text.'>'.$hp_value['policynumber'].'</option>';}} ?>
                 </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group-section">
                  <label class="formheading">UID</label>
                  <input type="text" class="form-control" name="policy_uid" id="policy_uid"/>
                </div>
              </div>
              <div class="col-md-4">
                <div class="adcust_plicy_delate">
                  <button class="btn btn-primary bgorange" type="button" onclick="pdelete_confirmation()">Delete</button>
                </div>
              </div>
            </div>
            </form>
          </div><!-- content_section_aside END -->


          <div class="clearfix"></div>
          <div class="row">    
            <div class="col-md-12">          
              <div class="content_section_aside">
                <h4 class="content_section_aside_header">Audit</h4> 
                <div class="activitylist">
                  <ul>
                      <?php echo getAreaActivityLists('delete_policy'); ?>
                   </ul>
                </div>
              </div><!-- content_section_aside END -->
            </div>
          </div>

        </div>
      </div><!-- sectionPanel_Right END -->