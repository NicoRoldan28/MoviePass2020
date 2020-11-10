<header>
      <div class="left_area">
        
        <?php if ($_SESSION["loggedUser"]->getRol()==2) {
          $direccion = FRONT_ROOT."User/admin";
        }else{
          $direccion = FRONT_ROOT."User/user";
        }?>
        <a href="<?php echo $direccion?>"><h3><span style="color: #b80f22;">Movie</span><span>Pass</span></a></h3>
      </div>
      <div class="right_area">
        <span><?php echo $_SESSION["loggedUser"]->getEmail() ?></span>
        <a href="<?php echo  FRONT_ROOT."Home/Logout "?>" class="logout_btn">Logout</a>
      </div>
</header>