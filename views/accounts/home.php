<?php $this->block('title', 'Registration') ?>

<?php $this->block('styles') ?>
<style>
	.list-group a {padding: 17px 15px;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2>Welcome Back to Your Account, <?= $user->name ?>!</h2>
		</div>
		<?php /*
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>Profile Information</h4></div>
				<div class="panel-body">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td><b>Display Name</b></td>
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
								<td><?= $user->customer->dob ?></td>
							</tr>
							<tr>
								<td><b>Phone</b></td>
								<td><?= $user->customer->phone ?></td>
							</tr>
						</tbody>
					</table>
					<div class="col-md-12">
						<a href="account/edit" class="btn btn-cta btn-default btn-block">Edit Profile</a>
					</div>
				</div>
			</div>
		</div>
		*/ ?>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>Recent Orders</h4></div>
				<div class="panel-body">
					<?php /*
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Card Type</th>
								<th>Cardholder</th>
								<th>Last 4 Digits</th>
								<th>Address</th>
							</tr>
						</thead>
						<tbody>
							<?php $pm = $user->customer->payment_method; $payment_methods = is_array($pm) ? $pm : [$pm]; ?>
							
							<?php foreach($payment_methods as $method): ?>
								<tr>
									<td><?= $method->type ?></td>
									<td><?= $method->cardholder ?></td>
									<td><?= $method->last_digits ?></td>
									<?php $addr = $method->address ?>
									<td><?= "{$addr->street},<br>{$addr->city}, {$addr->state}, {$addr->country}, {$addr->zip}" ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					*/ ?>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading text-center"><h4>Navigation</h4></div>
				<div class="list-group">
					<a href="account" class="list-group-item active"><i class="fa fa-user-circle fa-fw" aria-hidden="true"></i> User Account</a>
					<a href="account/history" class="list-group-item"><i class="fa fa-history fa-fw" aria-hidden="true"></i> Order History</a>
					<a href="account/payments" class="list-group-item"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> Payment Methods</a>
					<a href="account/profile" class="list-group-item"><i class="fa fa-pencil-square fa-fw" aria-hidden="true"></i> Edit Profile</a>
					<a href="account/security" class="list-group-item"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Update Security</a>
					<a href="javascript:document.logout.submit();" class="list-group-item"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> Log Out</a>
					<form method="POST" action="/logout" name="logout"></form>
				</div>
			</div>

			<div class="">
				
			</div>
		</div>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script>

</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', []); ?>