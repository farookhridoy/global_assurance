<?php global $userRoles,$footerFunctions; 
$footerFunctions = array("scriptUserNew");
if(state('err')){
    $error_message = state('err');
    state('err','');
}
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Users</a></li>
              <li>New User</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          
          <?php if($error_message){ ?>
            <div class="row">
            <div class="col-md-12">
            <p class="err"><?php echo $error_message; ?></p>
            <p><br /><br /></p>
            </div>
            </div>
            <?php } ?>

          <h1 class="page-titlename">Add User</h1>
          <form method="post" action="" onsubmit="return user_add_form_submit()">
          <input type="hidden" name="user_number" id="user_number" value=""/> 
          <input type="hidden" name="formSubmitted" value="1"/>
          <div class="title_bar">
            <button type="submit" class="btn btn-primary" type="button">Save</button>
          </div>

          <!--<div class="content_section_aside">
            <div class="row">
              <div class="col-md-8">
                <div class="paymode_status widthauto">
                  <ul>
                    <li><span>Delivery Request Number</span><p>DREQ53343</p></li>
                  </ul>
                </div>
              </div>

              <div class="col-md-4">
                  <div class="contryin_life">
                    <div class="row">
                      <div class="col-md-12 col-lg-6">
                        <label class="formheading">Date Sent</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-12 col-lg-6">
                        <label class="formheading">Status</label>
                        
                        <span class="form-select">
                          <select class="form-control">
                            <option>Pending</option>
                            <option>Received</option>
                          </select>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div> --><!-- content_section_aside END -->


                <div class="content_section_aside">
                  <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">User Name</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="text" class="form-control" name="user_name" id="user_name" required />
                    </div>
                  </div>
                </div>
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">First Name</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="text" class="form-control" name="first_name" id="first_name" required />
                    </div>
                  </div>
                  </div>
                  <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Last Name</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="text" class="form-control" name="last_name" id="last_name"  />
                    </div>
                  </div>
                </div>
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Email</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="email" class="form-control" name="email" id="email" autocomplete="off" required />
                    </div>
                  </div>
                </div>
                
                
                 <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Password</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="password" class="form-control" name="password" id="password" autocomplete="off"  />
                    </div>
                  </div>
                </div>
                
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Password Repeat</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="password" class="form-control" name="password_repeat" id="password_repeat" autocomplete="off"  />
                    </div>
                  </div>
                </div>
                
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Role</label></div>
                    <div class="col-md-12 col-lg-5">
                      <span class="form-select">
                          <select class="form-control" name="user_role" required>
                            <option value="0">&nbsp;</option>
                            <?php if($userRoles){foreach($userRoles as $r_key => $r_value){echo '<option value="'.$r_key.'">'.$r_value.'</option>';}} ?>
                          </select>
                        </span>
                    </div>
                  </div>
                </div>
                
                
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Status</label></div>
                    <div class="col-md-12 col-lg-5">
                      <span class="form-select">
                          <select class="form-control" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                          </select>
                        </span>
                    </div>
                  </div>
                </div>
                </div>
          </div>
          <div class="clearfix"></div>
          </form>

</div>