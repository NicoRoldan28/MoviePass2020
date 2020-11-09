<div class="sidebar">
      <a href="<?php echo  FRONT_ROOT."User/user "?>"><i class="fas fa-desktop"></i><span>List All Movie</span></a>
      <div>
            <form action="<?php echo FRONT_ROOT?>Cinema/seachShowingsForMovieForGender" method="post">
                  <div>
                        <?php
                        foreach($genderList as $gender)
                        {   ?>  
                        <div>
                              <label for="genero"><input type="radio" name="genero" value=<?php echo $gender->getId();?>id=""> <?php echo $gender->getName() ?></label>
                        </div> 
                        <br>
                        <?php }
                        ?>
                        <button class= "action_button" type="submit" name="btnLogin" value="<?php echo $gender->getId();?>">NEXT</button>
                  </div>  
            </form>  
      </div>
</div>
