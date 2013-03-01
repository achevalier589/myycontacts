<pre>$_POST: <?php print_r($_POST)?></pre>

<?php
session_start();

require_once('../config/db.php');

$required = array(
		'contact_firstname',
		'contact_lastname',
		'contact_email',
		'contact_phone1',
		'contact_phone2',
		'contact_phone3'
);

// Extract POST data to variables
extract($_POST);

// Validate form data
foreach($required as $r) {
	// If invalid, redirect with message
	if(!isset($_POST[$r]) || $_POST[$r] == '') {
		// Store message into session
		$_SESSION['message'] = array(
				'text' => 'Please enter all required information.',
				'type' => 'block'
		);

		// Store form data into session
		$_SESSION['POST'] = $_POST;

		// Set location header
		header("Location:../?p=form_edit_contact&id=$contact_id");

		// Kill script
		die();
	}
}

// Now that we know all fields have been inputted..




// Connect to the DB
$conn = new mysqli('localhost','mycontacts_user','s9D8HZJ3T8QBtuRZ','mycontacts');

$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;

// Execute the query
$sql = "UPDATE contacts 
		SET contact_firstname='$contact_firstname', contact_lastname='$contact_lastname', contact_email='$contact_email', contact_phone=$contact_phone, group_id=$group_id
		WHERE contact_id=$contact_id";
$conn->query($sql);

if($conn->errno > 0) {
	echo $conn->error;
	echo "<p><strong>SQL:</strong> $sql</p>";
	die();
}

// Close the connection
$conn->close();

$_SESSION['message'] = array(
		'text' => 'Your band has been edited.',
		'type' => 'info'
);

// Redirect
header('Location:../?p=list_contacts');
?>
