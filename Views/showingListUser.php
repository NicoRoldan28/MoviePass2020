<nav style='position: fixed'><?php require_once(VIEWS_PATH.'nav-user.php');?></nav> 
  <div class="div-login"><br><br>
    <h3 class="text-login" style='color:white;'>SHOWINGS</h3>
</div>
<div class="TableStyles">
            <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Dia y Horario inicio</th>
                    <th>Horario fin</th>
                    <th>Cine</th>
                    <th>SALA</th>
                    <th>capacidad</th>
                    <th>Pelicula</th>
                    <th>Duracion</th>
                    <th>Lenguaje</th>
                    <th>Imagen</th>
                    <th><H1>Select</H1></th>


                </tr>
            </thead>
            <tbody>
                    <?php
                
                    foreach($showingList as $showing)
                    {   
                        ?>
                        <tr> 
                            <td><?php echo $showing->getIdShowing() ?></td>
                            <td><?php echo $showing->getDayTime() ?></td>
                            <td><?php echo $showing->getHrFinish() ?></td>
                            <td><?php echo $showing->getRoom()->getCinema()->getName();?></td>
                            <td><?php echo $showing->getRoom()->getNombre();?></td>
                            <td><?php echo $showing->getRoom()->getCapacidad();?></td>

                            <td><?php echo $showing->getMovie()->getTitle();?></td>
                            <td><?php echo $showing->getMovie()->getLenght();?></td>
                            <td><?php echo $showing->getMovie()->getLenguage();?></td>
                            <td><?php echo $showing->getMovie()->getImage();?></td>
                            <td><div class="footer">
              <button class= "action_button" type="submit" name="btnLogin" value=<?php echo $showing->getIdShowing();?>>NEXT</button>
          </div> </td>
                            
                        </tr>
                        <br>
                        
                    <?php 
                    }
                    ?>
            </tbody>
            </table>
    </div>  