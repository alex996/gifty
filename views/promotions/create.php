<?php $this->block('title', 'Launch a promotion') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2><i class="fa fa-percent fa-fw" aria-hidden="true"></i> Promotions</h2>
		</div>
	
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Launch a new Promotion</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						<?php 
							include_once VIEWS_PATH."components/success.php";
							include_once VIEWS_PATH."components/errors.php";
					  	?>
						<form class="form-horizontal" action="/admin/promotions" method="POST">
							<div class="form-group">
							    <label class="control-label col-sm-4">Discount:</label>
								<div class="col-sm-6">
							    	<input type="number" min="0.01" max="0.99" step="0.01" class="form-control" name="discount" required="true"
							    		<?= isset($_POST['starts_at']) ? "value=\"".$_POST['discount']."\"" : "" ?> placeholder="0.00">
							    </div>
							</div>

							<div class="form-group">
							   <label class="control-label col-sm-4">Start date:</label>
								<div class="col-sm-6">
							    	<input type="datetime-local" class="form-control" name="starts_at" required="true"
							    		<?= isset($_POST['starts_at']) ? "value=\"".$_POST['starts_at']."\"" : "" ?>>
							    	<span class="help-block" style="margin-bottom:0">YYYY-MM-DD HH:MM AM/PM</span>
							    </div>
							</div>

							<div class="form-group">
							   <label class="control-label col-sm-4">End date:</label>
								<div class="col-sm-6">
							    	<input type="datetime-local" class="form-control" name="ends_at" required="true"
							    		<?= isset($_POST['starts_at']) ? "value=\"".$_POST['ends_at']."\"" : "" ?>>
							    	<span class="help-block">YYYY-MM-DD HH:MM AM/PM</span>
							    </div>
							</div>
							<div class="col-md-12">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-success btn-block btn-cta">Launch</button>
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