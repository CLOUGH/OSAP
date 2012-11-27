<!DOCTYPE html>
<html>
<head>
	<?php
		include_once '../common/php_class/user.php';
		include_once '../common/php_class/student.php';
		include_once '../common/php_class/course.php';
		include_once '../common/php_class/course_grades.php';
		foreach (glob('../common/php_controller/*.php') as $filename)
		    include_once $filename;
		session_start();
		$user = $_SESSION['user'];
	?>
	<meta charset="utf-8"/>
	<title>Register Course</title>
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/
	main_style.css" />
	<link rel ="stylesheet" type="text/css" href="stylesheet/register_course.css" />
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/navigation_bar.css" />
	<script src="../common/jQuery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="stylesheet/header.js"></script>
	<script type="text/javascript" src="javascript/functions.js"></script>

</head>
<body>
	<?php
		$student = new Student($user->getID(),$user->getType());
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
					<h3 >Register Course</h3>
					<dd><p>This is page displays the the students registered courses</p></dd>
				</dt>
			</dl>
			Registered courses
				<table>

				<tr id="table_heading">
					<th>Course Code</th>
					<th>Name</th>
					<th>Subject</th>
					<th>Level</th>
					<th>Faculty</th>
					<th>Semester</th>
					<th></th>
				</tr>
				<?php $i=0;	foreach($student->getRegisteredCourses() as $course){ ?>
					<tr class="rows" onclick=<?php echo $i++ ?> >
						<td><?php echo $course->getCode(); ?></td>
						<td><?php echo $course->getName(); ?></td>
						<td><?php echo $course->getSubject(); ?></td>
						<td><?php echo $course->getLevel(); ?></td>
						<td><?php echo $course->getFaculty(); ?></td>
						<td><?php echo $course->getSimester(); ?></td>
						<td><input type="button" value="View Schedule" onclick="toggleTable('course_id<?php echo $course->getId(); ?>')" /></td>
					</tr>

					<tr>
						<table id="course_id<?php echo  $course->getId(); ?>" style="margin-left:50px;display:none">


						<?php foreach ($course->getSchedules() as $sched) {?>
							<tr>
							 	<td><?php echo $sched->getType()?></td>
							 	<td><?php echo $sched->getTime()?></td>
							 	<td><?php echo $sched->getDay()?></td>
							 	<td><?php echo $sched->getRoom()?></td>
							 	<?php $lecturers_name_list=null;
							 	foreach ($sched->getLecturer() as $lect) {
									$lecturers_name_list.=$lect->getName().", ";
								 }?>
							 	<td><?php echo $lecturers_name_list; ?></td>
						 	</tr>
						<?php }?>
						</table>
					</tr>
				<?php } ?>
				</table>
			</p>
			<h4>Regiter Course</h4>
			<p>
				Add the schedule id of the course you would like to register for.
			</p>
			<form method="POST" action="reg_by_shedID.php">
				<p>
					<input class="schedule_fields" type="text" name="field1"/>
					<input class="schedule_fields" type="text" name="field2"/>
					<input class="schedule_fields" type="text" name="field3"/>
					<input class="schedule_fields" type="text" name="field4"/>
				</p>
				<p>
					<input type="submit" value="Submit" name="submit"/>
				</p>
			</form>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>