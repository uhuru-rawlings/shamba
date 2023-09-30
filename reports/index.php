<?php
  include_once("../config.php");
  include_once("../model/Projects.php");
  include_once("../model/Scope.php");
  include_once("../model/Reports.php");
  include_once("../model/Expenditure.php");
  include_once("../database/Database.php");
  $_SESSION['active'] = "reports";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reports</title>

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
            <h1 class="m-0">Reports</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo BASE_URL ?>dashboard/index.php">Home</a></li>
              <li class="breadcrumb-item active">Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="all_expenses">
          <h2 class="mt-3 mb-3">All Expenses</h2>
        <div class="table-responsive py-5">
          <table class="table table-active table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Project</th>
                <th>Season</th>
                <th>Expenses</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Date Added</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  $conn = new Database();
                  $db   = $conn -> connection();

                  $project = new Projects($db);
                  $projects = $project -> getProjects();

                  if($projects['status'] == 200){
                    foreach($projects['data'] as $projects){
              ?>
              <tr>
                <td><?php echo $projects['id'] ?></td>
                <td><?php echo $projects['ProjectName'] ?></td>
                <td><?php echo $projects['Season'] ?></td>
                <td><?php echo $projects['Expense'] ?></td>
                <td><?php echo $projects['Amount'] ?></td>
                <td><?php echo $projects['Date'] ?></td>
                <td><?php echo $projects['DateAdded'] ?></td>
              </tr>
              <?php
                    }
                  }
              ?>
            </tbody>
          </table>
        </div>
        </div>
        <div class="search_report py-5">
          <form action="#" method="post">
            <div class="row">
              <div class="form-group col-sm-3">
                  <label for="years">Year</label>
                  <select name="years" id="years" class="form-control">
                      <option value=""> -- SELECT YEAR --</option>
                      <?php                            
                          $year = date('Y');
                          for($i = 0; $i < 15; $i++){
                            $f_year = $year - $i;
                            echo "<option value='{$f_year}'>{$f_year}</option>";
                          }
                      ?>
                  </select>
              </div>
              <div class="form-group col-sm-3">
                  <label for="project_name">Project Name</label>
                  <select name="project_name" id="project_names1" class="form-control">
                      <option value=""> -- SELECT PROJECT --</option>
                      <?php                            
                          $conn = new Database();
                          $db   = $conn -> connection();
                          $users = new Scope($db);
                          $user  = $users -> getDistinctProjectScopes();

                          if($user['status'] == 200){
                              foreach($user['data'] as $expense){
                                  echo "<option value='{$expense['Project']}'>{$expense['Project']}</option>";
                              }
                          }
                      ?>
                  </select>
              </div>
              <div class="form-group col-sm-3">
                  <label for="Season">Season</label>
                  <select name="Season" id="Seasons1" class="form-control">
                      <option value=""> -- SELECT SEASON --</option>
                      <?php                            
                          $conn = new Database();
                          $db   = $conn -> connection();
                          $users = new Scope($db);
                          $user  = $users -> getDistinctSeasonScopes();

                          if($user['status'] == 200){
                              foreach($user['data'] as $expense){
                                  echo "<option value='{$expense['Season']}'>{$expense['Season']}</option>";
                              }
                          }
                      ?>
                  </select>
              </div>
              <div class="form-group col-sm-3">
                <label for="expenditure">Expenditure</label>                
                <select name="expenditure" id="expenditures1" class="form-control">
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
            </div>
            <div class="form-group">
              <input type="submit" value="Search" onclick="return validateSearch()" class="btn btn-primary">
            </div>
          </form>
        </div>
      <div class="table-responsive">
        <?php
            $conn = new Database();
            $db   = $conn -> connection();

            $reports = new Reports($db);
            if(isset($_POST['project_name']) || isset($_POST['Season']) || isset($_POST['expenditure']) || isset($_POST['years'])){
              $reports -> projectName  = $_POST['project_name'];
              $reports -> Season       = $_POST['Season'];
              $reports -> Expenditure  = $_POST['expenditure'];
              $reports -> Year         = $_POST['years'];
              
              $report  = $reports -> searchReports();
            }else{
              $report  = $reports -> getReports();
            }
        ?>
            <div class="expenses">
            <?php
              $exp = [];
              if($report['status'] == 200){
                foreach($report['data'] as $rep){
                  array_push($exp,$rep['Expense']);
                }
                $repeatedValues = array_diff_key($exp, array_unique($exp));

                echo "<b>All Expenses:-</b> ".implode(",", $exp);
                echo "<br>";
                echo "<b>Shared Expenses:-</b> ".implode(",", $repeatedValues);
              }
            ?>
            </div>
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
                if($report['status'] == 200){
                  foreach($report['data'] as $report){
              ?>
                <tr>
                    <td><?php echo $report['id'] ?></td>
                    <td><?php echo $report['ProjectName'] ?></td>
                    <td><?php echo $report['Season'] ?></td>
                    <td><?php  if($report['total_amount']){ echo number_format($report['total_amount']); }else{ echo $report['Amount']; } ?></td>
                    <td><a href="detailed-reports.php?p=<?php echo $report['ProjectName'] ?>&s=<?php echo $report['Season'] ?>" class="bg-primary text-white">see details</a>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
      </div>

      <div class="report_by_project" id="project">
        <h2 class="mt-3 mb-3">Report: Cost by Project</h2>
        <form action="#project" method="get">
          <div class="row d-flex align-items-center">
            <div class="form-group col-sm-4">
                <label for="project">Project Name</label>
                <select name="project" id="project" class="form-control" required>
                    <option value=""> -- SELECT PROJECT --</option>
                    <?php                            
                        $conn = new Database();
                        $db   = $conn -> connection();
                        $users = new Scope($db);
                        $user  = $users -> getDistinctProjectScopes();
  
                        if($user['status'] == 200){
                            foreach($user['data'] as $expense){
                                echo "<option value='{$expense['Project']}'>{$expense['Project']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-2 form-group">
              <input type="submit" value="Search" class="btn btn-primary">
            </div>
          </div>
        </form>
        <div class="table-responsive py-5">
          <table class="table table-active table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Project</th>
                <th>Season</th>
                <th>Expenses</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Date Added</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($_GET['project'])){
                  $conn = new Database();
                  $db   = $conn -> connection();

                  $project = new Projects($db);
                  $project -> ProjectName = $_GET['project'];
                  $projects = $project -> getProjectByProjectName();

                  if($projects['status'] == 200){
                    foreach($projects['data'] as $projects){
              ?>
              <tr>
                <td><?php echo $projects['id'] ?></td>
                <td><?php echo $projects['ProjectName'] ?></td>
                <td><?php echo $projects['Season'] ?></td>
                <td><?php echo $projects['Expense'] ?></td>
                <td><?php echo $projects['Amount'] ?></td>
                <td><?php echo $projects['Date'] ?></td>
                <td><?php echo $projects['DateAdded'] ?></td>
              </tr>
              <?php
                    }
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="report_by_project" id="seasons1">
        <h2 class="mt-3 mb-3">Report: Seasons per Year</h2>
        <form action="#seasons1" method="get">
          <div class="row d-flex align-items-center">
            <div class="form-group col-sm-4">
                <label for="years">Year</label>
                <select name="years" id="years" class="form-control">
                    <option value=""> -- SELECT YEAR --</option>
                    <?php                            
                        $year = date('Y');
                        for($i = 0; $i < 15; $i++){
                          $f_year = $year - $i;
                          echo "<option value='{$f_year}'>{$f_year}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label for="seasons">Project Season</label>
                <select name="seasons" id="seasons" class="form-control" required>
                    <option value=""> -- SELECT SEASON --</option>
                    <?php                            
                        $conn = new Database();
                        $db   = $conn -> connection();
                        $users = new Scope($db);
                        $user  = $users -> getDistinctSeasonScopes();
  
                        if($user['status'] == 200){
                            foreach($user['data'] as $expense){
                                echo "<option value='{$expense['Season']}'>{$expense['Season']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-2 form-group">
              <input type="submit" value="Search" class="btn btn-primary">
            </div>
          </div>
        </form>
        <div class="table-responsive py-5">
          <div class=""><b>Season: <?php echo $_GET['seasons']; ?></b></div>
          <div class=""><b>Date: <?php echo $_GET['years']; ?></b></div>
          <table class="table table-active table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Project</th>
                <th>Season</th>
                <th>Expenses</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Date Added</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($_GET['seasons'])){
                  $conn = new Database();
                  $db   = $conn -> connection();

                  $project = new Projects($db);
                  $project -> Season = $_GET['seasons'];
                  $project -> Date = $_GET['years'];
                  $projects = $project -> getProjectBySeasonPerYear();

                  if($projects['status'] == 200){
                    foreach($projects['data'] as $projects){
              ?>
              <tr>
                <td><?php echo $projects['id'] ?></td>
                <td><?php echo $projects['ProjectName'] ?></td>
                <td><?php echo $projects['Season'] ?></td>
                <td><?php echo $projects['Expense'] ?></td>
                <td><?php echo $projects['Amount'] ?></td>
                <td><?php echo $projects['Date'] ?></td>
                <td><?php echo $projects['DateAdded'] ?></td>
              </tr>
              <?php
                    }
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
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

<script>
  const validateSearch = () => {
    let project_names = document.getElementById('project_names1').value.trim();
    let Seasons = document.getElementById('Seasons1').value.trim();
    let expenditures = document.getElementById('expenditures1').value.trim();
    let years = document.getElementById('years').value.trim();


    if(project_names == "" && Seasons == "" && expenditures == "" && years == ""){
      alert('please select a search item');
      return false;
    }else{
      return true;
    }
  }
</script>

<script>
    const getActiveRecordId = (e) => {
        document.getElementById("updates").value = e;

        console.log(e)
        var xhr = new XMLHttpRequest();
        var url = 'http://opgfarm.site/projects/functions/get-projects-funct.php';

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText; // Store the response in a variable
                var jsonResponse = JSON.parse(response);
                console.log(jsonResponse.data); // Display the response in the console
                document.getElementById("project_names").value = jsonResponse.data.ProjectName
                document.getElementById("Tonages").value = jsonResponse.data.Tonage
                document.getElementById("sizes").value = jsonResponse.data.Size
                document.getElementById("Seasons").value = jsonResponse.data.Season
                document.getElementById("amounts").value = jsonResponse.data.Amount
                document.getElementById("dates").value = jsonResponse.data.Date
            }
        };

        xhr.send('project=' + encodeURIComponent(e));
    }
</script>