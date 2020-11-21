<nav style='position: fixed'><?php require_once(VIEWS_PATH.'head.php');?></nav> 
<br><br><br><br><br>
<form name='mensaje' action="<?php echo FRONT_ROOT?>Buy/registerCard" method="POST" >
        <div id="register">
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
                                <th id="total"><?php echo $buy->getQuantityTickets(); ?></th>
                        </tr>
                        <tr>
                                <th>Price</th>
                                <th id="total">300</th>
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
                                <button type="submit" name="btnPay" class="btn btn-danger" value="<?php echo $buy->getTotal().'-'.$buy->getIdBuy(); ?>"> PAGAR CON TARJETA DE CREDITO </button>
                        </td>
                </div>
        </div>   
</form>
