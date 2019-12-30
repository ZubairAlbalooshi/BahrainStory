<?php 
    require("../connection.php");
        $message=$_POST["message"];
        $stid=$_POST["stid"];
        $username=$_POST["name"];
        $date = date("Y-m-d",time());
        $pid=$_POST["comment_id"];
        $star=$_POST["star"];
   // echo $pid;
      
//var_dump($_POST);

$error=" ";
      try{  $sql=$db->prepare("insert into comment (comment_id,parrent_comment_id,comment,username,date,stid,rating)
        values (null,:pid,:comment,:username,:date,:stid,:rating)");
        $sql->bindParam(":comment",$message);
        $sql->bindParam(":pid",$pid);
        $sql->bindParam(":username",$username);
        $sql->bindParam(":date",$date);
        $sql->bindParam(":rating",$star);  
        $sql->bindParam(":stid",$stid);
        $sql->execute();
        $error="<label class='text-suc'>Comment Added </label>";
         }
        
        catch(Exception $e){
         $error=$e->getMessage();    
        }
    

$data=array('error' => $error);

echo json_encode($data);
?>