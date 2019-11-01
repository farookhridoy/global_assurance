<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
    
    function editMe(key)
    {        
        $('#'+key+'_val').hide();
        $('#'+'input_holder_'+key).show();
    }
    
    function saveMe(key , id)
    {
        var option_value = $('#'+key+'_input').val();
             
        $.post(url,{action:'saveSettings',option_value: option_value , id:id},
            function(data)
            {                
                if(parseInt(data.sucess) == 1)
                {     
                    $('#'+key+'_val').html(option_value);
                    $('#'+key+'_val').show();
                    $('#'+'input_holder_'+key).hide();
                    
                    $('#alert_message').html('');
                    $('#myalrbox').hide('slow');
                    
                    $('#valid_message').html(data.message);
                    $('#mymsgbox').show('slow');
                }
                else if(parseInt(data.sucess) == 0)
                {     
                    $('#'+key+'_val').html(option_value);
                    $('#'+key+'_val').show();
                    $('#'+'input_holder_'+key).hide();
                    
                    $('#valid_message').html('');
                    $('#mymsgbox').hide('slow');
                    
                    $('#alert_message').html(data.message);
                    $('#myalrbox').show('slow');
                } 
            },'json');
    }
    
    function makeValid(myid , msg)
    {
        var field_val = $('#'+myid).val();  
        if(field_val == '')
            $('#'+myid).val(msg);                  
    }
</script>

<div class="block">

    <h2>Site Settings</h2> 
        <div class="square-block">
            <div class="search-header">   
                <div class="left">
                    <form action="" method="post">
                        <input type="hidden" name="searchSubmitted" value="true" />
                        <ul class="search">
                            <li>Search:</li>
                            <li class="srchleft"></li>
                            <li class="srchmid">
                            <input type="text" name="search_key" id="search_key" onblur="makeValid(this.id,'<?php echo $search_key ?>')" onclick="this.value=''" value="<?php echo $search_key ?>" class="textbox" />
                            </li>
                            <li class="srchright"></li>
                        </ul>
                    </form>
                </div>
                 
             <span class="clear"></span> 
            </div>
            <table cellpadding="0" cellspacing="0" class="table">
               <thead class="thead">
                <tr>
                    <th>S#</th>
                    <th width="30%">Option Title</th>
                    <th width="30%">Option Name</th>
                    <th width="30%">Option Value</th>
                </tr>
            </thead>
            <tbody class="tbody">
            <?php
                if($allSettings)
                {
                    foreach($allSettings as $key=>$value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        ?>
                        <tr class="<?php echo $trclass; ?>" >
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['option_title'] ?></td>
                            <td><?php echo $value['option_name'] ?></td>
                            <td><a href="javascript:void(0)" onclick="editMe('<?php echo $key ?>')" class="edit_me" id="<?php echo $key.'_val' ?>">
                                <?php echo $value['option_value'] ?>
                              </a>
                              <span id="input_holder_<?php echo $key ?>" style="display: none;">
                              <input id="<?php echo $key.'_input' ?>" class="input-text-box"  value="<?php echo $value['option_value'] ?>" />
                              <input type="button" value="" class="mybutton" onclick="saveMe('<?php echo $key ?>' , '<?php echo $value['id'] ?>')" />
                              </span>
                              
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
            
            </tbody>
          </table>  
    </div>
</div>    
<span class="clear"></span>     