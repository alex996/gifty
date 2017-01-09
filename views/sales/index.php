<?php $this->block('title', 'Sales') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-area-chart fa-fw" aria-hidden="true"></i> Sales</h2>
		</div>

		<div class="col-md-9">

			<?php 
				include_once VIEWS_PATH."components/success.php";
				include_once VIEWS_PATH."components/error.php";
		  	?>
			
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>View Sales</h4>
				</div>
				<div class="panel-body">
					<?php if(!empty($sales)): ?>
						<div class="table-responsive">
							<table class="table">
							    <thead>
									<tr>
										<th>ID</th>
										<th>Customer</th>
										<th>Shipping</th>
										<th>Payment</th>
										<th>Status</th>
										<th></th>
										<th>Total</th>
										<th>Created at</th>
										<th></th>
									</tr>
								</thead>
							    <tbody>
							     	<?php foreach($sales as $sale): 
							     	?>
										<tr>
											<td><?= $sale->id ?></td>
											<td><?= $sale->customer()->first." ".$sale->customer()->last ?></td>
											<td><?= $sale->address()->city.", ".$sale->address()->country ?></td>
											<td><?= $sale->payment_method()->type ?></td>
											<form action="/admin/sales/<?= $sale->id ?>" method="POST">
												<td>
													<input type="hidden" name="_method" value="PATCH" />
													<select class="form-control input-sm" name="status" style="width: 120px">
														<option value="PENDING" <?php if($sale->status == "PENDING") echo "selected=\"selected\""; ?>">PENDING</option>
														<option value="APPROVED" <?php if($sale->status == "APPROVED") echo "selected=\"selected\""; ?>">APPROVED</option>
														<option value="DELIVERED" <?php if($sale->status == "DELIVERED") echo "selected=\"selected\""; ?>">DELIVERED</option>
														<option value="CANCELLED" <?php if($sale->status == "CANCELLED") echo "selected=\"selected\""; ?>">CANCELLED</option>
														<option value="ERROR" <?php if($sale->status == "ERROR") echo "selected=\"selected\""; ?>">ERROR</option>
													</select>
												</td>
												<td>
													<button type="submit" class="btn btn-default"><i class="fa fa fa-save" aria-hidden="true"></i></button>
												</td>
											</form>
											<td>$<?= $sale->total ?></td>
											<td><?= date('d-m-Y', strtotime($sale->created_at)) ?></td>
											<td><a href="/admin/sales/<?= $sale->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-ellipsis-h"></i></a></td>
								
										</tr>
									<?php 
									endforeach; ?>
							    </tbody>
							</table>
						</div>
						<hr>
					<?php else: ?>
						<div class="empty-cart">
							<h3>There are currently no sales.</h3>
							<h4>Please check in later.</h4><br>
						</div>
					<?php endif; ?>
				</div>
			</div>
			
		</div>

		<?php include_once(VIEWS_PATH . 'admin/components/sidebar.php') ?>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>