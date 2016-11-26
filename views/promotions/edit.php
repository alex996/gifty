<?php $this->block('title', 'Edit Promotion') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2>Promotions</h2>
		</div>
	
		<div class="col-md-9">
			
			<?php 
				include_once VIEWS_PATH."components/success.php";
				include_once VIEWS_PATH."components/errors.php";
		  	?>

			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Update Promotion</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						
						<form class="form-horizontal" action="/admin/promotions/<?= $promotion->id ?>" method="POST">

							<input type="hidden" name="_method" value="PATCH">
							
							<div class="form-group">
								<label class="control-label col-sm-4">ID:</label>
								<div class="col-sm-6">
							    	<input class="form-control" value="<?= $promotion->id ?>" disabled>
							    </div>
							</div>

							<div class="form-group">
							    <label class="control-label col-sm-4">Discount:</label>
								<div class="col-sm-6">
							    	<input type="number" min="0" max="99.99" step="0.01" class="form-control" name="discount" required="true" value="<?= $promotion->discount ?>">
							    </div>
							</div>

							<div class="form-group">
							   <label class="control-label col-sm-4">Start date (GMT):</label>
								<div class="col-sm-6">
							    	<input type="datetime-local" class="form-control" name="starts_at" required="true" value="<?= date("Y-m-d\TH:i:s", strtotime($promotion->starts_at)) ?>"> 
							    </div>
							</div>

							<div class="form-group">
							   <label class="control-label col-sm-4">End date (GMT):</label>
								<div class="col-sm-6">
							    	<input type="datetime-local" class="form-control" name="ends_at" required="true" value="<?= date("Y-m-d\TH:i:s", strtotime($promotion->ends_at)) ?>">
							    </div>
							</div>
							<br>
							<div class="col-md-12">
								<div class="col-md-6 col-md-offset-2">
									<button type="submit" class="btn btn-success btn-block btn-cta">Update</button>
								</div>
							</div>
						</form>
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