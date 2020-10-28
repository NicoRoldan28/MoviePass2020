<?php require_once('nav-cine.php');?>
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Showing/RegisterFuncion" method="post">
                <h1>Add Showing</h1>
                <br>
                <br>
                <label>Date<input type="date" name="dayTime" requerid></label>
                <br>
                <label>Movie Name <select name="nombreMovie" required ></label>
                <br>
                <?php
                foreach($movieList as $movie)
                {?>
                    <tr>
                        <td>
                            <option value="<?php echo $movie->getTitle() ?>"><?php echo $movie->getTitle() ?> </option>
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
                            <option value="<?php echo $room->getNombre() ?>"><?php echo $room->getNombre() ?> </option>
                        </td>
                    </tr>
                <?php
                } ?>
                </select>
                <br>
                <br>
                <br>
                <label>Cine Id<input type="number" name="idCine" value="<?php echo $id ?>" readonly></label>
                <br>
                <br>
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>