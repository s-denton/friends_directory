<?php

if (isset($_POST['action'])) {	//checking whic button has been clicked
    switch ($_POST['action']) {
        case 'add':
            add();
            break;
        case 'update':
            update();
            break;
        case 'delete':
            delete();
            break;
    }
}


function add(){	
include('mysqli_connect.php'); // Connect to the db.

$uname = $_REQUEST['username'];	//receive nput from ajax
$pass = $_REQUEST['password'];
$fname = $_REQUEST['firstname'];
$lname = $_REQUEST['lastname'];
$em = $_REQUEST['email'];
$r = $_REQUEST['role'];

		$insert_sql = "INSERT INTO users (username, password, firstname, lastname, email, role) VALUES ('$uname', '$pass', '$fname', '$lname', '$em', '$r')";
		if(mysqli_query($dbc, $insert_sql)){

		 	echo "The new user has been created successfully"; //if sql is successful
		}
		else{
			echo "Error. The User could NOT be created!"; //if sql fails
		}
	exit;
}


function update(){

include('mysqli_connect.php'); // Connect to the db.

$uname = $_REQUEST['username'];	//receive nput from ajax
$pass = $_REQUEST['password'];
$fname = $_REQUEST['firstname'];
$lname = $_REQUEST['lastname'];
$em = $_REQUEST['email'];
$r = $_REQUEST['role'];
	
	$check_sql= "SELECT * FROM users WHERE username='$uname'";
	$check_r = mysqli_query($dbc, $check_sql);
	if(mysqli_num_rows($check_r) > 0){
		$update_sql = "UPDATE users SET
			password= IF('$pass'='', password, '$pass'),
			firstname= IF('$fname'='', firstname, '$fname'),
			lastname= IF('$lname'='', lastname, '$lname'),
			email= IF('$em'='', email, '$em'),
			role= IF('$r'='', role, '$r')
			WHERE username='$uname'";
		if(mysqli_query($dbc, $update_sql)){
		 	echo "The record has been updated successfully"; //if sql is successful
		}
	}
	else{
		echo "Error. Something went wrong!"; //if sql fails
		}
	exit;
}


function delete(){	
include('mysqli_connect.php'); // Connect to the db.

$uname = $_REQUEST['username'];	//receive nput from ajax
$pass = $_REQUEST['password'];
$fname = $_REQUEST['firstname'];
$lname = $_REQUEST['lastname'];
$em = $_REQUEST['email'];
$r = $_REQUEST['role'];

		$delete_sql = "DELETE FROM users WHERE username='$uname' AND password='$pass' AND firstname='$fname' AND lastname='$lname' AND email='$em' AND role='$r'";
		mysqli_query($dbc, $delete_sql);

		if(mysqli_affected_rows($dbc)){
		 	echo "The record has been deleted successfully"; //if sql is successful
		}
		else{
			echo "Error. Something went wrong!"; //if sql fails
		}
	exit;
}

?>