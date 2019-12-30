<?php
require("connection.php");    
session_start();
if(isset($_POST)){
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    $password=$_POST['password'];
    $uid=$_SESSION['id'];
    
    try{
    $password=md5($password);
    $sql=$db->prepare("select id from users where password = '$password' and id ='$uid' ");
    $sql->execute();
    $count=$sql->rowCount();
    }
     catch(Exception $e)
    {
        echo $e;
    }

    try{
        if($count==1){
            $newpassword=md5($newpassword);
    $sql=$db->prepare("update users set password = '$newpassword' where id = '$uid' ");
    $sql->execute();
       session_start();
       session_destroy();
        session_start();
        $SESSION['email']="newpassword";
      header("location: ../login/");
        }
    else die("entered password is wrong");
    }
    catch(Exception $e)
    {
        echo $e;
    }
        
    
}

else header("location: ../404.html");
        
?>