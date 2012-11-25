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
					<td>Course Code</td>
					<td>Name</td>
					<td>Subject</td>
					<td>Level</td>
					<td>Faculty</td>
					<td>Simester</td>
				</tr>
				<?php $i=0;	foreach($student->getRegisteredCourses() as $course){ ?>
					<tr class="rows" onclick=<?php echo $i++ ?> >
						<td><?php echo $course->getCode(); ?></td>
						<td><?php echo $course->getName(); ?></td>
						<td><?php echo $course->getSubject(); ?></td>
						<td><?php echo $course->getLevel(); ?></td>
						<td><?php echo $course->getFaculty(); ?></td>
						<td><?php echo $course->getSimester(); ?></td>
					</tr>
				<?php } ?>
				</table>
			</p>
			<p>
				Course Grades
				<table>
				<tr id="table_heading">
					<td>Course Code</td>
					<td>Name</td>
					<td>Subject</td>
					<td>Level</td>
					<td>Faculty</td>
					<td>Simester</td>
					<td>Course Grade</td>
					<td>Exam Grade</td>
					<td>Final Grade</td>
					<td>GPA</td>

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
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>