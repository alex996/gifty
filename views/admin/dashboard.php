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

			

			
		</div>
		<?php include_once(VIEWS_PATH . 'admin/components/sidebar.php') ?>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', get_defined_vars()); ?>