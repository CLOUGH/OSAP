<?php
include_once '../common/php_class/user.php';
include_once '../common/php_class/student.php';
foreach (glob('../common/php_controller/*.php') as $filename)
	include_once $filename;
session_start();
// username and password sent from form
$myusername=$_POST['username'];
$mypassword=$_POST['password'];

function getCurrentLocation()
{
	$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	if ($_SERVER["SERVER_PORT"] != "80")
	{
	    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else
	{
	    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}


function login($myusername,$mypassword)
{

$host="localhost"; // Host name
$username="osap_system"; // Mysql username
$password="pass123"; // Mysql password
$db_name="osap"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
$connection = mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db($db_name,$connection)or die("cannot select DB");
// To protect MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE user_name='$myusername' and password='$mypassword'";

$result=mysql_query($sql,$connection);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1)
{
	// Register the user class User as 'user' and redirect to file "login_success.php"
	$selected_user =  mysql_fetch_array($result);
	$user = new User($selected_user ['id'], $selected_user ['user_name'],$selected_user ['first_name'],
		$selected_user ['last_name'],$selected_user ['middle_name'],$selected_user ['date_of_birth'],
		$selected_user ['email'],$selected_user ['type']);
	#get the main dir of the application
	$current_location = getCurrentLocation();
	$main_location = substr($current_location, 0,strpos($current_location, '/login'));

	$_SESSION['main_location'] = $main_location;
	$_SESSION['user'] = $user;
	$student = new Student($user->getID(), $user->getType());
	$_SESSION['student'] = $student;
	header("location:../home");
	}
else {
	echo '<script type="text/javascript">';
	echo 'alert("Invalid Login")';
	echo '</script>';
	include("index.html");
	}
}

login($myusername,$mypassword);
?>