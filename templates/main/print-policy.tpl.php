<?php global $insuredInfo,$footerFunctions,$policyInfo,$insuredLists;

//print_r($policyInfo);

$footerFunctions = array("scriptHealthRateup");
//$insuredInfo = getHealthSingleInsured($policyInfo['id']);
$insuredLists = getHealthInsuredLists($policyInfo['id']);
//echo '<pre>';
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
    $totalDeductible = $valDeductible['deductible'];
}


?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="<?php echo THE_URL; ?>"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li><a href="#">Open Policy Record</a></li>
              <li>Policy Printing</li>
            </ul>
          </div><!-- page-breadcrumbs END -->

          <h1 class="page-titlename">Policy Printing</h1>
        

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
                        <label class="formheading">Print ID</label>
                        <input type="text" class="form-control" value="">                        
                      </div>
                      <div class="col-md-5 ">
                        <label class="formheading">Select Policy Number</label>
                        <span class="">
                          <select class="form-control mySelect2" onchange="redirectPolicy(this);">
                            <?php $healthPolicies = getHealthPolicies(); if($healthPolicies){foreach($healthPolicies as $hp_key => $hp_value){$selected_text = ($policyInfo['id'] == $hp_value['id']) ? 'selected="selected"': ''; echo '<option value="'. THE_URL.'main/print_policy/'.$hp_value['id'].'" '.$selected_text.'>'.$hp_value['policynumber'].'</option>';}} ?>
                          </select>
                        </span>
                      </div>
                      <div class="col-md-2 ">
                        <label class="formheading">&nbsp;</label>
                        <div class="btn btn-primary bgorange"><a target="_blank" href="<?php echo THE_URL."main/pdf-insured/".$policyInfo['id']; ?>">Print</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div><!-- content_section_aside END -->



          <div class="content_section_aside">
            <div class="row">
              <div class="col-md-6 paddingRightset">
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Payment Period</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo dateFormFormat($policyInfo['paymentstart']);?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Payment Period 2</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo dateFormFormat($policyInfo['paymentend']);?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Annual Major Medical Limit</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo '$'.$totalCoverage;?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Annual Major Medical Deductible</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo $totalDeductible;?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Policy Mode</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo $policyType;?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Annual Medical Premium</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo $totalPremium;?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Policy Fee</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo $policyInfo['fee'];  ?>">
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Total Premium</label></div>
                    <div class="col-md-12 col-lg-7">
                      <input type="text" class="form-control" value="<?php echo $totalPremium+$policyInfo['fee'];?>">
                    </div>
                  </div>
                </div>

              </div>


              <div class="col-md-6 paddingLeftset">
                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Address L1</label></div>
                    <div class="col-md-12 col-lg-7">
                      <textarea class="form-control"><?php echo $policyInfo['addressl1'];  ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Address L2</label></div>
                    <div class="col-md-12 col-lg-7">
                      <textarea class="form-control"><?php echo $policyInfo['addressl2'];  ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="row rowsm">
                    <div class="col-md-12 col-lg-5"><label class="formheading labelSide">Address L3</label></div>
                    <div class="col-md-12 col-lg-7">
                      <textarea class="form-control"><?php echo $policyInfo['city'].', '.$insuredCountry;?></textarea>
                    </div>
                  </div>
                </div>

              </div>


            </div>
                
          </div><!-- END content_section_aside -->



          <div class="content_section_aside">
            <div class="table_overlay">
              <table class="tableContent tableNothover">
                <tr>
                    <td class="bigcontrolform"></td>
                    <td class="mediumcontrolform"></td>
                    <td class="smcontrolform"></td>
                    <td class="mediumcontrolform"></td>
                    <td class="mediumcontrolform"></td>
                    <td class="mediumcontrolform"><a target="_blank" href="<?php echo THE_URL; ?>main/pdf-all-insured/<?php echo $policyInfo['id'];?>" class="form-control">All Id Card Insured</a></td>
                </tr>
              <?php $insuredCount = 1; foreach($insuredLists as $inLists){?>
                <tr>
                  <td class="bigcontrolform"><input type="text" class="form-control" value="<?php echo $inLists['first_name'].' '.$inLists['last_name'];?>"></td>
                  <td class="mediumcontrolform"><input type="text" class="form-control" value="<?php echo dateFormFormat($inLists['dob']);?>"></td>
                  <td class="smcontrolform"><input type="text" class="form-control" value="<?php echo $inLists['age'];?>"></td>
                  <td class="mediumcontrolform"><input type="text" class="form-control" value="<?php echo dateFormFormat($inLists['effectivedate']);?>"></td>
                  <td class="mediumcontrolform"><input type="text" class="form-control" value="<?php echo $inLists['premium'];?>"></td>
                  <td class="mediumcontrolform"><a target="_blank" href="<?php echo THE_URL; ?>main/pdf-single-insured/<?php echo $inLists['id'];?>" class="form-control">Id Card Insured <?php echo $insuredCount;?></a></td>
                </tr>
              <?php $insuredCount++; }?>
              </table>
            </div><!-- table_overlay END -->
          </div><!-- END content_section_aside -->


         


          </div>
          <div class="clearfix"></div>


</div>