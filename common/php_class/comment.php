<?php
class Comment
{
	private $id;
	private $title;
	private $comment;
	private $commenters_name;
	private $date;
	private $time;

	public function Comment( $id,$title,$comment,$commenters_name,$date,$time)
	{
		$this->id = $id;
		$this->title=$title;
		$this->comment =$comment;
		$this->commenters_name = $commenters_name;
		$this->date = $date;
		$this->time= $time;
	}
	function getID()
	{
		return $this->id;
	}
	function getTitle()
	{
		return $this->title;
	}
	function getComment()
	{
		return $this->comment;
	}
	function getCommentersName()
	{
		return $this->commenters_name;
	}
	function getDate()
	{
		return $this->date;
	}
	function getTime()
	{
		return $this->time;
	}


}
?>
