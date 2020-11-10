<nav style='position: fixed'><?php require_once(VIEWS_PATH.'head.php');?></nav> 
  
<div class="TableStyles">
            <table style="text-align:center;">
            <thead>
                <tr>
                    <th>Pelicula</th>
                    <th>Cine</th>
                    <th>SALA</th>
                    <th>Dia y Horario inicio</th>
                    <th>Horario fin</th>
                    <th>Duracion</th>
                    <th>capacidad</th>
                    <th>Lenguaje</th> 
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    foreach($showingList as $showing)
                    {   
                        ?>
                        <tr>
                            <td><?php echo $showing->getMovie()->getTitle();?></td>
                            <td><?php echo $showing->getRoom()->getCinema()->getName();?></td>
                            <td><?php echo $showing->getRoom()->getNombre();?></td>
                            <td><?php echo $showing->getDayTime() ?></td>
                            <td><?php echo $showing->getHrFinish() ?></td>
                            <td><?php echo $showing->getMovie()->getLenght();?></td>
                            <td><?php echo $showing->getRoom()->getCapacidad();?></td>
                            <td><?php echo $showing->getMovie()->getLenguage();?></td>

                            <td><div class="footer">
              <button class= "action_button" type="submit" name="btnLogin" value=<?php echo $showing->getIdShowing();?>>NEXT</button>
          </div> </td>
                        </tr>
                    <?php 
                    }
                    ?>
            </tbody>
            </table>
    </div>  