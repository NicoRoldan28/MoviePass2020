<?php 
 include('header.php');
<<<<<<< HEAD
 include('nav-admin.php');
=======
 require_once('nav-admin.php');
>>>>>>> subMaster
 require_once("validate-session.php");
?>
<div><br>
    <h1 style='color:white;'>LIST OF CINEMAS</h1>
</div>
<br>
<div class="TableStyles">
<table>
    <thead>
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Value</th>
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
        </tr>
      <?php 
      }
      ?>
      </tbody>
</table>
</div>


