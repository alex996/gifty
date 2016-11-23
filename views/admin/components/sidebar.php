<?php $url = Router::url() ?>
<div class="col-md-3">
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingOne">
	        <h4 class="panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	      		<i class="fa fa-tachometer fa-fw" aria-hidden="true"></i> Dashboard
	        </h4> 
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse <?= strpos($url, 'dashboard') !== false ? "in" : "" ?>" role="tabpanel" aria-labelledby="headingOne">
	      <ul class="list-group">
		    <a class="list-group-item" href="/admin/dashboard">&emsp;<i class="fa fa-chevron-right fa-fw" aria-hidden="true"></i> Home</a>
		  </ul>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingTwo">
	        <h4 class="collapsed panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	          <i class="fa fa-database fa-fw" aria-hidden="true"></i> Inventory
	        </h4>
	    </div>
	    <div id="collapseTwo" class="panel-collapse collapse <?= strpos($url, 'inventory') !== false ? "in" : "" ?>" role="tabpanel" aria-labelledby="headingTwo">
	      <ul class="list-group">
		    <a class="list-group-item" href="/admin/products">&emsp;<i class="fa fa-chevron-right fa-fw" aria-hidden="true"></i> Products</a>
		  </ul>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingThree">
	        <h4 class="collapsed panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	          <i class="fa fa-area-chart fa-fw" aria-hidden="true"></i> Sales
	        </h4>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse" <?= strpos($url, 'sales') !== false ? "in" : "" ?> role="tabpanel" aria-labelledby="headingThree">
	      <ul class="list-group">
		    <a class="list-group-item" href="/admin/products">&emsp;<i class="fa fa-chevron-right fa-fw" aria-hidden="true"></i> Orders</a>
		  </ul>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading" role="tab" id="headingFour">
	        <h4 class="collapsed panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
	          <i class="fa fa-percent fa-fw" aria-hidden="true"></i> Promotions
	        </h4>
	    </div>
	    <div id="collapseFour" class="panel-collapse collapse <?= strpos($url, 'promotions') !== false ? "in" : "" ?>" role="tabpanel" aria-labelledby="headingFour">
          <ul class="list-group">
	        <a class="list-group-item" href="/admin/promotions">&emsp;<i class="fa fa-chevron-right fa-fw" aria-hidden="true"></i> View All Promotions</a>
	        <a class="list-group-item" href="/admin/promotions/create">&emsp;<i class="fa fa-chevron-right fa-fw" aria-hidden="true"></i> Launch a Promotion</a>
	      </ul>
	    </div>
	  </div>
	</div>
</div>




