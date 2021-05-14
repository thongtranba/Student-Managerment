<?php 
class RegisterRepository {
	protected $error;

	function fetch($cond = null) {
		global $conn;
		$sql = "SELECT register.*, student.name AS student_name, subject.name AS subject_name FROM register
		JOIN student ON register.student_id = student.id
		JOIN subject ON	register.subject_id = subject.id
		";
		if (!empty($cond)) {
			$sql .= " WHERE " . $cond;
		}
		$result = $conn->query($sql);
		$registers = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$register = new Register($row["student_id"], $row["subject_id"], $row["score"], $row["student_name"],$row["subject_name"]);
				$registers[] = $register;
			}
		}

		return $registers;
	}
	function getSubjectUnRegisterd($student_id) {
		
	}

	function getAll() {
		return $this->fetch();
	}
	function getByPattern($search) {
		$cond = "student.name LIKE '%$search%' OR subject.name LIKE '%$search%'";
		$registers = $this->fetch($cond);
		
		return $registers;

	}
	function hasStudent($student_id) {
		$cond = "student_id=$student_id";
		$registers = $this->fetch($cond);
		if (count($registers)>0) {
			return true;

		}
		return false;
	}
	function hasSubject($subject_id) {
		$cond = "subject_id=$subject_id";
		$registers = $this->fetch($cond);
		if (count($registers)>0) {
			return true;

		}
		return false;
	}

	function save($data) {
		global $conn;
		$student_id = $data["student_id"];
		$subject_id = $data["subject_id"];
		
		
		$sql = "INSERT INTO register (student_id, subject_id)
		VALUES ('$student_id', $subject_id)";

		if ($conn->query($sql) === TRUE) {
			// $last_student_id = $conn->insert_student_id;//chỉ cho auto increment
			return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}

	function find($student_id, $subject_id) {
		$cond = "student_id=$student_id AND subject_id=$subject_id";
		$registers = $this->fetch($cond);
		$register = current($registers);
		return $register;

	}

	function getError() {
		return $this->error;
	}

	function update($register) {
		global $conn;
		$subject_id = $register->getSubjectID();
		$score = $register->getScore();
		
		$student_id = $register->getStudentID();
		$sql = "UPDATE register SET score=$score WHERE student_id=$student_id AND subject_id=$subject_id";

		if ($conn->query($sql) === TRUE) {
			// $last_student_id = $conn->insert_student_id;//chỉ cho auto increment
			return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}

	function delete($student_id,$subject_id) {
		global $conn;
		$sql = "DELETE FROM register WHERE student_id=$student_id AND subject_id=$subject_id";

		if ($conn->query($sql) === TRUE) {
			// $last_student_id = $conn->insert_student_id;//chỉ cho auto increment
			return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}
}

?>