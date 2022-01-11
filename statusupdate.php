<?php

include "connection/connection.php";

  
if(isset($_GET['value'])){
$selectedvalue=$_GET['value'];
$invoiceid=$_GET['invoiceid'];

$sql=" UPDATE `samplesdata` SET `sample_status`='$selectedvalue' WHERE `sdid`='$invoiceid'";

 if($conn->query($sql)===TRUE){ 
                echo "updated";
            }
            else{
                echo "error";
            }
        }
        if(isset($_GET['roomvalue'])){

            
            $selectedvalue=$_GET['roomvalue']; 
            
        
            $sql1 = "SELECT * FROM `freezer` WHERE `frid`='$selectedvalue'";

            $result1 = mysqli_query($conn, $sql1);


            while($row1 = mysqli_fetch_array($result1))  
            { 
            
               echo '<option value="'.$row1["freid"].'">'.$row1["freezername"].'</option>';
            
            }
             }
                         if(isset($_GET['freezervalue'])){

            
                        $freezerselectedvalue=$_GET['freezervalue']; 
                        
                        $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";
            
                        $result1 = mysqli_query($conn, $sql1);
            
            
                        while($row1 = mysqli_fetch_array($result1))  
                        { 
                        
                           echo ' <div class="form-group col-md-6">
                           <label for="exampleInputEmail1">Select Row Number</label>
                           <select class="form-control " name="status" id="rowselect">';
                           
                           for($i=1;$i<=$row1["freezerrows"];$i++){

echo '<option value="'.$i.'" >Row-'.$i.'</option>';

                           }
                           
                           
                           echo '</select> </div>
                           
                           <div class="form-group col-md-6">
                           <label for="exampleInputEmail1">Select Row Number</label>
                           <select class="form-control " name="status" id="columnselect">';
                           
                           for($i=1;$i<=$row1["freezercolumns"];$i++){

                            echo '<option value="'.$i.'" >Column-'.$i.'</option>';
                            
                                                       }
                           
                           
                            echo'</select> </div>';

                       
                        
                        }
            
                    
                        
                        
                                }
  
  
?>