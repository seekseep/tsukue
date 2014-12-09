<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<div class="container">
<div class="col-md-4">
</div>
<div class="col-md-4">
<div class="login_form" id="loginModal">		
	<div class="modal-body">
		<div class="well">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#login" data-toggle="tab">Login</a>
				</li>
				<li><a href="#create" data-toggle="tab">Register</a>
				</li>
			</ul>
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane active in" id="login">
					<form class="form-horizontal" action='/public/common/lib/login_check.php' method="POST">
						<fieldset>
							<div id="legend">
								<legend class="">Login</legend>
							</div>
							<div class="control-group">
								<label class="control-label" for="username">Username</label>
								<div class="controls">
									<input type="text" id="username" name="name" placeholder="ユーザー名" class="input-xlarge">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<input type="password" id="password" name="pass" placeholder="パスワード" class="input-xlarge">
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
					<form>
						<fieldset>
							<div id="legend">
								<legend class="">Login</legend>
							</div>
							<div class="control-group">
								<label class="control-label" for="username">Username</label>
								<div class="controls">
									<input type="text" id="username" name="name" placeholder="ユーザー名" class="input-xlarge">
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<input type="password" id="password" name="pass" placeholder="パスワード" class="input-xlarge">
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
</div>
</div>
<div class="col-md-4">
</div>

<?php include_once 'common/php/_footer.php'; ?>

<?php include_once 'common/php/_foot.php'; ?>