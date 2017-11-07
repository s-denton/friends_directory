<?php 
include 'includes/header.html';
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['username']))
		$username = $_POST['username'];

	if (!empty($_POST['password']))
		$password = $_POST['password'];

	if (authenticate($username, $password) != true) {
		include 'includes/footer.html';
		exit();
	}
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
	    <form class="form-inline" action="login.php">
			<a href="index.php"><button class="btn btn-primary" id="nav-btn" type="button">Logout</button></a>
		</form>
	  </div>
	</nav>
	<hr>
	<div class="content-container text-left">
		<h2 class="content-title"><span><i class="fa fa-users"></i></span> All Entries</h2>
		<table class="table table-hover table-sm table-responsive">
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
				<?php showAllRecords(); ?>
			</tbody>
		</table>
	</div>

<?php include 'includes/footer.html'; ?>