<?php session_start() ?>

<!-- <pre><?php print_r($_POST) ?></pre> -->



<?php
require_once('../config/db.php');
require_once('fields.php');

// Extract POST data to variables
extract($_POST);

$required = array(
	'group_name'
);

// Validate form data
foreach($required as $r) {
	// If invalid, redirect with message
	// if not set    or  there is nothing in there
	if(!isset($_POST[$r]) || $_POST[$r] == '') {
		// Store message into session
		$_SESSION['message'] = array(
			'text' => 'Please enter all required information.',
			'type' => 'block'
		);
		
		// Store form data into session
		$_SESSION['POST'] = $_POST;
		
		// Set location header
		header('Location:../?p=form_add_group');
		
		// Kill script
		die();
	}
}

// Now that we know all fields have been inputted..

// Connect to DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
// Execute query
$sql = "INSERT INTO groups (group_name) VALUES ('$group_name')";
$conn->query($sql);

if($conn->errno > 0) {
	echo $conn->error;
}

// Close DB connection
$conn->close();

$_SESSION['message'] = array(
	'text' => 'Your group has been added.',
	'type' => 'success'
);

// Redirect to the main page
header('Location:../?p=list_contacts');




