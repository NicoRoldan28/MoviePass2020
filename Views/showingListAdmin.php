<div>
    <?php
    require_once("head.php");
    require_once("nav-admin.php");
    ?>
    
</div>
    <div class="TableStyles">
            <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Pelicula</th>
                    <th>Cine</th>
                    <th>SALA</th>
                    <th>Dia y Horario inicio</th>
                    <th>Horario fin</th>
                    <th>Duracion</th>
                    <th>capacidad</th>
                    <th>disponibilidad</th>
                    <th>Lenguaje</th>                   
                </tr>
            </thead>
            <tbody>
                    <?php
                
                    foreach($showingList as $showing)
                    {   
                        ?>
                        <tr> 
                            <td><?php echo $showing->getIdShowing() ?></td>
                            <td><?php echo $showing->getMovie()->getTitle();?></td>
                            <td><?php echo $showing->getRoom()->getCinema()->getName();?></td>
                            <td><?php echo $showing->getRoom()->getNombre();?></td>
                            <td><?php echo $showing->getDayTime() ?></td>
                            <td><?php echo $showing->getHrFinish() ?></td>
                            <td><?php echo $showing->getMovie()->getLenght();?></td>
                            <td><?php echo $showing->getRoom()->getCapacidad();?></td>
                            <td><?php echo $showing->getAvailability();?></td>
                            <td><?php echo $showing->getMovie()->getLenguage();?></td>
                        </tr>
                    <?php 
                    }
                    ?>
            </tbody>
            </table>
    </div>  

