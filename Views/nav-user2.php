<div class="sidebar">
      <a href="<?php echo  FRONT_ROOT."User/user "?>"><i class="fas fa-desktop"></i><span>List All Movie</span></a>
      <a href="<?php echo  FRONT_ROOT."Cinema/SelectDays"?>"><i class="fas fa-desktop"></i><span>Select Days</span></a>
      <a href="<?php echo  FRONT_ROOT."Buy/showBuyListView"?>"><i class="fas fa-desktop"></i><span>List all Buys</span></a>
      <br>
      <div>
            <form action="<?php echo FRONT_ROOT?>Cinema/seachShowingsForMovieForGender" method="post">
                  <div style="background-color: #393d47;">
                  <br>
                        <span>Select Gender</span>
                        <br><br>
                        <?php
                        if ($genderList!=null) {
                        
                        foreach($genderList as $gender)
                        {   ?>  
                              <label for="genero"><input type="radio" name="genero" value=<?php echo $gender->getId();?>id=""> <?php echo $gender->getName() ?></label>
                  
                        <br>
                        <?php }
                        
                        ?>
                        <br>
                        <button class= "action_button" type="submit" name="btnLogin" value="<?php echo $gender->getId();?>">NEXT</button>
                        <?php
                        }
                        ?>
                        <br><br>
                        
                  </div> 
                   
            </form>  
      </div>
</div>