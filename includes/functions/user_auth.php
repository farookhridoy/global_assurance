<?php



 	function _encode($password)

    {

	   $majorsalt = '6174A13A7BE5995B05BA7D4C62F75B2D37DD0CFA1CF7037CAE13A37FCD5D8620';
		// if PHP5
		if (function_exists('str_split'))

		{

			$_pass = str_split($password);

		}

		// if PHP4

		else

		{

			$_pass = array();

			if (is_string($password))

			{

				for ($i = 0; $i < strlen($password); $i++)

				{

					array_push($_pass, $password[$i]);

				}

			}

		}



		// encrypts every single letter of the password

		foreach ($_pass as $_hashpass)

		{

			$majorsalt .= md5($_hashpass);

		}



		// encrypts the string combinations of every single encrypted letter

		// and finally returns the encrypted password

		return md5($majorsalt);	

 }

 

 

    function getUserType($user_id)

    {

        global $db;

        

        return $db->executeSingle("user_type" , "users" , "user_id = '".$user_id."'");

    }
    
    
    function getUserRoleID($user_id)

    {

        global $db;
        
        $sql="SELECT idrole FROM userroles WHERE iduser='$user_id'";
        $role_info = $db->select_single($sql);
        return $role_info ? $role_info['idrole']: 0;
    }
    
    function getUserRole($user_id)
    {

        global $db;
        
        $idRole = getUserRoleID($user_id);
        $sql="SELECT name FROM roles WHERE id='$idRole'";
        $role_info = $db->select_single($sql);
        
        return $role_info ? $role_info['name']: "";

    }

    

    function changeUserStatus($user_id, $active=0){

    	global $db;

    	

    	if($user_id){

    		$sql = "UPDATE ".PRFX."users SET access = '$active' WHERE user_id ='$user_id' LIMIT 1";

    	    $stats = $db->edit($sql);

    	}

    	

    	return $stats;

    }

    

    function removeUser($user_id){

    	global $db;

    	if($user_id){

    		$sql ="DELETE FROM users WHERE id ='$user_id'";

    	    $stats = $db->delete($sql);
            if($stats){
                removeUserRoles($user_id);
            }

    	}

    		

    	return $stats;

    }
    
 function checkUserDuplicate($email,$user_name){
    global $db;
    $message = '';
    $sql = 'SELECT id FROM users WHERE name = "'.$user_name.'"';
    $user_data = $db->select_single($sql);
    if($user_data){
    $message = 'User Name already exists';
    }else{
      $sql = 'SELECT id FROM users WHERE email = "'.$email.'"';
      $user_data = $db->select_single($sql);  
      if($user_data)
      $message = 'Email already exists'; 
    }
    
    return $message;
    
 }

 function addUser($infos,$user_id=0){

 	global $db;
 	if(is_array($infos)){

 		foreach($infos as $key => $value){

 			$sql .= $key." ='".$value."', ";

 		}

 		$sql = trim($sql);
 		$sql = substr($sql, 0,strlen($sql)-1);
 		if($user_id){

 			$sql = "UPDATE users SET ".$sql." WHERE id ='$user_id'";
 			if($db->edit($sql))
 			$success = $user_id;

 		}else{
 			$sql = "INSERT INTO users SET ".$sql;
 			$user_id = $db->insert($sql);
            if($user_id)
            $success = $user_id;

	   }

 	}

 	return $success;

 }

 function getUserLists($limit=0,$start=0){
    global $db;
    
    $usersLists = array();
    $sql="SELECT * FROM users";
    
    if($limit)
    $sql .= " LIMIT $start,$limit";
    
    $usersLists = $db->select($sql);
    if($usersLists){
        foreach($usersLists as $key => $value){
           $userRole =  getUserRole($value['id']);
           $usersLists[$key]['userrole'] = $userRole;
        }
    }
    
    return $usersLists;
 }
  
 function getSingleUser($user_id){
    global $db;
    
    $userInfo = array();
    if($user_id){
    
    $sql="SELECT * FROM users WHERE id='$user_id'";
    
    
    $userInfo = $db->select_single($sql);
    if($userInfo){
        
     $userRole =  getUserRole($user_id);
     $userInfo['userrole'] = $userRole;

    }
    }
    return $userInfo;
 }
 
 
 function getUserRoleLists(){
    global $db;
    $roleLists = array();
  
    $sql="SELECT * FROM roles WHERE active ='1'";
    $roleData = $db->select($sql);
    if($roleData){
        foreach($roleData as $key => $value){
            $roleLists[$value['id']] = trim($value['name']);
        }
    }
  
    return $roleLists;
 }
 
 
 function addUserRole($user_id,$role_id,$romove_old=0){

 	global $db;
 
    if($user_id && $role_id){
    if($romove_old)
    $roveStats = removeUserRoles($user_id);
	$sql = "INSERT INTO userroles SET iduser='$user_id', idrole='$role_id'";
	$success = $db->insert($sql);
 	}

 	return $success;

 }

 function removeUserRoles($user_id){
   global $db;
   if($user_id){
    $sql ="DELETE FROM userroles WHERE iduser ='$user_id'";
    $stats = $db->delete($sql);
   }
   return $stats;
 }	

?>