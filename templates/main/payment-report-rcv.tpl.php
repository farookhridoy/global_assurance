<?php 
global $datePicker,$footerFunctions,$policyInfo,$policyNotes,$insuredLists,$insuredInfo,$db,$checkPermissionRole,$paymentsList;$datePicker = array("date_cancelled","effective_date","date_due","date_received","date_approved","payment_start","payment_end"); 
$checkPermissionRole = checkUserAccessRole('Policies');
$footerFunctions = array("scriptHealthNew","scriptHealthRateup");

require_once('BrowserDetection-master/lib/BrowserDetection.php');

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



<?php 

if(count($paymentsData)>0){
  $count=0;
  foreach($paymentsData as $payments_key => $payment_info){
    $payCycle_name = getPayCyclebyid($payment_info['id_pay_cycle']);
    $policyInfo = getSinglePolicy($payment_info['id_policy']);
    $singleReceiptInfo=getsingleInfoReceiptLists($payment_info['id_policy']);
    if ($count==$payments_key) {

    }else{
      $style="style='margin-top:10px'";
    }
    ?>
    
    <title>Payment Receipt</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    

    <link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.ico"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.png"/>

    <?php 
    $browser = new Wolfcast\BrowserDetection();
    if ($browser->getName() == Wolfcast\BrowserDetection::BROWSER_EDGE) {
      ?>
      <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>bootstrap.min.css"/>
    <?php } ?>


    <style type="text/css" media="screen">
      * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
      }
      .page {
        width: 25cm;
        min-height: 25.7cm;
        padding: 1cm;
        margin: 1cm auto;

        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      }


      @page {
        size: A4;
        height: 800px;
        margin: 1cm auto;
        padding: 1cm;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 200px;
      }

      @media print {
        .page {
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

    
    
    <div class="page" <?=$style?>>
      <div class="subpage">
        <table align="center" width="750" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">
         <tr>
          <th colspan="2" align="center"><img src="<?php echo MEDIA_IMAGES; ?>commission-paid-header.jpg" alt="image"/></th>
        </tr>
        <tr style="background-color: #fff;">
          <th colspan="10" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td align="left">
                    <br><br>
                    <span style="font-size: 19px;"><strong>PAYMENT RECEIPT</strong></span><br>
                    <span style="font-size: 16px; font-weight: 500; padding-top: 5px;">Federal Tax ID #650771090</span>
                    <br><br><br>
                  </td>
                  <td align="right"><strong style="font-size: 16px;">Date:&nbsp;</strong>
                    <span style="font-size: 14px; font-weight: 500"><?php echo date('d-M-y',strtotime($payment_info['date_paid']));?></span></td>
                  </tr>
                </tbody>
              </table>
            </th>

          </tr>
          <tr>
            <td colspan="10">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr style="background-color: lightgray;">
                    <td style="color: black;padding:8px 8px;font-size: 13px;font-weight: 800;border: 1px solid darkgray;">Insured</td>
                    <td style="color: black;padding:8px 8px;font-size: 13px;font-weight: 800;border: 1px solid darkgray;">Policy Number</td>
                    <td style="color: black;padding:8px 8px;font-size: 13px;font-weight: 800;border: 1px solid darkgray;">Payment Cyde</td>
                    <td style="color: black;padding:8px 8px;font-size: 13px;font-weight: 800;border: 1px solid darkgray;">Amount</td>

                    <tr>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;font-weight: 600;border-left: solid 1px #ccc;"><?php echo getHealthPrimaryInsuredText($payment_info['id_policy']); ?></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;font-weight: 600;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;" rowspan="3"><?php echo getPolicyNumberById($payment_info['id_policy']); ?></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;font-weight: 600;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"><?php echo $payCycle_name['paycycle']; ?></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;font-weight: 600;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;">$<?php echo number_format($payment_info['amount'],2);?></td>
                    </tr>
                    <tr>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"><strong>Policy Fee</strong></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px; font-weight: 600 ;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;">$<?php echo number_format($payment_info['fee'],2); ?></td>
                    </tr>
                    <tr>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"><strong>Total</strong></td>
                      <td style="color: #000;padding:8px 8px;font-size: 12px;font-weight: 600 ;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;">$<?php echo number_format($payment_info['amount']+$payment_info['fee'],2);?></td>
                    </tr>

                    <tr>
                      <td colspan="5"><br><br><br></td>
                    </tr>
                    <tr style="background: #fff">
                      <td align="left" colspan="2" style="padding:10px 10px;font-size: 15px; ">
                        <strong>Payment made by:</strong><br>
                        <span style="font-size: 14px;font-weight: 500"><?= $payment_info['receipt_pay']!=''?$payment_info['receipt_pay'] : trim($singleReceiptInfo['receipt_pay']) ?><br>
                          <?= $payment_info['receipt_type']!=''?$payment_info['receipt_type'] : trim($singleReceiptInfo['receipt_type']) ?></span>
                        </td>
                        <td align="left" colspan="3" style="padding:10px 10px;font-size: 15px; ">
                          <strong>Notes:</strong><br>
                          <span style="font-size: 14px;font-weight: 500"><?= $payment_info['receipt_note']!=''?$payment_info['receipt_note'] : trim($singleReceiptInfo['receipt_note']) ?></span>
                        </td>
                      </tr>
                      <tr style="background: #fff">
                        <td colspan="5"><br>
                          <img src="<?php echo MEDIA_IMAGES; ?>leylasignature.png" alt="signature"/>

                          <br></td>
                        </tr>



                        <tr>
                          <td colspan="10" align="left">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                              <tr>
                                <td colspan="4" align="left">
                                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td align="left" width="50%" style="padding: 0; font-size: 14px;">
                                        <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">
                                          <center><strong style="color: #1e3c87">Leyla Viera</strong></center>
                                          <center style="color: #c69308">Accounting Analyst</center>
                                        </span>
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
                <tr>
                  <th colspan="4" align="center"><img src="<?php echo MEDIA_IMAGES; ?>commission-paid-footer.jpg" alt="image"/></th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <?php 
          } //end foreach
        }
        ?>