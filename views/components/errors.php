<?php if (!empty($errors)): ?>
	<div class="alert alert-danger error-box">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Whoops!</strong> We found errors in your input:<br><br>
		<ul class="fa-ul">
			<?php foreach($errors as $error): ?>
				<li><i class="fa fa-times fa-fw" aria-hidden="true"></i> <?= $error ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>