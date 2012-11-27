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
	<title>Messaging</title>
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
					<dd><p>Select a Section Below:</p></dd>
				</dt>
			</dl>
			<form method="post" action="choice.php">
				<select name="choice">
					<option value="">(Select)</option>
					<option value="Send">Send A Message</option>
					<option value="Check">Check Inbox</option>
				</select>
				<input type="submit" value="Submit" class="submit">
			</form>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>