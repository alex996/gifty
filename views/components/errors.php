<?php if (!empty($errors)): ?>
	<div class="alert alert-danger error-box">
		<strong>Whoops!</strong> We found errors in your info:<br><br>
		<ul class="fa-ul">
			<?php foreach($errors as $error): ?>
				<li><i class="fa fa-times fa-fw" aria-hidden="true"></i> <?= $error ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>