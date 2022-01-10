<?php 
require_once('plugins/tcpdf/tcpdf.php'); 
session_start();
include "connection/connection.php";
$studyid=$_GET['stid'];
$sdate=$_GET['rdate'];



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




$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $obj_pdf->SetCreator(PDF_CREATOR);  
    $obj_pdf->SetTitle("LIPID PROFILE-".$studyid."-".$sdate." ");  
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $obj_pdf->SetDefaultMonospacedFont('helvetica');  
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $obj_pdf->setPrintHeader(false);  
    $obj_pdf->setPrintFooter(false);  
    $obj_pdf->SetAutoPageBreak(TRUE, 10);  
    $obj_pdf->SetFont('helvetica', '', 11);  
    $obj_pdf->AddPage();  
    $contentpdf = '<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CNCD - REPORT</title>';  
    $contentpdf .= '<style>'.file_get_contents('dist/css/adminlte.min.css').'<style>
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
    </style></style>';
    $contentpdf .='   <body class="hold-transition sidebar-mini">
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
                                        <span class="text-600 text-110  align-middle"><b>'.$studyid.'</b> </span>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            NAME: <b>'.$pname .'</b> 
                                        </div>
                                      
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div>
                                        <span class="text-600 text-110  align-middle">CENTER :</span>
                                        <span class="text-600 text-110  align-middle"><b>'.$center.'</b> </span>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                           AGE: <b>'.$page.'</b> 
                                        </div>
                                        
                                    </div>
                                </div>
            
                                <div class="text-95 col-sm-4 align-self-start d-sm-flex justify-content-end">
                                    <div class="text-grey-m2">
                                        
            
                                        <div>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            DATE: <b>'.$sdate.'</b> 
                                        </div>
                                        <div class="my-1">
                                          GENDER: <b>'.$pgender.'</b> 
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
                  <td>'.$glu .'</td>
                  <td> &lt; 200mg/dl</td>
                </tr>
                <tr>
                  <td>Serum Cholesterol</td>
                  <td>'.$chlo .'</td>
                  <td>"Without known coronary artery disease; ≤ 200 mg/dl: Desirable.
            With known coronary artery disease;≤160 mg/dl:Optimal."	
            </td>
                </tr>
                <tr>
                <td>Serum Triglycerides</td>
                  <td >'.$tg .'
            </td>
                  <td>46-236mg/dl 
            </td>
                </tr>
                <tr>
                <td>HDL
            </td>
                  <td >'.$hdl .'
            
            </td>
                  <td>"Without known coronary artery disease; ≥ 35 mg/dl:Desirable.
            With known coronary artery disease; ≥ 35 mg/dl:Optimal."	
            
            </td>
                </tr>
            
                <tr>
                  <td>LDL
            </td>
                <td>'.$ldl .'
            </td>
                <td>"Without known coronary artery disease; ≤ 130 mg/dl:Desirable.
            With known coronary artery disease; ≤ 100 mg/dl:Optimal."	
            </td>
              </tr>
            
            
            
                <tr>
                  <td>VLDL
            </td>
                <td>'.$vldl .'
            </td>
                <td>Normal VLDL levels are from 2 to 30 mg/Dl
            </td>
              </tr>
                <tr>
                  <td>Serum Creatinine
            </td>
                <td>'.$creat .'
            </td>
                <td>0.6 – 1.5 mg/dl
            </td>
              </tr>';
            
           
            if(!empty($astl))
            {
            $contentpdf.='
            
              <tr>
                  <td>AST (SGOT)
            </td>
                <td>'.$astl .'
            </td>
                <td>< 35 U/I
            </td>
              </tr>
              <tr>
                  <td>ALT (SGPT)
            
            </td>
                <td>'.$altl .'
            
            </td>
                <td>< 45 U/I
            
            </td>
              </tr>';
            
            
            }
$contentpdf.='</tbody>
            </table>
                      </div>
            
                                <div class="row border-b-2 brc-default-l2"></div>
            
                                <!-- or use a table instead -->
                                
            
                          <small class="mt-5">This is a computer generated report this doesnot require any signature.</small> <br>
                          <small >This report is generated for research purpose only and should not be use for diagonastic purposes.</small>
            
            
                               
            
                                <div class="mt-5">
                                   <div class="text-center">                     
                                     
            
                                
            <img alt="testing" src="barcode/barcode.php?size=40&text='.$studyid.'&print=true"/>
            
                              
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
            </div>  </body>
            </html>
';

// echo $contentpdf;
// $obj_pdf->writeHTMLCell(0, 0, '', '', $contentpdf, 0, 1, 0, true, '', true);
    $obj_pdf->writeHTML($contentpdf);  
    $obj_pdf->Output('file.pdf', 'I'); 


?>