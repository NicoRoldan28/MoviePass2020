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
  <form action="<?php echo FRONT_ROOT?>Cinema/ShowFilmTabView" method="post">
      <tbody>
      <?php
      foreach($cineList as $cinema)
      {
       ?>
        <tr>
          <input type= "checkbox" name="cine" value="<?php echo $cinema->getName()?>"><?php echo $cinema->getName()?>
        </tr>
      <?php 
      }
      ?>
      </tbody>
    <button type="submit">Send</button>
  </form>
</div>

