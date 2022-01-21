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

  if(isset($_GET['sampleid'])){

    $sampleid=$_GET['sampleid'];

   
    
}

if(isset($_POST['roomname'])){



$roomname=$_POST['roomname'];

$insert = $conn->query("INSERT INTO `freezerroom`(`roomname`) VALUES ('$roomname')");
    
if($insert){
      $statusMsg= "Toast.fire({
  icon: 'success',
  padding: '3em',  
  background: '#EBECEC',
  title: ' Room Added Successfully.'
  });";               
    
}
  }


  if(isset($_POST['draw'])){
    
    $drawnamount=$_POST['drawn_quantity'];
    $sample_id=$_POST['sample_id'];
    $user_id=$_POST['user_id'];
  


  
    $insert = $conn->query("INSERT INTO `sample_draw`(`sample_id`, `draw_quantity`,
    `user_id`) VALUES ('$sample_id','$drawnamount','$user_id')");
        
    if($insert){
          $statusMsg= "Toast.fire({
      icon: 'success',
      padding: '3em',  
      background: '#EBECEC',
      title: 'Information Stored Successfully.'
      });";               
        
    }

    echo mysqli_error($conn);
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
table td{
  width:100px;
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

<a href="" class="btn btn-lg btn-primary mt-3 mb-3" style="width:200px;" data-toggle="modal" data-target="#freezer" >DRAW SAMPLE</a>

</div>


</div>
<table id="example1" class="table table-bordered table-striped text-center ">
      <thead>
      <tr>
        <th>SAMPLE ID</th>
        <th>DRAWN QUANTITY</th>
        <th>DATE OF DRAWN</th>
        <th>DRAWN BY</th>
   
      </tr>
      </thead>
      <tbody >    

      <?php

$sql1 = "SELECT * FROM `sample_draw` as sd INNER JOIN `admin` as ad on sd.user_id=ad.adminid WHERE `sample_id`='$sampleid'";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 


echo "<tr>
<td>".$row1["sample_id"]."</td>
<td>
".$row1["draw_quantity"]."ml
</td>
<td>".$row1["date_of_draw"]."</td>
<td>".$row1["username"]."</td>
</tr>
<tr>";

}


?> 








      </tbody>
    
    </table>  

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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Draw Sample</h5>
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
                    <label for="exampleInputEmail1">Enter Drawn Amount in ml</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter Drawn Amount in ml" name="drawn_quantity" required >
                  </div>
               

                <input type="hidden" value="<?php echo $sampleid; ?>" name="sample_id">
                <input type="hidden" value="<?php echo $adminid; ?>" name="user_id">

           
                  </div>
 
</div>
                
                </div>

                <div class="col-md-12 text-center mb-5">
                  <button type="submit" class="btn btn-primary btn-block btn-lg" name="draw">Draw</button>
                </div>
               
              </form>
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
