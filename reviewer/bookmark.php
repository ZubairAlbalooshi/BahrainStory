<?php
require("connection.php");
$uid=$_POST['uid'];
 $stid=$_POST['stid'];
    
    $albookmarked=false;
    try{
        $sql=$db->prepare("select count(*) as count from bookmarks where stid='$stid' and  uid='$uid'");
        $sql->execute();
        $row=$sql->fetch();
        if($row[0]>0){
            echo "Already Bookmarked";
            die();
        }
    }
    
    catch(Exception $e){
        echo $e;
    }

    try{
        $sql=$db->prepare("insert into bookmarks (id,stid,uid) values (null,'$stid','$uid')");
        $sql->execute();
        echo "Done";
    }
    catch(Exceptions $e){
        $e->getMessage();
        echo "Problem";
    }
?>