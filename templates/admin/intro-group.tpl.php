<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
    
    function checkValid()
    {
        var err = '';
        
        var res_title = $('#res_title').val();
        
        if(res_title.length <= 0)
            err = "Enter Group Title";
                
        if(err != '')
        {
            $('#error_message').html(err);
            $('#myerrbox').show('slow');
            
            return false;
        }
        else
            return true;
    }  
</script>
<div class="block">
     <h3><?php echo $groupInfo ? "Edit": "Add" ?> Group Information</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">     
            
            
            <div class="form">
             <form action="" method="post" onsubmit="return checkValid()" enctype="multipart/form-data">
                <input type="hidden" name="res_id" value="<?php echo $groupInfo['res_id']; ?>" />
               <ul class="inputform">
                     <li>
                          <label>Group Title</label>             
                          <input type="text" name="res_title" id="res_title" value="<?php if($groupInfo) echo stripslashes($groupInfo['res_title']);else echo $_POST['res_title']; ?>" class="input-text-box" size="54"/>                          
                     </li>
                     
                    <li>
                        <label>Status</label>
                        <select name="status" id="status" class="selectbox">
                         <option value="1" selected="selected">Enabled</option>
                         <option value="0" <?php if($groupInfo && $groupInfo['status']==0){ ?>selected="selected"<?php } ?>>Disabled</option>
                         
                        </select>
                     </li>
                     <li>
                           <label>&nbsp;</label>
                           <input type="submit" name="formSubmitted" value="" class="mybutton" />
                    </li>
               </ul> 
             </form>
            <span class="clear"></span> 
         </div>   
          
         
          <div class="tips">
            <h2 class="welcome-title-tips">Help/Tips</h2>
            <p>
			 Add/Modify Landing/Slash Page Image group and Add Images(Top/Right/Bottom/Left) fro each group that will display on landing page if you choose 'Image Group' option for landing  page. Make the group 'Inactive' if you wnat any group to display on the landing page for perticular time.
			</p>
             <span class="clear"></span> 
         </div>
       
         
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>