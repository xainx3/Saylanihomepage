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

            echo '<option value="0">Select Freezer</option>';
            while($row1 = mysqli_fetch_array($result1))  
            { 
            
               echo '<option value="'.$row1["freid"].'">'.$row1["freezername"].'</option>';
            
            }
             }
                       
             
             
             
             if(isset($_GET['freezershelf'])){

            
                        $freezerselectedvalue=$_GET['freezershelf']; 
                        
                        $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";
            
                        $result1 = mysqli_query($conn, $sql1);
            
            
                        while($row1 = mysqli_fetch_array($result1))  
                        { 
                        
                        
                           
                           for($i=1;$i<=$row1["num_of_shelves"];$i++){

echo '<option value="'.$i.'" >Shelf-'.$i.'</option>';

                           }
                           
                           
                        }
            
                    
                        
                        
                    }  

                    if(isset($_GET['freezerrack'])){

            
                        $freezerselectedvalue=$_GET['freezerrack']; 
                        
                        $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";
            
                        $result1 = mysqli_query($conn, $sql1);
            
            
                        while($row1 = mysqli_fetch_array($result1))  
                        { 
                           
                         
                           for($i=1;$i<=$row1["num_of_racks"];$i++){

                            echo '<option value="'.$i.'" >Rack-'.$i.'</option>';
                            
                                                       }                         
                   }
             }


             if(isset($_GET['freezerbox'])){

            
                $freezerselectedvalue=$_GET['freezerbox']; 
                
                $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";
    
                $result1 = mysqli_query($conn, $sql1);
    
    
                while($row1 = mysqli_fetch_array($result1))  
                { 
                   
                 
                   for($i=1;$i<=$row1["num_of_boxes"];$i++){

                    echo '<option value="'.$i.'" >Box-'.$i.'</option>';
                    
                                               }                         
           }
     }
     if(isset($_GET['boxposition'])){

            
        $freezerselectedvalue=$_GET['boxposition']; 
        
        $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";

        $result1 = mysqli_query($conn, $sql1);


        while($row1 = mysqli_fetch_array($result1))  
        { 
           
         
           for($i=1;$i<=$row1["num_of_positions"];$i++){

            echo '<option value="'.$i.'" >'.$i.'</option>';
            
                                       }                         
   }
}



                                if(isset($_GET['dashboardstatusvalue'])){
                                    $dashboardstatusvalue=$_GET['dashboardstatusvalue'];
                                    $dashboardstatusselect=$_GET['dashboardstatusselect'];

                                    echo $dashboardstatusvalue;
                                    echo $dashboardstatusselect;
                                    
                                    $sql=" UPDATE `participantsinfocenter` SET `parti_status`='$dashboardstatusvalue' WHERE `study_id`='$dashboardstatusselect'";
                                    
                                     if($conn->query($sql)===TRUE){ 
                                                    echo "updated";
                                                }
                                                else{
                                                    echo "error";
                                                }
                                            }
  
  
?>