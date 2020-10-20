<?php 
 include('header.php');
 //include('nav-admin.php');
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
      <th>id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
        <tr> 
          <td><?php echo $cinema->getId() ?></td>
          <td><?php echo $cinema->getName() ?></td>
          <td><?php echo $cinema->getAdress() ?></td>
          <td><?php echo $cinema->getPrice_ticket() ?></td>
      </tr>
    </tbody>
  </table>
</div>
<div>
    
    <a href="<?php echo  FRONT_ROOT."Cinema/ShowAddView"?>">ADD CINEMAS</a>
</div>
 

