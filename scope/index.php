<?php
  include_once("../config.php");
  include_once("../model/Scope.php");
  include_once("../database/Database.php");
  $_SESSION['active'] = "scope";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Scoping</title>

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
            <h1 class="m-0">Project Scope</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>dashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Project Scope</li>
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
        Add Scope
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill the form to add scope</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="functions/save-scope-funct.php" method="post">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="project_name">Project</label>
                                <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Project Name e.g Shamba 1" required>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="Tonage">Season</label>
                                <input type="text" name="Tonage" id="Tonage" class="form-control" placeholder="Season e.g Season 1" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="size">Year</label>
                                <input type="text" name="size" id="size" class="form-control" placeholder="Year e.g 2021" required>
                            </div>
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
                    <th>Project</th>
                    <th>Season</th>
                    <th>Year</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = new Database();
                    $db   = $conn -> connection();

                    $projects = new Scope($db);
                    $project  = $projects -> getScopes();

                    if($project['status'] == 200){
                        foreach($project['data'] as $project){
                ?>
                <tr>
                    <td><?php echo $project['id'] ?></td>
                    <td><?php echo $project['Project'] ?></td>
                    <td><?php echo $project['Season'] ?></td>
                    <td><?php echo $project['Year'] ?></td>
                    <td><?php echo $project['Dateadded'] ?></td>
                    <td><a href="" id="<?php echo $project['id'] ?>" class="bg-primary text-white" data-toggle="modal" data-target="#exampleModal1" onclick="getActiveRecordId(this.id)">Edit</a><a href="functions/delete-scope-funct.php?scope=<?php echo $project['id'] ?>" class="bg-danger text-white">Delete</a></td>
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
                <form action="functions/update-scope-funct.php" method="post">
                    <div class="row">
                        <div class="form-group col-sm-12" style="display: none;">
                            <label for="project_name">Project</label>
                            <input type="text" name="updates" id="updates" class="form-control" placeholder="Project Name e.g Shamba 1" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="project_name">Project</label>
                            <input type="text" name="project_name" id="project_names" class="form-control" placeholder="Project Name e.g Shamba 1" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="Tonage">Season</label>
                            <input type="text" name="Tonage" id="Tonages" class="form-control" placeholder="Season e.g Season 1" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="size">Year</label>
                            <input type="text" name="size" id="sizes" class="form-control" placeholder="Year e.g 2021" required>
                        </div>
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
        var url = 'http://opgfarm.site/scope/functions/get-scope-funct.php';

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText; // Store the response in a variable
                var jsonResponse = JSON.parse(response);
                console.log(jsonResponse.data); // Display the response in the console
                document.getElementById("project_names").value = jsonResponse.data.Project
                document.getElementById("Tonages").value = jsonResponse.data.Season
                document.getElementById("sizes").value = jsonResponse.data.Year
            }
        };

        xhr.send('scope=' + encodeURIComponent(e));
    }
</script>