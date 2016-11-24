<?php $this->block('title', $product->name) ?>

<?php $this->block('styles') ?>
<style>
	.empty-cart h3 {margin-bottom: 20px;}
	.empty-cart { margin-bottom: 30px; }

	.table tbody>tr>td { vertical-align: middle; }
	.product-image {float:left; margin-right:10px;}
	.product-desc {width: 500px;}
	.product-qty {width: 60px;}
	#addProductButtonDiv {margin: 10px 0px 20px 0px; float: right;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i><?= $product->name ?></h2>
		</div>

		<p><a href="inventories" class="btn btn-success" style="float: left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to inventories</a></p>
		<p style="float:right"><a href="inventories/modifyItem/<?= $product->id ?>" class="btn btn-success"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i> Modify</a></p>

		<p>
			<div style="display: block; height: 60px;">
				<div style="float:right; clear: right;">
					<form method="POST" action="inventories/<?= $product->id ?>">
						<input type="hidden" name="_method" value="DELETE">
						<input type="submit" value="Delete" class="btn btn-danger"/>
					</form>
				</div>
			</div>
		</p>

		<div style="clear:both; margin-top: 10px;">
			<?php 
				include_once VIEWS_PATH."components/success.php";

				include_once VIEWS_PATH."components/error.php";
		  	?>
		</div>

		<table class="table">
		    <thead>
		    	<th>Id</th>
		    	<th>Field name</th>
		    	<th>Description</th>
		    </thead>
		    <tbody>
		    	<tr>
		    		<td><?= $product->id ?></td>
		    		<td>Product name</td>
		    		<td><?= $product->name ?></td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td>Description</td>
		    		<td><?= $product->description ?></td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td>Image</td>
		    		<td>
		    			<img style="width: 200px" src="<?php
							if(!$product->images())
								echo "http://placehold.it/350x150";
							else 
								echo "../public/img/".$product->images()->path;
						?>" />
		    		</td>
		    	</tr>
		    	<tr>
		    		<td><?= $product->category_id ?></td>
		    		<td>Category</td>
		    		<td><?= $product->category()->name ?></td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td>Price</td>
		    		<td>$<?= $product->price ?></td>
		    	</tr>
		    	<tr>
		    		<td><?= $product->promotion_id?></td>
		    		<td>Promotion</td>
		    		<td>
		    			<?php 
		    				if(!$product->promotion_id)
		    					echo "No promotion";
		    				else
		    					echo $product->promotion()->discount."%"; 
		    			?>	    				
		    		</td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td>Quantity</td>
		    		<td><?= $product->quantity ?></td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td>Status</td>
		    		<td><?php echo ucwords(strtolower(str_replace("_", " ", $product->status))) ?></td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td>Featured</td>
		    		<td><?php 
							if($product->featured == 0)
								echo 'No';
							else
								echo 'Yes';
							?>
					</td>
		    </tbody>
		</table>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
	$(function() {
        $('.product-qty').change(function() {
        	var input = $(this);
        	var val = input.val();

        	if (val < 1)
        		input.val(1);
        	else if (val > 100)
        		input.val(99);
        	else {
        		var form = input.closest('.form-edit-qty');
        		form.submit();
        	}
        });
	});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>