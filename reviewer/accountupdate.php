<?php
require("connection.php");    
session_start();
if(isset($_POST['name'])){
    $name=$_POST['name'];
    $uid=$_SESSION['id'];
    if(strlen(trim($name))==0){
        echo "name cannot be empty";
        die();
    }
   
    try{
    $sql=$db->prepare("update users set name = '$name' where id = '$uid' ");
    $sql->execute();
      header("location: account.php");
        }
    catch(Exception $e)
    {
        echo $e;
    }
        
    
}

else header("location: ../404.html");
        
?>