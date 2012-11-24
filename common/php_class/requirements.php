<?php
/**
*
*/
class Requirements
{
	private $id;
	private $labs;
	private $tutorials;
	private $lectures;
	function Requirements($id,$labs, $tutorials, $lectures)
	{
		$this->id = $id;
		$this->labs=$labs;
		$this->tutorials=$tutorials;
		$this->lectures=$lectures;
	}
	function getLabs()
	{
		return $this->labs;
	}
	function getTutorials()
	{
		return $this->tutorials;
	}
	function getlectures()
	{
		return $this->lectures;
	}
}
?>