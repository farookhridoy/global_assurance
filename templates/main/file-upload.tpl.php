<?php
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole;  $datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");

$policy_id_p= $policyInfo['id'];
$sql="SELECT * FROM notes WHERE policy_id='$policy_id_p'";
$getData = $db->select_single($sql);


//error_reporting(E_ALL);

?>

<div class="sectionPanel_Right">
  <div class="content_section">
    <div class="page-breadcrumbs">
      <ul>
        <li><a href="#"><i class="fas fa-home"></i></a></li>
        <li><a href="<?php echo THE_URL."main/health"; ?>">Dashboard</a></li>
        <li><a href="<?php echo THE_URL."main/payments-form/".$policyInfo['id']; ?>">Open Payment Form</a></li>
        <li>System</li>
    </ul>
</div><!-- page-breadcrumbs END -->
<h1 class="page-titlename">System</h1>
<?php 
if(isset($_SESSION["message"])) {
    $success = $_SESSION["message"];
    unset($_SESSION["message"]);
    echo '<strong style="color:green;font-size: 18px;font-weight: bold;">'.$success.'</strong>';
}elseif(isset($_SESSION["error"])) {
    $success = $_SESSION["error"];
    unset($_SESSION["error"]);
    echo '<strong style="color:red;font-size: 18px;font-weight: bold;">'.$success.'</strong>';
}else {
   $success = "";
}
?>

<div class="clearfix"></div>
<div class="row">  
    <div class="col-md-8"> 
       <form method="post" action="<?php echo THE_URL."main/upload"; ?>" id="frm_agent_notes" enctype="multipart/form-data">

          <div class="content_section_aside">
            <h4 class="content_section_aside_header">Upload xlsx sheet</h4>

            <div class="form-group-row">
              <div class="row rowsm">
                <div class="col-md-3"><label class="formheading labelSide">Choose Heartland Excel File</label></div>
                <div class="col-md-3">

                  <input type="file" name="fileToUpload"  id="file" class="form-control btn btn-primary" style="height: 33px !important;margin-top: -3px;">

                  <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
                  <input type="hidden" name="data_id" value="1">
              </div>
              <div class="col-md-6">
                  <input class="btn btn-primary bgorange" type="submit" value="Upload Heartland" name="upload" data-id="1">
                 

              </div>
          </div>
      </div>
  </div>
</form>
</div>
<div class="col-md-8"> 
       <form method="post" action="<?php echo THE_URL."main/upload"; ?>" id="frm_agent_notes" enctype="multipart/form-data">

          <div class="content_section_aside">
            <h4 class="content_section_aside_header">Upload xlsx sheet</h4>

            <div class="form-group-row">
              <div class="row rowsm">
                <div class="col-md-3"><label class="formheading labelSide">Choose Authorize Excel File</label></div>
                <div class="col-md-3">

                  <input type="file" name="fileToUpload"  id="file" class="form-control btn btn-primary" style="height: 33px !important;margin-top: -3px;">

                  <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
              </div>
              <div class="col-md-6">
                  <input type="hidden" name="data_id" value="2">
                  <input class="btn btn-success" type="submit" value="Upload Authorize" name="upload" data-id="2">

              </div>
          </div>
      </div>
  </div>
</form>
</div>
</div>

<!-- <div class="col-md-8"> 
 <form method="post" action="<?php echo THE_URL."main/upload"; ?>" id="frm_agent_notes" enctype="multipart/form-data">

  <div class="content_section_aside">
    <h4 class="content_section_aside_header">Upload xlsx sheet</h4>

    <div class="form-group-row">
      <div class="row rowsm">
        <div class="col-md-3"><label class="formheading labelSide">Choose Agents File</label></div>
        <div class="col-md-3">

          <input type="file" name="fileToUpload"  id="file" class="form-control btn btn-primary" style="height: 33px !important;margin-top: -3px;">

          <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
        </div>
        <div class="col-md-6">
          <input type="hidden" name="data_id" value="3">
          <input class="btn btn-success" type="submit" value="Upload Agents" name="upload" data-id="3">

        </div>
      </div>
    </div>
  </div>
</form>
</div> -->
</div>

</div>
</div>

