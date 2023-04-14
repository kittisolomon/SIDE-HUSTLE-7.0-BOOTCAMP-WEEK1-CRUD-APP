<?php

$check_email = "SELECT * FROM clients WHERE email = '$email'";

$query = mysqli_query($db_con, $check_email);

if(mysqli_num_rows($query) > 0){

    echo "Email already exist ";
    
}else{


//input insert statement here.....

}







?>