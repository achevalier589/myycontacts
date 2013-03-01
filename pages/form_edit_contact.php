<?php 
// Connect to the DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Excute SELECT query
$sql = "SELECT * FROM contacts WHERE contact_id={$_GET['id']}";
$results = $conn->query($sql);

// Store the contact data into variables
$contact = $results->fetch_assoc();
extract($contact);

// Close the connection
$conn->close();

?>

<h2>Edit Contact</h2>
<form class="form-horizontal" action="actions/edit_contact.php" method="post">
	<div class="control-group">
		<label class="control-label" for="contact_name">Name</label>
		<div class="controls">
			<?php echo input('contact_firstname', 'first name',$contact_firstname)?>
			<?php echo input('contact_lastname', 'last name',$contact_lastname)?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_email">Email</label>
		<div class="controls">
			<?php echo input('contact_email', 'you@example.com',$contact_email)?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_phone1">Phone</label>
		<div class="controls">
			(<?php echo input('contact_phone1', '999',substr($contact_phone,0,3),'phone span1')?>)
			<?php echo input('contact_phone2', '888',substr($contact_phone,3,3),'phone span1')?> - 
			<?php echo input('contact_phone3', '7777',substr($contact_phone,-4),'phone span2')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="group_id">Group</label>
		<div class="controls">			
			<?php 
				// Connect to DB
				$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
			
				// Query groups table
				$sql = "SELECT * FROM groups ORDER BY group_name";
				$results = $conn->query($sql);
				
				$selected_group_id = $group_id;
				
				$options[0] = 'Select a group';
				// Loop over result set
				while(($group = $results->fetch_assoc()) != null) {
					extract($group);
					
							// value		text
					$options[$group_id] = $group_name;
				}
				echo dropdown('group_id', $options, $selected_group_id);
				
				// Close DB connection
				$conn->close();
			?>
		</div>
	</div>
	<div class="form-actions">
		<input type="hidden" name="contact_id" value="<?php echo $contact_id ?>" />	<!-- $_GET['id'] -->
		<button type="submit" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Confirm Changes</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>
<?php unset($_SESSION['POST']) ?>