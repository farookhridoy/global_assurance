<script language="javascript" type="text/javascript">
		
	function checkSubmission()
	{
		var email = $('#email').val();
		
		//alert(email);
		if(email =="" ||  !email.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/))
		{
			$('#errorbox').show('slow');
			$('#error_mes').html("Valid Email Address Required");
			return false;
		}	
	}
	function closeMessage(id){
		
		$('#'+id).hide('slow');
	}
	
</script>


<div id="container">

           <div id="main">
       
               <div class="content">
               
               	<div class="errorbox" id="errorbox" style="display:none" >
		          <div class="valid-header">
		            <h5 class="errorico left" id="error_mes" ></h5>
		              <div class="cross-3 right"><a onclick="closeMessage('errorbox');">Cross</a></div>
		               <span class="clear"></span></div><div class="clear"></div></div>
               
           		<div class="list-headline-bg">
               		<h1 class="list-headline-right">Forget Your Password ?</h1>
             	</div>
	        <div class="block-box">
                   	<div class="content-block">
					<?php
					echo $msg;
					if($sucess != 1)
					{							
						
					?>    
	                <ul class="inputform">
	                	<form method="post" action="" onsubmit="return checkSubmission()">
	                    <li><label>Email Address :</label>
	                    <input type="text" name="email" id="email" value="" class="input-text-box" size="40" /></li> 
	                    <span class="clear"> </span> 
						<li>
							<label>&nbsp;</label><input type="submit" name="formSubmitted" value="Submit" class="button" />
						</li>
						
						<li>&nbsp;
							<span id="err"><?=$err?></span>
						</li>
						</form>  
	                </ul>
					
					<?php
					}
					?> 
	           		<span class="clear"> </span>   
	          		</div>
	               
	           <span class="clear"> </span>   
	        </div>
	       
	       <span class="clear"></span>
	 </div>
	 
                
	<?php
		#include(COMMON_TEMPLATES.'right_panel.php');
	?>

	<span class="clear"></span>
</div>     