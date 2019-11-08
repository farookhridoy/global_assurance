<?php 
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole,$paymentsList;$datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");

$policyCycle = getPayCycleLists();

$user_id = state('user_id');
$user_name = state("user_name");


if (isset($_POST['print_receipt_btn'])) {

    if (count($_POST['payment_id'])>0) {

        $sql="SELECT * FROM payments WHERE  id IN";
        $sql .= '(';
        foreach($_POST['payment_id'] as $value){
         $sql .= ''.$value.',';
     }
     $sql = rtrim($sql,",");
     $sql .= ')';
     $paymentsData = $db->select($sql);

 }else{
    $_SESSION["error"]='Please select payment receipts.';
    header('Location: '.THE_URL."main/receipts/");
}
}

?>
<!doctype html>
<html>
<head>
  <title>Payment Receipt Report</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <meta name="robots" content="noindex"/>
  <meta name="robots" content="nofollow"/>

  <link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.ico"/>
  <link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.png"/>

  <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>bootstrap.min.css"/>


  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">

</head>
<body>
  <table align="center" width="1200" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;margin-top: 50px;">

    <tbody>

      <tr rowspan="3" style="background-color: #fff;">
        <th colspan="6" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>

              <tr>
                <td><br><br>
                  <span style="font-size: 19px;"><strong>Recieved Payment Report</strong></span>
              </td>
          </tr>
      </tbody></table>
  </th>
  <th colspan="4" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;">
      <tbody><tr style="background: #f3f3f3;">
        <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>From:</strong></td>
        <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;"><?=trim($_POST['from_date']);?></td>
    </tr>
    <tr style="background: #f3f3f3;">
        <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>To:</strong></td>
        <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;"><?=trim($_POST['to_date']);?></td>
    </tr>
    
</tbody></table>
</th>
</tr>

<tr>
  <td colspan="10">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td colspan="10" style="padding: 0;">&nbsp;</td>
    </tr>
    <tr bgcolor="#000">
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Type</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Amount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Policy Number</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Insured Name</td>
        
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Policy Fee Amount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L1 Discount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L2 Discount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L3 Discount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L4 Discount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L5 Discount</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Date Due</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Date Paid</td>
        
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Effective date</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L1</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L2</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L3</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L4</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Agent L5</td>
        <td style="color: #fff;padding:8px 8px;font-size: 13px;">Pay Cicle</td>
        
    </tr>

    <?php

    $ins_loop = 1;
    if(count($paymentsData)>0){
        foreach($paymentsData as $payments_key => $payments_value){
            $policyInfo=getSinglePolicy($payments_value['id_policy']);
            $payCycle_name = getPayCyclebyid($payments_value['id_pay_cycle']);

            $agent_name1 = getSingleAgentNameById($policyInfo['idagent'],1);
            $agent_name2 = getSingleAgentNameById($policyInfo['idagent'],2);
            $agent_name3 = getSingleAgentNameById($policyInfo['idagent'],3);
            $agent_name4 = getSingleAgentNameById($policyInfo['idagent'],4);
            $agent_name5 = getSingleAgentNameById($policyInfo['idagent'],5);
            ?>

            <tr>
                <td style="color: #000;padding:8px 8px;font-size: 12px;">
                    <?php $paytype = getPayTypeLists(); 
                    if($paytype)
                        {foreach($paytype as $pt_key => $pt_value)
                            {
                                echo $selected_text = ($payments_value['id_pay_type'] == $pt_key) ? $pt_value: ''; 

                            }
                        } 
                        ?>
                    </td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['amount'],2);?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $policyInfo['policynumber']; ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo getHealthPrimaryInsuredText($payments_value['id_policy']); ?></td>
                    
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['fee'],2); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['agent_1_discount'],2); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['agent_2_discount'],2); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['agent_3_discount'],2); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['agent_4_discount'],2); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;">$<?php echo number_format($payments_value['agent_5_discount'],2); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo dateFormFormat($payments_value['date_due']); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo dateFormFormat($payments_value['date_paid']); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo dateFormFormat($policyInfo['effectivedate']); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?=$agent_name1?></td>

                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?=$agent_name2?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?=$agent_name3?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?=$agent_name4?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?=$agent_name5?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;"><?php echo $payCycle_name['paycycle']; ?></td>
                    
                    
                </tr>


                <?php 
                $ins_loop++;
                                            } //end foreach
                                        }
                                        ?>
                                    </tbody></table>
                                </td>
                            </tr>



                        </tbody></table>
                    </body>

                    </html>