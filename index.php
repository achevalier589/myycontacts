<?php 
// Must be called 1st to have access to any session data
session_start();

// "Import" functions	 (like it was typed all write here)
require('config/db.php');
require('config/app.php');
require('lib/functions.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css" />
		
		<!-- MyContact CSS -->
		<link rel="stylesheet" type="text/css" href="styles.css" />
		
		<!-- jQuery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		
		<!-- Bootstrap JS -->
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- My JS -->
		<script src="mycontacts.js"></script>
		
		<title>My Contacts</title>
	</head>
	<body>
		<div id="wrapper" class="container" >
			<header>
				<?php include('layout/header.php')?>	
				<!-- All of the content in the file 
						listed is copied right here -->
			</header>
			<nav>
				<?php include('layout/nav.php')?>	
			</nav>
			<section role="main">
				<?php include('layout/main.php')?>	
			</section>
			<footer>
				<?php include('layout/footer.php')?>	
				
			</footer>
		</div>
	</body>
</html>