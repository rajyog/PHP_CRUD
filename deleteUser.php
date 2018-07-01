<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    include("conn.php");

    // get user id
    $user_id = $_POST['id'];

    // delete User
    $query = "DELETE FROM tbl_student WHERE student_id = '$user_id'";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}
?>