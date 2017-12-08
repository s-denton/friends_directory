<?php 
include 'includes/header.html';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['username']))
		$username = $_POST['username'];
	if (!empty($_POST['password']))
		$password = $_POST['password'];
	if (!empty($_POST['password-conf']))
		$confirm_password = $_POST['password-conf'];
	if (!empty($_POST['firstname']))
		$firstname = $_POST['firstname'];
	if (!empty($_POST['lastname']))
		$lastname = $_POST['lastname'];
	if (!empty($_POST['email']))
		$email = $_POST['email'];
	
	createUser($username, $password, $confirm_password, $firstname, $lastname, $email);
}

?>	

	<div class="form-container">
		<form action="" method="post">
			<div class="form-group row">
				<label for="username">Username:</label>
				<input type="text" id="username" class="form-control form-control-lg" name="username" size="20" maxlength="40" value="<?php $_POST['username']; ?>">
			</div>
			<div class="form-group row">
				<label for="password">Password:</label>
				<input type="password" id="password" class="form-control form-control-lg" name="password" size="20" maxlength="40">
			</div>
			<div class="form-group row">
				<label for="password-conf">Confirm Password:</label>
				<input type="password" id="password-conf" class="form-control form-control-lg" name="password-conf" size="20" maxlength="40">
			</div>
			<div class="form-group row">
				<label for="firstname">First Name:</label>
				<input type="text" id="firstname" class="form-control form-control-lg" name="firstname" size="20" maxlength="40" value="<?php $_POST['firstname']; ?>">
			</div>
			<div class="form-group row">
				<label for="lastname">Last Name:</label>
				<input type="text" id="lastname" class="form-control form-control-lg" name="lastname" size="20" maxlength="40" value="<?php $_POST['lastname']; ?>">
			</div>
			<div class="form-group row">
				<label for="email">Email Address:</label>
				<input type="email" id="email" class="form-control form-control-lg" name="email" size="20" maxlength="40" value="<?php $_POST['email']; ?>">
			</div>
			<div class="form-group row">
				<button type="button" onclick="window.location.href='index.php'" class="btn btn-lg btn-primary submit-btn">Go Back</button>
				<button type="submit" name="submit" class="btn btn-lg btn-success submit-btn">Register</button>
			</div>
		</form>
	</div>
		
<?php include 'includes/footer.html'; ?>