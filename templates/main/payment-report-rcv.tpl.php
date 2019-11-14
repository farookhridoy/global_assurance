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

  <style type="text/css" media="screen">
    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .page {
      width: 25cm;
      min-height: 29.7cm;
      padding: 2cm;
      margin: 1cm auto;
      
      border-radius: 5px;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
      padding: 1cm;
      
      height: 256mm;
      
    }

    @page {
      size: A4;
      margin: 0;
    }

    @media print {
      .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
      }
    }
  </style>

  <?php 
  $pd_count= count($paymentsData);
  if(count($paymentsData)>0){
    foreach($paymentsData as $payments_key => $payment_info){
      $payCycle_name = getPayCyclebyid($payment_info['id_pay_cycle']);

      $insuredLists = getPaymentsLists($payment_info['id_policy']);
      $totalPremium = 0;
      foreach($insuredLists as $inLists){
        $totalPremium+= $inLists['amount'];
      }

      $policyInfo = getSinglePolicy($payment_info['id_policy']);
      ?>
    <div class="page">
      <div class="subpage">
        
     
   
      <table align="center"  width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

        <tbody>

          <tr style="background-color: #fff;">
            <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;"> 
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
                    <span style="font-size: 19px;"><strong>PAYMENT RECEIPT:</strong></span><br><br>

                  </td>
                </tr>
              </table>
            </th>
            <th colspan="4" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;">


                <tr style="background: #f3f3f3;">
                  <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Paid Date:&nbsp;</strong></td>
                  <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo dateFormFormat($payment_info['date_paid']);?></td>
                </tr>
                <tr style="background: #f3f3f3;">
                  <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Due Date:&nbsp;</strong></td>
                  <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo dateFormFormat($payment_info['date_due']);?></td>
                </tr>

              </table>
            </th>
          </tr>


          <tr>
            <td colspan="10">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr bgcolor="#000">
                    <td style="color: #fff;padding:8px 8px;font-size: 13px;">Insured</td>
                    <td style="color: #fff;padding:8px 8px;font-size: 13px;">Policy Number</td>
                    <td style="color: #fff;padding:8px 8px;font-size: 13px;">Payment Cyde</td>
                    <td style="color: #fff;padding:8px 8px;font-size: 13px;">Amount</td>
                  </tr>
                  <tr>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"><?php echo getHealthPrimaryInsuredText($payment_info['id_policy']); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;" rowspan="3"><?php echo getPolicyNumberById($payment_info['id_policy']); ?></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;">

                      <?php echo $payCycle_name['paycycle']; ?>

                    </td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;">$<?php echo number_format($payment_info['amount'],2);?></td>
                  </tr>
                  <tr>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"><strong>Policy Fee</strong></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;">$<?php echo number_format($payment_info['fee'],2); ?></td>
                  </tr>
                  <tr>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"><strong>Total</strong></td>
                    <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;">$<?php echo number_format($payment_info['amount']+$payment_info['fee'],2);?></td>
                  </tr>

                  <tr style="background: #fff">
                    <td colspan="5"><br><br><br></td>
                  </tr>
                  <tr style="background: #fff">
                    <td align="left" colspan="2" style="padding:10px 10px;font-size: 15px; border-top: solid 1px #eee;">
                      <strong>Payment made by:</strong><br>
                      <span style="font-size: 14px;"><?=$payment_info['receipt_pay']?><br>
                        <?=$payment_info['receipt_type']?></span>
                      </td>
                      <td align="left" colspan="3" style="padding:10px 10px;font-size: 15px; border-top: solid 1px #eee;">
                        <strong>Notes:</strong><br>
                        <span style="font-size: 14px;"><?=$payment_info['receipt_note']?></span>
                      </td>
                    </tr>
                    <tr style="background: #fff">
                      <td colspan="5"><br>


                        <br></td>
                      </tr>



                      <tr><td colspan="5"><br><br><br><br></td></tr>
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

                      <tr style="background: #fff">
                        <td colspan="5"><br><br><br></td>
                      </tr>



                    </tbody>
                  </table>
                </td>
              </tr>

            </tbody>
          </table>
           </div>

          </div>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>

          <?php if ($payments_key + 1 != $pd_count) { ?>
            
          <?php } ?>
          <?php 
          } //end foreach
        }
        ?>
      
      
   