<?php
include_once '../../common/php_class/search_prefrence.php';
include_once '../../common/php_class/course.php';
function get_course_list($search_prefrence)
{
	@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
	$course = array(new Course());
	#display error message if there was an issue opening up the database
	if(mysqli_connect_errno())
	{
	 	echo 'Error: could not connect to database.';
	 	return false;
	}
	$num = $search_prefrence->numArgumentSet();
	$query = $search_prefrence->generateQuery();
	$result_set = $db->query($query);

	for($i=0;$i<$result_set->num_rows;$i++)
	{
		$row = $result_set->fetch_assoc();
		$course[$i] = new Course();
		$course[$i]->init($row['crn'],$row['title'], $row['code'],$row['subject'], 
						$row['credit'], $row['faculty'], $row['simester'],$row['level'],
						'new Schedule()', $row['type']);		
	}
	return $course;
}

?>