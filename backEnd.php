<?php
session_start();



$get_string = 0;

$connection = mysqli_connect("localhost","root","","registration");






if (isset($_POST['check_submit_btn']))
 {

    $phone1 = $_POST['phone_id'];


      // PHONE NUMBER  VERIFICATION
    $phone_query = "SELECT phone FROM members WHERE phone='$phone1' ";
    $phone_query_run = mysqli_query($connection, $phone_query);
    if (mysqli_num_rows($phone_query_run) > 0) 

    {
      echo "Phone Number already exist!";

    }



 }









 if (isset($_POST['register_btn']))
 {


  $student_id = $_POST['student_id'];
  $username = $_POST['username'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $dob = $_POST['dob'];
  $address = $_POST['address'];
    $email = $_POST['email'];

  



    // USERNAME REQUIRES ONLY LETTERS
    if (!preg_match("/^[a-zA-Z\s]+$/", $username))
    {
      $_SESSION['status'] = "Username requires only Letters";
      $_SESSION['status_code'] = "error";
      header('Location: viewAdminPage.php');
    }
    else {






  
        

    // PHONE NUMBER REQUIRES ONLY NUMBERS
    if (!preg_match('/^[0-9]*$/',$phone)) 
    {
        $_SESSION['status'] = "Phone Number requires only numbers";
        $_SESSION['status_code'] = "error";
        header('Location: viewAdminPage.php');
    }
    else {


    if (strlen($phone)<10) 
    {
        $_SESSION['status'] = "Phone Number should be 10 digits";
        $_SESSION['status_code'] = "error";
        header('Location: viewAdminPage.php');
    }
    else{

    if (strlen($phone)>10) 
    {
        $_SESSION['status'] = "Phone Number should be 10 digits";
        $_SESSION['status_code'] = "error";
        header('Location: viewAdminPage.php');
    }
    else{



 



                        

      

            // PHONE NUMBER  VERIFICATION
    $phone_query1 = "SELECT * FROM students WHERE phone='$phone' ";
    $phone_query1_run = mysqli_query($connection, $phone_query1);
    if (mysqli_num_rows($phone_query1_run) > 0) 

    {
      $_SESSION['status'] = "Phone Number already exist!";
      $_SESSION['status_code'] = "error";
      header('Location: viewAdminPage.php');

    }
    else{









  
$checkMemebr = "SELECT student_id FROM students ORDER BY student_id DESC";
$checkMemebrResult = mysqli_query($connection,$checkMemebr);

$row = mysqli_fetch_array($checkMemebrResult);

$student_id_ID = $row['student_id'];

if (empty($student_id_ID)) {
  
  $student_id = "CSD2022M001";

}
else{

  $get_numbers = str_replace("CSD2022M", "", $student_id_ID);
  $get_string = str_pad($get_numbers + 1, 3, 0, STR_PAD_LEFT);
  $student_id = 'CSD2022M' .$get_string;

}



$query = "INSERT INTO students (student_id, username, phone, gender, dob, address, email) VALUES ('$student_id', '$username','$phone','$gender', '$dob', '$address','$email')";
$query_run = mysqli_query($connection,$query);

      if ($query_run) 
        {

          move_uploaded_file($_FILES['faculty_image']["name"], "Members_Images/".$_FILES['faculty_image']["name"]);
          $_SESSION['status'] = $username. " Added Successfully.  Student ID : " .$student_id;
          $_SESSION['status_code'] = "success";
          header('Location: viewAdminPage.php');
        }
        else
          {
            $_SESSION['status'] = "Student not Added";
            $_SESSION['status_code'] = "error";
            header('Location: viewAdminPage.php');
          }





    }



    if ($get_string == 10000) {
        
      $_SESSION['status'] = "Registration of members is limited";
      $_SESSION['status_code'] = "error";
      header('Location: viewAdminPage.php');

    }



// else{

//   $get_string++;

//   $membershipID = "HGT00".$get_string;
//   $insert_query = "INSERT INTO members (membershipNo, username, phone, gender, marital_status, dob, occupation, place_of_work, residence, department, tithe, year_baptised,home_town,region, country, usertype, `images`) VALUES ('$membershipID', '$username','$phone','$gender', '$marital_status', '$dob', '$occupation','$place_of_work','$residence','$department','$tithe','$year_baptised', '$home_town', '$region', '$country', '$usertype', '$images')";
//   $query_run = mysqli_query($connection, $insert_query);
//   if ($query_run) 
//   {

//     move_uploaded_file($_FILES['faculty_image']["name"], "Members_Images/".$_FILES['faculty_image']["name"]);
//     $_SESSION['status'] = "Member Added Successfully Membership No : " .$membershipID;
//     $_SESSION['status_code'] = "success";
//     header('Location: viewAllMembersPage.php');
//   }

//   else
//   {
//     $_SESSION['status'] = "Member not Added";
//     $_SESSION['status_code'] = "error";
//     header('Location: viewAllMembersPage.php');
//   }

// }
    






        

    }}}    }  
  }



//  }




















//Update Session

if (isset($_POST['update_btn']))
 {

    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $phone = $_POST['edit_phone'];
    $gender = $_POST['edit_gender'];
    $address = $_POST['edit_address'];
    $dob = $_POST['edit_dob'];
    $email = $_POST['edit_email'];




    
    $query = "UPDATE students SET username='$username', phone='$phone', gender='$gender', dob='$dob', email='$email', address='$address'  WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) 
    {   
      $_SESSION['status'] =  $username. " Information updated successfully";
      $_SESSION['status_code'] = "success";
      header('Location: viewAdminPage.php');
    }
    else
    {
      $_SESSION['status'] = "Student data not updated";
      $_SESSION['status_code'] = "error";
      header('Location: viewAdminPage.php');
    }

 }












//REGISTER DELETE CODE

if (isset($_POST['delete_btn'])) 
{
     $id = $_POST['delete_id'];

     $query = "DELETE FROM students WHERE id='$id' ";
     $query_run = mysqli_query($connection, $query);
     

    if ($query_run) 
    {
      $_SESSION['status'] = "Student data is  Deleted";
      $_SESSION['status_code'] = "success";
         header('Location: viewAdminPage.php');
    }
    else
    {
      $_SESSION['status'] = "Your data is not Delete";
      $_SESSION['status_code'] = "error";
      header('Location: viewAdminPage.php');
    } 
}






?>

