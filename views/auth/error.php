<?php if(isset($auth_error)): ?>
<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Whoops!</strong> <?= $auth_error ?>
</div>
<?php endif; ?>