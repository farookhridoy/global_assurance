<?php
    
    function checkUserName($user_name)
    {
        global $db;
        if($user_name != '')
        {
            $exist =  $db->countTotal("users" , "user_name = '".$user_name."'");
            
            if($exist == 0)return 1;
            else return 0;    
        }
        
    }	
	
?>