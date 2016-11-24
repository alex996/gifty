<?php $this->block('title', 'Inventory') ?>

<?php $this->block('styles') ?>
<style>
	.no-promo h3 {margin-bottom: 20px;}
	.no-promo { margin-bottom: 30px; }
	.btn-launch {width: 100px}

	.panel-heading h4 {margin-top:0;}
	.panel-heading p {padding-top:15px;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2>Promotions</h2>
		</div>

		<div style="clear:both; margin-top: 10px;">
			<?php 
				include_once VIEWS_PATH."components/success.php";
				include_once VIEWS_PATH."components/errors.php";
		  	?>
		</div>

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>
						<div class="pull-left">
							<a href="/admin/promotions/create" class="btn btn-cta btn-success btn-block btn-launch"><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Launch</a>
						</div>
						<p>View and Manage Promotions</p>
					</h4>
				</div>
				<div class="panel-body">
					<?php if(!empty($promotions)) : ?>
						<table class="table table-hover">
						    <thead>
								<tr>
									<th>ID</th>
									<th>Status</th>
									<th>Start Date (GMT)</th>
									<th>End Date (GMT)</th>
									<th>Discount</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
						    <tbody>
						     	<?php foreach($promotions as $promo): 
						     	?>
									<tr>
										<td><?= $promo->id ?></td>
										<?php $active = $promo->ends_at > date('Y-m-d H:i:s') ?> 
										<td><span class="label label-<?= $active ? "success" : "default" ?>"><?= $active ? "ACTIVE" : "INACTIVE" ?></span></td>
										<td><?= $promo->starts_at ?></td>
										<td><?= $promo->ends_at ?></td>
										<td><?= number_format($promo->discount * 100, 2) ?> %</td>
										<td><a href="/admin/promotions/<?= $promo->id ?>/edit" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
										<td>
											<form method="POST" action="/admin/promotions/<?= $promo->id ?>">
												<input type="hidden" name="_method" value="DELETE">
												<button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
											</form>
										</td>
									</tr>
								<?php 
								endforeach; ?>
						    </tbody>
						</table>
						

					<?php else: ?>
						<hr><div class="no-promo">
							<h3>There are currently no active promotions.</h3>
							<h4>All products are being sold at a regular price.</h4><br>
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