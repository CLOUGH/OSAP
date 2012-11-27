<?php
include_once "../common/php_class/user.php";
include_once '../common/php_class/student.php';
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
	$new_password =$_POST["new_password"];
	$confirm_password =$_POST["confirm_password"];
	$EMAIL_PATTERN = "/^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/";

	if(preg_match('/^[a-zA-Z0-9]{4,10}$/', $username))
	{
		$result_set = $db->query("SELECT user_name FROM users");
		for($i=0;$i<$result_set->num_rows;$i++)
		{
			$row = $result_set->fetch_assoc();
			if($row['user_name']==$username)			{
				header('location:edit.php?message='.urlencode("This username already exist please try again"));
				exit();
			}
		}
		$query ="UPDATE users SET user_name='".$username."' WHERE users.user_name ='".$user->getUsername()."'";
		$result_set = $db->query($query);
		$_SESSION['user']->setUsername($username);
	}
	if(!empty($faculty))
	{
		if($faculty=$_SESSION['student']->getFaculty())			{
				header('location:edit.php?message='.urlencode("The faculty entered was the same therefore no changes was made."));
				exit();
		}
		$query = "UPDATE students faculty='".$faculty."' WHERE students.id=".$_SESSION['student']->getId();
		$result_set = $db->query($query);
		$_SESSION['student']->setFaculty($faculty);
	}
	if(!empty($old_password) && !empty($new_password) && !empty($confirm_password))
	{
		$query = "SELECT password FROM users WHERE users.id=".$_SESSION['user']->getID();
		$result_set= $db->query($query);

		$row = $result_set->fetch_assoc();
		if($old_password == $row['password'])
		{
			if($new_password==$confirm_password)
			{
				$query = "UPDATE users SET password='".$new_password."' WHERE users.id=".$_SESSION['user']->getID();
				$result_set = $db->query($query);
			}
			else
			{
				header('location:edit.php?message='.urlencode("The new password entered does not match."));
				exit();
			}
		}
		else
		{
			header('location:edit.php?message='.urlencode("The old password entered does not match."));
			exit();
		}
	}else if(!empty($old_password))
	{
		header('location:edit.php?message='.urlencode("There was an issue with the password entered."));
		exit();
	}
	if(!empty($email))
	{
		if(preg_match($EMAIL_PATTERN, $email))
		{
			$query ="UPDATE users SET email='".$email."' WHERE users.user_name ='".$user->getEmail()."'";
			$result_set = $db->query($query);
			$_SESSION['user']->setEmail($email);
		}
		else
		{
			header('location:edit.php?message='.urlencode("The email is not valid."));
			exit();
		}
	}
	if(empty($username) && empty($faculty) && empty($old_password) && empty($confirm_password) && empty($email))
	{
		header('location:edit.php?message='.urlencode("There was no update submitted."));
		exit();
	}

	header('location:index.php?message='.urlencode("The update was successful."));
?>