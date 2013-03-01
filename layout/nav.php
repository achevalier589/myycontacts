<?php 
// Store the 'p' parameter from the QS into a variable

if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = DEFAULT_PAGE;
}

?>


<div class="navbar">
	<div class="navbar-inner">
		<a class="brand" href="./">MyContacts</a>
		<ul class="nav">
			<?php foreach($pages as $file => $text):
				if($file == $p) {
					$class = 'active'; 
				} else {
					$class = '';
				}	
				if(is_array($text)):?> 
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $file ?></a>
						<ul class="dropdown-menu">
						<?php foreach($text as $page => $name):?>
							<li><a href="./?p=<?php echo $page?>"><?php echo $name ?></a></li>							
						<?php endforeach?>
						</ul>
					</li>				
				<?php else: ?>
					<?php // also try...  http://twitter.github.com/bootstrap/components.html#buttonDropdowns ?>
					<li class="<?php echo $class ?>"><a href="./?p=<?php echo $file ?>"><?php echo $text ?></a></li>
				<?php endif ?>			
			<?php endforeach ?>
			</ul>
				<form method="get" class="form-inline form-search pull-right">
					<input type="hidden" name="p" value="list_contacts" >
					<div class="input-append">
						<input type="text" name="q" />
						<button type="submit"><i class="icon-search"></i></button>
					
					</div>
				</form>
	</div>
</div>
