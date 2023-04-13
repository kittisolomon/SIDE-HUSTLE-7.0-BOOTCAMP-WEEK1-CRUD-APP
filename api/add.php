<?php
require "db_con.php";

$request_body = file_get_contents("php://input");

$data = json_decode($request_body);

if($_SERVER['REQUEST_METHOD'] =='POST'){

 if(!empty($data->firstname)
  && !empty($data->lastname) 
  && !empty($data->department)
  && !empty($data->gender)
  && !empty($data->age)
  && !empty($data->email)
  && !empty($data->phoneno)
  && !empty($data->password)
  && !empty($data->confirm_password)){

 $firstname = filter_var($data->firstname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $lastname = filter_var($data->lastname, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $department = filter_var($data->department, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $gender = filter_var($data->gender, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $age = filter_var($data->age, FILTER_SANITIZE_NUMBER_INT);
 $email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
 $phoneno = filter_var($data->phoneno, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $password = filter_var($data->password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $confirm_password = filter_var($data->confirm_password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $date = "20".date('y-m-d');
 
 if($password !== $confirm_password){

    $response = ["res_code"=>"402","status"=>"error","message"=>"Password Mis-Match"];

    echo json_encode($response);

    return;

 }else{

$password = md5($password);

$sql = " INSERT INTO students (firstname,lastname,department,gender,age,email,phoneno,password,date)
         VALUES ('$firstname', '$lastname','$department','$gender','$age','$email','$phoneno','$password','$date')";
$query = mysqli_query($db_con, $sql);

if($query){

    $response = ["res_code"=>"200","status"=>"success","message"=>"Registration Sucess"];

    echo json_encode($response);

    return;

}else{

$response = ["res_code"=>"501","status"=>"error","message"=>"Registration Failed"];

    echo json_encode($response);

    return;
}

 }
 

}else{

    $response = ["res_code"=>"402","status"=>"error","message"=>"Please fill all the required fields"];

    echo json_encode($response);

    return;
}
    
}else{
    $response = ["res_code"=>"400","status"=>"error","message"=>"Invalid request method"];

    echo json_encode($response);

    return;
}
