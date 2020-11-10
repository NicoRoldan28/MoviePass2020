<div>
<?php 
require_once('head.php');
require_once('nav-admin.php');?>
</div>
<body class='Roomlist'>
  
<div class="TableStylesRooms">
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Capacity</th>
        <th>Cine</th>
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
</body>

