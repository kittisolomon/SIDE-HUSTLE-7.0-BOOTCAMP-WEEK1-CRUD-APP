<?php
require "db_con.php";

$request_body = file_get_contents("php://input");

$data = json_decode($request_body);

//$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'PUT'){
$id = $data->id;
$firstname = $data->firstname;
$lastname = $data->lastname;
$department = $data->department;
$gender = $data->gender;
$age = $data->age;
$email = $data->email;
$phoneno = $data->phoneno;

$sql = "UPDATE students  SET firstname = '$firstname', lastname= '$lastname', department = '$department', 
        gender= '$gender', age = '$age', email = '$email', phoneno = '$phoneno'  WHERE id = '$id' ";
$query = mysqli_query($db_con, $sql);

if(mysqli_affected_rows($db_con) > 0){

    $response = ["status"=>"success","message"=>"Update Sucessful"];

    echo json_encode($response);

    return;
}


}else{

    $response = ["status"=>"error","message"=>"Invalid request method"];

    echo json_encode($response);

    return;
}








?>