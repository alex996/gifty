<?php $this->block('title', 'Cart') ?>

<?php $this->block('styles') ?>
<style>
	.empty-cart h3 {margin-bottom: 20px;}
	.empty-cart { margin-bottom: 30px; }
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Shopping Cart</h2>
		</div>

		<div class="col-md-12">
			<?php if(!empty($cart) && !empty($cart->cart_details)): ?>
				<table class="table table-hover cart">
				    <thead>
						<tr>
							<th class="text-center">#</th>
							<th>Product</th>
							<th>Description</th>
							<th>Quantity</th>
							<th class="text-center">Unit Price</th>
							<th class="text-center">Total</th>
							<th></th>
						</tr>
					</thead>
				    <tbody>
				     	<?php foreach($cart->cart_details as $index => $detail): ?>
							<tr>
								<td class="text-center"><?= $index + 1 ?></td>
								<td>
									<img class="product-image" src="http://placehold.it/50x50" alt="">
									<a href="/products/<?= $detail->product->id ?>"><?= $detail->product->name ?></a>
								</td>
								<td class="product-desc"><?= $detail->product->description ?></td>
								<td>
									<form method="POST" action="/cart/cart-details/<?= $detail->id ?>" class="form-edit-qty">
										<input type="hidden" name="_method" value="PATCH">
										<input class="form-control product-qty" type="number" name="quantity" value="<?= $detail->quantity ?>" min="1" max="99">
									</form>
								</td>
								<td class="text-center">$<?= $detail->product->price ?></td>
								<td class="text-center">$<?= $detail->quantity * $detail->product->price ?></td>
								<td class="text-center">
									<form method="POST" action="/cart/cart-details/<?= $detail->id ?>" class="form-del-cart">
										<input type="hidden" name="_method" value="DELETE">
										<button type="button" class="btn btn-danger btn-del-cart"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
									</form>
								</td>
							</tr>
						<?php endforeach; ?>
				    </tbody>
				</table>
				<hr>
				<div class="row col-md-4 col-md-offset-4">
					<a href="/checkout/shipping" class="btn btn-success btn-block btn-lg">Checkout</a>
				</div>
			<?php else: ?>
				<div class="empty-cart">
					<h3>Your Cart is currently empty.</h3>
					<h4>Browse our <a href="/products">products</a> and select items you wish to add by clicking on the "Add" button.</h4><br>
				</div>
				<div class="row col-md-4 col-md-offset-4">
					<a href="/products" class="btn btn-success btn-block btn-lg"><i class="fa fa-shopping-bag fa-fw" aria-hidden="true"></i> Continue Shopping</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
$(function() {

	$('.product-qty').keypress(function(e){
		if (e.keyCode === 10 || e.keyCode === 13) e.preventDefault();
	});

	// Update quantity of a product
    $('.product-qty').change(function() {

    	var input = $(this);
    	var quantity = input.val();

    	if (quantity < 1)
    		input.val(1);
    	else if (quantity > 99)
    		input.val(99);
    	else {
    		var form = input.closest('.form-edit-qty');
    		var action = form.attr('action');

    		$.post(action, form.serialize())
	            .done(function(res) {
	                res = JSON.parse(res);
	                if (res.status == 1) {
	                    var in_cart = $('#in-cart').text();
	                    $('#in-cart').text(parseInt(in_cart) + 1);
	                }
	                else
	                    alert(res.errors.shift());
	            }).fail(function() {
	                console.log("AJAX request to " + action + "failed.");
	            });
    	}
    });

    // Remove a product from the cart
    $('.btn-del-cart').click(function() {

    	var form = $(this).closest('.form-del-cart');
    	var row = form.closest('tr');
    	var action = form.attr('action');
    	var quantity = row.find('.product-qty').val();

    	$.post(action, form.serialize())
    		.done(function(res) {
                res = JSON.parse(res);
                if (res.status == 1) {
                    var in_cart = $('#in-cart').text();
                    $('#in-cart').text(parseInt(in_cart) - parseInt(quantity));
                    row.remove();
                }
                else
                    alert(res.errors.shift());
            }).fail(function() {
                console.log("AJAX request to " + action + "failed.");
            });
    });
});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>