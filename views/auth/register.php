<?php $this->block('title', 'Register') ?>

<?php $this->block('styles') ?>
<style>
	
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="row">
	<div class="text-center">
		<h2>Register</h2>
	</div>

	<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
		<form method="POST" action="/register">
			<div class="form-group">
				<label for="email">Name:</label>
				<input class="form-control" type="email" name="email" id="email" placeholder="John Smith" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input class="form-control" type="email" name="email" id="email" placeholder="johnsmith@gmail.com" required>
			</div>
			<div class="form-group">
				<label for="password">Password:</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="*************" required>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-cta btn-block">Register</button>
			</div>
			<div class="text-center">
				<p>Already have an account? <a href="/login">Log in</a></p>
			</div>
		</form>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>
	
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', []); ?>