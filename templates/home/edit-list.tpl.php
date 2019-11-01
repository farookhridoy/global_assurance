<?php //print_r($data_lists); 
//$start = date("Y-m-d")." 9:30 am";  
//$start_time = strtotime($start);
global $trenza_employee,$db;

$month_info = cal_info(0);
$months = $month_info['months'];

//print_r($data_lists);

?>
<style>
.form-row{margin: 10px;}
.form-row ul li{list-style-type: none;margin: 5px 0;border: 2px solid green;border-radius: 2px;width: auto;width: 230px;padding: 5px;max-width: 98%;}
.form-row ul li span{color: red;font-weight: bold;cursor: pointer;}
.form-row ul li.removed{border-color: red !important;}
</style>

<script type="text/javascript">
function remove_entry(item_id){
  //  
  if(jQuery("#entry_itm_"+item_id).hasClass("removed")){
    jQuery("#entry_itm_"+item_id).removeClass("removed");
    jQuery("#entry_item_input_"+item_id).remove();
    
  }else{
    jQuery("#entry_itm_"+item_id).addClass("removed");
    jQuery('form#form_edit_list').append('<input type="hidden" name="removed_lists[]" value="'+item_id+'" id="entry_item_input_'+item_id+'" />');
  }
  
}

function add_new_list(){
    var row_time =  jQuery("#add_row_time").val();
    var curr_counter = parseInt(jQuery("#curr_counter").val());
    var row_am_pm = jQuery("#add_row_am_pm").val();
    curr_counter = curr_counter + 1;
    if(row_time){
        var slt_option = (row_am_pm == 'pm')? 'selected="selected"': '';
        jQuery("#e_list_container").append('<li id="entry_itm_'+curr_counter+'"><input type="text" name="e_times[]" value="'+row_time+'"/> <select name="e_am_pm[]"><option value="am">AM</option><option value="pm" '+slt_option+'>PM</option></select> <span onclick="remove_entry('+curr_counter+')">X</span></li>');
        jQuery("#curr_counter").val(curr_counter);
    }
    

 /*<li id="entry_itm_<?php echo $key;  ?>"><input type="text" name="e_times[]" value="<?php echo date("h:i",$value);  ?>"/>
<select name="e_am_pm[]"><option value="am">AM</option><option value="pm" <?php echo $pm_selected; ?>>PM</option>
</select>
<span onclick="remove_entry(<?php echo $key; ?>)">X</span>
</li> */
  
}

function erase_all(){
    var confirm_erase = confirm("Are you sure you want to delete all entry today?");
    if (confirm_erase) {
      
      jQuery("#remove_all").val("1");
      jQuery("#form_edit_list").submit();
    }
}

</script>
<div id="content">
<div class="form_edit">


<h3><?php echo $trenza_employee[$user_id];   ?> : <?php echo  trim($_REQUEST['date']) ?  date("F j, Y l",strtotime($_REQUEST['date'])): date("F j, Y l");  ?></h3>
<form method="post" id="form_edit_list">
<input type="hidden" name="row_id" value="<?php echo $data_lists['id'];  ?>" />
<input type="hidden" id="remove_all" name="remove_all" value="0" />

<div class="form-row">
<ul id="e_list_container">
<?php 
if($data_lists){
    $data_input = $data_lists['data_input'];
    if($data_input){
        $entries = unserialize($data_input);
    }
?>
<input type="hidden" id="curr_counter" value="<?php echo $entries ? count($entries): "0"; ?>"/>   
<?php     if($entries){ 
    

        foreach($entries as $key => $value){
        $pm_selected = (date("a",$value) == "pm")? 'selected="selected"': '';
?>  

<li id="entry_itm_<?php echo $key;  ?>"><input type="text" name="e_times[]" value="<?php echo date("h:i",$value);  ?>"/>
<select name="e_am_pm[]"><option value="am">AM</option><option value="pm" <?php echo $pm_selected; ?>>PM</option>
</select>
<span onclick="remove_entry(<?php echo $key; ?>)">X</span>
</li>        
<?php }
    }
}

?>
</ul>
</div>
<div class="form-row">
<div class="add_row" id="add_new_row" style="display: none;">
<input type="text" id="add_row_time" value="<?php echo date("h:i",time());  ?>"/>
<select id="add_row_am_pm"><option value="am">AM</option><option value="pm">PM</option>
<input type="button" value="Add" onclick="add_new_list()" />
</div>
</div>
<div class="form-row">
<input type="submit" name="update" value="Update"/>&nbsp;
<input type="button"  value="Add New" onclick="jQuery('#add_new_row').toggle();"/>
<input type="button"  value="Erase All" onclick="erase_all()"/>
</div>
</form>
</div>
</div>