<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<?php

if ( isset( $_SESSION[ 'creator_name' ] ) ) {
	header( "location: dashboard.php" );
}
?>
<div class="container">
	<div class="login_form col-md-offset-4 col-md-4"
		style="margin-top: 70px; margin-bottom: 70px;">
		<div class="well">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#login" data-toggle="tab">Login</a></li>
				<li><a href="#create" data-toggle="tab">Register</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active in" id="login">
					<form class="form-horizontal" action='../common/lib/login_check.php'
						method="POST">
						<fieldset>
							<div id="legend">
								<legend style="margin-bottom: 5px;">Login</legend>
							</div>
							<div class="control-group">
								<label class="control-label" for="user_id">UserID</label>
								<div class="controls">
									<input type="text" id="user_id" name="creator_name"
										placeholder="ユーザーID" class="input-xlarge">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<input type="password" id="password" name="creator_pass"
										placeholder="パスワード" class="input-xlarge">
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button class="btn btn-info">Login</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="tab-pane fade" id="create">
					<form class="form-horizontal" action='../common/lib/creator_register.php' method="POST">
						<fieldset>
							<div id="legend">
								<legend style="margin-bottom: 5px;">Register</legend>
							</div>
							<div class="control-group">
								<label class="control-label" for="user_id">UserID</label>
								<div class="controls">
									<input type="text" id="username" name="creator_name"
										placeholder="ユーザーID" class="input-xlarge">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<input type="password" id="password" name="creator_pass"
										placeholder="パスワード" class="input-xlarge">
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button class="btn btn-info">Registration</button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once 'common/php/_footer.php'; ?>

<?php include_once 'common/php/_foot.php'; ?>