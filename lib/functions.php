<?php
function connect() {
	return new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
}


function format_phone($phone) {
	return '<a href="tel:'.$phone.'">('.substr($phone,0,3).') '.substr($phone,3,3).'-'.substr($phone,-4).'</a>';
}


/**
 * Generates an HTML input element with the given attribute values.
 * This function also examines SESSION data for previously
 * entered values with the same name
 * @param unknown_type $name
 * @param unknown_type $placeholder
 */
function input($name, $placeholder, $value='', $class='') {  // $value is an optional input paramter!!!!!!
	if($value == '' && isset($_SESSION['POST'][$name])) {
		$value = $_SESSION['POST'][$name];		// 2D array
		
		// Remove from session data
		unset($_SESSION['POST'][$name]);

		if($value == '') {		// nothing was entered for this item
			$class .= ' error';
		}
	}
	return "<input class=\"$class\" type=\"text\" name=\"$name\" placeholder=\"$placeholder\" value=\"$value\" />";
}

/**
 * Generates an HTML <select> element with the given name attribute and option elements
 * If a value is provided, the corresponding <option> is marked as selected.
 * If a value is not provided (null), and session data is present, session value is used.
 * This function also examines session data for a previously submitted value
 * @param String $name Name attribute
 * @param Array $options Array of options in the form value => text
 * @return HTML select element
 */
function dropdown($name, $options, $group_id = 0) {
	$select = "<select name=\"$name\">";
	// Add option elements to select element
	foreach($options as $value => $text) {		// to use a 'forech' loop $options has to be an array
		//    array     key(1)   value(Jan)
		
		// If there is session form data for $name, AND its value
		// is the same as the current array element, select it
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name] == $value) {
			unset($_SESSION['POST'][$name]);
			$selected = 'selected="selected"';
		} else if($group_id == $value) { 
			$selected = 'selected="selected"';
		} else {
			$selected = '';
		}
		$select .= "<option $selected value=\"$value\">$text</option>";    
	}
	$select .= "</select>";
	echo $select;
}

/**
 * Generates an HTML radio buttons with the given name attrtibute and options
 * This function also examines session data for a previously submitted value
 * @param String $name Name attribute
 * @param Array $options Array of options in the form value => text
 * @return HTML input[type=radio] elements, wrapped in labels
 */
function radio($name, $options) {
	$radio = '';
	
	// Loop over options of the associative array
	foreach($options as $value => $text) {		// to use a 'forech' loop $options has to be an array
		//    array     key(1)   value(Jan)
		
		// If there is session form data for $name, AND its value
		// is the same as the current array element, select it
		if(isset($_SESSION['POST'][$name]) && $_SESSION['POST'][$name] == $value) {
			unset($_SESSION['POST'][$name]);
			$checked = 'checked="checked"';
		} else {
			$checked = '';
		}			// order of attributes within an opening tag does not matter
		$radio .= "<label><input type=\"radio\" name=\"$name\" $checked value=\"$value\">$text</label>";
	}
	echo $radio;
}

/**
 * Query the provided table for all rows, sorted by name using the fields
 * table_id and table_name
 * @param unknown_type $table name of DB table
 * @param unknown_type $default_value value of first option (1st key in array)
 * @param unknown_type $default_name name of the first option (1st value in array)
 */
function get_options($table, $default_value=0,$default_name='Select') {
	$options = array($default_value => $default_name);
	
	// Field names
	$id_field = $table.'_id';
	$name_field = $table.'_name';
	
	// Connect to DB
	$conn = connect();
	
	// Query table for id's and names
	$sql = "SELECT $id_field, $name_field FROM {$table}s ORDER BY $name_field";
	$results = $conn->query($sql);
	
	// Loop over result set, adding all rows to $options
	while (($row = $results->fetch_assoc()) != null) {
		$key = $row[$id_field];
		$value = $row[$name_field];
		$options[$key] = $value;
	}
	
	// Close DB connection
	$conn->close();
	
	// Return options
	return $options;
}

?>











