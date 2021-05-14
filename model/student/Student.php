<?php 
class Student {
	protected $id;
	protected $name;
	protected $birthday;
	protected $gender;

	function __construct($id, $name, $birthday, $gender) {
		$this->id = $id;
		$this->name = $name;
		$this->birthday = $birthday;
		$this->gender = $gender;
	}

	function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getBirthday() {
		return $this->birthday;
	}
	function getFormatBirthday() {
		$vnFormat = "d/m/y";
		return date ($vnFormat, strtotime($this->birthday));
	}

	function getGender() {
		return $this->gender;
	}

	function setId($id) {
		$this->id = $id;
		return $this; 
	}

	function setName($name) {
		$this->name = $name;
		return $this; 
	}

	function setBirthday($birthday) {
		$this->birthday = $birthday;
		return $this; 
	}

	function setGender($gender) {
		$this->gender = $gender;
		return $this; 
	}

	function getGenderName() {
		$genderMap = [0 => "nam", 1 => "nữ", 2 => "khác"];
		return $genderMap[$this->gender];
	}


}

 ?>