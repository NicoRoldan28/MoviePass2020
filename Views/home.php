<?php 
          require_once(VIEWS_PATH."header.php");?>
<body class="bodylogin">
       <div class="login-box">
          <form action=<?php echo FRONT_ROOT."User/Login"?> method="post">
          

          <h1 style="font-size: 50px;" ><span style="color:#b80f22;">Movie</span><span>Pass</span></h1>
          <br>
          <h1>Login</h1>
          <!-- USERNAME INPUT -->
          <label>Email<input class="input-login" type="email" name="email" placeholder="Enter Email" required></label>
        
          <!-- PASSWORD INPUT -->
          <label>Password<input class="input-login" type="password" name="password" placeholder="Enter Password" required ></label>

          <input type="submit" value="Log In">

          </form>
          <br>
            <div class="register-box"> 
              <span> <a href=<?php echo FRONT_ROOT."User/Register"?>>New to MoviePass? Sign Up</a></span>
            </div>
          </div>
</body>