<?php
require_once('plugins/tcpdf/tcpdf.php'); 
include "connection/connection.php";

if(isset($_POST['pdf'])){

  $studyid=$_POST['stid'];
  $sdate=$_POST['rdate'];
  
  $sql1 = "SELECT *FROM `participantsinfocenter` as `pic` INNER JOIN `labvalues_lipid` as `lvl` on pic.study_id=lvl.study_id WHERE lvl.study_id='$studyid' AND lvl.study_date='$sdate'";
 

  $result1 = mysqli_query($conn, $sql1);
  
  
  while($row1 = mysqli_fetch_array($result1))  
  
  { 


    $pgender  =   $row1['sex'];
    $page     =   $row1['age'];
    $pname    =   $row1['name'];
    $chlo     =   $row1['chlo'];
    $glu      =   $row1['glu'];
    $creat    =   $row1['creat'];
    $tg       =   $row1['tg'];
    $hdl      =   $row1['hdl'];
    $vldl     =   $row1['vldl'];
    $astl     =   $row1['astl'];
    $altl     =   $row1['altl'];
    $ldl      =   $row1['ldl'];
    $center   =   $row1['center'];
  
  }


  class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.png';
        $this->Image($image_file, 10, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 14);
        // Title
        $this->Cell(0, 15, 'CENTER FOR NON COMMUNICABLE DISEASES', 0, false, 'C', 0, '', 0, false, 'S', 'S');
        $this->SetY(15);
        $this->SetFont('helvetica', 'B', 10);
        
        $this->Cell(220, 15, 'RESEARCH LABORATORY', 0, false, 'C', 0, '', 0, false, 'S', 'S');
    
  
        $this->SetY(30);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->writeHTML('<hr />', true, false, false, false, '');
  
    }
  
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom

        $this->SetY(-23);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->writeHTML('<p>This is a computer generated report this doesnot require any signature. <br/>
        This report is generated for research purpose only and should not be use for diagonastic purposes.</p>', true, false, false, false, '');

        $this->SetY(-14);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->writeHTML('<hr/>', true, false, false, false, '');
  
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Plot # 19/2, Sector 17, Near Bilal Chowrangi, korangi industrial Area, Karachi.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Phones +92 21 35111 090 – 102 (13 Lines) Website: www.cncd.org.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  
      }
  }
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('CNCD');
  $pdf->SetTitle('LIPID_PROFILE_'.$studyid.'_'.$sdate.'');
  $pdf->SetSubject('REPORT');
  
  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
  
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
  if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
  }
  
  
  $pdf->SetFont('times', '', 10);
  
  $pdf->AddPage();
  
  
  $pdf->SetXY(20,35);
  $tbl = <<<EOD
  <table  cellpadding="2" cellspacing="1" width="100%">
  
   <tr >
    <td>MR.NO : <b>$studyid</b> </td>
    <td>CENTER:<b>$center</b> </td>
    <td>DATE: <b>$sdate</b></td>
  
   </tr>
   <tr >
    <td>NAME: <b>$pname</b></td>
    <td>AGE: <b>$page</b></td>
    <td>GENDER: <b>$pgender</b></td>
   </tr>
  
  </table>
  EOD;
  $pdf->writeHTML($tbl, true, false, false, false, '');
  $pdf->SetFont('helvetica', 'I', 8);
  $pdf->writeHTML('<hr />', true, false, false, false, '');
  
  
  $pdf->SetFont('helvetica', 'BU', 16);
  // Title
  $pdf->Cell(0, 10, 'BIO-CHEMISTRY', 0, false, 'C', 0, '', 0, false, 'S', 'S');
  
  
  $pdf->SetFont('dejavusans', '', 12);
  
  
  $pdf->SetXY(20,70);
  $tbl1 = '
  <table border="1"  cellpadding="5" cellspacing="1" align="center">
  <thead>
    <tr>
      <th scope="col"> <b>Test(s)</b></th>
      <th scope="col"><b>Result(s)</b></th>
      <th scope="col"><b>Range(s)</b></th>
    </tr>
  </thead>
  <tbody>';
  
  
  
  $tbl1 .= '
    <tr>
      <td>Random Blood Glucose</td>
      <td>'.$glu.' </td>
      <td> &lt; 200mg/dl</td>
    </tr>
    <tr>
      <td>Serum Cholesterol</td>
      <td>'.$chlo.' </td>
      <td>"Without known coronary artery disease ≤ 200 mg/dl: Desirable.
  With known coronary artery disease ≤ 160 mg/dl:Optimal."	
  </td>
    </tr>
    <tr>
    <td>Serum Triglycerides</td>
      <td >'.$tg.' 
  </td>
      <td>46-236mg/dl 
  </td>
    </tr>
    <tr>
    <td>HDL
  </td>
      <td >'.$hdl.'
  
  </td>
      <td>"Without known coronary artery disease &#8805; 35 mg/dl:Desirable.
  With known coronary artery disease; &#8805; 35 mg/dl:Optimal."	
  
  </td>
    </tr>
  
    <tr>
      <td>LDL
  </td>
    <td>'.$ldl.' 
  </td>
    <td>"Without known coronary artery disease; ≤ 130 mg/dl:Desirable.
  With known coronary artery disease; ≤ 100 mg/dl:Optimal."	
  </td>
  </tr>
  
  
  
    <tr>
      <td>VLDL
  </td>
    <td>'.$vldl.'
  </td>
    <td>Normal VLDL levels are from 2 to 30 mg/Dl
  </td>
  </tr>
    <tr>
      <td>Serum Creatinine
  </td>
    <td>'.$creat.' 
  </td>
    <td>0.6 – 1.5 mg/dl
  </td>
  </tr>';
  
  
  if(!empty($astl))
  {
    $tbl1 .='
  
  <tr>
      <td>AST (SGOT)
  </td>
    <td>'.$astl.' 
  </td>
    <td>< 35 U/I
  </td>
  </tr>
  <tr>
      <td>ALT (SGPT)
  
  </td>
    <td>'.$altl.'
  
  </td>
    <td>< 45 U/I
  
  </td>
  </tr>';
  }
  
  $tbl1 .='
  </tbody>
  </table>
  ';
  $pdf->writeHTML($tbl1, true, false, false, false, '');
  $style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$style['position'] = 'C';

$barcodedata=$studyid.'-'.$sdate;
  // $pdf->write1DBarcode($studyid, 'C128A', '', '', '', 15, 0.4, $style, 'N');
  
  // ---------------------------------------------------------

  $pdf->Output('LIPID-'.$studyid.'-'.$sdate.'.pdf', 'D');

  
}


if(isset($_POST['pdfcbc'])){

  $studyid=$_POST['stid'];
  $sdate=$_POST['rdate'];
  
  $sql1 = "SELECT *FROM `participantsinfocenter` as `pic` INNER JOIN `labvalues_cbc` as `lvc` on pic.study_id=lvc.study_id WHERE lvc.study_id='$studyid' AND lvc.study_date='$sdate'";
 

  $result1 = mysqli_query($conn, $sql1);
  
  
  while($row1 = mysqli_fetch_array($result1))  
  
  { 


    $pgender  =   $row1['sex'];
    $page     =   $row1['age'];
    $pname    =   $row1['name'];
    $wbc     =   $row1['wbc'];
    $rbc      =   $row1['rbc'];
    $hgb    =   $row1['hgb'];
    $hct       =   $row1['hct'];
    $mcv      =   $row1['mcv'];
    $mch     =   $row1['mch'];
    $mchc     =   $row1['mchc'];
    $plt     =   $row1['plt'];
    $rdw_sd      =   $row1['rdw_sd'];
    $rdw_cv      =   $row1['rdw_cv'];
    $pdw      =   $row1['pdw'];
    $mpv      =   $row1['mpv'];
    $p_lcr      =   $row1['p_lcr'];
    $pct      =   $row1['pct'];
    $neut      =   $row1['neut'];
    $lymph      =   $row1['lymph'];
    $mono      =   $row1['mono'];
    $eos      =   $row1['eos'];
    $basso     =   $row1['basso'];
    $center   =   $row1['center'];
  
  }


  class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'logo_example.png';
        $this->Image($image_file, 10, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 14);
        // Title
        $this->Cell(0, 15, 'CENTER FOR NON COMMUNICABLE DISEASES', 0, false, 'C', 0, '', 0, false, 'S', 'S');
        $this->SetY(15);
        $this->SetFont('helvetica', 'B', 10);
        
        $this->Cell(220, 15, 'RESEARCH LABORATORY', 0, false, 'C', 0, '', 0, false, 'S', 'S');
    
  
        $this->SetY(30);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->writeHTML('<hr />', true, false, false, false, '');
  
    }
  
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom

        $this->SetY(-25);
        // Set font
        $this->SetFont('helvetica', '', 8);
        $this->writeHTML('<p>This is a computer generated report this doesnot require any signature. <br/>
        This report is generated for research purpose only and should not be use for diagonastic purposes.</p>', true, false, false, false, '');

        $this->SetY(-14);
        // Set font
        $this->SetFont('helvetica', '', 8);
        $this->writeHTML('<hr/>', true, false, false, false, '');
  
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Plot # 19/2, Sector 17, Near Bilal Chowrangi, korangi industrial Area, Karachi.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetY(-10);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Phones +92 21 35111 090 – 102 (13 Lines) Website: www.cncd.org.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  
      }
  }
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('CNCD');
  $pdf->SetTitle('CBC_'.$studyid.'_'.$sdate.'');
  $pdf->SetSubject('REPORT');
  
  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
  
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
  if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      require_once(dirname(__FILE__).'/lang/eng.php');
      $pdf->setLanguageArray($l);
  }
  
  
  $pdf->SetFont('times', '', 10);
  
  $pdf->AddPage();
  
  
  $pdf->SetXY(20,35);
  $tbl = <<<EOD
  <table  cellpadding="2" cellspacing="1" width="100%">
  
   <tr >
    <td>MR.NO : <b>$studyid</b> </td>
    <td>CENTER:<b>$center</b> </td>
    <td>DATE: <b>$sdate</b></td>
  
   </tr>
   <tr >
    <td>NAME: <b>$pname</b></td>
    <td>AGE: <b>$page</b></td>
    <td>GENDER: <b>$pgender</b></td>
   </tr>
  
  </table>
  EOD;
  $pdf->writeHTML($tbl, true, false, false, false, '');
  $pdf->SetFont('helvetica', 'I', 8);
  $pdf->writeHTML('<hr />', true, false, false, false, '');
  
  
  $pdf->SetFont('helvetica', 'BU', 16);
  // Title
  $pdf->Cell(0, 10, 'HAEMATOLOGY REPORT', 0, false, 'C', 0, '', 0, false, 'S', 'S');
  
  
  $pdf->SetFont('dejavusans', '', 12);
  
  
  $pdf->SetXY(20,70);
  $tbl1 = '
  <table border="1"  cellpadding="5" cellspacing="1" align="center">
  <thead>
    <tr>
      <th scope="col"> <b>Test(s)</b></th>
      <th scope="col"><b>Result(s)</b></th>
      <th scope="col"><b>Range(s)</b></th>
    </tr>
  </thead>
  <tbody>';
  
  
  
  $tbl1 .= '
  <tr>
    <td>WBC</td>
    <td>'. $wbc .'[10^3/µL]</td>
    <td> &lt; 4.0-10.0</td>
  </tr>
  <tr>
    <td>RBC</td>
    <td>'. $rbc .' [10^6/µL]</td>
    <td>3.9-4.8
</td>
  </tr>
  <tr>
  <td>HGB</td>
    <td >'. $hgb .'[g/dL]
</td>
    <td>12.0-15.0
</td>
  </tr>
  <tr>
  <td>HCT
</td>
    <td >'. $hct .'[%]

</td>
    <td>36-46

</td>
  </tr>

  <tr>
    <td>MCV
</td>
  <td>'. $mcv .' [fL]
</td>
  <td>	
      80-100
</td>
</tr>



  <tr>
    <td>MCh
</td>
  <td>'. $mch .' [pg]
</td>
  <td>27-32
</td>
</tr>
  <tr>
    <td>MCHC
</td>
  <td>'. $mchc .' [g/dL]
</td>
  <td>31.5-34.5
</td>
</tr>



<tr>
    <td>PLT
</td>
  <td>'. $plt.' [10^3/µL]
</td>
  <td>150-400
</td>
</tr>
<tr>
    <td>RDW-SD

</td>
  <td>'. $rdw_sd.' [fL]

</td>
  <td>

</td>
</tr>
<tr>
    <td>RDW-CV

</td>
  <td>'. $rdw_cv.' [%]

</td>
  <td>
[11.6-14]
</td>
</tr>
<tr>
    <td>PDW

</td>
  <td>'. $pdw.' [fL]

</td>
  <td>

</td>
</tr>
<tr>
    <td>MPV

</td>
  <td>'. $mpv.' [fL]

</td>
  <td>

</td>
</tr>
<tr>
    <td>P-LCR

</td>
  <td>'. $p_lcr.' [fL]

</td>
  <td>

</td>
</tr>
<tr>
    <td>PCT

</td>
  <td>'. $pct.' [%]

</td>
  <td>

</td>
</tr>
<tr>
    <td>NEUTROPHILS

</td>
  <td>'. $neut.' [%]

</td>
  <td>
40-75
</td>
</tr>

<tr>
    <td>LYMPHOCYTES

</td>
  <td>'. $lymph.' [%]

</td>
  <td>
20-45
</td>
</tr>
<tr>
    <td>MONOCYTES

</td>
  <td>'. $mono.' [%]

</td>
  <td>
2-10
</td>
</tr>

<tr>
    <td>ESINOPHILS

</td>
  <td>'. $eos.' [fL]

</td>
  <td>
01-06
</td>
</tr>

<tr>
    <td>BASOPHILS

</td>
  <td>'. $basso.' [%]

</td>
  <td>
0-1
</td>
</tr>';
    
  
  $tbl1 .='
  </tbody>
  </table>
  ';



  $pdf->writeHTML($tbl1, true, false, false, false, '');

  $pdf->SetFont('helvetica', 'B', 12);
  $pdf->SetY(255);
  // Title
  $pdf->Cell(0, 15, 'REMARKS: Test has been performed on "SYSMEX-XN350" ', 0, false, 'L', 0, '', 0, false, 'S', 'S');


  $style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$style['position'] = 'C';

  // $pdf->write1DBarcode($studyid, 'C128A', '', '', '', 15, 0.4, $style, 'N');
  
  // ---------------------------------------------------------

  $pdf->Output('LIPID-'.$studyid.'-'.$sdate.'.pdf', 'I');

  
}


$thispage='patd';

session_start();
include "connection/connection.php";


if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

if(isset($_GET['patientid'])){

    $patientid=$_GET['patientid'];

    
    
}

if(!isset($_GET['patientid'])){

  header("Location: users.php");
  
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
  $temp=$_POST['temp'].'C';
}

if(!isset($_POST['cnic'])){

  $cnic='N/A';
}
else{
  $cnic=$_POST['cnic'];
}



$insert = $conn->query("UPDATE `participantsinfocenter` SET `date_of_enrollment`='$edate',
`date_of_receiving`='$rdate',`name`='$name',`age`='$age',`sex`='$gender',`contact_number`='$contact',
`temperature`='$temp' WHERE `study_id`='$patientid'");
    
if($insert){
      $statusMsg= "Toast.fire({
  icon: 'success',
  padding: '3em',  
  background: '#EBECEC',
  title: ' Participant Updated Successfully.'
  });";               
    
}





}

if(isset($_POST['storesample'])){



  $studyid=$_POST['mrno'];
  $sampleid=$_POST['sampleid'];
  $room=$_POST['roomselect'];
  $freezer=$_POST['freezer'];
  $freezerrow=$_POST['frow'];
  $freezercolumn=$_POST['fcolumn'];
  

  $sample_location=$room.'->'.$freezer.'->'.$freezerrow.'->'.$freezercolumn;
  
  $query= "select *from `samples_storage_location` where `study_id`='$studyid' AND `sample_id`='$sampleid' ";
  $result= mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result)>0){

    $updatesamplelocation = $conn->query("UPDATE `samples_storage_location` SET `freezer_room`='$room',
    `freezer`='$freezer',`freezer_rows`='$freezerrow',
    `freezer_columns`='$freezercolumn',`location`='$sample_location' WHERE `study_id`='$studyid' AND `sample_id`='$sampleid'");



    $statusMsg= "Toast.fire({
      icon: 'success',
      padding: '3em',  
      background: '#EBECEC',
      title: '&nbsp; Location Updated Successfully'
    });";
  
  }
else{
  $insertsamplelocation = $conn->query("INSERT INTO `samples_storage_location`(`study_id`, `sample_id`, 
  `freezer_room`, `freezer`, `freezer_rows`, `freezer_columns`, `location`) 
  VALUES ('$studyid','$sampleid','$room','$freezer','$freezerrow',
  '$freezercolumn','$sample_location')");

  $samplestatusupdate = $conn->query("UPDATE `samplesdata` SET `sample_status`='4' WHERE `study_id`='$studyid' AND `sample_id`='$sampleid'"); 
  
  if($insertsamplelocation && $samplestatusupdate){
        $statusMsg= "Toast.fire({
    icon: 'success',
    padding: '3em',  
    background: '#EBECEC',
    title: 'Sample Stored Successfully.'
    });";               
      
  }
  
}
  
  
  
  }


  if(isset($_POST['deletesample'])){

    $dsid=$_POST['dsid'];
    
     
    $delete = $conn->query("DELETE FROM `samplesdata` WHERE `sdid`='$dsid'");
    if($delete){
      $statusMsg= "Toast.fire({
    icon: 'success',
    padding: '3em',  
    background: '#EBECEC',
    title: ' Sample Deleted Successfully.'
    });";               
    }else{
        echo mysqli_error($conn); 
      $statusMsg= "Toast.fire({
        icon: 'error',
        padding: '3em',
        background: '#EBECEC',
        title: ' Unable to delete Sample.'
      });";          
      } 
    
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CNCD - UPDATE USER</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<style>
 a.disabled:hover {
    cursor:not-allowed !important;
 }
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
              <li class="breadcrumb-item active">Patient Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php

$sql1 = "SELECT *FROM `participantsinfocenter` where `study_id` ='$patientid'";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 

    $studyid=$row1['study_id'];  
    $name=$row1['name'];
    $dateofen=$row1['date_of_enrollment'];
    $dateofrec=$row1['date_of_receiving'];
    $age=$row1['age'];
    $gender=$row1['sex'];
    $contactnumber=htmlspecialchars_decode($row1['contact_number']);
    $temp=$row1['temperature'];
    $cnic1=$row1['cnic'];
}


?> 
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
  
      
         
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Details of <b> <i > <?php echo $name ?></i></b></h3>
              </div>
   


<form method="POST" action="" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                  <div class="form-group col-md-6">
                      <label >MR. No</label>
                      <input type="name" class="form-control bg-secondary"   name="mrno" required value="<?php echo $studyid ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="name" class="form-control" id="exampleInputEmail1"  name="name" required value="<?php echo $name ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Date of Enrollment</label>
                      <input type="date" class="form-control" id="endate"  name="edate" required  value="<?php echo date("Y-m-d", strtotime($dateofen)) ?>" max="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Date of Receiving</label>
                      <input type="date" class="form-control" id="exampleInputEmail1"  name="rdate" required value="<?php echo date("Y-m-d", strtotime($dateofrec)) ?>" max="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Age</label>
                      <input type="number" class="form-control" id="exampleInputPassword1"  name="age" required value="<?php echo $age ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Gender</label>
                      <input type="name" class="form-control" id="exampleInputPassword1"  name="gender" required value="<?php echo $gender ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label >Contact</label>
                      <input type="name" class="form-control"   name="contact" required value="<?php echo   $contactnumber ?>">
                    </div>
  
                    <div class="form-group col-md-6">
                      <label >Temprature</label>
                      <input type="number" class="form-control"  placeholder="Temprature of Participant" name="temp" value="<?php echo  preg_replace('/[^0-9]/', '',  $temp); ?>" required >
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label >CNIC</label>
                      <input type="number" class="form-control"     placeholder="XXXXX-XXXXXXX-X" name="cnic"  value="<?php echo $cnic1 ?>">
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
      <!-- /.card -->

    </section>


   <?php if($_SESSION['role']!="DE"){


?>
<section>

<div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Blood & Urine Samples</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Blood & Urine Reports</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Family Members</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Storage</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                  <div class="tab-pane fade active show " id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                  <table id="example1" class="table table-resposive table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME</th>
        <th>DATE OF EXTRACTION</th>
        <th>STATUS</th>
        <th>OPTIONS</th>
      </tr>
      </thead>
      <tbody >    
      <?php

$samplequery = "SELECT *FROM `samplesdata` WHERE `study_id`='$patientid'";
 
 
$sampleresult = mysqli_query($conn, $samplequery);


while($sampleresultrow = mysqli_fetch_array($sampleresult))  
{ 

  

echo 

'<tr>
<td>'.$sampleresultrow["sample_id"].'</td>
<td><img alt="barcode" src="barcode/barcode.php?size=40&text='.$sampleresultrow["sample_id"].'&print=true"/></td>

<td>'.$sampleresultrow["sample_name"].'</td>

<td>'.$sampleresultrow["date_of_extraction"].'</td>
<td>
<div class="form-group">
<select class="form-control firstselect" name="status" id='.$sampleresultrow["sdid"].'>';


$query = "SELECT *  FROM `status`";
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)) {
    if ($sampleresultrow["sample_status"] == $row['statusid']){

   echo'<option value='.$row["statusid"].'  selected>'.$row["status_name"].'</option>';

if($row["statusid"]=='1'){

  echo '<script> document.getElementById("'.$sampleresultrow["sdid"].'").classList.add("bg-danger");
  document.getElementById("'.$sampleresultrow["sdid"].'").style.color = "white";
  </script>';
}

if($row["statusid"]=='2'){

  echo '<script> document.getElementById("'.$sampleresultrow["sdid"].'").classList.add("bg-success");
  document.getElementById("'.$sampleresultrow["sdid"].'").style.color = "white";
  </script>';
}

if($row["statusid"]=='3'){

  echo '<script> document.getElementById("'.$sampleresultrow["sdid"].'").classList.add("bg-warning");
  document.getElementById("'.$sampleresultrow["sdid"].'").style.color = "white";
  </script>';
}
if($row["statusid"]=='4'){

  echo '<script> document.getElementById("'.$sampleresultrow["sdid"].'").classList.add("bg-primary");
  document.getElementById("'.$sampleresultrow["sdid"].'").style.color = "white";
  </script>';
}

 }

 else {

  echo'<option value='.$row["statusid"].'>'.$row["status_name"].'</option>';

     } }
 
echo' </select>
                      </div>
</td>


<td>  
<a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#RT'.$sampleresultrow["sdid"].'">
<i class="nav-icon fas fa-arrow-circle-right"></i>
    </i>
    Run Tests
</a>



<a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#M'.$sampleresultrow["sdid"].'">
<i class="nav-icon far fa-snowflake"></i>
    </i>
    Store
</a>
<div class="modal fade" id="RT'.$sampleresultrow["sdid"].'">
    <div class="modal-dialog">
      <div class="modal-content ">
   
        <div class="modal-body">
        <form method="post">

        <input type="name" value="'.$sampleresultrow["sdid"].'" name="dsid">
        
        <button type="submit" class="btn btn-outline-light" name="deletesample">Yes</button>
        
              </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
        

        
        </div>
      </div>
    </div>
  </div>


<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#D'.$sampleresultrow["sdid"].'">
<i class="fas fa-trash">
</i>
Delete
</a>

<div class="modal fade" id="D'.$sampleresultrow["sdid"].'">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
   
        <div class="modal-body">
          <p class="text-center">Are you sure you want to remove this Participant?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">No</button>
        
        <form method="post">

<input type="hidden" value="'.$sampleresultrow["sdid"].'" name="dsid">

<button type="submit" class="btn btn-outline-light" name="deletesample">Yes</button>

      </form>
        
        </div>
      </div>
    </div>
  </div>


</td>
</tr>

<div class="modal fade" id="M'.$sampleresultrow["sdid"].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">STORING '.$sampleresultrow["sample_id"].'</h5>
            </div>
      <div class="modal-body">
      <form method="POST" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                  <div class="form-group col-md-6">
                      <label >Study ID</label>
                      <input type="name" class="form-control bg-secondary text-white"   name="mrno" required value="'.$sampleresultrow["study_id"].'" readonly>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">Sample ID</label>
                      <input type="name" class="form-control bg-secondary text-white" id="exampleInputEmail1"  name="sampleid" value="'.$sampleresultrow["sample_id"].'" readonly required >
                    </div>
                    <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Select Room</label>

                     <select class="form-control roomselect" name="roomselect" id="roomselect">';



$query = "SELECT *  FROM `freezerroom`";
$result = mysqli_query($conn,$query);
echo '<option value="0">Select Storage Room</option>';

while($row = mysqli_fetch_array($result)) {   

   echo'<option value='.$row["frid"].' >'.$row["roomname"].'</option>';

 } 
 
echo' </select>


                    </div>
                    <div class="form-group col-md-6" id="freezerdiv">
                      <label for="exampleInputEmail1">Select Freezer</label>
                      <select class="form-control freezers" name="freezer" id="freezers">
                      <option value="0">Select Freezer</option>
                    </select>
                    </div> 
                    
                    <div class="form-group col-md-6">
                           <label for="exampleInputEmail1">Select Row Number</label>
                           <select class="form-control rowselect" name="frow" id="rowselect">
                           </select>

                           </div>

                           <div class="form-group col-md-6">
                           <label for="exampleInputEmail1">Select Column Number</label>
                           <select class="form-control columnselect" name="fcolumn" id="columnselect">
                           
                           </select>

                           </div>

                    </div>  
                    </div>
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-block btn-lg" name="storesample">Store</button>
                  </div>
                  </div>
  
                
                 
                </form>
      </div>
    
    </div>
  </div>
</div>
';

}
?> 
 </tbody>
    
    </table>                     </div>
                  <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">

                  <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME</th>
        <th>DATE OF RESULT</th>
        <th>STATUS</th>
        <th>Download PDF</th>        
        <th>VIEW DETAILS</th>
      </tr>
      </thead>
      <tbody >    

      <?php

$sql1 = "SELECT * FROM `labvalues_lipid` WHERE `study_id`='$patientid'";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 

    
  echo '<tr>


    <td>'.$row1["study_id"].'</td>
    <td>'.$row1["study_id"].'</td>
    <td>Lipid Profile</td>
    <td>'.$row1["study_date"].'</td>
    <td>
    <div class="form-group">
                            <select class="form-control bg-success">
                              <option>Pending</option>
                              <option >Processing</option>
                              <option Selected>Completed</option>
                             
                            </select>
                          </div>
    </td>
    <td>
    
    <form action="" method="post">
    
    <input type="hidden" name="stid" value="'.$row1["study_id"].'">
    <input type="hidden" name="rdate" value="'.$row1["study_date"].'">

    
    
   
    
    <button type="submit" class="btn btn-app bg-success" name="pdf">
    <i class="fas fa-download"></i> Download
                    </button>
                    
                    </form>
                    </td>
    
                          <td>    
    <a class="btn btn-info btn-sm" href="report.php?sampleid='.$row1["study_id"].'&date='.$row1["study_date"].'">
        <i class="fas fa-pencil-alt">
        </i>
        View
    </a>
    
    
    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger1">
        <i class="fas fa-trash">
        </i>
        Delete
    </a></td>
    </tr>';



}
$sql1 = "SELECT * FROM `labvalues_cbc` WHERE `study_id`='$patientid'";
 
 
$result1 = mysqli_query($conn, $sql1);


while($row1 = mysqli_fetch_array($result1))  
{ 

    
  echo '<tr>


    <td>'.$row1["study_id"].'</td>
    <td>'.$row1["study_id"].'</td>
    <td>CBC</td>
    <td>'.$row1["study_date"].'</td>
    <td>
    <div class="form-group">
                            <select class="form-control bg-success">
                              <option>Pending</option>
                              <option >Processing</option>
                              <option Selected>Completed</option>
                             
                            </select>
                          </div>
    </td>
    <td>
    
    <form action="" method="post">
    
    <input type="hidden" name="stid" value="'.$row1["study_id"].'">
    <input type="hidden" name="rdate" value="'.$row1["study_date"].'">

    
    
   
    
    <button type="submit" class="btn btn-app bg-success" name="pdfcbc">
    <i class="fas fa-download"></i> Download
                    </button>
                    
                    </form>
                    </td>
    
                          <td>    
    <a class="btn btn-info btn-sm" href="reportcbc.php?sampleid='.$row1["study_id"].'&date='.$row1["study_date"].'">
        <i class="fas fa-pencil-alt">
        </i>
        View
    </a>
    
    
    <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-danger1">
        <i class="fas fa-trash">
        </i>
        Delete
    </a></td>
    </tr>';



}

?> 









      </tbody>
    
    </table> 
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
<p class="text-center">No Record Found!</p>
                </div>
                  <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                  <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
      <tr>
        <th>BARCODE DATA</th>
        <th>BARCODE IMAGE</th>
        <th>NAME</th>
        <th>DATE OF STORAGE</th>
        <th>STORAGE LOCATION</th>        
      </tr>
      </thead>
      <tbody >  
        
 <?php
 $sql1 = "SELECT * FROM `samples_storage_location` as `ssl` INNER JOIN `samplesdata` as `sd` ON `ssl`.sample_id=`sd`.sample_id INNER JOIN `freezerroom` as fr ON `ssl`.freezer_room=`fr`.frid INNER JOIN `freezer` ON freezer.freid=`ssl`.freezer WHERE `ssl`.study_id='$patientid'";
 
 
 $result1 = mysqli_query($conn, $sql1);
 
 
 while($row1 = mysqli_fetch_array($result1))  
 { 

echo 
      '<tr>
      <td>'.$row1["sample_id"].' </td>
      <td><img alt="barcode" src="barcode/barcode.php?size=40&text='.$row1["sample_id"].'&print=true"/></td>
      <td>'.$row1["sample_name"].'</td>
      <td>'.$row1["date_of_storage"].'</td>
      <td>'.$row1["roomname"].'->'.$row1["freezername"].'->R'.$row1["freezerrows"].'->C'.$row1["freezercolumns"].'</td>
      </tr>';


 }
 ?>

<tr>








      </tbody>
    
    </table>                        </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
</section>

<?php

    }

    ?>

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


    $(function() {
    $('a[data-toggle="pill"]').on('click', function(e) {
        window.localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = window.localStorage.getItem('activeTab');
    if (activeTab) {
        $('#custom-tabs-four-tab a[href="' + activeTab + '"]').tab('show');
        window.localStorage.removeItem("activeTab");
    }
});


$('.firstselect').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var invoiceId=this.id;
    var dataString = 'value='+ valueSelected + '&invoiceid=' + invoiceId;
    event.preventDefault();

    $.ajax({
    method: "GET",
    url: "statusupdate.php",
    data: dataString,

  
    success: function(textStatus, status){
      console.log(textStatus);
        console.log(status);
        alert('Status Updated Successfully');
        location.reload();
        
        
    },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });
    
    });

    $('.roomselect').on('change', function (e) {
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
        $('.freezers').append(textStatus);
        
        
    },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });
    
    });

    $('.freezers').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var dataString = 'freezervalue1='+ valueSelected ;
    event.preventDefault();
    $.ajax({
    method: "GET",
    url: "statusupdate.php",
    data: dataString,
      success: function(textStatus, status){
      console.log(textStatus);
      console.log(status);
      $( ".rowselect" ).append(textStatus);
        
      var dataString = 'freezervalue2='+ valueSelected ;

    $.ajax({
      
    method: "GET",
    url: "statusupdate.php",
    data: dataString,
      success: function(textStatus, status){
      console.log(textStatus);
      console.log(status);
      $( ".columnselect" ).append(textStatus);
        
        },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });    
   


        },
    error: function(xhr, textStatus, error) {
        console.log(xhr.responseText);
        console.log(xhr.statusText);
        console.log(textStatus);
        console.log(error);
    }
  });    
    });
 
$('.firstselect option[value="4"]').attr('disabled','disabled');

$('.modal').on('hidden.bs.modal', function () {
  location.reload();
})

</script>
</body>
</html>



