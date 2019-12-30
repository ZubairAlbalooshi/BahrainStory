<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css"/>
<?php
require("connection.php");
session_start();
$id=$_GET['id'];
$uid=$_SESSION['uid'];

include "mpdf/mpdf.php";



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
                        $myfile=fopen("file.html","w");
                        $text='<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.4/css/froala_style.min.css" rel="stylesheet" type="text/css"/>'.'<div class="fr-view">'.$row['text'].'</div>'; 
                        $pattern='/(.BahrainStory.Author)/';
                        $replace=$path;
                        $ntext=preg_replace($pattern,$replace,$text);
                        fwrite($myfile,$ntext);
                        $mpdf = new Mpdf();
                        $mpdf->autoScriptToLang = true;
                        $mpdf->autoLangToFont = true;
                        $mpdf->WriteHTML(file_get_contents('file.html'));
                        $mpdf->Output('Story.pdf','D');


?>

