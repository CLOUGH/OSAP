<?php 
class Lecturer
{
	private $id;
	private $name;
	private $email;

	public function Lecturer($id,$name,$email)
	{
		$this->id = $id;
		$this->name=$name;
		$this->email=$email;
	}
	public function getID()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getEmail()
	{
		return $this->email;
	}
}
?>