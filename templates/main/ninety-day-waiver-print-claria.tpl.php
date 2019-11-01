<?php global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists;  $datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$footerFunctions = array("scriptHealthNew");
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">RIDER(S) TO POLICY OF INSURANCE
    </th>
  </tr>
  <tr rowspan="3" style="background-color: #fff;">
    <th colspan="6" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="<?php echo MEDIA_IMAGES; ?>claria-logo.png" width="150" /></td>
        </tr>
        
      </table>
    </th>
    <th colspan="4" width="90%" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
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
          <?php $insuredLists = getHealthInsuredLists($policyInfo['id']);
          //print_r($insuredLists);
          if($insuredLists){$loop_in = 1; foreach($insuredLists as $singleInsured){ 
          $ninetyDayWaiver = $singleInsured['ninety_day_waiver']; 
          $ninetyDayWaiverDate = $singleInsured['effective_ninety_day']; 
          if($ninetyDayWaiver == 1){
          ?>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php if($ninetyDayWaiverDate != '0000-00-00 00:00:00') echo dateFormFormat($ninetyDayWaiverDate); ?></td>
          <?php $loop_in++; 
          if($loop_in == 2){break;}
                }
            }
          }?>
        </tr>
        
      </table>
    </th>
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

    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">
              <span style="font-size: 14px;">This rider(s) revises and becomes part of the Policy numbered above.  It takes precedence over any provisions in the Policy or other riders that may conflict with it.  Keep attached to your policy.</span>
            </td>
          </tr>
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


  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="10" style="padding: 0;">&nbsp;</td>
        </tr>
        
        <tr bgcolor="#000">
          <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">First Name</td>
          <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">Last Name</td>
          <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">Original Effective Date</td>
        </tr>
        <?php $insuredLists = getHealthInsuredLists($policyInfo['id']);if($insuredLists){ foreach($insuredLists as $singleInsured){ 
            $ninetyDayWaiver = $singleInsured['ninety_day_waiver']; 
            $ninetyDayWaiverDate = $singleInsured['effective_ninety_day']; 
            if($ninetyDayWaiver == 1){    
        ?>
        <tr>
          <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singleInsured['first_name']; ?></td>
          <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singleInsured['last_name']; ?></td>
          <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;"><?php if($ninetyDayWaiverDate != '0000-00-00 00:00:00') echo dateFormFormat($ninetyDayWaiverDate); ?></td>
        </tr>
        <?php } } }?>
      </table>
    </td>
  </tr>

 <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br><br>&nbsp;<br></td>
          </tr>
        </table>
      </td>
    </tr>

  <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">
              <span style="font-size: 13px;"><?php echo utf8_encode('"90 Days Commencement of Benefit Waiver:  YES"'); ?><br>This 90 days waiver does not eliminate the 10 months waiting period for maternity benefits</span><br><br>
              <span style="font-size: 13px;"><?php echo utf8_encode('"Eliminación de provisión de espera de 90 días"'); ?><br><?php echo utf8_encode('Esta eliminación de 90 días de espera no incluye el periodo de espera de 10 meses para los beneficios de maternidad'); ?></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>






</table>