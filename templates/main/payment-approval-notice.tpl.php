<?php 
  
  global $db; 

  $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  $lastUriSegment = array_pop($uriSegments);

    $sql="SELECT * FROM payments where id='".$lastUriSegment."' ";
    $payment_info = $db->select_single($sql);
  //paycycle name by idpaycycle from policyinfo
  $payCycle_name = getPayCyclebyid($payment_info['id_pay_cycle']);
  $policyInfo = getSinglePolicy($payment_info['id_policy']);
$policyAgents = loadHealthPolicyAgents($policyInfo['idagent']);

?>

<!doctype html>
<html>
<head>
  <title>Payment Approval Notice</title>
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

  <table align="center" width="700" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;font-size: 11px;">

    <tbody>
      <tr style="background-color: #fff;">
        <th colspan="9" align="right" style="padding: 10px;color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;font-weight: 700;">PAYMENTS/DISCOUNTS APPROVAL SHEET <?php  echo $agent_name = $agent['name']; ?>
        </th>
    
      </tr>
      <tr rowspan="3" style="background-color: #fff;">
        <th colspan="6" valign="top" align="left" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody><tr>
              <td><img src="<?php echo MEDIA_IMAGES; ?>claria-logo.png" width="150"></td>
            </tr>
            <tr>
              <td><br><br><br><br><br><br>
                <span style="font-size: 19px;"><strong>PAYMENTS/DISCOUNTS DETAILS:</strong></span>
              </td>
            </tr>
          </tbody></table>
        </th>
        <th colspan="4" style="color: #000; font-size: 20px;text-transform: capitalize;font-family: 'Montserrat', sans-serif;">
          <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="font-family: 'Montserrat', sans-serif;">
            <tbody>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Policy Number:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;"><?php echo getPolicyNumberById($payment_info['id_policy']); ?></td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Primary Insured:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;"><?php echo getHealthPrimaryInsuredText($payment_info['id_policy']); ?></td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Effective Date:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;"><?php echo date('m/d/Y', strtotime($policyInfo['effectivedate'])) ; ?></td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Agent L1:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;">
                    <?php 
                        $agentLvl1 = $policyAgents[2][0]['idagent'];
                            if($agentLvl1){
                                $agents = getAgentLists("health",1);
                                    if($agents){
                                      foreach($agents as $al_key => $al_vl){
                                        $selected_text = ( trim($policyAgents[2][0]['idagent']) == $al_vl['id']) ? $al_vl['name']: ''; 
                                        echo $selected_text;
                                    }
                                }
                            }else{
                                $agents = getAgentLists("health",1); 
                                if($agents){
                                    foreach($agents as $al_key => $al_vl){ 
                                      $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? $al_vl['name']: '';  
                                      echo $selected_text;
                                  }
                              }
                          }
                      ?>

                </td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Agent L2:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;">
                    <?php 
                        $agentLvl1 = $policyAgents[3][0]['idagent'];
                            if($agentLvl1){
                                $agents = getAgentLists("health",2);
                                    if($agents){
                                      foreach($agents as $al_key => $al_vl){
                                        $selected_text = ( trim($policyAgents[3][0]['idagent']) == $al_vl['id']) ? $al_vl['name']: ''; 
                                        echo $selected_text;
                                    }
                                }
                            }else{
                                $agents = getAgentLists("health",2); 
                                if($agents){
                                    foreach($agents as $al_key => $al_vl){ 
                                      $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? $al_vl['name']: '';  
                                      echo $selected_text;
                                  }
                              }
                          }
                      ?>


                </td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Agent L3:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;">
                    <?php 
                        $agentLvl1 = $policyAgents[4][0]['idagent'];
                            if($agentLvl1){
                                $agents = getAgentLists("health",3);
                                    if($agents){
                                      foreach($agents as $al_key => $al_vl){
                                        $selected_text = ( trim($policyAgents[4][0]['idagent']) == $al_vl['id']) ? $al_vl['name']: ''; 
                                        echo $selected_text;
                                    }
                                }
                            }else{
                                $agents = getAgentLists("health",3); 
                                if($agents){
                                    foreach($agents as $al_key => $al_vl){ 
                                      $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? $al_vl['name']: '';  
                                      echo $selected_text;
                                  }
                              }
                          }
                      ?>

                </td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Agent L4:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;">
                    <?php 
                        $agentLvl1 = $policyAgents[5][0]['idagent'];
                            if($agentLvl1){
                                $agents = getAgentLists("health",4);
                                    if($agents){
                                      foreach($agents as $al_key => $al_vl){
                                        $selected_text = ( trim($policyAgents[5][0]['idagent']) == $al_vl['id']) ? $al_vl['name']: ''; 
                                        echo $selected_text;
                                    }
                                }
                            }else{
                                $agents = getAgentLists("health",4); 
                                if($agents){
                                    foreach($agents as $al_key => $al_vl){ 
                                      $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? $al_vl['name']: '';  
                                      echo $selected_text;
                                  }
                              }
                          }
                      ?>
                </td>
              </tr>
              <tr style="background: #f3f3f3;">
                <td colspan="2" style="padding:10px 15px;font-size: 13px;color: #000;"><strong>Agent L5:</strong></td>
                <td align="right" colspan="2" style="color: #000;padding:10px 15px;font-size: 13px;"><?php 
                        $agentLvl1 = $policyAgents[6][0]['idagent'];
                            if($agentLvl1){
                                $agents = getAgentLists("health",5);
                                    if($agents){
                                      foreach($agents as $al_key => $al_vl){
                                        $selected_text = ( trim($policyAgents[6][0]['idagent']) == $al_vl['id']) ? $al_vl['name']: ''; 
                                        echo $selected_text;
                                    }
                                }
                            }else{
                                $agents = getAgentLists("health",5); 
                                if($agents){
                                    foreach($agents as $al_key => $al_vl){ 
                                      $selected_text = ($policyInfo['idagent'] == $al_vl['id']) ? $al_vl['name']: '';  
                                      echo $selected_text;
                                  }
                              }
                          }
                      ?></td>
              </tr>

            </tbody></table>
          </th>
        </tr>

        <tr>
          <td colspan="10">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td colspan="10" style="padding: 0;">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" style=" padding-right: 20px;"><span style="font-size: 14px;"><strong>DETAILS</strong></span></td>
                  <td valign="top"><span style="font-size: 14px;"><?php echo $payment_info['details']; ?></span></td>
                </tr>
                <tr>
                  <td valign="top" style=" padding-right: 20px; padding-top: 30px;"><span style="font-size: 14px;"><strong>PAYMENT</strong></span></td>
                  <td valign="top" style=" padding-top: 30px;"><span style="font-size: 14px;">$<?php echo $payment_info['amount']; ?></span></td>
                </tr>
                <tr>
                  <td valign="top" style=" padding-right: 20px; padding-top: 30px;"><span style="font-size: 14px;"><strong>&nbsp;</strong></span></td>
                  <td valign="top" style=" padding-top: 30px;">

                    <table>
                      <tr>
                        <td style="color: #000;padding:10px 15px 10px 0;font-size: 14px;">&nbsp;</td>
                        <td style="color: #000;padding:10px 15px;font-size: 14px;"><strong>DISCOUNTS</strong></td>
                      </tr>
                      <tr>
                        <td style="color: #000;padding:10px 15px 10px 0;font-size: 14px;">L1:</td>
                        <td style="color: #000;padding:10px 15px;font-size: 14px;">$<?php echo $payment_info['agent_1_discount']; ?></td>
                      </tr>
                      <tr>
                        <td style="color: #000;padding:10px 15px 10px 0;font-size: 14px;">L2:</td>
                        <td style="color: #000;padding:10px 15px;font-size: 14px;">$<?php echo $payment_info['agent_2_discount']; ?></td>
                      </tr>
                      <tr>
                        <td style="color: #000;padding:10px 15px 10px 0;font-size: 14px;">L3:</td>
                        <td style="color: #000;padding:10px 15px;font-size: 14px;">$<?php echo $payment_info['agent_3_discount']; ?></td>
                      </tr>
                      <tr>
                        <td style="color: #000;padding:10px 15px 10px 0;font-size: 14px;">L4:</td>
                        <td style="color: #000;padding:10px 15px;font-size: 14px;">$<?php echo $payment_info['agent_4_discount']; ?></td>
                      </tr>
                      <tr>
                        <td style="color: #000;padding:10px 15px 10px 0;font-size: 14px;">L5:</td>
                        <td style="color: #000;padding:10px 15px;font-size: 14px;">$<?php echo $payment_info['agent_5_discount']; ?></td>
                      </tr>
                    </table>

                  </td>
                </tr>

                <tr>
                  <tr>
                    <td colspan="14"><br><br><br><br></td>
                  </tr>
                  <td colspan="10">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tbody><tr>
                        <td colspan="4">
                          <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tbody><tr>
                              <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                                <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Authorized Signature</span>
                              </td>
                              <td align="center" width="50%" style="padding: 0; font-size: 14px;">
                                <span style="width: 250px; border-top: solid 1px #999; padding-top: 5px; display: block;">Date</span>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

  </body>

  </html>