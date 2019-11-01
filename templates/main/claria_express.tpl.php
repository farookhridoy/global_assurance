<?php global $policyInfo,$db; 
//print_r($policyInfo);

$insuredLists = getHealthInsuredLists($policyInfo['id']);

$sql="SELECT * FROM relation WHERE active ='1' AND policytype='health'";
$relationData = $db->select($sql);

//echo '<pre>';
//print_r($insuredLists);

?>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tr style="background-color: #fff;">
    <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">Print Policy
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
          <td colspan="10" style="padding: 0;">&nbsp;</td>
        </tr>
        
        <tr bgcolor="#000">
          <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">First Name</td>
          <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">Last Name</td>
          <td align="center" style="color: #fff;padding:8px 8px;font-size: 13px;">Relation</td>
        </tr>
        <?php foreach($insuredLists as $singleinsured){
              $relation = getRelationbyid($singleinsured['idrelation']);
              //echo '<pre>';
              //print_r($rateups);  
        ?>
        <tr>
          <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singleinsured['first_name']; ?></td>
          <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $singleinsured['last_name']; ?></td>
          <td align="center" style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $relation; ?></td>
        </tr>
        <?php }?>
      </table>
    </td>
  </tr>

    <tr><td colspan="7" style="padding: 0;">&nbsp;<br>&nbsp;<br><br></td></tr>
    <tr>
      <td colspan="10" align="center">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" colspan="7" style="padding: 0;">
              <span style="font-size: 16px;"><strong>ADDENDUM</strong></span>
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
            <td colspan="7">
              <span style="font-size: 13px;"><strong><u>Elimination of Deductible</u></strong></span><br>
              <span style="font-size: 13px; display: block; padding-top: 5px;">Elimination of deductible towards inpatient and outpatient benefits in the country of residence. Only one deductible applies per policy, per family in every policy year.</span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7">
              <span style="font-size: 13px;"><strong><u>Freedom to Choose</u></strong></span><br>
              <span style="font-size: 13px; display: block; padding-top: 5px;">Worldwide<br>
                Freedom to choose any doctor or medical facility anywhere in the world.<br><br>

                Within the United States<br>
                Access to the PHCS network provider and STAR Preferred Network for all the plans.<br>
                Within the STAR network the insured person will have:<br>
                - A reduction in the deductible of up $1,000.<br>
                - No co-insurance.<br>
                - A reimbursement of up to $500 for a round trip airline ticket.
              </span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7">
              <span style="font-size: 13px;"><strong><u>Single Mother Maternity Coverage</u></strong></span><br>
              <span style="font-size: 13px; display: block; padding-top: 5px;">The coverage for Single Mother Maternity for the Main Insured will be as follows: the Eligible Benefits of a normal delivery, including prenatal consultations, delivery, medically necessary cesarean section delivery, birth complications and postnatal care for the mother and the newborn child. In country of residence Covered at $4,000 and the selected Certificate Deductible will not apply. Outside the country of residence there is no coverage in the single mother maternity rider. The single mother of the child must be continuously covered under this Certificate for 12 months prior to delivery. Elective cesarean section delivery, including pre and postnatal care for the mother and the newborn child or complications thereof will be covered with the policy deductible and 20% co insurance first applied with a maximum total of $3,000. Waiver of deductible in country of residence does not apply for any maternity or newborn benefits that are the result of an Elective Cesarean Section Delivery. The Maternity Benefit does not apply to an Insured Person who has selected deductibles of $5,000 or higher. </span>
            </td>
          </tr>
          <tr><td colspan="7"><br></td></tr>
          <tr>
            <td colspan="7">
              <span style="font-size: 13px;"><strong><u>Accidental Death Coverage</u></strong></span><br>
              <span style="font-size: 13px; display: block; padding-top: 5px;">The Policy provides a Maximum Principal Sum of $20,000 for an Accidental Death of the Main Insured, $10,000 for the Spouse and $5,000 per child.</span>
            </td>
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





</table>