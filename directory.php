<?php
session_start();
include 'includes/header.html';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($_SESSION["username"]))) {
	if (!empty($_POST['username']))
		$username = $_POST['username'];
		$_SESSION["username"] = $username;

	if (!empty($_POST['password']))
		$password = $_POST['password'];

	if (authenticate($username, $password) != true) {
		include 'includes/footer.html';
		exit();
	}	
} elseif (empty($_SESSION["username"])) {
	echo "<p class='bg-danger text-white'>You are not logged in</p>";
	echo "<button type='button' class='btn btn-lg btn-primary' style='margin-top: 20px;' onclick='history.back()'>Go Back</button>";
	include 'includes/footer.html';
	exit();
}
?>
	<nav class="navbar navbar-light navbar-expand-md">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navigation">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="directory.php">All Entries</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="new_entry.php">Add New Entry</a>
	      </li>
	    </ul>
	    <a href="javascript:window.location='includes/export.php?username=<?php echo $_SESSION["username"]; ?>'"><button id="export-btn" class="btn btn-success" value="<?php echo $_SESSION['username']; ?>"><i class="fa fa-download"></i> Export to Excel</button></a>
		<a href="logout.php"><button class="btn btn-primary" type="button"><i class="fa fa-sign-out"></i> Logout</button></a>
	  </div>
	</nav>
	<hr>
	<div class="content-container text-left">
		<h2 class="content-title"><span><i class="fa fa-users"></i></span> All Entries</h2>
		<table class="table table-hover table-sm table-responsive" id="directory-table">
			<thead>
				<tr>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Association</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php showAllRecords($_SESSION["username"]); ?>
			</tbody>
		</table>
	</div>

<?php include 'includes/footer.html'; ?>