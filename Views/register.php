
 <div class="login-box">  
        <H1>Sign In</H1>
        <form action="<?php echo FRONT_ROOT?>User/logverify" method="post">

            <label><input type="text" name="email" placeholder="Email" requerid></label>
            <br>
            <label><input type="password" name="password" placeholder="Password" required></label>
            <br>
            <label><input type="text" name="userName" placeholder="UserName" requerid></label>
            <br>
            <label><input type="text" name="firstName" placeholder="FirstName" requerid></label>
            <br>
            <label><input type="text" name="lastName" placeholder="LastName" requerid></label>
            <br>
            <label><input type="number" name="dni" placeholder="DNI" min=0 requerid></label>
            <br>
            <input class="btn-login btn" type="submit" name="btnLogin" value='Register'></button>

    </form>
</div>

  
