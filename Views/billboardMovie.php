<?php
require_once('head.php'); 
require_once(VIEWS_PATH.'nav-user2.php');?>
<body class="bod">
<form action="<?php echo FRONT_ROOT?>Cinema/seachShowingsForMovie" method="post">
  <ul class="pricing_table2">
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
              <button class= "action_button" type="submit" name="btnLogin" value=<?php echo $movie->getId();?>>NEXT</button>
          </div>
      </li>
      <?php } ?>
  </ul>
  <script src="prefixfree.min.js" type="text/javascript"></script>
</form>
          </body>
