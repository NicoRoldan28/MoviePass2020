<div class="login-box">
<h1>Select Cinema</h1>  
<form action="<?php echo FRONT_ROOT?>Cinena/AddShowing" method="post">  
    <label>cinema <br><select name="cinema" required ></label>
        <br>
        <?php
        foreach($cineList as $cine)
        {?>
            <tr>
                <td>
                    <option value="<?php echo $cine->getId() ?>"><?php echo $cine->getName() ?> </option>
                </td>
            </tr>
            <label>room <br><select name="room" required ></label>
            <?php
        foreach($roomList as $room)
        {?>
            <tr>
                <td>
                    <option value="<?php echo $cine->getId() ?>"><?php echo $room->getNombre() ?> </option>
                </td>
            </tr>
        <?php
        }
        } ?>
    </select>
    </select>
    <br>
    <br>
    <br>
    <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
    <br>
</form>
</div>