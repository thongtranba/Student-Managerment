<?php 
class SubjectRepository {
	protected $error;

	function fetch($cond = null) {
		global $conn;
		$sql = "SELECT * FROM subject";
		if (!empty($cond)) {
			$sql .= " WHERE " . $cond;
		}
		$result = $conn->query($sql);
		$subjects = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$subject = new Subject($row["id"], $row["name"], $row["number_of_credit"]);
				$subjects[] = $subject;
			}
		}

		return $subjects;
	}

	function getAll() {
		return $this->fetch();
	}
	function getByPattern($search) {
		$cond = "name LIKE '%$search%'";
		$subjects = $this->fetch($cond);
		
		return $subjects;

	}

	function getUnRegisterd($student_id) {
		// $sql = "SELECT * FROM subject WHERE id NOT in (SELECT subject_id FROM register WHERE student_id = $student_id)";
		$cond = "id NOT in (SELECT subject_id FROM register WHERE student_id = $student_id)";
		return $this->fetch($cond);
	}


	function save($data) {
		global $conn;
		$name = $data["name"];
		$number_of_credit = $data["number_of_credit"];
		
		$sql = "INSERT INTO subject (name, number_of_credit)
		VALUES ('$name', $number_of_credit)";

		if ($conn->query($sql) === TRUE) {
			// $last_id = $conn->insert_id;//chỉ cho auto increment
		    return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}

	function find($id) {
		$cond = "id=$id";
		$subjects = $this->fetch($cond);
		$subject = current($subjects);
		return $subject;

	}

	function getError() {
		return $this->error;
	}

	function update($subject) {
		global $conn;
		$name = $subject->getName();
		$number_of_credit = $subject->getNumberOfCredit();
		
		$id = $subject->getId();
		$sql = "UPDATE subject SET name='$name', number_of_credit='$number_of_credit' WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
			// $last_id = $conn->insert_id;//chỉ cho auto increment
		    return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}

	function delete($id) {
		global $conn;
		$sql = "DELETE FROM subject WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
			// $last_id = $conn->insert_id;//chỉ cho auto increment
		    return true;
		} 
		$this->error = "Error: " . $sql . "<br>" . $conn->error;
		return false;
	}
}

 ?>