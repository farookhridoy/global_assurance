<?php //print_r($data_lists); 
//$start = date("Y-m-d")." 9:30 am";  
//$start_time = strtotime($start);
global $trenza_employee,$db;

$month_info = cal_info(0);
$months = $month_info['months'];

//print_r($data_lists);

//echo $late_count = get_late_attendence_table("0007903551",5);
?>
<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/ajax_code.php';
    var input_timer;
    function loadTableRefined()
    {
        jQuery("#ajax_loader").show();
        var emp_id = jQuery("#rf_emp_id").val();
        var month =  jQuery("#rf_month").val();
        jQuery("#tab-list-table").hide();
        
        
        jQuery.post(url,{action:'load_refined_data', empl_id:emp_id,mnth:month},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                    //if(data.tab_data_str){
                       jQuery("#tab-list-table").html(data.tab_data_str); 
                       jQuery("#tab-list-table").show();
                    //}

                }
                else if(parseInt(data.sucess) == 0)
                {
                    if(data.msg)
                    alert(data.msg);
                 //jQuery("#scan_code").val("");
                 //jQuery("#scan_code").prop("disabled", false);
                 //jQuery("#scan_code").focus();
                }
                jQuery("#ajax_loader").hide();
            },'json');
            return false;
    }
</script>
<div id="content">
<div class="data-list">
<form method="post" action="" id="action_form">
<ul>
<li>
<select name="emp_id" id="rf_emp_id">
<option value="0" >Select Employee</option>
<?php if($trenza_employee){foreach($trenza_employee as $key => $value){if($value){
?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php }} } ?>
</select>
</li>
<li>
<select name="month" id="rf_month">
<option value="0">Select Month</option>
<?php if($months){foreach($months as $key => $value){if($value){
?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php }} } ?>
</select>
</li>
<li><input  type="button" name="load_data" value="Load" onclick="loadTableRefined()"/></li>
</ul>
</form>
<div id="ajax_loader">
<img src="<?php echo CSS_IMAGE_URL ?>loading.gif"/>
</div>
<div id="tab-list-table">
<table class="list-table" border="0" width="96%" cellpadding="0" cellspacing="0">
<thead>
<tr>
<th id="table-header" colspan="10"><?php echo date("F j, Y l");  ?></th>
</tr>
</thead>
<tfoot>
<tr>
<th colspan="10">&nbsp;</th>
</tr>
</tfoot>
<tbody>
<?php if($data_lists){foreach($data_lists as $row){
if($trenza_employee[$row['emp_id']]){
$present[] = $row['emp_id'];
if($row['data_input'])
$data_input = unserialize($row['data_input']);
else
$data_input = '';
$count_data_input = $data_input ? count($data_input): 0;
$in_out_class = ($count_data_input % 2)? "in_desk": "out_desk";
?>
<tr>
<td><a href="<?php echo SCRIPT_URL; ?>edit_list/?id=<?php echo $row['emp_id']; ?>"><?php echo $trenza_employee[$row['emp_id']]; ?></a><span class="<?php echo $in_out_class ?>">&nbsp;</span></td>
<?php if($row['data_input']){    

if(is_array($data_input)){
$data_counter = 0;

$start = $row['date_added']." 9:30 am";
$data_time = strtotime($start);
foreach($data_input as $key => $value){
    if($data_counter>= 9)
    break;
$hour = floor(($value-$data_time) / (60*60));
$minutes = floor((($value-$data_time) / 60) % 60);
if($data_time>$value){
    $hour = 0; 
    $minutes = 0;
}


if($data_counter==0 && ($hour > 0 || $minutes > 10))
$late_attendence = 'class="late_attend"';
else
$late_attendence = "";
if($row['emp_id']=="0007906326"){
   $sp_minutes = floor(($value-$data_time) / (60));
   if($sp_minutes < 71)
   $late_attendence = "";
}elseif($row['emp_id']=="0007895420"){
   $sp_minutes = floor(($value-$data_time) / (60));
   if($sp_minutes < 75)
   $late_attendence = "";  
}
/*elseif($row['emp_id']=="0007905933"){
   $sp_minutes = floor(($value-$data_time) / (60));
   if($sp_minutes < 70)
   $late_attendence = "";  
}*/
$duration_label = ($data_counter> 0)? "D:":"L:";
?>
<td width="9%" <?php echo $late_attendence; ?>><?php echo date("h:i a",$value);  ?><br /><?php echo $duration_label;  ?> <?php echo $hour."hr ".$minutes; ?>min</td>
<?php 
$data_time = $value;
$data_counter++;}
if($data_counter<9){for($i=$data_counter;$i<9;$i++){ ?>    
<td width="9%">&nbsp;</td>  
<?php }}

}else{ ?>
<td colspan="9">&nbsp;</td>
<?php } ?>
<?php }else{ ?>
<td colspan="9">&nbsp;</td>
<?php } ?>
</tr>
<?php } }
foreach($trenza_employee as $em_key => $em_value){
    if(!in_array($em_key,$present)){
?>        
 <tr><td><a href="<?php echo SCRIPT_URL; ?>edit_list/?id=<?php echo $em_key; ?>"><?php echo $trenza_employee[$em_key]; ?></a></td><td colspan="9"><span class="late_attend">X</span></td></tr>       
<?php    }
}

}else{ ?>
<tr><td colspan="10">No data available</td></tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>