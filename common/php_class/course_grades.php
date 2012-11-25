<?php
include_once 'course.php';
class CourseGrades
{
	private $course;
	private $course_work_grade;
	private $exam;
	public function CourseGrades($course,$course_grade, $exam)
	{
		$this->course = $course;
		$this->course_work_grade = $course_grade;
		$this->exam = $exam;
	}
	public function getCourse()
	{
		return $this->course;
	}
	public function getExamGrades()
	{
		return $this->exam;
	}
	public function getCourseGrades()
	{
		return $this->course_work_grade;
	}
}
?>