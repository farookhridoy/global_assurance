<script type="text/javascript">
   
    
</script>
<div class="block">
     <h3>Admin Account Information</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">
            <div class="form" style="width: 100%">
             <form action="" method="post" enctype="multipart/form-data">
                
               <ul class="inputform">
                     <li>
                          <label>Admin User Name</label>             
                          <input type="text" name="user_name" id="user_name" value="<?php echo $admin_info['user_name'] ?>" class="input-text-box" size="54" readonly="readonly"/>                          
                     </li>
                      <li>
                          <label>Admin Name</label>             
                          <input type="text" name="name" id="name" value="<?php echo $admin_info['name'] ?>" class="input-text-box" size="54"/>                          
                     </li>
                      <li>
                          <label>Admin E-Mail</label>             
                          <input type="text" name="admin_email" id="admin_email" value="<?php echo $admin_info['email'] ?>" class="input-text-box" size="54"/>                          
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