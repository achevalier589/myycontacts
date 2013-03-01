<h2>New Group</h2>
<form class="form-horizontal" action="actions/add_group.php" method="post">
	<div class="control-group">
		<label class="control-label" for="group_name">Name</label>
		<div class="controls">
			<?php echo input('group_name', 'group name')?>
		</div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i> Add Group</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>
