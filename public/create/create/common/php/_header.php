<div id="header">
	<nav class="navbar container">
		<!-- メニューバー -->
		<a id="top_logo" class="navbar-brand" href="index.php">AR-TABLE</a>
		<ul class="nav nav-pills navbar-right">

		<?php
		session_start();
		?>
			<li class="dropdown"><a class="dropdown-toggle"
				data-toggle="dropdown" href="#">
				<?php
				if ( isset( $_SESSION[ 'creator_name' ] ) ) {
					echo $_SESSION[ 'creator_name' ];
				} else {
					echo "ログインしてください。";
				}
				?>
				<b class="caret"></b>
			</a>
				<ul class="dropdown-menu">

					<li><a>ユーザー情報の編集</a></li>
					<li><a href="../common/lib/logout.php">ログアウト</a></li>
				</ul></li>
		</ul>
	</nav>
</div>
