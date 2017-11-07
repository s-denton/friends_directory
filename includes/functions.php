<?php
// authenticate login information
function authenticate($login_username, $login_password) {
	require ('includes/mysqli_connect.php');

	$sql = "SELECT uid FROM Users WHERE BINARY username = '$login_username' and password = '$login_password'";
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

// delete a book from the db
function deleteRecord($bookID) {
	require ('includes/mysqli_connect.php'); // Connect to the db.

	$sql = "DELETE FROM Books WHERE Book_id = '$bookID'";

	if(mysqli_query($dbc, $sql)) {
	    echo "<p class='bg-success text-white'>Book successfully deleted</p>";
	}else {
	    echo "<p class='bg-danger text-white'>Error deleting book: " . mysqli_error($dbc) . "</p>";
	}

}

// insert a new entry into the db
function insertRecord($fname, $lname, $company, $street, $city, $state, $zip, $email, $phone, $bday, $assoc) {
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

	$insert_sql = "INSERT INTO Directory (first_name, last_name, company, street, city, state, zip, email, phone, birthday, association) VALUES ('$fname', '$lname', '$company', '$street', '$city', '$state', '$zip', '$email', '$phone', '$bday', '$assoc')";

	// check for connection to database, else error
	if (mysqli_query($dbc, $insert_sql)) {
		echo "<script>location='directory.php'</script>";
	} else {
		echo "<br> <p class='bg-danger text-white'>Error Occured</p>";	
	}

}

// populate a dropdown list of books
function isbnList() {
	require ('includes/mysqli_connect.php'); // Connect to the db.

	// Make the query:
	$q = "SELECT * FROM Books ORDER BY ISBN ASC";		
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.
		
		// Fetch and print all the records:
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			echo '<option value="' . $row['Book_id'] . '">' . $row['ISBN'] . '</option>';
		}
		
		mysqli_free_result ($r); // Free up the resources.	

	} else { // If it did not run OK.

		// Public message:
		echo '<p class="bg-danger text-white">The books list could not be retrieved.</p>';
		
		// Debugging message:
		echo '<p class="bg-danger text-white">' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		
	} // End of if ($r) IF.

	mysqli_close($dbc); // Close the database connection.
}

// display the records in the db
function showAllRecords() {
	// This script retrieves all the records from the users table.

	require ('includes/mysqli_connect.php'); // Connect to the db.
			
	// Make the query:
	$q = "SELECT * FROM Directory ORDER BY last_name ASC";		
	$r = @mysqli_query ($dbc, $q); // Run the query.

	if ($r) { // If it ran OK, display the records.
		
		// Fetch and print all the records:
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			echo '
			<tr data-toggle="collapse" data-target="#records-accordian' . $row['fid'] . '" class="clickable">
				<td align="left">' . $row['last_name'] . '</td>
				<td align="left">' . $row['first_name'] . '</td>
				<td align="left">' . $row['email'] . '</td>
				<td align="left">' . $row['phone'] . '</td>
				<td align="left">' . $row['association'] . '</td>
				<td colspan="2" align="center">
					<button type="button" title="Edit Record" class="btn btn-primary btn-sm row-icon" value="' . $row['fid'] . '"><span><i class="fa fa-pencil-square-o table-icon" aria-hidden="true"></i></span>
					</button>
					<button type="button" title="Delete Record" class="btn btn-danger btn-sm row-icon" value="' . $row['fid'] . '"><span><i class="fa fa-trash-o table-icon" aria-hidden="true"></i></span>
					</button>
				</td>
			</tr>
			<tr id="records-accordian' . $row['fid'] . '" class="collapse">
				<td colspan="5">
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
		echo '<p class="bg-danger text-white">The current books could not be retrieved. We apologize for any inconvenience.</p>';
		
		// Debugging message:
		echo '<p class="bg-danger text-white">' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		
	} // End of if ($r) IF.

	mysqli_close($dbc); // Close the database connection.
}

// update an existing book in the db
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