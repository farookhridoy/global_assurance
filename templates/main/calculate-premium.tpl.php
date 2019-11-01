<? /*header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Report.doc");*/
?>
<?php global $insuredInfo,$footerFunctions,$policyInfo,$insuredLists,$db;

$footerFunctions = array("scriptHealthRateup");
//print_r($policyInfo);

function clean($string) {
   $string = str_replace(' ', '', $string);

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

//$insuredInfo = getHealthSingleInsured($policyInfo['id']);
$insuredLists = getHealthInsuredLists($policyInfo['id']);
//echo '<br>';
//print_r($insuredLists);
$totalPremium = 0;
foreach($insuredLists as $inLists){
    $totalPremium+= $inLists['premium'];
}

$policyCycle = getPayCycleLists();
//print_r($policyCycle);
foreach($policyCycle as $keyCycle => $valCycle){
    if($keyCycle == $policyInfo['idpaycycle'])
    $policyType = $valCycle;
}

$policyCountry = getCountryLists();
//print_r($policyCycle);
foreach($policyCountry as $keyCountry => $valCountry){
    if($keyCountry == $policyInfo['idcountry'])
    $insuredCountry = $valCountry;
}

$PolicyCoverage = getPolicyCoverages($policyInfo['idplan']);
//print_r($PolicyCoverage);
foreach($PolicyCoverage as $keyCoverage => $valCoverage){
    if($keyCoverage == $policyInfo['idcoverage'])
    $totalCoverage = $valCoverage;
}

$PolicyDeductible = getPolicyDeductibles($policyInfo['idcoverage']);
//print_r($PolicyDeductible);
foreach($PolicyDeductible as $keyDeductible => $valDeductible){
    if($valDeductible['id'] == $policyInfo['iddeductible'])
    echo $totalDeductible = clean($valDeductible['deductible']);
}

$policyPlan = $policyInfo['idplan'];
if($policyInfo['premium_zone'] == 'world'){$premiumZone = 'other';}
else{$premiumZone = $policyInfo['premium_zone'];}
$premiumZone;

if($policyPlan != 1){
$sql="SELECT * FROM rate_table WHERE plan ='$policyPlan' AND coverage ='$totalCoverage' AND deductible ='$totalDeductible' AND rate_country ='$premiumZone'";
$rateData = $db->select($sql);
//echo '<br>';
//print_r($rateData);
foreach($rateData as $rData){
    if($rData['age'] == '0-10'){
        $premium1 = $rData['premium'];
    }elseif($rData['age'] == '11-17'){
        $premium2 = $rData['premium'];
    }elseif($rData['age'] == '18-29'){
        $premium3 = $rData['premium'];
    }elseif($rData['age'] == '30-39'){
        $premium4 = $rData['premium'];
    }elseif($rData['age'] == '40-49'){
        $premium5 = $rData['premium'];
    }elseif($rData['age'] == '50-59'){
        $premium6 = $rData['premium'];
    }elseif($rData['age'] == '60-64'){
        $premium7 = $rData['premium'];
    }elseif($rData['age'] == '65-69'){
        $premium8 = $rData['premium'];
    }
}


?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="<?php echo THE_URL; ?>"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Open Policy Record</a></li>
              <li>Calculate Premium</li>
            </ul>
          </div><!-- page-breadcrumbs END -->

          <h1 class="page-titlename">Calculate Premium</h1>
        

          <div class="content_section_aside">
            <div class="row">
            
            <script type="text/javascript">
                        function redirectPolicy (sel) {
                            var url = sel[sel.selectedIndex].value;
                            window.location = url;
                        }
                      </script>
              
              <div class="col-md-8">
                  <div class="contryin_life">
                    <div class="row">
                      <div class="col-md-5 ">
                        <label class="formheading">Select Policy Number</label>
                        <span class="form-select">
                          <select class="form-control" onchange="redirectPolicy(this);">
                            <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){$selected_text = ($policyInfo['id'] == $hp_value['id']) ? 'selected="selected"': ''; echo '<option value="'. THE_URL.'main/calculate-premium/'.$hp_value['id'].'" '.$selected_text.'>'.$hp_value['policynumber'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="col-md-2 ">
                        <label class="formheading">&nbsp;</label>
                        <div class="btn btn-primary bgorange"><a href="javascript:void(0);" onclick="form_submit()">Save</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- content_section_aside END -->


          <div class="content_section_aside">
            <div class="table_overlay">
            <form method="post" action="" onsubmit="return calculate_premium_form_submit()" id="form_calculate_premium">
              <table class="tableContent tableNothover">
                <tr>
                    <th class="mediumcontrolform">Name</th>
                    <th class="smcontrolform">DOB</th>
                    <th class="mediumcontrolform">Age</th>
                    <th class="mediumcontrolform">Effective Date</th>
                    <th class="mediumcontrolform">Base Premium</th>
                    <th class="mediumcontrolform">Premium</th>
                </tr>
              <?php $insuredCount = 1; foreach($insuredLists as $inLists){
                $sql_rate="SELECT * FROM rateup WHERE idinsured ='".$inLists['id']."'";
                $rateupData = $db->select($sql_rate);
                //print_r($rateupData);
                if($rateupData){
                    foreach($rateupData as $rupData){
                        $sql_rateType="SELECT * FROM rateuptypes WHERE id ='".$rupData['idrateuptype']."'";
                        $rateupTypeData = $db->select($sql_rateType);
                        if($rateupTypeData){
                            foreach($rateupTypeData as $ruptypeData){
                                if($ruptypeData['rateuppercent'] != 0){$percentData += $ruptypeData['rateuppercent'];}
                                if($ruptypeData['rateupamount'] != 0){
                                    if($ruptypeData['id'] == 9 || $ruptypeData['id'] == 20 || $ruptypeData['id'] == 22){
                                        $amountDataStudentUs += $ruptypeData['rateupamount'];
                                    }else{
                                        $amountData += $ruptypeData['rateupamount'];
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $percentData = 0;
                    $amountData = 0;
                    $amountDataStudentUs = 0;
                }
                
                ?>
                <tr class="insured-data">
                  <td style="display: none;" class="smcontrolform"><input id="insuredId" type="hidden" readonly="readonly" disabled="disabled" class="form-control" name="insuredId" value="<?php echo $inLists['id'];?>"></td>
                  <td class="bigcontrolform"><input id="insuredName" type="text" class="form-control" name="insuredName" value="<?php echo $inLists['first_name'].' '.$inLists['last_name'];?>"></td>
                  <td class="mediumcontrolform"><input id="insuredDob" type="text" class="form-control" name="insuredDob" value="<?php echo dateFormFormat($inLists['dob']);?>"></td>
                  <td class="smcontrolform"><input id="insuredAge" type="text" class="form-control" name="insuredAge" value="<?php echo $inLists['age'];?>"></td>
                  <td class="mediumcontrolform"><input id="insuredEffectiveDate" type="text" class="form-control" name="insuredEffectiveDate" value="<?php echo dateFormFormat($inLists['effectivedate']);?>"></td>
                  <!-- Base Premium Start -->
                  <?php if($inLists['age'] < 11){
                    $basePremium = $premium1;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;} 
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 10 && $inLists['age'] < 18){
                    $basePremium = $premium2;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 17 && $inLists['age'] < 30){
                    $basePremium = $premium3;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2); 
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 40){
                    $basePremium = $premium4;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 50){
                    $basePremium = $premium5;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 60){
                    $basePremium = $premium6;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 59 && $inLists['age'] < 65){
                    $basePremium = $premium7;
                    //if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 64 && $inLists['age'] < 70){
                    $basePremium = $premium8;
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }?>
                      
                  <!-- Premium Start -->
                  <?php if($inLists['age'] < 11){
                    $basePremium = $premium1;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 10 && $inLists['age'] < 18){
                    $basePremium = $premium2;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 17 && $inLists['age'] < 30){
                    $basePremium = $premium3;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 40){
                    $basePremium = $premium4;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2); 
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 50){
                    $basePremium = $premium5;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 60){
                    $basePremium = $premium6;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 59 && $inLists['age'] < 65){
                    $basePremium = $premium7;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 64 && $inLists['age'] < 70){
                    $basePremium = $premium8;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 'Claria'){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2); 
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }?>
                </tr>
              <?php $insuredCount++; }?>
              </table>
            </form>
            </div><!-- table_overlay END -->
          </div><!-- END content_section_aside -->


         


          </div>
          <div class="clearfix"></div>


</div>
<?php }else{
    
$sqlMundial="SELECT * FROM rate_table_mundial WHERE plan ='$policyPlan' AND coverage ='$totalCoverage' AND deductible ='$totalDeductible' AND rate_country ='$premiumZone'";
$rateDataMundial = $db->select($sqlMundial);
echo '<br>';
print_r($rateDataMundial);
foreach($rateDataMundial as $rMunData){
    if($rMunData['age'] == '18-24'){
        $premium1 = $rMunData['premium'];
    }elseif($rMunData['age'] == '25-29'){
        $premium2 = $rMunData['premium'];
    }elseif($rMunData['age'] == '30-34'){
        $premium3 = $rMunData['premium'];
    }elseif($rMunData['age'] == '35-39'){
        $premium4 = $rMunData['premium'];
    }elseif($rMunData['age'] == '40-44'){
        $premium5 = $rMunData['premium'];
    }elseif($rMunData['age'] == '45-49'){
        $premium6 = $rMunData['premium'];
    }elseif($rMunData['age'] == '50-54'){
        $premium7 = $rMunData['premium'];
    }elseif($rMunData['age'] == '55-59'){
        $premium8 = $rMunData['premium'];
    }elseif($rMunData['age'] == '1dependent'){
        $premium9 = $rMunData['premium'];
    }elseif($rMunData['age'] == '2dependents'){
        $premium10 = $rMunData['premium'];
    }elseif($rMunData['age'] == '3plusdependent'){
        $premium11 = $rMunData['premium'];
    }elseif($rMunData['age'] == '60'){
        $premium12 = $rMunData['premium'];
    }elseif($rMunData['age'] == '61'){
        $premium13 = $rMunData['premium'];
    }elseif($rMunData['age'] == '62'){
        $premium14 = $rMunData['premium'];
    }elseif($rMunData['age'] == '63'){
        $premium15 = $rMunData['premium'];
    }elseif($rMunData['age'] == '64'){
        $premium16 = $rMunData['premium'];
    }elseif($rMunData['age'] == '65'){
        $premium17 = $rMunData['premium'];
    }elseif($rMunData['age'] == '66'){
        $premium18 = $rMunData['premium'];
    }elseif($rMunData['age'] == '67'){
        $premium19 = $rMunData['premium'];
    }elseif($rMunData['age'] == '68'){
        $premium20 = $rMunData['premium'];
    }elseif($rMunData['age'] == '69'){
        $premium21 = $rMunData['premium'];
    }
}


$Count = 1;
foreach($insuredLists as $inListsD){
    if($inListsD['age'] < 23 && $inListsD['studentus'] != ''){
        $dependentCountStudent += $Count;
    }
    if($inListsD['age'] < 19){
        $dependentCount += $Count;
    }
}
$totalDependentCount = $dependentCountStudent + $dependentCount;
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="<?php echo THE_URL; ?>"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Open Policy Record</a></li>
              <li>Calculate Premium</li>
            </ul>
          </div><!-- page-breadcrumbs END -->

          <h1 class="page-titlename">Calculate Premium</h1>
        

          <div class="content_section_aside">
            <div class="row">
            
            <script type="text/javascript">
                        function redirectPolicy (sel) {
                            var url = sel[sel.selectedIndex].value;
                            window.location = url;
                        }
                      </script>
              
              <div class="col-md-8">
                  <div class="contryin_life">
                    <div class="row">
                      <div class="col-md-5 ">
                        <label class="formheading">Select Policy Number</label>
                        <span class="form-select">
                          <select class="form-control" onchange="redirectPolicy(this);">
                            <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){$selected_text = ($policyInfo['id'] == $hp_value['id']) ? 'selected="selected"': ''; echo '<option value="'. THE_URL.'main/calculate-premium/'.$hp_value['id'].'" '.$selected_text.'>'.$hp_value['policynumber'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="col-md-2 ">
                        <label class="formheading">&nbsp;</label>
                        <div class="btn btn-primary bgorange"><a href="javascript:void(0);" onclick="form_submit()">Save</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- content_section_aside END -->


          <div class="content_section_aside">
            <div class="table_overlay">
            <form method="post" action="" onsubmit="return calculate_premium_form_submit()" id="form_calculate_premium">
              <table class="tableContent tableNothover">
                <tr>
                    <th class="mediumcontrolform">Name</th>
                    <th class="smcontrolform">DOB</th>
                    <th class="mediumcontrolform">Age</th>
                    <th class="mediumcontrolform">Effective Date</th>
                    <th class="mediumcontrolform">Base Premium</th>
                    <th class="mediumcontrolform">Premium</th>
                </tr>
              <?php $insuredCount = 1; foreach($insuredLists as $inLists){
                $sql_rate="SELECT * FROM rateup WHERE idinsured ='".$inLists['id']."'";
                $rateupData = $db->select($sql_rate);
                //print_r($rateupData);
                if($rateupData){
                    foreach($rateupData as $rupData){
                        $sql_rateType="SELECT * FROM rateuptypes WHERE id ='".$rupData['idrateuptype']."'";
                        $rateupTypeData = $db->select($sql_rateType);
                        if($rateupTypeData){
                            foreach($rateupTypeData as $ruptypeData){
                                if($ruptypeData['rateuppercent'] != 0){$percentData += $ruptypeData['rateuppercent'];}
                                if($ruptypeData['rateupamount'] != 0){
                                    if($ruptypeData['id'] == 9 || $ruptypeData['id'] == 20 || $ruptypeData['id'] == 22){
                                        $amountDataStudentUs += $ruptypeData['rateupamount'];
                                    }else{
                                        $amountData += $ruptypeData['rateupamount'];
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $percentData = 0;
                    $amountData = 0;
                    $amountDataStudentUs = 0;
                }
                
                ?>
                <tr class="insured-data">
                  <td style="display: none;" class="smcontrolform"><input id="insuredId" type="hidden" readonly="readonly" disabled="disabled" class="form-control" name="insuredId" value="<?php echo $inLists['id'];?>"></td>
                  <td class="bigcontrolform"><input id="insuredName" type="text" class="form-control" name="insuredName" value="<?php echo $inLists['first_name'].' '.$inLists['last_name'];?>"></td>
                  <td class="mediumcontrolform"><input id="insuredDob" type="text" class="form-control" name="insuredDob" value="<?php echo dateFormFormat($inLists['dob']);?>"></td>
                  <td class="smcontrolform"><input id="insuredAge" type="text" class="form-control" name="insuredAge" value="<?php echo $inLists['age'];?>"></td>
                  <td class="mediumcontrolform"><input id="insuredEffectiveDate" type="text" class="form-control" name="insuredEffectiveDate" value="<?php echo dateFormFormat($inLists['effectivedate']);?>"></td>
                  <!-- Base Premium Start -->
                  <?php if($inLists['age'] > 17 && $inLists['age'] < 25){
                    $basePremium = $premium1;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;} 
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 24 && $inLists['age'] < 30){
                    $basePremium = $premium2;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 35){
                    $basePremium = $premium3;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2); 
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 34 && $inLists['age'] < 40){
                    $basePremium = $premium4;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 45){
                    $basePremium = $premium5;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 44 && $inLists['age'] < 50){
                    $basePremium = $premium6;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 55){
                    $basePremium = $premium7;
                    //if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 54 && $inLists['age'] < 60){
                    $basePremium = $premium8;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 60){
                    $basePremium = $premium12;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 61){
                    $basePremium = $premium13;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 62){
                    $basePremium = $premium14;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 63){
                    $basePremium = $premium15;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 64){
                    $basePremium = $premium16;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 65){
                    $basePremium = $premium17;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 66){
                    $basePremium = $premium18;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 67){
                    $basePremium = $premium19;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 68){
                    $basePremium = $premium20;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 69){
                    $basePremium = $premium21;
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    //if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);} 
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }?>
                      
                  <!-- Premium Start -->
                  <?php if($inLists['age'] > 17 && $inLists['age'] < 25 && $inLists['studentus'] == ''){
                    $basePremium = $premium1;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 24 && $inLists['age'] < 30){
                    $basePremium = $premium2;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 29 && $inLists['age'] < 35){
                    $basePremium = $premium3;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 34 && $inLists['age'] < 40){
                    $basePremium = $premium4;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2); 
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 39 && $inLists['age'] < 45){
                    $basePremium = $premium5;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 44 && $inLists['age'] < 50){
                    $basePremium = $premium6;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);  
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 49 && $inLists['age'] < 55){
                    $basePremium = $premium7;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] > 54 && $inLists['age'] < 60){
                    $basePremium = $premium8;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2); 
                  ?>
                  <td class="mediumcontrolform"><input id="premiumCalculate" type="text" class="form-control" name="premiumCalculate" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 60){
                    $basePremium = $premium12;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 61){
                    $basePremium = $premium13;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 62){
                    $basePremium = $premium14;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 63){
                    $basePremium = $premium15;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 64){
                    $basePremium = $premium16;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 65){
                    $basePremium = $premium17;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 66){
                    $basePremium = $premium18;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 67){
                    $basePremium = $premium19;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 68){
                    $basePremium = $premium20;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] == 69){
                    $basePremium = $premium21;
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] < 19){
                    if($totalDependentCount == 1){$basePremium = $premium9;}
                    if($totalDependentCount == 2){$basePremium = $premium10;}
                    if($totalDependentCount > 3){$basePremium = $premium11;}
                    
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }elseif($inLists['age'] < 23 && $inLists['studentus'] != ''){
                    if($totalDependentCount == 1){$basePremium = $premium9;}
                    if($totalDependentCount == 2){$basePremium = $premium10;}
                    if($totalDependentCount > 3){$basePremium = $premium11;}
                    
                    if($inLists['smoker'] == 1){$basePremium *= 1.1;}
                    if($policyInfo['clariaexpress'] == 1){$basePremium *= 0.95;}
                    if($percentData && $percentData != 0){$basePremium *= '1.'.floatval($percentData);}
                    if($amountData && $amountData != 0){$basePremium += $amountData;}
                    if($amountDataStudentUs && $amountDataStudentUs != 0){$basePremium += $amountDataStudentUs;}
                    $basePremium = round($basePremium,2);
                  ?>
                  <td class="mediumcontrolform"><?php //echo $percentData,$amountData,$inLists['id'];?><input id="premiumBase" type="text" class="form-control" name="premiumBase" value="<?php echo $basePremium;?>"></td>
                  <?php }?>
                </tr>
              <?php $insuredCount++; }?>
              </table>
            </form>
            </div><!-- table_overlay END -->
          </div><!-- END content_section_aside -->


         


          </div>
          <div class="clearfix"></div>


</div>    
<?php }?>

<script type="text/javascript">
        
    function form_submit()
    {
        $('#form_calculate_premium').submit();
        
    }
</script>