<?php $this->block('title', 'Sale Details') ?>

<?php $this->block('styles') ?>
<style>
	.table tbody>tr>td { vertical-align: middle; }
	.product-thumb {margin-right: 10px; width:50px;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-area-chart fa-fw" aria-hidden="true"></i> Sales</h2>
		</div>

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>View Sale &ndash; <i>ID <?= $sale->id ?></i></p></h4>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<?php if (!empty($sale)): ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Product</th>
										<th>Quantity</th>
										<th>Unit Price</th>
										<th>Price Paid</th>
										<th>Promotion</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($sale) && $sale->order_details): ?>				
										<?php foreach($sale->order_details as $index => $detail): ?>
											<tr>
												<td><?= $index + 1 ?></td>
												<td>
													<?php $featured = $detail->product->featured_img(); ?>
													<img class="product-thumb pull-left" src="<?= !empty($featured) ? $featured->path : "/img/blank.png" ?>" alt="">
													<a href="/admin/inventory/<?= $detail->product->id ?>"><?= $detail->product->name ?></a>
												</td>
												<td class="text-center"><?= $detail->quantity ?></td>
												<td>$<?= $detail->product->price ?></td>
												<td>$<?= $detail->price ?></td>
												<td><?= $detail->product->promotion_id ? number_format($detail->product->promotion()->discount * 100, 2) ."%" : "NONE" ?></td>
											</tr>
										<?php endforeach; ?>
									<?php else: ?>
										<tr><td colspan="7" class="text-center"><i>There is nothing here.</i></td></tr>
									<?php endif; ?>
								</tbody>
							</table>
							<hr>
							<div class="col-md-12">
								<h3 class="pull-right total">Total: <b>$<?= $sale->total ?></b></h3>
							</div>
						<?php endif; ?>
					</div>
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