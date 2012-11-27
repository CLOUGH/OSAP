<?php
function get_notification_bar($first_name,$last_name)
{
	$main_location = $_SESSION['main_location'];
	$notification_bar_html_markup =
		'<div class="notification">
			<spam id="user_name">'.
			$first_name.' '.$last_name.'
			</spam>
			<a href="../messaging/index.php" >
				<img id="mail_img" src="'.$main_location.'/common/images/e_mail_16x16.png" />
			</a>
			<a href="'.$main_location.'/login/logout.php" >
				<img id="logout_img" src="'.$main_location.'/common/images/logout_16x16.png" />
			</a>
		</div>';

	return $notification_bar_html_markup;
}
?>