
<html>
<head>
	<meta charset="utf-8"/>
	<title>Course List</title>
	<?php
		include_once '../../common/php_class/search_prefrence.php';
		include_once 'controller/get_recommended.php';
		include_once '../../common/php_class/course.php';
		include_once '../../common/php_class/user.php';

		foreach (glob('../../common/php_controller/*.php') as $filename)
		{
		    include $filename;
		}
		session_start();
		$user = $_SESSION['user'];
	?>
	<link rel ="stylesheet" type="text/css" href="../../common/stylesheet/
	main_style.css" />
	<link rel ="stylesheet" type="text/css" href="stylesheet/
	course_list.css" />
	<link rel ="stylesheet" type="text/css" href="../../common/stylesheet/navigation_bar.css" />
	<script src="../../common/jQuery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="stylesheet/header.js"></script>

</head>
<body>
	<?php
		#Initialize variables that where posted to this php file through form
		$search_prefrence = new CourseSearchPrefrence();
		$search_prefrence->setCourseName($_POST['course_name']);
		$search_prefrence->setCourseCode($_POST['course_code']);
		$search_prefrence->setSubject($_POST['subject']);
		$search_prefrence->setCourseCreditRange($_POST['credit_range_min'], $_POST['credit_range_max']);
		$search_prefrence->setFaculty($_POST['faculty']);
		$search_prefrence->setDegreeName($_POST['degree_name']);
		$search_prefrence->setSimester($_POST['simester']);
		$search_prefrence->setYearOfDegree($_POST['year_of_degree']);
		$search_prefrence->setLectureName($_POST['lecture_name']);
		$search_prefrence->setTime($_POST['time_range_min'],$_POST['time_range_max']);
		$search_prefrence->setMaxClassDuration($_POST['max_class_duration']);
		$search_prefrence->setScheduleType($_POST['schedule_type']);

		$_SESSION['search_prefrence'] = $search_prefrence;

		$courses = get_course_list($search_prefrence);

	?>
	<div class="wrapper">
		<div class="header" >
			<?php echo get_notification_bar($user->getFirstName(),$user->getLastName()); ?>
			<h1 id="test">Student Online Advisory Portal</h1>
			<?php echo get_navigation_bar($user->getType()); ?>
		</div>
		<div class="content" >
			<dl>
				<dt>
					<h3 >Recomended Courses</h3>

			</dl>
			<div id="side_bar">

			</div>
			<table id="course_list" border="0" cellspacing="0" cellpadding="4">
				<tr id="table_heading">
					<td>Course Code</td>
					<td>Name</td>
					<td>Subject</td>
					<td>Credits</td>
					<td>Level</td>
					<td>Faculty</td>
					<td>Simester</td>
				</tr>

			<?php for($i=0; $i<count($courses); $i++)
			{ #Start of Loop
				$onclick_row = "window.location='../../course/?course_id=".$courses[$i]->getID()."'";
			?>

				<tr class="rows" onclick=<?php echo $onclick_row ?> >
					<td><?php echo $courses[$i]->getCode(); ?></td>
					<td><?php echo $courses[$i]->getName(); ?></td>
					<td><?php echo $courses[$i]->getSubject(); ?></td>
					<td><?php echo $courses[$i]->getCredit(); ?></td>
					<td><?php echo $courses[$i]->getLevel(); ?></td>
					<td><?php echo $courses[$i]->getFaculty(); ?></td>
					<td><?php echo $courses[$i]->getSimester(); ?></td>
				</tr>
			<?php } #End of Loop?>
			</table>

		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>
