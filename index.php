<?php 
session_start();
require "config.php";
require "model/connectDB.php";
require "model/student/Student.php";
require "model/student/StudentRepository.php";
require "model/subject/Subject.php";
require "model/subject/SubjectRepository.php";
require "model/register/Register.php";
require "model/register/RegisterRepository.php";

$c = !empty($_GET["c"]) ? $_GET["c"] : "student";
$a = !empty($_GET["a"]) ? $_GET["a"] : "list";

$controller = ucfirst($c) . "Controller";//StudentController

//Include controller first
require "controller/" . $controller . ".php"; //controller/StudentController.php

$objectController = new $controller(); //$objectController = new StudentController();
$objectController->$a();//$objectController->list()

// call_user_func_array([$controller, $a],[]);
 ?>