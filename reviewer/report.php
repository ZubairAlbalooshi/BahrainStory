<?php 
require("connection.php");

$stid=$_POST['stid'];
$reporterid=$_POST['reporterid'];
$reportedid=$_POST['reportedid'];
$reason=$_POST['reason'];
 
try{
    $sql=$db->prepare("insert into reporteduser (id , reporterid , reportedid , reason , stid) values (null , '$reporterid' , '$reportedid' , :reason , '$stid' )");
    
    $sql->bindParam(':reason', $reason);
    $sql->execute();
    echo "Done";
}

catch(Exception $e){
 echo "Failed";   
}


?>