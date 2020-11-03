<nav style='position: fixed'><?php require_once(VIEWS_PATH.'nav-user.php');?></nav> 
  <div class="div-login"><br><br>
    <h3 class="text-login" style='color:white;'>SHOWINGS</h3>
</div>
<form action="<?php echo FRONT_ROOT?>Cinema/seachShowingsForMovieForGender" method="post">
<div class="TableStyles">
            <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Select</th>

                </tr>
            </thead>
            <tbody>
                    <?php
                
                    foreach($genderList as $gender)
                    {   
                        ?>
                        <tr> 
                            <td><?php echo $gender->getName() ?></td>
                            <td><div class="footer">
              <button class= "action_button" type="submit" name="btnLogin" value=<?php echo $gender->getId();?>>NEXT</button>
          </div> </td>
                            
                        </tr>
                        <br>
                        
                    <?php 
                    }
                    ?>
            </tbody>
            </table>
    </div>  
    </form>  