<?php 
require_once('head.php'); 
require_once('nav-admin.php');?>
<body class="bodyRegisterRoom">
    <div class="RegisterRoom-box">
            <form action="<?php echo FRONT_ROOT?>Cinema/RegisterRoom" method="post">
                <h1>Add Room</h1>
                <br>
                <label>NAME<input class="input-login" type="text" name="name" placeholder="Enter Name" required ></label>
                <br>
                <label>CAPACITY<input class="input-login" type="text" name="capacity" placeholder="Enter Capacity" required></label>
                <br>
                <label>CINEMA <br><br>
                <select name="nombreCine" required>
                    <?php
                    foreach($cineList as $cine)
                    {?>
                        <tr>
                            <td>
                                <option value="<?php echo $cine->getId() ?>"><?php echo $cine->getName() ?></option>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </select></label>
                <br>

                <br>
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>
</body>
