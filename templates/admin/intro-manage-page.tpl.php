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
    	if(target_val=='image'){
    		$('#filetypeholder').hide();
    		$('#groupholder').show();
    	 }else{
 	  		$('#filetypeholder').show();
    		$('#groupholder').hide();
    	}
    }
</script>
<div class="block">
     <h3>Manage Splash Page</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">     
            
            
            <div class="form">
             <form action="" method="post" onsubmit="return checkValid()" enctype="multipart/form-data">
                <input type="hidden" name="res_id" value="<?php echo $introPageInfo['res_id']; ?>" />
                     <ul class="inputform">
                      <li>
                      <label>Target Type</label>
                        <select name="res_file_type" id="res_file_type" class="selectbox" onchange="checkTargetType()">
                         <option value="image" selected="selected">Image Group</option>
                         <option value="flash"  <?php if($introPageInfo['res_file_type']=='flash'){ ?>selected="selected"<?php } ?>>Flash</option>                 
                         <<!--option value="video"  <?php if($introPageInfo['res_file_type']=='video'){ ?>selected="selected"<?php } ?>>Video</option>-->                                 
                        </select>
                        
                        <div id="filetypeholder" style="display: <?php echo (in_array($introPageInfo['res_file_type'],array('video','flash'))?"block": "none") ?>">
						  <input type="file" name="target_file" /> &nbsp; <?php echo $articleInfo['file_name'] ?>
						</div>
						
						<div id="groupholder" style="display: <?php echo ($introPageInfo['res_file_type']=='image' || !$introPageInfo)?"block": "none" ?>">
					      <a href="<?php echo ADMIN_URL.'intro_groups' ?>"><h2>Manage Image Groups</h2></a>
						</div>
					
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
             Choose The Splash/Landing/Intro Page(Default Page) type. If you want to display the flash file then upload the file or if you want to display a 
             group if image slide shows then Click 'Manage Image Group'(You can also get it from 'Main Menu' =&gt; 'Pages' =&gt; 'Landing/Splash' =&gt; 'Manage Groups'. Add Group and Add Images
             (Top/Right/Bottom/Left) for those group. You can also inactivate the group if you don't want to show any perticular group for some time.
            
			</p>
             <span class="clear"></span> 
         </div>
       
         
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>