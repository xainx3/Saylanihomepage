<?php
$thispage='report';
include "connection/connection.php";

session_start();;
if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

if(isset($_GET['sampleid'])){

    $sampleid=$_GET['sampleid'];
    $studydate=$_GET['date'];
    
}

if(!isset($_GET['sampleid'])){

  header("Location: patientdetails.php");
  
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CNCD - REPORT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<style>
@print { 
	@page :footer { 
		display: none
	} 

	@page :header { 
		display: none
	} 
} 
@media print { 
	@page { 
		margin-top: 0; 
		margin-bottom: 0; 
	} 
	body { 
		padding-top: 72px; 
		padding-bottom: 72px ; 
	} 
} 
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
      </div>
    </section>

    <?php

$sql1 = "SELECT *FROM `participantsinfocenter` as `pic` INNER JOIN `labvalues_lipid` as `lvl`  on pic.study_id=lvl.study_id INNER JOIN `labvalues_hba1c` as lvhba on pic.study_id=lvhba.study_id  INNER JOIN `labvalues_uma` as lvuma on pic.study_id=lvuma.study_id WHERE lvuma.study_id='$sampleid' AND lvuma.study_date='$studydate'";
 

$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  

{ 

  
  $pgender  =   $row1['sex'];
  $page     =   $row1['age'];
  $pname    =   $row1['name'];
  $chlo     =   $row1['chlo'];
  $glu      =   $row1['glu'];
  $creat    =   $row1['creat'];
  $tg       =   $row1['tg'];
  $hdl      =   $row1['hdl'];
  $vldl     =   $row1['vldl'];
  $astl     =   $row1['astl'];
  $altl     =   $row1['altl'];
  $ldl      =   $row1['ldl'];
  $hba1c      = $row1['hba1c'];
  $uma      = $row1['uma'];
  $center   =   $row1['center'];

}


?> 


<section>
<div class="container">
<div class="page-content container">
    <div class="page-header text-blue-d2">
      

        
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    
                <div class="col-3">
                        <div class="text-left ">
                        <img src="images/logo.png" alt="" style="width:180px;">
                        
                        </div></div>

                        <div class="col-8">
                        <div class="text-center">
                        <h3 class="text-primary">CENTER FOR NON COMMUNICABLE DISEASES</h3>
                        <p class="text-center text-danger">RESEARCH LABORATORY</p>
                        </div></div>


                </div>
                <!-- .row -->

                <hr class="row brc-default-l mx-n1 mb-4" size="3" />

                <div class="row text-center">
                    <div class="col-sm-4">
                        <div>
                            <span class="text-600 text-110  align-middle">STUDY ID :</span>
                            <span class="text-600 text-110  align-middle"><b><?php echo $sampleid ?></b> </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                NAME: <b><?php echo $pname ?></b> 
                            </div>
                          
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div>
                            <span class="text-600 text-110  align-middle">CENTER :</span>
                            <span class="text-600 text-110  align-middle"><b><?php echo $center ?></b> </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                               AGE: <b><?php echo $page ?></b> 
                            </div>
                            
                        </div>
                    </div>

                    <div class="text-95 col-sm-4 align-self-start d-sm-flex justify-content-end">
                        <div class="text-grey-m2">
                            

                            <div>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                DATE: <b><?php echo $studydate ?></b> 
                            </div>
                            <div class="my-1">
                              GENDER: <b><?php echo $pgender ?></b> 
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
      <td><?php echo $glu ?></td>
      <td> &lt; 200mg/dl</td>
    </tr>
    <tr>
      <td>Serum Cholesterol</td>
      <td><?php echo $chlo ?></td>
      <td>"Without known coronary artery disease; ≤ 200 mg/dl: Desirable.
With known coronary artery disease;≤160 mg/dl:Optimal."	
</td>
    </tr>
    <tr>
    <td>Serum Triglycerides</td>
      <td ><?php echo $tg ?>
</td>
      <td>46-236mg/dl 
</td>
    </tr>
    <tr>
    <td>HDL
</td>
      <td ><?php echo $hdl ?>

</td>
      <td>"Without known coronary artery disease; ≥ 35 mg/dl:Desirable.
With known coronary artery disease; ≥ 35 mg/dl:Optimal."	

</td>
    </tr>

    <tr>
      <td>LDL
</td>
    <td><?php echo $ldl ?>
</td>
    <td>"Without known coronary artery disease; ≤ 130 mg/dl:Desirable.
With known coronary artery disease; ≤ 100 mg/dl:Optimal."	
</td>
  </tr>



    <tr>
      <td>VLDL
</td>
    <td><?php echo $vldl ?>
</td>
    <td>Normal VLDL levels are from 2 to 30 mg/Dl
</td>
  </tr>
    <tr>
      <td>Serum Creatinine
</td>
    <td><?php echo $creat ?>
</td>
    <td>0.6 – 1.5 mg/dl
</td>
  </tr>

<?php
if(!empty($astl))
{
?>

  <tr>
      <td>AST (SGOT)
</td>
    <td><?php echo $astl ?>
</td>
    <td>< 35 U/I
</td>
  </tr>
  <tr>
      <td>ALT (SGPT)

</td>
    <td><?php echo $altl ?>

</td>
    <td>< 45 U/I

</td>
</tr>
<?php
}?>


<tr>
<td>UNIRARY MICROALBUMIN
</td>
<td><?php echo $uma ?>
</td>
<td> <?php echo '<3.0 mg/dl'; ?>
</td>
</tr>

<tr>

<td>HbA1C
</td>
<td><?php echo $hba1c ?>
</td>
<td> Below 6.0%
</td>
</tr>



  </tbody>
</table>
          </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    

              <small class="mt-5">This is a computer generated report this doesnot require any signature.</small> <br>
              <small >This report is generated for research purpose only and should not be use for diagonastic purposes.</small>


                   

                    <div class="mt-5">
                       <div class="text-center">                     
                         

                       <?php
//  echo "<img alt='testing' src='barcode/barcode.php?size=40&text=".$sampleid."&print=true'/>";

                       ?>
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
