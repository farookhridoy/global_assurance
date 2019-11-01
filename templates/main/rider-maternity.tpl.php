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
              <span style="font-size: 16px;"><strong>SINGLE MOTHER MATERNITY RIDER</strong></span>
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
              <span style="font-size: 13px; display: block; padding-top: 5px;">The Eligible Benefits of a normal delivery, including prenatal consultations, delivery, medically necessary cesarean section delivery, birth complications and postnatal care for the mother and the newborn child. In country of residence Covered at $5,000 and the selected Certificate Deductible will not apply. Out of the country of residence there is no cover in the single mother maternity rider. The single mother of the child must be continuously covered under this Certificate for 12 months prior to delivery. Elective cesarean section delivery, including pre and postnatal care for the mother and the newborn child or complications thereof will be covered with the policy deductible and 20% co insurance first applied with a maximum total of $5,000. Waiver of deductible in country of residence does not apply. The Maternity Benefit does not apply to an Insured Person's who has selected deductibles of US$5,000 or higher.</span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">
                <?php $strContent = 'Los beneficios elegibles de un parto normal, incluyendo consultas prenatales, el parto, procedimiento de cesárea médicamente necesaria, complicaciones del nacimiento y la atención posnatal para la madre y el recién nacido. En el país de residencia cubre hasta US$ 5,000 y no se aplicará el Deducible. Fuera del país de residencia no hay cobertura en el Rider de maternidad para madre soltera. La madre soltera del niño debe ser continuamente cubierta por esta póliza de 12 meses antes del parto. Cesárea Electiva, incluyendo la atención pre y posnatal para la madre y el recién nacido o complicaciones del mismo será cubierto después del deducible de la póliza y el 20% de coaseguro aplica con un máximo total de US$ 5,000. Eliminación del deducible en el país de residencia no se aplica. Los beneficios de maternidad no se aplican a una persona asegurada que haya seleccionado deducibles de US$5,000 o superior.'; 
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