<?php

require("connection.php");

if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["type"])){

    echo $name=$_POST["name"];
    echo $password=$_POST["password"];
    echo $email=$_POST["email"];
    echo $type =$_POST["type"];
    if(!isset($_POST["noyears"])){
        $noyears="-";
    }
    else {$noyears=$_POST["noyears"];} 
         
    
$stmt=$db->prepare("select * from users where email = '$email'");

    $stmt->execute();

$row=$stmt->rowCount();
echo $row;
    
if($row == 1){
    session_start();
    $_SESSION["email"]="exists";
    header("location:../login");//redirect login page with message indicating the email has an account and to login instead 
    exit();
}
    
else{ 
            try{
            $stmt=$db->prepare("insert into users values (null,:name,:email,:password,:type,:status,:noofyears)");
            $stmt->bindParam(':name',$name);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':password',md5($password));
            $stmt->bindParam(':type',$type );
                $status="";
                if($type=="Author"){
                    $status="Active";
                }
                
                else{
                    $status="Inactive";
                    
                }
                $stmt->bindParam(':status',$status);
                $stmt->bindParam(':noofyears',$noyears);
            $stmt->execute();
            
                session_start();
                if($type == "Author"){
                    $_SESSION["email"]="registered";
                }
                else{
                    $_SESSION["email"]="Inactive";
                }
                
                
            }
    
            catch (Exception $e){
                echo "error",$e->getMessage();
            }
            header("location:../login");// reditrect to login page with message indicating account has been registered
            exit();
    
    


}
}?>