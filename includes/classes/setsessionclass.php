<?php

/**

 * RAW PHP SCRIPT

 *

 * A cemet development RAW PHP SCRIPT for PHP 4.3.2 or newer

 *

 * @package		RAWPHPSCRIPT

 * @author		CeMET Comminuications Ltd Development Team.

 * @copyright	Copyright (c) 2009, CeMET, Ltd.

 * @since		Version 1.0

 */

 

class setsessionclass

{       



	 function __construct(){

	 

		

				

                return true;

    }



/***** bof FOR SESSION********/

	function set_userdata($newdata = array(), $newval = '')

	{

		if (is_string($newdata))

		{

			$newdata = array($newdata => $newval);

		}

		

		if (count($newdata) > 0)

		{

			foreach ($newdata as $key => $val)

			{

				$_SESSION[$key] = $val;

			}

		}

	}

	

	function unset_userdata($newdata = array())

	{

		if (is_string($newdata))

		{

			$newdata = array($newdata => '');

		}



		if (count($newdata) > 0)

		{

			foreach ($newdata as $key => $val)

			{

				unset($_SESSION[$key]);

			}

		}

	}

	

	function userdata($item)

	{

		

		if(! isset($item)){

			return FALSE ;

		}else{

			if(! isset($_SESSION[$item])){

				return FALSE ;

			}else{

				return $_SESSION[$item];

			}

				

		} 

	}	

/***** eof FOR SESSION********/	

/***** bof FOR Flash Data********/

/**

	 * Strip slashes

	 *

	 * @access	public

	 * @param	mixed

	 * @return	mixed

	 */

	function strip_slashes($vals)

	{

		if (is_array($vals))

		{

			foreach ($vals as $key=>$val)

			{

				$vals[$key] = stripslashes($val);

			}

		}

		else

		{

			$vals = stripslashes($vals);

		}



		return $vals;

	}





	// ------------------------------------------------------------------------



	/**

	 * Add or change flashdata, only available

	 * until the next request

	 *

	 * @access	public

	 * @param	mixed

	 * @param	string

	 * @return	void

	 */

	function set_flashdata($newdata = array(), $newval = '')

	{

		if (is_string($newdata))

		{

			$newdata = array($newdata => $newval);

		}



		if (count($newdata) > 0)

		{

			foreach ($newdata as $key => $val)

			{

				$flashdata_key = 'flash'.':new:'.$key;

				$this->set_userdata($flashdata_key, $val);

			}

		}

	}



	// ------------------------------------------------------------------------



	/**

	 * Keeps existing flashdata available to next request.

	 *

	 * @access	public

	 * @param	string

	 * @return	void

	 */

	function keep_flashdata($key)

	{

		// 'old' flashdata gets removed.  Here we mark all

		// flashdata as 'new' to preserve it from _flashdata_sweep()

		// Note the function will return FALSE if the $key

		// provided cannot be found

		$old_flashdata_key = 'flash'.':old:'.$key;

		$value = $this->userdata($old_flashdata_key);



		$new_flashdata_key = 'flash'.':new:'.$key;

		$this->set_userdata($new_flashdata_key, $value);

	}



	// ------------------------------------------------------------------------



	/**

	 * Fetch a specific flashdata item from the session array

	 *

	 * @access	public

	 * @param	string

	 * @return	string

	 */

	function flashdata($key)

	{

		$flashdata_key = 'flash'.':old:'.$key;

		return $this->userdata($flashdata_key);

	}

	

/***** eof FOR Flash Data********/

	function sess_destroy()

	{

		/* unset($_SESSION['CE_user_id']);

		unset($_SESSION['CE_admin_user_id']);

		unset($_SESSION['CE_username']);

		unset($_SESSION['CE_email']);

		unset($_SESSION['CE_role_id']);

		unset($_SESSION['CE_logged_in']);

		unset($_SESSION['CE_SESSION_start_time']); */

		@session_destroy();

	}

	

	

/**

 *

 * cleans one or multiple var from session info

 * @param $clear

 * @return unknown_type

 */



	function cleaninfo($clean){

		if (is_array($clean)){

			foreach ($clean as $value){

				$this->unset_userdata($value);

			}

		} else {

				$this->unset_userdata($clean);

		}

	}



/**

 * flashinfo sets falshdata

 *

 * @param $key

 * @param $value

 * @return unknown_type

 */



	function flashinfo($key, $value = FALSE){

		if (!$value){

			return $this->flashdata($key);

		} else {			

			$this->set_flashdata($key, $value);

		}

	}



	function flashmessage($key, $value = FALSE){

		

		if (!$value){

			 $message = $this->userdata($key);

			 $this->unset_userdata($key);

			return $message;

		} else {

			$this->unset_userdata($key);

			$this->set_userdata(array($key=>$value));

		}

	}

}	

?>