<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
        
    function deleteUser(key , user_id)
    {
        if(confirm("Are You Sure You Want to Delete?")){
        
        $.post(url,{action:'deleteUser', id:user_id},
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
    
    
</script>
<div class="block">

    <h2 class="left">Manage News Subscriber</h2>
    <div class="right new_entry"><a href="<?php echo ADMIN_URL.'add_subscriber' ?>">ADD Subscriber</a></div> 
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
                    
                    <th width="35%">Subscriber E-Mail:</th>
                    <th width="25%">Status</th>
                    <th style="text-align: center;">
                        <select name="admin_action" class="select" onchange="this.form.submit();">
                            <option value="">--Select Action--</option>
                            <option value="enable">Enabled</option>
                            <option value="disable">Disabled</option>
                            <option value="delete">Delete</option>
                        </select>
				   </th>
                    
                </tr>
            </thead>
            <tbody class="tbody">
            <?php
                if($newssubscriberList)
                {
                    foreach($newssubscriberList as $key=>$value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        ?>
                        <tr class="<?php echo $trclass; ?>" id="<?php echo 'row_'.$key ?>">
                            <td><input type="checkbox" name="user_id_arr[]" value="<?php echo $value['user_id'] ?>" class="child" /></td>
                            <td><a href="mailto: <?php echo $value['email'] ?>"><?php echo $value['email'] ?></a></td>
                            <td>
                            <?php
                                switch($value['access'])
                                {
                                    case 0:
                                        echo "<span class=\"suspend\">InActive</span>";
                                    break;
                                    
                                    case 1:
                                        echo "<span class=\"approved\">Active</span>";
                                    break;
                                }
                            
                            ?>
                            </td>
                            
                            <td style="text-align: center;">                                 
                                <a href="javascript:void(0);" onclick="deleteUser('<?php echo $key; ?>','<?php echo $value['user_id'] ?>')" title="Remove Subscriber"><img src="<?php echo ADMIN_CSS_URL ?>images/delete.png" width="14" height="14" alt="Delete"  /></a>
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