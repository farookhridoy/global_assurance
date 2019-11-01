<style type="text/css">
    .no-display{display: none;}
</style>
<?php 
    global $rateInfo;
    
    $singleInsured = getHealthSingleInsured($rateInfo['insured_id']);
    //print_r($singleInsured);
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
                <li><a href="#" onclick="history.back()">Life Policy</a></li>
                <li>Manual Rate</li>
            </ul>
        </div><!-- page-breadcrumbs END -->
        
        <h1 class="page-titlename">Manual Rate</h1>
        
        <?php
            #print_r($insuredInfo);
        ?>
        
        <div class="title_bar">
            <div class="btn btn-primary bgorange"><a href="javascript:void(0);" onclick="form_submit()">Save</a></div>            
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
        
        <form method="post" action="<?php echo THE_URL.'main/manual_rate_save' ?>" id="form_manual_rate">
            <div class="no-display">
                <input type="hidden" name="insured_id" id="insured_id" value="<?php echo $rateInfo['insured_id']; ?>"/>
                <input type="hidden" name="id" id="id" value="<?php echo $rateInfo['id']; ?>"/>
            </div>            
            <div class="content_section_aside">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group-section">                            
                            <label class="formheading">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $singleInsured['first_name']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group-section">
                            <label class="formheading">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $singleInsured['last_name']; ?>"/>
                        </div>
                    </div>                    
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Base Premium</label>
                            <input type="text" class="form-control" name="base_premium" value="<?php echo $singleInsured['basepremium']; ?>"/>
                        </div>
                    </div>                    
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Total Premium</label>
                            <input type="text" class="form-control" name="total_premium" value="<?php echo $singleInsured['premium']; ?>"/>
                        </div>
                    </div>                    
                </div>
            </div>
        </form>        
        <!-- Content Section Ends Here -->    
    </div>
    <div class="clearfix"></div>
</div><!-- sectionPanel_Right END -->

<script type="text/javascript">
        
    function form_submit()
    {
        $('#form_manual_rate').submit();
        
    }
</script>