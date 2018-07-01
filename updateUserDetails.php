<?php
// include Database connection file
include("conn.php");

// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // Updaste User details
    $query = "UPDATE tbl_student SET student_firstname = '$first_name', student_lastname = '$last_name', student_email = '$email',student_mobile='$mobile' WHERE student_id = '$id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}