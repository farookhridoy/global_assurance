<?php global $policyInfo,$riderList,$db; 
//echo '<pre>';
//print_r($policyInfo);
$approveStandard = $policyInfo['approvedstandrad'];
if($approveStandard == 1){
    $approveStandardText = 'STANDARD';
}else{$approveStandardText = '';}

$delReq = getDeliveryRequests($policyInfo['id']);

$insuredLists = getHealthInsuredLists($policyInfo['id']);
//echo '<pre>';
//print_r($insuredLists);


/*$sql="SELECT * FROM rider";
$relationData = $db->select($sql);

echo '<pre>';
print_r($relationData);*/

?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">APPROVAL SHEET
    </th>
  </tr>
  <tr rowspan="3" style="background-color: #fff;">
    <th colspan="6" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="<?php echo MEDIA_IMAGES; ?>claria-logo.png" width="150" /></td>
        </tr>
        <tr>
          <td><br><br>
            <span style="font-size: 19px;"><strong>APPROVED WITH:</strong></span><br><br>
            <span style="font-size: 17px; color: #555555"><strong><?php echo $approveStandardText; ?></strong></span>
          </td>
        </tr>
      </table>
    </th>
    <th colspan="4" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;">
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Policy Number:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $policyInfo['policynumber']; ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Primary Insured:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo getHealthPrimaryInsuredText($policyInfo['id']); ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Effective Date:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo dateFormFormat($policyInfo['effectivedate'],"m/d/y"); ?></td>
        </tr>
        <?php $agentNames = loadHealthPolicyAgentNames($policyInfo['idagent']); //pre($agentNames); ?>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Agent L1:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $agentNames[1];  ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Agent L2:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $agentNames[2];  ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Agent L3:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $agentNames[3];  ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Agent L4:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $agentNames[4];  ?></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Agent L5:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo $agentNames[5];  ?></td>
        </tr>
      </table>
    </th>
  </tr>
  
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="10" style="padding: 0;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="10" style="padding-bottom: 8px; color: #1d79f8"><strong>Rate ups:</strong></td>
        </tr>
        <tr bgcolor="#000">
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">First Name</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Last Name</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Rate Up Type</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Rate Up Amount</td>
        </tr>
        <?php 
        
        if($insuredLists){
        foreach($insuredLists as $singleinsured){
              $rateups = getRateUpsByInsured($singleinsured['id']);
              
              
              //pre($rateuptype); exit;
              if($rateups){
              foreach($rateups as $singlerateup){
              $rateupsText = '';
              $rateuptype = getSingleRateUpType($singlerateup['idrateuptype']);
              $rateupsText = $rateuptype ? $rateuptype['type']: "";
              //echo '<pre>';
              //print_r($rateups);  
        ?>
        <tr>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singleinsured['first_name']; ?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singleinsured['last_name']; ?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $rateupsText; ?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singlerateup['amount']; ?></td>
        </tr>
        <?php }}}} ?>
      </table>
    </td>
  </tr>
  
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="10" style="padding: 0;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="10" style="padding-bottom: 8px; color: #1d79f8"><strong>Riders:</strong></td>
        </tr>
        <tr bgcolor="#000">
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">First Name</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Last Name</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Title</td>
        </tr>
        <?php
        foreach($insuredLists as $insLists){
            $insuredId = $insLists['id'];
            $sql="SELECT * FROM rider WHERE insured_id='$insuredId'";
            $riderData = $db->select($sql);
            if($riderData){
                foreach($riderData as $rData){
                    $last_name = explode(' ', $rData['name']);
                    $last_word = array_pop($last_name);
        ?>
        <tr>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo explode(' ',trim($rData['name']))[0]; ?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $last_word;?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $rData['title']; ?></td>
        </tr>
        <?php 
                }
            }
        }
        ?>
      </table>
    </td>
  </tr>

<?php $policyNotes = getPolicyNotes($policyInfo['id']); ?>
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="10" style="padding: 0;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="10" style="padding-bottom: 8px; color: #1d79f8"><strong>Notes:</strong></td>
        </tr>
        <tr bgcolor="#000">
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Note</td>
        </tr>
        <?php if($policyNotes){foreach($policyNotes as $policyNote){ ?>
        <tr>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo$policyNote['note']; ?></td>
        </tr>
        <?php }} ?>
      </table>
    </td>
  </tr>
  
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="10" style="padding: 0;">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="10" style="padding-bottom: 8px; color: #1d79f8"><strong>Delivery Requests:</strong></td>
        </tr>
        <tr bgcolor="#000">
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Date Sent</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Status</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">DREQNUM No</td>
          <td style="color: #fff;padding:8px 8px;font-size: 13px;">Details</td>
        </tr>
        <?php foreach($delReq as $delR){?>
        <tr>        
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo dateFormFormat($delR['datesent'],"m/d/y");?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $delR['status'];?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $delR['dreqnumber'];?></td>
          <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $delR['detail'];?></td>        
        </tr>
        <?php }?>
      </table>
    </td>
  </tr>


  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td>
        </tr>
      </table>
    </td>
  </tr>


  <tr><td colspan="7"><br><br><br><br></td></tr>
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                  <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Authorized Signature</span>
                </td>
                <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                  <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Date</span>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>

    
    
  
<!--   <tfoot>    
    <tr style="background: #fff">
      <td align="left" colspan="5" style="padding:10px 10px;font-size: 15px; border-top: solid 1px #eee;"><strong>Total</strong></td>
      <td align="center" style="padding:10px 10px;font-size: 15px; border-top: solid 1px #eee;"><strong>$10.00</strong></td>
      <td align="center" style="padding:10px 10px;font-size: 15px; border-top: solid 1px #eee;"><strong>$20.00</strong></td>
      <td align="right" colspan="2" style="padding:10px 10px;font-size: 15px; border-top: solid 1px #eee;"><strong>$16050.00</strong></td>
    </tr>
  </tfoot> -->

</table>