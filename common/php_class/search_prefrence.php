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
	private $schedule_type;

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
	public function setScheduleType($value)
	{
		$this->schedule_type = $value;
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
		$num_set = !empty($this->schedule_type) ?$num_set+1: $num_set;

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
		if(!empty($this->schedule_type))
			$args[$i++]= 'schedule_type';

		return $args;
	}
	public function courseListQuery()
	{
		$arg_used = $this->getArgumentUsed();
		$query = "SELECT c.*, simester FROM course c
				JOIN schedule s ON s.course_id=c.id
				JOIN lecture_map lm ON lm.schedule_id = s.id
				JOIN lecturer l ON l.id =lm.lecturer_id
				WHERE " ;
		for($i=0; $i<count($arg_used); $i++)
		{
			switch($arg_used[$i])
			{
				case 'course_name':
					$query= $query."c.title LIKE '%".$this->course_name."%' AND ";

					break;
				case 'course_code':
					$query=$query. "c.code LIKE '%".$this->course_code."%' AND ";
					break;
				case 'subject':
					$query= $query."c.subject LIKE '%".$this->subject."%' AND ";
					break;
				case 'course_credit_range':
					$query= $query."c.credit >='".$this->course_credit_range['min']."' AND
									c.credit <='".$this->course_credit_range['max']."' AND ";
					break;
				case 'faculty':
					if($this->faculty!="ALL")
					$query= $query."c.faculty LIKE '%".$this->faculty."%' AND ";
					break;
				case 'degree_name':
					#TODO Implement
					break;
				case 'simester':
					if($this->simester!="ALL")
						$query= $query."c.simester='".$this->simester."' AND ";
					break;
				case 'year_of_degree':
					if($this->year_of_degree!="ALL")
						$query= $query."c.level='".$this->year_of_degree."' AND ";
					break;
				case 'lecture_name':
					#TODO: IMPLEMENT QUERY
					$query= $query."l.lecturer_name='".$this->lecture_name."' AND ";
					break;
				case 'time':
					break;
				case 'lecture_gender':
					break;
				case 'max_class_duration':

					break;
				case 'schedule_type':
					if($this->schedule_type!='ALL')
						$query= $query."s.type='".$this->schedule_type."' AND ";
					break;
			}


		}
		$query=substr($query,0,strrpos($query, 'AND',-1));
		echo $query=$query." GROUP BY c.code";

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