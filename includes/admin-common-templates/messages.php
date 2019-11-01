<div class="display-msg">

    <div class="round-block-red" id="myerrbox" <?php if($this->error == ''){?> style="display: none;"<?php } ?>>
        <div class="round-t-red"><div><div></div></div></div>
        <div class="block-conten-red">  
          <div class="errorbox">
             <div>
               <h5 class="error-header left">Error Message!</h5>
               <div class="cross-3 right"><a href="javascript:void(0)" onclick="javascript: $('#myerrbox').hide('slow')">Cross</a></div>
               <span class="clear"></span> 
             </div> 
             <p id="error_message"><?php echo $this->error; ?></p> 
            <span class="clear"></span>
           </div> 
          <span class="clear"></span>
        </div>
        <div class="round-b-red"><div><div></div></div></div>
     </div>


    <div class="round-block-blue" id="mymsgbox" <?php if($this->message == ''){?> style="display: none;"<?php } ?>>
        <div class="round-t-blue"><div><div></div></div></div>
        <div class="block-conten-blue">
            <div class="validbox">
             <div>
               <div class="cross-2 right"><a href="javascript:void(0)" onclick="javascript: $('#mymsgbox').hide('slow')">Cross</a></div>
               <span class="clear"></span> 
             </div> 
            <h5 class="validation-title left"><?php echo $this->message; ?></h5>
           <span class="clear"></span>
           </div> 
          <span class="clear"></span>
        </div>
        <div class="round-b-blue"><div><div></div></div></div>
    </div>

    <div class="round-block-green" id="myalrbox" <?php if($this->alert == ''){?> style="display: none;"<?php } ?>>
        <div class="round-t-green"><div><div></div></div></div>
        <div class="block-conten-green">  
          <div class="invalidbox">
             <div>
               <h5  class="invalid-header left">Alert Message!</h5>
               <div class="cross-1 right"><a href="javascript:void(0)" onclick="javascript: $('#myalrbox').hide('slow')">Cross</a></div>
               <span class="clear"></span> 
             </div> 
             <p id="alert_message"><?php echo $this->alert; ?></p>  
            <span class="clear"></span>
           </div> 
          <span class="clear"></span>
        </div>
        <div class="round-b-green"><div><div></div></div></div>
    </div>


 <span class="clear"></span> 
</div>