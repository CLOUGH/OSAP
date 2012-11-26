<?php
include_once 'lecturer.php';
include_once 'schedule.php';
include_once 'comment.php';
include_once 'requirements.php';
#class describing a course object
class Course
{
	private $id;
	private $name;
	private $crn;
	private $code;
	private $subject;
	private $credit;
	private $faculty;
	private $simester;
	private $level;
	private $type;
	private $description;
	private $comments;
	private $requirements;
	/*--------------------------------------------Arrays---------------------------------------*/
	private $pre_requisites; #[pre_requisites]
	public $schedule; #[schedule]
	/*----------------------------------------Contstructor-------------------------------------*/
	public function Course()
	{
		$this->comments= array();

	}
	public function init($id,$name, $code,$subject, $credit, $faculty, $simester, $level,$schedule,
			 $type, $description,$comment_array,$requirements)
	{
		$this->id = $id;
		$this->name = $name;
		$this->code = $code;
		$this->subject= $subject;
		$this->credit = $credit;
		$this->faculty = $faculty;
		$this->simester = $simester;
		$this->level = $level;
		$this->type = $type;
		$this->description = $description;
		$this->comments = $comment_array;

		$this->schedule=$schedule;
		$this->requirements = $requirements;
	}
	/*----------------------------------------Setters-------------------------------------------*/
	public function addSchedule($value)
	{
		echo get_class($value);
		$this->schedule[count($this->schedule)]= $value;
	}

	public function addComment($value)
	{
		$this->comments[count(comments)] =$value;
	}
	public function setName($value)
	{
		$this->name=$value;
	}
	public function setCode($value)
	{
		$this->code=$value;
	}
	public function setSubject($value)
	{
		$this->subject=$value;
	}
	public function setCredit($value)
	{
		$this->credit=$value;
	}
	public function setFaculty($value)
	{
		$this->faculty=$value;
	}
	public function setSimester($value)
	{
		$this->simester=$value;
	}
	public function setLevel($value)
	{
		$this->level=$value;
	}
	public function setLectureName($value)
	{
		$this->lecture_name=$value;
	}
	public function setSchedule($value)
	{
		$this->schedule=$value;
	}
	public function setType($value)
	{
		$this->type=$value;
	}
	public function setID($value)
	{
		$this->id=$value;
	}
	/*----------------------------------------Getters-------------------------------------------*/
	public function getDescription()
	{
		return $this->description;
	}
	public function getRequirements()
	{
		return $this->requirements;
	}
	public function getComments()
	{
		return $this->comments;
	}
	public function getID()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getCode()
	{
		return $this->code;
	}
	public function getSubject()
	{
		return $this->subject;
	}
	public function getCredit()
	{
		return $this->credit;
	}
	public function getFaculty()
	{
		return $this->faculty;
	}
	public function getSimester()
	{
		return $this->simester;
	}
	public function getLevel()
	{
		return $this->level;
	}
	public function getLectureName()
	{
		return $this->lecture_name;
	}
	public function getSchedules()
	{
		return $this->schedule;
	}
	public function getType()
	{
		return $this->type;
	}
	/*----------------------------------------Methods---------------------------------------*/
	public function bareUpdate($course_id)
	{
		#opening database
		@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
		if(mysqli_connect_errno())
		{
		 	echo 'Error: could not connect to database.';
		 	die();
		}
		#bare update method is used for speed and performace update of the course class. Best used in search
		$query_course="SELECT c.* FROM course c WHERE c.id =".$course_id;
		$result_set= $db->query($query_course);
		$record= $result_set->fetch_assoc();

		$this->init($record['id'],$record['title'], $record['code'],$record['subject'],
						$record['credit'], $record['faculty'], $record['simester'],$record['level'],
						null, $record['type'],$record['description'],null,null);

		#closing database
		$db->close();


	}
	public function updateCourse($course_id)
	{
		#opening database
		@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
		if(mysqli_connect_errno())
		{
		 	echo 'Error: could not connect to database.';
		 	die();
		}

		#Get Course
		$query_course="SELECT c.* FROM course c WHERE c.id =".$course_id;

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


		$this->init($record['id'],$record['title'], $record['code'],$record['subject'],
						$record['credit'], $record['faculty'], $record['simester'],$record['level'],
						$schedule, $record['type'],$record['description'],$comments,$requirement);
		#closing database
		$db->close();
	}
	public function getAndUpdateScheudle($sched_id)
	{
		#opening database
		@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
		if(mysqli_connect_errno())
		{
		 	echo 'Error: could not connect to database.';
		 	die();
		}
		/*--------------------------------------------------------Get Shedules--------------------------------------------------------*/
		$query = "SELECT * From schedule s where s.id =".$sched_id.";";

		$course_schedule_result_set = $db->query($query);

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
			$this->addSchedule($schedule[$j]);

		}

		#closing database
		$db->close();
	}
}
?>