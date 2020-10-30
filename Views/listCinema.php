<?php 
 include('header.php');
 require_once("validate-session.php");
 require_once('nav-admin.php');
 
?>
<div><br>
    <h1 style='color:white;'>LIST OF CINEMAS</h1>
</div>
<br>
<form action="<?php echo FRONT_ROOT?>Cinema/ShowAddRoomView" method="post">
<div class="TableStyles">
<table>
    <thead>
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Value</th>
        <th></th>
      </tr>
    </thead>
      <tbody>
      <?php
      foreach($cineList as $cinema)
      {
       ?>
        <tr>
        <td><?php echo $cinema->getId() ?></td>
          <td><?php echo $cinema->getName() ?></td>
          <td><?php echo $cinema->getAdress() ?></td>
          <td><?php echo $cinema->getPrice_ticket() ?></td>
          <td><button type="submit" name="idCinema" value=<?php echo $cinema->getId();?>>AGREGAR SALA </button></td>
        </tr>
      <?php 
      }
      ?>
      </tbody>
</table>
</div>
</form>


