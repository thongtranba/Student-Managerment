<?php 
class Register {
	protected $student_id;
	protected $subject_id;
	protected $score;
	protected $student_name;
	protected $subject_name;

	function __construct($student_id, $subject_id, $score,$student_name, $subject_name) {
		$this->student_id = $student_id;
		$this->subject_id = $subject_id;
		$this->score = $score;
		$this->student_name = $student_name;
		$this->subject_name = $subject_name;
	}

	function getStudentId() {
		return $this->student_id;
	}

	function getSubjectId() {
		return $this->subject_id;
	}

	function getScore() {
		return $this->score;
	}
	function getStudentName() {
		return $this->student_name;
	}

	function getSubjectName() {
		return $this->subject_name;
	}
	function setStudentId($student_id) {
		$this->student_id = $student_id;
		return $this; 
	}

	function setSubjectId($subject_id) {
		$this->subject_id = $subject_id;
		return $this; 
	}

	function setScore($score) {
		$this->score = $score;
		return $this; 
	}

}

 ?>