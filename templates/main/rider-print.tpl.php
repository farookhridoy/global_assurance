<?php
global $insuredInfo,$db,$riderinfo,$footerFunctions;
$footerFunctions = array("scriptHealthRateup");

//print_r($insuredInfo);

if($insuredInfo){
    $policyinfo = getSinglePolicy($insuredInfo['idpolicy']);
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
          <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Deadline Date:</strong></td>
          <td width="60%" align="right"><span style="height: 22px; display: block; background: #fff; border: solid 1px #bbb; padding-right: 15px;"><?php $Date = dateFormFormat($riderinfo['date_sent'],"m/d/y"); echo date('m/d/y', strtotime($Date. ' + 21 days')); ?></span></td>
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
              <span style="font-size: 14px;"><strong>Name of insured:</strong> <?php echo $riderinfo['name']; ?></span>
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
              <span style="font-size: 16px;"><strong><?php echo $riderinfo['title']; ?></strong></span>
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
            <td colspan="7" style="text-align: center;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">"In addition to the terms, conditions and exclusions detailed in the Policy, benefits will be covered up to a life time maximum of USD$100,000.00 and a USD$10,000.00 limit per annual period of coverage after the insured person has been continuously covered for 12 months and the selected certificate deductible and/or coinsurance has been applied under any Section of the Policy in respect of any claims which, in the opinion of our medical advisors, arise either directly or indirectly as a result of Breast Tumors or its complication thereafter and all related illnesses, treatments, consequences, diagnoses in which this condition is associated and / or a later diagnosis of another condition in which one of the symptoms is Breast Tumors." PERMANENT</span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: center;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">
                <?php $strContent = '"Además de los términos, condiciones y exclusiones detallados en el contrato de la p?liza, los beneficios ser?n cubiertos hasta un máximo de USD$100,000.00 por vida de la p?liza y de USD$10,000.00 como l?mite por período anual de cobertura después que el asegurado haya estado continuamente cubierto durante 12 meses y el deducible/o coaseguro seleccionado en el certificado de la p?liza ha sido aplicado. Estos beneficios ser?n pagaderos con respecto a reclamos en los cuales, en la opinión de nuestros asesores médicos, se deben directa o indirectamente como resultado de Tumores de Mama o de sus complicaciones a partir de entonces y todas las enfermedades relacionadas, tratamientos, consecuencias y diagnósticos en el que esta condición está asociada y / o un diagnóstico posterior de otra condición en la que uno de los síntomas es Tumores de Mama. "PERMANENTE'; 
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
            <td colspan="7" style="text-align: center;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">La versi&oacute;n en Ingl&eacute;s de la Exclusi&oacute;n ser&aacute; el contrato oficial; el p&aacute;rrafo en el Idioma Espa&ntilde;ol es una traducci&oacute;n con car&aacute;cter informativo.</span>
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
              <span style="font-size: 13px; display: block; padding-top: 5px;"><strong>If Global Assurance Group does not receive a signed verification before the deadline date listed above claims incurred shall not be considered eligible for payment and/or policy may be cancelled at the administrator's discretion.</strong></span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;">
                <strong>I UNDERSTAND, ACCEPT AND HEREBY AGREE WITH THE UNDERWRITER TO MODIFY THE TERMS OF MY COVERAGE AS DESCRIBED ABOVE EFFECTIVE ON THE DATE STATED ABOVE.</strong>             
              </span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;"><strong>SIGNATURE OF INSURED OR GUARDIAN: ________________________________</strong></span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7" style="text-align: left;">
              <span style="font-size: 13px; display: block; padding-top: 5px;"><strong>DATE: _____________</strong></span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
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