<div class="checkout space">
  <div class="container">
    <div class="row">
    	<div class="col-md-8">
        <div class="payment">
    	<h4>Choose a payment option</h4>
        <p><input type="radio" name="payment_type" value="paypal" class="check" checked> PayPal<br>
  <input type="radio" name="payment_type" value="Credit Card" class="check" id="credit_card"> Credit Card</p>
         </div>
         
         <div class="payment" id="card_details" style="display:none;">
    	<h4>Credit card details</h4>
        <p><label>First Name</label>
           <input type="text" name="First name"  placeholder="First Name" /></p>
              <p>
              <label>Last Name</label>
              <input type="text"name="Last name" placeholder="Last Name" /></p>
              
               <p>
               <label>Card Type</label>
               <select>
               	<option>Visa</option>
                	<option>Visa1</option>
                    <option>Visa3</option>
                    <option>Visa2</option>
               </select></p>
              <p>
              <label>Card Number</label>
              <input type="text" placeholder="Card Number" name="card"/></p>
                <p>
              <label>Expiry Date</label>
              <select class="select">
              <option>01</option>
                	<option>Visa1</option>
                    <option>Visa3</option>
                    <option>Visa2</option>
               </select>
               <select class="select">
               <option>2015</option>
                	<option>Visa1</option>
                    <option>Visa3</option>
                    <option>Visa2</option>
               </select></p>
               <p>
              <label>CVV</label>
              <input type="text" placeholder="CVV"name="cvv" /></p>
             
                
             
         </div>
         
         
         <div class="payment">
    	<h4>Enter Your Details</h4>
        <p style="float:right;">Have an account ? Sign In</p>
        <p>
        <label>Email</label>
        <input type="text" placeholder="Email" /></p>
           <p id="already_fname"><label>First Name</label>
           <input type="text"  placeholder="First Name" name="First name" /></p>
              <p id="already_lname">
              <label>Last Name</label>
              <input type="text" placeholder="Last Name"name="Last name" /></p>
             <p>
              <label>Password</label>
              <input type="text" placeholder="Password"name="Password" /></p>
               <p>
              <label>Password Again</label>
              <input type="text"  placeholder="Password Again" name="passwordagain"/></p>
         </div>
         <div class="payment">
        
         <a href="#">Pay</a>
        
         </div>
        </div>
        
        <div class=" col-md-4">
        	<div class="payment">
            
            <table class="cart_table_small" style="width:100%">
	<tr><td>Title</td><td>Price</td><td>Quantity</td><td>Total</td></tr>
	
	<?php 
	$cart_total_price = 0;
	$count = count($_SESSION['cart']['id']);
	for($i = 0; $i < $count ;$i ++ ){?>
	<tr>
		
		<td><?php echo $_SESSION['cart']['title'][$i];?></td>
		<td><?php echo "$".$_SESSION['cart']['price'][$i];?></td>
		<td><?php echo $_SESSION['cart']['quantity'][$i];?></td>
		<td>
		<?php  $total = $_SESSION['cart']['price'][$i]*$_SESSION['cart']['quantity'][$i];
			echo "$".$total;
		$cart_total_price = $cart_total_price + $total;
		?>
		</td>
		
		
	</tr>
	<?php } ?>
	</table>
	<div class="cart-total-small" style="float: right;
    padding-top: 20px;">
	
	<table>
	<tr><td>Total Price -</td> <td>&nbsp;</td><td><?php echo "$".$cart_total_price;?></td></tr>
	</table>
        </div>
            
        </div>
  </div>
</div>
</div>
<script>
$("input:radio[name=payment_type]").on("click", function () {
    if ($("#credit_card").is(":checked")) {
        $("#card_details").show(0);
	$("#already_fname").hide(0);
	$("#already_lname").hide(0);
        
    } else {
	$("#card_details").hide(0);
	$("#already_fname").show(0);
	$("#already_lname").show(0);
    }
}); 

</script>
