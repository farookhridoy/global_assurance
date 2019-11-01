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
<div class="clearfix"></div>
<div class="row">  
    <div class="col-md-8"> 
       <form method="post" action="<?php echo THE_URL."main/upload"; ?>" id="frm_agent_notes" enctype="multipart/form-data">

          <div class="content_section_aside">
            <h4 class="content_section_aside_header">Upload xlsx sheet</h4>

            <div class="form-group-row">
              <div class="row rowsm">
                <div class="col-md-3"><label class="formheading labelSide">Choose Hertland Excel File</label></div>
                <div class="col-md-3">

                  <input type="file" name="fileToUpload"  id="file" class="form-control btn btn-primary" style="height: 33px !important;margin-top: -3px;">

                  <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
                  <input type="hidden" name="data_id" value="1">
              </div>
              <div class="col-md-6">
                  <button class="btn btn-primary bgorange" type="submit" data-id="1">Upload Hertland</button>
                 

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
                <div class="col-md-3"><label class="formheading labelSide">Choose Authrize Excel File</label></div>
                <div class="col-md-3">

                  <input type="file" name="fileToUpload"  id="file" class="form-control btn btn-primary" style="height: 33px !important;margin-top: -3px;">

                  <input type="hidden" name="policy_id" id="policy_id" value="<?php echo $policyInfo['id']; ?>">
              </div>
              <div class="col-md-6">
                  <input type="hidden" name="data_id" value="2">
                  <button class="btn btn-success" type="submit" data-id="2">Upload Authrize</button>

              </div>
          </div>
      </div>
  </div>
</form>
</div>
</div>

</div>
</div><!-- sectionPanel_Right END -->

<!-- /*require_once('../spreadsheet-plugin/php-excel-reader/excel_reader2.php');
require_once('../spreadsheet-plugin/SpreadsheetReader.php');
//error_reporting(E_ALL);
$policy_id =  trim($_POST['policy_id']);
$file =  trim($_FILES["uploadFile"]);

if (isset($_POST["uploadbtn"]))
{
    if($policy_id && $file){

        $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

        if(in_array($_FILES["uploadFile"]["type"],$allowedFileType)){

            $targetPath = '../includes/file-folder/'.$_FILES['uploadFile']['name'];
            move_uploaded_file($_FILES['uploadFile']['tmp_name'], $targetPath);

            $Reader = new SpreadsheetReader($targetPath);

            $sheetCount = count($Reader->sheets());

            for($i=0;$i<$sheetCount;$i++){
                $Reader->ChangeSheet($i);
                foreach ($Reader as $row){
                    if(isset($row[3])){
                        $paid_date= date("Y-m-d",strtotime($row[3]));
                    }

                    $sql = "INSERT INTO `payments`(`id_policy`,`id_pay_cycle`,`amount`,`date_paid`,`action`,`id_pay_type`,`fee`,`id_discount`,`id_user`,`date_due`,`locked`,`type`,`details`,`paid`,`date_created`,
                    `receipt_pay`,`receipt_type`,`receipt_note`) VALUES ('".trim($policyInfo['id'])."','".trim($policyInfo['idpaycycle'])."','".trim($row[12])."','".trim($paid_date)."','".trim($row[10])."','','".trim($policyInfo['fee'])."','','".trim($row[15])."','".trim($policyInfo['paymentduedate'])."','0','".trim($row[9])."','','0','','".trim($row[8])."','".trim($row[5]).'-'.trim($row[7])."','".trim($row[18])."')";

                    $result = $db->insert($sql);
                    if (! empty($result)) {

                        

                        echo "<script type=\"text/javascript\">
                            alert(\"Excel Data Imported into the Database\");
                            window.location.reload()
                        </script>";

                    } else {

                        
                        echo "<script type=\"text/javascript\">
                            alert(\"Problem in Importing Excel Data\");
                           
                        </script>";
                    }

                }//end foreach

            }//end for
        }else{ 

                //alert("Invalid File Type. Upload Excel File.");
                echo "<script type=\"text/javascript\">
                            alert(\"Invalid File Type. Upload Excel File.\");
                           
                        </script>";
        }
        if($payments){
            //alert("Upload Excel File.");
             echo "<script type=\"text/javascript\">
                            alert(\"Upload Excel File.\");
                           
                        </script>";
        }
    }else{

        //alert("Faild");
        echo "<script type=\"text/javascript\">
                            alert(\"Faild.\");
                           
                        </script>";
    }
} */  -->