<?php 
 include('nav-admin.php');
 require_once("validate-session.php");
?>
<div class="login-box">  
    <h1 class="text-login">CINEMA REGISTER</h1> <br>
    <form action=<?php echo FRONT_ROOT."Cinema/RegisterCine"?> method="post">
        
        <label>NAME<input class="input-login" type="text" name="name" placeholder="Enter Name" required ></label>
        <br>
        <label>ADDRESS<input class="input-login" type="text" name="address" placeholder="Enter Address" required ></label>
        <br>
        <label>PRICE TICKET<input class="input-login" type="text" name="price_ticket" placeholder="Enter Price Ticket" required ></label>
        <br>
        <input type="submit" name="btnLogin" value= 'REGISTER'></button>
    </form>
</div>


