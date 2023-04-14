<?php
require "db_con.php";
$request_body = file_get_contents("php://input");
$data = json_encode($request_body);

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] ==='GET'){

$sql = "SELECT * FROM students WHERE id = $id ";

$query = mysqli_query($db_con, $sql);

if(mysqli_num_rows($query) > 0){

while($row = mysqli_fetch_array($query)){
    $view_json["id"] = $row["id"];
  $view_json["firstname"] = $row["firstname"];
  $view_json["lastname"] = $row["lastname"];
  $view_json["department"] = $row["department"];
  $view_json["gender"] = $row["gender"];
  $view_json["age"] = $row["age"];
  $view_json["email"] = $row["email"];
  $view_json["phoneno"] = $row["phoneno"];
  $view_json["date"] = $row["date"];
  $std_details["all_details"][] = $view_json;

  $response = ["status"=>"success","student_details"=>$std_details];
  echo json_encode($response);
  return;
}
}else{

    $response = ["message"=>"Cannot retrieve students details"];
    echo json_encode($response);
     return;
}

}else{
  $response = ["status"=>"error","message"=>"Invalid request method"];
  echo json_encode($response);
  return;
}












?>