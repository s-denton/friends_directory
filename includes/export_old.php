<?php session_start();

header("Content-Type: text/csv; charset=utf-8");
    header("Content-Dispostion: attachment; filename=directory.csv");
    $output = fopen("php://output", "w");
    fputcsv($output, array('First Name', 'Last Name', 'Company', 'Street', 'City', 'State', 'Zip', 'Email', 'Phone', 'Birthday', 'Association'));
    $sql = "Select * from Directory WHERE BINARY username = '$username' ORDER BY last_name ASC";
    $result = mysqli_query($dbc, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);

/*


include ('mysqli_connect.php'); // Connect to the db.

$sql = "Select * from Directory WHERE BINARY username = '$username' ORDER BY last_name ASC";
//execute query 
$result = @mysqli_query($dbc, $sql) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_errno());

$FilZ
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysqli_num_fields($result); $i++) {
echo mysqli_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : false;
}

?>


<?php session_start();

$username = $_POST["username"];

/*******EDIT LINES 3-8*******/
$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "steve"; //MySQL Username     
$DB_Password = "infosys"; //MySQL Password     
$DB_DBName = "friends"; //MySQL Database Name
$filename = "directory"; //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "Select * from Directory WHERE BINARY username = '$username' ORDER BY last_name ASC";
$Connect = @mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysqli_error() . "<br>" . mysqli_errno());
//select database   
$Db = @mysqli_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysqli_error(). "<br>" . mysqli_errno());   
//execute query 
$result = @mysqli_query($Connect, $sql) or die("Couldn't execute query:<br>" . mysqli_error(). "<br>" . mysqli_errno());    
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysqli_num_fields($result); $i++) {
echo mysqli_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : false;
}

?>