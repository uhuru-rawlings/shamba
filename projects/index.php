<?php
  include_once("../config.php");
  include_once("../model/Projects.php");
  include_once("../model/Scope.php");
  include_once("../model/Expenditure.php");
  include_once("../database/Database.php");
  $_SESSION['active'] = "project";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Farm</title>

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
            <h1 class="m-0">Farm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>dashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Farm</li>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add Expenditure
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill the form to add expenditure</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/save-projects-func.php" method="post">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="project_name">Project Name</label>
                                <select name="project_name" id="project_name" class="form-control">
                                    <option value=""> -- SELECT PROJECT --</option>
                                    <?php                            
                                        $conn = new Database();
                                        $db   = $conn -> connection();
                                        $users = new Scope($db);
                                        $user  = $users -> getScopes();

                                        if($user['status'] == 200){
                                            foreach($user['data'] as $expense){
                                                echo "<option value='{$expense['Project']}'>{$expense['Project']}</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="Season">Season</label>
                                <select name="Season" id="Season" class="form-control" required>
                                    <option value=""> -- SELECT SEASON --</option>
                                    <?php                            
                                        $conn = new Database();
                                        $db   = $conn -> connection();
                                        $users = new Scope($db);
                                        $user  = $users -> getScopes();
    
                                        if($user['status'] == 200){
                                            foreach($user['data'] as $expense){
                                                echo "<option value='{$expense['Season']}'>{$expense['Season']}</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Expenditure</label>
                            <select name="expenditure" id="expenditure" class="form-control" required>
                                <option value=""> -- SELECT EXPENDITURE --</option>
                                <?php                            
                                    $conn = new Database();
                                    $db   = $conn -> connection();
                                    $users = new Expenditure($db);
                                    $user  = $users -> getExpenses();

                                    if($user['status'] == 200){
                                        foreach($user['data'] as $expense){
                                        echo "<option value='{$expense['Expense']}'>{$expense['Expense']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Save Records" class="btn btn-primary">
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
        <table class="table table-active table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Season</th>
                    <th>Expense</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = new Database();
                    $db   = $conn -> connection();

                    $projects = new Projects($db);
                    $project  = $projects -> getProjects();

                    if($project['status'] == 200){
                        foreach($project['data'] as $project){
                ?>
                <tr>
                    <td><?php echo $project['id'] ?></td>
                    <td><?php echo $project['ProjectName'] ?></td>
                    <td><?php echo $project['Season'] ?></td>
                    <td><?php echo $project['Expense'] ?></td>
                    <td><?php echo $project['Amount'] ?></td>
                    <td><?php echo $project['Date'] ?></td>
                    <td><?php echo $project['DateAdded'] ?></td>
                    <td><a href="" id="<?php echo $project['id'] ?>" class="bg-primary text-white" data-toggle="modal" data-target="#exampleModal1" onclick="getActiveRecordId(this.id)">Edit</a><a href="functions/delete-project-funct.php?project=<?php echo $project['id'] ?>" class="bg-danger text-white">Delete</a></td>
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
                <form action="functions/update-projects-func.php" method="post">
                    <div class="form-group" style="display: none;">
                        <input type="text" name="updates" id="updates" class="form-control" placeholder="Project Name" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="project_name">Project Name</label>
                            <select name="project_name" id="project_names" class="form-control">
                                <option value=""> -- SELECT PROJECT --</option>
                                <?php                            
                                    $conn = new Database();
                                    $db   = $conn -> connection();
                                    $users = new Scope($db);
                                    $user  = $users -> getScopes();

                                    if($user['status'] == 200){
                                        foreach($user['data'] as $expense){
                                            echo "<option value='{$expense['Project']}'>{$expense['Project']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="Season">Season</label>
                            <select name="Season" id="Seasons" class="form-control" required>
                                <option value=""> -- SELECT SEASON --</option>
                                <?php                            
                                    $conn = new Database();
                                    $db   = $conn -> connection();
                                    $users = new Scope($db);
                                    $user  = $users -> getScopes();
    
                                    if($user['status'] == 200){
                                        foreach($user['data'] as $expense){
                                            echo "<option value='{$expense['Season']}'>{$expense['Season']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">Expenditure</label>
                        <select name="expenditure" id="expenditures" class="form-control" required>
                            <option value=""> -- SELECT EXPENDITURE --</option>
                            <?php                            
                                $conn = new Database();
                                $db   = $conn -> connection();
                                $users = new Expenditure($db);
                                $user  = $users -> getExpenses();

                                if($user['status'] == 200){
                                    foreach($user['data'] as $expense){
                                        echo "<option value='{$expense['Expense']}'>{$expense['Expense']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amounts" class="form-control" placeholder="Amount" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="dates" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save Records" class="btn btn-primary">
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
        // var url = 'http://opgfarm.site/projects/functions/get-projects-funct.php';
        var url = 'functions/get-projects-funct.php';

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText; // Store the response in a variable
                var jsonResponse = JSON.parse(response);
                console.log(jsonResponse.data); // Display the response in the console
                document.getElementById("project_names").value = jsonResponse.data.ProjectName
                // document.getElementById("Tonages").value = jsonResponse.data.Tonage
                // document.getElementById("sizes").value = jsonResponse.data.Size
                document.getElementById("Seasons").value = jsonResponse.data.Season
                document.getElementById("amounts").value = jsonResponse.data.Amount
                document.getElementById("dates").value = jsonResponse.data.Date
            }
        };

        xhr.send('project=' + encodeURIComponent(e));
    }
</script>