<link type="text/css" href="<?=SCRIPT_URL?>includes/css/jqueryui/ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?=SCRIPT_URL?>includes/js/jqueryui/ui.core.js"></script>
<script type="text/javascript" src="<?=SCRIPT_URL?>includes/js/jqueryui/ui.datepicker.js"></script>
<script language="javascript" type="text/javascript">
		var status = 0;
	function  checkLogin(form){		
		if(form.email.value=="" ||  !form.email.value.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/) )
				$('#err').html("Valid e-mail required");
	    else if(form.user_password.value=="" || form.user_password.value.length < 4 )
			$('#err').html("Password cann't be null");
		else if(form.user_password.value.length > 32)
		    $('#err').html("Password should be less than 32 letters long");
	   	else
			  return true;
	  
	  return false;
	}
	function closeMessage(id){
		
		$('#'+id).hide('slow');
	}
	function  checkSignUp(form)
	{		
		var url = '<?=SCRIPT_URL?>ajax/ajax_code.php';
		
		if(form.user_name.value=="" )
		   	$('#error_mes').html("User name can't be null");
		else if(form.email.value=="" ||  !form.email.value.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/) )
			$('#error_mes').html("Valid Email Address Required");
	    else if(form.user_password.value=="" || form.user_password.value.length < 4 )
			$('#error_mes').html("Password should be at least 4 letters long");
		else if(form.user_password.value.length > 32)
			$('#error_mes').html("Password should be less than 32 letters long");
		else if(form.user_password.value != form.user_repassword.value)
			$('#error_mes').html("Password and retype password do not match");
		else if(form.vImageCodP.value=="" )
		   	$('#error_mes').html("Human verification code can't be null");
		//else if(form.terms.checked == false) 	    
		//	$('#error_mes').html("Terms & Conditions Not Checked");
		else		
			 return true;
		document.location.href="#errorbox";
		$('#errorbox').show('slow');
	
						
		return false;
	}
	
	
	
	function checkDuplicateEmail()
	{		
  		var url = '<?= SCRIPT_URL ?>ajax/ajax_code.php';
  		var user_email = $('#email').val();
  		
  		if(user_email.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
  		{
			
			$.post(url,{action:'check_email',email: user_email},			
				function(data){
	   
					var data_int = parseInt(data);
					//alert(data);
					 if(data_int==1)
					  {	document.location.href="#errorbox";
					  	$('#errorbox').show('slow');
						$('#error_mes').html("Email Address Already Exists");				  	
					  }
					  else
					  {
					  	$('#err').html("");
					  }
				});
		}else{
			document.location.href="#errorbox";
			$('#errorbox').show('slow');
			$('#error_mes').html("Valid Email Address Required");

		}
	}
	
	function checkDuplicateUserName()
	{		
  		var url = '<?= SCRIPT_URL ?>ajax/ajax_code.php';
  		var user_name = $('#user_name').val();
  		
  		if(user_name.length >= 4)
  		{
			
			$.post(url,{action:'check_user_name',user_name: user_name},			
				function(data){
	   
					var data_int = parseInt(data);
//					alert(data);
					 if(data_int==1)
					  {	document.location.href="#errorbox";				  	
					    $('#errorbox').show('slow');
						$('#error_mes').html("User Name Already Exists");
					  	
					  }
					  else
					  {
					  	
					  }
				});
		}else{
			document.location.href="#errorbox";
			$('#errorbox').show('slow');
			$('#error_mes').html("Valid User Name Required");

		}
	}
	
		$(function() {
		$("#birth_day").datepicker();
		$('#birth_day').datepicker('option', {dateFormat: 'yy-mm-dd'});
		});
		
	
	
</script>





	<div id="container">

           <div id="main">
       
               <div class="content">
               <!-- /*****************SHOW MESSAGES************************/ -->
		      <?php  $success = $this->my_session->flashmessage('successMessage');
			  		 $error = $this->my_session->flashmessage('errorMessage');
			  		 $warning = $this->my_session->flashmessage('warningMessage');
			  ?>
			  
			  
		
				<div class="errorbox" id="errorbox" style="display:none" >
		          <div class="valid-header">
		            <h5 class="errorico left" id="error_mes" ></h5>
		              <div class="cross-3 right"><a onclick="closeMessage('errorbox');">Cross</a></div>
		               <span class="clear"></span></div><div class="clear"></div></div>
		
		
		<?php if($success != ''){  ?>
				<div class="validbox" id="validbox">
		          <div class="valid-header" id="validbox_mes" ><h5 class="validation-title left"></h5>
		           <div class="cross-1 right"><a onclick="closeMessage('validbox');">Cross</a></div>
		            <span class="clear"></span></div><div class="clear"></div></div><? } ?>	
							
					  
		<!-- *****************END MESSAGES************************/ --> 
               	
           
                 <div class="list-headline-bg">
               		<h1 class="list-headline-right">Register</h1>
             	</div>
                 <?php
	        		if($sucess_flag == 1)
	        		{
	        	?>
	        	<div class="block-box">
                   <div class="content-block">
	        		<h3><?=$msg?></h3>
	        	</div></div>
	        	<?php }else{ ?>
	        	
	        	<div class="inner-content-wrap"> 
                                    <div class="form">     
                                         <form action="" method="post" onsubmit="return checkSignUp(this);">
                                          <h6 class="headerline">Address</h6>
                                          
                                           <ul class="inputform">
                                                 <li><label>Street:</label>             <input type="text" name="" value="" class="input-text-box" size="65"/></li>
                                                 <li><label>Street No.:</label>              <input type="text" name="street_number" id="street_number" value="<?=$_POST['street_number']?>" class="input-text-box" size="65"/></li>
                                                 <li><label>Zip Code:</label>  <input type="text" name="zip" id="zip" value="<?=$_POST['zip']?>" class="input-text-box" size="65"/></li>
                                         		<li><label>Town :</label><input type="text" name="town" id="town" value="<?=$_POST['town']?>" class="input-text-box" size="65"/></li>		
												<li><label>Country :</label><input type="text" name="country" id="country" value="<?=$_POST['country']?>" class="input-text-box" size="65"/></li>
                                                  
                                           </ul>  
                                           	<span class="clear"></span>  
                                           	<h6 class="headerline1">Crucial Data</h6>
									   		<ul class="inputform">  
	                                            <li><label>*User Name :</label><input type="text" name="user_name" id="user_name" value="<?=$_POST['user_name']?>" class="input-text-box" size="65"/></li>
	                        					<li><label>*Email :</label><input type="text" name="email" id="email" value="<?=$_POST['email']?>" class="input-text-box" size="65"/></li>	
												<li><label>*Password :</label><input type="password" name="user_password" id="user_password" value="" class="input-text-box" size="65"/></li>
	                        					<li><label>*Confirm Password :</label><input type="password" name="user_repassword" id="user_repassword" value="" class="input-text-box" size="65"/></li>  
                                           	</ul>
                                           	
                                           	<span class="clear"></span>  
                                           	<h6 class="headerline1">Movie Stuff</h6>
									   		<ul class="inputform">  
	                                            <li><label>Genres you own :</label><input type="text" name="own_gener" id="own_gener" value="<?=$_POST['own_gener']?>" class="input-text-box" size="65"/></li>
												<li><label>Players in your posession :</label><input type="text" name="player_posession" id="player_posession" value="<?=$_POST['player_posession']?>" class="input-text-box" size="65"/></li>
												<li><label>Do you prefer going to the cinema over playing a DVD at home?:</label>
													Yes&nbsp;<input type="radio" name="prefer_cinema" value="1" />
													No&nbsp;<input type="radio" name="prefer_cinema" value="0" />
												</li>
												<li><label>How many times a month do you go to the cinema?:</label><input type="text" name="cinema_month" id="cinema_month" value="<?=$_POST['cinema_month']?>" class="input-text-box" size="65"/></li>
												<li><label>Amount of DVDs in posession:</label><input type="text" name="own_dvd" id="own_dvd" value="<?=$_POST['own_dvd']?>" class="input-text-box" size="65"/></li>
												<li><label>Amount of Blu-Ray discs/HD-DVDs in posession</label><input type="text" name="own_blue_ray" id="own_blue_ray" value="<?=$_POST['own_blue_ray']?>" class="input-text-box" size="65"/></li>
												<li><label>Amount of DVDs you rent in a month</label><input type="text" name="dvd_rent_month" id="dvd_rent_month" value="<?=$_POST['dvd_rent_month']?>" class="input-text-box" size="65"/></li>
												<li><label>Do you also rent tv-series sometimes?:</label>
													Yes&nbsp;<input type="radio" name="tv_series_rent" value="1" />
													No&nbsp;<input type="radio" name="tv_series_rent" value="0" />
												</li>  
                                           	</ul>
                                           	
                                           	<span class="clear"></span>  
                                           	<h6 class="headerline1">Newsletter</h6>
									   		<ul class="inputform">  
	                                            <li><label>* Receive newsletter:</label>
													Yes&nbsp;<input type="radio" name="newsletter" value="1" />
													No&nbsp;<input type="radio" name="newsletter" value="0" />
												</li>
												<li><label>* Receive our partners newsletters:</label>
													Yes&nbsp;<input type="radio" name="partners_newsletter" value="1" />
													No&nbsp;<input type="radio" name="partners_newsletter" value="0" />
												</li> 
                                           	</ul>
                                           	
                                           	<span class="clear"></span>  
                                           	<h6 class="headerline1">Personal Data</h6>
									   		<ul class="inputform">  
	                                            <li><label>Real Name :</label><input type="text" name="name" id="name" value="<?=$_POST['name']?>" class="input-text-box" size="65"/></li>							
												<li><label>Sex :</label>
													Male&nbsp;<input type="radio" name="sex" value="1" />
													Female&nbsp;<input type="radio" name="sex" value="0" />
												</li>							
							
												<li><label>Date Of Birth :</label><input type="text" readonly="readonly" name="birth_day" id="birth_day" value="" class="input-text-box" size="65" /></li>
                                           	</ul>
                                           	
                                           	<ul class="inputform">  
	                                            <li><label>Human Verification</label>		                
							                    	<span style="height:30px; width:80px; display:block; float:left; margin-right:10px;">
													<input type="text" name="vImageCodP" id="vImageCodP" value="" class="input-text-box" style="width:80px;" size="10" /></span>
													<span style="height:30px; width:80px; display:block; line-height:30px; float:left; ">
													<img src="<?=WWW_3RD_PARTY?>vimage/img.php?size=4" height="30" /></span>
							                    </li>
						                     	<li><label>&nbsp;</label><input type="submit" name="formSubmitted" value="Submit" class="button" /></li>
						                     	
                                           	</ul>
                                           
                                           	
                                           
                                         </form>
                                      <span class="clear"></span>
                                    </div> 
                                <span class="clear"></span>
                           </div>
	        	
	        	
    			<?php } ?>
                  <span class="clear"></span>
               </div>
               
               
               <?php include(COMMON_TEMPLATES.'right-portion.tpl.php'); ?>  
               
               
              <span class="clear"></span>
           </div>
           
           
    <span class="clear"></span>
   </div>