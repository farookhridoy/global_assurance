<?php 
global $insuredInfo,$insuredLists,$footerFunctions,$policyInfo;
//print_r($insuredInfo);
$footerFunctions = array("scriptHealthRateup","scriptHealthNew");
$rateUpLists = getRateUpListsByInsured( $insuredInfo['id']);
//if($rateData['idrateuptype'])
//$rateTypeData = getSingleRateUpType($rateData['idrateuptype']);
$rateUpTypesData = array();
//print_r($rateUpLists);
?>
<div class="sectionPanel_Right">
        <div class="content_section">
          <div class="page-breadcrumbs">
            <ul>
              <li><a href="#"><i class="fas fa-home"></i></a></li>
              <li><a href="#">Dashboard</a></li>
              <li>Rate Up</li>
            </ul>
          </div><!-- page-breadcrumbs END -->
          <h1 class="page-titlename">Rate Up</h1>
          <div class="title_bar">
            <button class="btn btn-primary" type="button" id="addSaveRateUp" onclick="addSaveRateUpData(<?php echo $insuredInfo['id']; ?>)">Add and Save</button>
            <div class="btn btn-primary bgorange"><a href="<?php echo THE_URL."main/rate-up-print/".$insuredInfo['id']; ?>">Print</a></div>
            <div class="btn btn-primary bgorange print-add"><a onclick="addSavePrintRateUpData(<?php echo $insuredInfo['id']; ?>)" href="javascript: void(0)">Print Add</a></div>
          </div>
          <div class="content_section_aside">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group-section">
                 <input type="hidden" name="curr_insured_id" id="curr_insured_id" value="<?php echo $insuredInfo['id']; ?>"/>
                  <label class="formheading">First Name</label>
                  <input type="text" class="form-control" value="<?php echo $insuredInfo['first_name']; ?>"/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group-section">
                  <label class="formheading">Last Name</label>
                  <input type="text" class="form-control" value="<?php echo $insuredInfo['last_name']; ?>"/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group-section">
                  <label class="formheading">Rate up Type %</label>
                  <input type="text" name="rate_up_percent" id="rate_up_percent" class="form-control" value=""/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group-section">
                  <label class="formheading">Rate up Type $</label>
                  <input type="text" name="rate_up_amount" id="rate_up_amount" class="form-control" value=""/>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group-section">
                  <label class="formheading">Rate up $ Com</label>
                  <input type="text" name="rate_up_com" id="rate_up_com" class="form-control"/>
                </div>
              </div>
            </div>
          </div>
          <div class="content_section_aside">
                  <div class="table_overlay">
                    <table class="tableContent">
                      <tbody><tr>
                        <th class="fltersearch"><span>Type</span></th>
                        <th class="fltersearch"><span>Rate Up Amount %</span></th>
                        <th class="fltersearch"><span>Rate Up Amount $</span></th>
                        <th class="fltersearch"><span>Rate Up $ Commissionable</span></th>
                        <th class="fltersearch"><span>Delete</span></th>
                      </tr>
                      <tr>
                        <td>
                          <span class="form-select">
                            <select name="rateup_type" id="rateup_type" class="form-control" onchange="processRateUps(<?php echo $insuredInfo['id']; ?>)">
                              <option></option>
                              <?php $rateUps = getRateUptypes(); if($rateUps){foreach($rateUps as $r_key => $r_value){$rateUpTypesData[$r_value['id']] = $r_value;  echo '<option value="'.$r_value['id'].'">'.$r_value['type'].'</option>';}} ?>
                            </select>
                          </span>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      
                      <?php 
                      if($rateUpLists){foreach($rateUpLists as $rateUp){ ?>
                       <tr>
                        <td class="rate-up-id" style="display: none;"><?php echo $rateUpTypesData[$rateUp['idrateuptype']]['id'];?></td>
                        <td>
                        <?php echo $rateUpTypesData[$rateUp['idrateuptype']]['type']; ?>
                        </td>
                        <td><?php echo $rateUpTypesData[$rateUp['idrateuptype']]['rateuppercent']; ?></td>
                        <td><?php echo $rateUpTypesData[$rateUp['idrateuptype']]['rateupamount']; ?></td>
                        <td><?php echo $rateUpTypesData[$rateUp['idrateuptype']]['commission']; ?></td>
                        <td><a class="deleteRateup" href="javascript: void(0)">Delete</a><span class="rateupID" style="display: none;"><?php echo $rateUp['id']; ?></td>
                      </tr>
                      <?php }} ?>
                      
                    </tbody></table>
                  </div><!-- table_overlay END -->
                  <div class="clearfix"></div>
                </div>
          </div>
          <div class="clearfix"></div>
        </div><!-- sectionPanel_Right END -->