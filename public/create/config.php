<?php include_once 'common/php/_head.php'; ?>
<?php include_once 'common/php/_header.php'; ?>
<div class="container">
	<div class="login_form col-md-offset-4 col-md-4" style="margin-top:70px; margin-bottom:70px;">		
		<div class="well">
			<ul class="nav nav-tabs">
				<li class><a href="#create" data-toggle="tab">Register</a></li>
			</ul>
			<div class="tab-content">

				<div class="tab-pane fade" id="create">
					<form class="form-horizontal" action='' method="POST">
						<fieldset>
							<div id="legend">
								<legend style="margin-bottom: 5px;">Register</legend>
							</div>
							<div class="control-group">
								<label class="control-label" for="name_view">表示名</label>
								<div class="controls">
									<input type="text" id="name_view" name="name_view" placeholder="まーくん" class="input-xlarge">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="user_id">UserID</label>
								<div class="controls">
									<input type="text" id="username" name="name" placeholder="ユーザーID" class="input-xlarge">
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

<?php include_once 'common/php/_footer.php'; ?>

<?php include_once 'common/php/_foot.php'; ?>