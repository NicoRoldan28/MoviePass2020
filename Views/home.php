<body>
       <div class="login-box">
          <form action=<?php echo FRONT_ROOT."User/Login"?> method="post">

          <?php require_once(VIEWS_PATH."header.php");?>
          <h1>Login Here</h1>

          <!-- USERNAME INPUT -->
          <label>Email<input class="input-login" type="text" name="email" placeholder="Enter Email" required></label>
        
          <!-- PASSWORD INPUT -->
          <label>Password<input class="input-login" type="password" name="password" placeholder="Enter Password" required ></label>

          <input type="submit" value="Log In">

          </form>
            <div class="register-box"> 
              <span>New to MoviePass? <a href=<?php echo FRONT_ROOT."User/Register"?>>  SIGN UP</a></span>
            </div>
          </div>
</body>