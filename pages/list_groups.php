<h2>Groups</h2>

<ul class="nav nav-pills nav-stacked">
	<?php 
	// Connect to DB
	$conn = connect(); 
	
	// Query groups
	$sql = 'SELECT groups.*, COUNT(contact_id) AS num_contacts FROM groups LEFT JOIN contacts ON groups.group_id=contacts.group_id GROUP BY group_id ORDER BY group_name';
	$results = $conn->query($sql);
	
	// Loop over results set
	while(($group = $results->fetch_assoc()) != null) {
		extract($group);
		?>
		<li><span class="badge pull-right"><?php echo $num_contacts ?></span><a href="./?p=group&id=<?php echo $group_id ?>"><?php echo $group_name?></a></li>		
	<?php	
	}	
$conn->close() ?>
</ul>