<?php $this->block('title', 'Dashboard') ?>

<?php $this->block('styles') ?>
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
						<div class="col-md-8 col-md-offset-2">
							<p>This is your back-end dashboard. You will have full control of the system here.
							Plus, you will find marketing and sales statistics. However, right now there is 
							nothing to show. These features are currently part of the future development process...</p>
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