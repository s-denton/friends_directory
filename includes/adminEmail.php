<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'sendemail') {
    	$ue = $_REQUEST['uemail'];	
		$sub = $_REQUEST['subject'];
		$msg = $_REQUEST['comment'];

		mail('$ue', '$sub', '$msg');
		echo "Your email has been sent.";
		exit;
    }
}

?>