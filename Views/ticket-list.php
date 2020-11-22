<nav style='position: fixed'><?php require_once(VIEWS_PATH.'head.php');?></nav> 
<br>
<?php foreach ($ticketList as $ticket) {
  ?>
    <div class="cardWrap">
    <div class="card cardLeft">
      
      <div class="title">
        <br><h2><?php echo $ticket->getShowing()->getMovie()->getTitle()?></h2>
        <span>movie</span>
      </div>
      <div class="name">
        <br><h2><?php echo $ticket->getShowing()->getRoom()->getCinema()->getName() ?></h2>
        <span>cinema</span>
      </div>
      <div class="seat" style='text-align:center;'>
        <h2><?php echo $ticket->getShowing()->getRoom()->getNombre()?></h2>
        <span><p>room             </span>
      </div>
      <div class="seat">
        <h2><?php echo $ticket->getShowing()->getDayTime()?></h2>
        <span>day</span>
      </div>
      </div>
    </div>
  </div>
    <div class="card cardRight">
      <div class="eye"></div>
        <div class="number">
          <h3><?php echo $ticket->getIdTicket()?></h3>
          <span>code</span>
        </div>
        <div class="barcode"></div>
        </div>
    </div>
<?php
}?>
