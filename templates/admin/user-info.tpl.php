<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
    function checkUserName()
    {
        var user_name = $('#user_name').val();
        
        if(parseInt(user_name.length) > 4)
        {
            $('#invalid_user').hide();
            
            $.post(url,{action:'checkUserName',user_name: user_name},
            function(data)
            {                
                if(parseInt(data.sucess) == 1)
                {     
                    $('#valid_user').show();
                    $('#invalid_user').hide();
                }
                else if(parseInt(data.sucess) == 0)
                {
                    $('#valid_user').hide();
                    $('#invalid_user').show();
                }
            },'json');
            
            
        }
        else
        {
            $('#valid_user').hide();
            $('#invalid_user').show();
        }
        
    }
    
    function checkValid()
    {
        var err = '';
        
        var user_name = $('#user_name').val();
        var password1 = $('#password1').val();
        var password2 = $('#password2').val();
        var email = $('#email').val();
        
        //match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/)
        
        if(user_name.length < 3)
            err = "The user name must be have atleast 4 character";
        
        else if(!email.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
            err = "Invalid email format";
        
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
     <h3>Add/Edit User Information</h3>
     
     <!-- <div class="hr"></div> -->
     
          <div class="inputbox">     
            
            
            <div class="form">
             <form action="" method="post" onsubmit="return checkValid()">
                <input type="hidden" name="user_id" value="<?php echo $userInfo['user_id']; ?>" />
               <ul class="inputform">
                     <li>
                          <label>User Name </label>             
                          <input type="text" name="user_name" id="user_name" value="<?php if($userInfo) echo $userInfo['user_name']; else echo $_POST['user_name'] ?>" <?php if($userInfo['user_name'] != '')echo "readonly=\"readonly\"";else {?>onblur="checkUserName()"<?php } ?> class="input-text-box" size="54"/>
                          <span class="invalid" id="invalid_user" style="display: none;">Invalid</span>
                          <span class="valid" id="valid_user" style="display: none;">Valid</span>
                     </li>
                     
                     <li>
                          <label>Password</label>              
                          <input type="password" name="password1" id="password1" value="" class="input-text-box" size="54"/>
                          
                          <div>Leave blank if you don't wan to alter the existing password</div>
                     </li>
                     
                     <li>
                          <label>Password</label>              
                          <input type="password" name="password2" id="password2" value="" class="input-text-box" size="54"/>
                          
                          <div>Leave blank if you don't wan to alter the existing password</div>
                     </li>
                      
                     <li>
                          <label>Email Address </label>             
                          <input type="text" name="email" id="email" value="<?php if($userInfo) echo $userInfo['email'];else echo $_POST['email']; ?>" class="input-text-box" size="54"/>
                          <span class="invalid" id="valid_email" style="display: none;">Invalid</span>
                          <span class="valid" id="invalid_email" style="display: none;">Valid</span>
                     </li>
                     
                     <li>
                          <label>Name </label>             
                          <input type="text" name="name" id="name" value="<?php if($userInfo) echo $userInfo['name'];else echo $_POST['name']; ?>" class="input-text-box" size="54"/>                          
                     </li>
                     
                     <li>
                          <label>Short Bio</label>      
                          <textarea name="short_bio" cols="34" rows="5" class="input-textarea" ><?php if($userInfo)echo $userInfo['short_bio'];else echo $_POST['short_bio'];?></textarea>
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
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature.</p>
             <span class="clear"></span> 
         </div>
       
         
           <span class="clear"></span> 
         </div>
        <span class="clear"></span>
      </div>