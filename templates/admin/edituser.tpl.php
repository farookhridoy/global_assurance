<?php global $userRoles,$footerFunctions,$userInfo; 
$footerFunctions = array("scriptUserNew");
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="<?php echo THE_URL."admin/manageusers"; ?>">Users</a></li>
              <li>Edit User</li>
            </ul>
          </div><!-- page-breadcrumbs END -->

          <h1 class="page-titlename">Edit User</h1>
          <form method="post" action="" onsubmit="return user_add_form_submit()">
          
          <input type="hidden" name="user_number" id="user_number" value="<?php echo $userInfo['id']; ?>"/>
          <input type="hidden" name="formSubmitted" value="1"/>
          <div class="title_bar">
            <button type="submit" class="btn btn-primary" type="button">Save</button>
          </div>
 
                <div class="content_section_aside">
                  <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">User Name</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $userInfo['name']; ?>" required />
                    </div>
                  </div>
                </div>
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">First Name</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $userInfo['firstname']; ?>" required />
                    </div>
                  </div>
                  </div>
                  <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Last Name</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $userInfo['lastname']; ?>"  />
                    </div>
                  </div>
                </div>
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-2"><label class="formheading labelSide">Email</label></div>
                    <div class="col-md-12 col-lg-5">
                      <input type="email" class="form-control" name="email" id="email" autocomplete="off" value="<?php echo $userInfo['email']; ?>" required />
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
                            <?php if($userRoles){foreach($userRoles as $r_key => $r_value){ $selected_text = ($userInfo['userrole'] == $r_value) ? 'selected="selected"': ''; echo '<option value="'.$r_key.'" '.$selected_text.'>'.$r_value.'</option>';}} ?>
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
                            <option value="0" <?php if(!$userInfo['active']) echo 'selected="selected"'; ?>>Inactive</option>
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