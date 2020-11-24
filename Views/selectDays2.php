<?php
    require_once('head.php');
    require_once('nav-admin.php');
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    ?>
<body class= "backgroundDeadPool">
    
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Cinema/SearchDateForSold" method="post">
                <h1>Select Day for See Total Sold</h1>
                <br>
                <br>
                <label>Date && Hs Start <input type="datetime-local" name="dayTimeStart" min="<?php echo date('Y-m-d\TH:i'); ?>" required></label>
                <br>
                <br>
                <label>Date && Hs Finish <input type="datetime-local" name="dayTimeFinish" min="<?php echo date('Y-m-d\TH:i') ; ?>" required></label>
                <br>
                <label>Cinemas<input type="radio" name="type" value="Cinema" required></label>
                <label>Movies<input type="radio" name="type" value="Movie"></label>

                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>
</body>
