<div class="block">
     <h3>Send News Letter</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">
            <div class="form" style="width: 100%">
             <form action="" method="post" onsubmit="" enctype="multipart/form-data">
                <input type="hidden" name="res_id" value="<?php echo $newsletterInfo['res_id']; ?>" />
               <ul class="inputform">
                <li>
	                <label>Select News Letter</label>
	                <select name="sl_res_id" id="sl_res_id" class="selectbox" onchange="this.form.submit()">
	                  <?php if($active_lists){foreach($active_lists as $newL_list){ ?>
	                  <option <?php if($newL_list['res_id']==$newsletterInfo['res_id']){ ?>selected="selected"<?php } ?> value="<?php echo  $newL_list['res_id']?>"><?php echo $newL_list['res_title']; ?></option>
	                  <?php }} ?>
	                </select>
                </li>
              </ul>
			   <div class="clear"></div>
			   <div class="input_m_left">News Letter Content</div>
		       <div class="input_m_right"><textarea name="res_desc" id="res_desc" class="textarea" cols="90" rows="10"><?php echo $newsletterInfo['res_desc']; ?></textarea></div>
			   <div class="clear"></div>
 
			    <ul class="inputform">
                     
                     <li>
                       <label>&nbsp;</label>
                       <input type="hidden" name="formSubmitted" value="true" class="mybutton"/>
                       <input type="hidden" name="sendNewsLetter" value=""/>
                       
					   <input type="submit" name="send" value="" class="mybutton" onclick="this.form.sendNewsLetter.value=1"/>
                    </li>
               </ul> 
             </form>
            <span class="clear"></span> 
         </div>     
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>