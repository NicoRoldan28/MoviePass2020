<?php require_once('nav-user.php');?>
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Showing/SearchDate" method="post">
                <h1>Select Day for Showing</h1>
                <br>
                <br>
                <br>
                <label>Date<input type="date" name="StartDay" requerid></label>
                <br>
                <br>
                <label>Date<input type="date" name="EndDay" requerid></label>
                <br>
                <br>
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>