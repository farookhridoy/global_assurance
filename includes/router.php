<?php
/* Caution: Please Don't Change Anyting On This File.' */
	function make_route()
	{		

		$HTTP_HOST = $_SERVER['HTTP_HOST'];
		$REQUEST_URI = $_SERVER['REQUEST_URI'];
		$HOST_URI = 'http://'.$HTTP_HOST.$REQUEST_URI; 
		$HOST_URI = rtrim($HOST_URI , '/');
		$HOST_URI = str_replace('.html' , '' , $HOST_URI);
		$HOST_URI = str_replace('.htm' , '' , $HOST_URI);
		$HOST_URI = str_replace('.php' , '' , $HOST_URI);
		$x = substr($HOST_URI , strlen(SCRIPT_URL) , strlen($HOST_URI));	
		$x = preg_replace('#^/(.*)#', "$1", $x );
		$url_data = explode("?", $x);
		$url_part = $url_data[0];
		$query_part = "";
		$query_parms = array();
		if(count($url_data) > 1){
			$query_part = $url_data[1];
		}
		$url_part = urldecode ($url_part);
		$temp_url_parts = explode("/", $url_part);
		if($temp_url_parts)
		{
			foreach($temp_url_parts as $key=>$value)
			{				 
				$temp_url_parts[$key] = str_replace("'", "", _remove_invisible_characters($value));
			}
		}
		#pre($temp_url_parts);exit;
		$args=array();
		$ln =  "";
		$action =  "";
		if(count($temp_url_parts))
		{						
			for($cn=0,$cn_limit=count($temp_url_parts);$cn<$cn_limit;$cn++)$temp_url_parts[$cn] = trim($temp_url_parts[$cn]);
			#pre($temp_url_parts);exit;
			if(strlen($temp_url_parts[0])==2)
			{
				$ln =  $temp_url_parts[0];
				if (count($temp_url_parts) > 1)$controller = $temp_url_parts[1];
				if (count($temp_url_parts) > 2)$action = $temp_url_parts[2];				
				if (count($temp_url_parts) > 3)
				{	
					$sz = count($temp_url_parts);
					for($i=3 ; $i<$sz ; $i++)
					{
						$args[] = $temp_url_parts[$i];
					}
				}
			}
			else
			{
				$controller = $temp_url_parts[0];
				if (count($temp_url_parts) > 1)$action = $temp_url_parts[1];				
				if (count($temp_url_parts) > 2)
				{					
					$sz = count($temp_url_parts);
					for($i=2 ; $i<$sz ; $i++)
					{
						$args[] = $temp_url_parts[$i];
					}
				}
			}
		}
		// parse query params
		if (count($url_data) > 1){
			$query_part = $url_data[1];
			$temp_query_parts = explode("&", $query_part);
			foreach($temp_query_parts as $q){
				$temp = explode("=", $q);
				$key = $temp[0];
				$value = $temp[1];
				$query_parms[$key] = $value;
			}
		}

		$controller = str_replace("-","_",$controller);
        $action = str_replace("-","_",$action);
		$parms = array(
			"ln" => $ln,
			"controller" => $controller,
			"action" => $action,
			"args" => $args,
			"get" => $query_parms,
			"post" => $_POST,
			"gerbage" => $temp_url_parts,
			"query_part" => $query_part,
		);
		#print_r($parms);
		return $parms;	
	}

	function make_url($params = NULL)
	{
		if($params != NULL)
		{
			$param_list = implode('/' , $params);
			return SCRIPT_URL.$param_list;
		}
	}
	function _remove_invisible_characters($str)
	{
		static $non_displayables;
		if ( ! isset($non_displayables))
		{
			// every control character except newline (dec 10), carriage return (dec 13), and horizontal tab (dec 09),
			$non_displayables = array(

										'/%0[0-8bcef]/',			// url encoded 00-08, 11, 12, 14, 15

										'/%1[0-9a-f]/',				// url encoded 16-31

										'/[\x00-\x08]/',			// 00-08

										'/\x0b/', '/\x0c/',			// 11, 12

										'/[\x0e-\x1f]/'				// 14-31

									);

		}



		do

		{

			$cleaned = $str;

			$str = preg_replace($non_displayables, '', $str);

		}

		while ($cleaned != $str);



		return $str;

	}
?>