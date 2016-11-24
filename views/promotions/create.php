<?php $this->block('title', 'Launch a promotion') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2>Launch a new Promotion</h2>
		</div>
	
		<div class="col-md-9"><br>
			<div class="col-md-8 col-md-offset-2">
				<?php 
					include_once VIEWS_PATH."components/success.php";
					include_once VIEWS_PATH."components/errors.php";
			  	?>
				<form class="form-horizontal" action="/admin/promotions" method="POST">
					<div class="form-group">
					    <label class="control-label col-sm-4">Discount:</label>
						<div class="col-sm-6">
					    	<input type="number" step="0.01" min="0" max="0.99" step="0.01" class="form-control" name="discount" required="true"
					    		<?= isset($_POST['starts_at']) ? "value=\"".$_POST['discount']."\"" : "" ?>>
					    </div>
					</div>

					<div class="form-group">
					   <label class="control-label col-sm-4">Start date:</label>
						<div class="col-sm-6">
					    	<input type="datetime-local" class="form-control" name="starts_at" required="true"
					    		<?= isset($_POST['starts_at']) ? "value=\"".$_POST['starts_at']."\"" : "" ?>>
					    </div>
					</div>

					<div class="form-group">
					   <label class="control-label col-sm-4">End date:</label>
						<div class="col-sm-6">
					    	<input type="datetime-local" class="form-control" name="ends_at" required="true"
					    		<?= isset($_POST['starts_at']) ? "value=\"".$_POST['ends_at']."\"" : "" ?>>
					    </div>
					</div>
					<br>
					<div class="col-md-12">
						<div class="col-md-6 col-md-offset-2">
							<button type="submit" class="btn btn-success btn-block btn-cta">Launch</button>
						</div>
					</div>
				</form>
			</div>
		</div>

		<?php include_once(VIEWS_PATH . 'admin/components/sidebar.php') ?>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>