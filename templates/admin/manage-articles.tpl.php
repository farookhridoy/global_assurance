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

    <h2 class="left">Manage Home Articles</h2>
    <div class="right new_entry"><a href="<?php echo ADMIN_URL.'home_add_article' ?>">ADD New Article</a></div> 
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
                    <th width="35%">Article Title</th>
                    <th width="35%">Article Content</th>
                    <th width="35%">Article Image</th>
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
                if($articleLists)
                {
                    foreach($articleLists as $key=>$value)
                    {
                        if($key % 2 == 0)$trclass = 'col';
                        else $trclass = 'col1';
                        
                        $iamge_info = getSingleImage(array("res_id"=>$value['res_id'],"image_properties"=>"home_article"));
                        $iamge_thumb_info = getSingleImage(array("res_id"=>$home_article['res_id'],"image_properties"=>"home_article_thumb"));
                        ?>
                        <tr class="<?php echo $trclass; ?>" id="<?php echo 'row_'.$key ?>">
                            <td><input type="checkbox" name="res_id_arr[]" value="<?php echo $value['res_id'] ?>" class="child" /></td>
                            <td><?php echo $value['res_title'] ?></td>
                            <td><?php echo trunc_string($value['res_desc'],80) ?></td>
                            <td>
							<?php if($iamge_thumb_info['image_name']){ ?>
							<img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$iamge_thumb_info['image_path'].$iamge_thumb_info['image_name'],75,50) ?>"/>
							<?php }elseif($iamge_info['image_name']){ ?>
                            <img src="<?php echo doTimThumb(WWW_RESOURCE_STORE .$iamge_info['image_path'].$iamge_info['image_name'],75,50) ?>"/>
                            <?php }else{ ?>
                            No Image
                            <?php } ?>
							</td>
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
                                <a href="<?php echo ADMIN_URL.'home_add_article/'.$value['res_id']; ?>" title="Modify Article Information"><img src="<?php echo ADMIN_CSS_URL ?>images/edit.png" width="12" height="14" alt="Edit"  /></a>&nbsp;&nbsp;                                                                
                                <a href="javascript:void(0);" onclick="deleteArticle('<?php echo $key; ?>','<?php echo $value['res_id'] ?>')" title="Remove Article"><img src="<?php echo ADMIN_CSS_URL ?>images/delete.png" width="14" height="14" alt="Delete"  /></a>
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