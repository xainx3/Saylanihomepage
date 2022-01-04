<?php
$thispage = 'profile';
$thispage = 'updatep';
include "connection/connection.php";


session_start();
if(!isset($_SESSION["id"])){
  header("Location: index.php");
  exit();
  }

  else{
    $adminid=$_SESSION['id'];
  }



if(isset($_POST['submit'])){



$fname=$_POST['fname'];
$email=$_POST['email'];



if($_FILES["dp"]["name"]==""){


    $insert = $conn->query("UPDATE `admin` SET `username`='$fname',`email`='$email' WHERE `adminid`='$adminid'");
    
if($insert){
      $statusMsg= "Toast.fire({
  icon: 'success',
  padding: '3em',  
  background: '#EBECEC',
  title: ' User Updated Successfully.'
  });";               
    
}
    
    else{
        echo mysqli_error($conn); 
      $statusMsg= "Toast.fire({
        icon: 'error',
        padding: '3em',
        background: '#EBECEC',
        title: ' Uknown Error!'
      });";          
      } 
  
  
  
  }

  else{

$targetDir = "images/";
$filename = basename($_FILES["dp"]["name"]);
$tempdp = explode(".", $filename);
$newfilename = $email. '.' . end($tempdp);  
$targetFilePath = $targetDir . $newfilename;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$allowTypes = array('jpg','png','jpeg');




if(in_array($fileType, $allowTypes)){
        if(move_uploaded_file($_FILES['dp']['tmp_name'], $targetFilePath)){
            $insert = $conn->query("UPDATE `admin` SET `username`='$fname',`email`='$email',`dp`='$targetFilePath' WHERE `adminid`='$adminid'");
            if($insert){
              $statusMsg= "Toast.fire({
  icon: 'success',
  padding: '3em',  
  background: '#EBECEC',
  title: ' User Updated Successfully.'
});";               
            }else{

               
              $statusMsg= "Toast.fire({
                icon: 'error',
                padding: '3em',
                background: '#EBECEC',
                title: ' File upload failed, please try again.'
              });";          
              } 
        }else
        {
          $statusMsg= "Toast.fire({
            icon: 'error',
            padding: '3em',
            background: '#EBECEC',
            title: ' Sorry, there was an error uploading your file.'
          });";     
        }
    }
    else{
      $statusMsg= "Toast.fire({
        icon: 'warning',
        padding: '3em',
        background: '#EBECEC',
        title: ' Sorry, only JPG, JPEG, PNG files are allowed to upload for Profile Picture.'
      });"; 

    }


  

  }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CNCD - Profile</title>

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
 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
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
              <li class="breadcrumb-item active">Admin Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
  
      
         
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Admin Information</h3>
              </div>
            
<?php

$sql1 = "SELECT *FROM `admin` where `adminid`=$adminid";
 
 
$result1 = mysqli_query($conn, $sql1);

while($row1 = mysqli_fetch_array($result1))  
{ 

    $fname=$row1['username'];  
    $email=$row1['email'];
    $password=$row1['password'];
    $dp=$row1['dp'];

}


?>



              <form method="POST" action="" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                <div class="form-group col-md-6">
                    <label >Full Name</label>
                    <input type="name" class="form-control"  placeholder="Enter Full Name" name="fname" required value="<?php echo $fname ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" required value="<?php echo $email ?>">
                  </div>
                  


                     
                  <div class="form-group col-md-12" >
                    <label for="exampleInputFile">Upload Profile Picture</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" onchange="previewFile(this);" name="dp" >
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  </div>
                  <div class="form-group text-center " >
    <img id="previewImg" src="<?php echo $dp ?>" class="rounded-circle" style="width:200px; height:200px;">
</div>
</div>
                
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">Update</button>
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
