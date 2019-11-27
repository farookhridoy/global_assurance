<!doctype html>
<html>
  <head>
    <title>Global Assurance Group:Welcome</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex"/>
    <meta name="robots" content="nofollow"/>

    <link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.ico"/>
    <link rel="shortcut icon" type="image/png" href="<?php echo MEDIA_IMAGES; ?>favicon.png"/>

    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>style-jeet.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>style.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>media.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL; ?>select2.min.css"/>
    
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,300i,400,400i,500,500i,600,600i,700,700i,800,900" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>jquery.mCustomScrollbar.css"/>

    <style type="text/css">
      html,body{ height: 100%; }
      /*body{background:#fff; }*/
    </style>
    
  
    
    
  </head>
  <body class="globalassurance">
  <div class="roots">
  <header>
        <div class="logo"><a href="dashboard.html"><img src="<?php echo MEDIA_IMAGES; ?>logo.png" alt="logo"/></a></div>
        <div class="menuToggle" id="leftPanelMenu"><i class="fas fa-bars"></i><i class="fas fa-times"></i></div>
        <div class="float-right">
          <div class="userporthead">
            <div class="userporthead_port">
              <div class="userphotoimg"><img src="http://0.gravatar.com/avatar/69d0fea8ffe160479df0051cb5de61b8?s=96&amp;d=mm&amp;r=g" alt="user"></div>
              <span><?php echo state("full_name"); ?></span>
              <span class="userpordown"><i class="fas fa-angle-down"></i></span>    
            </div>
            <div class="userporthead_menus" id="croudmenu">
              <ul>            
                <li><a href="#"><i class="fas fa-user"></i>My Account</a></li>
                <?php $checkPermission = checkUserAccessRole('Admin'); if($checkPermission){ ?>
                <li><a href="<?php echo THE_URL."admin/manageusers"; ?>"><i class="fas fa-users"></i>Manage Users</a></li>
                <?php } ?>
                <li><a href="<?php echo THE_URL."auth/logout"; ?>"><i class="fas fa-power-off"></i>Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
  </header>
 <?php getUserSideBar(); ?>