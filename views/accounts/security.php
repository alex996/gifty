<?php $this->block('title', 'Payment Methods') ?>

<?php $this->block('styles') ?>
<style>
	
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Security Settings</h2>
		</div>
		<div class="col-md-9">
	
			<?php include_once(VIEWS_PATH . 'components/error.php') ?>
			<?php include_once(VIEWS_PATH . 'components/success.php') ?>

			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>Change Password</h4></div>
				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2">
						<form class="form-horizontal" method="POST" action="/account/security">
							<input type="hidden" name="_method" value="PATCH">
							<div class="form-group">
								<label class="control-label col-sm-4" for="old_password">Old Password:</label>
								<div class="col-sm-8">
								  	<input class="form-control" type="password" name="old_password" id="old_password" placeholder="*************" required minlength="6">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="password">New Password:</label>
								<div class="col-sm-8">
								  	<input class="form-control" type="password" name="password" id="password" placeholder="*************" required minlength="6">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4" for="password_confirmation">Confirm Password:</label>
								<div class="col-sm-8">
								  	<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="*************" required minlength="6">
								</div>
							</div>
							<hr>
							<div class="col-md-6 col-md-offset-3 text-center">
						    	<button type="submit" class="btn btn-cta btn-block btn-primary">Update</button>
						    </div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include_once(VIEWS_PATH . 'accounts/components/sidebar.php') ?>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>

</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>