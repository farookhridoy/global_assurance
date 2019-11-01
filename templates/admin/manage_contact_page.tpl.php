<div class="block">
     <h3>Manage Contact Page</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">
            <div class="form" style="width: 100%">
             <form action="" method="post" onsubmit="return checkValid()" enctype="multipart/form-data">
               <input type="hidden" name="res_id" value="<?php echo $contactInfo['res_id']; ?>" />
			   
			   <ul class="inputform">
			    <li>&nbsp;</li>
			   </ul>
			   <div class="clear"></div>
			   <div class="input_m_left">Contact Top</div>
			  
		       <div class="input_m_right"><textarea name="res_desc" id="res_desc" class="textarea" cols="50" rows="5"><?php echo $contactInfo['res_desc']; ?></textarea></div>
			   <div class="clear"></div>
                 
			    <ul class="inputform">
                     <li>
                        <label title="Add Contact Email Where The Mail Will Be Sent">Contact Email</label>
                        <input type="text" name="res_extra" id="res_extra" value="<?php if($contactInfo) echo stripslashes($contactInfo['res_extra']);else echo $_POST['res_extra']; ?>" class="input-text-box" size="54"/>
                       &nbsp; add &nbsp;<b> [%CONTACT_EMAIL%] </b>&nbsp; In Contact Top Where you want the contact email.
					 </li>
					 <li>
                        <label title="Add Contact Mail Subject When Someone send a contact request">Contact Email Subject</label>
                        <input type="text" name="res_title" id="res_title" value="<?php if($contactInfo) echo stripslashes($contactInfo['res_title']);else echo $_POST['res_title']; ?>" class="input-text-box" size="54"/>
					 </li>
                     
                     <li>
                        <label>Contact Option</label>
                        <select name="content_type" id="content_type" class="selectbox">
                         <option value="mail" selected="selected">Send to Mail</option>
                         <option value="db" <?php if($contactInfo && $contactInfo['content_type']=='db'){ ?>selected="selected"<?php } ?>>Save In Database</option>                
                         <option value="both" <?php if($contactInfo && $contactInfo['content_type']=='both'){ ?>selected="selected"<?php } ?>>Both</option>                
                        </select>
                     </li>
                     
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