<?php

/**

 * @copyright	Copyright (c) 2012, TrenzaSoftwares, http://trenzasoft.com.

 * @since		Version 1.0

**/

 

class dbclass

{

	

		

		var $SHOW_ERROR = TRUE;//TRUE TO THIS $SHOW_ERROR DISPLAY ANY TYPE OF MYSQL ERROR; //FALSE TO DO NOTING

		

        // Need to set these constant variables:

        var $DBASE    = DB_DATABASE;

        var $USER     = DB_SERVER_USERNAME;

        var $PASS     = DB_SERVER_PASSWORD;

        var $SERVER   = DB_SERVER;

		

		#var $DBASE    = "brewskylovers";

        #var $USER     = "root";

        #var $PASS     = "";

        #var $SERVER   = "localhost";

        #var $HOST ="localhost";



        function __construct(){



                $user = $this->USER;

                $pass = $this->PASS;

                $server = $this->SERVER;

                $dbase = $this->DBASE;

                $conn = @mysqli_connect($server,$user,$pass,$dbase);

                @mysqli_query("SET AUTOCOMMIT=0");

                if(!$conn) { $this->error("Mysql Connection attempt failed"); }

                //if(!@mysql_select_db($dbase,$conn)) { $this->error("Database Select failed"); }

                $this->CONN = $conn;

				

                return true;

        }

		

        function close(){

                $conn = $this->CONN ;

                $close = mysql_close($conn);

                if(!$close){

                    $this->error("Connection close failed");

                }

                return true;

        }



        function error($text=false){

        	
                $conn = $this->CONN;
	        	if($this->SHOW_ERROR){

			    echo "<br/><i>&raquo;&raquo;&nbsp; SQL-ERROR &raquo;&raquo;&nbsp;" .mysqli_errno($conn) ."&nbsp;&raquo;&raquo;&nbsp; ". mysqli_error($conn)." &nbsp;&laquo;&laquo;<br/>&raquo;&raquo;&nbsp; ".$text." &nbsp;&laquo;&laquo;</i>";

	            exit;

	           }

        }



		



		

		

		function getRowsArray($tableName,$where=false, $select = "*"){

		

			if ($select){

				$select=(is_array($select))? implode(',', $select) : $select;

				$sql = "SELECT ".$select;

			}

			

			$sql.= " FROM ".$tableName;

			

			if (is_array($where)){

				$sql .= " WHERE ";		

				$i=0;

				foreach($where as $k=>$val){

					if($i==0){

					$sql .= " `$k` ='$val'";	

					}else{

					$sql .= " AND `$k` ='$val'";	

					}

					

					$i++;

				}

			}elseif (is_numeric($where)) {

				$sql .= " WHERE ";		

				$sql .= $this->primary($tableName).' = ' . $this->escape($where);

			}elseif(is_string($where)){

			

				$sql .= " WHERE ";		

				$sql .= $where;

			}else{

				//no operation

			}

			

			//echo $sql;

			

			

			return $this->select($sql);

			

		} 

		

		function getRowArray($tableName,$where=false, $select = "*"){

		

			if ($select){

				$select=(is_array($select))? implode(',', $select) : $select;

				$sql = "SELECT ".$select;

			}

			

			$sql.= " FROM ".$tableName;

			

			if (is_array($where)){

				$sql .= " WHERE ";		

				$i=0;

				foreach($where as $k=>$val){

					if($i==0){

					$sql .= " `$k` ='$val'";	

					}else{

					$sql .= " AND `$k` ='$val'";	

					}

					

					$i++;

				}

			}elseif (is_numeric($where)) {

				$sql .= " WHERE ";		

				$sql .= $this->primary($tableName).' = ' . $where;

			}elseif(is_string($where)){

			

				$sql .= " WHERE ";		

				$sql .= $where;

			}else{

				//no operation

			}

			

			#echo $sql;

			return $this->select_single($sql);

		}

		

		

		function select ($sql="")

        {

                if(empty($sql)) { return false; }



                if(!preg_match("/^select/i",$sql)){

						$this->error(" SELECT is Misspeling");

                        return false;

                }



                if(empty($this->CONN)) { return false; }

                $conn = $this->CONN;

                //echo $sql;

                $results = mysqli_query($conn,$sql);
                //print_r($results);

                if( (!$results) or (empty($results)) ) {

                        return false;

                }

                $count = 0;

                $data = array();

                while ( $row = mysqli_fetch_array($results, MYSQLI_ASSOC))

                {

                        $data[$count] = $row;

                        $count++;

                }

                mysqli_free_result($results);

				return $data;

        }

		

		function select_single($sql){

		    if(!stristr($sql,"LIMIT"))

            $sql .= " LIMIT 1";		

			$rows=$this->select($sql);

			if($rows)

			return $rows[0];	

		}

		

		function get_variable($sql){

		 $row = $this->select_single($sql);

		 if($row){

		 	$row_value = array_values($row);

		 	return $row_value[0];

		 }

		}

		

		function db_var($table,$field,$field_key,$field_value){

		 $sql = "SELECT ".$field." FROM ".$table." WHERE ".$field_key."='".$field_value."' LIMIT 1";

		 $row = $this->select_single($sql);

		 return $row[$field];

		}

		

        function affected($sql="")

        {

                if(empty($sql)) { return false; }

                //if(!eregi("^select",$sql))
                if(!preg_match("/^select/i",$sql))
                {

                       	$this->error(" SELECT is Misspeling");

                        return false;

                }



                if(empty($this->CONN)) { return false; }

                $conn = $this->CONN;

                $results = @mysqli_query($conn,$sql);

                if( (!$results) or (empty($results)) ) {

                        return false;

                }

                $tot=0;

                $tot=mysqli_affected_rows($conn);

                return $tot;

        }



        function insert ($sql="")

        {

                if(empty($sql)) { return false; }

                if(!preg_match("/^insert/i",$sql))

                {

					$this->error(" INSERT is Misspeling");                     

					 return false;

                }

                if(empty($this->CONN))

                {

						$this->error();

                        return false;

                }



                $conn = $this->CONN;

//echo $sql;

                $results = @mysqli_query($conn,$sql);



                if(!$results) 

                {

					$this->error($sql);

                    return 0;

                }

                $id = mysqli_insert_id($conn);

                return $id;

        }



        function edit($sql="")

        {

        	

                if(empty($sql)) { return false; }

                //if(!eregi("^update",$sql))
                
                if(!preg_match("/^update/i",$sql))

                {

						$this->error(" UPDATE is Misspeling");

                        return false;

                }

                if(empty($this->CONN))

                {

                       	$this->error(" DB CONNECTION Failed"); 

						return false;

                }

                $conn = $this->CONN;

                $results =@mysqli_query($conn,$sql);

                if(!$results) 

                {

						$this->error($sql);

                        return 0;

                }

                $rows = 0;

                $rows = mysqli_affected_rows($conn);

                return $rows;

        }

		function delete($sql="")

        {

                if(empty($sql)) { return false; }

                //if(!eregi("^delete",$sql))
                if(!preg_match("/^delete/i",$sql))
                {

						$this->error(" DELETE is Misspeling");

                        return false;

                }

                if(empty($this->CONN))

                {

                       	$this->error(" DB CONNECTION Failed");  

						return false;

                }

                $conn = $this->CONN;

                $results =@mysqli_query($conn,$sql);

                if(!$results) 

                {

						$this->error($sql);

                        return false;

                }else return true;

        }



		function getColumns($tableName){

		

			$columns = array();
            $conn = $this->CONN;
			$query = mysqli_query($conn,'DESC ' . $tableName);

			while($row=mysqli_fetch_array($query)){

				$columns[] = $row[Field];

			}

			

			return $columns;

		}

		

		function primary($table = ''){	

		

			$fields = $this->getColumns($table);

			if ( ! is_array($fields))

			{

				return FALSE;

			}

			return current($fields);

		}

		

/*************bof HANDEL POST GET DATA**************************************/

	

	function db_input($string) {
        $conn = $this->CONN;
	    return mysqli::escape_string(trim($string));

	  }



	  function db_prepare_input($string) {

	    if (is_string($string)) {

	      return trim(stripslashes($string));

	    } elseif (is_array($string)) {

	      reset($string);

	      while (list($key, $value) = each($string)) {

	        $string[$key] = $this->db_prepare_input($value);

	      }

	      return $string;

	    } else {

	      return $string;

	    }

	  }

	/**

	 * Fetch an item from the GET array

	 *

	 * @access	public

	 * @param	string

	 * @param	bool

	 * @return	string

	 */

	function get($index = '', $xss_clean = FALSE)

	{

		return $this->_fetch_from_array($_GET, $index, $xss_clean);

	}



	// --------------------------------------------------------------------



	/**

	 * Fetch an item from the POST array

	 *

	 * @access	public

	 * @param	string

	 * @param	bool

	 * @return	string

	 */

	function post($index = '', $xss_clean = FALSE)

	{

		return $this->_fetch_from_array($_POST, $index, $xss_clean);

	}



	// --------------------------------------------------------------------



	/**

	 * Fetch an item from either the GET array or the POST

	 *

	 * @access	public

	 * @param	string	The index key

	 * @param	bool	XSS cleaning

	 * @return	string

	 */

	function get_post($index = '', $xss_clean = FALSE)

	{		

		if ( ! isset($_POST[$index]) )

		{

			return $this->get($index, $xss_clean);

		}

		else

		{

			return $this->post($index, $xss_clean);

		}		

	}

	

/*************************************eof HANDEL POST GET DATA****************************************************************************/	



	/**

	 * Clean Input Data

	 *

	 * This is a helper function. It escapes data and

	 * standardizes newline characters to \n

	 *

	 * @access	private

	 * @param	string

	 * @return	string

	 */

	function _clean_input_data($str)

	{

		if (is_array($str))

		{

			$new_array = array();

			foreach ($str as $key => $val)

			{

				$new_array[$this->_clean_input_keys($key)] = $this->_clean_input_data($val);

			}

			return $new_array;

		}



		// We strip slashes if magic quotes is on to keep things consistent

		if (get_magic_quotes_gpc())

		{

			$str = stripslashes($str);

		}



		// Should we filter the input data?

		if ($this->use_xss_clean === TRUE)

		{

			$str = $this->xss_clean($str);

		}



		// Standardize newlines

		if (strpos($str, "\r") !== FALSE)

		{

			$str = str_replace(array("\r\n", "\r"), "\n", $str);

		}

		

		return $str;

	}



	// --------------------------------------------------------------------



	/**

	 * Clean Keys

	 *

	 * This is a helper function. To prevent malicious users

	 * from trying to exploit keys we make sure that keys are

	 * only named with alpha-numeric text and a few other items.

	 *

	 * @access	private

	 * @param	string

	 * @return	string

	 */

	function _clean_input_keys($str)

	{

		 if ( ! preg_match("/^[a-z0-9:_\/-]+$/i", $str))

		 {

			exit('Disallowed Key Characters.');

		 }



		return $str;

	}



	// --------------------------------------------------------------------

	

	/**

	 * Fetch from array

	 *

	 * This is a helper function to retrieve values from global arrays

	 *

	 * @access	private

	 * @param	array

	 * @param	string

	 * @param	bool

	 * @return	string

	 */

	function _fetch_from_array(&$array, $index = '', $xss_clean = FALSE)

	{

		if ( ! isset($array[$index]))

		{

			return FALSE;

		}



		if ($xss_clean === TRUE)

		{

			return $this->xss_clean($array[$index]);

		}



		return $array[$index];

	}



	

	

	function escape($str)

	{	

		switch (gettype($str))

		{

			case 'string'	:	$str = "'".$this->escape_str($str)."'";

				break;

			case 'boolean'	:	$str = ($str === FALSE) ? 0 : 1;

				break;

			default			:	$str = ($str === NULL) ? 'NULL' : $str;

				break;

		}		

		return $str;

	}

	

	function escape_str($str)	

	{

		// Escape single quotes

		return str_replace("'", "''", $this->_remove_invisible_characters($str));

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

	



	/*

	NOTE: html_entity_decode() has a bug in some PHP versions when UTF-8 is the

	character set, and the PHP developers said they were not back porting the

	fix to versions other than PHP 5.x.

	*/

	function _html_entity_decode($str, $charset='UTF-8')

	{

		if (stristr($str, '&') === FALSE) return $str;



		// The reason we are not using html_entity_decode() by itself is because

		// while it is not technically correct to leave out the semicolon

		// at the end of an entity most browsers will still interpret the entity

		// correctly.  html_entity_decode() does not convert entities without

		// semicolons, so we are left with our own little solution here. Bummer.



		if (function_exists('html_entity_decode') && (strtolower($charset) != 'utf-8' OR version_compare(phpversion(), '5.0.0', '>=')))

		{

			$str = html_entity_decode($str, ENT_COMPAT, $charset);

			$str = preg_replace('~&#x(0*[0-9a-f]{2,5})~ei', 'chr(hexdec("\\1"))', $str);

			return preg_replace('~&#([0-9]{2,4})~e', 'chr(\\1)', $str);

		}



		// Numeric Entities

		$str = preg_replace('~&#x(0*[0-9a-f]{2,5});{0,1}~ei', 'chr(hexdec("\\1"))', $str);

		$str = preg_replace('~&#([0-9]{2,4});{0,1}~e', 'chr(\\1)', $str);



		// Literal Entities - Slightly slow so we do another check

		if (stristr($str, '&') === FALSE)

		{

			$str = strtr($str, array_flip(get_html_translation_table(HTML_ENTITIES)));

		}



		return $str;

	}

	

	

	/* function ciselect($select = '*', $escape = NULL)

	{

		// Set the global value if this was sepecified	

		if (is_bool($escape))

		{

			$this->_protect_identifiers = $escape;

		}

		

		if (is_string($select))

		{

			$select = explode(',', $select);

		}



		foreach ($select as $val)

		{

			$val = trim($val);



			if ($val != '')

			{

				$ar_select[] = $val;

			}

		}

		

		return $this;

	}

	

	function get_where($table = '', $where = null, $limit = null, $offset = null)

	{

		if ($table != '')

		{

			$this->from($table);

		}



		if ( ! is_null($where))

		{

			$this->where($where);

		}

		

		if ( ! is_null($limit))

		{

			$this->limit($limit, $offset);

		}

			

		$sql = $this->_compile_select();



		$result = $this->query($sql);

		$this->_reset_select();

		return $result;

	}

	*/

	

	// --------------------------------------------------------------------



	/**

	 * XSS Clean

	 *

	 * Sanitizes data so that Cross Site Scripting Hacks can be

	 * prevented.  This function does a fair amount of work but

	 * it is extremely thorough, designed to prevent even the

	 * most obscure XSS attempts.  Nothing is ever 100% foolproof,

	 * of course, but I haven't been able to get anything passed

	 * the filter.

	 *

	 * Note: This function should only be used to deal with data

	 * upon submission.  It's not something that should

	 * be used for general runtime processing.

	 *

	 * This function was based in part on some code and ideas I

	 * got from Bitflux: http://blog.bitflux.ch/wiki/XSS_Prevention

	 *

	 * To help develop this script I used this great list of

	 * vulnerabilities along with a few other hacks I've

	 * harvested from examining vulnerabilities in other programs:

	 * http://ha.ckers.org/xss.html

	 *

	 * @access	public

	 * @param	string

	 * @return	string

	 */

	function xss_clean($str, $is_image = FALSE)

	{

		/*

		 * Is the string an array?

		 *

		 */

		if (is_array($str))

		{

			while (list($key) = each($str))

			{

				$str[$key] = $this->xss_clean($str[$key]);

			}

	

			return $str;

		}



		/*

		 * Remove Invisible Characters

		 */

		$str = $this->_remove_invisible_characters($str);



		/*

		 * Protect GET variables in URLs

		 */

		 

		 // 901119URL5918AMP18930PROTECT8198

		 

		$str = preg_replace('|\&([a-z\_0-9]+)\=([a-z\_0-9]+)|i', $this->xss_hash()."\\1=\\2", $str);



		/*

		 * Validate standard character entities

		 *

		 * Add a semicolon if missing.  We do this to enable

		 * the conversion of entities to ASCII later.

		 *

		 */

		$str = preg_replace('#(&\#?[0-9a-z]{2,})[\x00-\x20]*;?#i', "\\1;", $str);



		/*

		 * Validate UTF16 two byte encoding (x00) 

		 *

		 * Just as above, adds a semicolon if missing.

		 *

		 */

		$str = preg_replace('#(&\#x?)([0-9A-F]+);?#i',"\\1\\2;",$str);



		/*

		 * Un-Protect GET variables in URLs

		 */

		$str = str_replace($this->xss_hash(), '&', $str);



		/*

		 * URL Decode

		 *

		 * Just in case stuff like this is submitted:

		 *

		 * <a href="http://%77%77%77%2E%67%6F%6F%67%6C%65%2E%63%6F%6D">Google</a>

		 *

		 * Note: Use rawurldecode() so it does not remove plus signs

		 *

		 */

		$str = rawurldecode($str);

	

		/*

		 * Convert character entities to ASCII 

		 *

		 * This permits our tests below to work reliably.

		 * We only convert entities that are within tags since

		 * these are the ones that will pose security problems.

		 *

		 */



		$str = preg_replace_callback("/[a-z]+=([\'\"]).*?\\1/si", array($this, '_convert_attribute'), $str);

	 

		$str = preg_replace_callback("/<\w+.*?(?=>|<|$)/si", array($this, '_html_entity_decode_callback'), $str);



		/*

		 * Remove Invisible Characters Again!

		 */

		$str = $this->_remove_invisible_characters($str);

		

		/*

		 * Convert all tabs to spaces

		 *

		 * This prevents strings like this: ja	vascript

		 * NOTE: we deal with spaces between characters later.

		 * NOTE: preg_replace was found to be amazingly slow here on large blocks of data,

		 * so we use str_replace.

		 *

		 */

		

 		if (strpos($str, "\t") !== FALSE)

		{

			$str = str_replace("\t", ' ', $str);

		}

		

		/*

		 * Capture converted string for later comparison

		 */

		$converted_string = $str;

		

		/*

		 * Not Allowed Under Any Conditions

		 */

		

		foreach ($this->never_allowed_str as $key => $val)

		{

			$str = str_replace($key, $val, $str);   

		}

	

		foreach ($this->never_allowed_regex as $key => $val)

		{

			$str = preg_replace("#".$key."#i", $val, $str);   

		}



		/*

		 * Makes PHP tags safe

		 *

		 *  Note: XML tags are inadvertently replaced too:

		 *

		 *	<?xml

		 *

		 * But it doesn't seem to pose a problem.

		 *

		 */

		if ($is_image === TRUE)

		{

			// Images have a tendency to have the PHP short opening and closing tags every so often

			// so we skip those and only do the long opening tags.

			$str = str_replace(array('<?php', '<?PHP'),  array('&lt;?php', '&lt;?PHP'), $str);

		}

		else

		{

			$str = str_replace(array('<?php', '<?PHP', '<?', '?'.'>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);

		}

		

		/*

		 * Compact any exploded words

		 *

		 * This corrects words like:  j a v a s c r i p t

		 * These words are compacted back to their correct state.

		 *

		 */

		$words = array('javascript', 'expression', 'vbscript', 'script', 'applet', 'alert', 'document', 'write', 'cookie', 'window');

		foreach ($words as $word)

		{

			$temp = '';

			

			for ($i = 0, $wordlen = strlen($word); $i < $wordlen; $i++)

			{

				$temp .= substr($word, $i, 1)."\s*";

			}



			// We only want to do this when it is followed by a non-word character

			// That way valid stuff like "dealer to" does not become "dealerto"

			$str = preg_replace_callback('#('.substr($temp, 0, -3).')(\W)#is', array($this, '_compact_exploded_words'), $str);

		}

		

		/*

		 * Remove disallowed Javascript in links or img tags

		 * We used to do some version comparisons and use of stripos for PHP5, but it is dog slow compared

		 * to these simplified non-capturing preg_match(), especially if the pattern exists in the string

		 */

		do

		{

			$original = $str;

	

			if (preg_match("/<a/i", $str))

			{

				$str = preg_replace_callback("#<a\s+([^>]*?)(>|$)#si", array($this, '_js_link_removal'), $str);

			}

	

			if (preg_match("/<img/i", $str))

			{

				$str = preg_replace_callback("#<img\s+([^>]*?)(\s?/?>|$)#si", array($this, '_js_img_removal'), $str);

			}

	

			if (preg_match("/script/i", $str) OR preg_match("/xss/i", $str))

			{

				$str = preg_replace("#<(/*)(script|xss)(.*?)\>#si", '[removed]', $str);

			}

		}

		while($original != $str);



		unset($original);



		/*

		 * Remove JavaScript Event Handlers

		 *

		 * Note: This code is a little blunt.  It removes

		 * the event handler and anything up to the closing >,

		 * but it's unlikely to be a problem.

		 *

		 */

		$event_handlers = array('[^a-z_\-]on\w*','xmlns');



		if ($is_image === TRUE)

		{

			/*

			 * Adobe Photoshop puts XML metadata into JFIF images, including namespacing, 

			 * so we have to allow this for images. -Paul

			 */

			unset($event_handlers[array_search('xmlns', $event_handlers)]);

		}



		$str = preg_replace("#<([^><]+?)(".implode('|', $event_handlers).")(\s*=\s*[^><]*)([><]*)#i", "<\\1\\4", $str);



		/*

		 * Sanitize naughty HTML elements

		 *

		 * If a tag containing any of the words in the list

		 * below is found, the tag gets converted to entities.

		 *

		 * So this: <blink>

		 * Becomes: &lt;blink&gt;

		 *

		 */

		$naughty = 'alert|applet|audio|basefont|base|behavior|bgsound|blink|body|embed|expression|form|frameset|frame|head|html|ilayer|iframe|input|isindex|layer|link|meta|object|plaintext|style|script|textarea|title|video|xml|xss';

		$str = preg_replace_callback('#<(/*\s*)('.$naughty.')([^><]*)([><]*)#is', array($this, '_sanitize_naughty_html'), $str);



		/*

		 * Sanitize naughty scripting elements

		 *

		 * Similar to above, only instead of looking for

		 * tags it looks for PHP and JavaScript commands

		 * that are disallowed.  Rather than removing the

		 * code, it simply converts the parenthesis to entities

		 * rendering the code un-executable.

		 *

		 * For example:	eval('some code')

		 * Becomes:		eval&#40;'some code'&#41;

		 *

		 */

		$str = preg_replace('#(alert|cmd|passthru|eval|exec|expression|system|fopen|fsockopen|file|file_get_contents|readfile|unlink)(\s*)\((.*?)\)#si', "\\1\\2&#40;\\3&#41;", $str);

					

		/*

		 * Final clean up

		 *

		 * This adds a bit of extra precaution in case

		 * something got through the above filters

		 *

		 */

		foreach ($this->never_allowed_str as $key => $val)

		{

			$str = str_replace($key, $val, $str);   

		}

	

		foreach ($this->never_allowed_regex as $key => $val)

		{

			$str = preg_replace("#".$key."#i", $val, $str);

		}



		/*

		 *  Images are Handled in a Special Way

		 *  - Essentially, we want to know that after all of the character conversion is done whether

		 *  any unwanted, likely XSS, code was found.  If not, we return TRUE, as the image is clean.

		 *  However, if the string post-conversion does not matched the string post-removal of XSS,

		 *  then it fails, as there was unwanted XSS code found and removed/changed during processing.

		 */



		if ($is_image === TRUE)

		{

			if ($str == $converted_string)

			{

				return TRUE;

			}

			else

			{

				return FALSE;

			}

		}

		

		log_message('debug', "XSS Filtering completed");

		return $str;

	}



	// --------------------------------------------------------------------



	/**

	 * Random Hash for protecting URLs

	 *

	 * @access	public

	 * @return	string

	 */

	function xss_hash()

	{

		if ($this->xss_hash == '')

		{

			if (phpversion() >= 4.2)

				mt_srand();

			else

				mt_srand(hexdec(substr(md5(microtime()), -8)) & 0x7fffffff);



			$this->xss_hash = md5(time() + mt_rand(0, 1999999999));

		}



		return $this->xss_hash;

	}

	

	function checkExists($table, $where){

		

		$res = $this->getRowArray($table, $where);

		if($res)

		 return true;

	    else

		 return false;

	}

//ends the class over here













	function doUpdate($data , $table_name , $where = '' , $show=0)
    {
        $conn = $this->CONN;
    	if(is_array($data))
    	{
    		$sql_do_update = "update " . $table_name . " set ";
			foreach($data as $key=>$val)				
                $sql_do_update .= $key . " = '" . $val . "', ";
				//$sql_do_update .= $key . " = '" . mysql_escape_string($val) . "', ";	

			$sql_do_update = rtrim($sql_do_update , ', ');
			$where = trim($where);
			if($where != '')$sql_do_update .= " where " . $where;
			if($show == 1)echo $sql_do_update;
            
			if(!mysqli_query($conn,$sql_do_update))echo mysql_error();
            
			$affected_row = mysqli_affected_rows();

   			return $affected_row;
    	}
    }

	function doInsert($data , $table_name , $show=0)
    {
        $conn = $this->CONN;
    	if(is_array($data))
    	{
    		$sql_do_insert = "insert into " . $table_name . " set ";
			foreach($data as $key=>$val)
				$sql_do_insert .= $key . " = '" . $val . "', ";

			$sql_do_insert = rtrim($sql_do_insert , ', ');

			if(!mysqli_query($conn,$sql_do_insert))echo mysql_error();
			$insertID = mysqli_insert_id();
			
            if($show == 1)
				echo $sql_do_insert;

			return $insertID;
    	}
    }

	

	function simpleExecute($sql , $show=0)

	{

        if($show == 1)

    		echo $sql;

		$result = mysqli_query($sql);

		

		if(!$result)die(mysql_error());

        

        return $result;

	}

	

	function executeSingle($select = '*' , $table_name , $where = '' , $show=0)

    {  		

    	$sql_select = "select " . $select . " from " . $table_name;

    	$where = trim($where);

		if($where != '')$sql_select .= " where " . $where . " limit 0,1";

    	if($show == 1)

    		echo $sql_select;

    	$result = @mysqli_query($sql_select);

    	if($result)

    	{

    		$row = mysql_fetch_row($result);

    		

    		return $row[0];

    	}    	

    }

    

    function deleteField($table_name , $where = '')

    {

    	$where = trim($where);

    	if(strlen($where) > 0)

    	{

    		$sql = "delete from " . $table_name . " where " . $where;

			@mysqli_query($sql);	

    	}    	

    }

    

    

    function countTotal($table_name , $where = '' , $show=0)

    {  		

    	$sql_select = "select count(*) from " . $table_name;

    	$where = trim($where);

		if($where != '')$sql_select .= " where " . $where;

    	if($show == 1)

			echo $sql_select;

    	#return $sql_select;

    	$result = @mysqli_query($sql_select);

    	

    	if($result)

    	{

    		$row = mysql_fetch_row($result);

    		#pre($row);exit;	

    		return $row[0];

    	}

		else

			return 0;    	

    }

    

    function querySingle($select = '*' , $table_name , $where = '' , $show=0)
    {
        $conn = $this->CONN;
    	$sql_select = "select " . $select . " from " . $table_name ." where " . $where . " limit 0,1";
    	if($show == 1)
    		echo $sql_select;
        $result = mysqli_query($conn,$sql_select);        
    	if($result)
    	{
    		$row = mysqli_fetch_array($result , MYSQLI_ASSOC);
    		return $row;
    	}
    }

    

    function dbQuery($select = '*' , $table_name , $where = '' , $order_by = '' , $limit = '',$show=0)

    {	    	

    	$sql_select = "select " . $select . " from " . $table_name;

    	$where = trim($where);

		if($where != '')$sql_select .= " where " . $where;

		$order_by = trim($order_by);

		if($order_by != '')$sql_select .= " order by " . $order_by;		

		$limit = trim($limit);

		if($limit != '')$sql_select .= " limit " . $limit;

		if($show!=0)

    		echo $sql_select;

    	$result = mysqli_query($sql_select);    	

    	if($result)

    	{	

    		while($row = mysql_fetch_array($result , MYSQL_ASSOC))    		

    			$result_arr[] = $row;

    		

    		return $result_arr;

    	}

		else die(mysql_error());    

			

    }



	function simpleSelect($sql_select , $show=0)

    {	

    	$sql_select = trim($sql_select);

    	if($show == 1)echo $sql_select; 

    	$result = mysqli_query($sql_select);    	

    	if($result)

    	{	

    		while($row = mysql_fetch_array($result , MYSQL_ASSOC))    		

    			$result_arr[] = $row;

    		

    		return $result_arr;

    	}

		else die(mysql_error());    

			

    }



	function pickRow($table_name , $primary_key , $primary_key_val)

	{

		return $this->querySingle("*" , $table_name , $primary_key . " = '" . $primary_key_val . "'");

	}

	

	function deleteRow($table_name , $primary_key , $primary_key_val , $show = 0)

	{

		$sql = "delete from " . $table_name . " where " . $primary_key . " = '" . $primary_key_val . "'";

		if($show == 1)echo $sql;

		if(mysqli_query($sql))return true;

		else return false;

		

		//return $this->querySingle("*" , $table_name , $primary_key . " = '" . $primary_key_val . "'");

	}

	

	

	function bindPOST($table_name,$priColumn=false){



			$data = array();

			

			if(!$priColumn){

				$priColumn = $this->primary($table_name);

			}

			

			if(count($_POST) >=1){

					

				$columns = $this->getColumns($table_name);

				foreach ($_POST as $key => $value){

					if (in_array($key, $columns)){

						$data[$key] = $value;

					}

				}//foreach

				

				//AFTER PREPARE DATA ARRAY			

				if (array_key_exists($priColumn, $data)){

					//UPDATE

					$sql ="UPDATE ".$table_name." SET ";

					$i=0;

					foreach($data as $key=>$value){

						

						$value = $this->db_prepare_input($value);

						

						if($i==0){

							if(is_string($value)){

								$sql .= "`".$key ."` = '".$this->db_input($value)."'";

							}else{

								$sql .= "`".$key ."` = '".$value."'";

							}

						}else{

							if(is_string($value)){

								$sql .= ", `".$key ."` = '".$this->db_input($value)."'";

							}else{

								$sql .= ", `".$key ."` = '".$value."'";

							}

						}

					

					$i++;

					}//foreach

					

					 $sql .= " WHERE ".$priColumn." = ".$data[$priColumn];

					

					return $this->edit($sql);

				

				}else{

					//INSERT

					$sql ="INSERT INTO ".$table_name." SET ";

					$i=0;

					foreach($data as $key=>$value){

							

						$value = $this->db_prepare_input($value);

						if($i==0){

							if(is_string($value)){

								$sql .= $key ." = '".$this->db_input($value)."'";

							}else{

								$sql .= $key ." = '".$value."'";

							}

						}else{

							

							if(is_string($value)){

								$sql .= ", ".$key ." = '".$this->db_input($value)."'";

							}else{

								$sql .= ", ".$key ." = '".$value."'";

							}

						}

					$i++;

					}//foreach

			//	echo $sql;

				return $this->insert($sql);

				}

				

			}else return false;

					

		}

	

	

	

	function Query($select = '*' , $table_name , $where = '' , $order_by = '' , $limit = '')

    {

    	$sql_select = "select " . $select . " from " . $table_name;

    	$where = trim($where);

		if($where != '')$sql_select .= " where " . $where;

		$order_by = trim($order_by);

		if($order_by != '')$sql_select .= " order by " . $order_by;		

		$limit = trim($limit);

		if($limit != '')$sql_select .= " limit " . $limit;

    	

    	$result = @mysqli_query($sql_select);

    	if($result)

    	{

  			

    		while($row = mysql_fetch_array($result , MYSQL_ASSOC))    		

    			$result_arr[] = $row;

    		

    		return $result_arr;

    	}    	

    }

	function update($sql="")

        {

                if(empty($sql)) { return false; }

                if(!preg_match("/^update/i",$sql))

                {

						$this->error(" UPDATE is Misspeling");

                        return false;

                }

                if(empty($this->CONN))

                {

                       	$this->error(" DB CONNECTION Failed"); 

						return false;

                }

                $conn = $this->CONN;

                $results =@mysqli_query($conn,$sql);

                if(!$results) 

                {

						$this->error($sql);

                        return 0;

                }

                $rows = 0;

                $rows = mysqli_affected_rows($conn);

                return $rows;

        }

	

	/*function bindPOST($table_name,$priColumn=false){



	$data = array();

	

	if(!$priColumn){

	$priColumn = $this->primary($table_name);

	}

	

	if (count($_POST)){

	

	$columns = $this->getColumns($table_name);

	foreach ($_POST as $key => $value)

	{

		if (in_array($key, $columns))

		{

		$data[$key] = $value;

	}

	}

	

	//pre($data);

	

	if (array_key_exists($priColumn, $data)){

	

	//UPDATE

	

	$sql ="UPDATE ".$table_name." SET ";

	$i=0;

	foreach($data as $key=>$value){

	$value = $this->db_prepare_input($value);

	if($i==0){

		if(is_string($value)){

		$sql .= "`".$key ."` = '".$this->db_input($value)."'";

		}else{

		$sql .= "`".$key ."` = '".$value."'";

		}

	}else{

		if(is_string($value)){

		$sql .= ", `".$key ."` = '".$this->db_input($value)."'";

		}else{

		$sql .= ", `".$key ."` = '".$value."'";

		}

	

	}

	

	$i++;

	}//foreach

	

	$sql .= " WHERE ".$priColumn." = ".$data[$priColumn];

	

	return $this->edit($sql);

	

	}else{

	

	//insert

	$sql ="INSERT INTO ".$table_name." SET ";

	$i=0;

	foreach($data as $key=>$value){

	$value = $this->db_prepare_input($value);

	if($i==0){

	if(is_string($value)){

	$sql .= $key ."= '".$this->db_input($value)."'";

	}else{

	$sql .= $key ."='".$value."'";

	}

	}else{

	if(is_string($value)){

	$sql .= ", ".$key ."= '".$this->db_input($value)."'";

	}else{

	$sql .= ", ".$key ."='".$value."'";

	}

	



	}

		$i++;

	}//foreach

	

	return $this->insert($sql);

	}

	

	} else return FALSE;

	}*/





	

}

?>