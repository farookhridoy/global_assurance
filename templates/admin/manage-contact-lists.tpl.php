<link  rel="stylesheet" type="text/css" href="<?php echo WWW_3RD_PARTY ?>facebox/facebox.css"/>
<script type="text/javascript" src="<?php echo WWW_3RD_PARTY ?>facebox/facebox.js"></script>

<script type="text/javascript">    
	jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loading_image : 'loading.gif',
        close_image   : 'closelabel.gif'
      }) 
    });
    
 </script>
<script type="text/javascript">


    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
        
    function deleteContactMsg(key , id)
    {
        if(confirm("Are You Sure You Want to Delete?")){
        
        $.post(url,{action:'deleteContactMsg', c_id:id},
            function(data)
            {    
                if(parseInt(data.sucess) == 1)
                {     
                    $('#valid_message').html(data.message);
                    $('#mymsgbox').show('slow');
                    $('#row_'+key).hide();
                }
                else if(parseInt(data.sucess) == 0)
                {
                    $('#alert_message').html(data.message);
                    $('#myalrbox').show('slow');
                }
            },'json');
        }
    }
    
    function markAsRead(id, msg , stats){
     
     if(!stats){
     	$.post(url,{action:'markAsRead', c_id:id},
            function(data)
            {    
                
				if(parseInt(data.sucess) == 1)
                {     
                    $('#msg'+id).html(msg);
                    
                }
                else if(parseInt(data.sucess) == 0)
                {
                   
                }
            },'json');
     	
      }
     
    }
    
</script>
<div class="block">

    <h2 class="left">Contacts Lists</h2> 
    <div class="clear"></div>
        <div class="square-block">
            <div class="search-header">   
                <div class="left">
                    <form action="<?php echo ADMIN_URL.$this->action ?>" method="post">
                        <input type="hidden" name="searchSubmitted" value="true" />
                        <ul class="search">
                            <li>Search:</li>
                            <li class="srchleft"></li>
                            <li class="srchmid">
                            <input type="text" name="search_key" id="search_key" onblur="makeValid(this.id,'<?php echo $this->search_key ?>')" onclick="this.value=''" value="<?php echo $this->search_key ?>" class="textbox" />
                            </li>
                            <li class="srchright"></li>
                        </ul>
                        
                    </form>
                </div>
                <div class="clear_search right">
                    <a href="<?php echo ADMIN_URL.'showall' ?>">Clear Search</a>
                </div>
             <span class="clear"></span> 
            </div>
            <form name="adminAction" method="post" action="">
            <input type="hidden" name="formSubmitted" value="true" />
            <table cellpadding="0" cellspacing="0" class="table">
               <thead class="thead">
                <tr>
                    <th width="5%"><input type="checkbox" id="parent" onclick="toggle_check_all(this.id , 'child')" /></th>
                    
                    <th width="15%">From</th>
                    <th width="20%">Email</th>
                    <th width="25%">Contact Time</th>
                    <th width="35%">Message</th>
                    <th style="text-align: center;">
                        <select name="admin_action" class="select" onchange="this.form.submit();">
                            <option value="">--Select Action--</option>
                            <option value="read">Mark as Read</option>
                            <option value="unread">Mark as Unread</option>
                            <option value="delete">Delete</option>
                        </select>
				   </th>
                    
                </tr>
            </thead>
            <tbody class="tbody">
            <?php
                if($contactList)
                {
                    foreach($contactList as $key=>$value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        ?>
                        <tr class="<?php echo $trclass; ?>" id="<?php echo 'row_'.$key ?>">
                            <td><input type="checkbox" name="c_id_arr[]" value="<?php echo $value['c_id'] ?>" class="child" /></td>
                            <td><?php echo $value['from_name'] ?></td>
                            <td><a href="mailto: <?php echo $value['from_email'] ?>"><?php echo $value['from_email'] ?></a></td>
                            <td><?php echo date("F j, Y, g:i a",$value['contact_time']); ?></td>
                            <td>
                            <div id="info<?php echo $key; ?>" style="display: none;"><?php echo $value['message']; ?></div>
							<a href="#info<?php echo $key; ?>" title="Click Here To Read Details" rel="facebox" onclick="markAsRead(<?php echo $value['c_id']?>,'<?php echo trunc_string($value['message'],50) ?>',<?php echo $value['status']?>)"><span id="msg<?php echo $value['c_id']?>"><?php echo $value['status'] ? trunc_string($value['message'],50): "<b>".trunc_string($value['message'],50)."</b>"; ?></span></a>
							</td>
                            <td style="text-align: center;">                                 
                                <a href="<?php echo ADMIN_URL.'contact_reply/'.$value['c_id']; ?>"  rel="facebox" title="Send News Letter to Subscribers"><img src="<?php echo ADMIN_CSS_URL ?>images/email-send-icon.png"  alt="Send NewsLetter"  /></a>&nbsp;&nbsp;                               
                                <a href="javascript:void(0);" onclick="deleteContactMsg('<?php echo $key; ?>','<?php echo $value['c_id'] ?>')" title="Remove Article"><img src="<?php echo ADMIN_CSS_URL ?>images/delete.png" width="14" height="14" alt="Delete"  /></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
            
            </tbody>            
          </table>
          
          <?php include(ADMIN_TEMPLATES.'seo_pagination.php'); ?>
           
          </form> 
    </div>
</div>    
<span class="clear"></span>     