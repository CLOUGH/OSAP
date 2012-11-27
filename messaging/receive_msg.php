

<!DOCTYPE html>
<html>
<head>
	<?php
		include_once '../common/php_class/user.php';
		include_once '../common/php_class/student.php';
		foreach (glob('../common/php_controller/*.php') as $filename)
		    include_once $filename;

		session_start();
		$user = $_SESSION['user'];
		$student =$_SESSION['student'];
		$student_id = $student->getId();

	$conn = new mysqli('localhost', 'osap_system', 'pass123', 'osap');
		$connection = mysql_connect('localhost', 'osap_system', 'pass123', 'osap')or die("cannot connect");
		mysql_select_db('osap',$connection)or die("cannot select DB");

		if (mysqli_connect_errno()) {
		  exit('Connect failed: '. mysqli_connect_error());
		}

		$reg_courses1 = "SELECT * FROM `registered_courses` WHERE student_id='$session_name' and schedule_id='$subject'";


		$results = mysql_query($reg_courses1,$connection);
		$count=mysql_num_rows($results);

		if ($count == 0 ){
			/*--------------------------------------------------/
			/				Updates Course Info                 /
			/--------------------------------------------------*/
			$sql = "INSERT INTO `registered_courses` ( `student_id`, `schedule_id`)
			VALUES ( '$session_name', '$subject')";

			if ($conn->query($sql) === TRUE) {
			  echo 'Successfully Registered For Course: <br />';
				$course_shed = "SELECT * FROM `schedule` WHERE id='$subject'";


				$shed_result = mysql_query($course_shed,$connection);
				$res=mysql_fetch_array($shed_result);
				echo $res['day'].', '.$res['time'].', '.$res['room'].', '.$res['type'];

			}
			else {
			 echo 'Error: '. $conn->error;
			}

			$conn->close();

			}
			else{
				echo "Already Registered For This Course: <br /> <br />";
				$course_shed = "SELECT * FROM `schedule` WHERE id='$subject'";


				$shed_result = mysql_query($course_shed,$connection);
				$res=mysql_fetch_array($shed_result);
				echo $res['day'].', '.$res['time'].', '.$res['room'].', '.$res['type'];
			}



	?>
	<meta charset="utf-8"/>
	<title>Home</title>
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/
	main_style.css" />
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/navigation_bar.css" />
	<script src="../common/jQuery/jquery-1.8.2.js"></script>
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
			
					<h3>Message Inbox</h3>
				
				
		</div>
		<table>
			<tr>
				<td>Sender</td>
				<td>Type</td>
				<td>Date</td>

			</tr>



		</table>	

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>