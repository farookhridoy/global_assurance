<?php global $policyInfo; 
$delReq = getDeliveryRequests($policyInfo['id']);
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">DELIVERY REQUIREMENT
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
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Deadline Date:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php if($policyInfo['datecancel'] && $policyInfo['datecancel'] != '0000-00-00 00:00:00') echo dateFormFormat($policyInfo['datecancel'],"m/d/y"); ?></td>
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
              <span style="font-size: 14px;">Global Assurance Group Inc. and  CLARIA Life and Health Insurance  have received your application for insurance. The coverage listed under this certificate is contingent upon Global Assurance Group receiving in their office the information requested below.</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr><td colspan="7"><br><br></td></tr>

    <tr>
      <td colspan="10" align="center" style="border-bottom: solid 2px #bbb;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" align="center" style="padding: 0;">
              <span style="font-size: 14px;"><strong>DOCUMENTS</strong></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr><td colspan="7"><br></td></tr>
    
    <?php foreach($delReq as $delR){?>
    <tr>
      <td colspan="7" style="padding: 0; text-align: center;"><div style="font-size: 13px;"><?php echo nl2br($delR['detail']);?></div></td>        
    </tr>
    <?php }?>
    
    <tr><td colspan="7"><br></td></tr>

    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="padding: 0;">
              <span style="font-size: 13px;">In the case, which the information requested above, is sent to Global Assurance Group and new information and/or medical conditions not declared in the application are discovered, then the policy will immediately de cancelled, voided, premiums refunded minus the policy fee and any claims incurred shall not be considered eligible for payment.</span><br><br>

              <span style="font-size: 13px;">Global Assurance Group may at its own discretion decide to offer the applicant to underwrite the application again taking in to consideration the new information and/or medical conditions received and make a new underwriting offer to the application. Global Assurance Group does not guarantee and is under no obligation whatsoever to underwrite the application again or make any new offers.</span><br><br>

              <span style="font-size: 13px;">If Global Assurance Group does not receive in its office the above information requested from the insured before the deadline date indicated above your policy will be cancelled, voided, premiums refunded minus the policy fee and any claims incurred shall not be considered eligible for payment.</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr><td colspan="7"><br><br><br><br><br><br><br></td></tr>
    <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td colspan="4">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                  <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Signature of Insured or Guardian</span>
                </td>
                <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                  <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Date</span>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody></table>
    </td>
  </tr>
  <tr><td colspan="7"><br><br><br><br></td></tr>
  <tr>
    <td colspan="10">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
              <td colspan="4">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                      <tr>
                        <td align="left" width="50%" style="padding: 0; font-size: 14px;">
                          <span style="width: 250px; padding-top: 5px; display: block;"><?php echo date("l, F j, Y"); ?></span>
                        </td>
                        <td align="right" width="50%" style="padding: 0; font-size: 14px;">
                          <span style="width: 250px; padding-top: 5px; display: block;">Page 1 of 1</span>
                        </td>
                      </tr>
                </tbody>
                </table>
              </td>
            </tr>
        </tbody>
      </table>
    </td>
  </tr>
  <tr><td colspan="7"><br><br><br><br></td></tr>
</table>