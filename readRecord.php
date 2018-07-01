<?php
	// include Database connection file 
	include("conn.php");

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email Address</th>
							<th>Mobile No</th>
							<th>Action</th>
						</tr>';

	$query = "SELECT * FROM tbl_student";

	if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($result) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($result))
    	{
    		$data .= '<tr>
				<td>'.$number.'</td>
				<td>'.$row['student_firstname'].'</td>
				<td>'.$row['student_lastname'].'</td>
				<td>'.$row['student_email'].'</td>
				<td>'.$row['student_mobile'].'</td>
				<td>
					<button onclick="GetUserDetails('.$row['student_id'].')" class="btn btn-warning">Update</button>
					<button onclick="DeleteUser('.$row['student_id'].')" class="btn btn-danger">Delete</button>
				</td>
    		</tr>';
    		$number++;
    	}
    }
    else
    {
    	// records now found 
    	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
    }

    $data .= '</table>';

    echo $data;
?>