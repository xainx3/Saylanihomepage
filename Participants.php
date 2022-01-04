<?php
session_start();
$thispage='sample';
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
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
  $temp=$_POST['temp'];
}

if(!isset($_POST['cnic'])){

  $cnic='N/A';
}
else{
  $cnic=$_POST['cnic'];
}



// $insert = $conn->query("UPDATE `participantsinfocenter` SET `date_of enrollment`='$edate',
// `date_of_receiving`='$rdate',`name`='$name',`age`='$age',`sex`='$gender',`contact_number`='$contact',
// `temperature`='$temp' WHERE `study_id`='$patientid'");
    
// if($insert){
//       $statusMsg= "Toast.fire({
//   icon: 'success',
//   padding: '3em',  
//   background: '#EBECEC',
//   title: ' Participant Updated Successfully.'
//   });";               
    
// }





}

  ?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LIMS | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/jquery.steps.css">
  <link rel="stylesheet" href="dist/css/main.css">
  <link rel="stylesheet" href="dist/css/normalize.css">
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

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
  <?php include 'header.php'  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Sample Registration</h1>
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


    <form method="POST" action="" enctype="multipart/form-data" id="registrationform" class="m-3 p-5 bg-dark rounded">

    <h1 class="text-center" style="margin: 0 0;">Enter Participant's Details</h1>





</form>

     
     
    

    
      

    
  </div>
  
  
  
  

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

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/jquery.steps.js"></script>
<script src="dist/js/jquery.cookie-1.3.1.js"></script>
  <script src="dist/js/validate.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});
</script>

<script>
      
      $(function() {
        $("#wizard").steps({
          headerTag: "h3",
          bodyTag: "section",
          transitionEffect: "slideLeft",
          autoFocus: true,
          saveState: true,
          labels: {

            finish: "Finish",
            next: "Next",
            previous: "Previous"

          },
          onStepChanging: function(event, currentIndex, newIndex) {

            // alert(currentIndex);
            var form1 = $("#registrationform");
           
            // var form3 = $("#m1form3_submit");
            // var form4 = $("#m1form4_submit");


            if (currentIndex > newIndex)
        {
            return true;
        }

            if (currentIndex == 0) {
              form1.validate().settings.ignore = ":disabled,:hidden";
            
            if(form1.valid()){

              //  event.preventDefault();
              // $.ajax({
              //   method: "POST",
              //   url: "formsubmit.php",
              //   data: $("#m1form1_submit").serialize(),
              //   beforeSend: function() {
              //     $("#loadMe").modal({
              //       backdrop: "static", //remove ability to close modal with click
              //       keyboard: false, //remove option to close with keyboard
              //       show: true //Display loader!
              //     });

              //     setTimeout(function() {
              //       $("#loadMe").modal("hide");
              //     }, 5000);


              //   },
              //   success: function(textStatus, status) {
              //     console.log(textStatus);
              //     console.log(status);

              //   },
              //   error: function(xhr, textStatus, error) {
              //     console.log(xhr.responseText);
              //     console.log(xhr.statusText);
              //     console.log(textStatus);
              //     console.log(error);
              //   }
              // });
              $("#loadMe").modal({
                   backdrop: "static", //remove ability to close modal with click
                    keyboard: false, //remove option to close with keyboard
                    show: true //Display loader!
                   });
              setTimeout(function() {
                   $("#loadMe").modal("hide");
                  }, 5000);
              return true;
      
            }
            else{
            return form1.valid();
          }
            
          }
         

          // if (currentIndex == 1) {
          //     form2.validate().settings.ignore = ":disabled,:hidden";
            
          //   if(form2.valid()){

          //      event.preventDefault();
          //     $.ajax({
          //       method: "POST",
          //       url: "formsubmit.php",
          //       data: $("#m1form2_submit").serialize(),
          //       beforeSend: function() {
          //         $("#loadMe").modal({
          //           backdrop: "static", //remove ability to close modal with click
          //           keyboard: false, //remove option to close with keyboard
          //           show: true //Display loader!
          //         });

          //         setTimeout(function() {
          //           $("#loadMe").modal("hide");
          //         }, 5000);


          //       },
          //       success: function(textStatus, status) {
          //         console.log(textStatus);
          //         console.log(status);

          //       },
          //       error: function(xhr, textStatus, error) {
          //         console.log(xhr.responseText);
          //         console.log(xhr.statusText);
          //         console.log(textStatus);
          //         console.log(error);
          //       }
          //     });

          //     $("#loadMe").modal({
          //          backdrop: "static", //remove ability to close modal with click
          //           keyboard: false, //remove option to close with keyboard
          //           show: true //Display loader!
          //          });
          //     setTimeout(function() {
          //          $("#loadMe").modal("hide");
          //         }, 5000);
          //     return true;

          //     // return form2.valid();
          //   }
          //   else{
          //   return form2.valid();
          // }
            
          // }

          // if (currentIndex == 2) {
          //     form3.validate().settings.ignore = ":disabled,:hidden";
            
          //   if(form3.valid()){

          //      event.preventDefault();
          //     $.ajax({
          //       method: "POST",
          //       url: "formsubmit.php",
          //       data: $("#m1form3_submit").serialize(),
          //       beforeSend: function() {
          //         $("#loadMe").modal({
          //           backdrop: "static", //remove ability to close modal with click
          //           keyboard: false, //remove option to close with keyboard
          //           show: true //Display loader!
          //         });

          //         setTimeout(function() {
          //           $("#loadMe").modal("hide");
          //         }, 5000);


          //       },
          //       success: function(textStatus, status) {
          //         console.log(textStatus);
          //         console.log(status);

          //       },
          //       error: function(xhr, textStatus, error) {
          //         console.log(xhr.responseText);
          //         console.log(xhr.statusText);
          //         console.log(textStatus);
          //         console.log(error);
          //       }
          //     });
          //     $("#loadMe").modal({
          //          backdrop: "static", //remove ability to close modal with click
          //           keyboard: false, //remove option to close with keyboard
          //           show: true //Display loader!
          //          });
          //     setTimeout(function() {
          //          $("#loadMe").modal("hide");
          //         }, 5000);
          //     return true;
          //     // return form3.valid();
          //   }
          //   else{
          //   return form3.valid();
          // }
            
          // }
//           if (currentIndex == 3) {
//               form4.validate().settings.ignore = ":disabled,:hidden";
//               form4.validate({
//   rules: {
//     total1: {
//       required: true,
//       min: 460000
//     }
//   }
// });
          //   if(form4.valid()){

          //      event.preventDefault();
          //     $.ajax({
          //       method: "POST",
          //       url: "formsubmit.php",
          //       data: $("#m1form4_submit").serialize(),
          //       beforeSend: function() {
          //         $("#loadMe").modal({
          //           backdrop: "static", //remove ability to close modal with click
          //           keyboard: false, //remove option to close with keyboard
          //           show: true //Display loader!
          //         });

          //         setTimeout(function() {
          //           $("#loadMe").modal("hide");
          //         }, 5000);


          //       },
          //       success: function(textStatus, status) {
          //         console.log(textStatus);
          //         console.log(status);

          //       },
          //       error: function(xhr, textStatus, error) {
          //         console.log(xhr.responseText);
          //         console.log(xhr.statusText);
          //         console.log(textStatus);
          //         console.log(error);
          //       }
          //     });
          //     var nu = parseInt($('#total1').val());

          //     if(nu<460000){
          // alert('Value should be greater than 460000');
          // return false;

          //     }
          //     else{
          //       return form1.valid();
          //     }
              
          //   }
          //   else{
          //   return form4.valid();
          // }
            
          // }
         
            

          },

          onFinishing: function(event, currentIndex) {
            var form2 = $("#collectionform");
            form2.validate().settings.ignore = ":disabled,:hidden";
            
              if(form2.valid()){
  
                 event.preventDefault();
                // $.ajax({
                //   method: "POST",
                //   url: "formsubmit.php",
                //   data: $("#m1form2_submit").serialize(),
                //   beforeSend: function() {
                //     $("#loadMe").modal({
                //       backdrop: "static", //remove ability to close modal with click
                //       keyboard: false, //remove option to close with keyboard
                //       show: true //Display loader!
                //     });
  
                //     setTimeout(function() {
                //       $("#loadMe").modal("hide");
                //     }, 5000);
  
  
                //   },
                //   success: function(textStatus, status) {
                //     console.log(textStatus);
                //     console.log(status);
  
                //   },
                //   error: function(xhr, textStatus, error) {
                //     console.log(xhr.responseText);
                //     console.log(xhr.statusText);
                //     console.log(textStatus);
                //     console.log(error);
                //   }
                // });
  
                $("#loadMe").modal({
                     backdrop: "static", //remove ability to close modal with click
                      keyboard: false, //remove option to close with keyboard
                      show: true //Display loader!
                     });
                setTimeout(function() {
                     $("#loadMe").modal("hide");
                    }, 5000);

                    window.location.href = "dashboard.php";
                return true;
                    
                // return form2.valid();
              }
              else{
              return form2.valid();
            }
              
           
          //   var form5 = $("#m1form5_submit");

          //   form5.validate().settings.ignore = ":disabled,:hidden";

          //   if(form5.valid()){
          //   event.preventDefault();
          //   $.ajax({
          //     method: "POST",
          //     url: "formsubmit.php",
          //     data: $("#m1form5_submit").serialize(),
          //     beforeSend: function() {
          //       $("#loadMe").modal({
          //         backdrop: "static", //remove ability to close modal with click
          //         keyboard: false, //remove option to close with keyboard
          //         show: true //Display loader!
          //       });

          //       setTimeout(function() {
          //         $("#loadMe").modal("hide");
          //       }, 5000);


          //     },
          //     success: function(textStatus, status) {
          //       console.log(textStatus);
          //       console.log(status);
          //       $(location).attr('href', '../rut.php');

          //     },
          //     error: function(xhr, textStatus, error) {
          //       console.log(xhr.responseText);
          //       console.log(xhr.statusText);
          //       console.log(textStatus);
          //       console.log(error);
          //     }
          //   });
          //   return form5.valid();
          //   }
          //   else{
          //   return form5.valid();
          // }



          }
        });

      });

   

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

//         stepTitles.eq(state.currentIndex).next(".body")
//     .each(function () {
//     var bodyHeight = $(this).height();
//     var padding = $(this).innerHeight() - bodyHeight;
//     bodyHeight += padding;
//     $(this).after('<div class="' + options.clearFixCssClass + '"></div>');
//     $(this).parent().animate({ height: bodyHeight }, "slow");
// });
        
    </script>
</body>
</html>
