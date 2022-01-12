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
                       
             
             
             
             if(isset($_GET['freezervalue1'])){

            
                        $freezerselectedvalue=$_GET['freezervalue1']; 
                        
                        $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";
            
                        $result1 = mysqli_query($conn, $sql1);
            
            
                        while($row1 = mysqli_fetch_array($result1))  
                        { 
                        
                        
                           
                           for($i=1;$i<=$row1["freezerrows"];$i++){

echo '<option value="'.$i.'" >Row-'.$i.'</option>';

                           }
                           
                           
                        }
            
                    
                        
                        
                    }  

                    if(isset($_GET['freezervalue2'])){

            
                        $freezerselectedvalue=$_GET['freezervalue2']; 
                        
                        $sql1 = "SELECT * FROM `freezer` WHERE `freid`='$freezerselectedvalue'";
            
                        $result1 = mysqli_query($conn, $sql1);
            
            
                        while($row1 = mysqli_fetch_array($result1))  
                        { 
                           
                         
                           for($i=1;$i<=$row1["freezercolumns"];$i++){

                            echo '<option value="'.$i.'" >Column-'.$i.'</option>';
                            
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