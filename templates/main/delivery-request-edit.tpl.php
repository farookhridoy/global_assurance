<?php global $policyInfo,$datePicker,$delivery_req_info; $datePicker = array("drq_date_sent"); ?>
      <div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Open Policy Record</a></li>
              <li><a href="<?php echo THE_URL."main/delivery-request-main/".$policyInfo['id']; ?>">Delivery Request</a></li>
              <li>Edit Delivery Request</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          <script>function resetDreq() {document.getElementById("dreq_frm").reset();}</script>
          <h1 class="page-titlename">Delivery Request</h1>
          <form method="POST" action="" name="dreq_frm" id="dreq_frm">
          <div class="title_bar">
            <button class="btn btn-primary" type="submit">Save</button>
            <button class="btn btn-primary bgwhite" type="button" style="text-transform: none" id="dreq_refresh" onclick="resetDreq()"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</button>
            <div class="btn btn-primary bgorange" ><a href="<?php echo THE_URL."main/delivery-request-delete/".$delivery_req_info['id']."/".$policyInfo['id']; ?>">Delete</a></div>
          </div>
         
         <input type="hidden" name="policy_num" value="<?php echo $policyInfo['id']; ?>"/>
         <input type="hidden" name="delivery_req_number" value="<?php echo $delivery_req_info['dreqnumber']; ?>"/>
         <input type="hidden" name="dreq_submit" value="1"/>
         <input type="hidden" name="dreq_num" value="<?php echo $delivery_req_info['id']; ?>"/>
          <div class="content_section_aside">
            <div class="row">
              <div class="col-md-8">
                <div class="paymode_status widthauto">
                  <ul>
                    <li><span>Delivery Request Number</span><p><?php echo $delivery_req_info['dreqnumber']; ?></p></li>
                  </ul>
                </div>
              </div>

              <div class="col-md-4">
                  <div class="contryin_life">
                    <div class="row">
                      <div class="col-md-12 col-lg-6">
                        <label class="formheading">Date Sent</label>
                        <input type="text" class="form-control" name="drq_date_sent" id="drq_date_sent" value="<?php if($delivery_req_info['datesent'] && $delivery_req_info['datesent'] != '0000-00-00 00:00:00') echo dateFormFormat($delivery_req_info['datesent']); ?>"/>
                      </div>
                      <div class="col-md-12 col-lg-6">
                        <label class="formheading">Status</label>
                        
                        <span class="form-select">
                          <select class="form-control" name="dreq_status">
                            <option>Pending</option>
                            <option <?php if($delivery_req_info['status']=='Received') echo 'selected="selected"'; ?>>Received</option>
                          </select>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- content_section_aside END -->


                <div class="content_section_aside">
                  <div class="table_overlay">
                    <table class="tableContent tableNothover">
                      <tbody><tr>
                        <th><span>Details</span></th>
                      </tr>
                     
                      <tr>
                        <td>
                          <textarea class="form-control" name="dreq_details"><?php echo $delivery_req_info['detail']; ?></textarea>
                        </td>
                      </tr>
                      <!--<tr>
                        <td><button class="btn btn-primary float-right">Add</button></td>
                      </tr>-->
                    </tbody></table>
                  </div><!-- table_overlay END -->
                </div>


               </form>


          </div>
          <div class="clearfix"></div>
</div>