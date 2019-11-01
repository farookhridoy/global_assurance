<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::  ADMIN PANEL  ::</title>

<link  rel="stylesheet" type="text/css" href="<?php echo ADMIN_CSS_URL ?>inner.css" />
<link href="<?php echo ADMIN_CSS_URL ?>jqueryslidemenu.css" rel="stylesheet" type="text/css" /> 
<link href="<?php echo WWW_3RD_PARTY ?>wysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css" /> 

<script type="text/javascript" src="<?php echo JS_URL ?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL ?>jqueryslidemenu.js"></script>
<script type="text/javascript" src="<?php echo JS_URL ?>common.js"></script>
<script type="text/javascript"> var script_url = '<?php echo ADMIN_URL ?>'; </script>
<script type="text/javascript" src="<?php echo WWW_3RD_PARTY ?>wysiwyg/jquery.wysiwyg.js"></script>

<script type="text/javascript">
    $(function() {
		$('.textarea').wysiwyg();
		});
</script>

</head>
<body>


    <div id="wrapper">
      <div id="header">
         
            <div id="branding">
              <h1 class="logo"><a href="<?php echo ADMIN_URL ?>" title="ADMINPANEL">Admin Panel</a></h1> 
            
              
              <div class="header-right"> 
                 <div class="header-right-l">
                  <div class="header-right-r">
            
                   <ul class="welcome-msg">
                        <li>Welcome: <a href="<?php echo ADMIN_URL ?>">Administrator</a></li>
                        <li class="account"><a href="<?php echo ADMIN_URL.'myaccount' ?>">My account </a></li> 
                        <li class="logout"><a href="<?php echo ADMIN_URL.'logout' ?>">Logout</a></li>
                   </ul>
                   <span class="clear"></span> 
                   <!-- <ul class="user-info"> 
                        <li class="login-last">Last login: 192.168.1.10 </li> 
                        <li class="logintime">Time: 12:10 AM</li>
                   </ul> -->
                 </div>  
                 </div>     
               </div>
              
            <span class="clear"></span>
            </div>
            
            <div class="navigation">
              <div class="jqueryslidemenu" id="myslidemenu">
              
                <ul>
                  <li><a class="active" href="<?php echo ADMIN_URL ?>">Dash Board</a>
                    <!--<ul>
                      <li><a href="<?php echo ADMIN_URL.'user' ?>">User Manager</a></li>
                      <li><a href="<?php echo ADMIN_URL.'userinfo' ?>">New Manager</a></li>
                    </ul>-->
                  </li>
                  <li class="nav-split">|</li> 
                  <li><a href="<?php echo ADMIN_URL.'settings' ?>">Settings</a></li>
                  <li class="nav-split">|</li>
                  <li><a href="<?php echo ADMIN_URL.'home_manage_articles' ?>">Pages</a>
                     <ul>
                        <li><a href="<?php echo ADMIN_URL.'home_manage_articles' ?>">Home</a>
						    <ul>
		                      <li><a href="<?php echo ADMIN_URL.'home_manage_sliders' ?>">Manage Slide Shows</a></li>
		                      <li><a href="<?php echo ADMIN_URL.'home_manage_articles' ?>">Manage Articles</a></li>
		                      <li><a href="<?php echo ADMIN_URL.'home_add_article' ?>">Add Article</a></li>
	                        </ul>
					   </li>
		  
                      <li><a href="<?php echo ADMIN_URL.'intro_manage' ?>">Landing/Splash</a>
						    <ul>
		                      <li><a href="<?php echo ADMIN_URL.'intro_manage' ?>">Manage Page</a></li>
							  <li><a href="<?php echo ADMIN_URL.'intro_manage_icon' ?>">Manage Icons</a></li>
		                      <li><a href="<?php echo ADMIN_URL.'intro_groups' ?>">Manage Groups</a></li>
		                      <li><a href="<?php echo ADMIN_URL.'intro_manage_group' ?>">Manage GroupImages</a></li>
	                        </ul>
					  </li>
					  <li><a href="<?php echo ADMIN_URL.'bio_content' ?>">Bio</a>
					    <ul>
	                      <li><a href="<?php echo ADMIN_URL.'bio_content' ?>">Manage Content</a></li>
	                      <li><a href="<?php echo ADMIN_URL.'bio_slides' ?>">Manage Slides</a></li>
                        </ul>
					  </li>
                      <li>
					    <a href="<?php echo ADMIN_URL.'manage_media_page' ?>">Media</a>
					    <ul>
	                      <li><a href="<?php echo ADMIN_URL.'manage_media_page' ?>">Manage Content</a></li>
	                      <li><a href="<?php echo ADMIN_URL.'media_manage_links' ?>">Manage Links</a></li>
                        </ul>
				      </li>
				      
				       <li><a href="<?php echo ADMIN_URL.'store_content' ?>">Store</a>
					    <ul>
	                      <li><a href="<?php echo ADMIN_URL.'store_content' ?>">Manage Content</a></li>
	                      <li><a href="<?php echo ADMIN_URL.'store_slides' ?>">Manage Slides</a></li>
                        </ul>
					  </li>
				      
				      
					  <li><a href="<?php echo ADMIN_URL.'contact_manage' ?>">Contact</a></li>
					  <li><a href="<?php echo ADMIN_URL.'manage_board_page' ?>">Board</a>
	                     <ul>
	                       <li><a href="<?php echo ADMIN_URL.'manage_board_page' ?>">Manage Board Pages</a></li>
	                       <li><a href="<?php echo ADMIN_URL.'add_board_page' ?>">Add Board Page</a></li>
	                       
	                    </ul>
                  
                      </li>
                      <li><a href="<?php echo ADMIN_URL.'manage_team_page' ?>">Team</a></li>
                      <li><a href="<?php echo ADMIN_URL.'manage_stockist_page' ?>">Stockists</a></li>
                    </ul>
                  
                  </li> 
                  
                  <li class="nav-split">|</li>
                  <li><a href="<?php echo ADMIN_URL.'manage_newsletters' ?>">News Letters</a>
                     <ul>
                       <li><a href="<?php echo ADMIN_URL.'manage_newsletters' ?>">Manage News Letter</a></li>
                       <li><a href="<?php echo ADMIN_URL.'add_newsletter' ?>">Add News Letter</a></li>
                       <li><a href="<?php echo ADMIN_URL.'send_newsletter' ?>">Send News Letters</a></li>
                       <li><a href="<?php echo ADMIN_URL.'news_subscriber' ?>">Manage Subscriber</a></li>
                    </ul>
                  
                  </li> 
                  <li class="nav-split">|</li>
                  <li><a class="active" href="<?php echo ADMIN_URL .'contacts' ?>">Contacts</a></li>
                  <li class="nav-split">|</li>
                  <li><a class="active" href="<?php echo ADMIN_URL .'banner' ?>">Banner</a></li>
                  <li class="nav-split">|</li>
                  <li><a class="active" href="<?php echo ADMIN_URL .'manage_seo' ?>">SEO</a></li>
                  <li><a class="active" href="<?php echo ADMIN_URL .'manage_logo' ?>">LOGO</a></li>
                </ul>
            <span class="clear"></span> </div>
            </div>
         
      </div>
     <div id="container">
        <?php include(ADMIN_TEMPLATES.'messages.php');?>
        
        <?php 
            if($this->breadcum)
                include(ADMIN_TEMPLATES.'breadcum.php');
        ?>