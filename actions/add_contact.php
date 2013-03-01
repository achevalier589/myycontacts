<?php session_start() ?>

<!-- <pre><?php print_r($_POST) ?></pre> -->



<?php
require_once('../config/db.php');
require_once('fields.php');

// Extract POST data to variables
extract($_POST);

// // Combine phone numbers
// $_POST['contact_phone'] = $_POST['contact_phone1'] + $_POST['contact_phone2'] + $_POST['contact_phone3'];


// foreach($fields as $f) {		// numeric and length is 10
// 	if($f['required']) {
// 		if($f['type'] == 'numeric') {
// 		//  if not set      or  there is nothing there or its not a number      or the length isn't 10
// 			if(!isset($_POST[$f]) || $_POST[$f] == '' || !is_numeric($_POST[$f]) || $f['length'] == $_POST[$f]) {
// 				$_SESSION['message'] = array(
// 					'text' => 'Please enter your phone number correctly',
// 					'type' => 'block'
// 				);
				
// 				// Store form data into session
// 				$_SESSION['POST'] = $_POST;
				
// 				// Set location header
// 				header('Location:../?p=form_add_contact');
				
// 				// Kill script
// 				die();
// 			}
// 		}
// 		if($f['type'] == 'string') {
// 			if(!isset($_POST[$f]) || $_POST[$f] == '') {
// 				// Store message into session
// 				$_SESSION['message'] = array(
// 						'text' => 'Please enter all required information.',		/// work!!!
// 						'type' => 'block'
// 				);
			
// 				// Store form data into session
// 				$_SESSION['POST'] = $_POST;
			
// 				// Set location header
// 				header('Location:../?p=form_add_contact');
			
// 				// Kill script
// 				die();
// 			}
// 		}
		
// 	}
// }



$required = array(
	'contact_firstname',
	'contact_lastname',
	'contact_email',
	'contact_phone1',	
	'contact_phone2',
	'contact_phone3'
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
		header('Location:../?p=form_add_contact');
		
		// Kill script
		die();
	}
}

// Now that we know all fields have been inputted..

// Connect to DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;

// Execute query
$sql = "INSERT INTO contacts (contact_firstname,contact_lastname,contact_email,contact_phone,group_id) VALUES ('$contact_firstname','$contact_lastname','$contact_email',$contact_phone,$group_id)";
$conn->query($sql);

if($conn->errno > 0) {
	echo $conn->error;
}

// Close DB connection
$conn->close();

$_SESSION['message'] = array(
	'text' => 'Your contact has been added.',
	'type' => 'success'
);

// Redirect to the main page
header('Location:../?p=list_contacts');




