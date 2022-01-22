<?php
session_start();
$thispage='dashboard';
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: index.php");
  exit();
  }

  if(isset($_POST['delete'])){

    $sid=$_POST['sid'];
    
     
    $delete = $conn->query("DELETE FROM `participantsinfocenter` WHERE `study_id`='$sid'");
    if($delete){
      $statusMsg= "Toast.fire({
    icon: 'success',
    padding: '3em',  
    background: '#EBECEC',
    title: ' Participant Deleted Successfully.'
    });";               
    }else{
        echo mysqli_error($conn); 
      $statusMsg= "Toast.fire({
        icon: 'error',
        padding: '3em',
        background: '#EBECEC',
        title: ' Unable to delete Participant.'
      });";          
      } 
    
    }

   
    $totalpart= "SELECT *FROM `participantsinfocenter`"; 
 
    $totalpartnum = mysqli_query($conn,  $totalpart);

    $totalpartnum=(int)mysqli_num_rows ($totalpartnum);

    $totallipid= "SELECT *FROM `labvalues_lipid`";
 
    $totallipidnum = mysqli_query($conn, $totallipid);

    $totalcbc= "SELECT *FROM `labvalues_cbc`";
 
    $totalcbcnum = mysqli_query($conn, $totalcbc);

    $totalreports=(int)mysqli_num_rows ($totallipidnum) + (int)mysqli_num_rows ($totalcbcnum);


    $todayregis="SELECT * FROM `participantsinfocenter` WHERE DATE(`timestamp`) = CURDATE()";
    $todayregisnum = mysqli_query($conn, $todayregis);
    $todayregisnum=(int)mysqli_num_rows ($todayregisnum);

    function thousandsCurrencyFormat($num) {

      if($num>1000) {
    
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
    
            return $x_display;
    
      }
    
      return $num;
    }

?>


<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LIMS | Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <!-- Navbar -->
<?php
include 'header.php';
?>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <?php
if($_SESSION['role']!="DE"){
  echo '<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>'.thousandsCurrencyFormat($totalpartnum).'</h3>

          <p>Total Participants</p>
        </div>
        <div class="icon">
        <i class="fas fa-users"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>'.thousandsCurrencyFormat($totalreports).'</h3>

          <p>Total Test Results</p>
        </div>
        <div class="icon">
        <i class="fas fa-vials"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box  bg-danger">
        <div class="inner">
          <h3>'.thousandsCurrencyFormat($todayregisnum).'</h3>
         
          <p>Participants Registered Today</p>
        </div>
        <div class="icon">
        <i class="fas fa-truck-moving"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>10</h3>

          <p>Tests Performed Today</p>
        </div>
        <div class="icon">
        <i class="fas fa-spinner"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
   
  </div>
 
</div>';
  }

?>
      

      <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>MR #</th>
        <th>NAME</th>
        <th>AGE</th>
        <th>GENDER</th>
        <th>CONTACT</th>
        <th>DATE OF ENROLLMENT</th>
        <th class="nosort">Status</th>
        <th class="nosort">Options</th>
      </tr>
      </thead>
      <tbody >    




      </tbody>
    
    </table>     
    </div>
    



    
  </div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>CNCD LMS</h5>
      <!-- <p>CUSTOMIZE DASHBOARD</p> -->
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="https://www.cncdpk.com/">CNCD</a>.</strong>
    All rights reserved.
   
  </footer>
</div>





<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

<?php if(isset($statusMsg)){ echo $statusMsg; }?> 

         
  $(document).ready(function(){
   $('#example1').DataTable({
      "order": [[ 5, "desc" ]],
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'server_processing'
      },
      'aoColumnDefs': [{
        'bSortable': false,
        'aTargets': ['nosort']
    }],
    
      'columns': [
         { data: 'study_id' },
         { data: 'name' },
         { data: 'age' },
         { data: 'sex' },
         { data: 'contact_number' },
         { data: 'date_of_enrollment' },
         { data: 'status'},
         { data: 'optionbtns'},
      ]
   });
});



  if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

    $(document).ready(function() {
  setTimeout(function() {
    $('select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var invoiceId=this.id;
    var dataString = 'dashboardstatusvalue='+ valueSelected + '&dashboardstatusselect=' + invoiceId;

    event.preventDefault();

    $.ajax({
    method: "GET",
    url: "statusupdate.php",
    data: dataString,

  
    success: function(textStatus, status){
      console.log(textStatus);
        console.log(status);

        Toast.fire({
        icon: 'success',
        padding: '3em',
        background: '#EBECEC',
        title: 'Status Updated Successfully'
      });

  $(document).ready(function() {
  setTimeout(function() {
        location.reload();
        
      });
  }, 3000);
    },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });
    
    });
  }, 1000);
});
</script>
</body>
</html>
