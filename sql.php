<?php
include_once 'sqlConfig.php';
function sql($query)
{
	if (isset($GLOBALS['sql_conn'])){
		$conn = $GLOBALS['sql_conn'];
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$results = $conn->query($query);
		$output = array();
		if (!$results) {
	    	trigger_error('Invalid query: ' . $conn->error);
		}
		else {
			if (is_object($results)){
				if ($results->num_rows > 0)
				{
					while ($row = $results->fetch_assoc())
					{
						array_push($output, $row);
					}
				}
			}
		}
		return $output;
	}
}
?>