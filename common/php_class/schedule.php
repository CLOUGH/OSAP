<?php
include_once 'lecturer.php';
class Schedule
{
	private $id;
	private $crn;
	private $day;
	private $time;
	private $room;
	private $type;
	private $lecturer; #Array(new Lecturer())

	/*----------------------------------------Constructor ---------------------------------*/
	public function Schedule($id, $crn, $day, $time, $room, $type, $lecturer)
	{
		$this->id = $id;
		$this->day = $day;
		$this->crn = $crn;
		$this->time = $time;
		$this->room = $room;
		$this->type = $type;
		$this->lecturer = $lecturer;

	}
	public function getCRN()
	{
		return $this->crn;
	}
	public function getID()
	{
		return $this->id;
	}
	public function addLecturer($value)
	{
		$this->lecturer[count(lecturer)] = $value;
	}
	public function getType()
	{
		return $this->type;
	}
	public function getDay()
	{
		return $this->day;
	}
	public function getTime()
	{
		return $this->time;
	}
	public function getRoom()
	{
		return $this->room;
	}
	public function getLecturer()
	{
		return $this->lecturer;
	}
}
?>