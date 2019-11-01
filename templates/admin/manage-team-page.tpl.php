<script type="text/javascript">
    function checkTargetType(){
    	var stats_val = $('#status').val();
    	if(stats_val==0){
    		$('#unpublish_mesg').show();
    	 }else{
 	  		
    		$('#unpublish_mesg').hide();
    	}
    }
</script>

<div class="block">
    <div class="f_cont_top_left"><h3>Manage Team Page</h3></div>
    <div class="f_cont_top_right">&nbsp;</div>
     
     <!-- <div class="hr"></div> -->
          <div class="inputbox">     
            
            
            <div class="form">
             <form action="" method="post" onsubmit="return checkValid()">
                <input type="hidden" name="res_id" value="<?php echo $teamInfo['res_id']; ?>" />
             
			  <ul class="inputform">
                     <li>
                          <label>Page Title</label>             
                          <input type="text" name="res_title" id="res_title" value="<?php if($teamInfo) echo stripslashes($teamInfo['res_title']);else echo $_POST['res_title']; ?>" class="input-text-box" size="54"/>                          
                     </li>
              </ul>
              
			   <div class="clear"></div>
			   <div class="input_m_left">Team Content</div>
		       <div class="input_m_right"><textarea name="res_desc" id="res_desc" class="textarea" cols="36"><?php echo $teamInfo['res_desc']; ?></textarea></div>
			   <div class="clear"></div>
 
              <ul class="inputform">
                 <li>
                    <label>Status</label>
                    <select name="status" id="status" class="selectbox" onchange="checkTargetType()">
                     <option value="1" selected="selected">Publish</option>
                     <option value="0" <?php if($teamInfo && $teamInfo['status']==0){ ?>selected="selected"<?php } ?>>UnPublish</option>                
                    </select>
                 </li>
              </ul>
               <div class="clear"></div>
               <div id="unpublish_mesg" style="display: <?php echo ($teamInfo && $teamInfo['status']==0)?"block": "none"; ?>">
				   <div class="input_m_left">Unpublish Message</div>
			       <div class="input_m_right"><textarea name="res_extra" id="res_extra" class="textarea" cols="36"><?php echo $teamInfo['res_extra']; ?></textarea></div>
		       </div>
			   <div class="clear"></div>
			   
              
              <ul class="inputform">
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
              You can put team list in the team content area. If you don't want to show the team list for certain time make it unpublish from status and 
              put a Unpublis message that will display instead of stockist list when status is unpublised.
			</p>
             <span class="clear"></span> 
         </div>
       
         
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>