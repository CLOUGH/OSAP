
<html>
<head>
	<meta charset="utf-8"/>
	<title>Course List</title>
	<?php

		include_once '../common/php_class/search_prefrence.php';
		include_once '../common/php_class/course.php';
		include_once '../common/php_class/user.php';
		include_once '../common/php_class/user.php';
		include_once '../common/php_class/requirements.php';

		foreach (glob('../common/php_controller/*.php') as $filename)
		{
		    include $filename;
		}
		session_start();
		$user=$_SESSION['user'];

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
		#Get Course
		$query_course="SELECT c.* FROM course c WHERE c.id =".$course_id;
		$course = new Course();
		$result_set= $db->query($query_course);
		$record= $result_set->fetch_assoc();

	/*--------------------------------------------------------Get Shedules--------------------------------------------------------*/
		$course_schedule_result_set = $db->query("SELECT s.* FROM schedule s WHERE s.course_id =".$record['id'].";");
		for($j=0;$j<$course_schedule_result_set->num_rows; $j++)
		{
			$schedule_row = $course_schedule_result_set->fetch_assoc();

			/*-----------------------------------------------------Get Lectures---------------------------------------------------------*/
			$schedule_lecture_result_set = $db->query("SELECT * FROM lecturer l JOIN lecture_map lm
				ON lm.lecturer_id = l.id WHERE lm.schedule_id=".$schedule_row['id'].";");
			$lecturers = array();
			for($k=0; $k<$schedule_lecture_result_set->num_rows; $k++)
			{
				$lecture_rows = $schedule_lecture_result_set->fetch_assoc();
				$lecturers[$k] = new Lecturer($lecture_rows['id'],$lecture_rows['lecturer_name'],$lecture_rows['email']);
			}
			#Create Schedule class
			$schedule[$j]= new Schedule($schedule_row['id'],$schedule_row['crn'], $schedule_row['day'], $schedule_row['time'],
										$schedule_row['room'],$schedule_row['type'],$lecturers);
		}
		/*-------------------------------------------------Get Comments & Reviews--------------------------------------------------------*/
		$comments_resultset = $db->query("SELECT c.* FROM comments c WHERE c.course_id=".$record['id'].";");
		$comments = array();
		for($i=0; $i<$comments_resultset->num_rows; $i++)
		{
			$comment_row = $comments_resultset->fetch_assoc();
			$comments[$i]= new Comment($comment_row['id'], $comment_row['title'],$comment_row['comment'],$comment_row['commenters_name']
 									,$comment_row['date'],$comment_row['time']);
		}

		/*----------------------------------------------------Get Course Requirements-----------------------------------------------------*/
		#TODO: IMPLEMENT Requirements
		$requirement_resultset = $db->query("SELECT r.* FROM course_requirements r WHERE r.course_id=".$record['id']);
		$requirement_row = $requirement_resultset->fetch_assoc();
		$requirement = new Requirements($requirement_row['id'],$requirement_row['labs'],$requirement_row['tutorial'],$requirement_row['lectures']);


		$course->init($record['id'],$record['title'], $record['code'],$record['subject'],
						$record['credit'], $record['faculty'], $record['simester'],$record['level'],
						$schedule, $record['type'],$record['description'],$comments,$requirement);


		#closing database
		$db->close();

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
					<h3><?php echo $course->getName(); ?></h3>

			</dl>
			<div id="description">
				<h4>Description</h4>
				<!-- TODO: IMPLEMENT DESCRIPTION -->
				<p><?php echo $course->getDescription(); ?><p>
			</div>
			<div id="requirements">
				<h4>Course Requirements</h4>
				<p>Requirements of the course to sucessfully register</p>
				<?php $requirements = $course->getRequirements();?>
				<input type="checkbox" readonly="readonly" />
					<h5 class="inline_heading"><?php echo $requirements->getlectures(); ?></h5> Lectures
				<br>
				<input type="checkbox" readonly="readonly" />
					<h5 class="inline_heading"><?php echo $requirements->getTutorials(); ?></h5> Tutorials
				<br>
				<input type="checkbox" readonly="readonly" />
					<h5 class="inline_heading"><?php echo $requirements->getLabs(); ?></h5> Labs
				<br>

			</div>
			<form method="post" action="../view_recommended_courses/list_course/controller/register.php">
			<div id="schedule">
				<h4>Schedules</h4>
				<table>
					<tr tr id="table_heading">
						<td style="padding-left:0px;">CRN</td>
						<td>Type</td>
						<td>Time</td>
						<td>Day</td>
						<td>Room</td>
						<td>Lecturers</td>
						<td>Register</td>
					</tr>
					<?php
						foreach($course->getSchedules() as $sched){ # Start of loop ?>
						<tr class="row">
							<?php
								echo '<td>'.$sched->getID().'</td>';
							 	echo '<td>'.$sched->getType().'</td>';
							 	echo '<td>'.$sched->getTime().'</td>';
							 	echo '<td>'.$sched->getDay().'</td>';
							 	echo '<td>'.$sched->getRoom().'</td>';
							 	$lecturers_name_list=null;
							 	foreach ($sched->getLecturer() as $lect) {
									$lecturers_name_list.=$lect->getName().", ";
								 }
							 	echo '<td>'.$lecturers_name_list.'</td>';
							 	echo '<td class="checkbox" ><input type="checkbox" name="course[]" value= "'.$course->getName().' '.$sched->getType().' '.$sched->getTime().' '.$sched->getDay(). ' " id="'.$sched->getID().'" />';
							 ?>

						</tr>
					<?php } #End of loop ?>
				</table>
				<input type="submit" id="register" class="button" value="Register" />
			</div>
		</form>
			<h4>Comments</h4>
			<?php foreach ($course->getComments() as $comment) { #Start of loop ?>
			<div class="comment">
				<h5><?php echo $comment->getTitle(); ?></h5>
				<!--Message -->
				<p>
					<?php echo $comment->getComment(); ?>
				</p>
				<div class="commenter_info">
					<p>
						<?php echo $comment->getCommentersName();?>
						<spam class="date"><?php echo $comment->getDate();?></sapm>
					<p>
				</div>
	    	</div>
	    	<?php } #End of Looop ?>
	    	<input type="button" id="AddComment" class="button" value="Add Comment" />
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>
