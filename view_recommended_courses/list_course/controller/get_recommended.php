<?php
include_once '../../common/php_class/search_prefrence.php';
include_once '../../common/php_class/course.php';
include_once '../../common/php_class/schedule.php';
include_once '../../common/php_class/lecturer.php';
function get_course_list($search_prefrence)
{
	session_start();
	@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
	
	$course = array();
	#display error message if there was an issue opening up the database
	if(mysqli_connect_errno())
	{
	 	echo 'Error: could not connect to database.';
	 	return false;
	}
	$_SESSION['db'] = $db;
	$num = $search_prefrence->numArgumentSet();
	$query = $search_prefrence->courseListQuery();
	$result_set = $db->query($query);

	for($i=0;$i<$result_set->num_rows;$i++)
	{

		$row = $result_set->fetch_assoc();
		$course[$i] = new Course();		
		$course_schedule_result_set = $_SESSION['db']->query("SELECT s.id, s.day, s.time, s.room, s.type FROM schedule s WHERE s.course_id =".$row['id'].";");
		$schedule= array();
		
		/*#get schedule
		for($j=0;$j<$course_schedule_result_set->num_rows; $j++)
		{
			
			$schedule_row = $course_schedule_result_set->fetch_assoc();
			$schedule_lecture_result_set = $db->query("SELECT * FROM lecturer l JOIN lecture_map lm 
				ON lm.lecturer_id = l.id WHERE lm.schedule_id=".$schedule_row['id'].";");			
			$lecturers = array();

			#Get Lectures
			for($k=0; $k<$schedule_lecture_result_set->num_rows; $k++)
			{
				$lecture_rows = $schedule_lecture_result_set->fetch_assoc();
				$lecturers[$k] = new Lecturer($lecture_rows['id'],$lecture_rows['lecturer_name'],$lecture_rows['email']);
				echo '<p>'.$lecturers[$k]->getName().'</p>';
			}
			$schedule[$j]= new Schedule($schedule_row['id'], $schedule_row['day'], $schedule_row['time'], $schedule_row['room'],$lecturers);
		}*/
		$course[$i]->init($row['id'],$row['crn'],$row['title'], $row['code'],$row['subject'], 
						$row['credit'], $row['faculty'], $row['simester'],$row['level'],
						$schedule, $row['type']);		
	}	
	
	$db->close();
	return $course;
}

?>