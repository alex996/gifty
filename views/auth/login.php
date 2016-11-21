<?php $this->block('title', 'Login') ?>

<?php $this->block('styles') ?>
<style>

</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="page-header text-center">
				<h2>Login</h2>
			</div>
			<?php include_once(VIEWS_PATH . 'components/error.php') ?>
			<form method="POST" action="/login">
				<div class="form-group">
					<label for="email">Email:</label>
					<input class="form-control" type="email" name="email" id="email" placeholder="johnsmith@gmail.com" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input class="form-control" type="password" name="password" id="password" placeholder="*************" required minlength="6">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-cta btn-block">Log In</button>
				</div>
				<div class="text-center">
					<p>Don't have an account? <a href="/register">Register</a></p>
				</div>
			</form>
		</div>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
	
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>