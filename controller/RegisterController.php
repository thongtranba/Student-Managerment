<?php 
class RegisterController {
	function list() {
		$search =!empty($_GET["search"]) ? $_GET["search"] : "";

		$registerRepository = new RegisterRepository();
		if (!empty($search)){
			$registers = $registerRepository->getByPattern($search);
		}
		else{
			$registers = $registerRepository->getAll();
		}
		include "view/register/list.php";
	}

	function add() {
		$studentRepository = new StudentRepository();
		$students = $studentRepository->getAll();

		$subjectRepository = new SubjectRepository();
		$subjects = $subjectRepository->getAll();

		include "view/register/add.php";
	}

	function save() {
		$student_id = $_POST["student_id"];
		$subject_id = $_POST["subject_id"];
		
		$registerRepository = new RegisterRepository();
		$data = [];
		$data["student_id"] = $student_id;
		$data["subject_id"] = $subject_id;
		
		if ($registerRepository->save($data)) {
			$_SESSION["message"] = "Đã tạo đăng ký mới";
		}
		else {
			$_SESSION["error"] = $registerRepository->getError();
		}
		header("location: index.php?c=register");
	}

	function edit() {
		$student_id = $_GET["student_id"];
		$subject_id = $_GET["subject_id"];
		$registerRepository = new RegisterRepository();
		$register = $registerRepository->find($student_id, $subject_id);
		include "view/register/edit.php";
	}

	function update() {
		$student_id = $_POST["student_id"];
		$subject_id = $_POST["subject_id"];
		
		$score = $_POST["score"];

		$registerRepository = new RegisterRepository();
		$register = $registerRepository->find($student_id, $subject_id);
		$register->setScore($score);
				
		if ($registerRepository->update($register)) {
			$_SESSION["message"] = "Điểm đã được cập nhật";
		}
		else {
			$_SESSION["error"] = $registerRepository->getError();
		}
		header("location: index.php?c=register");
	}

	function delete() {
		// get là sử dụng cho thông tin khác với POst
		$student_id = $_GET["student_id"];
		$subject_id = $_GET["subject_id"];
		$registerRepository = new RegisterRepository();
		if ($registerRepository->delete($student_id,$subject_id)) {
			$_SESSION["message"] = "Đăng ký đã bị xóa";
		}
		else {
			$_SESSION["error"] = $registerRepository->getError();
		}
		header("location: index.php?c=register");

	}
	function listSubject() {
	// 	$subjects = [
	// 	["id" => "1", "name"=>"Toán"],
	// 	["id" => "2", "name"=>"Lý"],
	// ];
		$student_id = $_GET["student_id"];
		$subjectRepository = new SubjectRepository();
		$unRegisterdSubjects = $subjectRepository->getUnRegisterd($student_id);
		$subjects = [];
		foreach($unRegisterdSubjects as $subject) {
			$subjects [] = ["id"=> $subject->getId(), "name" => $subject->getName()];
		}


	echo json_encode($subjects);
	}
}

?>
