<div class="login-box">  
<form action="<?php echo FRONT_ROOT?>Cinema/AddRoom" method="post">
    <h1>Add Room</h1>
    <br>
    <label>NAME<input class="input-login" type="text" name="name" placeholder="Enter Name" required ></label>
    <br>
    <label>CAPACITY<input class="input-login" type="number" name="capacity" placeholder="Enter Capacity" required></label>
    <br>
    <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
    <br>
</form>
