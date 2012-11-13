<?php
/***********************Connect to MySQL***********************************/
function connect($database_address, $username, $password, $table)
{	
	@$database_connection = new mysqli('localhost',, );


	return $database_connection;
}

?>
