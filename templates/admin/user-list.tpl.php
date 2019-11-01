<?php global $userLists; ?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Manage Users</a></li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          
          <h1 class="page-titlename">Manage Users</h1>
          <div class="title_bar">
            <div class="btn btn-primary bgorange" ><a href="<?php echo THE_URL."admin/add-user"; ?>">New User</a></div>
            <!--<button class="btn btn-primary bgwhite" type="button" style="text-transform: none"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</button>-->
          </div>




          <div class="content_section_aside">
                  <div class="table_overlay">
                    <table class="tableContent">
                      <tbody><tr>
                        <th class="fltersearch"><span>ID</span></th>
                        <th class="fltersearch"><span>User Name</span></th>
                        <th class="fltersearch"><span>First Name</span></th>
                        <th class="fltersearch"><span>Last Name</span></th>
                        <th class="fltersearch"><span>Email</span></th>
                        <th class="fltersearch"><span>Role</span></th>
                        <th class="fltersearch"><span>Status</span></th>
                        <th class="fltersearch"><span>Edit</span></th>
                        <th class="fltersearch"><span>Delete</span></th>
                      </tr> 
                     <?php if($userLists){foreach($userLists as $userInfo){ ?>
                      <tr>
                        <td><?php echo $userInfo['id'];  ?></td>
                        <td><?php echo $userInfo['name'];  ?></td>
                        <td><?php echo $userInfo['firstname'];  ?></td>
                        <td><?php echo $userInfo['lastname'];  ?></td>
                        <td><?php echo $userInfo['email'];  ?></td>
                        <td><?php echo $userInfo['userrole'];  ?></td>
                        <td><?php echo $userInfo['active'] ? "Active": "Inactive";  ?></td>
                        <td><a href="<?php echo THE_URL."admin/edit-user/".$userInfo['id']; ?>" class="detailsLink">Edit</a></td>
                        <td><a href="<?php echo THE_URL."admin/delete-user/".$userInfo['id']; ?>" class="detailsLink" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a></td>
                      </tr>
                      <?php }}else{ ?>
                      <tr><td colspan="9">Currently no user available.</td></tr>
                      <?php } ?>
                    </tbody></table>
                  </div><!-- table_overlay END -->
                  <div class="clearfix"></div>
            <div class="filtersColumn">
                <div class="filtersColumn-left">
                  <div class="paginationcrum">
                    <ul>
                      <li class="first"><a href="#"><i class="fas fa-backward"></i></a></li>
                      <li class="prev"><a href="#"><i class="fas fa-caret-left"></i></a></li>
                      <li class="pagess"><a>1 of 36</a></li>
                      <li class="next"><a href="#"><i class="fas fa-caret-right"></i></a></li>
                      <li class="last"><a href="#"><i class="fas fa-forward"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="filtersColumn-right">
                  <div class="filteredCol">
                    <button>
                      <span class="filteredS"><i class="fas fa-filter"></i> Filtered</span>
                      <span class="unfilteredS"><i class="fas fa-times-circle"></i> Unfiltered</span>
                    </button>
                  </div>
                  <div class="realtiveper">
                    <input type="text" placeholder="Search.." class="form-control">
                    <i class="fas fa-search"></i>
                  </div>
                </div>
            </div><!-- filtersColumn END -->
                </div>


         


          </div>
          <div class="clearfix"></div>


        </div>  

<span class="clear"></span>     