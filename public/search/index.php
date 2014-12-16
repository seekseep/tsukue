<?php 
	$title ="INDEX";
	include_once 'common/php/_head.php';
 ?>

<div class="centering">
	<section class="container">
		<h1 class="font-poiret-one">tsukue</h1>

		<!-- <img src="common/image/tsukue.png" height="110" width="267" alt=""> -->

		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-6">
				<form class="form-search" action="./list.php" method="GET">
					<input type="text" class="input-medium search-query" name="keyword">
					<button type="submit" class="btn">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
					</button>
				</form>
			</div>
			<div class="col-sm-3"></div>
		</div>
	
	</section>
</div>






<?php 
	include_once 'common/php/_foot.php';
 ?>