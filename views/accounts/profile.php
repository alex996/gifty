<?php $this->block('title', 'Profile') ?>

<?php $this->block('styles') ?>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Profile Information</h2>
		</div>
		<div class="col-md-9">

			<?php include_once(VIEWS_PATH . 'components/error.php') ?>
			<?php include_once(VIEWS_PATH . 'components/success.php') ?>
		
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>View Profile</h4>
				</div>
					<div class="panel-body">
						<div class="col-md-8 col-md-offset-2">
							<table class="table table-hover">
								<tbody>
									<tr class="top-no-border">
										<td ><b>Display Name</b></td>
										<td><?= $user->name ?></td>
									</tr>
									<tr>
										<td><b>Email</b></td>
										<td><?= $user->email ?></td>
									</tr>
									<tr>
										<td><b>First Name</b></td>
										<td><?= $user->customer->first ?></td>
									</tr>
									<tr>
										<td><b>Last Name</b></td>
										<td><?= $user->customer->last ?></td>
									</tr>
									<tr>
										<td><b>Date of Birth</b></td>
										<td><?= date("F d, Y", strtotime($user->customer->dob)) ?></td>
									</tr>
									<tr>
										<td><b>Phone</b></td>
										<td><?= $user->customer->phone ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h4>Edit Profile</h4>
				</div>
				<div class="panel-body">
					<div class="col-md-8 col-md-offset-2">
						<form class="form-inline" method="POST" action="/account/profile">
							<input type="hidden" name="_method" value="PATCH">
							<div class="form-group col-sm-8">
								<label class="col-sm-4" for="phone" style="margin-top:5px">Phone:</label>
								<div class="col-sm-8">
									<input class="form-control" id="phone" name="phone" placeholder="ex: 201-789-5642" required>
								</div>
							</div>
							<div class="form-group col-sm-4">
								<button type="submit" class="btn btn-block btn-default">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php include_once(VIEWS_PATH . 'accounts/components/sidebar.php') ?>
	</div>
</div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>

</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>