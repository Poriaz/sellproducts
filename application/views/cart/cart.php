<div class="type cart-page">
    <div class="container">
      <div class="row">
        <div class="col-md-12">

	<form action="<?php echo base_url();?>cart/view" method="post">
	<table class="cart_table">
	<tr><td>Thumbnail</td><td>Title</td><td>Price</td><td>Quantity</td><td>Total</td><td>Actions</td></tr>
	
	<?php 
	$cart_total_price = 0;
	$count = count($_SESSION['cart']['id']);
	for($i = 0; $i < $count ;$i ++ ){?>
	<tr>
		<td><img src="http://collab-o-nation.com/developers/foodequipments/assets/uploads/add_portfolio/<?php echo $_SESSION['cart']['id'][$i];?>/<?php echo $_SESSION['cart']['image'][$i];?>" height="80px" width="80px"/></td>
		<td><?php echo $_SESSION['cart']['title'][$i];?></td>
		<td><?php echo "$".$_SESSION['cart']['price'][$i];?></td>
		<td><input type="text" name="quantity[<?php echo $i;?>]" value="<?php echo $_SESSION['cart']['quantity'][$i];?>"/></td>
		<td>
		<?php  $total = $_SESSION['cart']['price'][$i]*$_SESSION['cart']['quantity'][$i];
			echo "$".$total;
		$cart_total_price = $cart_total_price + $total;
		?>
		</td>
		<td><a href="<?php echo base_url();?>cart/remove/<?php echo $i;?>" class="btn" >Remove</a></td>
		
	</tr>
	<?php } ?>
	</table>
	<input type="submit" class="btn" name="update_cart" value="Update Cart"/>
	</form>
    <div class="cart-total">
	<h5>Cart Totals</h5>
	<table>
	<tr><th>Total Price </th> <?php echo "$".$cart_total_price;?></tr>
	</table>
	<a href="<?php echo base_url();?>cart/review" class="btn">Review Cart</a>
	<a href="<?php echo base_url();?>order/payment" class="btn">Proceed to Payment</a>
	</div>
    </div>
      </div>
    </div>
</div>
