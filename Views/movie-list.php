
 <div style='z-index: -1;'>
<?php require_once(VIEWS_PATH.'head.php');
require_once(VIEWS_PATH.'nav-admin.php');?>
 </div>
<br>
<div>
    <body class="bodyCinemaList">
        <ul class="pricing_table">
      <?php
          foreach($movieList as $movie)
          {  ?>
      <li class="price_block">
          <h3><?php echo $movie->getTitle(); ?></h3>
          <h3>id:<?php echo $movie->getId(); ?></h3>
          <div class="price">
              <div class="price_figure">
                  <img src="<?= IMAGE.$movie->getImage(); ?>" alt=""height='250' width='198'>
              </div>
          </div>
          <ul class="features">
              <li>Lenght : <?php echo $movie->getLenght(); ?> minutes.</li>
              <li>Lenguage : <?php echo $movie->getLenguage() ?></li>
          </ul>
      </li>
      <?php } ?>
  </ul>
  <script src="prefixfree.min.js" type="text/javascript"></script>
    </body>


  
</div>
  