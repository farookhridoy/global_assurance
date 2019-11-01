<?php global $policyInfo; 
//print_r($policyInfo);
/*$idstatus = $policyInfo['idnotecancel'];
if($idstatus == 1){$idstatusText = 'Cancelled Before Renewal';}
elseif($idstatus == 2){$idstatusText = 'Changed Agent';}
elseif($idstatus == 3){$idstatusText = 'Changed Deductible';}
elseif($idstatus == 4){$idstatusText = 'Changed Plan';}
elseif($idstatus == 5){$idstatusText = 'Declined';}
elseif($idstatus == 6){$idstatusText = 'Non Renewed';}
elseif($idstatus == 7){$idstatusText = 'Not Taken';}
elseif($idstatus == 8){$idstatusText = 'Reinstatement Denied';}*/
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">CANCELATION NOTICE
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
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Expiration Date:</strong></td>
          <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php if($policyInfo['datecancel'] && $policyInfo['datecancel'] != '0000-00-00 00:00:00') echo dateFormFormat($policyInfo['datecancel'],"m/d/y"); ?></td>
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
            <td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" colspan="7" style="padding: 0;">
              <span style="font-size: 23px;">
                <strong>The Medical Policy described above has been cancelled as of the expiration date for the following reasons.</strong>
              </span>
            </td>
          </tr>
          <tr>
            <td colspan="7">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td align="center" colspan="7" style="padding: 0;">
              <span style="font-size: 23px;">
                <?php 
                $cancelReasons = getCancelReasons();
                if($cancelReasons){
                    foreach($cancelReasons as $cn_key => $cn_vl){ 
                        echo $cancel_text = ($policyInfo['idnotecancel'] == $cn_key) ? $cn_vl: '';
                    }
                }
                ?>
              </span>
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
          <td colspan="4">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td align="center" width="50%" style="padding: 0; font-size: 13px;">
                  <span style="width: 350px; padding-top: 5px; display: block;font-weight: bold;">Claria Life and Health Insurance Company</span>
                </td>
                <td align="center" width="50%" style="padding: 0; font-size: 13px;">
                  <span style="width: 350px; padding-top: 5px; display: block;font-weight: bold;">Cancellation Notice Page 1 of 1</span>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>

</table>