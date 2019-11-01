<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
    
    function checkValid()
    {
        var err = '';
        
        var res_title = $('#res_title').val();
        var res_description = $('#res_desc').val();
        
        if(res_title.length <= 0)
            err = "Enter Article Title";
        if(res_description.length <= 0)
           err = "Enter Article Content";
           
        if(err != '')
        {
            $('#error_message').html(err);
            $('#myerrbox').show('slow');
            
            return false;
        }
        else
            return true;
    }  
    
    function checkTargetType(){
    	var target_val = $('#res_file_type').val();
    	if(target_val=='url'){
    		$('#filetypeholder').hide();
    		$('#urlholder').show();
    	 }else{
 	  		$('#filetypeholder').show();
    		$('#urlholder').hide();
    	}
    }
</script>
<div class="block">
     <h3>Manage Logo</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">     
            
            
            <div class="form">
             <form action="" method="post" onsubmit="return checkValid()" enctype="multipart/form-data">
                <input type="hidden" name="res_id" value="<?php echo $boardInfo['res_id']; ?>" />
               <ul class="inputform">
                    <li>
                          <label>Upload Logo</label>   
		                  <input type="file" name="logo_image"/>
						                  
                     </li>
                     <li>
                          <label>Current Logo</label>   
		                   <img src="<?php echo (SCRIPT_URL ."includes/css/images/banner.jpg") ?>" width="350" height="120"/>                    
                     </li>
                     <li>
                       <label>&nbsp;</label>
                       <input type="submit" name="formSubmitted" value="" class="mybutton"/>
                    </li>
               </ul> 
             </form>
            <span class="clear"></span> 
         </div>   
          
         
          <div class="tips">
            <h2 class="welcome-title-tips">Help/Tips</h2>
            <p>
			 Uploading a new image you can change the header logo in site user section. Please upload the image with correct size(height X width). If you don't see the changes just refress your browser.
			</p>
             <span class="clear"></span>
			 <p>&nbsp;</p> 
			 <p>&nbsp;</p> 
			 <p>&nbsp;</p> 
			 <p>&nbsp;</p> 
			 <p>&nbsp;</p> 
			 <p>&nbsp;</p> 
			 <p>&nbsp;</p> 
 			 <p>&nbsp;</p>
         </div>
       
         
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>