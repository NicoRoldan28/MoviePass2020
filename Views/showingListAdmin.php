<nav style='position: fixed'>
<?php
require_once('head.php'); 
require_once(VIEWS_PATH.'nav-admin.php');
?>
</nav> 
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
                        </tr>
                    <?php 
                    }
                    ?>
            </tbody>
            </table>
    </div>  