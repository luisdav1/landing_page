<?php
include '../conn/connect.php';
include '../models/class-course.php';
include '../models/admin-course.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');

$metodo = $_SERVER['REQUEST_METHOD'];

$adminCourse = new AdminCourse($conn);

switch($metodo) {
    case 'GET':
        $response;
        if (isset($_GET['faculty'], $_GET['isUnderGraduate'], $_GET['isVirtual']) ) {
            $response = $adminCourse->getCourses($_GET['isUnderGraduate'],$_GET['faculty'], $_GET['isVirtual']);
        } else {
            $response = $adminCourse->getAllCourses();
        }
        echo $response;
    break;
    case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);
        $response;
        if (isset($_POST['name'], $_POST['description'], $_POST['isUnderGraduate'],  $_POST['faculty'], $_POST['isVirtual'])) {
            $newCourse = new Course($_POST['name'], $_POST['description'], $_POST['isUnderGraduate'],  $_POST['faculty'], $_POST['isVirtual']);
            $response = $adminCourse->saveCourse($newCourse);
        } else {
            $response['message'] = 'ERROR';
            $response['statusCode'] = '400';
            $response['error'] = 'All properties must be defined! (name, description, isUnderGraduate, faculty, isVirtuality)';
            $response = json_encode($response);
        }
        echo $response;
    break;
    case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $response;
        if (isset($_PUT['name'], $_PUT['description'], $_PUT['isUnderGraduate'],  $_PUT['faculty'], $_PUT['isVirtual'], $_GET['id'])) {
            $newCourse = new Course($_PUT['name'], $_PUT['description'], $_PUT['isUnderGraduate'],  $_PUT['faculty'], $_PUT['isVirtual']);
            $response = $adminCourse->updateCourse($_GET['id'], $newCourse);
        } else {
            $response['message'] = 'ERROR';
            $response['statusCode'] = '400';
            $response['error'] = 'All properties must be defined! ( id(Parameter), name, description, isUnderGraduate, faculty, isVirtuality)';
            $response = json_encode($response);
        }
        echo $response;
    break;
    case 'DELETE':
        $response;
        if (isset($_GET['id'])) {
            $response = $adminCourse->deleteCourse($_GET['id']);
        } else {
            $response['message'] = 'ERROR';
            $response['statusCode'] = '400';
            $response['error'] = 'The id parameter must be defined!';
            $response = json_encode($response);
        }
        echo $response;
    break;        
}
?>