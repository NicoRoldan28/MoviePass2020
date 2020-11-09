
 <div class="registerUser-box">  
 <h1 style="font-size: 50px;" ><span style="color:#b80f22;">Movie</span><span>Pass</span></h1>
 <br>
        <H1>Sign In</H1>
        <form action="<?php echo FRONT_ROOT?>User/logverify" method="post">

            <label><input type="email" name="email" placeholder="Email" requerid></label>
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

  
