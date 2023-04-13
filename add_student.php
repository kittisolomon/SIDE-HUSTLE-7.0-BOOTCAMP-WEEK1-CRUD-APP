<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Student Reg</title>
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
        <form  id="reg-form">
        <div class="row flex">
             <header class="form-header">STUDENT REGISTRATION</header>
          <span  class='col-md-8 alert alert-success text-center hide'>Add Success</span>
            <div class="col-md-8">
                <div class="form-group"></div>
                <label for="">First Name:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name">
            </div>
            <div class="col-md-8">
                <div class="form-group"></div>
                <label for="">Last Name:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter First Name">
            </div>
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="department">Department:</label>
                <select name="department" id="department" class="form-control" >
                <option value="select">--Select Department--</option>
                <option value="Frontend Development">Agric Department</option> 
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
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="age">Age:</label>
                <input type="numer" name="age" id="age" class="form-control" placeholder="Enter Age">
            </div>
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter E-mail">
            </div>
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="phoneno">Phone Number:</label>
                <input type="text" name="phoneno" id="phoneno" class="form-control" placeholder="Enter Phone Number">
            </div>
           
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
            </div>
             
            <div class="col-md-8 py-2">
                <div class="form-group"></div>
                <label for="">Confirm Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Re-type Password">
            </div>
            <div class="col-md-8 d-grid py-2">
                <div class="form-group"></div>
              <button type="submit" id='btn' name="submit" class="btn btn-primary">SUBMIT</button>   
            </div>
            <div class="col-md-12 py-2 flex">     
          <a href="all_students.php" class="btn btn-success"><i class="fas fa-arrow-left"></i> BACK </a>   
        </div>
           
        </div>
        </form>
    </div>


<script>
  
  document.getElementById('reg-form').addEventListener('submit', function(event) {

  event.preventDefault();

  const firstname = document.getElementById('firstname').value;
  const lastname = document.getElementById('lastname').value;
  const department = document.getElementById('department').value;
  const gender = document.getElementById('gender').value;
  const age = document.getElementById('age').value;
  const email = document.getElementById('email').value;
  const phoneno = document.getElementById('phoneno').value;
  const password = document.getElementById('password').value;
  const confirm_password = document.getElementById('confirm_password').value;

 //Creating an object with the form data

 const data = {firstname,lastname,department,gender,age,email,phoneno,password,confirm_password};

 const url = 'api/add.php';
 // Fetch the Create API
 fetch(url, {
    method: 'POST',
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
                document.getElementById('reg-form').reset();
            }
        })
        
});

</script>
<script src="js/bootstrap.min.js"></script>
<script src="alertifyjs/js/alertify.min.js"></script>
</body>
</html>