<?php session_start();

// insert update record form info into database
include ('mysqli_connect.php');

$record_id = $_POST["record_id"];
$first_name = trim($_POST["first_name"]);
$last_name = trim($_POST["last_name"]);
$company = trim($_POST["company"]);
$street = trim($_POST["street"]);
$city = trim($_POST["city"]);
$state = trim($_POST["state"]);
$zip = trim($_POST["zip"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$bday = trim($_POST["bday"]);
$assoc = $_POST["assoc"];
$error = '';

if(!empty($first_name)) {
	if(!preg_match('/^[A-Za-z ]+$/', $first_name)) {
		$error .= 'First Name is incorrect<br>';
	}
}

if(!empty($last_name)) {
	if(!preg_match('/^[A-Za-z ]+$/', $last_name)) {
		$error .= 'Last Name is incorrect<br>';
	}
}

if(!empty($company)) {
	if(!preg_match('/^[\w.- ]+$/', $company)) {
		$error .= 'Company is incorrect<br>';
	}
}

if(!empty($street)) {
	if(!preg_match('/^[0-9A-Za-z ]+$/', $street)) {
		$error .= 'Street is incorrect<br>';
	}
}

if(!empty($city)) {
	if(!preg_match('/^[A-Za-z ]+$/', $city)) {
		$error .= 'City is incorrect<br>';
	}
}

if(!empty($state)) {
	if(!preg_match('/^[A-Z]{2}$/', $state)) {
		$error .= 'State is incorrect format<br>';
	}
}

if(!empty($zip)) {
	if(!preg_match('/^[0-9]{5}$/', $zip)) {
		$error .= 'Zip is incorrect format<br>';
	}
}

if(!empty($email)) {
	if(!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $email)) {
		$error .= 'Email is incorrect format<br>';
	}
}

if(!empty($phone)) {
	if(!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
		$error .= 'Phone is incorrect format<br>';
	}
}

if(!empty($bday)) {
	if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $bday)) {
		$error .= 'Birthday is incorrect format<br>';
	}
}

if(!empty($assoc)) {
	if(!preg_match('/^[a-z]+$/i', $assoc)) {
		$error .= 'Association is incorrect<br>';
	}
}

if($error) {
	echo $error;

} else {

	$sql = "UPDATE Directory 
			SET first_name = IF('$first_name' = '', first_name, '$first_name'),
				last_name = IF('$last_name' = '', last_name, '$last_name'),
				company = IF('$company' = '', company, '$company'),
				street = IF('$street' = '', street, '$street'),
				city = IF('$city' = '', city, '$city'),
				state = IF('$state' = '', state, '$state'),
				zip = IF('$zip' = '', zip, '$zip'),
				email = IF('$email' = '', email, '$email'),
				phone = IF('$phone' = '', phone, '$phone'),
				birthday = IF('$bday' = '', birthday, '$bday'),
				association = IF('$assoc' = 'undefined', association, '$assoc')
			WHERE fid = '$record_id'";

	if(mysqli_query($dbc, $sql)) {
		echo "success";
	}else {
		die(header("HTTP/1.0 404 Not Found"));
	}
}
?>