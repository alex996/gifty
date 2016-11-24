<?php if (!empty($successes)): ?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> The following operations succeeded:<br><br>
		<ul class="fa-ul">
			<?php foreach($successes as $success): ?>
				<li><i class="fa fa-check" aria-hidden="true"></i> <?= $success ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>