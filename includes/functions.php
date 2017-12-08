<?php
// authenticate login information
function authenticate($login_username, $login_password) {
	require ('includes/mysqli_connect.php');

	$sql = "SELECT * FROM Users WHERE BINARY username = '$login_username' and password = '$login_password'";
	$result = $dbc -> query($sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row	
	if($count == 1) {
	    return true;
	} else {
	    $error = "<p class='bg-danger text-white'>Your username or password is invalid</p>";
	    echo "$error";
	    echo "<button type='button' class='btn btn-lg btn-primary' style='margin-top: 20px;' onclick='history.back()'>Go Back</button>";
	    return false;
	}
}

// create a new user
function createUser($username, $password, $confirm_password, $firstname, $lastname, $email) {
	require ('includes/mysqli_connect.php');

	// check if the passwords match
	if($password !== $confirm_password) {
		echo "<p class='bg-danger text-white'>Passwords do not match!</p>";
	    echo "<button type='button' class='btn btn-lg btn-primary submit-btn' onclick='history.back()'>Go Back</button>";
	    include 'includes/footer.html';
	    exit();
	}

	// check if email is already registered
	$email_exists_sql = "SELECT uid FROM Users WHERE BINARY email = '$email'";
	$result = $dbc -> query($email_exists_sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);

	// If result matched email, user is already registered	
	if($count == 1) {
	    echo "<p class='bg-danger text-white'>This email address is already registered</p>";
	    echo "<button type='button' class='btn btn-lg btn-primary submit-btn' onclick='history.back()'>Go Back</button>";
	    include 'includes/footer.html';
	    exit();
	}

	// check if user already exists
	$user_exists_sql = "SELECT uid FROM Users WHERE BINARY username = '$username'";
	$result = $dbc -> query($user_exists_sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);

	// If result matched, username already exists	
	if($count == 1) {
	    echo "<p class='bg-danger text-white'>Username already exists, please choose another</p>";
	    echo "<button type='button' class='btn btn-lg btn-primary submit-btn' onclick='history.back()'>Go Back</button>";
	    include 'includes/footer.html';
	    exit();
	}

	// insert the user into the user table
	$insert_sql = "INSERT INTO Users (username, password, firstname, lastname, email) VALUES ('$username', '$password', '$firstname', '$lastname', '$email')";

	// check for connection to database, else error
	if (mysqli_query($dbc, $insert_sql)) {
		echo "<script>location='index.php'</script>";
	} else {
		echo "<br> <p class='bg-danger text-white'>Error Occured</p>";	
	}
}

// delete a record from the db
function deleteRecord($username, $fid) {
	require ('includes/mysqli_connect.php'); // Connect to the db.

	$sql = "DELETE FROM Directory WHERE BINARY username = '$username' AND fid = '$fid";

	if(mysqli_query($dbc, $sql)) {
	    echo "<script>alert('Record successfully deleted!');</script>";
	}else {
	    echo "<p class='bg-danger text-white'>Error deleting book: " . mysqli_error($dbc) . "</p>";
	}

}

// insert a new record into the db
function insertRecord($username, $fname, $lname, $company, $street, $city, $state, $zip, $email, $phone, $bday, $assoc) {
	require ('includes/mysqli_connect.php'); // Connect to the db.

	// first check for a duplicate entry
	$select_sql = "SELECT fid FROM Directory WHERE BINARY first_name = '$fname' AND BINARY last_name = '$lname";
	$result = $dbc -> query($select_sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);

	// If result matched first and last names, entry already exists	
	if($count == 1) {
	    echo "<p class='bg-danger text-white'>Entry already exists</p>";
	    echo "<button type='button' class='btn btn-lg btn-primary submit-btn' onclick='history.back()'>Go Back</button>";
	}

	$insert_sql = "INSERT INTO Directory (username, first_name, last_name, company, street, city, state, zip, email, phone, birthday, association) VALUES ('$username', '$fname', '$lname', '$company', '$street', '$city', '$state', '$zip', '$email', '$phone', '$bday', '$assoc')";

	// check for connection to database, else error
	if (mysqli_query($dbc, $insert_sql)) {
		echo "<script>location='directory.php'</script>";
	} else {
		echo "<br> <p class='bg-danger text-white'>Error Occured</p>";	
	}

}

// display the records in the db
function showAllRecords($username) {
	// This script retrieves all the records from the users table.
	require ('includes/mysqli_connect.php'); // Connect to the db.
			
	// Make the query:
	$q = "SELECT * FROM Directory WHERE BINARY username = '$username' ORDER BY last_name ASC";		
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.
		
		// Fetch and print all the records:
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			echo '
			<tr class="clickable">
				<td align="left" class="row-last-name" value="' . $row['last_name'] . '">' . $row['last_name'] . '</td>
				<td align="left" class="row-first-name" value="' . $row['first_name'] . '">' . $row['first_name'] . '</td>
				<td align="left">' . $row['email'] . '</td>
				<td align="left">' . $row['phone'] . '</td>
				<td align="left">' . $row['association'] . '</td>
				<td colspan="2" align="center">
					<button data-toggle="collapse" data-target="#records-accordian' . $row['fid'] . '" data-parent="#directory-table" type="button" title="Show More" class="btn btn-primary btn-sm table-btn"><span><i class="fa fa-info" aria-hidden="true"></i></span>
					</button>
					<button type="button" title="Edit Record" class="btn btn-primary btn-sm table-btn edit-record-btn" value="' . $row['fid'] . '"><span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
					</button>
					<button type="button" title="Delete Record" class="btn btn-danger btn-sm table-btn delete-record-btn" value="' . $row['fid'] . '"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span>
					</button>
				</td>
			</tr>
			<tr id="records-accordian' . $row['fid'] . '" class="collapse">
				<td colspan="7" align="center">
					<div class="card">
						<div class="card-block">
							<div class="row">
								<div class="col-md-6 text-right card-left">
									<h4 class="card-title">
									' . $row['first_name'] . ' ' . $row['last_name'] . '<br>
									</h4>
									<h6 class="card-subtitle">
									' . $row['company'] . '<br><br>
									</h6>
								</div>
								<div class="col-md-6 text-left">
									<p class="card-text">
									' . $row['street'] . '<br>
									' . $row['city'] . ', ' . $row['state'] . ' ' . $row['zip'] . '<br>
									' . $row['email'] . '<br>
									' . $row['phone'] . '<br>
									' . $row['birthday'] . '<br>
									' . $row['association'] . '
									</p>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			';
		}
		
		mysqli_free_result ($r); // Free up the resources.	

	} else { // If it did not run OK.

		// Public message:
		echo '<p class="bg-danger text-white">The current directory could not be retrieved. We apologize for any inconvenience.</p>';
		
		// Debugging message:
		echo '<p class="bg-danger text-white">' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		
	} // End of if ($r) IF.

	mysqli_close($dbc); // Close the database connection.
}

// update an existing record in the db
function updateRecord($bookID, $isbn, $title, $author, $year) {
	require ('includes/mysqli_connect.php'); // Connect to the db.

	if ($isbn == "" && $title == "" && $author == "" && $year == "") {
		echo "<p class='bg-danger text-white'>At least one field must be filled out to update</p>";
	} else {

		$sql = "UPDATE Books 
				SET ISBN = IF('$isbn' = '', ISBN, '$isbn'),
					Author = IF('$author' = '', Author, '$author'),
					Title = IF('$title' = '', Title, '$title'),
					Year = IF('$year' = '', Year, '$year')
				WHERE Book_id = '$bookID'";

		if(mysqli_query($dbc, $sql)) {
		    echo "<p class='bg-success text-white'>Book successfully updated</p>";
		}else {
		    echo "<p class='bg-danger text-white'>Error updating book: " . mysqli_error($dbc) . "</p>";
		}
	}
}

?>