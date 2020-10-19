<nav style='position: fixed'><?php require_once(VIEWS_PATH.'nav-cine.php');?></nav> 
<br>
<form action="<?php echo FRONT_ROOT?>User/SearchShowing" method="post">
  <ul class="pricing_table">
      <?php
          foreach($movieList as $movie)
          {  ?>
      <li class="price_block">
          <h3><?php echo $movie->getTitle(); ?></h3>
          <div class="price">
              <div class="price_figure">
                  <img src="<?= IMAGE.$movie->getImage(); ?>" alt=""height='250' width='198'>
              </div>
          </div>
          <ul class="features">
              <li>Lenght : <?php echo $movie->getLenght(); ?>minutes.</li>
              <li>Lenguage : <?php echo $movie->getLenguage() ?></li>
          </ul>
          <div class="footer">
              <a class="action_button">NEXT<button type="submit" name="btnLogin" value=<?php echo $movie->getId();?>></button></a>
          </div>
      </li>
      <?php } ?>
  </ul>
  <script src="prefixfree.min.js" type="text/javascript"></script>
</form>





