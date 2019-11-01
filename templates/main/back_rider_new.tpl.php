<style type="text/css">
    .no-display{display: none;}
</style>
<?php 
global $insuredInfo,$insuredLists,$footerFunctions,$policyInfo,$datePicker , $riderInfo;
$datePicker = array("date_sent");
//print_r($insuredInfo);
$footerFunctions = array("scriptHealthRateup");
?>
<div class="sectionPanel_Right">
    <div class="content_section">
        <div class="page-breadcrumbs">
            <ul>
                <li><a href="#"><i class="fas fa-home"></i></a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#" onclick="history.back()">Rider Control</a></li>
                <li>Add New Rider</li>
            </ul>
        </div><!-- page-breadcrumbs END -->
        
        <h1 class="page-titlename">Add New Rider</h1>
        
        <?php
            #print_r($insuredInfo);
        ?>
        
        <div class="title_bar">
            <div class="btn btn-primary bgorange"><a href="javascript:void(0);" onclick="newrider_form_submit()">Save</a></div>
            <div class="btn btn-primary bgwhite"><a href="<?php echo THE_URL."main/rider_refresh/".$insuredInfo['id']; ?>">Close</a></div>
            <div class="btn btn-primary "><a href="#">Delete</a></div>
        </div>
        
        <!-- Content Section Starts Here -->
        
        <form method="post" action="" id="frm_new_health" onsubmit="return newrider_form_submit()" enctype="multipart/form-data">
            <div class="no-display">
                <input type="hidden" name="insured_id" id="insured_id" value="<?php echo $insuredInfo['id']; ?>"/>
                <input type="hidden" name="id" id="id" value="<?php echo $riderInfo['id']; ?>"/>
            </div>
            
            <div class="content_section_aside">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group-section">                            
                            <label class="formheading">Rider Number</label>
                            <input type="text" class="form-control" name="rider_number" value="<?php echo $riderInfo['rider_number']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group-section">
                            <label class="formheading">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $riderInfo['name']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $riderInfo['title']; ?>"/>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Date Sent</label>
                            <input type="text" class="form-control" name="date_sent" id="date_sent" value="<?php echo $riderInfo['date_sent'] ?>"/>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Status</label>
                            <span class="form-select">
                                <select class="form-control" name="status">
                                    <option value="0">Pending</option>
                                    <option value="1">Received</option>
                                    <option value="2">Benefits Increased Pending</option>
                                </select>
                            </span>
                        </div>
                      </div>
                    
                    
                    
                    
                </div>
            </div>
            
            <div class="content_section_aside">
                <div class="table_overlay">
                    <table class="tableContent tableNothover">
                        <tbody>
                            <tr>
                                <th class="fltersearch">Details</th>
                            </tr>
                            
                            <tr>
                                <td><textarea id="details" name="details" class="form-control"><?php echo $riderInfo['details'] ?></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- table_overlay END -->
            </div>
        
        </form>
        
        <!-- Content Section Ends Here -->
    
    </div>
    <div class="clearfix"></div>
</div><!-- sectionPanel_Right END -->

<script type="text/javascript">
    
    var THE_URL = '<?php echo THE_URL ?>';
    
    function newrider_form_submit()
    {
        var insured_id = $('#insured_id').val();
        
                     
       
        if(insured_id)
        {            
            $("#ajax_progress").text('Rider data saving please wait...');
            $("#ajax_progress").show();
            $.ajax({
                type: 'POST',
                url: THE_URL+"main/rider_save",
                data: $('form').serialize(), 
                success: function(response) {
                    alert(response); 
                    //return 1;
                    var response_json = $.parseJSON(response);
                    if(parseInt(response_json.sucess) == 1){
                        //window.location.href = health_new_success_url;
                        $("#ajax_progress").text('Policy data saved now file uploading please wait...');
                        //policy_files_upload(curr_policy_id);
                    }else{
                       alert("Failed to  save policy"); 
                    }
                    //alert(response);
                },
            });
    
        }
        else{
            alert("Policy Number can't be empty!!!");
        }
        return false;
      }
</script>