<?php 
global $policyInfo,$db; 
$insuredLists = getHealthInsuredLists($policyInfo['id']);

$rider_mat = 0;
$rider_mat_com = 0;
foreach($insuredLists as $inLists){
    $sql_rate="SELECT * FROM rateup WHERE idinsured ='".$inLists['id']."'";
    $rateupData = $db->select($sql_rate);
    //print_r($rateupData);
    if($rateupData){        
        foreach($rateupData as $rupData){
            $sql_rateType="SELECT * FROM rateuptypes WHERE id ='".$rupData['idrateuptype']."'";
            $rateupTypeData = $db->select($sql_rateType);
            //print_r($rateupTypeData);
            if($rateupTypeData){
                foreach($rateupTypeData as $ruptypeData){
                    if($ruptypeData['id'] == 20){
                        $rider_mat = $rider_mat+1;
                    }
                    if($ruptypeData['id'] == 22){
                        $rider_mat_com = $rider_mat_com+1;
                    }
                }
            }
        }
    }
}
//echo $rider_mat;
//echo $rider_mat_com;


?>
<div class="sectionPanel_left mCustomScrollbar">
<div class="panel_menu ">
  <ul>
    <li class="healthMenu active"><a href="<?php echo THE_URL."main/health"; ?>"><span>Health</span></a></a>
      <ul>
        <li><a class="premium-inclusion-btn" href="javascript:void(0);">Premium Inclusion</a></li>
        <li><a href="<?php echo THE_URL."main/delivery-request-main/".$policyInfo['id']; ?>" target="_blank">Delivery Request</a></li>
        <li><a href="<?php echo THE_URL."main/approval-sheet-claria/".$policyInfo['id']; ?>" target="_blank">Approval Sheet</a></li>
        <li><a href="<?php echo THE_URL."main/reinstatement-sheet-claria/".$policyInfo['id']; ?>" target="_blank">Reinstatement Sheet</a></li>
        <li><a href="<?php echo THE_URL."main/ninety-day-waiver-print-claria/".$policyInfo['id']; ?>" target="_blank">90 day waiver</a></li>
        <li><a href="javascript:void(0);" onclick="form_submit()">Calculate Premiums</a></li>
        <li><a href="<?php echo THE_URL."main/print-policy/".$policyInfo['id']; ?>" target="_blank">Print Policy Booklet</a></li>
        <li><a href="<?php echo THE_URL."main/cancel-notice-claria/".$policyInfo['id']; ?>" target="_blank">Cancellation Notice</a></li>
        <li><a href="<?php echo THE_URL."main/duplicate-policy/".$policyInfo['id']; ?>">Duplicate Policy</a></li>
        <li><a href="<?php echo THE_URL."main/claria-express/".$policyInfo['id']; ?>" target="_blank">Claria Express</a></li>
        <li><a href="#">90 day waiver ADD</a></li>
        <?php if($rider_mat > 0){ ?>
            <li><a href="<?php echo THE_URL."main/rider-maternity/".$policyInfo["id"]; ?>" target="_blank">Rider Maternity</a></li>
        <?php }else{ ?>
            <li><a href="#">Rider Maternity</a></li>
        <?php } ?>
        <?php if($rider_mat_com > 0){ ?>
            <li><a href="<?php echo THE_URL."main/rider-commate/".$policyInfo['id']; ?>" target="_blank">Rider ComMate</a></li>
        <?php }else{ ?>
            <li><a href="#">Rider ComMate</a></li>
        <?php } ?>
      </ul>
    </li>
    <li class="lifeMenu"><a href="#"><span>Life</span></a></li>            
  </ul>
</div>
</div><!-- sectionPanel_left END -->