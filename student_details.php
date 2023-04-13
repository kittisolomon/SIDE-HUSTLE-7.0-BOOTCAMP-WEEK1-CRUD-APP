<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Intern Details</title>
    <style>
        .col-lg-12{
            display: flex;
            flex-direction: column;

        }
        ul{
            list-style: none;
        }
    </style>
</head>
<body>
<div class="container form-wrapper">
    <div class="row ">
        <input id="id" type="hidden" name="" value="<?php $id = $_GET['id']; echo $id; ?>">
    <header class="form-header"> STUDENT DETAILS </header>
        <div class="col-lg-12 flex"  id="std_list">
     
        </div>
        <div class="col-md-12 py-2 flex">     
          <a href="all_students.php"> <button type="submit" id='btn' name="submit" class="btn btn-primary"><i class="fas fa-arrow-left"></i> BACK</button> </a>   
        </div>
    </div>
</div>
<script>
const id = document.getElementById('id').value;
 const url = `api/details.php?id=${id}`;
 //console.log(url)
fetch(url,{
method: 'GET',
'Content-Type': 'application/json',
}).then(response => response.json())
.then(response => {
    if(response.status === 'success'){
        const studentDetails = response.student_details.all_details;
        const listElement = document.querySelector('#std_list');

        studentDetails.forEach(student => {
        
            const element = document.createElement('ul');
               
            element.innerHTML = `
            <li><p><b>First Name:</b> ${student.firstname} </p></li>
            <li><p><b>Last Name:</b> ${student.lastname} </p></li>
            <li><p><b>Department:</b> ${student.department} </p></li>
            <li><p><b>Gender:</b> ${student.gender}</p> </li>
            <li><p><b>Age:</b> ${student.age} </p></li>
            <li><p><b>Email:</b> ${student.email} </p></li>
            <li><p><b>Phone Number:</b> ${student.phoneno}</p> </li>
            <li><p><b>Reg Date:</b> ${student.date} </p></li>
            `;
            listElement.appendChild(element);
             
        })

    }
    
})

</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>