<?php 
class StudentRepository {
	protected $error;

	function fetch($cond = null) {
		global $conn;
		$sql = "SELECT * FROM student";
		if (!empty($cond)) {
			$sql .= " WHERE " . $cond;
		}
		$result = $conn->query($sql);
		$students = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$student = new Student($row["id"], $row["name"], $row["birthday"], $row["gender"]);
				$students[] = $student;
			}
		}

		return $students;
	}

	function getAll() {
		return $this->fetch();
	}
	function getByPattern($search) {
		$cond = "name LIKE '%$search%'";
		$students = $this->fetch($cond);
		
		return $students;

	}

	function save($data) {
		global $conn;
		$name = $data["name"];
		$birthday = $data["birthday"];
		$gender = $data["gender"];
		if (empty($data["id"])) {
			$id='null';
		}
		else {
			$id=$data["id"];
		}
		
		$sql = "INSERT INTO student ( id, name, birthday, gender)
		VALUES ($id, '$name', '$birthday', $gender)";

		if ($conn->query($sql) === TRUE) {
			// $last_id = $conn->insert_id;//chỉ cho auto increment
		    return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}

	function find($id) {
		$cond = "id=$id";
		$students = $this->fetch($cond);
		$student = current($students);
		return $student;

	}

	function getError() {
		return $this->error;
	}

	function update($student) {
		global $conn;
		$name = $student->getName();
		$birthday = $student->getBirthday();
		$gender = $student->getGender();
		$id = $student->getId();
		$sql = "UPDATE student SET name='$name', birthday='$birthday', gender=$gender WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
			// $last_id = $conn->insert_id;//chỉ cho auto increment
		    return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}

	function delete($id) {
		global $conn;
		$sql = "DELETE FROM student WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
			// $last_id = $conn->insert_id;//chỉ cho auto increment
		    return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}
}

 ?>