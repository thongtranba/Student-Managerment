<?php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class StudentController {
	function list() {
		$search =!empty($_GET["search"]) ? $_GET["search"] : "";

		$studentRepository = new StudentRepository();
		if (!empty($search)){
			$students = $studentRepository->getByPattern($search);
		}
		else{
			$students = $studentRepository->getAll();
		}
		
		include "view/student/list.php";
	}

	function add() {
		include "view/student/add.php";
	}

	function save() {
		$name = $_POST["name"];
		$birthday = $_POST["birthday"];
		$gender = $_POST["gender"];
		$studentRepository = new StudentRepository();
		$data = [];
		$data["name"] = $name;
		$data["birthday"] = $birthday;
		$data["gender"] = $gender;
		if ($studentRepository->save($data)) {
			$_SESSION["message"] = "Đã tạo sinh viên mới";
		}
		else {
			$_SESSION["error"] = $studentRepository->getError();
		}
		header("location: index.php");
	}

	function edit() {
		$id = $_GET["id"];
		$studentRepository = new StudentRepository();
		$student = $studentRepository->find($id);
		include "view/student/edit.php";
	}

	function update() {
		$name = $_POST["name"];
		$birthday = $_POST["birthday"];
		$gender = $_POST["gender"];
		$id = $_POST["id"];

		$studentRepository = new StudentRepository();
		$student = $studentRepository->find($id);
		$student->setName($name);
		$student->setBirthday($birthday);
		$student->setGender($gender);
		if ($studentRepository->update($student)) {
			$_SESSION["message"] = "Sinh viên đã được cập nhật";
		}
		else {
			$_SESSION["error"] = $studentRepository->getError();
		}
		header("location: index.php");
	}

	function delete() {
		$id = $_GET["id"];
		$studentRepository = new StudentRepository();
		if ($studentRepository->delete($id)) {
			$_SESSION["message"] = "Sinh viên đã bị xóa";
		}
		else {
			$_SESSION["error"] = $studentRepository->getError();
		}
		header("location: index.php");

	}
	function hasRegister() {
		$student_id = $_GET["id"];
		$registerRepository = new registerRepository ();
		if ($registerRepository->hasStudent($student_id)) {


			$result = ["existing" => 1, "error" => "Sinh viên này đã đăng ký môn học, bạn không thể xóa"];
			echo json_encode($result);
		} else {
			$result = ["existing" => 0, "error" => "Sinh viên này đã đăng ký môn học, bạn không thể xóa"];
			echo json_encode($result);
		}
	}
	function import() {
		require "vendor/autoload.php";
		$inputFileName = 'Storage/Danh sách sinh viên.xlsx';

		/** Load $inputFileName to a Spreadsheet Object  **/
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		$sheet = $spreadsheet->getActiveSheet();
		$start = 2;
		$end = $sheet->getHighestRow();
		$studentRepository = new StudentRepository();
		$genderMap = ["nam"=>0, "nữ"=> 1, "khác"=>2];
		for ($row = $start; $row <= $end; $row++) {
			$maSV = $sheet->getCell("A$row")->getValue();
			$tenSV = $sheet->getCell("B$row")->getValue();
			$ngaySinh = $sheet->getCell("C$row")->getValue();
			$gioiTinh = $sheet->getCell("D$row")->getValue();


			if(!empty($maSV)) {
				$student = $studentRepository->find($maSV);
				if (!empty($student)) {
					$student->setName($tenSV);
					$student->setBirthday($ngaySinh);
					$student->setGender($genderMap[$gioiTinh]);

					$studentRepository->update($student);
					continue;
				}
			}

			$data = [
				"id"=>$maSV,
				"birthday"=>$ngaySinh,
				"name" => $tenSV,
				"gender" => $genderMap[$gioiTinh]
			];
			$studentRepository->save($data);
			
		}
		header("location: index.php");
	}
}

?>
