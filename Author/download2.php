<?php
require("connection.php");
session_start();
$id=$_GET['id'];
$uid=$_SESSION['uid'];

require_once('tcpdf/tcpdf.php');  
    $lg = Array();
    $lg['a_meta_charset'] = 'UTF-8';
    $lg['a_meta_dir'] = 'rtl';
    $lg['a_meta_language'] = 'fa';
    $lg['w_page'] = 'page';
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      //$obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      //$obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->AddPage();  
      $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      $obj_pdf->setLanguageArray($lg);  
      $obj_pdf->SetFont('dejavusans', '', 12);  


if($_GET['tp']=='d'){
$sql=$db->prepare("select * from drafts where id ='$id' and uid='$uid'");
                $sql->execute();
                   $row=$sql->fetch();
}

if($_GET['tp']=='s'){
$sql=$db->prepare("select * from story where id ='$id' and uid='$uid'");
                $sql->execute();
                   $row=$sql->fetch();
}

             //   var_dump($row);

                        $path=getcwd();
                        //$myfile=fopen("file.html","w");
                        $text=$row['text']; 
                        $pattern='/(.BahrainStory.Author)/';
                        $replace=$path;
                        $ntext=preg_replace($pattern,$replace,$text);
                        //fwrite($myfile,$ntext);
                        //echo $ntext;
                        $obj_pdf->writeHTML($ntext);  
                        $obj_pdf->Output('file.pdf', 'I'); 


?>

