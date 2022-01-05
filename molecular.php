<?php
session_start();
$thispage = 'mole';
include "connection/connection.php";

if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

// if(isset($_GET['sampleid'])){

//     $userid=$_GET['sampleid'];
    
// }

// if(!isset($_GET['sampleid'])){

//   header("Location: users.php");
  
// }

if(isset($_POST['submit'])){



$fname=$_POST['fname'];
$email=$_POST['email'];
$password=$_POST['password'];
$contact=$_POST['contact'];
$role=$_POST['role'];





}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CNCD - UPDATE USER</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<style>

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'header.php'  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href=index.php>Home</a></li>
              <li class="breadcrumb-item active">Molecular</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




<section>

<table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME OF TEST</th>
        <th>DATE OF EXTRACTIONd</th>
        <th>STATUS</th>
        <!-- <th>VIEW DETAILS</th> -->
      </tr>
      </thead>
      <tbody >    

<tr>


<td>FY-5025-bb4c61d7664de191 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>DNA</td>
<td>28/12/2021</td>
<td>
<div class="form-group">
                        <select class="form-control bg-danger">
                          <option selected>Pending</option>
                          <option >Processing</option>
                          <option >Completed</option>
                         
                        </select>
                      </div>
</td>

</tr>

<tr>

<tr>





      </tbody>
    
    </table>      

</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="https://www.cncdpk.com/">CNCD</a>.</strong>
    All rights reserved.
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>

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

    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }

    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }

 
   
</script>
</body>
</html>
