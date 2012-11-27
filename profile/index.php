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
	<title>Profile</title>
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/main_style.css" />
	<link rel ="stylesheet" type="text/css" href="stylesheet/profile.css" />
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/navigation_bar.css" />
	<script src="../common/jQuery/jquery-1.8.2.js"></script>
	<script type="text/javascript" src="stylesheet/header.js"></script>
	<script type="text/javascript" src="javascript/functions.js"></script>

</head>
<body>
	<?php
		$student = new Student($user->getID(),$user->getType());
		$message = isset($_GET['message'])?$_GET['message']:null;
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
					<h3 >Profile</h3>
					<dd><p>This is the profile page of a a the student</p></dd>
				</dt>
			</dl>
			<div id="main-content">
				<?php if (isset($message)): ?>
					<p><?php echo $message ?></p>
				<?php endif ?>

				<p class="fields">
					<span class="label">Username:</span><br />
					<span class="values"><?php echo $user->getUsername();?></span>
				</p>
				<p class="fields">
					<span class="label">ID Number: </span><br/>
					<span class="values"><?php echo $student->getId(); ?></span>
				</p>
				<p class="fields" style="clear:both">
					<span class="label">First Name:</span><br />
					<span class="values"><?php echo $user->getFirstName(); ?></span>
				</p>
				<p class="fields">
					<span class="label">Middle Name:</span><br />
					<span class="values"><?php echo $user->getMiddleName(); ?></span>
				</p>
				<p class="fields">
					<span class="label">Last Name:</span><br />
					<span class="values"><?php  echo $user->getLastName(); ?></span>
				</p>
				<p class="fields" style="clear:both">
					<span class="label">Date of Birth:</span><br />
					<span class="values"><?php echo $user->getDateOfBirth(); ?></span>
				</p>
				<p class="fields" style="clear:both">
					<span class="label">Email:</span><br />
					<span class="values"><?php  echo  $user->getEmail(); ?></span>
				</p>
				<p class="fields" style="clear:both">
					<span class="label">Faculty:</span><br />
					<span class="values"><?php echo $student->getFaculty(); ?></span>
				</p>

				<?php foreach($student->getMajors() as $major): ?>
					<?php if(!empty($major)):?>
						<p class="fields" style="clear:both">
							<span class="label">Major:</span><br />
							<span class="values"><?php echo $major; ?></span>
						</p>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php foreach($student->getMinors() as $minor): ?>
					<?php if(!empty($minor)):?>
						<p class="fields" style="clear:both">
							<span class="label">Minor:</span><br />
							<span class="values"><?php echo $minor; ?></span>
						</p>
					<?php endif; ?>
				<? endforeach;?>

				<p class="fields" style="clear:both">
					<span class="label">Level:</span><br />
					<span class="values"><?php echo $student->getLevel(); ?></span>
				</p>
				<p class="fields" >
					<span class="label">GPA:</span><br />
					<span class="values"><?php echo $student->getGPA(); ?></span>
				</p>
				<p style="clear:both">
					<h4>Registered courses</h4>
					<br>
					<table id="registered_courses"  border="0" cellspacing="0" cellpadding="0">

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
							<td size="100"><?php echo $course->getName(); ?></td>
							<td><?php echo $course->getSubject(); ?></td>
							<td><?php echo $course->getLevel(); ?></td>
							<td><?php echo $course->getFaculty(); ?></td>
							<td><?php echo $course->getSimester(); ?></td>
							<td><input type="button" value="View Schedule" onclick="toggleTable('course_id<?php echo $course->getId(); ?>')" /></td>
						</tr>

						<tr>
							<table class="schedule-table" id="course_id<?php echo $course->getId(); ?>" border="0" cellspacing="0" cellpadding="2">

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
				<p style="clear:both">
					<h4>Course Grades</h4>
					<br>
					<table class="grades-table">
					<tr id="table_heading">
						<th>Course Code</th>
						<th>Name</th>
						<th>Subject</th>
						<th>Level</th>
						<th>Faculty</th>
						<th>Semester</th>
						<th>Course Grade</th>
						<th>Exam Grade</th>
						<th>Final Grade</th>
						<th>GPA</th>
					</tr>
					<?php $i=0;
						foreach($student->getCourseGrades() as $course_grades){
							$course = $course_grades->getCourse();
						 ?>
						<tr class="rows" onclick=<?php echo $i++ ?> >

							<td><?php echo $course->getCode(); ?></td>
							<td><?php echo $course->getName(); ?></td>
							<td><?php echo $course->getSubject(); ?></td>
							<td><?php echo $course->getCredit(); ?></td>
							<td><?php echo $course->getFaculty(); ?></td>
							<td><?php echo $course->getSimester(); ?></td>
							<td><?php echo $course_grades->getCourseGrades();?></td>
							<td><?php echo $course_grades->getExamGrades();?></td>
							<td><?php echo $course_grades->getExamGrades()+$course_grades->getCourseGrades(); ?></td>
						</tr>
					<?php } ?>
					</table>
				</p>
				<a href="edit.php">Edit Profile</a>
			</div>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>