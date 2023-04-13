<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>Update Details</title>
    <style>
    .hide{
        display: none;
      }
      .alertify-notifier {
  top: 10px;
  right: 10px;
}
.alertify-notifier .ajs-success {
	font-size: 14px;
  font-weight: 700;
  color: #FFF;
}
.alertify-notifier .ajs-error {
font-size: 14px;
  font-weight: 700;
  color: #FFF;
}
    </style>
</head>
<body>
<div>
    <div class="container form-wrapper">
    <input id="id" type="hidden" name="" value="<?php $id = $_GET["id"]; echo $id; ?>">
        <form  id="update-form">
        <div class="row flex">
             <header class="form-header">UPDATE STUDENT DETAILS</header>
          
            <div class="col-md-8">
                <div class="form-group"></div>
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control">
            </div>
            <div class="col-md-8">
                <div class="form-group"></div>
                <label for="lastname">Last Name:</label>
                <input type="text" name="lastname"  id="lastname" class="form-control" value="">
            </div>
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="gender">Department:</label>
                <select name="department" id="department" class="form-control" >
                <option value="select">--Select Department--</option>
                <option value="Agric Department">Agric Department</option> 
                    <option value="Agric Department">Biology Department</option>
                    <option value="Chemistry Department">Chemistry Department</option>  
                    <option value="Computer Science Department">Computer Science Department</option>
                    <option value="Physic Departmentt">Physic Department</option> 
                    <option value="Zoology Department">Zoology Department</option>  
                </select>
            </div>
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control" >
                <option value="select">--Select Gender--</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="col-md-8">
                <div class="form-group"></div>
                <label for="">Age:</label>
                <input type="text" name="age" id="age" class="form-control" value="">
            </div>
            
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="">Email:</label>
                <input type="email" name="email" id="email"  class="form-control" value="">
            </div>
           
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="phoneno">Phone Number:</label>
                <input type="tel" name="hobby" id="phoneno"  class="form-control" value="">
            </div>
            <div class="col-md-8 d-grid py-2">
                <div class="form-group"></div>
              <button type="submit" name="submit" id="btn" class="btn btn-primary">UPDATE</button>   
            </div>
            <div class="col-md-12 py-2 flex">     
          <a href="all_students.php" class="btn btn-success"><i class="fas fa-arrow-left"></i> BACK </a>   
        </div>
           
        </div>
        </form>
    </div>

<script>
  const id = document.getElementById('id').value;
    const url = `api/details.php?id=${id}`;

    fetch(url,{
     method: 'GET',
     headers: {
        'Content-Type': 'application/json',
     }
    }).then(response => response.json())
    .then( response => {
        if(response.status === 'success'){
            const firstname = document.getElementById('firstname');
            const lastname = document.getElementById('lastname');
            const department = document.getElementById('department');
            const gender = document.getElementById('gender');
            const age = document.getElementById('age');
            const email = document.getElementById('email');
            const phoneno = document.getElementById('phoneno');

            const studentDetails = response.student_details.all_details;

            studentDetails.forEach(student => {
                firstname.value = student.firstname;
                lastname.value = student.lastname;
                department.value = student.department;
                gender.value = student.gender;
                age.value = student.age;
                email.value = student.email;
                phoneno.value = student.phoneno;
                
            })
            
        }else{

        }
    })

// updating the record

document.getElementById('update-form').addEventListener('submit', function(event) {

event.preventDefault();
const id = document.getElementById('id').value;
const firstname = document.getElementById('firstname').value;
const lastname = document.getElementById('lastname').value;
const department = document.getElementById('department').value;
const gender = document.getElementById('gender').value;
const age = document.getElementById('age').value;
const email = document.getElementById('email').value;
const phoneno = document.getElementById('phoneno').value;

//Creating an object with the form data

const data = {id,firstname,lastname,department,gender,age,email,phoneno};

const url = 'api/update.php';
// Fetch the PUT API
fetch(url, {
  method: 'PUT',
  body: JSON.stringify(data),
  headers: {
      'Content-Type':'application/json'
  }
})
.then(async (response) => {
          const result = await response.json();
          const err = result.status;
          const msg = result.message;
          if(err === 'error'){
          alertify.error(msg);
          }else{
              alertify.success(msg);
          }
      })
      
});
   
</script>
<script src="js/bootstrap.min.js"></script>
<script src="alertifyjs/js/alertify.min.js"></script>
</body>
</html>