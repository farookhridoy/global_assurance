<div class="block">
    <div class="f_cont_top_left"><h3>Manage Media Page</h3></div>
    <div class="f_cont_top_right"><a href="<?php echo ADMIN_URL.'media_manage_links' ?>"><h2>Manage Media Links</h2></a></div>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">     
            
            
            <div class="form">
             <form action="" method="post" onsubmit="return checkValid()" enctype="multipart/form-data">
                <input type="hidden" name="res_id" value="<?php echo $mediaInfo['res_id']; ?>" />
               <ul class="inputform">
                     <li>
                          <label>Media Title</label>             
                          <input type="text" name="res_title" id="res_title" value="<?php if($mediaInfo) echo stripslashes($mediaInfo['res_title']);else echo $_POST['res_title']; ?>" class="input-text-box" size="54"/>                          
                     </li>
              </ul>
			   <div class="clear"></div>
			   <div class="input_m_left">Media Content</div>
		       <div class="input_m_right"><textarea name="res_desc" id="res_desc" class="textarea" cols="36"><?php echo $mediaInfo['res_desc']; ?></textarea></div>
			   <div class="clear"></div>
 
			    <ul class="inputform">
                     <li>
                          <label>Top Image</label>   
		                  <input type="file" name="media_image"/>&nbsp;&nbsp;
		                  <?php 
                             $media_image = getSingleImage(array("image_properties" =>'media_top_image'));
                             
						     if($media_image){ 
					  	   ?>
						    <img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$media_image['image_path'].$media_image['image_name'],50,50) ?>"/>
						   <?php }else{
				   	           echo "NO Image Yet";
				           } ?>
						  	                           
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
            Enter Content For media Page and add Image that will display on media page top. Click on "Manage Media Links" on top right.
            You can also go there from "Main Menu" =&gt; "Pages" =&gt; "Media" =&gt; "Manage Links".
            If you want to add links in media page with images. The Image will be display in Pop Up box when you click on each link.
			</p>
             <span class="clear"></span> 
         </div>
       
         
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>