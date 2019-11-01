<?php
function pre($value){ echo '<pre>'; print_r($value);echo '</pre>';}
function urlredirect($url=false){header("Location: ".$url);exit;}

function close_window($reload_parent=false){$script ="<script type=\"text/javascript\">";if($reload_parent)$script .="window.opener.location.reload();";$script .="window.close();</script>";echo $script;}
function valid_email($email_address){ return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email_address)) ? false : true; }

function IP_TO_LONG($remote_address){$long = ip2long($remote_address);if ($long == -1 || $long === FALSE) {/*echo 'Invalid IP, please try again';*/return false;} else {$ipnum=sprintf("%u", ip2long($remote_address));return $ipnum;}}
function LONG_TO_IP($ipnum){$ip_address=long2ip($ipnum);return $ip_address;}

function base64UrlEncode($url){return urlencode(base64_encode($url));}
function base64UrlDecode($url){return base64_decode(urldecode($url));}
 
function getFileExtention($file_name){if($file_name){$ext = substr($file_name,strrpos($file_name,"."),strlen($file_name));}return $ext;}


function read_file($filename) {$f=fopen($filename,"r");if(filesize($filename) <= 0){return 'No data inserted yet!';}else{$data=fread($f,filesize($filename));}fclose($f);return $data;}
function write_file($filename,$newdata){$f=fopen($filename,"w");fwrite($f,$newdata);fclose($f);}
function append_file($filename,$newdata) {$f=fopen($filename,"a");fwrite($f,$newdata);fclose($f);}


function create_random_value($length=12, $type = 'mixed') {if ( ($type != 'mixed') && ($type != 'chars') && ($type != 'digits')) return false;$rand_value = '';while (strlen($rand_value) < $length) {if ($type == 'digits') {$char = rand(0,9);} else {$char = chr(rand(0,255));}if ($type == 'mixed') {if (eregi('^[a-z0-9]$', $char)) $rand_value .= $char;} elseif ($type == 'chars') {if (eregi('^[a-z]$', $char)) $rand_value .= $char;} elseif ($type == 'digits') {if (ereg('^[0-9]$', $char)) $rand_value .= $char;}}return $rand_value;}
function displayPrice($price,$len=2,$format="$"){$displayprice=$format.number_format($price, $len, '.', ',');return $displayprice;}
function displayNumber($number,$len=2){$displaynumber=number_format($number, $len, '.', ',');return $displaynumber;}
	
function PubdateToDateTime($pubDate){/* $pubDate='Tue, 12 May 2009 04:27:27 GMT';*/$time=strtotime($pubDate);	/*1242102447 */$datetime=date('Y-m-d H:i:s', $time); /* 2009-05-12 04:27:27 */return $datetime;}
function mysql2timestamp($datetime){/*$datetime='2009-05-12 04:27:27';*/$val = explode(" ",$datetime);$date = explode("-",$val[0]);$time = explode(":",$val[1]);return mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]); /*1242102447*/}
function date_time($datetime, $time=true){if($time){return date("F j, Y, g:i a",strtotime($datetime));}else{return date("F j, Y",strtotime($datetime));}}

function getDateTimeDifference($datetime){
 	
 		/*$date['second'] = strtotime("now") - strtotime($datetime);*/
 		$date['second'] = time() - strtotime($datetime);
 		$time_minute = $date['second']/60;
 		if( $time_minute >= 1){
 			$time = (int)($time_minute);
 			$unit =  ($time >= 2)? "minutes": "minute";
 			
 			$time_hour = $time_minute/60;
		  	if($time_hour >= 1){
	 			$time = (int)($time_hour);
	 			$unit =  ($time >= 2)? "hours": "hour";
	 			
			    $time_day = $time_hour/24;
			    if( $time_day >= 1){
		 			$time = (int)($time_day);
		 			$unit =  ($time >= 2)? "days": "day";
		 			
				    $time_month = $time_day/30;
				    if( $time_month >= 1){
			 			$time = (int)($time_month);
			 			$unit =  ($time >= 2)? "months": "month";
			 			
			 			$time_year = $time_month/12;
			 			if($time_year >= 1){
			 			 $time = 1;	
			 			 $unit = "year(or more)";
			 			}//end year
		 			}//end month
			    }//end day
		    }//end hour
 		}//end minutes
		else{
		 $time = '';
		 $unit = 'Moments';
		}
		
 	  $date['time']	= $time; //5
 	  $date['unit']	= $unit; // minutes
 
 	return $date;
 
 }
 
 function getDateTimeToAgo($datetime){
 	
 		/*$date['second'] = strtotime("now") - strtotime($datetime);*/
 		$seconds = time() - strtotime($datetime);
 		$time_minute = $seconds/60;
 		if( $time_minute >= 1){
 			$time = (int)($time_minute);
 			$unit =  ($time >= 2)? "minutes": "minute";
 			
 			$time_hour = $time_minute/60;
		  	if($time_hour >= 1){
	 			$time = (int)($time_hour);
	 			$unit =  ($time >= 2)? "hours": "hour";
	 			
			    $time_day = $time_hour/24;
			    if( $time_day >= 1){
		 			$time = (int)($time_day);
		 			$unit =  ($time >= 2)? "days": "day";
		 			
				    $time_month = $time_day/30;
				    if( $time_month >= 1){
			 			$time = (int)($time_month);
			 			$unit =  ($time >= 2)? "months": "month";
			 			
			 			$time_year = $time_month/12;
			 			if($time_year >= 1){
			 			 $time = 1;	
			 			 $unit = "year(or more)";
			 			}//end year
		 			}//end month
			    }//end day
		    }//end hour
 		}//end minutes
		else{
		 $time = $seconds;
		 $unit = 'seconds';
		}

 	return $time." ".$unit ." ago" ;
 }
 function InStr($String,$Find,$CaseSensitive = false){
	$i=0;
	while (strlen($String)>=$i)
	{
	unset($substring);
	if ($CaseSensitive)
	{
	$Find=strtolower($Find);
	$String=strtolower($String);
	}
	$substring=substr($String,$i,strlen($Find));
	if ($substring==$Find) return true;
	$i++;
	}
	return false; 	
}
 function getListedDate($datetime,$time=false){
 	
 		$time_second = time() - strtotime($datetime);
 		$time_minute = $time_second/60;
 		$time_hour = $time_minute/60;
		$time_day = $time_hour/24;
		$time_day = (int)($time_day);
		
		if($time_day == 0){
			return 	$time_day= "Today";
		}elseif($time_day == 1){
			return 	"Yesterday";
		}else{
			if($time){
				return  date("F j, Y, g:i a");  // March 10, 2001, 5:16 pm
			}else{
				return  date("F j",strtotime($datetime));  // March 10, 2001, 5:16 pm
			}
		}
}

 function getEndedDate($datetime,$unit='day'){
 	
 		$time_second = strtotime($datetime)-time();
 		$time_minute = $time_second/60;
 		$time_hour = $time_minute/60;
		$time_day = $time_hour/24;
		$time_day = (int)($time_day);
		
		if($time_day == 0){
			return 	$time_day= "Today".$unit;
		}elseif($time_day < 30) {
			$unit= ($time_day >= 2)? "days": "day";
			return 	$time_day= $time_day." ".$unit;	
		}else{
			$time_month = $time_day/30;
			$time_month = (int)($time_month);
			if($time_month<12){
				$unit= ($time_month >= 2)? "months": "month";
				return 	$time_month= $time_month." ".$unit;	
			}else{
				$time_year = $time_month/12;
				$time_year = (int)($time_year);
				$unit= ($time_year >= 2)? "years": "year";
				return 	$time_year= $time_year." ".$unit;	
			}
		}
}
 
 
 function getFormatedDate($date_in_y_mm_dd,$format){$year_leading = substr(date('Y'),0,2);$time = strtotime($year_leading.$date_in_y_mm_dd);return 	date($format,$time);   /*date: 090502 */}	
  
 function getCalenderDates(){
    $time = time();
    $month = date('m');
	 for($i= 0; $i< 30; $i++){
		 $x[$i]['date_f1'] = date('Y-m-d',$time);
		 $x[$i]['date_f2'] = date('ymd',$time);
	     $x[$i]['month']=(date('m',$time)==$month)?1:0;
	     $x[$i]['day']= date('d',$time);
		 $time = $time - (24 * 60 * 60);
	 }
  
    return  $x;
 }
/**********************************************************************************************/

function check_url($url){
	$host=str_replace(" ","",$url);
	$host_url = strstr(strtolower($host), 'http://')?$host:'http://'.$host;
	$parse_host_url=@parse_url($host_url);
  	$host_array=explode(".", $parse_host_url['host']);
   
   // validate data now
   if(strtolower($host_array[0])=='www'){
	    if(count($host_array)<3){
			return false;
		}
	}else{
		if(count($host_array)<2){
			return false;
		}	
	}
	
	return $host_url;
}


/*USEES ::  trunc_string(clean_html(stripslashes($rows['description'])), 300); */
function trunc_string($str = "", $len = 150, $more = 'true'){
    if ($str == "") return $str;
    if (is_array($str)) return $str;
    $str = trim($str);
    if (strlen($str) <= $len) return $str;
    /* else get that size of text*/
    $str = substr($str, 0, $len);
    /* backtrack to the end of a word*/
    if ($str != "") {
      if (!substr_count($str , " ")) {
        if ($more == 'true') $str .= "...";
        return $str;
      }
      /* backtrack */
      while(strlen($str) && ($str[strlen($str)-1] != " ")) {
        $str = substr($str, 0, -1);
      }
      $str = substr($str, 0, -1);
      if ($more == 'true') $str .= "...";
      if ($more != 'true' and $more != 'false') $str .= $more;
    }
    return $str;
}


function clean_html($clean_it, $extraTags = '') {
  	
  	if(!is_array($extraTags)) $extraTags = array($extraTags);

    $clean_it = preg_replace('/\r/', ' ', $clean_it);
    $clean_it = preg_replace('/\t/', ' ', $clean_it);
    $clean_it = preg_replace('/\n/', ' ', $clean_it);

    $clean_it= nl2br($clean_it);

	/* update breaks with a space for text displays in all listings with descriptions*/
    while (strstr($clean_it, '<br>'))   $clean_it = str_replace('<br>',   ' ', $clean_it);
    while (strstr($clean_it, '<br />')) $clean_it = str_replace('<br />', ' ', $clean_it);
    while (strstr($clean_it, '<br/>'))  $clean_it = str_replace('<br/>',  ' ', $clean_it);
    while (strstr($clean_it, '<p>'))    $clean_it = str_replace('<p>',    ' ', $clean_it);
    while (strstr($clean_it, '</p>'))   $clean_it = str_replace('</p>',   ' ', $clean_it);

	/* temporary fix more for reviews than anything else*/
    while (strstr($clean_it, '<span class="smallText">')) $clean_it = str_replace('<span class="smallText">', ' ', $clean_it);
    while (strstr($clean_it, '</span>')) $clean_it = str_replace('</span>', ' ', $clean_it);

	/* clean general and specific tags:*/
    $taglist = array('strong','b','u','i','em','p');
    $taglist = array_merge($taglist, (is_array($extraTags) ? $extraTags : array($extraTags)));
    foreach ($taglist as $tofind) {
      if ($tofind != '') $clean_it = preg_replace("/<[\/\!]*?" . $tofind . "[^<>]*?>/si", ' ', $clean_it);
    }

	/* remove any double-spaces created by cleanups:*/
    while (strstr($clean_it, '  ')) $clean_it = str_replace('  ', ' ', $clean_it);

	/* remove other html code to prevent problems on display of text*/
    $clean_it = strip_tags($clean_it);
    
    return $clean_it;
}
 

function convert_size($size,$type='byte'){
		switch($type){
			case 'byte':
				$result= $size;
				break;
			case 'KB':
				$result= round($size/1024, 2);
				break;
			case 'MB':
				$result= round($size/(1024*1024), 2);
				break;
			case 'GB':
				$result= round($size/(1024*1024*1024), 2);
				break;			
		}
	return $result;	
}
function make_seo_title($str, $uid = FALSE){
 	
	/*html decode, in case it is coming encoded (AJAX request)*/
	$seo_title = rawurldecode($str);
	
	/*some characters that might create trouble*/
	$switch_chars = '(,),\,/';
	$sc = explode(',', $switch_chars);
    $seo_title = trunc_string(clean_html(stripslashes(trim($seo_title))),90,false);
    
	foreach ($sc as $c) $seo_title = str_replace($c, '-', $seo_title);
	
	/* leave only alphanumeric characters and replace spaces with hyphens*/
    $seo_title = strtolower(str_replace('--', '-', preg_replace('/[\s]/', '-', preg_replace('/[^[:alnum:]\s-]+/', '', $str))));
	$len = strlen($seo_title);
	
	if ($seo_title[$len - 1] == '-') $seo_title = substr($seo_title, 0, -1);
	if ($seo_title[0] == '-') $seo_title = substr($seo_title, 1, $len);
	if ($uid) $seo_title = $seo_title . '-' . $uid;
	
	return $seo_title;
}

function parse_seo_title($str, $returnIndex = 0){
    $parts = explode('-', $str);
    if (count($parts) > 0){
        switch($returnIndex){
            case -1:
                return $parts;
                break;        
            case 0:
                return $parts[count($parts) - 1];
                break;
            default:
                return $parts[$returnIndex - 1];
        }
    }
    return FALSE;
}
function getMetaInfo($url){
	
   $v= $url;
   if($v){$i = strpos($v,"\r\n\r\n");$headers = substr($v,0,$i);$v = substr($v,$i);}
   $enc = "auto";
   
   $m=array();
   preg_match('/charset=[\\s]*([a-z0-9\\-]+)/i', $headers, $m);
   if($m && @$m[1]){$enc = trim($m[1]);}
  
   $m=array();
   preg_match('/<meta\s+http\-equiv=[^>]+charset=([a-z0-9\\-]+)/i', $v, $m);
  	if($m && $m[1]){$enc = $m[1];$enc = trim($enc);}
  
   $m=array();
   preg_match('/<meta[^>]+charset=([a-z0-9\\-]+)[^>]+http\-equiv=/i', $v, $m);
   
   if($m && $m[1]){$enc = $m[1];$enc = trim($enc);}

   $v = mb_convert_encoding  ( $v, 'UTF-8', $enc);
   
   preg_match('/<title>(.*?)<\/title>/si', $v, $r);
   $page_title = $r[1]?$r[1]:"";
   
   preg_match('/<meta\s+name=\"descr.*?content=\"(.*?)\"/si', $v, $r);
   if (!$r[1])preg_match('/<meta\s+name=\'descr.*?content=\'(.*?)\'/si', $v, $r);
   if (!$r[1])preg_match('/<meta\s+http\-equiv=\'descr.*?content=\'(.*?)\'/si', $v, $r);
   
   $desc = $r[1]?$r[1]:"";
   preg_match('/<meta\s+name=\"keyw.*?content=\"(.*?)\"/si', $v, $r);
   if (!$r[1])preg_match('/<meta\s+name=\'keyw.*?content=\'(.*?)\'/si', $v, $r);
   if (!$r[1])preg_match('/<meta\s+content=\'(.*?)\'.*?name=\'keyw/si', $v, $r);
   if (!$r[1])preg_match('/<meta\s+content=\"(.*?)\".*?name=\"keyw/si', $v, $r);
   if (!$r[1])preg_match('/<meta\s+http\-equiv=\'keyw.*?content=\'(.*?)\'/si', $v, $r);
   $keys = $r[1]?$r[1]:"";
   if (!$keys || !$desc) { // do some fallback
    $r = "/tmp/".rand(1000, 10000).".html"; // faster than requesting the url
    file_put_contents($r, $v);
    $meta = get_meta_tags($r);
    unlink($r);
    $keys = $meta['keywords'];
    $desc = $meta['description'];
   }
   // do some work on the keywords for safety as people are, yes, morons.
   return array("title"=>$page_title, "description"=>$desc,"keywords"=>$keys);
}
//RSS Function
function MakeRSSFeed($channel_info, $items_info){
	
	// $channel_info AND $items_info must be array 
	//TAG HELP 
	//http://www.make-rss-feeds.com/rss-tags.htm
	
	/*
	$channel_info['title'] = 'Free eBooks Download';
	$channel_info['link'] = SCRIPT_URL;
	$channel_info['description'] = 'freebookspedia.com is a largest free ebooks provider in this world.';
	$channel_info['image_title'] ='Agriculture Information Service, Bangladesh';
	$channel_info['image_url'] =SCRIPT_URL.'images/logo.png';
	$channel_info['image_link'] =SCRIPT_URL;
	$channel_info['image_width'] ='240';
	$channel_info['image_height'] ='140';
	*/
	
	/*
	//PUT THIS CODE ON HEADER OR FOOTER ON THIS SITE
	*/
	
		$rss = '<?xml version="1.0" encoding="utf-8" ?>
			<rss version="2.0">
				<channel>						
					<title>'. $channel_info['title'] .'</title>
					<link>'. $channel_info['link'] .'</link>
					<description>'. $channel_info['description'] .'</description>
					<image>
						<title>'. $channel_info['image_title'] .'</title>
						<url>'. $channel_info['image_url'] .'</url>
						<link>'. $channel_info['image_link'] .'</link>
						<width>'. $channel_info['image_width'] .'</width>
						<height>'. $channel_info['image_height'] .'</height>
					</image>';
	
	if(is_array($items_info)){
		//ITEMS LIST
		foreach($items_info as $item){
			$rss .= '<item>
						 <title>'. $item["item_title"] .'</title>						 
						 <link>'.$item["item_link"].'</link>
						 <description><![CDATA[  '. $item["item_description"] .']]></description>
						 <pubDate>'.$item["item_pubDate"].'</pubDate>
					 </item>';
		}
	}
			
	$rss .= '</channel>
			 </rss>';
	
	return $rss;
}


// #IMRAN
//-------------------------------------- * -----------------------------//


    function __($name, $s1=null, $s2=null, $s3=null, $s4=null, $s5=null, $s6=null, $s7=null,
                $s8=null, $s9=null, $s10=null) {
        if ($s1 || is_array($name)) {
            if ($s1)
                $name = array($name, $s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8, $s9, $s10);
            for($i=0;$i<sizeof($name);$i++) {
                if (isset($_REQUEST[$name[$i]]))
                    $name[$i] = stripslashes($_REQUEST[$name[$i]]);
                else
                    $name[$i] = "";
            }
            return $name;
        }
        if (!isset($_REQUEST[$name]))
            return null;
        $r = $_REQUEST[$name];
        if ($r && get_magic_quotes_gpc()) {
            $r = stripslashes($r);
        }
        return $r;
    }
    
	function isLogged() {
	 	return state('CE_logged_in');
	}    
    
	function isAdmin() {
    	return isLogged() && state('CE_admin');
	}
	
	function requireAdmin() {
	 	if (!isAdmin())
	  		die('You are not allowed to perform this operation!');
	}	
function send_emailer($mailer = array()){
	
			$mailer['from_email']=isset($mailer['from_email'])?$mailer['from_email']:SITE_ADMIN_EMAIL;
			$mailer['from_name']=isset($mailer['from_name'])?$mailer['from_name']:SITE_ADMIN_NAME;
	
			require_once(BASE_DIR."includes/classes/emailclass.php");
			$email = new emailclass;
			
			$email->from($mailer['from_email'], $mailer['from_name']);
			$email->to($mailer['to_email'], $mailer['to_name']);
			$email->subject($mailer['subject']);
			$email->message($mailer['message']);
			
			////////sending html mail
			if(isset($mailer['mailtype']) && $mailer['mailtype']=='html')
		     $email->set_mailtype('html');
			//$email->cc('another@another-example.com');
			//$email->bcc('them@their-example.com');
			
			if (! @$email->send()){
				return false;
			}else return true;
}

////


?>