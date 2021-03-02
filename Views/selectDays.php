<?php
    require_once('head.php');
    //require_once('nav-user2.php');
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    ?>
<body class= "backgroundDeadPool">
    
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Cinema/SearchDate" method="post">
                <h1>Select Day for Showing</h1>
                <br>
                <br>
                <br>
                <label>Date && Hour <input type="datetime-local" name="dayTimeStart" min="<?php echo date('Y-m-d\TH:i'); ?>" required></label>
                <br>
                <br>
                <label>Date && Hour <input type="datetime-local" name="dayTimeFinish" min="<?php echo date('Y-m-d\TH:i') ; ?>" required></label>
                <br>
                <br>
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>
</body>
