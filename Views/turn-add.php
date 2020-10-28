<?php require_once('nav-admin.php');?>
<div class="login-box">
    <h1 class="text-login">TURNS REGISTER</h1>  
    <form action="<?php echo FRONT_ROOT."Turn/RegisterTurn" ?>" method="post">
        <label>Hs Start <br><input class="input-login" type="time" name="hrStart" required ></label>
        <br>
        <label>Hs End <br><input class="input-login" type="time" name="hrFinish" required></label>
        <br>
        <input class="btn-login btn" type="submit" name="btnLogin" value='Register'></button>
    </form>
</div>
