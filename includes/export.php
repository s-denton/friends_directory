<?php session_start();
include ('mysqli_connect.php'); // Connect to the db.

$htmloutput = '';
if(isset($_GET["username"])) {
	$username = $_GET["username"];
	$sql = "Select * from Directory WHERE BINARY username = '$username' ORDER BY last_name ASC";
	$result = mysqli_query($dbc, $sql);
	if(mysqli_num_rows($result) > 0) {
		$htmloutput .= '
			<table class="table" bordered="1">
				<tr>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Company</th>
					<th>Street</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Birthday</th>
					<th>Association</th>
				</tr>
		';
		while($row = mysqli_fetch_array($result)) {
			$htmloutput .= '
				<tr>
					<td>'.$row["last_name"].'</td>
					<td>'.$row["first_name"].'</td>
					<td>'.$row["company"].'</td>
					<td>'.$row["street"].'</td>
					<td>'.$row["city"].'</td>
					<td>'.$row["state"].'</td>
					<td>'.$row["zip"].'</td>
					<td>'.$row["email"].'</td>
					<td>'.$row["phone"].'</td>
					<td>'.$row["birthday"].'</td>
					<td>'.$row["association"].'</td>
				</tr>
			';
		}
		$htmloutput .= '</table>';
		header('Content-Type: application/xls');
		header('Content-Disposition: attachment; filename=download.xls');
		echo $htmloutput;
	}
}
?>