<nav style='position: fixed'><?php require_once('head.php');?></nav> 
<br>
<?php foreach ($ticketList as $ticket) {
  ?>
    <div class="cardWrap">
    <div class="card cardLeft">
      <h1 style='text-align:center;'>Movie<span>Pass</span></h1>
      <div class="title">
        <h2><span>movie </span><?php echo $ticket->getShowing()->getMovie()->getTitle(); ?></h2>
      </div>
      <div class="title">
        <h2><span>cinema </span><?php echo $ticket->getShowing()->getRoom()->getCinema()->getName(); ?></h2>
      </div>
      <div class="title">
        <h2><span>room </span><?php echo $ticket->getShowing()->getRoom()->getNombre(); ?></h2>
      </div>
      <div class="title">
        <h2><span>day </span><?php echo $ticket->getShowing()->getDayTime(); ?></h2>
      </div>
      
    </div>
  </div>
    <div class="card cardRight">
      <div class="eye"></div>
        <div class="number">
          <h3><?php echo $ticket->getIdTicket();?></h3>
          <span>seat</span>
        </div>
        <div class="barcode"></div>
        </div>
    </div>
<?php
}?>
