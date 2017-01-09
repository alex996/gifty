<?php $this->block('title', 'Dashboard') ?>

<?php $this->block('styles') ?>
<style>
	.nav-card a {color: #949191;}
	.nav-card a:hover {color: #565656;}
	.nav-card h4 {margin-top:20px;}
</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="page-header text-center">
			<h2>Welcome, <?= ucfirst($user->name) ?>!</h2>
		</div>
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="text-center"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i> Admin Dashboard</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row text-center">
								<div class="col-md-4 nav-card">
									<a href="/admin/inventory">
										<h2><i class="fa fa-database fa-4x" aria-hidden="true"></i></h2>
										<h4>Inventory</h4>
									</a>
								</div>
								<div class="col-md-4 nav-card">
									<a href="/admin/sales">
										<h2><i class="fa fa-area-chart fa-4x" aria-hidden="true"></i></h2>
										<h4>Sales</h4>
									</a>
								</div>
								<div class="col-md-4 nav-card">
									<a href="/admin/promotions">
										<h2><i class="fa fa-percent fa-4x" aria-hidden="true"></i></h2>
										<h4>Promotions</h4>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include_once(VIEWS_PATH . 'admin/components/sidebar.php') ?>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>