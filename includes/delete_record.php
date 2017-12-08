<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?
require ('mysqli_connect.php'); // Connect to the db.

$recordID = $_POST["record_id"];

$sql = "DELETE FROM Directory WHERE fid = '$recordID'";

if(mysqli_query($dbc, $sql)) {
    echo "success";
}else {
    echo "Error deleting song: " . mysqli_error($dbc);
}
?>
</body>
</html>