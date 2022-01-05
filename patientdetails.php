<?php
$thispage='patd';

session_start();
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

if(isset($_GET['patientid'])){

    $patientid=$_GET['patientid'];

    
    
}

if(!isset($_GET['patientid'])){

  header("Location: users.php");
  
}

if(isset($_POST['update'])){



$name=$_POST['name'];
$edate=$_POST['edate'];
$rdate=$_POST['rdate'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$contact=$_POST['contact'];

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



$insert = $conn->query("UPDATE `participantsinfocenter` SET `date_of_enrollment`='$edate',
`date_of_receiving`='$rdate',`name`='$name',`age`='$age',`sex`='$gender',`contact_number`='$contact',
`temperature`='$temp' WHERE `study_id`='$patientid'");
    
if($insert){
      $statusMsg= "Toast.fire({
  icon: 'success',
  padding: '3em',  
  background: '#EBECEC',
  title: ' Participant Updated Successfully.'
  });";               
    
}





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

$sql1 = "SELECT *FROM `participantsinfocenter` where `study_id` ='$patientid'";
 
 
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

}


?> 
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
  
      
         
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Details of <b> <i > <?php echo $name ?></i></b></h3>
              </div>
   


<form method="POST" action="" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                  <div class="form-group col-md-6">
                      <label >MR. No</label>
                      <input type="name" class="form-control bg-secondary"   name="mrno" required value="<?php echo $studyid ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="name" class="form-control" id="exampleInputEmail1"  name="name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Date of Enrollment</label>
                      <input type="date" class="form-control" id="endate"  name="edate" required  value="<?php echo date("Y-m-d", strtotime($dateofen)) ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Date of Receiving</label>
                      <input type="date" class="form-control" id="exampleInputEmail1"  name="rdate" required value="<?php echo date("Y-m-d", strtotime($dateofrec)) ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Age</label>
                      <input type="number" class="form-control" id="exampleInputPassword1"  name="age" required value="<?php echo $age ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Gender</label>
                      <input type="name" class="form-control" id="exampleInputPassword1"  name="gender" required value="<?php echo $gender ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Contact</label>
                      <input type="name" class="form-control"   name="contact" required value="<?php echo   $contactnumber ?>">
                    </div>
  
                    <div class="form-group col-md-6">
                      <label >Temprature</label>
                      <input type="number" class="form-control"  placeholder="Temprature of Participant" name="temp" value="<?php echo  preg_replace('/[^0-9]/', '',  $temp); ?>" required >
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label >CNIC</label>
                      <input type="number" class="form-control"     placeholder="XXXXX-XXXXXXX-X" name="cnic" >
                    </div>
                       

                    </div>
  
  </div>
  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" name="update">Update</button>
                  </div>
                  </div>
  
                
                 
                </form>
  

            </div>
          

         
 
          
      </div>
      <!-- /.card -->

    </section>


   <?php if($_SESSION['role']!="DE"){

echo '<section>

<div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Blood & Urine Samples</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Blood & Urine Reports</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Family Members</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Storage</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME</th>
        <th>DATE OF EXTRACTION</th>
        <th>STATUS</th>
        <th>STORAGE LOCATION</th>        
        <th>VIEW DETAILS</th>
      </tr>
      </thead>
      <tbody >    

<tr>


<td>FY-5025-bb4c61d7664de191 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>EDTA</td>
<td>27/12/2021</td>
<td>
<div class="form-group">
                        <select class="form-control bg-primary">
                          <option>Pending</option>
                          <option >Processing</option>
                          <option Selected>Storage</option>
                         
                        </select>
                      </div>
</td>
<td>F1->R2->C5</td>

                      <td>    
<a class="btn btn-info btn-sm" href="sampledetail.php?sampleid=1">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger1">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FY-5025-5a0574530619ccc9 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>Gel Tube</td>
<td>27/12/2021</td>

<td><div class="form-group">
                        <select class="form-control bg-warning">
                          <option>Pending</option>
                          <option selected>Processing</option>
                          <option >Storage</option>
                         
                        </select>
                      </div></td>
                      <td>F1->R2->C4</td>
                      <td>    
<a class="btn btn-info btn-sm" href="serum.php?sampleid=2">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger2">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FY-5025-0c14b283f1817f24 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>Urine</td>
<td>27/12/2021</td>

<td><div class="form-group">
                        <select class="form-control bg-danger">
                          <option Selected>Pending</option>
                          <option >Processing</option>
                          <option >Completed</option>
                         
                        </select>
                      </div></td>
                      <td>F1->R2->C3</td>
                      <td>    
<a class="btn btn-info btn-sm" href="urine.php?sampleid=3">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger3">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>





      </tbody>
    
    </table>                     </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                  <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME</th>
        <th>DATE OF RESULT</th>
        <th>STATUS</th>
        <th>Download PDF</th>        
        <th>VIEW DETAILS</th>
      </tr>
      </thead>
      <tbody >    

<tr>


<td>FY-5025-bb4c61d7664de191 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>Lipid Profile</td>
<td>27/12/2021</td>
<td>
<div class="form-group">
                        <select class="form-control bg-success">
                          <option>Pending</option>
                          <option >Processing</option>
                          <option Selected>Completed</option>
                         
                        </select>
                      </div>
</td>
<td><a class="btn btn-app bg-success">
<i class="fas fa-download"></i> Download
                </a></td>

                      <td>    
<a class="btn btn-info btn-sm" href="report.php?sampleid=1">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger1">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FY-5025-5a0574530619ccc9 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>UMA</td>
<td>27/12/2021</td>

<td><div class="form-group">
                        <select class="form-control bg-warning">
                          <option>Pending</option>
                          <option selected>Processing</option>
                          <option >Storage</option>
                         
                        </select>
                      </div></td>
                      <td><a class="btn btn-app bg-success disabled">
<i class="fas fa-download"></i> Download
                </a></td>
                      <td>    
<a class="btn btn-info btn-sm" href="serum.php?sampleid=2">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger2">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FY-5025-0c14b283f1817f24 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>CBC</td>
<td>27/12/2021</td>

<td><div class="form-group">
                        <select class="form-control bg-danger">
                          <option Selected>Pending</option>
                          <option >Processing</option>
                          <option >Completed</option>
                         
                        </select>
                      </div></td>
                      <td><a class="btn btn-app bg-success disabled">
<i class="fas fa-download"></i> Download
                </a></td>
                      <td>    
<a class="btn btn-info btn-sm" href="urine.php?sampleid=3">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger3">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FY-5025-0c14b283f1817f24 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>HBA1C</td>
<td>27/12/2021</td>

<td><div class="form-group">
                        <select class="form-control bg-danger">
                          <option Selected>Pending</option>
                          <option >Processing</option>
                          <option >Completed</option>
                         
                        </select>
                      </div></td>
                      <td><a class="btn btn-app bg-success disabled">
<i class="fas fa-download"></i> Download
                </a></td>
                      <td>    
<a class="btn btn-info btn-sm" href="urine.php?sampleid=3">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger3">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FY-5025-0c14b283f1817f24 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>DNA</td>
<td>27/12/2021</td>

<td><div class="form-group">
                        <select class="form-control bg-danger">
                          <option Selected>Pending</option>
                          <option >Processing</option>
                          <option >Completed</option>
                         
                        </select>
                      </div></td>
                      <td><a class="btn btn-app bg-success disabled">
<i class="fas fa-download"></i> Download
                </a></td>
                      <td>    
<a class="btn btn-info btn-sm" href="urine.php?sampleid=3">
    <i class="fas fa-pencil-alt">
    </i>
    View
</a>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger3">
    <i class="fas fa-trash">
    </i>
    Delete
</a></td>
</tr>





      </tbody>
    
    </table> 
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
<p class="text-center">No Record Found!</p>
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME</th>
        <th>DATE OF STORAGE</th>
        <th>STORAGE LOCATION</th>        
      </tr>
      </thead>
      <tbody >    

<tr>


<td>FY-5025-bb4c61d7664de191 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>EDTA</td>
<td>27/12/2021</td>

<td>F1->R2->C5</td>


</tr>
<tr>


<td>FY-5025-5a0574530619ccc9 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>Serum</td>
<td>27/12/2021</td>


                      <td>F1->R2->C4</td>

</tr>
<tr>


<td>FY-5025-0c14b283f1817f24 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>Plasma</td>
<td>27/12/2021</td>


                      <td>F1->R2->C3</td>
                     
</tr>
<tr>


<td>FY-5025-0c14b283f1817f24 </td>
<td> <img src="images/barcode.gif" style="width:200px"> </td>
<td>HBA1C</td>
<td>27/12/2021</td>


                      <td>F1->R2->C3</td>
                     
</tr>
<tr>





      </tbody>
    
    </table>                        </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
</section>';

    }

    ?>

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



