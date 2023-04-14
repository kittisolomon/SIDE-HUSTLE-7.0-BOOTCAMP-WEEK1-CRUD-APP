<?php
require "db_con.php";

$request_body = file_get_contents("php://input");

$date = json_encode($request_body);
if($_SERVER['REQUEST_METHOD'] ==='GET'){

$sql = "SELECT * FROM  students";

$query = mysqli_query($db_con, $sql);

if(mysqli_num_rows($query) > 0){

while( $row = mysqli_fetch_array($query) ){

    $view_json["id"] = $row["id"];
    $view_json["firstname"] = $row["firstname"];
    $view_json["lastname"] = $row["lastname"];
    $view_json["department"] = $row["department"];
    $view_json["gender"] = $row["gender"];
    $view_json["age"] = $row["age"];
    $view_json["email"] = $row["email"];
    $view_json["phoneno"] = $row["phoneno"];
    $view_json["date"] = $row["date"];
    $students["all_students"][] = $view_json;
}

$response = ["status"=>"success","student_list"=>$students];
echo json_encode($response);
return;

}else{
    $response = ["status"=>"error","message"=>"No Records Found!"];
   echo json_encode($response);
    return;
}
}else{
    $response = ["status"=>"error","message"=>"Invalid request method"];
    echo json_encode($response);
    return;
}




?>