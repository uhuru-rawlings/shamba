<?php
  include_once("../config.php");
  include_once("../model/Registration.php");
  include_once("../database/Database.php");
  $_SESSION['active'] = "user";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo BASE_URL ?>plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/custom.css">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<?php include_once("../components/alert-popup.php"); ?>
<div class="wrapper">
  <!-- Navbar -->
  <?php include_once("../components/top-nav.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include_once("../components/side-nav.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>dashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      <div class="open_model mb-5">
        <!-- Button trigger modal -->
        <div class="d-flex">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add User
            </button>
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModal1">
                Add CashFlow
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill the form to add user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/save-user-func.php" method="post">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="Fname">First Name</label>
                                <input type="text" name="Fname" id="Fname" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Lname">Last Name</label>
                                <input type="text" name="Lname" id="Lname" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="Email">Email</label>
                                <input type="email" name="Email" id="Email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Phone">Phone</label>
                                <input type="tel" name="Phone" id="Phone" class="form-control" placeholder="Phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_again">Password Again</label>
                            <input type="password" name="password_again" id="password_again" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Save User" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Fill the form to add user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/save-cashflow-func.php" method="post">
                        <div class="form-group">
                            <label for="User">User (optional)</label>
                            <select name="User" id="User" class="form-control" placeholder="User">
                                <option value="">--SELECT USER--</option>
                                <?php
                                    $conn = new Database();
                                    $db   = $conn -> connection();

                                    $users = new Registration($db);
                                    $user  = $users -> getUsers();

                                    if($user['data']){
                                        foreach($user['data'] as $user){
                                ?>
                                <option value="<?php echo $user['id'] ?>"><?php echo $user['Fname'].' '.$user['Lname'] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Amount">Amount</label>
                            <input type="number" name="Amount" id="Amount" class="form-control" placeholder="Amount" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Save Amount" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
      </div>
      <div class="table-responsive">
      <table class="table table-active table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Fname</th>
                <th>Lname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conn = new Database();
                $db   = $conn -> connection();
                $users = new Registration($db);
                $user  = $users -> getUsers();

                if($user['status'] == 200){
                    foreach($user['data'] as $user){
            ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['Fname'] ?></td>
                    <td><?php echo $user['Lname'] ?></td>
                    <td><?php echo $user['Email'] ?></td>
                    <td><?php echo $user['Phone'] ?></td>
                    <td><?php echo $user['Roles'] ?></td>
                    <td><?php echo $user['DateAdded'] ?></td>
                    <td><a href="" id="<?php echo $user['id'] ?>" class="bg-primary text-white" data-toggle="modal" data-target="#exampleModal1" onclick="getActiveRecordId(this.id)">Edit</a><a href="functions/delete-user-func.php?user=<?php echo $user['id'] ?>" class="bg-danger text-white">Delete</a></td>
                </tr>
            <?php
                    }
                }
            ?>
        </tbody>
        </table>
      </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Update user records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="functions/update-user-func.php" method="post">
                    <div class="form-group col-sm-12" style="display: none;">
                        <input type="text" name="updates" id="updates" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="Fname">First Name</label>
                            <input type="text" name="Fname" id="Fnames" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="Lname">Last Name</label>
                            <input type="text" name="Lname" id="Lnames" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="Email">Email</label>
                            <input type="email" name="Email" id="Emails" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="Phone">Phone</label>
                            <input type="tel" name="Phone" id="Phones" class="form-control" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_again">Password Again</label>
                        <input type="password" name="password_again" id="password_again" class="form-control" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update Record" class="btn btn-primary">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include_once("../components/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script src="<?php echo BASE_URL ?>assets/js/tables.js"></script>
<script src="<?php echo BASE_URL ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo BASE_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?php echo BASE_URL ?>dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo BASE_URL ?>plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo BASE_URL ?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo BASE_URL ?>dist/js/pages/dashboard3.js"></script>
</body>
</html>


<script>
    const getActiveRecordId = (e) => {
        document.getElementById("updates").value = e;

        console.log(e)
        var xhr = new XMLHttpRequest();
        var url = 'functions/get-users-func.php';

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText; // Store the response in a variable
                var jsonResponse = JSON.parse(response);
                console.log(jsonResponse.data); // Display the response in the console
                document.getElementById("Fnames").value = jsonResponse.data.Fname
                document.getElementById("Lnames").value = jsonResponse.data.Lname
                document.getElementById("Emails").value = jsonResponse.data.Email
                document.getElementById("Phones").value = jsonResponse.data.Phone
            }
        };

        xhr.send('user=' + encodeURIComponent(e));
    }
</script>