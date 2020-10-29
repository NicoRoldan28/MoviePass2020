<?php require_once('nav-cine.php');?>
<div class="login-box">  
            <form action="<?php echo FRONT_ROOT?>Showing/RegisterFuncion" method="post">
                <h1>Add Showing</h1>
                <label>ROOM <br><select name="idRoom" required ></label>
                <?php
                foreach($rooms as $room)
                {?>
                    <tr> 
                    <td>
                        <option value="<?php echo $room->getId() ?>"><?php echo $turn->getHrStart()?> - <?php echo $turn->getHrFinish()  ?> </option>
                    </td>
                </tr>
                <?php 
                } ?>
                </select>
                <br>
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
                <input class="btn-login btn" type="submit" name="btnLogin"value='Save'></button>
                <br>
            </form>
</div>