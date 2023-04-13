<?php
require "db_con.php";

$id = $_GET['id'];

$sql = " DELETE FROM intern_info WHERE id = $id ";

$query = mysqli_query($con, $sql);

if($query){
    header("Location: all_intern.php");
}




?>