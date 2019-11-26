<?php 

global $db; 

$uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$lastUriSegment = array_pop($uriSegments);


$sql="SELECT * FROM payments where id='".$lastUriSegment."' ";
$payment_info = $db->select_single($sql);

  //paycycle name by idpaycycle from policyinfo
$payCycle_name = getPayCyclebyid($payment_info['id_pay_cycle']);

$insuredLists = getPaymentsLists($payment_info['id_policy']);
$totalPremium = 0;
foreach($insuredLists as $inLists){
  $totalPremium+= $inLists['amount'];
}

$policyInfo = getSinglePolicy($payment_info['id_policy']);
$singleReceiptInfo=getsingleInfoReceiptLists($payment_info['id_policy']);

?>


<title>Payment Receipt</title>


<link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.ico"/>
<link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.png"/>


<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">


<table align="center" width="750" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

  <tbody>
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
                  <td align="left" colspan="2" style="padding:10px 10px;font-size: 15px;">
                    <strong>Payment made by:</strong><br>
                    <span style="font-size: 14px;font-weight: 500"><?= $payment_info['receipt_pay']!=''?$payment_info['receipt_pay'] : trim($singleReceiptInfo['receipt_pay']) ?><br>
                      <?= $payment_info['receipt_type']!=''?$payment_info['receipt_type'] : trim($singleReceiptInfo['receipt_type']) ?></span>
                    </td>
                    <td align="left" colspan="3" style="padding:10px 10px;font-size: 15px;">
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
