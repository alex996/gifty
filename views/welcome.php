<?php $this->block('title', 'Welcome!') ?>

<?php $this->block('styles') ?>
	<style>
		* {color: green;}
	</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>

	<h1>Welcome, <?= $name ?>!</h1>

<?php $this->endblock() ?>

<?= $this->block('info') ?>

<?php $this->block('scripts') ?>
	<script>
		console.log('hey');
	</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', []); ?>