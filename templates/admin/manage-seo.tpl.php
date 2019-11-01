<script type="text/javascript">
    var url = '<?=SCRIPT_URL?>ajax/admin_ajax_code.php';
   function deleteArticle(key , id){
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

    <h2 class="left">Manage Page Title &amp; Meta</h2>
     
    <div class="clear"></div>
        <div class="square-block">
            <div class="search-header">   
                <div class="left">
				   
				   <p class="top_tips">Enter Page Meta Keyword, Description Title For Each Page. If You don't  need special meta title/description/key for any page just keep
				   those blank and the page will use default meta title,key,description that you can define from "Main Menu" =&gt; "Settings"
				   </p>
                </div>
                <div class="clear_search right">
                    &nbsp;
                </div>
                 
             <span class="clear"></span> 
            </div>
            <form name="adminAction" method="post" action="">
            <input type="hidden" name="formSubmitted" value="true" />
            <table cellpadding="0" cellspacing="0" class="table">
               <thead class="thead">
                <tr>
                    <th width="5%"><input type="checkbox" id="parent" onclick="toggle_check_all(this.id , 'child')" /></th>
                    <th width="10%">Page</th>
                    <th width="26%">Meta Title</th>
                    <th width="26%">Meta Key</th>
                    <th width="26%">Meta Description</th>
                    <th width="8%"  style="text-align: center;">Action</th>  
                </tr>
            </thead>
            <tbody class="tbody">
            <?php
                if($seoLists)
                {
                    foreach($seoLists as $key => $value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        ?>
                        <tr class="<?php echo $trclass; ?>" id="<?php echo 'row_'.$key ?>">
                            <td><input type="checkbox" name="s_id_arr[]" value="<?php echo $value['s_id'] ?>" class="child" /></td>
                            <td><?php echo $value['page_caption'] ?></td>
                            <td><?php echo $value['meta_title'] ?></td>
                            <td><?php echo $value['meta_key'] ?></td>
                            <td><?php echo $value['meta_description'] ?></td>
                            <td style="text-align: center">
							<a href="<?php echo ADMIN_URL.'modify_seo/'.$value['s_id']; ?>" title="Modify SEO Information"><img src="<?php echo ADMIN_CSS_URL ?>images/edit.png" width="12" height="14" alt="Edit"  /></a>
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