<?php  $err = state("err"); ?>
<div class="mainpTable">
      <div class="mainpTableCell">
        <div class="container text-center">

          <div class="loginPg">
            <div class="logocenter"><img src="<?php echo MEDIA_IMAGES; ?>logo.png" alt="logo"/></div>
            <div class="loginMain">
              <form method="post" action="">
                <div class="loginMain_row">
                  <div class="row">
                    <div class="col-md-3">
                      <label class="formlabelnm">Username</label>
                    </div>
                    <div class="col-md-9">
                      <input type="text" name="user_name" class="form-control" autocomplete="off"  required />
                    </div>
                  </div>
                </div>

                <div class="loginMain_row">
                  <div class="row">
                    <div class="col-md-3">
                      <label class="formlabelnm">Password</label>
                    </div>
                    <div class="col-md-9">
                      <input type="password" name="password" class="form-control" autocomplete="off" required />
                    </div>
                  </div>
                </div>

                <div class="loginMain_row">
                  <div class="row">
                    <div class="col-md-3">
                      <label class="formlabelnm">&nbsp;</label>
                    </div>
                    <div class="col-md-9 text-left">
                      <button class="btn btn-primary" type="submit" name="formSubmitted" value="1">Login</button>
                    </div>
                  </div>
                </div>
                <span class="err"><?php echo $err; ?></span>
              </form>
            </div>
          </div>
        </div>
      </div>
</div>