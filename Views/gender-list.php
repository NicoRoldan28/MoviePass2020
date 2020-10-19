<?php require_once("validate-session.php");?>

<nav style='position: fixed'><?php include('nav-cine.php');?></nav> 
  <div class="div-login"><br>
    <h1 class="text-login">LISTA DE GENEROS</h1>
  </div>  
<div class='TableStyles'>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Gender Name</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php
        foreach($genderList as $gender)
        {?>
            <tr> 
              <td><strong><?php echo $gender->getid() ?></strong></td>
              <td><strong><?php echo $gender->getName() ?></strong></td>
          </tr>
        <?php 
        }?>
      </tr>
    </tbody>
  </table>
</div>

