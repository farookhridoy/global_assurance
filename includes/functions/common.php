<?php

	function state($key, $value = FALSE, $newline = FALSE)

	{

		global $session,$db;

		$valueOld = $session->userdata($key);

		if ($value !== FALSE){

			if ($valueOld == FALSE) {

				$session->set_userdata($key, $value);

			} else {

				if ($newline) $value = $valueOld . "\n" . $value;

				$session->set_userdata($key, $value);

			}

		}else{

			return $session->userdata($key);

		}

	}

 
 
 function getUserSideBar(){
    global $userSideBar;
    if(empty($userSideBar))
    require_once COMMON_TEMPLATES.'user.left.tpl.php';
    else
    require_once COMMON_TEMPLATES.$userSideBar;
 }
 

/****************************************************************************/ 

 function make_pagination($sql,$page=false,$per_page=false){

			global $db;

			

			$per_page=($per_page)?$per_page:getSettings('PAGING_PER_PAGE');

			

			$curr_page=($page<=0)?1:$page;			

			$start_form=($curr_page-1)*$per_page;

			

			

			$total=$db->affected($sql);

			

			$total_page=ceil($total/$per_page);				

			

			//bof extra

			$page_list =array();

			if($total_page > 1){

					if($total_page > 9){

							$start = $curr_page-5;

							if($start < 1)

									$start = 1;

											

							$end = $start + 9;

							if($end > $total_page){

									$end = $total_page;

									$start = $end - 9;

							}

					}else{

							$start = 1;

							$end = $total_page;

					}

			

				for($i=$start;$i<=$end;$i++){

						$page_list[$i]=$i;

				}

			}

			//eof extra

			

			

			

			$pages=array();

			$pages['per_page']=$per_page;

			$pages['start_form']=$start_form;

			$pages['curr_page']=$curr_page;

			$pages['total_page']=$total_page;				

			$pages["first"] = 1;

			$pages["last"] = $total_page;

			if($curr_page<$total_page)

			$pages['next_page']=$curr_page+1;

			if($curr_page>1)

			$pages['prev_page']=$curr_page-1;

			

			$pages["page_list"] = $page_list; //extra 

			$pages["total_data"] = $total; //extra 



	return $pages;

}

    

    function getsettings($option_name)

    {

        global $db;

        if($option_name)

        {

            return $db->executeSingle("option_value" , PRFX."settings" , "option_name = '".$option_name."'");

        }

    }


    

function checkMyUserAuth(){

      global $db;

      $user_name = $db->get_post("user_name");
      $password = $db->get_post("password");

      if($user_name && $password){
         $password = md5($password);
         $sql="SELECT * FROM users WHERE name ='$user_name' and pwd='$password'";
         $user_data = $db->select_single($sql);

         if($user_data){
            
            if($user_data['active'] == 1){
            
                $display_name = trim($user_data['displayname']) ? trim($user_data['displayname']) : trim($user_data['name']);
                
                $user_role = getUserRole($user_data['id']);
    
                state("user_id",$user_data['id']);
    
                state("user_name",$user_data['name']);
    
                state("full_name",$display_name);
    
                state("user_type",1);
                
                state("user_role",$user_role);
            }else{
                $error = "Login failed! Your user status is not active.";
            }

         }else{

            $error = "Login failed enter user name and passord correctly.";

         }

      }

      else{

        $error = "User name or Password is empty";

      }

    

     //$result=mysql_query($sql); 

     if($error)

     $stats['reason'] = $error;

     return $stats;

    }

    

    function checkLoggedIn(){

        $user_id = state('user_id');

        if($user_id){

            $user_data['user_id'] = $user_id;

            $user_data['user_name'] =  state("user_name");

            $user_data['full_name'] =  state("full_name");

            $user_data['user_type'] =  state("user_type");

        }

        return $user_data;

  }
  
  function checkUserAccessRole($required_role){
    $access = false;
    $user_role = state("user_role");
    if(empty($user_role))
    $access = false;
    else{ 
      if($user_role=='Admin')
      $access = true;
      elseif($required_role =='Policies Read'){
        if($user_role == 'Policies Read' || $user_role == 'Policies'){
          $access = true;  
        }
      }
      elseif($required_role =='Policies'){
        if($user_role == 'Admin' || $user_role == 'Policies'){
          $access = true;  
        }
      }
      
    }
    return $access;
  }
  
  function accessErrorRedirectURL(){
    $url = THE_URL."main/health/?pr=1";
    return $url;
  }
  
  function checkAccessPermission($required_role){
    $checkPermission = checkUserAccessRole($required_role);
         if(!$checkPermission){
            $redirect_url = accessErrorRedirectURL();
            urlredirect($redirect_url);	
            exit;
    }
  }
?>