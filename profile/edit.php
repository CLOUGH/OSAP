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
					<h3 >Edit Profile</h3>
					<dd><p>This is the profile page of a a the student</p></dd>
				</dt>
			</dl>
			<?php if (isset($message)): ?>
				<p><?php echo $message ?></p>
			<?php endif ?>
			<form method="post" action="update_profile.php">
				<p>
					Email:
					<input type="text" name="email"/>
				</p>
				<p>
					Faculty:
					<input type="text" name="faculty" />
				</p>
				<p>
					Username:
					<input type="text" name="username"/>
				</p>
				<p>
					Old Password
					<input type="password" name="old_password">
				</p>
				<p>
					New Password
					<input type="password" name="new_password">
				</p>
				<p>
					Confrim Password
					<input type="password" name="confirm_password">
				</p>

				<input type="submit" value="Update" />
			</form>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>