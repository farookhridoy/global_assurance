<?php
global $insuredInfo,$db,$rateup_info,$footerFunctions,$policyinfo;
$footerFunctions = array("scriptHealthRateup");

//print_r($rateupinfo);
$insuredId = $rateupinfo['idinsured'];
$sql="SELECT * FROM insured WHERE id='$insuredId'";
$insured_info = $db->select_single($sql);

if($insured_info){
    $policyinfo = getSinglePolicy($insured_info['idpolicy']);
}
          
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">RIDER(S) TO POLICY OF INSURANCE
    </th>
  </tr>
  <tr rowspan="3" style="background-color: #fff;">
    <th colspan="6" width="50%" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="<?php echo MEDIA_IMAGES; ?>claria-logo.png" width="150" /></td>
        </tr>
      </table>
    </th>
    <th colspan="4" bgcolor="#f3f3f3" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif; padding: 10px;">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;">
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Policy Number:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo $policyinfo['policynumber']; ?></span></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Primary Insured:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo $insuredInfo['first_name'].' '.$insuredInfo['last_name']; ?></span></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Effective Date:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo dateFormFormat($policyinfo['effectivedate'],"m/d/y"); ?></span></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Policy Period:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo dateFormFormat($policyinfo['paymentstart'],"m/d/y"); ?> - <?php echo dateFormFormat($policyinfo['paymentend'],"m/d/y"); ?></span></td>
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

    <tr><td colspan="7"><br><br></td></tr>

    <tr>
      <td colspan="10" align="center">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" align="left" style="padding: 0;">
              <span style="font-size: 14px;"><strong>Name of insured:</strong> <?php echo $insuredInfo['first_name'].' '.$insuredInfo['last_name']; ?></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>


    <tr>
      <td colspan="10" align="center">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7"><br><br></td>
          </tr>
          <tr>
            <td colspan="7" align="center" style="padding: 0;">
              <span style="font-size: 16px;"><strong>ACCIDENTAL DEATH AND DISMEMBERMENT COVERAGE</strong></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
        <td colspan="10">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="10" style="padding: 0;"><br><br></td>
            </tr>
            <tr bgcolor="#000">
              <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">Detail</td>
              <td width="50%" align="center" style="color: #fff;padding:8px 8px;font-size: 13px; border-left: solid 5px #fff;">Detalle</td>
            </tr>
            <tr>
              <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;">
                <?php echo $rateup_info['detaileng'];?>
              </td>
              <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;">
                <?php echo $rateup_info['detailspa'];?>
              </td>
            </tr>
          </table>
        </td>
    </tr>
    
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    
    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;"><?php echo date("l, F j, Y"); ?></span>
            </td>
            <td colspan="7" style="text-align: right;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">Page 1 of 1</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>






</table>