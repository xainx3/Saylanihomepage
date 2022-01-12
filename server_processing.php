<?php

session_start();
if(!isset($_SESSION["id"])){
  header("Location: dashboard.php");
  exit();
  }
## Database configuration
include 'connection/connection.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and (`study_id` like '%".$searchValue."%' or 
    `name` like '%".$searchValue."%' or 
    `contact_number` like'%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from `participantsinfocenter`");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from `participantsinfocenter` WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from `participantsinfocenter` WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {


  if($row["parti_status"]==1)
  {
  
  $selectop='<div class="form-group">
  <select class="form-control bg-danger dashboardselect" id="'.$row["study_id"].'">
    <option value="1" selected>Pending Approval</option>
    <option value="2">Received</option>       
  </select>
  </div>';
  
  }
  
 else
  {
  
    $selectop='<div class="form-group">
    <select class="form-control bg-success dashboardselect" id="'.$row["study_id"].'">
    <option value="1">Pending Approval</option>
    <option value="2" selected>Received</option>      
    </select>
    </div>';
  
  }


if($_SESSION['role']=="DE"){
$deletebtn="";
}
else{
$deletebtn="<a class='btn btn-danger btn-sm' href='#' data-toggle='modal' data-target='#".$row['study_id']."'>
<i class='fas fa-trash'>
</i>
Delete
</a>

<div class='modal fade' id='".$row['study_id']."'>
    <div class='modal-dialog'>
      <div class='modal-content bg-danger'>
   
        <div class='modal-body'>
          <p class='text-center'>Are you sure you want to remove this Participant?</p>
        </div>
        <div class='modal-footer justify-content-between'>
          <button type='button' class='btn btn-outline-light' data-dismiss='modal'>No</button>
        
        <form method='post'>

<input type='hidden' value='".$row['study_id']."' name='sid'>

<button type='submit' class='btn btn-outline-light' name='delete'>Yes</button>

      </form>
        
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>";
}




   $data[] = array( 
      "study_id"=>$row['study_id'],
      "name"=>$row['name'],
      "age"=>$row['age'],
      "sex"=>$row['sex'],
      "contact_number"=>$row['contact_number'],
      "status"=>$selectop,
    "optionbtns"=>"<a class='btn btn-info btn-sm' href='patientdetails.php?patientid=".$row['study_id']."'>
    <i class='fas fa-pencil-alt'>
    </i>
    View
</a> ".$deletebtn

   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);