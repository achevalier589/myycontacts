<?php 
// Fetch the name of the group with the id that's in the QS
extract($_GET);

// Connect to the DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$sql = "SELECT group_name FROM groups WHERE group_id=$id";
$results = $conn->query($sql);
$group = $results->fetch_assoc();

?>

<h2><?php echo $group['group_name'] ?></h2>
<table class="table table-hover">
	<thead>
		<tr>
			<th>First</th>
			<th>Last</th>
			<th>Email</th>
			<th>Phone</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	
	
	
	<?php
	// Connect to the database
	//      new mysqli( host,       user,             password,          db name    )
	$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	// Read (SELECT) contacts from the database			exclude quotes
	
	$sql = "SELECT * FROM contacts WHERE group_id=$id ORDER BY contact_lastname ASC, contact_firstname";
								//		 contact_phone IS NULL
								//		 contact_phone 4026794965
	$results = $conn->query($sql);		// in java would be conn.query		function on conn
	
	// If there was a MySQL error on the last query,
	// display error and kill the currnet script
	if($conn->errno > 0) {
		echo $conn->error;
		die();		// die() stops execute of the rest of the code
	}
	
	// Loop over the contacts & display them
	//		fetches the next row from the results set as associative array
	// assicative array			* returns null when there are no more results in result set	
	while(($contact = $results->fetch_assoc()) != null) {
		extract($contact);
		?>
		
		<tr>
			<td><?php echo $contact_firstname ?></td>
			<td><?php echo $contact_lastname ?></td>
			<td><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email?></a></td>	
			<td><?php echo format_phone($contact_phone) ?></td>
			<?php 	$onclick = "return confirm('Are you sure you want to delete $contact_firstname?')"?>
			<td>
				<a class="btn btn-warning" href="./?p=form_edit_contact&id=<?php echo $contact_id?>"><i class="icon-edit icon-white"></i></a> 
				<form class="form-inline" action="actions/delete_contact.php" method="post">
					<input type="hidden" name="contact_id" value="<?php echo $contact_id?>" />
					<button onclick="$onclick" class="btn btn-danger" type="submit"><i class="icon-trash icon-white"></i></button>
				</form>
			</td>
			
				
	 
				 
		 </tr>
	<?php }?>
	</tbody>
</table>	
<?php $conn->close();?>
