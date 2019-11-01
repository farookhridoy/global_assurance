<script type="text/javascript">  
    function showFile(file_id)
    {
        if(file_id)
         $('#file_holder'+file_id).toggle('slow');

    }  
</script>
<div class="block">

    <h2 class="left">Splash Manage Icons</h2>
     
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
                       &nbsp;
				   </th>
                    
                </tr>
            </thead>
           
            <tbody class="tbody">
              <tr class="col">
               <td>Left Icon</td>
               <td>
			   <?php if($introIcons['intro_left_icon']){ ?>
			    <img src="<?php echo WWW_RESOURCE_STORE .$introIcons['intro_left_icon']; ?>" />
			   <?php }else{
			   	echo "NO Icon Yet";
			   } ?>
			   </td>
               <td>
               <a href="javascript: void(0)" onclick="showFile(1)"><b>Click here to Change</b></a>
			   <div id="file_holder1" style="display: none;">
			    <input type="file" name="intro_left_icon"/>
			    <span class="clear"></span>
			    <input type="submit" name="ChangeImage" value="change" class="submitbtn" style="float: left;"/>
			   </div>
			   </td>
             </tr>
             <tr class="col1">
               <td>Right Icon</td>
               <td> 
				   <?php if($introIcons['intro_right_icon']){ ?>
				    <img src="<?php echo WWW_RESOURCE_STORE .$introIcons['intro_right_icon']; ?>"/>
				   <?php }else{
				   	echo "NO Icon Yet";
				   } ?>
			   </td>
               <td>
			   <a href="javascript: void(0)" onclick="showFile(2)"><b>Click here to Change</b></a>
			   <div id="file_holder2" style="display: none;">
			    <input type="file" name="intro_right_icon"/>
			    <span class="clear"></span>
			    <input type="submit" name="ChangeImage" value="change" class="submitbtn" style="float: left;"/>
			   </div>
			   </td>
             </tr>
            </tbody>            
          </table>
          
          <?php include(ADMIN_TEMPLATES.'seo_pagination.php'); ?>
           
          </form> 
    </div>
</div>    
<span class="clear"></span>