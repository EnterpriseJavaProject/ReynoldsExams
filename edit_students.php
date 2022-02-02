<?php 
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>



 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

  


  <div class="container-fluid">

    <!----DataTales Examples-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">UPDATE STUDENT INFO </h4>
        </div>
        <div class="card-body">

        <?php

                $connection = mysqli_connect("localhost","root","","registration");
                if (isset($_POST['edit_btn']))
           {
                $id = $_POST['edit_id'];
            
                $query = "SELECT * FROM students WHERE id='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $row)
            {
        ?>


<form action="backEnd.php" method="POST">

<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>" >





<div class="form-group">
    <label>Student ID</label>
    <input type="text" value="<?php echo $row['student_id'] ?>" class="form-control" disabled="disabled" readonly="true" autocomplete="off">
    <span id="username_error_message" style="color:red;"></span>
</div>



<div class="form-group">
    <label>Full Name</label>
    <input type="text" name="edit_username" id="username" value="<?php echo $row['username'] ?>" class="form-control" placeholder="Enter Full Name" required>
    <span id="username_error_message" style="color:red;"></span>
</div>

<div class="form-group">
    <label>Phone Number</label>
    <input type="phone" name="edit_phone" id="phone" value="<?php echo $row['phone'] ?>" class="form-control" placeholder="Enter Phone Number" required>
    <span id="phone_error_message" style="color: red;"></span>

</div>



<div class="form-group">
    <label>Email</label>
    <input type="email" name="edit_email" id="email" value="<?php echo $row['email'] ?>" class="form-control" placeholder="Enter Email" required>
    <span id="email_error_message" style="color: red;"></span>

</div>


<div class="form-group">
    <label>Gender</label>
    <!-- <input type="text" name="edit_gender" value="" class="form-control"> -->
    <select name="edit_gender" class="form-control"  required>
            <option value="<?php echo $row['gender'] ?>"> <?php echo $row['gender'] ?> </option>
            <option>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
</div>



<div class="form-group">
    <label>Date of Birth</label>
    <input type="date" name="edit_dob" id="dob" value="<?php echo $row['dob'] ?>" class="form-control" autocomplete="off" placeholder="Enter Occupation">
    <span id="occupation_error_message" style="color:red;"></span>

</div>



<div class="form-group">
    <label>Address</label>
    <input type="text" name="edit_address" id="address" value="<?php echo $row['address'] ?>" class="form-control" placeholder="Enter Password" required>
    <span id="password_error_message" style="color:red;"></span>
</div>


<a href="viewAllAdminPage.php" class="btn btn-danger"> CANCEL </a>
<button type="submit" name="update_btn" onclick="return validate()" class="btn btn-primary"> UPDATE </button>

</form>

            <?php
                }
                }
            ?>





</div>
</div>
</div>
</div>
</div>
</div>







<script>

function validate(){
	
	var username = document.getElementById("username").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;

	
	
	var nametype = /^[A-Z a-z]+$/;
    // var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	

	if (username == ""){
        document.getElementById("username_error_message").innerHTML="** username required";
        return false;
    }
	
	if (nametype.test(username) == false){
        document.getElementById("username_error_message").innerHTML="** Username required letters";
        return false;
    }


	if (phone == ""){
        document.getElementById("phone_error_message").innerHTML="** Contact required";
        return false;
    }
	
	 if (isNaN(phone)){
		document.getElementById("phone_error_message").innerHTML="** Contact must be only digits";
        return false;
	}


	 if (phone.length<10){
		document.getElementById("phone_error_message").innerHTML="** Contact must be 10 digits";
        return false;
	}
	
	if (phone.length>10){
		document.getElementById("phone_error_message").innerHTML="** Contact must be 10 digits";
        return false;
	}

    if ((phone.charAt(0) != 0)){
		document.getElementById("phone_error_message").innerHTML="** Contact must begin with 0";
        return false;
	}


    if (email == ""){
        document.getElementById("email_error_message").innerHTML="** Email required";
        return false;
    }


	if  (emailformat.test(email)== false){
        document.getElementById("email_error_message").innerHTML="** Enter A Valid Email";
        return false;
    }



    if (password == ""){
        document.getElementById("password_error_message").innerHTML="** password required";
        return false;
    }



	if (nametype.test(password) == false){
        document.getElementById("password_error_message").innerHTML="** password should be only characters";
        return false;
    }


    if (password.length>5){
		document.getElementById("password_error_message").innerHTML="** Password must be more than 5 letters";
        return false;
	}




	
}
</script>









<?php
include('includes/main_scripts.php');
include('includes/footer.php');
?>
