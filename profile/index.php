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
	<link rel ="stylesheet" type="text/css" href="../common/stylesheet/
	main_style.css" />
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
					<h3 >Profile</h3>
					<dd><p>This is the profile page of a a the student</p></dd>
				</dt>
			</dl>

			<p>
				Username: <?php echo $user->getUsername();?>

			</p>
			<p>
				ID: <?php echo $student->getId(); ?>
			</p>
			<p>
				First Name: <?php echo $user->getFirstName(); ?>
			</p>
			<p>
				Middle Name: <?php echo $user->getMiddleName(); ?>
			</p>
			<p>
				Last Name: <?php  echo $user->getLastName(); ?>
			</p>
			<p>
				Date of Birth: <?php echo $user->getDateOfBirth(); ?>
			</p>
			<p>
				Email: <?php  echo  $user->getEmail(); ?>
			</p>
			<p>
				Faculty: <?php echo $student->getFaculty(); ?>
			</p>
			<p>
				Majors:
				<?php
					foreach($student->getMajors() as $major)
					echo $major." ";
				?>
			</p>
			<p>
				Minor:
				<?php
					foreach($student->getMinors() as $minor)
					echo $minor." ";
				?>
			</p>
			<p>
				Level: <?php echo $student->getLevel(); ?>
			</p>
			<p>
				GPA: <?php echo $student->getGPA(); ?>
			</p>
			<p>
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
			<p>
				Course Grades
				<table>
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

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>