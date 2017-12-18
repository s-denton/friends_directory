<?php 
include 'includes/header.html';
include 'includes/functions.php';

//if submit is clicked but the admin login is not checked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['adminlogin']))) {	
	if (!empty($_POST['username']))
		$username = $_POST['username'];

	if (!empty($_POST['password']))
		$password = $_POST['password'];

	if (authenticate_admin($username, $password) != true) {
		include 'includes/footer.html';
		exit();
	}
}

?>

<!-- <script src="script/jquery-1.8.1.min.js" type="text/javascript" ></script>
<script src="js/adminAjax.js" type="text/javascript" ></script> -->
	<div class="btn-group-vertical">
		<br>
		<h2> Email a user here:</h2>			
			<br>
			<button id="emailUser" name="emailuser" value="emailuser" class="btn btn-info">Email User</button>
	</div>

		<!--Show result from functions here: -->
		<p id="alert1" style="display:none;" class="alert alert-info text-center"><span id="result1" ></span></p>

		<form id="adminEmail" action="includes/adminEmail.php" method="post" style="display:none;">

			<div class="form-group row">
			    <p>Select User: <select name='useremail'>
					<?php
					include ('includes/mysqli_connect.php');
					$query = "SELECT email from users";
					$result = mysqli_query($dbc, $query); 
				        if (mysqli_num_rows($result)>0) {
				        while($row = mysqli_fetch_array($result)){
				        $uemail = $row['email'];

				        echo "<option value=$useremail>$uemail</option>";
				        }
					}
					?>
				</select></p>
		    </div>

		    <div class="form-group row">
		    	Subject: <input type="text" id="subject" class="form-control input-lg" placeholder="Subject">
		    </div>
			<div class="form-group row">
				Comment: <input type="text" id="comment" class="form-control input-lg" placeholder="Comment...">
			</div>

		    <div class="button-group">
			    <button name="sendemail" value="sendemail" class="btn btn-info">Send Email</button>
		    </div>
		</form>

	<hr>
	<div class="form-container">
		<h2> Add, Update, or Delete a User here:</h2>

		<form id="adminForm" action="includes/adminFunction.php" method="post">
			<p class="text-center small">Please, complete all the text boxes and choose an option below:</p>

			<!--Show result from functions here: -->
			<p id="alert" style="display:none;" class="alert alert-info text-center"><span id="result" ></span></p>		

			<div class="form-group row">
		    	<input type="text" id="username" class="form-control input-lg" placeholder="Username">
		    </div>
		    <div class="form-group row">
		    	<input type="text" id="password" class="form-control input-lg" placeholder="Password">
		    </div>
			<div class="form-group row">
				<input type="text" id="firstname" class="form-control input-lg" placeholder="First Name">
			</div>
		    <div class="form-group row">
		   		<input type="text" id="lastname" class="form-control input-lg" placeholder="Last Name">
		    </div>
		    <div class="form-group row">
		    	<input type="email" id="email" class="form-control input-lg" placeholder="Email">
		    </div>
		    <div class="form-group row">
		    	<input type="text" id="role" class="form-control input-lg" placeholder="User or Admin">
		    </div>

		    <div class="button-group">
			    <button name="add" value="add" class="button btn btn-info">Add User</button>
				<button name="update" value="update" class="button btn btn-success">Update User</button>
				<button name="delete" value="delete" class="button btn btn-danger">Delete User</button>
		    </div>
		</form>

	</div>
<?php include 'includes/footer.html'; ?>