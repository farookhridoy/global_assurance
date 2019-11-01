<?php global $policyInfo; 

 if($_REQUEST['pr']){
    $error_message = 'Permission error! You are not allowed to perform this action.';
 }
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Open Policy Record</a></li>
              <li>Delivery Request</li>
            </ul>
          </div><!-- page-breadcrumbs END -->

        <h1 class="page-titlename">Delivery Request</h1>
          <div class="title_bar">
            <div class="btn btn-primary bgorange" ><a href="<?php echo THE_URL."main/new-delivery-request/".$policyInfo['id']; ?>">New Delivery Request</a></div>
            <button class="btn btn-primary bgwhite" type="button" style="text-transform: none"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</button>
          </div>
          
           <?php if($error_message){ ?>
            <div class="row">
            <div class="col-md-12">
            <p class="err"><?php echo $error_message; ?></p>
            <p><br /><br /></p>
            </div>
            </div>
            <?php } ?>
          
          <div class="content_section_aside">
            <div class="paymode_status widthauto">
              <ul>
                <li><span>Policy Number</span><p><?php echo $policyInfo['policynumber']; ?></p></li>
              </ul>
            </div>
            <div class="deliberyreqDate"><?php echo dateFormFormat($policyInfo['effectivedate'],"m/d/y"); ?></div>
          </div><!-- content_section_aside END -->
          <div class="content_section_aside">
                  <div class="table_overlay">
                    <table class="tableContent delivery-req">
                      <tbody><tr>
                        <th class="fltersearch"><span>ID</span></th>
                        <th class="fltersearch"><span>Date Sent</span></th>
                        <th class="fltersearch"><span>Status</span></th>
                        <th class="fltersearch"><span>DREQNUM</span></th>
                        <th class="fltersearch"><span>Edit</span></th>
                        <th class="fltersearch"><span>Print En</span></th>
                        <th class="fltersearch"><span>Print Sp</span></th>
                      </tr>
                      
                      <?php $dreqLists = getDeliveryRequests($policyInfo['id']); if($dreqLists){foreach($dreqLists as $dreq){ ?>
                     
                     <tr>
                        <td><?php echo $dreq['id']; ?></td>
                        <td><?php if($dreq['datesent'] && $dreq['datesent'] != '0000-00-00 00:00:00') echo dateFormFormat($dreq['datesent']); ?></td>
                        <td><?php echo $dreq['status']; ?></td>
                        <td><?php echo $dreq['dreqnumber']; ?></td>
                        <td><a href="<?php echo THE_URL."main/delivery-request-edit/".$policyInfo['id']."/".$dreq['id']; ?>" class="detailsLink">Edit</a></td>
                        <td><a href="<?php echo THE_URL."main/delivery-request-print-claria/".$policyInfo['id']; ?>" class="detailsLink">Print</a></td>
                        <td><a href="<?php echo THE_URL."main/delivery-request-print-claria-sp/".$policyInfo['id']; ?>" class="detailsLink">Print SP</a></td>
                      </tr>
                      
                      <?php } } ?>
                    </tbody></table>
                  </div><!-- table_overlay END -->
                  <div class="clearfix"></div>
            </div>
          </div>
          <div class="clearfix"></div>
</div>