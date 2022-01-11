<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>

<div class="container">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                  <div class="form-group col-md-6">
                      <label >Study ID</label>
                      <input type="name" class="form-control bg-secondary text-white"   name="mrno" required value="ABC123" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Sample ID</label>
                      <input type="name" class="form-control bg-secondary text-white" id="exampleInputEmail1"  name="name" value="ABC123-S-1" readonly required >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Select Room</label>

                     <select class="form-control " name="status" id="roomselect">';

<?php

include "connection/connection.php";

$query = "SELECT *  FROM `freezerroom`";
$result = mysqli_query($conn,$query);
echo '<option value="0">Select Storage Room</option>';

while($row = mysqli_fetch_array($result)) {   

   echo'<option value='.$row["frid"].' >'.$row["roomname"].'</option>';

 } 
 
echo' </select>';

?>
                    </div>
                    <div class="form-group col-md-6" id="freezerdiv">
                      <label for="exampleInputEmail1">Select Freezer</label>
                      <select class="form-control " name="status" id="freezers">';
                      <option value="0">Select Freezer</option>
                    </select>
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
  </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script>

$('#roomselect').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var dataString = 'roomvalue='+ valueSelected ;
  
   event.preventDefault();
  $.ajax({
    method: "GET",
    url: "statusupdate.php",
    data: dataString,

  
    success: function(textStatus, status){
      console.log(textStatus);
        console.log(status);
        $('#freezers').append(textStatus);
        
        
    },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });
    
    });

    $('#freezers').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var dataString = 'freezervalue='+ valueSelected ;
  


    event.preventDefault();

    $.ajax({
    method: "GET",
    url: "statusupdate.php",
    data: dataString,
      
      success: function(textStatus, status){
      console.log(textStatus);
      console.log(status);
      $( "#freezerdiv" ).after(textStatus);
        
        
    },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });
    
    });
</script>
</body>
</html>