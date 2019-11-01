<?php
if(isset($pages) && $pages['total_page'] > 1){?>
  
    <div class="page"> 
        <div class="page-l">
            <div class="page-r">
    			
    			 <?php 
             	$link=(strstr($link, 'http:'))?$link:(SCRIPT_URL.$link);
             	$link .= 'page/';
             	global $query_part;
             	
             	$last = '';
				if($query_part !='')$last = '?'.$query_part;  
             	
				echo '<ul class="pagination">';
				echo '<li><span><span><span>Page: '. $pages['curr_page'] .' / '.  $pages['total_page'].'</span></span></span></li>';
				echo '<li><a href="'.$link.$pages['first'].$last.'"><span><span>First</span></span></a></li>';
				
				 if(isset($pages['prev_page'])){
		    		echo '<li><a href="'.$link.$pages['prev_page'].$last.'"><span><span>&laquo; Pre</span></span></a></li>';
		    	}
			 	foreach($pages['page_list'] as $k=>$v){
					echo '<li><a href="'.$link.$k.$last.'"><span><span>'.$v.'</span></span></a></li>';
				} 
				
				if(isset($pages['next_page'])){
		    		echo '<li><a href="'.$link.$pages['next_page'].$last.'"><span><span>Next&raquo;</span></span></a></li>';
		    	}
				echo ' <li><a href="'.$link.$pages['last'].$last.'"><span><span>Last</span></span></a></li>';
				echo '</ul>';
				?>
	 	<span class="clear"></span>  
            </div>
        </div>
	</div> 
	
   
<?php 
	}
?>