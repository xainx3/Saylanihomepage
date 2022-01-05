<?php
session_start();
$thispage='sample';
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }
if(isset($_POST['submit'])){

$studyid=$_POST['mrno'];



$sid_num = preg_replace('/[^0-9]/', '', $studyid);
$sid_alpha = preg_replace('/[^a-zA-Z]/', '', $studyid);


$name=$_POST['name'];
$edate=$_POST['edate'];
$rdate=$_POST['rdate'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$contact=$_POST['contactno'];

if(!isset($_POST['temp'])){

  $temp='N/A';
}
else{
  $temp=$_POST['temp'].'C';
}

if(!isset($_POST['cnic'])){

  $cnic='N/A';
}
else{
  $cnic=$_POST['cnic'];
}

$query= "select * from `participantsinfocenter` where `study_id`='$studyid' ";
$result= mysqli_query($conn, $query);

if(mysqli_num_rows($result)>0){
  $statusMsg= "Toast.fire({
    icon: 'error',
    padding: '3em',  
    background: '#EBECEC',
    title: '&nbsp; Duplicate Entry against Study ID'
  });";

}

else{
$insert = $conn->query("INSERT INTO `participantsinfocenter`(`study_id`, `sid_alpha`, `sid_num`, `date_of_enrollment`, `date_of_receiving`, `name`, `age`, `sex`, 
`contact_number`, `temperature`, `cnic`) VALUES ('$studyid','$sid_alpha','$sid_num','$edate','$rdate','$name','$age','$gender',
'$contact','$temp','$cnic')");
    
if($insert){
      $statusMsg= "Toast.fire({
  icon: 'success',
  padding: '3em',  
  background: '#EBECEC',
  title: ' Participant Added Successfully.'
  });";               
    
}
}
echo mysqli_error($conn);



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
 <style>
.form-center {
	position: relative;
	width:120%;
	height:10em;
}

.form-center form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}


   .error{
     color:red !important;
   }
   .loader1{
  position: relative;
  text-align: center;
  margin: 15px auto 35px auto;
  z-index: 9999;
  display: block;
  width: 80px;
  height: 80px;
  border: 10px solid rgba(0, 0, 0, .3);
  border-radius: 50%;
  border-top-color: #000;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}

@-webkit-keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}

 </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

 
  <?php include 'header.php'  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Participant's Registration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sample Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <form method="POST" action="" enctype="multipart/form-data" id="registrationform" class="m-5 p-5 bg-dark rounded">
      <h1 class="text-center" style="margin: 0 0;">Enter Participant's Details</h1>

      <div class="card-body">
        <div class="row">

      <div class="form-group col-md-6">
          <label >Study Id</label>
          <input type="name" class="form-control"  placeholder="Enter Study Id" name="mrno" required>
        </div>

        <div class="form-group col-md-6">
          <label for="exampleInputEmail1">Name</label>
          <input type="name" class="form-control"  placeholder="Enter Full Name" name="name" required>
        </div>

        <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Date of Enrollment</label>
          <input type="date" class="form-control"   name="edate" required>
        </div>

        <div class="form-group col-md-6">
          <label for="exampleInputPassword1">Date of Receiving</label>
          <input type="date" class="form-control"  placeholder="Enter age" name="rdate" required>
        </div>
        

        <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Age</label>
                      <input type="number" class="form-control" placeholder="Enter age of Participant"  name="age" required >
                    </div>

        <div class="form-group">
          <label for="exampleInputPassword1">Gender</label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" checked value="MALE">
            <label class="form-check-label">Male</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="FEMALE">
            <label class="form-check-label">Female</label>
          </div>
       
        </div>
        <div class="form-group col-md-6">
          <label >Contact</label>
          <input type="number" class="form-control"  placeholder="Enter Contact Number" name="contactno" required>
        </div>
        
          <div class="form-group col-md-6">
                      <label >Temprature &#8451;</label>
                      <input type="name" class="form-control"  placeholder="Enter Temprature of Sample" name="temp"  >
                    </div>
                    <div class="form-group col-md-12 mb-5">
                      <label >CNIC</label>
                      <input type="number" class="form-control"     placeholder="XXXXX-XXXXXXX-X" name="cnic" >
                    </div>

</div>
      
  
<div class="form-group col-md-12 text-center">
                      <input type="submit" class="btn btn-lg btn-primary" value="submit" name="submit" >
                    </div>
     
     
    </form>

     
     
    

    
      

    
  </div>
  
  
  <section class="container-fluid">
<h1 class="text-center">RECENT ENTRIES</h1>
  <table id="recenttb" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>STUDY ID</th>
        <th>NAME</th>
        <th>DATE OF ENROLLMENT</th>
        <th>DATE OF RECEIVING</th>
        <th>AGE</th>
        <th>GENDER</th>
        <th>CONTACT</th>
        <th>TEMPRATURE</th>
        <th>CNIC</th>
        <th>VIEW</th>
      </tr>
      </thead>
      <tbody >    

      <?php

$sql1 = "SELECT *FROM `participantsinfocenter`  ORDER BY `timestamp` DESC LIMIT 10";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 

    $studyid=$row1['study_id'];  
    $name=$row1['name'];
    $dateofen=$row1['date_of_enrollment'];
    $dateofrec=$row1['date_of_receiving'];
    $age=$row1['age'];
    $gender=$row1['sex'];
    $contactnumber=$row1['contact_number'];
    $temp=$row1['temperature'];


echo "<tr>

<td>".$row1['study_id']."</td>
<td>".$row1['name']."</td>
<td>".$row1['date_of_enrollment']."</td>
<td>".$row1['date_of_receiving']."</td>
<td>".$row1['age']."</td>
<td>".$row1['sex']."</td>
<td>".$row1['contact_number']."</td>
<td>".$row1['temperature']."</td>
<td>".$row1['cnic']."</td>
<td><a class='btn btn-info btn-sm' href='patientdetails.php?patientid=".$row1['study_id']."'>
<i class='fas fa-pencil-alt'>
</i>
View
</a></td>

</tr>";


}


?> 








      </tbody>
    
    </table>   
  </section>
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
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
<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <div class="loader1"></div>
          <div clas="loader-txt">
            <p>Loading..</p>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- REQUIRED SCRIPTS -->

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

    function printbrc(){
      if($('#blood').is(':checked') && $('#urine').is(':checked')){

        $("#loadMe").modal({
                   backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                   });
              setTimeout(function() {
                   $("#loadMe").modal("hide");
                   $("#wizard").steps("next");
                  }, 5000);

                  $('#next').click();
              
            }
           
         

          else{

            alert('Please Collect Blood and Urine Samples first!');
          }
 
        }

        if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

         $('#recenttb').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": true,
      "responsive": true,
    });
   
    </script>
</body>
</html>
