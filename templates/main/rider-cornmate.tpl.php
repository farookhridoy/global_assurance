<?php
global $insuredInfo,$db,$riderinfo,$footerFunctions,$policyInfo;
$footerFunctions = array("scriptHealthRateup");

//print_r($policyInfo);

          
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
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo $policyInfo['policynumber']; ?></span></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Primary Insured:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo getHealthPrimaryInsuredText($policyInfo['id']); ?></span></td>
        </tr>
        <tr style="background: #f3f3f3;">
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Effective Date:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php echo dateFormFormat($policyInfo['effectivedate'],"m/d/y"); ?></span></td>
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
              <span style="font-size: 14px;"><strong>Name of insured:</strong> <?php echo getHealthPrimaryInsuredText($policyInfo['id']); ?></span>
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
              <span style="font-size: 16px;"><strong>COMPLICATIONS OF PREGNANCY RIDER</strong></span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>


    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">The term "Complication of Pregnancy" means a condition needing medical treatment before, during, or after termination of pregnancy. The health condition must be diagnosed as distinct from pregnancy or as caused by it, including but not limited to: acute nephritis; cardiac decompensation; disease of the vascular, hemopoietic, nervous or endocrine systems. Conditions that can't be classified as a distinct Complication of Pregnancy but are connected with management of a difficult pregnancy are excluded from the definition of Complication of Pregnancy including but not limited are: terminated ectopic pregnancy, hyperemesis gravidarium, gestational hypertension, gestational diabetes, miscarriage, occasional spotting, caesarean section, molar pregnancy and false labor.</span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">
                <?php $strContent = 'Complications of pregnancy, maternity and / or newborn during delivery (except congenital and hereditary conditions), including but not limited to as prematurity, low birth weight, hyperbilirubinemia, hypoglycemia, respiratory problems, and trauma during delivery will be covered in the following manner:'; 
                    $output = htmlentities($strContent, 0, "UTF-8");
                    if ($output == "") {
                        $output = htmlentities(utf8_encode($strContent), 0, "UTF-8");
                        $output = html_entity_decode($output);;
                    }
                    echo $output; 
                ?>              
              </span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">
                <span style="display: block;"><span style="display: inline-block; width: 20px; vertical-align: top;">a)</span> <span style="display: inline-block; width: calc(100% - 25px); vertical-align: top;">Lifetime maximum coverage: $500,000 per policy, maximum 1 maternity per policy year.</span></span>
                <span style="display: block;"><span style="display: inline-block; width: 20px; vertical-align: top;">b)</span> <span style="display: inline-block; width: calc(100% - 25px); vertical-align: top;">This benefit only applies as described in the maternity care coverage of this policy.</span></span>
                <span style="display: block;"><span style="display: inline-block; width: 20px; vertical-align: top;">c)</span> <span style="display: inline-block; width: calc(100% - 25px); vertical-align: top;">This benefit does not apply to complications related to any condition excluded under this policy, including but not limited to complications of maternity or newborn during delivery arising from a pregnancy that results from any type of fertility treatment or any type of assisted fertility procedure, or pregnancies not covered.</span></span>
                <span style="display: block;"><span style="display: inline-block; width: 20px; vertical-align: top;">d)</span> <span style="display: inline-block; width: calc(100% - 25px); vertical-align: top;">The complications caused by a condition that was diagnosed before the pregnancy, and/or any of its consequences will be covered under the terms of this policy.</span></span>
              </span>
            </td>
          </tr>

        </table>
      </td>
    </tr>
    
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    
    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="text-align: right;"><div class="left-image" style="display: inline-block; vertical-align: middle; text-align: center;"><img style="vertical-align: middle;" src="<?php echo MEDIA_IMAGES; ?>sign.jpg" /><p style="margin-top: 5px; font-size: 8px;">Authorized by the Underwriting Department</p></div><div class="right-image" style="display: inline-block; vertical-align: middle;"><img style="vertical-align: middle;" src="<?php echo MEDIA_IMAGES; ?>sign-logo.jpg" /></div></td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    
    <tr>
      <td colspan="10">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="7" style="text-align: right;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">Page 1 of 1</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>
    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br></td></tr>






</table>