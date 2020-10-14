<?php 
 include('header.php');
 include('nav-cine.php');
 require_once("validate-session.php");
?>
<br><br>
<div><br>
    <h1 style='color:white;'>LIST OF CINEMAS</h1>
</div>
<br>
<div class="TableStyles">
  <table>
    <thead>
      <tr>
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
<div>
    
    <a href="<?php echo  FRONT_ROOT."Cinema/ShowAddView"?>">ADD CINEMAS</a>
</div>
 

