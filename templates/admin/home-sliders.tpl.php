<script type="text/javascript">  
    function showFile()
    {
       
         $('#file_holder').toggle('slow');

    }  
    
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
        
    function deleteImage(key , id)
    {
        if(confirm("Are You Sure You Want to Delete?")){
        
        $.post(url,{action:'deleteImage', img_id:id},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                    $('#valid_message').html(data.message);
                    $('#mymsgbox').show('slow');
                    $('#row_'+key).hide();
                }
                else if(parseInt(data.sucess) == 0)
                {
                    $('#alert_message').html(data.message);
                    $('#myalrbox').show('slow');
                }
            },'json');
        }
    }
    
</script>
<div class="block">
<form name="adminAction" method="post" action="" enctype="multipart/form-data">
    <h2 class="left">Intro Manage Group Images</h2>
     <div class="right new_entry"><a href="javascript: void(0)" onclick="showFile()">ADD New Image</a><br /><br />
	
	 <div id="file_holder" style="display: none;">
			    <input type="file" name="home_slide_image"/>
			    <span class="clear"></span>
			    <input type="submit" name="addNewImage" value=" add " class="submitbtn" style="float: left;"/>
			   </div>
	</div> 
    <div class="clear"></div>
        <div class="square-block">
           
            <input type="hidden" name="formSubmitted" value="true" />
            <table cellpadding="0" cellspacing="0" class="table">
               <thead class="thead">
                <tr>
                   <th width="5%"><input type="checkbox" id="parent" onclick="toggle_check_all(this.id , 'child')" /></th>
                   <th width="45%">Image</th>
                   <th style="text-align: center;">
                        <select name="admin_action" class="select" onchange="this.form.submit();">
                          <option value="0">--Select Action--</option>
                          <option value="delete">Delete</option>
                        </select>
				   </th>
                    
                </tr>
            </thead>
            <tbody class="tbody">
             
               <?php
                if($slider_images)
                {
                    foreach($slider_images as $key=>$value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        ?>
                        <tr class="<?php echo $trclass; ?>" id="<?php echo 'row_'.$key ?>">
                            <td><input type="checkbox" name="img_id_arr[]" value="<?php echo $value['img_id'] ?>" class="child" /></td>
                            <td><img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$value['image_path'].$value['image_name'],300,80); ?>"/></td>
                            <td style="text-align: center;">                                 
                               <a href="javascript:void(0);" onclick="deleteImage('<?php echo $key; ?>','<?php echo $value['img_id'] ?>')" title="Remove Image"><img src="<?php echo ADMIN_CSS_URL ?>images/delete.png" width="14" height="14" alt="Delete"  /></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>  
            </tbody>            
          </table>
          
          <?php include(ADMIN_TEMPLATES.'seo_pagination.php'); ?>
           
          </form> 
    </div>
</div>    
<span class="clear"></span>