<script type="text/javascript">  
    function showFile(file_id)
    {
        if(file_id)
         $('#file_holder'+file_id).toggle('slow');

    }  
</script>
<div class="block">

    <h2 class="left">Splash Manage Group Images</h2>
     
    <div class="clear"></div>
        <div class="square-block">
            <form name="adminAction" method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="formSubmitted" value="true" />
            <table cellpadding="0" cellspacing="0" class="table">
               <thead class="thead">
                <tr>
                   <th width="25%">Position</th>
                    <th width="45%">Image</th>
                    <th style="text-align: center;">
                        <select name="res_id" class="select" onchange="this.form.submit();">
                            <option value="0">--Select Group--</option>
                            <?php if($group_lists){  
                                  foreach($group_lists as $key => $value){	
				            ?>
				            <option value="<?php echo $value['res_id']; ?>" <?php if($value['res_id']==$res_id){ ?>selected ="selected"<?php } ?>><?php echo $value['res_title']; ?></option>
				            <?php } } ?>
                        </select>
				   </th>
                    
                </tr>
            </thead>
           
            <tbody class="tbody">
              <tr class="col">
               <td>Top Image</td>
               <td>
			   <?php if($introImages['top_image']){ ?>
			    <img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$introImages['top_image']) ?>"/>
			   <?php }else{
			   	echo "NO Image Yet";
			   } ?>
			   </td>
               <td>
               <a href="javascript: void(0)" onclick="showFile(1)"><b>Click here to Change</b></a>
			   <div id="file_holder1" style="display: none;">
			    <input type="file" name="top_image"/>
			    <span class="clear"></span>
			    <input type="submit" name="ChangeImage" value="change" class="submitbtn" style="float: left;"/>
			   </div>
			   </td>
             </tr>
             <tr class="col1">
               <td>Bottom Image</td>
               <td> 
				   <?php if($introImages['bottom_image']){ ?>
				    <img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$introImages['bottom_image']) ?>"/>
				   <?php }else{
				   	echo "NO Image Yet";
				   } ?>
			   </td>
               <td>
			   <a href="javascript: void(0)" onclick="showFile(2)"><b>Click here to Change</b></a>
			   <div id="file_holder2" style="display: none;">
			    <input type="file" name="bottom_image"/>
			    <span class="clear"></span>
			    <input type="submit" name="ChangeImage" value="change" class="submitbtn" style="float: left;"/>
			   </div>
			   </td>
             </tr>
             <tr class="col">
               <td>Left Image</td>
               <td>
				   <?php if($introImages['left_image']){ ?>
				    <img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$introImages['left_image']) ?>"/>
				   <?php }else{
				   	echo "NO Image Yet";
				   } ?>
			   </td>
               <td>
			    <a href="javascript: void(0)" onclick="showFile(3)"><b>Click here to Change</b></a>
			   <div id="file_holder3" style="display: none;">
			    <input type="file" name="left_image"/>
			    <span class="clear"></span>
			    <input type="submit" name="ChangeImage" value="change" class="submitbtn" style="float: left;"/>
			   </div>
			   </td>
             </tr>
             <tr class="col1">
               <td>Right Image</td>
               <td>
				   <?php if($introImages['right_image']){ ?>
				    <img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$introImages['right_image']) ?>"/>
				   <?php }else{
				   	echo "NO Image Yet";
				   } ?>
			   </td>
               <td>
			   <a href="javascript: void(0)" onclick="showFile(4)"><b>Click here to Change</b></a>
			   <div id="file_holder4" style="display: none;">
			    <input type="file" name="right_image"/>
			    <span class="clear"></span>
			    <input type="submit" name="ChangeImage" value="change" class="submitbtn" style="float: left;"/>
			   </div></td>
             </tr>
            </tbody>            
          </table>
          
          <?php include(ADMIN_TEMPLATES.'seo_pagination.php'); ?>
           
          </form> 
    </div>
</div>    
<span class="clear"></span>