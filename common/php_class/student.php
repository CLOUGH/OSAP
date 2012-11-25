<?php
include_once 'course_grades.php';
include_once 'course.php';
#student class describing a student
class Student
{
#TODO: complete the student class
	private $id;
	private $faculty;
	private $level;
	private $registered_courses;	#Course[]
	private $majors;	#string[]
	private $minors;		#string[]
	private $credit_count;
	private $course_grades;	#CourseGrades[]
	private $gpa;

	public function Student($id, $user_type)
	{
		@ $db = new MySQLi('localhost', 'osap_system','pass123','osap');
		#display error message if there was an issue opening up the database
		if(mysqli_connect_errno()){
		 	echo 'Error: could not connect to database.';
		 	return false;	}
		$query ="SELECT * FROM students s where ".($user_type=='student'?"s.user_id=":"s.id=").$id.";";
		$result_set = $db->query($query);
		$row = $result_set->fetch_assoc();

		$this->id = $row['id'];
		$this->faculty = $row['registered_faculty'];
		$this->level = $row['year_of_study'];
		$this->majors = array($row['major_1'],$row['major_2']);
		$this->minors = array($row['minor_1'],$row['minor_2']);
		$this->credit_count =$row['credit_count'];


		$query = "SELECT r.student_id, r.schedule_id, c.id FROM registered_courses r
					JOIN schedule s ON s.id = r.schedule_id
					JOIN course c ON c.id = s.course_id
					WHERE r.student_id =".$this->id."
					GROUP BY c.title";
		$result_set = $db->query($query);
		for($i=0; $i<$result_set->num_rows;$i++)
		{
			$row= $result_set->fetch_assoc();
			$this->registered_courses[$i] = new Course();
			$this->registered_courses[$i]->updateCourse($row['id']);
		}

		$query = "SELECT cg.* FROM course_grades cg
					WHERE cg.student_id =".$this->id;
		$result_set = $db->query($query);
		for($i=0; $i<$result_set->num_rows;$i++)
		{
			$row= $result_set->fetch_assoc();
			$course = new Course();
			$course->bareUpdate($row['course_id']);
			$this->course_grades[$i] = new CourseGrades($course,$row['course_grade'],$row['exam_grade']);
		}
		$this->gpa = $this->calculateGPA();
	}
	private function calculateGPA()
	{
		return 0;
	}
	/*----------------------------------Getters--------------------------------------------------------*/
	public function getId()
	{
		return $this->id;
	}
	public function getFaculty()
	{
		return $this->faculty;
	}
	public function getLevel()
	{
		return $this->level;
	}
	public function getMajors()
	{
		return $this->majors;
	}
	public function getMinors()
	{
		return $this->minors;
	}
	public function getCredit()
	{
		return $this->credit_count;
	}
	public function getCourseGrades()
	{
		return $this->course_grades;
	}
	public function getGPA()
	{
		return $this->gpa;
	}
	public function getRegisteredCourses()
	{
		return $this->registered_courses;
	}

}
?>