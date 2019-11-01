<div class="block">
     <div class="f_cont_top_left"><h3>Manage Bio Page Content</h3></div>
     <div class="f_cont_top_right"><a href="<?php echo ADMIN_URL.'bio_slides' ?>"><h2>Manage Bio Slides</h2></a></div>
     <span class="clear">&nbsp;</span>
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">
            <div class="form" style="width: 100%">
             <form action="" method="post" onsubmit="return checkValid()">
               <input type="hidden" name="res_id" value="<?php echo $bioInfo['res_id']; ?>" />
			   
			   <ul class="inputform">
			   <li>
                        <label title="Add Bio title/name here">Bio Title</label>
                        <input type="text" name="res_title" id="res_title" value="<?php if($bioInfo) echo stripslashes($bioInfo['res_title']);else echo $_POST['res_title']; ?>" class="input-text-box" size="54"/>
					 </li>
			   </ul>
			   <div class="clear"></div>
			   <div class="input_m_left">Bio Content</div>
			  
		       <div class="input_m_right"><textarea name="res_desc" id="res_desc" class="textarea" cols="50" rows="5"><?php echo $bioInfo['res_desc']; ?></textarea></div>
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
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>