<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // READ recods on page load
      readRecords(); // calling function
    });

    // READ records
    function readRecords() {
        $.get("readRecord.php", {}, function (data, status) {
            $(".records_content").html(data);
        });
    }  
    // Add Record//
    function addRecord() {
        // get values
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var mobile = $("#mobile").val();


        // Add record
        $.post("addRecord.php", {
            first_name: first_name,
            last_name: last_name,
            email: email,
            mobile: mobile
        }, function (data, status) {
            // close the popup
            $("#add_new_record_modal").modal("hide");
     
            // read records again
            readRecords();
     
            // clear fields from the popup
            $("#first_name").val("");
            $("#last_name").val("");
            $("#email").val("");
            $("#mobile").val("");
        });
    }

    var sort_field;
    var sort_type;
    function sort_filter(field)
    {
      alert('hi');
        if (sort_type == undefined)
        {
            sort_type = 'asc';
        } else if (sort_type == 'asc')
        {
            sort_type = 'desc';
        } else if (sort_type == 'desc')
        {
            sort_type = 'asc';
        }
        sort_field = field;
        list_promocode();
    }




    function DeleteUser(id) {
        var conf = confirm("Are you sure, do you really want to delete User?");
        if (conf == true) {
            $.post("deleteUser.php", {
                    id: id
                },
                function (data, status) {
                    // reload Users by using readRecords();
                    readRecords();
                }
            );
        }
    }

 
    function GetUserDetails(id) {
        // Add User ID to the hidden field for furture usage
        $("#hidden_user_id").val(id);
        $.post("readUserDetails.php", {
                id: id
            },
            function (data, status) {
                // PARSE json data
                var user = JSON.parse(data);
                // Assing existing values to the modal popup fields
                $("#update_first_name").val(user.student_firstname);
                $("#update_last_name").val(user.student_lastname);
                $("#update_email").val(user.student_email);
                $("#update_mobile").val(user.student_mobile);
            }
        );
        // Open modal popup
        $("#update_user_modal").modal("show");
    }
 
    function UpdateUserDetails() {

        // get values
        var first_name = $("#update_first_name").val();
        var last_name = $("#update_last_name").val();
        var email = $("#update_email").val();
        var mobile = $("#update_mobile").val();
     
        // get hidden field value
        var id = $("#hidden_user_id").val();
     
        // Update the details by requesting to the server using ajax
        $.post("updateUserDetails.php", {
                id: id,
                first_name: first_name,
                last_name: last_name,
                email: email,
                mobile: mobile

            },
            function (data, status) {
                // hide modal popup
                $("#update_user_modal").modal("hide");
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
  </script>
</head>
<body>
<!-- Content Section -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Demo: PHP and MySQL CRUD Operations using Jquery</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Records:</h3>
 
            <div class="records_content"></div>
        </div>
    </div>
</div>
<!-- /Content Section -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="update_first_name">First Name</label>
                    <input type="text" id="update_first_name" placeholder="First Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_last_name">Last Name</label>
                    <input type="text" id="update_last_name" placeholder="Last Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_email">Email Address</label>
                    <input type="text" id="update_email" placeholder="Email Address" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="update_mobile">Mobile Number</label>
                    <input type="text" id="update_mobile" placeholder="Mobile Number" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                <input type="hidden" id="hidden_user_id">
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">
 
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" placeholder="First Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" placeholder="Last Name" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" placeholder="Email Address" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="email">Molile</label>
                    <input type="text" id="mobile" placeholder="Mobile Number" class="form-control"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

</body>
</html>
