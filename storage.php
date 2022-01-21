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

  if(isset($_GET['patientid'])){

    $patientid=$_GET['patientid'];

    $studyid=$_GET['patientid'];
    
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


  if(isset($_POST['addfreezer'])){
    
    $roomid=$_POST['roomid'];
    $frename=$_POST['frename'];
    $Shelvesnum=$_POST['Shelvesnum'];
    $racksnum=$_POST['racksnum'];
    $boxnum=$_POST['boxnum'];
    $positionnum=$_POST['positionnum'];


  
    $insert = $conn->query(" INSERT INTO `freezer`( `frid`, `freezername`, `num_of_shelves`, `num_of_racks`, `num_of_boxes`, `num_of_positions`)
    VALUES ('$roomid','$frename','$Shelvesnum','$racksnum','$boxnum','$positionnum')");
        
    if($insert){
          $statusMsg= "Toast.fire({
      icon: 'success',
      padding: '3em',  
      background: '#EBECEC',
      title: 'Freezer Added Successfully.'
      });";               
        
    }

    echo mysqli_error($conn);
      }

      if(isset($_POST['freezer'])){

        $freeid=$_POST['freeid'];
        
         
        $delete = $conn->query("DELETE FROM `freezer` WHERE `freid`='$freeid'");
        if($delete){
          $statusMsg= "Toast.fire({
        icon: 'success',
        padding: '3em',  
        background: '#EBECEC',
        title: ' Freezer Deleted Successfully.'
        });";               
        }else{
            echo mysqli_error($conn); 
          $statusMsg= "Toast.fire({
            icon: 'error',
            padding: '3em',
            background: '#EBECEC',
            title: ' Unable to delete Freezer.'
          });";          
          } 
        
        }
        if(isset($_POST['dsroom'])){

          $sroom=$_POST['sroom'];
          
           
          $delete = $conn->query("DELETE FROM `freezerroom` WHERE `frid`='$sroom'");
          if($delete){
            $statusMsg= "Toast.fire({
          icon: 'success',
          padding: '3em',  
          background: '#EBECEC',
          title: ' Freezer Deleted Successfully.'
          });";               
          }else{
              echo mysqli_error($conn); 
            $statusMsg= "Toast.fire({
              icon: 'error',
              padding: '3em',
              background: '#EBECEC',
              title: ' Unable to delete Freezer.'
            });";          
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

<a href="" class="btn btn-lg btn-primary mt-3 mb-3" style="width:200px;" data-toggle="modal" data-target="#freezer" >ADD FREEZER</a>
<a href="" class="btn btn-lg btn-primary " style="width:200px;" data-toggle="modal" data-target="#room">ADD ROOM</a>

</div>


</div>
<hr>
<div class="table-responsive">
<h1 class="text-center">FREEZERS</h1>

<table id="example1" class="table table-bordered table-striped text-center ">
      <thead>
      <tr>
        <th>FREEZER ID</th>
        <th>ROOM NAME</th>
        <th>FREEZER NAME</th>
        <th>NUMBER OF SHELVES</th>
        <th>NUMBER OF RACKS</th>
        <th>NUMBER OF BOXES</th>
        <th>TOTAL POSITIONS IN BOX</th>        
        <th>VIEW/EDIT DETAILS</th>
      </tr>
      </thead>
      <tbody >    

      <?php

$sql1 = "SELECT * FROM `freezer` as f INNER JOIN `freezerroom` as fr on f.frid=fr.frid;";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 


   echo "<tr>


<td>F-".$row1["freid"]."</td>
<td>
".$row1["roomname"]."
</td>
<td>".$row1["freezername"]."</td>
<td>".$row1["num_of_shelves"]."</td>
<td>".$row1["num_of_racks"]."</td>

<td>".$row1["num_of_boxes"]."</td>
<td>".$row1["num_of_positions"]."</td>

                      <td>    
<a class='btn btn-info btn-sm' href='freezerdetails.php?freezerid=".$row1["freid"]."'>
    <i class='fas fa-pencil-alt'>
    </i>
    View
</a>


<a class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='#free".$row1["freid"]."'>
    <i class='fas fa-trash'>
    </i>
    Delete
</a><div class='modal fade' id='free".$row1["freid"]."'>
<div class='modal-dialog'>
  <div class='modal-content bg-danger'>

    <div class='modal-body'>
      <p class='text-center'>Are you sure you want to remove this Participant?</p>
    </div>
    <div class='modal-footer justify-content-between'>
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
    
    <form method='post'>

<input type='hidden' value='".$row1["freid"]."' name='freeid'>

<button type='submit' class='btn btn-outline-light' name='freezer'>Yes</button>

  </form>
    
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div></td>
</tr>
<tr>";

}


?> 








      </tbody>
    
    </table>  
    </div>

<hr>
    <div class="container table-responsive">
<h1 class="text-center">STORAGE ROOMS</h1>

<table id="example1" class=" table table-dark table-striped   text-center ">
      <thead>
      <tr>
        <th>ROOM ID</th>
        <th>ROOM NAME</th>
        <th>VIEW/EDIT DETAILS</th>
      </tr>
      </thead>
      <tbody >    

      <?php

$sql1 = "SELECT * FROM `freezerroom` ";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 


   echo "<tr>


<td>R-".$row1["frid"]."</td>
<td>".$row1["roomname"]."</td>



                      <td >    
<a class='btn btn-info btn-sm' href='roomdetails.php?roomid=".$row1["frid"]."'>
    <i class='fas fa-pencil-alt'>
    </i>
    View
</a>


<a class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='#fr".$row1["frid"]."'>
    <i class='fas fa-trash'>
    </i>
    Delete
</a>
<div class='modal fade' id='fr".$row1["frid"]."'>
<div class='modal-dialog'>
  <div class='modal-content bg-danger'>

    <div class='modal-body'>
      <p class='text-center'>Are you sure you want to remove this Participant?</p>
    </div>
    <div class='modal-footer justify-content-between'>
      <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
    
    <form method='post'>

<input type='hidden' value='".$row1["frid"]."' name='sroom'>

<button type='submit' class='btn btn-outline-light' name='dsroom'>Yes</button>

  </form>
    
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div></td>
</tr>
<tr>";

}


?> 








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
  <div class="modal-dialog modal-lg" role="document">
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
                  <label >Room Location</label>

                      
                        <select class="form-control" name="roomid">
                        <?php

$sql2 = "SELECT * FROM `freezerroom`";
 
 
$result2 = mysqli_query($conn, $sql2);


while($row2 = mysqli_fetch_array($result2))  
{ 
 echo '<option value="'.$row2["frid"].'">'.$row2["roomname"].'</option>';

}

?>
                         
                        </select>
                      </div>
                <div class="form-group col-md-12">
                    <label >Freezer Name</label>
                    <input type="name" class="form-control"  placeholder="Enter Freezer Name" name="frename" required >
                  </div>
                  <div class="form-group col-md-6">
                    <label >Number of Shelves</label>
                    <input type="name" class="form-control"  placeholder="Total Number of Shelves" name="Shelvesnum" required >
                  </div>
                  <div class="form-group col-md-6">
                    <label >Number of Racks in Shelf</label>
                    <input type="name" class="form-control"  placeholder="Total Number of Racks in Shelf" name="racksnum" required >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Number of Boxes in Rack</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Total Number of Boxes in Rack" name="boxnum" required >
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Total Positions in Box</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Number of Rows in Box" name="positionnum" required >
                  </div>
               

                
                     
           
                  </div>
 
</div>
                
                </div>

                <div class="col-md-12 text-center mb-5">
                  <button type="submit" class="btn btn-primary btn-block btn-lg" name="addfreezer">ADD</button>
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
        <h5 class="modal-title" id="exampleModalLabel">ADD ROOM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="row">
                <div class="form-group col-md-12">
                    <label >Room Name</label>
                    <input type="name" class="form-control"  placeholder="Enter Freezer Room Name" name="roomname" required >
                  </div>
               
                 

          
                     
           
                  </div>
 
</div>
                
                </div>

                <div class="col-md-12 text-center mb-5">
                  <button type="submit" class="btn btn-primary btn-block btn-lg" name="addroom">ADD</button>
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
