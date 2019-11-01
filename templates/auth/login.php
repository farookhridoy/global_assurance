<script language="javascript" type="text/javascript">
	function poptastic(url){
		var newwindow;
		newwindow=window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=400,height=300,screenX=150,screenY=150,top=100,left=50');
		if (window.focus) {newwindow.focus()}
	}


function  checkLogin(form){
	$("#errordata").css('display','block');
	if(form.user_name.value=="" || form.user_name.value.length < 3)
	    $('#errordata').html("Username cann't be null");
    else if(form.user_name.value.length  > 32)
	    $('#errordata').html("Username must be less than 32 letters long");
    else if(!form.user_name.value.match(/^([a-zA-Z0-9_\-])+$/))
	    $('#errordata').html("Invalid Username format");	 
    else if(form.user_password.value=="" || form.user_password.value.length < 4 )
		$('#errordata').html("Password cann't be null");
	else if(form.user_password.value.length > 32)
	    $('#errordata').html("Password should be less than 32 letters long");
   	else
		  return true;
  
  return false;
}
</script>

<h2 class="post-static-title">User Login</h2>
        <div class="hr"></div>
             		 <p>
Welcome to the social network! If you already have an account, you can login below.
<br/>
If you don't have an account, you can <a href="<?= THE_URL ?>auth/signup.php"><b>sign up here</b></a>!
</p>
    
 <?php require(TEMPLATE_STORE.'displaymessage.php');?>   	
    
	<?php if(isset($viewFiles['reason'])>0){?> 
       <p class="error"> <font color="#000000"><b> Banned Resign:</b></font> <br /> <?= $viewFiles['reason'] ?></p> 
   <?php } ?>
	<div class="markline right"><span class="star">*</span> indicates required fields</div>
        <form  name="login_form" method="post" onsubmit="return checkLogin(this)">
         <input name="formSubmitted" value="true" type="hidden" />
                        
            <ul class="input-form"> 
                <li class="input-label">Username: <span class="star">*</span></li>
                <li class="input-box">
                  <div class="input-box-m">
                   <div class="input-box-l">
                     <div class="input-box-r">
                        <input type="text" name="user_name" class="input-loginbox" size="54"/>
                     </div>
                    </div>
                  </div>
                </li>
                <li class="input-label">Password: <span class="star">*</span></li>
                <li class="input-box">
                     <div class="input-box-m">
                       <div class="input-box-l">
                         <div class="input-box-r">
                           <input type="password" name="user_password" class="input-loginbox" size="55"/>
                         </div>
                        </div>
                      </div>
                </li>
                <li class="input-label">&nbsp;</li>
                <li class="input-box">                                
                	<input type="submit" name="submit" value="Login" class="button right" />
					<div class="forgotpass"><a onclick="window.location.href='<?=THE_URL.'password-forgotten.html';?>'" style="cursor:pointer;">Forget Password?</a></div>
                </li>
            </ul> 
        </form> 