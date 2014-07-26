
<div class="container">
	<div class="row	">

	<?php foreach ($posts as $key => $content): ?>

		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php echo $content["post_title"]; ?></h3>
		  </div>
		  <div class="panel-body">
		   	<?php echo $content["post_detail"] ?>
		  </div>
		</div>

	<?php endforeach ?>
		
	</div>


	<div class="row">
	  <div class="col-xs-6 col-md-3">
	    <a href="#" class="thumbnail">
	      <img data-src="holder.js/200%x380" alt="...">
	    </a>
	  </div>
	  
	</div>


</div>