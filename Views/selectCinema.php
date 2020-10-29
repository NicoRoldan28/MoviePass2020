<?php require_once('nav-admin.php');?>
<div class="login-box">
<h1>Select Cinema</h1>  
<form action="<?php echo FRONT_ROOT?>Cinema/ShowFilmTabView" method="post">  
        <label>cinema <br><select name="cinema" required ></label>
        <br>
        <?php
        foreach($cinemaList as $cine)
        {?>
            <tr>
                <td>
                    <option value="<?php echo $cine->getId() ?>"><?php echo $cine->getName() ?> </option>
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
