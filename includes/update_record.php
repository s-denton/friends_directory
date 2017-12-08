<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?
// insert update record form info into database
include ('mysqli_connect.php');

$record_id = $_POST["record_id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$company = $_POST["company"];
$street = $_POST["street"];
$city = $_POST["city"];
$state = $_POST["state"];
$zip = $_POST["zip"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$bday = $_POST["bday"];
$assoc = $_POST["assoc"];

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
			association = IF('$assoc' = '', association, '$assoc')
		WHERE fid = '$record_id'";

if($result = $dbc -> query($sql)) {
	echo "success";
}else {
	die(header("HTTP/1.0 404 Not Found"));
}
?>
</body>
</html>