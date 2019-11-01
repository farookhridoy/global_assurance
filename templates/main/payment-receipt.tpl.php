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

?>

<!doctype html>
<html>
<head>
  <title>Payment Receipt</title>
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

  <table align="center" width="800" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

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
              <td colspan="2" style="padding:6px 15px;font-size: 13px;color: #000;"><strong>Date:&nbsp;</strong></td>
              <td align="right" colspan="2" style="color: #000;padding:6px 15px;font-size: 13px;"><?php echo dateFormFormat($payment_info['date_paid']);?></td>
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
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;"><?php echo $payment_info['amount'];?></td>
              </tr>
              <tr>
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"></td>
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;"><strong>Policy Fee</strong></td>
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;"><?php echo $policyInfo['fee']; ?></td>
              </tr>
              <tr>
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"></td>
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;"><strong>Total</strong></td>
                <td style="color: #000;padding:8px 8px;font-size: 12px;border-left: solid 1px #ccc;border-bottom: solid 1px #ccc;border-right: solid 1px #ccc;"><?php echo $payment_info['amount']+$policyInfo['fee'];?></td>
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

      </tbody></table>
    </body>

    </html>