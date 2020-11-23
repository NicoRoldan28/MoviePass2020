<nav style='position: fixed'><?php require_once('head.php');
/*require_once(VIEWS_PATH.'nav-user2.php');*/?></nav> 
<br><br><br><br><br>

<?php
foreach ($buyList as $buy) { ?>
      <div id="register">
              <form action=<?php echo FRONT_ROOT."Buy/showTicketListView"?> method="post">
        
        <div id="ticket">
                                <div id="entries">
                                        <tr>
                                                <th>Date: </th>        
                                                <th> <?php echo $buy->getDate(); ?></th>
                                        </tr>    
                                </div>

                                <br>
                        <h1>TICKET</h1>
                        <H3 style="text-align:center;">MoviePass</H3>
                        <br><br>
                        <table>
                                <tbody id="entries">        
                                </tbody>
                        <tr>
                                <th>Quantity ticket</th>
                                <th id="total"><?php echo $buy->getQuantityTicket(); ?></th>
                        </tr>
                
                        <tr>
                                <th>Discount</th>
                                <th id="total"><?php echo $buy->getDiscount().'%'; ?></th>
                        </tr>
                        <tfoot>
                                <tr>
                                        <th>Total</th>
                                        <th id="total"><?php echo $buy->getTotal(); ?></th>
                                </tr>
                        
                        </tfoot>
                        </table>
                        <td>
                          </td>
                </div>
        
              
              <button class= "btn btn-default" type="submit" name="idShowing" value=<?php echo $buy->getIdBuy();?>>Confirm</button>

        </form>
                
        </div>     
<?php
} ?>