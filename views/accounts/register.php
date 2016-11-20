<?php $this->block('title', 'Registration') ?>

<?php $this->block('styles') ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<style>

</style>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header text-center">
				<h2><i class="fa fa-check-circle" aria-hidden="true"></i> Registration is almost done!</h2>
				<h4>Please fill out a short form below.</h4>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="col-md-12">
					<?php include_once(VIEWS_PATH . 'components/errors.php') ?>
				</div>
				<form method="POST" action="/account">
				    <div class="form-group col-xs-12 col-sm-6">
				    	<label for="first">First Name</label>
				     	<input class="form-control" id="first" name="first" placeholder="ex: John" required>
				    </div>
				    <div class="form-group col-xs-12 col-sm-6">
				    	<label for="last">Last Name</label>
				     	<input class="form-control" id="last" name="last" placeholder="ex: Smith" required>
				    </div>
				    <div class="form-group col-xs-12 col-sm-6">
				    	<label for="dob">Date Of Birth</label>
				     	<input class="form-control" id="dob" name="dob" placeholder="Date Of Birth" required>
				    </div>
				    <div class="form-group col-xs-12 col-sm-6">
				    	<label for="phone">Phone</label>
				     	<input class="form-control" id="phone" name="phone" placeholder="ex: 201-789-5642" required>
				    </div>
				    <div class="clearfix"></div>
				    <hr>
					<div class="col-md-6 col-md-offset-3 text-center">
				    	<button type="submit" class="btn btn-cta btn-block btn-success">Create Account</button>
				    </div>
				</form>
			</div>
		</div>
	</div>
<div>
<?php $this->endblock() ?>

<?php $this->block('scripts') ?>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
	$(function() {
		var minyear = new Date().getFullYear() - 18;
	    $("#dob").datepicker({
	    	changeMonth: true,
      		changeYear: true,
      		dateFormat: 'yy-mm-dd',
      		yearRange: '-70:',
	    });
	});
</script>
<?php $this->endblock() ?>

<?php echo $this->display('layouts/app.php', []); ?>