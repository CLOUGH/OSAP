<!DOCTYPE html>
<html>
<head>


<?php
include_once '../../../common/php_class/user.php';
foreach (glob('../../../common/php_controller/*.php') as $filename)
include_once $filename;

	
session_start();
$user = $_SESSION['user'];
	$subject = array() ;

	foreach($_POST['course']  as  $payamt)  {
		 array_push($subject, $payamt);
	}

?>
	<meta charset="utf-8"/>
	<title>Home</title>
	<link rel ="stylesheet" type="text/css" href="../../../common/stylesheet/
	main_style.css" />
	<link rel ="stylesheet" type="text/css" href="../../../common/stylesheet/navigation_bar.css" />
	<script src="../../../common/jQuery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="stylesheet/header.js"></script>

</head>
<body>
	<div class="wrapper">
			<div class="header" >
				<?php echo get_notification_bar($user->getFirstName(),$user->getLastName()); ?>
				<h1 id="test">Student Online Advisory Portal</h1>
				<?php echo get_navigation_bar($user->getType()); ?>
			</div>
			<div class="content" >

<?php

		

/*--------------------------------------------------/
/			Function to Register for Courses        /
/--------------------------------------------------*/
function register($subject, $session_name){

$person = $session_name->getFirstName();
$serializeArray =serialize($subject); 
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
$sql = "UPDATE registered_courses SET Courses = '$serializeArray' WHERE user_name='$person'"; 

if ($conn->query($sql) === TRUE) {
  echo 'Successfully Registered For Course: <br />';
  for ($i=0; $i < count($subject) ; $i++) { 
  	echo $subject[$i].'<br/>';
  }


}
else {
 echo 'Error: '. $conn->error;
}

$conn->close();



}


register($subject, $user);



?>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>