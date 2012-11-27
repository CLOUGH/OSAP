<?php
include_once "../common/php_class/user.php";
session_start();
#opening database
	@$db = new MySQLi('localhost', 'osap_system','pass123','osap');
	if(mysqli_connect_errno())
	{
	 	echo 'Error: could not connect to database.';
	 	die();
	}
	$user =$_SESSION['user'];
	$username = strtolower($_POST["username"]);
	$email = $_POST["email"];
	$faculty = $_POST["faculty"];
	$old_password = $_POST["old_password"];
	$new_password =$_POST["confirm_password"];

	if(preg_match('/^[a-zA-Z0-9]{4,10}$/', $username))
	{
		$result_set = $db->query("SELECT user_name FROM users");
		foreach($result_set->fetch_assoc() as $row)
		{
			echo '<script type="text/javascript">';
			echo 'alert("reach")';
			echo '</script>';
			if($row==$username)
			{
				echo  '<script type="text/javascript">alter("That username is already in use.")</script>';
				header('Location:/index.php');
			}
		}
		$query ="UPDATE users SET user_name='".$username."' WHERE users.user_name ='".$user->getUsername()."'";
		var_dump($query);
		$result_set = $db->query($query);
		var_dump($username);

	}
	header('location:index.php');
	$query ="UPDATE user
			SET user_name=value, column2=value2,...
WHERE some_column=some_value";
?>