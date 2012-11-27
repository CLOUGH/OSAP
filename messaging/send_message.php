<?php


	    function died($error) {
        // your error code can go here
        echo "<h1>Sorry</h1> ";
        echo $error;
       
        die();
    }



  if(!isset($_POST['student_id']) ||      
        !isset($_POST['message_type']) ||
        !isset($_POST['message_area'])) {
        died('You didnt fill out the form completely.');       
    }







$student_id = $_POST['student_id'];
$message_type = $_POST['message_type'];
$message_area =  $_POST['message_area'];
$date = $_POST['date'];

function send_message($id, $type, $message, $day)
{

	// $person = $session_name->getFirstName();
	// $serializeArray =serialize($subject);
	/*--------------------------------------------------/
	/				Connects to Database                /
	/--------------------------------------------------*/
	$conn = new mysqli('localhost', 'osap_system', 'pass123', 'osap');


	if (mysqli_connect_errno()) {
	  exit('Connect failed: '. mysqli_connect_error());
	}


		/*--------------------------------------------------/
		/				Updates Message Table               /
		/--------------------------------------------------*/
		$sql = "INSERT INTO `messages` ( `senders_id`, `type`, `message`,`sent_date`)
		VALUES ( '$id', '$type', '$message', '$day')";

		if ($conn->query($sql) === TRUE) {
		  echo 'Successfully sent query : <br />';
			$course_shed = "SELECT * FROM `messages` WHERE senders_id='$id'";


		
		}
		else {
		 echo 'Error: '. $conn->error;
		}

		$conn->close();

		
}


send_message($student_id, $message_type, $message_area, $date);





?>