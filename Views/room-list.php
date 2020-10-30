<?php require_once('nav-cine.php');?>
<br>
<br>
<br>
<div class="TableStyles">
  <table style="text-align:center;">
    <thead>
      <tr>
        <th style="width: 30%;">Name</th>
        <th style="width: 30%;">Capacity</th>
        <th style="width: 15%;">Cine</th>
      </tr>
    </thead>
    <tbody>
        <?php
        foreach($roomList as $room)
        {
          ?>
            <tr> 
              <td style ="color:#DCDCDC" ><?php echo $room->getNombre() ?></td> 
              <td style ="color:#DCDCDC" ><?php echo $room->getCapacidad() ?></td>
              <?php $name = $this->cineDAO->returnName($room->getIdCine());?>
              <td style ="color:#DCDCDC" ><?php echo $name ?></td>
          </tr>
        <?php 
        }
      ?>
    
    </tbody>
  </table>
</div>
