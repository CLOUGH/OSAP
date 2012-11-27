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
			<dl>
				<dt>
					<h3>Messaging</h3>
					<dd><p>Use the Form Below to send your Query</p></dd>
				</dt>
			</dl>
			<form method="post" action="send_message.php">
				<p>
					Student ID:
					<input type="text" value="<?php echo $student_id; ?>" name="student_id" readonly="readonly">
				</p>
				<p>
					Type of Message:
					<select name="message_type">
						<option value="">(Select an Option)</option>
						<option value="Help with Registration">Help with Registration</option>
						<option value="Course Query">Course Query</option>
						
					</select>
				</p>
				<p>
					Current Date:
					<input type="text" name="date" value="<?php echo date("Y/m/d");?>"  readonly="readonly">

				</p>
				<p>
					Message:
				</p>
					<textarea name="message_area" rows="20" cols="80">

					</textarea>
				</p>
				

				<input type="submit" value="Update">
			</form>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>