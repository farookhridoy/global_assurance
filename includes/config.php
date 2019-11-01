<?php
error_reporting(0);
ob_start();
session_start();
define('SCRIPT_URL', "http://".$_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'],0, strpos($_SERVER['PHP_SELF'], "index.php")));
define('BASE_DIR' , substr(__FILE__ ,0, strpos(__FILE__, "includes")));
define('DS' , '/');	

if(!defined("THE_URL"))
define('THE_URL' ,SCRIPT_URL);	
	
define('DIR_3RD_PARTY',BASE_DIR.'includes/3rdParty/');
define('WWW_3RD_PARTY',SCRIPT_URL.'includes/3rdParty/');

define('CSS_IMAGE_URL',SCRIPT_URL.'includes/css/images/');
define('ADMIN_CSS_IMAGE_URL',SCRIPT_URL.'includes/admin-css/images/');
define('JS_URL',SCRIPT_URL.'includes/js/');

define('CONTROLLER_STORE',BASE_DIR.'controllers/');
define('TEMPLATE_STORE',BASE_DIR.'templates/');
	
define('RESOURCE_STORE',BASE_DIR.'media/');
define('WWW_RESOURCE_STORE',SCRIPT_URL.'media/');


define('MEDIA_IMAGES',SCRIPT_URL.'media/images/');

	
define('WEB_STORE',BASE_DIR.'web/files/images/');
define('WWW_WEB_STORE',SCRIPT_URL.'web/files/images/');
	
	
define('DEFAULT_CONTROLER' , 'home');
define('DEFAULT_FUNCTION' , 'default_func');

//define('COMMON_TEMPLATES',BASE_DIR.'includes/common-templates/');
define('COMMON_TEMPLATES',BASE_DIR.'templates/default/');
define('ADMIN_TEMPLATES',BASE_DIR.'includes/admin-common-templates/');
	
define('CSS_DIR',BASE_DIR.'includes/css/');
define('CSS_URL',SCRIPT_URL.'includes/css/');
define('ADMIN_CSS_DIR',BASE_DIR.'includes/admin-css/');
define('ADMIN_CSS_URL',SCRIPT_URL.'includes/admin-css/');

define('DB_DATABASE','global_database');
define('DB_SERVER_USERNAME','root');
define('DB_SERVER_PASSWORD','');
define('DB_SERVER','localhost');
define('PRFX','');
     


//DEFILE ADMIN
define('ADMIN_URL',SCRIPT_URL.'admin/');

define('ADMIN_LOGO','ADMIN <span>PANEL </span>');
define('ADMIN_TITLE','ADMIN PANEL');

//DEFINE FAVICON
define('FAVICON','favicon.ico');
define('HTML_PARAMS','dir="ltr" lang="en"');  


$dir_functions = BASE_DIR."includes/functions/";
include_from($dir_functions);

$dir = BASE_DIR."includes/models/";
include_from($dir);

require_once(BASE_DIR."includes/classes/dbclass.php");
$db = new dbclass;

/**** global variables used in templates/functions *****/
$datePicker = '';
$footerFunctions = '';
$userSideBar = '';

require BASE_DIR."includes/classes/phpmailer/PHPMailerAutoload.php";

require_once(BASE_DIR."includes/classes/setsessionclass.php");
$session = new setsessionclass;

$HTTP_HOST1 = $_SERVER['HTTP_HOST'];
$REQUEST_URI1 = $_SERVER['REQUEST_URI'];
$HOST_URI1 = 'http://'.$HTTP_HOST1.$REQUEST_URI1;
define('CURRENT_URL' , $HOST_URI1);


define('SITE_NAME',getSettings('SCRIPT_NAME'));
define('SITE_TITLE',getSettings('SCRIPT_META_KEYWORD'));


function include_from($dir, $ext='php'){
	$opened_dir = opendir($dir);	
	while ($element=readdir($opened_dir)){
	   $fext=substr($element,strlen($ext)*-1);
	   if(($element!='.') && ($element!='..') && ($fext==$ext)){
		  include($dir.$element);
	   }
	}
	closedir($opened_dir);
}
?>