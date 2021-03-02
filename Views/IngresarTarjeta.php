<?php 
require_once('head.php');
 //require_once('nav-admin.php');
 ///<label>CAPACITY<input class="input-login" type="number" name="capacity" placeholder="Enter Capacity" min=0 equired></label>
 require_once("validate-session.php");
?>



<div class="creditCardForm">
    <div class="heading">
        <h1>Confirm Purchase</h1>
    </div>
    <div class="payment">
        <form action=<?php echo FRONT_ROOT."Buy/ValidateCard"?> method="post">
            <div class="form-group owner">
                <label for="owner">Name</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            
            <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="number"  min=1 max=999 class="form-control" name="cvv" required>
            </div>
            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="number" min=0 class="form-control" name="cardNumber" autocomplete="off"  required>
            </div>
            <div class="form-group" id="expiration-date">
                <label for="bdaymonth">Expiration Date (month and year):</label>
                <input type="month" id="bdaymonth" name="bdaymonth"  required>
            

            <label class="form-group CVV">                   
                    <input type="radio" name="type" value="Visa" required>
                    <img src="<?php echo FRONT_ROOT?>Views/img/visa.jpg"></input>
                    </label>
                    <label class="form-group CVV">
                    <input type="radio" name="type" value="Master">
                    <img src="<?php echo FRONT_ROOT?>Views/img/mastercard.jpg"></input>
                    </label>

            <div class="form-group" id="pay-now">
                <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
            </div>
        </form>
    </div>
</div>




