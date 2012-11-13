<?php
include_once 'lecturer.php';
include_once 'schedule.php';
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
	/*--------------------------------------------Arrays---------------------------------------*/
	private $pre_requisites; #[pre_requisites]
	public $schedule; #[schedule]
	/*----------------------------------------Contstructor-------------------------------------*/
	public function Course()
	{

	}
	public function init($id,$name, $code,$subject, $credit, $faculty, $simester, $level,$schedule,
			 $type, $description)
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

		$this->schedule=$schedule;
	}
	/*----------------------------------------Setters-------------------------------------------*/
	public function addSchedule($value)
	{
		$this->schedule[count($this->schedule)]= $value;
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
	/*----------------------------------------Sub Classes---------------------------------------*/


}
?>