<?php
  include_once("../config.php");
  include_once("../model/Registration.php");
  include_once("../model/Reports.php");
  include_once("../database/Database.php");
  include_once("../model/Cashflow.php");
  $_SESSION['active'] = "home";
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>dashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <?php
                    $conn = new Database();
                    $db   = $conn -> connection();
                    $flows = new Cashflow($db);
                    $flows_c = $flows -> getAllAmount();
                    $total = 0;

                    if($flows_c['status'] == 200){
                      foreach($flows_c['data'] as $cash){
                        $total += $cash['Amount'];
                      }
                    }
                    echo number_format($total);
                  ?>
                </h3>

                <p>Total Cashflow</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar"></i>
              </div>
              <a href="../user/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php
                    $conn = new Database();
                    $db   = $conn -> connection();
                    $users = new Reports($db);
                    echo $users -> projectsCount();
                  ?>
                </h3>

                <p>Projects</p>
              </div>
              <div class="icon">
                <i class="fas fa-tractor"></i>
              </div>
              <a href="../projects/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                  <?php
                    $conn = new Database();
                    $db   = $conn -> connection();
                    $users = new Reports($db);
                    echo $users -> expenseCount();
                  ?>
                </h3>

                <p>Expenditure</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar"></i>
              </div>
              <a href="../expenditure/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <?php
                    $conn = new Database();
                    $db   = $conn -> connection();
                    $users = new Reports($db);
                    echo number_format($users -> expenseTotal());
                  ?>
                </h3>

                <p>Total Expenditures</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="../reports/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <h2>Cash Flows Tables</h2>
      <div class="table-responsive mb-5">
        <table class="table table-active table-hover">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Fname</th>
                  <th>Lname</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Amount</th>
                  <th>Date Added</th>
              </tr>
          </thead>
          <tbody>
              <?php
                  $conn = new Database();
                  $db   = $conn -> connection();
                  $users = new Cashflow($db);
                  $user  = $users -> getCashFlow();

                  if($user['status'] == 200){
                      foreach($user['data'] as $user){
              ?>
                  <tr>
                      <td><?php echo $user['id'] ?></td>
                      <td><?php echo $user['Fname'] ?></td>
                      <td><?php echo $user['Lname'] ?></td>
                      <td><?php echo "<a href='mailto:{$user['Email']}'>{$user['Email']}</a>" ?></td>
                      <td><?php echo "<a href='tel:{$user['Phone']}'>{$user['Phone']}</a>" ?></td>
                      <td><?php echo number_format($user['Amount']) ?></td>
                      <td><?php echo $user['dateAdded'] ?></td>
                  </tr>
              <?php
                      }
                  }
              ?>
          </tbody>
        </table>
      </div>


      <h2>Users Table</h2>
      <div class="table-responsive mb-5">
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
                  </tr>
              <?php
                      }
                  }
              ?>
          </tbody>
        </table>
      </div>


      <div class="table-responsive mb-5">
        <h2>Reports Table</h2>
        <table class="table table-active table-stripped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project</th>
                    <th>Season</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = new Database();
                    $db   = $conn -> connection();

                    $reports = new Reports($db);
                    $report  = $reports -> getReports();

                    if($report['status'] == 200){
                        foreach($report['data'] as $report){
                ?>
                <tr>
                    <td><?php echo $report['id'] ?></td>
                    <td><?php echo $report['ProjectName'] ?></td>
                    <td><?php echo $report['Season'] ?></td>
                    <td><?php echo number_format($report['total_amount']) ?></td>
                    <td><a href="../reports/detailed-reports.php?p=<?php echo $report['ProjectName'] ?>&s=<?php echo $report['Season'] ?>" class="bg-primary text-white">see details</a>
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
