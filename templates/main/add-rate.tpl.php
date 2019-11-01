<style type="text/css">
    .no-display{display: none;}
</style>
<?php 
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', '1');
    global $policyInfo,$db;
    
    $sql="SELECT * FROM coverage WHERE active ='1'";
    $coverageData = $db->select($sql);
    
    $sql_rate='SELECT * FROM rate_table_mexico';
    $add_rate_id = $db->select($sql_insert);
    /*echo '<pre>';
    print_r($coverageData);
    echo '</pre>';*/
?>
<div class="sectionPanel_Right">
    <div class="content_section">
        <div class="page-breadcrumbs">
            <ul>
                <li><a href="#"><i class="fas fa-home"></i></a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#" onclick="history.back()">Life Policy</a></li>
                <li>Add Rate</li>
            </ul>
        </div><!-- page-breadcrumbs END -->
        
        <h1 class="page-titlename">Add Rate</h1>
        
        <?php
            #print_r($insuredInfo);
        ?>
        
        <div class="title_bar">
            <div class="btn btn-primary bgorange"><a href="javascript:void(0);" onclick="form_submit()">Add Rate</a></div>            
        </div>        
        <!-- Content Section Starts Here -->
        
        <form method="post" action="<?php echo THE_URL.'main/mexico_rate_save' ?>" id="form_add_rate_mexico">           
            <div class="content_section_aside">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group-section">                            
                            <label class="formheading">Plan</label>
                            <select class="form-control" name="plan" id="policy_plan_rate">
                               <option value="0">&nbsp;</option>
                              <?php $planList = getPolicyPlanLists(1); if($planList){foreach($planList as $p_key => $p_value){ $selected_text = ($policyInfo['idplan'] == $p_key) ? 'selected="selected"': ''; echo '<option value="'.$p_key.'" '.$selected_text.'>'.$p_value.'</option>';}} ?>
                              
                            </select>
                        </div>                        
                    </div>
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Coverage</label>
                            <select class="form-control" name="coverage">
                                <option>&nbsp;</option>
                                <option value="1000000">1000000</option>
                                <option value="2000000">2000000</option>
                            </select>
                        </div>
                    </div>                    
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Deductible</label>
                            <select class="form-control" name="deductible">
                                <option>&nbsp;</option>
                                <option value="0-1000">0-1000</option>
                                <option value="0-2000">0-2000</option>
                                <option value="0-3000">0-3000</option>
                                <option value="0-5000">0-5000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Deductible Area</label>
                            <select class="form-control" name="deductiblearea">
                                <option>&nbsp;</option>
                                <option value="noneresidence">Outside country of residence</option>
                                <option value="residence">In country or residence</option>
                            </select>
                        </div>
                    </div>                   
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Age</label>
                            <select class="form-control" name="age">
                                <option>&nbsp;</option>
                                <option value="1dependent">1 dependent</option>
                                <option value="2dependents">2 dependents</option>
                                <option value="3plusdependent">3 or more</option>
                                <option value="18-24">18-24</option>
                                <option value="25-29">25-29</option>
                                <option value="30-34">30-34</option>
                                <option value="35-39">35-39</option>
                                <option value="40-44">40-44</option>
                                <option value="45-49">45-49</option>
                                <option value="50-54">50-54</option>
                                <option value="55-59">55-59</option>
                                <option value="60">60</option>
                                <option value="61">61</option>
                                <option value="62">62</option>
                                <option value="63">63</option>
                                <option value="64">64</option>
                                <option value="65">65</option>
                                <option value="66">66</option>
                                <option value="67">67</option>
                                <option value="68">68</option>
                                <option value="69">69</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Premium</label>
                            <input type="text" class="form-control" name="premium" value=""/>
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Rate Year</label>
                            <input type="text" class="form-control" name="rate_year" value=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group-section">
                            <label class="formheading">Country</label>
                            <select class="form-control" name="rate_country">
                                <option>&nbsp;</option>
                                <option value="mexico">Mexico</option>
                                <option value="srilanka">Srilanka</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div> 
                    <input style="display: none;" type="submit" value="Submit"/>                  
                </div>
            </div>
        </form>        
        <!-- Content Section Ends Here -->    
    </div>
    <div class="clearfix"></div>
</div><!-- sectionPanel_Right END -->

<script type="text/javascript">
        
    function form_submit()
    {
        $('#form_add_rate_mexico').submit();
        
    }
</script>