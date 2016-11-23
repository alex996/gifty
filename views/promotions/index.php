<?php $this->block('title', 'Inventory') ?>

<?php $this->block('styles') ?>
<style>
	.no-promo h3 {margin-bottom: 20px;}
	.no-promo { margin-bottom: 30px; }
	.btn-launch {width: 100px}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<div class="pull-left">
				<a href="promotions/create" class="btn btn-cta btn-success btn-block btn-launch"><i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> Launch</a>
			</div>
			<h2>
				Promotions
			</h2>
		</div>

		

		<div style="clear:both; margin-top: 10px;">
			<?php 
				include_once VIEWS_PATH."components/success.php";

				include_once VIEWS_PATH."components/error.php";
		  	?>
		</div>

		<div class="col-md-9">
			
			<?php if(!empty($promotions)) : ?>
				<table class="table">
				    <thead>
						<tr>
							<th>#</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Discount</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
				    <tbody>
				     	<?php foreach($promotions as $index => $curr_promo): 
				     	?>
							<tr>
								<td><?= $index + 1 ?></td>
								<td><?= $curr_promo->starts_at ?></td>
								<td><?= $curr_promo->ends_at ?></td>
								<td><?= $curr_promo->discount ?>%</td>
								<td><a href="/admin/promotions/<?= $curr_promo->id ?>/edit" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
								<td>
									<form method="POST" action="/admin/promotions/<?= $curr_promo->id ?>">
										<input type="hidden" name="_method" value="DELETE">
										<button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
									</form>
								</td>
							</tr>
						<?php 
						endforeach; ?>
				    </tbody>
				</table>
				<hr>

			<?php else: ?>
				<div class="no-promo">
					<h3>There are currently no active promotions.</h3>
					<h4>All products are being sold at a regular price.</h4><br>
				</div>
			<?php endif; ?>
		</div>
		<?php include_once(VIEWS_PATH . 'admin/components/sidebar.php') ?>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>