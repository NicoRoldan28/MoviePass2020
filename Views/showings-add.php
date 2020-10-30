<?php require_once('nav-admin.php');?>
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Cinema/AddShowing" method="post">
                <h1>Add Showing</h1>
                <br>
                <br>
                <label>Date && Hs Start <input type="datetime-local" name="dayTime" requerid></label>
                <br>
                <label>Movie Name <select name="nombreMovie" required ></label>
                <br>
                <?php
                foreach($movieList as $movie)
                {?>
                    <tr>
                        <td>
                            <option value="<?php echo $movie->getId() ?>"><?php echo $movie->getTitle() ?> </option>
                        </td>
                    </tr>
                <?php
                }?> 
                </select>
                <br>
                <br>
                <br>
                <label>Room <br><select name="nombreRoom" required ></label>
                <?php
                foreach($roomList as $room)
                {?>
                    <tr>
                        <td>
                            <option value="<?php echo $room->getId() ?>"><?php echo $room->getNombre() ?> </option>
                        </td>
                    </tr>
                <?php
                } ?>
                </select>
                <br>
                <br>
                
                <br>
                <br>
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>