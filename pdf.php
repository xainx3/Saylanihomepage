<?php
$thispage='report';
require_once('plugins/tcpdf/tcpdf.php'); 

include "connection/connection.php";


session_start();;
if(!isset($_SESSION["id"])){
  header("Location: ../index.php");
  exit();
  }

if(isset($_GET['sampleid'])){

  $studyid=$_GET['sampleid'];
  $sdate=$_GET['date'];


  
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
<table border="1"  cellpadding="3" cellspacing="2" align="center">
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
    <td>$glu </td>
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
  <td>'.$altl.' ?>

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


// ---------------------------------------------------------

$pdf->Output('LIPID-'.$studyid.'-'.$sdate.'.pdf', 'I');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CNCD - REPORT</title>




  <link rel="stylesheet" href="dist/css/adminlte.min.css">
<style>
@print { 
	@page :footer { 
		display: none
	} 

	@page :header { 
		display: none
	} 
} 
@media print { 
	@page { 
		margin-top: 0; 
		margin-bottom: 0; 
	} 
	body { 
		padding-top: 72px; 
		padding-bottom: 72px ; 
	} 
} 
  table{

    word-wrap:break-word;

  }
  td{
    width:100px;
  }
hr {
    
    border-top: 5px solid rgba(0,0,0,.1);
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



    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <div class="container">
                <div class="page-content container">
                    <div class="page-header text-blue-d2">
                      
                
                        
                    </div>
                
                    <div class="container px-0">
                        <div class="row mt-4">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="row">
                                    
                                <div class="col-3">
                                        <div class="text-left ">
                                        <img src="images/logo.png" alt="" style="width:180px;">
                                        
                                        </div></div>
                
                                        <div class="col-8">
                                        <div class="text-center">
                                        <h3 class="text-primary">CENTER FOR NON COMMUNICABLE DISEASES</h3>
                                        <p class="text-center text-danger">RESEARCH LABORATORY</p>
                                        </div></div>
                
                
                                </div>
                                <!-- .row -->
                
                                <hr class="row brc-default-l mx-n1 mb-4" size="3" />
                
                                <div class="row text-center">
                                    <div class="col-sm-4">
                                        <div>
                                            <span class="text-600 text-110  align-middle">STUDY ID :</span>
                                            <span class="text-600 text-110  align-middle"><b><?php echo $studyid ?></b> </span>
                                        </div>
                                        <div class="text-grey-m2">
                                            <div class="my-1">
                                                NAME: <b><?php echo $pname ?></b> 
                                            </div>
                                          
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4">
                                        <div>
                                            <span class="text-600 text-110  align-middle">CENTER :</span>
                                            <span class="text-600 text-110  align-middle"><b><?php echo $center ?></b> </span>
                                        </div>
                                        <div class="text-grey-m2">
                                            <div class="my-1">
                                               AGE: <b><?php echo $page ?></b> 
                                            </div>
                                            
                                        </div>
                                    </div>
                
                                    <div class="text-95 col-sm-4 align-self-start d-sm-flex justify-content-end">
                                        <div class="text-grey-m2">
                                            
                
                                            <div>
                                        </div>
                                        <div class="text-grey-m2">
                                            <div class="my-1">
                                                DATE: <b><?php echo $sdate ?></b> 
                                            </div>
                                            <div class="my-1">
                                              GENDER: <b><?php echo $pgender ?></b> 
                                            </div>
                                        </div>
                
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    
                                </div>
                                <hr class="row brc-default-l1 mx-n1 mb-4" />
                
                                <div class="text-center mb-5">
                             <h3> <u>BIO-CHEMISTRY REPORT</u> </h3>
                                    </div>
                                    <div class="row text-600 text-dark bgc-default-tp1 py-25">
                                    <table class="table table-strip mx-auto text-center">
                  <thead>
                    <tr>
                      <th scope="col">Test(s)</th>
                      <th scope="col">Result(s)</th>
                      <th scope="col">Range(s)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Random Blood Glucose</td>
                      <td><?php echo $glu ?></td>
                      <td> &lt; 200mg/dl</td>
                    </tr>
                    <tr>
                      <td>Serum Cholesterol</td>
                      <td><?php echo $chlo ?></td>
                      <td>"Without known coronary artery disease; ≤ 200 mg/dl: Desirable.
                With known coronary artery disease;≤160 mg/dl:Optimal."	
                </td>
                    </tr>
                    <tr>
                    <td>Serum Triglycerides</td>
                      <td ><?php echo $tg ?>
                </td>
                      <td>46-236mg/dl 
                </td>
                    </tr>
                    <tr>
                    <td>HDL
                </td>
                      <td ><?php echo $hdl ?>
                
                </td>
                      <td>"Without known coronary artery disease; ≥ 35 mg/dl:Desirable.
                With known coronary artery disease; ≥ 35 mg/dl:Optimal."	
                
                </td>
                    </tr>
                
                    <tr>
                      <td>LDL
                </td>
                    <td><?php echo $ldl ?>
                </td>
                    <td>"Without known coronary artery disease; ≤ 130 mg/dl:Desirable.
                With known coronary artery disease; ≤ 100 mg/dl:Optimal."	
                </td>
                  </tr>
                
                
                
                    <tr>
                      <td>VLDL
                </td>
                    <td><?php echo $vldl ?>
                </td>
                    <td>Normal VLDL levels are from 2 to 30 mg/Dl
                </td>
                  </tr>
                    <tr>
                      <td>Serum Creatinine
                </td>
                    <td><?php echo $creat ?>
                </td>
                    <td>0.6 – 1.5 mg/dl
                </td>
                  </tr>
                
                <?php
                if(!empty($astl))
                {
                ?>
                
                  <tr>
                      <td>AST (SGOT)
                </td>
                    <td><?php echo $astl ?>
                </td>
                    <td>< 35 U/I
                </td>
                  </tr>
                  <tr>
                      <td>ALT (SGPT)
                
                </td>
                    <td><?php echo $altl ?>
                
                </td>
                    <td>< 45 U/I
                
                </td>
                  </tr>
                
                <?php
                }?>
                  </tbody>
                </table>
                          </div>
                
                                    <div class="row border-b-2 brc-default-l2"></div>
                
                                    <!-- or use a table instead -->
                                    
                
                              <small class="mt-5">This is a computer generated report this doesnot require any signature.</small> <br>
                              <small >This report is generated for research purpose only and should not be use for diagonastic purposes.</small>
                
                
                                   
                
                                    <div class="mt-5">
                                       <div class="text-center">                     
                                         
                
                                       <?php
                 echo "<img alt='testing' src='barcode/barcode.php?size=40&text=".$studyid."&print=true'/>";
                
                                       ?>
                                       </div>
                
                                       <hr />
                                       <p class="text-center "> <i> Plot # 19/2, Sector 17, Near Bilal Chowrangi, korangi industrial Area, Karachi. <br>
                Phones +92 21 35111 090 – 102 (13 Lines) Website: www.cncd.org</i>
                </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

    
                
              
                </body>
                </html>