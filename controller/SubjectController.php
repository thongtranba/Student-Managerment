<?php 
class SubjectController {
	function list() {
		$search =!empty($_GET["search"]) ? $_GET["search"] : "";
		
		$subjectRepository = new SubjectRepository();
		if (!empty($search)){
			$subjects = $subjectRepository->getByPattern($search);
		}
		else{
			$subjects = $subjectRepository->getAll();
		}
		include "view/subject/list.php";
	}

	function add() {
		include "view/subject/add.php";
	}

	function save() {
		$name = $_POST["name"];
		$number_of_credit = $_POST["number_of_credit"];
		
		$subjectRepository = new SubjectRepository();
		$data = [];
		$data["name"] = $name;
		$data["number_of_credit"] = $number_of_credit;
		
		if ($subjectRepository->save($data)) {
			$_SESSION["message"] = "Đã tạo môn học mới";
		}
		else {
			$_SESSION["error"] = $subjectRepository->getError();
		}
		header("location: index.php?c=subject");
	}

	function edit() {
		$id = $_GET["id"];
		$subjectRepository = new SubjectRepository();
		$subject = $subjectRepository->find($id);
		include "view/subject/edit.php";
	}

	function update() {
		$name = $_POST["name"];
		$number_of_credit = $_POST["number_of_credit"];
		
		$id = $_POST["id"];

		$subjectRepository = new SubjectRepository();
		$subject = $subjectRepository->find($id);
		$subject->setName($name);
		$subject->setNumberofcredit($number_of_credit);
		
		if ($subjectRepository->update($subject)) {
			$_SESSION["message"] = "Môn học đã được cập nhật";
		}
		else {
			$_SESSION["error"] = $subjectRepository->getError();
		}
		header("location: index.php?c=subject");
	}

	function delete() {
		$id = $_GET["id"];
		$subjectRepository = new SubjectRepository();
		if ($subjectRepository->delete($id)) {
			$_SESSION["message"] = "Môn học đã bị xóa";
		}
		else {
			$_SESSION["error"] = $subjectRepository->getError();
		}
		header("location: index.php?c=subject");

	}
	function hasRegister() {
		$subject_id = $_GET["id"];
		$registerRepository = new registerRepository ();
		if ($registerRepository->hasSubject($subject_id)) {


		$result = ["existing" => 1, "error" => "Môn học này đã đăng ký môn học, bạn không thể xóa"];
		echo json_encode($result);
	} else {
		$result = ["existing" => 0, "error" => "Môn học này đã đăng ký môn học, bạn không thể xóa"];
		echo json_encode($result);
	}
	}
}

?>
