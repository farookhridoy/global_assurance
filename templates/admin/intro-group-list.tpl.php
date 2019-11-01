<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
        
    function deleteGroup(key , id)
    {
        if(confirm("Are You Sure You Want to Delete?")){
        
        $.post(url,{action:'deleteResource', res_id:id},
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

    <h2 class="left">Splash Page Images Group Lists</h2>
    <div class="right new_entry"><a href="<?php echo ADMIN_URL.'intro_add_group' ?>">ADD New Group</a></div> 
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
                    <th width="15%">Group ID</th>
                    <th width="35%">Group Title</th>
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
                if($groupList)
                {
                    foreach($groupList as $key=>$value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        ?>
                        <tr class="<?php echo $trclass; ?>" id="<?php echo 'row_'.$key ?>">
                            <td><input type="checkbox" name="res_id_arr[]" value="<?php echo $value['res_id'] ?>" class="child" /></td>
                            <td><?php echo $value['res_id'] ?></td>
                            <td><?php echo $value['res_title'] ?></td>
                            <td>
                            <?php
                                switch($value['status'])
                                {
                                    case 0:
                                        echo "<span class=\"suspend\">Disabled</span>";
                                    break;
                                    
                                    case 1:
                                        echo "<span class=\"approved\">Enabled</span>";
                                    break;
                                }
                            
                            ?>
                            </td>
                            
                            <td style="text-align: center;">                                 
                                <a href="<?php echo ADMIN_URL.'intro_add_group/'.$value['res_id']; ?>" title="Modify Group Information"><img src="<?php echo ADMIN_CSS_URL ?>images/edit.png" width="12" height="14" alt="Edit"  /></a>&nbsp;&nbsp;                                
                                <a href="<?php echo ADMIN_URL.'intro_manage_group/'.$value['res_id']; ?>" title="Manage Group Images"><img src="<?php echo ADMIN_CSS_URL ?>images/reports-icon.png"  alt="Manage"  /></a>&nbsp;&nbsp;                                
                                <a href="javascript:void(0);" onclick="deleteGroup('<?php echo $key; ?>','<?php echo $value['res_id'] ?>')" title="Remove Group"><img src="<?php echo ADMIN_CSS_URL ?>images/delete.png" width="14" height="14" alt="Delete"  /></a>
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