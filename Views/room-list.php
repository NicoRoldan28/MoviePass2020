<?php 
require_once('head.php');
require_once('nav-admin.php');?>
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
              <td style ="color:#DCDCDC" ><?php echo $room->getCinema()->getName() ?></td>
          </tr>
        <?php 
        }
      ?>
    
    </tbody>
  </table>
</div>
