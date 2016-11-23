<?php $this->block('title', 'Launch a promotion') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">

		<div class="page-header text-center">
			<h2>Launch a new Promotion</h2>
		</div>
	
		<div class="col-md-9">
			<div style="clear:both; margin-top: 10px;">
				<?php 
					include_once VIEWS_PATH."components/success.php";

					include_once VIEWS_PATH."components/error.php";
			  	?>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<form class="form-horizontal" action="/promotions" method="POST">
					<div class="form-group">
					    <label class="control-label col-sm-4">Discount (%):</label>
						<div class="col-sm-6">
					    	<input type="number" step="0.01" min="0" max="99.99" step="0.01" class="form-control" name="discount" required="true" <?php 
					    		if(isset($_POST['discount'])) echo "value=\"".$_POST['discount']."\"";
					    	?>>
					    </div>
					</div>

					<div class="form-group">
					   <label class="control-label col-sm-4">Start date:</label>
						<div class="col-sm-6">
					    	<input type="datetime-local" class="form-control" name="starts_at" required="true"
					    		<?php 
					    		if(isset($_POST['starts_at'])) echo "value=\"".$_POST['starts_at']."\"";
					    	?>>
					    </div>
					</div>

					<div class="form-group">
					   <label class="control-label col-sm-4">End date:</label>
						<div class="col-sm-6">
					    	<input type="datetime-local" class="form-control" name="ends_at" required="true"
					    		<?php 
					    		if(isset($_POST['starts_at'])) echo "value=\"".$_POST['ends_at']."\"";
					    	?>>
					    </div>
					</div>
					<hr>
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