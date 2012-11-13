<?php
session_start();


/*--------------------------------------------------/
/			Function to Register for Courses        /
/--------------------------------------------------*/
function register($subject, $session_name){


/*--------------------------------------------------/
/				Connects to Database                /
/--------------------------------------------------*/
$conn = new mysqli('localhost', 'root', '', 'osap');

if (mysqli_connect_errno()) {
  exit('Connect failed: '. mysqli_connect_error());
}

/*--------------------------------------------------/
/				Updates Course Info                 /
/--------------------------------------------------*/
$sql = "UPDATE users SET Courses = '$subject' WHERE Username='$session_name'"; 

if ($conn->query($sql) === TRUE) {
  echo 'Successfully Registered For Course:'.' '.$subject;
}
else {
 echo 'Error: '. $conn->error;
}

$conn->close();



}
foreach($_POST['course']  as  $value)  {
		$subject.= "$value\n";
	}
$session_name = $_SESSION['username'];

register($subject, $session_name);

var_dump($subject);
?>