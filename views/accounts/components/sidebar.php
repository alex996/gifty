<div class="col-md-3">
	<div class="panel panel-default account-sidebar">
		<div class="panel-heading text-center"><h4>Navigation</h4></div>
		<div class="list-group">
			<a href="/account" class="list-group-item <?= Router::url() == '/account' ? "active" : "" ?>"><i class="fa fa-user-circle fa-fw" aria-hidden="true"></i> User Account</a>
			<a href="/account/orders" class="list-group-item <?= Router::url() == '/account/orders' ? "active" : "" ?>"><i class="fa fa-history fa-fw" aria-hidden="true"></i> Order History</a>
			<a href="/account/payment-methods" class="list-group-item <?= Router::url() == '/account/payment-methods' ? "active" : "" ?>"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i> Payment Methods</a>
			<a href="/account/profile" class="list-group-item <?= Router::url() == '/account/profile' ? "active" : "" ?>"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> Profile Information</a>
			<a href="/account/security" class="list-group-item <?= Router::url() == '/account/security' ? "active" : "" ?>"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> Security Settings</a>
			<a href="javascript:document.logout.submit();" class="list-group-item"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> Log Out</a>
		</div>
	</div>
</div>