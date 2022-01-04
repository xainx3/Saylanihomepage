<?php
$thispage='report';
include "connection/connection.php";

session_start();;
if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

if(isset($_GET['sampleid'])){

    $userid=$_GET['sampleid'];
    
}

if(!isset($_GET['sampleid'])){

  header("Location: users.php");
  
}

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

  table{

    word-wrap:break-word;

  }
  td{
    width:100px;
  }
hr {
    
    border-top: 5px solid rgba(0,0,0,.1);
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
              <li class="breadcrumb-item active">Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




<section>
<div class="container">
<div class="page-content container">
    <div class="page-header text-blue-d2">
      

        
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center ">
                        <img src="images/logo.png" alt="" style="width:270px;">
                        
                        </div>
                        
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l mx-n1 mb-4" size="3" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-600 text-110  align-middle">MR NO :</span>
                            <span class="text-600 text-110  align-middle"><b>KHI-5896</b> </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                NAME: <b>Shazia Sulman</b> 
                            </div>
                            <div class="my-1">
                               Gender: <b>Female</b> 
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <div class="text-grey-m2">
                            

                            <div>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                Referred by: <b>Self</b> 
                            </div>
                            <div class="my-1">
                              Sample Date: <b>28/12/2021</b> 
                            </div>
                        </div>

                        </div>
                    </div>
                    <!-- /.col -->
                    
                </div>
                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="text-center mb-5">
             <h3> <u>BIO-CHEMISTRY REPORT</u> </h3>
                    </div>
                    <div class="row text-600 text-dark bgc-default-tp1 py-25">
                    <table class="table table-strip mx-auto text-center">
  <thead>
    <tr>
      <th scope="col">Test(s)</th>
      <th scope="col">Result(s)</th>
      <th scope="col">Range(s)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Random Blood Glucose</td>
      <td>89.2</td>
      <td> &lt; 200mg/dl</td>
    </tr>
    <tr>
      <td>Serum Cholesterol</td>
      <td>140.1</td>
      <td>"Without known coronary artery disease; ≤ 200 mg/dl: Desirable.
With known coronary artery disease;≤160 mg/dl:Optimal."	
</td>
    </tr>
    <tr>
    <td>Serum Triglycerides</td>
      <td >152.5
</td>
      <td>46-236mg/dl 
</td>
    </tr>
    <tr>
    <td>HDL
</td>
      <td >43

</td>
      <td>"Without known coronary artery disease; ≥ 35 mg/dl:Desirable.
With known coronary artery disease; ≥ 35 mg/dl:Optimal."	

</td>
    </tr>

    <tr>
      <td>LDL
</td>
    <td>66.6
</td>
    <td>"Without known coronary artery disease; ≤ 130 mg/dl:Desirable.
With known coronary artery disease; ≤ 100 mg/dl:Optimal."	
</td>
  </tr>

    <tr><td>
    LDL

    </td>
    <td>31
</td>
    <td>"Without known coronary artery disease; ≤ 130 mg/dl:Desirable.
With known coronary artery disease; ≤ 100 mg/dl:Optimal."	

</td>
  </tr>

    <tr>
      <td>VLDL
</td>
    <td>31
</td>
    <td>Normal VLDL levels are from 2 to 30 mg/Dl
</td>
  </tr>
    <tr>
      <td>Serum Creatinine
</td>
    <td>1.03
</td>
    <td>0.6 – 1.5 mg/dl
</td>
  </tr>
  <tr>
      <td>AST (SGOT)
</td>
    <td>25.9
</td>
    <td>< 35 U/I
</td>
  </tr>
  <tr>
      <td>ALT (SGPT)

</td>
    <td>28

</td>
    <td>< 45 U/I

</td>
  </tr>
  </tbody>
</table>
          </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    

              <p class="text-center mb-5 mt-5">Electronically verified On 28th of December, 2021. No Signature Required</p>

                   

                    <div>
                       <div class="text-center">                     <img src="images/barcode.gif" alt="" srcset="" style="width:250px;">
                       </div>
                       <hr />
                       <p class="text-center "> <i> Plot # 19/2, Sector 17, Near Bilal Chowrangi, korangi industrial Area, Karachi. <br>
Phones +92 21 35111 090 – 102 (13 Lines) Website: www.cncd.org</i>
</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    

</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



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
