<?php include 'includes/header.html'; ?>

		<div class="form-container">
			<form action="directory.php" method="post">
				<div class="form-group row">
					<label for="user-login">Username:</label>
					<input type="text" id="user-login" class="form-control form-control-lg" name="username" size="20" maxlength="40" value="<?php $_POST['username']; ?>">
				</div>
				<div class="form-group row">
					<label for="login-password">Password:</label>
					<input type="password" id="login-password" class="form-control form-control-lg" name="password" size="20" maxlength="40">
				</div>
				<div class="form-group row">
					<button type="submit" name="submit" class="btn btn-lg btn-primary submit-btn">Login</button>
				</div>
			</form>
		</div>
		
<?php include 'includes/footer.html'; ?>