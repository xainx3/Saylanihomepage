<?php
$thispage = 'storage';

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
  <title>CNCD - Storage</title>

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
              <li class="breadcrumb-item active">Storage Managment</li>
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
                <h3 class="card-title">Storage Managment</h3>
              </div>
            




<div class="row">
<div class="col-md-12 text-center ">

<a href="" class="btn btn-lg btn-primary mt-3 mb-3" style="width:200px;" data-toggle="modal" data-target="#freezer" >ADD FREEZER</a>
<a href="" class="btn btn-lg btn-primary " style="width:200px;" data-toggle="modal" data-target="#room">ADD ROOM</a>

</div>


</div>
<div class="table-responsive">


<table id="example1" class="table table-bordered table-striped text-center ">
      <thead>
      <tr>
        <th>FREEZER ID</th>
        <th>FREEZER NAME</th>
        <th>FREEZER ROWS</th>
        <th>FREEZER COLUMNS</th>
        <th>FREEZER LOCATION</th>
        <th>STORAGE SPACE</th>        
        <th>VIEW/EDIT DETAILS</th>
      </tr>
      </thead>
      <tbody >    

<tr>


<td>FR-1 </td>
<td>Urine  Freezer </td>
<td>8</td>
<td>4</td>
<td>
Room 1
</td>
<td>64</td>

                      <td>    
<a class='btn btn-info btn-sm' href='patientdetails.php?patientid=1'>
    <i class='fas fa-pencil-alt'>
    </i>
    View
</a>


<a class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='#modal-danger1'>
    <i class='fas fa-trash'>
    </i>
    Delete
</a></td>
</tr>
<tr>


<td>FR-2 </td>
<td>DNA FREEZER</td>
<td>6</td>
<td>3</td>

<td>Room 2</td>
                      <td>18</td>
                     <td>    
<a class='btn btn-info btn-sm' href='patientdetails.php?patientid=2'>
    <i class='fas fa-pencil-alt'>
    </i>
    View
</a>


<a class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='#modal-danger2'>
    <i class='fas fa-trash'>
    </i>
    Delete
</a></td> 
</tr>
<tr>


<td>FR-3 </td>
<td> Serum / Plasma Storage</td>
<td>5</td>
<td>5</td>

<td>Room 2</td>
                      <td>25</td>
                  <td>    
<a class='btn btn-info btn-sm' href='patientdetails.php?patientid=2'>
    <i class='fas fa-pencil-alt'>
    </i>
    View
</a>


<a class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='#modal-danger2'>
    <i class='fas fa-trash'>
    </i>
    Delete
</a></td> 
</tr>





      </tbody>
    
    </table>  
    </div>

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
<!-- Modal -->
<div class="modal fade" id="freezer" tabindex="-1" role="dialog" aria-labelledby="freezer" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD FREEZER</h5>
        <hr>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
              <form method="POST" action="" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="row">
                <div class="form-group col-md-12">
                    <label >Freezer Name</label>
                    <input type="name" class="form-control"  placeholder="Enter Freezer Name" name="fname" required >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Freezer Rows</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Number of Rows" name="frows" required >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Freezer Columns</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Number of Columns" name="fcolumns" required >
                  </div>

                  <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">Room Location</label>

                      
                        <select class="form-control" >
                          <option selected>Room 1</option>
                          <option>Room 2</option>
                          <option>Room 3</option>
                        </select>
                      </div>
                     
           
                  </div>
 
</div>
                
                </div>

                <div class="col-md-12 text-center mb-5">
                  <button type="submit" class="btn btn-primary btn-block btn-lg" name="submit">ADD</button>
                </div>
               
              </form>
      </div>
      </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="room" tabindex="-1" role="dialog" aria-labelledby="room" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
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
