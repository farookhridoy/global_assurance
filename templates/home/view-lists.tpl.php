<?php //print_r($data_lists); 
//$start = date("Y-m-d")." 9:30 am";  
//$start_time = strtotime($start);
global $trenza_employee,$db,$trenza_employee_images;

$month_info = cal_info(0);
$months = $month_info['months'];

//print_r($attendence_data);
?>

<div id="content">
<div class="data-list">
<div id="ajax_loader">
<img src="<?php echo CSS_IMAGE_URL ?>loading.gif"/>
</div>
<div id="tab-list-table">
<table class="list-table" border="0" width="96%" cellpadding="0" cellspacing="0">
<thead>
<tr>
<th id="table-header" colspan="12"><?php echo date("F j, Y l");  ?></th>
</tr>
</thead>
<tfoot>
<tr>
<th colspan="12">&nbsp;</th>
</tr>
</tfoot>
<tbody>
<?php if($data_lists){
$serial = 0;    
$data_lists = resort_attendance_data($data_lists);

foreach($data_lists as $row){ 
if($trenza_employee[$row['emp_id']]){
$present[] = $row['emp_id'];
if($row['data_input'])
$data_input = unserialize($row['data_input']);
else
$data_input = '';

//echo "<pre>";
//print_r($data_lists);
//exit;

$count_data_input = $data_input ? count($data_input): 0;
$in_out_class = ($count_data_input % 2)? "in_desk": "out_desk";
$serial++;
?>
<tr>
<td><?php echo $serial; ?></td>
<td width="15%"><a href="javascript: void(0)"><?php echo $trenza_employee[$row['emp_id']]; ?></a><span class="<?php echo $in_out_class ?>">&nbsp;</span></td>
<td><img src="<?php echo WWW_RESOURCE_STORE; ?>images/users/<?php echo $trenza_employee_images[$row['emp_id']]; ?>" alt="<?php echo $trenza_employee[$row['emp_id']]; ?>" style="width:60px !important"/></td>
<?php if($row['data_input']){    

if(is_array($data_input)){
$data_counter = 0;

$start = $row['date_added']." 9:00 am";
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


if($data_counter==0 && ($hour > 0 || $minutes >= 11))
$late_attendence = 'class="late_attend"';
else
$late_attendence = "";
if($row['emp_id']=="0007906326"){
   $sp_minutes = floor(($value-$data_time) / (60));
   if($sp_minutes < 71)
   $late_attendence = "";
}elseif($row['emp_id']=="0007895420"){
   $sp_minutes = floor(($value-$data_time) / (60));
   if($sp_minutes < 70)
   $late_attendence = "";  
}
/*elseif($row['emp_id']=="0007905933"){
   $sp_minutes = floor(($value-$data_time) / (60));
   if($sp_minutes < 70)
   $late_attendence = "";  
}*/
$duration_label = ($data_counter> 0)? "D:":"L:";

?>
<td width="8%" <?php echo $late_attendence; ?>><?php echo date("h:i a",$value);  ?><br /><?php echo $duration_label;  ?> <?php echo $hour."hr ".$minutes; ?>min</td>
<?php 
$data_time = $value;
$data_counter++;}
if($data_counter<9){for($i=$data_counter;$i<9;$i++){ ?>    
<td width="8%">&nbsp;</td>  
<?php }}

}else{ ?>
<td colspan="11">&nbsp;</td>
<?php } ?>
<?php }else{ ?>
<td colspan="11">&nbsp;</td>
<?php } ?>
</tr>
<?php }}
foreach($trenza_employee as $em_key => $em_value){
    if(!in_array($em_key,$present)){
        $serial++;
?>        
 <tr><td><?php echo $serial; ?></td><td><?php echo $trenza_employee[$em_key]; ?></td><td  width="9%"><img src="<?php echo WWW_RESOURCE_STORE; ?>images/users/<?php echo $trenza_employee_images[$em_key]; ?>" alt="<?php echo $trenza_employee[$em_key]; ?>" style="width:60px !important"/></td><td colspan="9"><span class="late_attend">X</span></td></tr>       
<?php    

}


}

}else{ ?>
<tr><td colspan="11">No data available</td></tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>