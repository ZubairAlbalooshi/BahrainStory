<?php
require("connection.php");
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
session_start();
$id=$_GET['id'];
$uid=$_SESSION['uid'];



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
                        $dompdf->loadHtml($ntext);
                        $dompdf->setPaper('A4','portrait');
                        $dompdf->render();
                        $dompdf->stream($row['title'],array("Attachment"=>1));


?>

