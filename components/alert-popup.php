<?php
    if(isset($_SESSION['success'])){
?>
<div class="alert_cards alert_success card bg-success text-white col-sm-3" ondblclick="deleteDoubleClick(this.id)" id="success_alert_card">
    <div class="card-body">
        <div class="d-flex">
            <div class="icon_s mr-2">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="messages">
                <?php echo $_SESSION['success']; ?>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>

<?php
    if(isset($_SESSION['error'])){
?>
    <div class="alert_cards alert_success card bg-danger text-white col-sm-3" ondblclick="deleteDoubleClick(this.id)" id="error_alert_card">
        <div class="card-body">
            <div class="d-flex">
                <div class="icon_s mr-2">
                    <i class="fas fa-xmark-circle"></i>
                </div>
                <div class="messages">
                    <?php echo $_SESSION['error']; ?>
                </div>
            </div>
        </div>
    </div>
<?php
    }
?>



<style>
    .alert_cards{
        position: absolute;
        top: 0;
        right: 0;
        z-index: 34656457674;
        cursor: pointer;
    }
</style>

<script>
  const deleteDoubleClick = (e) => {
    document.getElementById(e).style.display = "none";

    var xhr = new XMLHttpRequest();
      // var url = 'https://admin.couplesnmoney.simbasms.com/services/delete-sesssion.php';
      var url = 'http://opgfarm.site/services/delete-sessions.php';

      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          console.log(e + "is the current session");
          // location.reload()
        }
      };

      xhr.send('name=' + encodeURIComponent(e));
  }
</script>