<?php 
require_once('head.php');
//require_once('nav-user2.php');?>
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Cinema/SearchDate" method="post">
                <h1>Select Day for Showing</h1>
                <br>
                <br>
                <br>
                <label>Date && Hs Start <input type="datetime-local" name="dayTimeStart" requerid></label>
                <br>
                <br>
                <label>Date && Hs Finish <input type="datetime-local" name="dayTimeFinish" requerid></label>
                <br>
                <br>
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>