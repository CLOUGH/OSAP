
<html>
<head>
	<meta charset="utf-8"/>
	<title>Course List</title>
	<?php
		include_once '../common/php_class/search_prefrence.php';
		include_once '../common/php_class/course.php';
		session_start();
	?>
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/
	main_style.css" />
	<link rel ="stylesheet" type="text/css" href="stylesheet/
	course.css" />
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/navigation_bar.css" />
	<script src="../common/jQuery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="stylesheet/header.js"></script>

</head>
<body>
	<?php
		if(isset($_SESSION['search_prefrence']))
		{
			$search_prefrence = $_SESSION['search_prefrence'];
		}else{
			echo "<p>An error has occured. No prefrence was set.</p>";
			die();
		}
		#opening database
		@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
		if(mysqli_connect_errno())
		{
		 	echo 'Error: could not connect to database.';
		 	die();
		}

		$course_id=$_GET['course_id'];
		$query_course="SELECT c.* FROM course c WHERE c.id =".$course_id;
		$course = new Course();

		$result_set= $db->query($query_course);
		$record= $result_set->fetch_assoc();
		#get schedule
		$course_schedule_result_set = $db->query("SELECT s.id, s.day, s.time, s.room, s.type FROM schedule s WHERE s.course_id =".$record['id'].";");
		for($j=0;$j<$course_schedule_result_set->num_rows; $j++)
		{
			$schedule_row = $course_schedule_result_set->fetch_assoc();

			#Get Lectures
			$schedule_lecture_result_set = $db->query("SELECT * FROM lecturer l JOIN lecture_map lm
				ON lm.lecturer_id = l.id WHERE lm.schedule_id=".$schedule_row['id'].";");
			$lecturers = array();
			for($k=0; $k<$schedule_lecture_result_set->num_rows; $k++)
			{
				$lecture_rows = $schedule_lecture_result_set->fetch_assoc();
				$lecturers[$k] = new Lecturer($lecture_rows['id'],$lecture_rows['lecturer_name'],$lecture_rows['email']);
			}

			$schedule[$j]= new Schedule($schedule_row['id'], $schedule_row['day'], $schedule_row['time'], $schedule_row['room'],$schedule_row['type'],$lecturers);

		}
		$course->init($record['id'],$record['crn'],$record['title'], $record['code'],$record['subject'],
						$record['credit'], $record['faculty'], $record['simester'],$record['level'],
						$schedule, $record['type']);

		#closing database
		$db->close();

	?>
	<div class="wrapper">
		<div class="header" >
			<div class="notification">
				<spam id="user_name">My Name</spam>
				<a href="#" ><img id="mail_img" src="../common/images/e_mail_16x16.png" /></a>
			</div>
			<h1 id="test">Student Online Advisory Portal</h1>
			<nav>
				<ul>
					<li><a href="">Home</a></li>
					<li><a href="">Profile Management</a>
						<ul class="drop_down_list">
							<li><a href="">View Student Profile</a></li>
							<li><a href="">Edit Personal Profile</a></li>
							<li><a href="">Update Security</a></li>
						</ul>
					</li>
					<li><a href=""  >Course Advisory</a>
						<ul class="drop_down_list" >
							<li><a href="">Get Recommended</a></li>
							<li><a href="">Review Course</a></li>
							<li><a href="">Compare Course Timetables</a></li>
						</ul>
					</li>
					<li><a href="">Register</a>
						<ul class="drop_down_list">
							<li><a href="">Register Course</a></li>
							<li><a href="">Request Override</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
		<div class="content" >
			<dl>
				<dt>
					<h3><?php echo $course->getName(); ?></h3>
			</dl>
			<div id="description">
				<h4>Description</h4>
				<!-- TODO: IMPLEMENT DESCRIPTION -->
				<p> This is a description of the course<p>
			</div>
			<div id="recommended_schedule">
				<h4>Recommended Schedules</h4>
				<table>
					<tr tr id="table_heading">
						<td>Type</td>
						<td>Time</td>
						<td>Day</td>
						<td>Room</td>
						<td>Lecturers</td>
					</tr>
					<?php
						foreach($course->getSchedules() as $sched){ # Start of loop ?>
						<tr>
							<?php
							 	echo '<td>'.$sched->getType().'</td>';
							 	echo '<td>'.$sched->getTime().'</td>';
							 	echo '<td>'.$sched->getDay().'</td>';
							 	echo '<td>'.$sched->getRoom().'</td>';
							 	$lecturers_name_list=null;
							 	foreach ($sched->getLecturer() as $lect) {
									$lecturers_name_list.=$lect->getName().", ";
								 }
							 	echo '<td>'.$lecturers_name_list.'</td>';
							 ?>
						</tr>
					<?php } #End of loop ?>
				</table>
			</div>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>