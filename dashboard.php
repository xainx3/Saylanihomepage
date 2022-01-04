<?php
session_start();
$thispage='dashboard';
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: index.php");
  exit();
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
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  
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
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>160</h3>

                <p>Total Samples</p>
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
            <div class="small-box bg-success">
              <div class="inner">
                <h3>126</h3>

                <p>Received Samples</p>
              </div>
              <div class="icon">
              <i class="fas fa-mail-bulk"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box  bg-danger">
              <div class="inner">
                <h3>24</h3>

                <p>In Transit</p>
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

                <p>In Process</p>
              </div>
              <div class="icon">
              <i class="fas fa-spinner"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
         
        </div>
       
      </div>

      <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>MR #</th>
        <th>NAME</th>
        <th>AGE</th>
        <th>GENDER</th>
        <th>CONTACT</th>
        <th>Status</th>
        <th>Options</th>
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
<!-- ./wrapper -->


<!-- MODALS -->
<div class='modal fade' id='modal-danger1'>
        <div class='modal-dialog'>
          <div class='modal-content bg-danger'>
       
            <div class='modal-body'>
              <p class='text-center'>Are you sure you want to remove this user?</p>
            </div>
            <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
            
            <form method='post'>

<input type='hidden' value='".$row1['uid']."' name='duid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

          </form>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class='modal fade' id='modal-danger2'>
        <div class='modal-dialog'>
          <div class='modal-content bg-danger'>
       
            <div class='modal-body'>
              <p class='text-center'>Are you sure you want to remove this user?</p>
            </div>
            <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
            
            <form method='post'>

<input type='hidden' value='".$row1['uid']."' name='duid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

          </form>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class='modal fade' id='modal-danger3'>
        <div class='modal-dialog'>
          <div class='modal-content bg-danger'>
       
            <div class='modal-body'>
              <p class='text-center'>Are you sure you want to remove this user?</p>
            </div>
            <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
            
            <form method='post'>

<input type='hidden' value='".$row1['uid']."' name='duid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

          </form>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class='modal fade' id='modal-danger4'>
        <div class='modal-dialog'>
          <div class='modal-content bg-danger'>
       
            <div class='modal-body'>
              <p class='text-center'>Are you sure you want to remove this user?</p>
            </div>
            <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
            
            <form method='post'>

<input type='hidden' value='".$row1['uid']."' name='duid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

          </form>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class='modal fade' id='modal-danger5'>
        <div class='modal-dialog'>
          <div class='modal-content bg-danger'>
       
            <div class='modal-body'>
              <p class='text-center'>Are you sure you want to remove this user?</p>
            </div>
            <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
            
            <form method='post'>

<input type='hidden' value='".$row1['uid']."' name='duid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

          </form>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class='modal fade' id='modal-danger6'>
        <div class='modal-dialog'>
          <div class='modal-content bg-danger'>
       
            <div class='modal-body'>
              <p class='text-center'>Are you sure you want to remove this user?</p>
            </div>
            <div class='modal-footer justify-content-between'>
              <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
            
            <form method='post'>

<input type='hidden' value='".$row1['uid']."' name='duid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

          </form>
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



      <!-- MODALS END -->
<!-- REQUIRED SCRIPTS -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<!-- <script src="dist/js/demo.js"></script> -->
<script src="dist/js/pages/dashboard.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false
     
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": false,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });


         
  $(document).ready(function(){
   $('#example1').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':'server_processing.php'
      },
      'columns': [
         { data: 'study_id' },
         { data: 'name' },
         { data: 'age' },
         { data: 'sex' },
         { data: 'contact_number' },
         { data: 'status'},
         { data: 'optionbtns'},
      ]
   });
});

  if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
</script>
</body>
</html>
