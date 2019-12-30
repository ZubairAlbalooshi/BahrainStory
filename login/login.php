<?php 
    require("connection.php");

    if(isset($_POST["email"]) && isset($_POST["password"])){
        $email=$_POST["email"];
        $password=md5($_POST["password"]);
    try{    
        $stmt=$db->prepare("select * from users where email = :email and password = :password");
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
        $r=$stmt->rowCount();
        
        if($r==1){
                $row=$stmt->fetch();
                session_start();
                $_SESSION["email"]=$row["email"];
                $_SESSION["name"]=$row["name"];
                $_SESSION["type"]=$row["type"];
                $_SESSION["id"]=$row["id"];
                
        
            if($row["type"]=="Reviewer" && $row["status"]=="Active"){
           
                header("location:../../bahrainstory/reviewer"); // redirect to home screen + loged in 
                exit();
                                       }
            
            if($row["type"]=="Reviewer" && $row["status"]=="Inactive"){
                session_start();
                $_SESSION["email"]="Inactive";
                $_SESSION["Inactive"]=true;
                header("location:../../bahrainstory/login"); // redirect to home screen + loged in 
                exit();}
            
            if($row["type"]=="Author"){
                header("location:../../bahrainstory/Author"); // redirect to home screen + loged in
                exit();
                                                      }
                        if($row["type"]=="Admin"){
                header("location:../../bahrainstory/Admin"); // redirect to home screen + loged in
                exit();
                                                      }
                }
        else if($r==0){
            session_start();
            $_SESSION["email"]="wrong";
            header("location:http:../../bahrainstory/login");
            
        }
        
        }
        
    catch(Exception $e){
    echo "error",$e->getMessage();    
    }
        
        
    }
    
    else{
        header("location:/login");
    }
?>