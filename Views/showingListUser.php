<nav style='position: fixed'><?php require_once(VIEWS_PATH.'head.php');?></nav> 



<div class="TableStyles">
            <table style="text-align:center;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Pelicula</th>
                    <th>Cine</th>
                    <th>SALA</th>
                    <th>Horario inicio</th>
                    <th>Horario fin</th>
                    <th>Duracion</th>
                    <th>Cantidad de tickets</th>
                    <th>Siguiente</th>


                </tr>
            </thead>
            <tbody>
                    <?php
                
                    foreach($showingList as $showing)
                    {   
                        ?>
                        <tr> 
                        <form action="<?php echo FRONT_ROOT?>Buy/buyTicket" method="post">
                            <td><?php echo $showing->getIdShowing();?></td>
                        
                            <td><?php echo $showing->getMovie()->getTitle();?></td>
                            <td><?php echo $showing->getRoom()->getCinema()->getName();?></td>
                            <td><?php echo $showing->getRoom()->getNombre();?></td>
                            <td><?php echo $showing->getDayTime() ?></td>
                            <td><?php echo $showing->getHrFinish() ?></td>
                            <td><?php echo $showing->getMovie()->getLenght();?> minutos</td>
                            
                            <td><label><input type="number" name="quantity" required min="1" max="<?php echo $showing->getRoom()->getCapacidad();?>" ></label>
                                </td>
                            <td><div class="footer">
              <button class= "action_button" type="submit" name="btnLogin" value=<?php echo $showing->getIdShowing();?>>NEXT</button>
          </div> </td>
                      </form>     
                        </tr>
            
                    <?php 
                    }
                    ?>
            </tbody>
            </table>
    </div>  
 