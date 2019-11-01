<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
    
    
    function checkValid()
    {
        var err = '';
        
        var reply_to = $('#reply_to').val();
        var message = $('#message').val();
        var name   = $('#to_name').val();
        var sub   = $('#subject').val();
        
        if(reply_to.length <= 0)
            err = "Reply to cannot be empty";
        if(message.length <= 0)
           err = "Enter Message";
           
        if(err == '')
        {
           $.post(url,{action:'sendReply', to:reply_to,subject:sub,to_name: name,mess: message},
            function(data)
            {    
               
				if(parseInt(data.sucess) == 1)
                {     
                   alert(data.message);
                }
                else if(parseInt(data.sucess) == 0)
                {
                    alert(data.message);
                }
            },'json');
        }
        else{
        	alert(err);
        }
            return false;
    }  
    
</script>
<div class="form"  style="width: 500px;">
             <form action="" method="post" onsubmit="return checkValid()">
                 <ul class="inputform">
                     <li>
                          <label>Reply To</label>             
                          <input type="text" name="reply_to" id="reply_to" value="<?php if($contact_info) echo stripslashes($contact_info['from_email']);else echo $_POST['from_email']; ?>" class="input-text-box" size="49"/>                          
                     </li>
                     <li>
                          <label>Name</label>             
                          <input type="text" name="to_name" id="to_name" value="<?php if($contact_info) echo stripslashes($contact_info['from_name']);else echo $_POST['from_name']; ?>" class="input-text-box" size="49"/>                          
                     </li>
                      <li>
                          <label>Subject</label>             
                          <input type="text" name="subject" id="subject" value="Reply From Misfit" class="input-text-box" size="49"/>                          
                     </li>
                </ul>
			   <div class="clear"></div>
			   <div class="input_m_left">Message</div>
		       <div class="input_m_right"><textarea name="message" id="message" class="textarea" style="border: 1px solid #CCCCCC;" cols="32" rows="4"></textarea></div>
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