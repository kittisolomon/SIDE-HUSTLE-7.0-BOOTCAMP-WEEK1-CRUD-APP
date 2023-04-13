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
    <title>All Intern</title>
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
  
<div class="container form-wrapper">
    <div class="row flex">
    <header class="form-header">ALL REGISTERED STUDENT'S </header>
        <div class="col-lg-12">
          <div class="table-responsive">
            <table class="table justify" id="student-table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col" >Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">Department</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Age</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Date</th>
                        <th scope="col">View</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
          </div>
          
        </div>
        <div class="col-md-8 py-2 flex">     
          <a href="add_student.php"> <button type="submit" id='btn' name="submit" class="btn btn-primary"><i class="fas fa-plus"></i> ADD INTERN</button> </a>   
        </div>
    </div>
   
</div>
<script>

const url = 'api/view_students.php';
const tableBody = document.querySelector('#student-table tbody');

fetch(url, {
    method: 'GET',
    headers: {
        'Content-Type': 'application/json'
    },
}).then(response => response.json())
.then(response => {
    if (response.status === 'success') {
        const studentList = response.student_list.all_students;
        
        studentList.forEach(student => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${student.id}</td>
                <td>${student.firstname}</td>
                <td>${student.lastname}</td>
                <td>${student.department}</td>
                <td>${student.gender}</td>
                <td>${student.age}</td>
                <td>${student.email}</td>
                <td>${student.phoneno}</td>
                <td>${student.date}</td>
                <td><a href="student_details.php?id=${student.id}"  class="btn btn-success">View</a></td>
                <td><a href="update_details.php?id=${student.id}"  class="btn btn-warning"> Update </a></td>
                <td><button data-id="${student.id}"  class="btn-delete btn btn-danger">  Delete </button></td>
            `;
            tableBody.appendChild(row);
        });
        
        // Adding event listeners to delete buttons
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const id = button.getAttribute('data-id');

                // Creating an object with the form data
                const data = {id};

                // Fetch the delete API
                const url  = `api/delete.php?id=${id}`;
                fetch(url, {
                    method: 'DELETE',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type':'application/json'
                    }
                })
                .then(async (response) => {
                    const result = await response.json();
                    const status = result.status;
                    const msg = result.message;
                    if (status === 'success') {
                        alertify.success(msg);
                        // Remove deleted row from table
                        const row = button.parentNode.parentNode;
                        row.remove();
                    }else{
                        alertify.error(response.message);
                    }
                })
                .catch(error => {
                    // Handle fetch error
                    alertify.error(error);
                });
            });
        });
    } else {
        // Handle error response from server
        alertify.error(response.message);
    }
})
.catch(error => {
    // Handle fetch error
    alertify.error(error);
});


</script>
<script src="js/bootstrap.min.js"></script>
<script src="alertifyjs/js/alertify.min.js"></script>
</body>
</html>