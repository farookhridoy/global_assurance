<?php 
global $insuredInfo,$insuredLists,$footerFunctions,$policyInfo , $riderList;

$footerFunctions = array("scriptHealthRateup");

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
                <li>Rider Control</li>
            </ul>
        </div><!-- page-breadcrumbs END -->
        
        <h1 class="page-titlename">Rider Control</h1>
        
        <div id=""></div>
        
        <div class="title_bar">
            <div class="btn btn-primary bgorange"><a href="<?php echo THE_URL."main/rider_new/".$insuredInfo['id']; ?>">Add New Rider</a></div>
            <div class="btn btn-primary bgwhite"><a href="javascript: void(0)" onclick="window.location.reload()"><i class="fas fa-sync-alt"></i> &nbsp;Refresh</a></div>
            <div class="btn btn-primary "><a href="javascript: void(0)" onclick="window.close()">Close</a></div>
        </div>
        
        <?php if($error_message){ ?>
            <div class="row">
            <div class="col-md-12">
            <p class="err"><?php echo $error_message; ?></p>
            <p><br /><br /></p>
            </div>
            </div>
            <?php } ?>
        
        <!-- Content Section Starts Here -->
        
        
        
        <div class="content_section_aside">
            <div class="table_overlay">
                <table class="tableContent">
                    <tbody>
                        <tr>
                            <th class="fltersearch"><span>UIID</span></th>
                            <th class="fltersearch"><span>Rider Number</span></th>
                            <th class="fltersearch"><span>Title</span></th>
                            <th class="fltersearch"><span>Date Sent</span></th>
                            
                            <th class="fltersearch"><span>Status</span></th>
                            <th class="fltersearch"><span>Print</span></th>
                            <th class="fltersearch"><span>Print</span></th>
                        </tr>
                        
                        <?php foreach($riderList as $rider): ?>
                        
                        <tr>
                            <td><a href="<?php echo THE_URL.'main/rider_new/'.$rider['insured_id'].'/'.$rider['id'] ?>"><?php echo $rider['id'] ?></a></td>
                            <td><?php echo $rider['rider_number'] ?></td>
                            
                            <td><?php echo $rider['title'] . ' ' . $rider['name'] ?></td>
                            <td><?php echo dateFormFormat($rider['date_sent']); ?></td>
                            
                            <td><?php 
                            switch ($rider['status']) {
                            case "1":
                                echo "Received";
                                break;
                            case "2":
                                echo "Benefits Increased Pending";
                                break;
                            default:
                                $status_text =  "Pending";
                            }
                            echo $status_text; 
                            ?></td>
                            <td><a href="<?php echo THE_URL."main/rider-print/".$rider['id']; ?>" class="detailsLink">Print</a></td>
                            <td><a href="<?php echo THE_URL."main/rider-print-no-footer/".$rider['id']; ?>" class="detailsLink">Print no footer</a></td>
                            
                        </tr>
                        
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
            </div><!-- table_overlay END -->
            <div class="clearfix"></div>
        </div>
        
        
        <!-- Content Section Ends Here -->
    
    </div>
    <div class="clearfix"></div>
</div><!-- sectionPanel_Right END -->