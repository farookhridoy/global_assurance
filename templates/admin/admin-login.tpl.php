<body>
    <div id="wrapper">
        <div id="header">
          <div id="branding"> 
            <h1 class="admin-login">Admin <span class="login">Login</span></h1>
            <h1 class="logo"><a href="index.html" title="Admin Section">Admin Section</a></h1> 
            <span class="clear"></span>
          </div> 
        </div>
        
        
        <div id="container">
            
          <form action="" method="post"> 
              <div class="main">
                <div class="leftside"> 
                      <ul class="login_information">
                        <li class="userleft"></li>
                        <li class="usermid">
                          <input type="text" name="user_name" value="" class="textbox" />
                        </li>
                        <li class="userright"></li>
                        <li class="passleft"></li>
                        <li class="usermid">
                        <input type="password" name="password" value="" class="passbox" />
                        </li>
                        <li class="userright"></li>  
                        
                     </ul> 
                     <span class="clear"></span>
                </div> 
                <div class="rightside">
                    <!-- Invalid Login Box   -->
                    <?php
                        if($flag == -1)
                        {
                            ?>
                            <h2 class="invalid">Invalid Login!</h2>
                            <p>Appropriately licensed for resale. Except where explicitly stated this file is entirely the work.</p>      
                            <?php
                        }
                    ?>
                    <span class="clear"></span>
               </div> 
              <span class="clear"></span>
           </div>
             
          <div class="restofform-button">
            <ul>
               <li><input type="checkbox" value="" name=""  /></li> 
               <li class="rempass">Remeber Password</li> 
               <li class="forgotpass"><a href="#">Forgot Password?</a></li> 
            </ul>  
            <ul>
              <li><input type="submit" name="formSubmitted" value="Login" class="button" /></li>
            <!--  <li class="forgotpass"><a href="#">Forgot Password?</a></li> -->
            </ul>
         </div> 
          </form>   
          
          
        </div>
        
        <div id="footer"> 
          <div class="copyright"><span class="admin">Admin</span> <span class="login">Panel</span> &copy; copyright 2009 <a href="#">Trenza Softwares.</a></div>
        </div>
        
        
        
        
        <span class="clear"></span>
    </div>
</body>
</html>