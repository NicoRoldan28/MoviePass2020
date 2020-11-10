<?php require_once("validate-session.php");
require_once("head.php");?>

<nav style='position: fixed'><?php include('nav-admin.php');?></nav> 
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

