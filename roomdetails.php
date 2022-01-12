<?php
$thispage = 'storage';

session_start();
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

if(isset($_GET['roomid'])){

    $roomid=$_GET['roomid'];

    
    
}

if(!isset($_GET['roomid'])){

  header("Location: storage.php");
  
}

if(isset($_POST['updateroom'])){



    $roomname=$_POST['roomname'];
    
    $insert = $conn->query("UPDATE `freezerroom` SET `roomname`='$roomname' WHERE `frid`='$roomid'");
        
    if($insert){
          $statusMsg= "Toast.fire({
      icon: 'success',
      padding: '3em',  
      background: '#EBECEC',
      title: ' Room Updated Successfully.'
      });";               
        
    }
      }



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CNCD - UPDATE FREEZER</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<style>
 a.disabled:hover {
    cursor:not-allowed !important;
 }
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
              <li class="breadcrumb-item active">Patient Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php

$sql1 = "SELECT * FROM `freezerroom` WHERE `frid`=$roomid"; 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 

    $frid=$row1['frid'];
    $roomname=$row1['roomname'];
   

}


?> 
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
  
      
         
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Details of <b> <i > <?php echo $roomname ?></i></b></h3>
              </div>
   

              <form method="POST" action="" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="row">
                <div class="form-group col-md-12">
                    <label >Room Name</label>
                    <input type="name" class="form-control"  placeholder="Enter Freezer Room Name" value="<?php echo $roomname ?>" name="roomname" required >
                  </div>
               
                 

          
                     
           
                  </div>
 
</div>
                
                </div>

                <div class="col-md-12 text-center mb-5">
                  <button type="submit" class="btn btn-primary btn-block btn-lg" name="updateroom">Update</button>
                </div>
               
              </form>
  

            </div>
          

         
 
          
      </div>
      <!-- /.card -->

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



