<?php
require "db_con.php";

$request_body = file_get_contents("php://input");

$data = json_decode($request_body);

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

//$id = $data->id;

$sql = " DELETE FROM students  WHERE id = '$id' ";
$query = mysqli_query($db_con, $sql);

if($query){

    $response = ["status"=>"success","message"=>"Deleted Sucessfully"];

    echo json_encode($response);

    return;
}else {

    $response = ["status"=>"error","message"=>"Cannot delete student"];

    echo json_encode($response);

    return;
}


}else{

    $response = ["status"=>"error","message"=>"Invalid request method"];

    echo json_encode($response);

    return;
}








?>