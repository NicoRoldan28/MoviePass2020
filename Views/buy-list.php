<nav style='position: fixed'><?php require_once(VIEWS_PATH.'head.php');?></nav> 
        <form action="<?php echo FRONT_ROOT?>Buy/ShowListTicket" method="POST" >
        <div class="TableStylesRooms">
        <table>
        <thead>
        <tr>
                <th>Date</th>
                <th>Quantity ticket</th>
                <th>Discount</th>
                <th>Instance</th>
                <th>Total</th>
                <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
      foreach($buyList as $buy)
      {
       ?>
                <tr>
                <td><?php echo $buy->getDate() ?></td>
                <td><?php echo $buy->getQuantityTicket() ?></td>
                <td><?php echo $buy->getDiscount().'%' ?></td>
                <td><?php if($buy->getPago()->getIdPay()!=0){
                   echo "Pago" ;    
                }
                else{
                   echo "Impago" ;   
                }
                 ?></td>
                <td><?php echo $buy->getTotal() ?></td>
                <td><button type="submit" name="idBuy" value=<?php echo $buy->getIdBuy();?>>Show Tickets </button></td>
                </tr>
                <?php 
      }
      ?>
        </tbody>
        </table>
        </div>
    </form>