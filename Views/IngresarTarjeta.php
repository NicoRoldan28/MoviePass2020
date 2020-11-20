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
        <form action=<?php echo FRONT_ROOT."User/ValidateCard"?> method="post">
            <div class="form-group owner">
                <label for="owner">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            
            <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" name="cvv">
            </div>
            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" name="cardNumber">
            </div>
            <div class="form-group" id="expiration-date">
                <label>Expiration Date</label> <select name="mes" required >
                    <option value="01">01</option>
                    <option value="02">02 </option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                </div>
                <div class="form-group" id="expiration-date">
                <label>Expiration Date</label> <select name="año" required >
                    <option value="20"> 2020</option>
                    <option value="21"> 2021</option>
                    <option value="22"> 2022</option>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                    <option value="25"> 2025</option>
                    <option value="26"> 2026</option>
                </select>
            </div>

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
