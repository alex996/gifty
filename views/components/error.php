<?php if(!empty($error)): ?>
<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	<strong>Whoops!</strong> <?= $error ?>
</div>
<?php endif; ?>