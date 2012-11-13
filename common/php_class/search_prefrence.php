<?php
#PHP Class that describes a search prefrence
class CourseSearchPrefrence
{
	private $course_name;
	private $course_code;
	private $subject;
	private $course_credit_range; #[min,max]
	private $faculty;
	private $degree_name;
	private $simester;
	private $year_of_degree;
	private $lecture_name;
	private $time; #[max, min]
	private $lecture_gender;
	private $max_class_duration;
	private $lab_course;

	/*--------------------------------Constructors----------------------------------*/
	
	function __construct()
	{
		# code...
	}
	/*-----------------------------------Setters-----------------------------------*/
	public function setCourseName($value)
	{
		$this->course_name=$value;
	}
	public function setCourseCode($value)
	{
		$this->course_code=$value;
	}
	
	public function setSubject($value)
	{
		$this->subject=$value;
	}
	public function setCourseCreditRange($min_value,$max_value)
	{
		$this->course_credit_range= array("min"=>$min_value,"max"=>$max_value);
	}
	public function setFaculty($value)
	{
		$this->faculty=$value;
	}
	public function setDegreeName($value)
	{
		$this->degree_name = $value;
	}
	
	public function setSimester($value)
	{
		$new_value = $value;
		switch($value)
		{
			case 'First Simester':
				$new_value = 1;
				break;
			case 'Second Simester':
				$new_value = 2;
				break;
			case 'Summer':
				$new_value= 3;
				break;
		}
		$this->simester = $new_value;
	}
	public function setYearOfDegree($value)
	{
		$new_value = $value;
		switch($value)
		{
			case '1st':
				$new_value = 1;
				break;
			case '2nd':
				$new_value = 2;
				break;
			case '3rd':
				$new_value= 3;
				break;
				case '1st':
			case '4th':
				$new_value = 4;
				break;
			case '5th':
				$new_value= 5;
				break;
			case '6th':
				$new_value= 6;
				break;
			case '7th':
				$new_value= 7;
				break;
		}
		$this->year_of_degree = $new_value;
	}
	public function setLectureName($value)
	{
		$this->lecture_name =$value;
	}
	public function setTime($min_value,$max_value)
	{
		$this->time = array('min'=>$min_value, 'max'=>$max_value);
	}
	public function setMaxClassDuration($value)
	{
		$this->max_class_duration = $value;
	}
	public function setLabCourse($value)
	{
		$this->lab_course = $value;	
	}
	public function setLectureGender($value)
	{
		$this->lecture_gender = $value;
	}
	/*------------------------------------------GETTERS----------------------------------------*/
	public function getCourseName()
	{
		return $this->course_name;
	}
	public function getSubject()
	{
		return $this->subject;
	}
	/*----------------------------------------METHODS------------------------------------------*/
	public function numArgumentSet()
	{
		$num_set=0;
		$num_set = !empty($this->course_name) ?$num_set+1: $num_set;
		$num_set = !empty($this->course_code) ?$num_set+1: $num_set;
		$num_set = !empty($this->subject) ?$num_set+1: $num_set;
		$num_set = !empty($this->course_credit_range['min']) && !empty($this->course_credit_range['max']) ?$num_set+1: $num_set; #[min,max]
		$num_set = !empty($this->faculty) ?$num_set+1: $num_set;
		$num_set = !empty($this->degree_name) ?$num_set+1: $num_set;
		$num_set = !empty($this->simester) ?$num_set+1: $num_set;
		$num_set = !empty($this->year_of_degree) ?$num_set+1: $num_set;
		$num_set = !empty($this->lecture_name) ?$num_set+1: $num_set;
		$num_set = !empty($this->time['max'])&& !empty($this->time['min']) ?$num_set+1: $num_set; #[max, min]
		$num_set = !empty($this->lecture_gender) ?$num_set+1: $num_set;
		$num_set = !empty($this->max_class_duration) ?$num_set+1: $num_set;
		$num_set = !empty($this->lab_course) ?$num_set+1: $num_set;

		echo "number argument used: ".$num_set;
		return $num_set;
	}
	private function getArgumentUsed()
	{
		
		$i=0;
		if(!empty($this->course_name))
			$args[$i++] = 'course_name';
		if(!empty($this->course_code))
			$args[$i++]= 'course_code';
		if(!empty($this->subject))
			$args[$i++]='subject';
		if(!empty($this->course_credit_range['min']) && !empty($this->course_credit_range['max']))
			$args[$i++]= 'course_credit_range';
		if(!empty($this->faculty))
			$args[$i++]= 'faculty';
		if(!empty($this->degree_name))
			$args[$i++]= 'degree_name';
		if( !empty($this->simester))
			$args[$i++]='simester';
		if(!empty($this->year_of_degree))
			$args[$i++]= 'year_of_degree';
		if(!empty($this->lecture_name))
			$args[$i++]= 'lecture_name';
		if(!empty($this->time['max'])&& !empty($this->time['min']))
			$args[$i++]= 'time';
		if(!empty($this->lecture_gender))
			$args[$i++]= 'lecture_gender';
		if(!empty($this->max_class_duration))
			$args[$i++]= 'max_class_duration';
		if(!empty($this->lab_course))
			$args[$i++]= 'lab_course';

		return $args;
	}
	public function generateQuery()
	{
		$arg_used = $this->getArgumentUsed();
		$query = "SELECT * FROM course ".(count($arg_used)>0 ?"WHERE ":'');

		for($i=0; $i<count($arg_used); $i++)
		{	
			switch($arg_used[$i])
			{
				case 'course_name':
					$query= $query."title LIKE '%".$this->course_name."%' AND ";

					break;
				case 'course_code':
					$query=$query. "code LIKE '%".$this->course_code."%' AND ";
					break;
				case 'subject':
					$query= $query."subject LIKE '%".$this->subject."%' AND ";
					break;
				case 'course_credit_range':
					$query= $query."credit >='".$this->course_credit_range['min']."' AND 
									credit <='".$this->course_credit_range['max']."' AND ";
					break;
				case 'faculty':
					if($this->faculty!="ALL")
					$query= $query."faculty LIKE '%".$this->faculty."%' AND ";
					break;
				case 'degree_name':
					break;
				case 'simester':
					if($this->simester!="ALL")
						$query= $query."simester='".$this->simester."' AND ";
					break;
				case 'year_of_degree':
					if($this->year_of_degree!="ALL")
						$query= $query."level='".$this->year_of_degree."' AND ";
					break;
				case 'lecture_name':
					#TODO: IMPLEMENT QUERY 
					break;
				case 'time':
					break;
				case 'lecture_gender':
					break;
				case 'max_class_duration':

					break;
				case 'lab_course':
					break;
			}

		}
		echo $query=substr($query,0,strrpos($query, 'AND',-1));
		return $query;
	}
	private function died($error) {
		// your error code can go here
		echo "<h1>Sorry</h1> ";
		echo $error;
		
		die();
	}
}
?>