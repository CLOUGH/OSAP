<!DOCTYPE html>
<html>
<head>
	<?php
		include_once '../common/php_class/user.php';
		foreach (glob('../common/php_controller/*.php') as $filename)
		    include_once $filename;

		session_start();
		$user = $_SESSION['user'];
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
					<h3 >Home</h3>
					<dd><p>This is the home for the profile</p></dd>
				</dt>
			</dl>
		</div>

		<div class="footer">
			<a href="">Home</a>
		</div>
	</div>


</body>
</html>