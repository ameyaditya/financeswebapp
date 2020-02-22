<?php
session_start();
if (!isset($_SESSION['session'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Delete Account</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        #main-heading {
            font-size: 2em;
            margin-top: 30px;
            text-align: center;
            font-family: sans-serif;
        }

        @media screen and (min-width: 700px) {
            .container-fluid {
                color: white;
                font-size: 2em;
            }
        }

        @media screen and (max-width: 700px) {
            .container-fluid {
                color: white;
                font-size: 1.5em;
            }
        }
    </style>

    <script>

        function validate() {
            if ($("#accountno").val() == "") {
                alert("Enter Account No.");
                return false;
            }
            if ($("#delpassword").val() == "") {
                alert("Enter Password.");
                return false;
            }
            return true;
        }

        function submitdelete() {
            if (validate()) {
                $.ajax({
                    type: "post",
                    url: "/endpoints/getaccount.php",
                    data: {
                        "accountno": $("#accountno").val(),
                        "delpassword": $("#delpassword").val(),
                        "submit": "get_Account"
                    },
                    success: function(obj) {
                        var data = JSON.parse(obj);
                        if (data['statuscode'] == 1) {
                            $("#account-modal-input").val(data['data']['Account_no']);
                            $('#account-modal-name').val(data['data']['Name']);
                            $('#account-modal-balance').val(data['data']['Balance']);
                            $("#account-box").modal('show');
                        }
                        else{
                            $('#error-code').text(data['statuscode']);
                            $('#error-message').text(data['message']);
                            $('#error-box').modal('show');
                        }
                    }
                });
            }
        }

        function deleteaccount() {
            $('#account-box').modal('hide');
            if (validate()) {
                $.ajax({
                    type: "post",
                    url: "/endpoints/deleteaccount.php",
                    data: {
                        "accountno": $("#accountno").val(),
                        "delpassword": $("#delpassword").val(),
                        "submit": "get_Account"
                    },
                    success: function(obj){
                        var data = JSON.parse(obj);
                        if(data['statuscode'] == 1){
                            $('#accno').text(data['data']);
                            $('#delete-box').modal('show');
                        }
                        else{
                            $('#error-code').text(data['statuscode']);
                            $('#error-message').text(data['message']);
                            $('#error-box').modal('show');
                        }
                    }
                });
            }
        }
    </script>
</head>

<body>
<div class="modal fade" id="error-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            <div class="lead">Got the Error code:<span id="error-code"></span> with the error message:<span id="error-message"></span></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="delete-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Successfully Deleted</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
            </div class="lead">Successfully deleted the account  with number: <span id="accno"></span></div>
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="modal fade" id="account-box" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Account Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container forms">
                        <div class="form-group">
                            <label for="account-modal-no">Account No</label>
                            <input type="text" name="account-modal-input" id="account-modal-input" class="form-control" placeholder="Enter Account No." disabled>
                        </div>
                        <div class="form-group">
                            <label for="account-modal-name">Name</label>
                            <input type="text" name="account-modal-name" id="account-modal-name" class="form-control" placeholder="Enter Account No." disabled>
                        </div>
                        <div class="form-group">
                            <label for="account-modal-balance">Outstanding Balance</label>
                            <input type="text" name="account-modal-balance" id="account-modal-balance" class="form-control" placeholder="Enter Account No." disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="button" class="btn btn-primary btn-danger" onclick="deleteaccount()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container-fluid">Amity Ramapriya Finances
        </div>
        <button class="btn btn-light navbar-right" onclick="window.location.href='homepage.php' ">Home</button>
    </nav>
    <h1 class="display-4" id="main-heading">Delete Account</h1>
    <div class="container forms">
        <div class="form-group">
            <label for="accountno">Enter Account No. to delete</label>
            <input type="text" name="accountno" id="accountno" class="form-control" placeholder="Enter Account No." required>
        </div>
        <div class="form-group">
            <label for="accountno">Enter Password</label>
            <input type="password" name="delpassword" id="delpassword" class="form-control" placeholder="Enter password" required>
        </div>
        <button class="btn btn-primary" id="submit-account" onclick="submitdelete()" style="width: 100%">
            Submit
        </button>
    </div>
</body>

</html>