<?php


$choice = $_POST['choice'];

switch ($choice) {
	case 'Send': header( "Location: send_msg.php" );
		
		break;
	// case 'Check': header( "Location: receive_msg.php" );
		
	// 	break;
	default:
		# code...
		break;
}



?>