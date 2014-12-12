<?php 
	$title ="INDEX";
	include_once 'common/php/_head.php';
 ?>


<center>
<section class="container">
	<!-- <h1>index</h1> -->

	<img src="common/image/tsukue.png" height="110" width="267" alt="">

	<div class="row">
		<div class="col-sm-3">
		</div>
		<div class="col-sm-6">
			<form class="form-search" action="./list.php" method="GET">
				<input type="text" class="input-medium search-query" name="keyword">
				<button type="submit" class="btn"> 検 索 </button>
			</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
	
</section>
</center>




<?php 
	include_once 'common/php/_foot.php';
 ?>